<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8"/>
	<meta name="content-type" content="text/html; charset=utf-8" />
	<title><?php echo $this->config->item('seo_title');?></title>
	<meta name="Keywords" content="<?php echo $this->config->item('seo_keywords');?>" />
    <meta name="Description" content="<?php echo $this->config->item('seo_description');?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="renderer" content="webkit">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="baidu-site-verification" content="" />
    <meta name="csrf-token" content="">
    <link rel="Bookmark" type="image/x-icon" href="" />
    <link rel="shortcut icon" type="image/x-icon" href="" />
	<!--************js、css文件引入*************-->
	<link href="<?php echo autoVer('css/main.css');?>" rel="stylesheet" type="text/css"/>
	<link href="<?php echo autoVer('css/index.css');?>" rel="stylesheet" type="text/css"/>
	<script src="<?php echo autoVer('js/jquery.js');?>" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo autoVer('js/jquery1.11.2.js');?>"></script>
	<script src="<?php echo autoVer('js/main.js');?>" type="text/javascript" charset="utf-8"></script>
	<!--<script src="<?php echo autoVer('js/index.js');?>" type="text/javascript" charset="utf-8"></script>-->
</head>
<body>
<?php $this->load->view('header');?>

<!--banner部分html-->
<div class="banner">
	<div class="banner_box">
		<ul class="porlia">
			<?php foreach($roll_img as $key => $val) {?>
			<li style="background: url(<?php echo _FILE_PATH_.'/'.$val['img'];?>) 50% 0 no-repeat;<?php if($key>0)echo 'display: none;';?>">
				<a <?php if($val['adv_url']){?>href="<?php echo $val['adv_url'];?>" target="_blank"<?php }else{?>href="javascript:;"<?php }?>></a>
			</li>
			<?php }?>
		</ul>
	</div>
	<div class="banner_focus container">
		<div class="focus_box">
			<?php foreach($roll_img as $key => $val) {?>
			<span <?php if($key==0)echo 'class="focus_on"';?>></span>
			<?php }?>
		</div>
	</div>
	<script type="text/javascript">
		bannerI($(".banner"),4,'focus_on',3000)
	</script>
