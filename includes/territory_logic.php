<?php
echo '<p class="form_headers">Territory Percentages</p>';
				
// Determine to use Percentages graph or bar chart
$territory_chart_query = mysql_query("SELECT ResultID FROM results_territory WHERE ResultID = $AlertID") or die ("ERROR! ".mysql_error());
$territory_chart_array = mysql_fetch_array($territory_chart_query);
$territory_chart = mysql_num_rows($territory_chart_array);

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