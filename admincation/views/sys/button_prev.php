<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" href="<?php echo _PUB_HOME_;?>/css/validator.css" type="text/css" />
<script src="<?php echo _PUB_HOME_;?>/js/jquery.js"></script>
<script src="<?php echo _PUB_HOME_;?>/js/common.js"></script>

<script src="<?php echo _PUB_HOME_;?>/js/functionjs.js"></script>
<script src="<?php echo _PUB_HOME_;?>/js/jvalidator.js"></script>

<script src="<?php echo _PUB_HOME_;?>/plugin/artDialog/artDialog.source.js" type="text/javascript"></script>
<script src="<?php echo _PUB_HOME_;?>/plugin/artDialog/iframeTools.source.js" type="text/javascript"></script>

<link rel="stylesheet" href="<?php echo _PUB_HOME_;?>/plugin/ztree/css/ztree.css" type="text/css">
<script type="text/javascript" src="<?php echo _PUB_HOME_;?>/plugin/ztree/js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="<?php echo _PUB_HOME_;?>/plugin/ztree/js/jquery.ztree.core-3.5.js"></script>
<script type="text/javascript" src="<?php echo _PUB_HOME_;?>/plugin/ztree/js/jquery.ztree.excheck-3.5.js"></script>
<style>
.checktext {
	width: 80px;
}
</style>
<script>
$(function () {
	divresize('.ScrollBar', 125);
	$("#div_Application").hide();
})
//保存事件
function commitSave() {
	var item = "";
	$('.ScrollBar div').find(".checkbuttonOk").each(function () {
		item += $(this).find('.checktext').attr('id') + ",";
	});
	$("#hiddenButton").val(item);
	$('#form1').submit();
	$('#sub').removeAttr('onclick');
}

var setting = {    
	data:{
		simpleData:{
			enable:true
		}
	},
};
var zNodes = <?php echo $module;?>;
$(document).ready(function(){
	$.fn.zTree.init($("#moduleTree"), setting, zNodes);
});
function showButton(id) {
	$.ajax({
	 type: "POST",
	 url: "<?php echo _HOME_URL_;?>/sys/show_button",
	 data: {id:id},
	 async: false,
	 success: function(msg) {
		var obj = eval("("+msg+")");
		var divObj = $("#div_toolbar").children();
		divObj.each(function (i) {
			$(this).css('display', 'none');
			for(j = 0; j < obj.length; j++) {
				var thisId = 'button'+id+'-'+obj[j];
				if($(this).attr('id') == thisId)
					$("#"+thisId).css('display', '');
			}
		})
	 }
 })
}
</script>
</head>
<body>
<form action="<?php echo _HOME_URL_;?>/sys/button_prev_ok" id="form1" method="post">
<input type="hidden" name="id" value="<?php echo $info['id'];?>" />
<input id="hiddenButton" name="hiddenButton" type="hidden" />
<ul id="moduleTree" class="ztree" style="width:200px; height:380px; float:left"></ul>
<div class="bd" style="width:480px; float:right; height:392px; margin-top: 10px;">
	<div class="ScrollBar" style="padding: 5px; height:365px;">
		<div id="div_toolbar">
		<?php foreach($all as $key => $val){?>
			<div title="<?php echo $val['name'];?>" <?php if($button[$val['module']] && in_array($val['id'], $button[$val['module']])){?>class="checkbuttonOk panelcheck"<?php }else{?>class="checkbuttonNo panelcheck"<?php }?> id="<?php echo 'button'.$val['module'].'-'.$val['id'];?>">
				<div id="<?php echo $val['module'].'-'.$val['id'];?>" class="checktext"><img src="<?php echo _PUB_HOME_.'/images/16/'.$val['img'];?>" /><?php echo $val['name'];?></div>
				<div  <?php if($button[$val['module']] && in_array($val['id'], $button[$val['module']])){?>class="triangleOk"<?php }else{?>class="triangleNo"<?php }?>></div>
			</div>
		<?php }?>
		</div>
		<div>&nbsp;&nbsp;&nbsp;</div>
	</div>
</div>

<div class="frmbottom">
	<a class="l-btn" id="subform1" onclick="return commitSave('form1');" href="javascript:;"><span class="l-btn-left"><img src="<?php echo _PUB_HOME_;?>/images/16/accept.png" />确 认</span></a>
	<a class="l-btn" href="javascript:;" onclick="OpenClose();"><span class="l-btn-left"><img src="<?php echo _PUB_HOME_;?>/images/16/cancel.png" />关 闭</span></a>
</div>
</form>
<script>
showButton(<?php echo $arr[0]['id']?>);
</script>
</body>
</html>