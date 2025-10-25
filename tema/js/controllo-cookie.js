/* CONTROLLO SE IL COOKIE ACCETTA ESISTE */
function controllaCookie(){
	var controllo;
	controllo=leggiCookie("accetta");
	/* SE NON ESISTE FACCIO APPARIRE LA DIV DELLA PRIVACY */
	if (controllo==0){
		/* VISUALIZZO LA DIV DELLA PRIVACY */
		document.getElementById("privacy").style.visibility="visible";
		
	}
}
/* LEGGE I COOKIE */
function leggiCookie(nome) {
  var nome = nome + "=";
  var cookies = document.cookie.split(';');

  for(var i = 0; i < cookies.length; i++) {
    var c = cookies[i].trim();
    
    if (c.indexOf(nome) == 0) 
      return c.substring(nome.length, c.length);  
  }
  return 0;
}

/* SETTO I COOKIE */
function scriviCookie(nomeCookie,valoreCookie,durataCookie)
{
  var scadenza = new Date();
  var adesso = new Date();
  scadenza.setTime(scadenza.getTime() + (durataCookie * 24 * 60 * 60 *1000));
  document.cookie = nomeCookie + '=' + escape(valoreCookie) + '; expires=' + scadenza.toGMTString() + '; path=/';
}

/* RICHIAMO LA FUNZIONE DEI COOKIE DOPO CHE HO PREMUTO OK DELLA DIV PRIVACY*/
function MessaggioIniziale(){
	scriviCookie("accetta","1",365);
	document.getElementById("privacy").style.visibility="hidden";
	
}