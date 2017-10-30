;
$(function() {
    var cancelGife = $('.cancelGife'),
        addGife = $('#addGife'),
		trueBtn = $('.true'),
		cancelBtn = $('.cancel'),
        gift_id = $('input[name="gift_id"]'),
        gift_idVal = '',
		gifeContent = '';
    // 定义暂无数据图片
    var empty = $('#empty');
    // 定义弹窗
	var confirmWs = $('#confirmWs'),
		mask = $('#mask');

	// 点击删除按钮触发事件
    cancelGife.on('click', function() {
    	gifeContent = $(this).parent('div').parent('.gifeContent');
		mask.show();
		confirmWs.show();
		confirmFunction();
		gift_idVal = $(this).parent('div').find('input').val();
    });

    // 点击新增礼品按钮跳转页面
    addGife.on('click', function() {
    	$(location).attr("href","/addGift");
		//window.location.href='{:U("addGift")}';
    });

	// 处理删除tr函数
	function confirmFunction (){
		// 点击确认
		trueBtn.on('click', function() {
            console.log(gift_idVal);
			// 删除后进行一些后台操作并刷新页面
            $.ajax({
                url:'Admin/deleteGift',//请求到控制器的地址 U方法
                data:{'gift_id':gift_idVal},//控制器方法需要的数据
                method:'GET',
                async: false,
                //type:'JSON',//返回值的类型
                success:function(data){//成功后的回调函数，对返回值进行操作
                    console.log(data);
					if(data==1){
                        // 刷新页面
                        location.reload(true);
                        gifeContent.remove();
					}
                }
            });
            mask.hide();
            confirmWs.hide();

		});
		// 点击取消
		cancelBtn.on('click',function () {
			mask.hide();
			confirmWs.hide();
		})
	}

    // 为空时显示暂无数据
    if ($('#gifeContainer').find('.gifeContent').length == 0) {
        empty.show();
    } else {
        empty.hide();
    }
})
