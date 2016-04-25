<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Content-type: text/html; charset=utf-8");
class Sys extends SP_Controller
{
	function __construct() {
		parent::__construct();
		//$this->load->library('session');
		$this->load->model("sys_mod");
		$this->init();
	}
	protected function init() {
		$admin_id = $this->session->userdata('sp_admin');
		if(empty($admin_id) || $admin_id <= 0) {
			showMsg(_HOME_URL_.'/spindex/login', 'top');
			exit;
		}
		$this->sp_admin = $admin_id;
	}
	/*操作按钮
	 *Gxunc
	 */
	function button() {
		$tpage = isset($_GET['tpage']) ? intval($_GET['tpage']) : 1;
		$conditions = '';
		if($_GET['keyword']) {
			$keyword = $serach['keyword'] = $this->common->r_db->escape_str($_GET['keyword']);
			$conditions .= "name='".$keyword."'";
		}
		$page = Array(
			'tpage' => $tpage,
			'link' => _HOME_URL_.'/sys/button?keyword='.$keyword.'&tpage='
			);
		$arr = Array(
			'tab' => 'button',
			'conditions' => $conditions,
			'order' => 'sortnum desc, id asc'
		);
		$data = $this->common->findAllPage($page, $arr);
		$data['serach'] = $serach;
		$data['prev'] = $this->GetOperate();
		$this->load->view('sys/button_list', $data);
	}
	function button_add($id=0) {
        $data['info'] = array();
		if($id>0) {
			$info = $this->common->findOne('button', 'id='.$id);
			$data['info'] = $info;
		}
		$this->load->view('sys/button_add', $data);
	}
	function open_img($tpage = 1) {
		$html_folder = $this->common->file_html();
		$this->common->read_html($html_folder);

		$max=120;//设置每页显示图片最大张数  		  
		$path=ROOT_PATH."/public/home/images/16";
		$list = file_list($path);
		$link = _HOME_URL_.'/sys/open_img/';
		$nums = count($list);
		$mypage = new mypage();
		$mypage->initialize($nums, $link, $tpage, $max, 2);
		$pagestr = $mypage->create_links();
		for($j=$max*($tpage-1);$j<($max*($tpage-1)+$max)&&$j<$nums;++$j)	//循环条件控制显示图片张数
		{
			$arr .= "<div class='divicons' title='".$list[$j]."'>";
			$arr .= "<img src='"._PUB_HOME_.'/images/16/'.$list[$j]."' style='width:16px; height:16px;'/>";
			$arr .= "</div>";
		}
		$data['arr'] = $arr;
		$data['pagestr'] = $pagestr;
		$this->load->view('sys/open_img', $data);

		$this->common->write_html($html_folder);
	}
	function button_ok() {
		if(IS_POST == 'POST') {
			$id = intval($this->input->post('id'));
			$arr['name'] = $this->input->post('name');
			$arr['code'] = $this->input->post('code');
			$arr['event'] = $this->input->post('event');
			$arr['sortnum'] = intval($this->input->post('sortnum'));
			$arr['desc'] = $this->input->post('desc');
			$arr['img'] = $this->input->post('img');
			if($id>0) {
				$this->common->upd('button', $arr, 'id='.$id);
				$this->LogsSaveFile('修改按钮《'.$id.'》');
			}
			else {
				$this->common->add('button', $arr);
				$this->LogsSaveFile('添加按钮《'.$arr['name'].'》');
			}
			$message = Array(
				'type' => 4,
				'text' => '编辑操作按钮成功'
			);
			$this->common->messages($message);
		}
	}
	function button_del() {
		if(IS_POST == 'POST') {
			$param = $_POST['param'];
			$conditions = "id in ($param)";
			$this->common->del('button', $conditions);
			$this->LogsSaveFile('删除按钮《'.$param.'》');
			echo 'true';
		}
	}
	/*模块
	 *Gxunc
	 */
	function module() {
        $data = array();
		$data['prev'] = array();//$this->GetOperate();
		$data['module_list'] = $this->sys_mod->module_tree();
        var_dump($data);
		$this->load->view('sys/module_list', $data);
	}
	function module_add($id=0) {
        $data['info'] = array();
		if($id>0) {
			$info = $this->common->findOne('module', 'id='.$id);
			$data['info'] = $info;
		}
		$data['loop'] = $this->sys_mod->module_loop();
		$this->load->view('sys/module_add', $data);
	}
	function module_ok() {
		if(IS_POST == 'POST') {
			$id = intval($this->input->post('id'));
			$arr['name'] = $this->input->post('name');
			$arr['pid'] = intval($this->input->post('pid'));
			$arr['target'] = $this->input->post('target');
			$arr['url'] = $this->input->post('url');
			$arr['sortnum'] = intval($this->input->post('sortnum'));
			
			$code = $arr['pid'] == 0 ? '0-' : $this->sys_mod->module_top($arr['pid']);
			if($id>0) {
				if($id == $arr['pid']) {
						$message = Array(
						'type' => 5,
						'text' => '上级模块不能是模块本身'
					);
					$this->common->messages($message);
				}
				$info = $this->common->findOne('module', 'id='.$id, 'code');
				$arr['code'] = '-'.$code.$id.'-';
				preg_match_all('/-'.$id.'-/', $arr['code'], $other);
				if(count($other[0]) > 1) {
						$message = Array(
						'type' => 5,
						'text' => '上级模块级别不够'
					);
					$this->common->messages($message);
				}
				$this->common->upd('module', $arr, 'id='.$id);
				if($info['code'] != $arr['code']) {	//跨栏目
					$new_code = preg_replace('/^-0/', '', $arr['code']);
					$this->sys_mod->module_across($new_code, $id);
				}
				$this->LogsSaveFile('修改模块《'.$id.'》');
			}
			else {
				$this->common->add('module', $arr);
				$id = $this->common->w_db->insert_id();
				$m['code'] = '-'.$code.$id.'-';
				$this->common->upd('module', $m, 'id='.$id);
				$this->LogsSaveFile('添加模块《'.$id.'》');
			}
			file_del(APPPATH.'cache/data/sys+module');
			$message = Array(
				'type' => 4,
				'text' => '编辑模块成功'
			);
			$this->common->messages($message);
		}
	}
	function module_del() {
		if(IS_POST == 'POST') {
			$id = intval($_POST['param']);
			$this->common->del('module', "code like '%-".$id."-%'");
			file_del(APPPATH.'cache/data/sys+module');
			$this->LogsSaveFile('删除模块《'.$id.'》');
			echo 'true';
		}
	}
	function set_button($id) {
		$arr = $this->common->findAll('button', '', 'id, name, img', 'sortnum desc, id asc');
		$data['arr'] = $arr;
		$info = $this->common->findOne('module', 'id='.$id);
		$data['info'] = $info;

		$button = explode(',', $info['button']);
		$data['button'] = $button;
		$this->load->view('sys/set_button', $data);
	}
	function set_button_ok() {
		if(IS_POST == 'POST'){
			$id = intval($this->input->post('id'));
			$hiddenButton = $this->input->post('hiddenButton');
			$hiddenButton = trim($hiddenButton, ',');
			$arr['button'] = $hiddenButton;
			$this->common->upd('module', $arr, 'id='.$id);
			$this->LogsSaveFile('分配模块按钮《'.$id.'》');
			$message = Array(
				'type' => 4,
				'text' => '分配模块按钮成功'
			);
			$this->common->messages($message);
		}
	}
	
