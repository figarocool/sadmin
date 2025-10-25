<?php

	//inizializzazione sessioni
	session_start();
	//nome cartella
	$nomedir=date('d-m-Y');
	//function
	include  "functions.php";
	//cartella destinazione
	$percorsosave=$_SERVER['DOCUMENT_ROOT']."/upload/".$nomedir."/";
	//acquisisco la listbox
	$generolista=$_POST['listbox'];

//avviene il caricamento delle immagini
if(isset($_POST['carico']) and $_POST['carico']=="1" and $_POST['elimina']!="elimina"){
	if(is_dir($percorsosave)==false){
		$old = umask(0); 
		mkdir($percorsosave, 0777); 
		umask($old);		
	}
	$create_file=$percorsosave.$_FILES['file1']['name'];
	if(is_file($create_file)==false){
		//Estensione del file
		$specifichefile=pathinfo($_FILES['file1']['name']);
		$estensionefile=$specifichefile['extension'];
		//Controllo estensione del file se si tratta di un'immagine
		if(strtolower($estensionefile)==strtolower("jpg") or strtolower($estensionefile)==strtolower("gif") or strtolower($estensionefile)==strtolower("jpe") or strtolower($estensionefile)==strtolower("jpeg") or strtolower($estensionefile)==strtolower("png")){
			if (is_uploaded_file($_FILES['file1']['tmp_name'])) {
				if (move_uploaded_file($_FILES['file1']['tmp_name'], $create_file)){
					//ridimensionamento delle immagini
					resize($_FILES['file1']['name'],"max_".$_FILES['file1']['name'],800,0,1,$percorsosave);
					resize($_FILES['file1']['name'],$_FILES['file1']['name'],0,132,2,$percorsosave);
					//creazione dell'array
					if(isset($generolista)){
						$generolista=$generolista.",".$_FILES['file1']['name'];
					}else{
						$generolista=$_FILES['file1']['name'];
					}
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

//Eliminazione di un'immagine
if(isset($_POST['elimina']) and $_POST['elimina']=="elimina"){
	$elem=strval($_POST['dato']);
	$list=explode(",",$generolista);
	@unlink($percorsosave.$list[$elem]);
	@unlink($percorsosave."max_".$list[$elem]);
	unset($list[$elem]);
	$generolista=implode(",",$list);
}


?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
	<title>W-admin -- Carico Immagini</title>
</head>
<body bgcolor="#EFEFEF">
<form name='indietro' id='indietro' method='POST' action='caricoprodotti.php'>
	<input type="image" id="submit" name="submit" src="immagini/bottone1.jpg">
				
	<!--SALVATAGGIO DATI-->
	<input type="hidden" name="titolo" id="titolo" value="<?php print str_replace('\"','"',stripcslashes(htmlspecialchars($_POST['titolo']))); ?>">
	<input type="hidden" name="descrizione" id="descrizione" value="<?php print str_replace('\"','"',stripcslashes(htmlspecialchars($_POST['descrizione']))); ?>">
	<input type="hidden" name="arrayimg" id="arrayimg" value="<?php print $generolista; ?>">
	<input type="hidden" name="marca" id="marca" value="<?php print $_POST['marca']; ?>">
	<input type="hidden" name="categoria" id="categoria" value="<?php print $_POST['categoria']; ?>">
	<input type="hidden" name="l" id="l" value="<?php print $_POST['l']; ?>">
	<input type="hidden" name="p" id="p" value="<?php print $_POST['p']; ?>">
	<input type="hidden" name="h" id="h" value="<?php print $_POST['h']; ?>">
	<input type="hidden" name="l2" id="l2" value="<?php print $_POST['l2']; ?>">
	<input type="hidden" name="p2" id="p2" value="<?php print $_POST['p2']; ?>">
	<input type="hidden" name="h2" id="h2" value="<?php print $_POST['h2']; ?>">
	<input type="hidden" name="h3" id="h3" value="<?php print $_POST['h3']; ?>">
	<input type="hidden" name="diam" id="diam" value="<?php print $_POST['diam']; ?>">
	<input type="hidden" name="legno" id="legno" value="<?php print $_POST['legno']; ?>">
	<input type="hidden" name="colore" id="colore" value="<?php print $_POST['colore']; ?>">
	<input type="hidden" name="anno" id="anno" value="<?php print $_POST['anno']; ?>">
	<input type="hidden" name="prezzo" id="prezzo" value="<?php print $_POST['prezzo']; ?>">
	<input type="hidden" name="ante" id="ante" value="<?php print $_POST['ante']; ?>">
	<input type="hidden" name="cassetti" id="cassetti" value="<?php print $_POST['cassetti']; ?>">
	<input type="hidden" name="posti" id="posti" value="<?php print $_POST['posti']; ?>">
	<input type="hidden" name="finitura" id="finitura" value="<?php print $_POST['finitura']; ?>">
	<input type="hidden" name="laccatura" id="laccatura" value="<?php print $_POST['laccatura']; ?>">
	<input type="hidden" name="forma" id="forma" value="<?php print $_POST['forma']; ?>">
	<input type="hidden" name="tipo" id="tipo" value="<?php print $_POST['tipo']; ?>">
	<input type="hidden" name="stile" id="stile" value="<?php print $_POST['stile']; ?>">
	<input type="hidden" name="particolari" id="particolari" value="<?php print $_POST['particolari']; ?>">
	<!--FINE SALVATAGGIO-->
</form>	
	
	<form name='carico' id='carico' enctype="multipart/form-data" method='POST' action='gestioneimg.php'>
		<div style="background-image: url(immagini/title.jpg)" class="divtitle">Informazioni del Prodotto</div>	
		<table class="tabellaimmagini">
			<tr>
				<td class="anteprimaprodotti"><b>Immagini del prodotto</b></td>
				<td class="anteprimaprodotti"><b>Nuova immagine</b></td>
			</tr>
			<tr>
				<td class="anteprima">
<?php 				//se esiste l'array di immagini divido un immagine dall'altra
					if(isset($generolista) and count($generolista)>0){
						$listaimg=explode(",",$generolista);
					}
					if(isset($listaimg)){
						for($a=0;$a<count($listaimg);$a++){	
							if(strlen($listaimg[$a])>0){
?>								<div style="float:left; margin: 0px 10px 10px 0px">
									<img src="<?php print "../upload/".$nomedir."/".$listaimg[$a]; ?>" /><br />
									<input class="eliminaimg" type="Submit" id="elimina" name="elimina" value="elimina" OnClick="javascript: document.carico.dato.value='<?php print $a;?>'"/>	
								</div>	
<?php							}
						}
					$listaimg=implode(",",$listaimg);	
					}
?>					<input type="hidden" name="dato" id="dato" value="" />
				</td>
				<td class="descrizioneprodotto">
					<input type="file" name="file1" id="file1">
					<input type="hidden" name="carico" id="carico" value="1">
					<input type="submit" id="submit" name="submit" value="Carica">
					
					<!--SALVATAGGIO DATI-->
					<input type="hidden" name="titolo" id="titolo" value="<?php print str_replace('\"','"',stripcslashes(htmlspecialchars($_POST['titolo']))); ?>">
					<input type="hidden" name="descrizione" id="descrizione" value="<?php print str_replace('\"','"',stripcslashes(htmlspecialchars($_POST['descrizione']))); ?>">
					<input type="hidden" id="listbox" name="listbox" value="<?php print $generolista; ?>">
					<input type="hidden" name="marca" id="marca" value="<?php print $_POST['marca']; ?>">
					<input type="hidden" name="categoria" id="categoria" value="<?php print $_POST['categoria']; ?>">
					<input type="hidden" name="l" id="l" value="<?php print $_POST['l']; ?>">
					<input type="hidden" name="p" id="p" value="<?php print $_POST['p']; ?>">
					<input type="hidden" name="h" id="h" value="<?php print $_POST['h']; ?>">
					<input type="hidden" name="l2" id="l2" value="<?php print $_POST['l2']; ?>">
					<input type="hidden" name="p2" id="p2" value="<?php print $_POST['p2']; ?>">
					<input type="hidden" name="h2" id="h2" value="<?php print $_POST['h2']; ?>">
					<input type="hidden" name="h3" id="h3" value="<?php print $_POST['h3']; ?>">
					<input type="hidden" name="diam" id="diam" value="<?php print $_POST['diam']; ?>">
					<input type="hidden" name="legno" id="legno" value="<?php print $_POST['legno']; ?>">
					<input type="hidden" name="colore" id="colore" value="<?php print $_POST['colore']; ?>">
					<input type="hidden" name="anno" id="anno" value="<?php print $_POST['anno']; ?>">
					<input type="hidden" name="ante" id="ante" value="<?php print $_POST['ante']; ?>">
					<input type="hidden" name="prezzo" id="prezzo" value="<?php print $_POST['prezzo']; ?>">
					<input type="hidden" name="cassetti" id="cassetti" value="<?php print $_POST['cassetti']; ?>">
					<input type="hidden" name="posti" id="posti" value="<?php print $_POST['posti']; ?>">
					<input type="hidden" name="finitura" id="finitura" value="<?php print $_POST['finitura']; ?>">
					<input type="hidden" name="laccatura" id="laccatura" value="<?php print $_POST['laccatura']; ?>">
					<input type="hidden" name="forma" id="forma" value="<?php print $_POST['forma']; ?>">
					<input type="hidden" name="tipo" id="tipo" value="<?php print $_POST['tipo']; ?>">
					<input type="hidden" name="stile" id="stile" value="<?php print $_POST['stile']; ?>">
					<input type="hidden" name="particolari" id="particolari" value="<?php print $_POST['particolari']; ?>">
					<!--FINE SALVATAGGIO-->
				</td>
			</tr>
		</table>
	</form>	
</body>
</html>		