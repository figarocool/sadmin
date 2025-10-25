<?
	//Se il titolo e la descrizione sono stati inseriti
	if($_POST['ins']=="inscategoria" and strlen($_POST['titolo'])>0 and strlen($_POST['descrizione'])>0){
		//variabile di controllo
		$msg="si";
		//connessione al database
		$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
		//selezione del database
		mysql_select_db($database) or die ("Non riesco a selezionare il database");
		//Controllo se la marca esiste già
		$ris=mysql_query("select * from marche where nome='".mysql_real_escape_string($_POST['titolo'])."'") or die ("Query: marca non eseguita!");
		$iduguale=@mysql_result($ris,0,0);
		//cartella destinazione
		$percorsosave=$_SERVER['DOCUMENT_ROOT']."/upload/marche/";
		$create_file=$percorsosave.$_FILES['file1']['name'];
		if(is_file($create_file)==false and strlen($_FILES['file1']['name'])>0){
			//Estensione del file
			$specifichefile=pathinfo($_FILES['file1']['name']);
			$estensionefile=$specifichefile['extension'];
			//Controllo estensione del file se si tratta di un'immagine
			if(strtolower($estensionefile)==strtolower("jpg") or strtolower($estensionefile)==strtolower("gif") or strtolower($estensionefile)==strtolower("jpe") or strtolower($estensionefile)==strtolower("jpeg") or strtolower($estensionefile)==strtolower("png")){
				if (is_uploaded_file($_FILES['file1']['tmp_name'])) {
					if (move_uploaded_file($_FILES['file1']['tmp_name'], $create_file)){
						resize($_FILES['file1']['name'],$_FILES['file1']['name'],0,200,2,$percorsosave);
					}else{
						print "L'immagine non è stata inserita correttamente!";
					}
				}
				$imgmarca="/marche/".$_FILES['file1']['name'];
			}else{
?>				<div style="background-color:#D31D2F; color: #ffffff; padding-left: 10px; padding-top: 5px; border: 1px solid #000; width:400px; height: 30px;">I file in formato .<?php print $estensionefile; ?> non sono validi.</div>
<?php		}	
		}
		if(strlen($_FILES['file1']['name'])==0){$imgmarca="/noimg.jpg";}
		//Se è uguale non lo inserisce
		if(strlen($iduguale)>0){
			$messaggio="<div class='erroremsg'>Marca gi&agrave; esistente.</div>";
		}else{
			$titolo=$_POST['titolo'];
			$descrizione=$_POST['descrizione'];
			//Inserimento della categoria
			mysql_query("insert into marche values(default,'".mysql_real_escape_string($titolo)."','".mysql_real_escape_string($descrizione)."','".$imgmarca."')");
			//Messaggio di avvenuto inserimento
			$messaggio="<div class='messaggio'>Marca inserita correttamente!!!</div>";
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
?>	