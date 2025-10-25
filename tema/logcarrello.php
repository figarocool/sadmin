<?php
	//Inizializzo la sessione
	session_start();
	if(isset($_SESSION['wadmin']) and $_SESSION['wadmin']=="1"){
		$_SESSION['idprod']=$_POST['idprod'];
		$_SESSION['idut']=$_POST['idutente'];
		Header( "Location: http://".$_SERVER['HTTP_HOST']."/tema/insercarrello.php");
		}else{
			//config
			include "../config.php";
			//funzioni
			include "../w-admin/functions.php";
?>
<html>
	<head>
		<title>Carrello</title>
		<link rel="stylesheet" type="text/css" href="/tema/css/style.css">
	</head>
	<body>
		<? include "header.php"; ?>
		<div class="box-prodotticarrello">
			<div class="pagina error404">
				<h2>Il mio Carrello</h2>
				<p style="text-align: center;">Con il presente Modulo potrete acquistare uno o pi&ugrave; prodotti nella Vetrina delle Offerte.</p>
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