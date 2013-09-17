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
    
    <?php
	// Clean all variables at beginning of form
	
	$ResultServer = '1'; //Currently always set to Miller
	$ResultWinner = '';
	$ResultDraw = '';
	$ResultAlertCont = '';
	$ResultAlertType = '';
	$ResultFacilitiesWon = '';
	$ResultPopMajority = '';
	$ResultPopNC = '';
	$ResultPopTR = '';
	$ResultPopVS = '';	
	?>
    <div id="content">
    <form action="submitresult_facilities.php" method="POST" name="AlertStats">
    
    <p class="form_headers">General Alert Stats (Miller only for now!)</p>   
    
    <p class="form_item_text">Which server was this alert on?</p>
    <select name="ResultServer">
    	<option value="1">Miller</option>
    </select>
     
    <p class="form_item_text">When did the Alert end? (GMT time):</p>
    <input class="form_item" type="datetime-local" name="ResultDateTime" />
    
    <p class="form_item_text">Who won this alert?</p>
    
    <input type="radio" name="ResultWinner" value="NC" />New Conglomerate <br />
    <input type="radio" name="ResultWinner" value="TR" />Terran Republic <br />
    <input type="radio" name="ResultWinner" value="VS" />Vanu Soverignity <br />
    <input type="radio" name="ResultWinner" value="Draw" />Draw <br />
    
    <p class="form_item_text">Where was this continant based?</p>
    
    <input type="radio" name="ResultAlertCont" value="Amerish" onclick="reenableIfNotCross()"/>Amerish <br />
    <input type="radio" name="ResultAlertCont" value="Esamir" onclick="reenableIfNotCross()" />Esamir <br />
    <input type="radio" name="ResultAlertCont" value="Indar" onclick="reenableIfNotCross()" />Indar <br />
    <input type="radio" name="ResultAlertCont" value="Cross" onclick="disableIfCross()"/>Cross Continent (All three) <br />
    
    <script>
	function disableIfCross()
	{
		document.getElementById("TypeTerritory").disabled=true
	}
	function reenableIfNotCross()
	{
		document.getElementById("TypeTerritory").disabled=false
	}
	</script>
    
    <p class="form_item_text">What kind of alert was this?</p>
    
    <!-- Based on the continant answer and this answer, PHP will change the submitted variable to be the proper one into the database -->
    
    <input type="radio" name="ResultAlertType" value="Amp" />Amp Stations <br />
    <input type="radio" name="ResultAlertType" value="Bio" />Bio Labs<br />
    <input type="radio" name="ResultAlertType" value="Tech" />Tech Plants <br />
    <input type="radio" name="ResultAlertType" value="Territory" id="TypeTerritory" />Territory Capture <br />   
    
    <br />
    <input type="submit" name="AlertStats" value="Continue..." />
    
   	</form>
    <p class="form_headers">Population Statistics</p>   
    
    
    <p class="form_item_text">Which faction had the majority of population at the <b>end</b> of the alert?</p>
    
    <input type="radio" name="ResultMajorityPop" value="NC" />New Conglomerate <br />
    <input type="radio" name="ResultMajorityPop" value="TR" />Terran Republic <br />
    <input type="radio" name="ResultMajorityPop" value="VS" />Vanu Soverignity <br />
    <input type="radio" name="ResultMajorityPop" value="Even" />Populations were exactly even (33% each) <br />
    
    

	<p class="form_item_text">How much population percentage (%) did each of the factions have?</p>
    New Conglomerate = <input class="two" type="text" name="ResultPopsNC" />% <br />
    Terran Republic = <input class="two" type="text" name="ResultPopsTR" />% <br />
    Vanu Soverignty = <input class="two" type="text" name="ResultPopsVS" />% <br />





	</div>


</div>
</body>
</html>