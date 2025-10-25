<?
	//Se esiste la variabile post salvaprezzi
	if(isset($_POST['salvaprezzi']) and strlen($_POST['salvaprezzi'])>0){
		//connessione al database
		$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione.");
		//selezione del database
		mysql_select_db($database) or die ("Non riesco a selezionare il database");
		//fine del for
		$fine=$_POST['fine'];
		//idpreventivo
		$idpreventivo=$_POST['idpreventivo'];
		
		
		//SPECIFICHE PREVENTIVO
		//data preventivo
		$datap=explode("/",$_POST['datapreventivo']);
		$datapreventivo=$datap[2]."-".$datap[1]."-".$datap[0];
		//numero preventivo
		$numpreventivo=$_POST['numpreventivo'];
		//validita preventivo
		$validita=$_POST['validita'];
		//trasporto preventivo
		$iva=$_POST['iva'];
		//consegna preventivo
		$consegna=$_POST['consegna'];
		//Controllo se le specifiche sono già stati inseriti
		$queryspecifiche=mysql_query("select * from specifichepreventivo where idpreventivo='".$idpreventivo."'") or die ("Query seleziona preventivi non eseguita!");
		$esistentespecifiche=mysql_num_rows($queryspecifiche);
		//Se non esiste salvo le specifiche del preventivo
		if($esistentespecifiche==0){
			//Inserimento delle specifiche
			mysql_query("insert into specifichepreventivo values(default,'".$numpreventivo."','".$idpreventivo."','".$datapreventivo."','".$consegna."','".$validita."','".$iva."')");
		}else{
			//modifica delle specifiche
			mysql_query("UPDATE specifichepreventivo SET numero='".$numpreventivo."', data='".$datapreventivo."', consegna='".$consegna."', validita='".$validita."', trasporto='".$iva."' WHERE idpreventivo='".$idpreventivo."'");
		}
		//FINE SPECIFICHE
		
		//inizio for
		for($a=1; $a<=$fine; $a++){
			$idprodotto=$_POST["idprodotto".$a];  //id prodotto
			$prezzo=$_POST["prezzo".$a];	//prezzo
			$nota=$_POST["nota".$a];	//nota
			
			//INSERIMENTO PREZZI
			if(strlen($prezzo)>0 and is_numeric($prezzo)){
				//Controllo se il prezzo è già esistente
				$query=mysql_query("select * from prezzi where idprodotto='".$idprodotto."'") or die ("Query seleziona preventivi non eseguita!");
				$esistente=mysql_num_rows($query);
				//Se non esiste inserisco il prezzo al relativo prodotto
				if($esistente==0){
					//Inserimento del prezzo
					mysql_query("insert into prezzi values(default,'".$idprodotto."','".$prezzo."')");
				}else{
					//Se il prezzo del prodotto è maggiore di 0 altrimenti cancella il prezzo al prodotto
					if(strlen($prezzo)>0){
						//Modifica del prezzo
						mysql_query("UPDATE prezzi SET prezzo='".$prezzo."' WHERE idprodotto='".$idprodotto."'");
					}	
				}
			}
			if(strlen($prezzo)==0){
				//Controllo se il prezzo è già esistente
				$query=mysql_query("select * from prezzi where idprodotto='".$idprodotto."'") or die ("Query seleziona preventivi non eseguita!");
				//ricavo id prezzo
				$idprezzo=@mysql_result($query,0,0);
				$esistente=mysql_num_rows($query);
				if($esistente>0){
					//Eliminazione del prezzo
					mysql_query("DELETE FROM prezzi WHERE id='".$idprezzo."'");
				}
			}
			//FINE PREZZI

			
			//INSERIMENTO NOTE
			if(strlen($nota)>0){
				if($nota=="#0"){
					//Eliminazione della nota
					mysql_query("UPDATE note SET nota='".$nota."' WHERE idprodotto='".$idprodotto."' and idpreventivo='".$idpreventivo."'");
				}else{
					//Controllo se la nota è già esistente
					$queryn=mysql_query("select * from note where idprodotto='".$idprodotto."' and idpreventivo='".$idpreventivo."'") or die ("Query seleziona preventivi non eseguita!");
					$esistenten=mysql_num_rows($queryn);
					//Se non esiste inserisco il prezzo al relativo prodotto
					if($esistenten==0){
						//Inserimento del prezzo
						mysql_query("insert into note values(default,'".$idpreventivo."','".$idprodotto."','".$nota."')");
					}else{
						//Se il prezzo del prodotto è maggiore di 0 altrimenti cancella il prezzo al prodotto
						if(strlen($nota)>0){
							//Modifica del prezzo
							mysql_query("UPDATE note SET nota='".$nota."' WHERE idprodotto='".$idprodotto."' and idpreventivo='".$idpreventivo."'");
						}	
					}
				}	
			}else{
				//Eliminazione della nota
				mysql_query("UPDATE note SET nota='".$nota."' WHERE idprodotto='".$idprodotto."' and idpreventivo='".$idpreventivo."'");	
			}
			//Eliminazione della nota
			mysql_query("DELETE FROM note WHERE nota='#0' and idpreventivo='".$idpreventivo."'");			
			//FINE NOTE
		}
	}
?>	