<?
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
		$ruolo=$_POST['ruolo'];
		//newsletter
		if($_POST['newsletter']!=true){
			$newsletter="no";
		}else{
			$newsletter="si";
		}
		$paese='0';
		//connessione al database
		$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.iinc.php");
		//selezione del database
		mysql_select_db($database) or die ("Non riesco a selezionare il database");
		//Controllo se l'utente è  esiste
		$query="select * from utenti where user='".$usern."'";
		$ris=mysql_query($query) or die ("Query: ".$query." non eseguita!!");
		$iduguale=@mysql_result($ris,0,0);
		//Se è uguale non lo inserisce
		if(strlen($iduguale)>0){
			$messaggio="<div class='erroremsg'>Nickname gi&agrave; esistente.</div>";
		}else{
			//Se non ci sono errori inserisci
			if($errore==""){
				$sesso=$_POST['sesso'];
				$codfiscale=$_POST['codfiscale'];
				//Inserimento dell'utente
				mysql_query("insert into utenti values(default,'".mysql_real_escape_string($nome)."','".mysql_real_escape_string($cognome)."','".$datadinascita."','".$paese."','".$_POST['telefono']."','".mysql_real_escape_string($citta)."','".mysql_real_escape_string($provincia)."','".$cap."','".mysql_real_escape_string($indirizzo)."','".mysql_real_escape_string($usern)."','".mysql_real_escape_string($pswdb)."','".$email."','".$ruolo."','".$newsletter."','".$codfiscale."','".$sesso."')");
				//Messaggio di avvenuto inserimento
				$messaggio="<div class='messaggio'>Utente inserito correttamente!!!</div>";
				$nome="";
				$cognome="";
				$_POST['telefono']="";
				$citta="";
				$provincia="";
				$cap="";
				$indirizzo="";
				$usern="";
				$pswdb="";
				$email="";
				$sesso="";
				$codfiscale="";
				$registrazione="completato";
				$telefono="";
			}else{
				$errore="<div class='erroremsg'>".$errore."</div><br />";
			}	
		}
		mysql_close($db); //chiusura db
	}
?>	