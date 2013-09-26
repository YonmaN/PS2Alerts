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
<body onLoad="message()">

<div id="wrapper">

	<?php include('includes/header.php') ?>
    
    <?php

	// Clean all variables at beginning of form and set defaults to blank, if the form is fresh
	if ($SelfPost == '') {
		$ResultServer = '10'; //Currently always set to Miller. 10 is the PS2 API world ID for Miller Server.
		$ResultDateTime = ''; 
		$ResultNCWin = '';
		$ResultTRWin = '';
		$ResultVSWin = '';
		$ResultDomination = '0';
		$ResultDominationDuration = '00:00:00';
		$ResultAlertCont = '';
		$ResultAlertType = '';
		$ResultFacilitiesWon = '';
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
		$ResultNCWin = $winNC;
		$ResultTRWin = $winTR;
		$ResultVSWin = $winVS;
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
          <option>Miller</option> 
        </select>
        <input type="hidden" name="ResultServer" value="1" />
        <label for="ResultServer" class="form_item_text">(Disabled)</label>
         
   <div id="time_container" style="display: block; height: 100px;"> 
        <div id="time1" style="float: left; margin-top: 10px;">
        <p class="form_item_title">When did the Alert end? (UTC time)</p>
        <input class="form_item" id="ResultDateTime" style="margin-top: 10px; width: 120px; text-align: center;" name="ResultDateTime" value="Click to set time"/>
        <label for="ResultDateTime" class="form_item_text"></label>
        </div>
        <div id="time2">
        
        	<iframe src="http://free.timeanddate.com/clock/i3tjjso2/tluk/fn17/fs22/fcfff/tct/pct/tt0/tw0/tm3/ts1/ta1" frameborder="0" width="269" height="28" allowTransparency="true"></iframe>

             <p class="form_item_text" style="text-align: center; margin: 2px; font-size: 16px;">Current UTC Time</p>
        </div>
   </div>
        
        <p class="form_item_title">Who won this alert?</p>
        <p class="form_item_title" style="font-size: 13px; color: #fff;">If the alert was a draw, please select the factions that drew together.</p>
        <input type="checkbox" id="win1" name="rNC" onClick="drawterritories_enable(), dominationcheck()"  /><span class="form_item_text">New Conglomerate</span> <br />
        <input type="checkbox" id="win2" name="rTR" onClick="drawterritories_enable(), dominationcheck()"  /><span class="form_item_text">Terran Republic</span> <br />
        <input type="checkbox" id="win3" name="rVS" onClick="drawterritories_enable(), dominationcheck()" /><span class="form_item_text">Vanu Soverignity</span> <br />
            
        <script>
		function dominationcheck() 
		{
			win1 = document.getElementById("win1");
			win2 = document.getElementById("win2");
			win3 = document.getElementById("win3");
			
			if ((win1.checked == false) && (win2.checked == false) && (win3.checked == false))
			{
				disabledomination();
				animatedcollapse.hide('domination');
               
			}
							
			if ((win1.checked == true) && (win2.checked == false) && (win3.checked == false))
			{
				animatedcollapse.show('domination');
				enabledomination();
			}
			
			if ((win1.checked == false) && (win2.checked == true) && (win3.checked == false))
			{
				animatedcollapse.show('domination');
				enabledomination();
			}
			
			if ((win1.checked == false) && (win2.checked == false) && (win3.checked == true))
			{
				animatedcollapse.show('domination');
				enabledomination();
			}
		}
		</script>
            
            <?php               
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
              ?>
        <div class="subquestion" id="domination">
        <p class="form_item_title">Did the faction win the alert by Domination?</p>
        <input type="radio" name="ResultDomination" value="1" onClick="animatedcollapse.show('duration'), enabledomination()" /><span class="form_item_text">Yes</span> <br />
        <input type="radio" name="ResultDomination" value="0" onClick="animatedcollapse.hide('duration'), disabledomination()" /><span class="form_item_text">No</span> <br />
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
        
        <input type="radio" name="ResultAlertCont" value="Amerish" onClick="reenableIfNotCross(), animatedcollapse.show('pops_cont'), animatedcollapse.hide('pops_world'), wipepopsworld()"/>
        <span class="form_item_text">Amerish</span> <br />
        <input type="radio" name="ResultAlertCont" value="Esamir" onClick="reenableIfNotCross(), animatedcollapse.show('pops_cont'), animatedcollapse.hide('pops_world'), wipepopsworld()"  />
        <span class="form_item_text">Esamir</span> <br />
        <input type="radio" name="ResultAlertCont" value="Indar" onClick="reenableIfNotCross(), animatedcollapse.show('pops_cont'), animatedcollapse.hide('pops_world'), wipepopsworld()" />
        <span class="form_item_text">Indar</span> <br />
        <input type="radio" name="ResultAlertCont" value="Cross" onClick="disableIfCross(), animatedcollapse.hide('territory'), animatedcollapse.show('pops_world'), animatedcollapse.hide('pops_cont'), wipepopscont(), wipevaluesterritory()" />
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
        
        <input type="radio" name="ResultAlertType" value="Amp" onClick="javascript:animatedcollapse.hide('territory'), wipevaluesterritory()"/><span class="form_item_text">Amp Stations </span><br />
        <input type="radio" name="ResultAlertType" value="Bio" onClick="javascript:animatedcollapse.hide('territory'), wipevaluesterritory()"/><span class="form_item_text">Bio Labs</span><br />
        <input type="radio" name="ResultAlertType" value="Tech" onClick="javascript:animatedcollapse.hide('territory'), wipevaluesterritory()"/><span class="form_item_text">Tech Plants </span><br />
        <input type="radio" name="ResultAlertType" value="Territory" id="TypeTerritory" onClick="animatedcollapse.show('territory'), enableterritoryvalues(), drawterritories_disable()" /><span id="territory_text" class="form_item_text">Territory Capture </span><br />  
        
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
	
	if ($ResultDominationDurationPre = "") { // If no domination timer was chosen, leave NULL
		$ResultDominationDuration = "00:00:00";
	} else {
		$ResultDominationDuration = $ResultDominationDurationPre.':00';
	}
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
	
	echo '<br /> NC Win:';
	echo $winNC;
	echo '<br /> TR Win:';
	echo $winTR;
	echo '<br /> VS Win:';
	echo $winVS;
	echo '<br />';
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
	
	//Refresh Data to submit to processing script//
	echo '<input type="hidden" name="ResultServer" value="'.$ResultServer.'">';
	echo '<input type="hidden" name="ResultDateTime" value="'.$ResultDateTime.'">';
	echo '<input type="hidden" name="ResultNCWin" value="'.$winNC.'">';
	echo '<input type="hidden" name="ResultTRWin" value="'.$winTR.'">';
	echo '<input type="hidden" name="ResultVSWin" value="'.$winVS.'">';
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