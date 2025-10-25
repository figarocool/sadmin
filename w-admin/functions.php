<?

//CONTROLLO SE ESISTE UNA TABELLA
function esistetabella($database,$tabella,$connesso){
	if($connesso==1){
		include "../config.php";
		$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
		mysql_select_db($database) or die ("Non riesco a selezionare il database");
	}
	$sql = "SHOW TABLES FROM `$database`";
	$result = mysql_query($sql);
	while ($row = mysql_fetch_row($result)) {
		if($row[0]==$tabella){
			return true;
			break;
		}
	}
	return false;
}



//Crea query per il modulo gestionepriorita
function creaqueryprorita(){
	//prendo i valori nella tabella gestionepriorita
	$querypriorita=mysql_query("select * from gestionepriorita") or die ("Query gestionepriorita non eseguita!");
	//conto i risultati
	$righepriorita=mysql_num_rows($querypriorita);
	$cont=0;
	$queryx='';
	$queryy='';
	//Se esistono prodotti in priorità crea la query altrimenti stampa i prodotti normalmente
	if($righepriorita>0){
		while($datap=mysql_fetch_array($querypriorita)){
			switch ($datap[2]) {
				case "categorie":
				if($cont==0){ $unione=" where "; }else{ $unione=" or ";  }
				$queryx.=$unione." idcategoria='".$datap[1]."' ";
				$queryy.=$unione." idcategoria!='".$datap[1]."' ";
				break;
				
				case "marche":
				if($cont==0){ $unione=" where "; }else{ $unione=" or ";  }
				$queryx.=$unione." idmarca='".$datap[1]."' ";
				$queryy.=$unione." idmarca!='".$datap[1]."' ";
				break;
				
				case "prodotti":
				if($cont==0){ $unione=" where "; }else{ $unione=" or ";  }
				$queryx.=$unione." prodotti.id='".$datap[1]."' ";
				$queryy.=$unione." prodotti.id!='".$datap[1]."' ";
				break;
			}
			$cont=$cont+1;
		}
		return Array($queryx,$queryy);
	}else{
		return Array();
	}	
}

//FUNZIONE PER FAR USCIRE I PRODOTTI APPARTENENTI ALLE SOTTOCATEGORIE ANCHE NELLA CATEGORIA MADRE
function querycategorie($idcategoria, $counter){
	$query=sottoc($idcategoria,1,'0');
	return $query; 
}
function sottoc($idchk,$counter,$lista){
	$ris=mysql_query("select * FROM categorie Where appartenenza ='".$idchk."';");
	if($lista=='0'){
		$lista=" where idcategoria='".$idchk."'";
	}else{
		$lista.=" or idcategoria='".$idchk."'";
	}	
	while($data=mysql_fetch_array($ris)){ $lista = sottoc($data[0],($counter+1), $lista); }		
	return $lista;	
}
//FINE FUNZIONE

//Calcolo il percorso della categoria
function calcolonomecategoria($idcategoria){
	$f=percorsoalberog($idcategoria,0);
	$lista=array_reverse($f);
	$lista2="/".implode("/",$lista)."/categorie.html";
	return $lista2;
}

function percorsoalberog($idchk,$counter){
	global $f;
	$ris=mysql_query("select * FROM categorie Where id='".$idchk."';");
	while($data=mysql_fetch_array($ris)){  
		$counter=$counter+1;
		if($data[2]!=0){
			$f[$counter] = strtolower(puliscistring(titles($idchk)))."-".$idchk;
			percorsoalberog($data[2],$counter); 
		}else{
			$f[$counter] = strtolower(puliscistring(titles($idchk)))."-".$idchk;
		}	
	}
	return $f;
}


/*visualizzazione esterna lista*/
function visualizzacategorie1($tipo, $sito, $nomeclasse){
	//Ricavo tutte le categorie
	$q=mysql_query("select * from categorie where appartenenza ='0'") or die ("Query: select non eseguita!");
	$record=mysql_num_rows($q);
	if($record>0){
		if($tipo=="0"){
			//Stampo tutti i risultati
			while($data=mysql_fetch_array($q)){
				menualberoesterno($data[0],1,$nomeclasse);
			}
		}
		return $lista;
	}else{
		print "Nessuna Categorie inserita";
	}
}	

function rientranza($counter){
	for ($start = 1; $start < $counter; $start++){
		 $pixel= $pixel+20; 
	}
	return $pixel;
}

//categorie
function menualberoesterno($idchk,$counter,$nomeclasse){
		$ris=mysql_query("select * FROM categorie Where appartenenza ='".$idchk."';");
		//$f=percorsoalberog($idchk,0);
		//$lista=array_reverse($f);
		$lista=$sito.calcolonomecategoria($idchk);
?>		<li class="<?php print $nomeclasse; ?>"><div style="padding-left: <? print rientranza($counter); ?>px;"><a href="<?php print $lista; ?>" title="<? print "Permalink a ".titles($idchk); ?>"><? print titles($idchk); ?></a></div></li>
<?		while($data=mysql_fetch_array($ris)){ menualberoesterno($data[0],($counter+1),$nomeclasse); }		 
 
}	

/*Elimino i file temporanei dei preventivi*/
function eliminafile(){
	$dir=$_SERVER['DOCUMENT_ROOT']."/tmpimmagini/";
	// Open a known directory, and proceed to read its contents
	if (is_dir($dir)) {
		if ($dh = opendir($dir)) {
			while (($file = readdir($dh)) !== false) {
				$array.=$file.",";
			}
			closedir($dh);
		}
	}
	$array=explode(",",$array);
	for($i=0; $i<count($array); $i++){
		@unlink($dir.$array[$i]);
	}
}	
/*fine eliminazione*/


