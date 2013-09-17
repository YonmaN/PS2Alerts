<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/sitewide.css" rel="stylesheet" />
<?php include("includes/mysqlconnect.php") ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Planetside 2 Statistics Index</title>
</head>

<body>
<div id="wrapper">

	<div id="header">
    <a href="submitresult.php">Submit Result</a>
    <a href="stats.php">Statistics</a>
    </div>
    
    <div id="content">
    <?php
	$ResultDate = $_POST["ResultDateTime"];
    $ResultServer = $_POST["ResultServer"]; //Currently always set to Miller
	$ResultWinner = $_POST["ResultWinner"];
	$ResultDraw = $_POST["ResultDraw"];
	$ResultAlertCont = $_POST["ResultAlertCont"];
	$ResultAlertType = $_POST["ResultAlertType"];
	$ResultFacilitiesWon = $_POST["ResultFacilitiesWon"];
	$ResultPopMajority = $_POST["ResultPopMajority"];
	$ResultPopNC = $_POST["ResultPopNC"];
	$ResultPopTR = $_POST["ResultPopTR"];
	$ResultPopVS = $_POST["ResultPopVS"];
	$ResultAlertMasterType;
	
	// Convert Territory Types and Contiant Alert into the Alert Type variable to be used
	
	$ResultAlertMasterType = $ResultAlertType.$ResultAlertCont;
	
	?>
    
    <form action="" method="post" name="AlertStats">
    
    <?php
	echo 'DEBUGGING </br>';
	echo 'Date: ';
	echo $ResultDate;
	echo '</br>Server: ';
	echo $ResultServer;
	echo '</br> Alert Winner: ';
	echo $ResultWinner;
	echo '</br> Alert Draw? ';
	echo $ResultDraw;
	echo '</br> Alert Continant: ';	
	echo $ResultAlertCont;
	echo '</br> Alert Type: ';
	echo $ResultAlertType;
	echo '</br> Master Alert Type: ';
	echo $ResultAlertMasterType;
		
	?>	
	<p class="form_headers">Facility Statistics</p>  
    
    <p class="form_item_text">Which facility was the most contested?</p>
	<?php
	
	//Change Query based on Alert Type
	if($ResultAlertCont == "Amerish" or $ResultAlertCont == "Esamir" or $ResultAlertCont == "Indar") {			
	$SelectQuery = mysql_query("SELECT * FROM facilities WHERE FacilityType ='".$ResultAlertType."' AND FacilityContID ='".$ResultAlertCont."' ORDER BY FacilityContID ");
	
	} else if ($ResultAlertCont == "Cross") {
	$SelectQuery = mysql_query("SELECT * FROM facilities WHERE FacilityType ='".$ResultAlertType."' ORDER BY FacilityContID");
	}
	
    echo '<select>';
		while($facility_result = mysql_fetch_array($SelectQuery)) {
			echo '<option value="'.$facility_result['FacilityID'].'">'.$facility_result['FacilityContID'].' - '.$facility_result['FacilityName'].'</option>';
		}
    echo '</select>';
	?>

	<p class="form_item_text">How many facilties did the victor have? (Non Draw)</p>
    
    
    <?php 
	// Set up the form based on the previous information (cross continant or not etc)
	
	// IF Cross Continant:
	if ($ResultAlertMasterType == "AmpCross" or $ResultAlertMasterType == "BioCross") {
		echo '<input type="radio" name="FacilityWins" value="4"> 4/9 </br>';
		echo '<input type="radio" name="FacilityWins" value="5"> 5/9 </br>';
		echo '<input type="radio" name="FacilityWins" value="6"> 6/9 </br>';
		echo '<input type="radio" name="FacilityWins" value="7"> 7/9 </br>';
		echo '<input type="radio" name="FacilityWins" value="8"> 8/9 </br>';
		echo '<input type="radio" name="FacilityWins" value="9"> 9/9 (Dominating Victory)';
		
	} elseif ($ResultAlertMasterType == "TechCross") {
		echo '<input type="radio" name="FacilityWins" value="3"> 3/7';
		echo '<input type="radio" name="FacilityWins" value="4"> 4/7';
		echo '<input type="radio" name="FacilityWins" value="5"> 5/7';
		echo '<input type="radio" name="FacilityWins" value="6"> 6/7';
		echo '<input type="radio" name="FacilityWins" value="7"> 7/7 (Dominating Victory)';
	
	//Else if single continant alert
	} else {
		echo '<input type="radio" name="FacilityWins" value="2"> 2/3';
		echo '<input type="radio" name="FacilityWins" value="3"> 3/3 (Dominating Victory)';
	}
		
	?>
    <br />
    <input type="Submit" name="AlertStats" value="Continue..." />
	</form>
	</div>


</div>
</body>
</html>