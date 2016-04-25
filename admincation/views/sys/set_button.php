<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" href="<?php echo _PUB_HOME_;?>/css/validator.css" type="text/css" />
<script src="<?php echo _PUB_HOME_;?>/js/jquery.js"></script>
<script src="<?php echo _PUB_HOME_;?>/plugin/artDialog/artDialog.source.js" type="text/javascript"></script>
<script src="<?php echo _PUB_HOME_;?>/plugin/artDialog/iframeTools.source.js" type="text/javascript"></script>
<script src="<?php echo _PUB_HOME_;?>/js/functionjs.js"></script>
<script>
$(function () {
	divresize('.ScrollBar', 140);
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
</script>
<style>
.checktext {
	width: 70px;
}
</style>
</head>
<body>
    <form id="form1" action="<?php echo _HOME_URL_;?>/sys/set_button_ok" method="post">
        <input type="hidden" name="id" value="<?php echo $info['id'];?>" />
		<input type="hidden" id="hiddenButton" name="hiddenButton" />
        <div class="WarmPrompt-Info">
            <img src="<?php echo _PUB_HOME_;?>/images/32/status_online.png" style="width: 32px; height: 32px; vertical-align: middle; margin-bottom: 4px;" />
            想拥有操作按钮（请点击勾选）
        </div>
        <div class="bd">
            <div class="ScrollBar" style="padding: 5px;">
                <div id="div_toolbar">
				<?php foreach($arr as $key => $val){?>
                    <div title="<?php echo $val['name'];?>" <?php if(in_array($val['id'], $button)){?>class="checkbuttonOk panelcheck"<?php }else{?>class="checkbuttonNo panelcheck"<?php }?>>
						<div id="<?php echo $val['id'];?>" class="checktext"><img src="<?php echo _PUB_HOME_.'/images/16/'.$val['img'];?>" /><?php echo $val['name'];?></div>
						<div  <?php if(in_array($val['id'], $button)){?>class="triangleOk"<?php }else{?>class="triangleNo"<?php }?>></div>
					</div>
				<?php }?>
                </div>
                <div>&nbsp;&nbsp;&nbsp;</div>
            </div>
        </div>
        <div class="frmbottom" style="margin-top:-30px;">
			<a class="l-btn" id="subform1" onclick="commitSave();" href="javascript:;"><span class="l-btn-left"><img src="<?php echo _PUB_HOME_;?>/images/16/accept.png" />确 认</span></a>
			<a class="l-btn" href="javascript:;" onclick="OpenClose();"><span class="l-btn-left"><img src="<?php echo _PUB_HOME_;?>/images/16/cancel.png" />关 闭</span></a>
		</div>
    </form>
</body>
</html>
