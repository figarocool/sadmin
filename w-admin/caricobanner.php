<?php	//Inizializzo sessione
	session_start();
	//Se è stato effettuato il login accedi a questa pagina
	if(isset($_SESSION['wadmin']) and $_SESSION['wadmin']=="1"){
	
	unset($_SESSION['query']);
	//settaggio variabili
	$msg="no";
	//Dati database, connessione e selezione del database
	include "../config.php";
	//funzioni
	include "functions.php";
	//Inserimento di una nuovo categoria
	include "inclusi/inserimento_banner.php";
	//Modifica la categoria
	include "inclusi/modifica_banner.php";
	//Ricavo informazione della categoria
	if(isset($_GET['mod']) and strlen($_GET['mod'])>0){
		//connessione al database
		$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
		//selezione del database
		mysql_select_db($database) or die ("Non riesco a selezionare il database");
		//Ricavo tutte le categorie dal database
		$query="select id, link, nome_immagine, numero, visuale from `banner` where id='".$_GET['mod']."'";
		$ris=@mysql_query($query) or die ("Query: ".$query." non eseguita!");
		$id_banner=@mysql_result($ris,0,0);
		$link_banner=@mysql_result($ris,0,1);
		$nome_immagine=@mysql_result($ris,0,2);
		$numero_banner=@mysql_result($ris,0,3);
		$visuale_banner=@mysql_result($ris, 0, 4);
	}
?>
<html>
<head>
	<title>
	<?php if(isset($_GET['mod']) and strlen($_GET['mod'])>0){ ?>
		W-admin -- Modifica Banner
	<?php	}else{?>
		W-admin -- Inserimento Banner
	<?php 	}?>
	</title>
	<!--STILE BACHECA-->
	<link rel="stylesheet" type="text/css" href="css/bacheca.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/stylemenu.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/sddm.css" media="screen" />
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/effetto.js"></script>
	<script type="text/javascript" src="js/controllo_banner.js"></script>
	<script src="js/jquery.easing.1.3.js" type="text/javascript"></script>
	<script language="JavaScript" type="text/javascript" src="js/menu.js"></script>
	<script type="text/javascript" src="editor/wysiwyg.js"></script> 
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	<!--FINE BACHECA-->
</head>
<body>
	<div class="box1">
<?php		include "inclusi/header.php"?>
		<div class="box3">
		<table width="990px;" border="0">
			<tr>
				<td width="215px;" valign="top">
					<div class="menusinistra">
						<?php include "inclusi/menuleft.php"; ?>
					</div>
				</td>
				<td style="width: 770px; float: left;" valign="top">
			<div class="menucentro">
			<form action="<?php if(isset($_GET['mod']) and strlen($_GET['mod'])>0){ print "caricobanner.php?mod=".$_GET['mod']."";}else{ print "caricobanner.php"; } ?>" name="invio" id="invio" enctype="multipart/form-data" method="post" Onsubmit="return controllocampi()">
			
<?php 				print $messaggio; 
?>				<img src="immagini/icona_marche.gif">
<?php 					if(isset($_GET['mod']) and strlen($_GET['mod'])>0){ ?>
						Modifica Banner
<?php					}else{
?>						Inserimento Banner
<?php 					}
?>				<hr />
				<table border="0" width="500px">
					<tr>
						<td style="width: 500px; padding-top: 20px;">
							<span style="font-size: 14px; font-family: Arial; font-weight: bold;">Link banner:</span><br />
							<input type="text" name="titolo" id="titolo" value="<?php print puliscitesto(utf8_encode($link_banner)); ?>" size="50">
						</td>
					</tr>
					<tr>
						<td style="width: 500px; padding-top: 20px;">
							<span style="font-size: 14px; font-family: Arial; font-weight: bold;">Numero:</span><br />
							<input type="text" id="descrizione" name="descrizione" value="<?php print puliscitesto(utf8_encode($numero_banner)); ?>" size="50">
						</td>
					</tr>
					<tr>
						<td style="width: 500px; padding-top: 20px;">
<?php							if(strlen($nome_immagine)>0){
?>								<div style="width: 150px; float: left; text-align: center;">
									<span style="font-size: 14px; font-family: Arial; font-weight: bold;">Immagine Attuale:</span><br />
<?php									if(strlen($nome_immagine)==0){
?>											<img src="/w-admin/immagini/noimg.jpg">
<?php										}else{
?>											<img src="../banner/<?php print $nome_immagine; ?>" width="100" height="100">
<?php									}
?>									</div>
<?php							}
?>							<div style="width: 300px; float: left; padding-top: 20px;">
								<span style="font-size: 14px; font-family: Arial; font-weight: bold;">Nuova Immagine banner:</span><br />
								<input type="file" name="file1" id="file1" value="">
								<input type="hidden" name="imgold" id="imgold" value="<?php print $nome_immagine; ?>">
							</div>	
						</td>
					</tr>
				</table>	
				<div class="bottone">
<?php 					if(isset($_GET['mod']) and strlen($_GET['mod'])>0){ ?>				
						<input type="hidden" name="modi" id="modi" value="<?php print $_GET['mod']; ?>">
					<?php }else{?>	
						<input type="hidden" name="ins" id="ins" value="inscategoria">
					<?php }?>
					<?php if(isset($_GET['mod']) and strlen($_GET['mod'])>0){ ?>	
						<input type="Submit" name="cmd" id="cmd" value="Modifica Banner">
					<?php }else{?>	
						<input type="Submit" name="cmd" id="cmd" value="Inserisci Banner">
					<?php }?>
				</div>	
			
			</form>
			</div>					</td>
				</tr>
			</table>
		</div>
	</div>
</body>
</html>
<?php
	}else{
?>	<meta http-equiv="refresh" content="0 url=http://<?php print $_SERVER['HTTP_HOST'];?>">
<?php	
}?>