<!--头部html-->
<!-- <div class="head_fixed_box"></div> -->
<div id="head_fixed">
	<div class="header">
	<?php if($this->session->userdata('user_id')>0){?>
		<div class="container">
			<div class="why_left">
				<span><?php echo $this->session->userdata('user_name');?>您好！欢迎来到中药材商城，进入<a href="<?php echo _BASE_;?>/member" style="margin-left:0px;">个人中心</a></span>
				<a href="<?php echo _BASE_;?>/user/layout">[安全退出]</a>
			</div>
			<div class="why_right">
				<a href="<?php echo _BASE_;?>/seller/seller_reg">[申请入驻]</a>
				 <a href="http://wpa.qq.com/msgrd?v=1&uin=147881844&site=中药商城&menu=yes" target="_blank" title="客服QQ">客服中心</a>
			</div>
		</div>
	<?php }else{?>
		<div class="container">
			<div class="why_left">
				<span>您好！欢迎来到药材网！</span>
				<a href="<?php echo _BASE_;?>/user/login">[登录]</a>
				<a href="<?php echo _BASE_;?>/user/register">[免费注册]</a>
			</div>
			<div class="why_right">
				<a href="<?php echo _BASE_;?>/seller/seller_reg">[申请入驻]</a>
				<a href="http://wpa.qq.com/msgrd?v=1&uin=147881844&site=中药商城&menu=yes" target="_blank" title="客服QQ">客服中心</a>
			</div>
		</div>
	<?php }?>
	</div>
	<!--logo和搜索栏目-->
	<div class="logo_search">
		<div class="container">
			<div class="why_left logo_box">
				<h1>中药材商城</h1>
				<a href="<?php echo _BASE_;?>"><img src="<?php echo _PUB_DEFAULT_;?>/images/logo.png"/></a>
			</div>
			<div class="why_right over_box">
				<div class="why_left">
					<div class="search_box">
						<form method="get" action="<?php echo _BASE_;?>/goods/goods_list">
							<input type="search" name="name" placeholder="请输入药材名…" class="search_input" autocomplete="off" value="<?php echo $okname;?>" />
							<input type="submit" value="搜索" id="search_btn" />
						</form>
						<ul class="">
							<!--关联搜索-->
							<li></li>
						</ul>
					</div>
					<div class="hot_search">
						<p>热门搜索：
								<a href="<?php echo _BASE_;?>/goods/goods_list?name=<?php echo $val['name'];?>&cate=0&area=0&time=0&order=0"><?php echo $val['name'];?></a>
						</p>
					</div>
				</div>
				<div class="why_right paycar_box">
				<a href="<?php echo _BASE_;?>/cart">
					<i class="paycar_img"></i>
					<p>购物车  <span id="cart_num_header"></span>  件 </p>
					<i class="paycar_right"></i>
				</a>
				</div>
				
			</div>
		</div>
	</div>
</div>

<!--导航html-->
<div class="nav" id="topnav">
	<div class="container">
		<div class="why_left">
			<div class="all_pro">
				<h2>全部商品分类</h2>
				<div class="all_pro_box">

					<dl>
						<dt class="pro_item<?php echo $key+1;?>"></dt>
						<dd>
							<h3><a href=""><?php echo $val['cate_name'];?></a></h3>
							<p>
							</p>
							<div class="all_pro_item">
								<ul>

                                    <li><a target="_blank" href="<?php echo _BASE_;?>/goods/goods_list?name=<?php echo $name;?>&cate=<?php echo $v['id'];?>&area=<?php echo $area;?>&time=<?php echo $time;?>&order=<?php echo $order;?>"><?php echo $v['cate_name'];?></a></li>

                                    <li><a href="<?php echo _BASE_;?>/goods/goods_list" style="color:#6593cf">更多>></a></li>
                                </ul>
							</div>
						</dd>
					</dl>

				</div>
			</div>
		</div>
		<div class="why_left">
			<ul class="nav_ul">
				<li <?php if($headerNav=='index')echo 'class="nav_li_on"';?>><a href="<?php echo _BASE_;?>">首页</a></li>
				<li <?php if($headerNav=='goods')echo 'class="nav_li_on"';?>><a href="<?php echo _BASE_;?>/goods/goods_list">药材大全</a></li>
				<li><a href="javacript:;" onclick="javascript:alert('开发中')">理财产品</a></li>
				<li <?php if($headerNav=='supply')echo 'class="nav_li_on"';?>><a href="<?php echo _BASE_;?>/supply/supply_app">申请供应</a></li>
				<li <?php if($headerNav=='seller_reg')echo 'class="nav_li_on"';?>><a href="<?php echo _BASE_;?>/seller/seller_reg">商家入驻</a></li>
				<!-- <li><a href="">用户中心</a></li> -->
			</ul>
		</div>
	</div>
	<div class="banner_border"></div>
</div>