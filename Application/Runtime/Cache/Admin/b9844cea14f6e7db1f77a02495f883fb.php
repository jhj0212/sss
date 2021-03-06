<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="Generator" content="EditPlus®">
    <meta name="Author" content="">
    <meta name="Keywords" content="">
    <meta name="Description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>餐位添加</title>
    <link rel="stylesheet" type="text/css" href="/Public/quanxian/css/tianjia.css" />
    <script type="text/javascript" src="/Public/quanxian/js/jquery.js"></script>
</head>
<body class="main">

    <form action="<?php echo U('addSeat');?>" method='post' name="register" class="form-x" enctype="multipart/form-data">
        <input type="hidden" name="sid" id="sid" value="<?php echo ($sid); ?>"/>
        <input type="hidden" name="id" id="id" value="<?php echo ($id); ?>"/>
        <div class="tupian">
            <img src="/Public/quanxian/img/tianjia.png" />
            <h3 id="reContent"></h3>
        </div>
        <div class="liebiao">
            <ul>
                <li>
                    <p>桌号 :</p>
                    <input type="text" class=" " name="table_id" id="table_id" value="" placeholder="请输入桌号"/>
                    <span></span>
                </li>
                <li>
                    <p>餐位名称 :</p>
                    <input type="text" class=" " name="table_name" id="table_name" value="" placeholder="请输入餐位名称"/>
                </li>
                <li>
                    <p>可容纳人数 :</p>
                    <input type="text" class=" " name="person_count" id="person_count" value=""placeholder="请输入可容纳人数 "/>
                </li>
                <li>
                    <p>餐位类型 :</p>
                    <select name="table_type">
                        <option value="1">2人桌</option>
                        <option value="2">4人桌</option>
                        <option value="3">6人桌</option>
                        <option value="4">8人桌</option>
                        <option value="0">包房</option>
                    </select>
                </li>
                <li>
                    <p>是否提供预定 :</p>
                    <select name="is_order">
                        <option value="1">是</option>
                        <option value="0">否</option>
                    </select>
                </li>
            </ul>
        </div>
        <div class="tijiao">
            <button class="" type="submit" id="submitBtn"> 提交</button>
           <!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a class="" href="<?php echo U('seatBack');?>">&nbsp;返回</a>-->
        </div>
    </form>

    <script>
        var validate = {
            table_id : false,
            table_name : false,
            person_count : false

        };
        var reContent = $("#reContent");
        var msg = '';
        $(function(){

            var register = $( 'form[name=register]' );

            register.submit( function () {
                var isOK = validate.table_id && validate.table_name && validate.person_count;
                if ( isOK ) {
                    return true;
                }

                $( 'input[name=table_id]', register ).trigger('blur');
                $( 'input[name=table_name]', register ).trigger('blur');
                $( 'input[name=person_count]', register ).trigger('blur');
                return false;
            } );

            //验证桌号
            $("input[name='table_id']", register ).blur(function(){
                var table_id = $('#table_id').val();
                var sid = $('#sid').val();
                var span = $( this ).next();

                if ( table_id == '' ) {
                    /*msg = '桌号不能为空';
                    span.html( msg ).addClass('error');*/
                    reContent.show().html('请输入桌号！');
                    validate.table_id = false;
                    return;
                }

                $.get("<?php echo U('Admin/checkTable');?>",{'table_id':table_id,'sid':sid},function(data){
                    if(data==1){
                        reContent.show().html('此桌号已存在，请重新输入！');
                        $('#table_id').val('');
                       /* msg = '此桌号已存在，请重新输入';
                        span.html( msg ).addClass('error');*/
                        validate.table_id = false;
                    }else{
                        msg = '';
                        span.html( msg ).removeClass('error');
                        validate.table_id = true;
                    }

                })
            });
            //验证餐位名称
            $( 'input[name=table_name]', register ).blur( function () {
                var table_name = $('#table_name').val();
                var span = $( this ).next();

                if ( table_name == '' ) {
                   /* msg = '餐位名称不能为空';
                    span.html( msg ).addClass('error');*/
                    reContent.show().html('请输入餐位名称！');
                    validate.table_name = false;
                    return;
                }
                msg = '';
                validate.table_name = true;
                span.html( msg ).removeClass('error');
            } );
            //验证可容纳人数
            $("input[name='person_count']", register ).blur(function(){
                var person_count = $('#person_count').val();
                var span = $( this ).next();

                if ( person_count == '' ) {
                   /* msg = '可容纳人数不能为空';
                    span.html( msg ).addClass('error');*/
                    reContent.show().html('请输入可容纳人数！');
                    validate.person_count = false;
                    return;
                }
                msg = '';
                validate.person_count = true;
                span.html( msg ).removeClass('error');
            });
        })
    </script>
</body>
</html>