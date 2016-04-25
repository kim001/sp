//删除收藏
function coll_seller_del() {
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
			url:gxunc+"/active/coll_seller_del",
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