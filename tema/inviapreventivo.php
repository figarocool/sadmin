<?php
	//Inizializzo la sessione
	session_start();
	//config
	include "../config.php";
	//funzioni
	include "../w-admin/functions.php";
?>
<html>
	<head>
		<title>Preventivo</title>
		<link rel="stylesheet" type="text/css" href="/tema/css/style.css">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body>
		<?	include "header.php"; ?>
		<div class="box-prodotticarrello">
			<div class="pagina">
				<h2>Richiedi Preventivo</h2> 
				<div class="mexacquisto">
<?php
					//Svuoto i cookies
?>
					<p>Grazie per aver richiesto un preventivo, la ricontatteremo al pi&ugrave; presto!</p>
					<p><span>Attenzione:</span> SE DOPO 2 GIORNI NON ARRIVA NESSUNA NOSTRA E-MAIL, CONTROLLARE NELLA POSTA INDESIDERATA O NELLO SPAM DELLA VOSTRA CASELLA DI POSTA ELETTRONICA.</p>
				</div>
			</div>	
		</div>
		<? include "footer.php"; ?>
	</body>
</html>