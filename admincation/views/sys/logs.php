<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="<?php echo _PUB_HOME_;?>/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo _PUB_HOME_;?>/css/select.css" rel="stylesheet" type="text/css" />
<script src="<?php echo _PUB_HOME_;?>/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo _PUB_HOME_;?>/js/select-ui.min.js"></script>
<script src="<?php echo _PUB_HOME_;?>/js/common.js"></script>
<script type="text/javascript">
$(document).ready(function(e) {
    $(".select1").uedSelect({
		width : 345			  
	});
	$(".select2").uedSelect({
		width : 167  
	});
	$(".select3").uedSelect({
		width : 100
	});
});
</script>
</head>
<body>
	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="<?php echo URL_PATH;?>" target="_top">首页</a></li>
    <li><a>系统管理</a></li>
    <li><a>系统日志</a></li>
    </ul>
    </div>
	
	<div class="rightinfo">
    <div class="tools">
    	<ul class="toolbar">
       
        </ul>
		
		<form method="get" action="<?php echo _HOME_URL_;?>/sys/logs" id="searchForm">
		<ul class="seachform">
		<li><label>关键词</label><input name="keyword" type="text" class="scinput" value="<?php echo $keyword;?>" /></li>
		<li><label>年份</label>
		<div class="vocation">
		<select class="select3" name="year">
		<option value=''>全部</option>
		<?php for ($i=date('Y');$i>2000;$i--){
		$str1 = '<option value="'.$i.'"';
		if($i == $year)$str1 .= " selected";
		$str1 .= '>'.$i.'年</option>';
		echo $str1;
		}?>
		</select>
		</div>
		</li>
		
		<li><label>月份</label>  
		<div class="vocation">
		<select class="select3" name="month">
		<option value=''>全部</option>
		<?php for ($i=1;$i<=12;$i++){
			if (strlen($i)==1){
				$ii='0'.$i;
			}else{
				$ii=$i;
			}
			$str2 = '<option value="'.$ii.'"';
			if($ii == $month)$str2 .= " selected";
			$str2 .= '>'.$ii.'月</option>';
			echo $str2;
		}?>
		</select>
		</div>
		</li>
		<li><label>&nbsp;</label><input type="submit" class="scbtn" value="查询" /></li>
		</ul>
		</form>
    </div>
    <table class="tablelist">
    	<thead>
    	<tr>
        <th width=50>管理员编号</th>
        <th width=100>用户</th>
        <th width=350>操作说明</th>
        <th width=100>操作时间</th>
        <th width=100>操作ip</th>
        </tr>
        </thead>
        <tbody>
		<?php foreach($arr as $val){?>
        <tr rel="<?php echo $val['id'];?>">
		<td><?php echo $val['id'];?></td>
		<td><?php echo $val['username'];?></td>
		<td><?php echo cutStr($val['content'], 60);?></td>
		<td><?php echo $val['time'];?></td>
		<td><?php echo $val['ip'];?></td>
        </tr> 
        <?php }?>  
        </tbody>
    </table>
    <div class="pagin"><?php echo $pagestr;?></div>
    </div>
</body>
</html>
