<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8"/>
	<meta name="content-type" content="text/html; charset=utf-8" />
	<title><?php echo $this->config->item('seo_title');?>-忘记密码</title>
	<meta name="Keywords" content="<?php echo $this->config->item('seo_keywords');?>" />
    <meta name="Description" content="<?php echo $this->config->item('seo_description');?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="renderer" content="webkit">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="baidu-site-verification" content="" />
    <meta name="csrf-token" content="">
    <link rel="Bookmark" type="image/x-icon" href="" />
    <link rel="shortcut icon" type="image/x-icon" href="" />
	<!--************js、css文件引入*************-->
	<link href="<?php echo autoVer('css/main.css');?>" rel="stylesheet" type="text/css"/>
	<link href="<?php echo autoVer('css/login&register.css');?>" rel="stylesheet" type="text/css"/>
	<script src="<?php echo autoVer('js/jquery1.11.2.js');?>" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo autoVer('js/main.js');?>" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo autoVer('js/common.js');?>" type="text/javascript" charset="utf-8"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo autoVer('plugin/validform/css/style.css');?>">
</head>
<body>
<?php $this->load->view('header');?>
<!--首页正文html-->
<div class="index_body">
	<div class="banner_border_box_H"></div>
	<div class="index_body_box container">
		<div class="login_banner">
			<div class="login_banner_box">
				<img src="<?php echo _PUB_DEFAULT_;?>/images/resetpassword_banner.jpg" alt="" />
			</div>
			<div class="register_main_box reset_main_box">
				<div class="login_top">
					<h2>找回密码</h2>
					<span></span>
				</div>
				<form action="<?php echo _BASE_;?>/user/forget_ok" method="post" id="form1">
					<div class="cellphon">
						<input type="text" name="mobile" id="mobile" placeholder="注册手机号码" dataType="m" errormsg="手机号码不正确！" nullmsg="请输入手机号码！" ajaxurl="<?php echo _BASE_;?>/user/forAjax" autocomplete="off" />
					</div>
					<div class="yzm">
						<input type="text" name="code" id="code" placeholder="验证码" dataType="s" errormsg="验证码不正确！" nullmsg="请输入验证码！" ajaxurl="<?php echo _BASE_;?>/user/forAjax" autocomplete="off" />
						<button onclick="send_sms(this)">获取验证码</button>
					</div>
					<div class="password">
						<input type="password" name="pwd1" id="pwd1" placeholder="新密码" dataType="*6-16" errormsg="密码长度6-16位！" nullmsg="请输入新密码！" autocomplete="off" />
					</div>
					<div class="password_again">
						<input type="password" name="pwd2" id="pwd2" placeholder="确认密码" dataType="*" recheck="pwd1" errormsg="两次密码不一致！" nullmsg="请再次输入密码！" autocomplete="off" />
					</div>
					<div class="submit">
						<input type="submit" value="重设密码" style="width:185px;float:left" />
						<div class="Validform_checktip" id="forTip" style="height:42px; line-height:42px;"></div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>	
<?php $this->load->view('footer');?>
</body>
<script type="text/javascript" src="<?php echo autoVer('plugin/validform/validform_min.js');?>"></script>
<script type="text/javascript" src="<?php echo autoVer('js/forget.js');?>"></script>
</html>
