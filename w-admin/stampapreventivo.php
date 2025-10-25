<?
	//Dati database, connessione e selezione del database
	include "../config.php";
	//Funzioni
	include "functions.php";
	//connessione al database
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione.");
	//selezione del database
	mysql_select_db($database) or die ("Non riesco a selezionare il database");
	$idvisualizza=$_POST['idpreventivo'];
	$query="select * from preventivi where idpreventivo='".$idvisualizza."'";
	$ris=mysql_query($query) or die ("Query: ".$query." non eseguita!");
	$idutentedb=@mysql_result($ris,0,2);
	//specifiche preventivo
	$queryspe=mysql_query("select * from specifichepreventivo where idpreventivo='".$idvisualizza."'") or die ("Query: specifiche non eseguita!");
	$numero=@mysql_result($queryspe,0,2);
	$datadb1=@mysql_result($queryspe,0,3);
	$datadb=explode("-",$datadb1);
	$datadb=$datadb[2]."/".$datadb[1]."/".$datadb[0];
	$consegna=@mysql_result($queryspe,0,4);
	$validita=@mysql_result($queryspe,0,5);
	$trasporto=@mysql_result($queryspe,0,6);
	//conto i record
	$righe=mysql_num_rows($ris);
	//informazioni utente
	$queryinfo=mysql_query("select * from utenti where id='".$idutentedb."'") or die ("Query: utente non eseguita!");
	$nome=str_replace(chr(92)."'","'",ucfirst(@mysql_result($queryinfo,0,1)))." ".str_replace(chr(92)."'","'",ucfirst(@mysql_result($queryinfo,0,2)));
	$sesso=@mysql_result($queryinfo,0,16);
	$via=str_replace(chr(92)."'","'",@mysql_result($queryinfo,0,9));
	$cap=@mysql_result($queryinfo,0,8);
	$paese=str_replace(chr(92)."'","'",@mysql_result($queryinfo,0,6));
	$prov=@mysql_result($queryinfo,0,7);
	$tel=@mysql_result($queryinfo,0,5);
	$email=@mysql_result($queryinfo,0,12);
?>
<html>
<head>
	<title>Preventivo n. <? print $numero; ?></title>
	<meta http-equiv="Pragma" content="no-cache" />
	<meta http-equiv="Cache-Control" content="no-cache" />
	<script type="text/javascript" src="js/stampa.js"></script>
</head>
<body Onload="javascript: Stampa();">
	<form action="visualizzapreventivo.php" name="indietro" method="GET">
		<input type="Submit" name="cmd" id="cmd" value="<< Indietro">
		<input type="hidden" name="visualizza" id="visualizza" value="<? print $idvisualizza; ?>">
	</form>
	<table style="font-family: Arial;" border="0" width="900" height="210" style="margin-left: 15px;" cellpadding="0" cellspacing="0">
		<tr>
			<td width="500" align="right">&nbsp;</td>
			<td width="400">
				<table border="0" width="400" cellpadding="0" cellspacing="0" style="font-family: Arial; font-size: 18px; font-weight: bold;">
					<tr>
						<td width="70px" align="left">
							<? if($sesso=="f"){ print "Sig.ra";}else{ print "Sig.";} ?>
						</td>
						<td width="340">
							<? print $nome; ?>
						</td>
					</tr>
					<tr>
						<td width="70" align="left">&nbsp;</td>						
						<td width="340">
							<? print puliscitesto($via); ?>
						</td>
					</tr>
				</table>
				<table border="0" width="400" cellpadding="0" cellspacing="0" style="font-family: Arial; text-align: left; font-size: 18px; font-weight: bold;">			
					<tr>
						<td width="400"><? print $cap." &nbsp;&nbsp;".puliscitesto(ucfirst($paese))." (".strtoupper($prov).")"; ?></td>						
					</tr>
				</table>
				<table border="0" width="400"  cellpadding="0" cellspacing="0" style="font-family: Arial; font-size: 18px; font-weight: bold;">
					<tr>
						<td width="70" align="left">Tel. </td>						
						<td width="340">
							<? print $tel; ?>
						</td>
					</tr>
					<tr>
						<td width="70" align="left">E-mail:</td>						
						<td width="340">
							<? print $email; ?>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table border="0" width="900" height="42" cellpadding="0" cellspacing="0" style="margin-left: 15px; background: url('../w-admin/immagini/riquadroprev.jpg') no-repeat; font-family: Arial; text-align: center; font-size: 18px; font-weight: bold;">
		<tr>
			<td><? print "Preventivo n. ".$numero."&nbsp; del ".$datadb; ?></td>
		</tr>
	</table>
	<table border="0" width="900" height="55" cellpadding="0" cellspacing="0" style="margin-left: 15px;  font-family: Arial; text-align: center; font-size: 14px;">
		<tr>
			<td width="330" style="background: url('../w-admin/immagini/riquadro1.jpg') no-repeat;"><? print "Prevista Consegna: ".$consegna;?></td>
			<td width="230" style="background: url('../w-admin/immagini/riquadro2.jpg') no-repeat;"><? print "Validit&agrave; Offerta: ".$validita;?></td>
			<td width="340" style="background: url('../w-admin/immagini/riquadro3.jpg') no-repeat;"><? print $trasporto;?></td>
		</tr>
	</table>
	<table border="0" cellpadding="0" cellspacing="0" width="900" height="5" style="font-family: Arial; margin-left: 15px;">
		<tr>
			<td>
				<hr height="2" color="#000">
			</td>
		</tr>
	</table>	
