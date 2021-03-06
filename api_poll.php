<?php 

include ("includes/mysqlconnect.php");

$mode = "";
$debug = $_REQUEST["debug"];
$import = $_POST["import"];

echo 'MODE = '.$mode;

if ($import == "import") // Set up API Poll Script to insert data into the database using the ResultID supplied by the Import Script
{
	echo '<a href="api_input.php"><<<<<-----BACK TO INPUT</a>';
	$mode = "";
	$ResultID = $_POST["ResultID"];
	$grab_info_query = mysql_query("SELECT * FROM results2 WHERE ResultID = $ResultID");
	$grab_info = mysql_fetch_array($grab_info_query);
	
	$world_id = $grab_info["ResultServer"];
	$ResultDateTime = $grab_info["ResultDateTime"];
	$ResultAlertCont = $grab_info["ResultAlertCont"];
	$ResultAlertType = $grab_info["ResultAlertType"];
	$ResultDomination = $grab_info["ResultDomination"];
	$ResultDominationDuration = $grab_info["ResultDominationDuration"];
	
	list($hours,$mins,$secs) = explode(':',$ResultDominationDuration);
	$ResultDominationDuration_formatted = mktime($hours,$mins,$secs) - mktime(0,0,0);
	echo '<br />UNIX Duration: '.$ResultDominationDuration_formatted;
	echo '<br />';
}


if ($import == "") // If not importing
{
	$last_id_query = mysql_query("SELECT ResultID FROM results2 ORDER BY ResultID DESC LIMIT 1");
	$last_id = mysql_fetch_array($last_id_query);
	
	$ResultID = $last_id["ResultID"];
	//$ResultAlertType = $_POST["ResultAlertType"];
	//$ResultAlertCont = $_POST["ResultAlertCont"];
	$ResultDateTime = $_POST["ResultDateTime"];
	$world_id = $_POST["ResultServer"];
	
	// DOMINATION
	
	list($hours,$mins,$secs) = explode(':',$ResultDominationDuration);
	$ResultDominationDuration_formatted = mktime($hours,$mins,$secs) - mktime(0,0,0);
	echo '<br />UNIX Duration: '.$ResultDominationDuration_formatted;
	echo '<br />';
	
}

if ($debug == "debug")
{
	//$ResultDateTime = date("Y-m-d H:i:s");
	$ResultDateTime = "2013-11-13 05:00:00";
	
	$ResultAlertCont = "Cross";
	$ResultAlertType = "Tech";
	$ResultDomination = "1";
	$world_id = '10';
	$ResultDominationDuration = "01:00:00";
	//$ResultDominationDuration_formatted = strtotime($ResultDominationDuration);
	
	list($hours,$mins,$secs) = explode(':',$ResultDominationDuration);
	$ResultDominationDuration_formatted = mktime($hours,$mins,$secs) - mktime(0,0,0);
}

	// Calculate time based on Alert Type and date given
	
	if (($ResultAlertCont != "Cross") && ($ResultAlertType != "Territory")) // If facility alert on one continent (1 hour duration)
	{
		if ($ResultDomination == "0") 
		{		
			$duration = 3600 ; // 1 hour minutes for Database Script
			echo '<br />Duration (Domination): '.$duration;
			echo '<br />Formatted duration: '.$ResultDominationDuration_formatted;
		} 
		else if ($ResultDomination == "1")
		{
			$duration =  3900 - $ResultDominationDuration_formatted; // 1 hour plus 5 minutes for Database Script
			echo '<br />Duration (Domination): '.$duration;
			echo '<br />Formatted duration: '.$ResultDominationDuration_formatted;
		}
	} 
	else // Else if Cross continent, any type
	{
		if ($ResultDomination == "0") 
		{		
			$duration = 7200 ; 
			echo '<br />Duration (Domination): '.$duration;
			echo '<br />Formatted duration: '.$ResultDominationDuration_formatted;
		} 
		else if ($ResultDomination == "1")
		{
			$duration =  7500 - $ResultDominationDuration_formatted; // 1 hour plus 5 minutes for Database Script
			echo '<br />Duration (Domination): '.$duration;
			echo '<br />Formatted duration: '.$ResultDominationDuration_formatted;
		}
	}	
	
	echo '<br />RESULT ID: <a href="alertdetail.php?AlertID='.$ResultID.'">'.$ResultID.'</a>';
	
	$UNIX = strtotime($ResultDateTime) + 300; // Convert recorded end of result to UNIX time (4:59 minutes)
	echo '<br />UNIX END TIME: '.$UNIX;
	$time = $UNIX + 10800 - $duration; // Plus 300 seconds for Data End overlap
	
	// For some reason, the ResultDateTime is behind by 3 hours (10800 secs)?? WTF???
	
	echo '<br />UNIX START TIME: '.$time;
//}

// Set up varaibles based on inputs

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
		$facility = 0; // For territory Alerts
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
	
	echo '<br />---------------------- INPUTS AFTER FILTER -------------------- <br />';
	echo 'Alert Type = '.$ResultAlertType. '<br />';
	echo 'Facility Type = '.$facility. '<br />';
	echo 'Continent = '.$continent. '<br />';
	echo 'World ID = '.$world_id. '<br />';
	echo 'Duration: '.$duration. '<br />';
	echo 'START DATE TIME: '.gmdate("Y-m-d H:i:s", $time).'<br />';
	echo 'END DATE TIME: '.gmdate("Y-m-d H:i:s", $time +$duration);
	
if ($ResultAlertType != "Territory") {
	$content = file_get_contents("http://fishy.sytes.net/ps2territory.php?world=$world_id&facility=$facility&time=$time&duration=$duration", 0, null, null);
}
else {
	$content = file_get_contents("http://fishy.sytes.net/ps2territory.php?world=$world_id&continent=$continent&time=$time&duration=$duration", 0, null, null);
}

