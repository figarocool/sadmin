<?php
	//Eliminazione prodotto
	if(isset($_GET['elim']) and strlen($_GET['elim'])>0){
		//id prodotto da inserire
		$idp=$_GET['elim'];
		//trasformo in array la lista dei prodotti salvati nei cookies
		$listaprodotti=explode(",",$_COOKIE['carrello']);
		for($c=0; $c<=count($listaprodotti); $c++){
			//Cancello il prodotto da eliminare
			if($listaprodotti[$c]==$idp){
				unset($listaprodotti[$c]);
			}
			//Ricostruisco l'array saltando gli elementi ke risultano vuoti
			if($listaprodotti[$c]){
				$listanuova=$listanuova.$listaprodotti[$c].",";
			}	
		}
		if(count($listaprodotti)=="1"){
			$listanuova="0";
			//Setto i cookies a 0
			setcookie('carrello',$listanuova);
		}else{
			//Setto di nuovo i cookies con la lista nuov dei prodotti
			setcookie('carrello',$listanuova);
		}	
	}
	//Ritorno nel carrello del preventivo
	Header( "Location: http://".$_SERVER['HTTP_HOST']."/tema/carrello.php");
?>	