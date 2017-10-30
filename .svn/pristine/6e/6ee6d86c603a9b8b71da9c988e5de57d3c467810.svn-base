<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="Generator" content="EditPlus®">
    <meta name="Author" content="">
    <meta name="Keywords" content="">
    <meta name="Description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<base href="__STATIC__/">-->

    <link rel="stylesheet" type="text/css" href="/Public/quanxian/css/styles.css" />
    <script type="text/javascript" src="/Public/quanxian/js/moment.js"></script>
    <script type="text/javascript" src="/Public/quanxian/js/jquery.js"></script>
    <script type="text/javascript" src="/Public/quanxian/js/bootstrap-datetimepicker.js"></script>
    <title>线上收益</title>
    <script type="text/javascript">
        $(document).ready(function() {
            // date time picker

            if($(".iDate.date").length > 0) {
                $(".iDate.date").datetimepicker({
                    locale: "zh-cn",
                    format: "YYYY-MM-DD",
                    dayViewHeaderFormat: "YYYY年 MMMM"
                });
            }
        })
    </script>

</head>
<body style="padding: 10px; ">
        <!--no.1-->
        <div class="iDate date">
            <input type="text" name="begin_time" value="">
            <button type="button" class="addOn"></button>
        </div>
        <div class="iDate date">
            <input type="text" name="end_time" value="">
            <button type="button" class="addOn"></button>
        </div>

        <div class="sousuo">
            <form action="<?php echo U('revenue',array('sid'=>$sid));?>" method='post' class="" enctype="multipart/form-data">
                <button>
                    <img src="/Public/quanxian/img/fangda.png" />
                </button>
            </form>
        </div>

        <!--no.2-->
        <div class="kll">
            <div class="kll_z">
                <p>客流量</p>
                <h2><span><?php echo ($data[0]["count"]); ?></span>人</h2>
            </div>
            <div class="kll_y">
                <p>人均消费</p>
                <h2><span><?php echo ($data[0]["consum"]); ?></span>元</h2>
            </div>
        </div>
        <!--no.3-->
        <div class="liebiao">
            <ul>
                <li>
                    <p>营业额</p>
                    <span><?php echo ($data[0]["summoney"]); ?>元</span>
                </li>
                <li>
                    <p>折后营业额</p>
                    <span><?php echo ($data[0]["zhemoney"]); ?>元</span>
                </li>
                <li>
                    <p>会员充值</p>
                    <span><?php echo ($data[0]["count"]); ?>元</span>
                </li>
                <li>
                    <p>优免金额</p>
                    <span><?php echo ($data[0]["premoney"]); ?>元</span>
                </li>
            </ul>
        </div>

</body>
</html>