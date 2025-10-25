<?				

				//ricezione dei parametri della mail
				$oggetto="Nuovo utente registrato su ".$_SERVER['HTTP_HOST'];
				$mail="
					<html>
						<head>
							<title>Nuovo utente registrato</title>
						</head>
						<body style=\"font-family:Verdana,Tahoma,sans-serif\">
							<p>
								<center>
									<h1>Nuovo utente registrato su <b>".$_SERVER['HTTP_HOST']."</b></h1>
								</center>
							</p>
							Alcuni dati sul nuovo utente:<br>
							<br>
							<b>Username:</b> $userdb;<br>
							<b>Password:</b> $pswdb;<br>
							<b>Nome:</b> $nomedb;<br>
							<b>Cognome:</b> $cognomedb;<br>
							<br>
						</body>
					</html>
				";
				//header dell'e-mail
				$header="From: ".$emailsito."\r\n";
				$header.= "MIME-Version: 1.0\n";
				$header.= "Content-type: text/html; charset=\"iso-8859-1\"\n";
				$header.="Content-Transfer-Encoding: 7bit\n";
				//invio dell'email al venditore e acquirente
				mail($emailsito,$oggetto,$mail,$header);
?>				