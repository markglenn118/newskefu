# aikefu
名称	版本要求

服务器	CPU 2核心 ↑
运存 4G ↑
宽带 5M ↑
服务器操作系统	Linux Centos7 

运行环境	Nginx 1.18 
PHP 7.3 
MYSQL 5.6 

PHP设置

一、安装PHP插件：fileinfo、redis
二、删除PHP对应版本中的 pcntl_signal 、pcntl_signal_dispatch、 pcntl_fork、pcntl_wait、pcntl_alarm 禁用函数
站点配置

一、上传源码包到站点目录并解压
二、设置网站运行目录public
 
⦁	设置伪静态，选择thinkphp
 

程序安装

⦁	输入http://站点域名/install.php，执行一键安装
 

二、等待程序安装，安装完成后建议删除public目录下的install.php文件

运行服务

⦁	开放端口9090、2080
 

⦁	进入网站目录，打开终端
 

⦁	在终端窗口执行命令：php service/start.php start -d
 

客服系统SSL配置

⦁	设置宝塔SSL证书
 
注意：不能开启强制HTTPS

⦁	进入 /站点目录/public目录下,修改index.php
 
 

⦁	进入 /站点目录/service 目录下,修改config.php
 


四、开放456、443端口
 

五、设置网站，修改配置文件：
在service{}内加上
location  /app{
  proxy_pass http://127.0.0.1:456;     
  proxy_http_version 1.1;
  proxy_set_header Upgrade $http_upgrade;
  proxy_set_header Connection "Upgrade";
  proxy_set_header X-Real-IP $remote_addr;
}

 

六、重启推送服务：宝塔》终端；执行以下命令
php /www/wwwroot/你的站点目录/service/start.php restart -d

⦁	重启Nginx
 

站点管理

客服系统总后台
http://你的域名/backend
 
商户后台
http://你的域名/service


翻译配置

商户后台》商户设置
到百度翻译API申请接口权限【https://api.fanyi.baidu.com/】
选择：通用翻译API


其他配置
前端开启商户自助注册功能（默认开启）
打开/config/config.php文件
