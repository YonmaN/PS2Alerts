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
animatedcollapse.addDiv('part_one', 'fade=1')
animatedcollapse.addDiv('part_two', 'fade=1,height=60px')

animatedcollapse.ontoggle=function($, divobj, state){ //fires each time a DIV is expanded/contracted
	//$: Access to jQuery
	//divobj: DOM reference to DIV being expanded/ collapsed. Use "divobj.id" to get its ID
	//state: "block" or "none", depending on state
}

animatedcollapse.init()

</script>

<script type="text/javascript">

// Checks if the form is a SelfPost, and hides the appropiate DIVs //

var SelfPost = '<?php echo $SelfPost; ?>';

if SelfPost == 'true' {
	animatedcollapse.hide('part_one');
	animatedcollapse.show('part_two');
}
	

</script>

</head>

<body>
<div id="wrapper">

	<?php include('includes/header.php') ?>
    
    
    <?php
	
	$SelfPost = $_POST["SelfPost"];
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
		$ResultServer_POST = $_POST["ResultServer"]; //Currently always set to Miller
		$ResultDateTime_POST = $_POST["ResultDateTime"];
		$ResultWinner_POST = $_POST["ResultWinner"];
		$ResultDomination_POST =  $_POST["ResultDomination"];
		$ResultDominationDuration_POST = $_POST["ResultDominationDuration"];
		$ResultAlertCont_POST = $_POST["ResultAlertCont"];
		$ResultAlertType_POST = $_POST["ResultAlertType"];
		$ResultFacilitiesWon_POST = $_POST["ResultFacilitiesWon"];
		$ResultPopsNC_POST = $_POST["ResultPopsNC"];
		$ResultPopsTR_POST = $_POST["ResultPopsTR"];
		$ResultPospVS_POST = $_POST["ResultPopsVS"];
		$ResultTerritoryNC_POST = $_POST["ResultTerritoryNC"];
		$ResultTerritoryTR_POST = $_POST["ResultTerritoryTR"];
		$ResultTerritoryVS_POST = $_POST["ResultTerritoryVS"];
	}
	
	?>
    <div id="content">
    
<script type="text/javascript">
  $(function() {
    $('#ResultDateTime').datetimepicker({
	timeFormat: 'HH:mm',
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
		echo '<div class="form_item_text">';
			echo 'DEBUGGING </br>';
			echo "<pre>";
			var_dump($_POST);
			echo "</pre>";
		echo '</div>';
	}
	?>
    <div id="part_one">
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
        <input class="form_item" id="ResultDateTime" style="margin-top: 20px; width: 105px; text-align: center;" name="ResultDateTime" />
        <label for="ResultDateTime" class="form_item_text"></label>
        </div>
        <div id="time2" style="float: right; width: 345px;">
        
        	<div style="text-align:center;width:350px;padding:0.5em 0;">
        		<iframe src="http://www.zeitverschiebung.net/clock-widget-iframe?language=en&timezone=Atlantic%2FReykjavik" width="100%" height="110" frameborder="0" seamless>
        		</iframe>
      		 </div>
             <p class="form_item_text" style="text-align: center; margin: 2px;">Current GMT Time</p>
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
        <p class="form_item_title">How much <b>world</b> population did each empire have?</p>
        
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
         <p class="form_item_title">How much <b>continent</b> population did each empire have?</p>
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
     
	</div> <!-- Part 1 Div -->
  </div>
</div>
</body>
</html>