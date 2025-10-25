/*CALCOLO DEL TOTALE IVATO*/
function totale(x,y){
	//Controllo se il prezzo e l'iva sono state inserite con la virgola, in tal caso sostituisco con il punto
	num1 = x.replace(',','.');
	num2 = y.replace(',','.');
	//Sostituisco il valore inserito con la virgola in un numero con il punto sia per il prezzo che per l'iva
	document.getElementById('prezzo').value=num1;
	document.getElementById('iva').value=num2;
	//Controllo se il prezzo inserito è un numero
	if (isNaN(num1) == true) { 
		alert("Il prezzo inserito non e' un numero");
	}
	//Controllo se l'iva inserita è un numero
	if (isNaN(num2) == true) { 
		alert("l'iva inserito non e' un numero"); 
	} 
	//Se entrambi i valori sono stati inseriti correttamente
	if(isNaN(num1) == false && isNaN(num2) == false && num1!='' && num2!=''){
		//trasformo il prezzo e la percentuale in numero decimale
		prezzo = parseFloat(num1);
		percentuale = parseFloat(num2);
		//Calcolo il totale ivato
		tot=prezzo+((prezzo*percentuale)/100);
		//Scrivo il totale nella div del totale
		document.getElementById('totale').innerHTML="<b>Totale ivato: <span style='color:ff0000;'>"+tot+" Euro</span></b>";
	}
}
/*FINE FUNZIONE CALCOLO*/


/*FUNZIONE PER IL CONTROLLO DEI VALORI INSERITI NEL CARICO PRODOTTI*/
function controllocampi(){
	//Controllo se il titolo risulta vuoto
	if(document.carico.titolo.value==''){
		alert('Il titolo del prodotto risulta vuoto!');
		document.carico.titolo.focus();
		return false;
	}

	//Controllo se l'img del prodotto risulta vuota
	if(document.carico.listbox.value==''){
		alert("L' immagine del prodotto risulta vuota!");
		document.carico.listbox.focus();
		return false;
	}
	//Controllo se il prezzo del prodotto risulta vuoto
	if(document.carico.prezzo.value==''){
		alert("Il prezzo del prodotto risulta vuoto!");
		document.carico.prezzo.focus();
		return false;
	}
	//Controllo se il prezzo del prodotto è un numero
	if(isNaN(document.carico.prezzo.value)==true){
		alert("Il prezzo inserito per il prodotto non e' un numero!");
		document.carico.prezzo.focus();
		return false;
	}
	//Controllo se l'iva del prodotto risulta vuota
	if(document.carico.iva.value==''){
		alert("L'iva del prodotto risulta vuoto!");
		document.carico.iva.focus();
		return false;
	}
	//Controllo se l'iva del prodotto è un numero
	if(isNaN(document.carico.iva.value)==true){
		alert("L'iva inserita per il prodotto non e' un numero!");
		document.carico.iva.focus();
		return false;
	}
	//Controllo se la quantità del prodotto risulta vuota
	if(document.carico.quantita.value==''){
		alert("La quantita' del prodotto risulta vuota!");
		document.carico.quantita.focus();
		return false;
	}
	//Controllo se la quantità del prodotto è un numero
	if(isNaN(document.carico.quantita.value)==true){
		alert("La quantita' inserita per il prodotto non e' un numero!");
		document.carico.quantita.focus();
		return false;
	}
}
/*FINE FUNZIONE CONTROLLO*/


