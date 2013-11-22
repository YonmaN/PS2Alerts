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
						include("includes/territory_logic.php");
					}
					else 
					{
						echo '<div style="display:none" id="territory"></div>';
					}
				
				
								
				?>
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
	<?php include("includes/facility_graph.php") ?>
	<?php include("includes/facility_bar.php") ?>
	</div> <!-- End of Right Content DIV -->
</div>
<?php 
		if ($testing == 0) {		
		include("includes/disqus.php"); // Include Comment Section 
		}
		else 
		{ echo '<div class="content" id="comments" style="display:inline-block; margin-top: 0px; width: 1010px;"></div>';
		}?>
<?php include("includes/footer.php") ?>
</div>
</body>
</html>