<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="Generator" content="EditPlus®">
    <meta name="Author" content="">
    <meta name="Keywords" content="">
    <meta name="Description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="stylesheet" type="text/css" href="/Public/quanxian/css/yuangong.css" />-->
    <link rel="stylesheet" type="text/css" href="/Public/quanxian/css/tianjia.css" />
    <script type="text/javascript" src="/Public/quanxian/js/jquery.js"></script>
    <title>餐位信息</title>

</head>
<body class="main">
<form action="<?php echo U('Admin/editSeat');?>" method='post' class="" enctype="multipart/form-data">
    <input type="hidden" name="sid" id="sid" value="<?php echo ($sid); ?>"/>
    <input type="hidden" name="id" id="id" value="<?php echo ($id); ?>"/>
    <input type="hidden" name="table_id" id="table_id" value="<?php echo ($data["table_id"]); ?>"/>
    <input type="hidden" name="state" id="state" value="<?php echo ($data["state"]); ?>"/>
    <input type="hidden" name="level" id="level" value="<?php echo ($level); ?>"/>
    <input type="text" name="openid" id="openid" value="<?php echo ($openid); ?>"/>
    <div class="tupian">
        <img src="/Public/quanxian/img/tianjia.png" />
        <h3 id="reContent"><?php echo ($data["table_id"]); ?>号桌</h3>
    </div>
    <div class="liebiao">
        <ul>
            <li>
                <p>餐位名称：</p>
                <input type="text" class=" " name="table_name" value="<?php echo ($data["table_name"]); ?>"
                    <?php if($level != 1): ?>disabled<?php endif; ?>
                />
            </li>
            <li>
                <p>容纳人数：</p>

                <input type="text" class=" " name="person_count" value="<?php echo ($data["person_count"]); ?>"
                    <?php if($level != 1): ?>disabled<?php endif; ?>
                />
            </li>
            <li>
                <p>餐位类型：</p>
                <?php if($level == 1): ?><select name="table_type">
                        <option value="1" <?php if($data["table_type"] == 1): ?>selected="selected"<?php endif; ?>>2人桌</option>
                        <option value="2" <?php if($data["table_type"] == 2): ?>selected="selected"<?php endif; ?>>4人桌</option>
                        <option value="3" <?php if($data["table_type"] == 3): ?>selected="selected"<?php endif; ?>>6人桌</option>
                        <option value="4" <?php if($data["table_type"] == 4): ?>selected="selected"<?php endif; ?>>8人桌</option>
                        <option value="0" <?php if($data["table_type"] == 0): ?>selected="selected"<?php endif; ?>>包房</option>
                    </select><?php endif; ?>
                <?php if($level != 1): if($data["table_type"] == 0): ?><input type="text" class=" " name="table_type" value="包房" disabled/><?php endif; ?>
                    <?php if($data["table_type"] == 1): ?><input type="text" class=" " name="table_type" value="2人桌" disabled/><?php endif; ?>
                    <?php if($data["table_type"] == 2): ?><input type="text" class=" " name="table_type" value="4人桌" disabled/><?php endif; ?>
                    <?php if($data["table_type"] == 3): ?><input type="text" class=" " name="table_type" value="6人桌" disabled/><?php endif; ?>
                    <?php if($data["table_type"] == 4): ?><input type="text" class=" " name="table_type" value="8人桌" disabled/><?php endif; endif; ?>
            </li>
            <li>
                <p>是否提供预订:</p>
                <?php if($level == 1): ?><select name="is_order">
                        <option value="1" <?php if($data["is_order"] == 1): ?>selected="selected"<?php endif; ?>>是</option>
                        <option value="0" <?php if($data["is_order"] == 0): ?>selected="selected"<?php endif; ?>>否</option>
                    </select><?php endif; ?>
                <?php if($level != 1): if($data["is_order"] == 1): ?><input type="text" class=" " name="is_order" value="是" disabled/><?php endif; ?>
                    <?php if($data["is_order"] == 0): ?><input type="text" class=" " name="is_order" value="否" disabled/><?php endif; endif; ?>
            </li>
        </ul>
    </div>
    <?php if($level == 1): ?><div class="tijiao">
            <button class="" type="submit" id="submitBtn"> 提交</button>
        </div><?php endif; ?>
</form>
</body>
</html>