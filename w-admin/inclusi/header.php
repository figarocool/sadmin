<?
	//connessione al database
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.iiinc.php");
	//selezione del database
	mysql_select_db($database) or die ("Non riesco a selezionare il database");
	//Trovo i dati dal database
	$ris = mysql_query("select * from utenti where id='".$_SESSION['utente']."'") or die ("Query non eseguita!");
	$nomebac=@mysql_result($ris,0,1);
?>
<div class="box2">
	<div class="header">
		<a href="../index.html" title="Torna alla home">
			<img src="immagini/w-admin.jpg" border="0">
		</a>	
	</div>
	<div class="header1">
		<div class="testoheader1">
			Benvenuto <b><? print $nomebac; ?></b> | <a href="http://<? print $_SERVER['HTTP_HOST']."/tema/esci.php?esci=1";?>" style="color:#fff;"><u>[Esci dall'account]</u></a>
		</div>	
		<div class="profilo">
			<a href="profilo.php?prof=<? print $_SESSION['utente']; ?>">
				<img src="immagini/freccia.jpg" border="0"> Profilo
			</a>
		</div>
	</div>
</div>