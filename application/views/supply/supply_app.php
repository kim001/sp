<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8"/>
	<meta name="content-type" content="text/html; charset=utf-8" />
	<title><?php echo $this->config->item('seo_title');?>-申请供应</title>
	<meta name="Keywords" content="<?php echo $this->config->item('seo_keywords');?>" />
    <meta name="Description" content="<?php echo $this->config->item('seo_description');?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="renderer" content="webkit">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="baidu-site-verification" content="" />
    <meta name="csrf-token" content="">
    <link rel="Bookmark" type="image/x-icon" href="" />
    <link rel="shortcut icon" type="image/x-icon" href="" />
	<!--************js、css文件引入*************-->
	<link rel="stylesheet" type="text/css" href="<?php echo autoVer('css/common.css');?>"/>
	<link rel="stylesheet" type="text/css" href="<?php echo autoVer('css/main.css');?>"/>
	<link rel="stylesheet" type="text/css" href="<?php echo autoVer('css/loan.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo autoVer('css/load_form.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo autoVer('css/style.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo autoVer('css/uploadify.css');?>">

	<script src="<?php echo autoVer('js/jquery1.11.2.js');?>" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo autoVer('js/main.js');?>" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo autoVer('js/index.js');?>" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo autoVer('js/common.js')?>" type="text/javascript" charset="utf-8"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo autoVer('plugin/validform/css/style.css');?>">
	<script type="text/javascript" src="<?php echo autoVer('plugin/validform/validform_min.js');?>"></script>
	<script src="<?php echo autoVer("/js/jquery.uploadify.min.js");?>" type="text/javascript"></script>
	
	<style type="text/css">
	.step li {cursor: pointer;}
	.jsblock{display: block;}
	.buttonno{background: #d7d7d7 !important; border: 1px solid #D7D7D7 !important;}
	.buttonok{background: #df0024 !important; border: 1px solid #df0024 !important;}
	.input
	</style>

</head>
<!--头部html-->
<?php $this->load->view('header');?>

<!--首页详情1正文html-->
<div class="index_detail_body">
	<div class="banner_border_box_H"></div>
	<div class="loan_body_box container">
		<!-- 头部流程图 -->
		<div class="state">
			<ul>
				<li class="item active">
					<a href="javascript:;">
						<span class="icon icon-arrow"></span><br>
						填写申请信息
					</a>
				</li>
				<li class="dot">……</li>
				<li class="item active">
					<a href="javascript:;">
						<span class="icon icon-pencil"></span><br>
						缴纳保证金
					</a>
				</li>
				<li class="dot">……</li>
				<li class="item">
					<a href="javascript:;">
						<span class="icon icon-scales"></span><br>审核
					</a>
				</li>
				<li class="dot">……</li>
				<li class="item">
					<a href="javascript:;">
						<span class="icon icon-loop"></span><br>平台购货
					</a>
				</li>
				<li class="dot">……</li>
				<li class="item">
					<a href="javascript:;">
						<span class="icon icon-money"></span><br>到达仓库
					</a>
				</li>
			</ul>
		</div>
		
		<div class="state-body" style="display:block;">
			<div class="panel">
				<div class="panel-header">
					<h2>供应链申请信息：</h2>
					<a href="javascript:;" class="link yl_btn">预览</a>
				</div>
				<div class="panel-content">
					<ul class="step">
						<li <?php if($firstOk == 1){ ?> class="success" <?php }else{ ?> class="active" <?php } ?> >申请资料 <span></span></li>
						<li <?php if($nextOk == 1){ ?> class="success" <?php }else{ ?> class="active" <?php } ?> >上传资料 <span></span></li>
						<li ><button type="button" id="btnsubl" class="btn-wsd" onclick="goSubmit();">提交申请</button></li>
					</ul>
					<form action="<?php echo _BASE_;?>/supply/supply_ok" method="post" id="sqform">
						<div class="step-body jsblock">
							<div class="form-horizontal">
								<div class="form-group">
									<label class="form-label"><span class="text-red">*</span>产品名称：</label>
									<div class="form-control">
										<textarea name="name" class="input addinput" placeholder="产品名称" dataType="*2-20" errormsg="真实产品名称为2-20个字符！" nullmsg="真实产品名称！" autocomplete="off"><?php echo $name;?></textarea>
									</div>
									<div class="Validform_checktip"></div>
								</div>
								<div class="form-group">
									<label class="form-label"><span class="text-red">*</span>产品重量：</label>
									<div class="form-control">
										<input name="weight" class="input" placeholder="产品重量" type="text" style="width:280px;" dataType="*2-10" errormsg="请正确填写产品重量！" nullmsg="请输入产品重量！" autocomplete="off" value="<?php echo $weight;?>">
									</div>
									<div class="Validform_checktip">例：100kg</div>
								</div>
								<div class="form-group">
									<label class="form-label"><span class="text-red">*</span>产品总额：</label>
									<div class="form-control">
										<input name="total" class="input" placeholder="产品总额"  type="text" style="width:280px;" maxlength="9" dataType="money" errormsg="请保留两位小数！" nullmsg="请输入产品总额！" autocomplete="off" value="<?php echo $total;?>">
									</div>
									<div class="Validform_checktip">例：0.00</div>
								</div>
								<div class="form-group">
									<label class="form-label"><span class="text-red">*</span>产品规格：</label>
									<div class="form-control">
										<textarea name="spec" class="input addinput" placeholder="产品规格" dataType="*2-200" errormsg="产品规格为2-200个字符！" nullmsg="请输入产品规格！" autocomplete="off"> <?php echo $spec;?> </textarea>
									</div>
									<div class="Validform_checktip" style="margin-top: 50px;">例：粉状：200件</div>
								</div>
								<div class="form-group">
									<div class="form-control">
										<input type="hidden" value="1215154" name="tmpdir" id="id_file">
										<button class="btn-login continue supply_info_submit" type="button" >保存并继续</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				<form>
					<div class="step-body">
						<div class="form-horizontal">
							<div class="form-group">
								<label class="form-label2">必要认证资料</label>
								<div class="form-control">
									<ul class="uploadlist clearfix">
										<li class="item-1">
											身份认证
											<div class="uploadstate">
												<span <?php if($sfrz_img){ ?> class="uplaoded" <?php }?> > </span>
											</div>
											<a class="text-blue" href="javascript:;" id="sfrz">补充上传</a>
										</li>
										<?php if($account_type) { ?>
										<li class="item-2">
											营业执照
											<div class="uploadstate">
												<span <?php if($gzrz_img){ ?> class="uplaoded" <?php }?> ></span>
											</div>
											<a class="text-blue" href="javascript:;" id="gzrz">补充上传</a>
										</li>
										<li class="item-3">
											税务登记证
											<div class="uploadstate">
												<span <?php if($xyrz_img){ ?> class="uplaoded" <?php }?> ></span>
											</div>
											<a class="text-blue" href="javascript:;" id="xyrz">补充上传</a>
										</li>
										<li class="item-4">
											组织机构
											<div class="uploadstate">
												<span <?php if($srrz_img){ ?> class="uplaoded" <?php }?> ></span>
											</div>
											<a class="text-blue" href="javascript:;" id="srrz">上传资料</a>
										</li>
										<?php }?>
									</ul>
								</div>
							</div>

							<div class="form-group">
								<label class="form-label2">可选认证资料</label>
								<div class="form-control">
									<ul class="uploadlist clearfix">
										<?php if($account_type) { ?>
										<li class="item-5">
											办公场地租赁合同
											<div class="uploadstate">
												<span <?php if($fcrz_img){ ?> class="uplaoded" <?php }?> ></span>
											</div>
											<a class="text-blue" href="javascript:;" id="fcrz">上传资料</a>
										</li>
										<?php }?>
										<li class="item-6" style="margin-top: 20px;">
											工作证明函
											<div class="uploadstate">
												<span <?php if($gcrz_img){ ?> class="uplaoded" <?php }?> ></span>
											</div>
											<a class="text-blue" href="javascript:;" id="gcrz">上传资料</a>
										</li>
									</ul>
								</div>
							</div>

							<div class="form-group">
								<div class="form-control">
									<button class="btn-login btn-wsd buttonno" id="btnsubr" style="margin-left: 138px;" type="button" onclick="goSubmit();">提交申请</button>
								</div>
								<div class="Validform_checktip zlTip"></div>
							</div>
						</div>
					</div>
				</form>
				</div>
			</div>
		</div>
		
	</div><!-- loan_body_box闭合点 -->
	<!-- 预览框 -->
	<div id="yl_box" class="container">
		<div class="yl_top">借款信息预览</div>
		<div class="yl_main">
			<div class="yl_header">
				<ul>
					<li>借款金额<span>￥50,000</span></li>
					<li>借款期限<span>3个月</span></li>
					<li>月综合费率<span>0.88% </span></li>
					<li>月还款额<span>￥17106.67</span></li>
				</ul>
			</div>
			<!-- 个人信息 -->
			<div class="yl_item">
				<div class="yl_item_top">
					<h2>个人信息</h2>
				</div>
				<div class="yl_infor_box">
					<div class="yl_infor_l">
						<table>
							<tbody>
								<tr>
									<td width="120" align="right">姓名</td>
									<td width="170" align="left">王腾蛇</td>
								</tr>
								<tr>
									<td align="right">性别</td>
									<td width="" align="left">男</td>
								</tr>
								<tr>
									<td align="right">出生日期</td>
									<td width="" align="left">1999-02-21</td>
								</tr>
								<tr>
									<td align="right">最高学历</td>
									<td width="" align="left">高中或以下</td>
								</tr>
								<tr>
									<td align="right">入学年份</td>
									<td width="" align="left">1980</td>
								</tr>
								<tr>
									<td align="right">毕业院校</td>
									<td width="" align="left">--</td>
								</tr>
								<tr>
									<td align="right">居住地电话</td>
									<td width="" align="left">0755-86524785</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="yl_infor_r">
						<table>
							<tbody>
								<tr>
									<td width="120" align="right">手机号</td>
									<td width="170" align="left">163 **** 5568</td>
								</tr>
								<tr>
									<td align="right">身份证</td>
									<td width="" align="left">44**** **** **** ****</td>
								</tr>
								<tr>
									<td align="right">籍贯</td>
									<td width="" align="left">上海:黄浦</td>
								</tr>
								<tr>
									<td align="right">户口所在地</td>
									<td width="" align="left">北京:东城</td>
								</tr>
								<tr>
									<td align="right">居住地址</td>
									<td width="" align="left">江苏</td>
								</tr>
								<tr>
									<td align="right">居住地邮编</td>
									<td width="" align="left">512364</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- 家庭信息 -->
			<div class="yl_item">
				<div class="yl_item_top">
					<h2>家庭信息</h2>
				</div>
				<div class="yl_infor_box">
					<div class="yl_infor_l">
						<!-- 婚姻状况 -->
						<table>
							<thead>
								<tr>
									<td colspan="2"><span>婚姻状况</span></td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td width="120" align="right">婚姻状况</td>
									<td width="170" align="left">未婚</td>
								</tr>
								<tr>
									<td align="right">有无子女</td>
									<td width="" align="left">无</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="yl_infor_r">
						<!-- 直系亲属 -->
						<table>
							<thead>
								<tr>
									<td colspan="2"><span>直系亲属</span></td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td width="120" align="right">姓名</td>
									<td width="170" align="left">宋小宝</td>
								</tr>
								<tr>
									<td align="right">手机号</td>
									<td width="" align="left">25645872365</td>
								</tr>
								<tr>
									<td align="right">关系</td>
									<td width="" align="left">哥</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="yl_infor_box">
					<div class="yl_infor_l">
						<!-- 其他联系人 -->
						<table>
							<thead>
								<tr>
									<td colspan="2"><span>其他联系人</span></td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td width="120" align="right">姓名</td>
									<td width="170" align="left">宋小宝</td>
								</tr>
								<tr>
									<td align="right">手机号</td>
									<td width="" align="left">25645872365</td>
								</tr>
								<tr>
									<td align="right">关系</td>
									<td width="" align="left">哥</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="yl_infor_r">
						<!-- 其他联系人2 -->
						<table>
							<thead>
								<tr>
									<td colspan="2"><span>其他联系人2</span></td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td width="120" align="right">姓名</td>
									<td width="170" align="left">宋小宝</td>
								</tr>
								<tr>
									<td align="right">手机号</td>
									<td width="" align="left">25645872365</td>
								</tr>
								<tr>
									<td align="right">关系</td>
									<td width="" align="left">哥</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- 工作信息 -->
			<div class="yl_item">
				<div class="yl_item_top">
					<h2>工作信息</h2>
				</div>
				<div class="yl_infor_box">
					<div class="yl_infor_l">
						<table>
							<tbody>
								<tr>
									<td width="120" align="right">姓名</td>
									<td width="170" align="left">王腾蛇</td>
								</tr>
								<tr>
									<td align="right">性别</td>
									<td width="" align="left">男</td>
								</tr>
								<tr>
									<td align="right">出生日期</td>
									<td width="" align="left">1999-02-21</td>
								</tr>
								<tr>
									<td align="right">最高学历</td>
									<td width="" align="left">高中或以下</td>
								</tr>
								<tr>
									<td align="right">入学年份</td>
									<td width="" align="left">1980</td>
								</tr>
								<tr>
									<td align="right">毕业院校</td>
									<td width="" align="left">--</td>
								</tr>
								<tr>
									<td align="right">居住地电话</td>
									<td width="" align="left">0755-86524785</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="yl_infor_r">
						<table>
							<tbody>
								<tr>
									<td width="120" align="right">手机号</td>
									<td width="170" align="left">163 **** 5568</td>
								</tr>
								<tr>
									<td align="right">身份证</td>
									<td width="" align="left">44**** **** **** ****</td>
								</tr>
								<tr>
									<td align="right">籍贯</td>
									<td width="" align="left">上海:黄浦</td>
								</tr>
								<tr>
									<td align="right">户口所在地</td>
									<td width="" align="left">北京:东城</td>
								</tr>
								<tr>
									<td align="right">居住地址</td>
									<td width="" align="left">江苏</td>
								</tr>
								<tr>
									<td align="right">居住地邮编</td>
									<td width="" align="left">512364</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- 资产信息 -->
			<div class="yl_item">
				<div class="yl_item_top">
					<h2>资产信息</h2>
				</div>
				<div class="yl_infor_box">
					<div class="yl_infor_l">
						<table>
							<tbody>
								<tr>
									<td width="120" align="right">姓名</td>
									<td width="170" align="left">王腾蛇</td>
								</tr>
								<tr>
									<td align="right">性别</td>
									<td width="" align="left">男</td>
								</tr>
								<tr>
									<td align="right">出生日期</td>
									<td width="" align="left">1999-02-21</td>
								</tr>
								<tr>
									<td align="right">最高学历</td>
									<td width="" align="left">高中或以下</td>
								</tr>
								<tr>
									<td align="right">入学年份</td>
									<td width="" align="left">1980</td>
								</tr>
								<tr>
									<td align="right">毕业院校</td>
									<td width="" align="left">--</td>
								</tr>
								<tr>
									<td align="right">居住地电话</td>
									<td width="" align="left">0755-86524785</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="yl_infor_r">
						<table>
							<tbody>
								<tr>
									<td width="120" align="right">手机号</td>
									<td width="170" align="left">163 **** 5568</td>
								</tr>
								<tr>
									<td align="right">身份证</td>
									<td width="" align="left">44**** **** **** ****</td>
								</tr>
								<tr>
									<td align="right">籍贯</td>
									<td width="" align="left">上海:黄浦</td>
								</tr>
								<tr>
									<td align="right">户口所在地</td>
									<td width="" align="left">北京:东城</td>
								</tr>
								<tr>
									<td align="right">居住地址</td>
									<td width="" align="left">江苏</td>
								</tr>
								<tr>
									<td align="right">居住地邮编</td>
									<td width="" align="left">512364</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- 资产信息 -->
			<div class="yl_item">
				<div class="yl_item_top">
					<h2>资产信息</h2>
				</div>
				<div class="yl_infor_box">
					<div class="yl_infor_l">
						<!-- 必要上传资料 -->
						<table>
							<thead>
								<tr>
									<td colspan="2"><span>必要上传资料</span></td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td width="120" align="right">身份认证</td>
									<td width="170" align="left">审核中</td>
								</tr>
								<tr>
									<td width="120" align="right">信用认证</td>
									<td width="170" align="left">审核中</td>
								</tr>
								<tr>
									<td width="120" align="right">工作认证</td>
									<td width="170" align="left">审核中</td>
								</tr>
								<tr>
									<td width="120" align="right">收入认证</td>
									<td width="170" align="left">审核中</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="yl_infor_r sc">
						<!-- 可选上传资料 -->
						<table>
							<thead>
								<tr>
									<td colspan="2"><span>可选上传资料</span></td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td width="120" align="right">房产认证</td>
									<td width="170" align="left"><a href="javascript:void(0)">未上传</a></td>
								</tr>
								<tr>
									<td width="120" align="right">购车认证</td>
									<td width="170" align="left"><a href="javascript:void(0)">未上传</a></td>
								</tr>
								<tr>
									<td width="120" align="right">手机认证</td>
									<td width="170" align="left"><a href="javascript:void(0)">未上传</a></td>
								</tr>
								<tr>
									<td width="120" align="right">学历认证</td>
									<td width="170" align="left"><a href="javascript:void(0)">未上传</a></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- 关闭按钮 -->
			<div class="yl_close">
				<a href="javascript:void(0)">关闭</a>
			</div>
		</div>
	</div>
</div>
<div id="uploadFile" class="modal">
	<div class="modal-dialog">
		<div class="modal-header">
			<button class="close">X</button>
			<h3 class="modal-title icon-loan">上传资料</h3>
		</div>
		<div class="modal-body">
			<div class="fileupload">
				<div class="upload-explain">
					<div class="uploadtip">
						<h3>资料真实性</h3>
						<p>您上传的信息必须真实可靠，否则一律无法通过审核。</p>
					</div>
					<h4>上传说明：</h4>
					<ol>
						<li>（1）为保证质量，平台限制最多上传10张图片。</li>
						<li>（2）保证图片质量，大小不能超出2MB。</li>
						<li>（3）限制上传格式只能为.jpg，.jpeg，.png格式。<a href="javascript:;" class="text-blue">查看示例</a></li>
					</ol>
					
					<div class="uploaded-list">
						<table>
							<thead>
								<tr>
									<th width="200">文件名</th>
									<th width="150" style="text-align:center;">进度</th>
									<th width="80">大小</th>
									<th width="50">状态</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td colspan="4">
										<div style="height: 200px;overflow-y:auto;overflow-x: hidden; " id="file_upload-queue"></div>
									</td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="4">
										<div style="float:left; width:85px;"><input type="file" id="file_upload" name="file_upload"></div>
										<div style="float:left; padding-left:10px; width:85px;">
										<a href="javascript:$('#file_upload').uploadify('settings', 'formData', {'typeCode':document.getElementById('id_file').value});$('#file_upload').uploadify('upload','*')" class="btn-upload">开始上传</a>
										</div>
										<div style="float:right; padding-left:10px; width:85px;"><a id="cancel" class="btn-cancel" href="javascript:$('#file_upload').uploadify('cancel', '*')">取消上传</a></div>
									</td>
								</tr>
							</tfoot>
						</table>
					</div>
					<div class="mt-10">
						<b class="text-red">警告：</b>我们是一个注重诚信的网络平台。如果我们发现您上传的资料系伪造或有人工修改痕迹，我们会将你加入系统黑名单，永久取消您的申请资格。
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<form action="" method="post" id="zlform">
<div id="uploadConfirm" class="modal">
	<div class="modal-dialog">
		<div class="modal-header">
			<button class="cy_close close">X</button>
			<h3 class="modal-title icon-loan">上传确认   注意：要修改</h3>
		</div>
		<div class="modal-body">
			<div class="confirm-body jclock">
				<div class="form-horizontal">
					<div class="form-group">
						<label class="form-label"><span class="text-red">*</span>产品名称：</label>
						<div class="form-control">
							<input name="name" class="input addinput" placeholder="产品名称" dataType="s2-20" errormsg="真实产品名称为2-20个字符！" nullmsg="真实产品名称！" autocomplete="off" value="<?php echo $name;?>"></input>
						</div>
						<div class="Validform_checktip"></div>
					</div>
					<div class="form-group">
						<label class="form-label"><span class="text-red">*</span>产品重量：</label>
						<div class="form-control">
							<input name="weight" class="input" placeholder="产品重量(g)" type="text" style="width:280px;" dataType="n" errormsg="请输入数字！" nullmsg="请输入产品重量！" autocomplete="off" value="<?php echo $weight;?>">
						</div>
						<div class="Validform_checktip"></div>
					</div>
					<div class="form-group">
						<label class="form-label"><span class="text-red">*</span>产品总额：</label>
						<div class="form-control">
							<input name="total" class="input" placeholder="产品总额"  type="text" style="width:280px;" maxlength="9" dataType="money" errormsg="请保留两位小数！" nullmsg="请输入产品总额！" autocomplete="off" value="<?php echo $total;?>">
						</div>
						<div class="Validform_checktip">例：0.00</div>
					</div>
					<div class="form-group">
						<label class="form-label"><span class="text-red">*</span>产品规格：</label>
						<div class="form-control">
							<input name="spec" class="input addinput" placeholder="产品规格" dataType="*2-200" errormsg="产品规格为2-200个字符！" nullmsg="请输入产品规格！" autocomplete="off" value="<?php echo $spec;?>">
						</div>
						<div class="Validform_checktip" style="margin-top: 50px;">例：粉状：200件</div>
					</div>
					<div class="form-group">
						<div class="form-control">
							<input type="hidden" value="1215154" name="tmpdir" id="id_file">
							<input type="hidden" value="<?php echo $is_supply;?>"  id="is_supply">
							<button class="btn-login continue " type="button" id="subOk">确认<span id="tj_djs"></span></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</form>
<script type="text/javascript">
$(function() {
		//预览表格css修改
		$(".yl_infor_box").find("table tbody").find("td:first-child").css({"padding-right":"15px"});
		$(".yl_close a").bind('click', function(event) {
			$("#yl_box").hide();
			$(".loan_body_box").show();
		});
		/**预览按钮，点击时调用val传入方法**/
		$(".yl_btn").bind('click',function(){
			$("#yl_box").show();
			$(".loan_body_box").hide();
			//调用val传入方法
		});

		/* 阅读协议 */
		$('.protocol label').click(function() {
			if($(this).hasClass('on')) {
				$(this).removeClass('on');
				$(this).children(':checkbox').removeAttr('checked');
			} else {
				$(this).addClass('on');
				$(this).children(':checkbox').attr('checked', 'checked');
			}
		});

		/* 单选 */
		$('.form-control .radio').click(function() {
			$(this).addClass('active').children(':radio').attr('checked', 'checked').parent().siblings().removeClass('active').children(':radio').removeAttr('checked');
		});

		// 默认显示第一屏
		$('.step-body:first').show();
		
		/* 补充上传 */
		$.poplayer({
			triggerBtn: '.uploadlist li a',
            modal: '#uploadFile',
            position: 'fixed'
		});
		$('.step li').click(function () {
			var index = $(this).index();
			var nextnum = $(this).nextAll().length;
			if(nextnum > 0) {
				$('.step li').each(function(i) {
					if(index == i) {
						$(this).addClass('active');
						$('.step-body').eq(index).addClass('jsblock');
					}
					else {
						$('.step li').eq(i).removeClass('active');
						$('.step-body').eq(i).removeClass('jsblock');
					}
				})
			}
		});
	});

	function cuuur() {
		// 左侧状态改变
		$('.step li.active').addClass('success').removeClass('active').next().addClass('active');
		
		// 切换内容
		$('.jsblock').removeClass('jsblock').parent().next().children('.step-body').addClass('jsblock');
	}
	function goSubmit() {
		$is_supply = $('#is_supply').val();
		if($is_supply == 1) {
			$("#uploadConfirm").fadeIn(100);
			subInit();
		}
		else {
			return false;
		}
	}
	$(".cy_close").bind('click', function(event) {
		$("#uploadConfirm").fadeOut(100);
	});
	$('.confirm-body').click(function(e) { //阻止事件冒泡
		e.stopPropagation();
	});
	$('#uploadConfirm').click(function() {
		$("#uploadConfirm").fadeOut(100);
	});
	var timeov=5;
	function timeloop() {
		if (timeov == 0) {
			$('#subOk').addClass('buttonok');
			$('#subOk').attr('onclick', 'subItem()');		
			$('#tj_djs').html('');
			clearTimeout(itimeover);
			timeov = 5;
		} 
		else {
			$('#subOk').removeClass('buttonok');
			$('#subOk').removeAttr('onclick');
			$('#tj_djs').html("("+timeov+")");
			timeov--;
			var itimeover = setTimeout(timeloop, 1000);
		}
		return true;
	}
	function subInit() {
		if(timeov == 5)
			timeloop();
		else
			return false;
	}
	function subItem() {
		$.ajax({
		 type: "POST",
		 url: gxunc+'/supply/supply_add',
		 data: {},
		 async: false,
		 dataType:'json',
		 success: function(ret) {
			ret.jump = typeof(ret.jump) == 'undefined' ? 0 : ret.jump;
			ret.url = typeof(ret.url) == 'undefined' ? '' : ret.url;
			if(ret.jump > 0) {
				$.laytip({
					msg: ret.info,
					jump:ret.jump,
					url:ret.url,
					status:ret.status
				});
				return ret.status == 'n' ? false : true;
			}
			return true;
		}
		});
	}
	supply_app = $("#sqform").Validform({
		tiptype:function(msg,o,cssctl){
			if(!o.obj.is("form")) {
				var objtip=o.obj.parent().siblings(".Validform_checktip");
				cssctl(objtip,o.type);
				objtip.text(msg);
			}
		},
        showAllError:false,
        postonce:false,
        ignoreHidden:true,
        btnSubmit:".btn-login",
        ajaxPost:true,
		btnSubmit:".supply_info_submit",
		datatype:{
			'money' : /(\.\d{2})+/,
		},
        callback:function(ret) {
            ret.jump = typeof(ret.jump) == 'undefined' ? 0 : ret.jump;
            ret.url = typeof(ret.url) == 'undefined' ? '' : ret.url;
            if(ret.status == 'n') {
                $.laytip({
                    msg: ret.info,
                    jump:ret.jump,
                    url:ret.url,
                    status:ret.status
                });
                return false;
            }
            else {
                $.laytip({
                    msg: ret.info,
                    jump:ret.jump,
                    url:ret.url,
                    status:ret.status
                });
                $('.step li').eq(0).attr('class', 'success');
            }
            addInitOk();
            return ret.status == 'n' ? false : true;
        }
	});
	$('.uploadlist li a').click(function (){
		do_upload(this);
	});
	function do_upload(typeobj) {
		var img_id_upload = new Array();//初始化数组，存储已经上传的图片名
		var i = 0;//初始化数组下标
		$(function () {
			$('#file_upload').uploadify({
				'formData': {
					'timestamp': '1451275426',
					'token': 'a06673816244d8b0111fdd45643e79fc',
					'token_key': '008bCQVWCQJSUwYIAgIDBwYPUAICBgUCUlUEUFUA',
					'uptype': $(typeobj).attr('id'),
					'uid': '<?php echo sys_auth($user_id); ?>'
				},
				'auto': false,//关闭自动上传
				//'dataType': "json",
				'removeTimeout': 1,//文件队列上传完成1秒后删除
				'swf': 'http://127.0.0.1/demo/sp/public/default/plugin/uploadify/uploadify.swf',
				'uploader': 'http://127.0.0.1/demo/sp/supply/supply_upload',
				'buttonImage': '<?php echo _PUB_DEFAULT_;?>/images/add-file.png',
				'method': 'post',//方法，服务端可以用$_POST数组获取数据
				'multi': true,//允许同时上传多张图片
				'uploadLimit': 10,//一次最多只允许上传10张图片
				'fileTypeDesc': 'Image Files',//只允许上传图像
				'fileTypeExts': '*.gif; *.jpg; *.png',//限制允许上传的图片后缀
				'fileSizeLimit': '20000KB',//限制上传的图片不得超过200KB
				'onUploadSuccess' : function(file, data, response) {
					$('body').find('#file_upload-queue').html('恭喜你，图片上传成功！');
					var ret = data;
                    //alert(ret);
					//var ret = eval("("+data+")");
					console.info(data);
					console.info(file);
					ret.jump = typeof(ret.jump) == 'undefined' ? 0 : ret.jump;
					ret.url = typeof(ret.url) == 'undefined' ? '' : ret.url;
					if(ret.status == 'n') {
						$.laytip({
							msg: ret.info,
							jump:ret.jump,
							url:ret.url,
							status:ret.status
						});
					}
					else {
						$(typeobj).prev().children('span').attr('class', 'uplaoded');
						$(typeobj).html('补充上传');
						$('.step li').eq(-2).attr('class', 'success');
						//addInitOk();
					}

				},
                'onUploadError' : function(file, errorCode, errorMsg, errorString) {
                    switch(errorCode) {
                        case -100:
                            alert("上传的文件数量已经超出系统限制的！");
                            break;
                        case -110:
                            alert("文件 ["+file.name+"] 大小超出系统限制的！");
                            break;
                        case -120:
                            alert("文件 ["+file.name+"] 大小异常！");
                            break;
                        case -130:
                            alert("文件 ["+file.name+"] 类型不正确！");
                            break;
                    }
                },
				'onQueueComplete': function (queueData) {//上传队列全部完成后执行的回调函数
					// if(img_id_upload.length>0)
					// alert('成功上传的文件有：'+encodeURIComponent(img_id_upload));
				}
				// Put your options here
			});
		});
		var obj = $("#file_upload").children().eq(0);
		if(obj.attr('type')!= "application/x-shockwave-flash"){
			alert('系统检测到您的浏览器没有安装flash插件，为了你能够正常上传图片，建议你安装flash！');
		}
	}
	function addInitOk() {
		$.ajax({
			type: "POST",
			url: gxunc+'supply/upload_check',
			data: {},
			async: true,
			dataType:'json',
			success: function(ret) {
				if(ret.status == 1) {
					$('#btnsubr').removeClass('buttonno');
					$('#btnsubr').addClass('btn-login');
					$("#btnsubl").css("background","#df0024");
					$("#btnsubl").css("border","1px solid #de1737");
					$('.step li').eq(-2).attr('class', 'success');
					$('#is_supply').val(1);
				}
				return true;
			}
		});
	}
</script>
<?php $this->load->view('footer');?>
</body>
</html>