/*formattazione prezzo*/
function sistemaprezzo($prezzo){
	if(strlen($prezzo)>0){
		$divisione=explode(".",$prezzo);
		$invertostringa=strrev($divisione[0]);
		$finefor=strlen($invertostringa);
		$cont=0;
		for($i=0; $i<$finefor; $i++){
			$cont=$cont+1;
			if( $cont % 4 == 0 ){
				// Se è un multiplo di 3
				$cifre.=".".$invertostringa[$i];
			}else{
				$cifre.=$invertostringa[$i];
			}
		}
		$risultato=strrev($cifre).","."<span style=\"font-size: 14px;\">".$divisione[1]."</span>";
		return $risultato;
	}	
}
/*fine formattazione prezzo*/


	//FUNZIONE RESIZE	
function resize($src,$dst,$dstw,$dsth,$scala,$percorsosave) {

	$src = $percorsosave.$src;
	$dst = $percorsosave.$dst;
	list($width, $height, $type, $attr) = getimagesize($src);
    switch($type){
      case 1:$im = imagecreatefromgif($src);break;
      case 2:$im = imagecreatefromjpeg($src);break;
      case 3:$im = imagecreatefrompng($src);break;
      case 8:$im = imagecreatefromwbmp($src);break;
      default:break;
    }
	If ($dstw == "0" && $dsth == "0") { 
			$dstw = $width;
			$dsth = $height;
	}
	switch($scala){
		//scala in base alla lunghezza
		case 1:
			$dsth=($height*$dstw)/$width;
			break;
		//scala in base all'altezza
		case 2:
			$dstw=($width*$dsth)/$height;
			break;
		default:break;
	};
	$tim = imagecreatetruecolor($dstw,$dsth);	
    imagesavealpha($tim,true);
    imagealphablending($tim,false);
    imagecopyresampled($tim,$im,0,0,0,0,$dstw,$dsth,$width,$height);
    ImageJPEG($tim,$dst,90);
    imagedestroy($tim);
}

	//CREA TITOLO PAGINA
	function titlepagina($read){
		include "config.php"; 
		$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
		mysql_select_db($database) or die ("Non riesco a selezionare il database");
		$newurl = explode("/",$_SERVER['REQUEST_URI']);
		if(count($newurl)==3){ 
			$idfind = explode("-",$newurl[1]);	
			$sel = array_pop($idfind);
			$ris=mysql_query("select * FROM marche Where  id='".$sel."';");
			$contamarche=mysql_num_rows($ris);
			if($contamarche>0){	
				$titmarca=strtolower(str_replace("\'","'",mysql_result($ris,0,1)));
				$titolo=$titolosito." vi presenta ".strtoupper($titmarca)." una delle nostre migliori marche";
			}else{
				$titolo="HTTP Status 404 - Pagina non Trovata";
			}	
		}
		if(count($newurl)==4 and strstr($_SERVER['REQUEST_URI'],"/categorie.html") == "" ){
			$idfind = explode("-",$newurl[2]);	
			$sel = array_pop($idfind);
			$ris=mysql_query("select * FROM prodotti Where  id='".$sel."';");
			$idcat=@mysql_result($ris,0,3);
			$nomeprod=@mysql_result($ris,0,1);
			$rism=mysql_query("select * FROM marche Where  id='".$idcat."';");
			$contamarche1=mysql_num_rows($rism);
			if($contamarche1>0){	
				$titmarca=strtolower(str_replace("\'","'",mysql_result($rism,0,1)));
				$titolo="Dalla collezione ".strtoupper($titmarca)." vi presentiamo ".$nomeprod;
			}else{
				$titolo="HTTP Status 404 - Pagina non Trovata";
			}	
		}
		if(count($newurl)==4 and strstr($_SERVER['REQUEST_URI'],"/categorie.html") <> "" ){
			$idfind = explode("-",$newurl[2]);		
			$nomemarca = $idfind[0];
			$titolo=$titolosito." vi presenta la collezione suddivisa per ".strtolower($nomemarca);	
		}
		if(count($newurl)==5){
			$idfind = explode("-",$newurl[3]);	
			$sel = array_pop($idfind);
			$ris=mysql_query("select * FROM prodotti Where  id='".$sel."';");
			$idcat=@mysql_result($ris,0,3);
			$nomeprod=@mysql_result($ris,0,1);
			$rism=mysql_query("select * FROM marche Where  id='".$idcat."';");
			$contamarche1=mysql_num_rows($rism);
			if($contamarche1>0){	
				$titmarca=strtolower(str_replace("\'","'",mysql_result($rism,0,1)));
				$titolo="Dalla collezione ".strtoupper($titmarca)." vi presentiamo ".$nomeprod;
			}else{
				$titolo="HTTP Status 404 - Pagina non Trovata";
			}
		}
		if(strstr($_SERVER['REQUEST_URI'],"/offerte.html")){
			$titolo=$titolosito." vi offre le sue Offerte speciali";
		} 
		if(strstr($_SERVER['REQUEST_URI'],"/ricercavanzata.html")){
			$titolo="Ricerca avanzata";
		} 
		if($_SERVER['REQUEST_URI']=="/" or $_SERVER['REQUEST_URI']=="/index.html"){
			$titolo=$titolosito;
		}
		if(strstr($_SERVER['REQUEST_URI'],"error404.html")){
			$titolo="HTTP Status 404 - Pagina non Trovata";
		}
		if(strstr($_SERVER['REQUEST_URI'],"registrati.html") or strstr($_SERVER['REQUEST_URI'],"registrazionedb")){
			$titolo="Registrati su ".$titolosito;
		}
		if(strstr($_SERVER['REQUEST_URI'],"contattaci.html")){
			$titolo=$titolosito." - Modulo contattaci";
		}
		if(strstr($_SERVER['REQUEST_URI'],"azienda.html")){
			$titolo=$titolosito;
		}

		if(strstr($_SERVER['REQUEST_URI'],"leggeprivacy.html")){
			$titolo="Legge Privacy su ".$titolosito;
		}
		return $titolo;
	}
	//FINE TITOLO PAG

	//Pulisci testo
	function puliscitesto($read){
		$risultato=str_replace(chr(92).'"','"',$read);
		$risultato1=str_replace(chr(92)."'","'",$risultato);
		$risultato2=str_replace(chr(92),"",$risultato1);
		
		return $risultato2;
	}
	
	//PULISCI URL
	function puliscistring($read){
		$a=str_replace(" ","-",$read);
		$b1=str_replace("'","",$a);
		$b=str_replace(chr(92),"",$b1);
		$c=str_replace("à","a",$b);
		$d=str_replace("è","e",$c);
		$e=str_replace("ì","i",$d);
		$f=str_replace("ò","o",$e);
		$g=str_replace("ù","u",$f);
		$h=str_replace("/","",$g);
		$i=str_replace(".","",$h);
		$l=str_replace(")","",$i);
		$m=str_replace(",","",$l);
		$n=str_replace("&","",$m);
		$o=str_replace("é","e",$n);
		return $o;
	}
	//FINE PULISCI URL

	//RECUPERA STRINGA URL ORIGINALE
	function recuperastring($read){
		$a=str_replace("-"," ",$read);
		$b1=str_replace("'","",$a);
		return $a;
	}
	
	//VISUALIZZAZIONE MESE
	function visualizzamese($read){
		switch($read){
			case "01":
			$read="Gennaio";
			break;
			
			case "02":
			$read="Febbraio";
			break;
			
			case "03":
			$read="Marzo";
			break;

			case "04":
			$read="Aprile";
			break;

			case "05":
			$read="Maggio";
			break;

			case "06":
			$read="Giugno";
			break;

			case "07":
			$read="Luglio";
			break;

			case "08":
			$read="Agosto";
			break;

			case "09":
			$read="Settembre";
			break;

			case "10":
			$read="Ottobre";
			break;

			case "11":
			$read="Novembre";
			break;

			case "12":
			$read="Dicembre";
			break;	
		}
		return $read;
	}
	
	/*fine cerca*/
	
	
	//visualizzare la pagina corrente
	function visualizzapagina($read){
		
		$solourl=explode("?",$read);
		if(count($solourl)>0){ $read = $solourl[0];} 
		
		$newurl  = explode("/",$read);
		$variabile=array($read,$newurl);

		switch($variabile){
						
			case $variabile[0]=="/categorie.html" and count($variabile[1])==2:
			$read="contenuto-categorie.php";
			break;
			
			case in_array("categorie.html",$newurl)==true:
			$read="categorie.php";
			break;
			
			
			case in_array("marche.html",$newurl)==true:
			$read="contenuto-marche.php";
			break;
			
			case count($variabile[1])==3:
			$read="marche.php";
			break;
			
			case $variabile[0]=="/attivazione.html":
			$read="attivazione.php";
			break;
			
			case $variabile[0]=="/prodotti.html":
			$read="prodotti.php";
			break;
			
			case $variabile[0]=="/attivazione.php":
			$read="attivazione.php";
			break;
					
			case $variabile[0]=="/index.html":
			$read="contenuto.php";
			break;
			
			case $variabile[0]=="/leggeprivacy.html":
			$read="leggeprivacy.php";
			break;
			
			case $variabile[0]=="/":
			$read="contenuto.php";
			break;
			
			case count($variabile[1])==4:
			$read="schedatecnica.php";
			break;
			
			case count($variabile[1])==5:
			$read="schedatecnica.php";
			break;
								
			case $variabile[0]=="/ricerca.html":
			$read="ricerca.php";
			break;
			
			case $variabile[0]=="/registrati.html":
			$read="registrati.php";
			break;
						
			case $variabile[0]=="/registrazionedb.html":
			$read="registrazionedb.php";
			break;
						
			case $variabile[0]=="/azienda.html":
			$read="azienda.php";
			break;
			
			case $variabile[0]=="/contattaci.html":
			$read="contattaci.php";
			break;
			
			case $variabile[0]=="/inviorichiesta.html":
			$read="inviorichiesta.php";
			break;
						
			case $variabile[0]=="/preventivo.html":
			$read="logpreventivo.php";
			break;
	
			default:
			$read="error404.php";	
		}
		return $read;
}

