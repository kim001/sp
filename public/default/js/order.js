//取消订单
function order_cancel(_self, value) {
	if(confirm('您确定要取消此订单吗？')) {
		$.ajax({
			type:'POST',
			url:gxunc+'/order/order_cancel',
			data:{param:value},
			async:false,
			dataType:'json',
			success:function(ret){
				if(ret.status=='n') {
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
//删除订单
function order_del(_self, value) {
	if(confirm('您确定要删除此订单吗？')) {
		$.ajax({
			type:'POST',
			url:gxunc+'/order/order_del',
			data:{param:value},
			async:false,
			dataType:'json',
			success:function(ret){
				if(ret.status=='n') {
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
//申请退款
function refund(_self, value) {
	if(confirm('您确定要申请退款吗？')) {
		$.ajax({
			type:'POST',
			url:gxunc+'/order/refund',
			data:{param:value},
			async:false,
			dataType:'json',
			success:function(ret){
				$.laytip({
					msg: ret.info,
					jump:2,
					status:ret.status
				});
			}
		})
	}
}
//确认收货
function harvest() {
	$('#pay_dialog').css('display','block');
}