<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="Generator" content="EditPlus®">
    <meta name="Author" content="">
    <meta name="Keywords" content="">
    <meta name="Description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>预定报表</title>
    <link rel="stylesheet" type="text/css" href="/Public/quanxian/css/styles.css" />
    <script type="text/javascript" src="/Public/quanxian/js/moment.js"></script>
    <script type="text/javascript" src="/Public/quanxian/js/jquery.js"></script>
    <script type="text/javascript" src="/Public/quanxian/js/bootstrap-datetimepicker.js"></script>
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
    <form action="<?php echo U('report',array('sid'=>$sid));?>" method='post' class="" enctype="multipart/form-data">
        <input type="hidden" name="sid" value="<?php echo ($sid); ?>">
        <div class="iDate date">
            <input type="text" name="begin_time" value="">
            <button type="button" class="addOn"></button>
        </div>
        <div class="iDate date">
            <input type="text" name="end_time" value="">
            <button type="button" class="addOn"></button>
        </div>
        <div class="sousuo">
            <button>
                <img src="/Public/quanxian/img/fangda.png" />
            </button>
        </div>
        <div class="liebiao">
            <ul>
                <?php if(is_array($person)): foreach($person as $key=>$data): ?><li>
                        <p><?php echo ($data["table_id"]); ?></p>
                        <span><?php echo ($data["count"]); ?>次</span>
                    </li><?php endforeach; endif; ?>
            </ul>
        </div>
    </form>
</body>
</html>