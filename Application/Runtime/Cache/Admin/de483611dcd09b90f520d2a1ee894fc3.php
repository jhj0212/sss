<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="initial-scale=1, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0, width=device-width">
    <meta name="screen-orientation" content="portrait">
    <title>进击的玉兔</title>
    <link rel="stylesheet" type="text/css" href="/Public/quanxian/css/game.css">
    <script src="http://apps.bdimg.com/libs/zepto/1.1.4/zepto.min.js"></script>
</head>

<body>
    <div id="container">
        <div id="guidePanel"></div>
        <div id="gamepanel">
            <div class="score-wrap">
                <div class="heart"></div>
                <span id="score">0</span>
            </div>
            <canvas id="stage" width="320" height="568"></canvas>
        </div>
        <div id="gameoverPanel"></div>
        <div id="resultPanel">
            <div class="weixin-share"></div>
            <a href="javascript:void(0)" class="replay"></a>
            <div id="fenghao"></div>
            <div id="scorecontent">
                您在<span id="stime" class="lighttext">2378</span>秒内抢到了<span id="sscore" class="lighttext"></span>个月饼
                <br>超过了<span id="suser" class="lighttext">99%</span>的用户！
            </div>
            <div id="getCardContainer">
        		<a id='gameCard' href="gameCard.html" >领取积分奖励</a>
        	</div>
        </div>
    </div>
    <script type="text/javascript" src="/Public/quanxian/js/game.js"></script>
</body>

</html>