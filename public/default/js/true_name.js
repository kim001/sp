var log = $("#form1").Validform({
	tiptype:function(msg,o,cssctl){
		if(!o.obj.is("form")) {
			var objtip=o.obj.parent().siblings(".Validform_checktip");
			cssctl(objtip,o.type);
			objtip.text(msg);
		}
	},
	showAllError:false,
	postonce:true,
	ajaxPost:true,
	datatype:{
		"z2-6" : /^[\u4E00-\u9FA5\uf900-\ufa2d]{2,6}$/,
		"idcard":function(gets,obj,curform,datatype){
			var Wi = [ 7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2, 1 ];// 加权因子;
			var ValideCode = [ 1, 0, 10, 9, 8, 7, 6, 5, 4, 3, 2 ];// 身份证验证位值，10代表X;
			if (gets.length == 15) {   
				return isValidityBrithBy15IdCard(gets);   
			}else if (gets.length == 18){   
				var a_idCard = gets.split("");// 得到身份证数组   
				if (isValidityBrithBy18IdCard(gets)&&isTrueValidateCodeBy18IdCard(a_idCard)) {
					return true;   
				}   
				return false;
			}
			return false;
			
			function isTrueValidateCodeBy18IdCard(a_idCard) {   
				var sum = 0; // 声明加权求和变量   
				if (a_idCard[17].toLowerCase() == 'x') {   
					a_idCard[17] = 10;// 将最后位为x的验证码替换为10方便后续操作   
				}   
				for ( var i = 0; i < 17; i++) {   
					sum += Wi[i] * a_idCard[i];// 加权求和   
				}   
				valCodePosition = sum % 11;// 得到验证码所位置   
				if (a_idCard[17] == ValideCode[valCodePosition]) {   
					return true;   
				}
				return false;   
			}
			
			function isValidityBrithBy18IdCard(idCard18){   
				var year = idCard18.substring(6,10);   
				var month = idCard18.substring(10,12);   
				var day = idCard18.substring(12,14);   
				var temp_date = new Date(year,parseFloat(month)-1,parseFloat(day));   
				// 这里用getFullYear()获取年份，避免千年虫问题   
				if(temp_date.getFullYear()!=parseFloat(year) || temp_date.getMonth()!=parseFloat(month)-1 || temp_date.getDate()!=parseFloat(day)){   
					return false;   
				}
				return true;   
			}
			
			function isValidityBrithBy15IdCard(idCard15){   
				var year =  idCard15.substring(6,8);   
				var month = idCard15.substring(8,10);   
				var day = idCard15.substring(10,12);
				var temp_date = new Date(year,parseFloat(month)-1,parseFloat(day));   
				// 对于老身份证中的你年龄则不需考虑千年虫问题而使用getYear()方法   
				if(temp_date.getYear()!=parseFloat(year) || temp_date.getMonth()!=parseFloat(month)-1 || temp_date.getDate()!=parseFloat(day)){   
					return false;   
				}
				return true;
			}
		}
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
			location.href=gxunc+'/safe/true_name_success'
		}
	}
});

function addImg() { 
	//加载图标
	$(document).ajaxStart(function() {
	$('#loading').show();
	}).ajaxComplete(function() {
	$('#loading').hide();
	});
	//上传文件
	$.ajaxFileUpload({
	url:gxunc+'/safe/true_name_img',//处理图片脚本
	secureuri :false,
	fileElementId :'fileField',//file控件id
	dataType : 'json',
	success : function (data, status) {
		if(data.status == 'n') {
			$.laytip({
				msg: data.info,
				jump:2,
				status:data.status
			});
			return false;
		}
		else {
			var beforeli = '<li class="upload-item" style="width:80px; height:104px; margin-top:0px;"><img src="'+data.allpath+'" alt="'+data.path+'"><p class="item-delete" style="width:84px; height:20px; line-height:20px; margin-top:2px;"><a href="javascript:;" onclick="delImg(this)">删除</a></p></li>';
			$(".add-img").before(beforeli);
			m++;
			if(m >= 2)
				$(".add-img").remove();
		}
	}
	})
}

function delImg(obj) {
	if(confirm('您确定要删除此照片吗？')) {
		$.ajax({
		 type: "POST",
		 url: gxunc+'/safe/delImg',
		 data: {param:$(obj).parent().prev().attr('alt')},
		 async: false,
		 dataType:'json',
		 success: function(ret) {
			if(ret.status == 'n') {
				$.laytip({
					msg: ret.info,
					jump:2,
					status:ret.status
				});
				return false;
			}
			else {
				$(obj).parent().parent().remove();
				m--;
				if(m == 1) {
					var addli = '<li class="add-img" style="height:80px; margin-top:0px;"><a href="javascript:;"><img src="'+gxunc+'/public/default/images/jia.jpg"><input type="file" name="fileField" class="file" id="fileField" size="28" onchange="addImg()"></a></li>';
					$('.upload-list').append(addli);
				}
			}
		}
		})
	}
}
