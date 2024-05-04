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
define('app_key','jbktpwaf4qwtppgl');
define('app_secret','lef6pg66gz5sybl4dqfmf1xlrb9635r6');
define('app_id',232);
define('whost','wss://chate.uincloud.cn');
define('ahost','http://chate.uincloud.cn');
define('wport',443);
define('aport',2080);
define('registToken','1698688094');
define('AIKF_SALT','hjrupv7dlvnl0b0vvq');
define('AKF_VERSION','AI_KF');

// 自定义一个 入口 目录
define('PUBLIC_PATH',__DIR__);
// 定义 类的文件路径
define('EXTEND_PATH','../extend/');

// 定义微信配置
define('appid','');
define('appsecret','');
define('token','');
define('domain','http://chate.uincloud.cn');

// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';