/*CONTROLLO CAMPI VUOTI REGISTRAZIONE*/
function registrazione(){
	//Controllo se il nome risulta vuoto
	if(document.invio.nome.value==''){
		alert('Il campo nome risulta vuoto!');
		document.invio.nome.focus();
		return false;
	}
	//Controllo se il cognome risulta vuoto
	if(document.invio.cognome.value==''){
		alert('Il cognome risulta vuoto!');
		document.invio.cognome.focus();
		return false;
	}
	//Controllo se la data di nascita non è vuota
	if(document.invio.giorno.options[document.invio.giorno.selectedIndex].text=="--Giorno--"){
		alert("Data di nascita non corretta!");
		return false;
	}
	if(document.invio.mese.options[document.invio.mese.selectedIndex].text=="--Mese--"){
		alert("Data di nascita non corretta!");
		return false;
	}
	if(document.invio.anno.options[document.invio.anno.selectedIndex].text=="--Anno--"){
		alert("Data di nascita non corretta!");
		return false;
	}
	//Controllola citta' risulta vuota 
	if(document.invio.citta.value==''){
		alert("La citta risulta vuota!");
		document.invio.citta.focus();
		return false;
	}
	//Controllo se la provincia della spedizione risulta vuota
	if(document.invio.provincia.value==''){
		alert("La provincia risulta vuoto!");
		document.invio.provincia.focus();
		return false;
	}
	//Controllo se il cap risulta vuoto
	if(document.invio.cap.value==''){
		alert("Il cap risulta vuota!");
		document.invio.cap.focus();
		return false;
	}
	//Controllo se il cap è un numero
	if(isNaN(document.invio.cap.value)==true){
		alert("Il cap non e' un numero!");
		document.invio.cap.focus();
		return false;
	}
	//Controllo se il cap è un di 5
	if(document.invio.cap.value.length!=5){
		alert("Il cap deve essere di 5 caratteri!");
		document.invio.cap.focus();
		return false;
	}
	//Controllo se la via risulta vuota
	if(document.invio.via.value==''){
		alert("L' indirizzo risulta vuoto!");
		document.invio.via.focus();
		return false;
	}
	//Controllo se l'user risulta vuoto
	if(document.invio.user.value==''){
		alert("L'username risulta vuoto!");
		document.invio.user.focus();
		return false;
	}
	//Controllo se la password risulta vuota
	if(document.invio.psw.value==''){
		alert("La password risulta vuota!");
		document.invio.psw.focus();
		return false;
	}
	//Controllo se l'email risulta vuota
	if(document.invio.email.value==''){
		alert("L'email risulta vuota!");
		document.invio.email.focus();
		return false;
	}
	//Controllo se il captcha è vuoto
	if(document.invio.legge.checked==false){
		alert('Devi accettare la legge sulla privacy!');
		return false;
	}
	//Controllo se il captcha è vuoto
	if(document.invio.txt_captcha.value==''){
		alert('Il captcha risulta vuoto!');
		document.invio.txt_captcha.focus();
		return false;
	}
}
/*FINE REGISTRAZIONE*/


/*LOGIN*/
function controllologin(){
	//Controllo se l'username risulta vuoto
	if(document.login.user.value==''){
		alert("L'username risulta vuoto!");
		document.login.user.focus();
		return false;
	}
	//Controllo se la password risulta vuota
	if(document.login.psw.value==''){
		alert("La password risulta vuota!");
		document.login.psw.focus();
		return false;
	}
}
/*FINE LOGIN*/


/*CONTROLLO DEI CAMPI VUOTI ALL'INSERIMENTO PRODOTTI*/
function controlloprodotto(){
	//Controllo se il titolo del prodotto è vuoto
	if(document.ins.titolo.value==''){
		alert("Il titolo risulta vuoto!");
		document.ins.titolo.focus();
		return false;
	}
	//Controllo se l'img del prodotto risulta vuota
	if(document.ins.listbox.value==''){
		alert("L' immagine del prodotto risulta vuota!");
		document.ins.listbox.focus();
		return false;
	}
	//Controllo se la marca del prodotto risulta vuota
	if(document.ins.listbox.value==''){
		alert("L' immagine del prodotto risulta vuota!");
		document.ins.listbox.focus();
		return false;
	}
	//Controllo se la marca del prodotto risulta vuota
	if(document.ins.marca.options[ins.marca.selectedIndex].value=='0'){
		alert("La marca del prodotto risulta vuota!");
		return false;
	}
	//Controllo se la categoria del prodotto risulta vuota
	if(document.ins.categoria.options[ins.categoria.selectedIndex].value=='0'){
		alert("La categoria del prodotto risulta vuota!");
		return false;
	}
}
/*FINE PRODOTTI*/