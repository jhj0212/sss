;$(function () {
	// init->button
	var text = $('#text'),
		submitBtn = $('#submitBtn'),
		discount = $("input[name='discount']"),
		discountVal = $("input[name='discount'][checked]").val();
	// init->re/validate
	var textRe = /^\+?[1-9]\d*$/,
		validate = $('#validate');

	// function input discount Val-> click
	discount.on('click', function() {
		discountVal = $(this).val();
	});

	// function input any money-> click
	submitBtn.on('click', function () {
		textVal = text.val();
		// 什么都没选直接点击提交
		if (!textRe.test(textVal) && discountVal === undefined) {
			validate.hide();
			validate.html('').html('请输入正确的金额').show(100);
		}
		// 填了金额，还选了优惠后点击提交
		if (textRe.test(textVal) && discountVal != undefined) {
			validate.hide();
			validate.html('').html('不能同时选择两种充值方式').show(100);
		}
		// 手动输入缴费金额状态
		if (textRe.test(textVal) && discountVal === undefined) {
			validate.hide();
			// 发起支付请求
			// 请求处理后跳转页面
			$(location).attr('href','../html/rechangeSuccess.html');
		}
		// 选择优惠活动而不填写金额
		if (!textRe.test(textVal) && discountVal != undefined) {
			validate.hide();
			// 提交选择的优惠val至后台,然后发起支付请求
			$('form').submit();
			// 请求处理后跳转页面
			$(location).attr('href','../html/rechangeSuccess.html');
		}
	})

})