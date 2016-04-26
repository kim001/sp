<?php
class SP_Model extends CI_Model
{
	public $r_db;
	public $w_db;
	function __construct() {
		$this->r_db = $this->load->database('read', TRUE);
		$this->w_db = $this->load->database('write', TRUE);
		if(REDIS == 1) {
			$this->load->driver('cache', array('adapter' => 'redis'));
		}
	}
	/*数据库操作
	 *Gxunc
	 */
	function add($tab, $arr) {	//添加
		if( empty($tab) || !is_array($arr) || empty($arr) )
			exit('参数错误!');
		return $this->w_db->insert($tab, $arr);
	}
	function upd($tab, $arr, $conditions = '') {	//修改
		if( empty($tab) || !is_array($arr) || empty($arr) )
			exit('参数错误!');
		if($conditions)
			$this->w_db->where($conditions);
		return $this->w_db->update($tab, $arr);
	}
	function del($tab, $conditions = '') {	//删除
		if( empty($tab) )
			exit('参数错误!');
		if($conditions)
			$this->w_db->where($conditions);
		return $this->w_db->delete($tab);
	}
	function delUnion($tab, $conArr) {
		$sql = "DELETE FROM `".$this->db->dbprefix.$tab."` WHERE ".$conArr[0];
		for($i = 1; $i < count($conArr); $i++) {
			$sql .= " UNION DELETE FROM `".$this->db->dbprefix.$tab."` WHERE ".$conArr[$i];
		}
		return $this->w_db->query($sql);
	}


	function counts($tab, $conditions = '', $join = '') {	//计数
		if( empty($tab) )
			exit('参数错误!');
		if($conditions)
			$this->r_db->where($conditions);
		$this->r_db->from($tab);
		if( !empty($join) ) {
			foreach($join as $key => $val) {
				$this->r_db->join($key, $val, 'left');
			}
		}
		return $this->r_db->count_all_results();
	}

	function findAll($tab, $conditions = '', $field = '*', $order = '', $limit = '') {	//查询单表二维数组
		if( empty($tab) )
			exit('参数错误!');
		$this->r_db->select($field);
		$this->r_db->from($tab);
		if($conditions)
			$this->r_db->where($conditions);
		if($order)
			$this->r_db->order_by($order);
		if($limit)
			$this->r_db->limit($limit);
		//echo $this->r_db->_compile_select();
		$arr = $this->r_db->get()->result_array();
		return $arr;
	}
	function findAllJoin($tab, $join, $conditions = '', $field = '*', $order = '', $limit = '') {	//关联查询二维数组
		if( empty($tab) )
			exit('参数错误!');
		$this->r_db->select($field);
		$this->r_db->from($tab);
		foreach($join as $key => $val) {
			$this->r_db->join($key, $val, 'left');
		}
		if($conditions)
			$this->r_db->where($conditions);
		if($order)
			$this->r_db->order_by($order);
		if($limit)
			$this->r_db->limit($limit);
		
		$arr = $this->r_db->get()->result_array();
		return $arr;
	}
	function findOne($tab, $conditions = '', $field = '*', $order = '') {	//查询单表一维数组
		if( empty($tab) )
			exit('参数错误!');
		$this->r_db->select($field);
		$this->r_db->from($tab);
		if($conditions)
			$this->r_db->where($conditions);
		if($order)
			$this->r_db->order_by($order);
		$this->r_db->limit(1);
		$arr = $this->r_db->get()->row_array();
		return $arr;
	}
	function findOneJoin($tab, $join, $conditions = '', $field = '*', $order = '') {	//关联查询一维数组
		if( empty($tab) )
			exit('参数错误!');
		$this->r_db->select($field);
		$this->r_db->from($tab);
		foreach($join as $key => $val) {
			$this->r_db->join($key, $val, 'left');
		}
		if($conditions)
			$this->r_db->where($conditions);
		if($order)
			$this->r_db->order_by($order);
		$this->r_db->limit(1);
		$arr = $this->r_db->get()->row_array();
		return $arr;
	}

