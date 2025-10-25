<?	//Inizializzo sessione
	session_start();
	//Se è stato effettuato il login accedi a questa pagina
	if(isset($_SESSION['wadmin']) and $_SESSION['wadmin']=="1"){
		unset($_SESSION['lista']);
		unset($_SESSION['query']);
	//Dati database, connessione e selezione del database
	include "../config.php";
	
	//Funzioni
	include "functions.php";

	//Se la tabella gestionepriorità non esiste creala
	if(esistetabella($database,"gestionepriorita",1)==false){
		$query="CREATE TABLE `gestionepriorita` (
		`id` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
		`idcampo` INT( 10 ) NOT NULL ,
		`tipo` TEXT() NOT NULL
		) ENGINE = MYISAM ;";
		@mysql_query($query);
	}
	
	//Inserimento nella tabella
	include "inclusi/inserimentopriorita.php";
	
	//Eliminazione dalla tabella
	include "inclusi/eliminazionepriorita.php";
	
	//Ricavo il browser osato
	$lista=$_SERVER['HTTP_USER_AGENT'];
	$browser=explode(';',$lista);
	$browser=$browser[1]; 
	

?>
<html>
<head>
	<title>W-admin -- Gestione Prodotti</title>
	<!--STILE e JAVASCRIPT BACHECA-->
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
	<script language="JavaScript" type="text/javascript" src="js/gestionepriorita.js"></script>
	<script type="text/javascript" src="editor/wysiwyg.js"; ?>"></script> 
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
				<td width="770px">
						<div class="menucentro">
						<img src="immagini/icona_priorita.gif">Gestione priorit&agrave;
						<hr />
<?php					//Messaggio di inserimento o modifica del prezzo del prodotto
						if((isset($_POST['tipo']) and strlen($_POST['tipo'])>0) or (isset($_POST['elimina']) and $_POST['elimina']=="1")){
							print $messaggio;
						}
?>						<table style="font-weight: bold; font-size: 18px;">
							<tr>
								<td>Prodotti con priorit&agrave;:</td>
							</tr>
						</table>
						<table cellpadding="0" cellspacing="0" style="border: 2px solid #8BAECE; text-align: center; margin-bottom: 20px; font-size: 14px; font-weight: bold; background-color: #D5E2EB; width: 770px; height: 210px;">
							<tr>						
								<td  style="border: 1px solid #fff; height: 200px; text-align: left; padding-left: 20px;">
									<form action="gestionepriorita.php" name="frmpriorita" id="frmpriorita" method="POST">
									<select name="selectpriorita" id="selectpriorita" size="10" style="width: 720px;">
<?										$querypriorita=mysql_query("SELECT * FROM `gestionepriorita`") or die ("Query: gestionepriorita non eseguita!");
										while($priorita=mysql_fetch_array($querypriorita)){
											$query=mysql_query("SELECT * FROM ".$priorita[2]." where id='".$priorita[1]."'") or die ("Query: gestionepriorita non eseguita!");
											$nome="[".$priorita[2]."] ".str_replace(chr(92)."'","'",utf8_encode(@mysql_result($query,0,1)));
											print "<option value='".$priorita[0]."'>".$nome."</option>";
										}
?>									</select>
								</td>
							</tr>	
							<tr>
								<td><input type="Submit" value="Elimina" style="width: 150px; height: 25px;"></td>
								<input type="hidden" name="elimina" id="elimina" value="1" />
								</form>
							</tr>
						</table>
						<hr />
						Scegli cosa inserire nella priorit&agrave; 
						<br /><br />
						<table width="100%">
							<tr>
								<td>
									<table style="font-weight: bold; font-size: 18px;">
										<tr>
											<td>Seleziona una marca:</td>
										</tr>
									</table>
									<table cellpadding="0" cellspacing="0" style="border: 2px solid #8BAECE; text-align: center; margin-bottom: 20px; font-size: 14px; font-weight: bold; background-color: #D5E2EB; width: 380px; height: 250px;">
										<tr>						
											<td  style="border: 1px solid #fff; height: 200px;">
												<input type="text" name="cercamarca" id="cercamarca" value="Cerca una marca..." style="width: 285px;" Onclick="javascript: svuotatext(document.getElementById('cercamarca')); " Onkeyup="javascript: mostratutti(event,this.value,'marche','selectmarca');">
												<input type="button" name="cmdmarca" id="cmdmarca" value="cerca"  Onclick="javascript: cercavoce(document.getElementById('cercamarca'),document.getElementById('selectmarca'),'marche','selectmarca');">
												<br /><br />
												<form action="gestionepriorita.php" name="frmmarca" id="frmmarca" method="POST">
												<div id="ricavoselect">
												<select name="selectmarca" id="selectmarca" size="7" style="width: 350px;">
