<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8"/>
	<meta name="content-type" content="text/html; charset=utf-8" />
	<meta name="content-type" content="text/html; charset=utf-8" />
	<title><?php echo $this->config->item('seo_title');?>-系统消息</title>
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
	<link rel="stylesheet" type="text/css" href="<?php echo autoVer('css/main.css');?>"/>
	<link rel="stylesheet" type="text/css" href="<?php echo autoVer('css/person.css');?>">
	<script src="<?php echo autoVer('js/jquery1.11.2.js');?>" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo autoVer('js/common.js');?>" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo autoVer('js/main.js');?>" type="text/javascript" charset="utf-8"></script>
</head>
<body style="background: #f9f9f9;">
<!--个人中心正文html-->
<div class="index_detail_body">
	<div class="banner_border_box_H"></div>
	
	<div class="error_box">
		<div class="error_main">
			<?php if($act == 0){?><img src="<?php echo _PUB_DEFAULT_;?>/images/warn_error.png"><?php }else{?><img src="<?php echo _PUB_DEFAULT_;?>/images/warn_success.png"><?php }?>
			<div class="error_text">
				<h2><?php echo $text;?></h2>
				<p>
					<a href="javascript:;" onclick="window.opener=null;window.open('','_self');window.close();">点击这里，关闭此页</a>
				</p>
			</div>
		</div>		
	</div>
</div>
<script>
//setTimeout("location.href='<?php echo $url;?>';", 3000);
//禁止按键F5、退格
document.onkeydown = function(e){
    e = window.event || e;
    var keycode = e.keyCode || e.which;
    if( keycode = 116 || event.keyCode==8){
        if(window.event){// ie
            try{e.keyCode = 0;}catch(e){}
            e.returnValue = false;
        }else{// ff
            e.preventDefault();
        }
    }
}
</script>
</body>
</html>
