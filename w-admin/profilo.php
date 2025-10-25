<?	session_start();
	if(isset($_SESSION['wadmin']) and $_SESSION['wadmin']=="1"){
		unset($_SESSION['lista']);
		$_SESSION['prof'];
	include "inclusi/headerbacheca.php";
	//Funzioni
	include "functions.php";	
			
	//Modifica utente
	include "inclusi/modifica_utente1.php";
	if(isset($_GET['prof']) and strlen($_GET['prof'])>0){
		//config
		include "../config.php";
		//connessione al database
		$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
		//selezione del database
		mysql_select_db($database) or die ("Non riesco a selezionare il database");
		//Informazioni utente
		$query="select * from utenti where id='".$_GET['prof']."'";
		$ris=@mysql_query($query) or die ("Query: ".$query." non eseguita!");
		$iddb=@mysql_result($ris,0,0);
		$nome=@mysql_result($ris,0,1);
		$cognome=@mysql_result($ris,0,2);
		$telefono=@mysql_result($ris,0,5);
		$citta=@mysql_result($ris,0,6);
		$provincia=@mysql_result($ris,0,7);
		$cap=@mysql_result($ris,0,8);
		$indirizzo=@mysql_result($ris,0,9);
		$usern=@mysql_result($ris,0,10);
		$pswdb=@mysql_result($ris,0,11);
		$email=@mysql_result($ris,0,12);
		$data=@mysql_result($ris,0,3);
		$data=explode("-",$data);
		$paese=@mysql_result($ris,0,4);
		$ruolo=@mysql_result($ris,0,13);
		$idp=$_GET['prof'];
	}

	//browser
	$lista=$_SERVER['HTTP_USER_AGENT'];
	$browser=explode(';',$lista);
	$browser=$browser[1];
?>
<html>
<head>
	<title>W-admin -- Profilo</title>
	<!--STILE BACHECA-->
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<?php 
		if(strstr($browser, 'MSIE')==true){
	?>
			<link rel="stylesheet" type="text/css" href="css/bacheca.css" media="screen" />
	<?php	}else{?>
			<link rel="stylesheet" type="text/css" href="css/bacheca_moz.css" media="screen" />
	<?php	}?>	
	<link rel="stylesheet" type="text/css" href="css/stylemenu.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/registrazioneutenti.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/sddm.css" media="screen" />
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
	<script type="text/javascript" src="/js/datepicker.js"></script>
	<script type="text/javascript" src="js/effetto.js"></script>
	<script type="text/javascript" src="js/controllo.js"></script>
	<script src="js/jquery.easing.1.3.js" type="text/javascript"></script>
	<script language="JavaScript" type="text/javascript" src="js/menu.js"></script>
	<!--FINE BACHECA-->
</head>
<body>
	<div class="box1">
<?	include "inclusi/header.php"?>
		<table width="990px;" border="0">
			<tr>
				<td width="215px;" valign="top">
					<div class="menusinistra">
						<? include "inclusi/menuleft.php"; ?>
					</div>
				</td>
				<td style="width:770px; float: left;" valign="top">	
			<form action="profilo.php?prof=<? print $idp; ?>" name="invio" id="invio" method="post" Onsubmit="return registrazione();">
			<div class="menucentro">
<? 				if(strlen($messaggio)>0){
					print $messaggio;
				}	
				if(strlen($errore)>0){
					print $errore;
				}
?>				<img src="immagini/icona_utenti.gif"> Profilo utente
				<hr />
				</div>
				<div class="contentitolo">
					<div class="reg">Informazioni:</div>
					<p>&nbsp;</p>
					<div class="obbligatorio">*Campo obbligatorio</div>
					<div class="boxreg">
						<div>Nome:* </div> 
						<input type="text" name="nome" id="nome" value="<? print $nome; ?>" size="50" <? if(isset($_POST['nome']) and  $_POST['nome']==""){ print "class='error'";} ?>>
					</div>
					<div class="boxreg">
						<div>Cognome:* </div>
						<input type="text" name="cognome" id="cognome" value="<? print $cognome; ?>" size="50" <? if(isset($_POST['cognome']) and  $_POST['cognome']==""){ print "class='error'";} ?>>
					</div>
					<div class="boxreg">
						<div>Data di nascita:* </div>
<?							if(isset($_GET['prof']) and strlen($_GET['prof'])>0){
								ricavodata($data[2],$data[1],$data[0]);
							}else{	
								if(strlen($messaggio)>0 or strlen($errore)>0){
									if($registrazione=="completato"){
										datanascita("true","true","true")."<br />";
									}else{	
										ricavodata($_POST['giorno'],$_POST['mese'],$_POST['anno']);
									}	
								}else{
									datanascita("true","true","true")."<br />";
								}	
							}
?>					</div>
					<div class="boxreg">
						<div>Citt&agrave;*: </div>
						<input type="text" name="citta" id="citta" value="<? print $citta; ?>" size="21" <? if(isset($_POST['citta']) and  $_POST['citta']==""){ print "class='error'";} ?>>
						<b>Provincia:* </b> 
						<input type="text" name="provincia" id="provincia" value="<? print $provincia; ?>" size="10" <? if(isset($_POST['provincia']) and $_POST['provincia']==""){ print "class='error'";} ?>>
					</div>
					<div class="boxreg">
						<div>Indirizzo:* </div>
						<input type="text" name="via" id="via" value="<? print stripslashes($indirizzo); ?>" size="32" <? if(isset($_POST['via']) and $_POST['via']==""){ print "class='error'";} ?>>
						<b>Cap:* </b>
						<input type="text" name="cap" id="cap" value="<? print $cap; ?>" size="5" <? if(isset($_POST['cap']) and $_POST['cap']==""and strlen($cap)!=5){ print "class='error'";} ?>>
					</div>
					<div class="boxreg">
						<div>Telefono: </div>
						<input type="text" name="telefono" id="telefono" value="<? print $telefono; ?>" size="50">
					</div>			
					<div class="boxreg">
						<div>Username:* </div>
						<input type="text" name="user" id="user" value="<? print $usern; ?>" size="50" <? if(isset($_POST['user']) and $_POST['user']==""){ print "class='error'";} ?>>
					</div>	
					<div class="boxreg">
						<div>Password:* </div>
						<input type="text" name="pswnew" id="pswnew" value="" size="50" <? if(isset($psw) and $psw==""){ print "class='error'";} ?>>
					</div>	
					<div class="boxreg">
						<div>Email:* </div>
						<input type="text" name="email" id="email" value="<? print $email; ?>" size="50" <? if(isset($_POST['email']) and $_POST['email']==""){ print "class='error'";} ?>>
					</div>
				</div>
				<div class="bottonereg">
					<input type="hidden" name="ruolo" id="ruolo" value="<? print $ruolo; ?>">
					<input type="hidden" name="mod" id="mod" value="1">
					<input type="hidden" name="psw" id="psw" value="<? print $pswdb; ?>" />
					<input type="Submit" name="cmd" id="cmd" value="Modifica Account">
				</div>	
			</div>
			</form>
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