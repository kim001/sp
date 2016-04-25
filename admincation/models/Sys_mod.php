<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class sys_mod extends SP_Model
{
	function module_top($pid, $str = '') {
		$father = $this->findOne('module', 'id='.$pid, 'id, pid');
		if($father) {
			$str = $father['id'].'-'.$str;
			$str = $this->module_top($father['pid'], $str);
		}
		return $str;
	}
	function module_loop($id = 0, $level = 0, $falist = array())
	{
		//$this->r_db->cache_on();
		$arr = $this->findAll('module', 'pid='.$id, '*', 'sortnum desc, id asc');
		if($arr) {
			foreach($arr as $val) {
				$val['level'] = $level;
				$falist[] = $val;
				$level++;
				$falist = $this->module_loop($val['id'], $level, $falist);
				$level--;
			}
		}
		//$this->r_db->cache_off();
		return $falist;
	}
	function module_tree() {
		$this->r_db->cache_on();
		$arr = $this->module_loop();
		$str = "";
		foreach($arr as $key => $val) {
			$nextNum = $this->counts('module', "pid='".$val['id']."'");
			$file = $nextNum > 0 ? 'folder' : 'file';
			if($val['pid'] == 0)
				$str .= "<tr data-tt-id='".$val['id']."' rel='".$val['id']."'><td><span class='$file'>".$val['name']."</span></td><td>".$val['id']."</td><td>".$val['code']."</td><td>".$val['target']."</td><td>".$val['url']."</td><td>".$val['sortnum']."</td></tr>";
			else {
				$code = trim($val['code'], '-');
				$father_code = substr($code, 0, strrpos($code, '-'));
				$str .= "<tr data-tt-id='".$code."' data-tt-parent-id='".$father_code."' rel='".$val['id']."'><td><span class='$file'>".$val['name']."</span></td><td>".$val['id']."</td><td>".$val['code']."</td><td>".$val['target']."</td><td>".$val['url']."</td><td>".$val['sortnum']."</td></tr>";
			}
		}
		$this->r_db->cache_off();
		return $str;
	}
	function module_across($new_code, $id) {
		$match = '-'.$id.'-';
		$list = $this->findAll('module', 'id!='.$id." and code like '%".$match."%'");
		foreach($list as $val) {
			$arr = explode($match, $val['code']);
			$tarr['code'] = $new_code.$arr[1];
			$this->upd('module', $tarr, 'id='.$val['id']);
		}
	}

	function logs_list($fdata, $page, $perpage, $keyword) {
		$logs = new Logs;
		$logs->base_path = $this->config->item('systemlogsdir');
		
		$mypage = new mypage();
		$list = $logs->LogsChkList($fdata, $page, $perpage, $keyword);
		if($page > ceil($list['num']/$perpage))
			$page = ceil($list['num']/$perpage);
		$data['arr'] = $list['list'];
		$link = _HOME_URL_."/sys/logs?keyword=".$keyword."&year=".$year."&month=".$month."&page=";
		$mypage->initialize($list['num'], $link, $page, $perpage, 2);
		$data["pagestr"] = $mypage->create_links();
		return $data;
	}
}