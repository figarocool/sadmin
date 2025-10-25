<?	session_start();
	if(isset($_SESSION['wadmin']) and $_SESSION['wadmin']=="1"){
		unset($_SESSION['lista']);
		unset($_SESSION['query']);
		include "inclusi/headerbacheca.php";	
?>
<html>
<head>
	<title>Web admin -- Bacheca</title>
	<!--STILE BACHECA-->
	<link rel="stylesheet" type="text/css" href="css/bacheca.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/stylemenu.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/sddm.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/style1.css" />
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="js/menu.js"></script>
	<script type="text/javascript" src="js/prototype.js"></script>
	<script type="text/javascript" src="js/scriptaculous.js"></script>
	<script type="text/javascript" src="js/unittest.js"></script>
	<!--FINE BACHECA-->
</head>
<body>
	<div class="box1">
<?		include "inclusi/header.php"?>
		<div class="box3">
			<table width="990px;" border="0" style="font-size: 30px; font-family: Monotype Corsiva;">
				<tr>
					<td width="215px;" valign="top">
						<div class="menusinistra">
							<? include "inclusi/menuleft.php"; ?>
						</div>
					</td>
					<td style="width: 770px; float: left; margin-top: 20px;" valign="top">
						<img src="immagini/icona_casa.gif">Bacheca
						<hr />
						<div class="statistiche">
							<? include "inclusi/statistiche.php"; ?>
						</div>
					</td>
				</tr>
			</table>
		</div>
	</div>
</body>
</html>
<? } else { 
	Header("Location: http://".$_SERVER['HTTP_HOST']."/");
 }
?>
