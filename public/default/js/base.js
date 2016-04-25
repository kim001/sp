/*! base by blue li renwei 2016-03-01  |  最基本 元素脚本 通往每个页面 */
$(function(){
    
    //预加载方法封装函数
	var preloadImg = function(){
	    $("img").each(function(){//遍历所有图片
	        var othis = $(this),//当前图片对象
	            top = othis.offset().top - $(window).scrollTop();//计算图片top - 滚动条top
	           
	        if (top > $(window).height()) {//如果该图片不可见
	            return;//不管
	        } else {
	            //othis.attr('src', othis.attr('data-src')).removeAttr('data-src');//可见的时候把占位值替换 并删除占位属性
	            othis.attr('src', othis.attr('data-src'));
	        }
	    });
	    window.onscroll = function(){
			preloadImg();
		};
	}
	preloadImg();
});


/*
 *Gxunc
 **/

