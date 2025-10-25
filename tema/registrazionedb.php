<?php
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
		/*if(isset($_POST['continente']) and $_POST['continente']!="Seleziona Paese"){
			$paese=$_POST['continente'];
		}else{
			$errore="Il paese non risulta corretto!!!";
		}*/
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
			$errore.="<br />Il captcha non &egrave; stato inserito correttamente!!!";
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
		//legge privacy
		if($_POST["sesso"]!=true){
			$errore.="<br />Seleziona il sesso!!!";
		}
		$sesso=$_POST["sesso"]; // Sesso
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
				mysql_query("insert into utenti values(default,'".mysql_real_escape_string($nome)."','".mysql_real_escape_string($cognome)."','".$datadinascita."','0','".mysql_real_escape_string($_POST['telefono'])."','".mysql_real_escape_string($citta)."','".mysql_real_escape_string($provincia)."','".mysql_real_escape_string($cap)."','".mysql_real_escape_string($indirizzo)."','".mysql_real_escape_string($usern)."','".mysql_real_escape_string($pswdb)."','".mysql_real_escape_string($email)."','0','".$newsletter."','0','".$sesso."')");
				//ricavo l'id dell'ultimo utente
				$idutente=mysql_insert_id();
				//ricavo l'md5 del nome utente
				$codice=md5($nome);
				$codice1=substr(md5($nome),0,10);
				//Inserimento nella tabella attivazione
				mysql_query("insert into attivazione values(default,'".$idutente."','".$codice."','".$codice1."')");
				//Messaggio di avvenuto inserimento
				$messaggio="<div class='messaggio'>Grazie per esserti registrato. <br />Ti verr&agrave; inviata un'email per l'attivazione dell'account!!!</div>";
				//Email di attivazione
				include "w-admin/inclusi/emailregistrazione.php";
			}else{
				$errore="<div class='erroremsg'>".$errore."</div><br />";
			}	
		}
	}
?>
		<div class="box-titlepagina">
			<div class="titlepagina">
				<h2>Registrazione nuovo utente</h2>
			</div>
		</div>
		
		<div class="box-prodotti">
			<div class="pagina">
<?php
				if(strlen($errore)>0){
?>
					<div class="errore">
						<div class="affianco">
							<img src="tema/immagini/errore.png">
						</div>
						<div class="affianco1">
							<? print $errore; ?>
							<form action="/registrati.html" method="post">
								<input type="hidden" name="nome" id="nome" value="<? print $_POST['nome']; ?>">
								<input type="hidden" name="cognome" id="cognome" value="<? print $_POST['cognome']; ?>">
								<input type="hidden" name="sesso" id="sesso" value="<? print $_POST['sesso']; ?>">
								<input type="hidden" name="giorno" id="giorno" value="<? print $_POST['giorno']; ?>">
								<input type="hidden" name="mese" id="mese" value="<? print $_POST['mese']; ?>">
								<input type="hidden" name="anno" id="anno" value="<? print $_POST['anno']; ?>">
								<input type="hidden" name="citta" id="citta" value="<? print $_POST['citta']; ?>">
								<input type="hidden" name="provincia" id="provincia" value="<? print $_POST['provincia']; ?>">
								<input type="hidden" name="via" id="via" value="<? print $_POST['via']; ?>">
								<input type="hidden" name="cap" id="cap" value="<? print $_POST['cap']; ?>">
								<input type="hidden" name="telefono" id="telefono" value="<? print $_POST['telefono']; ?>">
								<input type="hidden" name="user" id="user" value="<? print $_POST['user']; ?>">
								<input type="hidden" name="psw" id="psw" value="<? print $_POST['psw']; ?>">
								<input type="hidden" name="email" id="email" value="<? print $_POST['email']; ?>">
								<input type="hidden" name="newsletter" id="newsletter" value="<? print $_POST['newsletter']; ?>">
								<input type="submit" name="cmd" id="cmd" value="Indietro">
							</form>	
						</div>
					</div>
<?php
				}else{
?>
					<div class="noerrore">
						<div class="avviso">
							<img src="tema/immagini/ok.png">
						</div>
						<div class="avviso">
							<? print $messaggio; ?>
						</div>
					</div>
<?php
				}
?>
			</div>
		</div>