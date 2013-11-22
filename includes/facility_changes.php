<?php // Facility Voting

echo '<div id="facility_votes_graph" style="width:330px; height: 340px;">';

// Results Table selector
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


//$facility_query = mysql_query ("SELECT * FROM facility_votes WHERE alert_id = $AlertID");
//$facility_votes = mysql_fetch_array($facility_query);

$facility_query = mysql_query ("SELECT * FROM results_".$type." WHERE resultID = $AlertID");
$facility_history = mysql_fetch_array($facility_query);

// Add up the arrays for results based on the results

$indar = 0;
$esamir = 0;
$amerish = 0;

$fac1 = 0;
$fac2 = 0;
$fac3 = 0;
$fac4 = 0;
$fac5 = 0;
$fac6 = 0;
$fac7 = 0;
$fac8 = 0;
$fac9 = 0;

// Grab first value from array
$prev_1 = $facility_history[3];
$prev_2 = $facility_history[4];
$prev_3 = $facility_history[5];
$prev_4 = $facility_history[6];
$prev_5 = $facility_history[7];
$prev_6 = $facility_history[8];
$prev_7 = $facility_history[9];
$prev_8 = $facility_history[10];
$prev_9 = $facility_history[11];

// Loop to compare the previous result with the currently selected one. If changed, then add to counter.
while ($history = mysql_fetch_array($facility_query)) 
{
	if ($history[3] != $prev_1) 
	{
		$fac1++;
		$indar++;
	}
	if ($history[4] != $prev_2) 
	{
		$fac2++;
		$indar++;
	}
	if ($history[5] != $prev_3) 
	{
		$fac3++;
		$indar++;
	}
	if ($history[6] != $prev_4) 
	{
		$fac4++;
		$amerish++;
	}
	if ($history[7] != $prev_5) 
	{
		$fac5++;
		$amerish++;
	}
	if ($history[8] != $prev_6) 
	{
		$fac6++;
		$amerish++;
	}
	if ($history[9] != $prev_7) 
	{
		$fac7++;
		$esamir++;
	}
	if ($history[10] != $prev_8) 
	{
		$fac8++;
		$esamir++;
	}
	if ($history[11] != $prev_9) 
	{
		$fac9++;
		$esamir++;
	}

	$prev_1 = $history[3];
	$prev_2 = $history[4];
	$prev_3 = $history[5];
	$prev_4 = $history[6];
	$prev_5 = $history[7];
	$prev_6 = $history[8];
	$prev_7 = $history[9];
	$prev_8 = $history[10];
	$prev_9 = $history[11];
}

$keys = array_keys($facility_history);

include("facility_changes_graph.php");

echo '</div> <!-- end of graph DIV -->';

/*echo $keys[7].': '.$fac1;
echo '<br />';
echo $keys[9].': '.$fac2;
echo '<br />';
echo $keys[11].': '.$fac3;
echo '<br />';
echo $keys[13].': '.$fac4;
echo '<br />';
echo $keys[15].': '.$fac5;
echo '<br />';
echo $keys[17].': '.$fac6;
echo '<br />';
echo $keys[19].': '.$fac7;
echo '<br />';
echo $keys[21].': '.$fac8;
echo '<br />';
echo $keys[23].': '.$fac9;
echo '<br />';

echo 'Indar Totals: '.$indar;
echo '<br />';
echo 'Amerish Totals: '.$amerish;
echo '<br />';
echo 'Esamir Totals: '.$esamir;
echo '<br />';
*/
?>