<?php
session_start();
	//function
	include  "functions.php";

if(isset($_GET['eli']) and strlen($_GET['eli'])>0){
	//cartella destinazione
	$percorsosave=$_SERVER['DOCUMENT_ROOT']."upload/";
	$idprod=$_GET['idprod'];
	$idimg=$_GET['idm'];
	include "../config.php";
	//connessione al database
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	//selezione del database
	mysql_select_db($database) or die ("Non riesco a selezionare il database");
	$queryimg="select * from immagini where id='".$idimg."'";
	$risult=mysql_query($queryimg) or die ("Query: ".$queryimg." non eseguita!");
	$img1=@mysql_result($risult,0,2);
	$img2=@mysql_result($risult,0,3);
	mysql_query("Delete from immagini where id='".$idimg."'");
	@unlink($percorsosave.$img1);
	@unlink($percorsosave.$img2);
}

if(isset($_GET['op']) and strlen($_GET['op'])>0){
	$idprod=$_GET['idprod'];
	include "../config.php";
	//connessione al database
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	//selezione del database
	mysql_select_db($database) or die ("Non riesco a selezionare il database");
	$queryimg="select * from immagini where idprodotto='".$_GET['idprod']."'";
	$risult=mysql_query($queryimg) or die ("Query: ".$queryimg." non eseguita!");
	$nomedir=substr(@mysql_result($risult,0,2),0,10);
	//cartella destinazione
	$percorsosave=$_SERVER['DOCUMENT_ROOT']."/upload/".$nomedir."/";
	if(is_dir($percorsosave)==false){
		mkdir($percorsosave);
	}
	$create_file=$percorsosave.$_FILES['file1']['name'];
	if(is_file($create_file)==false){
		//Estensione del file
		$specifichefile=pathinfo($_FILES['file1']['name']);
		$estensionefile=$specifichefile['extension'];
		//Controllo estensione del file se si tratta di un'immagine
		if(strtolower($estensionefile)==strtolower("jpg") or strtolower($estensionefile)==strtolower("gif") or strtolower($estensionefile)==strtolower("jpe") or strtolower($estensionefile)==strtolower("jpeg") or strtolower($estensionefile)==strtolower("png")){			if (is_uploaded_file($_FILES['file1']['tmp_name'])) {
				if (move_uploaded_file($_FILES['file1']['tmp_name'], $create_file)){
					//ridimensionamento delle immagini
					resize($_FILES['file1']['name'],"max_".$_FILES['file1']['name'],800,0,1,$percorsosave);
					resize($_FILES['file1']['name'],$_FILES['file1']['name'],0,177,2,$percorsosave);
					$idprod=$_GET['idprod'];
					mysql_query("Insert into immagini values(default, '".$idprod."' ,'".$nomedir."/".str_replace("%20"," ",$_FILES['file1']['name'])."', '".$nomedir."/"."max_".str_replace("%20"," ",$_FILES['file1']['name'])."')");
				}
			}
		}else{
?>			<div style="background-color:#D31D2F; color: #ffffff; padding-left: 10px; padding-top: 5px; border: 1px solid #000; width:400px; height: 30px;">I file in formato .<?php print $estensionefile; ?> non sono validi.</div>
<?php	}	
	}else{
?>
		<div style="background-color:#D31D2F; color: #ffffff; padding-left: 10px; padding-top: 5px; border: 1px solid #000; width:400px; height: 30px;">Immagine già esistente. Inserire una nuova immagine!</div>
<?php		
	}
}	

//RICAVO IMMAGINI PRODOTTO
	$idprod=$_GET['idprod'];
	include "../config.php";
	//connessione al database
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	//selezione del database
	mysql_select_db($database) or die ("Non riesco a selezionare il database");
	//query per ricavare le immagini
	$queryimgg="select * from immagini where idprodotto='".$idprod."'";
	$risult1=mysql_query($queryimgg) or die ("Query: ".$queryimgg." non eseguita!"); 
//FINE RICAVO IMMAGINI


?>	
<html>
<head>
	<title>Modifica immagini</title>
	<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
	<script type="text/javascript" src="js/modificaimmagine.js"></script> 
</head>
<body bgcolor="#EFEFEF">
		<form name='carico' id='carico' enctype="multipart/form-data" method='POST' action='gestioneimgmod.php?op=ins&idprod=<?php print $_GET['idprod']; ?>'>
		<div style="background-image: url(immagini/title.jpg)" class="divtitle">Informazioni del Prodotto</div>	
		<table class="tabellaimmagini">
			<tr>
				<td class="anteprimaprodotti"><b>Immagini del prodotto</b></td>
				<td class="anteprimaprodotti"><b>Nuova immagine</b></td>
			</tr>
			<tr>
				<td class="anteprima">
<?php				
				while($db_imgg=mysql_fetch_array($risult1)){
					$controllo=explode("/",$db_imgg[2]);
					if(strlen($controllo[1])>0){
?>					 <div style="float:left; margin: 0px 10px 10px 0px">
					 	<img src="/upload/<?php print $db_imgg[2]; ?>" /></br>
						<a href="#" Onclick="javascript: cambiaimmagine(<?php print $db_imgg[0]; ?>,<?php print $idprod; ?>);">Modifica</a>&nbsp;&nbsp;&nbsp;
						<a href="<?php print "http://".$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']."?eli=1&idm=".$db_imgg[0]."&idprod=".$idprod; ?>">Elimina</a>
					</div>	
<?php 					}else{
						//eliminazione img vuota
						mysql_query("DELETE FROM immagini where idprodotto='".$idprod."' and imgmin='".$db_imgg[2]."'");
					}
				} ?>	
				</td>
				<td class="descrizioneprodotto">
					<input type="file" name="file1" id="file1">
					<input type="hidden" id="img" name="img" value="copia" />
					<?php if(isset($listaimg) and strlen($listaimg)>0){ ?>
						<input type="hidden" id="listaimg" name="listaimg" value="<?php print $listaimg; ?>" />
					<?php } ?>
					<input type="submit" id="submit" name="submit" value="Carica">
				</td>
			</tr>
		</table>
	</form>	
 		<form name='indietro' id='indietro' method='POST' action='modificaprodotti.php?mod=<?php print $_GET['idprod']; ?>'>
			<input type="image" id="submit" name="submit" src="immagini/bottone1.jpg">
		</form>
<div id="oscura"></div>
<div id="scrivipagina"></div>		
</body>
</html>		