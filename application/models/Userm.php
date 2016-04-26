<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Userm extends SP_Model {
	/*登陆AJAX验证
	 *Khd
	 */
	function loginValid($name, $param) {
		switch($name) {
			case 'tname':
				$num = $this->common->counts('user', "username='".$param."' or mobile='".$param."'");
				if($num>0) {
					$error['info']   = $this->lang->line('accross');
					$error['status'] = 'y';
				}
				else {
					$error['info']   = $this->lang->line('loging_tname_error');
					$error['status'] = 'n';
				}
				break;
			case 'pwd':
				$tpwd = md5Str($param['tpwd']);
				$num = $this->common->counts('user', "password='".$tpwd."' and (username='".$param['tname']."' or mobile='".$param['tname']."')");
				if($num>0) {
					$error['info']   = $this->lang->line('accross');
					$error['status'] = 'y';
				}
				else {
					$error['info']   = $this->lang->line('login_tpwd_error');
					$error['status'] = 'n';
				}
				break;
			case 'yzm':
				$yzm = strtolower($this->session->userdata('yzm'));
				if(strtolower($param) == $yzm) {
					$error['info']   = $this->lang->line('accross');
					$error['status'] = 'y';
				}
				else {
					$error['info']   = $this->lang->line('yzm_error');
					$error['status'] = 'n';
				}
				break;
		}
		return $error;
	}
	/*注册AJAX验证
	 *Khd
	 */
	function regValid($name, $param) {
		switch($name) {
			case 'mobile':
				$num = $this->common->counts('user', "mobile='".$param."'");
				if($num>0) {
					$error['info']   = $this->lang->line('reg_mobile_exist');
					$error['status'] = 'n';
				}
				else {
					$error['info']	 = $this->lang->line('accross');
					$error['status'] = 'y';
				}
				break;
			case 'code':
				$reg_yzm = get_cookie('reg_yzm');
				if($param == $reg_yzm) {
					$error['info']   = $this->lang->line('accross');
					$error['status'] = 'y';
				}
				else {
					$error['info']   = $this->lang->line('yzm_error');
					$error['status'] = 'n';
				}
				break;
			case 'username':
				$num = $this->common->counts('user', "username='".$param."'");
				if($num>0) {
					$error['info']   = $this->lang->line('reg_username_exist');
					$error['status'] = 'n';
				}
				else {
					$error['info']	 = $this->lang->line('accross');
					$error['status'] = 'y';
				}
				break;
		}
		return $error;
	}
	/*找回密码
	 *Khd
	 */
	function forgetValid($name, $param) {
		switch($name) {
			case 'mobile':
				$num = $this->common->counts('user', "mobile='".$param."'");
				if($num>0) {
					$error['info']   = $this->lang->line('accross');
					$error['status'] = 'y';
				}
				else {
					$error['info']   = $this->lang->line('mobile_error');
					$error['status'] = 'n';
				}
				break;
			case 'code':
				$forget_yzm = get_cookie('forget_yzm');
				if($param == $forget_yzm) {
					$error['info'] = $this->lang->line('accross');
					$error['status'] = 'y';
				}
				else {
					$error['info'] = $this->lang->line('yzm_error');
					$error['status'] = 'n';
				}
				break;
		}
		return $error;
	}
}