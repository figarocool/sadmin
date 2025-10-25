<?
	//Prendo i cookies e li trasformo in array
	$listaprodotti=explode(',',$_COOKIE['carrello']);
	//Elimino i doppioni
	$righe=0;
	//conto i prodotti inseriti
	for($cont=0; $cont<=count($listaprodotti); $cont++){
		if($listaprodotti[$cont]!=0){
			$righe=$righe+1;
		}
	}
	//Numero di prodotti per ogni pagina
	$num=10;
	//Numero di pagine relativo al numero di prodotti inseriti per ogni pagina 
	$pagine=ceil($righe/$num);
	//Se esiste la variabile $_GET['id'] setta la variabile $corrente all'id passato altrimenti a zero
	if(isset($_GET['page'])){
		$partenza=$_GET['page']*$num;
		$corrente=$_GET['page'];
	}else{
		$partenza=0;
		$corrente=0;
	}
?>	