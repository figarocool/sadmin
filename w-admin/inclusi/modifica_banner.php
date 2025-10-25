
.<?php
	if(isset($_POST['modi']) and strlen($_POST['modi'])>0){
		$modificaimg=false;
		//connessione al database
		$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
		//selezione del database
		mysql_select_db($database) or die ("Non riesco a selezionare il database");	
		
		if(strlen($_FILES['file1']['name'])>0){
			$imgold=$_POST['imgold'];
			//cartella destinazione
			$percorsosave=$_SERVER['DOCUMENT_ROOT']."/banner/";
			$percorsoelimina=$_SERVER['DOCUMENT_ROOT']."/banner/";
			$create_file=$percorsosave.$_FILES['file1']['name'];
			if(is_file($create_file)==false){
				if (is_uploaded_file($_FILES['file1']['tmp_name'])) {
					if (move_uploaded_file($_FILES['file1']['tmp_name'], $create_file)==false){
						print "L'immagine non è stata inserita correttamente!";
					}
				}
			}
			@unlink($percorsoelimina.$imgold);
			$modificaimg=true;
		}else{
			$modificaimg=false;
		}	
		//Modifica la categoria
		if(isset($_GET['mod']) and strlen($_GET['mod'])>0){
			if(strlen($_POST['titolo'])>0 and strlen($_POST['descrizione'])>0){
				if($modificaimg==false){
					mysql_query("UPDATE banner SET link='".mysql_real_escape_string(utf8_decode($_POST['titolo']))."', numero='".mysql_real_escape_string(utf8_decode($_POST['descrizione']))."' where id='".$_GET['mod']."'");
					//Messaggio di avvenuto inserimento
					$messaggio="<div class='messaggio'>Banner modificato correttamente!!!</div>";
				}else{
					mysql_query("UPDATE banner SET link='".mysql_real_escape_string(utf8_decode($_POST['titolo']))."', numero='".mysql_real_escape_string(utf8_decode($_POST['descrizione']))."', nome_immagine='".$_FILES['file1']['name']."' where id='".$_GET['mod']."'");
					//Messaggio di avvenuto inserimento
					$messaggio="<div class='messaggio'>Banner modificato correttamente!!!</div>";
				}	
			}else{
				//Se il numero è vuoto
				if(strlen($_POST['descrizione'])==0){
					$messaggio="<div class='erroremsg'>Inserire il numero progressivo del banner</div>";
				}
			}
		}
	}
?>