<?				
				//ricezione dei parametri della mail
				$oggetto="Grazie per esserti registrato su ".$_SERVER['HTTP_HOST'];
				$mail="
					<html>
						<head>
							<title>Grazie per esserti registrato</title>
						</head>
						<body style=\"font-family:Verdana,Tahoma,sans-serif\">
							<p>
								<center>
									<h1>Grazie per esserti registrato su <b>".$_SERVER['HTTP_HOST']."</b></h1>
								</center>
							</p>
							Per attivare il tuo account clicca sul link sottostante:<br>
							<a href='http://".$_SERVER['HTTP_HOST']."/attivazione.html?id=$codice1&autent=$idutente'>Attiva account</a><br>
							<br />
							i dati per effettuare il login sono:<br>
							<br>
							<b>Username:</b> $usern;<br>
							<b>Password:</b> $pswdb;<br>
							<br>
							Grazie.
						</body>
					</html>
				";
				//header dell'e-mail
				$header="From: ".$emailsito."\r\n";
				$header.= "MIME-Version: 1.0\n";
				$header.= "Content-type: text/html; charset=\"iso-8859-1\"\n";
				$header.="Content-Transfer-Encoding: 7bit\n";
				//invio dell'email al venditore e acquirente
				mail($email,$oggetto,$mail,$header);
?>				