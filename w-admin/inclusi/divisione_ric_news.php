<?
	//Dati database, connessione e selezione del database
	include "../config.php";
	//connessione al database
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	//selezione del database
	mysql_select_db($database) or die ("Non riesco a selezionare il database");
	if(isset($_SESSION['cerca']) and strlen($_SESSION['cerca'])>0){
		$cerca=$_SESSION['cerca'];
	}else{
		$cerca=$_POST['cerca'];
	}
	$query1="SELECT * FROM newsletter WHERE titolo LIKE '%$cerca%'or descrizione LIKE '%$cerca%'";
	$ris1=mysql_query($query1) or die ("Query: ".$query1." non eseguita!");
	$righeric=mysql_num_rows($ris1);
	//Numero di record per ogni pagina
	$num=10;
	//Numero di pagine relativo al numero di record inseriti per ogni pagina 
	$pagine=ceil($righeric/$num);
	//Se esiste la variabile $_GET['id'] setta la variabile $corrente all'id passato altrimenti a zero
	if(isset($_GET['page'])){
		$partenza=$_GET['page']*$num;
		$corrente=$_GET['page'];
	}else{
		$partenza=0;
		$corrente=0;
	}
?>					