<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="overflow-y:auto;">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>药商平台管理系统</title>
<link href="<?php echo _PUB_HOME_;?>/css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo _PUB_HOME_;?>/css/accordion.css" type="text/css" />
<script src="<?php echo _PUB_HOME_;?>/js/jquery.js"></script>
<script src="<?php echo _PUB_HOME_;?>/js/functionjs.js"></script>
<link rel="stylesheet" href="<?php echo _PUB_HOME_;?>/plugin/artDialog/skins/blue.css" type="text/css" />
<script src="<?php echo _PUB_HOME_;?>/plugin/artDialog/artDialog.source.js" type="text/javascript"></script>
<script src="<?php echo _PUB_HOME_;?>/plugin/artDialog/iframeTools.source.js" type="text/javascript"></script>
<body>
<iframe src="<?php echo _HOME_URL_;?>/spindex/main" width="100%" marginwidth=0 id="mainFrame" name="mainFrame"></iframe>
<script>
$(function() {
	/*
	var maxheight = window.screen.height;
	var minheight = $(window).height();
	$("#mainFrame").css('max-height', maxheight);
	$("#mainFrame").css('min-height', minheight);
	*/
	var screenheight = window.screen.height-200;
	$("#mainFrame").css('height', screenheight+'px');
})
</script>
</body>
</html>