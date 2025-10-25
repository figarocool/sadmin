<?
	if(isset($_GET['elim']) and strlen($_GET['elim'])>0){
		//connessione al database
		$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
		//selezione del database
		mysql_select_db($database) or die ("Non riesco a selezionare il database");
		//Ricavo tutte le categorie dal database
		$query="select * from marche where id='".$_GET['elim']."'";
		$ris=@mysql_query($query) or die ("Query: ".$query." non eseguita!");
		$immaginecat=@mysql_result($ris,0,3);
		$percorsoelimina=$_SERVER['DOCUMENT_ROOT']."/upload/";
		if($immaginecat!="/noimg.jpg"){ @unlink($percorsoelimina.$immaginecat); }
		mysql_query("DELETE FROM marche where id='".$_GET['elim']."'");
	}
?>