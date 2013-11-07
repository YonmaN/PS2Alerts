<?php					

if ($AlertStats["ResultAlertType"] == "Amp")
{
	$type = "amp";
}
else if ($AlertStats["ResultAlertType"] == "Bio")
{
	$type = "bio";
}
else if ($AlertStats["ResultAlertType"] == "Tech")
{
	$type = "tech";
}
else
{
	$type = "UNKNOWN";
}
	
	$facility_query = mysql_query ("SELECT * FROM results_".$type." WHERE resultID = $AlertID");	
	
	$facility_last_query = mysql_query ("SELECT * FROM results_".$type." WHERE resultID = $AlertID ORDER BY dataTimestamp DESC LIMIT 1");
	$facility_last_result = mysql_fetch_array($facility_last_query);
	
		$facility_data_VS = array();
		$facility_data_NC = array();
		$facility_data_TR = array();
		$facility_data_dates = array();
			
		//echo $type;
		//echo $ResultAlertCont;
		
		while ($row = mysql_fetch_array($facility_query))
		{	
		
		if ($type == "amp") 
			{
				$fac1 = $row["Peris"];
				$fac2 = $row["Dahaka"];
				$fac3 = $row["Zurvan"];
				$fac4 = $row["Kwahtee"];
				$fac5 = $row["Sungrey"];
				$fac6 = $row["Wokuk"];
				$fac7 = $row["Elli"];
				$fac8 = $row["Freyr"];
				$fac9 = $row["Nott"];
			}
		else if ($type == "bio") 
			{
				$fac1 = $row["Allatum"];
				$fac2 = $row["Saurva"];
				$fac3 = $row["Rashnu"];
				$fac4 = $row["Ikanam"];
				$fac5 = $row["Onatha"];
				$fac6 = $row["Xelas"];
				$fac7 = $row["Andvari"];
				$fac8 = $row["Mani"];
				$fac9 = $row["Ymir"];
			}
		else if ($type == "tech")
			{
				$fac1 = $row["Hvar"];
				$fac2 = $row["Mao"];
				$fac3 = $row["Tawrich"];
				$fac4 = $row["Heyoka"];
				$fac5 = $row["Mekala"];
				$fac6 = $row["Tumas"];
				$fac7 = $row["Eisa"];
			}
		
		$VS = 0;
		$NC = 0;
		$TR = 0;
						
		if (($ResultAlertCont == "Indar") || ($ResultAlertCont == "Cross")) 
		{
			if ($fac1 == 1)
			{
				$VS++;
			}
			else if ($fac1 == 2)
			{
				$NC++;
			}
			else if ($fac1 == 3)
			{
				$TR++;
			}
			
			if ($fac2 == 1)
			{
				$VS++;
			}
			else if ($fac2 == 2)
			{
				$NC++;
			}
			else if ($fac2 == 3)
			{
				$TR++;
			}
			
			if ($fac3 == 1)
			{
				$VS++;
			}
			else if ($fac3 == 2)
			{
				$NC++;
			}
			else if ($fac3 == 3)
			{
				$TR++;
			}
		}
		if (($ResultAlertCont == "Amerish") || ($ResultAlertCont == "Cross"))
		{		
			if ($fac4 == 1)
			{
				$VS++;
			}
			else if ($fac4 == 2)
			{
				$NC++;
			}
			else if ($fac4 == 3)
			{
				$TR++;
			}
				
			if ($fac5 == 1)
			{
				$VS++;
			}
			else if ($fac5 == 2)
			{
				$NC++;
			}
			else if ($fac5 == 3)
			{
				$TR++;
			}
			
			if ($fac6 == 1)
			{
				$VS++;
			}
			else if ($fac6 == 2)
			{
				$NC++;
			}
			else if ($fac6 == 3)
			{
				$TR++;
			}
		}
		if (($ResultAlertCont == "Esamir") || ($ResultAlertCont == "Cross"))
		{					
			if ($fac7 == 1)
			{
				$VS++;
			}
			else if ($fac7 == 2)
			{
				$NC++;
			}
			else if ($fac7 == 3)
			{
				$TR++;
			}
			
			if ($fac8 == 1)
			{
				$VS++;
			}
			else if ($fac8 == 2)
			{
				$NC++;
			}
			else if ($fac8 == 3)
			{
				$TR++;
			}
			
			if ($fac9 == 1)
			{
				$VS++;
			}
			else if ($fac9 == 2)
			{
				$NC++;
			}
			else if ($fac9 == 3)
			{
				$TR++;
			}
		}
							
			array_push($facility_data_VS, $VS);
			array_push($facility_data_NC, $NC);
			array_push($facility_data_TR, $TR);
			array_push($facility_data_dates, gmdate("H:i", $row['dataTimestamp']));
		}
		/*echo '<pre class="form_item_text">';
		print_r(array_values($facility_data_dates));
		print_r(array_values($facility_data_VS));
		print_r(array_values($facility_data_NC));
		print_r(array_values($facility_data_TR));
		echo '</pre>';*/
		
		// Set Max for Graph:
		
		if (($ResultAlertCont == "Cross") && ($ResultAlertType != "Tech"))
		{
			$max = 9; // Cross Amp or Bio
		} 
		else if (($ResultAlertCont == "Cross") && ($ResultAlertType == "Tech"))
		{
			$max = 7; // Cross Tech
		}
		else if ($ResultAlertCont != "Cross")
		{
			$max = 3; // Cont Alert
		}
		
		
		
	?>