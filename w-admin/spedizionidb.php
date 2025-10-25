<?
	//inizializzo le variabili di sessione
	session_start();
	//Se l'utente è loggato visualizza carrello altrimenti lo porto al login
	if(!isset($_SESSION['id']) or strlen($_SESSION['id'])==0){
?>	
		<meta http-equiv="refresh" content="0; url=<? print "http://".$_SERVER['HTTP_HOST']; ?>/nonregistrato.php">
<?	}else{
	//includo le funzioni
	//include "functions.php";
	$loggato=$_SESSION['id'];
	
if(!isset($_GET['buy']) and strlen($_GET['buy'])==0){	
//CONTROLLO E SETTAGGIO VARIABILI
	//Controllo intestatario
	if(strlen($_POST['intestato'])==0){
		$errore = "Inserisci il nome e cognome o la rag. sociale.</br>";
	}else{
		$intestato=$_POST['intestato'];
	}
	//Controllo cod fiscale o p.iva
	if(strlen($_POST['codfiscale'])==0){
		$errore.="Inserisci il Cod. fiscale o la P.IVA.</br>";
	}else{
		$codfiscale=$_POST['codfiscale'];
	}
	//Controllo legge privacy
	if(strlen($_POST['legge'])==0){
		$errore.="Devi accettare la legge sulla privacy.</br>";
	}
	//Controllo indirizzo
	if(strlen($_POST['indirizzo'])==0){
		$errore.="Inserisci l'indirizzo.</br>";
	}else{
		$indirizzo = $_POST['indirizzo'];
	}
	//Controllo residenza
	if(strlen($_POST['residenza'])==0){
		$errore.="Inserisci la residenza.</br>";
	}else{
		$residenza=$_POST['residenza'];
	}
	//Controllo email
	if(strlen($_POST['email'])==0){
		$email="0";
	}else{
		$email=$_POST['email'];
	}
	//Controllo telefono
	if(strlen($_POST['tel'])==0){
		$errore="Inserisci Il telefono.";
	}else{
		$tel=$_POST['tel'];
	}
	//Controllo provincia
	if(strlen($_POST['provincia'])==0){
		$errore.="Inserisci la provincia.</br>";
	}else{
		$provincia=$_POST['provincia'];
	}
	//Controllo cap
	if(strlen($_POST['cap'])==0){
		$errore.="Inserisci il cap.</br>";
	}else{
		$cap=$_POST['cap'];
	}
	$indirizzo1=$indirizzo.",".$_POST['numero'];
}	
//FINE SETTAGGIO E CONTROLLO VARIABILI
?>
<html>
<head>
	<title>Spedizioni</title>
	<link rel="stylesheet" type="text/css" href="css/style visualizza.css" media="screen" />
	<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8"/>
</head>
<body>
<?	//Controllo se esistono errori li stampa altrimenti puoi acquistare
	if(isset($errore)){
?>
	<div style='border: 2px dashed #BBBBBB;width: 100%; height:50px; font-size: 20px; padding: 15px; background-color: #F0F0F0;'>
		<p>
			<strong><? print $errore;?></strong>
		</p>
 		<form name='indietro' id='indietro' method='POST' action='spedizioni.php'>
			<input type="hidden" name="intestato" id="intestato" value="<? print $_POST['intestato']; ?>">
			<input type="hidden" name="codfiscale" id="codfiscale" value="<? print $_POST['codfiscale']; ?>">
			<input type="hidden" name="residenza" id="residenza" value="<? print $_POST['residenza']; ?>">
			<input type="hidden" name="indirizzo" id="indirizzo" value="<? print $_POST['indirizzo']; ?>">
			<input type="hidden" name="provincia" id="provincia" value="<? print $_POST['provincia']; ?>">
			<input type="hidden" name="tel" id="tel" value="<? print $_POST['tel']; ?>">
			<input type="hidden" name="email" id="email" value="<? print $_POST['email']; ?>">
			<input type="hidden" name="cap" id="cap" value="<? print $_POST['cap']; ?>">
			<input type="image" id="submit" name="submit" src="immagini/indietro.gif">
		</form>
	</div>	
<? 	}else{ 
		//Inserimento nel database
		/*include $_SERVER['DOCUMENT_ROOT']."/wp-config.php";
		//connessione al database
		$db = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
		//selezione del database
		mysql_select_db(DB_NAME) or die ("Non riesco a selezionare il database");
		//query di inserimento spedizioni
		$query = mysql_query("insert into spedizioni values(default,'".mysql_real_escape_string(htmlentities($intestato))."', '$codfiscale', '".mysql_real_escape_string(htmlentities($indirizzo1))."','".mysql_real_escape_string($residenza)."', '".mysql_real_escape_string($provincia)."','$cap','$email','$tel','$loggato')") or die("Errore.La query non è stata eseguita");
		//seleziono i dati dal carrello
		$queryinfo="select * from carrello where idutente='".$loggato."'";
		$carrello=mysql_query($queryinfo) or die ("Query: ".$queryinfo." non eseguita!");
		while($infocar=mysql_fetch_array($carrello)){
			//query di inserimento vendite
			$query1 = mysql_query("insert into vendite values(default,'$loggato', '$infocar[2]', '$infocar[3]','$totale')") or die("Errore.La query non è stata eseguita");
			$q="select * from prodotti where id='".$infocar[2]."'";
			$qnt=mysql_query($q) or die ("Query: ".$q." non eseguita!");
			$prodotti.=mysql_result($qnt,0,1).",";
			$quantitae.=$infocar[3].",";
			$quantita=mysql_result($qnt,0,5);
			if(($quantita-$infocar[3])<=0){
				$ris=0;
			}else{
				$ris=$quantita-$infocar[3];
			}
			$query2 = mysql_query("UPDATE prodotti SET quantita='".$ris."' where id='".$infocar[2]."'") or die("Errore.La query non è stata eseguita");
			mysql_query("DELETE FROM carrello where idutente='".$loggato."'");
		}*/
	} 
?>

		<div style='border: 2px dashed #BBBBBB; width: 80%; height:50px; font-size: 20px; margin-left: 15%; padding: 15px; background-color: #F0F0F0;'>

			<div style=" float: left; border: 2px solid #000; width: 50%; height:176px; text-align: center;">
				<span style="font-weight: bold; font-size: 18px;">Paga subito e Concludi il tuo ordine.</span>
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
						<input type="hidden" name="cmd" value="_cart">
						<input type="hidden" name="business" value="<? print $emailpag; ?>">
						<input type="hidden" name="item_name_1" value="Prodotti acquistati su oliovinosalentino.com">
						<input type="hidden" name="currency_code" value="EUR">
						<input type="hidden" name="amount_1" value="<? print $totale; ?>">
						<input type="hidden" name="upload" value="1">
						<input type="hidden" name="return" value="http://www.webbay.it/pagamento_effettuato.html">
						<input type="image" src="http://www.paypal.com/it_IT/i/btn/x-click-but01.gif" name="submit" alt="Effettua i tuoi pagamenti con PayPal. &egrave; un sistema rapido, gratuito e sicuro.">
				
				</form>
				<img src="immagini/paypal-credit.gif">
			</div>
		</div>
		<p style="padding-top: 50px;">
			<a href="visualizzazione.php?idl=<? print $_GET['idl']; ?>&m=<? print urlencode($_GET['m']); ?>" title="Indietro">
				<img src="immagini/indietro.jpg" border="0" /> 
				Visualizza prodotti.
			<a>	
		</p>	
</body>
</html>
<? } ?>