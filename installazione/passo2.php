<html>
<head>
	<title>Installazione S-Admin - Passo 2</title>
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
			Di seguito puoi inserire i dettagli di connessione al database. Se non sei sicuro dei dati da inserire contatta il tuo fornitore di hosting.
			
			<div class="divcampi">
				<form action="passo3.php" name="datidb" method="POST" Onsubmit="javascript: return controllocampi();">
					<div class="riga">
						<div class="campo1">Nome database</div><div class="campo2"><input type="text" name="nomedb" id="nomedb" value="" /></div><div class="campo3">Il nome del database che si vuole utilizzare per S-Admin</div>
					</div>
					<div class="riga">
						<div class="campo1">Nome utente</div><div class="campo2"><input type="text" name="nomeuserdb" id="nomeuserdb" value="" /></div><div class="campo3">Il nome utente del database Mysql</div>
					</div>
					<div class="riga">
						<div class="campo1">Password</div><div class="campo2"><input type="password" name="passworddb" id="passworddb" value="" /></div><div class="campo3">La password del database Mysql</div>
					</div>
					<div class="riga">
						<div class="campo1">Host del database</div><div class="campo2"><input type="text" name="hostdb" id="hostdb" value="localhost" /></div><div class="campo3">Se <i>localhost</i> non funziona richiedere questa informazione al proprio fornitore di hosting</div>
					</div>
					<div class="riga">
						<input type="hidden" name="datidb" id="datidb" value="1" />
						<input type="Submit" name="cmd" id="cmd" value="Invia" class="bottoneinvia" />
					</div>
				</form>	
			</div>
		</div>	
	</div>
</body>
</html>