//Titolo categoria per tema esterno
function titles($id){
	//Controllo se è una pagina del sistema o meno
	if(strstr($_SERVER['SCRIPT_NAME'],"/tema/")){
		include "../config.php";
	}else{
		include "config.php";
	}	
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	mysql_select_db($database) or die ("Non riesco a selezionare il database");
	$ris=mysql_query("select * FROM `categorie` Where  id  ='".$id."';");
	return mysql_result($ris,0,1);
}

//Titolo categoria per s-admin
function titles1($id){
	include "../config.php"; 
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	mysql_select_db($database) or die ("Non riesco a selezionare il database");
	$ris=mysql_query("select * FROM `categorie` Where  id  ='".$id."';");
	return mysql_result($ris,0,1);
}

function stella($counter){
	for ($start = 1; $start < $counter; $start++){
		 $stella .= "+"; 
	}
	return $stella;
}
	
	//Stampa gli ID delle categorie e sottocategorie
	function percorsoalberoid($idchk,$counter){
		global $f;
		include "../config.php";
		$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
		//selezione del database
		mysql_select_db($database) or die ("Non riesco a selezionare il database");
		$ris=mysql_query("select * FROM categorie Where id='".$idchk."';");
		while($data=mysql_fetch_array($ris)){  
			$counter=$counter+1;
			if($data[2]!=0){
				$f[$counter] = strtolower(puliscistring(idcat($idchk)));
				percorsoalberoid($data[2],$counter); 
			}else{
				$f[$counter] = strtolower(puliscistring(idcat($idchk)));
			}	
		}
		return $f;
	}
	
