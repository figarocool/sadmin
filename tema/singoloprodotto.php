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
	<div class="descrprodotto">
		<p>
			<a href="<?php print "/".puliscistring($ricavomarca)."/".puliscistring($titoloprodotto)."-".puliscitesto($idprodotto)."/index.html"; ?>" title="<?php print "Permalink a ".$titoloprodotto; ?>"><?php print puliscitesto($titoloprodotto); ?></a>
		</p>
		<p>
			<?php print $descprodotto; ?>
		</p>
		<?php if (strlen($prezzo)!=0) echo "<p style='font-size: 14px; color: #000; font-weight:bold;' >&euro; &nbsp;".$prezzo."</p>";?>  
	</div>
	<div>
	</div>
</div>