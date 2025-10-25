<ul id="sliding-navigation">
	
		<div class="contenutobutton">
			<form action="bacheca.php" method="post">
				<input type="image" src="<?php print "http://".$_SERVER['HTTP_HOST']; ?>/w-admin/immagini/titolomenu.jpg" name="wp-submit" id="wp-submit" value="Collegati"/>
			</form>	
		</div>	


		<div class="contenutobutton">
			<form name="loginform" id="loginform" action="<?php print "http://".$_SERVER['HTTP_HOST']; ?>/blog/wp-login.php" method="post">
				<input type="hidden" name="log" id="user_login" class="input" value="admin" size="20" tabindex="10" />
				<input type="hidden" name="pwd" id="user_pass" class="input" value="mobili" size="20" tabindex="20" />
				<input type="hidden" name="redirect_to" value="<?php print "http://".$_SERVER['HTTP_HOST']; ?>/blog/wp-admin/" />
				<input type="hidden" name="testcookie" value="1" />
				<input type="image" src="<?php print "http://".$_SERVER['HTTP_HOST']; ?>/w-admin/immagini/titoloblog.jpg" name="wp-submit" id="wp-submit" value="Collegati"/>
			</form>
		</div>

		
		<div class="contenutobutton">
			<form name="autoLoginbutton1" id="autoLoginbutton1" action="https://www.google.com/analytics/reporting/login?ctu=https%3A%2F%2Fwww.google.com%2Fanalytics%2Fsettings%2F%3F" method="POST">
				<input type="image" src="<?php print "http://".$_SERVER['HTTP_HOST']; ?>/w-admin/immagini/titolostatistiche.jpg" value="Collegati"/>
			</form>
		</div>
		
	<hr style="width: 200px;">
</ul>
<!--------Start Menu---------->
<div class="mainDiv" state="0" style="margin-bottom: 20px;">
<div class="topItemm" classOut="topItem" classOver="topItemOver" onMouseOver="Init(this);" >
	<label>Prezzi</label>
</div>        
<div class="dropMenu" >
	<div class="subMenu" state="0">
		<span class="subItem" classOut="subItem" classOver="subItemOver"><a href="caricoprezzi.php">Gestione prezzi</a></span><BR />
	</div>
</div>
</div>
<!--------End Menu---------->
<!--------Start Menu---------->
<div class="mainDiv" state="0">
<div class="topItem8" classOut="topItem" classOver="topItemOver" onMouseOver="Init(this)" >
	<label>Priorit&agrave;</label>
</div>        
<div class="dropMenu" >
	<div class="subMenu" state="0">
		<span class="subItem" classOut="subItem" classOver="subItemOver"><a href="gestionepriorita.php">Gestione priorit&agrave;</a></span><BR />
	</div>
</div>
</div>
<!--------End Menu---------->
<BR />
<!--------Start Menu---------->
<div class="mainDiv" state="0">
<?php	//Dati database
	include "../config.php";
	//connessione al database
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	//selezione del database
	mysql_select_db($database) or die ("Non riesco a selezionare il database");
	//marche
	$qm='select * from marche';
	$rm=mysql_query($qm) or die ("Query: ".$qm." non eseguita!");
	//conto le marche
	$nummarchedb=mysql_num_rows($rm);
	if($nummarchedb>0){?>
		<div class="topItem" classOut="topItem" classOver="topItemOver" onMouseOver="Init(this);" >
			<label>Prodotti</label>
		</div> 
<?php }else{ ?>
		<div class="topItem" classOut="topItem" classOver="topItemOver" OnClick="javascript: alert('Attenzione prima di caricare un prodotto devi inserire una Marca'); window.location='caricomarca.php'">
			<label>Prodotti</label>
		</div> 
<?php }?>	
<div class="dropMenu" >
	<div class="subMenu" state="0">
		<span class="subItem" classOut="subItem" classOver="subItemOver"><a href="caricoprodotti.php">Aggiungi nuovo</a></span><BR />
		<span class="subItem" classOut="subItem" classOver="subItemOver"><a href="gestioneprodotti.php">Visualizza Prodotti</a></span><BR />
	</div>
</div>
</div>

<!--------End Menu---------->
<BR />
<!--------Start Menu---------->
<div class="mainDiv" state="0">
<div class="topItem5" classOut="topItem" classOver="topItemOver" onMouseOver="Init(this)" >
	<label>Categorie</label>
