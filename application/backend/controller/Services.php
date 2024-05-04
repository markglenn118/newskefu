<?php


namespace app\backend\controller;

use app\backend\model\Service;
use think\Db;
use think\Loader;
/**
 *
 * 后台页面控制器.
 */
class Services extends Base
{

    public function index()
    {
        if ($this->request->isAjax()) {
            return Service::getList();
        }
        return $this->fetch();
    }

    public function remove()
    {
        $id = $this->request->get('service_id');
        if (Service::destroy(['service_id' => $id])) $this->success('操作成功！');
        $this->error('操作失败！');
    }

    public function clear()
    {
        $id = $this->request->get('id');
        if (Db::name('wolive_chats')->where('service_id', $id)->delete()) {
            $this->success('操作成功！');
        }
        $this->error('操作失败！');
    }
    public function code(){
        //echo $this->request->get('service_id');exit;
        $service = Db::name('wolive_service')->where('service_id',$this->request->get('service_id'))->find();
        if($service['google_url']){
            $google_url = $service['google_url'];
        }else{
            Loader::import('google.Google', VENDOR_PATH,'.php');
            $Googl = new \Google();
            //生成秘钥
            $secret = $Googl->createSecret();
            $nickname = !empty($service['another_name']) ? $service['another_name'] : $service['user_name'];
            $google_url = $Googl->getQRCodeGoogleUrl($nickname,$secret);
            Db::name('wolive_service')->where("service_id",$this->request->get('service_id'))->update(['google_secret'=>$secret,'google_url'=>$google_url]);
        }
        $this->assign('google_url', $google_url);
        return $this->fetch();
    }
    public function reset(){
        if ($this->request->isAjax()) {
            $post = $this->request->post();
            if(Service::resetBusiness($post,$this->request->get('service_id'))) $this->success('操作成功！');
            $this->error('修改失败！');
        }
        return $this->fetch();
    }
}