<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>广东工业大学新闻通知网</title>
    <meta http-equiv="Content-type" content="text/html;charset=utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link rel="stylesheet" type="text/css" href="/GdutNews/Public/af.ui.base.css" />
    <script type="text/javascript" charset="utf-8" src="/GdutNews/Public/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="/GdutNews/Public/appframework.ui.min.js"></script>
    <?php if(isset($output)){?><script type="text/javascript">$.afui.ready(function(){$.afui.toast({message:'<?php echo $output;?>',position:'tc',type:'error'});});</script><?php }?>
</head>
<body>
<div id="splashscreen" class='ui-loader heavy'>广东工业大学<br/>新闻通知网<br/><br/><span class='ui-icon ui-icon-loading spin'></span><h1>正在加载...</h1></div>
<div class="view" id="MainView">
    <header><h1>新闻通知网</h1></header>
    <div class="pages">
        <div class="panel" id="login" data-selected="true">
            <div class="card" style="margin-top:15px;">
                <h1 style="text-align:center;">登录</h1>
                <form method="POST" action="<?php echo U('Login/login');?>"><div class="input-group">
                    <input name="un" type="text" placeholder="用户名"/>
                    <input name="passwd" type="password" placeholder="密码"/>
                </div><div>
                    <input id="remember" type="checkbox" name="remember" value="1"><label for="remember">记住我</label><input type="submit" class="button" value="登录"/>
                </div></form>
            </div>
            <div style="text-align:center;"><a href="#lost">首次登陆&nbsp;|&nbsp;找回密码</a></div>
        </div>
        <div class="panel" id="lost">
            <div class="card">
                <h1 style="text-align:center;">发送密码到邮件</h1>
                <div class="input-group">
                    <input type="text" placeholder="您的邮箱地址">
                    <input type="text" placeholder="您的姓名">
                    <input type="text" placeholder="验证码">
                    <input type="submit" class="button" value="找回密码"/>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>