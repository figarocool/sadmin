<?php
	//Inizializzo la sessione
	session_start();
	if(isset($_SESSION['wadmin']) and $_SESSION['wadmin']=="1"){
		$_SESSION['idprod']=$_POST['idprod'];
		$_SESSION['idut']=$_POST['idutente'];
		Header( "Location: http://".$_SERVER['HTTP_HOST']."/tema/inserpreventivo.php");
		}else{
			//config
			include "../config.php";
			//funzioni
			include "../w-admin/functions.php";
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Preventivo</title>
		<link rel="stylesheet" type="text/css" href="/tema/css/style.css">
	</head>
	<body>
		<?php include "header.php"; ?>
		<div class="box-prodotticarrello">
			<div class="pagina error404">
				<h2>Richiedi Preventivo</h2>
				<p style="text-align: center;">Con il presente Modulo potrete richiedere un preventivo di uno o pi&ugrave; prodotti.</p>
				<p style="text-align: center;">Per continuare si prega di registrarsi o accedere al sito.</p>
				<div class="registratiora"><a href="/registrati.html" title="Registrati ora">Registrati ora</a></div>
				<div class="boxcontattaci">
					<form action="/w-admin/index.php" name="login" id="login" method="post">
						<div class="modulo1">
							<h2>Accedi</h2>
							<div class="boxxx">
								<div class="campi"><span>*</span>Nome Utente:</div>
								<div class="campi"><span>*</span>Password:</div>
							</div>
							<div class="boxxx1">
								<div class="input"><input type="text" name="user" id="user" value=""></div>
								<div class="input"><input type="password" name="psw" id="psw" value=""></div>
							</div>
						</div>
						<input type="hidden" name="home" id="home" value="true">
						<div class="accedipreventivo">
							<input type="submit" value="Accedi" name="submit" id="submit">
						</div>
					</form>
				</div>
			</div>
		</div>
		<? include "footer.php"; ?>
	</body>
</html>
<?php
		}
?>