$json = json_decode($content, true);

if ($mode == "debugging") {

	echo '<pre style="color: white;">';
	var_dump($json);
	echo '</pre>';
	
}

$territory = $json["control-list"][0]["control-percentage"];
	
if (($mode == "") || ($mode == "debugging")) // Live Data Scripts
{	
	// COLLECT ZE DATA!!!
	
	if ($ResultAlertType != "Territory") // Array parasing for Facilities
	{
	
		$key = 0;
			
		foreach ($json["control-list"] as $result)
		{
			$array_fac = $result["facilities"];
			$fac1 = $array_fac[0]["owned-by-faction"];
			$fac2 = $array_fac[1]["owned-by-faction"];
			$fac3 = $array_fac[2]["owned-by-faction"];
			$fac4 = $array_fac[3]["owned-by-faction"];
			$fac5 = $array_fac[4]["owned-by-faction"];
			$fac6 = $array_fac[5]["owned-by-faction"];
			$fac7 = $array_fac[6]["owned-by-faction"];
			if ($ResultAlertType != "Tech") // Remove extra facilities for Tech
			{ 
				$fac8 = $array_fac[7]["owned-by-faction"];
				$fac9 = $array_fac[8]["owned-by-faction"];
			}
			
				if ($mode == "debugging")
				{
					echo '<br /><br /> ARRAY ('.$key.') VALUES: ';
					echo '<br />Result Timestamp: '.$result["datetime"];
					
					echo '<br /> '.$result["facilities"][0]["name"].': '.$fac1;
					echo '<br /> '.$result["facilities"][1]["name"].': '.$fac2;
					echo '<br /> '.$result["facilities"][2]["name"].': '.$fac3;
					echo '<br /> '.$result["facilities"][3]["name"].': '.$fac4;
					echo '<br /> '.$result["facilities"][4]["name"].': '.$fac5;
					echo '<br /> '.$result["facilities"][5]["name"].': '.$fac6;
					echo '<br /> '.$result["facilities"][6]["name"].': '.$fac7;
					if ($ResultAlertType != "Tech")  // Remove extra facilities for Tech
					{
					echo '<br /> '.$result["facilities"][7]["name"].': '.$fac8;
					echo '<br /> '.$result["facilities"][8]["name"].': '.$fac9;
					}
				}
		$key ++;
					
			if ($facility == 2) 
			{
				$submit_stats = mysql_query("INSERT INTO results_amp (dataTimestamp, resultID, Peris, Dahaka, Zurvan, Kwahtee, Sungrey, Wokuk, Elli, Freyr, Nott) 
				VALUES (".$result['datetime'].", $ResultID, $fac1, $fac2, $fac3, $fac4, $fac5, $fac6, $fac7, $fac8, $fac9) ");
		
			}
			
			if ($facility == 3) 
			{
				$submit_stats = mysql_query("INSERT INTO results_bio (dataTimestamp, resultID, Allatum, Saurva, Rashnu, Ikanam, Onatha, Xelas, Andvari, Mani, Ymir) 
				VALUES (".$result['datetime'].", $ResultID, $fac1, $fac2, $fac3, $fac4, $fac5, $fac6, $fac7, $fac8, $fac9) ");
		
			}
			
			if ($facility == 4) 
			{
				$submit_stats = mysql_query("INSERT INTO results_tech (dataTimestamp, resultID, Hvar, Mao, Tawrich, Heyoka, Mekala, Tumas, Eisa) 
				VALUES (".$result['datetime'].", $ResultID, $fac1, $fac2, $fac3, $fac4, $fac5, $fac6, $fac7) ");
		
			}
		
		} // End for each Facility Loop
		
		
		
	} // End of Facility IF	
	else if ($ResultAlertType == "Territory") // Array parsing for Territory
	{
		
		if ($mode == "debugging")
		{
			$total = $territory[1] + $territory[2] + $territory[3];
			echo 'RESULT DEBUGGING <br />';
			echo '<br /> Last Result ID: '.$ResultID;
			echo '<br /> VS Territory % = '.$territory[1] * 100;
			echo '<br /> NC Territory % = '.$territory[2] * 100;
			echo '<br /> TR Territory % = '.$territory[3] * 100;
		}
		
		foreach ($json["control-list"] as $result)
		{
			$territory_array = $result["control-percentage"];
			$territoryVS = $territory_array[1] * 100;
			$territoryNC = $territory_array[2] * 100;
			$territoryTR = $territory_array[3] * 100;
			
			if ($mode == "debugging")
			{
				echo '<br /><br /> ARRAY ('.$key.') VALUES: ';
				echo '<br />Result Timestamp: '.$result["datetime"];
				
				echo '<br /> TerritoryVS: '.$territoryVS;
				echo '<br /> TerritoryNC: '.$territoryNC;
				echo '<br /> TerritoryTR: '.$territoryTR;
			}
			
			$key ++;
			
			$submit_stats = mysql_query ("INSERT INTO results_territory (dataTimestamp, ResultID, TerritoryVS, TerritoryNC, TerritoryTR) 
			VALUES (".$result['datetime'].", $ResultID, $territoryVS, $territoryNC, $territoryTR) ");
			
		} // End for each Territory loop
		
	} // End of Territory IF
	
}// End of Data Loops
	
	if ((!$submit_stats) && ($key != 25)) { // a hack for the MySQL error for empty key. Need to find a permiant solution
		echo '<br />';		
		echo '<br />Error Key: '.$key;
		echo '<br />';
		die('API POLL ERROR!: ' . mysql_error() );

	} else 
	{
		$success = 1;
	}

?>