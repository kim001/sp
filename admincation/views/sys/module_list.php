<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="<?php echo _PUB_HOME_?>/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo _PUB_HOME_;?>/plugin/treetable/css/jquery.treetable.css" rel="stylesheet" type="text/css" />
<link href="<?php echo _PUB_HOME_;?>/plugin/treetable/css/jquery.treetable.theme.default.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="<?php echo _PUB_HOME_?>/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo _PUB_HOME_;?>/js/common.js"></script>

</head>
<body>
<div class="place">
<span>位置：</span>
<ul class="placeul">
	<li><a href="<?php echo _HOME_URL_;?>" target="_top">首页</a></li>
	<li>系统设置</li>
	<li>模块管理</li>
</ul>
</div>
<div class="rightinfo">
<div class="tools">
	<ul class="toolbar">
		<?php foreach($prev as $val){?>
		<a href="javascript:;" onclick="<?php echo $val['event'];?>"><li><span><img src="<?php echo _PUB_HOME_;?>/images/16/<?php echo $val['img'];?>" /></span><?php echo $val['name'];?></li></a>
		<?php }?>
	</ul>
</div>

<table class="tablelist">
	<thead>
	<tr>
		<th width=300>模块名称</th>
		<th width=80>ID</th>
		<th width=150>模块编号</th>
		<th width=100>连接目标</th>
		<th width=150>连接地址</th>
		<th width=80>排序</th>
	</tr>
	</thead>
	<tbody>
	<?php echo $module_list;?>
	</tbody>
</table>
</div>
<script src="<?php echo _PUB_HOME_;?>/plugin/treetable/js/jquery.js"></script>
<script src="<?php echo _PUB_HOME_;?>/plugin/treetable/js/jquery.treetable.js"></script>
<script>
$(".tablelist").treetable({ expandable: true });
jQuery('.tablelist').treetable('expandAll');

function add() {
	var url = "<?php echo _HOME_URL_;?>/sys/module_add";
	top.openDialog(url, 'dialog', '模块管理 - 添加', '650px', '500px', 50, 60);
}
function edit() {
	var key = getRowCode();
	if (top.IsEditdata(key)) {
		var url = "<?php echo _HOME_URL_;?>/sys/module_add/"+key;
		top.openDialog(url, 'dialog', '模块管理 - 修改', '650px', '500px', 50, 60);
	}
}
function del() {
	var key = getRowCode();
	if (top.IsEditdata(key)) {
		var url = "<?php echo _HOME_URL_;?>/sys/module_del";
		var delparm = "param="+key;
		var count = 1;
		top.delConfig(url, delparm, count);
	}
}
function set_button() {
	var key = getRowCode();
	if (top.IsEditdata(key)) {
		var url = "<?php echo _HOME_URL_;?>/sys/set_button/"+key;
		top.openDialog(url, 'dialog', '模块管理 - 分配按钮', '620px', '500px', 50, 60);
	}
}
</script>
</body>
</html>
