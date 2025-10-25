<?	session_start();
	//Dati database, connessione e selezione del database
	include "../config.php";
	//connessione al database
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	//selezione del database
	mysql_select_db($database) or die ("Non riesco a selezionare il database");	
	if(isset($_POST['utenti']) and strlen($_POST['utenti'])>0){
		$dividovariabile=explode("-",$_POST['utenti']);
		$idutente=$dividovariabile[0];
		$nomeutente=$dividovariabile[1];
?>		<script language="javascript">
			//vieni rindirizzato alla pagina della gestione delle categorie
			function doLoad1()  { setTimeout( 'refresh1()', 1000 ); }
			function refresh1() {
				top.document.getElementById('nome').value='<? print $nomeutente;?>';
				top.document.getElementById('idutente').value='<? print $idutente;?>';
				top.document.getElementById('oscura').style.display='none'; 
				top.document.getElementById('scrivipagina').innerHTML='';
			}
		</script>
		<body onload='doLoad1();'>
<?	}
?>
<html>
<head>
	<title>W-admin -- Lista Utenti</title>
	<link rel="stylesheet" type="text/css" href="css/listaprodotti.css" media="screen" />
</head>
<body bgcolor="#CCCCCC">
	<table width="100%">
		<tr>
			<td align="right">	
				<div class="chiudilistaprodotti">
					<a href="#" Onclick="javascript: top.document.getElementById('oscura').style.display='none'; top.document.getElementById('scrivipagina').innerHTML=''; "><img src="immagini/chiudi.jpg" border="0"></a>
				</div>
			</td>
		</tr>	
	</table>
	<div style="font-family: Arial; font-size: 22px; text-decoration: underline; font-weight: bold; color: #990000;">Lista Utenti</div>
	<form action="#" name="cerca" id="cerca" method="post">
	<table>
		<tr>
			<td style="font-family: Arial; font-weight: bold;">Nome:<input type="text" name="nomeut" id="nomeut" value=""></td>
			<td style="font-family: Arial; font-weight: bold;">Cognome:<input type="text" name="cognomeut" id="cognomeut" value=""></td>

		</tr>
		<tr>
			<td style="font-family: Arial; font-weight: bold;">Username:<input type="text" name="usereut" id="userut" value=""></td>
			<td>&nbsp;</td>
		</tr>
	</table>
	<div style="text-align: right; margin-top: 20px; margin-bottom: 20px;">
		<input type="Submit" name="cerca" id="cerca" value="Visualizza">
	</div>
	</form>
	<hr />
<?	if(isset($_POST['nomeut']) and strlen($_POST['nomeut'])>0){
		$a=" nome='".$_POST['nomeut']."'";
	}
	if(isset($_POST['cognomeut']) and strlen($_POST['cognomeut'])>0){
		if(strlen($_POST['nomeut'])==0){
			$b=" cognome='".$_POST['cognomeut']."'";
		}else{
			$b=" and cognome='".$_POST['cognomeut']."'";
		}	
	}
	if(isset($_POST['userut']) and strlen($_POST['userut'])>0){
		if(strlen($_POST['nomeut'])==0 and strlen($_POST['cognomeut'])==0){
			$c=" user='".$_POST['userut']."'";
		}else{
			$c=" and user='".$_POST['userut']."'";
		}	
	}
	if(isset($_POST['nomeut']) or isset($_POST['cognomeut']) or isset($_POST['userut'])){
		$query="select * from utenti where ".$a.$b.$c;
		$ris=mysql_query($query) or die ("Nessun risultato trovato!");
		//conto le righe trovate
		$trovato=@mysql_num_rows($ris);
		if($trovato>0){
?>			<form action="" name="aggiungi" id="aggiungi" method="post">
				<select name="utenti" id="utenti" size="7">
<?					while($data=mysql_fetch_array($ris)){
?>						<option value="<? print $data[0]."-".str_replace(chr(92)."'","'",$data[1])." ".str_replace(chr(92)."'","'",$data[2]); ?>"><? print str_replace(chr(92)."'","'",$data[1])." ".str_replace(chr(92)."'","'",$data[2]); ?></option>			
<?					}
?>				</select><br />
				<div style="text-align: right; margin-top: 10px; margin-bottom: 20px;">
					<input type="Submit" name="agg" id="agg" value="Conferma">
				</div>
			</form>	
<?		}else{
			print "Nessun risultato trovato!";
		}	
	}	
?>		
</body>
</html>
