<?	//Inizializzo sessione
	session_start();
	//Se è stato effettuato il login accedi a questa pagina
	if(isset($_SESSION['wadmin']) and $_SESSION['wadmin']=="1"){
	//Dati database, connessione e selezione del database
	include "../config.php";
	//Funzioni
	include "functions.php";
	//Elimina preventivo
	include "inclusi/eliminazione_preventivi.php";
	//Controllo se devo inserire la ? o la & nell'eliminazione
	include	"inclusi/percorso_eliminazione_categoria.php";
	
	//connessione al database
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	//selezione del database
	mysql_select_db($database) or die ("Non riesco a selezionare il database");
	
	//Ricavo il browser osato
	$lista=$_SERVER['HTTP_USER_AGENT'];
	$browser=explode(';',$lista);
	$browser=$browser[1]; 
	
//QUERY DI RICERCA	
//Controllo se la form è stata eseguita
if(isset($_POST['ricercap']) and strlen($_POST['ricercap'])>0){
	$primaquery=false;
	$queryselect="SELECT * FROM preventivi";

	//numero preventivo
	if(isset($_POST['nump']) and strlen($_POST['nump'])>0 and is_numeric($_POST['nump'])==true){
		$newselect="";
		$qnum=$_POST['nump'];
		if($primaquery==true){
			$newselect=$querytotale." and ";
			$querytotale=$newselect." idpreventivo ='$qnum'";
		}else{
			$newselect=$querytotale." where ";
			$primaquery=true;
			$querytotale=$querytotale.$newselect." idpreventivo='$qnum'";
		}
	}
	
	//id utente
	if(strlen($_POST['nome'])>0 or strlen($_POST['cognome'])>0){
		$nomefind=$_POST['nome'];
		$cognomefind=$_POST['cognome'];
		//composizione select
		if(strlen($nomefind)>0){ $a=" nome LIKE '%$nomefind%'";}
		if(strlen($cognomefind)>0){ 
			if(strlen($nomefind)>0){
				$b=" and cognome LIKE '%$cognomefind%'";
			}else{
				$b=" cognome LIKE '%$cognomefind%'";
			}	
		}
		//ricerca del nome e cognome
		$queryricerca=mysql_query("SELECT * FROM utenti WHERE ".$a.$b) or die ("Query: ricerca nome non eseguita!");
		$idutente=@mysql_result($queryricerca,0,0);
		if(strlen($idutente)>0){
			$newselect="";
			$qidutente=$idutente;
			if($primaquery==true){
				$newselect=$querytotale." and ";
				$querytotale=$newselect." idutente ='$qidutente'";
			}else{
				$newselect=$querytotale." where ";
				$primaquery=true;
				$querytotale=$querytotale.$newselect." idutente='$qidutente'";
			}
		}	
	}
	
	//giorno
	if(isset($_POST['giorno']) and $_POST['giorno']!=0){
		$newselect="";
		$qgiorno=$_POST['giorno'];
		if($primaquery==true){
			$newselect=$querytotale." and ";
			$querytotale=$newselect." Day(data)=$qgiorno";
		}else{
			$newselect=$querytotale." where ";
			$primaquery=true;
			$querytotale=$querytotale.$newselect." Day(data)=$qgiorno";
		}
	}
	
	//mese
	if(isset($_POST['mese']) and $_POST['mese']!=0){
		$newselect="";
		$qmese=$_POST['mese'];
		if($primaquery==true){
			$newselect=$querytotale." and ";
			$querytotale=$newselect." Month(data)=$qmese";
		}else{
			$newselect=$querytotale." where ";
			$primaquery=true;
			$querytotale=$querytotale.$newselect." Month(data)=$qmese";
		}
	}
	
	//anno
	if(isset($_POST['anno']) and $_POST['anno']!=0){
		$newselect="";
		$qanno=$_POST['anno'];
		if($primaquery==true){
			$newselect=$querytotale." and ";
			$querytotale=$newselect." Year(data)=$qanno";
		}else{
			$newselect=$querytotale." where ";
			$primaquery=true;
			$querytotale=$querytotale.$newselect." Year(data)=$qanno";
		}
	}
	
	//id prodotto
	if(isset($_POST['idprodotto']) and strlen($_POST['idprodotto'])>0){
		$newselect="";
		$qidprodotto=$_POST['idprodotto'];
		if($primaquery==true){
			$newselect=$querytotale." and ";
			$querytotale=$newselect." idprodotto='$qidprodotto'";
		}else{
			$newselect=$querytotale." where ";
			$primaquery=true;
			$querytotale=$querytotale.$newselect." idprodotto='$qidprodotto'";
		}
	}
	$queryric=$queryselect.$querytotale;
}else{
	if(strlen($_SESSION['query'])>0){
		$queryric=$_SESSION['query'];
		$controllocampi=true;
	}	
}
//FINE RICERCA	

	//Divisione in pagine
	include "inclusi/divisionericercapreventivi.php";

?>
<html>
<head>
	<title>W-admin -- Gestione Preventivo</title>
	<!--STILE e JAVASCRIPT BACHECA-->
	<? 
		if(strstr($browser, 'MSIE')==true){
	?>
			<link rel="stylesheet" type="text/css" href="css/bacheca.css" media="screen" />
	<?	}else{?>
			<link rel="stylesheet" type="text/css" href="css/bacheca_moz.css" media="screen" />
	<?	}?>	
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

	<link rel="stylesheet" type="text/css" href="css/stylemenu.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/sddm.css" media="screen" />
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/effetto.js"></script>
	<script type="text/javascript" src="js/controllo.js"></script>
	<script src="js/jquery.easing.1.3.js" type="text/javascript"></script>
	<script language="JavaScript" type="text/javascript" src="js/menu.js"></script>
	<script language="JavaScript" type="text/javascript" src="js/ricercapreventivo.js"></script>
	<!--FINE BACHECA-->
</head>
<body>
	<div class="box1">
<?		include "inclusi/header.php"?>
		<div class="box3">
		<table width="990px;" border="0">
			<tr>
				<td width="215px;" valign="top">
					<div class="menusinistra">
						<? include "inclusi/menuleft.php"; ?>
					</div>
				</td>
				<td width="770px">	
						<div class="menucentro">
<?							if(isset($_GET['elim']) and strlen($_GET['elim'])>0){
?>								<div class="messaggio">
									Il preventivo &egrave; stato eliminato.
								</div>
<? 							}
?>						<img src="immagini/icona_preventivi.gif">Gestione Preventivi
						<hr />
						<div class="numpag">
							Preventivi trovati: (<? print $righe; ?>)<? print $visualizzatutto."<br /><br /><br />";
?>							</div><br /><br />
<?						if($spedita==true){				
?>							<table style="text-align: left; padding-left: 15px; font-weight: bold; width: 720px; margin-bottom: 20px; height: 30px; background: url('immagini/titolo.jpg'); font-family: Arial;" cellpadding="0" cellspacing="0">
								<tr>
									<td bgcolor="#BFFFBF" style="border: 2px solid #000;">Preventivo inviato!</td>
								</tr>
							</table>
<?							$spedita=false;
						}
						include "inclusi/formricerca.php";
?>						<table style="text-align: center; width: 720px; height: 30px; background: url('immagini/titolo.jpg'); font-family: Arial;" cellpadding="0" cellspacing="0">
							<tr>
								<td style="width: 400px;">RICHIESTA</td>
								<td style="width: 100px;">DATA</td>						
								<td style="width: 110px;">VISUALIZZA</td>					
								<td style="width: 110px;">ELIMINA</td>					
							</tr>
						</table>
<?						$query=$queryric." LIMIT ".$partenza.",".$num."";
						$ris=mysql_query($query) or die ("Query: ".$query." non eseguita!");
						if($righe>0){
							$_SESSION['query']=$queryric;
							while($data=mysql_fetch_array($ris)){
								$datapreventivo=explode("-",$data[4]);
								$datapreventivo=$datapreventivo[2]."-".$datapreventivo[1]."-".$datapreventivo[0];
								$query1="select * from utenti where id='".$data[2]."'";
								$ris1=mysql_query($query1) or die ("Query: ".$query1." non eseguita!");
								$nomeutentedb=@mysql_result($ris1,0,1);
								$cognomeutentedb=@mysql_result($ris1,0,2);
								
								//query per vedere se il preventivo è stato inviato
								$queryinvio=mysql_query("select * from statopreventivi where idpreventivo='".$data[3]."'") or die ("Query:  non eseguita!");
								$statopreventivo=@mysql_result($queryinvio,0,2);
								if(strlen($statopreventivo)==1){ $coloretable="background-color: #BFFFBF; ";} else{$coloretable="";}
?>								<table style="<? print $coloretable; ?>height: 50px; width: 720px; border: 1px solid #000; font-family: Arial;" cellpadding="0" cellspacing="0">
									<tr>
										<td style="padding-left: 10px; border: 1px solid #000; width: 400px;"><? print "<b>".ucfirst($nomeutentedb)." ".ucfirst($cognomeutentedb)."</b> ha richiesto un preventivo"; ?></td>					
										<td style="text-align: center; border: 1px solid #000; width: 100px;"><? print $datapreventivo; ?></td>
										<td style="text-align: center; border: 1px solid #000; width: 110px;"><a href="visualizzapreventivo.php?<? print $_SERVER['QUERY_STRING']; ?>&visualizza=<? print $data[3]; ?>">Visualizza</td>					
										<td style="text-align: center; border: 1px solid #000; width: 110px;"><a href="gestionepreventivo.php?<? print $_SERVER['QUERY_STRING'].$var;?>elim=<? print $data[3]; ?>"><img src="immagini/elimina.gif" border="0"></a></td>					
									</tr>
								</table>
<?							}
						}else{
							print "Nessun risultato trovato!";
						}
?>						<div class="divpiede">&nbsp;</div>
						<div class="pagine">
							<? if($pagine>1){paginefooter($corrente,$pagine); }?>
						</div>
						</div>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div id="oscura"></div>
</body>
</html>
<?}else{
?>	<meta http-equiv="refresh" content="0 url=http://<? print $_SERVER['HTTP_HOST'];?>">
<?	
}?>