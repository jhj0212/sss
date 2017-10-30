<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="Generator" content="EditPlus®">
    <meta name="Author" content="">
    <meta name="Keywords" content="">
    <meta name="Description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/Public/quanxian/css/quanxian.css">
    <script type="text/javascript" src="/Public/quanxian/js/jquery.js"></script>
    <title>权限分配</title>
</head>
<body class="main">
<form action="<?php echo U('admin',array('sid'=>$sid));?>" method='post' class="" enctype="multipart/form-data">
    <div class="tupian">
        <img src="/Public/quanxian/img/quan1.png" />
    </div>
    <input type="hidden" name="sid" value="<?php echo ($sid); ?>" />
    <div class="sousuo">
        <input type="text" name="keywords" value="" placeholder="请输入搜索信息"/>
        <button>
            <img src="/Public/quanxian/img/fangda.png"/>
        </button>
    </div>
    <div class="liebiao">
        <ul>
            <?php if(is_array($person)): foreach($person as $key=>$data): ?><li>
                    <div class="txxm">
                    <img src="<?php echo ($data["sys_user_headimgurl"]); ?>" class="ws1"/>
                    <p><?php echo ($data["sys_user_name"]); ?></p>
                    </div>
                    <p><?php echo ($data["sys_user_position"]); ?></p>
                    <div class="tubiao">
                        <a href="<?php echo U('delete', array('sys_user_openid' => $data['sys_user_openid'],'sid'=>$data['sid']));?>" onclick="return confirm('确定要删除吗？');"><img src="/Public/quanxian/img/shanchu.png"/></a>
                        <a href="<?php echo U('editAdmin', array('sys_user_openid' => $data['sys_user_openid'],'sid'=>$data['sid']));?>"><img src="/Public/quanxian/img/xiugai.png"/></a>
                    </div>
                </li><?php endforeach; endif; ?>
        </ul>
    </div>
</form>
<script>
    /*$(function(){
        pushHistory();
        window.addEventListener("popstate", function(e) {
            alert("我监听到了浏览器的返回按钮事件啦");//根据自己的需求实现自己的功能
        }, false);
        function pushHistory() {
            var state = {
                title: "title",
                url: "#"
            };
            window.history.pushState(state, "title", "#");
        }

    });*/
</script>
</body>
</html>