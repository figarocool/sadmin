<?
	//connessione al database
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	//selezione del database
	mysql_select_db($database) or die ("Non riesco a selezionare il database");
	$q='select * from utenti';
	$r=mysql_query($q) or die ("Query: ".$q." non eseguita!");
	//conto i record inseriti
	$righe=mysql_num_rows($r);
	//Numero di record per ogni pagina
	$num=10;
	//Numero di pagine relativo al numero di record inseriti per ogni pagina 
	$pagine=ceil($righe/$num);
	//Se esiste la variabile $_GET['id'] setta la variabile $corrente all'id passato altrimenti a zero
	if(isset($_GET['page'])){
		$partenza=$_GET['page']*$num;
		$corrente=$_GET['page'];
	}else{
		$partenza=0;
		$corrente=0;
	}
	mysql_close($db); //chiusura db

?>	