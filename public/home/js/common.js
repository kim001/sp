$(function() {
	$('.tablelist tbody tr:odd').addClass('odd');
	$('.tablelist tbody tr').each(function (i) {		
		$(this).click(function(){
			$('.tablelist tbody tr:odd').addClass('odd');
			$('.trSelected').removeClass('trSelected');
			$(this).removeClass('odd');
			$(this).addClass('trSelected');
		});
	})
	$('input[name="allCheck"]').click(function(){
		allCheck();
    })
})
function itabclk(i) {	//切换
	$('.forminfo').css('display', 'none');
	$('#tab'+i).css('display', '');
	$('.itab>ul>li>a').removeClass('selected');
	$('#itab'+i).addClass('selected');
}
function allCheck() {	//全选
	var obj = $('input[name="allCheck"]');
	var objchild = $('input[name="idstr"]');
	if(obj.attr('checked') == true){
		objchild.each(function () {
			$(this).attr('checked', 'true');
		})
	}
	else{
		objchild.each(function () {		
			$(this).removeAttr('checked');
		})
	}
}
/*获取表格列值
 *gxunc
 */
function getRowCode() {
	var id = 0;
	$('.tablelist tbody tr').each(function (i) {		
		var obj = $('.tablelist tbody .trSelected');
		if(obj.text() != ''){
			id = $(obj).attr('rel');
		}
	})
	return id;
}
function getOutRowCode() {
	var id = 0;
	$('.tablelist tbody tr').each(function (i) {		
		var obj = $('.tablelist tbody .trSelected');
		if(obj.text() != ''){
			id = $(obj).attr('outrel');
		}
	})
	return id;
}
function getCheckRowValue() {
	var s = '';
	$('input[name="idstr"]:checked').each(function () {		
		s += $(this).val()+',';
	})
	s = s.substring(0,s.length-1);
	return s;
}
/*省市二级联动
 *Khd
 */
function set_city(pid, city) {
	$.ajax({
		 type: "POST",
		 url: ajaxUrl+"/ship/set_city",
		 data: {pid:pid},
		 async: false,
		 dataType:'json',
		 success: function(ret) {   //市
			var attrStr = "<option value=''>请选择...</option>";
			var attrLen = ret.length;
			if(attrLen>0) {
				for(i=0; i<attrLen; i++) {
					attrStr += "<option value='"+ret[i].id+"'";
					if(city>0 && ret[i].id==city)attrStr += " selected";
					attrStr += ">"+ret[i].area_name+"</option>";
				}
				$("#city").html(attrStr);
				$("#city").show();
			}
			else {
				$("#city").hide();
			}
			$("#area").html('');
			$("#area").hide();
		}
	})
}
/*市区二级联动
 *Khd
 */
function set_area(pid, city) {
	$.ajax({
		 type: "POST",
		 url: ajaxUrl+"/ship/set_city",
		 data: {pid:pid},
		 async: false,
		 dataType:'json',
		 success: function(ret){
			var attrStr = '';
			var attrLen = ret.length;
			if(attrLen>0) {
				for(i=0; i<attrLen; i++) {
					attrStr += "<option value='"+ret[i].id+"'";
					if(city>0 && ret[i].id==city)attrStr += " selected";
					attrStr += ">"+ret[i].area_name+"</option>";
				}
				$("#area").show();
				$("#area").html(attrStr);
			}
			else {
				$("#area").html('');
				$("#area").hide();
			}
		 }
	})
}

function commitSave(formid) {
	if(!CheckDataValid('#'+formid)){
		return false;
	}
	else {
		art.dialog.tips('系统正在提交数据，请稍等...');
		$('#'+formid).submit();
	}
}
function subSave(formid) {
	if(!CheckDataValid('#'+formid)){
		return false;
	}
	else {
		art.dialog.tips('系统正在提交数据，请稍等...');
		$('#'+formid).submit();
	}
}