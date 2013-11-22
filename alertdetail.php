<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include("includes/includes.php")?>
<?php include("includes/alerttitle.php")?>
</head>

<body>
<?php
$subheader = 1;

$AlertID = $_REQUEST["AlertID"];

$AlertStats_query = mysql_query("SELECT * FROM results2 WHERE ResultID = $AlertID ");
$AlertStats = mysql_fetch_array($AlertStats_query);

$ResultAlertType = $AlertStats['ResultAlertType'];
$ResultAlertCont = $AlertStats['ResultAlertCont'];

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

if ($AlertStats['ResultServer'] == "1")
{
	$ResultServer = "Connery";
} else if ($AlertStats['ResultServer'] == "9")
{
	$ResultServer = "Woodman";
} else if ($AlertStats['ResultServer'] == "9")
{
	$ResultServer = "Woodman";
} else if ($AlertStats['ResultServer'] == "10")
{
	$ResultServer = "Miller";
} else if ($AlertStats['ResultServer'] == "11")
{
	$ResultServer = "Ceres";
} else if ($AlertStats['ResultServer'] == "13")
{
	$ResultServer = "Cobalt";
} else if ($AlertStats['ResultServer'] == "17")
{
	$ResultServer = "Mattherson";
} else if ($AlertStats['ResultServer'] == "18")
{
	$ResultServer = "Waterson";
} else if ($AlertStats['ResultServer'] == "25")
{
	$ResultServer = "Briggs";
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
	//setcookie("votedAlertID", "".$AlertStats['AlertID']."", time()+31536000);
}
?>
<div id="wrapper">
	<?php include('includes/header.php') ?>
	<div id="float" style="margin-left: auto; margin-right: auto; width: 1050px;">
		<div class="stats_left" id="content_left_container">
			<div class="content stats_left" id="general_stats" style="height: 287px;">
				<p class="form_headers">Alert Details</p>
				<p class="form_item_text">Alert Type: <span class="stats_highlight"><?php echo $AlertStats['ResultAlertType']?></span></p>
				<p class="form_item_text">Server: <span class="stats_highlight"><?php echo $ResultServer ?></span></p>
				<p class="form_item_text">Continent: <span class="stats_highlight"><?php echo $ResultContinent ?></span></p>
				<p class="form_item_text">Victor: <span class="stats_highlight"><?php echo $ResultVictor ?></span></p>
				<p class="form_item_text">Ended: <span class="stats_highlight"><?php echo $AlertStats['ResultDateTime']?></span></p>
				<?php if ($AlertStats['ResultDomination'] == "1") {
					echo '<p class="form_item_text">Domination? <span class="stats_highlight">Yes</span></p>';
				} 
				else
				{
					echo '<p class="form_item_text">Domination? <span class="stats_highlight">No</span></p>';
				}
				?>
				
			</div>
			<?php 
			
			$testing = $_REQUEST["testing"];
			
			if(($ResultAlertType != "Territory") && ($AlertID > 157)) {
				echo '<div class="content stats_left" id="Facility_Changes">';
			}
			else {
				echo '<div class="content stats_left" id="Facility_Changes" style="display: none;">';
			}
			?>
				<p class="form_headers">Most Contested Facilities</p>
				<?php include("includes/facility_changes.php"); ?>
			</div>
		</div>
		<div class="stats_right" id="content_right_container">
			<div class="content stats_right" id="populations">
				<p class="form_headers">Final Alert Populations</p>
				<div id="population_end" style="width: 640px; height: 225px; margin-bottom: 10px; background-color:#900; border-radius: 10px;">
					<br />
					<br />
					<br />
					<p class="form_headers">Alert populations history (Line Graph) [SOE'S API CURRENLTY DOWN!]</p>
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
	</div>
		<?php 
		if ($testing == 0) {		
		include("includes/disqus.php"); // Include Comment Section 
		}
		else 
		{ echo '<div class="content" id="comments" style="display:inline-block; margin-top: 0px; width: 1010px;"></div>';
		}?>
	</div>

<?php include("includes/footer.php") ?>
</div>
</body>
</html>