<?	
	//Inizializzo sessione
	session_start();
	//Se è stato effettuato il login accedi a questa pagina
	if(isset($_SESSION['wadmin']) and $_SESSION['wadmin']=="1"){
	unset($_SESSION['query']);
	//Funzioni
	include "functions.php";
	//Inclusione dati database, connessione e selezione
	include "../config.php";
	//Modifica utente
	include "inclusi/modifica_utente.php";
	//Inserimento utente
	include "inclusi/inserimento_utente.php";
?>	
<html>
<head>
	<title>
	<? if(isset($_GET['mod']) and strlen($_GET['mod'])>0){ ?>
		W-admin -- Modifica utente
	<?	}else{?>
		W-admin -- Inserimento nuovo utente
	<? 	}?>
	</title>
	<!--STILE BACHECA-->
	<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8"/>
	<link rel="stylesheet" type="text/css" href="css/bacheca.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/stylemenu.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/registrazioneutenti.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/sddm.css" media="screen" />
	<script type="text/javascript" src="js/scripts.js"></script>
	<script type="text/javascript" src="js/effetto.js"></script>
	<script language="JavaScript" type="text/javascript" src="js/menu.js"></script>
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
				<td style="width: 770px; float: left;" valign="top">
			<form action="" name="invio" id="invio" method="post" Onsubmit="return registrazione();">
			<div class="menucentro">
<? 				if(strlen($messaggio)>0){
					print $messaggio;
				}	
				if(strlen($errore)>0){
					print $errore;
				}
?>				<img src="immagini/icona_utenti.gif">
<? 				if(isset($_GET['mod']) and strlen($_GET['mod'])>0){ ?>
					Modifica utente
<?				}else{?>
					Inserimento nuovo utente
<? 				}?>
				<hr />

				<div class="contentitolo">
					<div class="reg">Registrazione:</div><br /> 
					<div class="obbligatorio">*Campo obbligatorio</div>
					<div class="boxreg">
						<div>Nome:* </div> 
						<input type="text" name="nome" id="nome" value="<? print $nomedb; ?>" size="50" <? if(isset($_POST['nome']) and  $_POST['nome']==""){ print "class='error'";} ?>>
					</div>
					<div class="boxreg">
						<div>Cognome:* </div>
						<input type="text" name="cognome" id="cognome" value="<? print $cognome; ?>" size="50" <? if(isset($_POST['cognome']) and  $_POST['cognome']==""){ print "class='error'";} ?>>
					</div>
					<div class="boxreg">
						<div>Data di nascita:* </div>
<?							if(isset($_GET['mod']) and strlen($_GET['mod'])>0){
								ricavodata($data[2],$data[1],$data[0]);
							}else{	
								if(strlen($messaggio)>0 or strlen($errore)>0){
									if($registrazione=="completato"){
										datanascita("true","true","true","false")."<br />";
									}else{	
										ricavodata($_POST['giorno'],$_POST['mese'],$_POST['anno']);
									}	
								}else{
									datanascita("true","true","true","false")."<br />";
								}	
							}
?>					</div>
					<div class="boxreg">
						<div>Sesso:* </div>
						<input type="radio" name="sesso" id="sesso" value="m" <? if(isset($sesso) and  $sesso=="m"){ print "checked=checked";} ?>>M&nbsp;&nbsp;&nbsp;<input type="radio" name="sesso" id="sesso"  value="f" <? if(isset($sesso) and  $sesso=="f"){ print "checked=checked";} ?>>F
					</div>
					<div class="boxreg">
						<div>Cod. Fiscale:* </div>
						<input type="text" name="codfiscale" maxlength="16" id="codfiscale" value="<? print $codfiscale; ?>" size="50" <? if(isset($_POST['codfiscale']) and  $_POST['codfiscale']=="" or $_POST['coderrato']=="errato"){ print "class='error'";}else{ print "class='boxreginput'"; } ?>>
					</div>
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
						<input type="text" name="psw" id="psw" value="" size="50" />
					</div>	
					<div class="boxreg">
						<div>Email:* </div>
						<input type="text" name="email" id="email" value="<? print $email; ?>" size="50" <? if(isset($_POST['email']) and $_POST['email']==""){ print "class='error'";} ?>>
					</div>
					<div class="boxreg">
						<div>Newsletter:* </div>
						<input type="checkbox" name="newsletter" id="newsletter" <? if($ricnews=="si"){ print "checked='checked'";} ?>> Iscrivi l'utente alle Newsletter
					</div>
					<div class="boxreg">
						<div>Ruolo: </div>
						<select name='ruolo'>
<? 						if(isset($_GET['mod']) and strlen($_GET['mod'])>0){
							if(strlen($ruolo1)>0){
								$ruolo=$ruolo1;
							}
							if($ruolo=="1"){
?>								<option value="1">Amministratore</option>
								<option value="0">Utente standard</option>
<?							}else{
?>								<option value="0">Utente standard</option>
								<option value="1">Amministratore</option>
<?							}
						}else{
?>							<option value="0">Utente standard</option>
							<option value="1">Amministratore</option>
<?						}
?>						</select>	
					</div>	
				</div>
				<div class="bottonereg">
<?					if(isset($_GET['mod']) and strlen($_GET['mod'])>0){ ?>
						<input type="hidden" name="modi" id="modi" value="modreg">
						<input type="Submit" name="cmd" id="cmd" value="Modifica">
					<?}else{?>	
						<input type="hidden" name="ins" id="ins" value="reg">
						<input type="Submit" name="cmd" id="cmd" value="Inserisci">
					<?}?>
				</div>	
			</div>
			</form>
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