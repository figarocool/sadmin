<?//Inizializzo la sessione
	session_start();
	
	if(isset($_POST['ins']) and $_POST['ins']=="reg"){	
		//Controllo del nome
		if(isset($_POST['nome']) and strlen($_POST['nome'])>0){
			$nome=$_POST['nome'];
		}else{
			$errore="Si &egrave; verificato un errore nell'inserimento dei dati!!!";
		}
		//Controllo se il cognome è vuoto
		if(isset($_POST['cognome']) and strlen($_POST['cognome'])>0){
			$cognome=$_POST['cognome'];
		}else{
			$errore="Si &egrave; verificato un errore nell'inserimento dei dati!!!";
		}
		//Controllo se la data di nascita è vuoto
		if(isset($_POST['giorno']) and $_POST['giorno']!="--Giorno--" and isset($_POST['mese']) and $_POST['mese']!="--Mese--" and isset($_POST['anno']) and $_POST['anno']!="--Anno--"){
			$datadinascita=$_POST['anno']."-".$_POST['mese']."-".$_POST['giorno'];
		}else{
			$errore="La data di nascita non risulta corretta!!!";
		}
		//Controllo se il paese è vuoto
		if(isset($_POST['continente']) and $_POST['continente']!="Seleziona Paese"){
			$paese=$_POST['continente'];
		}else{
			$errore="Il paese non risulta corretto!!!";
		}
		//Controllo se la citta è vuota
		if(isset($_POST['citta']) and strlen($_POST['citta'])>0){
			$citta=$_POST['citta'];
		}else{
			$errore="Si &egrave; verificato un errore nell'inserimento dei dati!!!";
		}
		//Controllo se la provincia è vuota
		if(isset($_POST['provincia']) and strlen($_POST['provincia'])>0){
			$provincia=$_POST['provincia'];
		}else{
			$errore="Si &egrave; verificato un errore nell'inserimento dei dati!!!";
		}
		//Controllo se l'indirizzo è vuoto
		if(isset($_POST['via']) and strlen($_POST['via'])>0){
			$indirizzo=$_POST['via'];
		}else{
			$errore="Si &egrave; verificato un errore nell'inserimento dei dati!!!";
		}
		//Controllo se il cap è vuoto
		if(isset($_POST['cap']) and strlen($_POST['cap'])>0){
			$cap=$_POST['cap'];
		}else{
			$errore="Si &egrave; verificato un errore nell'inserimento dei dati!!!";
		}
		//Controllo se l'user è vuoto
		if(isset($_POST['user']) and strlen($_POST['user'])>0){
			$usern=$_POST['user'];
		}else{
			$errore="Si &egrave; verificato un errore nell'inserimento dei dati!!!";
		}
		//Controllo se la password è vuota
		if(isset($_POST['psw']) and strlen($_POST['psw'])>0){
			$pswdb=$_POST['psw'];
		}else{
			$errore="Si &egrave; verificato un errore nell'inserimento dei dati!!!";
		}
		//Controllo se la email è vuota
		if(isset($_POST['email']) and strlen($_POST['email'])>0){
			$email=$_POST['email'];
		}else{
			$errore="Si &egrave; verificato un errore nell'inserimento dei dati!!!";
		}
		//Codice captcha corretto
		if($_POST['txt_captcha']=="" or $_POST['txt_captcha']!=$_SESSION['session_captchaText']){
			$errore.="Il captcha non &egrave; stato inserito correttamente!!!";
		}
		//legge privacy
		if($_POST['legge']!=true){
			$errore.="Devi accettare la legge sulla privacy!!!";
		}
		if($_POST['newsletter']!=true){
			$newsletter="no";
		}else{
			$newsletter="si";
		}

		//Dati database, connessione e selezione del database
		include "../config.php";
		//connessione al database
		$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
		//selezione del database
		mysql_select_db($database) or die ("Non riesco a selezionare il database");
		//Controllo se l'utente è  esiste
		$query="select * from utenti where user='".$usern."'";
		$ris=mysql_query($query) or die ("Query: ".$query." non eseguita!");
		$iduguale=@mysql_result($ris,0,0);
		//Se è uguale non lo inserisce
		if(strlen($iduguale)>0){
			$errore="<div class='erroremsg'>Nickname gi&agrave; esistente.</div>";
		}else{
			//Se non ci sono errori inserisci
			if($errore==""){
				//Inserimento dell'utente
				mysql_query("insert into utenti values(default,'".$nome."','".$cognome."','".$datadinascita."','".$paese."','".$_POST['telefono']."','".$citta."','".$provincia."','".$cap."','".$indirizzo."','".$usern."','".$pswdb."','".$email."','0','".$newsletter."')");
				//ricavo l'id dell'ultimo utente
				$idutente=@mysql_insert_id();
				//ricavo l'md5 del nome utente
				$codice=md5($nome);
				$codice1=substr(md5($nome),0,10);
				//Inserimento nella tabella attivazione
				mysql_query("insert into attivazione values(default,'".$idutente."','".$codice."','".$codice1."')");
				//Messaggio di avvenuto inserimento
				$messaggio="<div class='messaggio'>Grazie per esserti registrato. <br />Ti verrà inviata un'email per l'attivazione dell'account!!!</div>";
				//Email di attivazione
				include "inclusi/emailregistrazione.php";
			}else{
				$errore="<div class='erroremsg'>".$errore."</div><br />";
			}	
		}
	}
?>	
<html>
<head>
	<title><?php print $titolosito; ?> -- Registrato nuovo utente</title>
	<!--STILE HOME-->
	<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
	<!--FINE STILE-->
<?
	//Header
	include "header.php"; 
?>
</head>
<body>
	<div class="contenuto">
		<div class="menumarche">
<?			//Menù sinistra
			include "inclusi/menusinistra.php";
?>		</div>
		<div class="prodotti">
			<div class="testo">
				<img src="immagini/regi.gif"> Registrazione
			</div>
			<hr >
<?
			if(strlen($errore)>0){ 
?>				<div class="errore">
					<div class="affianco">
						<img src="immagini/attenzione.gif">
					</div>
					<div class="affianco">
						<? print $errore."<br /><a href='registrazione.php'>Torna indietro</a>"; ?>
					</div>
				</div>
<?			}else{
?>				<div class="noerrore">
					<div class="affianco">
						<img src="immagini/ok.gif">
					</div>
					<div class="affianco1">
						<? print $messaggio."<br /><a href='registrazione.php'>Torna indietro</a>"; ?>
					</div>
				</div>
<?
			}
?>
		</div>
	</div>