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
	include "divisione_preventivo.php";
	//Controllo se i cookies sono attivati
	function php_cookie_enable(){
		if($_COOKIE["prodotti"]=="0"){
			return true;
		}else{
			return false;
		}
	}
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Preventivo</title>
		<link rel="stylesheet" type="text/css" href="/tema/css/style.css">
	</head>
	<body>
		<?	include "header.php"; ?>
		<div class="box-prodotticarrello">
			<div class="pagina">
				<h2 style="text-align: center;">Richiedi Preventivo</h2>
				<p style="text-align: center;">E' possibile inserire pi&ugrave; prodotti nello stesso preventivo!</p>
<?php
					//connessione al database
					$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione.");
					//selezione del database
					mysql_select_db($database) or die ("Non riesco a selezionare il database");
					$arrayprodotti=explode(',',$_COOKIE['prodotti']);
					$fine=$partenza+($num-1);
					for($i=$partenza; $i<=$fine; $i++){
						if($listaprodotti[$i]!=0){
							$queryprod=mysql_query("select * from prodotti where id='".$listaprodotti[$i]."'") or die ("Query prodotti non eseguita!");
							$righe=mysql_num_rows($queryprod);
							if($righe>0){
								$idprodotto=@mysql_result($queryprod,0,0);
							}else{
								$queryoff=mysql_query("select * from offerte where idprodotto='".$listaprodotti[$i]."'") or die ("Query offerte non eseguita!");
								$idprodotto=mysql_result($queryoff,0,1);
							}
							//ricavo dati
							$query1="select * from prodotti,immagini where prodotti.id=idprodotto and prodotti.id='".$idprodotto."'";
							$prodb=mysql_query($query1) or die ("Query: ".$query1." non eseguita!");
?>
								<div class="boxpreventivi">
									<div class="nomepreventivo">
<?php
											
									/*	print $nomeprod=@mysql_result($prodb,0,1);  */
										$nomeprod=@mysql_result($prodb,0,1);
										$enco=utf8_encode($nomeprod);
										print $enco;
?>
									</div>
									<div class="eliminapreventivo">
										<a href="elimpreventivo.php?elim=<? print $listaprodotti[$i]; ?>">X Elimina</a>
									</div>
									<div class="informazionipreventivo">
										<div class="immaginepreventivo">
											<img src="/upload/<? print $imgprod=@mysql_result($prodb,0,10); ?>">
										</div>
										<div class="decrizionepreventivo">
<?php
											$descprod=str_replace("<p>","",@mysql_result($prodb,0,2));
											$enc = utf8_encode($descprod);
											$descprod1=str_replace("</p>","",$enc); 
											print riducitesto($descprod1,200);
?>
										</div>
									</div>
								</div>				
<?php
								$listanuova=$listanuova.$listaprodotti[$i].",";
								$esiste=true;
							}
						}
						//Se i cookies sn disattivati non visualizzare le pag
						if (php_cookie_enable() == true and $pagine>1){
?>
							<div class="pagine">
								<? 	divisioneprodotti($corrente,$pagine); ?>
							</div>	
<?php
						}
						@setcookie('prodotti',$listanuova);
						//Se esistono prodotti visualizza textarea
						if($esiste==true){
?>
							<form action="preventivodb.php" name="preventivo" id="preventivo" method="POST">
								<div class="richiestapreventivo">
									<h2>Eventuale Richiesta:</h2>
									<textarea id="richiesta" name="richiesta" cols="78" rows="10"></textarea>
								</div>
								<div class="confermapreventivo">
									<input type="submit" value="Richiedi preventivo" name="cmd" id="cmd">
								</div>
							</form>
<?php
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
								print "<p style='text-align:center'>Il Preventivo &egrave; vuoto!</p>";
								//settaggio variabile
								$_SESSION['preventivo']="1";
							}
						}
?>	
			</div>
		</div>
		<? include "footer.php"; ?>
	</body>
</html>