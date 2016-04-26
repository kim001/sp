<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Content-type: text/html; charset=utf-8");

function md5Str($str) {
	return MD5(MD5("gxunc").substr(MD5($str),5,20));
}
function autoVer($url) {
	$ver = date("ynj", filemtime(ROOT_PATH."/public/default/".$url));
	return _PUB_DEFAULT_.'/'.$url.'?v='.$ver;
}
/*跳转
 *Gxunc
 */
function jsGourl($URL, $Tag = "self", $Msg = '') {
	echo("<SCRIPT LANGUAGE=\"JavaScript\">");
	if($Msg != '')
		echo("alert('".$Msg."');");
	echo($Tag.".location='".$URL."';");
	echo("</SCRIPT>");
	Return 1;
}
function gmtime() {
	return time();
}
/*文件
 *Gxunc
 */
function file_list($path) {
	$handle = opendir($path); //当前目录  		  
	while (false !== ($file = readdir($handle))) {
  
		list($filesname,$kzm)=explode(".",$file);//获取扩展名
		if($kzm=="gif" or $kzm=="jpg" or $kzm=="JPG" or $kzm=="png") { //文件过滤  
			if (!is_dir('./'.$file)) { //文件夹过滤
				$arr[]=$file;
				$i++; //记录图片总张数
			}  
		} 
	}
	return $arr;
}
//循环删除目录和文件函数
function file_del($dirName) {
	if ( $handle = opendir( "$dirName" ) ) {
		while ( false !== ( $item = readdir( $handle ) ) ) {
			if ( $item != "." && $item != ".." ) {
				if ( is_dir( "$dirName/$item" ) ) {
					delDirAndFile( "$dirName/$item" );
				}
				else {
					unlink( "$dirName/$item" );
				}
			}
		}
		closedir( $handle );
		rmdir( $dirName );
	}
}
//条件
function inWhereByField($field, $arr) {
	if(!is_array($arr))
		return '参数错误';
	$where = '';
	foreach($arr as $val) {
		$where .= $val['id'].',';
	}
	$where = $field.' IN ('.trim($where, ',').')';
	return $where;
}

function real_ip() {
	static $realip = NULL;
	if ($realip !== NULL)
		return $realip;
	if (isset($_SERVER)) {
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
			/* 取X-Forwarded-For中第一个非unknown的有效IP字符串 */
			foreach ($arr AS $ip){
				$ip = trim($ip);
				if ($ip != 'unknown')
				{
					$realip = $ip;
					break;
				}
			}
		}
		elseif (isset($_SERVER['HTTP_CLIENT_IP']))
			$realip = $_SERVER['HTTP_CLIENT_IP'];
		else{
			if (isset($_SERVER['REMOTE_ADDR'])){
				$realip = $_SERVER['REMOTE_ADDR'];
			}
			else
				$realip = '0.0.0.0';
		}
	}
	else {
		if (getenv('HTTP_X_FORWARDED_FOR'))
			$realip = getenv('HTTP_X_FORWARDED_FOR');
		elseif (getenv('HTTP_CLIENT_IP'))
			$realip = getenv('HTTP_CLIENT_IP');
		else
			$realip = getenv('REMOTE_ADDR');
	}
	preg_match("/[\d\.]{7,15}/", $realip, $onlineip);
	$realip = !empty($onlineip[0]) ? $onlineip[0] : '0.0.0.0';
	return $realip;
}
//字符串
function cutStr($str, $len, $charset="utf-8") {
	//如果截取长度小于等于0，则返回空
	if( !is_numeric($len) or $len <= 0 ) {
		return "";
	}
	//如果截取长度大于总字符串长度，则直接返回当前字符串
	$sLen = strlen($str);
	if( $len >= $sLen ) {
		return $str;
	}
	//判断使用什么编码，默认为utf-8
	if ( strtolower($charset) == "utf-8" ) {
		$len_step = 3; //如果是utf-8编码，则中文字符长度为3  
	}
	else {
		$len_step = 2; //如果是gb2312或big5编码，则中文字符长度为2
	} 
	//执行截取操作
	$len_i = 0; 
	//初始化计数当前已截取的字符串个数，此值为字符串的个数值（非字节数）
	$substr_len = 0; //初始化应该要截取的总字节数
	for( $i=0; $i < $sLen; $i++ ) {
		if ( $len_i >= $len ) break; //总截取$len个字符串后，停止循环
		//判断，如果是中文字符串，则当前总字节数加上相应编码的中文字符长度
		if( ord(substr($str,$i,1)) > 0xa0 ) {
			$i += $len_step - 1;
			$substr_len += $len_step;
		}
		else { //否则，为英文字符，加1个字节
			$substr_len ++;
		}
		$len_i ++;
	}
	$result_str = substr($str,0,$substr_len );
	if(strlen($str) > $substr_len)$result_str = $result_str.'...';
	return $result_str;
}

