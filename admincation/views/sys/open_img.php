<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" href="<?php echo _PUB_HOME_;?>/css/validator.css" type="text/css" />
<script src="<?php echo _PUB_HOME_;?>/js/jquery.js"></script>
<script type="text/javascript">
$(function () {
	$(".divicons").click(function () {
		var obj = $(top.document.getElementById('dialog').contentWindow.document.body);
		var src=$(this).find('img').attr('src');
		var value = src.substr(src.lastIndexOf('/')+1);
		obj.find('#imgMenu').attr('src', src);
		obj.find('#img').val(value);
	})
})
</script>
<style type="text/css">
	.divicons {
		float: left;
		border: solid 1px #fff;
		margin: 5px;
		padding-top: 3px;
		padding-left: 5px;
		padding-right: 5px;
		text-align: center;
		cursor: pointer;
		-moz-border-radius: 5px; /* Gecko browsers */
		-webkit-border-radius: 5px; /* Webkit browsers */
		border-radius: 5px; /* W3C syntax */
	}
	.divicons:hover {
		color: #FFF;
		border: solid 1px #ccc;
		background: #F7F7F7;
	}
</style>
</head>
<body>
    <form id="form1" runat="server">
        <input id="hidden_Size" type="hidden" runat="server" />
        <div class="div-body">
            <?php echo $arr;?>
        </div>
    </form>
	<div class="pagin"><?php echo $pagestr;?></div>
</body>
</html>
