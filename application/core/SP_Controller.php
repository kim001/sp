<?php
class SP_Controller extends CI_Controller 
{
	//写入日志
	function LogsSaveFile($content) {
		$logs = new Logs;
		$logs->base_path = $this->config->item('systemlogsdir');
		$logs->user_id = $this->session->userdata('user_id');
		$logs->user_name = $this->session->userdata('user_name');
		$logs->LogsSaveFile($content);
	}
}