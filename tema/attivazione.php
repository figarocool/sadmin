<?php	
	$_SESSION['login']="";
	unset($_SESSION['login']);
	$_SESSION['richiesta']="1";
	//Dati database
	include "config.php";
	//connessione al database
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	//selezione del database
	mysql_select_db($database) or die ("Non riesco a selezionare il database");
	if(strlen($_GET['autent'])>0 and strlen($_GET['id'])>0){
		//Controllo se l'utente  esiste
		$query="select * from attivazione where idutente='".$_GET['autent']."' and seriale='".$_GET['id']."'";
		$ris=mysql_query($query) or die ("Query: ".$query." non eseguita!");
		$attiva=@mysql_result($ris,0,0);
		$queryinfo="select * from utenti where id='".$_GET['id']."'";
		$risinfo=mysql_query($queryinfo) or die ("Query: ".$queryinfo." non eseguita!");
		$nomedb=@mysql_result($risinfo,0,1);
		$cognomedb=@mysql_result($risinfo,0,2);
		$userdb=@mysql_result($risinfo,0,10);
		$pswdb=@mysql_result($risinfo,0,11);
	}		
?>
		<div class="box-titlepagina">
			<div class="titlepagina">
				<h2>Attivazione account</h2>
			</div>
		</div>

<?php
		$errore="<p>Errore: Il tuo account non &egrave; stato attivato.</p><p>Si prega di contattare l'Amministratore del sito!</p>";
		$messaggioatt="<p>Grazie per esserti registrato. Il tuo account &egrave; ora attivo!</p>";
		if(isset($attiva) and strlen($attiva)>0){
?>			<div class="noerrore">
				<div class="affianco">
					<img src="tema/immagini/ok.png">
				</div>
				<div class="affianco1">
					<?php print $messaggioatt."<a href='"."http://".$_SERVER['HTTP_HOST']."'>Torna alla home</a>"; 
						mysql_query("DELETE FROM attivazione where id='".$attiva."'");
						//ricavo i dati inseriti
						include "w-admin/inclusi/setting.php";
						if($notificaset=="si"){
							include "w-admin/inclusi/emailadmin.php";
						}
						print $messaggioset;
					?>
				</div>
			</div>
<?php
		}else{
?>
			<div class="errore">
				<div class="affianco">
					<img src="tema/immagini/errore.png">
				</div>
				<div class="affianco1">
					<? print $errore; ?>
				</div>
			</div>
<?php
		}
?>
<?php mysql_close($db); ?>