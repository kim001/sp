<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>欢迎登录xxx管理系统</title>
<link href="<?php echo _PUB_HOME_;?>/css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="<?php echo _PUB_HOME_;?>/js/jquery.js"></script>
<script src="<?php echo _PUB_HOME_;?>/js/cloud.js" type="text/javascript"></script>
<script src="<?php echo _PUB_HOME_;?>/js/login.js" type="text/javascript"></script>
<script language="javascript">
	$(function(){
    $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
	$(window).resize(function(){  
    $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
    })  
});  
</script> 

</head>

<body style="background-color:#1c77ac; background-image:url(<?php echo _PUB_HOME_;?>/images/light.png); background-repeat:no-repeat; background-position:center top; overflow:hidden;">
    <div id="mainBody">
      <div id="cloud1" class="cloud"></div>
      <div id="cloud2" class="cloud"></div>
    </div>  
<div class="logintop">    
    <span>欢迎登录xxx管理系统</span>    
    <ul>
    <li><a href="<?php echo _BASE_;?>">回首页</a></li>
    </ul>    
    </div>
    
    <div class="loginbody">
  
    <span style="display:block;"></span>
    <form action="<?php echo _HOME_URL_;?>/spindex/login_ok" method="post" id="loginForm">
    <div class="loginbox">
    <ul>
    <li><input name="tname" type="text" class="loginuser" value="账号" onclick="JavaScript:this.value=''"/></li>
    <li><input name="tpwd" type="password" class="loginpwd" onclick="JavaScript:this.value=''"/></li>
    <li style="margin-bottom:10px;"><input type="button" class="loginbtn" value="登录" /></li>
	<li id="msgError" style="color:#FF0000"></li>
    </ul>
    </div>
    </form>
    </div>
    
    <div class="loginbm">版权所有  2015  <a href="##" target="_blank">深圳市谷山科技有限公司</a> 请勿用于任何商业用途</div>
</body>
</html>