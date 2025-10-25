<?	//Inizializzo sessione
	session_start();
	//Se è stato effettuato il login accedi a questa pagina
	if(isset($_SESSION['wadmin']) and $_SESSION['wadmin']=="1"){
	unset($_SESSION['query']);
	//settaggio variabili
	$msg="no";
	//Dati database, connessione e selezione del database
	include "../config.php";
	//connessione al database
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	//selezione del database
	mysql_select_db($database) or die ("Non riesco a selezionare il database");
	//Ricavo informazione della categoria
	if(isset($_POST['ins']) and strlen($_POST['ins'])>0){
		mysql_query("insert into newsletter values(default,'".$_POST['titolo']."','".$_POST['descrizione']."',true)");
	}
	
	//browser
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
	<?php 
		if(strstr($browser, 'MSIE')==true){
	?>
			<link rel="stylesheet" type="text/css" href="css/bacheca.css" media="screen" />
	<?php	}else{?>
			<link rel="stylesheet" type="text/css" href="css/bacheca_moz.css" media="screen" />
	<?php	}?>	
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
		<table width="990px;" border="0">
			<tr>
				<td width="215px;" valign="top">
					<div class="menusinistra">
						<? include "inclusi/menuleft.php"; ?>
					</div>
				</td>
			<td style="width: 770px; float: left;" valign="top">	
				<div class="menucentro">
	<?				if(isset($_GET['ins']) and strlen($_GET['ins'])>0){
	?>					<div class="messaggio">
							Newsletter salvata!
						</div>
	<? 				}
	?>				<img src="immagini/icona_newsletter.gif">	
							Inserimento Newsletter
					<hr />
					<form name="invio" id="invio" action="invionewsletter.php?ins=1" method="post">
					<div class="contentitolo">
						<div>Oggetto:</div><br /> 
						<input type="text" name="titolo" id="titolo" value="" size="50">
					</div><br />
					<div class="contentitolo">
						<div>Newsletter:</div><br /> 
						<textarea id="descrizione" name="descrizione" style="height: 200px; width: 400px; resize: none;"><? print $descrizionec; ?></textarea>
						<script language="JavaScript">
							generate_wysiwyg('descrizione');
						</script>
					</div>
					<div class="bottone">	
						<input type="hidden" name="ins" id="ins" value="invnews">
						<input type="Submit" name="cmd" id="cmd" value="Salva newsletter">
					</div>	
				</div>
				</form>
		</div>
		</td>
	</tr>
</table>			
</body>
</html>
<?}else{
?>	<meta http-equiv="refresh" content="0 url=http://<? print $_SERVER['HTTP_HOST'];?>">
<?	
}?>