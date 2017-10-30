<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="Generator" content="EditPlus®">
    <meta name="Author" content="">
    <meta name="Keywords" content="">
    <meta name="Description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>员工信息</title>
    <link rel="stylesheet" type="text/css" href="/Public/quanxian/css/yuangong.css" />
    <script type="text/javascript" src="/Public/quanxian/js/jquery.js"></script>
    <script type="text/javascript" src="/Public/quanxian/js/moment.js"></script>
    <script type="text/javascript" src="/Public/quanxian/js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // date time picker
            if($(".iDate.full").length > 0) {
                $(".iDate.full").datetimepicker({
                    locale: "zh-cn",
                    format: "YYYY-MM-DD HH:mm:ss",
                    dayViewHeaderFormat: "YYYY年 MMMM"
                });
            }
        })
    </script>
</head>
<body class="main">
<!-- 验证信息 -->
<h3 id="reContent"></h3>
<form action="<?php echo U('Admin/changeStaff');?>" method='post' class="" enctype="multipart/form-data">
    <input type="hidden" name="sys_user_openid" value="<?php echo ($data["sys_user_openid"]); ?>">
    <input type="hidden" name="sid" value="<?php echo ($data["sid"]); ?>">
    <img src="<?php echo ($data["sys_user_headimgurl"]); ?>" />
    <h1><?php echo ($data["sys_user_name"]); ?></h1>
    <div class="xinxi">
        <ul>
            <li>
                <span>微信昵称：</span>
                <input type="text" class=" " name="sys_nickname" value="<?php echo ($data["sys_nickname"]); ?>" disabled/>
            </li>
            <li>
                <span>手机号码：</span>
                <input type="text" class=" " name="sys_phone_number" value="<?php echo ($data["sys_phone_number"]); ?>" disabled/>
            </li>
            <li>
                <span>职位：</span>
                <!--<input type="text" class=" " name="sys_phone_number" value="<?php echo ($data["sys_user_position"]); ?>" disabled/>-->
                <select name="sys_user_position" style="width: 180px;">
                    <?php if(is_array($li)): foreach($li as $key=>$li): ?><option value="<?php echo ($li["sys_user_level"]); ?>"
                        <?php if($li[sys_user_level] == $data[sys_user_level]): ?>selected="selected"<?php endif; ?>
                        ><?php echo ($li["sys_user_levelname"]); ?>
                        </option><?php endforeach; endif; ?>
                </select>
            </li>
            <li>
                <span>入职时间 :</span>
                <div class="iDate full">
                    <input type="text" name="sys_attention_time" value="<?php echo ($data["sys_attention_time"]); ?>" disabled/>
                </div>
            </li>
        </ul>
    </div>
    <div class="tijiao" >
        <div class="bu">
            <button type="submit">提交</button>
        </div>
    </div>
</form>
</body>
</html>