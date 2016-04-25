<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="<?php echo _PUB_HOME_;?>/css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="<?php echo _PUB_HOME_;?>/js/jquery.js"></script>

<script type="text/javascript">
$(function(){	
	//导航切换
	$(".menuson li").click(function(){
		$(".menuson li.active").removeClass("active")
		$(this).addClass("active");
	});
	/*
	$('.title').click(function(){
		var $ul = $(this).next('ul');
		//$('dd').find('ul').slideUp();
		if($ul.is(':visible')){
			$(this).next('ul').slideUp();
		}else{
			$(this).next('ul').slideDown();
		}
	});
	*/
	$('.title').click(function(){
		var $ul = $(this).next('ul');
		if(!$ul.is(':visible')) {
			var titles = $('.leftmenu').find('.title');
			titles.each(function(i) {
				$(titles).eq(i).next('ul').slideUp();
			})
			$(this).next('ul').slideDown();
		}
	});
})	
</script>

</head>
<body style="background:#f0f9fd;">
	<div class="lefttop"><span></span>药商平台</div>
    <dl class="leftmenu">
    <?php foreach($arr as $key => $val){?>
    <dd dataid="<?php echo $val['pid'];?>"<?php if(!in_array($val['id'], $thisarr))echo ' style="display:none"';?>>
    <div class="title">
    <span></span><?php echo $val['name'];?>
    </div>
    	<ul class="menuson">
		<?php foreach($val['next'] as $k => $v){?><li><cite></cite><a href="<?php echo _HOME_URL_.$v['url'];?>" target="rightFrame"><?php echo $v['name'];?></a><i></i></li><?php }?>
        </ul>
    </dd>
     <?php }?>
	</dl>
	<script>
	var dd = $('.leftmenu').find('dd');
	var num = 0;
	dd.each(function(i){
		if($(dd).eq(i).css('display') != 'none' && num == 0) {
			$(dd).eq(i).find('.menuson').css('display', 'block');
			num++;
		}
	})
	</script>
</body>
</html>
