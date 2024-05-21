<?php

use Bunny\Channel;
use Bunny\Message;
use Workerman\Worker;
use Workerman\RabbitMQ\Client;

require __DIR__ . '/../../vendor/autoload.php';

$worker = new Worker();

$worker->onWorkerStart = function() {
    (new Client())->connect()->then(function (Client $client) {
        return $client->channel();
    })->then(function (Channel $channel) {
        return $channel->qos(0, 1)->then(function () use ($channel) {
            return $channel;
        });
    })->then(function (Channel $channel) {
        return $channel->queueDeclare('task_queue', false, true, false, false)->then(function () use ($channel) {
            return $channel;
        });
    })->then(function (Channel $channel) {
        echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";
        $channel->consume(
            function (Message $message, Channel $channel, Client $client) {
                echo " [x] Received ", $message->content, "\n";
                sleep(substr_count($message->content, '.'));
                echo " [x] Done", $message->content, "\n";
                $channel->ack($message);
            },
            'task_queue'
        );
    });
};

Worker::runAll();
