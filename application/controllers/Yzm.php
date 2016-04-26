<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Content-type: text/html; charset=utf-8");
class Yzm extends SP_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('vadcode');
	}
	function getYzm()
	{
		$_vc = new vadCode();      //实例化一个对象  
		$_vc->doimg();
		$this->session->set_userdata('yzm', $_vc->getCode());
	}
}
