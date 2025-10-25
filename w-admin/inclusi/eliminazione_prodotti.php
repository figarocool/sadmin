<?
	if(isset($_GET['elimprod']) and strlen($_GET['elimprod'])>0){
		//connessione al database
		$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
		//selezione del database
		mysql_select_db($database) or die ("Non riesco a selezionare il database");
		//eliminazione nella tabella preventivi
		mysql_query("DELETE FROM preventivi where idprodotto='".$_GET['elimprod']."' and idpreventivo='".$_GET['visualizza']."'");
	}
?>