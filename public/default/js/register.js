var reg = $("#form1").Validform({
	tiptype:function(msg,o,cssctl){
		var objtip=$("#regTip");
		cssctl(objtip,o.type);
		objtip.text(msg);
	},
	btnSubmit:".submit",
	showAllError:false,
	postonce:true
});
//获取手机验证码
var wait=60;
function time(o) {
	if (wait == 0) {
		o.removeAttribute("disabled");			
		o.innerHTML="获取校验码";
		wait = 60;
	} 
	else  {
		o.setAttribute("disabled", true);
		o.innerHTML= wait+"秒后获取";
		wait--;
		setTimeout(function() {
			time(o)
		},
		1000)
	}
}
function send_sms(o) {
	var flag1 = reg.check(false, $('#mobile'));
	var flag2 = $("#mobile")[0].validform_valid;
	if(flag1 && flag2 == 'true') {
		$.ajax({
		 type: "POST",
		 url: gxunc+"/user/send_sms/reg",
		 data: {mobile:$("#mobile").val()},
		 async: false,
		 dataType:'json',
		 success: function(ret) {
			  if(ret.status == 'y') {
				  time(o);
			  }
			  else {
				  alert(ret.info);
			  }
			}
		 })
	}
}