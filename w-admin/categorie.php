<?	//Inizializzo sessione
	session_start();
	//Dati database
	include "../config.php";
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	//selezione del database
	mysql_select_db($database) or die ("Non riesco a selezionare il database");
	
	include "functions.php";
	
	//Se è stato effettuato il login accedi a questa pagina
	if(isset($_SESSION['wadmin']) and $_SESSION['wadmin']=="1"){
		unset($_SESSION['query']);		
		//inserimento
		if($_POST['nuovo']=="ins"){
			
			include "inclusi/inscategoria.php";
		}
		//modifica
		if(strlen($_POST['mod'])>0){
			include  "inclusi/modcategoria.php";
		}
		//elimina
		if(strlen($_POST['elim'])>0){
			include  "inclusi/elimcategoria.php";	
		}
		
	//browser
	$lista=$_SERVER['HTTP_USER_AGENT'];
	$browser=explode(';',$lista);
	$browser=$browser[1]; 
	
?>
<html>
<head>
	<title>
		W-admin -- Gestione Categorie
	</title>
	<!--STILE BACHECA-->
	<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8"/>
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
	<script type="text/javascript" src="editor/wysiwyg.js"></script> 
	
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
				<td style="width: 770px; float: left;" valign="top">
			<div class="menucentro">
<? 				print $messaggio; 
?>				<img src="immagini/icona_categoria.gif">	
					Gestione Categorie
				<hr />
				<div class="contentitolo">
					<div class="reg">Inserimento di una nuova categoria:</div><br />
					<form action="#" method="post" name="inserimento">
						<input type="text" name="newcat" id="newcat" value="" size="30" style="font-size: 13px;">
						<input type="submit" id="cmd" name="cmd" value="Inserisci"><br /><br />
						<select name="cat" id="cat" size="1" style="width: 275px; font-size: 15px;">
							<option value="0">Nessuna Categoria</option> 
<?php						$ris=mysql_query("select * FROM categorie where appartenenza ='0'") or die ("Query: categorie non eseguita!");
							while($data=mysql_fetch_array($ris)){ controlloalbero($data[0],1); }	
?>						</select>
						<input type="hidden" id="nuovo" name="nuovo" value="ins">
					</form>
				</div><br />
				<div class="contentitolo">
					<form action="#" method="post" name="modifica">
						<div class="reg">Modifica di una categoria:</div><br />
						<select name="mod" id="mod" size="1" style="width: 200px; font-size: 15px;">
							<option value="0">Nessuna Categoria</option> 
<?php						$ris=mysql_query("select * FROM categorie where appartenenza ='0'") or die ("Query: categorie non eseguita!");
							while($data=mysql_fetch_array($ris)){ controlloalbero($data[0],1); }	
?>						</select>
						<input type="text" name="newmod" id="newmod" value="" size="20" style="font-size: 13px;">
						<input type="submit" id="cmd" name="cmd" value="Modifica">
					</form>	
				</div><br />
				<div class="contentitolo">
					<div class="reg">Eliminazione di una categoria:</div><br />
					<form action="#" method="post" name="elimina">
						<select name="elim" id="elim" size="1" style="width: 200px; font-size: 15px;">
							<option value="0">Nessuna Categoria</option> 
<?php						$ris=mysql_query("select * FROM categorie where appartenenza ='0'") or die ("Query: categorie non eseguita!");
							while($data=mysql_fetch_array($ris)){ controlloalbero($data[0],1); }	
?>						</select>
						<input type="submit" id="cmd" name="cmd" value="Elimina">
					</form>
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