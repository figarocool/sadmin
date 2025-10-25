function disattiva(read){
	if(read=="si"){
		document.getElementById('apriavanzate').style.display = "block";
		document.getElementById('contenutofiltro').style.height = "330px";
	}else{
		document.getElementById('contenutofiltro').style.height = "150px";
		document.getElementById('apriavanzate').style.display = "none";
	}	
}