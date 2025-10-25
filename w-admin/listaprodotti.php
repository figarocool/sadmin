<?	session_start();
	//Dati database, connessione e selezione del database
	include "../config.php";
	//connessione al database
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	//selezione del database
	mysql_select_db($database) or die ("Non riesco a selezionare il database");	
	if(isset($_POST['prodotti']) and strlen($_POST['prodotti'])>0){
		//id prodotto
		$_SESSION['prodotti']=$_POST['prodotti'];
?>		<script language="javascript">
			//vieni rindirizzato alla pagina della gestione delle categorie
			function doLoad1()  { setTimeout( 'refresh1()', 5000 ); }
			function refresh1() { top.frames['iframe'].style.display='none'; top.aggiorna();}
		</script>
		<body onload='doLoad1(); top.aggiorna();'>
<?	}
?>
<html>
<head>
	<title>W-admin -- Lista Prodotti</title>
	<link rel="stylesheet" type="text/css" href="css/listaprodotti.css" media="screen" />
</head>
<body bgcolor="#CCCCCC">
	<table width="100%">
		<tr>
			<td align="right">	
				<div class="chiudilistaprodotti">
					<a href="#" Onclick="javascript: top.frames['scrivipagina'].style.display='none'; top.document.getElementById('oscura').style.display='';">&nbsp;</a>
				</div>
			</td>
		</tr>	
	</table>
	<div style="font-family: Arial; font-size: 22px; text-decoration: underline; font-weight: bold; color: #990000;">Lista Prodotti</div>
	<form action="#" name="cerca" id="cerca" method="post">
	<table>
		<tr>
			<td style="font-family: Arial; font-weight: bold;">Tilolo:<input type="text" name="nomeprod" id="nomeprod" value=""></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td style="font-family: Arial; font-weight: bold;">
				Categoria:
				<select name="categoria" id="categoria">
					<option value="0">Seleziona</option>
<?					$query="select * from categorie order by nome asc";
					$ris=mysql_query($query) or die ("Query: ".$query." non eseguita!");
					while($data=mysql_fetch_array($ris)){
						print "<option value=".$data[0].">".str_replace(chr(92)."'","'",$data[1])."</option>";
					}
?>				</select>
			</td>
			<td style="font-family: Arial; font-weight: bold;">
				Marca:
				<select name="marca" id="marca">
					<option value="0">Seleziona</option>
<?					$query1="select * from marche order by nome asc";
					$ris1=mysql_query($query1) or die ("Query: ".$query1." non eseguita!");
					while($data=mysql_fetch_array($ris1)){
						print "<option value=".$data[0].">".str_replace(chr(92)."'","'",$data[1])."</option>";
					}
?>				</select>
			</td>
		</tr>
	</table>
	<div style="text-align: right; margin-top: 20px; margin-bottom: 20px;">
		<input type="Submit" name="cerca" id="cerca" value="Visualizza">
	</div>
	</form>
	<hr />
<?	if(isset($_POST['nomeprod']) and strlen($_POST['nomeprod'])>0){
		$cerca=$_POST['nomeprod'];
		$a=" titolo LIKE '%$cerca%'";
	}
	if(isset($_POST['categoria']) and $_POST['categoria']!=0){
		if(strlen($_POST['nomeprod'])==0){
			$b=" idcategoria='".$_POST['categoria']."'";
		}else{
			$b=" and idcategoria='".$_POST['categoria']."'";
		}	
	}
	if(isset($_POST['marca']) and $_POST['marca']!=0){
		if(strlen($_POST['nomeprod'])==0){
			$c=" idmarca='".$_POST['marca']."'";
		}else{
			$c=" and idmarca='".$_POST['marca']."'";
		}	
	}
	if(isset($_POST['marca']) or isset($_POST['categoria']) or isset($_POST['nomeprod'])){
		$query="select * from prodotti where ".$a.$b.$c;
		$ris=mysql_query($query) or die ("Query: ".$query." non eseguita!");	
?>		<form action="" name="aggiungi" id="aggiungi" method="post">
			<select name="prodotti" id="prodotti" size="10">
<?				while($data=mysql_fetch_array($ris)){
					$querymar=mysql_query("select * from marche where id='".$data[3]."'") or die ("Query: ".$query." non eseguita!");
					$nomemarca=@mysql_result($querymar,0,1);
?>					<option value="<? print $data[0]; ?>"><? print str_replace(chr(92)."'","'",$nomemarca)." - ".str_replace(chr(92)."'","'",$data[1]); ?></option>			
<?				}
?>			</select><br />
			<div style="text-align: right; margin-top: 20px; margin-bottom: 20px;">
				<input type="Submit" name="agg" id="agg" value="Aggiungi al preventivo">
			</div>
		</form>	
<?	}	
?>		
</body>
</html>
