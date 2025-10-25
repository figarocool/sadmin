<?	//Inizializzo sessione
	session_start();
	//Se è stato effettuato il login accedi a questa pagina
	if(isset($_SESSION['wadmin']) and $_SESSION['wadmin']=="1"){
	unset($_SESSION['query']);
	//Dati database, connessione e selezione del database
	include "../config.php";
	//Funzioni
	include "functions.php";
	//Eliminazione utente
	include "inclusi/eliminazione_utenti.php";
	//Divisione in pagine
	include "inclusi/divisione_pagine_impostazioni_ut.php";
	//Controllo se devo inserire la ? o la & nell'eliminazione della categoria
	include	"inclusi/percorso_eliminazione_categoria.php";
	//Attivazione o disattivazione di un account
	include "inclusi/statoutente.php";
	
	//Ricavo il browser osato
	$lista=$_SERVER['HTTP_USER_AGENT'];
	$browser=explode(';',$lista);
	$browser=$browser[1];	
?>
<html>
<head>
	<title>w-admin -- Gestione utente</title>
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
	<script language="JavaScript" type="text/javascript" src="js/excel.js"></script>
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
							L' utente &egrave; stato eliminato.
						</div>
<? 					}
					if(isset($_GET['att']) and strlen($_GET['att'])>0){
?>						<div class="messaggio">
							L' utente &egrave; stato attivato.
						</div>
<?					}
					if(isset($_GET['dis']) and strlen($_GET['dis'])>0){
?>						<div class="messaggio">
							L' utente &egrave; stato disattivato.
						</div>
<?					}
?>				<img src="immagini/icona_utenti.gif">Gestione Utenti
				<hr />
				<table style="font-family: Arial; width: 100%;">
					<tr>
						<td>
							<table width="350">
								<tr>
									<td>
										Totale Utenti: (<? print $righe; ?>)<? print $visualizzatutto; ?>
										 <form action="utenti.xls" Onsubmit="return generaxls(); "  >
											<input type="image" src="immagini/esportaexcel.jpg" value="Esporta su Excel">
										</form>
									</td>
								</tr>
							</table>	
						</td>
						<td>
							<form action="ricerca_utenti.php" method="post" id="ricerca" name="ricerca">
							<table	border="0" width="370">
								<tr>
									<td>
										<input type="text" id="cerca" name="cerca" value="">&nbsp;
										<input type="Submit" id="cmd" name="cmd" value="Cerca utenti">
									</td>
								</tr>
								<tr>
									<td height="20">&nbsp;</td>
								</tr>
								<tr>
									<td height="20" style="font-weight: bold;">Legenda:</td>
								</tr>
								<tr>
									<td>
										<img src="immagini/legenda1.jpg"> Utente Attivato
									</td>
								</tr>
								<tr>
									<td>	
										<img src="immagini/legenda.jpg"> Utente Disattivato
									</td>
								</tr>
							</table>						
							</form>
						</td>
					</tr>	
				</table>		
				<table style="margin-top: 30px; width: 100%; height: 30px; background: url('immagini/titolo.jpg'); font-family: Arial; font-weight: bold; font-size: 14px;" cellpadding="0" cellspacing="0">
					<tr>
						<td style="width: 100px; text-align: center;">ID</td>
						<td style="width: 290px; text-align: center;">NOME</td>
						<td style="width: 110px; text-align: center;">STATO</td>
						<td style="width: 110px; text-align: center;">MODIFICA</td>
						<td style="width: 110px; text-align: center;">ELIMINA</td>
					</tr>
				</table>
<?				//connessione al database
				$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
				//selezione del database
				mysql_select_db($database) or die ("Non riesco a selezionare il database");
				$query="select * from utenti order by id desc LIMIT ".$partenza.",".$num."";
				$ris=mysql_query($query) or die ("Query: ".$query." non eseguita!");
				if($righe>0){
					while($data=mysql_fetch_array($ris)){
						$cont=$cont+1;
						$righex=$righe-$partenza;
						$contatore=($righex+1)-$cont;
						//Controllo se l'utente è bloccato
						$queryu="select * from attivazione where idutente='".$data[0]."'";
						$risu=mysql_query($queryu) or die ("Query: ".$queryu." non eseguita!");
						$bloccato=@mysql_result($risu,0,0);
?>						<table style="border: 1px solid #000; width: 100%; height: 30px; font-family: Arial; font-size: 16px;" cellpadding="0" cellspacing="0">
							<tr>
								<td style="width: 100px; border: 1px solid #000; text-align: center; font-weight: bold;">
<? 									print $contatore; 
?>								</td>
								<td style="width: 290px; border: 1px solid #000;">
<? 									if($data[13]=='1'){
										print puliscitesto(utf8_encode($data[10]))." <b>[Amministratore]</b>";
									}else{
										if(strlen($bloccato)>0){
											print puliscitesto(utf8_encode($data[10]))." <b>[Bloccato]</b>";
										}else{
											print puliscitesto(utf8_encode($data[10]));
										}	
									}	
?>								</td>
<?							if(strlen($bloccato)>0){
?>								<td style="width: 110px; border: 1px solid #000; text-align: center;">
									<a href="gestioneutente.php?att=<? print $data[0]; ?>"><img src="immagini/disattivautente.jpg" border="0"></a>
								</td>
<?							}else{
?>								<td style="width: 110px; border: 1px solid #000; text-align: center;">
									<a href="gestioneutente.php?dis=<? print $data[0]; ?>"><img src="immagini/attivautente.jpg" border="0"></a>
								</td>
<?							}
?>							<td style="width: 110px; border: 1px solid #000; text-align: center;">
								<a href="inserimentoutente.php?mod=<? print $data[0]; ?>"><img src="immagini/modifica.gif" border="0"></a>
							</td>
							<td style="width: 110px; border: 1px solid #000; text-align: center;">
								<a href="gestioneutente.php?elim=<? print $data[0]; ?>"><img src="immagini/elimina.gif" border="0"></a>
							</td>
						</tr>
					</table>
<?					}
				}else{
					print "Nessun utente registrato";
				}
				mysql_close($db); //chiusura db
?>				<div class="divpiede">&nbsp;</div>
				<div class="pagine">
					<? paginefooter($corrente,$pagine); ?>
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