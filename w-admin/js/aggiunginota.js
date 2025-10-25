function aprinota(iddiv){
	divnota="contenutonota"+iddiv;
	divnotaimg="imgnota"+iddiv;
	input="nota"+iddiv;
	document.getElementById(divnota).style.display="";
	document.getElementById(divnotaimg).style.display="none";
	document.getElementById(input).value="";
}

function chiudinota(iddiv){
	divnota="contenutonota"+iddiv;
	divnotaimg="imgnota"+iddiv;
	input="nota"+iddiv;
	document.getElementById(divnota).style.display="none";
	document.getElementById(divnotaimg).style.display="";
	document.getElementById(input).value="#0";
}	
	