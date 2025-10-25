<?php
// config
include "config.php";
//connessione al database
$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
//selezione del database
mysql_select_db($database) or die ("Non riesco a selezionare il database");
//Ricavo l'ultima data in cui è stata generata la sitemap
$querysitemap=mysql_query("select data from sitemap") or die ("Query data non eseguita!");
//ultima data
$datasitemap=@mysql_result($querysitemap,0,0);
//data sistema
$datasistema=date("Y-m-d");

//Se la data nel db è diversa da quella del sistema aggiorna la sitemap e la data nel db
if($datasistema!=$datasitemap){
	
	//query di aggiornamento della data della sitemap nel db
	$queryagg = mysql_query("Update sitemap set data='".$datasistema."' where id='1'") or die("La query di aggiornamento della data della sitemap non è stata eseguita");
	
	// genera sitemap wpannel
	$fp = fopen('sitemap.xml', 'w+');
	fwrite($fp, '<?xml version="1.0" encoding="UTF-8"?><?xml-stylesheet type="text/xsl" href="http://'.$_SERVER["HTTP_HOST"].'/sitemap.xsl"?><!-- generator="wadmin" -->'.chr(13));
	fwrite($fp,'<!-- sitemap-generator-url="https://arkosoft.it" sitemap-generator-version="3.2.2" -->'.chr(13));
	fwrite($fp,'<!-- generated-on="'.date("d F Y")." ".date("h:i").'" -->'.chr(13));
	fwrite($fp,'<!-- Debug: Total comment count: 12186 -->'.chr(13));
	fwrite($fp,'<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"><url>'.chr(13));
	fwrite($fp,'<loc>http://'.$_SERVER["HTTP_HOST"].'/</loc>'.chr(13));
	fwrite($fp,'<lastmod>'.date("Y-m-d")."T".date("h:i:s")."+00:00".'</lastmod>'.chr(13));
	fwrite($fp,'<changefreq>always</changefreq>'.chr(13));
	fwrite($fp,'<priority>1.0</priority>'.chr(13));
	fwrite($fp,'</url>'.chr(13));
 

	//registrati
	fwrite($fp,"<url>".chr(13));
	$url = "http://".$_SERVER["HTTP_HOST"]."/registrati.html";
	fwrite($fp,"<loc>".$url."</loc>".chr(13));
	fwrite($fp,"<lastmod>".date("Y-m-d")."T".date("h:i:s")."+00:00"."</lastmod>".chr(13));
	fwrite($fp,"<changefreq>monthly</changefreq>".chr(13));
	$priority = "0.1";
	fwrite($fp,"<priority>".$priority."</priority>".chr(13));
	fwrite($fp,"</url>".chr(13));
	
	// chi siamo
	fwrite($fp,"<url>".chr(13));
	$url = "http://".$_SERVER["HTTP_HOST"]."/azienda.html";
	fwrite($fp,"<loc>".$url."</loc>".chr(13));
	fwrite($fp,"<lastmod>".date("Y-m-d")."T".date("h:i:s")."+00:00"."</lastmod>".chr(13));
	fwrite($fp,"<changefreq>monthly</changefreq>".chr(13));
	$priority = "0.5";
	fwrite($fp,"<priority>".$priority."</priority>".chr(13));
	fwrite($fp,"</url>".chr(13));
	
	// contattaci
	fwrite($fp,"<url>".chr(13));
	$url = "http://".$_SERVER["HTTP_HOST"]."/contattaci.html";
	fwrite($fp,"<loc>".$url."</loc>".chr(13));
	fwrite($fp,"<lastmod>".date("Y-m-d")."T".date("h:i:s")."+00:00"."</lastmod>".chr(13));
	fwrite($fp,"<changefreq>monthly</changefreq>".chr(13));
	$priority = "0.1";
	fwrite($fp,"<priority>".$priority."</priority>".chr(13));
	fwrite($fp,"</url>".chr(13));
	
	// marche
	fwrite($fp,"<url>".chr(13));
	$url = "http://".$_SERVER["HTTP_HOST"]."/marche.html";
	fwrite($fp,"<loc>".$url."</loc>".chr(13));
	fwrite($fp,"<lastmod>".date("Y-m-d")."T".date("h:i:s")."+00:00"."</lastmod>".chr(13));
	fwrite($fp,"<changefreq>monthly</changefreq>".chr(13));
	$priority = "0.1";
	fwrite($fp,"<priority>".$priority."</priority>".chr(13));
	fwrite($fp,"</url>".chr(13));
	
	// categorie
	fwrite($fp,"<url>".chr(13));
	$url = "http://".$_SERVER["HTTP_HOST"]."/categorie.html";
	fwrite($fp,"<loc>".$url."</loc>".chr(13));
	fwrite($fp,"<lastmod>".date("Y-m-d")."T".date("h:i:s")."+00:00"."</lastmod>".chr(13));
	fwrite($fp,"<changefreq>monthly</changefreq>".chr(13));
	$priority = "0.1";
	fwrite($fp,"<priority>".$priority."</priority>".chr(13));
	fwrite($fp,"</url>".chr(13));
	
	// stampa le categorie
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	mysql_select_db($database) or die ("Non riesco a selezionare il database");
	$objcat = mysql_query("select * from categorie");
	while($dato=mysql_fetch_array($objcat)){
		fwrite($fp,"<url>".chr(13));
		$lista="http://".$_SERVER["HTTP_HOST"].calcolonomecategoria($dato[0]);
		fwrite($fp,"<loc>".$lista."</loc>".chr(13));
		fwrite($fp,"<lastmod>".date("Y-m-d")."T".date("h:i:s")."+00:00"."</lastmod>".chr(13));
		fwrite($fp,"<changefreq>monthly</changefreq>".chr(13));
		$priority = "0.1"; 
		fwrite($fp,"<priority>".$priority."</priority>".chr(13));
		fwrite($fp,"</url>".chr(13));
	}
	mysql_close($db);
	//fine categorie
	
	// stampa i prodotti la index
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	mysql_select_db($database) or die ("Non riesco a selezionare il database");
	$obj = mysql_query("select * from prodotti");	
	while($data=mysql_fetch_array($obj)){
		fwrite($fp,"<url>");
		$titolo = puliscistring($data['titolo']);
		$idcategoria = $data['idcategoria'];
		$objcategoria = mysql_query("select nome from categorie where id=".$idcategoria);
		$categoria  = strtolower(puliscistring(@mysql_result($objcategoria,0,0)));
		$url = "http://".$_SERVER["HTTP_HOST"]."/".$categoria."/".$titolo."-".$data['id']."/index.html";
		fwrite($fp,"<loc>".$url."</loc>".chr(13));
		fwrite($fp,"<lastmod>".date("Y-m-d")."T".date("h:i:s")."+00:00"."</lastmod>".chr(13));
		fwrite($fp,"<changefreq>monthly</changefreq>".chr(13));
		// gestione della priorità!
		$priority = "0.1"; 
		fwrite($fp,"<priority>".$priority."</priority>".chr(13));
		fwrite($fp,"</url>".chr(13));
	}
	mysql_close($db);
	
	
	// pagina  autogenerante del catalogo
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	mysql_select_db($database) or die ("Non riesco a selezionare il database");
	$count = mysql_query("select count(*) from prodotti");	
	mysql_close($db);
	$totale = ceil(mysql_result($count,0,0) / 6);

	for ($start = 0; $start < $totale; $start++){ 
		$con=$start+1;
		fwrite($fp,"<url>".chr(13));
		$url = "http://".$_SERVER["HTTP_HOST"]."/index.html?page=".$con;
		fwrite($fp,"<loc>".$url."</loc>".chr(13));
		fwrite($fp,"<lastmod>".date("Y-m-d")."T".date("h:i:s")."+00:00"."</lastmod>".chr(13));
		fwrite($fp,"<changefreq>monthly</changefreq>".chr(13));
		$priority = "0.1";
		fwrite($fp,"<priority>".$priority."</priority>".chr(13));
		fwrite($fp,"</url>".chr(13));
	}
	fwrite($fp,"</urlset>".chr(13));
	fclose($fp);
	@exec("system sitemap.xml");
}
?>