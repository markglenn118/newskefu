<?php


namespace app\service\controller;

use app\service\model\Service;
use app\service\model\WoliveReply;
use think\Db;

/**
 *
 * 后台页面控制器.
 */
class Chat extends Base
{
    public function index()
    {
        $login = $_SESSION['Msg'];
        $res = Db::table('wolive_business')->where('id', $login['business_id'])->find();
        $service = Db::table('wolive_service')->where('service_id', $login['service_id'])->find();
        $this->assign("type", $res['video_state']);
        $this->assign("service", $service);
        $this->assign('atype', $res['audio_state']);
        $this->assign('imghead', $login['avatar']);
        return $this->fetch();
    }

    /** 快捷回复列表
     * @return array|mixed
     */
    public function wolive()
    {
        if ($this->request->isAjax()) return WoliveReply::getList();
        return $this->fetch();
    }

    /** 添加快捷回复
     * @return array|mixed
     * @throws \Exception
     */
    public function wolive_add()
    {
        if ($this->request->isAjax()) {
            $post = $this->request->post();
            $post['service_id'] = $_SESSION['Msg']['service_id'];
            $post['word'] = $this->request->post('word');
            $post['tag'] = $this->request->post('tag');
            //商户号
            if ($_SESSION['Msg']['parent_id'] == 0){
                $serviceIds = Service::where('parent_id',$_SESSION['Msg']['service_id'])->column('service_id');
                array_push($serviceIds,$_SESSION['Msg']['service_id']);
                $insertData = [];
                foreach ($serviceIds as $id){
                    $post['service_id'] = $id;
                    $insertData[] = $post;
                }
                WoliveReply::where('service_id','in',$serviceIds)->where('tag',$post['tag'])->delete();
                $res = (new WoliveReply())->saveAll($insertData);
            }else{
                $res = WoliveReply::insert($post);
            }
            if ($res) $this->success('添加成功');
            $this->error('添加失败！');
        }
        return $this->fetch();
    }
    /** 修改快捷回复
     * @return array|mixed
     * @throws \think\exception\DbException
     */
    public function wolive_edit()
    {
        if ($this->request->isAjax()) {
            $post = $this->request->post();
            $post['service_id'] = $_SESSION['Msg']['service_id'];
            $post['word'] = $this->request->post('word');
            $post['tag'] = $this->request->post('tag');
            $woliveReply = WoliveReply::get($this->request->post('id'));
            if (empty($woliveReply)){
                $this->error('修改失败！');
            }
            //商户号
            if ($_SESSION['Msg']['parent_id'] == 0){
                $serviceIds = Service::where('parent_id',$_SESSION['Msg']['service_id'])->column('service_id');
                array_push($serviceIds,$_SESSION['Msg']['service_id']);
                unset($post['id']);
                $insertData = [];
                foreach ($serviceIds as $id){
                    $post['service_id'] = $id;
                    $insertData[] = $post;
                }
                WoliveReply::where('service_id','in',$serviceIds)->where('tag',$woliveReply['tag'])->delete();
                $res = (new WoliveReply())->saveAll($insertData);
            }else{
                $res = WoliveReply::where("sid", $post['id'])->where('service_id', $_SESSION['Msg']['service_id'])->field(true)->update($post);
            }
            if ($res) $this->success('修改成功');
            $this->error('修改失败！');
        }
        $id = $this->request->get('id');
        $robot = WoliveReply::get(['id' => $id]);
        $this->assign('woliveReply', $robot);
        return $this->fetch();
    }
    /** 删除快捷回复
     * @return void
     * @throws \think\exception\DbException
     */
    public function wolive_remove()
    {
        $id = $this->request->get('id');
        if ($_SESSION['Msg']['parent_id'] == 0){
            $serviceIds = Service::where('parent_id',$_SESSION['Msg']['service_id'])->column('service_id');
            array_push($serviceIds,$_SESSION['Msg']['service_id']);
            $woliveReply = WoliveReply::get(['id' => $id]);
            $res = WoliveReply::where('service_id','in',$serviceIds)->where('tag',$woliveReply['tag'])->delete();
        }else{
            $res = WoliveReply::destroy(['sid' => $id]);
        }
        if ($res) $this->success('操作成功！');
        $this->error('操作失败！');
    }
}