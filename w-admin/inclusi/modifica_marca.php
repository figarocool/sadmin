<?
	if(isset($_POST['modi']) and strlen($_POST['modi'])>0){
		$modificaimg=false;
		//connessione al database
		$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
		//selezione del database
		mysql_select_db($database) or die ("Non riesco a selezionare il database");
		//Controllo se la marca esiste già
		$query="select * from marche where nome='".mysql_real_escape_string($_POST['titolo'])."' and id!='".$_POST['modi']."'";
		$ris=mysql_query($query) or die ("Query: cerca marca esistente non eseguita!");
		//conto i record inseriti
		$rec=mysql_num_rows($ris);
		//Se è uguale non lo inserisce
		if($rec>0){
			$messaggio="<div class='erroremsg'>Marca gi&agrave; esistente.</div>";
		}else{	
			if(strlen($_FILES['file1']['name'])>0){
				//Estensione del file
				$specifichefile=pathinfo($_FILES['file1']['name']);
				$estensionefile=$specifichefile['extension'];
				//Controllo estensione del file se si tratta di un'immagine
				if(strtolower($estensionefile)==strtolower("jpg") or strtolower($estensionefile)==strtolower("gif") or strtolower($estensionefile)==strtolower("jpe") or strtolower($estensionefile)==strtolower("jpeg") or strtolower($estensionefile)==strtolower("png")){
					$imgold=$_POST['imgold'];
					//cartella destinazione
					$percorsosave=$_SERVER['DOCUMENT_ROOT']."/upload/marche/";
					$percorsoelimina=$_SERVER['DOCUMENT_ROOT']."/upload/";
					$create_file=$percorsosave.$_FILES['file1']['name'];
					if(is_file($create_file)==false){
						if (is_uploaded_file($_FILES['file1']['tmp_name'])) {
							if (move_uploaded_file($_FILES['file1']['tmp_name'], $create_file)){
								resize($_FILES['file1']['name'],$_FILES['file1']['name'],0,200,2,$percorsosave);
							}else{
								print "L'immagine non è stata inserita correttamente!";
							}
						}
					}
					if($imgold!="/noimg.jpg"){ @unlink($percorsoelimina.$imgold); }
					$modificaimg=true;
					$imgmarca="/marche/".$_FILES['file1']['name'];
				}else{
?>				<div style="background-color:#D31D2F; color: #ffffff; padding-left: 10px; padding-top: 5px; border: 1px solid #000; width:400px; height: 30px;">I file in formato .<?php print $estensionefile; ?> non sono validi.</div>
<?php			}		
			}else{
				$modificaimg=false;
				$imgmarca="/noimg.jpg";
			}
			//Modifica la categoria
			if(isset($_GET['mod']) and strlen($_GET['mod'])>0){
				if(strlen($_POST['titolo'])>0 and strlen($_POST['descrizione'])>0){
					if($modificaimg==false){
						mysql_query("UPDATE marche SET nome='".mysql_real_escape_string($_POST['titolo'])."', descrizione='".mysql_real_escape_string($_POST['descrizione'])."' where id='".$_GET['mod']."'");
						//Messaggio di avvenuto inserimento
						$messaggio="<div class='messaggio'>Marca modificata correttamente!!!</div>";
					}else{
						mysql_query("UPDATE marche SET nome='".mysql_real_escape_string($_POST['titolo'])."', descrizione='".mysql_real_escape_string($_POST['descrizione'])."', logo='".$imgmarca."' where id='".$_GET['mod']."'");
						//Messaggio di avvenuto inserimento
						$messaggio="<div class='messaggio'>Marca modificata correttamente!!!</div>";
					}	
				}else{
					//Se il titolo è vuoto
					if(strlen($_POST['titolo'])>0){
						$messaggio="<div class='erroremsg'>Inserire il titolo della marca</div>";
					}
					//Se la descrizione è vuota
					if(strlen($_POST['descrizione'])>0){
						$messaggio="<div class='erroremsg'>Inserire la descrizione della marca</div>";
					}
				}
			}
		}
	}
?>