<?													$querymarca=mysql_query("SELECT id,nome FROM `marche` order by nome asc") or die ("Query: marca non eseguita!");
													while($nomemarca=mysql_fetch_array($querymarca)){
														print "<option id='".str_replace(chr(92)."'","'",utf8_encode($nomemarca[1]))."' value='".$nomemarca[0]."'>".str_replace(chr(92)."'","'",utf8_encode($nomemarca[1]))."</option>";
													}
?>												</select>
												</div>
											</td>
										</tr>	
										<tr>
											<td><input type="Submit" value="Inserisci" style="width: 150px; height: 25px;"></td>
											<input type="hidden" name="tipo" id="tipo" value="marche" />
											<input type="hidden" name="ricmarche" id="ricmarche" value="0" />
											<input type="hidden" name="select" id="select" value="selectmarca" />
											</form>
										</tr>
									</table>
								</td>
								<td>
									<table style="font-weight: bold; font-size: 18px;">
										<tr>
											<td>Seleziona una categoria:</td>
										</tr>
									</table>
									<table cellpadding="0" cellspacing="0" style="border: 2px solid #8BAECE; text-align: center; margin-bottom: 20px; font-size: 14px; font-weight: bold; background-color: #D5E2EB; width: 380px; height: 250px;">
										<tr>						
											<td  style="border: 1px solid #fff; height: 200px;">
												<input type="text" name="cercacategoria" id="cercacategoria" value="Cerca una categoria..." style="width: 285px;"  Onclick="javascript: svuotatext(document.getElementById('cercacategoria')); " Onkeyup="javascript: mostratutti(event,this.value,'categorie','selectcategoria');">
												<input type="button" name="cmdcategoria" id="cmdcategoria" value="cerca" Onclick="javascript: cercavoce(document.getElementById('cercacategoria'),document.getElementById('selectcategoria'),'categorie','selectcategoria');">
												<br /><br />
												<form action="gestionepriorita.php" name="frmcategoria" id="frmcategoria" method="POST">
												<div id="ricavoselect1">
												<select name="selectcategoria" id="selectcategoria" size="7" style="width: 350px;">
<?													$querycat=mysql_query("SELECT id,nome FROM `categorie` order by nome asc") or die ("Query: categoria non eseguita!");
													while($nomecat=mysql_fetch_array($querycat)){
														print "<option id='".str_replace(chr(92)."'","'",utf8_encode($nomecat[1]))."' value='".$nomecat[0]."'>".str_replace(chr(92)."'","'",utf8_encode($nomecat[1]))."</option>";
													}
?>												</select>
												</div>
											</td>
										</tr>	
										<tr>
											<td><input type="Submit" value="Inserisci" style="width: 150px; height: 25px;"></td>
											<input type="hidden" name="tipo" id="tipo" value="categorie" />
											<input type="hidden" name="riccategorie" id="riccategorie" value="0" />
											<input type="hidden" name="select" id="select" value="selectcategoria" />
											</form>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						<table>						
							<tr>
								<td>	
									<table style="font-weight: bold; font-size: 18px;">
										<tr>
											<td>Seleziona un prodotto:</td>
										</tr>
									</table>
									<table cellpadding="0" cellspacing="0" style="border: 2px solid #8BAECE; text-align: left; margin-bottom: 20px; font-size: 14px; font-weight: bold; background-color: #D5E2EB; width: 770px; height: 250px;">
										<tr>						
											<td  style="border: 1px solid #fff; height: 200px; padding-left: 20px;">
												<input type="text" name="cercaprodotto" id="cercaprodotto" value="Cerca un prodotto..." style="width: 440px;"  Onclick="javascript: svuotatext(document.getElementById('cercaprodotto')); " Onkeyup="javascript: mostratutti(event,this.value,'prodotti','selectprodotto');">
												<input type="button" name="cmdprodotto" id="cmdprodotto" value="cerca" Onclick="javascript: cercavoce(document.getElementById('cercaprodotto'),document.getElementById('selectprodotto'),'prodotti','selectprodotto');">
												<br /><br />
												<form action="gestionepriorita.php" name="frmprodotto" id="frmprodotto" method="POST">
												<div id="ricavoselect2" style="width: 500px; float: left;">
												<select name="selectprodotto" id="selectprodotto" size="7" style="width: 500px;" Onchange="javascript: cercaimgprodotto(this.value,'prodotto'); ">
