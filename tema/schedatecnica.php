<?php
	//connessione al database
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	//selezione del database
	mysql_select_db($database) or die ("Non riesco a selezionare il database");
	
	$newurl = explode("/",$_SERVER['REQUEST_URI']);
	$idfind = explode("-",$newurl[2]);
	$idprod = array_pop($idfind);
	
	//offerta
	$query=mysql_query("select * from offerte where idprodotto='".$idprod."'") or die ("Query offerte non eseguita!");
	if (mysql_num_rows($query)!=0){
		$idprod=@mysql_result($query,0,1);
		$prezzo=@mysql_result($query,0,2);
		$record=mysql_num_rows($query);
	}	
		
	//Prendo le cose se il prodotto è in vendita!
	$queryInVendita=mysql_query("select * from prodottivendita where idprodotto='".$idprod."'") or die ("Query prodotto in vendita non eseguita!");
	if (mysql_num_rows($queryInVendita)!=0){
		$prezzo=@mysql_result($queryInVendita,0,2);
	}
	
	if(strlen($idprod)>0){
		//inserimento nella tabella ultimi prodotti visualizzati
		$visualizzo=mysql_query("select * from ultimimobili where idprodotto='".$idprod."'") or die ("Query ultimivisualizzati non eseguita!");
		$giavisualizzato=@mysql_result($visualizzo,0,2);
		if(strlen($giavisualizzato)==0){
			mysql_query("insert into ultimimobili values('default','".$idprod."','1')");
		}else{
			$volte=$giavisualizzato+1;
			mysql_query("Update ultimimobili set visualizzato='".$volte."' where idprodotto='".$idprod."'") or die("Errore.La query non è stata eseguita");
		}
		/*fine inserimento*/
	
		//Controllo se il prodotto è bloccato
		$querybloccati=mysql_query("select * from bloccati where idprodotto='".$idprod."'") or die ("Query bloccati non eseguita!");
		$bloccato=mysql_num_rows($querybloccati);
		
		//ricavo dati
		$query="select * from prodotti,immagini where prodotti.id=idprodotto and prodotti.id='".$idprod."' group by prodotti.id";
		$prodb=mysql_query($query) or die ("Query: ".$query." non eseguita!");
		$nomeprod=utf8_encode(@mysql_result($prodb,0,1));
		$descprod=@mysql_result($prodb,0,2);
		$immaginemax=@mysql_result($prodb,0,10);
		$record=mysql_num_rows($prodb);
		
		//misure del prod
		$misura="L. ".@mysql_result($prodb,0,4)." P. ".@mysql_result($prodb,0,5)." H. ".@mysql_result($prodb,0,6);
		$idm=@mysql_result($prodb,0,3);
		
		$query=mysql_query("select * from marche where id='".$idm."'") or die ("Query marche non eseguita!");
		$nomecat=@mysql_result($query,0,1);
		
		//query per vedere se il prodotto ha doppie misure
		$querymis=mysql_query("select * from misure where idprodotto='".$idprod."'") or die ("Query:  non eseguita!");
		$misuredb=@mysql_result($querymis,0,0);
		$lunghezza2=@mysql_result($querymis,0,4);
		$profondita2=@mysql_result($querymis,0,6);
		$altezza2=@mysql_result($querymis,0,5);
		$altezza3=@mysql_result($querymis,0,3);
		$diametro=@mysql_result($querymis,0,2);
		$misura2="L. ".$lunghezza2." P. ".$profondita2." H. ".$altezza2;
		$misura3="H. ".$altezza3." D. ".$diametro;
		
		//query per vedere se il prodotto ha delle avanzate
		$queryof="select * from avanzate where idprodotto='".$idprod."'";
		$risof=mysql_query($queryof) or die ("Query: ".$queryof." non eseguita!");
		$idavanzate=@mysql_result($risof,0,0);
		$legno=@mysql_result($risof,0,2);
		$colore=@mysql_result($risof,0,3);
		$anno=@mysql_result($risof,0,4);
		$ante=@mysql_result($risof,0,5);
		$cassetti=@mysql_result($risof,0,6);
		$posti=@mysql_result($risof,0,7);
		$finitura=@mysql_result($risof,0,8);
		$laccatura=@mysql_result($risof,0,9);
		$forma=@mysql_result($risof,0,10);
		$tipo=@mysql_result($risof,0,11);
		$stile=@mysql_result($risof,0,12);
		$particolari=@mysql_result($risof,0,13);
		
		if($record>0){
?>
			<div class="box-prodotti">
				<div class="container-prodotti">
					<div class="box-dettagli">
						<div class="anteprima-prodotto">
							<div class="imgprincipale">
								<a href="<?php print "http://".$_SERVER['HTTP_HOST']; ?>/upload/<?php print $immaginemax; ?>" rel="lightbox" title="<?php print $nomeprod; ?>">
									<img src="<?php print "http://".$_SERVER['HTTP_HOST']; ?>/upload/<?php print $immaginemax; ?>" alt="<?php print $nomeprod; ?>">
								</a>
							</div>
							<div class="imgcorrelati">
<?php							//Altre immagini
								$queryimg="select * from immagini where idprodotto='".mysql_real_escape_string($idprod)."'";
								$imgdb=mysql_query($queryimg) or die ("Query: ".$query1." non eseguita!");
								while($dataimg=mysql_fetch_array($imgdb)){	
									if($immaginemax!=$dataimg[3]){
										//ricavo nome immagine
										$nomeimg=explode(chr(47),$dataimg[2]);
										$nomeimg=array_pop($nomeimg);
?>										<a href="<?php print "http://".$_SERVER['HTTP_HOST']; ?>/upload/<?php print $dataimg[3]; ?>" rel="lightbox" title="<?php print $nomeimg; ?>">
											<img src="<?php print "http://".$_SERVER['HTTP_HOST']; ?>/upload/<?php print $dataimg[2]; ?>" alt="<?php print $nomeimg; ?>">
										</a>
<?php								}
								}
?>							</div>
						</div>
						<div class="dettagli-prodotto">
							<!--<div class="box-direzione">
								<a href="#0" title="" class="direzione"><img src="immagini/destra.png" alt=""></a>
								<a href="#0" title="" class="direzione"><img src="immagini/sinistra.png" alt=""></a>
							</div>-->
							<!--<p class="marca"><a href="/<? print puliscistring($nomecat)."-".$idm; ?>/index.html" title="<?php print "Permalink a ".stripslashes($nomecat); ?>" class="linksc"><?php print stripslashes($nomecat); ?></a></p>-->
							<p class="nome"><a href="http://<?php print $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];  ?>" title="<?php print "Permalink a ".$nomeprod; ?>" class="linksc"><?php print stripslashes($nomeprod); ?></a></p>
<?php 						if(strlen($prezzo)>0){							
?>								<p class="prezzo"><span>&euro; <?php print decimali($prezzo); ?></span></p><!--<p class="prezzo">Prezzo:<span>&euro; <?php print decimali($prezzo); ?></span></p>-->
<?php						}
							//Se il prodotto è disponibile stampo la voce "disponibile", altrimenti la voce "non disponibile" 
							if($bloccato==0){
?>								<p class="disp">Disponibile</p>
<?php						}else{
?>								<p class="nodisp">Non disponibile</p>
<?php						}
?>							<div class="box-conferma">
<?php							//Controllo se si tratta di un'offerta (o un prodotto in vendita) o di un prodotto normale
								if(strlen($prezzo)>0 or $prodottoInVendita){
									if($bloccato==0){
?>										<form class="form-center" action="/tema/logcarrello.php" name="contattaci" method="POST">
											<input class="richiesta" type="submit" id="submit" name="submit" value="Aggiungi al carrello">
											<input type="hidden" name="idprod" id="idprod" value="<? print $idprod; ?>">
											<input type="hidden" name="idutente" id="idutente" value="<? print $_SESSION['utente']; ?>">
										</form>	
<?									}	
								}else{
									if($bloccato==0){
?>										<div class="richiediprev">
											<form class="form-center" action="/tema/logpreventivo.php" name="contattaci" method="POST">
												<input class="richiesta" type="submit" id="submit" name="submit" value="Richiedi preventivo">
												<input type="hidden" name="idprod" id="idprod" value="<? print $idprod; ?>">
												<input type="hidden" name="idutente" id="idutente" value="<? print $_SESSION['utente']; ?>">
											</form>
										</div>
<?php								}
								}
?>							</div>

						</div>
                        							<div class="descr"><?php print utf8_encode(puliscitesto($descprod));?></div>
<?							if($misura!="L.  P.  H. "){
								print "<div class=\"misprod\">Dimensioni: ".$misura."</div>";
							}
							if($misura3!="H.  D. "){
								print "<div class=\"misprod\">Dimensioni: ".$misura3."</div>";
							}
							if($misura2!="L.  P.  H. "){
								print "<div class=\"misprod\">Dimensioni: ".$misura2."</div>";
							}
							
							//Stampo le misure nuove
							$sql_misure_nuove="SELECT `l`,`p`, `h`, `d`, `nome` FROM misure_prodotto WHERE `idprodotto`=" . mysql_real_escape_string($idprod);
							$rs_misure_nuove = mysql_query($sql_misure_nuove) or die ("Query: ".$sql_misure_nuove." non eseguita!");
							while($data_misure=mysql_fetch_array($rs_misure_nuove)){
								print "<div class='altremisure'>";
								print "<p>" . $data_misure[4] . "</p>";
								print "Dimensioni HxLxP";
								if ((strlen($data_misure[3]) > 0) AND ($data_misure[3] != 0)){
									print "xD";
								}
								print " (cm) <br/>";
								print $data_misure[2] . "x" . $data_misure[0] . "x" . $data_misure[1];
								if ((strlen($data_misure[3]) > 0) AND ($data_misure[3] != 0)){
									print "x" . $data_misure[3] . "";
								}
								print "</div>";
							}
?>
<?php					//Avanzate del prodotto
						if(strlen($idavanzate)>0){ 
?>
								<div class="testo">AVANZATE</div>
								<div class="divavanzate">
									<div class="nomeavanzata">Legno:</div><div class="descrizioneavanzata"><? print $legno; ?></div>
									<div class="clear"></div>
									<div class="nomeavanzata">Colore:</div><div class="descrizioneavanzata"><? print $colore; ?></div>
									<div class="clear"></div>
									<div class="nomeavanzata">Anno:</div><div class="descrizioneavanzata"><? print $anno; ?></div>
									<div class="clear"></div>
									<div class="nomeavanzata">Ante:</div><div class="descrizioneavanzata"><? print $ante; ?></div>
									<div class="clear"></div>
									<div class="nomeavanzata">Cassetti:</div><div class="descrizioneavanzata"><? print $cassetti; ?></div>
									<div class="clear"></div>
									<div class="nomeavanzata">Posti:</div><div class="descrizioneavanzata"><? print $posti; ?></div>
									<div class="clear"></div>
									<div class="nomeavanzata">Finitura:</div><div class="descrizioneavanzata"><? print $finitura; ?></div>
									<div class="clear"></div>
									<div class="nomeavanzata">Laccatura:</div><div class="descrizioneavanzata"><? print $laccatura; ?></div>
									<div class="clear"></div>
									<div class="nomeavanzata">Forma:</div><div class="descrizioneavanzata"><? print $forma; ?></div>
									<div class="clear"></div>
									<div class="nomeavanzata">Tipo:</div><div class="descrizioneavanzata"><? print $tipo; ?></div>
									<div class="clear"></div>
									<div class="nomeavanzata">Stile:</div><div class="descrizioneavanzata"><? print $stile; ?></div>
									<div class="clear"></div>
									<div class="nomeavanzata">Particolari:</div><div class="descrizioneavanzata"><? print $particolari; ?></div>
									<div class="clear"></div>
								</div>
<?
						}
?>
					</div>
				</div>
			</div>
<?php
			//Inserisco i prodotti simili
			$queryprodsimili="SELECT * FROM `prodotti` WHERE `id` IN (SELECT `idsimile` FROM `prodottisimili` WHERE `idprodotto`='".mysql_real_escape_string($idprod)."')";
			$prodsimili=mysql_query($queryprodsimili) or die ("Query: ".$queryprodsimili." non eseguita!");
			if (mysql_num_rows($prodsimili)!=0){
?>
				<div class="box-titleprodotti">
					<div class="titleprodotti">
						<h2>Prodotti correlati</h2>
					</div>
				</div>
				<div class="box-prodotti">
					<div class="container-prodotti">
<?php
						$cont=0;
						while($data=mysql_fetch_array($prodsimili)){
							$idprodotto=$data[0];
							$titoloprodotto=utf8_encode($data[1]);
							
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
							
							//Stampa prodotti
							include "singoloprodottosimile.php";
						}
?>
					</div>
				</div>
<?php
			}
			mysql_close($db);
		}else{
			include "error404.php";
		}
	}else{
		include "error404.php";
	}
?>