<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/sitewide.css" rel="stylesheet" />
<link href='http://fonts.googleapis.com/css?family=Noto+Sans:400,700' rel='stylesheet' type='text/css'>
<?php include("includes/mysqlconnect.php") ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Planetside 2 Statistics Index</title>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="js/animatedcollapse.js">

/***********************************************
* Animated Collapsible DIV v2.4- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for this script and 100s more
***********************************************/

</script>


<script type="text/javascript">

animatedcollapse.addDiv('territory', 'fade=1,height=100px')

animatedcollapse.addDiv('cat', 'fade=0,speed=400,group=pets')
animatedcollapse.addDiv('dog', 'fade=0,speed=400,group=pets,persist=1,hide=1')
animatedcollapse.addDiv('rabbit', 'fade=0,speed=400,group=pets,hide=1')

animatedcollapse.ontoggle=function($, divobj, state){ //fires each time a DIV is expanded/contracted
	//$: Access to jQuery
	//divobj: DOM reference to DIV being expanded/ collapsed. Use "divobj.id" to get its ID
	//state: "block" or "none", depending on state
}

animatedcollapse.init()

</script>
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
        <input type="radio" name="ResultAlertCont" value="Cross" onclick="disableIfCross(), animatedcollapse.hide('territory')" />Cross Continent (All three) <br />
        
        <script>
        function disableIfCross()
        {
            document.getElementById("TypeTerritory").disabled=true
			document.getElementById("TypeTerritory").checked=false
        }
        function reenableIfNotCross()
        {
            document.getElementById("TypeTerritory").disabled=false
        }
        </script>
        
        <p class="form_item_text">What kind of alert was this?</p>
        
        <!-- Based on the continant answer and this answer, PHP will change the submitted variable to be the proper one into the database -->
        
        <input type="radio" name="ResultAlertType" value="Amp" onclick="javascript:animatedcollapse.hide('territory')"/>Amp Stations <br />
        <input type="radio" name="ResultAlertType" value="Bio" onclick="javascript:animatedcollapse.hide('territory')"/>Bio Labs<br />
        <input type="radio" name="ResultAlertType" value="Tech" onclick="javascript:animatedcollapse.hide('territory')"/>Tech Plants <br />
        <input type="radio" name="ResultAlertType" value="Territory" id="TypeTerritory" onclick="animatedcollapse.show('territory')" />Territory Capture <br />   
        
        <div id="territory" style="display:none; background-color:#777;">
        
        <p class="form_item_text">How much territory % did each empire control?</p>
        
        <table width="250" border="0" style="text-align: center;">
          <tr>
            <td width="83">NC</td>
            <td width="83">TR</td>
            <td width="83">VS</td>
          </tr>
          <tr>
            <td><input class="two" type="text" name="ResultTerritoryNC" /></td>
            <td><input class="two" type="text" name="ResultTerritoryTR" /></td>
            <td><input class="two" type="text" name="ResultTerritoryVS" /></td>
          </tr>
        </table>
        
        </div>
        
        <br />
        <input type="submit" name="AlertStats" value="Continue..." />
        
        </form>
        <p class="form_headers">Population Statistics</p>   
        
        
        <p class="form_item_text">Which faction had the majority of population at the <b>end</b> of the alert?</p>
        
        <input type="radio" name="ResultMajorityPop" value="NC" />New Conglomerate <br />
        <input type="radio" name="ResultMajorityPop" value="TR" />Terran Republic <br />
        <input type="radio" name="ResultMajorityPop" value="VS" />Vanu Soverignity <br />
        <input type="radio" name="ResultMajorityPop" value="Even" />Populations were exactly even (33% each) <br />
        
        <div id="pops">
    
        <p class="form_item_text">How much population percentage (%) did each of the factions have?</p>
        <table width="250" border="0" style="text-align: center;">
          <tr>
            <td width="83">NC</td>
            <td width="83">TR</td>
            <td width="83">VS</td>
          </tr>
          <tr>
            <td><input class="two" type="text" name="ResultPopsNC" /></td>
            <td><input class="two" type="text" name="ResultPopsTR" /></td>
            <td><input class="two" type="text" name="ResultPopsVS" /></td>
          </tr>
        </table>
        
        </div>
	</div>
</div>
</body>
</html>