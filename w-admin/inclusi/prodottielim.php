<?
	if(isset($_GET['elim']) and strlen($_GET['elim'])>0){
		$percorsosave=$_SERVER['DOCUMENT_ROOT']."/upload";
		//connessione al database
		$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
		//selezione del database
		mysql_select_db($database) or die ("Non riesco a selezionare il database");
		//immagini del prodotto
		$queryimg="select imgmin,imgmax from prodotti,immagini where prodotti.id=idprodotto and idprodotto='".$_GET['elim']."'";
		$risult=mysql_query($queryimg) or die ("Query: ".$queryimg." non eseguita!");
		while($db_img=mysql_fetch_array($risult)){
			@unlink($percorsosave."/".$db_img[0]);
			@unlink($percorsosave."/".$db_img[1]);
		}
		//eliminazione nella tabella immagini
		mysql_query("DELETE FROM immagini where idprodotto='".$_GET['elim']."'");
		//eliminazione nella tabella prodotto
		mysql_query("DELETE FROM prodotti where id='".$_GET['elim']."'");
		//eliminazione nella tabella offerte
		mysql_query("DELETE FROM offerte where idprodotto='".$_GET['elim']."'");
		//eliminazione nella tabella prodottivendita
		mysql_query("DELETE FROM prodottivendita where idprodotto='".$_GET['elim']."'");
		//eliminazione nella tabella avanzate
		mysql_query("DELETE FROM avanzate where idprodotto='".$_GET['elim']."'");
		//eliminazione nella tabella misure
		mysql_query("DELETE FROM misure where idprodotto='".$_GET['elim']."'");
		//eliminazione nella tabella prezzi
		mysql_query("DELETE FROM prezzi where idprodotto='".$_GET['elim']."'");
		//eliminazione nella tabella ultimi mobili
		mysql_query("DELETE FROM ultimimobili where idprodotto='".$_GET['elim']."'");
		//eliminazione nella tabella assegnazionecategorie
		mysql_query("DELETE FROM assegnazionecategorie where idprodotto='".$_GET['elim']."'");
		//Elimino prodotti simili
		mysql_query("DELETE FROM prodottisimili where idprodotto='".$_GET['elim']."' or idsimile='".$_GET['elim']."'");
	}
?>