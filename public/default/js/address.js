address = $("#form1").Validform({
	tiptype:function(msg,o,cssctl){
		if(!o.obj.is("form")) {
			var objtip=o.obj.parent().siblings(".Validform_checktip");
			cssctl(objtip,o.type);
			objtip.text(msg);
		}
	},
	showAllError:false,
	postonce:true,
	btnSubmit:".qr",
	ajaxPost:true,
	datatype:{
		"z2-6" : /^[\u4E00-\u9FA5\uf900-\ufa2d]{2,6}$/,
		"phone":function(gets,obj,curform,regxp){
			var reg1=regxp["m"],
				reg2=/^((0\d{2,3})-)(\d{7,8})(-(\d{3,4}))?$/,
				mobile=curform.find("#mobile");
			if(reg1.test(mobile.val())){return true;}
			if(reg2.test(gets)){return true;}
			return false;
		},
		"is_dist":function(gets,obj,curform,regxp){
			if($(obj).val() == '') {
				return false;
			}
			else {
				return true;
			}
		}	
	},
	callback:function(ret) {
		if(ret.status == 'y') {
			window.location.reload();
			return true;
		}
		else {
			$.laytip({
				msg: ret.info,
				jump:2,
				status:ret.status
			});
			return false;
		}
	}
});
address.resetForm();
//重置
function cancel() {
	$("#arealist").citySelect({
		prov:"", 
		city:"", 
		dist:"", 
		nodata:"none",
		required:false
	});
	$("input[name='address_id']").val('');
	//$("div").removeClass('Validform_wrong');
	$('.Validform_checktip').html('');
}
//修改收货地址
function address_upd(obj) {
	$.ajax({
		type:'POST',
		url:gxunc+'/active/address_upd',
		data:{param:$(obj).attr('alt')},
		async: false,
		dataType:'json',
		success:function(ret) {
			if(ret.status == 'n') {
				$.laytip({
					msg: ret.info,
					jump:2,
					status:ret.status
				});
				return false;
			} 
			else {
				$("input[name='accept_name']").val(ret.accept_name);
				$("input[name='address']").val(ret.address);
				$("input[name='zip']").val(ret.zip);
				$("input[name='mobile']").val(ret.mobile);
				$("input[name='telphone']").val(ret.telphone);
				$("input[name='address_id']").val(ret.id);
				if(ret.is_default==1) {
					$("input[name='default']").prop("checked", true);
				}
				else {
					$("input[name='default']").prop("checked", false);
				}
				$("#arealist").citySelect({
					prov:ret.province, 
					city:ret.city, 
					dist:ret.area, 
					nodata:"none",
					required:false
				});
				$("input[name='accept_name']").focus();
			}
		}
	})
}
//删除收货地址
function address_del(obj) {
	if(confirm('您确定要删除此收货地址吗？')) {
		$.ajax({
			type:'POST',
			url:gxunc+'/active/address_del',
			data:{param:$(obj).attr('alt')},
			async: false,
			dataType:'json',
			success:function(ret) {
				if(ret.status == 'n') {
					$.laytip({
						msg: ret.info,
						jump:2,
						status:ret.status
					});
				}
				else {
					window.location.reload();
				}
			}
		})
	}
}
$(document).ready(function(e) {
	$("#arealist").citySelect({
		prov:"", 
    	city:"", 
		dist:"", 
		nodata:"none",
		required:false
	});
});
//设为默认
function is_default(value, type) {
	$.ajax({
		type:'POST',
		url:gxunc+'/active/is_default',
		data:{param:value, type:type},
		async: false,
		dataType:'json',
		success:function(ret) {
			if(ret.status == 'n') {
				$.laytip({
					msg: ret.info,
					jump:2,
					status:ret.status
				});
			}
			else {
				window.location.reload();
			}
		}
	})
}