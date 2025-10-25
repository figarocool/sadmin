<?	//Inizializzo sessione
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
	include "inclusi/inserimento_marca.php";
	//Modifica la categoria
	include "inclusi/modifica_marca.php";
	//Ricavo informazione della categoria
	if(isset($_GET['mod']) and strlen($_GET['mod'])>0){
		//connessione al database
		$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
		//selezione del database
		mysql_select_db($database) or die ("Non riesco a selezionare il database");
		//Ricavo tutte le categorie dal database
		$query="select * from marche where id='".$_GET['mod']."'";
		$ris=@mysql_query($query) or die ("Query: ".$query." non eseguita!");
		$idc=@mysql_result($ris,0,0);
		$nomec=@mysql_result($ris,0,1);
		$descrizionec=@mysql_result($ris,0,2);
		$immaginecat=@mysql_result($ris,0,3);
	}
?>
<html>
<head>
	<title>
	<? if(isset($_GET['mod']) and strlen($_GET['mod'])>0){ ?>
		W-admin -- Modifica Prodotti
	<?	}else{?>
		W-admin -- Inserimento Prodotti
	<? 	}?>
	</title>
	<!--STILE BACHECA-->
	<link rel="stylesheet" type="text/css" href="css/bacheca.css" media="screen" />
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
		<table width="990px;" border="0">
			<tr>
				<td width="215px;" valign="top">
					<div class="menusinistra">
						<? include "inclusi/menuleft.php"; ?>
					</div>
				</td>
				<td style="width: 770px; float: left;" valign="top">
			<form action="<? if(isset($_GET['mod']) and strlen($_GET['mod'])>0){ print "caricomarca.php?mod=".$_GET['mod']."";}else{ print "caricomarca.php"; } ?>" name="invio" id="invio" enctype="multipart/form-data" method="post" Onsubmit="return controllocampi()">
			<div class="menucentro">
<? 				print $messaggio; 
?>				<img src="immagini/icona_marche.gif">	
<? 					if(isset($_GET['mod']) and strlen($_GET['mod'])>0){ ?>
						Modifica Marca
<?					}else{
?>						Inserimento Marca
<? 					}
?>				<hr />
				<table border="0" width="500px">
					<tr>
						<td style="width: 500px; padding-top: 20px;">
							<span style="font-size: 14px; font-family: Arial; font-weight: bold;">Nome marca:</span><br />
							<input type="text" name="titolo" id="titolo" value="<? print puliscitesto($nomec); ?>" size="50">
						</td>
					</tr>
					<tr>
						<td style="width: 500px; padding-top: 20px;">
							<span style="font-size: 14px; font-family: Arial; font-weight: bold;">Descrizione marca:</span>
							<textarea id="descrizione" name="descrizione" style="height: 200px; width: 100%; resize: none;"><? print puliscitesto($descrizionec); ?></textarea>
							<script language="JavaScript">
								generate_wysiwyg('descrizione');
							</script>
						</td>
					</tr>
					<tr>
						<td style="width: 500px; padding-top: 20px;">
<?							if(strlen($immaginecat)>0){
?>								<div style="width: 150px; float: left; text-align: center;">
									<span style="font-size: 14px; font-family: Arial; font-weight: bold;">Immagine Attuale:</span><br />
									<img src="../upload<? print $immaginecat; ?>" width="100" height="100">
								</div>
<?							}
?>							<div style="width: 300px; float: left; padding-top: 20px;">
								<span style="font-size: 14px; font-family: Arial; font-weight: bold;">Nuova Immagine marca:</span><br />
								<input type="file" name="file1" id="file1" value="">
								<input type="hidden" name="imgold" id="imgold" value="<? print $immaginecat; ?>">
							</div>	
						</td>
					</tr>
				</table>	
				<div class="bottone">
<? 					if(isset($_GET['mod']) and strlen($_GET['mod'])>0){ ?>				
						<input type="hidden" name="modi" id="modi" value="<? print $_GET['mod']; ?>">
					<?}else{?>	
						<input type="hidden" name="ins" id="ins" value="inscategoria">
					<?}?>
					<input type="Submit" name="cmd" id="cmd" value="Inserisci marca">
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