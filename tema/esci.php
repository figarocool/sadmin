<?php
		//Inizializzo la sessione
		session_start();
		if(isset($_GET['esci']) and $_GET['esci']=="1"){
			unset($_SESSION['wadmin']);
			unset($_SESSION['utente']);
			unset($_SESSION['entrap']);
			session_destroy();

			//logout
			Header( "Location: http://".$_SERVER['HTTP_HOST']);
		}
?>