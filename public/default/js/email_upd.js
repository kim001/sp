var log = $("#form1").Validform({
	tiptype:function(msg,o,cssctl){
		if(!o.obj.is("form")) {
			var objtip=o.obj.parent().siblings(".Validform_checktip");
			cssctl(objtip,o.type);
			objtip.text(msg);
		}
	},
	btnSubmit:"#emailSub",
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
			onstep(1);
			$('#again').val(ret.email);
			$('.input-submit').attr('href', ret.emailurl);
			$("#hcode").val(ret.code);
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
	 url: gxunc+"/safe/send_sms/mailupd",
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
}
function step1() {
	var codeChk = log.check(false, $('#code'));
	var codeVad = $("#code")[0].validform_valid;
	var nemailChk = log.check(false, $('#nemail'));
	var nemailVad = $("#nemail")[0].validform_valid;
	if(!codeChk || codeVad != 'true' || !nemailChk || nemailVad != 'true') {
		return false;
	}
	onstep(1);
}

function sendAgain(obj) {
	$.ajax({
		type:'POST',
		url:gxunc+'/safe/email_upd_send',
		data:{nemail:$(obj).val(), code:$('#hcode').val()},
		dataType:'json',
		success: function(ret) {
			ret.jump = typeof(ret.jump) == 'undefined' ? 0 : ret.jump;
			ret.url = typeof(ret.url) == 'undefined' ? '' : ret.url;
			if(ret.jump>0) {
				$.laytip({
					msg: ret.info,
					jump:ret.jump,
					url:ret.url,
					status:ret.status
				});
				return false;
			}
			times(obj);
		}
	})
}

var waits=120;
function times(o) {
	if (waits == 0) {
		$(o).attr("onclick", "sendAgain(this)");		
		$(o).html("重新发送");
		waits = 120;
		
	} 
	else {
		$(o).removeAttr("onclick");
		$(o).html(waits+"秒后重新发送");
		waits--;
		setTimeout(function() {
			times(o)
		},
		1000)
	}
}