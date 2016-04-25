var cash = $("#form1").Validform({
	tiptype:function(msg,o,cssctl){
		if(!o.obj.is("form")) {
			var objtip=o.obj.siblings(".Validform_checktip");
			cssctl(objtip,o.type);
			objtip.text(msg);
		}
	},
	showAllError:false,
	beforeSubmit:function(curform){
		$.payplayer({
			triggerBtn: '#pay_cls',
			modal: '#pay_dialog',
			position: 'fixed',
			width:'500',
			height:'250'
		});
	},
	datatype:{
		"moneyset" : function(get,obj,curform,datatype) {
			var rule = /^(?!0+(?:\.0+)?$)(?:[1-9]\d*|0)(?:\.\d{1,2})?$/;
			if (!rule.test($(obj).val())) {
				return false;
			}
		},
		"moneynum" : function(get,obj,curform,datatype) {
			if($(obj).val() < 1) {
				return false;
			}
		}
	}
});
cash.tipmsg.w['moneyset'] = '请输入正确的提现金额！';
cash.tipmsg.w['moneynum'] = '单笔提现必须大于1元！';