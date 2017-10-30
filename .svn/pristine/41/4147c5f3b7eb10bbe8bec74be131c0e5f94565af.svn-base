<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" name="viewport">
    <!-- ios下删除默认的苹果工具栏和菜单栏 -->
    <meta content="yes" name="apple-mobile-web-app-capable">
    <!-- ios下控制状态栏显示样式，黑色 -->
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <!-- 电话号码非默认识别 -->
    <meta content="telephone=no" name="format-detection">
    <link rel="stylesheet" type="text/css" href="/Public/css/getNumber.css">
    <link rel="stylesheet" type="text/css" href="/Public/commonLib/css/common/reset.css">
    <!-- @media css -->
    <link rel="stylesheet" type="text/css" href="/Public/commonLib/css/common/media.css">
    <title>排队取号</title>
</head>

<body>
    <!-- 父容器 -->
    <div class="container">
        <!-- 表单提示 -->
        <div id="prompt">
            <span>欢迎使用排队取号系统</span>
        </div>
        <!-- 餐桌取号容器 -->
        <form method="post" action="<?php echo U("/Admin/Index/proveStartTime");?>">
        	<input type="hidden" name="sid" value="<?php echo ($sid); ?>"/>
            <div id="getContainer">
                <div class="get_people">
                    <span>用餐人数：</span>
                    <input id="get_people" type="number" name="people" placeholder="请输入用餐人数" value=""></input>
                </div>
                <div class="get_phone">
                    <span>联系电话：</span>
                    <input id="get_phone" type="number" name="tel" placeholder="请输入联系方式" value=""></input>
                </div>
            </div>
            <!-- 信息容器 -->
            <div id="msgContainer">
                <div class="msg_msg">
                    <p>听到叫号请到迎宾台，过号作废，重新取号。</p>
                    <p>等待桌数为3桌时，微信平台进行通知，请注意查看。</p>
                </div>
                <div class="msg_phone">
                    <img src="/Public/commonLib/images/phone.png">
                    <span><?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; echo ($vo['telephone']); endforeach; endif; else: echo "" ;endif; ?></span>
                </div>
                <div class="msg_add">
                    <img src="/Public/commonLib/images/add.png">
                    <span><?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; echo ($vo['province']); echo ($vo['city']); echo ($vo['district']); echo ($vo['address']); endforeach; endif; else: echo "" ;endif; ?></span>
                </div>
            </div>
            <div id="submitContainer">
                <button id="button" type="button">确认提交</button>
            </div>
        </form>
    </div>
    <!-- 外部库引用 -->
    <script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/1.9.0/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/js/getNumber.js"></script>
</body>

</html>