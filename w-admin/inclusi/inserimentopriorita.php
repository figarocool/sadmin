<?php

	//dichiarazioni variabili
	$select=$_POST['select'];
	$idcampo=$_POST[$select];
	
	//Se è stata fatta una ricerca risetta l'id da inserire
	if($_POST['ricprodotti1']!=0 or $_POST['ricprodotti']!=0 or $_POST['ricmarche']!=0 or $_POST['riccategorie']!=0){
		$ricerca="ric".$_POST['tipo'];
		if($select=='selectofferta'){ $ricerca=$ricerca."1"; }
		
		if(isset($_POST[$ricerca]) and strlen($_POST[$ricerca])>0){
			$idcampo=$_POST[$ricerca];
		}
	}	

	//Se il titolo e la descrizione sono stati inseriti
	if(strlen($idcampo)>0 and $idcampo!=0 and strlen($_POST['tipo'])>0){
	
		//connessione al database
		$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
		//selezione del database
		mysql_select_db($database) or die ("Non riesco a selezionare il database");
		//Controllo se la marca esiste già
		$ris=mysql_query("select * from gestionepriorita where idcampo='".$idcampo."' and tipo='".$_POST['tipo']."'") or die ("Query: gestionepriorita non eseguita!");
		$iduguale=@mysql_result($ris,0,0);
		//Se è uguale non lo inserisce
		if($iduguale>0){
			$messaggio="<div class='erroremsg'>Il valore &egrave; nella lista!!!</div>";
		}else{
			//Inserimento della categoria
			mysql_query("insert into gestionepriorita values('default','".$idcampo."','".$_POST['tipo']."')");
			//Messaggio di avvenuto inserimento
			$messaggio="<div class='messaggio'>Valore inserito correttamente!!!</div>";
		}
	}else{
		$messaggio="<div class='erroremsg'>Non &egrave; stato selezionato nessun valore da inserire nella priorit&agrave;</div>";
	}
?>	