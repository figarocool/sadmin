<?
	if(isset($_GET['mod']) and strlen($_GET['mod'])>0){
		//connessione al database
		$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.php");
		//selezione del database
		mysql_select_db($database) or die ("Non riesco a selezionare il database");
		//Informazioni utente
		$query="select * from utenti where id='".$_GET['mod']."'";
		$ris=mysql_query($query) or die ("Query: ".$query." non eseguitaa!");
		$iddb=mysql_result($ris,0,0);
		$nomedb=mysql_result($ris,0,1);
		$cognome=mysql_result($ris,0,2);
		$telefono=mysql_result($ris,0,5);
		$citta=mysql_result($ris,0,6);
		$provincia=mysql_result($ris,0,7);
		$cap=mysql_result($ris,0,8);
		$indirizzo=mysql_result($ris,0,9);
		$usern=mysql_result($ris,0,10);
		$pswdb=mysql_result($ris,0,11);
		$email=mysql_result($ris,0,12);
		$data=mysql_result($ris,0,3);
		$sesso=mysql_result($ris,0,16);
		$codfiscale=mysql_result($ris,0,15);
		$data=explode("-",$data);
		//$paese=mysql_result($ris,0,4);
		$paese='0';
		$ruolo=mysql_result($ris,0,13);
		$ricnews=mysql_result($ris,0,14);
		if(isset($_POST['modi']) and strlen($_POST['modi'])>0){
			//Controllo del nome
			if(isset($_POST['nome']) and strlen($_POST['nome'])>0){
				$nomedb=$_POST['nome'];
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
			//Controllo cod fiscale
			if(isset($_POST['codfiscale']) and strlen($_POST['codfiscale'])>0){
				$codfiscale=$_POST['codfiscale'];
			}else{
				$codfiscale='0';
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
			}
			//Controllo se la email è vuota
			if(isset($_POST['email']) and strlen($_POST['email'])>0){
				$email=$_POST['email'];
			}else{
				$errore="Si &egrave; verificato un errore nell'inserimento dei dati!!!";
			}
			//ruolo dell'utente
			$ruolo1=$_POST['ruolo'];
			if($_POST['newsletter']=="on"){
				$newsletter="si";
			}else{
				$newsletter="no";
			}	
			//Controllo se l'utente è  esiste
			$query="select * from utenti where user='".$usern."' and id!='".$iddb."'";
			$ris=mysql_query($query) or die ("Query: ".$query." non eseguita!");
			$iduguale=@mysql_result($ris,0,0);
			//Se è uguale non lo inserisce
			if(strlen($iduguale)>0){
				$messaggio="<div class='erroremsg'>Nickname gi&agrave; esistente.</div>";
			}else{
				//Se non ci sono errori inserisci
				if($errore==""){
					$sesso=$_POST['sesso'];
					$codfiscale=$_POST['codfiscale'];
					//Modifica dell'utente
					mysql_query("Update utenti set nome='".$nomedb."', cognome='".$cognome."',datadinascita='".$datadinascita."', sesso='".$sesso."', codfiscale='".$codfiscale."', paese='".$paese."',telefono='".$_POST['telefono']."',citta='".$citta."',provincia='".$provincia."',cap='".$cap."',via='".$indirizzo."',user='".$usern."',psw='".$pswdb."',email='".$email."',admin='".$ruolo1."', newsletter='".$newsletter."' where id='".$_GET['mod']."'");
					//Messaggio di avvenuto inserimento
					$messaggio="<div class='messaggio'>Utente modificato correttamente!!!</div>";
					$telefono=$_POST['telefono'];
					$ricnews=$newsletter;
					$data=explode("-",$datadinascita);
				}else{
					$errore="<div class='erroremsg'>".$errore."</div><br />";
				}	
			}
		}
		mysql_close($db); //chiusura db
	}
?>	