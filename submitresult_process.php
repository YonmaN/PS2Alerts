<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include("includes/includes.php")?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Processing...</title>
</head>

<body>
<?php 

$gmtimenow = time() - (int)substr(date('H-i'),0,3)*60*60; 

// Query for last alert time
$alert_last_query = mysql_query("SELECT * FROM results2 ORDER BY ResultDateTime DESC LIMIT 1");
$alert_last_time_result = mysql_fetch_array($alert_last_query);

$alert_last_time_formatted = strtotime($alert_last_time_result['ResultDateTime'])+7200; // Last Alert, plus 2 hours in seconds

if ($gmttimenow < $alert_last_time_formatted) {
	echo 'TIME!!!';
}

echo 'GMT: Formatted:';
echo $gmtimenow;
echo '<br /> Data Formatted:';
echo $alert_last_time_formatted;
echo '<br /> Data Cell:';
echo $alert_last_time_result['ResultDateTime'];

$ResultServer = 10; //Currently always set to Miller
$ResultDateTime = $_POST["ResultDateTime"];
$ResultNCWin = $_POST["ResultNCWin"];
$ResultTRWin = $_POST["ResultTRWin"];
$ResultVSWin = $_POST["ResultVSWin"];
$ResultDraw = $_POST["ResultDraw"];
$ResultDomination =  $_POST["ResultDomination"];
$ResultDominationDuration = $_POST["ResultDominationDuration"];
$ResultAlertCont = $_POST["ResultAlertCont"];
$ResultAlertType = $_POST["ResultAlertType"];
$ResultFacilitiesWon = $_POST["ResultFacilitiesWon"];
$ResultPopsNC = $_POST["ResultPopsNC"];
$ResultPopsTR = $_POST["ResultPopsTR"];
$ResultPopsVS = $_POST["ResultPopsVS"];
$ResultTerritoryNC = $_POST["ResultTerritoryNC"];
$ResultTerritoryTR = $_POST["ResultTerritoryTR"];
$ResultTerritoryVS = $_POST["ResultTerritoryVS"];
$ResultContestedFacility = $_POST["ResultContestedFacility"];

// FIX for disabled text field

if ($ResultTerritoryNC == '') 
{
	$ResultTerritoryNC = 75;
}
else if ($ResultTerritoryTR == '')
{
	$ResultTerritoryTR = 75;
}
else if ($ResultTerritoryVS == '')
{
	$ResultTerritoryVS = 75;
}

	echo 'DEBUGGING </br>';
	echo "<pre>";
	var_dump($_POST);
	echo "</pre>";

//SUBMIT DA DATA!

$submit = mysql_query ("INSERT INTO results2 (ResultDateTime, ResultServer, ResultNC, ResultTR, ResultVS, ResultDraw, ResultAlertCont, ResultAlertType, ResultDomination, ResultDominationDuration, ResultPopsNC, ResultPopsTR, ResultPopsVS, ResultTerritoryNC, ResultTerritoryTR, ResultTerritoryVS, ResultFacilitiesWon, ResultContestedFacility) VALUES ('".$ResultDateTime."', '".$ResultServer."', '".$ResultNCWin."', '".$ResultTRWin."', '".$ResultVSWin."', '".$ResultDraw."', '".$ResultAlertCont."', '".$ResultAlertType."', '".$ResultDomination."', '".$ResultDominationDuration."', '".$ResultPopsNC."', '".$ResultPopsTR."', '".$ResultPopsVS."', '".$ResultTerritoryNC."', '".$ResultTerritoryTR."', '".$ResultTerritoryVS."', '".$ResultFacilitiesWon."', '".$ResultContestedFacility."')");

if (!$submit) {
	die('ERROR!: ' . mysql_error());
} else {
	header("Location: thanks.php"); /* Redirect browser */
	exit();
}

$Result = mysql_query ("SELECT * FROM results ORDER BY ResultID DESC LIMIT 1");

while ($check = mysql_fetch_array($Result)) {
	echo $check['ResultID'];
}
?>
</body>
</html>


