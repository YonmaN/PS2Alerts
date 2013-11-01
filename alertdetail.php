<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include("includes/includes.php")?>
<title>Alert Stats</title>
</head>

<body>
<?php

$AlertID = $_REQUEST["AlertID"];

$AlertStats_query = mysql_query("SELECT * FROM results2 WHERE ResultID = $AlertID ");
$AlertStats = mysql_fetch_array($AlertStats_query);

if ($AlertStats["ResultID"] != $AlertID) // Check if alert exists
{
	header("Location: thanks.php?Message=3"); //Send them to error page if not
}

if ($AlertStats['ResultNC'] == 'WIN') 
{
	$ResultVictor = "New Conglomerate";
} else if ($AlertStats['ResultTR'] == 'WIN')
{
	$ResultVictor = "Terran Republic";
} else if ($AlertStats['ResultVS'] == 'WIN')
{
	$ResultVictor = "Vanu Soverignity";
} else if ($AlertStats['ResultDraw'] == 1) 
{
	$ResultVictor = "Draw";
} else {
	$ResultVictor = "ERROR";
}

if ($AlertStats['ResultAlertCont'] == "Cross") 
{
	$ResultContinent = "Cross Continent (Global)";
} 
else 
{
	$ResultContinent = $AlertStats['ResultAlertCont'];
}

// Cookie settings

