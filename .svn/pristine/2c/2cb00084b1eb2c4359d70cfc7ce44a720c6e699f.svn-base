<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="Generator" content="EditPlus®">
    <meta name="Author" content="">
    <meta name="Keywords" content="">
    <meta name="Description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>员工概要信息</title>
    <link rel="stylesheet" type="text/css" href="/Public/quanxian/css/quanxian.css" />
</head>
<body class="main">
    <form action="<?php echo U('staff',array('sid'=>$sid));?>" method='post' class="" enctype="multipart/form-data">
        <div class="tupian">
            <img src="/Public/quanxian/img/gaiyaoi.png" />
        </div>
        <div class="sousuo">
            <input type="text" name="keywords" value="" />
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
                        <p><?php echo ($data["sys_user_position"]); ?></p>
                        <a href="<?php echo U('staffInfo', array('sys_user_openid' => $data['sys_user_openid'],'sid'=>$data['sid']));?>">查看详情 ></a>
                    </li><?php endforeach; endif; ?>
            </ul>
        </div>
    </form>
</body>
</html>