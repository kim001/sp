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
<form action="<?php echo _HOME_URL_;?>/sys/admin_ok" id="form1" method="post" enctype="multipart/form-data">
<table border="0" cellpadding="0" cellspacing="0" class="frm">
<tr>
	<th><b>*</b>所属角色：</th>
	<td>
		<select name="role_id" datacol="yes" err="所属角色" checkexpession="NotNull" style="width:120px;">
			<option value=''>请选择...</option>
			<?php foreach($role_list as $val){?>
			<option value='<?php echo $val['id'];?>'<?php if($val['id'] == $info['role_id'])echo ' selected';?>><?php echo $val['name'];?></option>
			<?php }?>
		</select>
	</td>
</tr>
<tr>
	<th><b>*</b>登录帐号：</th>
	<td>
		<input name="admin_name" maxlength="20" type="text" class="txt" datacol="yes" err="登录帐号" checkexpession="NotNull" value="<?php echo $info['admin_name'];?>" />
	</td>
</tr>
<?php if($info){?>
<tr>
	<th>登录密码：</th>
	<td>
		<input name="admin_pwd" maxlength="20" type="password" class="txt" /><i>为空则不改</i>
	</td>
</tr>
<?php }else{?>
<tr>
	<th><b>*</b>登录密码：</th>
	<td>
		<input name="admin_pwd" maxlength="20" type="password" class="txt" datacol="yes" err="登录密码" checkexpession="NotNull" />
	</td>
</tr>
<?php }?>
<tr>
	<th>真实姓名：</th>
	<td>
		<input name="realname" maxlength="20" type="text" class="txt" value="<?php echo $info['realname'];?>" />
	</td>
</tr>
<tr>
	<th>手机号码：</th>
	<td>
		<input name="mobile" maxlength="20" type="text" class="txt" value="<?php echo $info['mobile'];?>" />
	</td>
</tr>
<tr>
	<th>邮箱地址：</th>
	<td>
		<input name="email" maxlength="30" type="text" class="txt" value="<?php echo $info['email'];?>" />
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