function isEmpty(val){
	return (val === undefined || val == null || val.length <= 0) ? true : false;
}
function sleep(milliseconds) {
	var start = new Date().getTime();
	for (var i = 0; i < 1e7; i++) {
		if ((new Date().getTime() - start) > milliseconds){
			break;
		}
	}
}
function getRandomInt(min, max)
{
	return Math.floor(Math.random() * (max - min + 1)) + min;
}
function find_p(x1, y1, x2, y2, a1, b1, a2, b2){
	var A, B, C, D, E, F, inx, iny;
	x1 = points[lines[i].from].x;   y1 = points[lines[i].from].y;
	x2 = points[lines[i].to].x;	 y2 = points[lines[i].to].y;
	a1 = points[lines[b].from].x;   b1 = points[lines[b].from].y;
	a2 = points[lines[b].to].x;	 b2 = points[lines[b].to].y;

	A = y1 - y2;
	B = x2 - x1;
	C = x1 * A + y1 * B;

	D = b1 - b2;
	E = a2 - a1;
	F = a1 * D + b1 * E;
	if (A * E - D * B != 0){
		insy = (A * F - D * C) / (A * E - D * B);
		insx = (E * C - B * F) / (A * E - D * B);
		if(((x1<insx&&insx<x2)||(x2<insx&&insx<x1))&&((y1<insy&&insy<y2)||(y2<insy&&insy<y1))){
			if(((a1<insx&&insx<a2)||(a2<insx&&insx<a1))&&((b1<insy&&insy<b2)||(b2<insy&&insy<b1))){
				var ret = {};
				ret.x = insx;
				ret.y = insy;
				return ret;
			}
		}
	}
}
function array_toend(array, element){
	var element_ge = array[element];
	array.splice(element, 1);	
	array.push(element_ge);
	return(array);
}
function getXMLDocument(url)  
{  
	var xml;  
	if(window.XMLHttpRequest)  
	{  
		xml=new window.XMLHttpRequest();  
		xml.open("GET", url, false);  
		xml.send("");  
			return xml.responseXML;  
	}  
	else{
		if(window.ActiveXObject)  
		{  
			xml=new ActiveXObject("Microsoft.XMLDOM");  
			xml.async=false;  
			xml.load(url);  
			return xml;  
		}  
		else  
		{  
			return null;  
		}  
	}
}
Math.degrees = function(rad)
{
	return rad*(180/Math.PI);
}
Math.radians = function(deg)
{
	return deg * (Math.PI/180);
}
function bezie(){
	
}
function get_coor(bezie_c, t){
	var x = 0;
	var y = 0;
	x = (Math.pow((1 - t), 3) * bezie[0][0]) + (3 * Math.pow((1 - t), 2) * t * bezie[1][0]) + (3* (1 - t) * Math.pow(t, 2) * bezie[2][0]) + (Math.pow(t, 3) * bezie[3][0]);
	y = (Math.pow((1 - t), 3) * bezie[0][1]) + (3 * Math.pow((1 - t), 2) * t * bezie[1][1]) + (3* (1 - t) * Math.pow(t, 2) * bezie[2][1]) + (Math.pow(t, 3) * bezie[3][1]);
	var ret = [x, y];
	return ret;
}
function point(x, y) {
	this.x = x;
	this.y = y;
}
function line(a, b, way){
	this.a = a;
	this.b = b;
	this.way = way;
}