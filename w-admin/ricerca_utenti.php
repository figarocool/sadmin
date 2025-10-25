<?	//Inizializzo sessione
	session_start();
	//Se è stato effettuato il login accedi a questa pagina
	if(isset($_SESSION['wadmin']) and $_SESSION['wadmin']=="1"){
	
	//Dati database, connessione e selezione del database
	include "../config.php";
	//Funzioni
	include "functions.php";
	//Divisione in pagine
	include "inclusi/divisione_ric_ute.php";
	
	//Ricavo il browser osato
	$lista=$_SERVER['HTTP_USER_AGENT'];
	$browser=explode(';',$lista);
	$browser=$browser[1];
?>
<html>
<head>
	<title>W-admin -- Ricerca utente</title>
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
		<table width="990px;" border="0">
			<tr>
				<td width="215px;" valign="top">
			<div class="menusinistra">
				<? include "inclusi/menuleft.php"; ?>
			</div>
				</td>
				<td width="770px">
			<div class="menucentro">
				<img src="immagini/icona_utenti.gif">Gestione Utenti
				<hr />
				<div class="numpag">
					Totale utenti: (<? print $righericerca; ?>)
					<a href='gestioneutente.php' class='linkvisual'>Visualizza tutti</a>
				</div>
				<br />
				<table style="margin-top: 30px; width: 720px; height: 30px; background: url('immagini/titolo.jpg'); font-family: Arial; font-weight: bold; font-size: 14px;" cellpadding="0" cellspacing="0">
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
				//ricerca
				if(strlen($_POST['cerca'])>0){
					$cerca=$_POST['cerca'];
					$_SESSION['cerca']=$cerca;
				}else{	
					$cerca=$_SESSION['cerca'];
				}
				$query="SELECT * FROM utenti WHERE nome LIKE '%$cerca%'or cognome LIKE '%$cerca%' or user LIKE '%$cerca%' order by id asc LIMIT ".$partenza.",".$num."";
				$ris=mysql_query($query) or die ("Query: ".$query." non eseguita!");
				$righeric=mysql_num_rows($ris);
				if($righeric>0){
					while($data=mysql_fetch_array($ris)){
						//Controllo se l'utente è bloccato
						$queryu="select * from attivazione where idutente='".$data[0]."'";
						$risu=mysql_query($queryu) or die ("Query: ".$queryu." non eseguita!");
						$bloccato=@mysql_result($risu,0,0);
?>					<table style="border: 1px solid #000; width: 720px; height: 30px; font-family: Arial; font-size: 16px;" cellpadding="0" cellspacing="0">
							<tr>
								<td style="width: 100px; border: 1px solid #000; text-align: center; font-weight: bold;">
<? 									print $data[0]; 
?>								</td>
								<td style="width: 290px; border: 1px solid #000;">
<? 									if($data[13]=='1'){
										print $data[10]." <b>[Amministratore]</b>";
									}else{
										if(strlen($bloccato)>0){
											print $data[10]." <b>[Bloccato]</b>";
										}else{
											print $data[10];
										}	
									}	
?>							</td>
							<?							
							if(strlen($bloccato)>0){
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
							</div>
							<td style="width: 110px; border: 1px solid #000; text-align: center;">
								<a href="gestioneutente.php?<? print $_SERVER['QUERY_STRING'].$var;?>elim=<? print $data[0]; ?>"><img src="immagini/elimina.gif" border="0"></a>
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
					<a href='gestioneutente.php' class='linkvisual'>Visualizza tutti</a>
				</div>
				<br clear="all">
				<div class="pagine">
					<? 	divisioneprodotti($corrente,$pagine); ?>
				</div>
			</div>
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