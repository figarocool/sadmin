<div class="prodotto">
	<div class="imgprodotto">
		<a href="<?php print "/".puliscistring($ricavomarca)."/".puliscistring($titoloprodotto)."-".puliscitesto($idprodotto)."/index.html"; ?>" title="<?php print "Permalink a ".$titoloprodotto; ?>">
<?php
			if($bloccato==1){
?>
				<img src="/tema/immagini/offerta.png" class="offerta">
				<img class="nondisponibile" src="/tema/immagini/nondisponibile.png" alt="<?php print  $ricavomarca." - ".$titoloprodotto; ?>" title="<?php print  $ricavomarca." - ".puliscitesto($titoloprodotto); ?>">
<?php
			}
?>
			<img src="<?php print "http://".$_SERVER['HTTP_HOST']."/upload/".$imgmax;?>" alt="<?php print  $ricavomarca." - ".$titoloprodotto; ?>" title="<?php print  $ricavomarca." - ".puliscitesto($titoloprodotto); ?>">
		</a>
	</div>
	<p><a href="<?php print "/".puliscistring($ricavomarca)."/".puliscistring($titoloprodotto)."-".puliscitesto($idprodotto)."/index.html"; ?>" title="<?php print "Permalink a ".$titoloprodotto; ?>"><?php print puliscitesto($titoloprodotto); ?></a></p>
	<a class="visualizza-min" rel="lightbox" href="<? print "/upload/".$imgmax; ?>" title="Ingrandisci <? print  $titoloprodotto; ?>"><img src="/tema/immagini/ingrandisci.png" alt="Ingrandisci prodotto"></a>
</div>