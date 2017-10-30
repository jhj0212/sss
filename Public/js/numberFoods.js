;
$(function() {
    // 左侧tab动态获取信息->ajax
    function ajaxLeftTab() {

    }

    // 右侧tab动态获取信息->ajax
    function ajaxRightTab() {
    	
    }

    // tab处理函数
    function showList() {
        // 初始化，获取左右两侧tab列表
        var leftBtn = $('#foodsNav').children('li'),
            rightTab = $('#foodsListContainer').find('.foodsList');
        // 左侧li点击事件
        leftBtn.on('click', function() {
            // var当前点击索引值
            var index = $(this).index();
            // 同级当前点击li追加类active，兄弟元素追加类''->取消样式
            $(this).attr('class', 'active').siblings('li').attr('class', '');
            // 右侧菜单容器根据索引值判断是否显示
            rightTab.eq(index).show().siblings('.foodsList').hide();
        })
    }

    // 入口函数
    function main() {
    	// 顺序执行->当左右ajax获取信息append至html后
    	ajaxLeftTab();
    	ajaxRightTab();
    	// showList才可以找到左右tab的元素进行tab切换
        showList();
    }

    // API
    main();
})
