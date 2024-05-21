<?php

use Bunny\Client;

require '../../vendor/autoload.php';

$client = (new Client())->connect();
$channel = $client->channel();

$channel->exchangeDeclare('logs', 'fanout');
// 启用confirm模式
$channel->setConfirmSelect();
$channel->confirmSelect();
$data = implode(' ', array_slice($argv, 1));
$channel->publish($data, [], 'logs');
echo " [x] Sent '{$data}'\n";
$channel->waitForConfirmsOrDie();
$channel->close();
$client->disconnect();
