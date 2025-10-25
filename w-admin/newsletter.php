<?	
		
	//config
	include "../config.php";
	//connessione al database
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	//selezione del database
	mysql_select_db($database) or die ("Non riesco a selezionare il database");
	$query1="select email from utenti where admin!='1' and newsletter='si'";
	$email1=mysql_query($query1) or die ("Query: ".$query1." non eseguita!");
	//tutte le email
	$fine=mysql_num_rows($email1);
	//settaggio variabili
	if(isset($_GET['corrente']) and strlen($_GET['corrente'])>0){
		$corrente=$_GET['corrente'];
	}else{
		$corrente=0;
	}
	$idnews=$_GET['news'];
	//cerco il tiotlo e la descrizione della newsletter
	$query2="select * from newsletter where id='".$idnews."'";
	$emailnews=mysql_query($query2) or die ("Query: ".$query2." non eseguita!");
	$titolon=@mysql_result($emailnews,0,1);
	$descn=@mysql_result($emailnews,0,2);
	include "inclusi/emailnewsletter.php";
	//trovo tutti gli utenti registrati
	$query="select email from utenti where admin!='1' and newsletter='si' LIMIT ".$corrente.",10";
	$email=mysql_query($query) or die ("Query: ".$query." non eseguita!");
	while($data=mysql_fetch_array($email)){
		mail($data[0],$titolon,$maild,$header);
	}
	$corrente=$_GET['corrente']+10;
	if(($fine-$_GET['corrente'])<10){
		$corrente=($_GET['corrente']+10)+($fine-$corrente);
	}
	
	//Ricavo il browser usato
	$lista=$_SERVER['HTTP_USER_AGENT'];
	$browser=explode(';',$lista);
	$browser=$browser[1]; 
?>
<html>
<head>
	<? 
		if(strstr($browser, 'MSIE')==true){
	?>
			<link rel="stylesheet" type="text/css" href="css/newsletter.css" />
	<?	}else{?>
			<link rel="stylesheet" type="text/css" href="css/newsletter_moz.css" />
	<?	}?>
</head>
<body>
<div class="contenitore">
	<div class="freccie">
		<img src="immagini/freccie.gif">
	</div>
	<div class="testo"><br />
<?		if($corrente==$fine){
?>			<div class="tlabel">Invio Newsletter completato!</div>
<?		}else{
?>			<div class="tlabel"><? print $corrente. "/" .$fine; ?></div>Email inviate!
<?		}
?>	</div>
	<div class="buffer">
		<img src="immagini/buffermod.gif">
	</div>
</div>	
</body>
</html>
<?	if($corrente!=$fine){
?>		<script language="javascript">
		//vieni rindirizzato alla pagina della gestione delle categorie
		function doLoad()  { setTimeout( 'refresh()', 2000 ); }
		function refresh() { window.location.href = '<? print "http://".$_SERVER['SERVER_NAME']."/w-admin/newsletter.php?corrente=".$corrente;?>';}
		</script>
		<body onload='doLoad()'>
<?	}else{
?>		<script language="javascript">
		//vieni rindirizzato alla pagina della gestione delle categorie
		function doLoad1()  { setTimeout( 'refresh1()', 5000 ); }
		function refresh1() { top.frames['scrivipagina'].style.display='none'; top.aggiorna();}

		</script>
		<body onload='doLoad1(); top.aggiorna();'>
<?	}
?>