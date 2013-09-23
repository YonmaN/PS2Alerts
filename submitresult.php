<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/sitewide.css" rel="stylesheet" />
<link href='http://fonts.googleapis.com/css?family=Noto+Sans:400,700' rel='stylesheet' type='text/css' />
<?php include("includes/mysqlconnect.php") ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<title>Planetside 2 Statistics Index</title>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="js/animatedcollapse.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/additional-methods.js"></script>


<?php $SelfPost = $_POST["SelfPost"]; ?>
<script type="text/javascript">
/***********************************************
* Animated Collapsible DIV v2.4- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for this script and 100s more
***********************************************/

</script>

<script type="text/javascript">
animatedcollapse.addDiv('territory', 'fade=1,height=80px')
animatedcollapse.addDiv('pops_world', 'fade=1,height=80px')
animatedcollapse.addDiv('pops_cont', 'fade=1,height=80px')
animatedcollapse.addDiv('domination', 'fade=1,height=70px')
animatedcollapse.addDiv('duration', 'fade=1,height=60px')
animatedcollapse.addDiv('partone', 'fade=1')
animatedcollapse.addDiv('parttwo', 'fade=1')

animatedcollapse.ontoggle=function($, divobj, state){ //fires each time a DIV is expanded/contracted
	//$: Access to jQuery
	//divobj: DOM reference to DIV being expanded/ collapsed. Use "divobj.id" to get its ID
	//state: "block" or "none", depending on state
}

animatedcollapse.init()

</script>
<script>
function message() {
	window.alert("This system is NOT YET LIVE. Please use the Google document at www.bit.ly/MillerAlertStats until announcement!");
}
</script>

</head>
<body onload="message()">

<div id="wrapper">

	<?php include('includes/header.php') ?>
    
    
    <?php

	// Clean all variables at beginning of form and set defaults IF form is fresh
	if ($SelfPost == '') {
		$ResultServer = '1'; //Currently always set to Miller
		$ResultDateTime = '';
		$ResultWinner = '';
		$ResultDomination = '0';
		$ResultDominationDuration = '';
		$ResultAlertCont = '';
		$ResultAlertType = '';
		$ResultPopsNC = '';
		$ResultPopsTR = '';
		$ResultPopsVS = '';
		$ResultTerritoryNC = '';
		$ResultTerritoryTR = '';
		$ResultTerritoryVS = '';
	
	} elseif ($SelfPost == 'true') 
	{
		$ResultServer = $_POST["ResultServer"]; //Currently always set to Miller
		$ResultDateTimePre = $_POST["ResultDateTime"];
		$ResultWinner = $_POST["ResultWinner"];
		$ResultDomination =  $_POST["ResultDomination"];
		$ResultDominationDurationPre = $_POST["ResultDominationDuration"];
		$ResultAlertCont = $_POST["ResultAlertCont"];
		$ResultAlertType = $_POST["ResultAlertType"];
		$ResultFacilitiesWon = $_POST["ResultFacilitiesWon"];
		$ResultPopsNC = $_POST["ResultPopsNC"];
		$ResultPopsTR = $_POST["ResultPopsTR"];
		$ResultPopsVS = $_POST["ResultPopsVS"];
		$ResultTerritoryNC = $_POST["ResultTerritoryNC"];
		$ResultTerritoryTR = $_POST["ResultTerritoryTR"];
		$ResultTerritoryVS = $_POST["ResultTerritoryVS"];
		
		$ResultAlertMasterType = $ResultAlertType.$ResultAlertCont;
	}
	
	?>

    <div id="content">
    
<script type="text/javascript">
  $(function() {
    $('#ResultDateTime').datetimepicker({
	timeFormat: 'HH:mm',
	dateFormat: 'yy-mm-dd',
	showButtonPanel: false,
	maxDate: 0,
	minDate: -1,
	timezone: "0000",
	pickerTimeSuffix: ' GMT'
	
});
	$( "#ResultDominationDuration" ).timepicker({
	hourMax: 1,
	showButtonPanel: false
	});
  });
</script>
  
<script type="text/javascript">

	$("#form").validate({
		rules:
		{
			ResultDateTime: 
			{
				required: true
			},
			ResultWinner:
			{
				required: true
			},
			ResultAlertCont: 
			{
				required: true
			},
			ResultAlertType: 
			{
				required: true
			}
		}
	});
	
