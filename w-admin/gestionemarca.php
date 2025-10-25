<?	//Inizializzo sessione
	session_start();
	//Se è stato effettuato il login accedi a questa pagina
	if(isset($_SESSION['wadmin']) and $_SESSION['wadmin']=="1"){
	unset($_SESSION['query']);
	//Dati database, connessione e selezione del database
	include "../config.php";
	//Funzioni
	include "functions.php";
	//Elimina categoria
	include "inclusi/eliminazione_marca.php";
	//Divisione in pagine
	include "inclusi/divisione_pagine_impostazioni.php";
	//Controllo se devo inserire la ? o la & nell'eliminazione della categoria
	include	"inclusi/percorso_eliminazione_marca.php";
	
	//Ricavo il browser osato
	$lista=$_SERVER['HTTP_USER_AGENT'];
	$browser=explode(';',$lista);
	$browser=$browser[1];
?>
<html>
<head>
	<title>W-admin -- Gestione marca</title>
	<!--STILE e JAVASCRIPT BACHECA-->
	<? 
		if(strstr($browser, 'MSIE')==true){
	?>
			<link rel="stylesheet" type="text/css" href="css/regutente.css" media="screen" />
	<?	}else{?>
			<link rel="stylesheet" type="text/css" href="css/regutente_moz.css" media="screen" />
	<?	}?>	
	<link rel="stylesheet" type="text/css" href="css/stylemenu.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/sddm.css" media="screen" />
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/effetto.js"></script>
	<script type="text/javascript" src="js/controllo.js"></script>
	<script src="js/jquery.easing.1.3.js" type="text/javascript"></script>
	<script language="JavaScript" type="text/javascript" src="js/menu.js"></script>
	<!--FINE BACHECA-->
</head>
<body>
	<div class="box1">
<?		include "inclusi/header.php"?>
		<div class="box3">
			<div class="menusinistra">
				<? include "inclusi/menuleft.php"; ?>
			</div>
			<div class="menucentro">
<?					if(isset($_GET['elim']) and strlen($_GET['elim'])>0){
?>						<div class="messaggio">
							La categoria &egrave; stata eliminata.
						</div>
<? 					}
?>				<img src="immagini/icona_categoria.gif">Gestione Marca
				<hr />
				<div class="numpag">
					Totale Categorie: (<? print $righe; ?>)<? print $visualizzatutto; ?>
				</div>
				<form action="ricerca_marca.php" method="post" id="ricerca" name="ricerca">
				<div Class="ricerca">
					<input type="text" id="cerca" name="cerca" value="">&nbsp;
					<input type="Submit" id="cmd" name="cmd" value="Cerca categoria">
				</div>
				</form>
				<table style="margin-top: 50px; width: 100%; height: 30px; float: left; background: url('immagini/titolo.jpg'); font-family: Arial; font-weight: bold; font-size: 14px;" cellpadding="0" cellspacing="0">
					<tr>
						<td style="width: 100px; text-align: center;">ID</td>
						<td style="width: 400px; text-align: center;">NOME</td>
						<td style="width: 110px; text-align: center;">MODIFICA</td>
						<td style="width: 110px; text-align: center;">ELIMINA</td>
					</tr>
				</table>
<?				//connessione al database
				$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
				//selezione del database
				mysql_select_db($database) or die ("Non riesco a selezionare il database");
				$query="select * from marche order by id desc LIMIT ".$partenza.",".$num."";
				$ris=mysql_query($query) or die ("Query: ".$query." non eseguita!");
				if($righe>0){
					while($data=mysql_fetch_array($ris)){
?>						<table style="border: 1px solid #000; width: 100%; height: 30px; font-family: Arial; font-size: 15px;" cellpadding="0" cellspacing="0">
							<tr>
								<td style="border: 1px solid #000; height: 40px; width: 100px; text-align: center;"><? print $data[0]; ?></td>
								<td style="border: 1px solid #000; height: 40px;  width: 400px; padding-left: 10px;"><? print puliscitesto($data[1]); ?></td>
								<td style="border: 1px solid #000; height: 40px;  width: 110px; text-align: center;"><a href="caricomarca.php?mod=<? print $data[0]; ?>"><img src="immagini/modifica.gif" border="0"></a></td>
								<td style="border: 1px solid #000; height: 40px;  width: 110px; text-align: center;"><a href="gestionemarca.php?<? print $_SERVER['QUERY_STRING'].$var;?>elim=<? print $data[0]; ?>"><img src="immagini/elimina.gif" border="0"></a></td>
							</tr>
						</table>
<?					}
				}else{
					print "Nessun marca inserita";
				}
?>				<div class="divpiede">&nbsp;</div>
				<table style="margin-top: 20px; width: 100%; height: 30px; font-family: Arial; font-weight: bold; font-size: 14px; float: left;" cellpadding="0" cellspacing="0">
					<tr>
						<td style="width: 100%; text-align: center;"><? divisioneprodotti($corrente,$pagine); ?></td>
					</tr>
				</table>	
			</div>
		</div>
	</div>
</body>
</html>
<?}else{
?>	<meta http-equiv="refresh" content="0 url=http://<? print $_SERVER['HTTP_HOST'];?>">
<?	
}?>