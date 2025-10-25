<?
	include $_SERVER['DOCUMENT_ROOT']."/config.php";
	error_reporting(E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING);
	//inizializzo le sessioni
	session_start();
if($_SESSION['invioprev']==0){	
	//per test
	//set_include_path("pear");
	//per versione pubblica
	set_include_path(get_include_path().":./pear");
	require "PEAR.php";
	require "HTTP/Request.php";
	$res = new HTTP_Request("http://".$_SERVER['HTTP_HOST']."/w-admin/contenutoemailpreventivo.php?idpreventivo=".$_GET['idpreventivo']."");
	$res->sendRequest();
	$body = $res->getResponseBody();
	$total = $body; //contenuto html

	//settaggio variabili
	$percorsosave = "../preventiviinviati/";
	
	//Creo la cartella se nn è presente
	if(is_dir($percorsosave)==false){
		$old = umask(0); 
		mkdir($percorsosave, 0777); 
		umask($old);		
	}
	
	//nome file
	$nomefile=$_GET['idutente']."-".$_GET['idpreventivo'].date("dmYHis").".html";
	
	//settaggio variabili
	$filename=$percorsosave.$nomefile;
	$contenuto1 = $total;
	$handle1=fopen($filename,"x+"); //apre il file
	fwrite($handle1, $contenuto1);
	fclose($handle1);
	
	
	//link
	$percorsolink = "http://".$linksito."/preventiviinviati/";
	$link=$percorsolink.$nomefile;
	$link2="http://".$linksito."/tema/guidastampa.php";
	$link3="http://".$linksito."/tema/guidastampa.php#moz";
	
	//CESTINO DEI PRVENTIVI
	//config
	include $_SERVER['DOCUMENT_ROOT']."/config.php";
	//connessione al database
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	//selezione del database
	mysql_select_db($database) or die ("Non riesco a selezionare il database");
	//Seleziono la data del preventivo
	$querypreventivo=mysql_query("select * from preventivi where idpreventivo='".$_GET['idpreventivo']."' LIMIT 1") or die ("Query: non eseguita!");
	$datapreventivo=@mysql_result($querypreventivo,0,4);
	$querycest = mysql_query("insert into cestinati values(default,'".$_GET['idpreventivo']."','".$_GET['idutente']."','".$datapreventivo."','".$link."')") or die("Errore.La query non è stata eseguita");
	//FINE CESTINO
	
	
	//Invio preventivo via email
	$oggetto="Preventivo n.".$_GET['idpreventivo'];
	$mail="Come da Vostra gentile richiesta Vi inviamo il preventivo relativo ai prodotti da Voi scelti.<br /> Per Visualizzare il preventivo clicca sul seguente link: <br /><br /><a href='$link'><b>visualizza preventivo</b></a><br /><br />Se non riesci a stampare il preventivo correttamente ed utilizzi Internet Explorer <a href=\"$link2\"><b>clicca qui</b></a>.<br/>Se invece utilizzi Mozilla Firefox <a href=\"$link3\"><b>clicca qui</b></a>.<br /><br />Cordiali Saluti<br />".$nomepersalutopreventivo;
	//header dell'e-mail
	$header="From: ".$emailperinvio."\r\n";
	$header.= "MIME-Version: 1.0\n";
	$header.= "Content-type: text/html; charset=\"iso-8859-1\"\n";
	$header.="Content-Transfer-Encoding: 7bit\n";
	//destinatario
	$email=$_GET['email'];
	//invio dell'email al venditore e acquirente
	mail($email,$oggetto,$mail,$header);
	
	$_SESSION['invioprev']=1;
	$spedita=true;
	
	$idprevins=$_GET['idpreventivo'];
	//controllo se è stato mandato il preventivo
	$queryvis=mysql_query("select * from statopreventivi where idpreventivo='".$idprevins."'") or die ("Query: non eseguita!");
	$risultato=@mysql_num_rows($queryvis);
	if($risultato==0){
		//query per settare che il preventivo è stato inviato
		$query1 = mysql_query("insert into statopreventivi values(default,'".$idprevins."','1')") or die("Errore.La query non è stata eseguita");
	}
}
include "gestionepreventivo.php";
?>	




	