</script>
    
        
        <?php if ($SelfPost == "true") {
            echo '<div id="partone" style="display:none">';
        } else {
            echo '<div id="partone">';
        } 
        ?>
      <form action="submitresult.php" id="form" method="post" name="AlertStats">
        <p class="form_headers">Alert Stats Submission (Miller only for now!)</p> 
        
        <p class="form_subtitle_text">Thank you for taking the time to submit alert data for us! Every alert you can tell us about will further help our understanding of the performances of each empire during alerts on your server! <br />
          <br/>
        Please note, you can't submit another alert until two hours later, to prevent spamming and contaminating the results.</p>  
        
        <p class="form_item_title">Which server was this alert on?</p>
        <select name="ResultServerDis" id="ResultServer" disabled="disabled" >
          <option value="1">Miller</option> 
        </select>
        <input type="hidden" name="ResultServer" value="1" />
        <label for="ResultServer" class="form_item_text">(Disabled)</label>
         
   <div id="time_container" style="display: block; height: 120px;"> 
        <div id="time1" style="float: left; margin-top: 10px;">
        <p class="form_item_title">When did the Alert end? (GMT time):</p>
        <input class="form_item" id="ResultDateTime" style="margin-top: 20px; width: 120px; text-align: center;" name="ResultDateTime" />
        <label for="ResultDateTime" class="form_item_text"></label>
        </div>
        <div id="time2" style="float: right; width: 345px;">
        
        	<div style="text-align:center;width:350px;padding:0.5em 0;">
        		<iframe src="http://www.zeitverschiebung.net/clock-widget-iframe?language=en&timezone=Atlantic%2FReykjavik" width="100%" height="110" frameborder="0" seamless>
        		</iframe>
      		 </div>
             <p class="form_item_text" style="text-align: center; margin: 2px; font-size: 24px;">Current GMT Time</p>
        </div>
   </div>
        
        <p class="form_item_title">Who won this alert?</p>
        <input type="radio" name="ResultWinner" value="NC" onclick="drawterritories_enable(), animatedcollapse.show('domination')"  /><span class="form_item_text">New Conglomerate</span> <br />
        <input type="radio" name="ResultWinner" value="TR" onclick="drawterritories_enable(), animatedcollapse.show('domination')"  /><span class="form_item_text">Terran Republic</span> <br />
        <input type="radio" name="ResultWinner" value="VS" onclick="drawterritories_enable(), animatedcollapse.show('domination')"  /><span class="form_item_text">Vanu Soverignity</span> <br />
        <input type="radio" name="ResultWinner" value="Draw" id="draw" onclick="drawterritories_disable(), animatedcollapse.hide('domination')" /><span class="form_item_text">Draw</span> <br />
        
        <div class="subquestion" id="domination">
        <p class="form_item_title">Did the faction win the alert by Domination?</p>
        <input type="radio" name="ResultDomination" value="1" onclick="animatedcollapse.show('duration'), enabledomination()" /><span class="form_item_text">Yes</span> <br />
        <input type="radio" name="ResultDomination" value="0" onclick="animatedcollapse.hide('duration'), disabledomination()" /><span class="form_item_text">No</span> <br />
        </div>
        
        <script>
		function disabledomination()
		{
			document.getElementById("ResultDominationDuration").value=""
			document.getElementById("ResultDominationDuration").disabled=true
		}		
		function enabledomination()
		{
			document.getElementById("ResultDominationDuration").disabled=false
		}
		
		</script>
        
        <div class="subquestion" id="duration">
        <p class="form_item_title">How long did this alert last?</p>
        <input type="text" id="ResultDominationDuration" style="width: 50px; text-align: center;" name="ResultDominationDuration" /><span class="form_item_text" style="margin-left: 5px;">Hours</span>
        
        </div>
                          
        <p class="form_item_title">Where was this continent based?</p>
        
        <input type="radio" name="ResultAlertCont" value="Amerish" onclick="reenableIfNotCross(), animatedcollapse.show('pops_cont'), animatedcollapse.hide('pops_world'), wipepopsworld()"/>
        <span class="form_item_text">Amerish</span> <br />
        <input type="radio" name="ResultAlertCont" value="Esamir" onclick="reenableIfNotCross(), animatedcollapse.show('pops_cont'), animatedcollapse.hide('pops_world'), wipepopsworld()"  />
        <span class="form_item_text">Esamir</span> <br />
        <input type="radio" name="ResultAlertCont" value="Indar" onclick="reenableIfNotCross(), animatedcollapse.show('pops_cont'), animatedcollapse.hide('pops_world'), wipepopsworld()" />
        <span class="form_item_text">Indar</span> <br />
        <input type="radio" name="ResultAlertCont" value="Cross" onclick="disableIfCross(), animatedcollapse.hide('territory'), animatedcollapse.show('pops_world'), animatedcollapse.hide('pops_cont'), wipepopscont(), wipevaluesterritory()" />
        <span class="form_item_text">Cross Continent (All three)</span> <br />
        
       	<script>
		
		function wipepopscont()
		{
			document.getElementById("pops_c_nc").value=""
			document.getElementById("pops_c_nc").disabled=true
			document.getElementById("pops_w_nc").disabled=false
			document.getElementById("pops_c_tr").value=""
			document.getElementById("pops_c_tr").disabled=true
			document.getElementById("pops_w_tr").disabled=false
			document.getElementById("pops_c_vs").value=""	
			document.getElementById("pops_c_vs").disabled=true
			document.getElementById("pops_w_vs").disabled=false
		}
		
		function wipepopsworld()
		{
			document.getElementById("pops_w_nc").value=""
			document.getElementById("pops_w_nc").disabled=true
			document.getElementById("pops_c_nc").disabled=false
			document.getElementById("pops_w_tr").value=""
			document.getElementById("pops_w_tr").disabled=true
			document.getElementById("pops_c_tr").disabled=false
			document.getElementById("pops_w_vs").value=""
			document.getElementById("pops_w_vs").disabled=true	
			document.getElementById("pops_c_vs").disabled=false
		}
		
		</script>        
        
        <div class="subquestion" id="pops_world">
        <p class="form_item_title">How much <b>world</b> population % did each empire have?</p>
        
        <table width="150" border="0" style="text-align: center;">
          <tr>
            <td class="form_item_text" width="50">NC</td>
            <td class="form_item_text" width="50">TR</td>
            <td class="form_item_text" width="50">VS</td>
          </tr>
          <tr>
            <td><input class="two" type="text" id="pops_w_nc" name="ResultPopsNC" /></td>
            <td><input class="two" type="text" id="pops_w_tr" name="ResultPopsTR" /></td>
            <td><input class="two" type="text" id="pops_w_vs" name="ResultPopsVS" /></td>
         </tr>
        </table>
        
        </div>
        
        <div class="subquestion" id="pops_cont">
         <p class="form_item_title">How much <b>continent</b> population % did each empire have?</p>
        <table width="150" border="0" style="text-align: center;">
          <tr>
            <td class="form_item_text" width="50">NC</td>
            <td class="form_item_text" width="50">TR</td>
            <td class="form_item_text" width="50">VS</td>
          </tr>
          <tr>
            <td><input class="two" type="text" id="pops_c_nc" name="ResultPopsNC" /></td>
            <td><input class="two" type="text" id="pops_c_tr" name="ResultPopsTR" /></td>
            <td><input class="two" type="text" id="pops_c_vs" name="ResultPopsVS" /></td>
          </tr>
        </table>
        </div>
        
        
        
        <script type="text/javascript">
        function disableIfCross()
        {
            document.getElementById("TypeTerritory").disabled=true
			document.getElementById("TypeTerritory").checked=false
			document.getElementById("territory_text").className = "strike";
        }
        function reenableIfNotCross()
        {
            document.getElementById("TypeTerritory").disabled=false
			document.getElementById("territory_text").className = "form_item_text";
        }
        </script>
        
        <p class="form_item_title">What kind of alert was this?</p>
        
        <!-- Based on the continant answer and this answer, PHP will change the submitted variable to be the proper one into the database -->
        
        <input type="radio" name="ResultAlertType" value="Amp" onclick="javascript:animatedcollapse.hide('territory'), wipevaluesterritory()"/><span class="form_item_text">Amp Stations </span><br />
        <input type="radio" name="ResultAlertType" value="Bio" onclick="javascript:animatedcollapse.hide('territory'), wipevaluesterritory()"/><span class="form_item_text">Bio Labs</span><br />
        <input type="radio" name="ResultAlertType" value="Tech" onclick="javascript:animatedcollapse.hide('territory'), wipevaluesterritory()"/><span class="form_item_text">Tech Plants </span><br />
        <input type="radio" name="ResultAlertType" value="Territory" id="TypeTerritory" onclick="animatedcollapse.show('territory'), enableterritoryvalues(), drawterritories_disable()" /><span id="territory_text" class="form_item_text">Territory Capture </span><br />  
        
        <script type="text/javascript">
		
		function wipevaluesterritory()
		{
			document.getElementById("TerritoryNC").value=""
			document.getElementById("TerritoryNC").disabled=true
			document.getElementById("TerritoryTR").value=""
			document.getElementById("TerritoryTR").disabled=true
			document.getElementById("TerritoryVS").value=""
			document.getElementById("TerritoryVS").disabled=true
		}
		
		function enableterritoryvalues()
		{
			document.getElementById("TerritoryNC").disabled=false
			document.getElementById("TerritoryTR").disabled=false
			document.getElementById("TerritoryVS").disabled=false
		}
		
		function checkterritories()
		{
			var TerritoryOption = document.getElementById("TypeTerritory")
			var TerritoryNC = document.getElementById("TerritoryNC")
			var TerritoryTR = document.getElementById("TerritoryTR")
			var TerritoryVS = document.getElementById("TerritoryVS")
						
			if ((TerritoryNC.value + TerritoryTR.value + TerritoryVS.value < 99) && (TerritoryOption.checked=true))
			{
				window.alert("Territories do not match up to 100% - Too low! Please check the territory percentages and try again.");
				
			} else if (TerritoryNC.value + TerritoryTR.value + TerritoryVS.value > 100)	{
				window.alert("Territories do not match up to 100% - Too high! Please check the territory percentages and try again.");
			}
		}
		
		function drawterritories_disable()
		{
			var Draw = document.getElementById("draw")
			var TerritoryNC = document.getElementById("TerritoryNC")
			var TerritoryTR = document.getElementById("TerritoryTR")
			var TerritoryVS = document.getElementById("TerritoryVS")
			
		if (Draw.checked=true)
			{
				TerritoryNC.value ="33"
				TerritoryNC.readOnly=true
				TerritoryTR.value ="33"
				TerritoryTR.readOnly=true
				TerritoryVS.value ="33"
				TerritoryVS.readOnly=true
			}
		}
		
		function drawterritories_enable()
		{
			TerritoryNC.value =""
			TerritoryNC.disabled=false
			TerritoryNC.readOnly=false
			TerritoryTR.value =""
			TerritoryTR.disabled=false
			TerritoryTR.readOnly=false
			TerritoryVS.value =""
			TerritoryVS.disabled=false
			TerritoryVS.readOnly=false
			
		}
		</script>		
        
        <div id="territory" class="subquestion">
        
        <p class="form_item_title">How much territory % did each empire control?</p>
        
        <table width="150" border="0" style="text-align: center;">
          <tr>
            <td class="form_item_text" width="50">NC</td>
            <td class="form_item_text" width="50">TR</td>
            <td class="form_item_text" width="50">VS</td>
          </tr>
          <tr>
            <td><input class="two" type="text" name="ResultTerritoryNC" id="TerritoryNC" /></td>
            <td><input class="two" type="text" name="ResultTerritoryTR" id="TerritoryTR" /></td>
            <td><input class="two" type="text" name="ResultTerritoryVS" id="TerritoryVS" /></td>
          </tr>
        </table>
        
        </div>
        
        <br />
    <input type="hidden" name="SelfPost" value="true" />
    <input type="submit" name="AlertStats" onsubmit="return checkterritories()" value="Continue..." /> 
    </form>     
     
	</div> <!-- Part 1 Div End -->
        
        <?php if ($SelfPost == "true") {
            echo '<div id="parttwo" style="display:block">';
        } else {
            echo '<div id="parttwo" style="display:none">';
        }
   	
	
	// PART 2 POST PROCESSING
	
	if ($ResultWinner == "Draw") 
   	{
		$ResultDraw = "1";
	} else {
		$ResultDraw = "0";
	}
	
	// Append seconds to Domination timer and Alert Timer
	
	$ResultDominationDuration = $ResultDominationDurationPre.':00';
	$ResultDateTime = $ResultDateTimePre.':00';
	?>
    
    <form action="submitresult_process.php" method="post" name="AlertStats2">
    
    <div class="form_item_text" id="debug">
  	<?php if ($SelfPost == "true") {
		echo '<div class="form_item_text">';
			echo 'DEBUGGING </br>';
			echo "<pre>";
			var_dump($_POST);
			echo "</pre>";
		echo '</div>';
	}	
	echo '</br> Master Alert Type: ';
	echo $ResultAlertMasterType;
	?>	
    </div>
	<p class="form_headers">Facility Statistics</p>  
    
    <p class="form_item_title">Which facility was the most contested?</p>
	<?php
	
	//Change Query based on Alert Type
	
	if ($ResultAlertType == "Territory") {
		$SelectQuery = mysql_query("SELECT * FROM facilities WHERE FacilityContID ='".$ResultAlertCont."' ORDER BY FacilityType");
	
	}else if($ResultAlertCont == "Amerish" or $ResultAlertCont == "Esamir" or $ResultAlertCont == "Indar") {			
	$SelectQuery = mysql_query("SELECT * FROM facilities WHERE FacilityType ='".$ResultAlertType."' AND FacilityContID ='".$ResultAlertCont."' ORDER BY FacilityContID ");
	
	} else if ($ResultAlertCont == "Cross") {
	$SelectQuery = mysql_query("SELECT * FROM facilities WHERE FacilityType ='".$ResultAlertType."' ORDER BY FacilityContID");
	
	} 
    echo '<select name="ResultContestedFacility">';
		while($facility_result = mysql_fetch_array($SelectQuery)) {
			echo '<option value="'.$facility_result['FacilityID'].'">'.$facility_result['FacilityContID'].' - '.$facility_result['FacilityName'].'</option>';
		}
    echo '</select>';
	?>
    
	
    
    
    <?php 
	// Set up the form based on the previous information (cross continant or not etc)
	
	// IF Cross Continant and NOT territory and NOT a draw::
	
	if ($ResultDomination == "1") 
	{
		echo '<p class="form_item_text">DOMINATION</p>';
		
		if ($ResultAlertMasterType == "AmpCross" or $ResultAlertMasterType == "BioCross") 
		{
			$ResultFacilitiesWon = 9;
		} elseif ($ResultAlertMasterType == "TechCross") {
			$ResultFacilitiesWon = 7;
		} else { // If Continential
			$ResultFacilitiesWon = 3;
		}
	} else 
	{
		if ($ResultAlertType != "Territory") 
		{				
			if ($ResultAlertMasterType == "AmpCross" or $ResultAlertMasterType == "BioCross") 
				{
					echo '<p class="form_item_title">How many facilties did the victor have?</p>';
					echo '<input type="radio" class="form_item_text" name="ResultFacilitiesWon" value=4> <span class="form_item_text">4/9</span> </br>';
					echo '<input type="radio" class="form_item_text" name="ResultFacilitiesWon" value=5> <span class="form_item_text">5/9</span> </br>';
					echo '<input type="radio" class="form_item_text" name="ResultFacilitiesWon" value=6> <span class="form_item_text">6/9</span> </br>';
					echo '<input type="radio" class="form_item_text" name="ResultFacilitiesWon" value=7> <span class="form_item_text">7/9</span> </br>';
					echo '<input type="radio" class="form_item_text" name="ResultFacilitiesWon" value=8> <span class="form_item_text">8/9</span> </br>';
					
				} elseif ($ResultAlertMasterType == "TechCross") 
				{
					echo '<p class="form_item_title">How many facilties did the victor have?</p>';
					echo '<input type="radio" class="form_item_text" name="ResultFacilitiesWon" value=3> <span class="form_item_text">3/7</span> </br>';
					echo '<input type="radio" class="form_item_text" name="ResultFacilitiesWon" value=4> <span class="form_item_text">4/7</span> </br>';
					echo '<input type="radio" class="form_item_text" name="ResultFacilitiesWon" value=5> <span class="form_item_text">5/7</span> </br>';
					echo '<input type="radio" class="form_item_text" name="ResultFacilitiesWon" value=6> <span class="form_item_text">6/7</span> </br>';
				}
		}
	}
		
	?>
    <br />
    
    <?php
	
	//Refresh Data to submit//
	echo '<input type="hidden" name="ResultServer" value="'.$ResultServer.'">';
	echo '<input type="hidden" name="ResultDateTime" value="'.$ResultDateTime.'">';
	echo '<input type="hidden" name="ResultWinner" value="'.$ResultWinner.'">';
	echo '<input type="hidden" name="ResultDraw" value="'.$ResultDraw.'">';
	echo '<input type="hidden" name="ResultDomination" value="'.$ResultDomination.'">';
	echo '<input type="hidden" name="ResultDominationDuration" value="'.$ResultDominationDuration.'">';
	echo '<input type="hidden" name="ResultAlertCont" value="'.$ResultAlertCont.'">';
	echo '<input type="hidden" name="ResultAlertType" value="'.$ResultAlertType.'">';
	echo '<input type="hidden" name="ResultPopsNC" value="'.$ResultPopsNC.'">';
	echo '<input type="hidden" name="ResultPopsTR" value="'.$ResultPopsTR.'">';
	echo '<input type="hidden" name="ResultPopsVS" value="'.$ResultPopsVS.'">';
	echo '<input type="hidden" name="ResultTerritoryNC" value="'.$ResultTerritoryNC.'">';
	echo '<input type="hidden" name="ResultTerritoryTR" value="'.$ResultTerritoryTR.'">';
	echo '<input type="hidden" name="ResultTerritoryVS" value="'.$ResultTerritoryVS.'">';
	?>
    <input type="Submit" name="AlertStats2" value="Submit The Data!" />
	</form>
	</div>
        </div>
  </div>
</div>
</body>
</html>