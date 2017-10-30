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
    <link rel="stylesheet" type="text/css" href="/Public/css/numberFoods.css">
    <link rel="stylesheet" type="text/css" href="/Public/commonLib/css/common/reset.css">
    <!-- @media css -->
    <link rel="stylesheet" type="text/css" href="/Public/commonLib/css/common/media.css">
    <title>菜单预览</title>
</head>

<body>
    <!-- 父容器 -->
    <div class="container">
        <!-- 图片容器 -->
        <div id="imgContainer">
        	<a href="numberSuccess.html">返回</a>
        </div>
        <!-- 菜单列表 双栏布局-->
        <!-- 左侧选择列表->tab切换 -->
        <ul id="foodsNav">
        	<?php if(is_array($type_result)): $i = 0; $__LIST__ = $type_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$c): $mod = ($i % 2 );++$i;?><li class="active"><?php echo ($c['menu_type']); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <!-- 右侧菜单列表->tab切换 -->
		
        <div id="foodsListContainer">
		<?php if(is_array($type_result)): $i = 0; $__LIST__ = $type_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($i++ == 1): ?><ul class="foodsList "><?php else: ?> <ul class="foodsList offList"><?php endif; ?>
           
                <!-- 单一菜品 -->           
				<?php if(is_array($menu_info)): $i = 0; $__LIST__ = $menu_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$f): $mod = ($i % 2 );++$i; if($vo['menu_type'] == $f['menu_type']): ?><li>
                    <img class="foods_img" src="/Public/images/numberFoods/<?php echo ($f['menu_pag_url']); ?>">
                    <div class="foods_msg">
                        <span class="foods_title"><?php echo ($f['menu_name']); ?></span>
                        <p class="foods_money"><span>￥</span><?php echo ($f['unit_price']); ?></p>
                    </div>
                </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
				  <!-- 单一菜品end -->
            </ul><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
    <!-- 外部库引用 -->
    <script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/1.9.0/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/js/numberFoods.js"></script>
</body>
</body>

</html>