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
        $this->assign([
            'admin_name' => session('admin_user_name'),
            'admin_id' => session('admin_user_id'),
        ]);
    }

}