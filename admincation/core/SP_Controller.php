<?php
class SP_Controller extends CI_Controller 
{
	//写入日志
	function LogsSaveFile($content) {
		//$logs = new Logs;
		//$logs->base_path = $this->config->item('systemlogsdir');
		//$logs->user_id = $this->session->userdata('user_id');
		//$logs->user_name = $this->session->userdata('user_name');
		//$logs->LogsSaveFile($content);
	}
	//操作权限
	function GetOperate($url='') {
		if($url == '') {
			$url = $_SERVER['REQUEST_URI'];
			preg_match('/\.php\/(.*)\?|\.php\/(.*)/i', $url, $match);
			$str = $match[count($match)-1];
			$arr = explode('/', $str);
			$moduleUrl = '/'.$arr[0].'/'.$arr[1];
		}
		else
			$moduleUrl = $url;
		$module = $this->common->findOne('module', "url='$moduleUrl'", 'id');
		$role_id = $this->session->userdata('role_id');

		$role = $this->common->findOne('role', 'id='.$role_id, 'button');
		$arr = unserialize($role['button']);
		if( is_array($arr[$module['id']]) && !empty($arr[$module['id']]) ) {
			$conditions = 'id in ('.implode(',', $arr[$module['id']]).')';
			$button = $this->common->findAll('button', $conditions, '*', 'sortnum desc,id asc');
			return $button;
		}
	}
}