<?	//Inizializzo sessione
	session_start();
	//Se è stato effettuato il login accedi a questa pagina
	if(isset($_SESSION['wadmin']) and $_SESSION['wadmin']=="1"){
	
	//Dati database, connessione e selezione del database
	include "../config.php";
	//Funzioni
	include "functions.php";
	//divisione in pagine
	include "inclusi/divisione_ric_news.php";
	
	//Ricavo il browser osato
	$lista=$_SERVER['HTTP_USER_AGENT'];
	$browser=explode(';',$lista);
	$browser=$browser[1]; 	
?>
<html>
<head>
	<title>W-admin -- Ricerca newsletter</title>
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
	<script type="text/javascript" src="editor/wysiwyg.js"; ?>"></script> 
	<script language="JavaScript" type="text/javascript" src="js/newsletter.js"></script> 
	
	<!--FINE BACHECA--> 
</head>
<body>
	<div class="box1">
<?		include "inclusi/header.php"?>
		<div class="box3">
		<table width="1000px;" border="0">
			<tr>
				<td width="215px;" valign="top">
					<div class="menusinistra">
						<? include "inclusi/menuleft.php"; ?>
					</div>
				</td>
				<td width="770px" valign="top">
			<div class="menucentro">
				<img src="immagini/icona_newsletter.gif">Ricerca Newsletter
				<hr />
				<div class="numpag">
					<a href='gestionenewsletter.php' class='linkvisual'>Visualizza tutti</a>
				</div>
				<br />
				<table style="margin-top: 30px; width: 720px; height: 30px; background: url('immagini/titolo.jpg'); font-family: Arial; font-weight: bold; font-size: 14px;" cellpadding="0" cellspacing="0">
					<tr>
						<td style="width: 100px; text-align: center;">ID</td>
						<td style="width: 290px; text-align: center;">NOME</td>
						<td style="width: 110px; text-align: center;">MODIFICA</td>
						<td style="width: 110px; text-align: center;">ELIMINA</td>
						<td style="width: 110px; text-align: center;">INVIA</td>
					</tr>
				</table>
<?				if(isset($_POST['cerca']) and strlen($_POST['cerca'])>0 or strlen($_SESSION['cerca'])>0){
					if(isset($_SESSION['cerca']) and strlen($_SESSION['cerca'])>0){
						$cerca=$_SESSION['cerca'];
					}else{
						$cerca=$_POST['cerca'];
					}
					$_SESSION['cerca']=$cerca;
					$query="SELECT * FROM newsletter WHERE titolo LIKE '%$cerca%'or descrizione LIKE '%$cerca%' order by id asc LIMIT ".$partenza.",".$num."";
					$ris=mysql_query($query) or die ("Query: ".$query." non eseguita!");
				}
				if($righeric>0){
					while($data=mysql_fetch_array($ris)){
?>						<table style="border: 1px solid #000; width: 720px; height: 30px; font-family: Arial; font-size: 16px;" cellpadding="0" cellspacing="0">
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
					print "Nessun risultato trovato";
				}
				mysql_close($db); //chiusura db
?>				<div class="divpiede">&nbsp;</div>
				<br /><br />
				<div class="numpag">
					<a href='gestionenewsletter.php' class='linkvisual'>Visualizza tutti</a>
				</div>
				<br clear="all">
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