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
<form action="<?php echo _HOME_URL_;?>/sys/role_ok" id="form1" method="post" enctype="multipart/form-data">
<table border="0" cellpadding="0" cellspacing="0" class="frm">
<tr>
	<th><b>*</b>角色名称：</th>
	<td>
		<input name="name" maxlength="20" type="text" class="txt" datacol="yes" err="角色名称" checkexpession="NotNull" value="<?php echo $info['name'];?>" />
	</td>
</tr>
<tr>
	<th><b>*</b>角色分类：</th>
	<td>
		<select name="tyname" datacol="yes" err="角色分类" checkexpession="NotNull" style="width:120px;">
			<option value=''>请选择...</option>
			<option value='系统角色'<?php if($info['tyname'] == '系统角色')echo ' selected';?>>系统角色</option>
			<option value='业务角色'<?php if($info['tyname'] == '业务角色')echo ' selected';?>>业务角色</option>
			<option value='应用角色'<?php if($info['tyname'] == '应用角色')echo ' selected';?>>应用角色</option>
		</select>
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
</body>
</html>