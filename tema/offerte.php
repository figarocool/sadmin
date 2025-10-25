<?php
	unset($_SESSION['query']);
	//divisione dei prodotti in pagine
	include "divisione_pagine_offerte.php";		
?>
	<div class="box-prodotti">
		<div class="container-prodotti">
<?php
				//connessione al database
					$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione.");
					//selezione del database
					mysql_select_db($database) or die ("Non riesco a selezionare il database");
					$query=mysql_query("select * from prodotti where idmarca='2' order by id desc LIMIT ".$partenza.",".$num."") or die ("Query marche non eseguita!");
					while($data=mysql_fetch_array($query)){
							//$queryoff=mysql_query("select * from prodotti where id='".$data[1]."'") or die ("Query marche non eseguita!");
							$idprodotto=$data[0];
							$titoloprodotto=$data[1];
							$descrizioneprodotto=$data[2];
							//$idmarcadb=@mysql_result($queryoff,0,3);
							$l=$data[5];
							$p=$data[6];
							$h=$data[7];
							$queryofferta=mysql_query("select * from offerte where idprodotto='".$data[0]."'") or die ("Query bloccati non eseguita!");
							$prezzofferta=@mysql_result($queryofferta,0,2);
							//misure del prod
							$misura="L. ".$l." P. ".$p." H. ".$h;
							
							//Controllo se il prodotto è bloccato
							$querybloccati=mysql_query("select * from bloccati where idprodotto='".$data[0]."'") or die ("Query bloccati non eseguita!");
							$bloccato=mysql_num_rows($querybloccati);
							
							//query per vedere se il prodotto ha doppie misure
							$querymis=mysql_query("select * from misure where idprodotto='".$data[0]."'") or die ("Query:  non eseguita!");
							$misuredb=@mysql_result($querymis,0,0);
							$lunghezza2=@mysql_result($querymis,0,4);
							$profondita2=@mysql_result($querymis,0,6);
							$altezza2=@mysql_result($querymis,0,5);
							$altezza3=@mysql_result($querymis,0,3);
							$diametro=@mysql_result($querymis,0,2);
							$misura2="L. ".$lunghezza2." P. ".$profondita2." H. ".$altezza2;
							$misura3="H. ".$altezza3." D. ".$diametro;
							
							//$querymarc=mysql_query("select * from marche where id='".$idmarcadb."'") or die ("Query marche non eseguita!");
							//$idmarca=@mysql_result($querymarc,0,0);
							//$ricavomarca=@mysql_result($querymarc,0,1);
							
							//categoria del prodotto
							$querycategoria=mysql_query("select * from categorie where id='".$data[4]."'") or die ("Query marcaprodotti non eseguita!");
							$idcategoria=@mysql_result($querycategoria,0,0);
							$ricavocategoria=@mysql_result($querycategoria,0,1);
							
							$queryimg=mysql_query("select imgmin,imgmax from immagini where idprodotto='".$data[0]."'")or die ("Query non eseguita!");
							$imgmin=@mysql_result($queryimg,0,0);
							$imgmax=@mysql_result($queryimg,0,1);
							
							$offerta = 1;
							
							//Stampa prodotti
							include "singoloprodotto.php";
					}
					mysql_close($db);
?>
		</div>
	</div>
	<div class="pagine">
		<?php divisioneprodotti($corrente,$pagine); ?>
	</div>