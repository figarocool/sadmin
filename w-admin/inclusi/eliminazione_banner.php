<?php
	if(isset($_GET['elim']) and strlen($_GET['elim'])>0){
		//connessione al database
		$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
		//selezione del database
		mysql_select_db($database) or die ("Non riesco a selezionare il database");
		//Ricavo tutte le categorie dal database
		$query="select nome_immagine from banner where id='".$_GET['elim']."'";
		$ris=@mysql_query($query) or die ("Query: ".$query." non eseguita!");
		$rs = mysql_fetch_array($ris);
		$immaginecat=$rs[0];
		
		$percorsoelimina=$_SERVER['DOCUMENT_ROOT']."/banner/";
		
		@unlink($percorsoelimina . $immaginecat);
		mysql_query("DELETE FROM banner where id='".$_GET['elim']."'");
	}
?>