//计算文件大小
function getRealSize($size) { 
	$kb = 1024;         // Kilobyte
	$mb = 1024 * $kb;   // Megabyte
	$gb = 1024 * $mb;   // Gigabyte
	$tb = 1024 * $gb;   // Terabyte
	if($size < $kb) { 
		return $size." B";
	}
	else if($size < $mb) { 
		return round($size/$kb,2)." KB";
	}
	else if($size < $gb) { 
		return round($size/$mb,2)." MB";
	}
	else if($size < $tb) { 
		return round($size/$gb,2)." GB";
	}
	else { 
		return round($size/$tb,2)." TB";
	}
}
//计算目录大小
function getDirSize($dir) { 
	$sizeResult = 0;
	$handle = opendir($dir);
	
	while (false!==($FolderOrFile = readdir($handle)))
	{ 
		if($FolderOrFile != "." && $FolderOrFile != "..") { 
			if(is_dir("$dir/$FolderOrFile")) { 
				$sizeResult += getDirSize("$dir/$FolderOrFile"); 
			}
			else { 
				$sizeResult += filesize("$dir/$FolderOrFile"); 
			}
		}    
	}
	closedir($handle);
	return $sizeResult;
}
// 压缩
function listfiles($dir = ".", $faisunZIP) {
	$sub_file_num = 0;
	if (is_file($dir)) {
		
		if (realpath($faisunZIP->gzfilename) != realpath("$dir")) {
			$mydir = trim(substr($dir, strrpos($dir, '/')), '/');
			$faisunZIP->addfile(implode('', file("$dir")), "$mydir");
			return 1;
		}
		return 0;
	}
	$handle = opendir("$dir");
	while ($file = readdir($handle)) {
		if($file == "." || $file == "..")
			continue;
		if(is_dir("$dir/$file")) {
			$sub_file_num += listfiles("$dir/$file", $faisunZIP);
		} 
		else {
			if (realpath($faisunZIP->gzfilename) != realpath("$dir/$file")) {
				$mydir = trim(substr($dir, strrpos($dir, '/')), '/');
				$faisunZIP->addfile(implode('', file("$dir/$file")), "$mydir/$file");
				$sub_file_num++;
			}
		}
	}
	closedir($handle);
	if (!$sub_file_num)
	$faisunZIP->addfile("", "$dir/");
	return $sub_file_num;
}