</div>        
<div class="dropMenu" >
	<div class="subMenu" state="0">
		<span class="subItem" classOut="subItem" classOver="subItemOver"><a href="categorie.php">Gestione categorie</a></span><BR />
	</div>
</div>
</div>
<!--------End Menu---------->
<BR />
<!--------Start Menu---------->
<div class="mainDiv" state="0">
<div class="topItem4" classOut="topItem" classOver="topItemOver" onMouseOver="Init(this)" >
	<label>Marche</label>
</div>        
<div class="dropMenu" >
	<div class="subMenu" state="0">
		<span class="subItem" classOut="subItem" classOver="subItemOver"><a href="caricomarca.php">Aggiungi nuova</a></span><BR />
		<span class="subItem" classOut="subItem" classOver="subItemOver"><a href="gestionemarca.php">Visualizza Marche</a></span><BR />
	</div>
</div>
</div>
<!--------End Menu---------->
<BR />
<!--------Start Menu---------->
<div class="mainDiv" state="0">
<div class="topItem9" classOut="topItem" classOver="topItemOver" onMouseOver="Init(this)" >
	<label>Banner</label>
</div>        
<div class="dropMenu" >
	<div class="subMenu" state="0">
		<span class="subItem" classOut="subItem" classOver="subItemOver"><a href="caricobanner.php">Aggiungi nuovo</a></span><BR />
		<span class="subItem" classOut="subItem" classOver="subItemOver"><a href="gestionebanner.php">Visualizza Banner</a></span><BR />
	</div>
</div>
</div>
<!--------End Menu---------->
<BR />
<!--------Start Menu---------->
<div class="mainDiv" state="0">
<div class="topItem1" classOut="topItem" classOver="topItemOver" onMouseOver="Init(this)" >
	<label>Utenti</label>
</div>        
<div class="dropMenu" >
	<div class="subMenu" state="0">
		<span class="subItem" classOut="subItem" classOver="subItemOver"><a href="inserimentoutente.php">Aggiungi nuovo</a></span><BR />
		<span class="subItem" classOut="subItem" classOver="subItemOver"><a href="gestioneutente.php">Visualizza Utenti</a></span><BR />
	</div>
</div>
</div>
<!--------End Menu---------->
<BR />
<!--------Start Menu---------->
<div class="mainDiv" state="0">
<div class="topItem6" classOut="topItem" classOver="topItemOver" onMouseOver="Init(this)" >
	<label>Newsletter</label>
</div>        
<div class="dropMenu" >
	<div class="subMenu" state="0">
		<span class="subItem" classOut="subItem" classOver="subItemOver"><a href="invionewsletter.php">Inserimento newsletter</a></span><BR />
		<span class="subItem" classOut="subItem" classOver="subItemOver"><a href="gestionenewsletter.php">Visualizza newsletter</a></span><BR />
	</div>
</div>
</div>
<!--------End Menu---------->
<BR />
<!--------Start Menu---------->
<div class="mainDiv" state="0">
<div class="topItem7" classOut="topItem" classOver="topItemOver" onMouseOver="Init(this)" >
	<label>Preventivi</label>
</div>        
<div class="dropMenu" >
	<div class="subMenu" state="0">
		<span class="subItem" classOut="subItem" classOver="subItemOver"><a href="gestionepreventivo.php">Visualizza Preventivi</a></span><BR />
	</div>
</div>
</div>
<!--------End Menu--------->
<BR />
<!--------Start Menu---------->
<div class="mainDiv" state="0">
<div class="topItem7" classOut="topItem" classOver="topItemOver" onMouseOver="Init(this)" >
	<label>Cestino</label>
</div>        
<div class="dropMenu" >
	<div class="subMenu" state="0">
		<span class="subItem" classOut="subItem" classOver="subItemOver"><a href="gestionepreventivocestinati.php">Preventivi Cestinati</a></span><BR />
	</div>
</div>
</div>
<!--------End Menu--------->
<BR />
<!--------Start Menu---------->
<div class="mainDiv" state="0">
<div class="topItem2" classOut="topItem" classOver="topItemOver" onMouseOver="Init(this)" >
	<label>Opzioni</label>
</div>	
<div class="dropMenu" >
	<div class="subMenu" state="0">
		<span class="subItem" classOut="subItem" classOver="subItemOver"><a href="opzioni.php">Impostazioni</a></span><BR />
	</div>
</div>
</div>
<!--------End Menu---------->