<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" href="<?php echo _PUB_HOME_;?>/css/validator.css" type="text/css" />
<script src="<?php echo _PUB_HOME_;?>/js/jquery.js"></script>
<script src="<?php echo _PUB_HOME_;?>/js/functionjs.js"></script>
<script src="<?php echo _PUB_HOME_;?>/js/jvalidator.js"></script>
<script src="<?php echo _PUB_HOME_;?>/js/common.js"></script>

<script src="<?php echo _PUB_HOME_;?>/plugin/artDialog/artDialog.source.js" type="text/javascript"></script>
<script src="<?php echo _PUB_HOME_;?>/plugin/artDialog/iframeTools.source.js" type="text/javascript"></script>

<link rel="stylesheet" href="<?php echo _PUB_HOME_;?>/plugin/ztree/css/ztree.css" type="text/css">
<script type="text/javascript" src="<?php echo _PUB_HOME_;?>/plugin/ztree/js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="<?php echo _PUB_HOME_;?>/plugin/ztree/js/jquery.ztree.core-3.5.js"></script>
<script type="text/javascript" src="<?php echo _PUB_HOME_;?>/plugin/ztree/js/jquery.ztree.excheck-3.5.js"></script>

<script>
var setting = {    
	check:{
		enable:true
	},
	data:{
		simpleData:{
			enable:true
		}
	},
	callback:{
		onClick: onClick,
		onCheck:onCheck
	}
};
var zNodes = <?php echo $arr;?>;

$(document).ready(function(){
	$.fn.zTree.init($("#moduleTree"), setting, zNodes);
});
function onClick(e,treeId, treeNode) {
	var zTree = $.fn.zTree.getZTreeObj("moduleTree");
	zTree.expandNode(treeNode);
}
function onCheck(e,treeId,treeNode){
	var treeObj=$.fn.zTree.getZTreeObj("moduleTree"),
	nodes=treeObj.getCheckedNodes(true),
	v="";
	for(var i=0;i<nodes.length;i++){
		v+=nodes[i].id + ",";
		// alert(nodes[i].id); //获取选中节点的值
	}
	v = v.substring(0, v.length-1);
	$("#moduleId").val(v);
}
</script>
</head>

<body>
<form action="<?php echo _HOME_URL_;?>/sys/module_prev_ok" id="form1" method="post">
<input type="hidden" name="id" value="<?php echo $info['id'];?>" />
<input type="hidden" name="moduleId" id="moduleId" value="<?php echo $info['module'];?>" />
<center><ul id="moduleTree" class="ztree" style="width:550px; height:380px;"></ul></center>
<div class="frmbottom">
	<a class="l-btn" id="subform1" onclick="return commitSave('form1');" href="javascript:;"><span class="l-btn-left"><img src="<?php echo _PUB_HOME_;?>/images/16/accept.png" />确 认</span></a>
	<a class="l-btn" href="javascript:;" onclick="OpenClose();"><span class="l-btn-left"><img src="<?php echo _PUB_HOME_;?>/images/16/cancel.png" />关 闭</span></a>
</div>
</form>
</body>
</html>