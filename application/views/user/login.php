<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8"/>
	<meta name="content-type" content="text/html; charset=utf-8" />
	<title><?php echo $this->config->item('seo_title');?>-登录</title>
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
				<img src="<?php echo _PUB_DEFAULT_;?>/images/login_banner.jpg" alt="" />
			</div>
			<div class="login_main_box">
				<div class="login_top">
					<h2>账号登录</h2>
					<span></span>
				</div>
				<form action="<?php echo _BASE_;?>/user/login_ok" method="post" id="form1">
					<div class="username">
						<input type="text" placeholder="昵称/手机号码" name="tname" id="tname" dataType="s2-10|m" errormsg="用户名格式不正确！" nullmsg="请输入用户名！" tip="昵称/手机号码" altercss="gray" ajaxurl="<?php echo _BASE_;?>/user/loginAjax/tname" autocomplete="off" />
					</div>
					<div class="password">
						<input type="password" placeholder="登录密码" name="tpwd" id="tpwd"  datatype="*6-16&chktpwd" nullmsg="请输入登录密码！" autocomplete="off" />
					</div>
					<div class="yzm">
						<input type="text" placeholder="验证码" name="yzm" id="yzm" dataType="s" errormsg="验证码不正确！" nullmsg="请输入验证码！" ajaxurl="<?php echo _BASE_;?>/user/loginAjax/yzm" autocomplete="off" />
						<a class="refresh" href="javascript:;" onclick="javascript:document.getElementById('yzm_img').src='<?php echo _BASE_;?>/yzm/getYzm/'+Math.random();document.getElementById('yzm').value=''"><img id="yzm_img" src="<?php echo _BASE_;?>/Yzm/getYzm" alt="" /></a>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" name="is_auto" value="1" />下次自动登录</label>
						<a href="<?php echo _BASE_;?>/user/forget" title="忘记密码？">忘记密码</a>
						<div class="Validform_checktip" id="loginTip" style="height:36px; line-height:36px;"></div>
					</div>
					<div class="submit" style="margin-top:0px;">
						<input type="hidden" name="ret_url" value="<?php echo $ret_url;?>"/>
						<input type="submit" value="立即登录"/>
					</div>
				</form>
			</div>
			<div class="mf_register">
				<a href="<?php echo _BASE_;?>/user/register">免费注册 <span>》</span></a>
			</div>
		</div>
	</div>
</div>	
<?php $this->load->view('footer');?>
</body>
<script type="text/javascript" src="<?php echo autoVer('plugin/validform/validform_min.js');?>"></script>
<script type="text/javascript" src="<?php echo autoVer('js/login.js');?>"></script>
</html>
