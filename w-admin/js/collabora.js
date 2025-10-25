function check(){
	//Controllo se il nome e cognome risulta vuoto
	if(document.collabora.nome.value==''){
		alert('Il nome e cognome risulta vuoto!');
		document.collabora.nome.focus();
		return false;
	}
	//Controllo se il telefono risulta vuoto
	if(document.collabora.telefono.value==''){
		alert('Il telefono risulta vuoto!');
		document.collabora.telefono.focus();
		return false;
	}
	//Controllo se l'email risulta vuoto
	if(document.collabora.email.value==''){
		alert('Email inserita non correttamente!');
		document.collabora.email.focus();
		return false;
	}
	//Controllo se il messaggio risulta vuoto
	if(document.collabora.messaggio.value==''){
		alert('Il messaggio risulta vuoto!');
		document.collabora.messaggio.focus();
		return false;
	}
}	