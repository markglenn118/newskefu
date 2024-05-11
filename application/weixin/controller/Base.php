<?php 
namespace app\weixin\controller;
use think\Controller;

class Base extends Controller
{
     public function _initialize()
    {
        if (empty($_SESSION['Msg'])) {
            $APPID=appid;   
          
            $url = domain;
            $REDIRECT_URI=$url.'/weixin/login';
            $scope='snsapi_base';
            $url='https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$APPID.'&redirect_uri='.urlencode($REDIRECT_URI).'&response_type=code&scope='.$scope.'&state=123#wechat_redirect';

            $this->redirect($url);
        }

        $login = $_SESSION['Msg'];
        $app_key = app_key;
        $whost = whost;
        $arr = parse_url($whost);
        if ($arr['scheme'] == 'ws') {
            $value = 'false';
            $port = 'wsPort';
        } else {
            $value = 'true';
            $port = 'wssPort';
        }

        $this->assign('app_key', $app_key);
        $colonyServer = colony_server($_SESSION['Msg']['service_id']);
        $this->assign('whost',$colonyServer['host']);
        $this->assign('value', $value);
        $this->assign('wport', $colonyServer['wport']);
        $this->assign('port', $port);
        $this->assign('arr', $login);
    }
}