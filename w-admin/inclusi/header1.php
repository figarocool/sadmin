<!--<div class="box2">
	<div class="header">
		<a href="http://www.wadmin.it" title="W-Admin" id="cd-logo">
			<img src="immagini/w-admin.jpg">
		</a>	
	</div>
	<div class="header1">
		<div class="testoheader1">
			Benvenuto <b><?php //print $_SESSION['prof']; ?></b> | <a href="http://<?php //print $_SERVER['HTTP_HOST']."/tema/esci.php?esci=1";?>" style="color:#fff;"><u>[Esci dall'account]</u></a>
		</div>	
		<div class="profilo">
			<a href="profilo1.php?prof=<?php //print $_SESSION['id']; ?>">
				<img src="immagini/freccia.jpg" border="0"> Profilo
			</a>
		</div>
	</div>
</div>-->

<div id="header">
	<a href="http://<?php print $_SERVER['HTTP_HOST']; ?>" title="Home" id="cd-logo">
		<img src="immagini/w-admin.jpg" alt="S-Admin">
	</a>
	<div id="cd-top-nav">
		<ul>
			<li class="testoheader1">
				Benvenuto <b><?php print $_SESSION['prof']; ?></b> | <a href="http://<?php print $_SERVER['HTTP_HOST']."/tema/esci.php?esci=1";?>"><u>[Esci dall'account]</u></a>
			</li>	
			<li class="profilo">
				<a href="profilo1.php?prof=<?php print $_SESSION['id']; ?>">
					<img src="immagini/freccia.jpg" border="0"> Profilo
				</a>
			</li>
		</ul>
	</div>
	<a id="cd-menu-trigger" href="#0">
		<span class="cd-menu-text">Menu</span>
		<span class="cd-menu-icon"></span>
	</a>
</div>