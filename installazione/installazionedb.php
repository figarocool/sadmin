<?php
//CREAZIONE FILE CONFIG.PHP
$fp = fopen('../config.php', 'w+');
fputs ($fp,'<?php'."\n");

fputs ($fp,'//CONFIG'."\n");
fputs ($fp,'$host='.chr(34).$_POST['hostdb'].chr(34).";\n");
fputs ($fp,'$user='.chr(34).$_POST['nomeuserdb'].chr(34).";\n");
fputs ($fp,'$psw='.chr(34).$_POST['passworddb'].chr(34).";\n");
fputs ($fp,'$database='.chr(34).$_POST['nomedb'].chr(34).";\n\n");

fputs ($fp,'//METATAG'."\n");
fputs ($fp,'$abstarct='.chr(34).chr(34).";\n");
fputs ($fp,'$keywords='.chr(34).chr(34).";\n");
fputs ($fp,'$description='.chr(34).chr(34).";\n\n");

fputs ($fp,'//INFORMAZIONI PER PANNELLO'."\n");
fputs ($fp,'$titolosito='.chr(34).$_POST['titolosito'].chr(34).";\n");
fputs ($fp,'$emailsito='.chr(34).$_POST['emailsito'].chr(34).";\n\n");

fputs ($fp,'//ANALYTICS'."\n");
fputs ($fp,'$codiceanalytics='.chr(34).chr(34).";\n\n");

fputs ($fp,'?>');
fclose($fp);
//CREAZIONE FILE CONFIG.PHP


//CREAZIONE FILE ROBOTS.TXT
$fp = fopen('../robots.txt', 'w+');

fputs ($fp,'User-agent: *'."\n");
fputs ($fp,'Disallow:'."\n\n");

fputs ($fp,'# Internet Archiver Wayback Machine'."\n");
fputs ($fp,'User-agent: ia_archiver'."\n");
fputs ($fp,'Disallow: /'."\n\n");

fputs ($fp,'# Does anyone care I love Google Apache htaccess'."\n");
fputs ($fp,'Sitemap: http://'.$_SERVER['HTTP_HOST'].'/sitemap.xml'."\n\n");

fclose($fp);
//CREAZIONE FILE ROBOTS.TXT



//INSTALLAZIONE DATABASE
include "../config.php";
//connessione al database
$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
//selezione del database
mysql_select_db($database) or die ("Non riesco a selezionare il database");
//database
$filename = "database.php";
//apre il file
$handle=fopen($filename,"r");
//lettura del file
$contents = fread($handle, filesize($filename));
//divido le query
$sql=explode(";",$contents);
$fine=count($sql)-1;
for($i=0; $i<$fine; $i++){
	//query di creazione
	mysql_query($sql[$i].";") or die ("Creazione tabelle del DB fallita");
}
//chiusura file
fclose($handle);


//AGGIUNGO L'AMMINISTRATORE DI S-ADMIN
mysql_query("INSERT INTO `utenti` (`user`, `psw`, `email`, `admin`) VALUES ('".$_POST['nomeutente']."', '".$_POST['password']."', '".$_POST['emailsito']."', 1)");

//chiusura db
mysql_close($db);

//Permessi cartelle
@chmod("../upload", 0777);
@chmod("../upload/marche", 0777);
@chmod("../banner", 0777);
@chmod("../gestioneimmaginipreventivi", 0777);
@chmod("../preventiviinviati", 0777);
@chmod("../tmpimmagini", 0777);

//FINE
?>	
