<?	//Inizializzo sessione
	session_start();
	//Se è stato effettuato il login accedi a questa pagina
	if(isset($_SESSION['wadmin']) and $_SESSION['wadmin']=="1"){
	//distruggo la sessione di ricerca
	$_SESSION['cerca']='';
	unset($_SESSION['query']);
	unset($_SESSION['cerca']);
	//Dati database, connessione e selezione del database
	include "../config.php";
	//Funzioni
	include "functions.php";
	//Eliminazione utente
	include "inclusi/eliminazione_newsletter.php";
	//Divisione in pagine
	include "inclusi/divisione_pagine_newsletter.php";
	//Controllo se devo inserire la ? o la & nell'eliminazione della categoria
	include	"inclusi/percorso_eliminazione_categoria.php";
	
	//Ricavo il browser osato
	$lista=$_SERVER['HTTP_USER_AGENT'];
	$browser=explode(';',$lista);
	$browser=$browser[1]; 	
?>
<html>
<head>
	<title>W-admin -- Gestione newsletter</title>
	<!--STILE e JAVASCRIPT BACHECA-->
	<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8"/>
	<? 
		if(strstr($browser, 'MSIE')==true){
	?>
			<link rel="stylesheet" type="text/css" href="css/bacheca.css" media="screen" />
	<?	}else{?>
			<link rel="stylesheet" type="text/css" href="css/bacheca_moz.css" media="screen" />
	<?	}?>	
	<link rel="stylesheet" type="text/css" href="css/stylemenu.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/sddm.css" media="screen" />
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/effetto.js"></script>
	<script type="text/javascript" src="js/controllo.js"></script>
	<script src="js/jquery.easing.1.3.js" type="text/javascript"></script>
	<script language="JavaScript" type="text/javascript" src="js/menu.js"></script> 
	<script language="JavaScript" type="text/javascript" src="js/newsletter.js"></script> 
	<!--FINE BACHECA-->	
</head>
<body>
	<div class="box1">
<?		include "inclusi/header.php"?>
		<div class="box3">
		<table width="990px;" border="0">
			<tr>
				<td width="215px;" valign="top">
					<div class="menusinistra">
						<? include "inclusi/menuleft.php"; ?>
					</div>
				</td>
				<td valign="top" style="width: 770px; float: left;">
			<div class="menucentro">
<?					if(isset($_GET['elim']) and strlen($_GET['elim'])>0){
?>						<div class="messaggio">
							La newsletter &egrave; stata eliminata.
						</div>
<? 					}
?>				<img src="immagini/icona_newsletter.gif">Gestione Newsletter
				<hr />
				<div class="numpag">
					Totale newsletter: (<? print $righe; ?>)<? print $visualizzatutto; ?>
				</div>
				<form action="ricerca_newsletter.php" method="post" id="ricerca" name="ricerca">
				<div Class="ricerca">
					<input type="text" id="cerca" name="cerca" value="">&nbsp;
					<input type="Submit" id="cmd" name="cmd" value="Cerca newsletter">
				</div>
				</form>
				<p>&nbsp;</p>
				<table style="margin-top: 30px; width: 100%; height: 30px; background: url('immagini/titolo.jpg'); font-family: Arial; font-weight: bold; font-size: 14px;" cellpadding="0" cellspacing="0">
					<tr>
						<td style="width: 100px; text-align: center;">ID</td>
						<td style="width: 290px; text-align: center;">NOME</td>
						<td style="width: 110px; text-align: center;">MODIFICA</td>
						<td style="width: 110px; text-align: center;">ELIMINA</td>
						<td style="width: 110px; text-align: center;">INVIA</td>
					</tr>
				</table>
<?				//connessione al database
				$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
				//selezione del database
				mysql_select_db($database) or die ("Non riesco a selezionare il database");
				$query="select * from newsletter order by id asc LIMIT ".$partenza.",".$num."";
				$ris=mysql_query($query) or die ("Query: ".$query." non eseguita!");
				if($righe>0){
					while($data=mysql_fetch_array($ris)){
?>						<table style="border: 1px solid #000; width: 100%; height: 30px; font-family: Arial; font-size: 16px;" cellpadding="0" cellspacing="0">
							<tr>
								<td style="width: 100px; border: 1px solid #000; text-align: center; font-weight: bold;"><? print $data[0]; ?></td>
								<td style="width: 290px; border: 1px solid #000; padding-left: 10px;"><? print utf8_encode($data[1]); ?></td>
								<td style="width: 110px; border: 1px solid #000; text-align: center;"><a href="modificanewsletter.php?mod=<? print $data[0]; ?>">Modifica</a></td>
								<td style="width: 110px; border: 1px solid #000; text-align: center;"><a href="gestionenewsletter.php?elim=<? print $data[0]; ?>">Elimina</a></td>
								<td style="width: 110px; border: 1px solid #000; text-align: center;">
									<div id="oscura"></div>
									<a href="#" onclick="javascript:caricapagina(<? print $data[0]; ?>); oscura();">Invia</a>
								</td>
							</tr>
						</table>
<?					}
				}else{
					print "Nessuna Newslettere inserita";
				}
				mysql_close($db); //chiusura db
?>				<div class="divpiede">&nbsp;</div>
				<div class="pagine">
					<? paginefooter($corrente,$pagine); ?>
				</div>
			</div>
											</td>
				</tr>
			</table>
		</div>
	</div>
</body>
</html>
<?}else{
?>	<meta http-equiv="refresh" content="0 url=http://<? print $_SERVER['HTTP_HOST'];?>">
<?	
}?>