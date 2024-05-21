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
        $service = Db::name('wolive_service')->where('service_id', $id)->find();
        if (Service::destroy(['service_id' => $id])) {
            $this->log('删除客服昵称为【'.$service['nick_name'].'】的账号');
            $this->success('操作成功！');
        }
        $this->error('操作失败！');
    }

    public function clear()
    {
        $id = $this->request->get('id');
        $service = Db::name('wolive_service')->where('service_id', $id)->find();
        if (Db::name('wolive_chats')->where('service_id', $id)->delete()) {
            $this->success('操作成功！');
            $this->log('清空了客服昵称为【'.$service['nick_name'].'】的聊天记录');
        }
        $this->error('操作失败！');
    }
    public function code(){
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
            $this->log('生成了客服昵称为【'.$service['nick_name'].'】的谷歌二维码');
        }
        $this->assign('google_url', $google_url);
        return $this->fetch();
    }
    public function reset(){
//        if ($this->request->isAjax()) {
            $service = Db::name('wolive_service')->where('service_id',$this->request->get('service_id'))->find();
            if(!$service){
                $this->error('数据不存在');
            }
            $update = ['google_bind'=>0];
            if(\app\service\model\Service::where("service_id",$this->request->get('service_id'))->update($update)) {
                $this->log('重置了客服昵称为【'.$service['nick_name'].'】的谷歌二维码');
                $this->success('操作成功！');
            }
            $this->error('修改失败！');
//        }
//        return $this->fetch();
    }
}