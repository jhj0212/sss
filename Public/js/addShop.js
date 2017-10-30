;
$(function() {
    // 初始化获得一些标签并命名
    var shopLocation = $('input[name="shopLocation"]'),
        bMapDiv = $('.bMap'),
        addMapDiv = $('.addMap'),
        validate = $('#validate'),
        shopLocationVal = '',
        shopName = $('input[name="business_name"]'),
        shopPhone = $('input[name="shopPhone"]'),
        shopLogo = $("#shopLogo"),
        zizhiFile = $("#zizhiFile"),
        time_1 = $("input[name='time_1']"),
        time_2 = $("input[name='time_2']"),
        zizhiMain = $("input[name='zizhiMain']"),
        zizhiMainCheckVal = $("input[name='zizhiMain'][checked]").val(),
        zizhiFileDiv = $('.zizhiFile'),
        zizhiNameDiv = $('.zizhiName'),
        zizhiName = $('input[name="zizhiName"]'),
        zizhiCard = $('input[name="zizhiCard"]'),
        zizhiMainVal = '',
        submitBtn = $('#submitBtn'),
        businessName = $('.businessName');

    // 正则
    var phoneRe = /^((0\d{2,3}-\d{7,8})|(1[3584]\d{9}))$/,
        timeRe = /^(([1-9]{1})|([0-1][0-9])|([1-2][0-3])):([0-5][0-9])$/,
        zizhiCardRe = /^[-\d{1,20}]+$/;

    // 三级联动调动js方法
    shopLocation.citySelect();
    // 点击三级联动输入框
    shopLocation.on('click', function(event) {
        event.stopPropagation();
        shopLocation.citySelect('open');
    });

    // 三级联动输入框选择器

    shopLocation.on('done.ydui.cityselect', function(ret) {
        $(this).val(ret.provance + ' ' + ret.city + ' ' + ret.area);
        // 获取到三级联动的val值
        shopLocationVal = shopLocation.val();
        // 每次在获取到三级联动值之后,展示门店具体位置容器,并制空原地图容器组件
        addMapDiv.show();
        bMapDiv.empty();
        // 地图组件触发
        $("#addMap").bMap({
            //默认地址，如果为空则通过解析默认坐标获取
            address: shopLocationVal,
            //默认坐标，如果为空则通过解析默认地址获取
            // location: [],
            name: "map",
            //回调函数，返回地址数组与坐标
            callback: function(address, point) {
                console.log(address);
                console.log(point);
                var city = address.city,
                    district = address.district,
                    province = address.province,
                    street = address.street,
                    streetNumber = address.streetNumber,
                    lng = point.lng,
                    lat = point.lat;
                 
                $('#city').val(city);
                $('#district').val(district);
                $('#province').val(province);
                $('#street').val(street);
                $('#streetNumber').val(streetNumber);
                $('#lng').val(lng);
                $('#lat').val(lat);





            }
        });
       
        // 拿到map的input标签
        var mapInput = $('input[name="map"]');
        // 如果map地址有值，打开门店名称
        if (mapInput.val() != '') {
            shopName.attr({ 'disabled': false, 'placeholder': '请输入门店名称' }).removeClass('disabled');
        }
    });
 
    // 电话校验
    shopPhone.blur(function() {
        if (!phoneRe.test(shopPhone.val())) {
            validate.show().html('').html("电话号码格式错误");
        } else {
            validate.html('').hide();
        }
    })

    // 门店logo上传验证
    shopLogo.change(function() {
        if (!/\.(gif|jpg|jpeg|png|GIF|JPG|PNG)$/.test($(this).val())) {
            validate.show().html('').html("图片格式不正确");
            $(this).val('');
        } else {
            validate.html('').hide();
        }
    });

    // 营业时间校验
    time_1.blur(function() {
        if (!timeRe.test(time_1.val())) {
            validate.show().html('').html("营业时间格式不正确");
        } else {
            validate.html('').hide();
        }
    })
    time_2.blur(function() {
        if (!timeRe.test(time_2.val())) {
            validate.show().html('').html("营业时间格式不正确");
        } else {
            validate.html('').hide();
        }
    })

    // 经营资质证件号校验
    zizhiCard.blur(function() {
        if (!zizhiCardRe.test(zizhiCard.val())) {
            validate.show().html('').html("经营资质证件号格式不正确");
        } else {
            validate.html('').hide();
        }
    })

    // 经营资质上传图片校验 
    zizhiFile.change(function() {
        if (!/\.(gif|jpg|jpeg|png|GIF|JPG|PNG)$/.test($(this).val())) {
            validate.show().html('').html("图片格式不正确");
        } else {
            validate.html('').hide();
        }
    });

    // 经营资质主体点击切换表单
    // 先判断主体的val并判断显隐
    if (zizhiMainCheckVal == 0) {
        zizhiNameDiv.hide().find('input').val('');
        zizhiFileDiv.hide().find('input').val('');
    }
    zizhiMain.on('click', function() {
        zizhiMainVal = $(this).val();
        if (zizhiMainVal == 0) {
            zizhiNameDiv.hide().find('input').val('');
            zizhiFileDiv.hide().find('input').val('');
        }
        if (zizhiMainVal == 1) {
            zizhiNameDiv.show();
            zizhiFileDiv.show();
        }
    });

    submitBtn.on('click', function() {
        // 美食val赋值
        var optionVal = $('#shopData option:selected').val();
        // 证件号资质制0
        if (zizhiMainVal == '') {
            zizhiMainVal = 0;
        }
        // 验证表单信息
        if (zizhiCard.val() == '') {
            validate.show().html('').html("经营资质证件号不能为空");
        }
        if (!zizhiCardRe.test(zizhiCard.val())) {
            validate.show().html('').html("经营资质证件号格式不正确");
        }
        if (!zizhiCardRe.test(zizhiCard.val())) {
            validate.show().html('').html("经营资质证件号填写错误");
        }
        if (shopLogo.val() == '') {
            validate.show().html('').html("门店图片不能为空");
        }
        if (shopLocation.val() == '') {
            validate.show().html('').html("门店定位不能为空");
        }
        if (shopPhone.val() == '') {
            validate.show().html('').html("客服电话不能为空");
        }
        if (!phoneRe.test(shopPhone.val())) {
            validate.show().html('').html("电话号码格式错误");
        }
        if (shopName.val() == '') {
            validate.show().html('').html("门店名称不能为空");
        }
        if (time_1.val() == '' || time_2.val() == '') {
            validate.show().html('').html("营业时间不能为空");
        }
        if (businessName.val() == '') {
            validate.show().html('').html("分店名称不能为空");
        }
        // 经营资质val为相关主体即val=1时
        if (zizhiMainVal == 1) {
            if (zizhiName.val() == '') {
                validate.show().html('').html("经营资质名称不能为空");
            }
            if (zizhiFile.val() == '') {
                validate.show().html('').html("相关材料不能为空");
            }
        }
        // 所有验证通过后可以提交表单
        if (zizhiCardRe.test(zizhiCard.val()) && businessName.val() != '' && shopLogo.val() != '' && timeRe.test(time_1.val()) && timeRe.test(time_2.val()) && shopLocation.val() != '' && phoneRe.test(shopPhone.val()) && shopName.val() != '') {
            if (zizhiMainVal == 1) {
                if (zizhiName.val() == '') {
                    validate.show().html('').html("经营资质名称不能为空");
                }
                if (zizhiFile.val() == '') {
                    validate.show().html('').html("相关材料不能为空");
                }
                else {
                    // 提交表单
                    console.log("success1");
                }
            }
            if (zizhiMainVal == 0){
                // 提交表单
                console.log("success0");
            }
        }
        console.log(optionVal);
    });

});
