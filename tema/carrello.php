<?php
	//Inizializzo la sessione
	session_start();
	//config
	include "../config.php";
	//funzioni
	include "../w-admin/functions.php";
	//variabile
	$esiste=false;
	//divisione dei prodotti in pagine
	include "divisione_carrello.php";
	//Controllo se i cookies sono attivati
	function php_cookie_enable(){
		if($_COOKIE["carrello"]=="0"){
			return true;
		}else{
			return false;
		}
	}
?>
<html>
	
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Carrello</title>
		<link rel="stylesheet" type="text/css" href="/tema/css/style.css">
		<script type="text/javascript" src="/tema/js/menu.js"></script>	
		
	</head>
	<body>
		<?	include "header.php"; ?>
		<div class="box-prodotticarrello">
			<div class="pagina">
				<h2 style="text-align: center;">Il mio carrello</h2>
<?php
				//connessione al database
				$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione.");
				//selezione del database
				mysql_select_db($database) or die ("Non riesco a selezionare il database");
				$arrayprodotti=explode(',',$_COOKIE['carrello']);
				$fine=$partenza+($num-1);
				$arr_id_prodotti_paypal = array();
				$arr_nomi_prodotti_paypal = array();
				$arr_prezzi_prodotti_paypal = array();
				for($i=$partenza; $i<=$fine; $i++){
					if($listaprodotti[$i]!=0){
						$queryprod=mysql_query("select * from offerte where idprodotto='".$listaprodotti[$i]."'") or die ("Query prodotti non eseguita!");
						$righe=mysql_num_rows($queryprod);
						$idprodotto=@mysql_result($queryprod,0,1);
						$prezzo=@mysql_result($queryprod,0,2);
						
						//Se non è un'offerta prendo il prezzo dalla tabella dei prodotti in vendita
						if($righe==0){
							$queryinvendita=mysql_query("select * from prodottivendita where idprodotto='".$listaprodotti[$i]."'") or die ("Query prodotto in vendita non eseguita!");
							if (mysql_num_rows($queryinvendita)!=0){
								$prezzo=@mysql_result($queryinvendita,0,2);
							}
						}
						
						
						//ricavo dati
						$query1="select * from prodotti,immagini where prodotti.id=idprodotto and prodotti.id='".$listaprodotti[$i]."'";
						$prodb=mysql_query($query1) or die ("Query: ".$query1." non eseguita!");
						
						array_push($arr_id_prodotti_paypal, $idprodotto);
						array_push($arr_nomi_prodotti_paypal, @mysql_result($prodb,0,1));
						array_push($arr_prezzi_prodotti_paypal, $prezzo);
?>
						<div class="boxpreventivi">
							<div class="nomepreventivo">
<?php
								//print $nomeprod=@mysql_result($prodb,0,1);
								$nomeprod=@mysql_result($prodb,0,1);
								$enc = utf8_encode($nomeprod);
								print $enc;
?>
							</div>
							<div class="eliminapreventivo">
								<a href="elimcarrello.php?elim=<? print $listaprodotti[$i]; ?>">X Elimina</a>
							</div>
							<div class="informazionipreventivo">
								<div class="immaginepreventivo">
									<img src="/upload/<? print $imgprod=@mysql_result($prodb,0,10); ?>">
								</div>
								<div class="decrizionepreventivo">
<?php
									$descprod=@mysql_result($prodb,0,2);
									//print utf8_decode(riducitesto($descprod,300));
									$enco=utf8_encode($descprod);
									print riducitesto($enco,300);
									
?>
								</div>
								
								<div class="prezzocarrello">
								Prezzo: <? print decimali($prezzo); ?> Euro
<?php
								$totalecar=$totalecar+$prezzo;
?>
								</div>
							</div>
							
						</div>
						
<?php
						$listanuova=$listanuova.$listaprodotti[$i].",";
						$esiste=true;
					}
				}
?>
			<?php if ($esiste==true){ ?>
				<div class="totalecarrello">
					Totale: <? print $totale = decimale($totalecar,"si"); ?> Euro 
<?php
					$_SESSION['totale']=$totale;
?>
				</div>
				<?php	} ?>
<?php
				//Se i cookies sn disattivati non visualizzare le pag
				if (php_cookie_enable() == true and $pagine>1){
?>
					<div class="pagine">
						<? 	divisioneprodotti($corrente,$pagine); ?>
					</div>	
<?php
				}
				@setcookie('carrello',$listanuova);
				//Se esistono prodotti visualizza textarea
				if($esiste==true){
					//connessione al database
					$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione.");
					//selezione del database
					mysql_select_db($database) or die ("Non riesco a selezionare il database");
					//Stampo i metodi di pagamento
					$querypag=mysql_query("select * from metodipagamento") or die ("Query pagamenti non eseguita!");
					while($data=mysql_fetch_array($querypag)){
?>						<form class="form-center" action="inviacarrello.php" method="post">						
							<input type="submit" value="Paga con <?php print $data[1]; ?>" class="likelink">
							<input type="hidden" name="totalecarrello" value="<?php echo $totale; ?>">						
							<input type="hidden" name="pagamento" value="<?php print $data[2]; ?>">						
							<input type="hidden" name="idpagamento" value="<?php print $data[0]; ?>">						
						</form>
<?php				}

				}else{
					//Se i cookies sono disattivati stampa errore
					if (php_cookie_enable() == false){
?>
						<div class="registrarsi">
<?php
							echo "<div style='font-weight: bold; padding-top: 20px; text-align: center;'>Attenzione i Cookies sono disabilitati, pertanto non &egrave; possibile effettuate un preventivo!</div><br /><br />";
?>
						</div>
<?php
					}else{
						print "<p style='text-align:center;'>Il Carrello &egrave; vuoto! <p>";
						//settaggio variabile
						$_SESSION['acquisto']="1";
					}
				}
?>
			</div>
		</div>
		<? include "footer.php"; ?>
	</body>
</html>
<? mysql_close($db); ?>