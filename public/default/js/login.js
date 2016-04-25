var login = $("#form1").Validform({
	tiptype:function(msg,o,cssctl){
		var objtip=$("#loginTip");
		cssctl(objtip,o.type);
		objtip.text(msg);
	},
	btnSubmit:".submit",
	showAllError:false,
	postonce:true,
	datatype:{
		'chktpwd':function(gets,obj,curform,datatype) {
			var flag = true;
			$.ajax({
			 type: "POST",
			 url: gxunc+"/user/loginAjax/pwd",
			 data: {tname:$("#tname").val(), tpwd:$("#tpwd").val()},
			 async: false,
			 dataType:'json',
			 success: function(ret) {
				 if(ret.status != 'y') {
					 flag = false;
				 }
				}
			 })
			return flag;
		}
	}
});
login.tipmsg.w['*6-16'] = '请输入正确的登录密码！';
login.tipmsg.w['chktpwd']='登陆密码错误！';