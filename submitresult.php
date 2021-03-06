<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include("includes/includes.php")?>
<title>PS2 Alert Submission</title>
<script type="text/javascript">
/***********************************************
* Animated Collapsible DIV v2.4- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for this script and 100s more
***********************************************/

</script>
<script type="text/javascript">
animatedcollapse.addDiv('territory', 'fade=1,height=110px')
animatedcollapse.addDiv('pops_world', 'fade=1,height=110px')
animatedcollapse.addDiv('pops_cont', 'fade=1,height=110px')
animatedcollapse.addDiv('domination', 'fade=1,height=95px')
animatedcollapse.addDiv('duration', 'fade=1,height=80px')

animatedcollapse.ontoggle=function($, divobj, state){ //fires each time a DIV is expanded/contracted
	//$: Access to jQuery
	//divobj: DOM reference to DIV being expanded/ collapsed. Use "divobj.id" to get its ID
	//state: "block" or "none", depending on state
}

animatedcollapse.init()

</script>
<script>
function load() {
	document.getElementById("submit_part1").disabled=true // Disable Submit button until user has chosen empire and server
	<!--window.alert("There is currently an issue with the Alert Data API (as of 28/11/13). Don't worry, you can still submit alerts! You will just get an error on the next page, as the data cannot be collected. Please ignore this error! - Maelstrome") -->
	
	<!--alert("There is currently an issue with the submission script, where it displays a wall of text. Your alert will be submitted, please ignore this!"); -->
}
</script>
</head>
<?php

// Clean all variables at beginning of form and set defaults to blank, if the form is fresh
	$ResultServer = $_REQUEST["ResultServer"];
	$ResultServerSelect = $_REQUEST["ResultServerSelect"];
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
	$SubmitterIP = $_SERVER['REMOTE_ADDR'];

// Check to see if IP is banned from submitting	

$bans_query = mysql_query ("SELECT IPBanned FROM bans WHERE IPBanned = '$SubmitterIP'");
$bans = mysql_fetch_array($bans_query);

if ($bans["IPBanned"] == $SubmitterIP)
{
	header("Location: thanks.php?Message=2");
	exit;
}

// Check recent alert timer

date_default_timezone_set('GMT');

$Now = new DateTime('NOW');
$Now->sub(new DateInterval('PT1H'));
$SpamTimer = $Now->format('Y-m-d H:i:s');

$last_times_query = mysql_query("SELECT ResultServer, ResultDateTime FROM results2 WHERE ResultDateTime > '".$SpamTimer."' AND ResultServer = ".$ResultServerSelect." ");

$last_times = mysql_fetch_array($last_times_query);

if (empty($last_times)) 
{
	$SpamLimit = 0; // Allows page to be opened
} else 
{
	$SpamLimit = 1; // Restricts page
}

if ($SpamLimit == 1)
{
	header("Location: thanks.php?Message=1"); /* Redirect browser */
	exit();
}

$SelfPost_error = $_REQUEST["SelfPost_error"];
if ($SelfPost == "true")
{
	echo '<body>';
}
else if ($SelfPost_error == "")
{
	echo '<body onload="load()">';
}
?>
<div id="wrapper">
	<?php include('includes/header.php') ?>
	<div class="content" id="content">
		<script type="text/javascript">
  $(function() {
    $('#ResultDateTime').datetimepicker({
	timeFormat: 'HH:mm',
	dateFormat: 'yy-mm-dd',
	showButtonPanel: false,
	maxDate: 0,
	minDate: -1,
	timezone: '-0100',
	pickerTimeSuffix: ' UTC'
	
});
	$( "#ResultDominationDuration" ).timepicker({
	hourMax: 1,
	showButtonPanel: false
	});
  });
