<?php
	include_once '../config.php';
	include_once 'inclusi/setting.php';
	//ricezione dei parametri della mail
	$id_utente=$_GET['att'];
	
	//Ricavo l'email dell'utente
	$sql="SELECT email FROM `utenti` WHERE id=" . $id_utente;
	$rs = mysql_query($sql) or die ("Query: ".$sql." non eseguita!");
	$mails = mysql_fetch_array($rs);
	$email_utente = $mails[0];

	//Setto l'oggetto
	$oggetto="Utente sbloccato su ".$titolosito;
	
	//header dell'e-mail
	$header="From: " . $emailsito ."\r\n";
	$header.= "MIME-Version: 1.0\n";
	$header.= "Content-type: text/html; charset=\"utf-8\"\n";
	$header.="Content-Transfer-Encoding: quoted-printable\n\n";
	
	$corpomail="<html><body>".htmlspecialchars_decode($mail_sblocco)."</body></html>";
	//invio dell'email
	mail($email_utente, $oggetto, $mail_sblocco, $header);
?>