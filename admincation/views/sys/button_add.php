<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" href="<?php echo _PUB_HOME_;?>/css/validator.css" type="text/css" />
<script src="<?php echo _PUB_HOME_;?>/js/jquery.js"></script>
<script src="<?php echo _PUB_HOME_;?>/js/common.js"></script>

<script src="<?php echo _PUB_HOME_;?>/js/functionjs.js"></script>
<script src="<?php echo _PUB_HOME_;?>/js/jvalidator.js"></script>
<script src="<?php echo _PUB_HOME_;?>/plugin/artDialog/artDialog.source.js" type="text/javascript"></script>
<script src="<?php echo _PUB_HOME_;?>/plugin/artDialog/iframeTools.source.js" type="text/javascript"></script>
</head>

<body>
<form action="<?php echo _HOME_URL_;?>/sys/button_ok" id="form1" method="post" enctype="multipart/form-data">
<table border="0" cellpadding="0" cellspacing="0" class="frm">
<tr>
	<th><b>*</b>编码：</th>
	<td>
		<input name="code" maxlength="20" type="text" class="txt" datacol="yes" err="编码" checkexpession="NotNull" value="<?php echo $info['code'];?>" />
	</td>
</tr>
<tr>
	<th><b>*</b>名称：</th>
	<td>
		<input name="name" maxlength="20" type="text" class="txt" datacol="yes" err="名称" checkexpession="NotNull" value="<?php echo $info['name'];?>" />
	</td>
</tr>
<tr>
	<th><b>*</b>按钮图标：</th>
	<td>
		<input name="img" type="hidden" id="img" value="<?php echo $info['img'];?>">
		<img src="<?php if($info['img'])echo _PUB_HOME_.'/images/16/'.$info['img'];else echo _PUB_HOME_.'/images/illustration.png';?>" id="imgMenu" style="vertical-align: middle; padding-right: 10px; width: 16px; height: 16px;">
		<input class="btn" value="图标选取" type="button" onclick="open_img()">
	</td>
</tr>
<tr>
	<th><b>*</b>按钮事件：</th>
	<td>
		<input name="event" maxlength="50" type="text" class="txt" datacol="yes" err="按钮事件" checkexpession="NotNull" value="<?php echo $info['event'];?>" />
	</td>
</tr>
<tr>
	<th>显示顺序：</th>
	<td>
		<input name="sortnum" maxlength="8" type="text" class="txt" value="<?php echo $info['sortnum'];?>" />
	</td>
</tr>
<tr>
	<th>描述：</th>
	<td>
		<textarea name="desc" maxlength="100" cols=50 rows=5><?php echo $info['desc'];?></textarea>
	</td>
</tr>
</table>
<input type="hidden" name="id" value="<?php echo $info['id'];?>" />
<div class="frmbottom">
	<a class="l-btn" id="subform1" onclick="return commitSave('form1');" href="javascript:;"><span class="l-btn-left"><img src="<?php echo _PUB_HOME_;?>/images/16/accept.png" />确 认</span></a>
	<a class="l-btn" href="javascript:;" onclick="OpenClose();"><span class="l-btn-left"><img src="<?php echo _PUB_HOME_;?>/images/16/cancel.png" />关 闭</span></a>
</div>
</form>
<script>
function open_img() {
	var url = "<?php echo _HOME_URL_;?>/sys/open_img";
	openDialog(url, 'dialog1', '选取系统图标', '600px', '400px', 100, 60);
}
</script>
</body>
</html>