if ($SelfPost == "true") 
{
	setcookie("votedAlertID", "".$AlertStats['AlertID']."", time()+31536000);
}
?>
<div id="wrapper">
	<?php include('includes/header.php') ?>
	<div id="float" style="margin-left: auto; margin-right: auto; width: 1050px;">
		<div class="stats_left" id="content_left_container">
			<div class="content stats_left" id="general_stats">
				<p class="form_headers">Alert Details</p>
				<p class="form_item_text">Alert Type: <span class="stats_highlight"><?php echo $AlertStats['ResultAlertType']?></span></p>
				<p class="form_item_text">Continent: <span class="stats_highlight"><?php echo $ResultContinent ?></span></p>
				<p class="form_item_text">Victor: <span class="stats_highlight"><?php echo $ResultVictor ?></span></p>
				<p class="form_item_text">Submitted: <span class="stats_highlight"><?php echo $AlertStats['ResultDateTime']?></span></p>
			</div>
			<div class="content stats_left" id="Facility_Vote">
				<p class="form_headers">Facility Voting</p>
				<p class="form_item_text" style="text-align: center;">Which facility was the most contested?</p>
				<div id="facility_graph" style="width:320px; height: 320px;">
				</div>
				<div id="facility_votes" style="width: 320px; height: 30px; background-color:#840003;">
					<?php
	
				//Change Query based on Alert Type
				
				$ResultAlertType = $AlertStats['ResultAlertType'];
				$ResultAlertCont = $AlertStats['ResultAlertCont'];
				
				if ($ResultAlertType == "Territory") 
				{
					$SelectQuery = mysql_query("SELECT * FROM facilities WHERE FacilityContID ='".$ResultAlertCont."' ORDER BY FacilityType");
				} 
				else if ($ResultAlertCont == "Amerish" or $ResultAlertCont == "Esamir" or $ResultAlertCont == "Indar") 
				{			
					$SelectQuery = mysql_query("SELECT * FROM facilities WHERE FacilityType ='".$ResultAlertType."' AND FacilityContID ='".$ResultAlertCont."' ORDER BY FacilityContID ");
				} 
				else if ($AlertStats['ResultAlertCont'] == "Cross") // Referenced literally here because of Cross / Global variable change
				{
					$SelectQuery = mysql_query("SELECT * FROM facilities WHERE FacilityType ='".$ResultAlertType."' ORDER BY FacilityContID");
				} 
				echo '<form name="facilities">';
					echo '<select name="ResultContestedFacility">';
						while($facility_result = mysql_fetch_array($SelectQuery))
						{
							echo '<option value="'.$facility_result['FacilityID'].'">'.$facility_result['FacilityContID'].' - '.$facility_result['FacilityName'].'</option>';
						}
					echo '</select>';
					echo '<input type="button" value="Vote!"</input>';
				echo '</form>';
				?>
				</div>
			</div>
		</div>
		<div class="stats_right" id="content_right">
			<div class="content stats_right" id="populations">
				<p class="form_headers">Populations Chart</p>
				<div id="facility_graph" style="width: 640px; height: 200px; margin-bottom: 10px; background-color:#900;">
					<br />
					<br />
					<br />
					<p class="form_headers">Alert populations through duration of alert (Area line graph)</p>
				</div>
			</div>
			<?php 
			if ($AlertStats['ResultAlertType'] == "Territory")
				{
					echo '<div class="content stats_right" id="territory">';
				}
				else 
				{
					echo '<div style="display:none" id="territory">';
				}
			?>
			<p class="form_headers">Territory Percentages</p>
			<p class="form_item_text" style="text-align: center; font-size: 12px;">Due to server calculations, territories may not always add up to 100%.</p>
			<div id="territory_percentages" style="width: 630px; height: 300px;"></div>
			
			<?php 
			
			$territory_query = mysql_query ("SELECT * FROM results_territory WHERE ResultID = $AlertID");
			
			
			//if ($territory_result["ResultID"] == $AlertID)
			//{
				$territory_data_VS = array();
				$territory_data_NC = array();
				$territory_data_TR = array();
				$territory_data_dates = array();
				
				while ($row = mysql_fetch_array($territory_query))
				{
					array_push($territory_data_VS, $row["TerritoryVS"]);
					array_push($territory_data_NC, $row["TerritoryNC"]);
					array_push($territory_data_TR, $row["TerritoryTR"]);
					array_push($territory_data_dates, gmdate("H:i", $row['dataTimestamp']));
				}
				/*echo '<pre class="form_item_text">';
				print_r(array_values($territory_data_dates));
				print_r(array_values($territory_data_VS));
				print_r(array_values($territory_data_NC));
				print_r(array_values($territory_data_TR));
				echo '</pre>';*/
				
			//}
				$territory_old_query = mysql_query ("SELECT ResultID, ResultTerritoryNC, ResultTerritoryTR, ResultTerritoryVS FROM results2 WHERE ResultID = $AlertID ");
				$territory_old_result = mysql_fetch_array ($territory_old_query);
				
				$territoryNC = $territory_old_result["ResultTerritoryNC"];
				$territoryTR = $territory_old_result["ResultTerritoryTR"];
				$territoryVS = $territory_old_result["ResultTerritoryVS"];
				
			?>
			
			<script>
			$(function () {
        $('#territory_percentages').highcharts({
            chart: {
                type: 'area',
				backgroundColor: ''
            },
            title: {
                text: ''
            },
			credits:{enabled: false},
			exporting:{enabled: false},
            xAxis: {
                categories: [<?php foreach ($territory_data_dates as $key) {echo "'".$key."', ";}?>],
                tickmarkPlacement: 'on',
				tickInterval: 2,
                title: {
                    enabled: false
                }
            },
            yAxis: {
                title: {
                    text: ''
                },
                labels: {
                    formatter: function() {
                        return this.value;
                    }
                }
            },
			legend: {
				enabled: false
			},
            tooltip: {
                shared: true,
				crosshairs:[{width:1,color:'white',zIndex:22}],
                pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.percentage:.1f}%</b><br/>',
            },
            plotOptions: {
                area: {
                    stacking: 'percent',
                    lineColor: '#ffffff',
                    lineWidth: 1,
					fillOpacity: 0.85,
                    marker: {
                        lineWidth: 1,
                        lineColor: '#CCCCCC'
                    }
                }
            },
            series: [{
                name: 'Vanu Soverignity',
                data: [<?php foreach ($territory_data_VS as $key) {echo "".$key.", ";}?>],
				color: '#7309AA'
            }, {
                name: 'New Conglomerate',
                data: [<?php foreach ($territory_data_NC as $key) {echo "".$key.", ";}?>],
				color: '#080B74'
			}, {
                name: 'Terran Republic',
                data: [<?php foreach ($territory_data_TR as $key) {echo "".$key.", ";}?>],
				color: '#910000'
            }]
        });
    });
    </script>
		</div>
		<?php 
			if ($AlertStats['ResultAlertType'] != "Territory")
				{
					echo '<div class="content stats_right" id="facilities">';
					
					if ($AlertStats['ResultAlertType'] == "Amp") 
					{					
						$facility_query = mysql_query("SELECT * FROM results_amp WHERE resultID = $AlertID ");
					} 
					else if ($AlertStats['ResultAlertType'] == "Bio")
					{
						$facility_query = mysql_query("SELECT * FROM results_bio WHERE resultID = $AlertID ");
					} 
					else if ($AlertStats['ResultAlertType'] == "Tech")
					{
						$facility_query = mysql_query("SELECT * FROM results_tech WHERE resultID = $AlertID ");
					}

				}
				else 
				{
					echo '<div style="display:none" id="facilities">';
				}
				
					$facility_result = mysql_fetch_array($facility_query);
			?>
		<p class="form_headers">Facilities</p>
		
			<div id="facility_graph" style="width: 640px; height: 200px; margin-bottom: 10px; background-color:#900;">
				<br />
