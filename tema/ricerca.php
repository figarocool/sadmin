<?php
	$_SESSION['query']='';
	include "tema/divisione_ricerca.php";
?>
		<div class="box-titlepagina">
			<div class="titlepagina">
				<h2>Ricerca [ <? print $righe; ?> Prodotti trovati! ]</h2>
			</div>
		</div>
<?php
		if($righe>0){
?>
		<div class="box-prodotti">
			<div class="container-prodotti">
<?php
				//connessione al database
				$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione.");
				//selezione del database
				mysql_select_db($database) or die ("Non riesco a selezionare il database");
				//ricerca
				if(strlen($_POST['cerca'])>0){
					$cerca=$_POST['cerca'];
					$_SESSION['cerca']=$cerca;
				}else{	
					$cerca=$_SESSION['cerca'];
				}	
				$query=mysql_query("SELECT * FROM prodotti WHERE titolo LIKE '%$cerca%' or descrizione LIKE '%$cerca%' order by id asc LIMIT ".$partenza.",".$num."") or die ("Query marche non eseguita!");
				while($data=mysql_fetch_array($query)){
					$idprodotto=$data[0];
					$titoloprodotto=$data[1];
					$descprodotto=utf8_encode($data[2]);
				
					
					//misure del prod
					$misura="L. ".$data[5]." P. ".$data[6]." H. ".$data[7];
					
					//query per vedere se il prodotto ha doppie misure
					$querymis=mysql_query("select * from misure where idprodotto='".$data[0]."'") or die ("Query: misure  non eseguita!");
					$misuredb=@mysql_result($querymis,0,0);
					$lunghezza2=@mysql_result($querymis,0,4);
					$profondita2=@mysql_result($querymis,0,6);
					$altezza2=@mysql_result($querymis,0,5);
					$altezza3=@mysql_result($querymis,0,3);
					$diametro=@mysql_result($querymis,0,2);
					$misura2="L. ".$lunghezza2." P. ".$profondita2." H. ".$altezza2;
					$misura3="H. ".$altezza3." D. ".$diametro;
					
					//Controllo se il prodotto è bloccato
					$querybloccati=mysql_query("select * from bloccati where idprodotto='".$data[0]."'") or die ("Query bloccati non eseguita!");
					$bloccato=mysql_num_rows($querybloccati);
					//fine bloccato
					
					$querymarc=mysql_query("select * from marche where id='".$data[3]."'") or die ("Query marche non eseguita!");
					$ricavomarca=@mysql_result($querymarc,0,1);
					$queryimg=mysql_query("select imgmin,imgmax from immagini where idprodotto='".$data[0]."'")or die ("Query non eseguita!");
					$imgmin=@mysql_result($queryimg,0,0);
					$imgmax=@mysql_result($queryimg,0,1);
					
					//offerta
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
				<? 	divisioneprodotti($corrente,$pagine); ?>
			</div>
		</div>
<?php
		}else{
			print "<div class=\"notrovato\">Nessuno Prodotto trovato!</div>";
		}
?>
