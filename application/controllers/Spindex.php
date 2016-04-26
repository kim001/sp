<?php
defined('BASEPATH') OR exit('Not allowed');
header("Content-type: text/html; charset=utf-8");
class Spindex extends SP_Controller
{
	function __construct() {
		parent::__construct();
	}
	function index() {
        $data = array();
        /*
		//滚动图
		$roll_img = $this->common->findAll('adv', 'url_type=0 and is_open=1 and type_id=5', 'img, adv_url', 'id asc', 4);
		$data['roll_img'] = $roll_img;
		//种植基地
		$zzjd = $this->common->findAll('adv', 'url_type=0 and is_open=1 and type_id=6', 'img, adv_url', 'id asc', 4);
		$data['zzjd'] = $zzjd;
		//当季热卖
		$djrm = $this->common->findAll('adv', 'url_type=0 and is_open=1 and type_id=7', 'img, adv_url', 'id asc', 3);
		$data['djrm'] = $djrm;
		//热卖药材
		$rmyc = $this->common->findAll('adv', 'url_type=0 and is_open=1 and type_id=8', 'img, adv_url', 'id asc', 3);
		$data['rmyc'] = $rmyc;
		//常用中药材
		$yczy = $this->common->findAll('adv', 'url_type=0 and is_open=1 and type_id=9', 'img, adv_url', 'id asc', 7);
		$data['yczy'] = $yczy;
		//动物昆虫药材
		$dwkc = $this->common->findAll('adv', 'url_type=0 and is_open=1 and type_id=10', 'img, adv_url', 'id asc', 6);
		$data['dwkc'] = $dwkc;
		//名贵滋补药材
		$mgzb = $this->common->findAll('adv', 'url_type=0 and is_open=1 and type_id=11', 'img, adv_url', 'id asc', 6);
		$data['mgzb'] = $mgzb;
		//动物昆虫药材滚动图
		$dwkc_roll = $this->common->findAll('adv', 'url_type=0 and is_open=1 and type_id=12', 'img, adv_url', 'id asc', 3);
		$data['dwkc_roll'] = $dwkc_roll;
		//名贵滋补药材滚动图
		$mgzb_roll = $this->common->findAll('adv', 'url_type=0 and is_open=1 and type_id=13', 'img, adv_url', 'id asc', 3);
		$data['mgzb_roll'] = $mgzb_roll;

		//资讯公告
		$data['zx'] = $this->common->findAllRedis('art', "type_id=30 and is_ok=1", 'id, title, addtime', 'is_top desc, sortnum desc, id desc', '11');	//资讯
		$data['gg'] = $this->common->findAllRedis('art', "type_id=31 and is_ok=1", 'id, title, addtime', 'is_top desc, sortnum desc, id desc', '11');	//公告
		
		//最近成交
		$join = Array(
			'goods' => 'order_goods.goods_id=goods.id',
			'order' => 'order_goods.order_id=order.id',
			'user' => 'order.user_id=user.id'
		);
		$data['zjcj'] = $this->common->findAllJoin('order_goods', $join, 'order.status=5', $field = 'goods.name, username, order_goods.goods_weight, order.accept_time', 'order.accept_time desc, order.id desc', 5);
         */
		$this->load->view('index', $data);
	}
}