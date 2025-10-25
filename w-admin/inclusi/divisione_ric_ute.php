<?
	//Dati database, connessione e selezione del database
	include "../config.php";
	//connessione al database
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	//selezione del database
	mysql_select_db($database) or die ("Non riesco a selezionare il database");
	//ricerca
	if(strlen($_POST['cerca'])>0){
		$cerca=$_POST['cerca'];
		$_SESSION['cerca']=$cerca;
	}else{	
		$cerca=$_SESSION['cerca'];
	}
	$queryricercautente="SELECT * FROM utenti WHERE nome LIKE '%$cerca%'or cognome LIKE '%$cerca%' or user LIKE '%$cerca%'";
	$risultatoutente=mysql_query($queryricercautente) or die ("Query: ".$queryricercautente." non eseguita!");
	$righericerca=mysql_num_rows($risultatoutente);
	//Numero di record per ogni pagina
	$num=10;
	//Numero di pagine relativo al numero di record inseriti per ogni pagina 
	$pagine=ceil($righericerca/$num);
	//Se esiste la variabile $_GET['id'] setta la variabile $corrente all'id passato altrimenti a zero
	if(isset($_GET['page'])){
		$partenza=$_GET['page']*$num;
		$corrente=$_GET['page'];
	}else{
		$partenza=0;
		$corrente=0;
	}
?>					