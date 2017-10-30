;$(function () {
	var subBtn = $('#newCoupon'),
		delBtn = $('td').find('.cancelCoupon'),
		pushBtn = $('td').find('.pushCoupon'),
		trueBtn = $('.true'),
		cancelBtn = $('.cancel'),
		tr = '';
	var confirmWs = $('#confirmWs'),
		mask = $('#mask');
	// 新建优惠券事件
	subBtn.on('click',function () {
		$(location).attr('href','../html/addCouponIndex.html');
	});
	// 删除卡券事件
	delBtn.on('click',function () {
		// 选中删除行的tr并全部删除
		tr = $(this).parent('td').parent('tr');
		// 对事件进行处理
		mask.show();
		confirmWs.show();
		confirmFunction();
	});
	// 处理删除tr函数
	function confirmFunction (){
		// 点击确认
		trueBtn.on('click', function() {
			mask.hide();
			confirmWs.hide();
			tr.remove();
			// 删除后进行一些表单操作并刷新页面
		});
		// 点击取消
		cancelBtn.on('click',function () {
			mask.hide();
			confirmWs.hide();
		})
	}
	// 暂无数据
    var empty = $('#empty');
    if ($('tbody').find('tr').length == 0) {
        empty.show();
    } else {
        empty.hide();
    }
})