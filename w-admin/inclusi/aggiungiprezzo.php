<? 
	if(isset($_POST['salvaprezzi']) and strlen($_POST['salvaprezzi'])>0){
		//connessione al database
		$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
		//selezione del database
		mysql_select_db($database) or die ("Non riesco a selezionare il database");
		if(strlen($_POST['idprodotto'])>0 or strlen($_POST['prezzo'])>0){
			//Informazioni del prodotto
			$queryy=mysql_query("select * from prezzi where idprodotto='".$_POST['idprodotto']."'") or die ("Query: prod non eseguita!");
			//conto i record inseriti
			$righe=mysql_num_rows($queryy);
			if($righe>0){
				//Modifica del prezzo già esistente
				mysql_query("UPDATE prezzi SET prezzo='".$_POST['prezzo']."' where idprodotto='".$_POST['idprodotto']."'");
				$msg="<div class='messaggio'>Il prezzo del prodotto &egrave; stato modificato!</div>";
			}else{
				//Inserimento il prezzo del prodotto
				mysql_query("insert into prezzi values(default,'".$_POST['idprodotto']."','".$_POST['prezzo']."')");
				$msg="<div class='messaggio'>Il prezzo del prodotto &egrave; stato inserito!</div>";
			}
		}else{
			$msg="<div class='erroremsg'>Errore nell'inserimento del prezzo</div>";
		}	
	}
?>