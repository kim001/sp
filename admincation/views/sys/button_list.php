<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="<?php echo _PUB_HOME_?>/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo _PUB_HOME_;?>/css/select.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo _PUB_HOME_?>/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo _PUB_HOME_;?>/js/common.js"></script>

</head>
<body>
<div class="place">
<span>位置：</span>
<ul class="placeul">
	<li><a href="<?php echo _HOME_URL_;?>" target="_top">首页</a></li>
	<li>系统设置</li>
	<li>操作按钮</li>
</ul>
</div>
<div class="rightinfo">
<div class="tools">
	<ul class="toolbar">
		<?php foreach($prev as $val){?>
		<a href="javascript:;" onclick="<?php echo $val['event'];?>"><li><span><img src="<?php echo _PUB_HOME_;?>/images/16/<?php echo $val['img'];?>" /></span><?php echo $val['name'];?></li></a>
		<?php }?>
	</ul>

	<form method="get" action="<?php echo _HOME_URL_;?>/sys/button" id="searchForm">
	<ul class="seachform">
		<li><label>按钮名称</label><input name="keyword" type="text" class="scinput" value="<?php echo $serach['keyword'];?>" style="width:200px;" /></li>
		<li style="margin:0"><input type="submit" class="scbtn" value="搜索" /></li>
	</ul>
	</form>
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
		<td><img src="<?php echo _PUB_HOME_.'/images/16/'.$val['img'];?>" /></td>
		<td><?php echo $val['sortnum'];?></td>
		<td><?php echo $val['desc'];?></td>
		</tr> 
	<?php }?>
	</tbody>
</table>

<div class="pagin"><?php echo $pagestr;?></div>

</div>
<script>
function add() {
	var url = "<?php echo _HOME_URL_;?>/sys/button_add";
	top.openDialog(url, 'dialog', '操作按钮 - 添加', '650px', '500px', 50, 60);
}
function edit() {
	var key = getRowCode();
	if (top.IsEditdata(key)) {
		var url = "<?php echo _HOME_URL_;?>/sys/button_add/"+key;
		top.openDialog(url, 'dialog', '操作按钮 - 修改', '650px', '500px', 50, 60);
	}
}
function del() {
	var key = getCheckRowValue();
	if (top.IsDelData(key)) {
		var url = "<?php echo _HOME_URL_;?>/sys/button_del";
		var delparm = "param="+key;
		var count = $('input[name="idstr"]:checked').length;
		top.delConfig(url, delparm, count);
	}
}
</script>
</body>
</html>
