<?
/*
<!-- http://free-script.it/ -->
<!-- Free script - Script gratuiti per il web. Script php, script asp, script javascript, script ajax. -->
<!-- Script ajax: Drag and drop con scriptaculous e salvataggio posizione -->
*/
session_start();
//array elementi -> possono anche essere presi da database
$elemento[1]['titolo']="Stato attuale";
$elemento[1]['contenuto']=" 0 Prodotti inseriti; <br /> 0 Categorie inserite; <br /> 0 Marche inserite; <br /> 0 Utenti registrate;";
$elemento[2]['titolo']="Ultimi utenti registrati";
$elemento[2]['contenuto']="sdfsdfsdfsd";
$elemento[3]['titolo']="TITOLO 3/1";
$elemento[3]['contenuto']="Contenuto 3 lista 1.";

$elemento[4]['titolo']="TITOLO 1/2";
$elemento[4]['contenuto']="Contenuto 1 lista 2.";
$elemento[5]['titolo']="TITOLO 2/2";
$elemento[5]['contenuto']="Contenuto 2 lista 2.";
$elemento[6]['titolo']="TITOLO 3/2";
$elemento[6]['contenuto']="Contenuto 3 lista 2.";

$elemento[7]['titolo']="TITOLO 1/3";
$elemento[7]['contenuto']="Contenuto 1 lista 3.";
$elemento[8]['titolo']="TITOLO 2/3";
$elemento[8]['contenuto']="Contenuto 2 lista 3.";
$elemento[9]['titolo']="TITOLO 3/3";
$elemento[9]['contenuto']="Contenuto 3 lista 3.";

//controllo cookie
if(!isset($_COOKIE['cookie_colonna1']) && !isset($_COOKIE['cookie_colonna2']) && !isset($_COOKIE['cookie_colonna3'])){
	setcookie ( "cookie_colonna1","1,2,3",time()+2592000);
	setcookie ( "cookie_colonna2","4,5,6",time()+2592000);
	setcookie ( "cookie_colonna3","7,8,9",time()+2592000);
	$array_colonna1=array(1,2,3);
	$array_colonna2=array(4,5,6);
	$array_colonna3=array(7,8,9);
}else{
	if(isset($_COOKIE['cookie_colonna1'])){
		$array_colonna1=explode(",",$_COOKIE['cookie_colonna1']);
	}else{
		$array_colonna1=Array();
	}
	if(isset($_COOKIE['cookie_colonna2'])){
		$array_colonna2=explode(",",$_COOKIE['cookie_colonna2']);
	}else{
		$array_colonna2=Array();
	}
	if(isset($_COOKIE['cookie_colonna3'])){
		$array_colonna3=explode(",",$_COOKIE['cookie_colonna3']);
	}else{
		$array_colonna3=Array();
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>Script ajax: Drag and drop con scriptaculous e salvataggio posizione</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <script src="ajax/prototype.js" type="text/javascript"></script>
  <script src="ajax/scriptaculous.js" type="text/javascript"></script>
  <script src="ajax/unittest.js" type="text/javascript"></script>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>

<div class="container">
	<div class="colonna">
		<ul class="sortabledemo" id="firstlist">
			<?
			for($elementi=0;$elementi<count($array_colonna1);$elementi++){
			?>
			<li class="item" id="firstlist_key<?=$array_colonna1[$elementi]?>">
				<div class="handle"><?=$elemento[$array_colonna1[$elementi]]['titolo']?></div> <?=$elemento[$array_colonna1[$elementi]]['contenuto']?>
			</li>
			<?
			}
			?>
		</ul>
	</div>
	<div class="colonna">
		<ul class="sortabledemo" id="secondlist">
			<?
			for($elementi=0;$elementi<2;$elementi++){
			?>
			<li class="item" id="secondlist_key<?=$array_colonna2[$elementi]?>">
				<div class="handle"><?=$elemento[$array_colonna2[$elementi]]['titolo']?></div> <?=$elemento[$array_colonna2[$elementi]]['contenuto']?>
			</li>
			<?
			}
			?>
		</ul>
	</div>
	<div class="colonna">
		<ul class="sortabledemo" id="thirdlist">
			<?
			for($elementi=0;$elementi<count($array_colonna3);$elementi++){
			?>
			<li class="item" id="secondlist_key<?=$array_colonna3[$elementi]?>">
				<div class="handle"><?=$elemento[$array_colonna3[$elementi]]['titolo']?></div> <?=$elemento[$array_colonna3[$elementi]]['contenuto']?>
			</li>
			<?
			}
			?>
		</ul>
	</div>
</div>


 <script type="text/javascript">
 // <![CDATA[
   Sortable.create("firstlist",
     {dropOnEmpty:true,handle:'handle',containment:["firstlist","secondlist","thirdlist"],constraint:false,
      onUpdate:function(){var myAjax = new Ajax.Request("save.php", {method:'get',parameters:Sortable.serialize('firstlist')+"&"+Sortable.serialize('secondlist')+"&"+Sortable.serialize('thirdlist')}) }});
   Sortable.create("secondlist",
     {dropOnEmpty:true,handle:'handle',containment:["firstlist","secondlist","thirdlist"],constraint:false,
     onUpdate:function(){var myAjax = new Ajax.Request("save.php", {method:'get',parameters:Sortable.serialize('firstlist')+"&"+Sortable.serialize('secondlist')+"&"+Sortable.serialize('thirdlist')}) }});
   Sortable.create("thirdlist",
     {dropOnEmpty:true,handle:'handle',containment:["firstlist","secondlist","thirdlist"],constraint:false,
     onUpdate:function(){var myAjax = new Ajax.Request("save.php", {method:'get',parameters:Sortable.serialize('firstlist')+"&"+Sortable.serialize('secondlist')+"&"+Sortable.serialize('thirdlist')}) }});
 // ]]>
 </script>
 

 </body>
 </html>