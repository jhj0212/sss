;
$(function() {
    var validate = $('#validate'),
        menu_name = $('input[name="menu_name"]'),
        menu_type = $('input[name="menu_type"]'),
        unit_price = $('input[name="unit_price"]'),
        //menu_url = $('input[name="imghead"]'),
        submitBtn = $('#submitBtn');
    // 正则
    var bonusRe = /^[1-9]\d*$/;

    // 名称失焦验证
    menu_name.blur(function() {
        if (menu_name.val() == '') {
            validate.html('').html('菜品名称不能为空').show();
        } else {
            validate.html('').hide();
        }
    })
    // 积分失焦验证
    unit_price.blur(function() {
        if (!bonusRe.test(unit_price.val())) {
            validate.html('').html('单价格式不正确').show();
        } else {
            validate.html('').hide();
        }
    })
    // 菜品类型
    menu_type.blur(function() {
        if (menu_type.val() == '') {
            validate.html('').html('菜品类型不能为空').show();
        } else {
            validate.html('').hide();
        }
    })
    // 礼品图片验证
    /*menu_url.change(function() {
        if (!/\.(jpg|jpeg|png|JPG|PNG)$/.test($(this).val())) {
            validate.show().html('').html("图片格式不正确");
            $(this).val('');
        } else {
            validate.html('').hide();
        }
    });*/

    // 点击提交
    submitBtn.on('click', function() {
        if (menu_name.val() == '') {
            validate.html('').html('菜品名称不能为空').show();
        }
        if (!bonusRe.test(unit_price.val())) {
            validate.html('').html('单价格式不正确').show();
        }
        /*if (menu_url.val() == '') {
            validate.html('').html('菜品图片不能为空').show();
        }*/
        if (menu_type.val() == '') {
            validate.html('').html('菜品类型不能为空').show();
        }
        // 全部验证后通过
        if (menu_name.val() != '' && bonusRe.test(unit_price.val()) && menu_type.val() != '') {
            console.log(menu_name.val());
            console.log(menu_type.val());
            console.log(unit_price.val());
            $('#form').submit();
        }
    })
})
