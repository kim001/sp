//自适应左右部分高度一致
var leftbox = $(".person_center_left")
var rightbox = $(".person_center_right");
var bigbox = $(".person_center");
var leftborderbox = $(".person_left_box");
if(leftbox.innerHeight()<=rightbox.innerHeight()){
	var HH = rightbox.innerHeight();
	bigbox.css('height',HH+'px');
	leftborderbox.css('height',(HH-81)+'px');
	rightbox.css('height',HH+'px');		
}else if(rightbox.innerHeight()<leftbox.innerHeight()){
	var HH = leftbox.innerHeight();
	bigbox.css('height',HH+'px');
	leftborderbox.css('height',(HH-81)+'px');
	rightbox.css('height',HH+'px');
}