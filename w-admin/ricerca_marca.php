<?	//Inizializzo sessione
	session_start();
	//Se è stato effettuato il login accedi a questa pagina
	if(isset($_SESSION['wadmin']) and $_SESSION['wadmin']=="1"){
	
	//Dati database, connessione e selezione del database
	include "../config.php";
	//Funzioni
	include "functions.php";
	//Divisione in pagine
	include "inclusi/divisione_pagine_impostazioni_ric.php";
	
	//Ricavo il browser osato
	$lista=$_SERVER['HTTP_USER_AGENT'];
	$browser=explode(';',$lista);
	$browser=$browser[1];	
?>
<html>
<head>
	<title>W-admin -- Ricerca marca</title>
	<!--STILE e JAVASCRIPT BACHECA-->
	<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8"/>
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
				<img src="immagini/icona_utenti.gif">Gestione Utenti
				<hr />
				<div class="numpag">
					<a href='gestionecategoria.php' class='linkvisual'>Visualizza tutti</a>
				</div>
				<br />
				<table style="margin-top: 50px; width: 100%; height: 30px; background: url('immagini/titolo.jpg'); font-family: Arial; font-weight: bold; font-size: 14px;" cellpadding="0" cellspacing="0">
					<tr>
						<td style="width: 100px; text-align: center;">ID</td>
						<td style="width: 400px; text-align: center;">NOME</td>
						<td style="width: 110px; text-align: center;">MODIFICA</td>
						<td style="width: 110px; text-align: center;">ELIMINA</td>
					</tr>
				</table>
<?				if(isset($_POST['cerca']) and strlen($_POST['cerca'])>0){
					$cerca=$_POST['cerca'];
					//connessione al database
					$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
					//selezione del database
					mysql_select_db($database) or die ("Non riesco a selezionare il database");
					$query="SELECT * FROM marche WHERE nome LIKE '%$cerca%' order by id asc LIMIT ".$partenza.",".$num."";
					$visualizzatutto=" | <a href='gestionecategoria.php' class='linkvisual'>Visualizza tutti</a>";
					$ris=mysql_query($query) or die ("Query: ".$query." non eseguita!");
					//conto i prodotti inseriti
					$righeric=mysql_num_rows($ris);
					if($righeric==0){
						print "Nessun valore trovato!";
					}else{
						while($data=mysql_fetch_array($ris)){
?>							<table style="border: 1px solid #000; width: 720px; height: 30px; font-family: Arial; font-size: 15px;" cellpadding="0" cellspacing="0">
								<tr>
									<td style="border: 1px solid #000; height: 40px; width: 100px; text-align: center;"><? print $data[0]; ?></td>
									<td style="border: 1px solid #000; height: 40px;  width: 400px; padding-left: 10px;"><? print puliscitesto($data[1]); ?></td>
									<td style="border: 1px solid #000; height: 40px;  width: 110px; text-align: center;"><a href="caricomarca.php?mod=<? print $data[0]; ?>"><img src="immagini/modifica.gif" border="0"></a></td>
									<td style="border: 1px solid #000; height: 40px;  width: 110px; text-align: center;"><a href="gestionemarca.php?<? print $_SERVER['QUERY_STRING'].$var;?>elim=<? print $data[0]; ?>"><img src="immagini/elimina.gif" border="0"></a></td>
								</tr>
							</table>
<?						}
					}
				}
				mysql_close($db); //chiusura db
?>				<div class="divpiede">&nbsp;</div>
				<br /><br />
				<div class="numpag">
					<a href='gestionecategoria.php' class='linkvisual'>Visualizza tutti</a>
				</div>
				<br clear="all">
				<div class="pagine">
					<? 	divisioneprodotti($corrente,$pagine); ?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>	
<?}else{
?>	<meta http-equiv="refresh" content="0 url=http://<? print $_SERVER['HTTP_HOST'];?>">
<?	
}?>