function controlloalbero($idchk,$counter){
	include "../config.php";
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	mysql_select_db($database) or die ("Non riesco a selezionare il database");
	 
	$ris=mysql_query("select * FROM `categorie` Where appartenenza ='".$idchk."';");
 
?> <option value="<? print $idchk; ?>"><? print  stella($counter).titles1($idchk); ?></option>
<?	while($data=mysql_fetch_array($ris)){ controlloalbero($data[0],($counter+1)); }		 
}


//Stampo le categorie nel pannello S-Admin
function categoriesadmin($idchk,$counter){
	include "../config.php";
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	mysql_select_db($database) or die ("Non riesco a selezionare il database");
	$ris=mysql_query("select * FROM `categorie` Where appartenenza ='".$idchk."';");
?> 	<option value="<? print $idchk; ?>"><? print  stella($counter).titles1($idchk); ?></option>
	<script>
		lista.push("<?php print titles1($idchk); ?>");
	</script>
<?	while($data=mysql_fetch_array($ris)){ categoriesadmin($data[0],($counter+1)); }		 
}

//Stampo le categorie nel tema esterno
function categorietema($idchk,$counter,$taghtml){
	include "../config.php";
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	mysql_select_db($database) or die ("Non riesco a selezionare il database");
	
	$ris=mysql_query("select * FROM `categorie` Where appartenenza ='".$idchk."';");
 
	print  $taghtml.stella($counter).titles1($idchk); ?></option>
<?	while($data=mysql_fetch_array($ris)){ categorietema($data[0],($counter+1)); }		 
}

//Stampo le categorie madri nel tema esterno
function stampocategorie($appartenenza){
	//Controllo se è una pagina del sistema o meno
	if(strstr($_SERVER['SCRIPT_NAME'],"/tema/")){
		include "../config.php";
	}else{
		include "config.php";
	}	
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	mysql_select_db($database) or die ("Non riesco a selezionare il database");
	
	//Seleziono tutte le categorie madri
	$ris=mysql_query("select * FROM `categorie` Where appartenenza ='".$appartenenza."';");
	$record=mysql_num_rows($ris);
	if($record>0){
		while($data=mysql_fetch_array($ris)){
			$link="http://".$_SERVER['HTTP_HOST'].calcolonomecategoria($data[0]);
			$lista[]=Array($data[0],titles($data[0]),$link);
		}	
		return $lista;
	}	
}
 
 function controlloalberoselezionato($idchk,$counter,$selezionato){
		include "config.php";
		$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
		mysql_select_db($database) or die ("Non riesco a selezionare il database");
	 
		$ris=mysql_query("select * FROM `categorie` Where appartenenza ='".$idchk."';");
 
		 ?> <option value="<? print $idchk; ?>" <? if($idchk==$selezionato){ print "selected"; } ?> ><? print  stella($counter).titles($idchk); ?></option>
		<?
		while($data=mysql_fetch_array($ris)){ controlloalberoselezionato($data[0],($counter+1),$selezionato); }
		 
}
 
	function imgf($read){
		$t = explode("/",$read);
		for ($start = 0; $start < count($t); $start++){
					if ($start == 0){
						$f .= $t[$start]; 
					} else {
						if ($start == count($t)-1){				
							$f .= "/min-".$t[$start];
						} else {
							$f .= "/".$t[$start];
						}
					 }
		}
		return $f;
	}


//PULIZIA tag html
function puliziatag($read){
	$salta = false;
	for ($start = 0; $start <= strlen($read); $start++){
		if (substr($read,0,$start) == "<"){ $salta = true; }
		if (substr($read,0,$start) == ">"){ $salta = false;}
		if ($salta == false){ $totale .= substr($read,$start,1); }  
	}
	return $totale;
}

//riduce il testo a un numero stabilito di caratteri e lo interrompe con i puntini ...
function riducitesto($testo,$caratteri){
		if(strlen($testo)>$caratteri){
			$risultato=substr($testo,0,$caratteri)."[...]";
		}else{
			$risultato=$testo;
		}
		
	print puliscitesto(strip_tags($risultato));
}

//prezzo ivato con stampa
function totaleivato($prezzo,$iva,$approssima){
	$totaleivato=(($prezzo*$iva)/100)+$prezzo;
	$posizionepunto=strpos($totaleivato,".");
	$cifre=strlen(substr($totaleivato,($posizionepunto+1)));
	$centesimi=($posizionepunto+3);
	$decimi=$posizionepunto+2;
	if($approssima=="si"){
		if($posizionepunto==""){
			$totaleivato=$totaleivato.".00";
		}else{
			if($posizionepunto=="2"){
				$totaleivato=substr($totaleivato,0,$decimi)."0";
			}else{
				if(substr($totaleivato,0,($centesimi+1))>5){
					$totaleivato=(substr($totaleivato,0,$centesimi))+0.01;
				}else{
					$totaleivato=substr($totaleivato,0,$centesimi);
				}
			}
		}
		if(strpos($totaleivato,".")==""){
			$totaleivato=$totaleivato.".00";
		}
	}else{
		$totaleivato=substr($totaleivato,0,($posizionepunto+3));
		if($posizionepunto==""){
			$totaleivato=$totaleivato.".00";
		}else{
			if($cifre==1){
				$totaleivato=substr($totaleivato,0,$decimi)."0";
			}
		}	
	}	
	print $totaleivato." Euro";
}