	/*角色管理
	 *Gxunc
	 */
	function role() {
		$conditions = '';
		$tpage = isset($_GET['tpage']) ? intval($_GET['tpage']) : 1;
		if($_GET['keyword']) {
			$keyword = $serach['keyword'] = $this->common->r_db->escape_str($_GET['keyword']);
			$conditions .= "name='".$keyword."'";
		}
		$page = Array(
			'tpage' => $tpage,
			'link' => _HOME_URL_.'/sys/role?keyword='.$keyword.'&tpage='
			);
		$arr = Array(
			'tab' => 'role',
			'conditions' => $conditions,
			'order' => 'id desc'
		);
		$data = $this->common->findAllPage($page, $arr);
		$data['serach'] = $serach;
		$data['prev'] = $this->GetOperate();
		$this->load->view('sys/role_list', $data);
	}
	function role_add($id=0) {
		if($id>0) {
			$info = $this->common->findOne('role', 'id='.$id);
			$data['info'] = $info;
		}
		$this->load->view('sys/role_add', $data);
	}
	function role_ok() {
		if(IS_POST == 'POST') {
			$id = intval($this->input->post('id'));
			$arr['name'] = $this->input->post('name');
			$arr['tyname'] = $this->input->post('tyname');
			$arr['desc'] = $this->input->post('desc');
			if($id>0) {
				$this->common->upd('role', $arr, 'id='.$id);
				$this->LogsSaveFile('修改角色《'.$id.'》');
			}
			else {
				$this->common->add('role', $arr);
				$this->LogsSaveFile('添加角色《'.$arr['name'].'》');
			}
			$message = Array(
				'type' => 4,
				'text' => '编辑角色成功'
			);
			$this->common->messages($message);
		}
	}
	function role_del() {
		if(IS_POST == 'POST') {
			$param = $_POST['param'];
			$conditions = "id in ($param)";
			$this->common->del('role', $conditions);
			$this->LogsSaveFile('删除角色《'.$param.'》');
			echo 'true';
		}
	}
	//模块权限分配
	function module_prev($id) {
		$info = $this->common->findOne('role', 'id='.$id);
		$moduleArr = explode(',', $info['module']);
		$arr = $this->common->findAll('module', '', 'id, name, pid', 'sortnum desc, id asc');
		foreach($arr as $key => $val){
			$json[$key]['id'] = $val['id'];
			$json[$key]['pId'] = $val['pid'];
			$json[$key]['name'] = $val['name'];
			$json[$key]['open'] = 'true';
			if(in_array($val['id'], $moduleArr))
				$json[$key]['checked'] = 'true';
		}
		$obj = new myjson;
		$data['arr'] = $obj->encode($json);
		$data['info'] = $info;
		$this->load->view('sys/module_prev', $data);
	}
	function module_prev_ok() {
		if(IS_POST == 'POST') {
			$id = intval($this->input->post('id'));
			$arr['module'] = $this->input->post('moduleId');
			$this->common->upd('role', $arr, 'id='.$id);
			$this->LogsSaveFile('分配模块权限《'.$id.'》');
			$message = Array(
				'type' => 4,
				'text' => '分配模块权限成功'
			);
			$this->common->messages($message);
		}
	}
	//按钮权限分配
	function button_prev($id) {
		$where = '1=2';
		$info = $this->common->findOne('role', 'id='.$id);
		if(empty($info['module'])) {
			$message = Array(
				'type' => 5,
				'text' => '您还没有分配模块权限'
			);
			$this->common->messages($message);
		}
		$where = 'id IN ('.$info['module'].')';
		$arr = $this->common->findAll('module', $where, 'id, name, pid, button', 'sortnum desc, id asc');
		foreach($arr as $key => $val) {
			$json[$key]['id'] = $val['id'];
			$json[$key]['pId'] = $val['pid'];
			$json[$key]['name'] = $val['name'];
			$json[$key]['open'] = 'true';
			$json[$key]['click'] = "showButton('".$val['id']."')";
		}
		$obj = new myjson;
		$data['module'] = $obj->encode($json);
		$data['info'] = $info;
		
		$button = unserialize($info['button']);
		$data['button'] = $button;
		foreach($arr as $key => $val) {
			if(!$val['button'])
				continue;
			$conditions = "id in (".$val['button'].")";
			$list = $this->common->findAll('button', $conditions, '*', 'sortnum desc, id asc');
			if(!empty($list)) {
				foreach($list as $v){
					$v['module'] = $val['id'];
					$all[] = $v;
				}
			}
		}
		$data['all'] = $all;
		$this->load->view('sys/button_prev', $data);
	}
	function show_button() {
		$id = intval($this->input->post('id'));
		$info = $this->common->findOne('module', 'id='.$id);
		$arr = explode(',', $info['button']);
		$obj = new myjson;
		$json = $obj->encode($arr);
		echo $json;
	}
	function button_prev_ok() {
		if(IS_POST == 'POST') {
			$id = intval($this->input->post('id'));
			$hiddenButton = trim($this->input->post('hiddenButton'), ',');
			$buttonArr = explode(',', $hiddenButton);
			foreach($buttonArr as $key => $val) {
				$list = explode('-', $val);
				$button[$list[0]][] = $list[1];
			}
			$arr['button'] = serialize($button);
			$this->common->upd('role', $arr, 'id='.$id);
			$this->LogsSaveFile('分配按钮权限《'.$id.'》');
			$message = Array(
				'type' => 4,
				'text' => '分配按钮权限成功'
			);
			$this->common->messages($message);
		}
	}
	/*管理员
	 *Gxunc
	 */
	function admin() {
		$tpage = isset($_GET['page']) ? intval($_GET['page']) : 1;
		$conditions = '';
		if($_GET['keyword']) {
			$keyword = $serach['keyword'] = $this->common->r_db->escape_str($_GET['keyword']);
			$conditions .= "admin_name='".$keyword."'";
		}
		$page = Array(
			'tpage' => $tpage,
			'link' => _HOME_URL_.'/sys/admin?keyword='.$keyword.'&tpage='
			);
		$arr = Array(
			'tab' => 'admin',
			'field' => $this->common->r_db->dbprefix.'admin .*, name',
			'conditions' => $conditions,
			'join' => Array(
				'role' => 'admin.role_id=role.id'
			),
			'order' => 'admin.id desc'
			);
		$data = $this->common->findAllPage($page, $arr);
		$data['serach'] = $serach;
		$data['prev'] = $this->GetOperate();
		$this->load->view('sys/admin', $data);
	}
	function admin_add($id=0) {
		if($id>0) {
			$info = $this->common->findOne('admin', 'id='.$id);
			$data['info'] = $info;
		}
		$data['role_list'] = $this->common->findAll('role');
		$this->load->view('sys/admin_add', $data);
	}
	function admin_ok() {
		if(IS_POST == 'POST') {
			$id = intval($this->input->post('id'));
			$arr['role_id'] = intval($this->input->post('role_id'));
			$arr['admin_name'] = $this->input->post('admin_name', true);
			$admin_pwd =$this->input->post('admin_pwd', true);
			$arr['email'] = $this->input->post('email', true);
			$arr['mobile'] = $this->input->post('mobile', true);
			$arr['realname'] = $this->input->post('realname', true);
			if($id>0) {
				if($admin_pwd)
					$arr['admin_pwd'] = md5Str($admin_pwd);
				$this->common->upd('admin', $arr, 'id='.$id);
				$this->LogsSaveFile('修改管理员《'.$id.'》');
			}
			else {
				$arr['admin_pwd'] =  md5Str($admin_pwd);
				$this->common->add('admin', $arr);
				$this->LogsSaveFile('添加管理员《'.$arr['admin_name'].'》');
			}

			$message = Array(
				'type' => 4,
				'text' => '编辑管理员成功'
			);
			$this->common->messages($message);
		}
	}
	function admin_del() {
		if(IS_POST == 'POST') {
			$param = $_POST['param'];
			$conditions = "id in ($param)";
			$this->common->del('admin', $conditions);
			$this->LogsSaveFile('删除管理员《'.$param.'》');
			echo 'true';
		}
	}
	/*系统日志
	 *Gxunc
	 */
	function logs() {
		$perpage = 20;	//每页显示条数
		$page = isset($_GET['page']) ? $_GET['page'] : 1;
		$keyword = $_GET['keyword'];
		$year = $_GET['year'];
		$month = $_GET['month'];
		$fdata = $year.$month;
		if(empty($fdata))
			$fdata = date('Ym');
		$data = $this->sys_mod->logs_list($fdata, $page, $perpage, $keyword);

		$data['month']=$month;
		$data['year']=$year;
		$data['keyword']=$keyword;
		$this->load->view('sys/logs', $data);
	}
}