<?
	//Inizializzo la sessione
	session_start();

	//Dati database, connessione e selezione del database
	include "../config.php";
	//connessione al database
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	//selezione del database
	mysql_select_db($database) or die ("Non riesco a selezionare il database");
	//Trovo i dati dal database
	$q="select * from utenti where email='".$_POST['email']."'";
	$ris=mysql_query($q) or die ("Query: ".$q." non eseguita!");
	//risultato della query
	$idut=@mysql_result($ris,0,0);
	$email=@mysql_result($ris,0,12);
	$username=@mysql_result($ris,0,10);
	$password=@mysql_result($ris,0,11);
	if(isset($_POST['email']) and strlen($_POST['email'])>0){
		if(strlen($idut)>0 and strlen($_POST['email'])>0){
			$_SESSION['wadmin']="";
			//header dell'e-mail
			$header="From: ".$emailsito." \r\n";
			$header.= "MIME-Version: 1.0\n";
			$header.= "Content-type: text/html; charset=\"iso-8859-1\"\n";
			$header.="Content-Transfer-Encoding: 7bit\n";
			$errore="I relativi dati sono stati inviati all'email inserita!";
			//ricezione dei parametri della mail
			$oggetto="Recupero dati di accesso da ".$titolosito;
			$mail="
					<html>
						<head>
							<title>Recupero dati di accesso da ".$titolosito."</title>
						</head>
						<body style=\"font-family:Verdana,Tahoma,sans-serif\">
							<p>
								<center>
									<h1>Recupero dati di accesso su <b>".$titolosito."</b></h1>
								</center>
							</p>
							<table>
								<tr>
									<td><b>Username:</b></td>
									<td>".$username."</td>
								</tr>
								<tr>
									<td><b>Password:</b></td>
									<td>".$password."</td>
								</tr>
							</table>
						</body>
					</html>
			";
			mail($email, $oggetto, $mail, $header);
		}else{
			$errore="Attenzione: all'email non corrisponde nessun dato!";
		}
	}

	$lista=$_SERVER['HTTP_USER_AGENT'];
	$browser=explode(';',$lista);
	$browser=$browser[1];
?>
<html>
<head>
	<title>Recupero Password</title>
	<!--STILE HOME-->
	<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8"/>
	<? 
		if(strstr($browser, 'MSIE')==true){
	?>
			<link rel="stylesheet" type="text/css" href="css/login.css" media="screen" />
	<?	}else{?>
			<link rel="stylesheet" type="text/css" href="css/login_moz.css" media="screen" />
	<?	}?>	
	<script type="text/javascript" src="js/scripts.js"></script>
	<!--FINE STILE-->
</head>
<body>
	<a href="http://<? print $_SERVER['HTTP_HOST'];?>" class="link">&larr; Torna alla Home</a>
	<form action="#" name="login" id="login" method="post">
	<div class="boxlogin1">
<?		if(strlen($errore)>0){
?> 			<div class="loginerror">
<?				print $errore;?>
			</div>
		<?}?>
		<div class="boxtitolo">
			<div class="titolologin">
				Recupero Password
			</div>
		</div>
		<div class="boxcontent1">
			<div class="user">
				<div class="titolouser">
					E-mail
				</div>
				<div>				
					<input type="text" name="email" id="email" value="" size="30">
				</div>	
			</div>
			<div class="bottonelogin">
				<input type="hidden" name="login" id="login" value="ok">
				<input type="image" id="cmd" name="cmd" src="immagini/recupero.jpg">	
			</div>
		</div>
	</div>
	</form>
</body>
</html>