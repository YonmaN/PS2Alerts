<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include("includes/includes.php")?>
<?php include("includes/alerttitle.php")?>
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
				<p class="form_item_text">Ended: <span class="stats_highlight"><?php echo $AlertStats['ResultDateTime']?></span></p>
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
				<p class="form_headers">Final Alert Populations</p>
				<div id="population_end" style="width: 640px; height: 225px; margin-bottom: 10px; background-color:#900;">
					<br />
					<br />
					<br />
					<p class="form_headers">Alert populations history (Line Graph)</p>
				</div>
			</div>
			<div class="content stats_right" id="populations" style="display: none;">
				<p class="form_headers">Population History Chart</p>
				<div id="population_history" style="width: 640px; height: 200px; margin-bottom: 10px; background-color:#900;">
					<br />
					<br />
					<br />
					<p class="form_headers">Alert populations history (Line Graph)</p>
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
				
				echo '<p class="form_headers">Territory Percentages</p>';
				
				// Determine to use Percentages graph or bar chart
				$territory_chart_query = mysql_query("SELECT ResultID FROM results_territory WHERE ResultID = $AlertID") or die ("ERROR! ".mysql_error());
				$territory_chart_array = mysql_fetch_array($territory_chart_query);
				$territory_chart = mysql_num_rows($territory_chart_array);
				
				echo 'CHART RESULT: '.$territory_chart;
				
				if ($territory_chart >= 1)
				{
					echo '<div id="territory_bar" style="width: 630px; height: 150px;"></div>';
					$territory_result = 0;
				}
				else 
				{
					echo '<div id="territory_percentages" style="width: 630px; height: 300px;"></div>';
					$territory_result = 1;
				}
				
					echo '</div>';

				if ($territory_result == 1)
				{
					$territory_query = mysql_query ("SELECT * FROM results_territory WHERE ResultID = $AlertID");
					
					/*echo '<pre class="form_item_text">';
					print_r(array_values($territory_data_dates));
					print_r(array_values($territory_data_VS));
					print_r(array_values($territory_data_NC));
					print_r(array_values($territory_data_TR));
					echo '</pre>';*/
					
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
					include ("includes/territory_percentages.php"); // Include code for Territory Chart
				}
				else if ($territory_result == 0)
				{
					
					$territory_old_query = mysql_query ("SELECT ResultID, ResultTerritoryNC, ResultTerritoryTR, ResultTerritoryVS FROM results2 WHERE ResultID = $AlertID ");
					$territory_old_result = mysql_fetch_array ($territory_old_query);
					
					$territoryNC = $territory_old_result["ResultTerritoryNC"];
					$territoryTR = $territory_old_result["ResultTerritoryTR"];
					$territoryVS = $territory_old_result["ResultTerritoryVS"];
					
					echo '<br />'. $territoryNC;
					echo '<br />'. $territoryTR;
					echo '<br />'. $territoryVS;
					
					include ("includes/territory_bar.php"); // Include code for territory chart
				}
								
				?>
			</script>
		</div>
		<?php if ($AlertStats["ResultAlertType"] != "Territory") // Hide facilities DIV if not relevent
			{
				echo '<div class="content stats_right" id="facility_history_graph">';
			}
			else
			{
				echo '<div class="content stats_right" style="display: none;">';
			}
			?>
			<p class="form_headers">Facility History</p>
			<div id="facility_history" style="width: 640px; height: 300px;">
			</div>
			<?php include("includes/facility_graph_logic.php") ?>
			<script>
					$(function () {
					$('#facility_history').highcharts({
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
						categories: [<?php foreach ($facility_data_dates as $key) {echo "'".$key."', ";}?>],
						tickmarkPlacement: 'on',
						tickInterval: 2,
						title: {
							enabled: false
						}
					},
					yAxis:{title:{text:''},max:<?php echo $max;?>,tickInterval:1},
					legend: {
						enabled: false
					},
					tooltip: {
						shared: true,
						crosshairs:[{width:1,color:'white',zIndex:22}],
						pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b><br/>',
					},
					plotOptions: {
						area: {
							stacking: 'normal',
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
						data: [<?php foreach ($facility_data_VS as $key) {echo "".$key.", ";}?>],
						color: '#7309AA'
					}, {
						name: 'New Conglomerate',
						data: [<?php foreach ($facility_data_NC as $key) {echo "".$key.", ";}?>],
						color: '#080B74'
					}, {
						name: 'Terran Republic',
						data: [<?php foreach ($facility_data_TR as $key) {echo "".$key.", ";}?>],
						color: '#910000'
					}]
				});
			});
			</script>
			<?php include("includes/facility_bar.php") ?>
		</div>
		<?php include("includes/disqus.php") // Include Comment Section ?>
</div>
</body>
</html>