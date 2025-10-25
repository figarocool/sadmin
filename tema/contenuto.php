<?php
	unset($_SESSION['query']);
	//divisione dei prodotti in pagine
	include "divisione_pagine.php";	
	//connessione al database
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	//selezione del database
	mysql_select_db($database) or die ("Non riesco a selezionare il database");
	//Seleziono i banner
	$ris=mysql_query('SELECT link, nome_immagine FROM banner WHERE visuale=0 ORDER BY `numero` ASC') or die ("Query: categorie non eseguita!");
	if (mysql_num_rows($ris) > 0){
?>
		<div class="jcarousel-wrapper">
			<div class="jcarousel">
				<ul>
<?php
					while($data=mysql_fetch_array($ris)){
?>
						<li><a title="Link a <?php print $data[0]; ?>" href="<?php print $data[0]; ?>"><img src="<?php print "http://".$_SERVER['HTTP_HOST']; ?>/banner/<?php print $data[1]; ?>" alt="Banner"></a></li>
<?php
					}
?>
				</ul>

			</div>
			<a href="#" class="jcarousel-control-prev">&lsaquo;</a>
			<a href="#" class="jcarousel-control-next">&rsaquo;</a>
			<p class="jcarousel-pagination"></p>
		</div>
<?php
	}
?>
	<div class="container-prodotti">
<?php
		if(esistetabella($database,"gestionepriorita",0)==true){
			//creazione query dei prodotti con priorità
			$queryx=creaqueryprorita();
		}
						
		if(count($queryx)==0){
			//Query senza priorità
			$queryy="SELECT * FROM prodotti WHERE id NOT IN (SELECT DISTINCT idprodotto FROM offerte) order by RAND() LIMIT ".$partenza.",".$num."";
		}else{
			//Query con priorità
			$queryy="(select DISTINCT(prodotti.id), titolo, descrizione, idmarca, l, p, h, (1000000*prodotti.id) as ord2  from prodotti inner join assegnazionecategorie ON assegnazionecategorie.idprodotto=prodotti.id ".$queryx[0].") union all (select prodotti.id, titolo, descrizione, idmarca, l, p, h, FLOOR(1+(RAND()*prodotti.id)) as ord2  from prodotti INNER JOIN assegnazionecategorie ON assegnazionecategorie.idprodotto=prodotti.id ".$queryx[1]." ORDER BY RAND()) order by ord2 desc LIMIT ".$partenza.",".$num."";
		}
		
		$query=mysql_query($queryy) or die ("Query prodotti non eseguita!");
		while($data=mysql_fetch_array($query)){
			$idprodotto=$data[0];
			$titoloprodotto=utf8_encode($data[1]);
			$descprodotto=utf8_encode($data[2]);
			
			//Controllo se il prodotto è bloccato
			$querybloccati=mysql_query("select * from bloccati where idprodotto='".$data[0]."'") or die ("Query bloccati non eseguita!");
			$bloccato=mysql_num_rows($querybloccati);
			//fine bloccato

			//marca del prodotto
			$querymarc=mysql_query("select * from marche where id='".$data[3]."'") or die ("Query marcaprodotti non eseguita!");
			$idmarca=@mysql_result($querymarc,0,0);
			$ricavomarca=@mysql_result($querymarc,0,1);
			

			//ricavo le img del prodotto
			$queryimg=mysql_query("select imgmin,imgmax from immagini where idprodotto='".$data[0]."'")or die ("Query imgprod non eseguita!");
			$imgmin=@mysql_result($queryimg,0,0);
			$imgmax=@mysql_result($queryimg,0,1);
			
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
			
			//Stampa prodotti
			include "singoloprodotto.php";
		}
		mysql_close($db);
?>
	</div>
	<div class="pagine">
		<? 	divisioneprodotti($corrente,$pagine);?>
	</div>
