<div id="header">
	<div class="barra-superiore">
		<div class="divlogo">
			<a id="cd-logo" href="<?php print "http://".$_SERVER['HTTP_HOST']; ?>">
				<img src="/tema/immagini/logo_sito.png" alt="Homepage">
			</a>
		</div>			
		<div id="cd-top-nav">
			<ul>
				<li class="campo-ricerca">
					<form action="<?php print "http://".$_SERVER['HTTP_HOST']; ?>/ricerca.html" method="POST">
						<input type="text" value="Cerca prodotto" name="testo" id="testo" onclick="javascript: this.value='';">
						<input type="submit" value="" title="ricerca" id="ricerca-testo">
					</form>
				</li>
<?php
				if(strlen($collegato)==0){
?>					<li><a href="<?php print "http://".$_SERVER['HTTP_HOST']; ?>/registrati.html" title="Registrati">Registrati</a></li>
<?php
				}
?>
			</ul>
		</div>
		<a id="cd-menu-trigger" href="#0">
			<span class="cd-menu-text">Menu</span>
			<span class="cd-menu-icon"></span>
		</a>
	</div>
</div>
<?php 
	//Pagina Corrente
	$paginacorrente = $_SERVER['REQUEST_URI'];
	switch($paginacorrente){
		case "/azienda.html":
			$pagazienda="class='current'";
			break;
		
		case "/prodotti.html":
			$pagprodotti="class='current'";
			break;
		
		case "/volantino.html":
			$pagvolantino="class='current'";
			break;
		
		case "/servizioclienti.html":
			$pagservizioclienti="class='current'";
			break;
		case "/":
			$paghome="class='current'";
			break;
		case "/index.html":
			$paghome="class='current'";
			break;	
			
	}	
?>	
<div class="cd-main-content" id="cd-main-content">
	<div class="menu-pagine">
		<div class="container-generale">
			<ul>
				<li><a href="<?php print "http://".$_SERVER['HTTP_HOST']; ?>" title="Home" <?php print $paghome; ?>>Home</a></li>
				<li><a href="<?php print "http://".$_SERVER['HTTP_HOST']; ?>/azienda.html" title="Azienda" <?php print $pagazienda; ?>>Azienda</a></li>
				<li><a href="<?php print "http://".$_SERVER['HTTP_HOST']; ?>/marche.html" title="Marche" <?php print $pagazienda; ?>>Marche</a></li>
				<li><a href="<?php print "http://".$_SERVER['HTTP_HOST']; ?>/categorie.html" title="Categorie" <?php print $pagazienda; ?>>Categorie</a></li>
				<li><a href="<?php print "http://".$_SERVER['HTTP_HOST']; ?>/contattaci.html" title="Contattaci" <?php print $pagazienda; ?>>Contattaci</a></li>
			</ul>
		</div>
	</div>
	<div class="contentgenerale">