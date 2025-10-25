//aggiunge una voce nella gestione delle priorità
/*function aggiungivoce(){
	num_option=document.getElementById('marca').options.length; 
	indice_selezionato = document.getElementById('selectmarca').selectedIndex;
	if(indice_selezionato>=0){
		value_selezionato = document.getElementById('selectmarca').options[indice_selezionato].value;
		testo_selezionato = document.getElementById('selectmarca').options[indice_selezionato].innerHTML;
		duplicato=0;
		for(a=0;a<num_option;a++){
			if(document.getElementById('marca').options[a].value==value_selezionato){
				duplicato=1;
			}
		}
		if(duplicato==0){
			document.getElementById('marca').options[num_option]=new Option('',escape(value_selezionato),false,false);
			document.getElementById('marca').options[num_option].innerHTML = testo_selezionato;
		}
	}
}

//rimuove una voce della gestione delle priorità
function rimuovivoce(){
	indice_selezionato = document.getElementById('marca').selectedIndex;
	if(indice_selezionato>=0){
		document.getElementById('marca').options[indice_selezionato]=null;
	}
}*/
//cerca una voce nella relativa lista
function cercaimgprodotto(idprodotto,tipo){
	if(idprodotto.length>0){
		switch(tipo){
			case "prodotto":
			document.getElementById('ricavoimg1').innerHTML="<iframe name='iframe1' id='iframe1' style=\"background-color: #D5E2EB; margin-left: -5px; margin-top: -12px;\" src='cercaimgprodotti.php?id="+idprodotto+"' height='190px' width='230px' FRAMEBORDER='0' SCROLLING='no'>";
			break;
			
			case "offerta":
			document.getElementById('ricavoimg2').innerHTML="<iframe name='iframe1' id='iframe1' style=\"background-color: #D5E2EB; margin-left: -5px; margin-top: -12px;\" src='cercaimgprodotti.php?id="+idprodotto+"' height='190px' width='230px' FRAMEBORDER='0' SCROLLING='no'>";
			break;
			
			case "prodottoiframe":
			top.document.getElementById('ricavoimg1').innerHTML="<iframe name='iframe1' id='iframe1' style=\"background-color: #D5E2EB; margin-left: -5px; margin-top: -12px;\" src='cercaimgprodotti.php?id="+idprodotto+"' height='190px' width='230px' FRAMEBORDER='0' SCROLLING='no'>";
			break;
			
			case "offertaiframe":
			top.document.getElementById('ricavoimg2').innerHTML="<iframe name='iframe1' id='iframe1' style=\"background-color: #D5E2EB; margin-left: -5px; margin-top: -12px;\" src='cercaimgprodotti.php?id="+idprodotto+"' height='190px' width='230px' FRAMEBORDER='0' SCROLLING='no'>";
			break;
		}	
	}
}


//Se la text di ricerca ritorna a zero visualizzare tutti i risultati
function mostratutti(e,text,tabella,selectselezionata){

	if (!e) var e = window.event;    
	if (e.keyCode) code = e.keyCode;     
	else if (e.which) code = e.which;
	
	if(text.length==0 && code==8){
		switch(tabella){
			case "marche":
			document.getElementById('ricavoselect').innerHTML="<iframe name='iframe1' id='iframe1' style=\"background-color: #D5E2EB; margin-left: -5px; margin-top: -12px;\" src='mostratutti.php?tabella="+tabella+"&select="+selectselezionata+"' height='118px' width='350px' FRAMEBORDER='0' SCROLLING='no'>";
			break;
			
			case "categorie":
			document.getElementById('ricavoselect1').innerHTML="<iframe name='iframe1' id='iframe1' style=\"background-color: #D5E2EB; margin-left: -5px; margin-top: -12px;\" src='mostratutti.php?tabella="+tabella+"&select="+selectselezionata+"' height='118px' width='350px' FRAMEBORDER='0' SCROLLING='no'>";
			break;
		
			case "prodotti":
			document.getElementById('ricavoselect2').innerHTML="<iframe name='iframe1' id='iframe1' style=\"background-color: #D5E2EB; margin-left: -5px; margin-top: 0px;\" src='mostratutti.php?tabella="+tabella+"&select="+selectselezionata+"' height='120px' width='500px' FRAMEBORDER='0' SCROLLING='no'>";
			break;
			
			case "offerte":
			document.getElementById('ricavoselect3').innerHTML="<iframe name='iframe1' id='iframe1' style=\"background-color: #D5E2EB; margin-left: -5px; margin-top: 0px;\" src='mostratutti.php?tabella="+tabella+"&select="+selectselezionata+"' height='120px' width='500px' FRAMEBORDER='0' SCROLLING='no'>";
			break;
		}
	}
}

