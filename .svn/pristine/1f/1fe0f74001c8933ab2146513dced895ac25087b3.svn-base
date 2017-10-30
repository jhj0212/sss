;$(function (){
	var submitBtn = $('#submitBtn'),
		name = $('#nickName'),
		sex = $('.sex'),
		phone = $('#phone'),
		validate = $('#validate'),
		sexCheckVal = '';

	// 正则
	nameRe = /^([\u4e00-\u9fa5]){2,7}$/,
	phoneRe = /^1(3|4|5|7|8)\d{9}$/;
	
    // 固定日期选择器
    if ($(".iDate.date").length > 0) {
        $(".iDate.date").datetimepicker({
            locale: "zh-cn",
            format: "YYYY-MM-DD",
            dayViewHeaderFormat: "YYYY年 MMMM"
        });
    }
	// 姓名验证
	name.blur(function () {
		if (!nameRe.test(name.val())) {
			validate.show().html('').html("姓名格式不正确");
		}else{
			validate.hide();
		}
	})

	// 手机验证
	phone.blur(function () {
		if (!phoneRe.test(phone.val())) {
			validate.show().html('').html("手机号格式不正确");
		}else{
			validate.hide();
		}
	})

	// 性别添加显示标识
	sex.on('click',function () {
		sexCheckVal = $(this).val();
		$(this).prev('label').addClass('true');
		$(this).parent('div').siblings('div').find('label').removeClass('true');
	})

	// 表单提交验证
	submitBtn.on('click',function(){
		if (name.val() == '') {
			validate.show().html('').html("姓名不能为空");
		}
		if (!nameRe.test(name.val())) {
			validate.show().html('').html("姓名格式不正确");
		}
		if (!phoneRe.test(phone.val())) {
			validate.show().html('').html("手机号格式不正确");
		}
		if (phone.val() == '') {
			validate.show().html('').html("手机号不能为空");
		}
		if (nameRe.test(name.val()) && phoneRe.test(phone.val())) {
			$('form').submit();
		}
	})
});