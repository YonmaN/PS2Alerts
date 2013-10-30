<?php 

include ("includes/mysqlconnect.php");

$debugging = $_REQUEST["debugging"];

$world_id = $ResultServer; // Taken from Processing Script

if ($debugging == "debugging")
{
	$ResultAlertType = "Territory";
	$facility = 2;
	$continent = 2;
	$world_id = 10;
}

//  2 = Amp, 3 = Bio, 4 = Tech

if ($debugging == "")
{
	if ($ResultAlertType == "Amp") 
	{
		$facility = 2; 
	} 
	else if ($ResultAlertType == "Bio") 
	{
		$facility = 3;
	} 
	else if ($ResultAlertType == "Tech") 
	{
		$facility = 4;
	}
	else 
	{
		$facility = 0;
	}

	if ($ResultAlertCont == "Cross")
	{
		$continent = 0;
	}
	else if ($ResultAlertCont == "Indar")
	{
		$continent = 2;
	}
	else if ($ResultAlertCont == "Amerish")
	{
		$continent = 6;
	}
	else if ($ResultAlertCont == "Esamir")
	{
		$continent = 8;
	}
}
	
$last_result_query = mysql_query ("SELECT ResultID FROM results2 ORDER BY ResultID DESC LIMIT 1");
$last_result = mysql_fetch_array($last_result_query);

$ResultID = $last_result["ResultID"];

echo $ResultID;

if ($ResultAlertType != "Territory") {
	$content = file_get_contents("http://fishy.sytes.net/ps2territory.php?world=$world_id&facility=$facility", 0, null, null);
}
else {
	$content = file_get_contents("http://fishy.sytes.net/ps2territory.php?world=$world_id&continent=$continent", 0, null, null);
}

$json = json_decode($content, true);

echo '<pre>';
var_dump($json);
echo '</pre>';

$territory = $json["control-percentage"];
$facilities = $json["facilities"];

$territory_VS = intval($territory[1]);
echo '<br /> VS Territory % = '.$territory[1] * 100;
echo '<br /> NC Territory % = '.$territory[2] * 100;
echo '<br /> TR Territory % = '.$territory[3] * 100;

$total = $territory[1] + $territory[2] + $territory[3];
	
if ($debugging == "")
{
	
	if ($ResultAlertType == "Territory") 
	{
		$submit_stats = mysql_query ("INSERT INTO results_territory VALUES ($ResultID, ".$territory[1].", ".$territory[2].", ".$territory[3].") ");
	}
	
	if ($facility == 2) 
	{ // Amps
	
		$fac_peris = $facilities[0];
		$fac_dahaka = $facilities[1];
		$fac_zurvan = $facilities[2];
		$fac_kwahtee = $facilities[3];
		$fac_sungrey = $facilities[4];
		$fac_wokuk = $facilities[5];
		$fac_elli = $facilities[6];
		$fac_freyr = $facilities[7];
		$fac_nott = $facilities[8];
	
		$submit_stats = mysql_query("INSERT INTO results_amp VALUES ($ResultID, ".$fac_peris['owned_by_faction'].", ".$fac_dahaka['owned_by_faction'].", ".$fac_zurvan['owned_by_faction'].", ".$fac_kwahtee['owned_by_faction'].", ".$fac_sungrey['owned_by_faction'].", ".$fac_wokuk['owned_by_faction'].", ".$fac_elli['owned_by_faction'].", ".$fac_freyr['owned_by_faction'].", ".$fac_nott['owned_by_faction']." )");
	
	}
	
	if ($facility == 3) { // Bios
	
		$fac_allatum = $facilities[0];
		$fac_saurva = $facilities[1];
		$fac_rashnu = $facilities[2];
		$fac_ikanam = $facilities[3];
		$fac_onatha = $facilities[4];
		$fac_xelas = $facilities[5];
		$fac_andvari = $facilities[6];
		$fac_mani = $facilities[7];
		$fac_ymir = $facilities[8];
	
	$submit_stats = mysql_query("INSERT INTO results_bio VALUES ($ResultID, ".$fac_allatum['owned_by_faction'].", ".$fac_saurva['owned_by_faction'].", ".$fac_rashnu['owned_by_faction'].", ".$fac_ikanam['owned_by_faction'].", ".$fac_onatha['owned_by_faction'].", ".$fac_xelas['owned_by_faction'].", ".$fac_andvari['owned_by_faction'].", ".$fac_mani['owned_by_faction'].", ".$fac_ymir['owned_by_faction']." )");
	
	}
	
	if ($facility == 4) { // Techs
		
		$fac_hvar = $facilities[0];
		$fac_mao = $facilities[1];
		$fac_tawrich = $facilities[2];
		$fac_heyoka = $facilities[3];
		$fac_mekala = $facilities[4];
		$fac_tumas = $facilities[5];
		$fac_eisa = $facilities[6];
	
	echo "VARIABLE DEBUGGING";
	echo $fac_hvar['owned_by'];
	
	$submit_stats = mysql_query("INSERT INTO results_tech VALUES ($ResultID, ".$fac_hvar['owned_by_faction'].", ".$fac_mao['owned_by_faction'].", ".$fac_tawrich['owned_by_faction'].", ".$fac_heyoka['owned_by_faction'].", ".$fac_mekala['owned_by_faction'].", ".$fac_tumas['owned_by_faction'].", ".$fac_eisa['owned_by_faction']." )");
	
	}
	
	if (!$submit_stats) {
		die('API POLL ERROR!: ' . mysql_error() );
	}
}

?>