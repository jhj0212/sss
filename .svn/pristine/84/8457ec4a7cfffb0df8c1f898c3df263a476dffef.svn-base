;
$(function() {

    // 获取变量
    var baseColor = $('input[name="baseColor"]'),
        baseTitle = $('input[name="baseTitle"]'),
        chooseTime = $('input[name="chooseTime"]'),
        slot = $('input[name="slot"]'),
        slotName = $('.slotName'),
        slotInput = $('.slotInput'),
        button = $('#submitBtn'),
        validate = $('#validate'),
        chooseTimeFixed1 = $('.chooseTimeFixed1'),
        chooseTimeFixed2 = $('.chooseTimeFixed2'),
        baseDiscount = $('input[name="baseDiscount"]'),
        youhui_check_1 = $('.youhui_check_1'),
        youhui_check_2 = $('.youhui_check_2'),
        Youhui_first = $('.Youhui_first'),
        Youhui_second = $('.Youhui_second'),
        youhui_input = $('.youhui_input');

    // 基本信息值
    var baseColorVal = $('input[name="baseColor"][checked]').val(),
        baseTitleVal = baseTitle.val(),
        chooseTimeVal = $('input[name="chooseTime"][checked]').val(),
        slotVal = $('input[name="slot"][checked]').val(),
        slot_some_day = $('.slot_some_day'),
        imgTypeVal = $('input[name="imgType"][checked]').val(),
        phoneVal = $('.phone').val();

    // 正则
    var phoneRe = /^1(3|4|5|7|8)\d{9}$/,
        numberRe = /^\d{0,}$/,
        discountRe = /^[1-9](\.[0-9])$/;

    // 卡券颜色->点击追加特效并移除其他特效
    baseColor.on('click', function() {
        baseColorVal = $(this).val();
        $(this).parent().addClass('true').siblings('.base_color').removeClass('true');
    });

    // 卡券有效期-》点选其中一个，置灰另一个
    if (chooseTimeVal == 0) {
        $(this).parent().siblings().find('input').attr('disabled', false);
        $(this).parent().siblings().find('span').css('color', '#777');
        $('input[name="chooseTime"][value="1"]').parent().find('select').attr('disabled', true);
    }
    chooseTime.on('click', function() {
        chooseTimeVal = $(this).val();
        // 固定日期置灰领取后
        if (chooseTimeVal == 0) {
            $(this).parent().siblings().find('input').attr('disabled', false);
            $(this).parent().siblings().find('span').css('color', '#777');
            $('input[name="chooseTime"][value="1"]').parent().find('select').attr('disabled', true);
        }
        // 领取后置灰固定日期
        if (chooseTimeVal == 1) {
            $(this).parent().find('select').attr('disabled', false);
            $('input[name="chooseTime"][value="0"]').parent().siblings().find('input').attr('disabled', true);
            $('input[name="chooseTime"][value="0"]').parent().siblings().find('span').css('color', '#ddd');
        }
    });

    // 固定日期选择器
    if ($(".iDate.date").length > 0) {
        $(".iDate.date").datetimepicker({
            locale: "zh-cn",
            format: "YYYY-MM-DD",
            dayViewHeaderFormat: "YYYY年 MMMM"
        });
    }

    // 固定有效期失焦验证
    chooseTimeFixed1.blur(function() {
        // 获取到两个input日期的值
        var startTime = chooseTimeFixed1.val(),
            endTime = chooseTimeFixed2.val();
        // 将开始时间与结束时间转换成中国标准时间
        var start = new Date(startTime.replace("-", "/").replace("-", "/")),
            end = new Date(endTime.replace("-", "/").replace("-", "/"));
        // 开始与结束日期比较
        if (start > end) {
            validate.show().html('').html("开始日期不得大于结束日期");
        } else {
            validate.hide().html('');
        }
    });
    chooseTimeFixed2.blur(function() {
        // 获取到两个input日期的值
        var startTime = chooseTimeFixed1.val(),
            endTime = chooseTimeFixed2.val();
        // 将开始时间与结束时间转换成中国标准时间
        var start = new Date(startTime.replace("-", "/").replace("-", "/")),
            end = new Date(endTime.replace("-", "/").replace("-", "/"));
        // 开始与结束日期比较
        if (start > end) {
            validate.show().html('').html("结束日期不得小于开始日期");
        } else {
            validate.hide().html('');
        }
    });

    // 卡券可用时段 ->点选其中一个，隐藏另一个
    slot.on('click', function() {
        slotVal = $(this).val();
        if (slotVal == 0) {
            slot_some_day.hide();
            // 清空另一个所有信息
            slotName.attr('checked', false);
            slotInput.val("");
        }
        if (slotVal == 1) {
            slot_some_day.show();
        }
    });

    // 会员卡标题验证
    baseTitle.blur(function() {
        baseTitleVal = $('input[name="baseTitle"]').val();
        if (baseTitleVal === '') {
            validate.show().html('').html("请输入会员卡标题");
        } else {
            validate.html('').hide();
        }
    })

    // 会员卡优惠点击事件
    youhui_check_1.on('click', function() {
        if (youhui_check_1.is(':checked')) {
            Youhui_first.show();
            if (!numberRe.test(youhui_input)) {
                validate.show().html('').html("积分优惠填写错误");
            }
        } else {
            Youhui_first.hide();
            Youhui_first.find('input').val('');
            validate.html('').hide();
        }
    })
    youhui_check_2.on('click', function() {
            if (youhui_check_2.is(':checked')) {
                Youhui_second.show();
                // 卡券折扣力度
                if (baseDiscount.val() == '') {
                    validate.show().html('').html("折扣额度不能为空");
                }
                if (!discountRe.test(baseDiscount.val())) {
                    validate.show().html('').html("折扣额度填写错误");
                }
            } else {
                Youhui_second.find('input').val('');
                Youhui_second.hide();
                validate.html('').hide();
            }
        })
        // 手机验证
    $('.phone').blur(function() {
        phoneVal = $('.phone').val();
        if (!phoneRe.test(phoneVal)) {
            validate.show().html('').html("请填写正确的手机号");
        } else {
            validate.html('').hide();
        }
    })

    // 表单提交验证
    button.on('click', function() {
        // 重置一些value值
        baseTitleVal = $('input[name="baseTitle"]').val();
        usePay_text = $('.usePay_text').val();
        // 获取到两个有效期的input日期的值
        var startTime = chooseTimeFixed1.val(),
            endTime = chooseTimeFixed2.val();
        // 将开始时间与结束时间转换成中国标准时间
        var start = new Date(startTime.replace("-", "/").replace("-", "/")),
            end = new Date(endTime.replace("-", "/").replace("-", "/"));
        // 验证空及undefined值->不通过
        // 卡券标题
        if (baseTitleVal == '') {
            validate.show().html('').html("请输入会员卡标题");
        }
        // 会员卡优惠判断
        if (!youhui_check_1.is(':checked') && !youhui_check_2.is(':checked')) {
            validate.show().html('').html("没有选择会员卡优惠选项");
        }
        if (youhui_check_1.is(':checked')) {
            if (!numberRe.test(youhui_input.val())) {
                validate.show().html('').html("积分优惠填写错误");
            }
        }
        if (youhui_check_2.is(':checked')) {
            if (baseDiscount.val() == '') {
                validate.show().html('').html("折扣额度不能为空");
            }
            if (!discountRe.test(baseDiscount.val())) {
                validate.show().html('').html("折扣额度填写错误");
            }
        }
        // 卡券有效期
        if (chooseTimeVal == undefined) {
            validate.show().html('').html("请选择有效期");
        }
        // 固定有效期判断
        if (start > end) {
            validate.show().html('').html("开始日期不得大于结束日期");
        }
        // 卡券时间段
        if (slotVal == undefined) {
            validate.show().html('').html("请选择可用时段");
        }
        // 所有验证通过后提交表单
        if (baseTitleVal != '' && (youhui_check_1.is(':checked') || youhui_check_2.is(':checked')) && chooseTimeVal != undefined && slotVal != undefined && (start <= end)) {
            // 选择时段，判断内容是否填充
            if (slotVal == 0) {
                // 隐藏表单
                validate.html('').hide();
                // 提交表单
                $('form').submit();
            }
            if (slotVal == 1) {
                var slotInputVal = slotInput.val(),
                    slotValTrue = '';
                if (!slotName.is(':checked') && slotInputVal === '') {
                    validate.show().html('').html("部分时段填写错误");
                } else {
                    // 隐藏表单
                    validate.html('').hide();
                    // 提交表单
                    $('form').submit();
                    console.log('su2');
                }
            }
        }
    })
})
