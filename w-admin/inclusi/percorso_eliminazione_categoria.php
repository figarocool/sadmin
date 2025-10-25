<?
	//Controllo se devo inserire la ? o la &
	$read=@implode($_SERVER['argv']);
	$read=@explode("=",$read);
	$get=count($read);
	if($get!=1 or strlen($_SERVER['QUERY_STRING'])>0){
		$var="&";
	}
?>