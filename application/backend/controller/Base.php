<?php
/**
 * Created by PhpStorm.
 * User: Andy
 * Date: 2020/1/28
 * Time: 16:34
 */
namespace app\backend\controller;

use think\Controller;
use app\backend\model\Admins;
use app\service\model\AdminLog;
use think\Cookie;

class Base extends Controller
{


    public function _initialize()
    {
        parent::_initialize();
        if(empty(session('admin_user_name'))){
            $this->redirect(url('/backend/login/index'));
        }
        $random_number = Admins::table("wolive_admin")->where('id',session('admin_user_id'))->value('random_number');
        if($random_number != session('random_number')){
            session('admin_user_name', null);
            session('admin_user_id', null);
            session('random_number', null);
            $this->redirect(url('/backend/login/index'));
        }
        $redisToken = \think\Cache::store('redis')->get('service_token:'.session('admin_user_id'));
        if (empty($redisToken)){
            session('admin_user_name', null);
            session('admin_user_id', null);
            session('random_number', null);
            $this->redirect(url('/backend/login/index'));
        }
        $this->assign([
            'admin_name' => session('admin_user_name'),
            'admin_id' => session('admin_user_id'),
        ]);
    }
    public function log($info){
        $data = [
            'uid' => session('admin_user_id') ? session('admin_user_id') : 0,
            'info' => $info,
            'ip' => $this->request->ip(),
            'user_agent' => $this->request->server('HTTP_USER_AGENT'),
            'create_time' => time(),
        ];
        AdminLog::table('wolive_admin_log')->insert($data);
    }

}