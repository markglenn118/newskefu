<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:85:"C:\Users\13424\Desktop\WWW\kefu\public/../application/service\view\setting\index.html";i:1714829877;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/static/component/pear/css/pear.css"/>
    <style>
        .layui-form-label{
            text-align: left;
        }
    </style>
</head>
<body>
<form class="layui-row layui-col-space10 layui-form">
    <div class="layui-col-md12">
        <div class="layui-card" style="margin-left: 20px;margin-top: 20px;">
            <div class="layui-card-header">商户设置</div>
            <div class="layui-form-item" style="margin-top: 20px">
                <label class="layui-form-label">网页标题</label>
                <div class="layui-input-block">
                    <input name="webs" value="<?php echo $business['webs']; ?>" class="layui-input" style="width: 250px;display: inline-block;margin-right: 10px"/>
                    (必填，如：云客服)
                </div>
            </div>
                       <div class="layui-form-item">
                    <input type="text" name="chatbg" value="<?php echo $business['chatbg']; ?>" id="kefu_avatar" class="layui-input" style="width: 250px;display: inline-block;margin-right: 10px"/>
                    <label class="layui-form-label">聊天背景图</label>
                    <div class="layui-input-block">
                        <img src="<?php echo $business['chatbg']; ?>" width="50px" height="50px" id="avatar">
                        <a href="javascript:;" style="margin-left: 20px;color:#01AAED" id="upload_avatar">重新上传</a>(只允许上传图片格式文件，jpg、png、jpeg)尺寸最好为1920*1080
                    </div>
                </div>
                     <div class="layui-form-item">
                    <input type="text" name="pinpai" value="<?php echo $business['pinpai']; ?>" id="kefu_bvatar" class="layui-input" style="width: 250px;display: inline-block;margin-right: 10px"/>
                    <label class="layui-form-label">品牌logo</label>
                    <div class="layui-input-block">
                        <img src="<?php echo $business['pinpai']; ?>" width="50px" height="50px" id="bvatar">
                        <a href="javascript:;" style="margin-left: 20px;color:#01AAED" id="upload_bvatar">重新上传</a>(只允许上传图片格式文件，jpg、png、jpeg)尺寸最好为200*200
                    </div>
                </div>
                <div class="layui-form-item" style="margin-top: 20px">
                <div class="layui-form-item">
                    <input type="text" name="charad" value="<?php echo $business['charad']; ?>" id="charad" class="layui-input" style="width: 250px;display: inline-block;margin-right: 10px"/>
                    <label class="layui-form-label">右侧广告图</label>
                    <div class="layui-input-block">
                        <img src="<?php echo $business['charad']; ?>" width="50px" height="50px" id="char_ad">
                        <a href="javascript:;" style="margin-left: 20px;color:#01AAED" id="upload_charad">重新上传</a>(只允许上传图片格式文件，jpg、png、jpeg)尺寸最好为200px200px默认程序会自动缩放
                    </div>
                </div>
                <div class="layui-form-item" style="margin-top: 20px">
                <label class="layui-form-label">广告图链接</label>
                <div class="layui-input-block">
                    <input name="adurl" value="<?php echo $business['adurl']; ?>" class="layui-input" style="width: 250px;display: inline-block;margin-right: 10px"/>
                    (图片广告跳转地址，没有地址请留空。如http://www.baidu.com)
                </div>
            </div>     
            <div class="layui-form-item" style="margin-top: 20px">
                <label class="layui-form-label">广告介绍</label>
                <div class="layui-input-block">
                    <input name="jieshao" value="<?php echo $business['jieshao']; ?>" class="layui-input" style="width: 250px;display: inline-block;margin-right: 10px"/>
                    (填写80字符 如：华为创立于1987年，是全球领先的ICT（信息与通信）基础设施和智能终端提供商。)
                </div>
            </div>
                </div>
            <div class="layui-form-item" style="margin-top: 20px">
                <label class="layui-form-label">默认语言</label>
                <div class="layui-input-inline">
                    <select name="lang" lay-verify="required">
                        <option value="">请选择默认语言</option>
                        <?php $_66364a1ce0fdc=config('lang'); if(is_array($_66364a1ce0fdc) || $_66364a1ce0fdc instanceof \think\Collection || $_66364a1ce0fdc instanceof \think\Paginator): if( count($_66364a1ce0fdc)==0 ) : echo "" ;else: foreach($_66364a1ce0fdc as $key=>$vo): ?>
                        <option value="<?php echo $key; ?>" <?php if($business['lang'] == $key): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
            </div>
            <div class="layui-form-item" style="margin-top: 20px">
                <label class="layui-form-label">翻译APPID</label>
                <div class="layui-input-block">
                    <input name="bd_trans_appid" value="<?php echo $business['bd_trans_appid']; ?>" class="layui-input" style="width: 250px;display: inline-block;margin-right: 10px"/>
                    <span>百度翻译API【<a href="https://api.fanyi.baidu.com/" target="_blank">点击申请</a>】</span>
                </div>
            </div>
            <div class="layui-form-item" style="margin-top: 20px">
                <label class="layui-form-label">翻译密钥</label>
                <div class="layui-input-block">
                    <input name="bd_trans_secret" value="<?php echo $business['bd_trans_secret']; ?>" class="layui-input" style="width: 250px;display: inline-block;margin-right: 10px"/>
                    <span>百度翻译API【<a href="https://api.fanyi.baidu.com/doc/21" target="_blank">查看文档</a>】</span>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" style="width: 220px">翻译（客服回复消息时自动翻译）</label>
                <div class="layui-input-inline">
                    <select name="auto_trans" lay-verify="required" >
                        <option value="1" <?php if($business['auto_trans'] == 1): ?>selected<?php endif; ?>>启用</option>
                        <option value="0" <?php if($business['auto_trans'] == 0): ?>selected<?php endif; ?>>禁用</option>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" style="width: 220px">根据用户IP自动设置语言</label>
                <div class="layui-input-inline">
                    <select name="auto_ip" lay-verify="required" >
                        <option value="1" <?php if($business['auto_ip'] == 1): ?>selected<?php endif; ?>>启用</option>
                        <option value="0" <?php if($business['auto_ip'] == 0): ?>selected<?php endif; ?>>禁用</option>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" style="width: 220px">是否开启公众号模板消息</label>
                <div class="layui-input-inline">
                    <select name="template_state" lay-verify="required" >
                        <option value="open" <?php if($business['template_state'] == 'open'): ?>selected<?php endif; ?>>启用</option>
                        <option value="close" <?php if($business['template_state'] == 'close'): ?>selected<?php endif; ?>>禁用</option>
                    </select>
                </div>
            </div>

            <div class="layui-form-item" style="margin: 15px">
                <h3>服务器地址(URL)</h3>
                <div class="layui-code">
                    <?php echo url('weixin/index/index',['business_id'=>$_SESSION['Msg']['business_id']],false,true); ?>
                </div>
                <div style="color: #636c72;">此地址填写到公众号后台服务器地址(URL)中</div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label" style="width: 220px">公众号原始id</label>
                <div class="layui-input-inline">
                    <input type="text" name="wx_id" placeholder="请输入公众号原始id" autocomplete="off" class="layui-input" value="<?php echo $template['wx_id']; ?>" style="width: 250px;display: inline-block;margin-right: 10px">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" style="width: 220px">公众号AppId</label>
                <div class="layui-input-inline">
                    <input type="text" name="app_id" placeholder="请输入公众号AppId" autocomplete="off" class="layui-input" value="<?php echo $template['app_id']; ?>" style="width: 250px;display: inline-block;margin-right: 10px">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" style="width: 220px">公众号AppSecret</label>
                <div class="layui-input-inline">
                    <input type="text" name="app_secret" placeholder="请输入公众号AppSecret" autocomplete="off" class="layui-input" value="<?php echo $template['app_secret']; ?>" style="width: 250px;display: inline-block;margin-right: 10px">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" style="width: 220px">公众号token</label>
                <div class="layui-input-inline" style="display: flex;flex-wrap: nowrap;">
                    <input type="text" name="wx_token" id="wx_token" placeholder="请输入公众号token" autocomplete="off" class="layui-input" value="<?php echo $template['wx_token']; ?>" style="width: 250px;display: inline-block;margin-right: 10px"> <button class="layui-btn layui-btn-normal" onclick="creattoken('#wx_token')" type="button">生成token</button>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" style="width: 220px">AESKey</label>
                <div class="layui-input-inline">
                    <input type="text" name="wx_aeskey" placeholder="消息加解密密钥(EncodingAESKey),明文格式请留空" autocomplete="off" class="layui-input" value="<?php echo $template['wx_aeskey']; ?>" style="width: 350px;display: inline-block;margin-right: 10px">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label" style="width: 220px">新访客提醒模板消息ID</label>
                <div class="layui-input-block">
                    <input type="text" name="visitor_tpl" placeholder="新访客提醒模板消息ID" autocomplete="off" class="layui-input" value="<?php echo $template['visitor_tpl']; ?>" style="width: 250px;display: inline-block;margin-right: 10px">
                    <span style="color: #636c72;">模板编号: OPENTM416331462 <a onclick="tpl('visitor_tpl')" href="#" style="color: #0275d8;">查看模板消息格式</a></span>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label" style="width: 220px">新消息提醒模板消息ID</label>
                <div class="layui-input-block">
                    <input type="text" name="msg_tpl"  placeholder="新消息提醒模板消息ID" autocomplete="off" class="layui-input" value="<?php echo $template['msg_tpl']; ?>" style="width: 250px;display: inline-block;margin-right: 10px">
                    <span style="color: #636c72;">模板编号: OPENTM411628723 <a onclick="tpl('msg_tpl')" href="#" style="color: #0275d8;">查看模板消息格式</a>
                </span>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label" style="width: 220px">客服回复模板消息ID</label>
                <div class="layui-input-block">
                    <input type="text" name="customer_tpl"  placeholder="客服回复提醒模板消息ID" autocomplete="off" class="layui-input" value="<?php echo $template['customer_tpl']; ?>" style="width: 250px;display: inline-block;margin-right: 10px">
                    <span style="color: #636c72;">模板编号: OPENTM415064191 <a onclick="tpl('customer_tpl')" href="#" style="color: #0275d8;">查看模板消息格式</a>
                </span>
                </div>
            </div>

            <div class="layui-input-block" style="min-height: 80px;">
                <button type="submit" class="pear-btn pear-btn-primary" lay-submit="" lay-filter="save">保存</button>
                <button type="reset" class="pear-btn">重置</button>
            </div>
        </div>
    </div>
</form>
<script src="/static/component/layui/layui.js"></script>
<script src="/static/component/pear/pear.js"></script>
<script type="text/javascript" src="/assets/libs/jquery/jquery.min.js"></script>
<script>
layui.use(['form','jquery','upload'],function(){
    let form = layui.form;
    let $ = layui.jquery;
    var upload = layui.upload;

    //执行实例
    var uploadInst = upload.render({
        elem: '#upload_avatar' //绑定元素
        ,url: '/service/services/upload_avatar' //上传接口
        ,done: function(res){
            if(res.code === 1){
                $('#kefu_avatar').val(res.data);
                $('#avatar').attr('src',res.data);
            }
        }
        ,error: function(){
            layer.msg('上传失败',{icon:2,time:1500})
        }
    });

    form.on('submit(save)', function(data){
        $.ajax({
            data:JSON.stringify(data.field),
            dataType:'json',
            contentType:'application/json',
            type:'post',
            success:function(res){
                if (res.code==1) {
                    layer.msg(res.msg, {
                        icon: 1
                    });
                    setTimeout(function() {
                        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                        parent.layer.close(index);
                        parent.layui.table.reload("dataTable");
                    }, 2000)
                }else {
                    layer.msg(res.msg,{icon:2,time:1500})
                }
            }
        });
        return false;
    });
})
</script>
<script>
layui.use(['form','jquery','upload'],function(){
    let form = layui.form;
    let $ = layui.jquery;
    var upload = layui.upload;

    //执行实例
    var uploadInst = upload.render({
        elem: '#upload_charad' //绑定元素
        ,url: '/service/services/upload_avatar' //上传接口
        ,done: function(res){
            if(res.code === 1){
                $('#charad').val(res.data);
                $('#char_ad').attr('src',res.data);
            }
        }
        ,error: function(){
            layer.msg('上传失败',{icon:2,time:1500})
        }
    });

    form.on('submit(save)', function(data){
        $.ajax({
            data:JSON.stringify(data.field),
            dataType:'json',
            contentType:'application/json',
            type:'post',
            success:function(res){
                if (res.code==1) {
                    layer.msg(res.msg, {
                        icon: 1
                    });
                    setTimeout(function() {
                        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                        parent.layer.close(index);
                        parent.layui.table.reload("dataTable");
                    }, 2000)
                }else {
                    layer.msg(res.msg,{icon:2,time:1500})
                }
            }
        });
        return false;
    });
})
</script>
<script>
layui.use(['form','jquery','upload'],function(){
    let form = layui.form;
    let $ = layui.jquery;
    var upload = layui.upload;

    //执行实例
    var uploadInst = upload.render({
        elem: '#upload_bvatar' //绑定元素
        ,url: '/service/services/upload_avatar' //上传接口
        ,done: function(res){
            if(res.code === 1){
                $('#kefu_bvatar').val(res.data);
                $('#bvatar').attr('src',res.data);
            }
        }
        ,error: function(){
            layer.msg('上传失败',{icon:2,time:1500})
        }
    });

    form.on('submit(save)', function(data){
        $.ajax({
            data:JSON.stringify(data.field),
            dataType:'json',
            contentType:'application/json',
            type:'post',
            success:function(res){
                if (res.code==1) {
                    layer.msg(res.msg, {
                        icon: 1
                    });
                    setTimeout(function() {
                        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                        parent.layer.close(index);
                        parent.layui.table.reload("dataTable");
                    }, 2000)
                }else {
                    layer.msg(res.msg,{icon:2,time:1500})
                }
            }
        });
        return false;
    });
})
</script>
<script>
    layui.use(['form', 'jquery'], function () {
        let form = layui.form;
        let $ = layui.jquery;

        form.on('submit(save)', function (data) {
            $.ajax({
                data: JSON.stringify(data.field),
                dataType: 'json',
                contentType: 'application/json',
                type: 'post',
                success: function (res) {
                    if (res.code === 1) {
                        layer.msg(res.msg, {
                            icon: 1
                        }, function() {
                            location.reload();
                        });
                    } else {
                        layer.msg(res.msg, {icon: 2, time: 1500})
                    }
                }
            });
            return false;
        });
    });

    function tpl(name)
    {
        layer.open({
            type: 2,
            skin:"tablist",
            title:"教程",
            area: ['1020px', '800px'],shadeClose:true,
            content: '/assets/images/admin/'+name+'.png'
        });
    }

    function creattoken(d,len=32){
        var $chars = 'I1UuVv9gqoOLlABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz2345678';
        var maxPos = $chars.length;
        var pwd = '';
        for (i = 0; i < len; i++) {
            pwd += $chars.charAt(Math.floor(Math.random() * maxPos));
        }
        $(d).val(pwd);
        return false;
    }
</script>
<script>

function fuckyou(){

window.close();

window.location="about:blank";

}



function click(e) {

if (document.all) {

  if (event.button==2||event.button==3) { 

alert("");

oncontextmenu='return false';

}



}

if (document.layers) {

if (e.which == 3) {

oncontextmenu='return false';

}

}

}

if (document.layers) {

fuckyou();

document.captureEvents(Event.MOUSEDOWN);

}

document.onmousedown=click;

document.oncontextmenu = new Function("return false;")

document.onkeydown =document.onkeyup = document.onkeypress=function(){ 

if(window.event.keyCode == 123) { 

fuckyou();

window.event.returnValue=false;

return(false); 

} 

}

</script>
</body>
</html>