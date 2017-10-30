;
$(function() {
    // 获取到button并赋值
    var card50 = $('.card50'),
        card100 = $('.card100'),
        card200 = $('.card200'),
        card300 = $('.card300'),
        card400 = $('.card400'),
        card500 = $('.card500');
    var getBtn = $('button'),
    	getwindow = $('#getCardWindow'),
    	mask = $('#mask');
   	var btnVal = '';
   	//jq获取地址栏参数扩展方法
    (function ($) {
        $.getUrlParam = function (name) {
            var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
            var r = window.location.search.substr(1).match(reg);
            if (r != null) return unescape(r[2]); return null;
        }
    })(jQuery);
   	
   	
   	
    /** ajax先加载出card的分数，在函数中调用以下Main函数！ **/
    /* 加载出当次分数，并加载出其领取过哪个积分 **/
    /* 把已领取过的积分按钮，设为1周内不可再次领取，并前台disabled，改状态为“已领取” **/
    /* Main函数 **/
   	// 得到分数赋值							
	var score = $.getUrlParam('score');
   	$('.myCard').html(score);
   
    function Main() {
        var card = parseInt(($('.myCard').text()));
        // 封装游戏分数获取器
        function gameCard(minCard, maxCard, btn) {
            if (card >= minCard && card < maxCard) {
                btn.removeClass('disabled').text('可领取').attr('disabled', false);
            }
        }
        // 触发分数获取器函数
        function mainTrigger() {
            gameCard(50, 100, card50);
            gameCard(100, 200, card100);
            gameCard(200, 300, card200);
            gameCard(300, 400, card300);
            gameCard(400, 500, card400);
            gameCard(500, 10000, card500);
        }
        // 触发触发器及弹窗函数
        mainTrigger();
        getCardWindow();
    }
  	// 主函数
    Main();

    // 点击领取后->弹窗函数
    function getCardWindow (){
    	getBtn.on('click', function() {
    		// 点击的按钮的值
    		btnVal = $(this).val();
    		// 特效操作
    		mask.show();
    		getwindow.show();
    		setTimeout(function () {
    			getwindow.hide();
    			mask.hide();
				clearTimeout();
    		},1000);
    		// ajax操作->向后台传递val并添加数据
    	});
    }
})
