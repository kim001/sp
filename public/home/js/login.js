function cktname(){
	var flag = true;
	var objname = $("input[name='tname']");
	if (objname.val() == '' || objname.val() == '账号'){
		$("#msgError").html('账号不能为空！');
		flag = false;
	}
	else
		$("#msgError").html('');
	return flag;
}
function cktpwd(){
	var flag = true;
	var objpwd = $("input[name='tpwd']");
	if (objpwd.val() == ''){
		$("#msgError").html('密码不能为空！');
		flag = false;
	}
	else
		$("#msgError").html('');
	return flag;
}
$(function () {
	$("input[name='tname']").blur(function(){
		cktname();
	})
	$("input[name='tpwd']").blur(function(){
		cktpwd();
	})
	$("input[class='loginbtn']").click(function(){
		if(cktname()){
			if(cktpwd()){
				$("#loginForm").submit();
			}
		}
	})
})