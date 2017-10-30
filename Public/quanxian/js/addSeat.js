;$(function() {
    var submitBtn = $("#submitBtn"),
        reContent = $("#reContent");
    // 正则定义
    //var phoneRe = /^1[34578]\d{9}$/;
    $.get("{:U('check')}",{table_id:table_id},function(data){
        if(data==1){
            console.log(data);
            reContent.show().html('桌号已存在！');
            $('#table_id').val('');
        }else{
            reContent.hide();
        }
    });
	// 权限修改表单验证
    submitBtn.on('click', function () {
        console.log(1);
        var table_id    = $('#table_id').val();
        var table_name  = $( '#table_name' ).val();
        var person_count = $( '#person_count' ).val();
        console.log(person_count);
        if (table_id=='') {
            reContent.show().html('请输入桌号！');
        }
        if (table_name=='') {
            reContent.show().html('请输入餐位名称！');
        }
        if (person_count=='') {
            reContent.show().html('请输入可容纳人数！');
        }
        if (table_id != ''&&table_name != ''&&person_count != '') {
            reContent.hide();
            $('form').submit();
        }
    });
});