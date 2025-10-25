					<div id="divricerca" name="divricerca">
						<form name="formpreventivo" id="formpreventivo" action="caricoprezzi.php" method="POST">
						<table style="width: 520px; font-weight: bold; font-size: 18px;">
							<tr>
								<td>Seleziona un mobile:</td>
							</tr>
						</table>
						<table cellpadding="0" cellspacing="0" style="border: 2px solid #8BAECE; margin-bottom: 20px; font-size: 14px; font-weight: bold; background-color: #D5E2EB; width: 520px;">
							<tr>
								<td>
									<table style="width: 520px;">
										<tr>							
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
															<div id="ricavoprodotti" style="margin-top: 18px; margin-left: 10px; background-color: #D5E2EB;">
																<select name="prodotti" id="prodotti" style="width: 230px;">
																	<option value="0">Seleziona Prodotto</option>
																</select>
															</div>
															<input type="hidden" name="idprodotto" id="idprodotto" value="" />
														</td>
													</tr>
												</table>													
											</td>
										</tr>
									</table>
									<table style="width: 520px; text-align: right;">							
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