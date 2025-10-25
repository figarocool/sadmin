<?
/*SBLOCCO DEL PRODOTTO*/
	include "../../config.php";
	//connessione al database
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	//selezione del database
	mysql_select_db($database) or die ("Non riesco a selezionare il database");
	mysql_query("DELETE FROM bloccati where idprodotto='".$_GET['id']."'");
/*fine blocco*/	
?>
		<div style='border: 2px dashed #BBBBBB;width: 100%; height:50px; font-size: 20px; padding: 15px; background-color: #F0F0F0;'>
			<p>
				<strong>Il prodotto &egrave; stato sbloccato.</strong>
			</p>
			<p style="padding-top: 50px;">
				<a href="<? print $_SERVER['HTTP_REFERER']; ?>" title="Indietro">
					Visualizza prodotti.
				<a>	
			</p>
		</div>
	<script language="javascript">
	//vieni rindirizzato alla pagina della gestione delle categorie
	function doLoad()  { setTimeout( 'refresh()', 0 ); }
	function refresh() { window.location.href = '<? print $_SERVER['HTTP_REFERER']; ?>';}
	</script>
	<body onload='doLoad()'>