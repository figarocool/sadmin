<body bgcolor="#D5E2EB">
<?php
	//dichiarazioni variabili
	$idprodotto=$_GET['id'];

	//Dati database, connessione e selezione del database
	include "../config.php";
	//connessione al database
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	//selezione del database
	mysql_select_db($database) or die ("Non riesco a selezionare il database");	
	//query creata
	$querycampo=mysql_query("SELECT * FROM immagini where idprodotto=".$idprodotto." LIMIT 1") or die ("Query: img  non eseguita!");
	//conto i risultati
	$righecampo=mysql_num_rows($querycampo);
	if($righecampo>0){
		print "<img src='/upload/".@mysql_result($querycampo,0,2)."' />";
	}else{
		print "<img src='/w-admin/immagini/noanteprima.jpg' />";
	}	
	mysql_close($db);
?>
</body>





