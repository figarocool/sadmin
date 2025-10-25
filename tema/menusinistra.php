<?php
			//connessione al database
			$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione.");
			//selezione del database
			mysql_select_db($database) or die ("Non riesco a selezionare il database");
			//utente loggato
			$query=mysql_query("select * from utenti where id='".$_SESSION['utente']."'") or die ("Query utente non eseguita!");
			$nomeutente=ucfirst(@mysql_result($query,0,1))." ".ucfirst(@mysql_result($query,0,2));
			$collegato=@mysql_result($query,0,10);
			$admin=@mysql_result($query,0,13);
?>
			<div class="sidebar">	
<?php			//Controllo se l'utente è loggato o meno
				if(isset($_SESSION['wadmin']) and $_SESSION['wadmin']=="1"){
					$_SESSION['entrap']="1";
?>					<div id="categorie">Accedi al Sito</div>
					<div id="boxaccedi">
						<div class="textformtitle">Benvenuto/a <label><?php print $nomeutente; ?></label></div>
							<div class="esci">
<?php	  						if($admin=="1"){
?>									<div>&raquo; <a href="/w-admin/bacheca.php?ac=<?php print $_SESSION['utente']; ?>&att=<?php print $collegato; ?>" title="Entra nel pannello">Entra nel Pannello</a></div>
									<div>&raquo; <a href="/tema/esci.php?esci=1" title="Esci">Esci</a></div>
<?php							}else{
									//Controllo se il preventivo è vuoto o meno
									if($_SESSION['preventivo']==1){
?>										<div>&raquo; <a href="/tema/preventivo.php" title="Visualizza Preventivo">Visualizza Preventivo</a></div>
<?php								}
									//Controllo se il carrello è vuoto o meno
									if($_SESSION['acquisto']=='1'){
?>										<div>&raquo; <a href="/tema/carrello.php" title="Visualizza Carrello">Visualizza Carrello</a></div>
<?php								}
?>									<div>&raquo; <a href="/w-admin/bacheca1.php?ac=<?php print $_SESSION['utente']; ?>&att=<?php print $collegato; ?>" title="Entra nel pannello">Entra nel Pannello</a></div>
									<div>&raquo; <a href="/tema/esci.php?esci=1" title="Esci">Esci</a></div>
<?php							}
?>							</div>
					</div>
<?php			}else{ ?>
					<div id="accedisito">Accedi al Sito</div>
					<div id="boxaccedi">
						<form action="/w-admin/index.php" name="login" id="login" method="post" >
							<div class="textform">Username</div>
							<input type="text" name="user" id="user" value="" class="inputform">
							<div class="textform">Password</div>
							<input type="password" name="psw" id="psw" value="" class="inputform">
							<div class="registratilogin">
								&raquo; <a href="/registrati.html" title="Registrati">Registrati</a>
							</div>	
							<input type="hidden" name="home" id="home" value="true">
							<input type="submit" value="Login" class="submitform">
						</form>
					</div>
<?php 			} 
?>
				<div id="categorie">Categorie</div>
				<div id="nomecategorie">
					<ul>
<?php					//Leggo le categorie
						$query=mysql_query("select * from categorie order by nome asc") or die ("Query marche non eseguita!");
						while($data=mysql_fetch_array($query)){
?>	
							<li>
								&raquo; <a href="http://<?php print $_SERVER["HTTP_HOST"];  ?>/MOBILIFICIO/<?php print strtoupper(puliscistring($data[1]))."-".$data[0]; ?>/categorie.html" title="Permalink a <?php print $data[1]; ?>"><?php print str_replace("\'","'",$data[1]); ?> </a>
							</li>
<?php					}
?>				
					</ul>
				</div>
				
				<div id="marche">Marche</div>
				<div id="nomemarche">
					<ul>
<?php					//Leggo le marche
						$query=mysql_query("select * from marche order by nome asc") or die ("Query marche non eseguita!");
						while($data=mysql_fetch_array($query)){?>
							<li>&raquo; <a href="/<?php print puliscistring($data[1])."-".$data[0]; ?>/index.html" title="<?php print "Permalink a ".puliscitesto($data[1]); ?>"><?php print utf8_encode(ucwords(strtolower(puliscitesto($data[1])))); ?> </a></li>
<?php					}
						mysql_close($db);
?>
					</ul>
				</div>
			</div>