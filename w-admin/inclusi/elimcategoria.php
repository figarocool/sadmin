<?
	if(strlen($_POST['elim'])>0){
		$idelim=$_POST['elim'];
		if($idelim!=0){
			mysql_query("DELETE FROM categorie where id='".$idelim."'");
			echo "<div class='messaggio'><strong>Categoria eliminata correttamente!</strong></div>";
		}else{
			echo "<div class='erroremsg'><strong>Seleziona una categoria da eliminare!</strong></div>";
		}
	}
?>