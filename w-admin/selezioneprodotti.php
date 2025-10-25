<?
	//Ricavo il browser osato
	$lista=$_SERVER['HTTP_USER_AGENT'];
	$browser=explode(';',$lista);
	$browser=$browser[1]; 
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<script language="JavaScript">
	function scriviid(id){
		top.document.formpreventivo.idprodotto.value=id;
	}
	</script>
<!--STILE e JAVASCRIPT BACHECA-->
<? 
	if(strstr($browser, 'MSIE')==true){
?>
		<link rel="stylesheet" type="text/css" href="css/ricercapreventivo.css" media="screen" />
<?	}else{?>
		<link rel="stylesheet" type="text/css" href="css/ricercapreventivo_moz.css" media="screen" />
<?	}?>	
</head>
<body bgcolor="#D5E2EB">
	<select name="prodotti" id="prodotti" class="selectcambio" Onchange="javascript: scriviid(this.value);">
		<option value="0">Seleziona Prodotto</option>
	<?	//Dati database, connessione e selezione del database
		include "../config.php";
		//connessione al database
		$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
		//selezione del database
		mysql_select_db($database) or die ("Non riesco a selezionare il database");	
		//query prodotti per la marca selezionata
		$queryprod=mysql_query("SELECT id,titolo FROM `prodotti` WHERE idmarca='".$_GET['marca']."' order by titolo asc") or die ("Query: prodotti non eseguita!");
		while($nomeprod=mysql_fetch_array($queryprod)){
			print "<option value='".$nomeprod[0]."'>".utf8_encode($nomeprod[1])."</option>";
		}
		mysql_close($db);
	?>
	</select>
</body>
</html>



