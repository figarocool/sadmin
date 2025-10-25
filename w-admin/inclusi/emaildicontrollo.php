<?				
				$oggetto1="Errore: ".$titolosito;
				$mail="
					<html>
						<head>
							<title>id preventivo 0</title>
						</head>
						<body style=\"font-family:Verdana,Tahoma,sans-serif\">
							<p>
								<center>
									<h1>id preventivo 0</h1>
								</center>
							</p>
							<table>
								<tr>
									<td>L'ID del preventivo è ritornato zero.</td>
								</tr>
							</table>
						</body>
					</html>
				";
				//header dell'e-mail
				$header="From: ".$emailsito."\r\n";
				$header.= "MIME-Version: 1.0\n";
				$header.= "Content-type: text/html; charset=\"iso-8859-1\"\n";
				$header.="Content-Transfer-Encoding: 7bit\n";
				mail("info@arkosoft.it",$oggetto,$mail,$header);
?>				