var avanzamento = -1;
var tempo = 30;
var asd=false;
var top;
var top1;
var t;
function spostamento(){
	top = document.getElementById("img").style.top;
	top = parseInt(top);
	if(top<-10){
		document.getElementById("img1").style.visibility = "visible";
		top1 = document.getElementById("img1").style.top;
		top1 = parseInt(top1);
		top1 += avanzamento;
		top += avanzamento;
		document.getElementById("img").style.top = top+"px";
		document.getElementById("img1").style.top = top1+"px";
		t=setTimeout("spostamento()",tempo);
		if(top1<-20){
			document.getElementById("img").style.top = '360px';
			asd=true;
		}
	}else{
		top += avanzamento;
		document.getElementById("img").style.top = top+"px";
		if(asd==true){
			document.getElementById("img1").style.top = (top-380)+"px";
		}
		if(top<-10){
			document.getElementById("img1").style.top = '370px';
		}
		t=setTimeout("spostamento()",tempo);
	}
}
function fermaimg(read){
	clearTimeout(t);
	document.getElementById("img").style.top = read+"px"; 
	//document.getElementById("img1").style.top = "440px";
	//document.getElementById("img1").style.visibility = "hidden";
}