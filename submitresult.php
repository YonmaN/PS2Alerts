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
	document.getElementById("submit_part1").disabled=true // Disable Submit button until user has chosen empire
}
</script>
</head>
<?php $SelfPost = $_POST["SelfPost"]; 

// Clean all variables at beginning of form and set defaults to blank, if the form is fresh
if ($SelfPost == '') {
	$ResultServer = $_REQUEST["ResultServer"];; 
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
	$ResultServer = $_POST["ResultServer"];
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
	

// Check recent alert timer

date_default_timezone_set('GMT');

$Now = new DateTime('NOW');
$Now->sub(new DateInterval('PT1H'));
$SpamTimer = $Now->format('Y-m-d H:i:s');

$last_times_query = mysql_query("SELECT ResultServer, ResultDateTime FROM results2 WHERE ResultDateTime > '".$SpamTimer."' AND ResultServer = ".$ResultServer." ");

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
?>
<body>
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
		<?php if ($SelfPost == "true") {
            echo '<div id="partone" style="display:none">';
        } else {
            echo '<div id="partone">';
        } 
		
        ?>
		<form action="submitresult.php" id="form" method="post" onSubmit="return (checkterritories() && checkpops() )" name="AlertStats">
			<p class="form_headers">Alert Statistics Submission</p>
			<p class="form_subtitle_text">Thank you for taking the time to submit alert data for us! Every alert you can tell us about will further help our understanding of the performances of each empire during alerts on your server! <br />
				<br/>
				Please note, you can't submit another alert until an hour later, to prevent spamming and contaminating the results.</p>
			<p class="form_item_title">Which server was this alert on?</p>
			<select name="ResultServer" id="ResultServer" onChange="lastAlertCheck();" >
				<?php if ($ResultServer == '') {echo '<option value="Select">Select Server</option>';} ?>
				<option value="25" <?php if ($ResultServer == 25) {echo "selected='selected'"; } ?>>Briggs</option>
				<option value="11" <?php if ($ResultServer == 11) {echo "selected='selected'"; } ?>>Ceres</option>
				<option value="13" <?php if ($ResultServer == 13) {echo "selected='selected'"; } ?>>Cobalt</option>
				<option value="1" <?php if ($ResultServer == 1) {echo "selected='selected'"; } ?>>Connery</option>
				<option value="17" <?php if ($ResultServer == 17) {echo "selected='selected'"; } ?>>Mattherson</option>
				<option value="10" <?php if ($ResultServer == 10) {echo "selected='selected'"; } ?>>Miller</option>
				<option value="18" <?php if ($ResultServer == 18) {echo "selected='selected'"; } ?>>Waterson</option>
				<option value="9" <?php if ($ResultServer == 9) {echo "selected='selected'"; } ?>>Woodman</option>
			</select>
			
			<script type="text/javascript">
			
			function lastAlertCheck()
			{
				ResultServerValue = document.getElementById("ResultServer").value
				
				this.document.location.href = "submitresult.php?ResultServer="+ResultServerValue+"";
				
				$("#ResultServer option[value='Select']").remove();
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
				<input type="checkbox" class="checkboxes" id="win1" name="rNC" onClick="dominationcheck(), lockterritory(), checktechplantdraw()" />
				<span class="form_item_text">New Conglomerate</span><br />
				<input type="checkbox" class="checkboxes" id="win2" name="rTR" onClick="dominationcheck(), lockterritory(), checktechplantdraw()" />
				<span class="form_item_text">Terran Republic</span><br />
				<input type="checkbox" class="checkboxes" id="win3" name="rVS" onClick="dominationcheck(), lockterritory(), checktechplantdraw()" />
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
				<input type="radio" name="ResultAlertCont" value="Amerish" onClick="reenableIfNotCross(), animatedcollapse.show('pops_cont'), animatedcollapse.hide('pops_world'), wipepopsworld()" required/>
				<span class="form_item_text">Amerish</span> <br />
				<input type="radio" name="ResultAlertCont" value="Esamir" onClick="reenableIfNotCross(), animatedcollapse.show('pops_cont'), animatedcollapse.hide('pops_world'), wipepopsworld()" required />
				<span class="form_item_text">Esamir</span><br />
				<input type="radio" name="ResultAlertCont" value="Indar" onClick="reenableIfNotCross(), animatedcollapse.show('pops_cont'), animatedcollapse.hide('pops_world'), wipepopsworld()" required />
				<span class="form_item_text">Indar</span><br />
				<input type="radio" id="XCont" name="ResultAlertCont" value="Cross" onClick="disableIfCross(), animatedcollapse.hide('territory'), animatedcollapse.show('pops_world'), animatedcollapse.hide('pops_cont'), wipepopscont(), wipevaluesterritory()" required />
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
				<span class="form_item_text">Tech Plants </span> <br />
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
		
		function checktechplantdraw() // Since a 3 way tech plant alert is not possible (7 is not divisiable by 3), prevent it from being selected.
		{
			win1 = document.getElementById("win1");
			win2 = document.getElementById("win2");
			win3 = document.getElementById("win3");
			tech = document.getElementById("AlertTech")
			cont = document.getelementbyid("XCont")
			
			if ((win1.checked == true) && (win2.checked == true) && (win3.checked == true) && (tech.checked == true ) && (cont.checked == false))
			{
				window.alert("A three way draw is not possible with Tech Plant alerts. Please re-choose the winners.");
				win1.checked = false;
				win2.checked = false;
				win3.checked = false;
				disabledomination()
				return false
			}
		}
		</script>
			<div id="territory" class="subquestion">
				<p class="form_item_title">How much territory % did each empire control?</p>
				<table width="150" border="0" style="text-align: center;">
					<tr>
						<td class="form_item_text" width="50">VS</td>
						<td class="form_item_text" width="50">TR</td>
						<td class="form_item_text" width="50">NC</td>
					</tr>
					<tr>
						<td><input class="two" type="text" name="ResultTerritoryVS" id="TerritoryVS" required /></td>
						<td><input class="two" type="text" name="ResultTerritoryTR" id="TerritoryTR" required /></td>
						<td><input class="two" type="text" name="ResultTerritoryNC" id="TerritoryNC" required /></td>
					</tr>
				</table>
				<div id="TerritoryError" class="error-side" style="margin-top: -28px;">
					<label for="ResultTerritory" class="error"></label>
				</div>
			</div>
			<br />
			<input type="hidden" name="SelfPost" value="true" />
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
	
	<?php if ($SelfPost == "true") {
            echo '<div id="parttwo" style="display:block">';
        } else {
            echo '<div id="parttwo" style="display:none">';
        }
   	
	// PART 2 POST PROCESSING
	// New database structure processing
	
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
	
	// Append seconds to Domination timer and Alert Timer
	
	if ($ResultDominationDurationPre == "") { // If no domination timer was chosen, leave NULL
		$ResultDominationDuration = "00:00:00";
	} else {
		$ResultDominationDuration = $ResultDominationDurationPre.':00';
	}
	$ResultDateTime = $ResultDateTimePre.':00';
	?>
	<form action="submitresult_process.php" method="post" name="AlertStats2">
		<?php 
		if ($SelfPost == "12345") {
		echo '<div class="form_item_text" id="debug">';
			echo 'DEBUGGING </br>';
			echo "<pre>";
			var_dump($_POST);
			echo "</pre>";
			
			echo '<p class="form_item_text">Domination Before: '.$ResultDominationDurationPre.'</p>';
			
			echo '</br> Master Alert Type: ';
			echo $ResultAlertMasterType;
			
			echo '<br /> NC Win:';
			echo $winNC;
			echo '<br /> TR Win:';
			echo $winTR;
			echo '<br /> VS Win:';
			echo $winVS;
			echo '<br /> Draw:';
			echo $ResultDraw;
		
		echo '</div>';
	}	
	
	?>
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
		//echo '<p class="form_item_text">DOMINATION</p>';
		
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
		<br />
		<input type="Submit" name="AlertStats2" value="Submit The Data!" />
	</form>
	</div> <!-- End of Part 2 DIV -->
</div>
</body>
</html>