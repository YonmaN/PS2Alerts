<?php
echo '<div class="content stats_right" id="territory">';
	echo '<p class="form_headers">Territory Percentages</p>';
					
	// Determine to use Percentages graph or bar chart
	$territory_chart_query = mysql_query("SELECT * FROM results_territory WHERE ResultID = $AlertID") or die ("ERROR! ".mysql_error());
	$territory_chart_array = mysql_fetch_array($territory_chart_query);
	
	$error = 0;
	
	if (mysql_num_rows($territory_chart_query) >= 1) // If there's a result
	{
		$territory_result = 1;
	}
	else if (mysql_num_rows($territory_chart_query) == 0) // If no result (Old style no longer exists, as AlertDetail is not available!)
	{
		$territory_result = 0;
		echo '<p class="warning_headers">No Territory Data Available!</p>';
	}
			
	if ($territory_result == 1)
	{
		
		echo '<div id="territory_percentages" style="width: 630px; height: 300px;"></div>';	
		
		$territory_data_VS = array();
		$territory_data_NC = array();
		$territory_data_TR = array();
		$territory_data_dates = array();
		
		while ($row = mysql_fetch_array($territory_chart_query))
		{
			array_push($territory_data_VS, $row["TerritoryVS"]);
			array_push($territory_data_NC, $row["TerritoryNC"]);
			array_push($territory_data_TR, $row["TerritoryTR"]);
			array_push($territory_data_dates, gmdate("H:i", $row['dataTimestamp']));
		}
		include ("includes/territory_percentages.php"); // Include code for Territory Chart
	}
