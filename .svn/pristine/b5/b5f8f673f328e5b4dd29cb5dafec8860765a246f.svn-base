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
    <link rel="stylesheet" type="text/css" href="/Public/css/memberCenter.css">
    <link rel="stylesheet" type="text/css" href="/Public/commonLib/css/common/reset.css">
    <!-- @media css -->
    <link rel="stylesheet" type="text/css" href="/Public/commonLib/css/common/media.css">
    <title>会员中心</title>
</head>

<body>
    <!-- 父容器 -->
    <div class="container">
        <!-- 头部->容器->内含会员卡、会员基本信息：积分、会员等级、余额 -->
        <!-- 需加载信息：会员卡卡号，积分，会员等级，余额并显示 -->
        <div id="headerContainer">
            <!-- 头部->会员卡 -->
            <div class="head_img_container">
                <img src="/Public/images/memberCenter/card.png" alt="会员卡">
                <p>NO.<span class="cardNumber"><?php echo ($result['0']['user_card_code']); ?></span></p>
            </div>
            <!-- 头部->会员基本信息容器 -->
            <div class="head_msg_container">
                <!-- 积分 -->
                <div class="msg_exp">
                    <span>积分</span>
                    <span>10</span>
                </div>
                <!-- 会员等级 -->
                <div class="msg_grade">
                    <span>会员等级</span>
                    <span>普通会员</span>
                </div>
                <!-- 余额 -->
                <div class="msg_money">
                    <span>余额</span>
                    <span>100</span>
                </div>
            </div>
        </div>
        <!-- 签到容器 -->
        <div id="signContainer">
            <span class="sign_msg">每日签到,爽拿积分</span>
            <a href="<?php echo U('admin/create/sign');?>" class="sign_btn">签</a>
        </div>
        <!-- 下方3行3列导航容器->分上中下三行处理->跳转链接，无需获取数据 -->
        <!-- 图片命名方式采用横向索引方式 -->
        <div id="navContainer">
            <!-- 第一行 -->
            <div class="nav_top">
                <a href="<?php echo U('admin/create/memberPrivilege');?>">
                    <div>
                        <img src="/Public/images/memberCenter/t2.png">
                        <span>会员特权</span>
                    </div>
                </a>
                <a href="<?php echo U('admin/create/exchangeShop');?>">
                    <div>
                        <img src="/Public/images/memberCenter/t3.png">
                        <span>兑换商城</span>
                    </div>
                </a>
            </div>
            <!-- 第二行 -->
            <div class="nav_mid">
                <a href="/Public/html/rechange.html">
                    <div>
                        <img src="/Public/images/memberCenter/m3.png">
                        <span>立即充值</span>
                    </div>
                </a>
                <a href="<?php echo U('admin/create/payExchange');?>">
                    <div>
                        <img src="/Public/images/memberCenter/b2.png">
                        <span>消费详情</span>
                    </div>
                </a>
            </div>
            <!-- 第三行 -->
            <div class="nav_bottom">
                <a href="<?php echo U('admin/create/applyShop');?>">
                    <div>
                        <img src="/Public/images/memberCenter/b1.png">
                        <span>适用门店</span>
                    </div>
                </a>
                <a href="/Public/html/coupon.html">
                    <div>
                        <img src="/Public/images/memberCenter/b3.png">
                        <span>优惠卡券</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- 外部库引用 -->
    <script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/1.9.0/jquery.min.js"></script>
</body>

</html>