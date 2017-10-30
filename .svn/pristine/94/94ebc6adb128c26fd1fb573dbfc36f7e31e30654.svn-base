<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="Generator" content="EditPlus®">
    <meta name="Author" content="">
    <meta name="Keywords" content="">
    <meta name="Description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>添加人员</title>
    <link rel="stylesheet" type="text/css" href="/Public/quanxian/css/quanxian.css" />
</head>
<body class="main">
<form action="<?php echo U('addStaff',array('sid'=>$sid));?>" method='post' class="" enctype="multipart/form-data">
    <div class="tupian">
        <img src="/Public/quanxian/img/gaiyaoi.png"/>
    </div>
    <div class="sousuo">
        <input type="text" name="sys_nickname" value="" placeholder="请输入搜索微信名"/>
        <button>
            <img src="/Public/quanxian/img/fangda.png"/>
        </button>
    </div>
    <div class="liebiao">
        <ul>
            <?php if(is_array($person)): foreach($person as $key=>$data): ?><li>
                    <div class="txxm">
                        <img src="/Public/quanxian/img/toux.png" class="ws1"/>
                        <p><?php echo ($data["sys_user_name"]); ?></p>
                    </div>
                    <p>
                        <?php echo ($data["sys_user_position"]); ?>
                        <?php if($data["sys_user_position"] == null): ?>系统用户<?php endif; ?>
                    </p>
                    <a href="<?php echo U('changeStaff', array('sys_user_openid' => $data['sys_user_openid'],'sid'=>$data['sid']));?>">设置身份 ></a>
                </li><?php endforeach; endif; ?>
        </ul>
    </div>
</form>
</body>
</html>