//prezzo ivato senza stampa
function totaleivato2($prezzo,$iva,$approssima){
	$totaleivato=(($prezzo*$iva)/100)+$prezzo;
	$posizionepunto=strpos($totaleivato,".");
	$cifre=strlen(substr($totaleivato,($posizionepunto+1)));
	$centesimi=($posizionepunto+3);
	$decimi=$posizionepunto+2;
	if($approssima=="si"){
		if($posizionepunto==""){
			$totaleivato=$totaleivato.".00";
		}else{
			if($posizionepunto=="2"){
				$totaleivato=substr($totaleivato,0,$decimi)."0";
			}else{
				if(substr($totaleivato,0,($centesimi+1))>5){
					$totaleivato=(substr($totaleivato,0,$centesimi))+0.01;
				}else{
					$totaleivato=substr($totaleivato,0,$centesimi);
				}
			}
		}
		if(strpos($totaleivato,".")==""){
			$totaleivato=$totaleivato.".00";
		}
	}else{
		$totaleivato=substr($totaleivato,0,($posizionepunto+3));
		//print $totaleivato;
		if($posizionepunto==""){
			$totaleivato=$totaleivato.".00";
		}else{
			if($cifre==1){
				$totaleivato=substr($totaleivato,0,$decimi)."0";
			}
		}	
	}	
	return $totaleivato;
}

//prezzo con approsimazione
function decimale($prezzo,$approssima){
	$posizionepunto=strpos($prezzo,".");
	$cifre=strlen(substr($prezzo,($posizionepunto+1)));
	$centesimi=($posizionepunto+3);
	$decimi=$posizionepunto+2;
	if($approssima=="si"){
		if($posizionepunto==""){
			$prezzo=$prezzo.".00";
		}else{
			if($posizionepunto=="2"){
				$prezzo=substr($prezzo,0,$decimi)."0";
			}else{
				if(substr($prezzo,0,($centesimi+1))>5){
					$prezzo=(substr($prezzo,0,$centesimi))+0.01;
				}else{
					$prezzo=substr($prezzo,0,$centesimi);
				}
			}
		}
		if(strpos($prezzo,".")==""){
			$prezzo=$prezzo.".00";
		}
	}else{
		$prezzo=substr($prezzo,0,($posizionepunto+3));
		//print $totaleivato;
		if($posizionepunto==""){
			$prezzo=$prezzo.".00";
		}else{
			if($cifre==1){
				$prezzo=substr($prezzo,0,$decimi)."0";
			}
		}	
	}	
	return $prezzo;
}

function puliziapage($read){
	$t = explode("&page=",$read);
	if (count($t) > 1) {
		return $t[0];
	} else {
		$t = explode("?page=",$read);
		return  $t[0];
	}
}

function divisioneprodotti($corrente,$fine){
	if($_SERVER['REQUEST_URI']=="/"){
		$paginaurl="/index.html";
	}else{
		$paginaurl=$_SERVER['REQUEST_URI'];
	}
	if(strlen($_SERVER['QUERY_STRING'])>0 and strstr($_SERVER['HTTP_HOST'].$paginaurl,"?page=")==false){
		$percorso=puliziapage("http://".$_SERVER['HTTP_HOST'].$paginaurl)."&";
	}else{
		$percorso=puliziapage("http://".$_SERVER['HTTP_HOST'].$paginaurl)."?";
	}
	
	
	
	if($fine>7){
		print "<a href='".$percorso."page=0' title='Inizio' class='altrilink'>Inizio </a>".chr(126);
	}
	if($fine>0){
		print " Pagina: ";
	}	
	
	if(($corrente)>1 and $fine>7){
		print "<a href='".$percorso."page=".($corrente-1)."' title='Precedente' class='altrilink'>Indietro</a> ... ";
	}
	
	if($corrente>0){
		$a=$corrente;
	}else{
		$a=1;
	}
	$end=$a+6;
	if($end<=$fine){
		for($a;$a<=$end;$a++){
				if($a==($corrente+1)){
					print "<span class='linkcorrente'>".$a."</span>";
				}else{
					print "<a href='".$percorso."page=".($a-1)."' class='altrilink'>".$a."</a>";
				}	
		}
	}else{
	$e=($a+8)-$fine;
	$e=($corrente+2)-$e;
	if($e<0){
		$e=1;
	}
		for($e;$e<=$fine;$e++){
			if($e==($corrente+1)){
				print "<span class='linkcorrente'>".$e."</span>";
			}else{
				print "<a href='".$percorso."page=".($e-1)."' class='altrilink'>".$e."</a>";
			}
		}
	}
	if(($corrente+6)<=$fine){
		print " ... <a href='".$percorso."page=".($corrente+1)."' title='Successivo' class='altrilink'>Avanti</a>";
	}

}

