<table style="width: 700px;">
	<tr>
		<td>
			<table class="tabellarecord">
				<tr>
					<td bgcolor="#5788AF" style="padding-left: 10px;">Ultimi 8 Utenti Registrati</td>
				</tr>
				<tr>
					<td bgcolor="#CADDEC">
						<table>
							<tr>
								<td class="sinistra10">
<?									$ricavoquery="select * from utenti order by id desc limit 9";
									$ricavoris=mysql_query($ricavoquery) or die ("Query: ".$ricavoquery." non eseguita!");
									if($numutenti>0){
										while($data=mysql_fetch_array($ricavoris)){
											$cont=$cont+1;
											$contatore=($numutenti+1)-$cont;
											print "<span class='recordutenti'><a href='http://".$_SERVER['HTTP_HOST']."/w-admin/inserimentoutente.php?mod=$data[0]'><b>".$contatore."</b>&nbsp;&nbsp;".$data[10]."</a></span>"."<br />";
										}
									}
?>								</td>
							</tr>
						</table>
					</td>	
				</tr>
			</table>
		</td>
		<td>
			<table class="tabellarecord">
				<tr>
					<td bgcolor="#5788AF" height="10">Stato Attuale</td>
				</tr>
				<tr>
					<td bgcolor="#CADDEC" class="allineasu">
						<table>
							<tr>
								<td>
<?									if($numprodotti>0){
?>										<table border="0" width="300px">
											<tr>
												<td width="50px;"><span class='numrecord'><? print $numprodotti; ?></span></td>
												<td width="250px"><span class='record'>Prodotti inseriti</span></td>
											</tr>
											<tr>
												<td width="50px;"><span class='numrecord'><? print $numofferte; ?></span></td>
												<td width="250px"><span class='record'>Offerte inserite</span></td>
											</tr>
											<tr>
												<td width="50px;"><span class='numrecord'><? print $numcategorie; ?></span></td>
												<td width="250px"><span class='record'>Categorie inserite</span></td>
											</tr>
											<tr>
												<td width="50px;"><span class='numrecord'><? print $nummarche; ?></span></td>
												<td width="250px"><span class='record'>Marche inserite</span></td>
											</tr>
											<tr>
												<td width="50px;"><span class='numrecord'><? print $numutenti; ?></span></td>
												<td width="250px"><span class='record'>Utenti registrati</span></td>
											</tr>
										</table>
<?									}
?>								</td>
							</tr>
						</table>
					</td>	
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>
			<table class="tabellarecord">
				<tr>
					<td bgcolor="#5788AF" height="10">Mobili pi&ugrave; visualizzati</td>
				</tr>
				<tr>
					<td bgcolor="#CADDEC" class="allineasu">
						<table>
							<tr>
								<td>
									<table border="0" width="300px">
										<tr>
											<td>
<?												$visualizzoquery="select * from ultimimobili order by visualizzato desc limit 9";
												$visualizzoris=mysql_query($visualizzoquery) or die ("Query: ".$visualizzoquery." non eseguita!");
												if($numutenti>0){
													while($data=mysql_fetch_array($visualizzoris)){
														$prodquery=mysql_query("select * from prodotti where id='".$data[1]."'") or die ("Query: ultimi non eseguita!");
														$nomeproddb=utf8_encode(@mysql_result($prodquery,0,1));
														if(strlen($nomeproddb)>25){
															$nomeproddb=substr($nomeproddb,0,18)."...";
														}
															if($data[1]!='0'){
																print "<span class='recordutenti'><a href='http://".$_SERVER['HTTP_HOST']."/w-admin/modificaprodotti.php?mod=$data[1]'><b>".$data[2]."</b>&nbsp;&nbsp;".$nomeproddb."</a></span>"."<br />";
															}
													}
												}
?>												</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>	
				</tr>
			</table>
		</td>
	</tr>
</table>