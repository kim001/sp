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
<form action="<?php echo _HOME_URL_;?>/sys/module_ok" id="form1" method="post" enctype="multipart/form-data">
<table border="0" cellpadding="0" cellspacing="0" class="frm">
<tr>
	<th><b>*</b>模块名称：</th>
	<td>
		<input name="name" maxlength="20" type="text" class="txt" datacol="yes" err="模块名称" checkexpession="NotNull" value="<?php echo $info['name'];?>" />
	</td>
</tr>
<tr>
	<th><b>*</b>上级模块：</th>
	<td>
		<select name="pid" id="pid" class="select" style="width:43.5%">
			<option value="0">请选择...</option>
			<?php foreach($loop as $val){?>
			<option value='<?php echo $val['id'];?>'<?php if($val['id'] == $info['pid'])echo ' selected';?>><?php for($i=0;$i<$val['level'];$i++){?>&nbsp;&nbsp;<?php }?><?php echo $val['name'];?></option>
			<?php }?>
		</select>
	</td>
</tr>
<tr>
	<th><b>*</b>连接目标：</th>
	<td>
		<select name="target" id="target" class="select" style="width:43.5%">
			<option value="click"<?php if($info['target']=='click')echo ' selected';?>>click</option>
			<option value="iframe"<?php if($info['target']=='iframe')echo ' selected';?>>iframe</option>
			<option value="target"<?php if($info['target']=='target')echo ' selected';?>>target</option>
		</select>
	</td>
</tr>
<tr>
	<th>连接地址：</th>
	<td>
		<input name="url" maxlength="50" type="text" class="txt" value="<?php echo $info['url'];?>" />
	</td>
</tr>
<tr>
	<th>显示顺序：</th>
	<td>
		<input name="sortnum" maxlength="8" type="text" class="txt" value="<?php echo $info['sortnum'];?>" />
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