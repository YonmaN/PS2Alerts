<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include("includes/includes.php")?>
<link href="css/sitewide.css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Planetside 2 Statistics Index</title>

<script type="text/javascript">
animatedcollapse.addDiv('info', 'fade=1,height=360px,persist=1')

animatedcollapse.ontoggle=function($, divobj, state){ //fires each time a DIV is expanded/contracted
	//$: Access to jQuery
	//divobj: DOM reference to DIV being expanded/ collapsed. Use "divobj.id" to get its ID
	//state: "block" or "none", depending on state
}

animatedcollapse.init()

</script>

<style>
.form_item_text {
	font-size: 12px;
	text-align: center;
}

.table_border {
	border-right-style: dotted;
	border-right-color: #620002;
	border-right-width: 2px;
}

.table_bottom {
	height: 75px;
	border-bottom-style: dotted;
	border-bottom-color: #620002;
	border-bottom-width: 2px;
}

table#facility_bar {
	width: 490px;
}

table#facility_bar td {
	width: 50px;
}
</style>
</head>

<body>
<div id="wrapper">
<?php 
$subheader = 1;
include('includes/header.php') ?>

	<div class="content" id="allalerts" style="width: 1100px;">

<table id="alerts" width="1100" border="0" cellspacing="3">
	<tr>
		<td class="table_headers table_border" width="140">Result End</td>
		<td width="117" class="table_headers table_border">Server</td>
		<td width="98" class="table_headers table_border">Winner</td>
		<td width="91" class="table_headers table_border">Type</td>
		<td width="121" class="table_headers table_border">Continent</td>
		<td width="486" class="table_headers">End Result</td>
	</tr>

	<?php
	
	$all_alerts_query = mysql_query ("SELECT * FROM results2 ORDER BY ResultDateTime DESC");
	
	while($AlertStats = mysql_fetch_array($all_alerts_query) )
	{
			
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
				
		if ($AlertStats['ResultNC'] == 'WIN') 
		{
			$ResultVictor = "NC";
		} else if ($AlertStats['ResultTR'] == 'WIN')
		{
			$ResultVictor = "TR";
		} else if ($AlertStats['ResultVS'] == 'WIN')
		{
			$ResultVictor = "VS";
		} else if ($AlertStats['ResultDraw'] == 1) 
		{
			$ResultVictor = "Draw";
		} else {
			$ResultVictor = "ERROR";
		}
		
		if ($AlertStats['ResultAlertCont'] == "Cross") 
		{
			$ResultContinent = "Cross Continent";
		} 
		else 
		{
			$ResultContinent = $AlertStats['ResultAlertCont'];
		}		
		
		if ($AlertStats["ResultAlertType"] == "Amp")
		{
			$type = "amp";
		}
		else if ($AlertStats["ResultAlertType"] == "Bio")
		{
			$type = "bio";
		}
		else if ($AlertStats["ResultAlertType"] == "Tech")
		{
			$type = "tech";
		}
		else
		{
			$type = "UNKNOWN";
		}
					
		echo '<tr>';
			echo '<td class="table_item_text table_border table_bottom">';
			$row_formatted = strtotime($AlertStats["ResultDateTime"]);
				
				if ($AlertStats['ResultID'] > 157) {
					
				echo '<a class="form_item_title" href="alertdetail.php?AlertID='.$AlertStats['ResultID'].'">';
				
				}
					echo '<p class="table_item_text" style="color: #F00;">';
					echo date('d', $row_formatted) . "-";
					echo date('m', $row_formatted) . "-";
					echo date('y', $row_formatted) . " ";
					
					echo date('H', $row_formatted) . ":";
					echo date('i', $row_formatted) ;
					
					
					echo '</p>';
				echo '</a>';
				
			echo '</td>';
			
			echo '<td class="table_item_text table_border table_bottom">';
				echo $ResultServer;
			echo '</td>';
			
			echo '<td class="table_item_text table_border table_bottom">';
				echo $ResultVictor;
			echo '</td>';
			
			echo '<td class="table_item_text table_border table_bottom">';
				echo $AlertStats["ResultAlertType"];
			echo '</td>';
			
			echo '<td class="table_item_text table_border table_bottom">';
				echo $ResultContinent;
			echo '</td>';
			
			echo '<td class="table_item_text table_bottom">';
				if ($AlertStats["ResultAlertType"] == "Territory") 
				{
					
					if (($AlertStats["ResultTerritoryNC"] == "0") || ($AlertStats["ResultTerritoryNC"] == 'NULL')) // If new style
					{
						$AlertStatsTerritory_query = mysql_query ("SELECT ResultID, TerritoryVS, TerritoryNC, TerritoryTR FROM results_territory 
						WHERE ResultID = ".$AlertStats['ResultID']." ORDER BY dataTimestamp DESC LIMIT 1");
						$AlertStatsTerritory = mysql_fetch_array($AlertStatsTerritory_query);
					}	
					
					if (mysql_num_rows($AlertStatsTerritory_query) == 0) //If no data is found (new style) 
					{
						echo '<p class="warning_headers" style="font-size: 32px;">Territory Data Not Available!</p>';
					}
					else if (mysql_num_rows($AlertStatsTerritory_query) >= 1) 
					{
						echo '<div id="territory_bar_new_'.$AlertStats["ResultID"].'" style="width: 490px; height: 75px">';
						include("includes/territory_bar_new.php");
					}
					
					else // Must be old style!
					{
						echo '<div id="territory_bar_'.$AlertStats["ResultID"].'" style="width: 490px; height: 75px">';
						include("includes/territory_bar.php");
					}
				}
				else if ($AlertStats["ResultAlertType"] != "Territory")
				{
					include("includes/facility_bar.php");
				}
			echo '</td>';
			
		echo '</tr>';
	}
	?>
	</table>
	<p class="form_item_text" style="text-align: center;">End of results list</p>
	</div>

</div>
</body>
</html>