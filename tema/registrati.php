<?php
	$_SESSION['login']="";
	unset($_SESSION['login']);
	unset($_SESSION['query']);
	
	//ricavo dati se nn corretti
	$nome=$_POST['nome'];
	$cognome=$_POST['cognome'];
	$sesso=$_POST['sesso'];
	$citta=$_POST['citta'];
	$provincia=$_POST['provincia'];
	$indirizzo=$_POST['via'];
	$cap=$_POST['cap'];
	$telefono=$_POST['telefono'];
	$usern=$_POST['user'];
	$pswdb=$_POST['psw'];
	$email=$_POST['email'];
	//fine ricavo
?>
<script type="text/javascript" src="tema/js/scripts.js"></script>
<div class="box-titlepagina">
	<div class="titlepagina">
		<h2>Registrazione</h2>
	</div>
</div>
<div class="box-prodotti divpagine">
	<div class="pagina">
		<div class="registrazione">
			<form action="registrazionedb.html" name="invio" id="invio" method="post" Onsubmit="return registrazione();">
				<p class="obbligatorio">*Campo obbligatorio</p>
				<div class="boxreg">
					<div class="nome"><span>*</span>Nome:</div>
					<input type="text" name="nome" id="nome" value="<? print $nome; ?>" size="50" <? if(isset($_POST['nome']) and  $_POST['nome']==""){ print "class='error'";} ?>>
				</div>
				<div class="boxreg">
					<div class="nome"><span>*</span>Cognome:</div>
					<input type="text" name="cognome" id="cognome" value="<? print $cognome; ?>" size="50" <? if(isset($_POST['cognome']) and  $_POST['cognome']==""){ print "class='error'";} ?>>
				</div>
				<div class="boxreg">
					<div class="nome"><span>*</span>Sesso:</div>
					<input type="radio" name="sesso" id="sesso" value="m" <? if(isset($_POST["sesso"]) and  $_POST["sesso"]=="m"){ print "checked=checked";} ?>><span class="sesso">M</span><input type="radio" name="sesso" id="sesso"  value="f" <? if(isset($_POST["sesso"]) and  $_POST["sesso"]=="f"){ print "checked=checked";} ?>><span class="sesso">F</span>
				</div>
				<div class="boxreg">
					<div class="nome"><span>*</span>Data di nascita:</div>
<?php
					if(isset($_POST["giorno"]) and  isset($_POST["mese"]) and isset($_POST["anno"]) and !isset($_POST["data"])){
?>
						<select name='giorno' id='giorno' size='1' class='input1'>
							<option value='<?php print $_POST["giorno"]; ?>' selected><?php print $_POST["giorno"]; ?></option>
							<option value='01'>01</option>
							<option value='02'>02</option>
							<option value='03'>03</option>
							<option value='04'>04</option>
							<option value='05'>05</option>
							<option value='06'>06</option>
							<option value='07'>07</option>
							<option value='08'>08</option>
							<option value='09'>09</option>
							<option value='10'>10</option>
							<option value='11'>11</option>
							<option value='12'>12</option>
							<option value='13'>13</option>
							<option value='14'>14</option>
							<option value='15'>15</option>
							<option value='16'>16</option>
							<option value='17'>17</option>
							<option value='18'>18</option>
							<option value='19'>19</option>
							<option value='20'>20</option>
							<option value='21'>21</option>
							<option value='22'>22</option>
							<option value='23'>23</option>
							<option value='24'>24</option>
							<option value='25'>25</option>
							<option value='26'>26</option>
							<option value='27'>27</option>
							<option value='28'>28</option>
							<option value='29'>29</option>
							<option value='30'>30</option>
							<option value='31'>31</option>
						</select>
						<select name='mese' id="mese" size='1' class='input1'>
							<option value='<?php print $_POST["mese"]; ?>' selected><?php print visualizzamese($_POST["mese"]); ?></option>
							<option value='01'>Gennaio</option>
							<option value='02'>Febbraio</option>
							<option value='03'>Marzo</option>
							<option value='04'>Aprile</option>
							<option value='05'>Maggio</option>
							<option value='06'>Giugno</option>
							<option value='07'>Luglio</option>
							<option value='08'>Agosto</option>
							<option value='09'>Settembre</option>
							<option value='10'>Ottobre</option>
							<option value='11'>Novembre</option>
							<option value='12'>Dicembre</option>
						</select>
<?php
						$anno=date("Y")-17;
?>
						<select name='anno' id="anno" size='1' class='input1'>
							<option value='<?php print $_POST["anno"]; ?>' selected><? print $_POST["anno"]; ?></option>
<?php
							for($i=0; $i<=100; $i++){
								$anno=$anno-1;
								print "<option value='$anno'>$anno</option>";
							}
?>
						</select>
<?php
					}else{
						if(isset($_POST["data"]) and $_POST["data"]=="0"){
							datanascita("true","true","true","true")."<br />";
						}else{
							datanascita("true","true","true","false")."<br />";
						}
					}
