<?php
//Controllo header
function controllo404($read){
		$solourl=explode("?",$read);
		if(count($solourl)>0){ $read = $solourl[0];} 
		
		$newurl  = explode("/",$read);
		$variabile=array($read,$newurl);
	
		switch($variabile){
			
			case count($variabile[1])==3:
			$read="pagina";
			break;
			
			case $variabile[0]=="/attivazione.html":
			$read="pagina";
			break;
			
			case $variabile[0]=="/servizi.html":
			$read="pagina";
			break;
			
			case $variabile[0]=="/leggeprivacy.html":
			$read="pagina";
			break;
			
			case $variabile[0]=="/dovesiamo.html":
			$read="pagina";
			break;
			
			case $variabile[1][3]=="categorie.html":
			$read="pagina";
			break;
			
			case $variabile[0]=="/index.html":
			$read="pagina";
			break;
			
			case $variabile[0]=="/":
			$read="pagina";
			break;
			
			case count($variabile[1])==4:
			$read="pagina";
			break;
			
			case count($variabile[1])==5:
			$read="pagina";
			break;
					
			case $variabile[0]=="/offerte.html":
			$read="pagina";
			break;		
			
			case $variabile[0]=="/ricerca.html":
			$read="pagina";
			break;
			
			case $variabile[0]=="/registrati.html":
			$read="pagina";
			break;
			
			case $variabile[0]=="/registrazionedb.html":
			$read="pagina";
			break;
			
			case $variabile[0]=="/chisiamo.html":
			$read="pagina";
			break;
			
			case $variabile[0]=="/contattaci.html":
			$read="pagina";
			break;
			
			case $variabile[0]=="/inviorichiesta.html":
			$read="pagina";
			break;
			
			case $variabile[0]=="/faq.html":
			$read="pagina";
			break;
			
			case $variabile[1][3]=="categorie.html":
			$read="pagina";
			break;
			
			case $variabile[0]=="/preventivo.html":
			$read="pagina";
			break;
	
			default:
			$read="pagina404";	
		}
		return $read;
}

	//Richiamo la funzione
	$dato = $_SERVER['REQUEST_URI']; 
	$paginacorrente=controllo404($dato);

	//Se siamo nella pagina 404 cambia l'header
	if ($paginacorrente == "pagina404"){ 
		header("HTTP/1.0 404 Not Found"); 
		header("Status: 404 Not Found");
	}
	
?>