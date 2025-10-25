<?php
	//Se il titolo e la descrizione sono stati inseriti
	if($_POST['ins']=="inscategoria" and strlen($_POST['descrizione'])>0){
		//variabile di controllo
		$msg="si";
		//connessione al database
		$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
		//selezione del database
		mysql_select_db($database) or die ("Non riesco a selezionare il database");
		//cartella destinazione
		$percorsosave=$_SERVER['DOCUMENT_ROOT']."/banner/";
		$create_file=$percorsosave.$_FILES['file1']['name'];
		if(is_file($create_file)==false){
			if (is_uploaded_file($_FILES['file1']['tmp_name'])) {
				if (move_uploaded_file($_FILES['file1']['tmp_name'], $create_file)==false){
					print "L'immagine non è stata inserita correttamente!";
				}
			}
		}
		$link_banner=utf8_decode($_POST['titolo']);
		$numero_banner=utf8_decode($_POST['descrizione']);
		//Inserimento della categoria
		mysql_query("insert into banner(id, link, numero, nome_immagine, visuale) values('default','".mysql_real_escape_string($link_banner)."','".mysql_real_escape_string($numero_banner)."','".$_FILES['file1']['name']."','0')");
		//Messaggio di avvenuto inserimento
		$messaggio="<div class='messaggio'>Banner inserito correttamente!!!</div>";
		
	}else{
		//Se la descrizione è vuota
		if(strlen($_POST['descrizione'])>0){
			$messaggio="<div class='erroremsg'>Inserire il numero del banner</div>";
		}
	}
?>	