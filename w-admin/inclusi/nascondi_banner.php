<?php
	$nascondi=false;
	if(isset($_GET['nascondi']) and strlen($_GET['nascondi'])>0){
		//connessione al database
		$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
		//selezione del database
		mysql_select_db($database) or die ("Non riesco a selezionare il database");
		//Ricavo tutte le categorie dal database
		$query=mysql_query("select visuale from banner where id='".$_GET['nascondi']."'") or die ("Query: nascondi marca non eseguita!");
		$visuale=@mysql_result($query,0,0);
		if(strlen($visuale)>0){
			if($visuale=="0"){ $stato="1"; }
			if($visuale=="1"){ $stato="0"; }
		}else{
			$stato="0";
		}	
		mysql_query("UPDATE banner SET visuale='".$stato."' where id='".$_GET['nascondi']."'");
		//Messaggio di avvenuto modifica
		$nascondi=true;
	}
?>