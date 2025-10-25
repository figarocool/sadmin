<?	$_SESSION['wadmin'];
	$_SESSION['utente'];
	//config
	include "config.php";
	//funzioni
	include "w-admin/functions.php";
	
?>	<title><? print titlepagina($_SERVER['REQUEST_URI']); ?></title>

	<meta name="abstarct" content="<?php print $abstarct; ?>"/>
	<meta name="keywords" content="<?php print $keywords; ?>"/>
	<meta name="description" content="<?php print $description; ?>"/>
	<meta content="width=device-width, maximum-scale=1, user-scalable=no" name="viewport">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	
	<link rel="stylesheet" type="text/css" href="/tema/css/style.css">
	
	<!-- FONT PER IL SITO -->
	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300,100' rel='stylesheet' type='text/css'>
	<!-- FINE FONT -->
	
	<!--FILE PER LO SLIDE-->
	<link rel="stylesheet" type="text/css" href="/tema/css/jcarousel.basic.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:700,600,800,400|Raleway:400,300,600,500,700,800' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
	<script src="/tema/js/jquery-1.11.3.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="/tema/js/jquery.jcarousel.min.js"></script>
	<script type="text/javascript" src="/tema/js/jcarousel.basic.js"></script>
	<script type="text/javascript" src="/tema/js/autoscroll.js"></script>
	<script type="text/javascript" src="/tema/js/controllo-cookie.js"></script>
	<!--fine slide-->
	
	<!--FILE PER IL LIGHTBOX-->
	<link rel="stylesheet" href="/tema/css/lightbox.css" type="text/css" media="screen">
	<script src="/tema/js/lightbox.js" type="text/javascript"></script>
	<!--fine lightbox-->

<?php 
	if ($_COOKIE['accetta']=="1" and strlen($codiceanalytics)>0){ 
		print $codiceanalytics;
	}
?>