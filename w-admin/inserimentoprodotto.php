<?php
	//Controlo se i campi sono corretti
		//Controllo del titolo
		if(isset($_POST['titolo']) and strlen($_POST['titolo'])>0){
			$titolo=$_POST['titolo'];
		}else{
			$errore="Il titolo del prodotto risulta vuoto!!!<br />";
		}
		//Controllo della descrizione
		if(isset($_POST['descrizione']) and strlen($_POST['descrizione'])>0){
			$descrizione=$_POST['descrizione'];
		}else{
			$errore.="La descrizione del prodotto risulta vuota!!!<br />";
		}
		//Controllo immagine
		if(isset($_POST['listbox']) and strlen($_POST['listbox'])>0){
			$img=$_POST['listbox'];
		}else{
			$errore.="Nessuna immagine caricata!!!<br />";
		}
		//Controllo categoria
		if(isset($_POST['categoria']) and strlen($_POST['categoria'])>0){
			$categoria=$_POST['categoria'];
		}else{
			$errore.="Nessuna categoria scelta!!!<br />";
		}
		//Controllo marca
		if(isset($_POST['marca']) and strlen($_POST['marca'])>0){
			$marca=$_POST['marca'];
		}else{
			$errore.="Nessuna marca scelta!!!<br />";
		}
		//Misure
		$lunghezza=$_POST['l'];
		$altezza=$_POST['h'];
		$profondita=$_POST['p'];
		$diametro=$_POST['diam'];
		$lunghezza2=$_POST['l2'];
		$altezza2=$_POST['h2'];
		$altezza3=$_POST['h3'];
		$profondita2=$_POST['p2'];
		//prezzo offerta
		$prezzo=$_POST['prezzo'];
	//fine controllo

	
	//CARICO PRODOTTI
	//Controllo se esistono errori li stampa altrimenti puoi inserire un nuovo prodotto
