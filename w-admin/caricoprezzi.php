<?	//Inizializzo sessione
	session_start();
	unset($_SESSION['acquirente']);
	//Se è stato effettuato il login accedi a questa pagina
	if(isset($_SESSION['wadmin']) and $_SESSION['wadmin']=="1"){
		unset($_SESSION['lista']);
	//Dati database, connessione e selezione del database
	include "../config.php";
	//Funzioni
	include "functions.php";
	//Elimina preventivo
	include "inclusi/aggiungiprezzo.php";

	
	//Ricavo il browser osato
	$lista=$_SERVER['HTTP_USER_AGENT'];
	$browser=explode(';',$lista);
	$browser=$browser[1]; 
	

?>
<html>
<head>
	<title>W-admin -- Gestione prezzi</title>
	<!--STILE e JAVASCRIPT BACHECA-->
	<? 
		if(strstr($browser, 'MSIE')==true){
	?>
			<link rel="stylesheet" type="text/css" href="css/bacheca.css" media="screen" />
			<link rel="stylesheet" type="text/css" href="css/ricercapreventivo.css" media="screen" />
	<?	}else{?>
			<link rel="stylesheet" type="text/css" href="css/bacheca_moz.css" media="screen" />
			<link rel="stylesheet" type="text/css" href="css/ricercapreventivo_moz.css" media="screen" />
	<?	}?>	
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

	<link rel="stylesheet" type="text/css" href="css/stylemenu.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/sddm.css" media="screen" />
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/effetto.js"></script>
	<script type="text/javascript" src="js/controllo.js"></script>
	<script src="js/jquery.easing.1.3.js" type="text/javascript"></script>
	<script language="JavaScript" type="text/javascript" src="js/menu.js"></script>
	<script language="JavaScript" type="text/javascript" src="js/ricercapreventivo.js"></script>
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
				<td style="width: 770px; float: left;" valign="top">	
						<div class="menucentro">
						<img src="immagini/icona_preventivi.gif">Gestione prezzi
						<hr />
<?						include "inclusi/formricercaprodotto.php";
						if(strlen($_POST['idprodotto'])>0){
						//Informazioni del prodotto
						$query=mysql_query("select * from prodotti where id='".$_POST['idprodotto']."'") or die ("Query: prod non eseguita!");
						$nomeprodotto=@mysql_result($query,0,1);
						$descprodotto=@mysql_result($query,0,2);
						$idmar=@mysql_result($query,0,3);
						//immagine del prodotto
						$query1=mysql_query("select * from immagini where idprodotto='".$_POST['idprodotto']."'") or die ("Query: img non eseguita!");
						$prodottoprev=@mysql_result($query1,0,2);
						//marca del prodotto
						$query2=mysql_query("select * from marche where id='".$idmar."'") or die ("Query: marche non eseguita!");
						$nomemarca=@mysql_result($query2,0,1);
						//prezzo del prodotto
						$query3=mysql_query("select * from prezzi where idprodotto='".$_POST['idprodotto']."'") or die ("Query: prezzo non eseguita!");
						$prezzodb=@mysql_result($query3,0,2);
						
						//Messaggio di inserimento o modifica del prezzo del prodotto
						if(isset($_POST['salvaprezzi']) and strlen($_POST['salvaprezzi'])>0){
							print $msg;
						}
?>						<form action="caricoprezzi.php" name="modprezzo" id="modprezzo" method="POST">
						<table style="padding-left: 10px; color: #fff; background-color: #333; font-size: 16px; font-weight: bold; height: 30px; width: 720px; border: 1px solid #000; font-family: Arial;" cellpadding="0" cellspacing="0">
							<tr>
								<td width="620px"><? print puliscitesto(strtoupper($nomemarca)." - ".utf8_encode($nomeprodotto)); ?></td>
							</tr>
						</table>
						<table style="height: 50px; width: 720px; border: 1px solid #000; font-family: Arial;" cellpadding="0" cellspacing="0">
							<tr>
								<td style="border: 1px solid #000; width: 100px;"><img src="<? print "../upload/".$prodottoprev; ?>" width="100px" height="100px"></td>
								<td style="border: 1px solid #000; width: 400px;"><? print "<div style=\"font-family: Arial; font-size: 12px; padding-left: 10px;\">".puliscitesto(utf8_encode($descprodotto))."</div>"; ?></td>
								<td style="border: 1px solid #000; width: 220px;">
									<center>
										<span style="font-family: Arial; font-size: 14px; font-weight: bold;">Prezzo dell'articolo:<br />
										<input type="text" name="prezzo" id="prezzo" value="<? print $prezzodb; ?>" onkeypress="javascript: sistemaprezzo(this.value,this);">
										<input type="hidden" name="idprodotto" id="idprodotto" value="<? print $_POST['idprodotto']; ?>">
										<input type="hidden" name="salvaprezzi" id="salvaprezzi" value="1">
									</center>
								</td>
							</tr>
						</table>
						<input type="Submit" name="cmd" id="cmd" value="Conferma" style="margin-left: 570px; height: 40px; width: 150px; margin-top: 10px;"/>
						</form>
<?						}else{
							print "Seleziona un prodotto";
						}
?>						</div>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div id="oscura"></div>
	<div id="scrivipagina"></div>
</body>
</html>
<?}else{
?>	<meta http-equiv="refresh" content="0 url=http://<? print $_SERVER['HTTP_HOST'];?>">
<?	
}?>