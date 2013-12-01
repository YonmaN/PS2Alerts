<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include("includes/includes.php")?>
<title>Report an alert in progress!</title>
<script>
function load() {
	document.getElementById("submit_part1").disabled=true // Disable Submit button until user has chosen empire and server
	<!--window.alert("There is currently an issue with the Alert Data API (as of 28/11/13). Don't worry, you can still submit alerts! You will just get an error on the next page, as the data cannot be collected. Please ignore this error! - Maelstrome") -->
	
	<!--alert("There is currently an issue with the submission script, where it displays a wall of text. Your alert will be submitted, please ignore this!"); -->
}
</script>
</head>
<?php

$subheader = 1;

// Clean all variables at beginning of form and set defaults to blank, if the form is fresh
	$ResultServerSelect = $_REQUEST["ResultServerSelect"];
	$reportTime = ''; 
	$reportCont = '';
	$reportType = '';
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

$last_times_query = mysql_query("SELECT reportServer, reportTime FROM alert_reports WHERE reportTime > '".$SpamTimer."' AND reportServer = ".$ResultServerSelect."");

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
    $('#reportTime').timepicker({
	timeFormat: 'HH:mm:ss',
	showButtonPanel: false,
	hourMax: 1
	
});
  });
</script>

		<form action="alertreport_process.php" id="form" method="post" name="AlertReport">
			<p class="form_headers">Ongoing Alert Report</p>
			<p class="form_subtitle_text" style="text-align: center;">Are you witnessing an alert happening? Tell us about it!</p>
			<p class="form_item_title">Which server is this alert on?</p>
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
			<input type="hidden" name="reportServer" value="<?php echo $ResultServerSelect; ?>">
			
			<script type="text/javascript">
			
			function lastAlertCheck()
			{
				ResultServerValue = document.getElementById("ResultServerSelect").value
				
				this.document.location.href = "alertreport.php?ResultServerSelect="+ResultServerValue+"&SelfPost_error=submitted";
				
				$("#ResultServerSelect option[value='Select']").remove();
				document.getElementById("submit_part1").disabled=false;
			}
						
			</script>
			<div id="time_container" style="display: block; height: 120px;">
				<div id="time1" style="float: left; margin-top: 10px;">
					<p class="form_item_title">How long is there remaining on this alert?</p>
					<p class="form_item_title" style="font-size:12; color:#fff;">Alt-tab into the game to find out!</p>
					<input class="form_item" id="reportTime" style="margin-top: 10px; margin-right: 10px; width: 60px; text-align: center;" name="reportTime" required />
					<label for="reportTime" class="form_item_text"></label>
				</div>
			</div>
			<div class="question" id="alert_loc">
				<p class="form_item_title">On which contient is the alert taking place? </p>
				<input type="radio" name="reportCont" value="Amerish" onClick="reenableIfNotCross()" required/>
				<span class="form_item_text">Amerish</span> <br />
				<input type="radio" name="reportCont" value="Esamir" onClick="reenableIfNotCross()" required />
				<span class="form_item_text">Esamir</span><br />
				<input type="radio" name="reportCont" value="Indar" onClick="reenableIfNotCross()" required />
				<span class="form_item_text">Indar</span><br />
				<input type="radio" id="XCont" name="reportCont" value="Cross" onClick="disableIfCross()" required />
				<span class="form_item_text">Cross Continent (All three)</span> <br />
				<label for="reportCont" class="error"></label>
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
				<p class="form_item_title">What kind of alert is this?</p>
				
				<!-- Based on the continant answer and this answer, PHP will change the submitted variable to be the proper one into the database -->
				
				<input type="radio" name="reportType" value="Amp" required/>
				<span class="form_item_text">Amp Stations </span> <br />
				<input type="radio" name="reportType" value="Bio" required />
				<span class="form_item_text">Bio Labs</span> <br />
				<input type="radio" id="AlertTech" name="reportType" value="Tech" required />
				<span id="TechPlantSpan" class="form_item_text">Tech Plants </span> <br />
				<input type="radio" name="reportType" value="Territory" id="TypeTerritory" required />
				<span id="territory_text" class="form_item_text">Territory Capture </span> <br />
				<label for="ResultAlertType" class="error"></label>
			</div>	
			<input type="submit" id="submit_part1" name="AlertStats" value="Continue..." />
		</form>
	</div>
	<!-- Part 1 Div End -->
	<?php include("includes/footer.php"); ?>
</div>
</body>
</html>