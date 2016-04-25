<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class common extends SP_Model
 {
	 function __construct() {
		parent::__construct();
		/*
		$this->load->library('ftp');
		
		$ftp_conf['hostname'] = '222.73.130.76';
		$ftp_conf['username'] = 'gxunc';
		$ftp_conf['password'] = 'gxunc';
		$ftp_conf['port'] = 2102;
		
		$ftp_conf['hostname'] = '192.168.101.133';
		$ftp_conf['username'] = 'ftpuser';
		$ftp_conf['password'] = 'guxuncheng';
		$ftp_conf['port'] = 21;
		
		$ftp_conf['debug']    = TRUE;
		$this->ftp_conf = $ftp_conf;
		*/
	 }
 	//消息提醒
	function messages($message, $type = 1) {
		if($type == 1)
			$view = 'dialogMessage';
		elseif($type == 2)
			$view = 'navMessage';
		else
			$view = 'warning';
		ob_start();
		$this->load->view($view, $message);
		ob_end_flush();
		exit();
	}
 }