<?php
	//Inizializzo la sessione
	session_start();
	
	//id prodotto
	$idprod=$_SESSION['idprod'];
	//id utente
	$idutente=$_SESSION['idut'];
	//settaggio variabile
	$_SESSION['preventivo']="1";
	//trasformo la lista dei cookies in array
	$lista=explode(",",$_COOKIE['prodotti']);
	//lista dei prodotti scelti dall'utente
	if (in_array($idprod,$lista)==false){
		$listaprodotti=$_COOKIE['prodotti'].$idprod.",";
		//Setto la lista dei prodotti e l'utente nei cookies
		setcookie('prodotti',$listaprodotti);
		setcookie('utente',$idutente);
	}	
	//Torno nel carrello virtuale dei preventivi
	Header( "Location: http://".$_SERVER['HTTP_HOST']."/tema/preventivo.php");
?>		
		