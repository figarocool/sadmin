
<?php
	include("../config.php");
	include("xlgen/mysql_excel.inc.php");

	$import=new HarImport();
	$import->openDatabase($host,$user,$psw,$database);
	
	//Importazione dati da query

	$sql="select * from `utenti`";
	$import->ImportData($sql,"utenti.xls");
	
?>

<META HTTP-EQUIV="REFRESH" CONTENT="0; URL=/w-admin/utenti.xls">

                    