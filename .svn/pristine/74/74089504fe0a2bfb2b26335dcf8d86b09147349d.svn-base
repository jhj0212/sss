<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" name="viewport">
    <!-- ios下删除默认的苹果工具栏和菜单栏 -->
    <meta content="yes" name="apple-mobile-web-app-capable">
    <!-- ios下控制状态栏显示样式，黑色 -->
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <!-- 电话号码非默认识别 -->
    <meta content="telephone=no" name="format-detection">
    <title></title>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
</head>
<body>
    <script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/1.9.0/jquery.min.js"></script>
    <script>
        // 注意：所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。
        // 如果发现在 Android 不能分享自定义内容，请到官网下载最新的包覆盖安装，Android 自定义分享接口需升级至 6.0.2.58 版本及以上。
        // 完整 JS-SDK 文档地址：<a rel="nofollow" href="http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html" target="_blank">http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html</a>

        wx.config({
            debug: true,
            appId:  '<?php echo ($wx_config["appId"]); ?>',
            timestamp: '<?php echo ($wx_config["timestamp"]); ?>',
            nonceStr: '<?php echo ($wx_config["nonceStr"]); ?>',
            signature: '<?php echo ($wx_config["signature"]); ?>',
            jsApiList:
            // 所有要调用的 API 都要加到这个列表中
                ['scanQRCode']
        });
        wx.ready(function () {
            // 在这里调用 API
            wx.checkJsApi({
                jsApiList: ['chooseImage'], // 需要检测的JS接口列表，所有JS接口列表见附录2,
                success: function(res) {
                    //alert(res.errMsg);
                    // 以键值对的形式返回，可用的api值true，不可用为false
                    // {"checkResult":{"chooseImage":true},"errMsg":"checkJsApi:ok"}
                }
            });
            wx.scanQRCode({
                needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
                scanType: ["qrCode","barCode"], // 可以指定扫二维码还是一维码，默认二者都有
                success: function (res) {
                    var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
                    alert(result);
                    var obj = JSON.stringify(result);
                    alert(obj);
                }

            })
        });
    </script>
</body>
</html>