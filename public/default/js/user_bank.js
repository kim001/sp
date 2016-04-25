user_bank = $("#form1").Validform({
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
		"z2-6" : /^[\u4E00-\u9FA5\uf900-\ufa2d]{2,6}$/
	},
	callback:function(ret) {
		if(ret.status == 'n') {
			$.laytip({
				msg: ret.info,
				jump:2,
				status:ret.status
			});
			return false;
		}
		else {
			window.location.reload();
			return true;
		}
	}
});
user_bank.resetForm();
//删除银行卡
function user_bank_del(obj) {
	if(confirm('您确定要删除此银行卡吗？')) {
		$.ajax({
			type:'POST',
			url:gxunc+'/account/user_bank_del',
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
//修改银行卡
function user_bank_upd(obj) {
	$.ajax({
		type:'POST',
		url:gxunc+'/account/user_bank_upd',
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
				$("input[name='true_name']").val(ret.true_name);
				$("#province").val(ret.province);
				$("#bank_id").val(ret.bank_id);
				$("input[name='card']").val(ret.card);
				$("input[name='id']").val(ret.id);
				set_city(ret.province, ret.city);
			}
		}
	})
}
/*省市二级联动
 *Khd
 */
function set_city(pid, city) {
	$.ajax({
		 type: "POST",
		 url: gxunc+"/account/set_city",
		 data: {pid:pid},
		 async: false,
		 dataType:'json',
		 success: function(ret) {   //市
			var attrStr = "<option value=''>请选择...</option>";
			var attrLen = ret.length;
			if(attrLen>0) {
				for(i=0; i<attrLen; i++) {
					attrStr += "<option value='"+ret[i].id+"'";
					if(city>0 && ret[i].id==city)attrStr += " selected";
					attrStr += ">"+ret[i].name+"</option>";
				}
				$("#city").html(attrStr);
				$("#city").show();
			}
			else {
				$("#city").hide();
			}
		}
	})
}