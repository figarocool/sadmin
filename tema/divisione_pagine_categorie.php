<?php
	//query per le categorie
	$q="SELECT * FROM prodotti JOIN assegnazionecategorie ON prodotti.id=assegnazionecategorie.idprodotto ".$select;
	$r=mysql_query($q) or die ("Query: ".$q." non eseguitaa!");
	
	//conto i prodotti inseriti
	$righe=mysql_num_rows($r);
	//Numero di prodotti per ogni pagina
	$num=9;
	//Numero di pagine relativo al numero di prodotti inseriti per ogni pagina 
	$pagine=ceil($righe/$num);
	//Se esiste la variabile $_GET['id'] setta la variabile $corrente all'id passato altrimenti a zero
	if(isset($_GET['page'])){
		$partenza=$_GET['page']*$num;
		$corrente=$_GET['page'];
	}else{
		$partenza=0;
		$corrente=0;
	}
?>	