<?php
	session_start();


	if(isset($_POST['ric']) and strlen($_POST['ric'])>0){				
		//CONTROLLO SE I CAMPI SONO VUOTI
		//Controllo se il nome è stato inserito o meno
		if(isset($_POST['nome']) and strlen($_POST['nome'])==0){
			$errore.="Inserire il proprio Nome!"."<br />";
		}
		//Controllo se il cognome è stato inserito o meno
		if(isset($_POST['cognome']) and strlen($_POST['cognome'])==0){
			$errore.="Inserire il proprio Cognome!"."<br />";
		}
		//Controllo se la richiesta è stata inserita o meno
		if(isset($_POST['richiesta']) and strlen($_POST['richiesta'])==0){
			$errore.="Inserire la richiesta!"."<br />";
		}
		//Controllo se la provincia  è stata inserita o meno
		if(isset($_POST['prov']) and strlen($_POST['prov'])==0){
			$errore.="Inserire la provincia!"."<br />";
		}
		//Controllo se il tel  è stato inserito o meno
		if(isset($_POST['tel']) and strlen($_POST['tel'])==0){
			$errore.="Inserire un numero di telefono!"."<br />";
		}
		//Controllo se il paese è stato inserito o meno
		if(isset($_POST['paese']) and strlen($_POST['paese'])==0){
			$errore.="Inserire il paese!"."<br />";
		}
		//Controllo se l'email è stata inserita o meno
		if(isset($_POST['email']) and strlen($_POST['email'])==0){
			$errore.="Inserire l'email!"."<br />";
		}
		//FINE CONTROLLO
					
		//INVIO EMAIL
		//ricezione dei parametri della mail
		$nome=$_POST['nome']." ".$_POST['cognome'];
		$email=$_POST['email'];
		$tel=$_POST['tel'];
		$paese=$_POST['paese']." Prov ".$_POST['prov'];
		$nomeprodotto=$_POST['nomeprodotto'];
		
		if(strlen($nomeprodotto)>0){
			$mobile='
			<tr>
				<td><b>Mobile:</b></td>
				<td>'.$nomeprodotto.'</td>
			</tr>';
		}
		
		$richiesta=$_POST['richiesta'];
		$errore1=false;
		//convalida del form
		if($nome=="" ||$richiesta==""){
			$errore1=true;
		}
		$oggetto="Richiesta da ".$titolosito;
		$mail="
			<html>
				<head>
					<title>Richiesta</title>
				</head>
				<body style=\"font-family:Verdana,Tahoma,sans-serif\">
					<p>
						<center>
							<h1>Richiesta su <b>".$titolosito."</b></h1>
						</center>
					</p>
					<table>
						<tr>
							<td><b>Nome e Cognome:</b></td>
							<td>$nome</td>
						</tr>
						<tr>
							<td><b>Paese:</b></td>
							<td>$paese</td>
						</tr>
						<tr>
							<td><b>Telefono:</b></td>
							<td>$tel</td>
						</tr>
						<tr>
							<td><b>Posta elettronica:</b></td>
							<td>$email</td>
						</tr>
						$mobile
						<tr>
							<td><b>Richiesta:</b></td>
							<td>$richiesta</td>
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
		//invio dell'email al venditore e acquirente
		if(!$errore1 and strlen($_SESSION['richiesta'])>0){
			mail($emailsito,$oggetto,$mail,$header);
			$_SESSION['richiesta']='';
			unset($_SESSION['richiesta']);
			$errore="Richiesta inviata correttamente";
		}
		//FINE EMAIL
	}
	
?>	
<div class="box-titlepagina">
	<div class="titlepagina">
		<h2>Invio Richiesta</h2>
	</div>
</div>
<div class="box-prodotti divpagine">		
	<div class="pagina">
<?php	if(isset($_POST['ric']) and strlen($_POST['ric'])>0 and $errore!="Richiesta inviata correttamente!!!"){ 		
?>			<div class="errore">
				<div class="affianco1">
					<?php print $errore."<br /><a href='".$_SERVER['HTTP_REFERER']."'>Torna indietro</a>"; ?>
				</div>
			</div>
<?php	}else{
?>			<div class="noerrore">
				<div class="affianco1">
					<?php print $errore."<br /><a href='".$_SERVER['HTTP_REFERER']."'>Torna indietro</a>"; ?>
				</div>
			</div>
<?php	}
?>
	</div>
</div>	
