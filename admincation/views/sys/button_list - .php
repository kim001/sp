<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="<?php echo _PUB_HOME_?>/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo _PUB_HOME_;?>/css/select.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo _PUB_HOME_?>/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo _PUB_HOME_;?>/js/select-ui.min.js"></script>
<script type="text/javascript" src="<?php echo _PUB_HOME_;?>/js/common.js"></script>

<script type="text/javascript">
$(document).ready(function(e) {
    $(".select1").uedSelect({
		width : 100			  
	});
	$(".select2").uedSelect({
		width : 120  
	});
	$(".select3").uedSelect({
		width : 100
	});
});
</script>
</head>
<body>
<div class="place">
<span>位置：</span>
<ul class="placeul">
	<li><a href="#">首页</a></li>
	<li><a href="#">系统设置</a></li>
	<li><a href="#">操作按钮</a></li>
</ul>
</div>
<div class="rightinfo">
<div class="tools">
	<ul class="toolbar">
	<a href="javascript:;" onclick="button_add()"><li class="click"><span><img src="<?php echo _PUB_HOME_;?>/images/16/application_form_add.png" /></span>弹出层</li></a>
	<a href="javascript:;" onclick="value()"><li><span><img src="<?php echo _PUB_HOME_;?>/images/16/application_form_edit.png" /></span>获取值</li></a>
	</ul>
	
	<ul class="seachform">
	<li><label>按钮名称</label><input name="keyword" type="text" class="scinput" value="" style="width:200px;" /></li>
	<li style="margin:0"><input type="submit" class="scbtn" value="搜索" /></li>
	</ul>
</div>

<table class="tablelist">
	<thead>
	<tr>
		<th><input name="allCheck" type="checkbox" /></th>
		<th>ID</th>
		<th>编码</th>
		<th>按钮名称</th>
		<th>图标</th>
		<th>排序</th>
		<th>描述</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach($arr as $val){?>
		<tr rel="<?php echo $val['id'];?>">
		<td><input name="idstr" type="checkbox" value="<?php echo $val['id'];?>" /></td>
		<td><?php echo $val['id'];?></td>
		<td><?php echo $val['code'];?></td>
		<td><?php echo $val['name'];?></td>
		<td><?php echo _PIC_PATH_.'/'.$val['img'];?></td>
		<td><?php echo $val['sortnum'];?></td>
		<td><?php echo $val['desc'];?></td>
		</tr> 
	<?php }?>
	</tbody>
</table>

<div class="pagin">
	<div class="message">共<i class="blue">1256</i>条记录，当前显示第&nbsp;<i class="blue">2&nbsp;</i>页</div>
	<ul class="paginList">
	<li class="paginItem"><a href="javascript:;"><span class="pagepre"></span></a></li>
	<li class="paginItem"><a href="javascript:;">1</a></li>
	<li class="paginItem current"><a href="javascript:;">2</a></li>
	<li class="paginItem"><a href="javascript:;">3</a></li>
	<li class="paginItem"><a href="javascript:;">4</a></li>
	<li class="paginItem"><a href="javascript:;">5</a></li>
	<li class="paginItem more"><a href="javascript:;">...</a></li>
	<li class="paginItem"><a href="javascript:;">10</a></li>
	<li class="paginItem"><a href="javascript:;"><span class="pagenxt"></span></a></li>
	</ul>
</div>

</div>
<script>
function button_add() {
	var url = "<?php echo _HOME_URL_;?>/sys/button_add/";
	top.openDialog(url, 'dialog', '操作按钮 - 添加', '650px', '500px', 50, 60);
}
function button_edit() {
	var key = getRowCode();
	if (top.IsEditdata(key)) {
		var url = "<?php echo _HOME_URL_;?>/sys/button_add/"+key;
		top.openDialog(url, 'dialog', '操作按钮 - 修改', '650px', '500px', 50, 60);
	}
}
</script>
</body>
</html>
