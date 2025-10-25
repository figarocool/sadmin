<?
	//includo settaggi
	include "w-admin/inclusi/setting.php";
	//connessione al database
	$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione. Verificare i parametri nel file config.inc.php");
	//selezione del database
	mysql_select_db($database) or die ("Non riesco a selezionare il database");
	//controllo se il valore cercato è una categoria
	$q=mysql_query("SELECT * FROM prodotti WHERE id NOT IN (SELECT DISTINCT idprodotto FROM offerte)") or die ("Query: divisione non eseguitaa!");
	//conto i risultati
	$righe=mysql_num_rows($q);
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
	mysql_close($db); //chiusura db
?>	