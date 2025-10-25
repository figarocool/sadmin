/*FUNZIONE PER IL CONTROLLO DEI VALORI INSERITI NELLA RICHIESTA*/

var valore;
valore = true;
	 
function controllocampi(read){
	//Controllo se il nome risulta vuoto
	if (read == false){ return false; }
	if(document.richiesta.nome.value=='' || document.richiesta.nome.value=='Inserisci il tuo nome!' && read == true){
		alert('Il nome risulta vuoto!');
		document.richiesta.nome.focus();
		document.richiesta.nome.style.border='2px solid #ff0000';
		document.richiesta.nome.style.color='#ff0000';
		document.richiesta.nome.value='Inserisci il tuo nome!';
		return false;
	}
	//Controllo se il cognome risulta vuoto
	if(document.richiesta.cognome.value=='' || document.richiesta.cognome.value=='Inserisci il tuo cognome!' && read==true){
		alert('Il cognome risulta vuoto!');
		document.richiesta.cognome.focus();
		document.richiesta.cognome.style.border='2px solid #ff0000';
		document.richiesta.cognome.style.color='#ff0000';
		document.richiesta.cognome.value='Inserisci il tuo cognome!';
		return false;
	}
	//Controllo se il paese risulta vuoto
	if(document.richiesta.paese.value=='' || document.richiesta.paese.value=='Inserisci il paese!' && read==true){
		alert('Il Paese risulta vuoto!');
		document.richiesta.paese.focus();
		document.richiesta.paese.style.border='2px solid #ff0000';
		document.richiesta.paese.style.color='#ff0000';
		document.richiesta.paese.value='Inserisci il paese!';
		return false;
	}
	//Controllo se la provincia risulta vuota
	if(document.richiesta.prov.value=='' || document.richiesta.prov.value=='Inserisci la provincia!' && read==true){
		alert('La provincia risulta vuota!');
		document.richiesta.prov.focus();
		document.richiesta.prov.style.border='2px solid #ff0000';
		document.richiesta.prov.style.color='#ff0000';
		document.richiesta.prov.value='Inserisci la provincia!';
		return false;
	}
	//Controllo se il telefono risulta vuoto
	if(document.richiesta.tel.value=='' || document.richiesta.tel.value=='Inserisci un numero di telefono!' && read==true){
		alert('Il telefono risulta vuota!');
		document.richiesta.tel.focus();
		document.richiesta.tel.style.border='2px solid #ff0000';
		document.richiesta.tel.style.color='#ff0000';
		document.richiesta.tel.value='Inserisci un numero di telefono!';
		return false;
	}
	//Controllo se la richiesta risulta vuota
	if(document.richiesta.richiesta.value=='' || document.richiesta.richiesta.value=='Inserisci la tua richiesta!'  && read ==true){
		alert('La richiesta risulta vuota!');
		document.richiesta.richiesta.focus();
		document.richiesta.richiesta.style.border='2px solid #ff0000';
		document.richiesta.richiesta.style.color='#ff0000';
		document.richiesta.richiesta.value='Inserisci la tua richiesta!';
		return false;
	}
}

//Dopo che esce l'errore che non è stato inserito il valore svuota la text
function formatto(read){
	if(read=="1"){
		document.richiesta.nome.style.border='1px solid #7F9DB9'; 
		document.richiesta.nome.style.color='#000'; 
		document.richiesta.nome.value='';
	}
	if(read=="2"){
		document.richiesta.cognome.style.border='1px solid #7F9DB9'; 
		document.richiesta.cognome.style.color='#000'; 
		document.richiesta.cognome.value='';
	}
	if(read=="3"){
		document.richiesta.richiesta.style.border='1px solid #7F9DB9'; 
		document.richiesta.richiesta.style.color='#000'; 
		document.richiesta.richiesta.value='';
	}
	if(read=="4"){
		document.richiesta.paese.style.border='1px solid #7F9DB9'; 
		document.richiesta.paese.style.color='#000'; 
		document.richiesta.paese.value='';
	}
	if(read=="5"){
		document.richiesta.prov.style.border='1px solid #7F9DB9'; 
		document.richiesta.prov.style.color='#000'; 
		document.richiesta.prov.value='';
	}
	if(read=="6"){
		document.richiesta.tel.style.border='1px solid #7F9DB9'; 
		document.richiesta.tel.style.color='#000'; 
		document.richiesta.tel.value='';
	}
}

//svuoto tutti i campi
function cancellafrm(){
	valore = false;
	document.richiesta.reset();
	document.richiesta.nome.style.border='1px solid #7F9DB9'; 
	document.richiesta.nome.style.color='#000'; 
	document.richiesta.nome.value='';
		
	document.richiesta.cognome.style.border='1px solid #7F9DB9'; 
	document.richiesta.cognome.style.color='#000'; 
	document.richiesta.cognome.value='';
	
	document.richiesta.richiesta.style.border='1px solid #7F9DB9'; 
	document.richiesta.richiesta.style.color='#000'; 
	document.richiesta.richiesta.value='';
	
	document.richiesta.tel.style.border='1px solid #7F9DB9'; 
	document.richiesta.tel.style.color='#000'; 
	document.richiesta.tel.value='';
	
	document.richiesta.prov.style.border='1px solid #7F9DB9'; 
	document.richiesta.prov.style.color='#000'; 
	document.richiesta.prov.value='';
	
	document.richiesta.paese.style.border='1px solid #7F9DB9'; 
	document.richiesta.paese.style.color='#000'; 
	document.richiesta.paese.value='';
}
function inviofrm(){
	valore = true;
}
/*FINE CONTROLLO*/	