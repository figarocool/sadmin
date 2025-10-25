<? if(isset($_POST['ricercap']) and strlen($_POST['ricercap'])=="1" or strlen($_SESSION['query'])>0){ $altezza="height: 200px;"; $visibile="display: none;"; }else{ $altezza="height: 1px; border: 1px solid #000;";} ?>
					<div style="width: 100%;">
						<input type="image" src="immagini/cercaprev.jpg" name="cercaprev" id="cercaprev" style="text-align: left; <? print $visibile; ?>" onclick="javascript: apricerca();"/>
					</div>
					<div id="divricerca" name="divricerca" style="<? print $altezza; ?> display: visible; width: 100%;  overflow: hidden;">
						<form name="formpreventivo" id="formpreventivo" action="ricercapreventivo.php" method="POST">
						<table style="width: 100%; font-weight: bold; font-size: 18px;">
							<tr>
								<td>Ricerca un preventivo:</td>
							</tr>
						</table>
						<table cellpadding="0" cellspacing="0" style="border: 2px solid #8BAECE; margin-bottom: 20px; font-size: 14px; font-weight: bold; background-color: #D5E2EB; width: 100%;">
							<tr>
								<td>
									<table style="width: 100%;">
										<tr>
											<td style="border: 1px solid #fff; height: 40px; padding-left: 5px;">Numero preventivo: <input type="text" name="nump" id="nump" value="" size="5"></td>
											<td style="border: 1px solid #fff; height: 40px; padding-left: 5px;">
												<table>
													<tr>
														<td>
															Nome: <input type="text" name="nome" id="nome" value="" size="22" style="vertical-align: top;">
														</td>
														<td>
															Cognome: <input type="text" name="cognome" id="cognome" value="" size="22" style="vertical-align: top;">
														</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>							
											<td style="border: 1px solid #fff; height: 60px; padding-left: 5px;">Data preventivo: <br />
												<select name="giorno" id="giorno">
													<option value="0">Giorno</option>
													<option value="01">01</option>
													<option value="02">02</option>
													<option value="03">03</option>
													<option value="04">04</option>
													<option value="05">05</option>
													<option value="06">06</option>
													<option value="07">07</option>
													<option value="08">08</option>
													<option value="09">09</option>
													<option value="10">10</option>
													<option value="11">11</option>
													<option value="12">12</option>
													<option value="13">13</option>
													<option value="14">14</option>
													<option value="15">15</option>
													<option value="16">16</option>
													<option value="17">17</option>
													<option value="18">18</option>
													<option value="19">19</option>
													<option value="20">20</option>
													<option value="21">21</option>
													<option value="22">22</option>
													<option value="23">23</option>
													<option value="24">24</option>
													<option value="25">25</option>
													<option value="26">26</option>
													<option value="27">27</option>
													<option value="28">28</option>
													<option value="29">29</option>
													<option value="30">30</option>
													<option value="31">31</option>
												</select>
												<select	name="mese" id="mese">
													<option value="0">Mese</option>
													<option value="01">Gennaio</option>
													<option value="02">Febbraio</option>
													<option value="03">Marzo</option>
													<option value="04">Aprile</option>
													<option value="05">Maggio</option>
													<option value="06">Giugno</option>
													<option value="07">Luglio</option>
													<option value="08">Agosto</option>
													<option value="09">Settembre</option>
													<option value="10">Ottobre</option>
													<option value="11">Novembre</option>
													<option value="12">Dicembre</option>
												</select>
												<select name="anno" id="anno">
													<option value="0">Anno</option>
			<?										//Prendo solo gli anni in cui sono stati fatti i preventivi
													$queryanno=mysql_query("SELECT data FROM preventivi group by Year(data) order by data desc") or die ("Query: anno non eseguita!");
													while($datanno=mysql_fetch_array($queryanno)){
														$splitdata=explode("-",$datanno[0]);
														print "<option value='".$splitdata[0]."'>".$splitdata[0]."</option>";
													}
			?>									</select>
											</td>
											<td  style="border: 1px solid #fff; height: 60px; padding-left: 5px;">
												<table border="0">
													<tr>
														<td>
															Mobile: <br />
															<select name="marca" id="marca" Onchange="javascript: selezioneprodotti(this.value);">
																<option value="0">Marca</option>
						<?										//Prendo solo gli anni in cui sono stati fatti i preventivi
																$querymarca=mysql_query("SELECT id,nome FROM `marche` WHERE 1 order by nome asc") or die ("Query: marca non eseguita!");
																while($nomemarca=mysql_fetch_array($querymarca)){
																	print "<option value='".$nomemarca[0]."'>".str_replace(chr(92)."'","'",$nomemarca[1])."</option>";
																}
						?>									</select>
														</td>
														<td>
															<div id="ricavoprodotti" style="margin-top: 18px; background-color: #D5E2EB;">
																<select name="prodotti" id="prodotti" style="width: 230px;">
																</select>
															</div>
															<input type="hidden" name="idprodotto" id="idprodotto" value="" />
														</td>
													</tr>
												</table>													
											</td>
										</tr>
									</table>
									<table style="width: 100%; text-align: right;">							
										<tr>
											<td>
												<input type="image" src="immagini/cercapreventivo.jpg" name="cmd" id="cmd" value="cerca"/>
												<input type="hidden" name="ricercap" id="ricercap" value="1" />
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>	
						</form>	
					</div>