	function findAllPage($page, $arr) {	//分页
		$tpage = (!$page['tpage'] || $page['tpage'] < 1) ? 1 : $page['tpage'];
		$perpage = isset($page['perpage']) ? $page['perpage'] : 20;
		$type = isset($page['type']) ? $page['type'] : 2;
		$link = $page['link'];
		$start = ($tpage-1)*$perpage;
		
		$tab = $arr['tab'];
		$field = isset($arr['field']) ? $arr['field'] : '*';
		$join = isset($arr['join']) ? $arr['join'] : '';
		$join_type = isset($arr['join_type']) ? $arr['join_type'] : 'left';
		$conditions = isset($arr['conditions']) ? $arr['conditions'] : '';
		$order = isset($arr['order']) ? $arr['order'] : '';

		$nums = $this->counts($tab, $conditions, $join);

		$this->r_db->select($field);
		$this->r_db->from($tab);
		if($join) {
			foreach($join as $key => $val) {
				$this->r_db->join($key, $val, $join_type);
			}
		}
		if($conditions)
			$this->r_db->where($conditions);
		if($order)
			$this->r_db->order_by($order);
		$this->r_db->limit($perpage, $start);
		$mypage = new mypage();
		$mypage->initialize($nums, $link, $tpage, $perpage, $type);
		$list['pagestr'] = $mypage->create_links();
		$list['arr'] = $this->r_db->get()->result_array();
		return $list;
	}

	
	/*REDIS操作
	 *Gxunc
	 */
	function addKey($tabName, $key) {
		$keys = $this->cache->get($tabName);
		if(empty($keys)) {
			$keys = array();
		}
		if(!in_array($key, $keys)) {
			$keys[] = $key;
			$this->cache->save($tabName, $keys, 600);
			return true;
		}
		else {
			return false;
		}
	}
	function addCache($tabName, $sql, $data) {
		$key = md5($sql);
		if($this->addKey($tabName, $key)) {
			$this->cache->save($key, $data, 600);
		}
	}
	function getCache($sql) {
		$key = md5($sql);
		return $this->cache->get($key);
	}
	function delCache($tabName) {
		$keys = $this->cache->get($tabName);
		if(!empty($keys)) {
			foreach($keys as $key){
				$this->cache->delete($key);
			}
		}
		$this->cache->delete($tabName);
	} 
	function delone($sql) {
		$key = md5($sql);
		$this->cache->delete($key);
	}
	
