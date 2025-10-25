<?
/*
<!-- http://free-script.it/ -->
<!-- Free script - Script gratuiti per il web. Script php, script asp, script javascript, script ajax. -->
<!-- Script ajax: Drag and drop con scriptaculous e salvataggio posizione -->
*/
	//Dati database
	include "../config.php";
	//connessione al database
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	//selezione del database
	mysql_select_db($database) or die ("Non riesco a selezionare il database");
		/*MENU 1*/	
	//marche
	$q='select * from marche';
	$r=mysql_query($q) or die ("Query: ".$q." non eseguita!");
	//conto le marche
	$nummarche=mysql_num_rows($r);
	//categorie
	$q1='select * from categorie';
	$r1=mysql_query($q1) or die ("Query: ".$q1." non eseguita!");
	//conto le categorie
	$numcategorie=mysql_num_rows($r1);
	//prodotti
	$q3='select * from prodotti';
	$r2=mysql_query($q3) or die ("Query: ".$q3." non eseguita!");
	//conto i prodotti
	$numprodotti=mysql_num_rows($r2);
	//utenti
	$q5='select * from utenti';
	$r5=mysql_query($q5) or die ("Query: ".$q5." non eseguita!");
	//conto i prodotti
	$numutenti=mysql_num_rows($r5);
	//offerte
	$q4='select * from offerte';
	$r3=mysql_query($q4) or die ("Query: ".$q4." non eseguita!");
	//conto i prodotti
	$numofferte=mysql_num_rows($r3);
/*FINE MENU1*/
?>