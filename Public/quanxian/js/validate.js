;$(function() {
    var submitBtn = $("#submitBtn"),
        reContent = $("#reContent");
    // 正则定义
    var phoneRe = /^1[34578]\d{9}$/;
    //var phoneRe = /^1[3|4|5|8][0-9]\d{4,8}$/;
	// 权限修改表单验证
    submitBtn.on('click', function () {
        var phoneVal = $("#sys_phone_number").val();
        if (phoneRe.test(phoneVal)== false) {
            reContent.show().html(' 请输入正确的手机号码！');
        }
        if (phoneVal=='') {
            reContent.show().html('请输入手机号码！');
        }
        if (phoneVal != ''&&phoneRe.test(phoneVal)) {
            reContent.hide();
            $('form').submit();
        }
    });
});