?>
				</div>
				<div class="boxreg">
					<div class="cap"><span>*</span>Cap:</div>
					<input type="text" name="cap" id="cap" value="<? print $cap; ?>" size="5" <? if(isset($_POST['cap']) and $_POST['cap']==""and strlen($cap)!=5){ print "class='error'";} ?>>
					<div class="citta"><span>*</span>Citt&agrave;:</div>
					<input type="text" name="citta" id="citta" value="<? print $citta; ?>" size="21" <? if(isset($_POST['citta']) and  $_POST['citta']==""){ print "class='error'";} ?>>
					<div class="prov"><span>*</span>Provincia:</div>
					<input type="text" name="provincia" id="provincia" value="<? print $provincia; ?>" size="10" <? if(isset($_POST['provincia']) and $_POST['provincia']==""){ print "class='error'";} ?>>
				</div>
				<div class="boxreg">
					<div class="nome"><span>*</span>Indirizzo:</div>
					<input type="text" name="via" id="via" value="<? print stripslashes($indirizzo); ?>" size="32" <? if(isset($_POST['via']) and $_POST['via']==""){ print "class='error'";} ?>>
				</div>
				<div class="boxreg">
					<div class="nome"><span>*</span>Telefono:</div>
					<input type="text" name="telefono" id="telefono" value="<? print $telefono; ?>" size="50">
				</div>			
				<div class="boxreg">
					<div class="nome"><span>*</span>Username:</div>
					<input type="text" name="user" id="user" value="<? print $usern; ?>" size="50" <? if(isset($_POST['user']) and $_POST['user']==""){ print "class='error'";} ?>>
				</div>	
				<div class="boxreg">
					<div class="nome"><span>*</span>Password:</div>
					<input type="password" name="psw" id="psw" value="<? print $pswdb; ?>" size="50" <?php if(isset($_POST['psw']) and $_POST['psw']==""){ print "class='error'";} ?>>
				</div>	
				<div class="boxreg">
					<div class="nome"><span>*</span>Email:</div>
					<input type="text" name="email" id="email" value="<? if(isset($_POST['email_newsletter'])){print $_POST['email_newsletter'];} if(isset($_POST['newsletter']) and $_POST['newsletter']=="1"){ print $_POST['emailnew'];}else{ print $email;} ?>" size="50" <? if(isset($_POST['email']) and $_POST['email']==""){ print "class='error'";} ?>>
				</div>
				<div class="newsletter">
					<p><input type="checkbox" name="newsletter" id="newsletter" <? if(isset($_POST['newsletter']) and $_POST['newsletter']=="1"){ print "checked='checked'";} ?>>Voglio ricevere le Newsletter di <span><?php print $titolosito; ?></span></p>
				</div>
				<div class="boxreg">
					<div class="nome"><span>*</span>Legge privacy:</div>
					<?php include "w-admin/inclusi/setting.php"; ?>
					<textarea name="privacy" id="privacy" cols="38" rows="10" readonly><?php print htmlspecialchars(html_entity_decode($legge)); ?></textarea>
					<span class="check"><input checked="checked" type="checkbox" id="legge" name="legge">Accetta la Legge sulla privacy</span>
				</div>	
				<div class="captcha">
					<p class="nome"><span>*</span>Codice Captcha</p>
					<div class="imgcaptcha"><img src="<?php print "http://".$_SERVER['HTTP_HOST']; ?>/w-admin/inclusi/captcha.php" alt="captcha codice" name="captcha" width="233" height="49" id="captcha"></div>
				</div>
				<div class="captcha">
					<p class="testocaptcha"><span>*</span>Inserisci il testo che vedi nell'immagine</p>
					<input class="txt_captcha" name="txt_captcha" type="text" id="txt_captcha">
				</div>
				<div class="registrazionebutton">	
					<input class="btn-form" type="Submit" name="cmd" id="cmd" value="Registrati">	
				</div>
				<input type="hidden" name="ins" id="ins" value="reg">	
			</form>
		</div>
	</div>		
</div>