var log = $("#form1").Validform({
	tiptype:function(msg,o,cssctl){
		if(!o.obj.is("form")) {
			var objtip=o.obj.parent().siblings(".Validform_checktip");
			cssctl(objtip,o.type);
			objtip.text(msg);
		}
	},
	btnSubmit:"#loginSub",
	ignoreHidden:true,
	showAllError:false,
	postonce:true,
	ajaxPost:true,
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
			onstep(2);
			return true;
		}
	}
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
	$.ajax({
	 type: "POST",
	 url: gxunc+"/safe/send_sms/lpwdupd",
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
//改变选项卡
function onstep(index) {
	if(index == 1) {
		$("#step1").fadeOut(10);
		$("#step2").fadeIn(10);
		$("#step_img_2").attr("src", gxunc+"/public/default/images/safe_mm2_2.png");
	}
	else if(index == 2){
		$("#step1").fadeOut(10);
		$("#step2").fadeOut(10);
		$("#step3").fadeIn(10);
		$("#step_img_3").attr("src", gxunc+"/public/default/images/safe_mm3_2.png");
	}
}
function step1() {
	var codeChk = log.check(false, $('#code'));
	var codeVad = $("#code")[0].validform_valid;
	var opwdChk = log.check(false, $('#opwd'));
	if(!codeChk || codeVad != 'true' || !opwdChk) {
		return false;
	}
	onstep(1);
}