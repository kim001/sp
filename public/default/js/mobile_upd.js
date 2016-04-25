var log = $("#form1").Validform({
	tiptype:function(msg,o,cssctl){
		if(!o.obj.is("form")) {
			var objtip=o.obj.parent().siblings(".Validform_checktip");
			cssctl(objtip,o.type);
			objtip.text(msg);
		}
	},
	btnSubmit:"#mobileSub",
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
var wait1=60;
function time1(o) {
	if (wait1 == 0) {
		o.removeAttribute("disabled");			
		o.innerHTML="获取校验码";
		wait1 = 60;
	} 
	else  {
		o.setAttribute("disabled", true);
		o.innerHTML= wait1+"秒后获取";
		wait1--;
		setTimeout(function() {
			time1(o)
		},
		1000)
	}
}
function send_sms1(o) {
	$.ajax({
	 type: "POST",
	 url: gxunc+"/safe/send_sms/telupd1",
	 async: false,
	 dataType:'json',
	 success: function(ret) {
		  if(ret.status == 'y') {
			  time1(o);
		  }
		  else {
			  alert(ret.info);
		  }
		}
	 })
}
//获取手机验证码
var wait2=60;
function time2(o) {
	if (wait2 == 0) {
		o.removeAttribute("disabled");			
		o.innerHTML="获取校验码";
		wait2 = 60;
	} 
	else  {
		o.setAttribute("disabled", true);
		o.innerHTML= wait2+"秒后获取";
		wait2--;
		setTimeout(function() {
			time2(o)
		},
		1000)
	}
}
function send_sms2(o) {
	$.ajax({
	 type: "POST",
	 url: gxunc+"/safe/send_new_sms/telupd2",
	 async: false,
	 dataType:'json',
	 data:{mobile:$('#nmobile').val()},
	 success: function(ret) {
		  if(ret.status == 'y') {
			  time2(o);
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
	var codeChk = log.check(false, $('#code1'));
	var codeVad = $("#code1")[0].validform_valid;
	if(!codeChk || codeVad != 'true') {
		return false;
	}
	onstep(1);
}