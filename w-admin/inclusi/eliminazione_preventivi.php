<?
	if(isset($_GET['elim']) and strlen($_GET['elim'])>0){
		//connessione al database
		$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
		//selezione del database
		mysql_select_db($database) or die ("Non riesco a selezionare il database");
		//eliminazione nella tabella preventivi
		mysql_query("DELETE FROM preventivi where idpreventivo='".$_GET['elim']."'");
		mysql_query("DELETE FROM statopreventivi where idpreventivo='".$_GET['elim']."'");
		mysql_query("DELETE FROM messaggi where idpreventivo='".$_GET['elim']."'");
		mysql_query("DELETE FROM specifichepreventivo where idpreventivo='".$_GET['elim']."'");
	}
?>