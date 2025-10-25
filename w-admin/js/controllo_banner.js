function controllocampi(){
	//Controllo se il numero risulta vuoto
	if(document.invio.descrizione.value==''){
		alert('Il numero progressivo del banner risulta vuoto!');
		document.invio.descrizione.focus();
		return false;
	}
}	