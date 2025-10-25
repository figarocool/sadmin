<?
	$time=time();
	setcookie("prodotti", "", $time - 3600);
	setcookie("utente", "", $time - 3600);
	//Inizializzo la sessione
	session_start();
	//config
	include "../config.php";
	//funzioni
	include "../w-admin/functions.php";
	if($_SESSION['preventivo']=="1"){
		//connessione al database
		$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione.");
		//selezione del database
		mysql_select_db($database) or die ("Non riesco a selezionare il database");
		$q=mysql_query('select * from preventivi order by id desc limit 1') or die ("Query: ".$q." non eseguita!");
		$idpreventivodb=@mysql_result($q,0,3);
		//Se l'ID del preventivo ritorna zero manda un email ad Arkosoft
		if(strlen($idpreventivodb)==0){ include "$emaildicontrollo.php";}
		//fine controlo
		//sommo l'ultimo id + 1
		$idpreventivo=$idpreventivodb+1;
		//trasformo in array i prodotti
		$lista=explode(",",$_COOKIE["prodotti"]);
		//ricavo l'utente
		$utente=$_COOKIE["utente"];
		//data di sistema
		$data=date("Y-m-d");
		//inserisco nella tabella preventivi i singoli prodotti
		for($i=0; $i<=count($lista); $i++){
			if($lista[$i]!=0){
				//Inserimento prodotto nel preventivo
				mysql_query("insert into preventivi values(default,'".$lista[$i]."','".$utente."','".$idpreventivo."','".$data."')");
			}
		}
		//Se è stato scritto un msg lo inserisco nella tabella messaggi
		if(strlen($_POST['richiesta'])>0){
			//Inserimento prodotto nel preventivo
			mysql_query("insert into messaggi values(default,'".$_POST['richiesta']."','".$utente."','".$idpreventivo."','".$data."')");
		}
		$_SESSION['preventivo']="";
		
	}	
	//chiudo il db
	mysql_close($db); 
	//Torno nel carrello virtuale dei preventivi
	Header( "Location: http://".$_SERVER['HTTP_HOST']."/tema/inviapreventivo.php");
?>