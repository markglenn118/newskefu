<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:91:"C:\Users\Administrator\Desktop\WWW\kefu\public/../application/backend\view\login\index.html";i:1714819760;}*/ ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>登录-多商户客服后台管理系统</title>
  <!-- 样 式 文 件 -->
  <link rel="stylesheet" href="/static/component/pear/css/pear.css" />
  <style>
    .layui-form {
      width: 320px !important;
      margin: auto !important;
      margin-top: 160px !important;
    }

    .layui-form button {
      width: 100% !important;
      height: 44px !important;
      line-height: 44px !important;
      font-size: 16px !important;
      background-color: #5FB878 !important;
      font-weight: 550 !important;
    }

    .layui-form-checked[lay-skin=primary] i {
      border-color: #5FB878 !important;
      background-color: #5FB878 !important;
      color: #fff !important;
    }

    .layui-tab-content {
      margin-top: 15px !important;
      padding-left: 0px !important;
      padding-right: 0px !important;
    }

    .layui-form-item {
      margin-top: 20px !important;
    }

    .layui-input {
      height: 44px !important;
      line-height: 44px !important;
      padding-left: 15px !important;
      border-radius: 3px !important;
    }

    .layui-input:focus {
      box-shadow: 0px 0px 2px 1px #5FB878 !important;
    }

    .layui-form-danger:focus{
      box-shadow: 0px 0px 2px 1px #f56c6c !important;
    }

    .logo {
      width: 60px !important;
      margin-top: 10px !important;
      margin-bottom: 10px !important;
      margin-left: 20px !important;
    }

    .title {
      font-size: 30px !important;
      font-weight: 550 !important;
      color: #5FB878 !important;
      display: inline-block !important;
      height: 60px !important;
      line-height: 60px !important;
      margin-top: 10px !important;
      text-align: center;
      width: 100%;
    }

    .desc {
      width: 100% !important;
      text-align: center !important;
      color: gray !important;
      height: 60px !important;
      line-height: 60px !important;
    }

    body {
      background-repeat:no-repeat;
      background-color: whitesmoke;
      background-size: 100%;
      height: 100%;
    }

    .code {
      float: left;
      margin-right: 13px;
      margin: 0px !important;
      border: #e6e6e6 1px solid;
      display: inline-block!important;
    }

    .codeImage {
      float: right;
      height: 42px;
      border: #e6e6e6 1px solid;
      width: 113px;
    }

  </style>
</head>
<!-- 代 码 结 构 -->
<body background="/static/admin/images/background.svg" style="background-size: cover;">
<form class="layui-form" action="javascript:void(0);">
  <div class="layui-form-item">
    <div class="title">Admin Login</div>
    <div class="desc">
      多 商 户 客 服 后 台 管 理 系 统
    </div>
  </div>
  <div class="layui-form-item">
    <input placeholder="请输入用户名" lay-verify="required" type="text" class="layui-input" name="username" autocomplete="off" />
  </div>
  <div class="layui-form-item">
    <input placeholder="请输入密码" lay-verify="required" type="password" class="layui-input" name="password" autocomplete="off" />
  </div>
  <div class="layui-form-item">
    <input placeholder="请输入验证码"  lay-verify="required" type="text" class="code layui-input layui-input-inline" name="captcha" autocomplete="off"/>
    <img src="<?php echo url('captcha'); ?>" class="codeImage" id="codeimg"/>
  </div>
  <div class="layui-form-item">
    <button type="button" class="pear-btn pear-btn-success login" lay-submit lay-filter="login">
      登 入
    </button>
  </div>
</form>
<script src="/static/component/layui/layui.js"></script>
<script src="/static/component/pear/pear.js"></script>
<script>
    layui.use(['form', 'layer', 'jquery'], function () {
        var $ = layui.jquery
            , layer = layui.layer
            , form = layui.form;
        // 登 录 提 交
        form.on('submit(login)', function(data) {
            layer.load();
            $.ajax({
                type: "POST",
                data: data.field,
                url: "/backend/login/check",
                success: function (res) {
                    layer.closeAll('loading');
                    if (res.code==1){
                        layer.msg(res.msg,{icon:1,time:1000},function () {
                            location.href = res.url;
                        })
                    } else {
                        layer.msg(res.msg,{icon:2,time:1000},function () {
                            initCode();
                        })
                    }
                }
            });
            return false;
        });
        initCode();
        function initCode() {
            $('#codeimg').attr("src","<?php echo url('captcha'); ?>?r=" + new Date().getTime());
        }
        $('#codeimg').on('click', function () {
            initCode();
        });
    })
</script>
</body>
</html>
