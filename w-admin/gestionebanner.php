<?php	//Inizializzo sessione
	session_start();
	//Se è stato effettuato il login accedi a questa pagina
	if(isset($_SESSION['wadmin']) and $_SESSION['wadmin']=="1"){
	unset($_SESSION['query']);
	//Dati database, connessione e selezione del database
	include "../config.php";
	//Funzioni
	include "functions.php";
	//Elimina categoria
	include "inclusi/eliminazione_banner.php";
	//Nascondi marca
	include "inclusi/nascondi_banner.php";
	//Divisione in pagine
	include "inclusi/divisione_pagine_impostazioni_banner.php";
	//Controllo se devo inserire la ? o la & nell'eliminazione della categoria
	include	"inclusi/percorso_eliminazione_categoria.php";
	
	//Ricavo il browser osato
	$lista=$_SERVER['HTTP_USER_AGENT'];
	$browser=explode(';',$lista);
	$browser=$browser[1];
?>
<html>
<head>
	<title>W-admin -- Gestione banner</title>
	<!--STILE e JAVASCRIPT BACHECA-->
	<?php 
		if(strstr($browser, 'MSIE')==true){
	?>
			<link rel="stylesheet" type="text/css" href="css/regutente.css" media="screen" />
	<?php	}else{?>
			<link rel="stylesheet" type="text/css" href="css/regutente_moz.css" media="screen" />
	<?php	}?>	
	<link rel="stylesheet" type="text/css" href="css/stylemenu.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/sddm.css" media="screen" />
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/effetto.js"></script>
	<script type="text/javascript" src="js/controllo.js"></script>
	<script src="js/jquery.easing.1.3.js" type="text/javascript"></script>
	<script language="JavaScript" type="text/javascript" src="js/menu.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<!--FINE BACHECA-->
</head>
<body>
	<div class="box1">
<?php		include "inclusi/header.php"?>
		<div class="box3">
			<div class="menusinistra">
				<?php include "inclusi/menuleft.php"; ?>
			</div>
			<div class="menucentro">
<?php			if(isset($_GET['elim']) and strlen($_GET['elim'])>0){ ?><div class="messaggio">Il banner &egrave; stato eliminato.</div><?php } ?>				
<?php			if(isset($nascondi) and $nascondi==true){ ?><div class='messaggio'>Il banner non sar&agrave; visualizzato!!!</div><?php } ?>				
				<img src="immagini/icona_categoria.gif">Gestione Banner
				<hr />
				<div class="numpag">
					Totale Banner: (<?php print $righe; ?>)<?php print $visualizzatutto; ?>
				</div>
				<table style="margin-top: 50px; width: 100%; height: 30px; background: url('immagini/titolo.jpg'); font-family: Arial; font-weight: bold; font-size: 14px;" cellpadding="0" cellspacing="0">
					<tr>
						<td style="width: 100px; text-align: center;">ID</td>
						<td style="width: 400px; text-align: center;">LINK</td>
						<td style="width: 110px; text-align: center;">MODIFICA</td>
						<td style="width: 110px; text-align: center;">ELIMINA</td>
						<td style="width: 110px; text-align: center;">VISUALIZZA</td>
					</tr>
				</table>
<?php				//connessione al database
				$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
				//selezione del database
				mysql_select_db($database) or die ("Non riesco a selezionare il database");
				$query="select * from banner order by id desc LIMIT ".$partenza.",".$num."";
				$ris=mysql_query($query) or die ("Query: ".$query." non eseguita!");
				if($righe>0){
					while($data=mysql_fetch_array($ris)){
						if($data[4]=="1"){ $visualizza="background-color: #FFD2D2;"; $bottonevis="visualizza1.jpg"; }else{ $visualizza=""; $bottonevis="visualizza.jpg"; }
?>						<table style="border: 1px solid #000; width: 100%; height: 30px; font-family: Arial; font-size: 15px;" cellpadding="0" cellspacing="0">
							<tr>
								<td style="<?php print $visualizza; ?> border: 1px solid #000; height: 40px; width: 100px; text-align: center;"><?php print $data[0]; ?></td>
								<td style="<?php print $visualizza; ?> border: 1px solid #000; height: 40px;  width: 400px; padding-left: 10px;"><?php print puliscitesto(utf8_encode($data[1])); ?></td>
								<td style="<?php print $visualizza; ?> border: 1px solid #000; height: 40px;  width: 110px; text-align: center;"><a href="caricobanner.php?mod=<?php print $data[0]; ?>"><img src="immagini/modifica.gif" border="0"></a></td>
								<td style="<?php print $visualizza; ?> border: 1px solid #000; height: 40px;  width: 110px; text-align: center;"><a href="gestionebanner.php?<?php print $_SERVER['QUERY_STRING'].$var;?>elim=<?php print $data[0]; ?>"><img src="immagini/elimina.gif" border="0"></a></td>
								<td style="<?php print $visualizza; ?> border: 1px solid #000; height: 40px;  width: 110px; text-align: center;"><a href="gestionebanner.php?<?php print $_SERVER['QUERY_STRING'].$var;?>nascondi=<?php print $data[0]; ?>"><img src="immagini/<?php print $bottonevis; ?>" border="0"></a></td>
							</tr>
						</table>
<?php					}
				}else{
					print "Nessun banner inserito";
				}
?>				<div class="divpiede">&nbsp;</div>
				<table style="margin-top: 20px; width: 100%; height: 30px; font-family: Arial; font-weight: bold; font-size: 14px; float: left;" cellpadding="0" cellspacing="0">
					<tr>
						<td style="width: 720px; text-align: center;"><?php divisioneprodotti($corrente,$pagine); ?></td>
					</tr>
				</table>	
			</div>
		</div>
	</div>
</body>
</html>
<?php }else{
?>	<meta http-equiv="refresh" content="0 url=http://<?php print $_SERVER['HTTP_HOST'];?>">
<?php	
}?>