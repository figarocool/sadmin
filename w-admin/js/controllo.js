function controllocampi(){
	//Controllo se il titolo risulta vuoto
	if(document.invio.titolo.value==''){
		alert('Il titolo della marca risulta vuoto!');
		document.invio.titolo.focus();
		return false;
	}
}	