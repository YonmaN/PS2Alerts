<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include("includes/mysqlconnect.php"); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Processing...</title>
</head>


<body>
<?php 

$ResultServer = 10; //Currently always set to Miller
$ResultDateTime = $_POST["ResultDateTime"];
$ResultNCWin = $_POST["ResultNCWin"];
$ResultTRWin = $_POST["ResultTRWin"];
$ResultVSWin = $_POST["ResultVSWin"];
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

$submit = mysql_query ("INSERT INTO results2 (ResultDateTime, ResultServer, ResultNC, ResultTR, ResultVS, ResultAlertCont, ResultAlertType, ResultDomination, ResultDominationDuration, ResultPopsNC, ResultPopsTR, ResultPopsVS, ResultTerritoryNC, ResultTerritoryTR, ResultTerritoryVS, ResultFacilitiesWon, ResultContestedFacility) VALUES ('".$ResultDateTime."', '".$ResultServer."', '".$ResultNCWin."', '".$ResultTRWin."', '".$ResultVSWin."', '".$ResultAlertCont."', '".$ResultAlertType."', '".$ResultDomination."', '".$ResultDominationDuration."', '".$ResultPopsNC."', '".$ResultPopsTR."', '".$ResultPopsVS."', '".$ResultTerritoryNC."', '".$ResultTerritoryTR."', '".$ResultTerritoryVS."', '".$ResultFacilitiesWon."', '".$ResultContestedFacility."')");

if (!$submit) {
	die('ERROR!: ' . mysql_error());
} else {
	header("Location: thanks.php"); /* Redirect browser */
	echo 'SUBMISSION SUCCESSFUL';
	exit();
}

$Result = mysql_query ("SELECT * FROM results ORDER BY ResultID DESC LIMIT 1");

while ($check = mysql_fetch_array($Result)) {
	echo $check['ResultID'];
}
?>
</body>
</html>


