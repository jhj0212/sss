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
    <link rel="stylesheet" type="text/css" href="/Public/css/numberCancel.css">
    <link rel="stylesheet" type="text/css" href="/Public/commonLib/css/common/reset.css">
    <!-- @media css -->
    <link rel="stylesheet" type="text/css" href="/Public/commonLib/css/common/media.css">
    <title>取消预约</title>
</head>

<body>
    <!-- 父容器 -->
    <div class="container">
        <!-- 表单包裹容器 -->
        <div id="QR">
            <img src="/Public/images/orderCancel/qr.jpg">
        </div>
        <div id="btnContainer">
        	<a href="<?php echo U("/Admin/Index/numberSuccess");?>">
            	<button type="button" class="cancel"></button>
            </a>
            
            <!-- 跳转到地图页面 -->
	        <a href="<?php echo U("/Admin/Index/map",array('queue_id'=>$queue_id,'res'=>'麦当劳'));?>">
	            <button type="button" class="confirm"></button>
	        </a>
         
        </div>
    </div>
    <!-- 外部库引用 -->
    <script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/1.9.0/jquery.min.js"></script>
    <!-- <SCRIPT type="text/javascript">
    ;function(){
    	var cancel = $("cancel"),
    		confirm = $("confirm");
    	var cancelUrl = "<?php echo U("/Admin/Index/numberSuccess");?>",
    		confirmUrl = "<?php echo U("/Admin/Index/Map");?>";
    	function onHref(id,url){
    		id.on("click",function{
    			window.location.href = url;
    		})
    	}
    	onHref(cancel,cancelUrl);
    	//onHref(confirm,confirmUrl);
    }
    </SCRIPT> -->
</body>

</html>