<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class common extends SP_Model
 {
	 function __construct() {
		parent::__construct();
		if(intval(get_cookie('user_id_cookie'))>0 && intval($this->session->userdata('user_id'))<=0) {
			$user = Array(
				'user_id' => get_cookie('user_id_cookie'),
				'user_name' => get_cookie('user_name_cookie')
			);
			$this->session->set_userdata($user);
		}
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
	/*生成html
	  *Gxunc
	  */
	function read_html($html_folder) {
		if(is_file($html_folder)) {
			die(read_file($html_folder));
		}
	}
	function write_html($html_folder) {
		$folder = substr($html_folder, 0, strrpos($html_folder, '/'));

		if(!is_dir($folder)) {
			mkdir($folder, '0755', true);
		}
		$content = $this->output->get_output();
		write_file($html_folder, $content);
	}
	function file_html() {
		$uri = $this->config->item('base_url')
			.$this->config->item('index_page')
			.'/'
			.$this->uri->uri_string();
		$uri_string = $this->uri->uri_string();
		$uri_arr = explode('/', $uri_string);
		$html_folder = APPPATH.'cache/html/'.$uri_arr[0].'+'.$uri_arr[1].'/';
		
		$html_folder .= md5($uri).'.html';
		return $html_folder;
	}
	function del_content_img($content) {
		$pattern = '/<img[^>]*src\s*=\s*([\'"]?)([^\'" >]*)\1/isu';
		preg_match_all($pattern, $content, $match);
		if(!empty($match[2])) {
			foreach($match[2] as $val) {
				$pic = str_replace(_FILE_PATH_, '', $val);
				unlink(ROOT_PATH.'/'.$pic);
			}
		}
	}
	/*公用模块*/
	function message($links) {
		ob_start();
		$this->load->view('message', $links);
		ob_end_flush();
		exit();
	}
	function checkLogin($urlcode='') {	//判断登录状态
		if(intval($this->session->userdata('user_id'))<=0) {
			if(intval(get_cookie('user_id_cookie'))<=0 || get_cookie('user_id_cookie') == '') {
				jsGourl(_BASE_.'/user/login/'.$urlcode);
			}
			else {
				$user = Array(
					'user_id' => get_cookie('user_id_cookie'),
					'user_name' => get_cookie('user_name_cookie')
				);
				if(empty($user)){
					jsGourl(_BASE_.'/user/login/'.$urlcode);
				}
				else {
					$this->session->set_userdata($user);
				}
			}
		}
		$user_id = intval($this->session->userdata('user_id'));
		$num = $this->common->counts('user', "id='".$user_id."' and status=1");
		if($num>0) {
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
			jsGourl(_BASE_.'/user/login/'.$urlcode, 'self', $this->lang->line('login_error'));
		}
	}
	function checkLoginAjax() {
		if(intval($this->session->userdata('user_id'))<=0) {
			if(intval(get_cookie('user_id_cookie'))<=0 || get_cookie('user_id_cookie') == '') {
				$ret['status'] = 'n';
				$ret['info'] = $this->lang->line('login_expire');
			}
			else {
				$user = Array(
					'user_id' => get_cookie('user_id_cookie'),
					'user_name' => get_cookie('user_name_cookie')
				);
				if(empty($user)){
					$ret['status'] = 'n';
					$ret['info'] = $this->lang->line('login_expire');
				}
				else {
					$ret['status'] = 'y';
					$ret['info'] = $this->lang->line('accross');
					$this->session->set_userdata($user);
				}
			}
		}
		else {
			$ret['status'] = 'y';
			$ret['info'] = $this->lang->line('accross');
		}
		$user_id = intval($this->session->userdata('user_id'));
		$num = $this->common->counts('user', "id='".$user_id."' and status=1");
		if($num>0) {
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
			$ret['status'] = 'n';
			$ret['info'] = $this->lang->line('login_error');
		}
		return $ret;
	}
	//计算商品的种类
	function getCartSorts() {
		//$cartValue = $this->session->userdata('gxuncart');
		$cartValue = $_COOKIE['gxuncart'];
		$mycart = $this->myjson->decode($cartValue);
		$sumSort   = 0;
		$sortArray = array('goods', 'product');
		if(!empty($mycart)) {
			foreach($sortArray as $sort) {
				$sumSort += count($mycart[$sort]);
			}
		}
		return $sumSort;
	}
	function footer() {
		$arr = $this->common->findAllRedis('art_type', 'pid=10', 'id, name', 'sortnum desc, id asc', 5);
		foreach($arr as $key => $val) {
			$arr[$key]['parent'] = $this->common->findAllRedis('art_type', 'pid='.$val['id'], 'id, name', 'sortnum desc, id asc', 4);
		}
		return $arr;
	}
	function top_cate() {
		$cate_list = $this->common->findAllRedis('category', 'pid=0 and is_banner=1', 'id, cate_name', 'sortnum desc, id asc', 7);
		foreach($cate_list as $key => $val) {
			$cate_list[$key]['next'] = $this->common->findAllRedis('category', 'pid='.$val['id'].'', 'id, cate_name', 'sortnum desc, id asc', 25);
		}
		return $cate_list;
	}
	function verify_sms($content, $mobile, $type) {
		if($content == '') {
			$ret['status'] = 'n';
			$ret['info'] = $this->lang->line('sms_content_empty');
			return $ret;
		}
		$code = randStr();
		$username = $this->common->findOne('user', "mobile='".$mobile."'", 'username');
		$content = str_replace('#user_name#', $username['username'], $content);
		$content = str_replace('#code#', $code, $content);
		$time = gmtime();
		$minue = intval(get_cookie($type.'_minue'));
		if($minue>$time) {
			$ret['status'] = 'n';
			$ret['info'] = $this->lang->line('less_minue');
		}
		else {
			$ok_time = $time+60;
			//发短信
			$sms_ver = $this->config->item('sms_ver');
			$sms_password = $this->config->item('sms_password');
			$sms_url = $this->config->item('sms_url');
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $sms_url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "account=".$sms_ver."&password=".$sms_password."&destmobile=".$mobile."&msgText=".$content."&sendDateTime=");
			curl_setopt($ch, CURLOPT_HEADER,0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			$return = curl_exec($ch);
			curl_close($ch);
			//发短信
			if($return>0) {
				set_cookie($type.'_mobile', $mobile, 900);	//15分钟后
				set_cookie($type.'_yzm', $code, 900);
				set_cookie($type.'_minue', $ok_time, 900);

				$arr['type'] = 0;	//验证短信
				$arr['content'] = $content;
				$arr['addtime'] = $time;
				$arr['mobile'] = $mobile;
				$this->common->add('sms', $arr);

				$ret['status'] = 'y';
				$ret['info'] = $this->lang->line('accross');
			}
			else {
				$ret['status'] = 'n';
				$ret['info'] = $this->lang->line('send_sms_error');
			}
			
		}
		return $ret;
	}
	function notice_sms($content, $mobile) {
		if($content == '') {
			$ret['status'] = 'n';
			$ret['info'] = $this->lang->line('sms_content_empty');
			return $ret;
		}
		$time = gmtime();
		
		//发短信
		//$sms_notice = $this->config->item('sms_notice');
		$sms_notice = $this->config->item('sms_notice');
		$sms_password = $this->config->item('sms_password');
		$sms_url = $this->config->item('sms_url');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $sms_url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "account=".$sms_notice."&password=".$sms_password."&destmobile=".$mobile."&msgText=".$content."&sendDateTime=");
		curl_setopt($ch, CURLOPT_HEADER,0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		$return = curl_exec($ch);
		curl_close($ch);
		//发短信
		if($return>0) {
			$ret['status'] = 'y';
			$ret['info'] = $this->lang->line('accross');
		}
		else {
			$ret['status'] = 'n';
			$ret['info'] = $this->lang->line('send_sms_error');
		}
		return $ret;
	}
	/*发送邮件
	 *Khd
	 */
	function verify_mail($type, $email_arr, $arr) {
		$time = gmtime();
		$minue2 = intval(get_cookie($type.'_minue'));
		if($minue2>$time) {
			$ret['status'] = 'n';
			$ret['info'] = $this->lang->line('less_minue');
		}
		$this->load->library('email');
		//以下设置Email参数
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = $this->config->item('smtp');
		$config['smtp_user'] = $this->config->item('smtp_user');
		$config['smtp_pass'] = $this->config->item('smtp_pwd');
		$config['smtp_port'] = $this->config->item('smtp_port');
		$config['wordwrap'] = TRUE;  
		$config['mailtype'] = 'html';
		$config['charset'] = 'utf-8';
		$config['crlf'] = "\r\n";
		$config['newline'] = "\r\n";
		$this->email->initialize($config);
		//以下设置Email内容
		$this->email->from($this->config->item('smtp_user'), $arr['title']);
		$this->email->to($email_arr);
		$this->email->subject($arr['title']);
		$this->email->message($arr['content']);
		if($this->email->send()) {
			$arr['addtime'] = date("Y-m-d H:i:s");
			$arr['email'] = $email_arr;
			$this->add('email', $arr);
			
			$time2 = $time+120;
			$time15 = $time+900;
			set_cookie($type.'_minue2', $time2, 900);
			set_cookie($type.'_minue15', $time15, 900);
			$ret['status'] = 'y';
			$ret['info'] = $this->lang->line('accross');
		}
		else {
			$ret['status'] = 'n';
			$ret['info'] = $this->lang->line('fail');
		}
		return $ret;
	}

	/*热门搜索
	 *Khd
	 */
	function hot_search() {
		$hot_search = $this->common->findAllRedis('hot_search', '', '*', 'sortnum desc, id desc', 7);
		return $hot_search;
	}
	/*会员信息
	 *Khd
	 */
	function user_info() {
		$user_info = $this->common->findOne('user', 'id='.$this->session->userdata('user_id'), 'username, img, mobile, account, frozen_account, item_money');
		return $user_info;
	}
	/*系统提示
	 *Khd
	 */
	function letter() {
		$letter = $this->common->counts('letter', "user_id='".$this->session->userdata('user_id')."' and isopen=0");
		return $letter;
	}
	
	/*购物车商品数量
	 *Khd
	 */
	function cart_goods() {
		$this->load->model('cartm');
		$cartValue = $_COOKIE['gxuncart'];
		$list = $this->cartm->cartFormat();
		$num = 0;
		foreach($list['seller'] as $val) {
			foreach($val['goods'] as $v) {
				$num += $v['num'];
			}
		}
		return $num;
	}
	/*商户管理*/

	/*消息提醒
	  *Gxunc
	  */
	function messages($message, $type = 1) {
		if($type == 1)
			$view = 'mall/dialogMessage';
		elseif($type == 2)
			$view = 'mall/navMessage';
		else
			$view = 'mall/warning';
		ob_start();
		$this->load->view($view, $message);
		ob_end_flush();
		exit();
	}
	function upMessages($arr, $url = '') {
		$type = $url == '' ? 1 : 2;
		if(isset($arr['flag'])) {	//单传
			if($arr['flag'] <= 0) {
				$message = Array(
					'type' => 5, 
					'text' => $arr['name'],
					'url' => $url
				);
				$this->messages($message, $type);
			}
		}
		else {
			$size = 0;
			$ext = 0;
			foreach($arr as $val) {
				if($val['flag'] == -1)
					$size++;
				else
					$ext++;
			}
			$msg = '';
			if($size > 0)
				$msg .= $size.'个文件超出大小！';
			if($ext > 0)
				$msg .= $ext.'个文件格式错误！';
			if($msg != '') {
				$message = Array(
					'type' => 5, 
					'text' => $msg,
					'url' => $url
				);
				$this->messages($message, $type);
			}
		}
	}
 }