/*registrazione utenti*/
function datanascita($giorno,$mese,$anno,$errore){
	if($giorno=="true"){
?>		<select name='giorno' id='giorno' size='1' <? if($errore=="true"){ print "class='error1'";}else{ print "class='input1'";} ?>>
			<option>--Giorno--</option>
			<option value='01'>01</option>
			<option value='02'>02</option>
			<option value='03'>03</option>
			<option value='04'>04</option>
			<option value='05'>05</option>
			<option value='06'>06</option>
			<option value='07'>07</option>
			<option value='08'>08</option>
			<option value='09'>09</option>
			<option value='10'>10</option>
			<option value='11'>11</option>
			<option value='12'>12</option>
			<option value='13'>13</option>
			<option value='14'>14</option>
			<option value='15'>15</option>
			<option value='16'>16</option>
			<option value='17'>17</option>
			<option value='18'>18</option>
			<option value='19'>19</option>
			<option value='20'>20</option>
			<option value='21'>21</option>
			<option value='22'>22</option>
			<option value='23'>23</option>
			<option value='24'>24</option>
			<option value='25'>25</option>
			<option value='26'>26</option>
			<option value='27'>27</option>
			<option value='28'>28</option>
			<option value='29'>29</option>
			<option value='30'>30</option>
			<option value='31'>31</option>
		</select>
		</label>&nbsp;<label>
<?	}
	if($mese=="true"){
?>		<select name='mese' size='1' <? if($errore=="true"){ print "class='error1'";}else{ print "class='input1'";} ?>>
			<option selected>--Mese--</option>
			<option value='01'>Gennaio</option>
			<option value='02'>Febbraio</option>
			<option value='03'>Marzo</option>
			<option value='04'>Aprile</option>
			<option value='05'>Maggio</option>
			<option value='06'>Giugno</option>
			<option value='07'>Luglio</option>
			<option value='08'>Agosto</option>
			<option value='09'>Settembre</option>
			<option value='10'>Ottobre</option>
			<option value='11'>Novembre</option>
			<option value='12'>Dicembre</option>
        </select>
		</label>&nbsp;<label>
<?	}
	if($anno=="true"){
	$anno=date("Y")-17;
?>	<select name='anno' size='1' <? if($errore=="true"){ print "class='error1'";}else{ print "class='input1'";} ?>>
<?		print "<option value='0'>--Anno--</option>";
		for($i=0; $i<=100; $i++){
			$anno=$anno-1;
			print "<option value='$anno'>$anno</option>";
		}
?>	</select>
<?	}	
}

function continente($continente){
	if($continente=="true"){
	print "<select name='continente' class='input'>
			<option>Seleziona Paese</option>
			<option>APO/FPO</option>
			<option>Afghanistan</option>
			<option>Albania</option>
			<option>Algeria</option>
			<option>Andorra</option>
			<option>Angola</option>
			<option>Anguilla</option>
			<option>Antigua e Barbuda</option>
			<option>Antille Olandesi</option>
			<option>Arabia Saudita</option>
			<option>Argentina</option>
			<option>Armenia</option>
			<option>Aruba</option>
			<option>Australia</option>
			<option>Austria</option>
			<option>Bahamas</option>
			<option>Bahrein</option>
			<option>Bangladesh</option>
			<option>Barbados</option>
			<option>Belgio</option>
			<option>Belize</option>
			<option>Benin</option>
			<option>Bermuda</option>
			<option>Bhutan</option>
			<option>Bielorussia</option>
			<option>Bolivia</option>
			<option>Bosnia e Herzegovina</option>
			<option>Botswana</option>
			<option>Brasile</option>
			<option>Brunei Darussalam</option>
			<option>Bulgaria</option>
			<option>Burkina Faso</option>
			<option>Burma</option>
			<option>Burundi</option>
			<option>Cambogia</option>
			<option>Camerun</option>
			<option>Canada</option>
			<option>Ciad</option>
			<option>Cile</option>
			<option>Cina</option>
			<option>Cipro</option>
			<option>Citt&iuml;&iquest;&frac12;del Vaticano</option>
			<option>Colombia</option>
			<option>Comoros</option>
			<option>Congo, Repubblica</option>
			<option>Congo, Repubblica Democratica</option>
			<option>Corea del Sud</option>
			<option>Costa d'Avorio</option>
			<option>Costa Rica</option>
			<option>Croazia, Repubblica</option>
			<option>Danimarca</option>
			<option>Dominica</option>
			<option>Ecuador</option>
			<option>Egitto</option>
			<option>El Salvador</option>
			<option>Emirati Arabi Uniti</option>
			<option>Eritrea</option>
			<option>Estonia</option>
			<option>Etiopia</option>
			<option>Federazione Russa</option>
			<option>Figi</option>
			<option>Filippine</option>
			<option>Finlandia</option>
			<option>Francia</option>
			<option>Gambia</option>
			<option>Georgia</option>
			<option>Germania</option>
			<option>Ghana</option>
			<option>Giamaica</option>
			<option>Giappone</option>
			<option>Gibilterra</option>
			<option>Gibuti</option>
			<option>Giordania</option>
			<option>Grecia</option>
			<option>Grenada</option>
			<option>Groenlandia</option>
			<option>Guadalupe</option>
			<option>Guam</option>
			<option>Guatemala</option>
			<option>Guernsey</option>
			<option>Guinea</option>
			<option>Guinea-Bissau</option>
			<option>Guinea Equatoriale</option>
			<option>Guyana</option>
			<option>Guyana Francese</option>
			<option>Haiti</option>
			<option>Honduras</option>
			<option>Hong Kong</option>
			<option>India</option>
			<option>Indonesia</option>
			<option>Irlanda</option>
			<option>Islanda</option>
			<option>Isole di Capo Verde</option>
			<option>Isole Cayman</option>
			<option>Isole Cook</option>
			<option>Isole Falkland (Islas Malvinas)</option>
			<option>Isole Marshall</option>
			<option>Isole Salomone</option>
			<option>Isole Turks e Caicos</option>
			<option>Isole Vergini Britanniche</option>
			<option>Isole Vergini (U.S.A.)</option>
			<option>Israele</option>
			<option>Italia</option>
			<option>Jan Mayen</option>
			<option>Jersey</option>
			<option>Kazakistan</option>
			<option>Kenya</option>
			<option>Kiribati</option>
			<option>Kuwait</option>
			<option>Kyrgyzstan</option>
			<option>Laos</option>
			<option>Lesotho</option>
			<option>Lettonia</option>
			<option>Libano</option>
			<option>Liberia</option>
			<option>Liechtenstein</option>
			<option>Lituania</option>
			<option>Lussemburgo</option>
			<option>Macao</option>
			<option>Macedonia</option>
			<option>Madagascar</option>
			<option>Malawi</option>
			<option>Maldive</option>
			<option>Malesia</option>
			<option>Mali</option>
			<option>Malta</option>
			<option>Marocco</option>
			<option>Martinica</option>
			<option>Mauritania</option>
			<option>Mauritius</option>
			<option>Mayotte</option>
			<option>Messico</option>
			<option>Micronesia</option>
			<option>Moldova</option>
			<option>Monaco</option>
			<option>Mongolia</option>
			<option>Montserrat</option>
			<option>Mozambico</option>
			<option>Namibia</option>
			<option>Nauru</option>
			<option>Nepal</option>
			<option>Nicaragua</option>
			<option>Niger</option>
			<option>Nigeria</option>
			<option>Niue</option>
			<option>Norvegia</option>
			<option>Nuova Caledonia</option>
			<option>Nuova Zelanda</option>
			<option>Oman</option>
			<option>Paesi Bassi</option>
			<option>Pakistan</option>
			<option>Palau</option>
			<option>Panama</option>
			<option>Papuasia Nuova Guinea</option>
			<option>Paraguay</option>
			<option>Per</option>
			<option>Polinesia Francese</option>
			<option>Polonia</option>
			<option>Portogallo</option>
			<option>Porto Rico</option>
			<option>Qatar</option>
			<option>Regno Unito</option>
			<option>Repubblica dell'Azerbaijan</option>
			<option>Repubblica Ceca</option>
			<option>Repubblica Centrafricana</option>
			<option>Repubblica Dominicana</option>
			<option>Repubblica di Gabon</option>
			<option>Romania</option>
			<option>Ruanda</option>
			<option>Sahara Occidentale</option>
			<option>Samoa Americane</option>
			<option>Samoa Occidentale</option>
			<option>St. Elena</option>
			<option>St. Kitts-Nevis</option>
			<option>St. Pierre e Miquelon</option>
			<option>San Marino</option>
			<option>San Vincenzo e Grenadine</option>
			<option>Santa Lucia</option>
			<option>Senegal</option>
			<option>Seychelles</option>
			<option>Sierra Leone</option>
			<option>Singapore</option>
			<option>Siria</option>
			<option>Slovacchia</option>
			<option>Slovenia</option>
			<option>Somalia</option>
			<option>Spagna</option>
			<option>Sri Lanka</option>
			<option>Stati Uniti</option>
			<option>Sudafrica</option>
			<option>Suriname</option>
			<option>Svalbard</option>
			<option>Svezia</option>
			<option>Svizzera</option>
			<option>Swaziland</option>
			<option>Tahiti</option>
			<option>Tailandia</option>
			<option>Taiwan</option>
			<option>Tajikistan</option>
			<option>Tanzania</option>
			<option>Togo</option>
			<option>Tonga</option>
			<option>Trinidad e Tobago</option>
			<option>Tunisia</option>
			<option>Turchia</option>
			<option>Turkmenistan</option>
			<option>Tuvalu</option>
			<option>Ucraina</option>
			<option>Uganda</option>
			<option>Ungheria</option>
			<option>Uruguay</option>
			<option>Uzbekistan</option>
			<option>Vanuatu</option>
			<option>Venezuela</option>
			<option>Vietnam</option>
			<option>Wallis e Futuna</option>
			<option>Yemen</option>
			<option>Yugoslavia</option>
			<option>Zambia</option>
			<option>Zimbabwe</option>
	  </select>";
	}
}
/*fine utenti*/
	