</script>
		<form action="submitresult_process.php" id="form" method="post" onSubmit="return (checkterritories() && checkpops() && checkempires() )" name="AlertStats">
			<p class="form_headers">Alert Statistics Submission</p>
			<p class="form_subtitle_text">Thank you for taking the time to submit alert data for us! Every alert you can tell us about will further help our understanding of the performances of each empire during alerts on your server! <br />
				<br/>
				Please note, you can't submit another alert until an hour later, to prevent spamming and contaminating the results.</p>
			<p class="form_item_title">Which server was this alert on?</p>
			<select name="ResultServerSelect" id="ResultServerSelect" onChange="lastAlertCheck();" >
				<?php if ($ResultServerSelect == '') {echo '<option value="Select">Select Server</option>';} ?>
				<option value="25" <?php if ($ResultServerSelect == 25) {echo "selected='selected'"; } ?>>Briggs</option>
				<option value="11" <?php if ($ResultServerSelect == 11) {echo "selected='selected'"; } ?>>Ceres</option>
				<option value="13" <?php if ($ResultServerSelect == 13) {echo "selected='selected'"; } ?>>Cobalt</option>
				<option value="1" <?php if ($ResultServerSelect == 1) {echo "selected='selected'"; } ?>>Connery</option>
				<option value="17" <?php if ($ResultServerSelect == 17) {echo "selected='selected'"; } ?>>Mattherson</option>
				<option value="10" <?php if ($ResultServerSelect == 10) {echo "selected='selected'"; } ?>>Miller</option>
				<option value="18" <?php if ($ResultServerSelect == 18) {echo "selected='selected'"; } ?>>Waterson</option>
				<option value="9" <?php if ($ResultServerSelect == 9) {echo "selected='selected'"; } ?>>Woodman</option>
			</select>
			<input type="hidden" name="ResultServer" value="<?php echo $ResultServerSelect; ?>">
			
			<script type="text/javascript">
			
			function lastAlertCheck()
			{
				ResultServerValue = document.getElementById("ResultServerSelect").value
				
				this.document.location.href = "submitresult.php?ResultServerSelect="+ResultServerValue+"&SelfPost_error=submitted";
				
				$("#ResultServerSelect option[value='Select']").remove();
				document.getElementById("submit_part1").disabled=false;
			}
						
			</script>
			<div id="time_container" style="display: block; height: 100px;">
				<div id="time1" style="float: left; margin-top: 10px;">
					<p class="form_item_title">When did the Alert end? (UTC time)</p>
					<input class="form_item" id="ResultDateTime" style="margin-top: 10px; margin-right: 10px; width: 120px; text-align: center;" name="ResultDateTime" required />
					<label for="ResultDateTime" class="form_item_text"></label>
				</div>
				<div id="time2">
					<iframe src="http://free.timeanddate.com/clock/i3tjjso2/tluk/fn17/fs22/fcfff/tct/pct/tt0/tw0/tm3/ts1/ta1" frameborder="0" width="269" height="28" allowTransparency="true"></iframe>
					<p class="form_item_text" style="text-align: center; margin: 2px; font-size: 16px;">Current UTC Time</p>
				</div>
			</div>
			<div class="question" id="alert_won">
				<p class="form_item_title">Who won this alert?</p>
				<p class="form_item_title" style="font-size: 13px; color: #fff;">If the alert was a draw, please select the factions that drew together.</p>
				<input type="checkbox" class="checkboxes" id="win1" name="rNC" onClick="dominationcheck(), lockterritory(), threewayTech()" />
				<span class="form_item_text">New Conglomerate</span><br />
				<input type="checkbox" class="checkboxes" id="win2" name="rTR" onClick="dominationcheck(), lockterritory(), threewayTech()" />
				<span class="form_item_text">Terran Republic</span><br />
				<input type="checkbox" class="checkboxes" id="win3" name="rVS" onClick="dominationcheck(), lockterritory(), threewayTech()" />
				<span class="form_item_text">Vanu Soverignity</span><br />
				<label for="checkboxes" class="error"></label>
			</div>
			<script>
		function dominationcheck() 
		{
			var valid = 0
			win1 = document.getElementById("win1");
			win2 = document.getElementById("win2");
			win3 = document.getElementById("win3");
			
			if ((win1.checked == false) && (win2.checked == false) && (win3.checked == false))
			{
				disabledomination();
				valid = 0
			}
							
			if ((win1.checked == true) && (win2.checked == false) && (win3.checked == false))
			{
				enabledomination();
				valid = 1
				document.getElementById("submit_part1").disabled=false

			} else if ((win1.checked == true) && (win2.checked == true || win3.checked == true))
			{
				disabledomination();
				document.getElementById("submit_part1").disabled=false
				valid = 1
			}
			
			if ((win1.checked == false) && (win2.checked == true) && (win3.checked == false))
			{
				enabledomination();
				document.getElementById("submit_part1").disabled=false
				valid = 1
			} else if ((win2.checked == true) && (win1.checked == true || win3.checked == true))
			{
				disabledomination();
				document.getElementById("submit_part1").disabled=false
				valid = 1
			}
			
			if ((win1.checked == false) && (win2.checked == false) && (win3.checked == true))
			{
				enabledomination();
				document.getElementById("submit_part1").disabled=false
				valid = 1
			} else if ((win3.checked == true) && (win1.checked == true || win2.checked == true))
			{
				disabledomination();
				document.getElementById("submit_part1").disabled=false
				valid = 1
			}
			
			if (valid == 0) {
				window.alert("You need to select at least one empire!");
				document.getElementById("submit_part1").disabled=true // Disable Submit button until user has chosen empire
				return false
			}
			
		}
		
		function lockterritory() 
		{
			win1 = document.getElementById("win1");
			win2 = document.getElementById("win2");
			win3 = document.getElementById("win3");
			TerritoryVS = document.getElementById("TerritoryVS");
			TerritoryTR = document.getElementById("TerritoryTR");
			TerritoryNC = document.getElementById("TerritoryNC");
			ResultDomination1 = document.getElementById("ResultDomination1");
			ResultDomination2 = document.getElementById("ResultDomination2");

		// Do a check to see if the Domination option has been unchecked. If so, wipe the rules.
		
		if (ResultDomination2.checked == true) // Domination = NO
		{
			TerritoryVS.disabled = false;
			TerritoryTR.disabled = false;
			TerritoryNC.disabled = false;
			TerritoryVS.value = "";
			TerritoryTR.value = "";
			TerritoryNC.value = "";
		}
		
		if (ResultDomination1.checked == true) // Domination = YES
			{
				if ((win1.checked == false) && (win2.checked == false) && (win3.checked == false)) 
				{
					TerritoryVS.disabled = false;
					TerritoryTR.disabled = false;
					TerritoryNC.disabled = false;
				}
				
				if ((win1.checked == true) && (win2.checked == false) && (win3.checked == false)) // NC Win
				{
					TerritoryVS.disabled = false;
					TerritoryTR.disabled = false;
					TerritoryNC.disabled = true;
					TerritoryNC.value = 75;
					TerritoryTR.value = "";
					TerritoryVS.value = "";
				} 
				if ((win1.checked == false) && (win2.checked == true) && (win3.checked == false)) // TR Win
				{
					TerritoryVS.disabled = false;
					TerritoryTR.disabled = true;
					TerritoryNC.disabled = false;
					TerritoryNC.value = "";
					TerritoryTR.value = 75;
					TerritoryVS.value = "";
				} 
				if ((win1.checked == false) && (win2.checked == false) && (win3.checked == true)) // VS Win
				{
					TerritoryVS.disabled = true;
					TerritoryTR.disabled = false;
					TerritoryNC.disabled = false;
					TerritoryNC.value = "";
					TerritoryTR.value = "";
					TerritoryVS.value = 75;
				} 
				
				
				if ((win1.checked == true) && (win2.checked == true) && (win3.checked == true)) 
				{
					TerritoryVS.disabled = true;
					TerritoryTR.disabled = true;
					TerritoryNC.disabled = true;
					TerritoryVS.value = 33;
					TerritoryTR.value = 33;
					TerritoryNC.value = 33;
				}
			}
		}
		
		</script>
			<?php               
                
              ?>
			  
			  <script type="text/javascript">
			  function checkempires()
			  {
				  NC = document.getElementById("win1");
				  TR = document.getElementById("win2");
				  VS = document.getElementById("win3");
				
				if ((NC.checked == false) && (TR.checked == false) && (VS.checked == false))
				{
					window.alert("No empire selected!");
					return false
					
				}
				else 
				{
					return true
				}				  
			  } 
			  
			  </script>
			<div class="subquestion" id="domination">
				<p class="form_item_title">Did the faction win the alert by Domination?</p>
				<input type="radio" id="ResultDomination1" name="ResultDomination" value="1" onClick="enabledominationsub(), enabledomination(), lockterritory()" />
				<span class="form_item_text">Yes</span> <br />
				<input type="radio" id="ResultDomination2" name="ResultDomination" value="0" onClick="disabledominationsub(), disabledominationsub(), lockterritory()" />
				<span class="form_item_text">No</span> <br />
				<div id="DomDur" class="error-side" style="margin-top: -33px;">
					<label for="ResultDomination" class="error"></label>
				</div>
			</div>
			<script>
		
		function wipeterritorylocks()
		{
			TerritoryVS = document.getElementById("TerritoryVS");
			TerritoryTR = document.getElementById("TerritoryTR");
			TerritoryNC = document.getElementById("TerritoryNC");
			
			TerritoryVS.disabled = false;
			TerritoryTR.disabled = false;
			TerritoryNC.disabled = false;
			TerritoryVS.value = "";
			TerritoryTR.value = "";
			TerritoryNC.value = "";
			
		}
		function disabledomination()
		{
			document.getElementById("ResultDominationDuration").value=""
			document.getElementById("ResultDominationDuration").disabled=true
			document.getElementById("ResultDomination1").disabled=true
			document.getElementById("ResultDomination2").disabled=true
			document.getElementById("ResultDomination1").checked=false
			document.getElementById("ResultDomination2").checked=false
			animatedcollapse.hide('duration')
			animatedcollapse.hide('domination')
			$( "#ResultDomination1" ).rules( "remove" );
			$( "#ResultDomination2" ).rules( "remove" );
			wipeterritorylocks()
		}
		
		function disabledominationsub()
		{
			document.getElementById("ResultDominationDuration").value=""
			document.getElementById("ResultDominationDuration").disabled=true
			animatedcollapse.hide('duration')
			$( "#ResultDominationDuration" ).rules( "remove" );
		}	
		
		function enabledominationsub()
		{
			$( "#ResultDominationDuration" ).rules( "add", {
  				required: true
			});
			document.getElementById("ResultDominationDuration").disabled=false;
			animatedcollapse.show('duration');
		}
		function enabledomination()
		{
			document.getElementById("ResultDomination1").disabled=false
			document.getElementById("ResultDomination2").disabled=false
			animatedcollapse.show('domination');
			
			$( "#ResultDomination1" ).rules( "add", {
  				required: true
			});
			$( "#ResultDomination1" ).rules( "add", {
  				required: true
			});
		}
		
		function disableTech()
		{
			document.getElementById("AlertTech").disabled = true
			document.getElementById("AlertTech").checked = false
			document.getElementById("TechPlantSpan").className = "strike";
		}
		
		function enableTech()
		{
			document.getElementById("AlertTech").disabled = false
			document.getElementById("TechPlantSpan").className = "form_item_text";
		}
		
		function threewayTech() 
		{
			win1 = document.getElementById("win1");
			win2 = document.getElementById("win2");
			win3 = document.getElementById("win3");
			XCont = document.getElementById("XCont");
			
			if ((win1.checked == true) && (win2.checked == true) && (win3.checked == true) && (XCont.checked == true))
			{
				disableTech();
			} 
			else if ((win1.checked == false) || (win2.checked == false) || (win3.checked == false) || (XCont.checked == false))
			{
				enableTech();
			}
		}
		
		</script>
			<div class="subquestion" id="duration">
				<p class="form_item_title">How much time was there left in this alert?</p>
				<input type="text" id="ResultDominationDuration" style="width: 50px; text-align: center;" name="ResultDominationDuration" />
				<span class="form_item_text" style="margin-left: 5px;">Hours</span>
				<div id="DomDur" class="error-side">
					<label for="ResultDominationDuration" class="error"></label>
				</div>
			</div>
			<div class="question" id="alert_loc">
				<p class="form_item_title">On which contient did the alert take place? </p>
				<input type="radio" name="ResultAlertCont" value="Amerish" onClick="reenableIfNotCross(), animatedcollapse.show('pops_cont'), animatedcollapse.hide('pops_world'), wipepopsworld(), threewayTech()" required/>
				<span class="form_item_text">Amerish</span> <br />
				<input type="radio" name="ResultAlertCont" value="Esamir" onClick="reenableIfNotCross(), animatedcollapse.show('pops_cont'), animatedcollapse.hide('pops_world'), wipepopsworld(), threewayTech()" required />
				<span class="form_item_text">Esamir</span><br />
				<input type="radio" name="ResultAlertCont" value="Indar" onClick="reenableIfNotCross(), animatedcollapse.show('pops_cont'), animatedcollapse.hide('pops_world'), wipepopsworld(), threewayTech()" required />
				<span class="form_item_text">Indar</span><br />
				<input type="radio" id="XCont" name="ResultAlertCont" value="Cross" onClick="disableIfCross(), animatedcollapse.hide('territory'), animatedcollapse.show('pops_world'), animatedcollapse.hide('pops_cont'), wipepopscont(), wipevaluesterritory(), threewayTech()" required />
				<span class="form_item_text">Cross Continent (All three)</span> <br />
				<label for="ResultAlertCont" class="error"></label>
			</div>
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
						<td class="form_item_text" width="50">VS</td>
						<td class="form_item_text" width="50">TR</td>
						<td class="form_item_text" width="50">NC</td>
					</tr>
					<tr>
						<td><input class="two" type="text" id="pops_w_vs" name="ResultPopsVS" required /></td>
						<td><input class="two" type="text" id="pops_w_tr" name="ResultPopsTR" required /></td>
						<td><input class="two" type="text" id="pops_w_nc" name="ResultPopsNC" required /></td>
					</tr>
				</table>
				<div id="popswarningw" class="error-side">
					<label for="ResultPops" class="error"></label>
				</div>
			</div>
			<div class="subquestion" id="pops_cont">
				<p class="form_item_title">How much <b>continent</b> population % did each empire have?</p>
				<table width="150" border="0" style="text-align: center;">
					<tr>
						<td class="form_item_text" width="50">VS</td>
						<td class="form_item_text" width="50">TR</td>
						<td class="form_item_text" width="50">NC</td>
					</tr>
					<tr>
						<td><input class="two" type="text" id="pops_c_vs" name="ResultPopsVS" required /></td>
						<td><input class="two" type="text" id="pops_c_tr" name="ResultPopsTR" required /></td>
						<td><input class="two" type="text" id="pops_c_nc" name="ResultPopsNC" required /></td>
					</tr>
				</table>
				<div id="popswarningc" style="margin-left: 150px; margin-top: -27px;">
					<label for="ResultPops" class="error"></label>
				</div>
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
			<div class="question" id="alert_type">
				<p class="form_item_title">What kind of alert was this?</p>
				
				<!-- Based on the continant answer and this answer, PHP will change the submitted variable to be the proper one into the database -->
				
				<input type="radio" name="ResultAlertType" value="Amp" onClick="javascript:animatedcollapse.hide('territory'), wipevaluesterritory()" required/>
				<span class="form_item_text">Amp Stations </span> <br />
				<input type="radio" name="ResultAlertType" value="Bio" onClick="javascript:animatedcollapse.hide('territory'), wipevaluesterritory()" required />
				<span class="form_item_text">Bio Labs</span> <br />
				<input type="radio" id="AlertTech" name="ResultAlertType" value="Tech" onClick="javascript:animatedcollapse.hide('territory'), wipevaluesterritory(), checktechplantdraw()" required />
				<span id="TechPlantSpan" class="form_item_text">Tech Plants </span> <br />
				<input type="radio" name="ResultAlertType" value="Territory" id="TypeTerritory" 
			onClick="animatedcollapse.show('territory'), lockterritory(), enableterritoryvalues()" required />
				<span id="territory_text" class="form_item_text">Territory Capture </span> <br />
				<label for="ResultAlertType" class="error"></label>
			</div>
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
			if (document.getElementById("ResultDomination1").checked == true)
			{
				lockterritory()
			} else {
				document.getElementById("TerritoryNC").disabled=false
				document.getElementById("TerritoryTR").disabled=false
				document.getElementById("TerritoryVS").disabled=false
			}
		}
		
		function checkterritories()
		{
			var TerritoryOption = document.getElementById("TypeTerritory")
			var TerritoryNCString = document.getElementById("TerritoryNC").value
			var TerritoryTRString = document.getElementById("TerritoryTR").value
			var TerritoryVSString = document.getElementById("TerritoryVS").value
			TerritoryNC = parseInt (TerritoryNCString)
			TerritoryTR = parseInt (TerritoryTRString)
			TerritoryVS = parseInt (TerritoryVSString)
			
			if (TerritoryOption.checked == false) 
			{
				return true
			}
			
			if ((TerritoryNC + TerritoryTR + TerritoryVS < 97) && (TerritoryOption.checked == true))
			{
				window.alert("Territories do not match! The values submitted are too low! Please check the territory percentages and try again.");
				document.getElementById("TerritoryError").className = "error-side";
				return false
				
			} else if ((TerritoryNC + TerritoryTR + TerritoryVS > 100) && (TerritoryOption.checked == true))
			{
				window.alert("Territories do not match up to 100% - Too high! Please check the territory percentages and try again.");
				document.getElementById("TerritoryError").className = "error-side";
				return false
			} 
			else if ((TerritoryNC + TerritoryTR + TerritoryVS == 100) || (TerritoryNC + TerritoryTR + TerritoryVS == 99) && (TerritoryOption.checked == true))
			{
				return true
			}
		}
		
		function checkpops()
		{
			var XCont = document.getElementById("XCont")
			
			var popsWVSString = document.getElementById("pops_w_vs").value
			var popsWTRString = document.getElementById("pops_w_tr").value
			var popsWNCString = document.getElementById("pops_w_nc").value
			popsWVS = parseInt (popsWVSString)
			popsWTR = parseInt (popsWTRString)
			popsWNC = parseInt (popsWNCString)
			
			var popsCVSString = document.getElementById("pops_c_vs").value
			var popsCTRString = document.getElementById("pops_c_tr").value
			var popsCNCString = document.getElementById("pops_c_nc").value
			popsCVS = parseInt (popsCVSString)
			popsCTR = parseInt (popsCTRString)
			popsCNC = parseInt (popsCNCString)
			
			if (XCont.checked == true) // If Cross Continent
			{
				if (popsWVS + popsWTR + popsWNC < 98)
				{
					window.alert("Populations do not add up to 98%, 99% or 100%! The values you entered are too low (below 99%). Please check the populations!")
					popsWVSString = ""
					popsWTRString = ""
					popsWNCString = ""
					return false
					
				} else if (popsWVS + popsWTR + popsWNC > 100)
				{
					window.alert("Populations do not add up to 99% or 100%! The values you entered are too high (over 100%). Please check the populations!")
					popsWVSString = ""
					popsWTRString = ""
					popsWNCString = ""
					return false
				} else 
					{
						return true
					}
				
			} else if (XCont.checked == false) // If a continental alert
			{
				if (popsCVS + popsCTR + popsCNC < 98)
				{
					window.alert("Populations do not add up to 98%, 99% or 100%! The values you entered are too low (below 99%). Please check the populations!")
					popsCVSString = ""
					popsCTRString = ""
					popsCNCString = ""
					return false
					
				} else if (popsCVS + popsCTR + popsCNC > 100)
				{
					window.alert("Populations do not add up to 99% or 100%! The values you entered are too high (over 100%). Please check the populations!")
					popsCVSString = ""
					popsCTRString = ""
					popsCNCString = ""
					return false
				} else 
					{
						return true
					}
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
			<br />
			<input type="submit" id="submit_part1" name="AlertStats" value="Continue..." />
		</form>
		<script type="text/javascript">

	$("#form").validate({
		groups: {
			ResultPops: "ResultPopsNC ResultPopsTR ResultPopsVS",
			ResultTerritory: "ResultTerritoryNC ResultTerritoryTR ResultTerritoryVS"
		}
		
	});
	
	</script>
	</div>
	<!-- Part 1 Div End -->
</div>
</body>
</html>