<?				$queryprev=mysql_query("select * from preventivi where idpreventivo='".$idvisualizza."'") or die ("Query: prodotti non eseguita!");
				$totaleprodotti=mysql_num_rows($queryprev);
				$cont=0;
				while($data=mysql_fetch_array($queryprev)){
					$cont=$cont+1;
					$queryprod=mysql_query("select * from prodotti where id='".$data[1]."'") or die ("Query: prodotti non eseguita!");
					$nomeproddb=utf8_encode(@mysql_result($queryprod,0,1));
					$descproddb=utf8_encode(@mysql_result($queryprod,0,2));
					$idmarcadb=@mysql_result($queryprod,0,3);
					
					//ricavo le img del prodotto
					$queryimg=mysql_query("select imgmin,imgmax from immagini where idprodotto='".$data[1]."'")or die ("Query non eseguita!");
					$imgmin=@mysql_result($queryimg,0,0);
					$immaginegrande=@mysql_result($queryimg,0,1);
					$formatoimg=explode(".",$immaginegrande);
					$formato=array_pop($formatoimg);
					$imgma=explode("/",$immaginegrande);
					$imgmax=array_pop($imgma);
					
					//marca del prodotto
					$querymarca=mysql_query("select * from marche where id='".$idmarcadb."'") or die ("Query: prodotti non eseguita!");
					$nomemarcadb=@mysql_result($querymarca,0,1);
					
					//note del prodotto
					$querynote=mysql_query("select * from note where idpreventivo='".$idvisualizza."' and idprodotto='".$data[1]."'") or die ("Query: prodotti non eseguita!");
					$notedb=@mysql_result($querynote,0,3);
					
					//prezzo
					$queryprezzo=mysql_query("select * from prezzi where idprodotto='".$data[1]."'") or die ("Query: prodotti non eseguita!");
					$prezzodb=@mysql_result($queryprezzo,0,2);
					$totale=$totale+$prezzodb;
					
					//misure del prod
					$misura="L. ".mysql_result($queryprod,0,5)." P. ".mysql_result($queryprod,0,6)." H. ".mysql_result($queryprod,0,7);
?>					<table  border="0" width="900" cellpadding="0" cellspacing="0" style="font-family: Arial; margin-left: 10px;">
						<tr>
							<td height="40" width="900" style="padding-left: 20px; padding-top: 10px; border: 1px solid #000;"><? print "<div style=\"float: left; width: 750px;\">".puliscitesto(strtoupper($nomemarcadb))." - ".puliscitesto($nomeproddb)."</div><div style=\"font-family: Arial; float: left; font-weight: bold;\">&euro;. ".sistemaprezzo($prezzodb)."</div>"; ?></td>
						</tr>
						<tr>
							<td height="36" width="890" style="padding-left: 20px; border: 1px solid #000;">
								<div style="height: 100px; width: 890px; overflow: hidden;">
								<? print puliscitesto($descproddb,300); ?>
<? 								if($misura!="L. 0 P. 0 H. 0"){
									print $misura;

								}
?>								</div>
							</td>	
						</tr>
					</table>	
					<table  style="font-family: Arial;" border="0" cellpadding="0" cellspacing="0" style="margin-left: 15px; padding-left: 20px; font-weight: bold;">					
						<tr>
							<td height="29" align="left" width="900">
								<? if(strlen($notedb)>0){ print "N.B. ".$notedb;}else{ print "&nbsp;";} ?>
							</td>
						</tr>
					</table>
<?				}
?>	
				<table border="0" cellpadding="0" cellspacing="0">					
					<tr>
						<td height="29" align="right" width="900" style="font-size: 20px; font-weight: bold; border: 1px solid #000;">
							<? print "Totale = ".decimali($totale)." Euro";?> 
						</td>
					</tr>
				</table>
</body>
</html>