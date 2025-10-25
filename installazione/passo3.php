<?php
	//Controllo se i campi sono stati inserito
	if(isset($_POST['datidb']) and $_POST['datidb']=="1"){
		
		$errore=false;
		
		//Controllo se il Nome del database è vuoto
		if(isset($_POST['nomedb']) and strlen($_POST['nomedb'])==0){
			$errore=true;
			$messaggio="Nome database, ";
		}
		//Controllo se il Nome utente del database è vuoto
		if(isset($_POST['nomeuserdb']) and strlen($_POST['nomeuserdb'])==0){
			$errore=true;
			$messaggio.="Nome utente, ";
		}
		//Controllo se la Password del database è vuoto
		if(isset($_POST['passworddb']) and strlen($_POST['passworddb'])==0){
			$errore=true;
			$messaggio.="Password, ";
		}
		//Controllo se l'host del database è vuoto
		if(isset($_POST['hostdb']) and strlen($_POST['hostdb'])==0){
			$errore=true;
			$messaggio.="Host del database, ";
		}
		
		//Faccio un controllo per vedere se si connette al db con i dati inseriti
		if($errore==false){
			//connessione al database
			$db = mysql_connect($_POST['hostdb'], $_POST['nomeuserdb'], $_POST['passworddb']);
			if(!$db){
				$errore=true;
				$messaggio.="Errore di connessione al database, ";
			}
		}

		//Faccio un controllo per vedere se si connette al db con i dati inseriti
		if($errore==false){
			//selezione del database
			$db_selected = mysql_select_db($_POST['nomedb']);
			if (!$db_selected){
				$errore=true;
				$messaggio.="Database non trovato, ";
			}
		}
	}
?>
<html>
<head>
	<title>Installazione S-Admin - Passo 3</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta content="width=device-width, maximum-scale=1, user-scalable=no" name="viewport">
	<link href="style.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="js/controlli.js"></script>
</head>
<body>
	<div class="divcontenuto">
		<div class="divheader">
			<img src="immagini/s-admin.png" border="0">
		</div>
		<div class="contenuto">
<?php		//Controllo se ci sono stati errori
			if($errore==true){
				print "<div class='msgerrore'>I seguenti campi sono vuoti o non sono stati inseriti correttamente: <span>".substr($messaggio,0,(strlen($messaggio)-2))."</span></div>";
?>				
				<form action="passo2.php" method="POST">
					<input type="Submit" name="cmd" id="cmd" value="Torna indietro" class="bottoneinstalla"/>
				</form>	
<?php		}else{
?>				Abbiamo quasi finito! Mancano le ultime informazioni per poter accedere a S-Admin.
			
				<div class="divcampi">
					<form action="passo4.php" name="datisadmin" method="POST" Onsubmit="javascript: return controllocampisito();">
						<div class="riga">
							<div class="campo1">Titolo Sito</div><div class="campo2"><input type="text" name="titolosito" id="titolosito" value="" /></div><div class="campo3">Il Titolo del sito che si vuole utilizzare</div>
						</div>
						<div class="riga">
							<div class="campo1">Email</div><div class="campo2"><input type="text" name="emailsito" id="emailsito" value="" /></div><div class="campo3">Questa e-mail servirà per i moduli di registrazione utente, preventivi e carrello</div>
						</div>
						<div class="riga">
							<div class="campo1">Nome Utente</div><div class="campo2"><input type="text" name="nomeutente" id="nomeutente" value="" /></div><div class="campo3">Scegli un Nome utente per quando accederai al pannello di S-Admin</div>
						</div>
						<div class="riga">
							<div class="campo1">Password</div><div class="campo2"><input type="password" name="password" id="password" value="" /></div><div class="campo3">Scegli la password per quando accederai al pannello di S-Admin</div>
						</div>
						<div class="riga">
							<input type="hidden" name="dati" id="dati" value="1" />
							<input type="hidden" name="nomedb" id="nomedb" value="<?php print $_POST['nomedb']; ?>" />
							<input type="hidden" name="nomeuserdb" id="nomeuserdb" value="<?php print $_POST['nomeuserdb']; ?>" />
							<input type="hidden" name="passworddb" id="passworddb" value="<?php print $_POST['passworddb']; ?>" />
							<input type="hidden" name="hostdb" id="hostdb" value="<?php print $_POST['hostdb']; ?>" />
							<input type="Submit" name="cmd" id="cmd" value="Installa S-Admin" class="bottoneinstalla"/>
						</div>
					</form>	
				</div>
<?php		}
?>			
		</div>	
	</div>
</body>
</html>