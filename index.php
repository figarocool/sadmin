<?	//sessioni
	session_start();
	
	//Controllo se esiste il config
	if(file_exists("config.php")) {
?>
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
			<? include "head.php"; ?>
		</head>

		<body onload="javascript: controllaCookie();">

		<?	include "genera.php"; //Genera Sitemap
			include "tema/index.php";
		?>

		<div class="mex-box" id="privacy" style="visibility:hidden; z-index:2;">
			<p>
				Usiamo i cookie per migliorare la tua esperienza. Per maggiori informazioni leggi la nostra 
				<a href="<?php print "http://".$_SERVER['HTTP_HOST']; ?>/leggeprivacy.html"><u>politica privacy</u></a>.
				<br>
				Utilizzando <?php print $_SERVER['HTTP_HOST']; ?>, accetti i cookie come da impostazioni del tuo browser. 
			</p>
			<div class="accetta" >
				<a href="javascript: MessaggioIniziale();" >OK</a>
			</div>
		</div>

		</body>
		</html>
<?php
	}else{
		//Altrimenti lancia l'installazione
		header("Location: http://".$_SERVER['HTTP_HOST']."/installazione/passo1.php");
	}
?>	