<?
	//connessione al database
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	//selezione del database
	mysql_select_db($database) or die ("Non riesco a selezionare il database");
	if(isset($_GET['elim']) and strlen($_GET['elim'])){
		mysql_query("DELETE FROM newsletter where id='".$_GET['elim']."'");
	}
	mysql_close($db);
?>