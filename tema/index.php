<?php include "tema/header.php"; ?>
<?php include "tema/menusinistra.php"; ?>
<?php
	//verifico la pagina  da visualizzare
	$dato = $_SERVER['REQUEST_URI']; 
	//Visualizza pagina
	include visualizzapagina($dato); 	
?>
<?php include "tema/footer.php"; ?>