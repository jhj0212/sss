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
    <link rel="stylesheet" type="text/css" href="/Public/css/orderIndex.css">
    <link rel="stylesheet" type="text/css" href="/Public/commonLib/css/common/reset.css">
    <!-- @media css -->
    <link rel="stylesheet" type="text/css" href="/Public/commonLib/css/common/media.css">
    <title>电话预约</title>
</head>

<body>
    <!-- 父容器 -->
    <div class="container">
        <!-- 头部虚化背景容器 -->
        <div id="daskHeaderImg">
            <img src="/Public/images/orderIndex/order_bg.jpg">
            <h3>Hello,Client!</h3>
            <h4>吃货不是在吃，就是在吃的路上</h4>
        </div>
        <!-- 表单包裹容器->订座 -->
        <form  id="form" name="form" method="post" action="<?php echo U('orderConfirm');?>">
            <input type="hidden" name="sid" value="<?php echo ($sid); ?>"/>
            <input type="hidden" name="openid" value="<?php echo ($openid); ?>"/>
            <!-- 订座头部及天数 -->
            <div id="DayContainer">
                <div class="Day_header">
                    <div class="Day_header_left">
                        <img src="/Public/images/orderIndex/right.png">
                        <span>预约订座</span>
                    </div>
                    <div class="Day_header_right">
                        <span>免排队，到店即就餐</span>
                    </div>
                </div>
                <!-- 选择人数 -->
                <div id="peopleNumber">
                    <input class="peopleNumber" type="text" name="peopleNumber" placeholder="请填写预约人数(数字)">人
                </div>
                <div id="maskRe">
                    <h3>请输入正确的人数！</h3>
                </div>
            </div>
            
            <div id="submitHack"></div>
            <div id="submitContainer">
        
             <button class="submitBtn" type="button" >立即订座</button>
            </div>
        </form>
    </div>

    
    <!-- 外部库引用 -->
    <script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/1.9.0/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/js/orderIndex.js"></script>
</body>

</html>