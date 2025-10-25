<img src="<? print $_GET['img']; ?>"><br />
<? 
	$immagine=explode(chr(47),$_GET['img']);
	print array_pop($immagine)."<span style='margin-left: 750px;'>&nbsp;</span>"; 
?> 
	
	<input type="image" src="../immagini/chiudi.jpg" name="asd" id="asd" value=" Chiudi" onclick="javascript: top.frames['scrivipagina'].style.display='none';top.aggiorna();">