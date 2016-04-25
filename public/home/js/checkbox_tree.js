function onClick(e, treeId, treeNode) {
	var zTree = $.fn.zTree.getZTreeObj("checkbox_tree");
	zTree.checkNode(treeNode, !treeNode.checked, null, true);
	return false;
}

function onCheck(e, treeId, treeNode) {
	var zTree = $.fn.zTree.getZTreeObj("checkbox_tree"),
	nodes = zTree.getCheckedNodes(true),
	v1 = "";
	v2 = "";
	for (var i=0, l=nodes.length; i<l; i++) {
		v1 += nodes[i].name + ",";
		v2 += nodes[i].id + ",";
	}
	//if (v.length > 0 ) v = v.substring(0, v.length-1);
	var cateObj = $("#cateSel");
	var hidObj = $("#hid_cate");
	if (v1.length > 0 ) {
		v1 = v1.substring(0, v1.length-1);
		v2 = v2.substring(0, v2.length-1);
		cateObj.attr("value", v1);
		hidObj.attr("value", v2);
	}
	else {
		cateObj.attr("value", '');
		hidObj.attr("value", '');
	}
}

function showMenu() {
	var cityObj = $("#cateSel");
	var cityOffset = $("#cateSel").offset();
	$("#menuContent").css({left:cityOffset.left + "px", top:cityOffset.top + cityObj.outerHeight() + "px"}).slideDown("fast");
	if(_self_type == 'dialog')
		$(top.document.getElementById('dialog').contentWindow.document).bind("mousedown", onBodyDown);
	else
		$("body").bind("mousedown", onBodyDown);
}
function hideMenu() {
	$("#menuContent").fadeOut("fast");
	if(_self_type == 'dialog')
		$(top.document.getElementById('dialog').contentWindow.document).unbind("mousedown", onBodyDown);
	else
		$("body").unbind("mousedown", onBodyDown);
}
function onBodyDown(event) {
	if (!(event.target.id == "menuBtn" || event.target.id == "cateSel" || event.target.id == "menuContent" || $(event.target).parents("#menuContent").length>0)) {
		hideMenu();
	}
}