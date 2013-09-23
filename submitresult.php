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
animatedcollapse.addDiv('pops_world', 'fade=1,height=100px')
animatedcollapse.addDiv('pops_cont', 'fade=1,height=100px')

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

	<?php include('includes/header.php') ?>
    
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
        
        <p class="form_headers">Alert Stats Submission (Miller only for now!)</p> 
        
        <p class="form_subtitle_text">Thank you for taking the time to submit alert data for us! Every alert you can tell us about will further help our understanding of the performances of each empire during alerts on your server! <br />
          <br/>
        Please note, you can't submit another alert until two hours later, to prevent spamming and contaminating the results.</p>  
        
        <p class="form_item_title">Which server was this alert on?</p>
        <select name="ResultServer" disabled="disabled">
          <option value="1">Miller</option> 
        </select> <span class="form_item_text" style="margin-left: 5px;">(Disabled)</span>
         
   <div id="time_container" style="display: block; height: 120px;"> 
        <div id="time1" style="float: left; margin-top: 10px;">
        <p class="form_item_title">When did the Alert end? (GMT time):</p>
        <input class="form_item" style="margin-top: 15px;" type="datetime-local" name="ResultDateTime" />
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
        
        <input type="radio" name="ResultWinner" value="NC" onclick="drawterritories_enable()"  /><span class="form_item_text">New Conglomerate</span> <br />
        <input type="radio" name="ResultWinner" value="TR" onclick="drawterritories_enable()"  /><span class="form_item_text">Terran Republic</span> <br />
        <input type="radio" name="ResultWinner" value="VS" onclick="drawterritories_enable()"  /><span class="form_item_text">Vanu Soverignity</span> <br />
        <input type="radio" name="ResultWinner" value="Draw" id="draw" onclick="drawterritories_disable()" /><span class="form_item_text">Draw</span> <br />
                          
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
        
        
        
        <script>
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
        
        <script>
		
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
				TerritoryNC.disabled=true
				TerritoryTR.value ="33"
				TerritoryTR.disabled=true
				TerritoryVS.value ="33"
				TerritoryVS.disabled=true
			}
		}
		
		function drawterritories_enable()
		{
			TerritoryNC.value =""
			TerritoryNC.disabled=false
			TerritoryTR.value =""
			TerritoryTR.disabled=false
			TerritoryVS.value =""
			TerritoryVS.disabled=false
			
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
              
    <input type="submit" name="AlertStats" onclick="checkterritories()" value="Continue..." /> 
    </form>   
	</div>
</div>
</body>
</html>