</div>	
<!--首页正文html-->
<div class="index_body disnopin">
	<div class="index_body_box container">
		<!--最新成交栏-->
		<div id="Purchase">
			<span class="left_shu">最新成交:</span>
			<ul>
				<?php if($zjcj){foreach($zjcj as $val){?>
				<li>
					<span><?php echo cutStr($val['name'], 10);?></span>
					<span><?php echo $val['goods_weight'];?>g</span>
					<span class="pur_name"><?php echo nameStr($val['username']);?></span>
					<span><?php echo date("Y-m-d", $val['accept_time']);?></span>
				</li>
				<?php }}?>
			</ul>
		</div>
		<!--热卖、当季热卖、种植基地-->
		<div id="hot_sale">
			<div class="why_left hot_sale_left"><!--热卖、当季热卖、种植基地     左侧盒子-->
				<div class="tablenew">
					<ul>
						<li class="tabox">种植基地</li>
						<li class="tabox">当季热卖</li>
						<li class="tabox">热卖药材</li>
						<li class="tablenew_on" id="tablenew_on"></li>
					</ul>
				</div>
				<div class="hot_sale_body" id="mainbodyc">
					<div class="table_item">
						<ul class="towmodule sfqli">
							<?php foreach($zzjd as $key => $val) {?>
							<li class="<?php if($key==0 || $key ==2)echo 'sfqli2';else echo 'sfqli1';?>" >
								<a <?php if($val['adv_url']){?>href="<?php echo $val['adv_url'];?>" target="_blank"<?php }else{?>href="javascript:;"<?php }?>>
									<img src="<?php echo _FILE_PATH_.'/'.$val['img'];?>" alt="" />
								</a>
							</li>
							<?php }?>
						</ul>
					</div>
					<div class="table_item" style="display:none;">
						<ul class="towmodule focuspic">
							<?php foreach($djrm as $key => $val) {?>
							<li class="fpic<?php echo $key+1;?>" >
								<a <?php if($val['adv_url']){?>href="<?php echo $val['adv_url'];?>" target="_blank"<?php }else{?>href="javascript:;"<?php }?>>
									<img src="<?php echo _FILE_PATH_.'/'.$val['img'];?>" alt="" />
								</a>
							</li>
							<?php }?>
						</ul>
					</div>
					<div class="table_item" style="display: none;">
						<ul class="towmodule focuspic frli">
							<?php foreach($rmyc as $key => $val) {?>
							<li class="fpic<?php echo $key+1;?>" >
								<a <?php if($val['adv_url']){?>href="<?php echo $val['adv_url'];?>" target="_blank"<?php }else{?>href="javascript:;"<?php }?>>
									<img src="<?php echo _FILE_PATH_.'/'.$val['img'];?>" alt="" />
								</a>
							</li>
							<?php }?>
						</ul>
					</div>
					<script type="text/javascript">
						tableC($(".hot_sale_left"),".table_top",".table_item",'table_top_on')
					</script>
				</div>
			</div>
			<div class="why_right zx_gg"><!--资讯、公告     右侧盒子-->
				<div class="table_top">
					<ul>
						<li class="table_top_on">资讯</li>
						<li>公告</li>
					</ul>
				</div>
				<div class="zx_gg_body">
					
					<div class="zx_gg_item zx_item">
						<ul>
							<?php foreach($zx as $val){?>
							<li><a href='<?php echo _BASE_;?>/news/news_intro/<?php echo $val['id'];?>' title='<?php echo $val['title'];?>' target="_blank"><?php echo cutStr($val['title'], 18);?></a><span><?php echo date("m-d", $val['addtime']);?></span></li>
							<?php }?>
						</ul>
						<div class="zx_gg_more">
							<a href="<?php echo _BASE_;?>/news/news_list/30" target="_blank">
								<i class="zx_gg_more_l"></i>更多》<i class="zx_gg_more_r"></i>
							</a>
						</div>
					</div>
					<div class="zx_gg_item gg_item" style="display: none;">
						<ul>
							<?php foreach($gg as $val){?>
							<li><a href='<?php echo _BASE_;?>/news/news_intro/<?php echo $val['id'];?>' title='<?php echo $val['title'];?>' target="_blank"><?php echo cutStr($val['title'], 18);?></a><span><?php echo date("m-d", $val['addtime']);?></span></li>
						<?php }?>
						</ul>
						<div class="zx_gg_more">
							<a href="<?php echo _BASE_;?>/news/news_list/31">
								<i class="zx_gg_more_l"></i>更多》<i class="zx_gg_more_r"></i>
							</a>
						</div>
					</div>
					<script type="text/javascript">
						tableC($(".zx_gg"),".table_top",".zx_gg_item",'table_top_on', 'click');
					</script>
				</div>
			</div>
		</div><!--hot_sale闭合节点-->
		<!--1F 常用中药材--><!--1F 常用中药材--><!--1F 常用中药材-->
		<div id="" class="floor_shop">
			<h2>1F&nbsp;&nbsp;常用中药材</h2>
			<ul class="towmodule modflif">
				<?php foreach($yczy as $key => $val) {?>
					<li class="modfli<?php if($key<5)echo $key+1;elseif($key==5)echo '51';else echo '52';?>">
					<a <?php if($val['adv_url']){?>href="<?php echo $val['adv_url'];?>" target="_blank"<?php }else{?>href="javascript:;"<?php }?>>
						<img src="<?php echo _FILE_PATH_.'/'.$val['img'];?>" alt="" />
					</a>
				</li>
				<?php }?>
			</ul>

		</div><!--first_shop闭合节点-->
		<script type="text/javascript">
			bannerI($("#one_f"),3,'floor_focus_on',2000);
		</script>
		<!--2F 动物昆虫药材--><!--2F 动物昆虫药材--><!--2F 动物昆虫药材-->
		<div id="" class="floor_shop">
			<h2>2F&nbsp;&nbsp;动物昆虫药材</h2>
			<div class="floor_shop_box">
				<div class="floor_banner why_left h600pic" id="tow_f">
					<ul>
						<?php foreach($dwkc_roll as $key => $val){?>
						<li <?php if($key>0){?>style="display: none;"<?php }?>>
							<a <?php if($val['adv_url']){?>href="<?php echo $val['adv_url'];?>" target="_blank"<?php }else{?>href="javascript:;"<?php }?>>
							<img src="<?php echo _FILE_PATH_.'/'.$val['img'];?>" alt="" />
							</a>
						</li>
						<?php }?>
					</ul>
					<div class="floor_focus">
						<?php foreach($dwkc_roll as $key => $val){?>
						<span <?php if($key==0)echo 'class="floor_focus_on"';?>></span>
						<?php }?>
					</div>
				</div>
				<ul class="towmodule modflif">
					<?php foreach($dwkc as $key => $val){?>
					<li class="<?php if($key==1 || $key==3)echo 'modfli7';else echo 'modfli6';?>">
						<a <?php if($val['adv_url']){?>href="<?php echo $val['adv_url'];?>" target="_blank"<?php }else{?>href="javascript:;"<?php }?>>
							<img src="<?php echo _FILE_PATH_.'/'.$val['img'];?>" alt="" />
						</a>
					</li>
					<?php }?>
				</ul>
			</div>
		</div><!--second_shop闭合节点-->
		<script type="text/javascript">
			bannerI($("#tow_f"),3,'floor_focus_on',2000);
		</script>
		<!--3F 动物昆虫药材--><!--3F 动物昆虫药材--><!--3F 动物昆虫药材-->
		<div id="" class="floor_shop">
			<h2>3F&nbsp;&nbsp;名贵滋补药材</h2>
			<div class="floor_shop_box">
				<div class="floor_banner why_left h600pic" id="three_f">
					<ul>
						<?php foreach($mgzb_roll as $key => $val){?>
						<li <?php if($key>0){?>style="display: none;"<?php }?>>
							<a <?php if($val['adv_url']){?>href="<?php echo $val['adv_url'];?>" target="_blank"<?php }else{?>href="javascript:;"<?php }?>>
							<img src="<?php echo _FILE_PATH_.'/'.$val['img'];?>" alt="" />
							</a>
						</li>
						<?php }?>
					</ul>
					<div class="floor_focus">
						<?php foreach($mgzb_roll as $key => $val){?>
						<span <?php if($key==0)echo 'class="floor_focus_on"';?>></span>
						<?php }?>
					</div>
				</div>
				<ul class="towmodule modflif">
					<?php foreach($mgzb as $key => $val){?>
					<li class="<?php if($key==1 || $key==3)echo 'modfli7';else echo 'modfli6';?>">
						<a <?php if($val['adv_url']){?>href="<?php echo $val['adv_url'];?>" target="_blank"<?php }else{?>href="javascript:;"<?php }?>>
							<img src="<?php echo _FILE_PATH_.'/'.$val['img'];?>" alt="" />
						</a>
					</li>
					<?php }?>
				</ul>
			</div>
		</div><!--three_shop闭合节点-->
		<script type="text/javascript">
			bannerI($("#three_f"),3,'floor_focus_on',2000);
		</script>
	</div><!--index_body_box闭合节点-->
