<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="<?php echo _PUB_HOME_;?>/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo _PUB_HOME_;?>/js/jquery.js"></script>
<style>
.forminfo li{
	margin-top: 0px;
	margin-bottom: 10px;
}
.formtitle{
	margin-bottom: 0px;
}
</style>
</head>
<body>
	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="#">首页</a></li>
    </ul>
    </div>
    <div class="mainindex">
    <div class="welinfo">
    <span><img src="<?php echo _PUB_HOME_;?>/images/sun.png" alt="天气" /></span>
    <b><?php echo $info['admin_name']?>，欢迎使用信息管理系统</b>
    </div>
    <div class="welinfo">
    <span><img src="<?php echo _PUB_HOME_;?>/images/time.png" alt="时间" /></span>
    <i>您上次登录的时间：<?php echo date("Y-m-d H:i:s", $info['last_time'])?> | 登陆IP：<?php echo $info['last_ip'];?> | 登陆次数：<?php echo intval($info['vist_num']);?></i>
    </div>
    <div class="xline"></div>
    <ul class="iconlist">
    <div style="float:left; margin-right:40px;">
    <div class="formtitle"><span>订单管理待办：</span></div>
	<div style="overflow:hidden;">
	<ul class="forminfo" style="float:left;">
		<li><label>待支付订单：</label><label><a href="<?php echo _HOME_URL_;?>/order/order_pay_list"><?php echo intval($dzf);?>个</a></label></li>
		<li><label>待发货订单：</label><label><a href="<?php echo _HOME_URL_;?>/order/order_send_list"><?php echo intval($dfh);?>个</a></label></li>
		<li><label style="width: 98px;margin-left: -12px;">15天未收货订单：</label><label><a href="<?php echo _HOME_URL_;?>/order/order_receipt_list"><?php echo intval($wsh);?>个</a></label></li>
		<li><label>退货待初审：</label><label><a href="<?php echo _HOME_URL_;?>/order/order_refund_cs"><?php echo intval($th_cs);?>个</a></label></li>
		<li><label>退货待复审：</label><label><a href="<?php echo _HOME_URL_;?>/order/order_refund_fs"><?php echo intval($th_fs);?>个</a></label></li>
	</ul>
	</div>
	</div>
	<div style="float:left; margin-right:40px;">
	<div class="formtitle"><span>产品管理待办：</span></div>
	<div style="overflow:hidden;">
	<ul class="forminfo" style="float:left;">
		<li><label>待审核产品：</label><label><a href="<?php echo _HOME_URL_;?>/goods/goods_ds"><?php echo intval($goods);?>个</a></label></li>
		<li><label>待开发票：</label><label><a href="<?php echo _HOME_URL_;?>/invoice/invoice_open_list"><?php echo intval($invoice);?>个</a></label></li>
	</ul>
	</div>
	</div>
	<div style="float:left; margin-right:40px;">
	<div class="formtitle"><span>会员信息待办：</span></div>
	<div style="overflow:hidden;">
	<ul class="forminfo" style="float:left;">
		<li><label>商家待初审：</label><label><a href="<?php echo _HOME_URL_;?>/member/seller_ds"><?php echo intval($seller_ds);?>个</a></label></li>
		<li><label>商家待复审：</label><label><a href="<?php echo _HOME_URL_;?>/member/seller_dfs"><?php echo intval($seller_fs);?>个</a></label></li>
		<li><label>会员投诉：</label><label><a href="<?php echo _HOME_URL_;?>/comment/complain"><?php echo intval($complain);?>个</a></label></li>
	</ul>
	</div>
	</div>
</body>

</html>
