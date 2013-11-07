<?php // Logic for Facility Bar
		echo '<table id="facility_bar" width="630" border="0">';
			echo '<tr>';
				
				if ($AlertStats['ResultAlertType'] == "Amp") 
				{
					if (($AlertStats['ResultAlertCont'] == "Indar") || ($AlertStats['ResultAlertCont'] == "Cross"))
					{
						if ($facility_last_result["Peris"] == 1)
						{
							$win_peris = "VS";
						}
						else if ($facility_last_result["Peris"] == 2)
						{
							$win_peris = "NC";
						}
						else if ($facility_last_result["Peris"] == 3)
						{
							$win_peris = "TR";
						}
							
						echo '<td class="facility_cell form_item_text" style="text-align: center;">';
							echo '<span class="icon icon_'.$AlertStats['ResultAlertType'].'_'.$win_peris.'"></span>';
							echo '<br />';
							echo '<b>Peris</b>';
							echo '<br />';
							echo '(Indar)';
						echo '</td>';
						
						if ($facility_last_result["Dahaka"] == 1)
						{
							$win_dahaka = "VS";
						}
						else if ($facility_last_result["Dahaka"] == 2)
						{
							$win_dahaka = "NC";
						}
						else if ($facility_last_result["Dahaka"] == 3)
						{
							$win_dahaka = "TR";
						}
						
						echo '<td class="facility_cell form_item_text" style="text-align: center;">';
							echo '<span class="icon icon_'.$AlertStats['ResultAlertType'].'_'.$win_dahaka.'"></span>';
							echo '<br />';
							echo '<b>Dahaka</b>';
							echo '<br />';
							echo '(Indar)';
						echo '</td>';
						
						if ($facility_last_result["Zurvan"] == 1)
						{
							$win_zurvan = "VS";
						}
						else if ($facility_last_result["Zurvan"] == 2)
						{
							$win_zurvan = "NC";
						}
						else if ($facility_last_result["Zurvan"] == 3)
						{
							$win_zurvan = "TR";
						}
						
						echo '<td class="facility_cell form_item_text" style="text-align: center;">';
							echo '<span class="icon icon_'.$AlertStats['ResultAlertType'].'_'.$win_zurvan.'"></span>';
							echo '<br />';
							echo '<b>Zurvan</b>';
							echo '<br />';
							echo '(Indar)';
						echo '</td>';
					}
					
					if (($AlertStats['ResultAlertCont'] == "Amerish") || ($AlertStats['ResultAlertCont'] == "Cross"))
					{
						if ($facility_last_result["Kwahtee"] == 1)
						{
							$win_kwahtee = "VS";
						}
						else if ($facility_last_result["Kwahtee"] == 2)
						{
							$win_kwahtee = "NC";
						}
						else if ($facility_last_result["Kwahtee"] == 3)
						{
							$win_kwahtee = "TR";
						}
						echo '<td class="facility_cell form_item_text" style="text-align: center;">';
							echo '<span class="icon icon_'.$AlertStats['ResultAlertType'].'_'.$win_kwahtee.'"></span>';
							echo '<br />';
							echo '<b>Kwahtee</b>';
							echo '<br />';
							echo '(Amerish)';
						echo '</td>';
						
						if ($facility_last_result["Sungrey"] == 1)
						{
							$win_sungrey = "VS";
						}
						else if ($facility_last_result["Sungrey"] == 2)
						{
							$win_sungrey = "NC";
						}
						else if ($facility_last_result["Sungrey"] == 3)
						{
							$win_sungrey = "TR";
						}
						
						echo '<td class="facility_cell form_item_text" style="text-align: center;">';
							echo '<span class="icon icon_'.$AlertStats['ResultAlertType'].'_'.$win_sungrey.'"></span>';
							echo '<br />';
							echo '<b>Sungrey</b>';
							echo '<br />';
							echo '(Amerish)';
						echo '</td>';
						
						if ($facility_last_result["Wokuk"] == 1)
						{
							$win_wokuk = "VS";
						}
						else if ($facility_last_result["Wokuk"] == 2)
						{
							$win_wokuk = "NC";
						}
						else if ($facility_last_result["Wokuk"] == 3)
						{
							$win_wokuk = "TR";
						}
						
						echo '<td class="facility_cell form_item_text" style="text-align: center;">';
							echo '<span class="icon icon_'.$AlertStats['ResultAlertType'].'_'.$win_wokuk.'"></span>';
							echo '<br />';
							echo '<b>Wokuk</b>';
							echo '<br />';
							echo '(Amerish)';
						echo '</td>';
					}
					
					if (($AlertStats['ResultAlertCont'] == "Esamir") || ($AlertStats['ResultAlertCont'] == "Cross"))
					{
						
						if ($facility_last_result["Elli"] == 1)
						{
							$win_elli = "VS";
						}
						else if ($facility_last_result["Elli"] == 2)
						{
							$win_elli = "NC";
						}
						else if ($facility_last_result["Elli"] == 3)
						{
							$win_elli = "TR";
						}
						
						echo '<td class="facility_cell form_item_text" style="text-align: center;">';
							echo '<span class="icon icon_'.$AlertStats['ResultAlertType'].'_'.$win_elli.'"></span>';
							echo '<br />';
							echo '<b>Elli</b>';
							echo '<br />';
							echo '(Esamir)';
						echo '</td>';
						
						if ($facility_last_result["Freyr"] == 1)
						{
							$win_freyr = "VS";
						}
						else if ($facility_last_result["Freyr"] == 2)
						{
							$win_freyr = "NC";
						}
						else if ($facility_last_result["Freyr"] == 3)
						{
							$win_freyr = "TR";
						}
						
						echo '<td class="facility_cell form_item_text" style="text-align: center;">';
							echo '<span class="icon icon_'.$AlertStats['ResultAlertType'].'_'.$win_freyr.'"></span>';
							echo '<br />';
							echo '<b>Freyr</b>';
							echo '<br />';
							echo '(Esamir)';
						echo '</td>';
						
						if ($facility_last_result["Nott"] == 1)
						{
							$win_nott = "VS";
						}
						else if ($facility_last_result["Nott"] == 2)
						{
							$win_nott = "NC";
						}
						else if ($facility_last_result["Nott"] == 3)
						{
							$win_nott = "TR";
						}
						
						echo '<td class="facility_cell form_item_text" style="text-align: center;">';
							echo '<span class="icon icon_'.$AlertStats['ResultAlertType'].'_'.$win_nott.'"></span>';
							echo '<br />';
							echo '<b>Nott</b>';
							echo '<br />';
							echo '(Esamir)';
						echo '</td>';
					}
					
				} 
				else if ($AlertStats['ResultAlertType'] == "Bio") 
				{
					if (($AlertStats['ResultAlertCont'] == "Indar") || ($AlertStats['ResultAlertCont'] == "Cross"))
					{
						if ($facility_last_result["Allatum"] == 1)
						{
							$win_allatum = "VS";
						}
						else if ($facility_last_result["Allatum"] == 2)
						{
							$win_allatum = "NC";
						}
						else if ($facility_last_result["Allatum"] == 3)
						{
							$win_allatum = "TR";
						}
							
						echo '<td class="facility_cell form_item_text" style="text-align: center;">';
							echo '<span class="icon icon_'.$AlertStats['ResultAlertType'].'_'.$win_allatum.'"></span>';
							echo '<br />';
							echo '<b>Allatum</b>';
							echo '<br />';
							echo '(Indar)';
						echo '</td>';
						
						if ($facility_last_result["Saurva"] == 1)
						{
							$win_saurva = "VS";
						}
						else if ($facility_last_result["Saurva"] == 2)
						{
							$win_saurva = "NC";
						}
						else if ($facility_last_result["Saurva"] == 3)
						{
							$win_saurva = "TR";
						}
						
						echo '<td class="facility_cell form_item_text" style="text-align: center;">';
							echo '<span class="icon icon_'.$AlertStats['ResultAlertType'].'_'.$win_saurva.'"></span>';
							echo '<br />';
							echo '<b>Saurva</b>';
							echo '<br />';
							echo '(Indar)';
						echo '</td>';
						
						if ($facility_last_result["Rashnu"] == 1)
						{
							$win_rashnu = "VS";
						}
						else if ($facility_last_result["Rashnu"] == 2)
						{
							$win_rashnu = "NC";
						}
						else if ($facility_last_result["Rashnu"] == 3)
						{
							$win_rashnu = "TR";
						}
						
						echo '<td class="facility_cell form_item_text" style="text-align: center;">';
							echo '<span class="icon icon_'.$AlertStats['ResultAlertType'].'_'.$win_rashnu.'"></span>';
							echo '<br />';
							echo '<b>Rashnu</b>';
							echo '<br />';
							echo '(Indar)';
						echo '</td>';
					}
					
					if (($AlertStats['ResultAlertCont'] == "Amerish") || ($AlertStats['ResultAlertCont'] == "Cross"))
					{
						if ($facility_last_result["Ikanam"] == 1)
						{
							$win_ikanam = "VS";
						}
						else if ($facility_last_result["Ikanam"] == 2)
						{
							$win_ikanam = "NC";
						}
						else if ($facility_last_result["Ikanam"] == 3)
						{
							$win_ikanam = "TR";
						}
						echo '<td class="facility_cell form_item_text" style="text-align: center;">';
							echo '<span class="icon icon_'.$AlertStats['ResultAlertType'].'_'.$win_ikanam.'"></span>';
							echo '<br />';
							echo '<b>Ikanam</b>';
							echo '<br />';
							echo '(Amerish)';
						echo '</td>';
						
						if ($facility_last_result["Onatha"] == 1)
						{
							$win_onatha = "VS";
						}
						else if ($facility_last_result["Onatha"] == 2)
						{
							$win_onatha = "NC";
						}
						else if ($facility_last_result["Onatha"] == 3)
						{
							$win_onatha = "TR";
						}
						
						echo '<td class="facility_cell form_item_text" style="text-align: center;">';
							echo '<span class="icon icon_'.$AlertStats['ResultAlertType'].'_'.$win_onatha.'"></span>';
							echo '<br />';
							echo '<b>Onatha</b>';
							echo '<br />';
							echo '(Amerish)';
						echo '</td>';
						
						if ($facility_last_result["Xelas"] == 1)
						{
							$win_xelas = "VS";
						}
						else if ($facility_last_result["Xelas"] == 2)
						{
							$win_xelas = "NC";
						}
						else if ($facility_last_result["Xelas"] == 3)
						{
							$win_xelas = "TR";
						}
						
						echo '<td class="facility_cell form_item_text" style="text-align: center;">';
							echo '<span class="icon icon_'.$AlertStats['ResultAlertType'].'_'.$win_xelas.'"></span>';
							echo '<br />';
							echo '<b>Xelas</b>';
							echo '<br />';
							echo '(Amerish)';
						echo '</td>';
					}
					
					if (($AlertStats['ResultAlertCont'] == "Esamir") || ($AlertStats['ResultAlertCont'] == "Cross"))
					{
						
						if ($facility_last_result["Andvari"] == 1)
						{
							$win_andvari = "VS";
						}
						else if ($facility_last_result["Andvari"] == 2)
						{
							$win_andvari = "NC";
						}
						else if ($facility_last_result["Andvari"] == 3)
						{
							$win_andvari = "TR";
						}
						
						echo '<td class="facility_cell form_item_text" style="text-align: center;">';
							echo '<span class="icon icon_'.$AlertStats['ResultAlertType'].'_'.$win_andvari.'"></span>';
							echo '<br />';
							echo '<b>Andvari</b>';
							echo '<br />';
							echo '(Esamir)';
						echo '</td>';
						
						if ($facility_last_result["Mani"] == 1)
						{
							$win_mani = "VS";
						}
						else if ($facility_last_result["Mani"] == 2)
						{
							$win_mani = "NC";
						}
						else if ($facility_last_result["Mani"] == 3)
						{
							$win_mani = "TR";
						}
						
						echo '<td class="facility_cell form_item_text" style="text-align: center;">';
							echo '<span class="icon icon_'.$AlertStats['ResultAlertType'].'_'.$win_mani.'"></span>';
							echo '<br />';
							echo '<b>Mani</b>';
							echo '<br />';
							echo '(Esamir)';
						echo '</td>';
						
						if ($facility_last_result["Ymir"] == 1)
						{
							$win_ymir = "VS";
						}
						else if ($facility_last_result["Ymir"] == 2)
						{
							$win_ymir = "NC";
						}
						else if ($facility_last_result["Ymir"] == 3)
						{
							$win_ymir = "TR";
						}
						
						echo '<td class="facility_cell form_item_text" style="text-align: center;">';
							echo '<span class="icon icon_'.$AlertStats['ResultAlertType'].'_'.$win_ymir.'"></span>';
							echo '<br />';
							echo '<b>Ymir</b>';
							echo '<br />';
							echo '(Esamir)';
						echo '</td>';
					}
					
				} 
				else if ($AlertStats['ResultAlertType'] == "Tech") 
				{
					
					if (($AlertStats['ResultAlertCont'] == "Indar") || ($AlertStats['ResultAlertCont'] == "Cross"))
					{
						if ($facility_last_result["Hvar"] == 1)
						{
							$win_hvar = "VS";
						}
						else if ($facility_last_result["Hvar"] == 2)
						{
							$win_hvar = "NC";
						}
						else if ($facility_last_result["Hvar"] == 3)
						{
							$win_hvar = "TR";
						}
							
						echo '<td class="facility_cell form_item_text" style="text-align: center;">';
							echo '<span class="icon icon_'.$AlertStats['ResultAlertType'].'_'.$win_hvar.'"></span>';
							echo '<br />';
							echo '<b>Hvar</b>';
							echo '<br />';
							echo '(Indar)';
						echo '</td>';
						
						if ($facility_last_result["Mao"] == 1)
						{
							$win_mao = "VS";
						}
						else if ($facility_last_result["Mao"] == 2)
						{
							$win_mao = "NC";
						}
						else if ($facility_last_result["Mao"] == 3)
						{
							$win_mao = "TR";
						}
						
						echo '<td class="facility_cell form_item_text" style="text-align: center;">';
							echo '<span class="icon icon_'.$AlertStats['ResultAlertType'].'_'.$win_mao.'"></span>';
							echo '<br />';
							echo '<b>Mao</b>';
							echo '<br />';
							echo '(Indar)';
						echo '</td>';
						
						if ($facility_last_result["Tawrich"] == 1)
						{
							$win_tarwich = "VS";
						}
						else if ($facility_last_result["Tawrich"] == 2)
						{
							$win_tarwich = "NC";
						}
						else if ($facility_last_result["Tawrich"] == 3)
						{
							$win_tarwich = "TR";
						}
						
						echo '<td class="facility_cell form_item_text" style="text-align: center;">';
							echo '<span class="icon icon_'.$AlertStats['ResultAlertType'].'_'.$win_tarwich.'"></span>';
							echo '<br />';
							echo '<b>Tawrich</b>';
							echo '<br />';
							echo '(Indar)';
						echo '</td>';
					}
					
					if (($AlertStats['ResultAlertCont'] == "Amerish") || ($AlertStats['ResultAlertCont'] == "Cross"))
					{
						if ($facility_last_result["Heyoka"] == 1)
						{
							$win_heyoka = "VS";
						}
						else if ($facility_last_result["Heyoka"] == 2)
						{
							$win_heyoka = "NC";
						}
						else if ($facility_last_result["Heyoka"] == 3)
						{
							$win_heyoka = "TR";
						}
						echo '<td class="facility_cell form_item_text" style="text-align: center;">';
							echo '<span class="icon icon_'.$AlertStats['ResultAlertType'].'_'.$win_heyoka.'"></span>';
							echo '<br />';
							echo '<b>Heyoka</b>';
							echo '<br />';
							echo '(Amerish)';
						echo '</td>';
						
						if ($facility_last_result["Mekala"] == 1)
						{
							$win_mekala = "VS";
						}
						else if ($facility_last_result["Mekala"] == 2)
						{
							$win_mekala = "NC";
						}
						else if ($facility_last_result["Mekala"] == 3)
						{
							$win_mekala = "TR";
						}
						
						echo '<td class="facility_cell form_item_text" style="text-align: center;">';
							echo '<span class="icon icon_'.$AlertStats['ResultAlertType'].'_'.$win_mekala.'"></span>';
							echo '<br />';
							echo '<b>Mekala</b>';
							echo '<br />';
							echo '(Amerish)';
						echo '</td>';
						
						if ($facility_last_result["Tumas"] == 1)
						{
							$win_tumas = "VS";
						}
						else if ($facility_last_result["Tumas"] == 2)
						{
							$win_tumas = "NC";
						}
						else if ($facility_last_result["Tumas"] == 3)
						{
							$win_tumas = "TR";
						}
						
						echo '<td class="facility_cell form_item_text" style="text-align: center;">';
							echo '<span class="icon icon_'.$AlertStats['ResultAlertType'].'_'.$win_tumas.'"></span>';
							echo '<br />';
							echo '<b>Tumas</b>';
							echo '<br />';
							echo '(Amerish)';
						echo '</td>';
					}
					
					if (($AlertStats['ResultAlertCont'] == "Esamir") || ($AlertStats['ResultAlertCont'] == "Cross"))
					{
						
						if ($facility_last_result["Eisa"] == 1)
						{
							$win_eisa = "VS";
						}
						else if ($facility_last_result["Eisa"] == 2)
						{
							$win_eisa = "NC";
						}
						else if ($facility_last_result["Eisa"] == 3)
						{
							$win_eisa = "TR";
						}
						
						echo '<td class="facility_cell form_item_text" style="text-align: center;">';
							echo '<span class="icon icon_'.$AlertStats['ResultAlertType'].'_'.$win_eisa.'"></span>';
							echo '<br />';
							echo '<b>Eisa</b>';
							echo '<br />';
							echo '(Esamir)';
						echo '</td>';
					}
				} 
		
			echo '</tr>';		
		echo '</table>';
		?>