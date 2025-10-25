<?		//Dati database
		include "config.php";
		//connessione al database
		$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
		//selezione del database
		mysql_select_db($database) or die ("Non riesco a selezionare il database");
		//Controllo se l'utente è  esiste
		$query="select * from utenti where id='".$_GET['ac']."'";
		$ris=mysql_query($query) or die ("Query: ".$query." non eseguita!");
		$profilo=@mysql_result($ris,0,10);
?>		