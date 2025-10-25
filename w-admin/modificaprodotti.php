<?php	//Inizializzo sessione
	session_start();
	//Se è stato effettuato il login accedi a questa pagina
	if(isset($_SESSION['wadmin']) and $_SESSION['wadmin']=="1"){
		$posstr=strpos($_SERVER["HTTP_REFERER"], "gestioneprodotti.php");
		if ($posstr != false){
			$_SESSION['paginaprecedente']=$_SERVER["HTTP_REFERER"];
		}
	//Dati database
	include "../config.php";
	include "functions.php";
	//connessione al database
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	//selezione del database
	mysql_select_db($database) or die ("Non riesco a selezionare il database");
	//query di ricavo informazione prodotto
	$query=mysql_query("select * from prodotti where id='".$_GET['mod']."'") or die ("Query: non eseguita!");
	//Settaggio variabili
	if(isset($_POST['back']) and $_POST['back']=="errore"){
		$titolo=$_POST['titolo'];
		$descrizione=$_POST['descrizione'];
		$idmarca=$_POST['marca'];
		$idcat=$_POST['categoria'];
		$lunghezza=$_POST['l'];
		$profondita=$_POST['p'];
		$altezza=$_POST['h'];
		$lunghezza2=$_POST['l2'];
		$profondita2=$_POST['p2'];
		$altezza2=$_POST['h2'];
		$altezza3=$_POST['h3'];
		$diametro=$_POST['d'];
		$listaimg=$_POST['arrayimg'];
	}else{
		$titolo=@mysql_result($query,0,1);
		$descrizione=@mysql_result($query,0,2);
		$idmarca=@mysql_result($query,0,3);
		$lunghezza=@mysql_result($query,0,4);
		$profondita=@mysql_result($query,0,5);
		$altezza=@mysql_result($query,0,6);
		//immagini del prodotto
		$queryimg="select imgmin from prodotti,immagini where prodotti.id=idprodotto and idprodotto='".$_GET['mod']."'";
		$risult=mysql_query($queryimg) or die ("Query: ".$queryimg." non eseguita!");
	}
	
	//$querycategorie=mysql_query("select * from assegnazionecategorie where idprodotto='".$_GET['mod']."'") or die ("Query: non eseguita!");
	//$idcat=@mysql_result($query,0,4);
	//query per vedere se il prodotto è un'offerta
	$querymis=mysql_query("select * from misure where idprodotto='".$_GET['mod']."'") or die ("Query:  non eseguita!");
	$misuredb=@mysql_result($querymis,0,0);
	$lunghezza2=@mysql_result($querymis,0,4);
	$profondita2=@mysql_result($querymis,0,6);
	$altezza2=@mysql_result($querymis,0,5);
	$altezza3=@mysql_result($querymis,0,3);
	$diametro=@mysql_result($querymis,0,2);
	$offerte=0;
	//query per vedere se il prodotto ha doppie misure
	$queryoff="select * from offerte where idprodotto='".$_GET['mod']."'";
	$risoff=mysql_query($queryoff) or die ("Query: ".$queryoff." non eseguita!");
	if (mysql_num_rows($risoff)==0){
		$queryoff="select * from prodottivendita where idprodotto='".$_GET['mod']."'";
		$risoff=mysql_query($queryoff) or die ("Query: ".$queryoff." non eseguita!");
		if (mysql_num_rows($risoff)!=0){
			$offerte=2;
		}
	}else{
		$offerte=1;
	}
	$offerta=@mysql_result($risoff,0,0);
	$prezzo=@mysql_result($risoff,0,2);
	//query per vedere se il prodotto ha delle avanzate
	$queryof="select * from avanzate where idprodotto='".$_GET['mod']."'";
	$risof=mysql_query($queryof) or die ("Query: ".$queryof." non eseguita!");
	$idavanzate=@mysql_result($risof,0,0);
	$legno=puliscitesto(utf8_encode(@mysql_result($risof,0,2)));
	$colore=puliscitesto(utf8_encode(@mysql_result($risof,0,3)));
	$anno=puliscitesto(utf8_encode(@mysql_result($risof,0,4)));
	$ante=puliscitesto(utf8_encode(@mysql_result($risof,0,5)));
	$cassetti=puliscitesto(utf8_encode(@mysql_result($risof,0,6)));
	$posti=puliscitesto(utf8_encode(@mysql_result($risof,0,7)));
	$finitura=puliscitesto(utf8_encode(@mysql_result($risof,0,8)));
	$laccatura=puliscitesto(utf8_encode(@mysql_result($risof,0,9)));
	$forma=puliscitesto(utf8_encode(@mysql_result($risof,0,10)));
	$composto=puliscitesto(utf8_encode(@mysql_result($risof,0,11)));
	$stile=puliscitesto(utf8_encode(@mysql_result($risof,0,12)));
	$particolari=puliscitesto(utf8_encode(@mysql_result($risof,0,13)));
	//query per prendere tutte le misure
	$query_prodotti_nuovi=mysql_query("select * from misure_prodotto where idprodotto='".$_GET['mod']."'") or die ("Query: non eseguita!");
	//query per vedere se le categoria associate al prodotto
	$queryasscat=mysql_query("select * from assegnazionecategorie where idprodotto='".$_GET['mod']."'") or die ("Query:  non eseguita!");
	$listaidcategorie=Array();
	while($data=mysql_fetch_array($queryasscat)){
		$querynomecat=mysql_query("select * from categorie where id='".$data[2]."'") or die ("Query:  non eseguita!");
		if(strlen(@mysql_result($querynomecat,0,1))>0){
			array_push($listaidcategorie,@mysql_result($querynomecat,0,0));
		}
	}
	//Prendo tutti i prod simili facendo prima query dei simili per prendere i vari id dei prodotti simili
	$queryasprodsimili=mysql_query("select * from prodottisimili where idprodotto='".$_GET['mod']."'") or die ("Query:  non eseguita!");
	$listaprodottisimili=Array();
	while($data=mysql_fetch_array($queryasprodsimili)){
		array_push($listaprodottisimili,$data[2]);
	}
?>	
<html>
<head>
	<title>W-admin -- Modifica prodotto</title>
	<!--STILE BACHECA-->
	<link rel="stylesheet" type="text/css" href="css/bacheca.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/stylemenu.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/sddm.css" media="screen" />
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/effetto.js"></script>
	<script src="js/jquery.easing.1.3.js" type="text/javascript"></script>
	<script language="JavaScript" type="text/javascript" src="js/menu.js"></script>
	<script language="JavaScript" type="text/javascript" src="js/scripts.js"></script>
	<script type="text/javascript" src="editor/wysiwyg1.js"></script> 
	<script type="text/javascript" src="js/animatedcollapse.js"></script> 
	<script type="text/javascript" src="editor/scripts/wysiwyg.js"></script>
	<script type="text/javascript" src="editor/scripts/wysiwyg-settings.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script type="text/javascript" src="js/script_aggiunta_prodotti.js"></script>
	<script type="text/javascript">
		WYSIWYG.attach('descrizione', full); 
	</script>
	<!--FINE BACHECA-->
</head>
<body>
	<div class="box1">
<?php		include "inclusi/header.php"?>
		<div class="box3">
			<div class="menusinistra">
				<?php include "inclusi/menuleft.php"; ?>
			</div>
			<div class="menucentro">
				<img src="immagini/icona_prodotti.gif">Modifica Prodotto
				<a class="btn-navigazione-preventivo" href="<?php echo $_SESSION['paginaprecedente']; ?>">Indietro</a>
				
				<hr />
				<form action="modificadbprodotto.php?mod=<?php print $_GET['mod']; ?>" method="post" name="ins" id="ins" Onsubmit="return controlloprodotto();">
				<table style="width: 100%" border="0"  style="font-family: Arial;">
					<tr>
						<td width="500px">
							<input type="text" name="titolo" id="titolo" value="<?php print puliscitesto(utf8_encode($titolo)); ?>" size="42" style="font-size: 20px;">
						</td>
						<td width="200px">
							<a href="gestioneimgmod.php?idprod=<?php print $_GET['mod']; ?>"><img src="immagini/gestioneimg.gif" border="0"></a>
						</td>
					</tr>
				</table>
				<table style="width: 100%" height="370" border="0" style="font-family: Arial;">
					<tr>
						<td width="500px" valign="top">
							<textarea id="descrizione" name="descrizione"><? print utf8_encode(str_replace(chr(92)."'","'",$descrizione)); ?></textarea>
						</td>
						<td width="200px" valign="top">
							<b>Lista immagini</b><br>
<?php 							$listaimg=explode(",",$listaimg); ?>
							<select id="listbox" name="listbox" multiple size="3" class="listbox">
<?php 								for($a=0;$a<count($listaimg);$a++){ 
									if(strlen($listaimg[$a])>0){
?>										<option value="<?php print $listaimg[$a]; ?>" selected><?php print $listaimg[$a]; ?></option>
<?php 										$listanew=$listanew.",".$listaimg[$a];
									}
								}
								if(isset($_GET['mod']) and $_GET['mod']>0){ 
									while($db_img=mysql_fetch_array($risult)){
										if(strlen(substr($db_img[0],11))>0){
?>											<option value="<?php print substr($db_img[0],11); ?>" selected><?php print substr($db_img[0],11); ?></option>
<?php											$listanew=$listanew.",".substr($db_img[0],11);
										}
									}
								}							
?>							</select>						
						</td>
					</tr>
				</table>
				<table style="width: 100%" border="0" style="font-family: Arial;">
					<tr>
						<td width="400px">
							Marca:&nbsp;
<?php							//Seleziono la marche ke è stata scelta prima
							$marcadb="select * from marche where id='".$idmarca."'";
							$marcains=mysql_query($marcadb) or die ("Query: ".$marcadb." non eseguita!");
							$marcai=@mysql_result($marcains,0,1);
							//Seleziono tutto le marche tranne quella selezionata
							$q="select * from marche where id!='".$idmarca."' order by nome asc";
							$r=mysql_query($q) or die ("Query: ".$q." non eseguita!");
?>							<select name='marca'>
								<option value='<?php print $idmarca; ?>' selected><?php print puliscitesto(utf8_encode($marcai)); ?></option>
								<option value="0">--Marca--</option>
<?php								while($data=mysql_fetch_array($r)){
?>									<option value='<?php print $data[0]; ?>'><?php print puliscitesto(utf8_encode($data[1])); ?></option>
<?php 								}
?>							</select>
						</td>
					</tr>
				</table>
				<table style="width: 100%" border="0" style="font-family: Arial;">	
					<hr />
					<tr>
						<td width="400px">
							<script>var lista=new Array("0");</script>
							Categoria:&nbsp;
							<select name='categoria' style="width: 210px;">
								<option value="0">--Categoria--</option> 
<?php							$ris=mysql_query("select * FROM categorie where appartenenza ='0'") or die ("Query: categorie non eseguita!");
								while($data=mysql_fetch_array($ris)){ 
									categoriesadmin($data[0],1); 
								}
?>							</select>
							<input type="button" name="selcat" id="selcat" value="Inserisci" onclick="javascript: aggiungivoce(document.ins.categoria.options[document.ins.categoria.selectedIndex].value,lista[document.ins.categoria.options[document.ins.categoria.selectedIndex].index],document.ins.listboxcategorie);">							
						</td>
						<td style="width: 210px; text-align: right;">
							<div style="margin-right: 105px;">Lista categorie</div>
							<select name="listboxcategorie[]" id="listboxcategorie" multiple="multiple" size="3" style="height: 100px; width: 210px;">
<?php							if(isset($listaidcategorie) and count($listaidcategorie)>0){
									for($a=0; $a<count($listaidcategorie); $a++){
										$querynomecat = mysql_query("SELECT * FROM `categorie` where id='".$listaidcategorie[$a]."'") or die("Errore.La query nome categoria non è stata eseguita");
										$nomecatdb=@mysql_result($querynomecat,0,1);
										print "<option value=".$listaidcategorie[$a].">".$nomecatdb."</option>";
									}
								}
?>							</select>
							<br />
							<input type="button" name="delcat" id="delcat" value="Elimina"  onclick="javascript: toglivoce(document.ins.listboxcategorie);">
						</td>
					</tr>
				</table>
				<hr />
				<table style="width: 100%" border="0" style="font-family: Arial;">	
					<tr>
						<td width="400px">
							Prodotti:&nbsp;
<?php						//ricavo tutte le categorie inseriti
							$q='select * from prodotti order by titolo asc';	
							$r=mysql_query($q) or die ("Query: ".$q." non eseguita!");
?>							<script>var listaprodottisimili=new Array("0");</script>
							<select name='prodottisimili' style="width: 210px;">
								<option value="0">--Prodotto--</option>
<?php								while($data=mysql_fetch_array($r)){
?>										<option value='<?php print $data[0]; ?>'><?php print $data[1]; ?></option>
										<script>
											listaprodottisimili.push("<?php print $data[1]; ?>");
										</script>
<?php 								}
?>							</select>
							<input type="button" name="selcat" id="selcat" value="Inserisci" onclick="javascript: aggiungivoce(document.ins.prodottisimili.options[document.ins.prodottisimili.selectedIndex].value,listaprodottisimili[document.ins.prodottisimili.options[document.ins.prodottisimili.selectedIndex].index],document.ins.listboxprodottisimili);">							
						</td>
						<td align="right">
							<div style="margin-right: 185px;">Lista Prodotti simili</div>
							<select name="listboxprodottisimili[]" id="listboxprodottisimili" multiple size="5" style="height: 100px; width: 318px;">
<?php							if(isset($listaprodottisimili) and count($listaprodottisimili)>0){
									for($a=0; $a<count($listaprodottisimili); $a++){
										$querynomeprodsimili = mysql_query("SELECT * FROM `prodotti` where id='".$listaprodottisimili[$a]."'") or die("Errore.La query dei prodotti simili non è stata eseguita");
										$nomeprodsimiledb=@mysql_result($querynomeprodsimili,0,1);
										print "<option value=".$listaprodottisimili[$a].">".$nomeprodsimiledb."</option>";
									}
								}
?>							</select>
							<br />
							<input type="button" name="delcat" id="delcat" value="Elimina"  onclick="javascript: toglivoce(document.ins.listboxprodottisimili);">
						</td>
					</tr>
				</table>
				<hr />
				<table style="width: 100%; font-family: Arial; margin-top: 30px; margin-bottom: 30px; background-color: #D5E2EB;">
					<tr>
						<td height="50">
							Misure: <br />
							L: <input type="text" name="l" id="l" value="<?php print $lunghezza; ?>" size="2"> P: <input type="text" name="p" id="p" value="<?php print $profondita; ?>"  size="2"> H: <input type="text" name="h" id="h" value="<?php print $altezza; ?>"  size="2">
						</td>
					</tr>
<?php					if(strlen($misuredb)>0){					
?>						<tr>					
							<td height="50">
								<b>Altre Misure:</b> 
								<input type="radio" checked="checked" name="misureex" id="misureex" Onclick="javascript: document.getElementById('divanimatom').style.display = 'block';" value="1"> Attiva 
								<input type="radio" name="misureex" id="misureex" Onclick="javascript: document.getElementById('divanimatom').style.display = 'none';"  value="0"> Disattiva
								<br />
								<div id="divanimatom" style="display:block" class="offerte">
									L2: <input type="text" name="l2" id="l2" value="<?php print $lunghezza2; ?>" size="2"> P2: <input type="text" name="p2" id="p2" value="<?php print $profondita2; ?>"  size="2"> H2: <input type="text" name="h2" id="h2" value="<?php print $altezza2; ?>"  size="2"><br /><br />
									D2: <input type="text" name="d" id="d" value="<?php print $diametro; ?>"  size="2"> H2: <input type="text" name="h3" id="h3" value="<?php print $altezza3; ?>"  size="2">
								</div>
							</td>
						</tr>
<?php					}else{
?>						<tr>					
							<td height="50">
								<b>Seconde Misure:</b> 
								<input type="radio" name="misureex" id="misureex" Onclick="javascript: document.getElementById('divanimatom').style.display = 'block';" value="1"> Attiva 
								<input type="radio" checked="checked" name="misureex" id="misureex" Onclick="javascript: document.getElementById('divanimatom').style.display = 'none';"  value="0"> Disattiva
								<br />
								<div id="divanimatom" style="display:none" class="offerte">
									L2: <input type="text" name="l2" id="l2" value="<?php print $lunghezza2; ?>" size="2"> P2: <input type="text" name="p2" id="p2" value="<?php print $profondita2; ?>"  size="2"> H2: <input type="text" name="h2" id="h2" value="<?php print $altezza2; ?>"  size="2"><br /><br />
									D2: <input type="text" name="d" id="d" value="<?php print $diametro; ?>"  size="2"> H2: <input type="text" name="h3" id="h3" value="<?php print $altezza3; ?>"  size="2">
								</div>
							</td>
						</tr>
<?php					}
?>				</table>

				<table style="width: 100%; font-family: Arial; margin-top: 30px; margin-bottom: 30px; background-color: #D5E2EB; position: relative; top: 0px;">
					<tbody id="lista_tutti_prodotti">
<?php			
				if (mysql_num_rows($query_prodotti_nuovi) == 0){?>
					<tr>
						<td height="50" id="prodotto_1">
						
							Misure: <br /><div id="aggiungi_nuova_misura" onclick="aggiungi_prodotto();"></div>
							L: <input type="text" name="prodottoNuovo[0][l]" id="l" value="<?php print $l; ?>" size="2"> P: <input type="text" name="prodottoNuovo[0][p]" id="p" value="<?php print $p; ?>"  size="2"> H: <input type="text" name="prodottoNuovo[0][h]" id="h" value="<?php print $h; ?>"  size="2"> D: <input type="text" name="prodottoNuovo[0][d]" id="d" value="<?php print $d; ?>"  size="2"> Nome: <input type="text" name="prodottoNuovo[0][nome_prod_tmp]" id="nome_prod" value="<?php print $nome_prod; ?>"  size="53">
						</td>
					</tr>
<?php				} else{
					$num_righe_vis = -1;
					while($data=mysql_fetch_array($query_prodotti_nuovi)){
					$num_righe_vis = $num_righe_vis + 1;
?>
					
					<tr>
<?php
						if ($num_righe_vis == 0) {
							print "<td height=\"50\" id=\"prodotto_1\">";
						}else{
							print "<td id=\"prodotto_1\">";
						}
?>
<?php						if ($num_righe_vis == 0){?>
							Misure: <br /><div id="aggiungi_nuova_misura" onclick="aggiungi_prodotto();"></div>
<?php						}?>
							L: <input type="text" name="prodottoNuovo[<?php print $num_righe_vis?>][l]" id="l" value="<?php print $data[2]; ?>" size="2"> P: <input type="text" name="prodottoNuovo[<?php print $num_righe_vis ?>][p]" id="p" value="<?php print $data[3]; ?>"  size="2"> H: <input type="text" name="prodottoNuovo[<?php print $num_righe_vis ?>][h]" id="h" value="<?php print $data[4]; ?>"  size="2"> D: <input type="text" name="prodottoNuovo[<?php print $num_righe_vis ?>][d]" id="d" value="<?php print $data[5]; ?>"  size="2"> Nome: <input type="text" name="prodottoNuovo[<?php print $num_righe_vis ?>][nome_prod_tmp]" id="nome_prod" value="<?php print $data[6]; ?>"  size="63">
						</td>
					</tr>
<?php					}
				}
?>					

					</tbody>
				</table>

				<div class="offerte">
<?php					if(strlen($offerta)>0){
?>						<input type="radio" <? if($offerte==0){ print 'checked="checked"';} ?> name="offerte" id="offerte" Onclick="javascript: document.getElementById('divanimato').style.display = 'none';" value="0"> Prodotto 
						<input type="radio" <? if($offerte==1){ print 'checked="checked"';} ?> name="offerte" id="offerte" Onclick="javascript: document.getElementById('divanimato').style.display = 'block';"  value="1"> Offerta
						<input type="radio" <? if($offerte==2){ print 'checked="checked"';} ?> name="offerte" id="offerte" Onclick="javascript: document.getElementById('divanimato').style.display = 'block';"  value="2"> Prodotti in vendita
						<div id="divanimato" style="display:block" class="offerte">
							Prezzo: <input type="text" name="prezzo" id="prezzo" value="<?php print $prezzo; ?>">
						</div><br />	
<?php					}else{
?>						<input type="radio" <? if($offerte==0){ print 'checked="checked"';}?> name="offerte" id="offerte" Onclick="javascript: document.getElementById('divanimato').style.display = 'none';" value="0"> Prodotto 
						<input type="radio" <? if($offerte==1){ print 'checked="checked"';}?> name="offerte" id="offerte" Onclick="javascript: document.getElementById('divanimato').style.display = 'block';"  value="1"> Offerta
						<input type="radio" <? if($offerte==2){ print 'checked="checked"';}?> name="offerte" id="offerte" Onclick="javascript: document.getElementById('divanimato').style.display = 'block';"  value="2"> Prodotti in vendita
						<div id="divanimato" style="display:none" class="offerte">
							Prezzo: <input type="text" name="prezzo" id="prezzo" value="<?php print $_POST['prezzo']; ?>">
						</div>
<?php					}
?>				</div><br />
<?php				if(strlen($idavanzate)>0){?>
						<div class="offerte" onmousedown="if(document.getElementById('divanimato1').style.display == 'none'){ document.getElementById('divanimato1').style.display = 'block'; }else{ document.getElementById('divanimato1').style.display = 'none'; }"> <img src="immagini/avanzate.jpg" border="0"> <u>Avanzate</u> </div>
						<div id="divanimato1" style="display:block" class="offerte1">
<?php					}else{
?>						<div class="offerte" onmousedown="if(document.getElementById('divanimato1').style.display == 'none'){ document.getElementById('divanimato1').style.display = 'block'; }else{ document.getElementById('divanimato1').style.display = 'none'; }"> <img src="immagini/avanzate.jpg" border="0"> <u>Avanzate</u> </div>
						<div id="divanimato1" style="display:none" class="offerte1">
<?php					}
?>					Legno: &nbsp;&nbsp;<input type="text" name="legno" id="legno" value="<?php print $legno; ?>"> &nbsp;&nbsp;&nbsp;&nbsp;Colore: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="colore" id="colore" value="<?php print $colore; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Anno: &nbsp;&nbsp;<input type="text" name="anno" id="anno" value="<?php print $anno; ?>" size="5"><br /><br />
					Ante: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="ante" id="ante" value="<?php print $ante; ?>"> &nbsp;&nbsp;&nbsp;&nbsp;Cassetti: &nbsp;&nbsp;&nbsp;<input type="text" name="cassetti" id="cassetti" value="<?php print $cassetti; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Posti: &nbsp;&nbsp;<input type="text" name="posti" id="posti" value="<?php print $posti; ?>" size="5"><br /><br />
					Finitura: <input type="text" name="finitura" id="finitura" value="<?php print $finitura; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Laccatura: <input type="text" name="laccatura" id="laccatura" value="<?php print $laccatura; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Forma: <input type="text" name="forma" id="forma" value="<?php print $forma; ?>"><br /><br />
					Tipo(composto, ecc):  &nbsp;&nbsp;<input type="text" name="tipo" id="tipo" value="<?php print $composto; ?>"> &nbsp;&nbsp;&nbsp;&nbsp;Stile(moderno, classico, ecc): <input type="text" name="stile" id="stile" value="<?php print $stile; ?>"><br /><br />
					Particolari:  &nbsp;&nbsp;<input type="text" name="particolari" id="particolari" value="<?php print $particolari; ?>" size="16"><br /><br />
				</div>				
				<div style="text-align:right;>
					<input type="hidden" name="caricoprod" id="caricoprod" value="esegui" />
					<input type="Submit" name="cmd" id="cmd" value="Modifica prodotto" onmouseover="javascript: selezionatutti(document.ins.listboxprodottisimili);">
				</div>	
			</div>
		</div>
	</div>
</body>
</html>
<?php }else{
?>	<meta http-equiv="refresh" content="0 url=http://<?php print $_SERVER['HTTP_HOST'];?>">
<?php	
}?>