	/*
	function findAllPageRedis($page, $arr) {	//分页
		$dbprefix = $this->r_db->dbprefix;
		$tpage = (!$page['tpage'] || $page['tpage'] < 1) ? 1 : $page['tpage'];
		$perpage = isset($page['perpage']) ? $page['perpage'] : 20;
		$type = isset($page['type']) ? $page['type'] : 2;
		$link = $page['link'];
		$start = ($tpage-1)*$perpage;
		
		$tab = $arr['tab'];
		$field = isset($arr['field']) ? $arr['field'] : '*';
		$join = isset($arr['join']) ? $arr['join'] : '';
		$join_type = isset($arr['join_type']) ? $arr['join_type'] : 'left';
		$conditions = isset($arr['conditions']) ? $arr['conditions'] : '';
		$order = isset($arr['order']) ? $arr['order'] : '';
		
		$sql = 'SELECT '.$field.' FROM '.$dbprefix.$tab.' AS '.$tab;
		if(!empty($join) && is_array($join)){
			foreach($join as $key => $val) {
				$sql .= ' '.$join_type.' JOIN `'.$dbprefix.$key.'` AS '.$key.' ON '.$val;
			}
		}
		if($conditions)
			$sql .= " WHERE ".$conditions;
		if($order)
			$sql .= " ORDER BY ".$order;
		
		$sqlCount = $sql;
		$sql .= " LIMIT $start, $perpage";
		if(1==REDIS) {
			$this->load->driver('cache', array('adapter' => 'redis'));
			$countKey = '#'.$str.'#'.md5str($sqlCount);
			$sqlKey = '#'.$str.'#'.md5str($sql);
			$nums = $this->cache->get($countKey);
			$list['arr'] = $this->cache->get($sqlKey);
		}
		if($list['arr']) {
			$mypage = new mypage();
			$mypage->initialize($nums, $link, $tpage, $perpage, $type);
			$list['pagestr'] = $mypage->create_links();
			return $list;
		}
		$numArr = $this->r_db->query($sqlCount)->result_array();
		$nums = count($numArr);

		$mypage = new mypage();
		$mypage->initialize($nums, $link, $tpage, $perpage, $type);
		$list['pagestr'] = $mypage->create_links();
		$list['arr'] = $this->r_db->query($sql)->result_array();
		if(1==REDIS && $list['arr']) {
			$this->cache->save($sqlKey, $list['arr'], 600);
			$this->cache->save($countKey, $nums, 600);
		}
		return $list;
	}
	*/
	function findAllPageRedis($page, $arr) {	//分页
		$dbprefix = $this->r_db->dbprefix;
		$tpage = (!$page['tpage'] || $page['tpage'] < 1) ? 1 : $page['tpage'];
		$perpage = isset($page['perpage']) ? $page['perpage'] : 20;
		$type = isset($page['type']) ? $page['type'] : 2;
		$link = $page['link'];
		$start = ($tpage-1)*$perpage;
		
		$tab = $arr['tab'];
		$field = isset($arr['field']) ? $arr['field'] : '*';
		$join = isset($arr['join']) ? $arr['join'] : '';
		$join_type = isset($arr['join_type']) ? $arr['join_type'] : 'left';
		$conditions = isset($arr['conditions']) ? $arr['conditions'] : '';
		$order = isset($arr['order']) ? $arr['order'] : '';
		
		$sql = 'SELECT '.$field.' FROM '.$dbprefix.$tab.' AS '.$tab;
		$sqlCount = 'SELECT COUNT(*) AS num FROM '.$dbprefix.$tab.' AS '.$tab;
		if(!empty($join) && is_array($join)){
			foreach($join as $key => $val) {
				$sql .= ' '.$join_type.' JOIN `'.$dbprefix.$key.'` AS '.$key.' ON '.$val;
				$sqlCount .= ' '.$join_type.' JOIN `'.$dbprefix.$key.'` AS '.$key.' ON '.$val;
			}
		}
		if($conditions) {
			$sql .= " WHERE ".$conditions;
			$sqlCount .= " WHERE ".$conditions;
		}
		$numArr = $this->r_db->query($sqlCount)->row_array();
		$nums = $numArr['num'];

		if($order) {
			$sql .= " ORDER BY ".$order;
		}
		$sql .= " LIMIT $start, $perpage";
		if(1==REDIS) {
			$list['arr'] = $this->getCache($sql);
		}
		if($list['arr']) {
			$mypage = new mypage();
			$mypage->initialize($nums, $link, $tpage, $perpage, $type);
			$list['pagestr'] = $mypage->create_links();
			return $list;
		}
		$mypage = new mypage();
		$mypage->initialize($nums, $link, $tpage, $perpage, $type);
		$list['pagestr'] = $mypage->create_links();
		$list['arr'] = $this->r_db->query($sql)->result_array();
		if(1==REDIS && $list['arr']) {
			$this->addCache($tab, $sql, $list['arr']);
		}
		return $list;
	}
	function findAllRedis($tab, $conditions = '', $field = '*', $order = '', $limit = '') {	//查询单表二维数组
		$dbprefix = $this->r_db->dbprefix;
		$sql = 'SELECT '.$field.' FROM '.$dbprefix.$tab.' AS '.$tab;
		if($conditions) {
			$sql .= " WHERE ".$conditions;
		}
		if($order) {
			$sql .= " ORDER BY ".$order;
		}
		if($limit) {
			$sql .= " LIMIT ".$limit;
		}
		if(1==REDIS) {
			$arr = $this->getCache($sql);
		}
		if($arr) {
			return $arr;
		}
		$arr = $this->r_db->query($sql)->result_array();
		if(1==REDIS && $arr) {
			$this->addCache($tab, $sql, $arr);
		}
		return $arr;
	}
	function findAllJoinRedis($tab, $join, $conditions = '', $field = '*', $order = '', $limit = '') {	//关联查询二维数组
		$dbprefix = $this->r_db->dbprefix;
		$sql = 'SELECT '.$field.' FROM '.$dbprefix.$tab.' AS '.$tab;
		foreach($join as $key => $val) {
			$sql .= ' left JOIN `'.$dbprefix.$key.'` AS '.$key.' ON '.$val;
		}
		if($conditions) {
			$sql .= " WHERE ".$conditions;
		}
		if($order) {
			$sql .= " ORDER BY ".$order;
		}
		if($limit) {
			$sql .= " LIMIT ".$limit;
		}
		if(1==REDIS) {
			$arr = $this->getCache($sql);
		}
		if($arr) {
			return $arr;
		}
		$arr = $this->r_db->query($sql)->result_array();
		if(1==REDIS && $arr) {
			$this->addCache($tab, $sql, $arr);
		}
		return $arr;
	}
	
}