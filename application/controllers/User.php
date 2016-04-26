<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Content-type: text/html; charset=utf-8");
class User extends SP_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('userm');
	}
	function index() {
		echo $this->session->userdata('forget_yzm');
	}
	/*判断会员是否登陆
	 *Khd
	 */
	protected function user_init() {
		if(intval($this->session->userdata('user_id'))>0) {
			jsGourl(_BASE_.'/member');
		}
		else {
			if(intval(get_cookie('user_id_cookie')>0)) {
				$user = Array(
					'user_id' => get_cookie('user_id_cookie'),
					'user_name' => get_cookie('user_name_cookie')
				);
				$this->session->set_userdata($user);
				jsGourl(_BASE_.'/member');
			}
		}
	}
	/*会员注册
	 *Khd
	 */
	function register() {
		$this->user_init();
		$this->load->view('user/register');
	}
	/*注册Ajax验证
	 *Khd
	 */
	function regAjax() {
		if(IS_POST == 'POST') {
			$name  = $this->input->post('name', true);
			$param = $this->input->post('param', true);
			$ret = $this->userm->regValid($name, $param);
			echo $this->myjson->encode($ret);
		}
	}
	function register_ok() {
		if(IS_POST == 'POST') {
			$mobile = $this->input->post('mobile', true);
			if(!isMobile($mobile)) {
				die($this->lang->line('fail'));
			}
			$reg_mobile = get_cookie('reg_mobile');
			if($mobile != $reg_mobile) {
				die($this->lang->line('fail'));
			}
			$ret = $this->userm->regValid('mobile', $mobile);
			if($ret['status'] == 'n') {
				jsGourl(_BASE_.'/user/register', 'self', $this->lang->line('reg_mobile_error'));
				exit;
			}
			$username = $this->input->post('username', true);
			$ret = $this->userm->regValid('username', $username);
			if($ret['status'] == 'n') {
				jsGourl(_BASE_.'/user/register', 'self', $this->lang->line('reg_username_error'));
				exit;
			}
			$code = $this->input->post('code', true);
			$ret = $this->userm->regValid('code', $code);
			if($ret['status'] == 'n') {
				jsGourl(_BASE_.'/user/register', 'self', $this->lang->line('yzm_error'));
				exit;
			}
			$tpwd = md5Str($_POST['pwd1']);
			$user = array(
				'username' => $username,
				'password' => $tpwd,
				'mobile'   => $mobile,
				'account' => 0,
				'frozen_account' => 0,
				'item_money' => 0
			);
			$this->common->add('user', $user);
			$user_id = $this->common->w_db->insert_id();
			$time = gmtime();
			$data_time = date("Y-m-d H:i:s");
			$data_ip = real_ip();
			$user_per = array(
				'user_id'	 => $user_id,
				'addtime'	 => $time,
				'last_login' => $data_time,
				'last_ip' => $data_ip
			);
			$this->common->add('user_per', $user_per);
			//保存会员信息
			$sessArr = array(
				'user_id'  => $user_id,
				'user_name' => $username
			);
			$this->session->set_userdata($sessArr);
			//清空session
			$unsess = array(
				'yzm' => ''
			);
			$this->session->unset_userdata($unsess);
			delete_cookie('reg_mobile');
			delete_cookie('reg_yzm');
			delete_cookie('reg_minue');

			delete_cookie('forget_mobile');
			delete_cookie('forget_yzm');
			delete_cookie('forget_minue');

			jsGourl(_BASE_.'/member');
		}
	}
	/*会员登陆
	 *Khd
	 */
	function login($ret_url='') {
		$this->user_init();
		$data['ret_url'] = $ret_url;
		$this->load->view('user/login', $data);
	}
	/*登陆Ajax验证
	 *Khd
	 */
	function loginAjax($type) {
		if(IS_POST == 'POST') {
			if($type == 'pwd') {
				$tname = $this->input->post('tname', true);

				$tpwd  = $_POST['tpwd'];
				$param = array(
					'tname' => $tname,
					'tpwd'	=> $tpwd
				);
			}
			else {
				$param = $this->input->post('param', true);
			}
			$ret = $this->userm->loginValid($type, $param);
			echo $this->myjson->encode($ret);
		}
	}
	function login_ok() {
		if(IS_POST == 'POST') {
			$tname = $this->input->post('tname', true);
			$ret = $this->userm->loginValid('tname', $tname);
			if($ret['status'] == 'n') {
				die($ret['info']);
			}
			$tpwd = $_POST['tpwd'];
			$tname_tpwd = array('tname' => $tname, 'tpwd' => $tpwd);
			$ret = $this->userm->loginValid('tpwd', $tname_tpwd);
			if($ret['status'] == 'n') {
				die($ret['info']);
			}
			$yzm = $this->input->post('yzm', true);
			$ret = $this->userm->loginValid('yzm', $yzm);
			if($ret['status'] == 'n') {
				die($ret['info']);
			}
			$info = $this->common->findOne('user', "password='".md5Str($tpwd)."' and (username='".$tname."' or mobile='".$tname."')");
			if($info['status']>0) {
				jsGourl(_BASE_.'/user/login', 'self', $this->lang->line('login_error'));
				exit;
			}
			$data_time = date("Y-m-d H:i:s");
			$data_ip = real_ip();
			$user_per = array(
				'last_login' => $data_time,
				'last_ip' => $data_ip
			);
			$this->common->upd('user_per', $user_per, 'user_id='.$info['id']);

			//保存会员信息
			$session_arr = array(
				'user_id'  => $info['id'],
				'user_name' => $info['username']
			);
			$this->session->set_userdata($session_arr);

			if(intval($_POST['is_auto']) == 1) {
				set_cookie('user_id_cookie', $info['id'], 604800);	//一周
				set_cookie('user_name_cookie', $info['username'], 604800);
			}
			//清空session
			$unsess = array(
				'yzm' => ''
			);
			$this->session->unset_userdata($unsess);
			delete_cookie('reg_mobile');
			delete_cookie('reg_yzm');
			delete_cookie('reg_minue');

			delete_cookie('forget_mobile');
			delete_cookie('forget_yzm');
			delete_cookie('forget_minue');

			$ret_url = sys_auth($_POST['ret_url'], 'DECODE');
			if($ret_url) {
				jsGourl($ret_url);
			}
			else {
				jsGourl(_BASE_.'/member');
			}
		}
	}
	/*退出
	 *Khd
	 */
	function layout() {
		//清空session
		$session_arr = array(
			'user_id'  => '',
			'user_name' => '',
			'yzm' => ''
		);
		$this->session->unset_userdata($session_arr);
		$this->session->sess_destroy();
		//删除cookie
		delete_cookie('user_id_cookie');
		delete_cookie('user_name_cookie');

		delete_cookie('reg_mobile');
		delete_cookie('reg_yzm');
		delete_cookie('reg_minue');

		delete_cookie('forget_mobile');
		delete_cookie('forget_yzm');
		delete_cookie('forget_minue');

		delete_cookie('telupd1_mobile');
		delete_cookie('telupd1_yzm');
		delete_cookie('telupd1_minue');

		delete_cookie('telupd2_mobile');
		delete_cookie('telupd2_yzm');
		delete_cookie('telupd2_minue');
		jsGourl(_BASE_.'/user/login');
	}
	/*忘记密码
	 *Khd
	 */
	function forget() {
		$this->user_init();
		$this->load->view('user/forget');
	}
	function forget_ok() {
		if(IS_POST == 'POST') {
			$mobile = $this->input->post('mobile', true);
			if(!isMobile($mobile)) {
				die($this->lang->line('fail'));
			}
			$forget_mobile = get_cookie('forget_mobile');
			if($mobile != $forget_mobile) {
				die($this->lang->line('fail'));
			}
			$ret = $this->userm->forgetValid('mobile', $mobile);
			if($ret['status'] == 'n') {
				jsGourl(_BASE_.'/user/forget', 'self', $ret['forget_error']);
				exit;
			}
			$code = $this->input->post('code', true);
			$ret = $this->userm->forgetValid('code', $code);
			if($ret['status'] == 'n') {
				jsGourl(_BASE_.'/user/forget', 'self', $ret['yzm_error']);
				exit;
			}
			$tpwd = md5Str($_POST['pwd1']);
			$this->common->upd('user', array('password' => $tpwd), "mobile='".$mobile."'");
			//清空session
			$session = array(
				'yzm' => ''
			);
			$this->session->unset_userdata($session);
			delete_cookie('reg_mobile');
			delete_cookie('reg_yzm');
			delete_cookie('reg_minue');

			delete_cookie('forget_mobile');
			delete_cookie('forget_yzm');
			delete_cookie('forget_minue');

			jsGourl(_BASE_.'/user/login');
		}
	}
	function forAjax() {
		if(IS_POST == 'POST') {
			$name  = $this->input->post('name', true);
			$param = $this->input->post('param', true);
			$ret = $this->userm->forgetValid($name, $param);
			echo $this->myjson->encode($ret);
		}
	}
	/*发送验证码
	 *Khd
	 */
	function send_sms($type) {
		if(IS_POST == 'POST') {
			$mobile = $this->input->post('mobile', true);
			$template_id = $type == 'reg' ? 1 : 6;
			$template = $this->common->findOne('sms_temp', "id=".$template_id." and isopen=1", 'content');
			$ret = $this->common->verify_sms($template['content'], $mobile, $type);
			echo $this->myjson->encode($ret);
		}
	}
}