</div>

<?php $this->load->view('footer');?>

<script>
var newstime = setInterval(newsgoup,2000)
function newsgoup(){
	$("#Purchase ul").animate({top:-36},500,function(){
		$("#Purchase ul").css({top:0});
		$("#Purchase ul li:eq(0)").insertAfter($("#Purchase ul li:last"));
	});
}

$("#Purchase ul li").hover(function(){
	clearInterval(newstime)
},function(){
	newstime = setInterval(newsgoup,2000)
})

movebot();
function movebot(){
	//var t_list = $box.find($table_top).find("li");
	var aBox = document.getElementsByClassName('tabox');
	var oBg = $('#tablenew_on')[0];
	var m_list = $('#mainbodyc .table_item');//.find('.table_item');
	//鼠标经过效果
		$('.tabox').mouseover(function(){
			var n = $('.tabox').index(this);
			//aBox.removeClass($class);
			//aBox.eq(n).addClass($class);
			m_list.hide(0);
			m_list.eq(n).fadeIn(1000);
		})
	
		$('.tabox').click(function(event) {
			var n = $('.tabox').index(this);
			//aBox.removeClass($class);
			//aBox.eq(n).addClass($class);
			m_list.hide(0);
			m_list.eq(n).fadeIn(1000);
		});
	
	var t2 = null;
	
	for(var i=0;i<aBox.length;i++){
		aBox[i].onmouseover = function(){
			startMove( this.offsetLeft );
			clearTimeout(t2);
		};
		aBox[i].onmouseout = function(){
			t2 = setTimeout(function(){
				//startMove( aBox[0].offsetLeft );
			},100);
			
		};
	}
	
	oBg.onmouseover = function(){
		clearTimeout(t2);
	};
	oBg.onmouseout = function(){
		t2 = setTimeout(function(){
			//startMove( aBox[0].offsetLeft );
		},100);
	};
	
}
	

var timer = null;
var iSpeed = 0;

function startMove(iTarget){
	clearInterval(timer);
	timer = setInterval(function(){
		var oBg = $('#tablenew_on')[0];
		iSpeed += (iTarget - oBg.offsetLeft)/6;
		iSpeed *= 0.75;
		
		if( Math.abs(iSpeed)<=1 && Math.abs(iTarget - oBg.offsetLeft)<=1){
			clearInterval(timer);
			oBg.style.left = iTarget + 'px';
			iSpeed = 0;
		}
		else{
			oBg.style.left = oBg.offsetLeft + iSpeed + 'px';
		}
		
	},30);
}
</script>
</body>
</html>
