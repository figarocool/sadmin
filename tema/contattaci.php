<?php 
	$_SESSION['richiesta']='1'; 
	unset($_SESSION['query']);
?>
		<script src="tema/js/richiesta.js" type="text/javascript"></script>
<div class="box-titlepagina">
	<div class="titlepagina">
		<h2>Contattaci</h2>
	</div>
</div>
<div class="box-prodotti divpagine">		
	<div class="pagina">
		<form action="inviorichiesta.html" name="richiesta" id="richiesta" method="post" Onsubmit="javascript: return controllocampi(valore);">
		<div class="registrazione">
			<div class="campoob">* Campo obbligatorio</div>
			<div class="box">
				<div class="divcampi">
					<div class="campi">Nome:*</div>
					<div class="campi">Cognome:*</div>
					<div class="campi">Citt&agrave;:*</div>
					<div class="campi">Provincia:*</div>
					<div class="campi">Tel:*</div>
					<div class="campi">E-mail:</div>
					<div class="campi">Richiesta:*</div>
				</div>
				<div class="divcampi">
					<div class="input"><input type="text" name="nome" id="nome" value="" Onclick="javascript: formatto('1');" Onkeypress="javascript: formatto1('1');"></div>
					<div class="input"><input type="text" name="cognome" id="cognome" value="" Onclick="javascript: formatto('2');" Onkeypress="javascript: formatto1('1');"></div>
					<div class="input"><input type="text" name="paese" id="paese" value="" Onclick="javascript: formatto('4');" Onkeypress="javascript: formatto1('1');"></div>
					<div class="input"><input type="text" name="prov" id="prov" value="" Onclick="javascript: formatto('5');" Onkeypress="javascript: formatto1('1');"></div>
					<div class="input"><input type="text" name="tel" id="tel" value="" Onclick="javascript: formatto('6');" Onkeypress="javascript: formatto1('1');"></div>
					<div class="input"><input type="text" name="email" id="email" value="" Onclick="javascript: formatto('7');" Onkeypress="javascript: formatto1('7');"></div>
					<div class="input"><textarea id="richiesta" name="richiesta" rows="10" cols="35" Onclick="javascript: formatto('3');" Onkeypress="javascript: formatto1('1');"></textarea></div>
				</div>
			</div>
			<div class="bottonerichiesta">
				<input type="hidden" id="ric" name="ric" value="1">
				<input type="Submit" class="resetric" id="button" name="button" value="Reset" Onclick="javascript: cancellafrm();">
				<input type="Submit" class="inviaric" id="submit" name="submit" value="Invia richiesta" Onclick="javascript: inviofrm();">		
			</div>
		</form>		
		</div>
	</div>	
</div>	