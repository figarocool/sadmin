<?php
	//Controllo se i campi sono stati inserito
	if(isset($_POST['dati']) and $_POST['dati']=="1"){
		
		$errore=false;
		
		//Controllo se il titolo del sito è vuoto
		if(isset($_POST['titolosito']) and strlen($_POST['titolosito'])==0){
			$errore=true;
			$messaggio="Titolo del sito, ";
		}
		//Controllo se il e-mail del sito è vuoto
		if(isset($_POST['emailsito']) and strlen($_POST['emailsito'])==0){
			$errore=true;
			$messaggio.="E-mail del sito, ";
		}
		//Controllo se nome utente è vuoto
		if(isset($_POST['nomeutente']) and strlen($_POST['nomeutente'])==0){
			$errore=true;
			$messaggio.="Nome utente, ";
		}
		//Controllo se la password è vuota
		if(isset($_POST['password']) and strlen($_POST['password'])==0){
			$errore=true;
			$messaggio.="Password, ";
		}
		
	}
?>
<html>
<head>
	<title>Installazione S-Admin - Passo 4</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta content="width=device-width, maximum-scale=1, user-scalable=no" name="viewport">
	<link href="style.css" rel="stylesheet" type="text/css">
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
				<form action="passo3.php" method="POST">
					<input type="Submit" name="cmd" id="cmd" value="Torna indietro" class="bottoneinstalla"/>
				</form>	
<?php		}else{
	
				//Installazione db
				include "installazionedb.php";
?>		
				<h2>Congratulazioni!</h2><br />
				S-Admin è stato installato correttamente. Grazie e buon divertimento!
				
				<div class="divcampi">
					<form action="<?php print "http://".$_SERVER['HTTP_HOST']."/w-admin/"; ?>" method="POST">
						<div class="riga">
							<div class="campo1">Nome Utente</div><div class="campo2"><?php print $_POST['nomeutente']; ?></div>
						</div>
						<div class="riga">
							<div class="campo1">Password</div><div class="campo4">La password che hai scelto</div>
						</div>
						<div class="riga">
							<input type="Submit" name="cmd" id="cmd" value="Login" class="bottoneinvia"/>
						</div>
					</form>	
				</div>
<?php		}
?>							
		</div>	
	</div>
</body>
</html>