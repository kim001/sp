<html>
<head>
<title>无标题文档</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="JavaScript" src="<?php echo _PUB_HOME_;?>/js/jquery.js"></script>
<script language="javascript">
function switchSysBar(){
	var obj = $("#attachucp", window.parent.document);
	if(obj.attr('cols') == '187,10,*') {
		obj.attr('cols', '0,10,*');
		$('#leftbars').css('display', '');
		$('#rightbars').css('display', 'none');
	}
	else {
		obj.attr('cols', '187,10,*');
		$('#leftbars').css('display', 'none');
		$('#rightbars').css('display', '');
	}
}
</script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" leftmargin="0">
<center>
<table height="100%" cellspacing="0" cellpadding="0" border="0" width="100%">
	<tbody>
	<tr>
		<td bgcolor="#009fef" width="1">
		<img height="1" width="1" src="<?php echo _PUB_HOME_;?>/images/ccc.gif"/>
		</td>
		<td id="leftbars" bgcolor="#f5f4f4" style="display: none;">
			<a onClick="switchSysBar()" href="javascript:void(0);">
			<img height="90" border="0" width="9" alt="展开左侧菜单" src="<?php echo _PUB_HOME_;?>/images/pic24.gif"/></a>
		</td>
		<td id="rightbars" bgcolor="#f5f4f4">
			<a onClick="switchSysBar()" href="javascript:void(0);">
			<img height="90" border="0" width="9" alt="隐藏左侧菜单" src="<?php echo _PUB_HOME_;?>/images/pic23.gif"/></a>
		</td>
	</tr>
	</tbody>
</table>
</center>
</body>
</html>