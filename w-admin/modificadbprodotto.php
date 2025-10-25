<?php
	//Controlo se i campi sono corretti
		//Controllo del titolo
		if(isset($_POST['titolo']) and strlen($_POST['titolo'])>0){
			$titolo=utf8_decode($_POST['titolo']);
		}else{
			$errore="Il titolo del prodotto risulta vuoto!!!<br />";
		}
		//Controllo della descrizione
		if(isset($_POST['descrizione']) and strlen($_POST['descrizione'])>0){
			$descrizione=utf8_decode($_POST['descrizione']);
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
		$lunghezza2=$_POST['l2'];
		$altezza2=$_POST['h2'];
		$altezza3=$_POST['h3'];
		$diametro=$_POST['d'];
		$profondita2=$_POST['p2'];
		$offerte=$_POST['offerte'];
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
			<input type="hidden" name="ritorno" id="ritorno" value="ritorno">
<?php			if($_POST['offerte']=="1" or $_POST['offerte']=="2"){
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
	$query = mysql_query("Update prodotti set titolo='".mysql_real_escape_string($titolo)."', descrizione='".mysql_real_escape_string($descrizione)."', idmarca='$marca', l='$lunghezza', p='$profondita', h='$altezza' where id='".$_GET['mod']."'") or die("Errore.La queryprod non è stata eseguita");
	//ricavo l'id del prodotto
	$idultimo=mysql_insert_id();
	if($_POST['misureex']=="1"){
		$querymis=mysql_query("select * from misure where idprodotto='".$_GET['mod']."'") or die ("Query:  non eseguita!");
		//conto i prodotti inseriti
		$righe=mysql_num_rows($querymis);
		if($righe>0){
			//query di modifica misure
			$query1 = mysql_query("Update misure set d='".$diametro."', h3='".$altezza3."', l2='".$lunghezza2."',h2='".$altezza2."',p2='".$profondita2."' where idprodotto='".$_GET['mod']."'") or die("Errore.La query misure non è stata eseguita");
		}else{
			//query di inserimento misure
			$query1 = mysql_query("insert into misure values('default','".$_GET['mod']."','$diametro', '$altezza3', '$lunghezza2','$altezza2','$profondita2')") or die("Errore.La query non è stata eseguita");
		}
	}
	if($_POST['misureex']=="0"){
		//query per eliminare le misure del prodotto
		mysql_query("DELETE FROM misure where idprodotto='".$_GET['mod']."'");	
	}
	//query di inserimento offeta
	if($_POST['offerte']=="1"){
		//query di ricavo informazione prodotto
		$query="select * from offerte where idprodotto='".$_GET['mod']."'";
		$ris=mysql_query($query) or die ("Query: ".$query." non eseguita!");
		$idof=@mysql_result($ris,0,0);
		//se l'offerta esiste la modifica altrimenti la inserisce come nuova
		if(strlen($idof)>0){
			$queryofferte = mysql_query("Update offerte set prezzo='$prezzo' where idprodotto='".$_GET['mod']."'") or die("Errore.La query non è stata eseguita");
		}else{
			$queryofferte = mysql_query("insert into offerte values('default','".$_GET['mod']."', '$prezzo')") or die("Errore.La query non è stata eseguita");
		}
		mysql_query("DELETE FROM prodottivendita where idprodotto='".$_GET['mod']."'");
	}elseif($_POST['offerte']=="2"){
		//query di ricavo informazione prodotto
		$query="select * from prodottivendita where idprodotto='".$_GET['mod']."'";
		$ris=mysql_query($query) or die ("Query: ".$query." non eseguita!");
		$idof=@mysql_result($ris,0,0);
		//se l'offerta esiste la modifica altrimenti la inserisce come nuova
		if(strlen($idof)>0){
			$queryofferte = mysql_query("Update prodottivendita set prezzo='$prezzo' where idprodotto='".$_GET['mod']."'") or die("Errore.La query non è stata eseguita");
		}else{
			$queryofferte = mysql_query("insert into prodottivendita values('default','".$_GET['mod']."', '$prezzo')") or die("Errore.La query non è stata eseguita");
		}
		mysql_query("DELETE FROM offerte where idprodotto='".$_GET['mod']."'");
	}else{
		//eliminazione nella tabella offerte
		mysql_query("DELETE FROM offerte where idprodotto='".$_GET['mod']."'");
		mysql_query("DELETE FROM prodottivendita where idprodotto='".$_GET['mod']."'");
	}
	//inserimento avanzate del prodotto
	if(strlen($_POST['legno'])>0 or strlen($_POST['colore'])>0 or strlen($_POST['anno'])>0 or strlen($_POST['ante'])>0 or strlen($_POST['cassetti'])>0 or strlen($_POST['posti'])>0 or strlen($_POST['finitura'])>0 or strlen($_POST['laccatura'])>0 or strlen($_POST['forma'])>0 or strlen($_POST['tipo'])>0 or strlen($_POST['stile'])>0 or strlen($_POST['particolari'])>0){
		//query di ricavo informazione prodotto
		$query="select * from avanzate where idprodotto='".$_GET['mod']."'";
		$ris=mysql_query($query) or die ("Query: ".$query." non eseguita!");
		$idav=@mysql_result($ris,0,0);
		//Se è le avanzate di questo prodotto esistono le modifica altrimenti le inserisce come nuovo
		if(strlen($idav)>0){
			$queryavanzate = mysql_query("Update avanzate set legno='".htmlentities($_POST['legno'])."', colore='".htmlentities($_POST['colore'])."', anno='".htmlentities($_POST['anno'])."', ante='".$_POST['ante']."', cassetti='".$_POST['cassetti']."', posti='".$_POST['posti']."', finitura='".$_POST['finitura']."', laccatura='".$_POST['laccatura']."', forma='".$_POST['forma']."', tipo='".$_POST['tipo']."', stile='".$_POST['stile']."', particolari='".$_POST['particolari']."' where idprodotto='".$_GET['mod']."'") or die("Errore.La queryavanzate non è stata eseguita");
		}else{
			$queryavanzate = mysql_query("insert into avanzate values('default','".$_GET['mod']."','".htmlentities($_POST['legno'])."', '".htmlentities($_POST['colore'])."', '".htmlentities($_POST['anno'])."', '".$_POST['ante']."', '".$_POST['cassetti']."','".$_POST['posti']."', '".$_POST['finitura']."','".$_POST['laccatura']."','".$_POST['forma']."','".$_POST['tipo']."','".$_POST['stile']."','".$_POST['particolari']."')") or die("Errore.La query non è stata eseguita");
		}
	}else{
		//eliminazione nella tabella avanzate
		mysql_query("DELETE FROM avanzate where idprodotto='".$_GET['mod']."'");
	}
	mysql_query("DELETE FROM misure_prodotto WHERE idprodotto = '" . $_GET['mod'] ."'");
	
	// Inserisco misure con nome
	foreach ($_POST['prodottoNuovo'] as $array_prodotto) {
		if ($array_prodotto) {
			if ($array_prodotto['l'] != "" or $array_prodotto['p'] != "" or $array_prodotto['h'] != "" or $array_prodotto['d'] != "" or $array_prodotto['nome_prod_tmp'] != ""){
				$querymisurenuove = mysql_query("insert into misure_prodotto(idprodotto, l, h, p, d, nome) values('". $_GET['mod'] . "', '" .$array_prodotto['l'] . "', '" . $array_prodotto['h'] . "', '" . $array_prodotto['p'] . "', '" . $array_prodotto['d'] . "', '" . mysql_real_escape_string($array_prodotto['nome_prod_tmp']) . "')") or die("Errore.La query non è stata eseguita");
			}
	  }
	}
	
	$idprodottodamodifica=$_GET['mod'];
	//Inserimento delle categorie
	if(isset($_POST['listboxcategorie']) and count($_POST['listboxcategorie'])){
		mysql_query("DELETE FROM assegnazionecategorie where idprodotto='".$idprodottodamodifica."'") or die("Errore. La query di eliminazione delle categorie non è stata eseguita!");
		//Inserisco nuove categorie
		foreach($_POST['listboxcategorie'] as $idcategoria) {
			$queryasscat = mysql_query("insert into assegnazionecategorie values(default,'$idprodottodamodifica', '$idcategoria')") or die("Errore.La query inserimento assegnazione categorie non è stata eseguita");
		}
	}
	
	//Inserimento dei prodotti simili
	if(isset($_POST['listboxprodottisimili']) and count($_POST['listboxprodottisimili'])){
		mysql_query("DELETE FROM prodottisimili where idprodotto='".$idprodottodamodifica."'") or die("Errore. La query di eliminazione dei prodotti simili non è stata eseguita!");
		//Inserisco nuove categorie
		foreach($_POST['listboxprodottisimili'] as $idprodsimili) {
			$queryasprodsimili = mysql_query("insert into prodottisimili values(default,'$idprodottodamodifica', '$idprodsimili')") or die("Errore.La query inserimento prodotti simili non è stata eseguita");
		}
	}
	if(count($_POST['listboxprodottisimili'])==0){
		mysql_query("DELETE FROM prodottisimili where idprodotto='".$idprodottodamodifica."'") or die("Errore. La query di eliminazione dei prodotti simili non è stata eseguita!");
	}
	
	//Distruggo la sessione delle img
	$_SESSION['lista']="";
	$_SESSION['listacategorie']="";
	$_SESSION['listaprodottisimili']="";
	unset($_SESSION['lista']);	
	unset($_SESSION['listacategorie']);	
	unset($_SESSION['listaprodottisimili']);
?>
		<div style='border: 2px dashed #BBBBBB;width: 100%; height:50px; font-size: 20px; padding: 15px; background-color: #F0F0F0;'>
			<p>
				<strong>Il prodotto &egrave; stato modificato correttamente.</strong>
			</p>
			<p style="padding-top: 50px;">
				<a href="<?php print "modificaprodotti.php?mod=".$_GET['mod'].""; ?>" title="Indietro"> 
					Torna indietro.
				</a>
			</p>
		</div>
	<script language="javascript">
	//vieni rindirizzato alla pagina della gestione delle categorie
	function doLoad()  { setTimeout( 'refresh()', 0 ); }
	function refresh() { window.location.href = "modificaprodotti.php?mod="+<?php print $_GET['mod']; ?>+"";}
	</script>
	<body onload='doLoad()'>
<?php }?>	