<?													$queryprod=mysql_query("SELECT id,titolo FROM `prodotti` WHERE id NOT IN (SELECT DISTINCT idprodotto FROM offerte) order by titolo asc") or die ("Query: prodotti non eseguita!");
													while($nomeprod=mysql_fetch_array($queryprod)){
														print "<option id='".str_replace(chr(92)."'","'",utf8_encode($nomeprod[1]))."'  value='".$nomeprod[0]."'>".str_replace(chr(92)."'","'",utf8_encode($nomeprod[1]))."</option>";
													}
?>												</select>
												</div>
											</td>
											<td>
												<div id="ricavoimg1" style="width: 220px; float: left; padding-left: 10px; padding-right: 10px; text-align: center;">
													<img src="/w-admin/immagini/noanteprima.jpg" />
												</div>
											</td>
										</tr>	
										<tr>
											<td><input type="Submit" value="Inserisci" style="width: 150px; height: 25px; margin-left: 20px;"></td>
											<input type="hidden" name="tipo" id="tipo" value="prodotti" />
											<input type="hidden" name="ricprodotti" id="ricprodotti" value="0" />
											<input type="hidden" name="select" id="select" value="selectprodotto" />
											</form>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<table style="font-weight: bold; font-size: 18px;">
										<tr>
											<td>Seleziona un'offerta:</td>
										</tr>
									</table>
									<table cellpadding="0" cellspacing="0" style="border: 2px solid #8BAECE; text-align: left; margin-bottom: 20px; font-size: 14px; font-weight: bold; background-color: #D5E2EB; width: 770px; height: 250px;">
										<tr>						
											<td  style="border: 1px solid #fff; height: 200px; padding-left: 20px;">
												<input type="text" name="cercaofferta" id="cercaofferta" value="Cerca un 'offerta..." style="width: 440px;"  Onclick="javascript: svuotatext(document.getElementById('cercaofferta')); " Onkeyup="javascript: mostratutti(event,this.value,'offerte','selectofferta');">
												<input type="button" name="cmdofferta" id="cmdofferta" value="cerca" Onclick="javascript: cercavoce(document.getElementById('cercaofferta'),document.getElementById('selectofferta'),'offerte','selectofferta');">
												<br /><br />
												<form action="gestionepriorita.php" name="frmofferta" id="frmofferta" method="POST">
												<div id="ricavoselect3" style="width: 500px; float: left;">
												<select name="selectofferta" id="selectofferta" size="7" style="width: 500px;"  Onchange="javascript: cercaimgprodotto(this.value,'offerta'); ">
<?													$queryofferta=mysql_query("SELECT id,titolo FROM `prodotti` WHERE id IN (SELECT DISTINCT idprodotto FROM offerte) order by titolo asc") or die ("Query: offerta non eseguita!");
													while($offerta=mysql_fetch_array($queryofferta)){
														print "<option id='".str_replace(chr(92)."'","'",utf8_encode($offerta[1]))."'  value='".$offerta[0]."'>".str_replace(chr(92)."'","'",utf8_encode($offerta[1]))."</option>";
													}
?>												</select>
												</div>
											</td>
											<td>
												<div id="ricavoimg2" style="width: 220px; float: left; padding-left: 10px; padding-right: 10px; text-align: center;">
													<img src="/w-admin/immagini/noanteprima.jpg" />
												</div>
											</td>
										</tr>	
										<tr>
											<td><input type="Submit" value="Inserisci" style="width: 150px; height: 25px; margin-left: 20px;"></td>
											<input type="hidden" name="tipo" id="tipo" value="prodotti" />
											<input type="hidden" name="ricprodotti1" id="ricprodotti1" value="0" />
											<input type="hidden" name="select" id="select" value="selectofferta" />
											</form>
										</tr>
									</table>
								</td>
							</tr>
						</table>
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