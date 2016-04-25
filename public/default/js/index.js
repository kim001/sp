/*!
 * 中药材商城首页js文件
 */

$(document).ready(function(){

 	//成交新闻状态
	var newstime = setInterval(newsgoup,2000)
	function newsgoup(){
		$("#Purchase ul").animate({top:-36},500,function(){
			$("#Purchase ul").css({top:0});
			$("#Purchase ul li:eq(0)").insertAfter($("#Purchase ul li:last"));
		});
	}
	
	$("#Purchase ul li").hover(function(){
		clearInterval(newstime)
	},function(){
		newstime = setInterval(newsgoup,2000)
	})
	//图片首页效果
	// $(".hot_sale_body img").hover(function(){
	// 	$(this).animate({
	// 		'width': '103%',
	// 		'height': '102%',
	// 	},300,function(){
	// 		$(this).animate({
	// 		})
	// 	});
	// },function(){
	// 	$(this).animate({
	// 		'width': '100%',
	// 		'height': '100%',
	// 	},100);
	// })

 })
