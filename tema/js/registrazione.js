/*CONTROLLO CAMPI VUOTI REGISTRAZIONE*/
function registrazione(){
	//Controllo se il nome risulta vuoto
	if(document.invio.nome.value==''){
		alert('Il campo nome risulta vuoto!');
		document.invio.nome.focus();
		document.invio.nome.style.border= '1px solid #ff0000';
		document.invio.nome.style.background = '#FFB7B7';
		return false;
	}
	//Controllo se il cognome risulta vuoto
	if(document.invio.cognome.value==''){
		alert('Il cognome risulta vuoto!');
		document.invio.cognome.focus();
		document.invio.cognome.style.border= '1px solid #ff0000';
		document.invio.cognome.style.background = '#FFB7B7';
		return false;
	}
	//Controllo se il codice fiscale risulta vuoto
	if(document.invio.codfiscale.value==''){
		alert('Il codice fiscale risulta vuoto!');
		document.invio.codfiscale.focus();
		document.invio.codfiscale.style.border= '1px solid #ff0000';
		document.invio.codfiscale.style.background = '#FFB7B7';
		return false;
	}
	if(document.invio.codfiscale.value.length<16 || document.invio.codfiscale.value.length>16){
		alert("Il codice fiscale non e' stato inserito correttamente!");
		document.invio.codfiscale.focus();
		document.invio.codfiscale.style.border= '1px solid #ff0000';
		document.invio.codfiscale.style.background = '#FFB7B7';
		return false;
	}
	//Controllo la data di nascita
	if(document.invio.giorno.options[document.invio.giorno.selectedIndex].text=="--Giorno--" || document.invio.mese.options[document.invio.mese.selectedIndex].text=="--Mese--" || document.invio.anno.options[document.invio.anno.selectedIndex].text=="--Anno--"){
		alert("Non e' stata selezionata la data di nascita!");
		document.invio.giorno.focus();
		document.invio.giorno.style.background = '#FFB7B7';
		document.invio.mese.style.background = '#FFB7B7';
		document.invio.anno.style.background = '#FFB7B7';
		return false;
	}
	//Controllo se il comune di nascita è vuoto
	if(document.invio.comunenascita.value==''){
		alert('Il Comune di nascita risulta vuoto!');
		document.invio.comunenascita.focus();
		document.invio.comunenascita.style.border= '1px solid #ff0000';
		document.invio.comunenascita.style.background = '#FFB7B7';
		return false;
	}
	//Controllo se la prov d nascita è vuota
	if(document.invio.provnascita.options[document.invio.provnascita.selectedIndex].text=="Prov"){
		alert("Non e' stata selezionata la provincia di nascita!");
		document.invio.provnascita.focus();
		document.invio.provnascita.style.background = '#FFB7B7';
		return false;
	}
	//Controllo se la prov d residenza è vuota
	if(document.invio.provresidenza.options[document.invio.provresidenza.selectedIndex].text=="Prov"){
		alert("Non e' stata selezionata la provincia di residenza!");
		document.invio.provresidenza.focus();
		document.invio.provresidenza.style.background = '#FFB7B7';
		return false;
	}
	//Controllo se il comune di residenza è vuoto
	if(document.invio.comuneresidenza.value==''){
		alert('Il Comune di residenza risulta vuoto!');
		document.invio.comuneresidenza.focus();
		document.invio.comuneresidenza.style.border= '1px solid #ff0000';
		document.invio.comuneresidenza.style.background = '#FFB7B7';
		return false;
	}
	//Controllo se il cap risulta vuoto
	if(document.invio.cap.value==''){
		alert("Il cap risulta vuota!");
		document.invio.cap.focus();
		document.invio.cap.style.border= '1px solid #ff0000';
		document.invio.cap.style.background = '#FFB7B7';
		return false;
	}
	//Controllo se il cap risulta non corretto	
	if(document.invio.cap.value.length<5 || isNaN(document.invio.cap.value)==true){
		alert("Il cap non risulta corretto!");
		document.invio.cap.focus();
		document.invio.cap.style.border= '1px solid #ff0000';
		document.invio.cap.style.background = '#FFB7B7';
		return false;
	}
	//Controllo se l'indirizzo è vuoto
	if(document.invio.indirizzo.value==''){
		alert("L'ndirizzo risulta vuoto!");
		document.invio.indirizzo.focus();
		document.invio.indirizzo.style.border= '1px solid #ff0000';
		document.invio.indirizzo.style.background = '#FFB7B7';
		return false;
	}
	//Controllo se il numero civico è vuoto
	if(document.invio.numcivico.value==''){
		alert("Il numero civico risulta vuoto!");
		document.invio.numcivico.focus();
		document.invio.numcivico.style.border= '1px solid #ff0000';
		document.invio.numcivico.style.background = '#FFB7B7';
		return false;
	}
	//Controllo se il tel è vuoto
	if(document.invio.telefono.value==''){
		alert("Il numero di telefono risulta vuoto!");
		document.invio.telefono.focus();
		document.invio.telefono.style.border= '1px solid #ff0000';
		document.invio.telefono.style.background = '#FFB7B7';
		return false;
	}
	//Controllo se l'user è vuoto
	if(document.invio.user.value==''){
		alert("L'username risulta vuoto!");
		document.invio.user.focus();
		document.invio.user.style.border= '1px solid #ff0000';
		document.invio.user.style.background = '#FFB7B7';
		return false;
	}
	//Controllo se la password risulta vuota
	if(document.invio.psw.value==''){
		alert("La password risulta vuoto!");
		document.invio.psw.focus();
		document.invio.psw.style.border= '1px solid #ff0000';
		document.invio.psw.style.background = '#FFB7B7';
		return false;
	}
	//Controllo se l'email è vuota
	if(document.invio.email.value==''){
		alert("L'email risulta vuoto!");
		document.invio.email.focus();
		document.invio.email.style.border= '1px solid #ff0000';
		document.invio.email.style.background = '#FFB7B7';
		return false;
	}
	if (document.invio.email.value.indexOf ('@',0)  == -1) {
 		alert("L'e-mail inserita non e' corretta!");
 		document.invio.email.focus();
		document.invio.email.style.border= '1px solid #ff0000';
		document.invio.email.style.background = '#FFB7B7';
 		return false;
 	} 
	//Controllo se la legge sulla privacy è stata selezionata
	if(document.invio.legge.checked==false){
		alert('Devi accettare la legge sulla privacy!');
		return false;
	}
	//Controllo se il captcha
	if (document.invio.txt_captcha.value=='') {
 		alert("Il captcha risulta vuoto!");
 		document.invio.txt_captcha.focus();
		document.invio.txt_captcha.style.border= '1px solid #ff0000';
		document.invio.txt_captcha.style.background = '#FFB7B7';
 		return false;
 	} 
}

/*FINE REGISTRAZIONE*/

