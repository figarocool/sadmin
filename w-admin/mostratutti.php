<?php
	//dichiarazioni variabili
	$tabella=$_GET['tabella'];
	$select=$_GET['select'];
	
	if($tabella=="prodotti"){
		$concquery="`prodotti` WHERE id NOT IN (SELECT DISTINCT idprodotto FROM offerte) order by titolo asc";
		$width="style='width: 500px;'";
		$onchange='Onchange="javascript: top.document.getElementById(\'ricprodotti\').value=this.value; cercaimgprodotto(this.value,\'prodottoiframe\'); "';
	} 
	if($tabella=="offerte"){
		$concquery="`prodotti` WHERE id IN (SELECT DISTINCT idprodotto FROM offerte) order by titolo asc";
		$width="style='width: 500px;'";
		$tabella="prodotti";
		$onchange='Onchange="javascript: top.document.getElementById(\'ricprodotti1\').value=this.value; cercaimgprodotto(this.value,\'offertaiframe\'); "';
	}
	if($tabella=="marche"){
		$concquery=$tabella." order by nome asc";
		$width="style='width: 350px;'";
		$onchange='Onchange="javascript: top.document.getElementById(\'ricmarche\').value=this.value; "';
	}
	
	if($tabella=="categorie"){
		$concquery=$tabella." order by nome asc";
		$width="style='width: 350px;'";
		$onchange='Onchange="javascript: top.document.getElementById(\'riccategorie\').value=this.value;"';
	}
	

?>
<body style="margin: 0px; padding: 0px;">
	<script language="JavaScript" type="text/javascript" src="js/gestionepriorita.js"></script>
	<select name="<?php print $select; ?>" id="<?php print $select; ?>" size="7" <?php print $width; ?> <? print $onchange; ?> />
	<?php
		//Dati database, connessione e selezione del database
		include "../config.php";
		//connessione al database
		$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
		//selezione del database
		mysql_select_db($database) or die ("Non riesco a selezionare il database");	
		//query creata
		$querycampo=mysql_query("SELECT * FROM ".$concquery) or die ("Query: lista completa non eseguita!");
		//conto i risultati
		$righecampo=mysql_num_rows($querycampo);
		if($righecampo>0){
			$querycampo=mysql_query("SELECT * FROM ".$concquery) or die ("Query: lista completa non eseguita!");
			while($nomecampo=mysql_fetch_array($querycampo)){
				print "<option id='".str_replace(chr(92)."'","'",utf8_encode($nomecampo[1]))."' value='".$nomecampo[0]."'>".str_replace(chr(92)."'","'",utf8_encode($nomecampo[1]))."</option>";
			}
		}	
		mysql_close($db);
?>
	</select>
</body>



