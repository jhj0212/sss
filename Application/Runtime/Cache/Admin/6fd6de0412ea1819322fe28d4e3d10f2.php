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
    <!-- 其他手写样式css -->
    <link rel="stylesheet" type="text/css" href="/Public/quanxian/css/addGife.css">
    <link rel="stylesheet" type="text/css" href="/Public/quanxian/css/reset.css">
    <!-- @media css -->
    <link rel="stylesheet" type="text/css" href="/Public/quanxian/css/media.css">
    <script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/1.9.0/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/quanxian/js/addGife.js"></script>
    <title>新增礼品</title>
</head>

<body>

    <!-- 父容器 -->
    <div class="container">
        <!-- 头部标题 -->
        <div id="headerContainer">
            <h3>新增礼品</h3>
        </div>
        <!-- 信息验证提示 -->
        <h3 id="validate"></h3>
        <form id="form" method="post" enctype="multipart/form-data" >
            <input type="hidden" name="sid" value="<?php echo ($sid); ?>">
            <!-- 基本信息容器 -->
            <div id="baseContianer">
                <h4>基本信息</h4>
                <div class="base_gife">
                    <h3>礼品名称：</h3>
                    <input type="text" placeholder="请输入礼品名称" name="gift_name"/>
                </div>
                <div class="base_gife">
                    <h3>礼品类型：</h3>
                    <div>
                        <input type="radio" name="gift_type" checked value="0">礼品</input>
                        <input type="radio" name="gift_type" value="1">商品</input>
                    </div>
                </div>
                <div class="base_gife">
                    <h3>礼品图片：</h3>
                    <!--input-group start-->
                    <div class="input-group row">
                        <div class="col-sm-9 big-photo">
                            <!--<div id="preview">
                                <img id="imghead" alt="请选择上传的礼品图片" onclick="$('#previewImg').click();">
                            </div>
                            <input type="file" onchange="previewImage(this)" name="gift_url" style="display: none;" id="previewImg" value="">
                            <input type="text"  name="gift_urlName" id="gift_urlName" value="">
                            <input type="text"  name="gift_urlSize" id="gift_urlSize" value="">
                            <input type="text"  name="gift_urlType" id="gift_urlType" value="">
                            <input type="text"  name="gift_urlPath" id="gift_urlPath" value="">-->
                            <a><img src="/Public/quanxian/img/manage_6.png" alt="" id="imghead" ></a>
                            <input name="imghead" type="hidden" />
                            <!--<input id="uploaderInput" class="uploader__input" style="display: none;" type="file" accept="" multiple="">-->
                        </div>
                    </div>
                    <!--input-group end-->
                    <span>礼品图片上传格式仅支持png、jpg格式</span>
                </div>
                <div class="base_gife">
                    <h3>所需积分：</h3>
                    <input type="text" placeholder="请输入所需积分" name="gift_bonus"/>
                    <span>礼品积分需为正整数，如100,210等</span>
                </div>
            </div>
            <!-- 提交 -->
            <div id="btnHack"></div>
            <div id="btnContainer">
                <button id="submitBtn" type="button">立即提交</button>
            </div>
        </form>
    </div>
    <!-- 外部库引用 -->

    <!--<script type="text/javascript" src="/Public/quanxian/js/viewImg.js"></script>-->
    <form style="display:none" enctype="multipart/form-data"  id="inputForm"  method="post">
        <input type="button" id="file" name="img" style="display:none"  form="inputForm">
    </form>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script>

        var imgname = "";
        var imgid = "";
        $('#imghead').click(function(){
            imgid = $(this).attr('id');
            imgname = $(this).closest('div').find('input[type=hidden]').attr('name');
            console.log(imgid);
            console.log(imgname);
            $('#file').click();
        });

        wx.config({
            debug: false,
            appId: '<?php echo ($wx_config["appId"]); ?>',
            timestamp: '<?php echo ($wx_config["timestamp"]); ?>',
            nonceStr: '<?php echo ($wx_config["nonceStr"]); ?>',
            signature: '<?php echo ($wx_config["signature"]); ?>',
            jsApiList: ['chooseImage','uploadImage']
        });

        wx.ready(function(){
            $('#file').on('click',function(){
                wx.chooseImage({
                    count: 1, // 默认9
                    sizeType: ['compressed'],
                    sourceType: ['album','camera'],
                    success: function (res) {
                        var localIds = res.localIds;
                        //upload
                        wx.uploadImage({
                            localId: localIds[0],
                            isShowProgressTips: 1,
                            success: function (res) {
                                var serverId = res.serverId;
                                server__id=serverId;
                                //save server
                                $.post('<?php echo U("wxupload");?>',
                                    {'serverId':serverId},
                                    function(ret){
                                        if(ret['status']!='00'){
                                            url=serverId;
                                            alert('上传失败，请重试！');
                                        }else{
                                            url=ret['data'];
                                            id = ret['id'];
                                            //alert(url);
                                            //alert(id);
                                            $('#'+imgid).attr('src','/Uploads'+url);
                                            $('#'+imgid).attr('width','80%');
                                            /*if(imgid=='imghead'){*/
                                                $('input[name='+imgname+']').val(id);
                                            /*}else{*/
                                                //$('input[name='+imgid+']').val(id);
                                            /*}*/
                                        }
                                        //alert(url);
                                    },'json');
                            }
                        });
                    }
                });
            });



        });
        wx.error(function(res){
            console.log(res);
            alert('信息调用有误，请重新刷新本页面');
        });

        $('input[type=file]').change(function(){ //上传控件
            //$('.ui-loading-block p').text('正在上传');
            //$('.ui-loading-block').addClass('show');
            if($(this).val() == ''){
                return ;
            }
            var ajax_option={
                url:'<?php echo U("uploadImg");?>',
                type: 'POST',
                dataType: 'json',
                timeout: '100000',
                success:function(data, status){
                    console.log(data);
                    //data  返回参数 statusText 返回状态
                    if(data.status)
                    {
                        $('#'+imgid).attr('src',data.path);
                        $('input[name='+imgname+']').val(data.id);
                        console.log($('input[name='+imgname+']').val());
                    }else{
                        alert('图片上传失败，请稍后再试！');
                    }
                },
                error:function(){
                    alert('图片上传失败，您上传的图片过大!');
                }
            };
            $('#inputForm').ajaxSubmit(ajax_option);
        });

    </script>
</body>

</html>