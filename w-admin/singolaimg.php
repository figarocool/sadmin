<?
	session_start();	
	include "../config.php";
	//includo le funzioni
	include "functions.php";
	$errore=true;
	$idprod=$_POST['idprodotto'];
	$idimg=$_POST['idimmagine'];
	if(isset($_GET['idm']) and strlen($_GET['idm'])>0){ $idimg=$_GET['idm']; }
	if(isset($_GET['idprodotto']) and strlen($_GET['idprodotto'])>0){ $idprod=$_GET['idprodotto']; }
	//connessione al database
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	//selezione del database
	mysql_select_db($database) or die ("Non riesco a selezionare il database");
	//Immagine da sostituire
	$queryimg="select * from immagini where id='".$idimg."'";
	$risult=mysql_query($queryimg) or die ("Query: ".$queryimg." non eseguita!");
	$img=@mysql_result($risult,0,2);
	
if($_GET['mod']=="1"){
	$dir=substr($img,0,11);
	//cartella destinazione
	$percorsosave=$_SERVER['DOCUMENT_ROOT']."/upload/".$dir;
	
	//Controllo se il file esiste
	if(strlen($_FILES['file1']['name'])>0){
		if(is_file($percorsosave.$_FILES['file1']['name'])==false){
			//Estensione del file
			$specifichefile=pathinfo($_FILES['file1']['name']);
			$estensionefile=$specifichefile['extension'];
			//Controllo estensione del file se si tratta di un'immagine
			if(strtolower($estensionefile)==strtolower("jpg") or strtolower($estensionefile)==strtolower("gif") or strtolower($estensionefile)==strtolower("jpe") or strtolower($estensionefile)==strtolower("jpeg") or strtolower($estensionefile)==strtolower("png")){
				if (is_uploaded_file($_FILES['file1']['tmp_name'])) {
					if (move_uploaded_file($_FILES['file1']['tmp_name'], $percorsosave.$_FILES['file1']['name'])){
						//ridimensionamento delle immagini
						resize($_FILES['file1']['name'],"max_".$_FILES['file1']['name'],532,0,1,$percorsosave);
						resize($_FILES['file1']['name'],$_FILES['file1']['name'],0,132,2,$percorsosave);
						$errore=false;
					}
				}
				$nomedir=substr($img,0,11);
				$nuovaimg=$nomedir.$_FILES['file1']['name'];
				$nuovaimg1=$nomedir."max_".$_FILES['file1']['name'];
			}else{
?>				<div style="background-color:#D31D2F; color: #ffffff; padding-left: 10px; padding-top: 5px; border: 1px solid #000; width:400px; height: 30px;">I file in formato .<?php print $estensionefile; ?> non sono validi.</div>
<?				$nuovaimg="/noimg.jpg";
				$nuovaimg1="/max_noimg.jpg";
				$errore=true;
			}			

			//query per sostituire l'img 
			mysql_query("update immagini set imgmin='".$nuovaimg."',imgmax='".$nuovaimg1."' where id='".$idimg."'"); 
			//Elimino l'img vecchia
			@unlink($percorsosave.substr($img,11));
			@unlink($percorsosave."max_".substr($img,11));
			
		}else{
?>			<div style="background-color:#D31D2F; color: #ffffff; padding-left: 10px; padding-top: 5px; border: 1px solid #000; width:400px; height: 30px;">Immagine già esistente. Inserire una nuova immagine!</div>
<?			$errore=true;
		}
	}else{
?>		<div style="background-color:#D31D2F; color: #ffffff; padding-left: 10px; padding-top: 5px; border: 1px solid #000; width:400px; height: 30px;">Nessuna immagine caricata!</div>
<?		$errore=true;		
	}	
}	
	//Se è andato tutto bene chiudo l'iframe
	if($errore==false){
?>		<script language="Javascript">
			top.aggiorna(<? print $idprod; ?>);
			top.document.getElementById('oscura').style.display='none'; 
			top.document.getElementById('scrivipagina').innerHTML='';
		</script>
<?	}

?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
</head>
<body class="nessuno">
		<form name='carico' id='carico' enctype="multipart/form-data" method='POST' action='singolaimg.php?mod=1'>
		<div style="background-image: url(immagini/title.jpg)" class="divtitle">
			Modifica immagini del prodotto
			<span style="margin-left: 180px;">&nbsp;</span>
			<a href="#" style="text-decoration: none; color: #ff0000;" Onclick="javascript: top.document.getElementById('oscura').style.display='none'; top.document.getElementById('scrivipagina').innerHTML=''; ">X</a>
		</div>	
		<table class="tabellaimmagini1">
			<tr>
				<td class="anteprimaprodotti"><b>Anteprima immagine</b></td>
				<td class="anteprimaprodotti"><b>Inserimento foto</b></td>
			</tr>
			<tr>
				<td class="anteprima">

					 <div style="float:left; margin: 0px 10px 10px 0px; overflow: hidden; width: 200px;">
					 	<img src="../upload/<? print $img; ?>" /></br>
					</div>	
				</td>
				<td class="descrizioneprodotto">
					<input type="file" name="file1" id="file1">
					<input type="hidden" id="img" name="img" value="copia" />
					<input type="hidden" id="idprodotto" name="idprodotto" value="<? print $idprod; ?>" />
					<input type="hidden" id="idimmagine" name="idimmagine" value="<? print $idimg; ?>" />
					<input type="submit" id="submit" name="submit" value="Carica">
				</td>
			</tr>
		</table>
	</form>	
</body>
</html>			