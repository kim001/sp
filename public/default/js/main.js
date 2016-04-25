/*!
 * 公共js文件
 */


//封装banner和1f 2f 3f的小banner公共函数
function bannerI($box,$a,$class,$time){
	var banner_time = setInterval(timeC,$time);
	var x = 0;
	var $b = $a-1
	var obj = $box.find("li");
	var obj_f = $box.find("span");
	function timeC(){
		if(x<$b){
			x++;
		}else{
			x=0;
		}
		obj.hide(0);// hide  fadeOut
		obj.eq(x).fadeIn(1500); //show fadeIn 
		obj_f.removeClass($class);
		obj_f.eq(x).addClass($class);
	}
	obj.hover(function(){
		clearInterval(banner_time);
	},function(){
		banner_time = setInterval(timeC,$time);
	})
	obj_f.hover(function(){
		var n = obj_f.index(this);
		clearInterval(banner_time);
		obj.hide(0);
		obj.eq(n).fadeIn(1500);
		obj_f.removeClass($class);
		obj_f.eq(n).addClass($class);
	},function(){
		var n = obj_f.index(this);
		banner_time = setInterval(timeC,$time);
		x = n;
	})
}
//选项卡封装函数
function tableC($box,$table_top,$table_item,$class,$aa){	//$aa选择鼠标经过或者点击
	/*
	**$box选项卡大盒子
	**$table_top选项卡头部盒子
	**$table_item选项卡内容每一项共同盒子
	**$class选项卡头部当前项class类
	<div class="$box">
		<div class="$table_top">
			<ul>
				<li class="$class">...</li>
			</ul>
		</div>
		<div class="">
			<div class="$table_item">1</div>
			<div class="$table_item">2</div>
		</div>
	</div>
	*/
	var t_list = $box.find($table_top).find("li");
	var m_list = $box.find($table_item);
	if($aa == 'mouseover' || $aa == null){	//鼠标经过效果
		t_list.mouseover(function(){
			var n = t_list.index(this);
			t_list.removeClass($class);
			t_list.eq(n).addClass($class);
			m_list.hide(0);
			m_list.eq(n).show();
		})
	}else if($aa == 'click'){	//点击效果
		t_list.click(function(event) {
			var n = t_list.index(this);
			t_list.removeClass($class);
			t_list.eq(n).addClass($class);
			m_list.hide(0);
			m_list.eq(n).show();
		});
	}
}
//店家星系评估和买家评价星级
function xxLevel($box,$level,$class){
	for (var a= 0; a < $level; a++) {
		$box.find('i').eq(a).addClass($class);
	}
}


//预加载方法封装函数
function imgload($box){
	var $libox = $box.find('li');
	var boxT = new Array();
	var thisH = new Array();
	var srcimg = new Array();
	//debugger;
	//var abc = $libox.eq(0).offset().top;
	$.each($libox,function(i){
	    boxT[i] = $libox.eq(i).offset().top;
		srcimg[i] = $libox.eq(i).find('img').attr("xsrc");	
		var scrollT = $(document).scrollTop();
		var bodyH = $(window).height();

		thisH[i] = boxT[i] - bodyH - scrollT;
		for (var i = 0; i < thisH.length; i++) {
			if (thisH[i] <=0) {
				$libox.eq(i).find('img').attr("src",srcimg[i])
			}
		}
	});
	window.onscroll = function(){
		$.each($libox,function(i){
		    boxT[i] = $libox.eq(i).offset().top;
			srcimg[i] = $libox.eq(i).find('img').attr("xsrc");
			var scrollT = $(document).scrollTop();
			var bodyH = $(window).height();
			thisH[i] = boxT[i] - bodyH - scrollT;
		})
		//console.log(srcimg);
		for (var i = 0; i < thisH.length; i++) {
			if (thisH[i] <=  0) {
				$libox.eq(i).find('img').attr("src",srcimg[i])
			}
		}
	}
}

//借款流程左边高度自适应
var rightH = $(".box_body_right").outerHeight();
$(".box_body_left").height(rightH);

$(document).ready(function(){
	//头部一直固定在顶部
	$(window).scroll(function(){
		var scroll_TOP = $(document).scrollTop();
		//document.title = scroll_TOP ;
		var nav_top = $("#topnav").offset().top;
		//var head_fixedH = $("#head_fixed").height();
		//document.title = head_fixedH;
		//$(".head_fixed_box").css('height',head_fixedH);

		//document.title = nav_top ;
		if(scroll_TOP>nav_top){
			// $("#head_fixed").css({"position":"fixed","top":"0px","z-index":"1000"})
			// 				.css('border-bottom','1px #d1d1d1 solid');
			$(".toTop").show(); //返回顶部按钮显示
		}else{
			// $("#head_fixed").css({"position":"fixed","top":-scroll_TOP,"z-index":"1000"})
			// 				.css('border-bottom','none');
			$(".toTop").hide(); //返回顶部按钮隐藏
		}
	});
	//点击返回顶部按钮
	$(".toTop").click(function(){
		$("html,body").animate({scrollTop:0},500);	
	});
	
	
	//买家排序top图片
	//sortshow($("ul.seller_sort li"));
	
	$(".goods_list_page").addClass("user_select");
})



















