function controllocampi(){
	//Controllo se il nome del database se è vuoto
	if(document.datidb.nomedb.value==''){
		alert('Il nome del database risulta vuoto!');
		document.datidb.nomedb.focus();
		return false;
	}
	//Controllo se il nome utente del database se è vuoto
	if(document.datidb.nomeuserdb.value==''){
		alert('Il nome utente del database risulta vuoto!');
		document.datidb.nomeuserdb.focus();
		return false;
	}
	//Controllo se la password del database se è vuoto
	if(document.datidb.passworddb.value==''){
		alert('La password del database risulta vuota!');
		document.datidb.passworddb.focus();
		return false;
	}
	//Controllo se l'host del database se è vuoto
	if(document.datidb.hostdb.value==''){
		alert("L'Host del database risulta vuoto!");
		document.datidb.hostdb.focus();
		return false;
	}
}

function controllocampisito(){
	//Controllo se il titolo del sito se è vuoto
	if(document.datisadmin.titolosito.value==''){
		alert('Il titolo del sito risulta vuoto!');
		document.datisadmin.titolosito.focus();
		return false;
	}
	//Controllo se l'email del sito se è vuoto
	if(document.datisadmin.emailsito.value==''){
		alert("L'email del sito risulta vuoto!");
		document.datisadmin.emailsito.focus();
		return false;
	}
	//Controllo se il nome utente del sito se è vuoto
	if(document.datisadmin.nomeutente.value==''){
		alert('Il nome utente del sito risulta vuota!');
		document.datisadmin.nomeutente.focus();
		return false;
	}
	//Controllo se la password del sito se è vuoto
	if(document.datisadmin.password.value==''){
		alert("La password del sito risulta vuoto!");
		document.datisadmin.password.focus();
		return false;
	}
}		