//aggiunge gli zeri per trasformali in euro
function decimali($importo){
	$punto=strpos($importo,".");
	$cifre=strlen(substr($importo,($punto+1)));
	if(strlen($punto)=="0"){
		$risultato=$importo.".00";
	}else{
		switch ($cifre) {
			case 1:
				$risultato=$importo."0";
				break;
			case 2:
				$risultato=substr($importo,($punto+3));
				break;
		}
	}
	return $risultato;
}




//Visualizzazione delle pagine sotto ogni pagina
function paginefooter($corrente,$fine){
	$scriptname=$_SERVER['SCRIPT_NAME'];
	if ($scriptname=="/w-admin/provainvio.php"){
		$scriptname="/w-admin/gestionepreventivo.php";
	}
	$percorso="http://".$_SERVER['HTTP_HOST'].$scriptname."?";
	if($fine>7){
		print "<a href='".$percorso."id=0' title='Inizio' class='altrilink'>Inizio </a>".chr(126);
	}	
	print " Pagina: ";
	if(($corrente)>1 and $fine>7){
		print "<a href='".$percorso."id=".($corrente-1)."' title='Precedente' class='altrilink'>Indietro</a> ... ";
	}
	if($corrente>0){
		$a=$corrente;
	}else{
		$a=1;
	}
	$end=$a+6;
	if($end<=$fine){
		for($a;$a<=$end;$a++){
				if($a==($corrente+1)){
					print "<span class='linkcorrente'>".$a." "."</span>";
				}else{
					print "<a href='".$percorso."page=".($a-1)."' class='altrilink'>".$a." </a>";
				}	
		}
	}else{
	$e=($a+8)-$fine;
	$e=($corrente+2)-$e;
	if($e<0){
		$e=1;
	}
		for($e;$e<=$fine;$e++){
			if($e==($corrente+1)){
				print "<span class='linkcorrente'>".$e." "."</span>";
			}else{
				print "<a href='".str_replace("??","?",$percorso."?page=".($e-1))."' class='altrilink'>".$e." </a>";
			}
		}
	}
	if(($corrente+6)<=$fine){
		print " ... <a href='".$percorso."page=".($corrente+1)."' title='Successivo' class='altrilink'>Avanti</a>";
	}
}
//fine visualizza pagina


