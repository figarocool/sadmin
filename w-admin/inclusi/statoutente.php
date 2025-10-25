<?	
	//connessione al database
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	//selezione del database
	mysql_select_db($database) or die ("Non riesco a selezionare il database");
	if(isset($_GET['att']) and strlen($_GET['att'])>0){
		mysql_query("DELETE FROM attivazione where idutente='".$_GET['att']."'");
		//Invio email per l'attivazione
		include("emailsblocco.php");
	}
	if(isset($_GET['dis']) and strlen($_GET['dis'])>0){
		//Inserimento nella tabella attivazione
		mysql_query("insert into attivazione values(default,'".$_GET['dis']."','0','0')");
	}
?>