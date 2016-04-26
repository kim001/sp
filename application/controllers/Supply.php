<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Content-type: text/html; charset=utf-8");
class Supply extends SP_Controller {
	function __construct() {
		parent::__construct();
        $this->lang->load('supply');
	}
	protected function user_ajax() {
		$retAjax = $this->common->checkLoginAjax();
		if($retAjax['status'] == 'n') {
			echo $this->myjson->encode($retAjax);
			exit;
		}
	}
    protected function check($user_id = 0) {
        return 0;//TODO
    }
	/*申请供应
	 *Kim
	 */
	function supply_app() {
		$url = sys_auth(_BASE_.'/supply/supply_app');
		$this->common->checkLogin($url);
		$user_id = intval($this->session->userdata('user_id'));
        $joinArr = array(
            'user' => 'user.id=supply.user_id',
            'supply_info' => 'supply_info.user_id=supply.user_id'
        );
        $data = $this->common->findOneJoin('supply', $joinArr, "supply.user_id='$user_id'", 'name, weight, total, spec, supply.is_ok AS firstOk, supply_info.is_ok AS nextOk, account_type, sfrz_img, gzrz_img, xyrz_img, srrz_img, fcrz_img, gcrz_img');
        $data['user_id'] = $user_id;
		$this->load->view('supply/supply_app', $data);
	}
	/*处理申请资料
	 *kim
	 */
	function supply_ok() {
		if(IS_POST == 'POST') {
            $this->user_ajax();
			$user_id = intval($this->session->userdata('user_id'));
            $arr['user_id'] = $user_id;
            $arr['name'] = $this->input->post('name', true);
            $arr['weight'] = $this->input->post('weight', true);
            $arr['total'] = $this->input->post('total', true);
            $arr['spec'] = $this->input->post('spec', true);
            $supply = $this->common->findOne('supply', 'user_id='.$user_id, 'is_ok');
            if($supply['is_ok'] == 1) {
                $this->common->upd('supply', $arr, 'user_id='.$user_id);
                $retAjax['status'] = 'y';
                $retAjax['info'] = $this->lang->line('update_success');
            }
            else {
                $arr['is_ok'] = 1;
                $this->common->add('supply',$arr);
                $retAjax['status'] = 'y';
                $retAjax['info'] = $this->lang->line('save_success');
            }
            echo $this->myjson->encode($retAjax);
		}
	}
	/*上传照片处理
	 *kim
	 */
	function supply_upload() {
		if(IS_POST == 'POST') {
            $this->load->library('curl');
            $obj = new myjson;
            $verifyToken = md5('gxunc' . $this->input->post('timestamp'));
            $user_id = sys_auth($this->input->post('uid', true), 'DECODE');
            if(!$user_id) {
                $retAjax['status'] = 'n';
                $retAjax['info'] = $this->lang->line('login_expire');
                $retAjax['url'] =  _BASE_.'/user/login';
            }
            if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
                //上传远程图片
                $ch = new curl();
                $updata = Array(
                    'token_key' => MD5(MD5("gxunc").substr(MD5('g1u2x3u4n5c6h7e8n9g'),5,20)),
                    'img' => '@'.$_FILES['Filedata']['tmp_name'],
                    'name' => $_FILES['Filedata']['name'],
                    'dir' => 'supply/{y}/{m}',
                    'thumb_width' => '350',
                    'thumb_height' => '350',
                    'maxsize' => '2',
                    'allow_types' => 'jpg|png|jpeg|gif',
                    'WATER_PIC' => ''
                );
                $rets = $ch->set_post(_FILE_PHP_.'/upload.php', $updata);
                $fs = $this->myjson->decode($rets);
                if($fs['flag']<0) {
                    $retAjax['status'] = 'n';
                    $retAjax['info'] = sprinf($this->lang->line('upload_fail'), $fs['name']);
                }
                else {
                    $img = $this->input->post('uptype', true) . '_img';
                    $info = $this->common->findOne('supply_info', 'user_id='.$user_id);
                    if($info) {
                        $data[$img] =  $info[$img].$fs['dir'].$fs['name'].',';
                        $this->common->upd('supply_info', $data, 'user_id=' . $user_id);
                    }
                    else {
                        $data['user_id'] = $user_id;
                        $data['is_ok'] = $this->check($user_id);
                        $data[$img] = $fs['dir'].$fs['name'].',';
                        $this->common->add('supply_info', $data, 'user_id=' . $user_id);
                    }
                    $retAjax['status'] = 'y';
                    $retAjax['info'] =  $this->lang->line('upload_success');
               }
            }
            echo $obj->encode($retAjax);
		}
	}
	/* 添加供应链申请
	 *kim
	 */
	function supply_add() {
        if(IS_POST == 'POST') {
            $this->user_ajax();
            $user_id = intval($this->session->userdata('user_id'));
            $data['user_id'] = intval($this->session->userdata('user_id'));
            $data['addtime'] = gmtime();
            $data['is_ok'] = 0;
            $this->common->add('supply_per', $data, 'user_id='.$user_id);
            $retAjax['status'] = 'y';
            $retAjax['info'] = $this->lang->line('supply_success');
            $retAjax['url'] = _BASE_ . '/supply/supply_cash';
            die($this->myjson->encode($retAjax));
        }
	}
	/*
	 * 检查必传图片是否上传完成
	 * kim
	 */
	function upload_check() {
		if(IS_POST == 'POST') {
            $this->user_ajax();
			$user_id = intval($this->session->userdata('user_id'));
			$user = $this->common->findOne('user','id='.$user_id, 'is_seller');
			$supply = $this->common->findOne('supply', 'user_id='.$user_id);
			$data = array('status'=>0,'info'=>'');
	        //TODO
			echo $this->myjson->encode($data);exit;
		}
	}
}