<?php
// 这里填写客服系统域名，前面带http://，用于pusher系统通知客服平台客户或者客服上下线
$domain = 'http://192.168.101.196';

// App_key，客服系统与pusher通讯的key
$app_key = 'f94r9nxhvuycfcc1';

// App_secret，客服系统与pusher通讯的密钥
$app_secret = 'no56jmquzkdgepepmoxj3c69v89q9hql';

// App id
$app_id = 232;

// websocket 端口，客服系统网页会连这个端口
$websocket_port = 9090;

// Api 端口，用于后端与pusher通讯
$api_port = 2080;

//当前服务的域名或ip
define("HOST_INFO", [
    'host'=>'http://192.168.101.196',
    'port'=> $api_port]
);

//redis服务配置
define("REDIS", [
        'host'=>'http://192.168.101.196',
        'port'=> $api_port,
        'pwd'=> $api_port]
);


