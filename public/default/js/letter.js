//查看
function letter_sel(obj) {
	$.ajax({
		type:'POST',
		url:gxunc+'/active/letter_sel',
		data:{param:$(obj).attr('alt')},
		dataType:'json',
		async: false,
		success:function(ret) {
			if(ret.status == 'y') {
				$("#title").html(ret.title);
				$("#content").html(ret.content);
				$("#addtime").html(ret.addtime);
			}
			else {
				$.laytip({
					msg: ret.info,
					jump:2,
					status:ret.status
				});
			}
		}
	})
}	
//删除
function letter_del() {
	var str="";
	$('input[name="idstr"]:checked').each(function(){
		str+=$(this).val()+",";
	})
	if(str=="") {
		alert('未选中项！');
		return false;
	}
	if(confirm('您确定要删除吗？')) {
		$.ajax({
			type:"POST",
			url:gxunc+"/active/letter_del",
			data:{param:str},
			async:false,
			dataType:"json",
			success:function(ret){
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
//关闭
function closebtn() {
	$("#title").html('');
	$("#content").html('');
	$("#addtime").html('');
}