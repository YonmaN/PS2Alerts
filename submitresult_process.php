<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include("includes/includes.php")?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Processing...</title>
</head>

<body>
<?php 

$ResultServer = $_POST["ResultServer"];
$ResultDateTimePre = $_POST["ResultDateTime"];
$ResultDraw = $_POST["ResultDraw"];
$ResultDomination =  $_POST["ResultDomination"];
$ResultDominationDuration = $_POST["ResultDominationDuration"];
$ResultDominationDurationPre = $_POST["ResultDominationDuration"];
$ResultAlertCont = $_POST["ResultAlertCont"];
$ResultAlertType = $_POST["ResultAlertType"];
$ResultPopsNC = $_POST["ResultPopsNC"];
$ResultPopsTR = $_POST["ResultPopsTR"];
$ResultPopsVS = $_POST["ResultPopsVS"];

$SubmitterIP = $_SERVER['REMOTE_ADDR'];

$ResultAlertMasterType = $ResultAlertType.$ResultAlertCont;

// SUBMISSION PROCESSING

if ($ResultDominationDurationPre == "") { // If no domination timer was chosen, leave NULL
	$ResultDominationDuration = "00:00:00";
} 
else 
{
	$ResultDominationDuration = $ResultDominationDurationPre.':00';
}
	
$ResultDateTime = $ResultDateTimePre.':00';

if (($ResultTerritoryNC == '') && ($ResultTerritoryTR == '') && ($ResultTerritoryVS == '')) 
{
	$ResultTerritoryNC = 0;
	$ResultTerritoryTR = 0;
	$ResultTerritoryVS = 0;
}

if ($ResultFacilitiesWon == '')
{
	$ResultFacilitiesWon = 0;
}

if ($ResultDomination == '')
{
	$ResultDomination = 0;
}


if(isset($_POST['AlertStats']))
{ 
	echo 'FIRST IF SUCCESSFUL';       
	if(isset($_POST['rNC'])) {
		$winNC="2";
	} else {
		$winNC="0";
	}
	if (isset($_POST['rTR'])) {
	    $winTR="2";
	} else {
		$winTR="0";
	}
	if (isset($_POST['rVS'])) {
	    $winVS="2";
	} else {
		$winVS="0";
	}
	
	 if (($winNC==$winVS) && ($winVS == $winTR) && ($winNC == $winTR)){
		echo 'VS/TR/NC';
		$winNC="1";
		$winTR="1"; 
		$winVS="1";
	}
	
	if (($winNC == $winTR)&& ($winNC=="2")){
		echo 'NC/TR';
		$winNC="1";
		$winTR="1";
		$winVS="0";
	}
	if (($winVS==$winTR)&& ($winVS=="2")){
		echo 'VS/TR';
		$winVS="1";
		$winTR="1";                                                
	}
	if (($winNC==$winVS)&& ($winNC=="2")){
		echo 'VS/NC';
		$winNC="1";
		$winVS="1";                                                
	}
	echo $winNC;
	echo '<br />';
	echo $winTR;
	echo '<br />';
	echo $winVS;
	echo '<br />';
}

if ($winNC == 2)
	{
		$winNC = "WIN";
	} else if ($winTR == 2)
	{
		$winTR = "WIN";
	} else if ($winVS == 2)
	{
		$winVS = "WIN";
	}
	
if ($winNC == 1)
	{
		$winNC = "DRAW";
	} 
	if ($winTR == 1)
	{
		$winTR = "DRAW";
	}
	if ($winVS == 1)
	{
		$winVS = "DRAW";
	}
	
	$ResultDraw = 0;
	
	if (($winNC == "DRAW") or ($winTR == "DRAW") or ($winVS == "DRAW"))
   	{
		$ResultDraw = "1";
	} else {
		$ResultDraw = "0";
	}
	
	
$ResultNCWin = $winNC;
$ResultTRWin = $winTR;
$ResultVSWin = $winVS;
	
/////////////////////////////////////////////////////

	

//SUBMIT DA DATA!

$submit = mysql_query ("INSERT INTO results2 (ResultDateTime, ResultServer, ResultNC, ResultTR, ResultVS, ResultDraw, ResultAlertCont, ResultAlertType, ResultDomination, ResultDominationDuration, ResultPopsNC, ResultPopsTR, ResultPopsVS, SubmitterIP) 
VALUES ('$ResultDateTime', '$ResultServer', '$ResultNCWin', '$ResultTRWin', '$ResultVSWin', '$ResultDraw', '$ResultAlertCont', '$ResultAlertType', '$ResultDomination', '$ResultDominationDuration', '$ResultPopsNC', '$ResultPopsTR', '$ResultPopsVS', '$SubmitterIP')");

include_once ("api_poll.php");

if ($success != 1) { // If an error has occured within API script

	echo 'DEBUGGING </br>';
	echo '<pre style="color: white">';
	var_dump($_POST);
	//print_r(get_defined_vars());
	echo "</pre>";
	
}


error_reporting(E_ALL); ini_set('display_errors', 'On'); 

if (!$submit) {
	die('SUBMIT ERROR!: ' . mysql_error());
} 
else
{
	header("Location: thanks.php");
	exit();
}
?>
</body>
</html>


