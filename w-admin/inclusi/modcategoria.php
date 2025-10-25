<?
		if(strlen($_POST['mod'])>0){
			$idmod=$_POST['mod'];
			$newcat=$_POST['newmod'];
			if($idmod!=0 and strlen($newcat)!=0){
				mysql_query("UPDATE categorie SET nome='".$newcat."' where id='".$idmod."'");
				echo "<div class='messaggio'><strong>Categoria modificata correttamente!</strong></div>";
			}else{
				if(strlen($newcat)==0){
					echo "<div class='erroremsg'><strong>Inserisci il nome della nuova categoria!</strong></div>";
				}else{
					echo "<div class='erroremsg'><strong>Seleziona una categoria da modificare!</strong></div>";
				}
			}
		}
?>