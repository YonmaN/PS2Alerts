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

if ($AlertStats['ResultNC'] == 2) 
{
	$ResultVictor = "New Conglomerate";
} else if ($AlertStats['ResultTR'] == 2)
{
	$ResultVictor = "Terran Republic";
} else if ($AlertStats['ResultVS'] == 2)
{
	$ResultVictor = "Vanu Soverignity";
} else if ($AlertStats['ResultDraw'] == 1) 
{
	$ResultVictor = "Draw";
} else {
	$ResultVictor = "ERROR";
}

?>
<div id="wrapper">
	<?php include('includes/header.php') ?>
	<div id="float" style="margin-left: auto; margin-right: auto; width: 1050px;">
		<div class="stats_left" id="content_left_container">
			<div class="content stats_left" id="general_stats">
				<p class="form_headers">Alert Details</p>
				<p class="form_item_text">Alert Type: <span class="stats_highlight"><?php echo $AlertStats['ResultAlertType']?></span></p>
				<p class="form_item_text">Continent: <span class="stats_highlight"><?php echo $AlertStats['ResultAlertCont']?></span></p>
				<p class="form_item_text">Victor: <span class="stats_highlight"><?php echo $ResultVictor ?></span></p>
				<p class="form_item_text">Submitted: <span class="stats_highlight"><?php echo $AlertStats['ResultDateTime']?></span></p>
			</div>
			<div class="content stats_left" id="Facility_Vote">
				<p class="form_headers">Facility Voting</p>
				<p class="form_item_text">Bar graph w/ voting</p>
			</div>
		</div>
		<div class="stats_right" id="content_right">
			<div class="content stats_right" id="populations">
				<p class="form_headers">Populations Chart</p>
				<p class="form_item_text">LINE GRAPH</p>
			</div>
			<?php if ($AlertStats['ResultAlertType'] == "Territory")
				{
					echo '<div class="content stats_right" id="territory">';
				}
				else 
				{
					echo '<div style="display:none" id="territory">';
				}
				?>
			<p class="form_headers">Territory Percentages</p>
			<div id="territory_percentages" style="width: 630px; height: 150px;">
			</div>
			
			<script>
			$(function () {
				$('#territory_percentages').highcharts({
					chart: {
						type: 'bar',
						backgroundColor: '',
					},
					credits: {enabled: false},
					title: {
						text: ''
					},
					xAxis: {
						categories: 'Territory'
					},
					yAxis: {
						min: 0,
						max: 100
					},
					legend: {
						backgroundColor: '#FFFFFF',
						reversed: true
					},
					plotOptions: {
						series: {
							stacking: 'normal',
								dataLabels: {
									color: '#FFF',
									enabled: true
								}
						},
					},
						series: [{
						name: 'New Congolomerate',
						color: '#0080FF',
						data: [<?php echo $AlertStats["ResultTerritoryNC"] ?>]
					}, {
						name: 'Terran Republic',
						color: '#DF0101',
						data: [<?php echo $AlertStats["ResultTerritoryTR"] ?>]
					}, {
						name: 'Vanu Soverignity',
						color: '#7309AA',
						data: [<?php echo $AlertStats["ResultTerritoryVS"] ?>]
					}]
				});
			});
			</script>
		</div>
	</div>
</div>
</div>
</body>
</html>