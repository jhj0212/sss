;
$(function() {

    // 获取变量
    var baseColor = $('input[name="baseColor"]'),
        baseTitle = $('input[name="baseTitle"]'),
        chooseTime = $('input[name="chooseTime"]'),
        slot = $('input[name="slot"]'),
        slotName = $('.slotName'),
        slotInput = $('.slotInput'),
        limit = $('.limit'),
        usePay = $('.usePay'),
        imgType = $('input[name="imgType"]'),
        button = $('#submitBtn'),
        validate = $('#validate'),
        chooseTimeFixed1 = $('.chooseTimeFixed1'),
        chooseTimeFixed2 = $('.chooseTimeFixed2');

    // 基本信息值
    var baseColorVal = $('input[name="baseColor"][checked]').val(),
        baseTitleVal = baseTitle.val(),
        chooseTimeVal = $('input[name="chooseTime"][checked]').val(),
        slotVal = $('input[name="slot"][checked]').val(),
        slot_some_day = $('.slot_some_day'),
        imgTypeVal = $('input[name="imgType"][checked]').val(),
        discountMsg = $('.discountMsg').val(),
        use_pay_select = $("#use_pay_select option:selected").val(),
        use_share_select = $("#use_share_select option:selected").val(),
        usePay_text = $('.usePay_text').val(),
        phoneVal = $('.phone').val();

    // 正则
    var phoneRe = /^1(3|4|5|7|8)\d{9}$/,
        numberRe = /^\d{0,}$/;

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

    // 使用条件点击 隐藏与显式
    usePay.on('click', function() {
        if ($(this).is(':checked')) {
            $('.use_pay_div').show();
        } else {
            $('.use_pay_div').hide();
            $('.use_pay_div').find('.usePay_text').val('');
        }
    });

    // 封面样式
    imgType.on('click', function() {
        imgTypeVal = $(this).val();
        $(this).prev('img').addClass('imgTrue');
        $(this).parent().siblings('.img_type').find('img').removeClass('imgTrue');
    })

    // 使用条件
    $('#use_pay_select').on('click', function() {
        use_pay_select = $(this).val();
    })
    $('#use_share_select').on('click', function() {
        use_share_select = $(this).val();
    })

    // 卡券标题验证
    baseTitle.blur(function() {
        baseTitleVal = $('input[name="baseTitle"]').val();
        if (baseTitleVal === '') {
            validate.show().html('').html("请输入卡券标题");
        } else {
            validate.html('').hide();
        }
    })

    // 卡券简介验证
    $('.discountMsg').blur(function() {
        discountMsg = $('.discountMsg').val();
        if (discountMsg === '') {
            validate.show().html('').html("请输入卡券简介");
        } else {
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
        discountMsg = $('.discountMsg').val();
        baseTitleVal = $('input[name="baseTitle"]').val();
        usePay_text = $('.usePay_text').val();
        // 获取到两个有效期的input日期的值
        var startTime = chooseTimeFixed1.val(),
            endTime = chooseTimeFixed2.val();
        // 将开始时间与结束时间转换成中国标准时间
        var start = new Date(startTime.replace("-", "/").replace("-", "/")),
            end = new Date(endTime.replace("-", "/").replace("-", "/"));
        // 验证空及undefined值->不通过
        if (baseTitleVal == '') {
            validate.show().html('').html("请输入卡券标题");
        }
        if (chooseTimeVal == undefined) {
            validate.show().html('').html("请选择有效期");
        }
        if (slotVal == undefined) {
            validate.show().html('').html("请选择可用时段");
        }
        // 固定有效期判断
        if (start > end) {
            validate.show().html('').html("开始日期不得大于结束日期");
        }
        // 选择部分时段，判断内容是否填充
        if (slotVal == 1) {
            var slotInputVal = slotInput.val();
            if (!slotName.is(':checked') && slotInputVal === '') {
                validate.show().html('').html("部分时段填写错误");
            }
        }
        if (discountMsg == '') {
            validate.show().html('').html("请填写封面简介");
        }
        // 同时满足两种条件，且并行空字符则验证不通过使用规则
        if ((use_share_select == null || use_share_select == 0) && usePay_text == '') {
            validate.show().html('').html("请选择使用条件");
        }
        // 所有验证通过后提交表单
        if (baseTitleVal != '' && chooseTimeVal != undefined && slotVal != undefined && (start <= end) && discountMsg != '' && ((use_share_select != null || use_share_select != 0) && usePay_text != '')) {
            // 隐藏表单
            validate.html('').hide();
            // 提交表单
            $('form').submit();
        }
    })
})
