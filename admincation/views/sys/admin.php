<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="<?php echo _PUB_HOME_;?>/css/style.css" rel="stylesheet" type="text/css" />
<script src="<?php echo _PUB_HOME_;?>/js/jquery.js"></script>
<script src="<?php echo _PUB_HOME_;?>/js/common.js"></script>
</head>
<body>
<div class="place">
<span>位置：</span>
<ul class="placeul">
	<li><a href="<?php echo _HOME_URL_;?>" target="_top">首页</a></li>
	<li><a>系统设置</a></li>
	<li>管理员管理</li>
</ul>
</div>
<div class="rightinfo">
	<div class="tools">
		<ul class="toolbar">
		<?php foreach($prev as $val){?>
		<a href="javascript:;" onclick="<?php echo $val['event'];?>"><li><span><img src="<?php echo _PUB_HOME_;?>/images/16/<?php echo $val['img'];?>" /></span><?php echo $val['name'];?></li></a>
		<?php }?>
		</ul>
		<form method="get" action="<?php echo _HOME_URL_;?>/sys/admin" id="searchForm">
		<ul class="seachform">
			<li><label>管理员帐号</label><input name="keyword" type="text" class="scinput" value="<?php echo $serach['keyword'];?>" style="width:200px;" /></li>
			<li style="margin:0"><input type="submit" class="scbtn" value="搜索" /></li>
		</ul>
		</form>
	</div>
	<table class="tablelist">
		<thead>
		<tr>
			<th width=50><input name="allCheck" type="checkbox" /></th>
			<th width=80>ID编号</th>
			<th width=120>帐号</th>
			<th width=200>真实姓名</th>
			<th width=150>所属角色</th>
			<th width=110>联系方式</th>
			<th width=100>访问次数</th>
			<th width=150>上次访问时间</th>
			<th width=150>上次访问IP</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($arr as $key => $val){?>
		<tr rel="<?php echo $val['id'];?>">
			<td><input name="idstr" type="checkbox" value="<?php echo $val['id'];?>" /></td>
			<td><?php echo $val['id'];?></td>
			<td><?php echo $val['admin_name'];?></td>
			<td><?php echo $val['realname'];?></td>
			<td><?php echo $val['name'];?></td>
			<td><?php echo $val['mobile'];?></td>
			<td><?php echo intval($val['vist_num']);?>次</td>
			<td><?php echo isset($val['last_time']) ? date("Y-m-d H:i:s", $val['last_time']) : '无';?></td>
			<td><?php echo isset($val['last_ip']) ? $val['last_ip'] : '无';?></td>
		</tr> 
		<?php }?>    
		</tbody>
	</table>
	<div class="pagin"><?php echo $pagestr;?></div>
</div>
<script type="text/javascript">
function add() {
	var url = "<?php echo _HOME_URL_;?>/sys/admin_add";
	top.openDialog(url, 'dialog', '管理员管理 - 添加', '650px', '500px', 50, 60);
}
function edit() {
	var key = getRowCode();
	if (top.IsEditdata(key)) {
		var url = "<?php echo _HOME_URL_;?>/sys/admin_add/"+key;
		top.openDialog(url, 'dialog', '管理员管理 - 编辑', '650px', '500px', 50, 60);
	}
}
function del() {
	var key = getCheckRowValue();
	if (top.IsDelData(key)) {
		var url = "<?php echo _HOME_URL_;?>/sys/admin_del";
		var delparm = "param="+key;
		var count = $('input[name="idstr"]:checked').length;
		top.delConfig(url, delparm, count);
	}
}
</script>
</body>
</html>
