<?php
	if(isset($_POST['elimina']) and $_POST['elimina']==1){
		//connessione al database
		$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
		//selezione del database
		mysql_select_db($database) or die ("Non riesco a selezionare il database");
		if(strlen($_POST['selectpriorita'])>0){
			//elimina voce
			mysql_query("DELETE FROM `gestionepriorita` where id='".$_POST['selectpriorita']."'");
			//Messaggio di avvenuta eliminazione
			$messaggio="<div class='messaggio'>Valore eliminato correttamente!!!</div>";
		}else{
			//Messaggio di errore
			$messaggio="<div class='erroremsg'>Nessun valore selezionato</div>";
		}	
	}
?>