<?
/*
<!-- http://free-script.it/ -->
<!-- Free script - Script gratuiti per il web. Script php, script asp, script javascript, script ajax. -->
<!-- Script ajax: Drag and drop con scriptaculous e salvataggio posizione -->
*/
session_start();
if(isset($_GET['firstlist'])){$firstlist=$_GET['firstlist'];}else{$firstlist=Array();}
if(isset($_GET['secondlist'])){$secondlist=$_GET['secondlist'];}else{$secondlist=Array();}
if(isset($_GET['thirdlist'])){$thirdlist=$_GET['thirdlist'];}else{$thirdlist=Array();}

$colonna1=str_replace("key","",implode(",",$firstlist));
$colonna2=str_replace("key","",implode(",",$secondlist));
$colonna3=str_replace("key","",implode(",",$thirdlist));

setcookie ( "cookie_colonna1",$colonna1,time()+2592000);
setcookie ( "cookie_colonna2",$colonna2,time()+2592000);
setcookie ( "cookie_colonna3",$colonna3,time()+2592000);

echo $colonna1."<br>".$colonna2."<br>".$colonna3;
?>