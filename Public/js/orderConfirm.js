;
$(function() {
    // 初始化控件
    var day = $(".Day_order").find('span'),
        time = "",
        tabelNumber = '',
        sex = $("input[name='sex']"),
        name = $("input[name='nickName']"),
        phone = $("input[name='phone']"),
        remark = $("textarea"),
        submitBtn = $("#submitBtn").find('button'),
        reContent = $("#reContent"),
    	tabletime = '',
    	zhuo = $("#zhuo").parent();
    // 初始化控件value值和索引
    var dayIndex = null,
        timeVal = $("input[name='time'][checked]").val(),
        tabelNumberVal = '',
        sexVal = $("input[name='sex'][checked]").val(),
        remarkVal = $("textarea").val();

    // 正则定义
    var phoneRe = /^1[34578]\d{9}$/,
    	nameRe = /^([\u4e00-\u9fa5]{1,20}|[a-zA-Z\.\s]{1,20})$/;
    
    //先隐藏座位数量
    zhuo.hide();
    
    // day函数->选择当前日期(天数索引值)，并返回索引index

    day.on('click', function() {
    	zhuo.show();
    	$('.zhuoTrue').hide();
    	dayIndex = $(this).text();
    	$.ajax({
    		url:'calTableInfo',//请求到控制器的地址 U方法
    		data:{'day':dayIndex},//控制器方法需要的数据
    		method:'POST',
    		//async: false,同步
    		type:'JSON',//返回值的类型
    		success:function(data){//成功后的回调函数，对返回值进行操作 
	        			if(data.status!=0){
		    				$("#zhuo").html(data.msg);
		    				$(".tableNumber_choose").empty();
		    				if($('.time_radio_container')){
		    					$('#TimeContainer').empty();
		    				}
		    			}
		    			else{
			    			$("#zhuo").html(data.data.table_num);
			    			var html = "";
			    			if(data.data.table_id.length!=0){
				    			for(var i = 0; i <data.data.table_id.length; i++){
				    				html+='<div class="radio"><label class="disabled">'+data.data.table_id[i]+'</label><input type="radio"  name="tabelNumber" value= "'+data.data.table_id[i]+'" ></div>';
				    			}
			    			}  
			    			//tabletime = data.data.table_time;
			    			$(".tableNumber_choose").html(html);
			    			tabelNumber =$("input[name='tabelNumber']");
			    			tabelNumber.parent('.radio').parent('.tableNumber_choose').find('label').removeClass('disabled');
			    			showTabelOpen ();
			    			clickTabelNumber();	
		    			}
    		}
    	});
        $(this).addClass('choose');
        $(this).siblings('span').removeClass('choose');
    })

    // 其他获取当前点击的input值事件->增加样式类，并返回此值，对默认value赋值\
    // 桌位取值
    function clickTabelNumber () {
        tabelNumber.on('click', function() {
        	var html = '';
        	var alltime = '';
            tabelNumberVal = $(this).val();
        	$.ajax({
        		url:'calTimeInfo',//请求到控制器的地址 U方法
        		data:{'tabelNumber':tabelNumberVal},//控制器方法需要的数据
        		method:'POST',
        		//async: false,同步
        		type:'JSON',//返回值的类型
        		success:function(data){//成功后的回调函数，对返回值进行操作 
        				
        			 $.each(data,function(n,val){	
        	            	html+='<div class="time_radio_container">';
        	                html+='<span class="disabled" id="order_time">'+val+'</span>';
        	                html+='<input type="radio" disabled name="time" value="'+val+'"></input></div>';
    	            })
    	            $daytime = $("input[name='time']").val();
        			 $('#TimeContainer').html(html);
        			 $(this).prev().addClass('choose');
        			 $(this).parent().siblings('.radio').find('label').removeClass('choose');
        			 time = $("input[name='time']");
        			 time.parent().find('span').removeClass('disabled');
        			 showTimeOpen();
        			 clickTime();
        		}
        	});
            //alltime = tabletime[tabelNumberVal];
        });
    };
    // 打开餐桌选位函数->在这个函数中写入ajax->查询桌位
    function showTabelOpen () {
    	var tabelOpen = setInterval(function() {
    		if (dayIndex != null) {
    			clearInterval(tabelOpen);
    			tabelNumber.attr('disabled', false);
    		}
    	}, 100);
    }
    // 打开具体时间函数->在这个函数中写入ajax->查询时间
    function showTimeOpen () {
    	var timeOpen = setInterval(function() {
    		if (tabelNumberVal != undefined) {
    			clearInterval(timeOpen);
    			time.attr('disabled', false);
    		}
    	}, 100);
    }
    // 打开填写姓名和备注函数
    function showNameOpen(){
    	var nameOpen = setInterval(function() {
        	if (timeVal != undefined&&dayIndex!=null&&tabelNumberVal!=undefined) {
            	clearInterval(nameOpen);
            	sex.attr('disabled', false);
            	name.attr('disabled', false);
            	phone.attr('disabled', false);
            	remark.attr('disabled', false);
        	}
    	}, 100);
    	clickSex();
    }
    // 时间取值-》点击变色
    function clickTime () {
    	time.on('click', function() {
    		timeVal = $(this).val();
    		$(this).prev().addClass('choose');
    		$(this).parent().siblings('.time_radio_container').find('span').removeClass('choose');
    	});
    	showNameOpen();
    }
    // 性别取值-》点击变色
    function clickSex(){
    	sex.on('click', function() {
    		sexVal = $(this).val();
    		$(this).prev().addClass('name_radio_type_hack_true');
    		$(this).parent().parent().siblings('.name_sex_content').find('label').removeClass('name_radio_type_hack_true');
    	});
    }
    // 点击事件end
    // 表单验证
    submitBtn.on('click', function() {
    	var phoneVal = $("input[name='phone']").val(),
    		nickNameVal = $("input[name='nickName']").val();
    		remarkNameVal = $("textarea[name='remark']").val()
        if (!phoneRe.test(phoneVal)) {
        	reContent.show().html('请输入正确的手机号码！');
        }
        if (!nameRe.test(nickNameVal)) {
        	reContent.show().html('请输入正确的姓名格式！');
        }
        if (sexVal == undefined) {
        	reContent.show().html('请输入选择性别！');
        }
        if (sexVal != undefined && nameRe.test(nickNameVal) && phoneRe.test(phoneVal)) {
        	reContent.hide();
        	$('form').submit();
        }
        
       /* var info=new Array();
        info[0]=dayIndex;
        info[1]=tabelNumberVal;
        info[2]=timeVal;
        info[3]=nickNameVal;
        info[4]=phoneVal;
        info[5]=sexVal;
        info[6]=remarkNameVal;
        
        $.ajax({
    		url:'/Admin/Order/orderSuccess',//请求到控制器的地址 U方法
    		data:{'info':info},//控制器方法需要的数据
    		method:'POST',
    		//async: false,//同步
    		type:'JSON',//返回值的类型
    		success:function(data){//成功后的回调函数，对返回值进行操作 
    			alert(data);
    		}
        });*/
    });
});
