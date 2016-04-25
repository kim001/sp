<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Content-type: text/html; charset=utf-8");
class Spindex extends SP_Controller
{
    protected $sp_admin = 0;
	function __construct() {
		parent::__construct();
		//$this->load->model("common");
		//$this->load->helper("func");
		//$this->load->helper('file');
		//$this->load->library('session');
	}
    function index() {
        $this->init(); //登录判断
        $this->load->view('spindex/index');
    }
	function login() {
		//$sp_admin = $this->session->userdata('admin_id');
		//if(!empty($sp_admin) || $sp_admin > 0) {
			//jsGourl(_HOME_URL_);
			//exit;
		//}
		$this->load->view('spindex/login');
	}
	function login_ok() {
		if(IS_POST == 'POST') {
			$tname = $this->input->post('tname', true);
			$tpwd = $this->input->post('tpwd');
			$tpwd = md5Str($tpwd);
			$info = $this->common->findOne('admin', "admin_name='$tname' and admin_pwd='$tpwd'");
			if($info) {

				$addnum = $info['vist_num']+1;
				$data_time = gmtime();
				$data_ip = real_ip();
				$admin_arr = array(
					'last_time' => $data_time,
					'last_ip' => $data_ip,
					'vist_num' => $addnum
				);
				$this->common->upd('admin', $admin_arr, 'id='.$info['id']);

				$session_arr = array(
					'sp_admin'  => $info['id'],
					'admin_name' => $info['admin_name'],
					'role_id' => $info['role_id']
				);
				$this->session->set_userdata($session_arr);
				showMsg(_HOME_URL_);
				//exit;
			}
			else {
				$message = Array(
					'msg' => '用户名或密码错误，系统正在返回...',
					'url' => _HOME_URL_.'/spindex/login'
				);
				$this->common->messages($message, 3);
			}
		}
	}
	function logout() {
		$session_arr = array(
			'sp_admin'  => '',
			'admin_name' => '',
			'role_id' => ''
		);
		$this->session->unset_userdata($session_arr);
		$this->session->sess_destroy();
		showMsg(_HOME_URL_.'/spindex/login');
	}

	function main() {
		$this->init();
		$this->load->view('spindex/main');
	}
	function top() {
		$this->init();
		$role_id = $this->session->userdata('role_id');

		$data['arr'] = $this->topMenu($role_id);
		$this->load->view('spindex/top', $data);
	}
	function left() {
		$this->init();
		$role_id = $this->session->userdata('role_id');
		$top = $this->topMenu($role_id);
		$role = $this->common->findOne('role', 'id='.$role_id, 'module');
		$where = inWhereByField('pid', $top);
		//默认打开第一个权限栏目
		$arr = array();
		$data['arr'] = array();
		if($role['module']) {
			$tarr = $this->common->findAll('module', "pid='".$top[0]['id']."' and id in (".$role['module'].")", '*', 'sortnum desc, id asc');
			foreach($tarr as $val) {
				$thisarr[] = $val['id'];
			}
			$data['thisarr'] = $thisarr;
			$arr = $this->common->findAll('module', $where, '*', 'sortnum desc, id asc');
			foreach($arr as $key => $val) {
				$arr[$key]['next'] = $this->common->findAll('module', "pid='".$val['id']."' and id in (".$role['module'].")", '*', 'sortnum desc, id asc');
			}
			$data['arr'] = $arr;
		}
		$this->load->view('spindex/left', $data);
	}
	function swich() {
		$this->init();
		$this->load->view('spindex/swich');
	}
	function right() {
		$this->init();
		$data = array();
		$data['info'] = $this->common->findOne('admin', 'id='.$this->sp_admin);
		//待支付订单
		$data['dzf'] = 0;//$this->common->counts('order', 'pay_status=0 and status=1');
		//待发货订单
		$data['dfh'] = 0;//$this->common->counts('order', 'pay_status=1 and status=2 and (distribution_status=0 or distribution_status=2)');
		//15天未收货订单
		$time = gmtime();
		$data['wsh'] = 0;//$this->common->counts('order', "pay_status=1 and order.status=2 and distribution_status=1 and (send_time+'1296000'<'".$time."')");
		//退货待初审
		$data['th_cs'] = 0;//$this->common->counts('order_refund', 'status=0');
		//退货待复审
		$data['th_fs'] = 0;//$this->common->counts('order_refund', 'status=1');
		
		//产品待审核
		$data['goods'] = 0;//$this->common->counts('goods', 'is_ok=0');
		//待开发票	
		$data['invoice'] = 0;//$this->common->counts('invoice', 'status=0');
		
		//商家待初审
		$data['seller_ds'] = 0;//$this->common->counts('seller', 'is_ok=0');
		//商家待复审
		$data['seller_fs'] = 0;//$this->common->counts('seller', 'is_ok=3');
		//会员投诉
		$data['complain'] = 0;//$this->common->counts('complain', 'admin_id=0');

		$this->load->view('spindex/right', $data);
	}
	protected function topMenu($role_id)
	{
		$arr = array();
		$role = $this->common->findOne('role', 'id='.$role_id, 'module');

		if($role['module'])
			$arr = $this->common->findAll('module', "pid=0 and id in (".$role['module'].")", '', 'sortnum desc, id asc');

		return $arr;
	}
    protected function init() {
		$sp_admin = $this->session->userdata('sp_admin');
        if(empty($sp_admin) || $sp_admin <= 0) {
            showMsg(_HOME_URL_.'/spindex/login', 'top');
            exit;
        }
        $this->sp_admin = $sp_admin;
    }
}
