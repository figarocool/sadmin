<?php
	//Inizializzo la sessione
	session_start();
	unset($_SESSION['prof']);
	$_SESSION['wadmin']='';
	$_SESSION['utente']='';
	$visualizza=true;

	//Dati database, connessione e selezione del database
	include "../config.php";
	//connessione al database
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	//selezione del database
	mysql_select_db($database) or die ("Non riesco a selezionare il database");
	//Trovo i dati dal database
	$ris = mysql_query("select * from utenti where LOWER(user)='".strtolower(mysql_real_escape_string($_POST["user"]))."' and LOWER(psw)='".strtolower(mysql_real_escape_string($_POST["psw"]))."'") or die ("Query non eseguita!");	//risultato della query
	$idut=@mysql_result($ris,0,0);
	$collegato=@mysql_result($ris,0,10);
	$admin=@mysql_result($ris,0,13);
	//vedo se l'account è bloccato
	$qa="select * from attivazione where idutente='".$idut."'";
	$risa=mysql_query($qa) or die ("Query: ".$qa." non eseguita!");
	$att=@mysql_result($risa,0,0);
	//Se non ritorna niente significa che l'user o la psw non sono corretti
	if(isset($_POST['user']) and strlen($_POST['user'])>0){
		if(strlen($idut)>0 and strlen($_POST['user'])>0 and strlen($_POST['psw'])>0 and strlen($att)==0){
			if(isset($admin) and $admin==1){
				$_SESSION['wadmin']="1";
				$_SESSION['utente']=$idut;
				$errore="Accesso eseguito correttamente!";
				Header( "Location: http://".$_SERVER['HTTP_HOST']."/w-admin/bacheca.php");
			}else{
				$_SESSION['wadmin']="1";
				$_SESSION['utente']=$idut;
				$errore="Accesso eseguito correttamente!";
				Header( "Location: http://".$_SERVER['HTTP_HOST']);
			}
			$visualizza=false;
		}else{
			if(strlen($idut)>0){
				$errore="Attenzione: Il tuo account &egrave; bloccato!";
			}else{
				$errore="Attenzione: Username o Password errate!";
			}	
			$visualizza=true;
		}
	}
	
	$lista=$_SERVER['HTTP_USER_AGENT'];
	$browser=explode(';',$lista);
	$browser=$browser[1]; 
	//if(!isset($_POST['home']) and strlen($_POST['home'])>0 and strlen($errore)>0){
	if($visualizza==true){
?>	
<html>
<head>
	<title>Collegati</title>
	<!--STILE HOME-->
	<?php 
		if(strstr($browser, 'MSIE')==true){
	?>
			<link rel="stylesheet" type="text/css" href="css/login.css" media="screen" />
	<?php	}else{?>
			<link rel="stylesheet" type="text/css" href="css/login_moz.css" media="screen" />
	<?php	}?>	
	<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8"/>
	<script type="text/javascript" src="js/scripts.js"></script>
	<!--FINE STILE-->
</head>
<body>
	<a href="http://<?php print $_SERVER['HTTP_HOST'];?>" class="link">&larr; Torna alla Home</a>
	<form action="index.php" name="login" id="login" method="post" OnSubmit='return controllologin();'>
	<div class="boxlogin">
<?php	if(strlen($errore)>0){
?> 			<div class="loginerror">
<?php			print $errore; ?>
			</div>
<?php	}
?>		<div class="boxtitolo">
			<div class="titolologin">
				Login
			</div>
		</div>
		<div class="boxcontent">
			<div class="user">
				<div class="titolouser">
					Nome utente
				</div>
				<div>				
					<input type="text" name="user" id="user" value="" size="30">
				</div>	
			</div>
			<div class="user">
				<div class="titolouser">
					Password
				</div>
				<div>				
					<input type="password" name="psw" id="psw" value="" size="30">
				</div>	
			</div>
			<div class="bottonelogin">
				<input type="hidden" name="login" id="login" value="ok">
				<input type="image" id="cmd" name="cmd" src="immagini/login.jpg">	
			</div>
			<div class="recuperopsw">
				<img src="immagini/recuperopassword.gif">
				<a href="recupero_password.php" title="Recupero password">
					Recupero password
				</a>	
			</div>
		</div>
	</div>
	</form>
</body>
</html>
<?php
	}
?>