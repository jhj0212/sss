;
$(function() {
    // init
    var cancelBtn = $('.cancelBtn'),
        mask = $('#mask'),
        confirmWs = $("#confirm_ws"),
        confirmTrue = $(".wx_true"),
        confirmCancel = $(".wx_false"),
        empty = $("#empty");
    var orderVal = '';
    var order_id = $('input[name="orderid"]'),
    	order_idVal = '';
    // 删除按钮点击事件->弹出选择框
    cancelBtn.on('click', function() {
    	order_idVal = $(this).parent('tr').find('input').val();
        mask.show();
        confirmWs.show();
        // 拿到当前点击的tr的id值并赋给orderVal，用来传递后台数据
        orderVal = $(this).parent('tr').attr('id');
    });
    // 点击确定->传递信息，隐藏选择框
    confirmTrue.on('click', function() {
    	
        // ajax->利用获取到的orderVal进行删除操作
    	$.ajax({
    		url:'orderDelete',//请求到控制器的地址 U方法
    		data:{'order_id':order_id},//控制器方法需要的数据
    		method:'POST',
    		//async: false,同步
    		type:'JSON',//返回值的类型
    		success:function(data){//成功后的回调函数，对返回值进行操作
                if(data==1){
                    mask.hide();
                    confirmWs.hide();
                    window.location.reload(true);
                }
		    }
        })
    });
        // 点击取消->直接隐藏选择框
    confirmCancel.on('click', function() {
        mask.hide();
        confirmWs.hide();
        orderVal = '';
    })
    if ($('tbody').find('tr').length == 0) {
        empty.show();
    } else {
        empty.hide();
    }
})
