<?php
use Bunny\Channel;
use Workerman\Worker;
use Workerman\RabbitMQ\Client;

require __DIR__ . '/../../vendor/autoload.php';

$worker = new Worker();

$worker->onWorkerStart = function() {
    global $argv;
    unset($argv[1]);
    $argv = array_values($argv);
    $routing_key = isset($argv[1]) && !empty($argv[1]) ? $argv[1] : 'info';
    $data = implode(' ', array_slice($argv, 2));
    if (empty($data)) {
        $data = "Hello World!";
    }

    (new Client())->connect()->then(function (Client $client) {
        return $client->channel();
    })->then(function (Channel $channel) {
        return $channel->exchangeDeclare('topic_logs', 'topic')->then(function () use ($channel) {
            return $channel;
        });
    })->then(function (Channel $channel) use ($data, $routing_key) {
        echo " [x] Sending ", $routing_key, ':', $data, " \n";
        return $channel->publish($data, [], 'topic_logs', $routing_key)->then(function () use ($channel) {
            return $channel;
        });
    })->then(function (Channel $channel) use ($data, $routing_key) {
        echo " [x] Sent ", $routing_key, ':', $data, " \n";
        $client = $channel->getClient();
        return $channel->close()->then(function () use ($client) {
            return $client;
        });
    })->then(function (Client $client) {
        $client->disconnect();
    });

};

Worker::runAll();
