<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]

ini_set('session.gc_maxlifetime', 432000);
ini_set('session.cookie_lifetime', 432000);
ini_set('session.gc_probability',1);
ini_set('session.gc_divisor',1000);


isset($_SESSION) or session_start();

// 定义环境版本

// 定义应用目录
define('APP_PATH', __DIR__ . '/../application/');
define('VENDOR',__DIR__.'/../vendor/');

// 定义配置文件目录
define('CONF_PATH', __DIR__ . '/../config/'); 


// 定义pusher密匙
define('app_key','f94r9nxhvuycfcc1');
define('app_secret','no56jmquzkdgepepmoxj3c69v89q9hql');
define('app_id',232);
define('whost','ws://192.168.101.197');
define('ahost','http://192.168.101.197');
define('wport',9090);
define('aport',2080);
define('registToken','381533248');
define('AIKF_SALT','zt01v7vh5tk76wn8gs');
define('AKF_VERSION','AI_KF');

// 自定义一个 入口 目录
define('PUBLIC_PATH',__DIR__);
// 定义 类的文件路径
define('EXTEND_PATH','../extend/');

// 定义微信配置
define('appid','');
define('appsecret','');
define('token','');
define('domain','http://192.168.101.197');

//redis服务配置
define("REDIS", [
        'host'=>'192.168.101.194',
        'port'=> 6379,
        'pwd'=> '1234']
);
//访客会话保存时长（秒）
define('CACHE_VISIT',60);

//FTP 服务配置
define("FTP", [
        'path'=>'107.187.39.13',
        'port'=> 21,
        'username'=> 'testftp',
        'password'=> 'XPFLwRhHa8xfyLCy',
        'domain'=> 'http://107.187.39.13:8081/',
    ]
);
// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';