<br />
<br />
<p class="form_headers">Facility captures over alert period<br />
placeholder (Area Line Graph)</p>
			</div>
		
		<table width="630" border="0">
				<?php 
				
				if ($AlertStats['ResultAlertType'] == "Amp") 
				{
					
					if (($AlertStats['ResultAlertCont'] == "Indar") || ($AlertStats['ResultAlertCont'] == "Cross"))
					{
						if ($facility_result["Peris"] == 1)
						{
							$win_peris = "VS";
						}
						else if ($facility_result["Peris"] == 2)
						{
							$win_peris = "NC";
						}
						else if ($facility_result["Peris"] == 3)
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
						
						if ($facility_result["Dahaka"] == 1)
						{
							$win_dahaka = "VS";
						}
						else if ($facility_result["Dahaka"] == 2)
						{
							$win_dahaka = "NC";
						}
						else if ($facility_result["Dahaka"] == 3)
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
						
						if ($facility_result["Zurvan"] == 1)
						{
							$win_zurvan = "VS";
						}
						else if ($facility_result["Zurvan"] == 2)
						{
							$win_zurvan = "NC";
						}
						else if ($facility_result["Zurvan"] == 3)
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
						if ($facility_result["Kwahtee"] == 1)
						{
							$win_kwahtee = "VS";
						}
						else if ($facility_result["Kwahtee"] == 2)
						{
							$win_kwahtee = "NC";
						}
						else if ($facility_result["Kwahtee"] == 3)
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
						
						if ($facility_result["Sungrey"] == 1)
						{
							$win_sungrey = "VS";
						}
						else if ($facility_result["Sungrey"] == 2)
						{
							$win_sungrey = "NC";
						}
						else if ($facility_result["Sungrey"] == 3)
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
						
						if ($facility_result["Wokuk"] == 1)
						{
							$win_wokuk = "VS";
						}
						else if ($facility_result["Wokuk"] == 2)
						{
							$win_wokuk = "NC";
						}
						else if ($facility_result["Wokuk"] == 3)
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
						
						if ($facility_result["Elli"] == 1)
						{
							$win_elli = "VS";
						}
						else if ($facility_result["Elli"] == 2)
						{
							$win_elli = "NC";
						}
						else if ($facility_result["Elli"] == 3)
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
						
						if ($facility_result["Freyr"] == 1)
						{
							$win_freyr = "VS";
						}
						else if ($facility_result["Freyr"] == 2)
						{
							$win_freyr = "NC";
						}
						else if ($facility_result["Freyr"] == 3)
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
						
						if ($facility_result["Nott"] == 1)
						{
							$win_nott = "VS";
						}
						else if ($facility_result["Nott"] == 2)
						{
							$win_nott = "NC";
						}
						else if ($facility_result["Nott"] == 3)
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
						if ($facility_result["Allatum"] == 1)
						{
							$win_allatum = "VS";
						}
						else if ($facility_result["Allatum"] == 2)
						{
							$win_allatum = "NC";
						}
						else if ($facility_result["Allatum"] == 3)
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
						
						if ($facility_result["Saurva"] == 1)
						{
							$win_saurva = "VS";
						}
						else if ($facility_result["Saurva"] == 2)
						{
							$win_saurva = "NC";
						}
						else if ($facility_result["Saurva"] == 3)
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
						
						if ($facility_result["Rashnu"] == 1)
						{
							$win_rashnu = "VS";
						}
						else if ($facility_result["Zurvan"] == 2)
						{
							$win_rashnu = "NC";
						}
						else if ($facility_result["Zurvan"] == 3)
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
						if ($facility_result["Ikanam"] == 1)
						{
							$win_ikanam = "VS";
						}
						else if ($facility_result["Ikanam"] == 2)
						{
							$win_ikanam = "NC";
						}
						else if ($facility_result["Ikanam"] == 3)
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
						
						if ($facility_result["Onatha"] == 1)
						{
							$win_onatha = "VS";
						}
						else if ($facility_result["Onatha"] == 2)
						{
							$win_onatha = "NC";
						}
						else if ($facility_result["Onatha"] == 3)
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
						
						if ($facility_result["Xelas"] == 1)
						{
							$win_xelas = "VS";
						}
						else if ($facility_result["Xelas"] == 2)
						{
							$win_xelas = "NC";
						}
						else if ($facility_result["Xelas"] == 3)
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
						
						if ($facility_result["Andvari"] == 1)
						{
							$win_andvari = "VS";
						}
						else if ($facility_result["Andvari"] == 2)
						{
							$win_andvari = "NC";
						}
						else if ($facility_result["Andvari"] == 3)
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
						
						if ($facility_result["Mani"] == 1)
						{
							$win_mani = "VS";
						}
						else if ($facility_result["Mani"] == 2)
						{
							$win_mani = "NC";
						}
						else if ($facility_result["Mani"] == 3)
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
						
						if ($facility_result["Ymir"] == 1)
						{
							$win_ymir = "VS";
						}
						else if ($facility_result["Ymir"] == 2)
						{
							$win_ymir = "NC";
						}
						else if ($facility_result["Ymir"] == 3)
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
						if ($facility_result["Hvar"] == 1)
						{
							$win_hvar = "VS";
						}
						else if ($facility_result["Hvar"] == 2)
						{
							$win_hvar = "NC";
						}
						else if ($facility_result["Hvar"] == 3)
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
						
						if ($facility_result["Mao"] == 1)
						{
							$win_mao = "VS";
						}
						else if ($facility_result["Mao"] == 2)
						{
							$win_mao = "NC";
						}
						else if ($facility_result["Mao"] == 3)
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
						
						if ($facility_result["Tawrich"] == 1)
						{
							$win_tarwich = "VS";
						}
						else if ($facility_result["Tawrich"] == 2)
						{
							$win_tarwich = "NC";
						}
						else if ($facility_result["Tawrich"] == 3)
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
						if ($facility_result["Heyoka"] == 1)
						{
							$win_heyoka = "VS";
						}
						else if ($facility_result["Heyoka"] == 2)
						{
							$win_heyoka = "NC";
						}
						else if ($facility_result["Heyoka"] == 3)
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
						
						if ($facility_result["Mekala"] == 1)
						{
							$win_mekala = "VS";
						}
						else if ($facility_result["Mekala"] == 2)
						{
							$win_mekala = "NC";
						}
						else if ($facility_result["Mekala"] == 3)
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
						
						if ($facility_result["Tumas"] == 1)
						{
							$win_tumas = "VS";
						}
						else if ($facility_result["Tumas"] == 2)
						{
							$win_tumas = "NC";
						}
						else if ($facility_result["Tumas"] == 3)
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
						
						if ($facility_result["Eisa"] == 1)
						{
							$win_eisa = "VS";
						}
						else if ($facility_result["Eisa"] == 2)
						{
							$win_eisa = "NC";
						}
						else if ($facility_result["Eisa"] == 3)
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
				?>
			</tr>
		</table>
	</div>
</div>
</div>
</body>
</html>