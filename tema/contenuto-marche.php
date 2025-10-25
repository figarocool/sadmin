	<div class="box-titlepagina">
		<div class="titlepagina">
			<h2>Le nostre marche</h2>
		</div>
	</div>
	<div class="box-prodotti divpagine">
		<div class="pagina">
<?php		//connessione al database
			$db = mysql_connect($host, $user, $psw) or die ("Errore nella connessione.");
			//selezione del database
			mysql_select_db($database) or die ("Non riesco a selezionare il database");
			$query=mysql_query("select * from marche order by nome asc") or die ("Query marche non eseguita!");
			while($data=mysql_fetch_array($query)){?>
				<div class="marca"><a href="http://<? print $_SERVER["HTTP_HOST"];  ?>/MOBILIFICIO/<? print strtoupper(puliscistring($data[1]))."-".$data[0]; ?>/categorie.html" title="Permalink a <? print $data[1]; ?>"> &raquo; <? print str_replace("\'","'",$data[1]); ?> </a></div>
<?php		}
			mysql_close($db);
?>		</div>
	</div>