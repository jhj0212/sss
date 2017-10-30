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
    <link rel="stylesheet" type="text/css" href="/Public/css/orderConfirm.css">
    <link rel="stylesheet" type="text/css" href="/Public/commonLib/css/common/reset.css">
    <!-- @media css -->
    <link rel="stylesheet" type="text/css" href="/Public/commonLib/css/common/media.css">
    <title>预约确定</title>
</head>

<body>
    <!-- 父容器 -->
    <div class="container">
        <!-- 验证信息 -->
        <h3 id="reContent"></h3>
        <!-- 头部图片宣传 -->
        <div id="imgContainer">
            <div class="img_textContainer">
                <span class="img_text_big">美食</span>
                <span class="img_text_small">·海量美食应有尽有</span>
            </div>
        </div>
        
        <!-- 表单提交 -->
        <form id="formContainer" name="fm" method="post" action="<?php echo U('orderSuccess');?>">
            <input type="text" name="sid" id="sid" value="<?php echo ($sid); ?>"/>
            <input type="text" name="openid" id="openid" value="<?php echo ($openid); ?>"/>
            <!-- 表单信息->表单信息栏*4 -->
            <!-- 表单提交->时间和桌数 -->
            <div class="form_msgContainer">
                <h3 class="Day_title">选择时间：</h3>
                <!-- 选择具体天数->死链radio->传递给后台value -->
                <div class="Day_order">
                     <?php if(is_array($tomorrow)): $i = 0; $__LIST__ = $tomorrow;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><span><?php echo ($vo); ?></span><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <!-- 可选桌位 -->
                <div class="form_tableMsg">
                    <div class="tableMsg_msg">
                        <span>可选座位：</span>
                    </div>
                    <div class="tableMsg_number">
                    	<p class='zhuoTrue'>请先选择日期</p>
                        <p>仅剩<span id='zhuo'></span>桌</p>
                    </div>
                </div>
                <!-- 桌位号码 -->
                <div class="form_tableNumber">
                    <div class="tableNumber_msg">
                        <span>桌位号码：</span>
                    </div>
                    <div class="tableNumber_choose">                    
                    </div>
                </div>
            </div>
            <!-- 表单提交->时间 -->
            <!-- 订座具体时间容器/死链radio->直接传后台value -->
            <div class="form_msgContainer">
                <div id="TimeContainer">
                   <!--  <div class="time_radio_container">
                        <span class="disabled" id="order_time"></span>
                        <input type="radio" disabled name="time" value=""></input>
                    </div>
                    -->
                </div>
            </div>
            <!-- 表单提交->姓名手机号 -->
            <div class="form_msgContainer">
                <div class="form_name">
                    <div id="nm" class="name_msg" >
                        <span>姓名：</span>
                    </div>
                    <div class="name_container">
                        <div class="name_input">
                            <input type="text" disabled name="nickName" placeholder="请输入姓名"></input>
                        </div>
                        <div class="name_sex" id="sex">
                            <div class="name_sex_content">
                                <div class="name_radio_type">
                                    <label class="name_radio_type_hack"></label>
                                    <input type="radio" disabled name="sex" value="0"></input>
                                </div>
                                <label>先生</label>
                            </div>
                            <div class="name_sex_content">
                                <div class="name_radio_type">
                                    <label class="name_radio_type_hack"></label>
                                    <input type="radio" disabled name="sex" value="1"></input>
                                </div>
                                <label>女士</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form_phone">
                    <div class="phone_msg">
                        <span>手机：</span>
                    </div>
                    <div class="phone_input">
                        <input id="phone" type="number" maxlength="11" disabled name="phone" placeholder="请输入手机号"/>
                    </div>
                </div>
            </div>
            <!-- 表单提交->备注 -->
            <div class="form_msgContainer">
                <div class="form_remark">
                    <div class="remark_msg">
                        <span>备注：</span>
                    </div>
                    <div class="remark_textarea">
                        <textarea id="remark" name="remark" disabled placeholder="请输入您的要求，我们会尽量安排"></textarea>
                    </div>
                </div>
            </div>
            <!-- 表单提交 -->
            <div id="btnHack"></div>
            <div id="submitBtn">
                <button type="button">立即预约</button>
            </div>
        </form>
    </div>
    <!-- 外部库引用 -->
    <script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/1.9.0/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/quanxian/js/orderConfirm.js"></script>
</body>

</html>