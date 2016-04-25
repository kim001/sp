<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="<?php echo _PUB_HOME_;?>/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo _PUB_HOME_;?>/css/accordion.css" rel="stylesheet" type="text/css" />
<script src="<?php echo _PUB_HOME_;?>/js/jquery.js"></script>
<script src="<?php echo _PUB_HOME_;?>/js/functionjs.js"></script>

<link rel="stylesheet" href="<?php echo _PUB_HOME_;?>/plugin/artDialog/skins/blue.css" type="text/css" />
<script src="<?php echo _PUB_HOME_;?>/plugin/artDialog/artDialog.source.js" type="text/javascript"></script>
<script src="<?php echo _PUB_HOME_;?>/plugin/artDialog/iframeTools.source.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){	
	//顶部导航切换
	$(".nav li a").click(function(){
		$(".nav li a.selected").removeClass("selected")
		$(this).addClass("selected");
	})	
})	
</script>
</head>
<body style="background:url(<?php echo _PUB_HOME_;?>/images/topbg.gif) repeat-x;">
<div class="topleft">
    <a href="<?php echo _HOME_URL_;?>" target="_top"><img src="<?php echo _PUB_HOME_;?>/images/logo.png" title="系统首页" /></a>
    </div>

	<ul class="nav" id="navddee" style="margin-top:35px;">
		<?php foreach($arr as $key => $val){?>
		<li><a href="javascript:;" target="rightFrame" onclick="leftNav('<?php echo $val['id'];?>')"<?php if($key == 0)echo ' class="selected"';?> style="border-radius:6px;"><h2 style="font-size:16px; padding-top:9px"><?php echo $val['name'];?></h2></a></li>
		<?php }?>
    </ul>
    <div class="topright">    
    <ul>
		<li><span><img src="<?php echo _PUB_HOME_;?>/images/help.png" title="帮助"  class="helpimg"/></span><a href="#">帮助</a></li>
		<li><a href="#">关于</a></li>
		<li><a href="<?php echo _HOME_URL_;?>/spindex/logout" target="_parent">退出</a></li>
    </ul>
     
    <div class="user">
		<span>admin</span>
		<i>消息</i>
		<b>0</b>
    </div>
</div>
<script>
function safe() {
	var url = "<?php echo _HOME_URL_;?>/spindex/safe";
	top.openDialog(url, 'dialog', '账户安全 - 修改密码', '500px', '320px', 50, 60);
}
function calcur() {
	var url = "<?php echo _HOME_URL_;?>/spindex/calcur";
	top.openDialog(url, 'dialog', '科学计算器', '800px', '420px', 50, 60);
}
function leftNav(topid) {
	var num = 0;
	//var obj = $(top.document.getElementById('mainFrame').contentWindow.document.body).find("#leftFrame").get(0).contentWindow.document.body;
	var obj = $(parent.document.getElementById('leftFrame').contentWindow.document.body);
	var dd = $(obj).find('dd');
	dd.each(function(i){
		if($(dd).eq(i).attr('dataid') == topid) {
			$(dd).eq(i).css('display', 'block');
			$(dd).eq(i).find('.menuson').css('display', 'none');
			if(num == 0)
				$(dd).eq(i).find('.menuson').css('display', 'block');
			num++;
			//$(dd).eq(0).css('display', 'block');
		}
		else {
			$(dd).eq(i).css('display', 'none');
		}
	})
}

</script>
</body>
</html>
