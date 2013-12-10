<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include("includes/includes.php")?>
<link href="css/sitewide.css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Planetside 2 Alerts</title>
</head>

<body>
<div id="wrapper">
	<?php 
	$subheader = 1;
	
	$testing = $_REQUEST["testing"];
	
	include('includes/header.php');
	
	if (!isset($_COOKIE["read"])) // Do a check to see if the user has already read the notice
	{ 
		include("includes/siteinfo.php");
	}
	
	$selected_server = $_REQUEST["server"]; 
	
	$time_filter = $_REQUEST["time_filter"];
	$today_date = date("Y-m-d");
				
	$ResultServer = $_POST["server"]; // For server selections 
	date_default_timezone_set('UTC');
	?>
	
	<div id="float" style="margin-left: auto; margin-right: auto; width: 1020px;">
		<div id="content_left" style="width:380px; float: left;">
			<div class="content" id="general_stats" style="width: 320px; height: 260px">
				<p class="form_headers">General Statistics</p>
				<?php
				
				$ResultServer = $_REQUEST["server"];
				
				//include("includes/server_rules_index.php"); // Server Rules	
				
				if (($ResultServer == "all") || ($ResultServer == ""))
				{
					$ResultServer_SQL = "WHERE ResultServer BETWEEN '1' AND '20'"; // Complete SQL rule if theres no results. Make it simple :P
				}
				else if (($ResultServer != "all") || ($ResultServer != ""))
				{
					$ResultServer_SQL = "WHERE ResultServer = '$ResultServer'"; // Add SQL rule in when required
				} 
											
				if ($time_filter == "peak")
				{
					$time_start = "17:00:00";
					$time_end = "23:59:00";
				}
				else if ($time_filter == "offpeak")
				{
					$time_start = "00:00:00";
					$time_end = "16:59:59";
				}
				else	
				{	
					$time_start = "00:00:00";
					$time_end = "23:59:59";
				}
				
				if ($time_filter != "none") 
				{
					$count_submit_query = mysql_query("SELECT CAST(ResultDateTime AS time) FROM results2 ".$ResultServer_SQL." AND CAST(ResultDateTime as time) BETWEEN '$time_start' AND '$time_end'");
					$count_domination_query = mysql_query("SELECT CAST(ResultDateTime AS time) FROM results2 ".$ResultServer_SQL." AND ResultDomination = 1 AND CAST(ResultDateTime as time) BETWEEN '$time_start' AND '$time_end'");
					$count_submit = mysql_num_rows($count_submit_query);
					$count_domination = mysql_num_rows($count_domination_query);
				}
				else // If no filtering
				{
					$count_submit_query = mysql_query("SELECT COUNT(ResultID) FROM results2 ".$ResultServer_SQL." ");
					$count_domination_query = mysql_query("SELECT COUNT(ResultID) FROM results2 ".$ResultServer_SQL." AND ResultDomination = 1 ");
					
					$count_submit = mysql_fetch_row($count_submit_query);
					$count_domination = mysql_fetch_row($count_domination_query);
				}
				
				$alerts_list_query = mysql_query("SELECT * FROM results2 ".$ResultServer_SQL." ORDER BY ResultDateTime DESC LIMIT 3 ");

				?>
				<table width="320" border="0" style="margin-top:15px;">
					<tr>
						<td style="text-align: center;"><img src="images/AlertIconWaves3.png" alt="Alerts Submitted Icon" /></td>
						<td style="text-align: center;"><img src="images/AlertIconDominated.png" alt="Alerts Dominated Icon" /></td>
					</tr>
					<tr>
						<td style="text-align: center;"><span class="stats_highlight"> <?php if($time_filter != "none") { echo $count_submit; } else { echo $count_submit[0]; } ?> </span></td>
						<td style="text-align: center;"><span class="stats_highlight"> <?php if($time_filter != "none") { echo $count_domination; } else { echo $count_domination[0]; } ?> </span></td>
					</tr>
					<tr>
						<td style="text-align: center;"><p class="form_item_text" style="margin: 0px;"> Alerts Submitted</p></td>
						<td style="text-align: center;"><p class="form_item_text" style="margin: 0px;"> Alerts Dominated</p></td>
					</tr>
				</table>
				
				<div id="selections" style="width:340px; margin-top: 10px; margin-left: -10px; padding-top: 6px; border-top:dotted; border-top-color: #620002">
				
					<div id="server_selection" style="width: 165px; float: left; text-align: center; border-right:dotted; border-right-color:#620002;">
						<p class="form_item_text" style="display: inline;"> Selected Server: </p>						
						<form action="" method="POST">
							<select name="server" onChange="this.form.submit()" style="margin-top: 5px;" >
								<option value="all">All Servers </option>
								<option value="25" <?php if ($selected_server == 25) {echo "selected='selected'"; } ?>>Briggs</option>
								<option value="11" <?php if ($selected_server == 11) {echo "selected='selected'"; } ?>>Ceres</option>
								<option value="13" <?php if ($selected_server == 13) {echo "selected='selected'"; } ?>>Cobalt</option>
								<option value="1" <?php if ($selected_server == 1) {echo "selected='selected'"; } ?>>Connery</option>
								<option value="17" <?php if ($selected_server == 17) {echo "selected='selected'"; } ?>>Mattherson</option>
								<option value="10" <?php if ($selected_server == 10) {echo "selected='selected'"; } ?>>Miller</option>
								<option value="18" <?php if ($selected_server == 18) {echo "selected='selected'"; } ?>>Waterson</option>
								<option value="9" <?php if ($selected_server == 9) {echo "selected='selected'"; } ?>>Woodman</option>
							</select>
							<input type="hidden" name="time_filter" value="<?php echo $time_filter; ?>" />
						</form>
						
					</div>
					
					<div id="time_selection" style="width: 165px; margin-left: 5px; float: left; text-align: center;">		
						<p class="form_item_text" style="display: inline;"> Time Filtering: </p>
						<form action="" method="POST">
							<select name="time_filter" style="margin-top:5px; width: 153px;" onChange="this.form.submit()">
								<option value="none" <?php if ($time_filter == "none") {echo "selected='selected'"; } ?>>None (24 hours)</option>
								<option value="peak" <?php if ($time_filter == "peak") {echo "selected='selected'"; } ?>>Peak (17:00 - 23:59)</option>
								<option value="offpeak" <?php if ($time_filter == "offpeak") {echo "selected='selected'"; } ?>>Nights (00:00 - 16:59)</option>
							</select>
							<input type="hidden" name="server" value="<?php echo $selected_server; ?>" />
						</form>
					</div>
				</div>
			</div>
			<div class="content" id="chart_container" style="margin-top: 10px; width: 320px;">
				<p class="form_headers">Faction &amp; Types</p>
					<div id="factions_chart" style="width: 320px; height: 320px;">
						<?php if ($count_submit > 1)
							{
								echo '<div id="alert_types" style="width: 380px; height: 320px;">';
									include("includes/index_empwins_graph.php");
								echo '</div>';
							}
							else
							{
								echo '<div id="alert_types" style="width: 320px; height: 320px;">';
									echo '<p class="form_headers" style="padding-top: 120px;">No data available!</p>';
								echo '</div>';
							}
						?>
					</div>
			</div>
		</div>
		<div id="content_middle" class="stats_middle" style="background: none; padding-top: 0px; width: 630px">
			<div id="content_middle_submits" class="stats_middle" style="width: 630px;">
				<div id="alert_submissions" style="width: 610px; height: 252px; margin-left: 10px; margin-top:8px">
				</div>
				<?php 
				
				$alert_submits_totals_query = mysql_query("SELECT COUNT( ResultID ) AS total, ResultDateTime, DATE( ResultDateTime ) AS DATE
														FROM results2
														WHERE ResultDateTime > CURDATE( ) - INTERVAL 7 DAY 
														GROUP BY DATE
														LIMIT 0 , 30");
														
				$alert_submits_NC_query = mysql_query("SELECT COUNT( ResultID ) AS total, ResultDateTime, DATE( ResultDateTime ) AS DATE
														FROM results2
														WHERE ResultNC = 2  AND ResultDateTime > CURDATE( ) - INTERVAL 7 DAY 
														GROUP BY DATE
														LIMIT 0 , 30");
				
				$alert_submits_TR_query = mysql_query("SELECT COUNT( ResultID ) AS total, ResultDateTime, DATE( ResultDateTime ) AS DATE
														FROM results2
														WHERE ResultTR = 2  AND ResultDateTime > CURDATE( ) - INTERVAL 7 DAY 
														GROUP BY DATE
														LIMIT 0 , 30");
				
				$alert_submits_VS_query = mysql_query("SELECT COUNT( ResultID ) AS total, ResultDateTime, DATE( ResultDateTime ) AS DATE
														FROM results2
														WHERE ResultVS = 2  AND ResultDateTime > CURDATE( ) - INTERVAL 7 DAY 
														GROUP BY DATE
														LIMIT 0 , 30");
				
				
				$date_today = date("Y-m-d");
				$date_1day = date("Y-m-d", strtotime(' -1 days'));
				$date_2day = date("Y-m-d", strtotime(' -2 days'));
				$date_3day = date("Y-m-d", strtotime(' -3 days'));
				$date_4day = date("Y-m-d", strtotime(' -4 days'));
				$date_5day = date("Y-m-d", strtotime(' -5 days'));
				$date_6day = date("Y-m-d", strtotime(' -6 days'));
				$date_7day = date("Y-m-d", strtotime(' -7 days'));
				
				$chart_date_today = date("d-m");
				$chart_date_1day = date("d-m", strtotime(' -1 days'));
				$chart_date_2day = date("d-m", strtotime(' -2 days'));
				$chart_date_3day = date("d-m", strtotime(' -3 days'));
				$chart_date_4day = date("d-m", strtotime(' -4 days'));
				$chart_date_5day = date("d-m", strtotime(' -5 days'));
				$chart_date_6day = date("d-m", strtotime(' -6 days'));
				$chart_date_7day = date("d-m", strtotime(' -7 days'));
				
				date_default_timezone_set('GMT');
				
				$Now = new DateTime('NOW');
				$Now_Formatted = $Now->format('Y-m-d H:i:s');
				
				$Now_Fix = new DateTime('NOW');
				$Now_Fix->add(new DateInterval('P1D'));
				$Now_Formatted_Fix = $Now_Fix->format('Y-m-d H:i:s');
				$Now_Formatted_Fix_notime = $Now_Fix->format('Y-m-d H:i:s');
				
				//$SpamTimer = $Now->format('Y-m-d H:i:s');
				
				$DaysSeven = new DateTime('NOW');
				$DaysSeven->sub(new DateInterval('P7D'));
				$DaysSeven_Formatted = $DaysSeven->format('Y-m-d H:i:s');
				
				$DaysSeven = new DateTime('NOW');
				$DaysSeven->sub(new DateInterval('P30D'));
				$DaysSeven_Formatted = $DaysSeven->format('Y-m-d H:i:s');
				
				
				$nc_wins_query = mysql_query
				("SELECT ResultDateTime, DATE( ResultDateTime ) AS DATE, COUNT( ResultNC ) AS ResultsNC
				FROM results2
				WHERE ResultNC = 'WIN' AND ResultDateTime BETWEEN '".$DaysSeven_Formatted."' AND '".$Now_Formatted_Fix."'
				GROUP BY DATE "); 
				
				$tr_wins_query = mysql_query
				("SELECT ResultDateTime, DATE( ResultDateTime ) AS DATE, COUNT( ResultTR ) AS ResultsTR
				FROM results2
				WHERE ResultTR = 'WIN' AND ResultDateTime BETWEEN '".$DaysSeven_Formatted."' AND '".$Now_Formatted_Fix."'
				GROUP BY DATE "); 
				
				$vs_wins_query = mysql_query
				("SELECT ResultDateTime, DATE( ResultDateTime ) AS DATE, COUNT( ResultVS ) AS ResultsVS
				FROM results2
				WHERE ResultVS = 'WIN' AND ResultDateTime BETWEEN '".$DaysSeven_Formatted."' AND '".$Now_Formatted_Fix."'
				GROUP BY DATE "); 
				
				$draws_query = mysql_query
				("SELECT COUNT(ResultDraw) AS ResultsDraw, DATE(ResultDateTime) AS DATE
				FROM results2
				WHERE ResultDraw = 1 AND ResultDateTime BETWEEN '".$DaysSeven_Formatted."' AND '".$Now_Formatted_Fix."'
				GROUP BY DATE "); 
				// Add Faction WHERE stuff in later
				
				// Set all to 0 incase the result is NULL for the graph to work properly
				$nc_wins_6day = 0;
				$nc_wins_5day = 0;
				$nc_wins_4day = 0;
				$nc_wins_3day = 0;
				$nc_wins_2day = 0;
				$nc_wins_1day = 0;
				$nc_wins_today = 0;
				
				$tr_wins_6day = 0;
				$tr_wins_5day = 0;
				$tr_wins_4day = 0;
				$tr_wins_3day = 0;
				$tr_wins_2day = 0;
				$tr_wins_1day = 0;
				$tr_wins_today = 0;
				
				$vs_wins_6day = 0;
				$vs_wins_5day = 0;
				$vs_wins_4day = 0;
				$vs_wins_3day = 0;
				$vs_wins_2day = 0;
				$vs_wins_1day = 0;
				$vs_wins_today = 0;
				
				$draws_6day = 0;
				$draws_5day = 0;
				$draws_4day = 0;
				$draws_3day = 0;
				$draws_2day = 0;
				$draws_1day = 0;
				$draws_today = 0;
				
				while ($nc_wins_result = mysql_fetch_array($nc_wins_query))
				{
					if ($nc_wins_result['DATE'] == $date_6day)
					{
						$nc_wins_6day = $nc_wins_result['ResultsNC'];
					}
					elseif ($nc_wins_result['DATE'] == $date_5day)
					{
						$nc_wins_5day = $nc_wins_result['ResultsNC'];
					}
					elseif ($nc_wins_result['DATE'] == $date_4day)
					{
						$nc_wins_4day = $nc_wins_result['ResultsNC'];
					}
					elseif ($nc_wins_result['DATE'] == $date_3day)
					{
						$nc_wins_3day = $nc_wins_result['ResultsNC'];
					}
					elseif ($nc_wins_result['DATE'] == $date_2day)
					{
						$nc_wins_2day = $nc_wins_result['ResultsNC'];
					}
					elseif ($nc_wins_result['DATE'] == $date_1day)
					{
						$nc_wins_1day = $nc_wins_result['ResultsNC'];
					}
					elseif ($nc_wins_result['DATE'] == $date_today)
					{
						$nc_wins_today = $nc_wins_result['ResultsNC'];
					}
				}
				
				while ($tr_wins_result = mysql_fetch_array($tr_wins_query))
				{
					if ($tr_wins_result['DATE'] == $date_6day)
					{
						$tr_wins_6day = $tr_wins_result['ResultsTR'];
					}
					elseif ($tr_wins_result['DATE'] == $date_5day)
					{
						$tr_wins_5day = $tr_wins_result['ResultsTR'];
					}
					elseif ($tr_wins_result['DATE'] == $date_4day)
					{
						$tr_wins_4day = $tr_wins_result['ResultsTR'];
					}
					elseif ($tr_wins_result['DATE'] == $date_3day)
					{
						$tr_wins_3day = $tr_wins_result['ResultsTR'];
					}
					elseif ($tr_wins_result['DATE'] == $date_2day)
					{
						$tr_wins_2day = $tr_wins_result['ResultsTR'];
					}
					elseif ($tr_wins_result['DATE'] == $date_1day)
					{
						$tr_wins_1day = $tr_wins_result['ResultsTR'];
					}
					elseif ($tr_wins_result['DATE'] == $date_today)
					{
						$tr_wins_today = $tr_wins_result['ResultsTR'];
					}
				}
				
				while ($vs_wins_result = mysql_fetch_array($vs_wins_query))
				{
					if ($vs_wins_result['DATE'] == $date_6day)
					{
						$vs_wins_6day = $vs_wins_result['ResultsVS'];
					}
					elseif ($vs_wins_result['DATE'] == $date_5day)
					{
						$vs_wins_5day = $vs_wins_result['ResultsVS'];
					}
					elseif ($vs_wins_result['DATE'] == $date_4day)
					{
						$vs_wins_4day = $vs_wins_result['ResultsVS'];
					}
					elseif ($vs_wins_result['DATE'] == $date_3day)
					{
						$vs_wins_3day = $vs_wins_result['ResultsVS'];
					}
					elseif ($vs_wins_result['DATE'] == $date_2day)
					{
						$vs_wins_2day = $vs_wins_result['ResultsVS'];
					}
					elseif ($vs_wins_result['DATE'] == $date_1day)
					{
						$vs_wins_1day = $vs_wins_result['ResultsVS'];
					}
					elseif ($vs_wins_result['DATE'] == $date_today)
					{
						$vs_wins_today = $vs_wins_result['ResultsVS'];
					}
				}
				
				while ($draws_result = mysql_fetch_array($draws_query))
				{
					if ($draws_result['DATE'] == $date_6day)
					{
						$draws_6day = $draws_result['ResultsDraw'];
					}
					elseif ($draws_result['DATE'] == $date_5day)
					{
						$draws_5day = $draws_result['ResultsDraw'];
					}
					elseif ($draws_result['DATE'] == $date_4day)
					{
						$draws_4day = $draws_result['ResultsDraw'];
					}
					elseif ($draws_result['DATE'] == $date_3day)
					{
						$draws_3day = $draws_result['ResultsDraw'];
					}
					elseif ($draws_result['DATE'] == $date_2day)
					{
						$draws_2day = $draws_result['ResultsDraw'];
					}
					elseif ($draws_result['DATE'] == $date_1day)
					{
						$draws_1day = $draws_result['ResultsDraw'];
					}
					elseif ($draws_result['DATE'] == $date_today)
					{
						$draws_today = $draws_result['ResultsDraw'];
					}
				}
				
				?>
				<script>
			
			$(function () {
			$('#alert_submissions').highcharts({
				chart: {
					type: 'column',
					backgroundColor: ''
				},
				credits: {enabled: false},
				title: {
					text: 'Alert Victories - Last 7 days',
					style: {
						color: '#C00',
						fontSize: '28px',
						marginTop: '10px',
						fontFamily: 'Orbitron, sans-serif'
					}
				},
				xAxis: {
					 categories: [<?php echo "'".$chart_date_6day."', '".$chart_date_5day."', '".$chart_date_4day."', '".$chart_date_3day."', '".$chart_date_2day."', '".$chart_date_1day."', '".$chart_date_today."'" ?>],
				labels: {
						style: {
							color: '#FFFFFF'
						}
					}
				},
				yAxis: {
					title: {
						text: ''
					},
					allowDecimals: false,
					stackLabels: {
						enabled: true,
						style: {
							fontWeight: 'bold',
							color: (Highcharts.theme && Highcharts.theme.textColor) || 'white'
						}
					},
					labels: {
						style: {
							color: '#FFFFFF'
						}
					}
				},
				legend: {
					enabled: false,
				},
				tooltip: {
					formatter: function() {
						return '<b>'+ this.x +'</b><br/>'+
							this.series.name +': '+ this.y +'<br/>'+
							'Total: '+ this.point.stackTotal;
					}
	
				},
				plotOptions: {
					column: {
						stacking: 'normal',
						dataLabels: {
							enabled: true,
							color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
							formatter:function() {
								if(this.y !=0) {
									return this.y;
								}
							}
						}
					}
				},
				series: [{
					name: 'New Conglomerate',
					color: '#080B74',
					data: [<?php echo $nc_wins_6day.", ".$nc_wins_5day.", ".$nc_wins_4day.", ".$nc_wins_3day.", ".$nc_wins_2day.", ".$nc_wins_1day.", ".$nc_wins_today ?>]
				}, {
					name: 'Terran Republic',
					color: '#910000',
					data: [<?php echo $tr_wins_6day.", ".$tr_wins_5day.", ".$tr_wins_4day.", ".$tr_wins_3day.", ".$tr_wins_2day.", ".$tr_wins_1day.", ".$tr_wins_today ?>]
				}, {
					name: 'Vanu Soverignity',
					color: '#7309AA',
					data: [<?php echo $vs_wins_6day.", ".$vs_wins_5day.", ".$vs_wins_4day.", ".$vs_wins_3day.", ".$vs_wins_2day.", ".$vs_wins_1day.", ".$vs_wins_today ?>]
				}, {
					name: 'Draws',
					color: '#333333',
					data: [<?php echo $draws_6day.", ".$draws_5day.", ".$draws_4day.", ".$draws_3day.", ".$draws_2day.", ".$draws_1day.", ".$draws_today ?>]
				}],
			});
		});
		</script>
			</div>
			<div id="alert_conts" class="stats_middle">
			<p class="form_headers">Continents &amp; Types</p>
			<?php if ($count_submit > 1)
			{
				echo '<div id="alert_types" style="width: 380px; height: 320px;">';
					include("includes/index_cont_graph.php");
				echo '</div>';
			}
			else
			{
				echo '<div id="alert_types" style="width: 380px; height: 320px;">';
					echo '<p class="form_headers" style="padding-top: 120px;">No data available!</p>';
				echo '</div>';
			}
			?>
			</div>
			<div class="content" id="content_right" style="width:200px; float: right; margin-left: 10px; padding-bottom: 5px;">
				<p class="form_headers" style="font-size: 24px;">Recent Alerts</p>
				<a class="form_item_text" style="color: #F00; font-size: 14px; margin-left: 55px;" href="allalerts.php">View all Alerts</a>
				 
				<?php
				
				if ($count_submit < 1) 
				{
					echo '<p class="form_item_text" style="text-align: center;">No Alerts were found!</p>';
				}
				else 
				{			
					while ($row = mysql_fetch_array($alerts_list_query)) 
					{
					
						//echo '<a href="BLAH.JPG">';
						
						$row_date = date($row['ResultDateTime']);
						$row_formatted = strtotime($row_date);
						$ResultNC = $row['ResultNC'];
						$ResultTR = $row['ResultTR'];
						$ResultVS = $row['ResultVS'];
						$ResultDraw = $row['ResultDraw'];
						$ResultServer = $row['ResultServer'];
						
						if ($ResultNC == "WIN") 
						{
							$winner = "New Conglomerate";
						} else if ($ResultTR == "WIN")
						{
							$winner = "Terran Republic";
						} else if ($ResultVS == "WIN")
						{
							$winner = "Vanu Sovereignty";
						} else if ($ResultDraw == 1) {
							$winner = "Draw";
						}
						
						include("includes/server_rules.php");
						
						echo '<a class="form_item_title" href="alertdetail.php?AlertID='.$row['ResultID'].'">';
						
						echo '<p class="form_item_title" style="color: #F00;">';
						echo date('H', $row_formatted) . ":";
						echo date('i', $row_formatted) . "   ";
						
						echo date('d', $row_formatted) . "-";
						echo date('m', $row_formatted) . "-";
						echo date('y', $row_formatted) . " ";
						echo '</p>';
						echo '</a>';
						
						echo '<p class="form_item_text">';
						
						echo '<span style="color:#F00;">Server:</span> '.$Server;
						echo "<br />";
						echo '<span style="color:#F00;">Continent:</span> '.$row["ResultAlertCont"];
						echo "<br />";
						echo '<span style="color:#F00;">Type:</span> '.$row["ResultAlertType"];
						echo "<br />";
						echo '<span style="color:#F00;">Victor:</span> '.$winner;
						echo '</p>';
					}
				}
			?>
			</div>
			
		</div>	
			<?php include("includes/disqus.php");?>
	</div>

	<?php include("includes/footer.php");?>
</div>

</body>
</html>