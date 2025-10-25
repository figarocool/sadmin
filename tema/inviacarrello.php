<?php
	//Inizializzo la sessione
	session_start();
	//config
	include "../config.php";
	//funzioni
	include "../w-admin/functions.php";
	if($_SESSION['acquisto']=="1"){
		//connessione al database
		$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione.");
		//selezione del database
		mysql_select_db($database) or die ("Non riesco a selezionare il database");
		$lista=explode(",",$_COOKIE["carrello"]);
		$utente=$_COOKIE["utenteof"];
		$queryutente=mysql_query("select * from utenti where id='".$utente."'") or die ("Query utenti non eseguita!");
		$data=date("Y-m-d");
		for($i=0; $i<=count($lista); $i++){
			if($lista[$i]!=0){
				$queryofferte=mysql_query("select * from prodotti where id='".$lista[$i]."'") or die ("Query prodotti non eseguita!");
				$idcate=@mysql_result($queryofferte,0,3);
				$querymarca=mysql_query("select * from marche where id='".$idcate."'") or die ("Query marca non eseguita!");
				$nomecate=@mysql_result($querymarca,0,1);
				$nomeoff=$nomecate." - ".mysql_result($queryofferte,0,1);
				$prodotti.=$nomeoff.",";		
			}
		}
		$_SESSION['acquisto']="";
		include "mail.php";	
	}
	//distruggo i cookie
	$time=time();
	@setcookie("carrello", "", $time - 3600);
	@setcookie("utenteof", "", $time - 3600);
	//chiusura db
	@mysql_close($db);
?>
<html>
	<head>
		<title>Carrello</title>
		<link rel="stylesheet" type="text/css" href="/tema/css/style.css">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body>
		<?	include "header.php"; ?>
		<div class="box-prodotticarrello">
			<div class="pagina">
				<h2 style="text-align: center;">Il mio Carrello</h2> 
				<div class="mexacquisto">
<?php
					//Svuoto i cookies
?>
					<p>Grazie per aver acquistato i nostri prodotti, la ricontatteremo al pi&ugrave; presto!</p>
<?php				//connessione al database
					$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione.");
					//selezione del database
					mysql_select_db($database) or die ("Non riesco a selezionare il database");
					$querypag=mysql_query("select * from metodipagamento WHERE id='".$_POST['idpagamento']."'") or die ("Query pagamenti non eseguita!");
					if ($_POST['pagamento']==0) {
?>						<!-- Codice Paypal -->						
						<form class="form-center"name="_cart"  action="https://www.paypal.com/cgi-bin/webscr" method="post">
							<input type="hidden" name="cmd" value="_cart">
							<input type="hidden" name="upload" value="1">
							<input type="hidden" name="business" value="<?php print mysql_result($querypag,0,3); ?>">
							<input type="hidden" name="currency_code" value="EUR">
							<!-- da modificare in modo "amount_x" (esmpio x=1,2,3,4 ecc) il totale in base al "item_name_x" -->
							<input type="hidden" name="amount_1" value="<?php echo $_POST['totalecarrello']; ?>">
							<!-- da modificare in modo  "item_name_x" (esmpio x=1,2,3,4 ecc) -->
							<input type="hidden" name="item_name_1" value="Pagamento dei prodotti acquistati">							
							<input type="hidden" name="lc" value="IT">	
							<input type="submit" value="Continua con Paypal" class="likelink" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">					
						</form>								
<?php				} else { 
							
						//Info Altro Pagamento
						print mysql_result($querypag,0,3); 
						
					} 
?>				</div>
				
			</div>	
		</div>
		<? include "footer.php"; ?>
	</body>
</html>