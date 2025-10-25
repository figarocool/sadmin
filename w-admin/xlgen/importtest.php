<?php
	
	include("mysql_excel.inc.php");
	
	$import=new HarImport();
	$import->openDatabase("sql.cityiper.it","cityiper","seru9583","cityiper");
	
	//To import the data from table
	//$import->ImportDataFromTable("utenti-newsletter");
	
	//To import the data from sql query

	$sql="select nome,cognome,cellulare from `utenti-newsletter`";
	$import->ImportData($sql,"myXls.xls");

	//To force to download
	//$import->ImportDataFromTable("graduate","",true);
	//Or
	//$import->ImportData($sql,"myXls.xls",true);

?>