<?php

use Bunny\Channel;
use Bunny\Message;
use Bunny\Protocol\MethodQueueDeclareOkFrame;
use Workerman\Worker;
use Workerman\RabbitMQ\Client;

require __DIR__ . '/../../vendor/autoload.php';

$worker = new Worker();

$worker->onWorkerStart = function() {
    global $argv;
    unset($argv[1]);
    $argv = array_values($argv);
    $severities = array_slice($argv, 1);
    if (empty($severities)) {
        file_put_contents('php://stderr', "Usage: $argv[0] [info] [warning] [error]\n");
        exit(1);
    }
    (new Client())->connect()->then(function (Client $client) {
        return $client->channel();
    })->then(function (Channel $channel) use ($severities) {
        return $channel->exchangeDeclare('direct_logs', 'direct')->then(function () use ($channel, $severities) {
            return $channel->queueDeclare('', false, false, true, false);
        })->then(function (MethodQueueDeclareOkFrame $frame) use ($channel, $severities) {
            $promises = [];

            foreach ($severities as $severity) {
                $promises[] = $channel->queueBind($frame->queue, 'direct_logs', $severity);
            }

            return \React\Promise\all($promises)->then(function () use ($frame) {
                return $frame;
            });
        })->then(function (MethodQueueDeclareOkFrame $frame) use ($channel) {
            echo ' [*] Waiting for logs. To exit press CTRL+C', "\n";
            $channel->consume(
                function (Message $message, Channel $channel, Client $client) {
                    echo ' [x] ', $message->content, "\n";
                },
                $frame->queue,
                '',
                false,
                true
            );
        });
    });
};

Worker::runAll();
