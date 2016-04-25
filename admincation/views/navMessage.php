<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>系统消息提醒</title>
<script src="<?php echo _PUB_HOME_;?>/js/jquery.js"></script>
<script src="<?php echo _PUB_HOME_;?>/js/functionjs.js"></script>
<script src="<?php echo _PUB_HOME_;?>/plugin/artDialog/artDialog.source.js" type="text/javascript"></script>
<script src="<?php echo _PUB_HOME_;?>/plugin/artDialog/iframeTools.source.js" type="text/javascript"></script>
</head>
<body>
<script>
	top.showTipsMsg('<?php echo $text;?>', '3000', '<?php echo $type;?>');
	location.href='<?php echo $url;?>';
  </script>
</body>
</html>