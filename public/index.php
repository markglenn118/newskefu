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
define('app_key','tjawfoxkc2hsr4k9');
define('app_secret','ykne5lhnaq6igu7fmupva5gv6sjkf4vh');
define('app_id',232);
define('whost','ws://www.kefu.cn');
define('ahost','http://www.kefu.cn');
define('wport',9090);
define('aport',2080);
define('registToken','1190672203');
define('AIKF_SALT','aio3anna21tmf8l7qq');
define('AKF_VERSION','AI_KF');

// 自定义一个 入口 目录
define('PUBLIC_PATH',__DIR__);
// 定义 类的文件路径
define('EXTEND_PATH','../extend/');

// 定义微信配置
define('appid','');
define('appsecret','');
define('token','');
define('domain','http://www.kefu.cn');

// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';