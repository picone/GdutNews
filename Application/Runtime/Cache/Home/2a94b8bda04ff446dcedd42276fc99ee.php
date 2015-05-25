<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>广东工业大学新闻通知网</title>
    <meta http-equiv="Content-type" content="text/html;charset=utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link rel="stylesheet" type="text/css" href="/GdutNews/Public/icons.min.css" />
    <link rel="stylesheet" type="text/css" href="/GdutNews/Public/af.ui.base.css" />
    <script type="text/javascript" charset="utf-8" src="/GdutNews/Public/jquery-2.1.3.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="/GdutNews/Public/appframework.ui.min.js"></script>
</head>
<body>
<div id="splashscreen" class='ui-loader heavy'>广东工业大学<br/>新闻通知网<br/><br/><span class='ui-icon ui-icon-loading spin'></span><h1>正在加载...</h1></div>
<div class="view" id="mainview">
    <header><h1>新闻通知网</h1><a class="menuButton" data-transition="cover" data-left-menu="#leftMenu"></a><a class="icon magnifier" style="position:relative;top:13px;float:right;"></a></header>
    <div class="pages">
        <div class="panel" title="新闻通知网" data-selected="true">
            <ul class="list">
                <li class="divider" style="padding-right:0;"></li>
                    <li><a href="javascript:t(4,0,1,false)"><?php echo $category[4]['data'][0]['name'];?></a></li>
                <?php if(empty($notice)){?>
                    <li>今天还没有新通知</li>
                <?php }else{foreach($notice as &$v){?>
                    <li><a href="javascript:p(<?php echo $v['articleid'];?>)"><?php echo $v['title'];?></a></li>
                <?php }}?>
                <li class="divider" style="padding-right:0;"></li>
                    <li><a href="javascript:t(5,0,1,false)"><?php echo $category[5]['data'][0]['name'];?></a></li>
                <?php if(empty($notice)){?>
                <li>今天还没有新公告</li>
                <?php }else{foreach($announce as &$v){?>
                    <li><a href="javascript:p(<?php echo $v['articleid'];?>)"><?php echo $v['title'];?></a></li>
                <?php }}?>
                <li class="divider" style="padding-right:0;"></li>
                    <li><a href="javascript:t(6,0,1,false)"><?php echo $category[6]['data'][0]['name'];?></a></li>
                <?php if(empty($notice)){?>
                <li>今天还没有新简讯</li>
                <?php }else{foreach($note as &$v){?>
                    <li><a href="javascript:p(<?php echo $v['articleid'];?>)"><?php echo $v['title'];?></a></li>
                <?php }}?>
            </ul>
            <p align="center">©2015 广东工业大学 All Rights Reserved.</p>
        </div>
        <div class="panel" id="passage"></div>
        <div class="panel" id="list"><div id="main_page"></div><div id="next_page"><ul class="button block" onclick="n()">加载更多...</div></div>
    </div>
    <nav id="leftMenu">
        <div class="view active">
            <header id="menuHeader"><h1>导航栏</h1><a class="icon close" style="position:relative;top:13px;right:8px;float:right;" data-menu-close></a></header>
            <div class="pages">
                <div class="panel active">
                    <ul class="list"><li class="divider">新闻通知网</li><li><a href="#main" data-menu-close>主页</a></li>
                        <?php foreach($category as $k=>&$v){ echo '<li class="divider">',$v['name'],'</li>'; foreach($v['data'] as &$v2){ echo '<li><a href="javascript:t(',$k,',',$v2['id'],',1,0)" data-menu-close>',$v2['name'],'</a></li>'; } }?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>
</body>
</html>