//Visualizzazione delle pagine sotto ogni pagina
function paginefooter1($corrente,$fine){
	if($fine>7){
		print "<a href='".$_SERVER['REDIRECT_SCRIPT_URI']."?page=carrello/index.php&id=0' title='Inizio' class='altrilink'>Inizio </a>".chr(126);
	}	
	print " Pagina: ";
	if(($corrente)>1 and $fine>7){
		print "<a href='".$_SERVER['REDIRECT_SCRIPT_URI']."?page=carrello/index.php&id=".($corrente-1)."' title='Precedente' class='altrilink'>Indietro</a> ... ";
	}
	if($corrente>0){
		$a=$corrente;
	}else{
		$a=1;
	}
	$end=$a+6;
	if($end<=$fine){
		for($a;$a<=$end;$a++){
				if($a==($corrente+1)){
					print "<span class='linkcorrente'>".$a." "."</span>";
				}else{
					print "<a href='".$_SERVER['REDIRECT_SCRIPT_URI']."?page=carrello/index.php&id=".($a-1)."' class='altrilink'>".$a." </a>";
				}	
		}
	}else{
	$e=($a+8)-$fine;
	$e=($corrente+2)-$e;
	if($e<0){
		$e=1;
	}
		for($e;$e<=$fine;$e++){
			if($e==($corrente+1)){
				print "<span class='linkcorrente'>".$e." "."</span>";
			}else{
				print "<a href='".$_SERVER['REDIRECT_SCRIPT_URI']."?page=carrello/index.php&id=".($e-1)."' class='altrilink'>".$e." </a>";
			}
		}
	}
	if(($corrente+6)<=$fine){
		print " ... <a href='".$_SERVER['REDIRECT_SCRIPT_URI']."?page=carrello/index.php&id=".($corrente+1)."' title='Successivo' class='altrilink'>Avanti</a>";
	}
}
//fine visualizza pagina


//Ricavo la data inserita
function ricavodata($giorno,$mese,$anno){
	if(strlen($giorno)>0){
		print 	"<select name='giorno' size='1'>
					<option>".$giorno."</option>
					<option>--Giorno--</option>
					<option>01</option>
					<option>02</option>
					<option>03</option>
					<option>04</option>
					<option>05</option>
					<option>06</option>
					<option>07</option>
					<option>08</option>
					<option>09</option>
					<option>10</option>
					<option>11</option>
					<option>12</option>
					<option>13</option>
					<option>14</option>
					<option>15</option>
					<option>16</option>
					<option>17</option>
					<option>18</option>
					<option>19</option>
					<option>20</option>
					<option>21</option>
					<option>22</option>
					<option>23</option>
					<option>24</option>
					<option>25</option>
					<option>26</option>
					<option>27</option>
					<option>28</option>
					<option>29</option>
					<option>30</option>
					<option>31</option>
				</select>";
	}
	if(strlen($mese)>0){
	switch ($mese) {
	    case "01":
	        $nomem="Gennaio";
	        break;
	    case "02":
	        $nomem="Febbraio";
	        break;
	    case "03":
	        $nomem="Marzo";
	        break;
		 case "04":
	        $nomem="Aprile";
	        break;
	    case "05":
	        $nomem="Maggio";
	        break;
	    case "06":
	        $nomem="Giugno";
	        break;	
	    case "07":
	        $nomem="Luglio";
	        break;
	    case "08":
	        $nomem="Agosto";
	        break;
	    case "09":
	        $nomem="Settembre";
	        break;
		 case "10":
	        $nomem="Ottobre";
	        break;
	    case "11":
	        $nomem="Novembre";
	        break;
	    case "12":
	        $nomem="Dicembre";
	        break;			
	}
	print 	"<select name='mese' size='1'>
				<option value=".$mese.">".$nomem."</option>
				<option>--Mese--</option>
				<option value='01'>Gennaio</option>
				<option value='02'>Febbraio</option>
				<option value='03'>Marzo</option>
				<option value='04'>Aprile</option>
				<option value='05'>Maggio</option>
				<option value='06'>Giugno</option>
				<option value='07'>Luglio</option>
				<option value='08'>Agosto</option>
				<option value='09'>Settembre</option>
				<option value='10'>Ottobre</option>
				<option value='11'>Novembre</option>
				<option value='12'>Dicembre</option>
            </select>";
	}
	if(strlen($anno)>0){
	$annoric=date("Y")-17;
?>	<select name='anno' size='1'>
<?		print "<option value='$anno'>".$anno."</option>";
		for($i=0; $i<=91; $i++){
			$annoric=$annoric-1;
			print "<option value='$annoric'>$annoric</option>";
		}
?>	</select>
<?	}		
}
//fine data
?>
<?
	function rimuoviescape($testo){
		$testo=str_replace('\\"','\"',$testo);
		$testo=str_replace("\'","'",$testo);
		$testo=str_replace('\"','"',$testo);
		return $testo;
	}
	
	function caratterispeciali($testo){
		$testo=str_replace("à","&agrave;",$testo);
		$testo=str_replace("è","&egrave;",$testo);
		$testo=str_replace("é","&eacute;",$testo);
		$testo=str_replace("ì","&igrave;",$testo);
		$testo=str_replace("ò","&ograve;",$testo);
		$testo=str_replace('ù','&ugrave;',$testo);
		return $testo;
	}
	
?>
