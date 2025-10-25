<?	
	//config
	include "../config.php";
	//funzioni
	include "../w-admin/functions.php";
?>	
<html>
<head>
	<title>Carrello</title>
	<link rel="stylesheet" type="text/css" href="/tema/css/style.css">
	<script type="text/javascript" src="/tema/js/menu.js"></script>	
</head>
<body>
	<div id="contenuto">
		<?	include "header.php"; ?>
	<div class="principale">
			<? include "menusinistra.php";?>
				<div class="divchisiamo">
					<div class="testo">Il mio Carrello</div> 
					<hr />
					<div style='font-weight: bold; padding-top: 20px; font-size: 14px;'>
<? 						//Svuoto i cookies
?>						Grazie per aver acquistato i nostri prodotti, la ricontatteremo al più presto!
					</div>
				</div>
			</div>	
			<? include "footer.php"; ?>
	</div>
</body>
</html>