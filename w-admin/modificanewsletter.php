<?	//Inizializzo sessione
	session_start();
	//Se è stato effettuato il login accedi a questa pagina
	if(isset($_SESSION['wadmin']) and $_SESSION['wadmin']=="1"){
	
	//Dati database, connessione e selezione del database
	include "../config.php";
	//connessione al database
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	//selezione del database
	mysql_select_db($database) or die ("Non riesco a selezionare il database");
	//Modifico la newsletter
	if(isset($_POST['modi']) and strlen($_POST['modi'])>0){
		mysql_query("Update newsletter set titolo='".$_POST['titolo']."', descrizione='".$_POST['descrizione']."',invio='true' where id='".$_POST['modi']."'");
	}
	$query="select * from newsletter where id='".$_GET['mod']."'";
	$ris=mysql_query($query) or die ("Query: ".$query." non eseguita!");
	$titolo=@mysql_result($ris,0,1);
	$descrizione=@mysql_result($ris,0,2);
	
	//Ricavo il browser osato
	$lista=$_SERVER['HTTP_USER_AGENT'];
	$browser=explode(';',$lista);
	$browser=$browser[1]; 	
?>
<html>
<head>
	<title>
		W-admin -- Newsletter
	</title>
	<!--STILE BACHECA-->
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
<?				if(isset($_POST['modi']) and strlen($_POST['modi'])>0){
?>					<div class="messaggio">
						Newsletter modificata!
					</div>
<? 				}
?>				<img src="immagini/icona_newsletter.gif">	
						Modifica Newsletter
				<hr />
				<form name="invio" id="invio" action="modificanewsletter.php?mod=<? print $_GET['mod']; ?>" method="post">
				<div class="contentitolo">
					<div>Oggetto:</div><br /> 
					<input type="text" name="titolo" id="titolo" value="<? print utf8_encode($titolo); ?>" size="50">
				</div><br />
				<div class="contentitolo">
					<div>Newsletter:</div><br /> 
					<textarea id="descrizione" name="descrizione" style="height: 200px; width: 400px;"><? print utf8_encode($descrizione); ?></textarea>
					<script language="JavaScript">
						generate_wysiwyg('descrizione');
					</script>
				</div>
				<div class="bottone">	
					<input type="hidden" name="modi" id="modi" value="<? print $_GET['mod']; ?>">
					<input type="Submit" name="cmd" id="cmd" value="Modifica newsletter">
				</div>	
			</div>
			</form>
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