//Se la text è uguale a al testo di default cerca viene svuotata
function svuotatext(text){
	if(text.value=='Cerca una marca...' || text.value=='Cerca una categoria...' || text.value=='Cerca un prodotto...' || text.value=='Cerca un \'offerta...'){
		text.value='';
	}
}

//Sostituisci tutte le occorrenze di una stringa
function replaceAll(txt, replace, with_this) {  
	return txt.replace(new RegExp(replace, 'g'),with_this);
}


//cerca una voce nella relativa lista
function cercavoce(ricerca,archivio,tabella,selectselezionata){
	if(ricerca.value!='Cerca una marca...' && ricerca.value!='' && ricerca.value!='Cerca una categoria...' && ricerca.value!='Cerca un prodotto...' && ricerca.value!='Cerca un \'offerta...'){
		switch(tabella){
			case "marche":
			document.getElementById('ricavoselect').innerHTML="<iframe name='iframe1' id='iframe1' style=\"background-color: #D5E2EB; margin-left: -5px; margin-top: -12px;\" src='cercaprodotti.php?cerca="+replaceAll(ricerca.value,"'","&#39;")+"&tabella="+tabella+"&select="+selectselezionata+"' height='118px' width='350px' FRAMEBORDER='0' SCROLLING='no'>";
			break;
			
			case "categorie":
			document.getElementById('ricavoselect1').innerHTML="<iframe name='iframe1' id='iframe1' style=\"background-color: #D5E2EB; margin-left: -5px; margin-top: -12px;\" src='cercaprodotti.php?cerca="+replaceAll(ricerca.value,"'","&#39;")+"&tabella="+tabella+"&select="+selectselezionata+"' height='118px' width='350px' FRAMEBORDER='0' SCROLLING='no'>";
			break;
		
			case "prodotti":
			document.getElementById('ricavoselect2').innerHTML="<iframe name='iframe1' id='iframe1' style=\"background-color: #D5E2EB; margin-left: -5px; margin-top: 0px;\" src='cercaprodotti.php?cerca="+replaceAll(ricerca.value,"'","&#39;")+"&tabella="+tabella+"&select="+selectselezionata+"' height='120px' width='500px' FRAMEBORDER='0' SCROLLING='no'>";
			break;
			
			case "offerte":
			document.getElementById('ricavoselect3').innerHTML="<iframe name='iframe1' id='iframe1' style=\"background-color: #D5E2EB; margin-left: -5px; margin-top: 0px;\" src='cercaprodotti.php?cerca="+replaceAll(ricerca.value,"'","&#39;")+"&tabella="+tabella+"&select="+selectselezionata+"' height='120px' width='500px' FRAMEBORDER='0' SCROLLING='no'>";
			break;
		}
		
		
		/*for(a=0;a<archivio.length;a++){
			alert(archivio.options[a].id);
			if(archivio.options[a].id.toLowerCase()==ricerca.value.toLowerCase()){
				archivio.options[a].selected=true;
				break;
			}
		}*/
	}else{
		alert('Inserisci un valore da cercare!!!');
		ricerca.value='';
		ricerca.focus();
	}	
}
	