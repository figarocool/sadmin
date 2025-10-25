<?php
	if(isset($_GET['prof']) and strlen($_GET['prof'])>0 and strlen($_POST['mod'])>0){
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
		//paese
		$paese='0';
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
		if((isset($_POST['pswnew']) and strlen($_POST['pswnew'])>0)){
			$psw=$_POST['pswnew'];
		}else{
			$psw=$_POST['psw'];
		}
		//Controllo se la email è vuota
		if(isset($_POST['email']) and strlen($_POST['email'])>0){
			$email=$_POST['email'];
		}else{
			$errore="Si &egrave; verificato un errore nell'inserimento dei dati!!!";
		}
		//ruolo dell'utente
		$ruolo1=$_POST['ruolo'];
		//Controllo se l'utente è  esiste
		$query="select * from utenti where user='".$usern."' and id!='".$_GET['prof']."'";
		$ris=mysql_query($query) or die ("Query: ".$query." non eseguita!");
		$iduguale=@mysql_result($ris,0,0);
		//Se è uguale non lo inserisce
		if(strlen($iduguale)>0){
			$messaggio="<div class='erroremsg'>Nickname gi&agrave; esistente.</div>";
		}else{
			//Se non ci sono errori inserisci
			if($errore==""){
				//Modifica dell'utente
				mysql_query("Update utenti set nome='".mysql_real_escape_string($nome)."', cognome='".mysql_real_escape_string($cognome)."',datadinascita='".$datadinascita."',paese='".$paese."',telefono='".$_POST['telefono']."',citta='".mysql_real_escape_string($citta)."',provincia='".mysql_real_escape_string($provincia)."',cap='".$cap."',via='".mysql_real_escape_string($indirizzo)."',user='".mysql_real_escape_string($usern)."',psw='".$psw."',email='".$email."', admin='".$ruolo1."' where id='".$_GET['prof']."'");
				//Messaggio di avvenuto inserimento
				$messaggio="<div class='messaggio'>Utente modificato correttamente!!!</div>";
				$telefono=$_POST['telefono'];
			}else{
				$errore="<div class='erroremsg'>".$errore."</div>";
			}	
		}
	}
	
?>	