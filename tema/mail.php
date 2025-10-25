<?				

				//ricezione dei parametri della mail
				$nome=mysql_result($queryutente,0,1)." ".mysql_result($queryutente,0,2);
				$residenza=mysql_result($queryutente,0,8)." ".mysql_result($queryutente,0,6)." Prov. ".mysql_result($queryutente,0,7);
				$indirizzo=mysql_result($queryutente,0,9);
				$email=mysql_result($queryutente,0,12);
				$prodotti=explode(",",$prodotti);
				$tel=mysql_result($queryutente,0,5);
				$totale=$_SESSION['totale'];
				$richiesta=$_POST['richiesta'];
				$errore=false;
				//convalida del form
				if($nome=="" or $residenza=="" or $indirizzo=="")
				{
					$errore=true;
				}
				for($a=0; $a<(count($prodotti)-1); $a++){
					$listap.='+ '.$prodotti[$a].';<br />';
				}
				$oggetto="Prodotti venduti su ".$titolosito;
				$oggetto1="Prodotti acquistati su ".$titolosito;
				$mail="
					<html>
						<head>
							<title>Prodotti venduti su $titolosito</title>
						</head>
						<body style=\"font-family:Verdana,Tahoma,sans-serif\">
							<p>
								<center>
									<h1>Prodotti venduti su <b>$titolosito</b></h1>
								</center>
							</p>
							<table>
								<tr>
									<td><b>Nome e Cognome:</b></td>
									<td>$nome</td>
								</tr>
								<tr>
									<td><b>Residenza:</b></td>
									<td>$residenza</td>
								</tr>
								<tr>
									<td><b>Indirizzo:</b></td>
									<td>$indirizzo</td>
								</tr>
								<tr>
									<td><b>Telefono:</b></td>
									<td>$tel</td>
								</tr>
								<tr>
									<td><b>Posta elettronica:</b></td>
									<td>$email</td>
								</tr>
								<tr>
									<td><b>Prodotti acquistati:</b></td>
									<td>$listap</td>
								</tr>
								<tr>
									<td><b>Richiesta:</b></td>
									<td>$richiesta</td>
								</tr>
								<tr>
									<td><b>Totale euro:</b></td>
									<td>$totale</td>
								</tr>
							</table>
							<br />Se ancora non avete provveduto al pagamento, potete pagare tramite
							<br />
							";
							
							//connessione al database
							$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione.");
							//selezione del database
							mysql_select_db($database) or die ("Non riesco a selezionare il database");
							$querypag=mysql_query("select * from metodipagamento") or die ("Query pagamenti non eseguita!");
							while($data=mysql_fetch_array($querypag)){
								$mail.="<p style='font-weight:bold'>".$data[1]."</p>";
								//Controllo se è paypal
								if($data[2]==0){
									$mail.="<a href='https://www.paypal.com/xclick/business='".$data[3]."'&currency_code=EUR&item_name=Prodotti Ordinati su ".$titolosito."&amount=".$totale."'>Paga adesso</a>";
								}
								$mail.="<p>".$data[3]."</p>";
							}	
					
						$mail.="</body>
					</html>
				";
				
				//chiusura db
				@mysql_close($db);
				
				//header dell'e-mail
				$header="From: $emailsito\r\n";
				$header.= "MIME-Version: 1.0\n";
				$header.= "Content-type: text/html; charset=\"iso-8859-1\"\n";
				$header.="Content-Transfer-Encoding: 7bit\n";
				//invio dell'email al venditore e acquirente
				if(!$errore){
					print "ciao";
					mail($emailsito,$oggetto,$mail,$header);
					mail($email,$oggetto1,$mail,$header);
				}
?>				