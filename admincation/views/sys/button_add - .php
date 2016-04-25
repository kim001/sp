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
		<input name="code" maxlength="20" type="text" class="txt" datacol="yes" err="编码" checkexpession="NotNull" style="width: 220px" />
	</td>
</tr>
<tr>
	<th><b>*</b>名称：</th>
	<td>
		<input name="name" maxlength="20" type="text" class="txt" datacol="yes" err="名称" checkexpession="NotNull" style="width: 220px" />
	</td>
</tr>
<tr>
	<th><b>*</b>图标：</th>
	<td>
		<div class="file-box">
		<input type='text' name='textfield' id='textfield' class='filetxt' />  
		<input type='button' class='filebtn' value='浏览...' />
		<input type="file" name="img" class="textfile" size="28" onchange="document.getElementById('textfield').value=this.value" />
	</div>
	</td>
</tr>

<tr>
	<th><b>*</b>按钮事件：</th>
	<td>
		<input name="event" maxlength="50" type="text" class="txt" datacol="yes" err="按钮事件" checkexpession="NotNull" style="width: 220px" />
	</td>
</tr>
<tr>
	<th>显示顺序：</th>
	<td>
		<input name="sortnum" maxlength="8" type="text" class="txt" style="width: 220px" />
	</td>
</tr>
<tr>
	<th>描述：</th>
	<td>
		<textarea name="desc" maxlength="100" cols=50 rows=5></textarea>
	</td>
</tr>
</table>
<div class="frmbottom">
	<a class="l-btn" id="subform1" onclick="return commitSave('form1');" href="javascript:;"><span class="l-btn-left"><img src="<?php echo _PUB_HOME_;?>/images/16/accept.png" />确 认</span></a>
	<a class="l-btn" href="javascript:;" onclick="OpenClose();"><span class="l-btn-left"><img src="<?php echo _PUB_HOME_;?>/images/16/cancel.png" />关 闭</span></a>
</div>
</form>
</body>
</html>