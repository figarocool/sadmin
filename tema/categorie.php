<?php
	unset($_SESSION['query']);
?>
<?php
		//connessione al database
		$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione.");
		//selezione del database
		mysql_select_db($database) or die ("Non riesco a selezionare il database");
		$newurl = explode("/",$_SERVER['REQUEST_URI']);	
		$idfind = explode("-",$newurl[2]);	
		$sel = array_pop($idfind);	
		$query=mysql_query("select * from categorie where id='".$sel."'") or die ("Query marche1 non eseguita!");
		//conto i se esiste la categoria
		$contacategorie=mysql_num_rows($query);
		
		//Se è stata trovata la categoria visualizza il contenuto
		if($contacategorie>0){
			$idcat=@mysql_result($query,0,0);
			$nomecat=@mysql_result($query,0,1);

			//divisione dei prodotti in pagine
			include "divisione_pagine_categorie.php";
			if($righe>0){
?>				<div class="box-marche">
					<div class="box-titleprodotti">
						<div class="titleprodotti">
							<h2>SONO PRESENTI <? print $righe; ?> PRODOTTI DELLA CATEGORIA <? print stripslashes($nomecat); ?></h2>
						</div>
					</div>
					<div class="box-prodotti">
						<div class="container-prodotti">
<?php					$query=mysql_query("SELECT * FROM prodotti JOIN assegnazionecategorie ON prodotti.id=assegnazionecategorie.idprodotto WHERE idcategoria='".$sel."' LIMIT ".$partenza.",".$num."") or die ("Query categorie non eseguita!");
						while($data=mysql_fetch_array($query)){
							$idprodotto=$data[0];
							$titoloprodotto=utf8_encode($data[1]);
							$descprodotto=$data[2];
							$idmarca=$data[3];
							
							//Controllo se il prodotto è bloccato
							$querybloccati=mysql_query("select * from bloccati where idprodotto='".$data[0]."'") or die ("Query bloccati non eseguita!");
							$bloccato=mysql_num_rows($querybloccati);
							//fine bloccato
										
							
							//categoria del prodotto
							$querycategoria=mysql_query("select * from categorie where id='".$data[4]."'") or die ("Query marcaprodotti non eseguita!");
							$idcategoria=@mysql_result($querycategoria,0,0);
							$ricavocategoria=@mysql_result($querycategoria,0,1);
									
							//ricavo le img del prodotto
							$queryimg=mysql_query("select imgmin,imgmax from immagini where idprodotto='".$data[0]."'")or die ("Query non eseguita!");
							$imgmin=@mysql_result($queryimg,0,0);
							$imgmax=@mysql_result($queryimg,0,1);
							
							//marca del prodotto
							$querymarc=mysql_query("select * from marche where id='".$idmarca."'") or die ("Query marche non eseguita!");
							$idmarca=@mysql_result($querymarc,0,0);
							$ricavomarca=@mysql_result($querymarc,0,1);
							
							//offerta
							$prezzo="";
							$queryoff=mysql_query("select * from offerte where idprodotto='".$data[0]."'") or die ("Query offerte non eseguita!");
							if (mysql_num_rows($queryoff)!=0){
								$idprod=@mysql_result($queryoff,0,1);
								$prezzo=@mysql_result($queryoff,0,2);
							}	
								
							//Prendo le cose se il prodotto è in vendita!
							$queryInVendita=mysql_query("select * from prodottivendita where idprodotto='".$data[0]."'") or die ("Query prodotto in vendita non eseguita!");
							if (mysql_num_rows($queryInVendita)!=0){
								$prezzo=@mysql_result($queryInVendita,0,2);
							}
							
							if(strlen($prezzofferta)>0){
								//Stampa offerta
								include "singolaofferta.php";	
							}else{
								//Stampa prodotti
								include "singoloprodotto.php";
							}	
						}
			}
?>
						</div>
					</div>
<?php
			}else{
				print "Nessuna categoria trovata";
			}
			if($righe>0){
?>
				<div class="pagine">
					<?php divisioneprodotti($corrente,$pagine); ?>
				</div>
<?php
			}
			mysql_close($db);
?>		</div>