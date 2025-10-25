	</div>
<?php
	//connessione al database
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	//selezione del database
	mysql_select_db($database) or die ("Non riesco a selezionare il database");
?>
	<div class="box-footer">
		<div class="footer">
			<div class="container container-logo">
				<a href="<?php print "http://".$_SERVER['HTTP_HOST']; ?>" title=""><img src="/tema/immagini/logo_footer.png" alt=""></a>
			</div>
			<div class="container">
				<ul class="info">
					<li class="nome">Arredamenti</li>
					<li class="dettagli">Via Garibaldi</li>
					<li class="dettagli">10102 Torino (To)</li>
					<li class="dettagli">Tel: 0000/000000</li>
					<li class="dettagli">Fax: 0000/000000</li>
					<li class="dettagli">P.Iva: 0123456789</li>
				</ul>
			</div>
			<div class="container container-maps">
				<img src="/tema/immagini/maps.jpg" alt="" class="maps">               
			</div>
		</div>
	</div>
	<div class="realizzazione">
		<div class="realizzazione-inner">
<?php
			if($_SERVER['REQUEST_URI']=="/" or $_SERVER['REQUEST_URI']=="/index.html"){	
?>
				Tema realizzato da <a href="http://www.arkosoft.it" title="Software House Puglia" rel="nofollow" target="_blank">Arkosoft</a>
<?php
			}else{
				print "Tema realizzato da Arkosoft";
			}
?>
		</div>
	</div>
</div> <!-- cd-main-content -->
<div id="cd-lateral-nav">
	<ul class="cd-navigation cd-single-item-wrapper">
		<li class="campo-ricerca">
			<form action="<?php print "http://".$_SERVER['HTTP_HOST']; ?>/ricerca.html" method="POST">
				<input type="text" value="Cerca prodotto" name="testo" id="testo" onclick="javascript: this.value='';">
				<input type="submit" value="" title="ricerca" id="ricerca-testo">
			</form>
		</li>
		<li><a href="<?php print "http://".$_SERVER['HTTP_HOST']; ?>" title="Home" <?php print $paghome; ?>>Home</a></li>
		<li><a href="<?php print "http://".$_SERVER['HTTP_HOST']; ?>/azienda.html" title="Azienda" <?php print $pagazienda; ?>>Azienda</a></li>
		<li><a href="<?php print "http://".$_SERVER['HTTP_HOST']; ?>/marche.html" title="Marche" <?php print $pagazienda; ?>>Marche</a></li>
		<li><a href="<?php print "http://".$_SERVER['HTTP_HOST']; ?>/categorie.html" title="Categorie" <?php print $pagazienda; ?>>Categorie</a></li>
		<li><a href="<?php print "http://".$_SERVER['HTTP_HOST']; ?>/contattaci.html" title="Contattaci" <?php print $pagazienda; ?>>Contattaci</a></li>
<?php
		if(strlen($collegato)==0){
?>			<li><a href="<?php print "http://".$_SERVER['HTTP_HOST']; ?>/w-admin/" class="accedi" title="Accedi al pannello">Accedi</a></li>
			<li><a href="<?php print "http://".$_SERVER['HTTP_HOST']; ?>/registrati.html" title="Registrati">Registrati</a></li>
<?php
		}
?>
<?php
		if(isset($_SESSION['wadmin']) and $_SESSION['wadmin']=="1"){
			$_SESSION['entrap']="1";
?>
			<div id="boxlogin">
				<div class="textformtitle">Benvenuto/a <label><?php print $nomeutente; ?></label></div>
				<div class="esci">
<?php
					if($admin=="1"){
?>
						<div>&raquo; <a href="/w-admin/bacheca.php?ac=<?php print $_SESSION['utente']; ?>&att=<?php print $collegato; ?>" title="Entra nel pannello">Entra nel Pannello</a></div>
						<div>&raquo; <a href="/tema/esci.php?esci=1" title="Esci">Esci</a></div>
<?php
					}else{
						//Controllo se il preventivo è vuoto o meno
						if($_SESSION['preventivo']==1){
?>
							<div>&raquo; <a href="/tema/preventivo.php" title="Visualizza Preventivo">Visualizza Preventivo</a></div>
<?php
						}
						//Controllo se il carrello è vuoto o meno
						if($_SESSION['acquisto']=='1'){
?>
							<div>&raquo; <a href="/tema/carrello.php" title="Visualizza Carrello">Visualizza Carrello</a></div>
<?php
						}
?>
						<div>&raquo; <a href="/w-admin/bacheca1.php?ac=<?php print $_SESSION['utente']; ?>&att=<?php print $collegato; ?>" title="Entra nel pannello">Entra nel Pannello</a></div>
						<div>&raquo; <a href="/tema/esci.php?esci=1" title="Esci">Esci</a></div>
<?php
					}
?>
				</div>
			</div>
<?php
		}
?>
	</ul> <!-- cd-single-item-wrapper -->
	
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="tema/js/main.js" type="text/javascript"></script> <!-- Resource jQuery -->
<script src="tema/js/modernizr.js" type="text/javascript"></script> <!-- FILE PER IL MENU' HAMBURGHER -->
<script src="tema/js/sovrapposizione.js" type="text/javascript"></script> <!-- Sovrapposizione delle div -->