//加密
function sys_auth($string, $operation = 'ENCODE', $key = 'GXUNC', $expiry = 0) {
	$key_length = 4;
	//$key = md5($key != '' ? $key : pc_base::load_config('system', 'auth_key'));
	$fixedkey = md5($key);
	$egiskeys = md5(substr($fixedkey, 16, 16));
	$runtokey = $key_length ? ($operation == 'ENCODE' ? substr(md5(microtime(true)), -$key_length) : substr($string, 0, $key_length)) : '';
	$keys = md5(substr($runtokey, 0, 16) . substr($fixedkey, 0, 16) . substr($runtokey, 16) . substr($fixedkey, 16));
	$string = $operation == 'ENCODE' ? sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$egiskeys), 0, 16) . $string : base64_decode(substr($string, $key_length));

	$i = 0; $result = '';
	$string_length = strlen($string);
	for ($i = 0; $i < $string_length; $i++){
		$result .= chr(ord($string{$i}) ^ ord($keys{$i % 32}));
	}
	if($operation == 'ENCODE') {
		return $runtokey . str_replace('=', '', base64_encode($result));
	} else {
		if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$egiskeys), 0, 16)) {
			return substr($result, 26);
		} else {
			return '';
		}
	}
}
function isMobile($mobile) {
	$strlen = strlen($mobile);
	if(!preg_match("/^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/", $mobile)) {
		return false;
	}
	elseif ($strlen != 11) {
		return false;
	}
	return true;
}
function telStr($str) {
	$len = strlen($str)/2;
	return substr_replace($str,str_repeat('*',$len),ceil(($len)/2),$len);
}
function isEmail($email) {
	return strlen($email) > 6 && preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $email);
}
function emailUrl($email) {
	return "http://mail.".trim(substr($email, strrpos($email, '@')), '@');
}
function emailStr($str) {
	$arr = explode('@', $str);
	$len = strlen($arr[0])/2;
	return substr_replace($arr[0],str_repeat('*',$len),ceil(($len)/2),$len).'@'.$arr[1];
}
function randStr($length = 6) {
	$chars = '0123456789';
	for ($i = 0; $i < strlen($chars); $i++) {
		$arr[$i] = $chars[$i];
	}
	mt_srand((double) microtime() * 1000000);
	shuffle($arr);
	return substr(implode('', $arr), 4, $length);
}
function get_millisecond(){  
	list($usec, $sec) = explode(" ", microtime());   
	$msec = round($usec*1000);  
	return $msec;
}
/*截取性别
 *Khd
 */
