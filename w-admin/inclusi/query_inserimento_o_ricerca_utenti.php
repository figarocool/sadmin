<?

	if(isset($_POST['cerca']) and strlen($_POST['cerca'])>0){
		print $cerca=$_POST['cerca'];
		$query="SELECT * FROM utenti WHERE nome LIKE '%$cerca%'or cognome LIKE '%$cerca%' or user LIKE '%$cerca%' order by id asc LIMIT ".$partenza.",".$num."";
		$visualizzatutto=" | <a href='gestioneutente.php' class='linkvisual'>Visualizza tutti</a>";
		$ris=mysql_query($query) or die ("Query: ".$query." non eseguita!");
		if(strlen(@mysql_result($ris,0,0))==0){
			$nessunutenti="Nessun valore trovato!";
		}
	}else{
		$query="select * from utenti order by id asc LIMIT ".$partenza.",".$num."";
		$ris=mysql_query($query) or die ("Query: ".$query." non eseguita!");
		if(strlen(mysql_result($ris,0,0)==0)){
			$nessunutenti="Nessun utente inserito!";
		}
	}
?>