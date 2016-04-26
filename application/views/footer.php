<div class="footer">
	<div class="container">
		<div class="why_left">
			<div class="foot_link_box">

				<div class="foot_link_item">
					<ul>
						<h3><?php echo $val['name'];?></h3>

						<li><a href="<?php echo _BASE_;?>/news/help_center/<?php echo $v['id'];?>"><?php echo $v['name'];?></a></li>

					</ul>
				</div>

			</div>
			<!-- <div class="logo_box">
				<a href="javascript:void(0)"><img src="<?php echo _PUB_DEFAULT_;?>/images/logo.png"/></a>
			</div> -->
			<div class="beian_box">
				<p>互联网药品信息服务资格证书(经营性)  |  
					食品流通许可证  |  国际联网备案证书  |  
					粤ICP备16026761号Copyright © 2016-2017 
					中药网版权所有　</p>
			</div>
			<div class="friend_box">
				<img src="<?php echo _PUB_DEFAULT_;?>/images/friend_box.jpg"/>
			</div>
		</div>
		<div class="why_right">
			<div class="gz_ewm">
				<img src="<?php echo _PUB_DEFAULT_;?>/images/gz_ewm.png"/>
				<p>关注我们</p>
			</div>
		</div>
	</div>
</div>
<div class="topbox">
    <ul>
        <li class="ticon service_ticon5" id="end">
            <a href="<?php echo _BASE_;?>/cart"><span id="cart_num_footer"><?php echo $this->common->cart_goods();?></span>购物车</a>
        </li>
        <li  class="ticon service_ticon2">
            <a href="<?php echo _BASE_;?>/active/coll_goods_list" title="我的收藏">我的收藏</a>
        </li>
        <li  class="ticon service_ticon1">
            <a href="http://wpa.qq.com/msgrd?v=1&uin=147881844&site=中药商城&menu=yes" target="_blank" title="客服QQ" rel="nofollow">在线客服</a>
        </li>
        <li class="ticon service_ticon toTop">
            <a title="返回顶部" href="javascript:void(0)" ></a>
        </li>
    </ul>
</div>