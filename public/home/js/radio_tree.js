function onClick(e, treeId, treeNode) {
	var zTree = $.fn.zTree.getZTreeObj("radio_tree");
	zTree.checkNode(treeNode, !treeNode.checked, null, true);
	return false;
}

function onCheck(e, treeId, treeNode) {
	var zTree = $.fn.zTree.getZTreeObj("radio_tree"),
	nodes = zTree.getCheckedNodes(true),
	v = "";
	for (var i=0, l=nodes.length; i<l; i++) {
		v += nodes[i].name + "," + nodes[i].id;
	}
	//if (v.length > 0 ) v = v.substring(0, v.length-1);
	var cateObj = $("#cateSel");
	var hidObj = $("#hid_cate");
	if (v.length > 0 ) {
		varr = v.split(',');
		cateObj.attr("value", varr[0]);
		hidObj.attr("value", varr[1]);
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