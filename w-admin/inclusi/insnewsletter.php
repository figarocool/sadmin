<?
	//config
	include "../config.php";
	//connessione al database
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	//selezione del database
	mysql_select_db($database) or die ("Non riesco a selezionare il database");
	//Inserisco la newsletter nel db
	mysql_query("insert into newsletter values(default,'".$_POST['titolo']."','".$_POST['descrizione']."','true')");
?>	