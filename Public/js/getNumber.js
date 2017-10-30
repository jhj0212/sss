;
$(function() {
    // 获取变量
    var submit = $('button[type="button"]'),
        span = $('#prompt').find('span');
    // 数字正则->人数(至少1位)
    var peopleRe = /^\d{1,}$/;
    // 数字正则->手机号(11位)
    var phoneRe = /^1[0-9]{10}$/;
    // 表单提交按钮->先验证->验证通过后提交表单
    submit.on('click', function(event) {
        // init初始变量赋值
        var peopleVal = $('#get_people').val(),
            phoneVal = $('#get_phone').val();
        // 人数验证
        if (!peopleRe.test(peopleVal)) {
            span.html('').html('请输入正确的人数！')
        }
        // 手机号验证
        if (!phoneRe.test(phoneVal)) {
            span.html('').html('请输入正确的11位手机号码！');
        }
      /*  $.ajax({
        	url:'/xhy/Admin/Index/getNumber',
        	data:{'phoneVal':phoneVal},
        	method:"POST",
        	type:'JSON',
        	success:function(data){
        		
        	}
        });
        
        //Ajax调用处理
        $.ajax({
           type: "POST",
           url: "test.php",
           data: "name=garfield&age=18",
           success: function(data){
                    $("#myDiv").html('<h2>'+data+'</h2>');
              }
        });
        */
        
        
        // 双重验证通过->提交表单
        if (peopleRe.test(peopleVal) && phoneRe.test(phoneVal)) {
        	// 提交表单->传递数据
            $('form').submit();
        }
    });
})
