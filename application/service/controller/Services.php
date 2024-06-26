<?php


namespace app\service\controller;

use app\service\model\Sentence;
use app\service\model\Service;
use app\service\model\WoliveReply;
use think\Db;
use app\service\model\Business;
use think\File;
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
        $group = Db::name("wolive_group")->where(['business_id'=>$_SESSION['Msg']['business_id']])->select();
        $this->assign('group', $group);
        return $this->fetch();
    }

    public function add()
    {
        if ($this->request->isAjax()) {
            $post = $this->request->post();
            $result = $this->validate($post, 'Services');
            if ($result !== true) $this->error('验证失败！');
            if ($post['nick_name'] == "") $post['nick_name'] = "客服" . $post['user_name'];
            $num = Service::where('business_id', $_SESSION['Msg']['business_id'])->count();
            $max = Business::where('id', $_SESSION['Msg']['business_id'])->value('max_count');
            if ($max != 0 && $num >= $max) $this->error('新增客服已经达到限制,不能再添加!');
            $service = Service::where('user_name', $post['user_name'])->find();
            if ($service) $this->error('该客服名已经存在!');
            unset($post['password2']);
            $post['parent_id'] = $_SESSION['Msg']['service_id'];
            $post["business_id"] = $_SESSION['Msg']['business_id'];
            $pass = md5($post['user_name'] . "hjkj" . $post["password"]);
            $post['password'] = $pass;
            $res = Service::field(true)->insert($post);
            if ($res){
                $service = Service::where('user_name', $post['user_name'])->find();
                //添加问候语
                $sentenceData = Sentence::where('service_id',$_SESSION['Msg']['service_id'])->select();
                if ($sentenceData){
                    $insertData = [];
                    foreach ($sentenceData as $value){
                        $insertData[] = [
                            'content'=> $value['content'],
                            'service_id'=> $service['service_id'],
                            'state'=> $value['state'],
                            'lang'=> $value['lang'],
                        ];
                    }
                    (new Sentence())->saveAll($insertData);
                }

                //添加快捷回复
                $data = WoliveReply::where('service_id',$_SESSION['Msg']['service_id'])->select();
                if ($data){
                    $insertData = [];
                    foreach ($data as $value){
                        $insertData[] = [
                            'word'=> $value['word'],
                            'service_id'=> $service['service_id'],
                            'tag'=> $value['tag'],
                        ];
                    }
                    (new WoliveReply())->saveAll($insertData);
                }

             $this->success('添加成功');
            }
            $this->error('添加失败！');
        }
        $group = Db::name("wolive_group")->select();
        $this->assign('group', $group);
        return $this->fetch();
    }

    public function edit()
    {
        if ($this->request->isAjax()) {

            $post = $this->request->post();
            $service = Service::where(['service_id' => $post['id']])->find();
            $res = Service::where("service_id", $post['id'])->field(true)->update($post);
            if ($res) {
                $this->log('[客服账号]修改客服【'.$service['nick_name'].'】的资料'.json_encode($post));
                $this->success('修改成功');
            }
            $this->error('修改失败！');
        }
        $id = $this->request->get('id');
        $service = Service::where(['service_id' => $id])->find();
        $group = Db::name("wolive_group")->select();
        $this->assign('service', $service);
        $this->assign('group', $group);
        return $this->fetch();
    }

    public function upload_avatar()
    {
        $file = $this->request->file('file');
        if ($file) {
            $newpath = ROOT_PATH . "/public/upload/images/{$_SESSION['Msg']['business_id']}/";
            $info = $file->validate(['ext' => 'jpg,png,gif,jpeg'])->move($newpath, time());
            if ($info) {
                $imgname = $info->getFilename();
                $imgpath = $this->base_root . "/upload/images/{$_SESSION['Msg']['business_id']}/" . $imgname;
                $this->success('上传成功', '', $imgpath);
            } else {
                $this->error('上传失败！');
            }
        }
        $this->error('上传失败！');
    }

    public function pass()
    {
        if ($this->request->isAjax()) {
            $post = $this->request->post();
            if ($post['newpass'] != $post['newpass2']) $this->error('新密码不一致');
            $result = $this->validate($post, 'Check.change_service_pwd');
            if ($result !== true) return ['code' => 0, 'msg' => $result];
            $user = Service::where("service_id", $post['id'])->find();
            $pass = md5($user['user_name'] . "hjkj" . $post['newpass']);
            $res = Service::table("wolive_service")->where("service_id", $post['id'])->update(["password" => $pass]);
            if ($res) {
                $this->log('[客服账号]重置客服【'.$user['nick_name'].'】的密码');
                $this->success('修改成功');
            }
            $this->error('修改失败！');
        }
        return $this->fetch();
    }

    public function offline_first()
    {
        $post = $this->request->post();
        $result = Service::where('service_id', $post['service_id'])->update(['offline_first' => $post['offline_first']]);
        if ($result) $this->success('操作成功！');
        $this->error('操作失败！');
    }

    public function remove()
    {
        $id = $this->request->get('service_id');
        if (Service::destroy(['service_id' => $id,'business_id'=>$_SESSION['Msg']['business_id']])) $this->success('操作成功！');
        $this->error('操作失败！');
    }
    public function code(){
        
        $service = Service::where('service_id',$this->request->get('service_id'))->find();
        if($service['google_url']){
            $google_url = $service['google_url'];
        }else{
            Loader::import('google.Google', VENDOR_PATH,'.php');
            $Googl = new \Google();
            //生成秘钥
            $secret = $Googl->createSecret();
            $nickname = !empty($service['another_name']) ? $service['another_name'] : $service['user_name'];
            $google_url = $Googl->getQRCodeGoogleUrl($nickname,$secret);
            Service::where("service_id",$this->request->get('service_id'))->update(['google_secret'=>$secret,'another_name'=>$nickname,'google_url'=>$google_url]);
            $this->log('[客服账号]生成客服【'.$service['nick_name'].'】的谷歌二维码');
        }
        $this->assign('google_url', $google_url);
        return $this->fetch();
    }
    public function reset(){
//        if ($this->request->isAjax()) {
            $service = Service::where('service_id',$this->request->get('service_id'))->find();
            $updateService = Service::where('service_id',$_SESSION['Msg']['service_id'])->find();
            if(!$service){
                $this->error('数据不存在');
            }
            if($updateService['level'] == 'service' && $this->request->get('service_id') !=$_SESSION['Msg']['service_id']){
                $this->error('权限不足');
            }
            $update = ['google_bind'=>0];
//            if (trim($post['nickname']) != $service['another_name']){
//                Loader::import('google.Google', VENDOR_PATH,'.php');
//                $Googl = new \Google();
//                $secret = $Googl->createSecret();
//                $google_url = $Googl->getQRCodeGoogleUrl(trim($post['nickname']),$secret);
//                $update = ['google_bind'=>0,'google_url'=>$google_url,'google_secret'=>$secret,'another_name'=>trim($post['nickname'])];
//            }
            if(Service::where("service_id",$this->request->get('service_id'))->update($update)){
                $this->log('[客服账号]重置客服【'.$service['nick_name'].'】的谷歌二维码');
                $this->success('重置谷歌验证码成功');
                
            }
            $this->error('修改失败！');
//        }
//        $service = Service::where('service_id',$this->request->get('service_id'))->find();
//        $this->assign('another_name', $service['another_name']);
//        return $this->fetch();
    }
}