if(isset($errore)){
?>
	<div style='border: 2px dashed #BBBBBB;width: 100%; height:50px; font-size: 20px; padding: 15px; background-color: #F0F0F0;'>
		<p>
			<strong><?php print $errore;?></strong>
		</p>
 		<form name='indietro' id='indietro' method='POST' action='caricoprodotti.php'>
			<input type="hidden" name="arrayimg" id="arrayimg" value="<?php print $img; ?>">
			<input type="hidden" name="titolo" id="titolo" value="<?php print $titolo; ?>">
			<input type="hidden" name="descrizione" id="descrizione" value="<?php print $descrizione; ?>">
			<input type="hidden" name="marca" id="marca" value="<?php print $marca; ?>">
			<input type="hidden" name="categoria" id="categoria" value="<?php print $categoria; ?>">
			<input type="hidden" name="l" id="l" value="<?php print $lunghezza; ?>">
			<input type="hidden" name="h" id="h" value="<?php print $altezza; ?>">
			<input type="hidden" name="p" id="p" value="<?php print $profondita; ?>">
<?php			if($_POST['misureex']=="1"){
?>				<input type="hidden" name="l2" id="l2" value="<?php print $lunghezza2; ?>">
				<input type="hidden" name="h2" id="h2" value="<?php print $altezza2; ?>">
				<input type="hidden" name="d" id="d" value="<?php print $diametro; ?>">
				<input type="hidden" name="h3" id="h3" value="<?php print $altezza3; ?>">
				<input type="hidden" name="p2" id="p2" value="<?php print $profondita2; ?>">
<?php			}
?>			<input type="hidden" name="ritorno" id="ritorno" value="ritorno">
<?php			if($_POST['offerte']=="1"){
?>				<input type="hidden" name="prezzo" id="prezzo" value="<?php print $prezzo; ?>">
<?php			}
			if(strlen($_POST['legno'])>0 or strlen($_POST['colore'])>0 or strlen($_POST['anno'])>0 or strlen($_POST['ante'])>0 or strlen($_POST['cassetti'])>0 or strlen($_POST['posti'])>0 or strlen($_POST['finitura'])>0 or strlen($_POST['laccatura'])>0 or strlen($_POST['forma'])>0 or strlen($_POST['tipo'])>0 or strlen($_POST['stile'])>0 or strlen($_POST['particolari'])>0){
?>				<input type="hidden" name="legno" id="legno" value="<?php print $_POST['legno']; ?>">
				<input type="hidden" name="colore" id="colore" value="<?php print $_POST['colore']; ?>">
				<input type="hidden" name="anno" id="anno" value="<?php print $_POST['anno']; ?>">
				<input type="hidden" name="ante" id="ante" value="<?php print $_POST['ante']; ?>">
				<input type="hidden" name="cassetti" id="cassetti" value="<?php print $_POST['cassetti']; ?>">
				<input type="hidden" name="posti" id="posti" value="<?php print $_POST['posti']; ?>">
				<input type="hidden" name="finitura" id="finitura" value="<?php print $_POST['finitura']; ?>">
				<input type="hidden" name="laccatura" id="laccatura" value="<?php print $_POST['laccatura']; ?>">
				<input type="hidden" name="forma" id="forma" value="<?php print $_POST['forma']; ?>">
				<input type="hidden" name="tipo" id="tipo" value="<?php print $_POST['tipo']; ?>">
				<input type="hidden" name="stile" id="stile" value="<?php print $_POST['stile']; ?>">
				<input type="hidden" name="particolari" id="particolari" value="<?php print $_POST['particolari']; ?>">
<?php			}
?>			<input type="Submit" id="submit" name="submit" value="<< Indietro">
		</form>
	</div>	
<?php	
}else{
	//Inserimento nel database
	//Dati database, connessione e selezione del database
	include "../config.php";
	//connessione al database
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	//selezione del database
	mysql_select_db($database) or die ("Non riesco a selezionare il database");
	//query di inserimento prodotti
	$query = mysql_query("insert into prodotti values('default','".mysql_real_escape_string($titolo)."', '".mysql_real_escape_string($descrizione)."', '$marca', '$lunghezza','$profondita','$altezza')") or die("Errore.La query non è stata eseguita");
	//ricavo l'id del prodotto
	$idultimo=mysql_insert_id();
	if($_POST['misureex']=="1"){
		//query di inserimento prodotti
		$query1 = mysql_query("insert into misure values('default','".$idultimo."','$diametro', '$altezza3', '$lunghezza2','$altezza2','$profondita2')") or die("Errore.La query non è stata eseguita");
	}
	//query di inserimento offeta
	if($_POST['offerte']=="1"){
		$queryofferte = mysql_query("insert into offerte values('default','$idultimo', '$prezzo')") or die("Errore.La query non è stata eseguita");
	}elseif($_POST['offerte']=="2"){
		//Metto nei prodotti in vendita
		$queryofferte = mysql_query("insert into prodottivendita values('default','$idultimo', '$prezzo')") or die("Errore.La query non è stata eseguita");
	}
	//prefisso per le immagini grandi
	$pref="max_";
	//nome cartella delle img
	$nomedir=date('d-m-Y')."/";
	//divido le immagini per la virgola
	$arrayimg=explode(",",$_POST['listbox']);
	//ricavo le immagini del prodotto
	for($i=0;$i<count($arrayimg);$i++){
		if(strlen($arrayimg[$i])>0){
			//query immagini
			$queryimg = mysql_query("insert into immagini values('default','".$idultimo."', '".$nomedir.str_replace("%20"," ",$arrayimg[$i])."', '".$nomedir.$pref.str_replace("%20"," ",$arrayimg[$i])."')") or die("Errore.La query non è stata eseguita");
		}
	}
	//inserimento avanzate del prodotto
	if(strlen($_POST['legno'])>0 or strlen($_POST['colore'])>0 or strlen($_POST['anno'])>0 or strlen($_POST['ante'])>0 or strlen($_POST['cassetti'])>0 or strlen($_POST['posti'])>0 or strlen($_POST['finitura'])>0 or strlen($_POST['laccatura'])>0 or strlen($_POST['forma'])>0 or strlen($_POST['tipo'])>0 or strlen($_POST['stile'])>0 or strlen($_POST['particolari'])>0){
		$queryavanzate = mysql_query("insert into avanzate values('default','".$idultimo."','".htmlentities($_POST['legno'])."', '".htmlentities($_POST['colore'])."', '".htmlentities($_POST['anno'])."', '".$_POST['ante']."', '".$_POST['cassetti']."','".$_POST['posti']."', '".$_POST['finitura']."','".$_POST['laccatura']."','".$_POST['forma']."','".$_POST['tipo']."','".$_POST['stile']."','".$_POST['particolari']."')") or die("Errore.La query non è stata eseguita");
	}
	
	//Inserimento delle categorie
	if(isset($_POST['listboxcategorie']) and count($_POST['listboxcategorie'])){
		foreach($_POST['listboxcategorie'] as $idcategoria) {
			$queryasscat = mysql_query("insert into assegnazionecategorie values(default,'.$idultimo.', '.$idcategoria.')") or die("Errore.La query inserimento assegnazione categorie non è stata eseguita");
		}
	}
	
	//Inserimento dei prodotti simili
	if(isset($_POST['listboxprodottisimili']) and count($_POST['listboxprodottisimili'])){
		foreach($_POST['listboxprodottisimili'] as $idprodsimile) {
			$queryasprodsimili = mysql_query("insert into prodottisimili values(default,'.$idultimo.', '.$idprodsimile.')") or die("Errore.La query inserimento prodotti simili non è stata eseguita");
		}
	}
	
	// Inserisco tutte le misure con nome
	foreach ($_POST['prodottoNuovo'] as $array_prodotto) {
	  if ($array_prodotto) {
		if ($array_prodotto['l'] != "" or $array_prodotto['p'] != "" or $array_prodotto['h'] != "" or $array_prodotto['d'] != "" or $array_prodotto['nome_prod_tmp'] != ""){
			$querymisurenuove = mysql_query("insert into misure_prodotto(idprodotto, l, h, p, d, nome) values('". $idultimo . "', '" .$array_prodotto['l'] . "', '" . $array_prodotto['h'] . "', '" . $array_prodotto['p'] . "', '" . $array_prodotto['d'] . "', '" . mysql_real_escape_string($array_prodotto['nome_prod_tmp']) . "')") or die("Errore.La query non è stata eseguita");
		}
	  }
	}
	
	//Distruggo la sessione delle img e della lista
	$_SESSION['lista']="";
	$_SESSION['listacategorie']="";
	$_SESSION['listaprodottisimili']="";
	unset($_SESSION['lista']);	
	unset($_SESSION['listacategorie']);	
	unset($_SESSION['listaprodottisimili']);	
?>
		<div style='border: 2px dashed #BBBBBB;width: 100%; height:50px; font-size: 20px; padding: 15px; background-color: #F0F0F0;'>
			<p>
				<strong>Il prodotto &egrave; stato inserito correttamente.</strong>
			</p>
			<p style="padding-top: 50px;">
				<a href="<?php print $_SERVER['HTTP_REFERER']."?ins=1"; ?>" title="Indietro"> 
					Torna indietro.
			</p>
		</div>
	<script language="javascript">
	//vieni rindirizzato alla pagina della gestione delle categorie
	function doLoad()  { setTimeout( 'refresh()', 0 ); }
	function refresh() { window.location.href = '<?php print $_SERVER['HTTP_REFERER']."?ins=1"; ?>';}
	</script>
	<body onload='doLoad()'>
<?php } ?>	