function cardSub($card) {
	$birth = strlen($card)==15 ? ('19' . substr($card, 6, 6)) : substr($card, 6, 8);
	$birth = strInsert($birth, 4, '-');
	$birth = strInsert($birth, 7, '-');
	$sex = substr($card, strlen($card) == 18 ? 16 : 14, 1)%2 > 0 ? 0 : 1;
	$arr['birthday'] = $birth;
	$arr['sex'] = $sex;
	return $arr;
}
function strInsert($str, $i, $subStr) {
	for($j=0; $j<$i; $j++){
		$startStr .= $str[$j];
	}
	for ($j=$i; $j<strlen($str); $j++){
		$lastStr .= $str[$j];
	}
	$str = ($startStr.$subStr.$lastStr);
	return $str;
}
function micTime($name) {
	$time = explode ( " ", microtime () );
	$time = $time [1] . floor($time [0] * 1000);
	if(strlen($time) == 12) {
		$time .= "0";
	}
	return $name.$time;
}
function price_format($price, $price_format = 0){
	switch(intval($price_format)) {
		case 0:
			//$price = intval($price) == 0 ? 0 : $price;
			$price = number_format($price, 2, '.', '');
			$price = sprintf('%.2f', $price);
			break;
		case 1: // 保留不为 0 的尾数
			$price = preg_replace('/(.*)(\\.)([0-9]*?)0+$/', '\1\2\3', number_format($price, 2, '.', ''));
			if (substr($price, -1) == '.') {
				$price = substr($price, 0, -1);
			}
			break;
		case 2: // 不四舍五入，保留1位
			$price = substr(number_format($price, 2, '.', ''), 0, -1);
			break;
		case 3: // 直接取整
			$price = intval($price);
			break;
		case 4: // 四舍五入，保留 1 位
			$price = number_format($price, 1, '.', '');
			break;
		case 5: // 先四舍五入，不保留小数
			$price = round($price);
			break;
	}
	return $price;
}
function safe_replace($string) {
	$string = str_replace('%20','',$string);
	$string = str_replace('%27','',$string);
	$string = str_replace('%2527','',$string);
	$string = str_replace('*','',$string);
	$string = str_replace('"','&quot;',$string);
	$string = str_replace("'",'',$string);
	$string = str_replace('"','',$string);
	$string = str_replace(';','',$string);
	$string = str_replace('<','&lt;',$string);
	$string = str_replace('>','&gt;',$string);
	$string = str_replace("{",'',$string);
	$string = str_replace('}','',$string);
	$string = str_replace('\\','',$string);
	return $string;
}
function trim_script($str)  {
	if(is_array($str)) {
		foreach ($str as $key => $val) {
			$str[$key] = trim_script($val);
		}
	}
	else {
		$str = preg_replace ( '/\<([\/]?)script([^\>]*?)\>/si', '&lt;\\1script\\2&gt;', $str );
		$str = preg_replace ( '/\<([\/]?)iframe([^\>]*?)\>/si', '&lt;\\1iframe\\2&gt;', $str );
		$str = preg_replace ( '/\<([\/]?)frame([^\>]*?)\>/si', '&lt;\\1frame\\2&gt;', $str );
		$str = preg_replace ( '/]]\>/si', ']] >', $str );
	}
	return $str;
}
function safeParam($param) {
	return safe_replace(trim_script($param));
}
/*商户中心*/
function getfirstchar($s0) {	//获取首字母
    $fchar = ord($s0{0});
	if($fchar<160) {	//非中文
		if($fchar>=48 && $fchar<=57) {
			return '1'; //数字
		}
		elseif($fchar>=65 && $fchar<=90) {
			return chr($fchar); // A--Z 
		}
		elseif($fchar>=97 && $fchar<=122) {
			return chr($fchar-32); // a--z 
		}
		else {
			return '~'; //其他 
		}
	}
	else {
		//if($fchar >= ord("A") and $fchar <= ord("z") )return strtoupper($s0{0});
		$s1 = iconv("UTF-8","gb2312", $s0);
		$s2 = iconv("gb2312","UTF-8", $s1);
		if($s2 == $s0){$s = $s1;}else{$s = $s0;}
		$asc = ord($s{0}) * 256 + ord($s{1}) - 65536;
		if($asc >= -20319 and $asc <= -20284) return "A";
		if($asc >= -20283 and $asc <= -19776) return "B";
		if($asc >= -19775 and $asc <= -19219) return "C";
		if($asc >= -19218 and $asc <= -18711) return "D";
		if($asc >= -18710 and $asc <= -18527) return "E";
		if($asc >= -18526 and $asc <= -18240) return "F";
		if($asc >= -18239 and $asc <= -17923) return "G";
		if($asc >= -17922 and $asc <= -17418) return "I";
		if($asc >= -17417 and $asc <= -16475) return "J";
		if($asc >= -16474 and $asc <= -16213) return "K";
		if($asc >= -16212 and $asc <= -15641) return "L";
		if($asc >= -15640 and $asc <= -15166) return "M";
		if($asc >= -15165 and $asc <= -14923) return "N";
		if($asc >= -14922 and $asc <= -14915) return "O";
		if($asc >= -14914 and $asc <= -14631) return "P";
		if($asc >= -14630 and $asc <= -14150) return "Q";
		if($asc >= -14149 and $asc <= -14091) return "R";
		if($asc >= -14090 and $asc <= -13319) return "S";
		if($asc >= -13318 and $asc <= -12839) return "T";
		if($asc >= -12838 and $asc <= -12557) return "W";
		if($asc >= -12556 and $asc <= -11848) return "X";
		if($asc >= -11847 and $asc <= -11056) return "Y";
		if($asc >= -11055 and $asc <= -10247) return "Z";
		return null;
	}
}
function nameStr($user_name) {
	$strlen = mb_strlen($user_name, 'utf-8');
	$firstStr = mb_substr($user_name, 0, 1, 'utf-8');
	$lastStr = mb_substr($user_name, -1, 1, 'utf-8');
	return $strlen == 2 ? $firstStr . str_repeat('*', mb_strlen($user_name, 'utf-8') - 1) : $firstStr . str_repeat("*", $strlen - 2) . $lastStr;
}