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
	
	
	?>
    
    <form action="" method="post" name="AlertStats">
    
    <p class="form_headers">Facility Statistics</p>  
    
    <p class="form_item_text">Which facility was the most contested?</p>
	
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
		
	$SelectQuery = ("SELECT * FROM facilities WHERE FacilityType ='".$ResultAlertType."' AND FacilityContID = '".$ResultAlertCont."'");	
	
	?>
    
    <select>
    	<option value="Allatum">Allatum Bio Lab</option>
        <option value="Andvari">Andvari Bio Lab</option>
        <option value="Dahaka">Dahaka Amp Station</option>
        <option value="Allatum">Allatum Bio Lab</option>
        <option value="Allatum">Allatum Bio Lab</option>
        <option value="Allatum">Allatum Bio Lab</option>
        <option value="Allatum">Allatum Bio Lab</option>
        <option value="Allatum">Allatum Bio Lab</option>
        <option value="Allatum">Allatum Bio Lab</option>
        <option value="Allatum">Allatum Bio Lab</option>
        <option value="Allatum">Allatum Bio Lab</option>
        <option value="Allatum">Allatum Bio Lab</option>
        <option value="Allatum">Allatum Bio Lab</option>
        <option value="Allatum">Allatum Bio Lab</option>
        <option value="Allatum">Allatum Bio Lab</option>
        <option value="Allatum">Allatum Bio Lab</option>
        <option value="Allatum">Allatum Bio Lab</option>
        <option value="Allatum">Allatum Bio Lab</option>
        <option value="Allatum">Allatum Bio Lab</option>
        <option value="Allatum">Allatum Bio Lab</option>
        <option value="Allatum">Allatum Bio Lab</option>
        <option value="Allatum">Allatum Bio Lab</option>
        <option value="Allatum">Allatum Bio Lab</option>
        <option value="Allatum">Allatum Bio Lab</option>
        
    </select>

</form>
	</div>


</div>
</body>
</html>