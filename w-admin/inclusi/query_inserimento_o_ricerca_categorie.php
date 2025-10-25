<?
	if(isset($_POST['cerca']) and strlen($_POST['cerca'])>0){
		$cerca=$_POST['cerca'];
		$query="SELECT * FROM categorie WHERE nome LIKE '%$cerca%' order by id asc LIMIT ".$partenza.",".$num."";
		$visualizzatutto=" | <a href='gestionecategoria.php' class='linkvisual'>Visualizza tutti</a>";
		$ris=mysql_query($query) or die ("Query: ".$query." non eseguita!");
		if(strlen(mysql_result($ris,0,0))==0){
			$nessunamarca="Nessun valore trovato!";
		}
	}else{		
		$query="select * from categorie order by id asc LIMIT ".$partenza.",".$num."";
		$ris=mysql_query($query) or die ("Query: ".$query." non eseguita!");
		if(strlen(mysql_result($ris,0,0)==0)){
			$nessunamarca="Nessuna marca inserita!";
		}
	}
?>