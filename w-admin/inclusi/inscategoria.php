<?
	if(strlen($_POST['newcat'])>0){
		$newcat=$_POST['newcat'];
		$appartenenza=$_POST['cat'];
		$query=mysql_query("select * from categorie where nome='".mysql_real_escape_string($newcat)."' and appartenenza='".$appartenenza."'") or die ("Query: select cat non eseguita!");
		$cat=@mysql_result($query,0,0);
		if(strlen($cat)==0){
			mysql_query("INSERT INTO categorie() VALUES ('0', '".mysql_real_escape_string($newcat)."', '".$appartenenza."');");
			echo "<div class='messaggio'><strong>Categoria inserita correttamente!</strong></div>";		
		}else{
			echo "<div class='erroremsg'><strong>Categoria gi&agrave; esistente!</strong></p></div>";		
		}
	}else{
		echo "<div class='erroremsg'><strong>Inserisci il nome di una categoria!</strong></div>";		
	}
?>