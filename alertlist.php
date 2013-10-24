<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include("includes/includes.php")?>
<title>Alert Stats</title>
<style>
.form_headers { font-size: 28px; }
</style>
</head>

<body>
<div id="wrapper">
<?php include('includes/header.php') ?>
<div id="float" style="margin-left: auto; margin-right: auto; width: 1020px;">
	<div id="content_left" style="width:380px; float: left;">
		<div class="content" id="general_stats" style="width: 320px; height: 260px">
			<p class="form_headers">General Statistics</p>
			<?php
				
				date_default_timezone_set('UTC');
				
				$count_submit_query = mysql_query("SELECT COUNT(ResultID) FROM results2");
				$alerts_list_query = mysql_query("SELECT * FROM results2 ORDER BY ResultDateTime DESC LIMIT 3 ");
				$count_domination_query = mysql_query("SELECT COUNT(ResultID) FROM results2 WHERE ResultDomination = 1 ");
				
				$count_submit = mysql_fetch_row($count_submit_query);
				$count_domination = mysql_fetch_row($count_domination_query);
				
				?>
				<table width="320" border="0" style="margin-top:35px;">
	<tr>
		<td style="text-align: center;"><img src="images/AlertIconWaves3.png" alt="Alerts Submitted Icon" /></td>
		<td style="text-align: center;"><img src="images/AlertIconDominated.png" alt="Alerts Dominated Icon" /></td>
	</tr>
	<tr>
		<td style="text-align: center;"><span class="stats_highlight"> <?php echo $count_submit[0] ?> </span></td>
		<td style="text-align: center;"><span class="stats_highlight"> <?php echo $count_domination[0] ?> </span></td>
	</tr>
	<tr>
		<td style="text-align: center;"><p class="form_item_text" style="margin: 0px;"> Alerts Submitted</p></td>
		<td style="text-align: center;"><p class="form_item_text" style="margin: 0px;"> Alerts Dominated</p></td>
	</tr>
</table>
			
		</div>
		<div class="content" id="chart_container" style="margin-top: 10px; width: 320px;">
			<p class="form_headers">Alerts by Faction &amp; Type</p>
			<div id="factions_chart" style="width: 320px; height: 320px;">
			</div>
			<?php
	
	$wins_NC_query = mysql_query ("SELECT * FROM results2 WHERE ResultNC = 'WIN'");
	$wins_NC = mysql_num_rows($wins_NC_query);
	$wins_TR_query = mysql_query ("SELECT * FROM results2 WHERE ResultTR = 'WIN'");
	$wins_TR = mysql_num_rows($wins_TR_query);
	$wins_VS_query = mysql_query ("SELECT * FROM results2 WHERE ResultVS = 'WIN'");
	$wins_VS = mysql_num_rows($wins_VS_query);
	$wins_Draw_query = mysql_query ("SELECT * FROM results2 WHERE ResultDraw = 1");
	$wins_Draw = mysql_num_rows($wins_Draw_query);
	
	$wins_NC_amps_query = mysql_query ("SELECT * FROM results2 WHERE ResultNC = 'WIN' AND ResultAlertType = 'Amp' ");
	$wins_NC_amps = mysql_num_rows($wins_NC_amps_query);
	$wins_NC_bios_query = mysql_query ("SELECT * FROM results2 WHERE ResultNC = 'WIN' AND ResultAlertType = 'Bio' ");
	$wins_NC_bios = mysql_num_rows($wins_NC_bios_query);
	$wins_NC_techs_query = mysql_query ("SELECT * FROM results2 WHERE ResultNC = 'WIN' AND ResultAlertType = 'Tech' ");
	$wins_NC_techs = mysql_num_rows($wins_NC_techs_query);
	$wins_NC_territory_query = mysql_query ("SELECT * FROM results2 WHERE ResultNC = 'WIN' AND ResultAlertType = 'Territory' ");
	$wins_NC_territory = mysql_num_rows($wins_NC_territory_query);
	
	$wins_TR_amps_query = mysql_query ("SELECT * FROM results2 WHERE ResultTR = 'WIN' AND ResultAlertType = 'Amp' ");
	$wins_TR_amps = mysql_num_rows($wins_TR_amps_query);
	$wins_TR_bios_query = mysql_query ("SELECT * FROM results2 WHERE ResultTR = 'WIN' AND ResultAlertType = 'Bio' ");
	$wins_TR_bios = mysql_num_rows($wins_TR_bios_query);
	$wins_TR_techs_query = mysql_query ("SELECT * FROM results2 WHERE ResultTR = 'WIN' AND ResultAlertType = 'Tech' ");
	$wins_TR_techs = mysql_num_rows($wins_TR_techs_query);
	$wins_TR_territory_query = mysql_query ("SELECT * FROM results2 WHERE ResultTR = 'WIN' AND ResultAlertType = 'Territory' ");
	$wins_TR_territory = mysql_num_rows($wins_TR_territory_query);
	
	$wins_VS_amps_query = mysql_query ("SELECT * FROM results2 WHERE ResultVS = 'WIN' AND ResultAlertType = 'Amp' ");
	$wins_VS_amps = mysql_num_rows($wins_VS_amps_query);
	$wins_VS_bios_query = mysql_query ("SELECT * FROM results2 WHERE ResultVS = 'WIN' AND ResultAlertType = 'Bio' ");
	$wins_VS_bios = mysql_num_rows($wins_VS_bios_query);
	$wins_VS_techs_query = mysql_query ("SELECT * FROM results2 WHERE ResultVS = 'WIN' AND ResultAlertType = 'Tech' ");
	$wins_VS_techs = mysql_num_rows($wins_VS_techs_query);
	$wins_VS_territory_query = mysql_query ("SELECT * FROM results2 WHERE ResultVS = 'WIN' AND ResultAlertType = 'Territory' ");
	$wins_VS_territory = mysql_num_rows($wins_VS_territory_query);
	
	$wins_Draw_amps_query = mysql_query ("SELECT * FROM results2 WHERE ResultDraw = 1 AND ResultAlertType = 'Amp' ");
	$wins_Draw_amps = mysql_num_rows($wins_Draw_amps_query);
	$wins_Draw_bios_query = mysql_query ("SELECT * FROM results2 WHERE ResultDraw = 1 AND ResultAlertType = 'Bio' ");
	$wins_Draw_bios = mysql_num_rows($wins_Draw_bios_query);
	$wins_Draw_techs_query = mysql_query ("SELECT * FROM results2 WHERE ResultDraw = 1 AND ResultAlertType = 'Tech' ");
	$wins_Draw_techs = mysql_num_rows($wins_Draw_techs_query);
	$wins_Draw_territory_query = mysql_query ("SELECT * FROM results2 WHERE ResultDraw = 1 AND ResultAlertType = 'Territory' ");
	$wins_Draw_territory = mysql_num_rows($wins_Draw_territory_query);
	
	?>
			<script>
				
		$(function () {
    
        var colors = Highcharts.getOptions().colors,
            categories = ['NC', 'TR', 'VS', 'Draw'],
            name = 'Empire',
            data = [{
                    y: <?php echo $wins_NC ?>,
                    color: '#080B74',
                    drilldown: {
                        name: 'NC',
                        categories: ['Amp', 'Bio', 'Tech', 'Territory'],
                        data: [<?php echo $wins_NC_amps ?>, <?php echo $wins_NC_bios ?>, <?php echo $wins_NC_techs ?>, <?php echo $wins_NC_territory ?>],
                        color: ['#090B74', '#1A1EB2', '#4E51D8', '#7375D8']
                    }
					
                }, {
                    y: <?php echo $wins_TR ?>,
                    color: colors[3],
                    drilldown: {
                        name: 'TR',
                        categories: ['Amp', 'Bio', 'Tech', 'Territory'],
                        data: [<?php echo $wins_TR_amps ?>, <?php echo $wins_TR_bios ?>, <?php echo $wins_TR_techs ?>, <?php echo $wins_TR_territory ?>],
                        color: colors[3]
                    }
                }, {
                    y: <?php echo $wins_VS ?>,
                    color: '#7309AA',
                    drilldown: {
                        name: 'VS',
                        categories: ['Amp', 'Bio', 'Tech', 'Territory'],
                        data: [<?php echo $wins_VS_amps ?>, <?php echo $wins_VS_bios ?>, <?php echo $wins_VS_techs ?>, <?php echo $wins_VS_territory ?>],
                        color: ['#4A036F', '#7309AA', '#A13DD5', '#AF66D5']
                    }
                }, {
                    y: <?php echo $wins_Draw?>,
                    color: '#333333',
                    drilldown: {
                        name: 'Draw',
                        categories: ['Amp', 'Bio', 'Tech', 'Territory'],
                        data: [<?php echo $wins_Draw_amps ?>, <?php echo $wins_Draw_bios ?>, <?php echo $wins_Draw_techs ?>, <?php echo $wins_Draw_territory ?>],
                        color: ['#CCCCCC', '#999999', '#666666', '#333333']
                    }
                }];
    
    
        // Build the data arrays
        var browserData = [];
        var versionsData = [];
        for (var i = 0; i < data.length; i++) {
    
            // add browser data
            browserData.push({
                name: categories[i],
                y: data[i].y,
                color: data[i].color
            });
    
            // add version data
            for (var j = 0; j < data[i].drilldown.data.length; j++) {
                var brightness = 0.2 - (j / data[i].drilldown.data.length) / 5 ;
                versionsData.push({
                    name: data[i].drilldown.categories[j],
                    y: data[i].drilldown.data[j],
                    color: Highcharts.Color(data[i].color).brighten(brightness).get()
                });
            }
        }
    
        // Create the chart
        $('#factions_chart').highcharts({
            chart: {
                type: 'pie',
				backgroundColor: '',
            },
			credits: {enabled: false},
            title: {
                text: ''
            },
            plotOptions: {
                pie: {
                    shadow: false,
                    center: ['50%', '50%'],
					borderColor: '#CCCCCC'
                }
            },
            tooltip: {
        	    valueSuffix: ''
            },
            series: [{
                name: 'Empire Wins',
                data: browserData,
                size: '100%',
                dataLabels: {
                    formatter: function() {
                        return this.y > 5 ? this.point.name +'<br />'+ this.y: null;
                    },
                    color: 'white',
                    distance: -80
                }
            }, {
                name: 'Alert Type Wins',
                data: versionsData,
                size: '100%',
                innerSize: '80%',
                dataLabels: {
					enabled: true,
					distance: -20,
                    formatter: function() {
                        // display only if larger than 1
                        return this.y > 1 ? this.y  : null;
                    },
					color: 'white'
                }
            }]
        });
    });
    
</script>
		</div>
	</div>
	<div id="content_middle" class="stats_middle" style="background: none; padding-top: 0px; width: 630px">
		<div id="content_middle_submits" class="stats_middle" style="width: 630px;">
			<div id="alert_submissions" style="width: 610px; height: 260px; margin-left: 10px;">
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
					marginTop: '10px'
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
			<p class="form_headers">Alert Continents &amp; Types</p>
			<div id="alert_types" style="width: 380px; height: 320px;">
			</div>
			<?php
			
			$amerish_amp_query = mysql_query("SELECT * FROM results2 WHERE ResultAlertCont = 'Amerish' AND ResultAlertType = 'Amp' ");
			$amerish_amp = mysql_num_rows($amerish_amp_query);
			$amerish_bio_query = mysql_query("SELECT * FROM results2 WHERE ResultAlertCont = 'Amerish' AND ResultAlertType = 'Bio' ");
			$amerish_bio = mysql_num_rows($amerish_bio_query);
			$amerish_tech_query = mysql_query("SELECT * FROM results2 WHERE ResultAlertCont = 'Amerish' AND ResultAlertType = 'Tech' ");
			$amerish_tech = mysql_num_rows($amerish_tech_query);
			$amerish_territory_query = mysql_query("SELECT * FROM results2 WHERE ResultAlertCont = 'Amerish' AND ResultAlertType = 'Territory' ");
			$amerish_territory = mysql_num_rows($amerish_territory_query);
			
			$esamir_amp_query = mysql_query("SELECT * FROM results2 WHERE ResultAlertCont = 'Esamir' AND ResultAlertType = 'Amp' ");
			$esamir_amp = mysql_num_rows($esamir_amp_query);
			$esamir_bio_query = mysql_query("SELECT * FROM results2 WHERE ResultAlertCont = 'Esamir' AND ResultAlertType = 'Bio' ");
			$esamir_bio = mysql_num_rows($esamir_bio_query);
			$esamir_territory_query = mysql_query("SELECT * FROM results2 WHERE ResultAlertCont = 'Esamir' AND ResultAlertType = 'Territory' ");
			$esamir_territory = mysql_num_rows($esamir_territory_query);
			
			$indar_amp_query = mysql_query("SELECT * FROM results2 WHERE ResultAlertCont = 'Indar' AND ResultAlertType = 'Amp' ");
			$indar_amp = mysql_num_rows($indar_amp_query);
			$indar_bio_query = mysql_query("SELECT * FROM results2 WHERE ResultAlertCont = 'Indar' AND ResultAlertType = 'Bio' ");
			$indar_bio = mysql_num_rows($indar_bio_query);
			$indar_tech_query = mysql_query("SELECT * FROM results2 WHERE ResultAlertCont = 'Indar' AND ResultAlertType = 'Tech' ");
			$indar_tech = mysql_num_rows($indar_tech_query);
			$indar_territory_query = mysql_query("SELECT * FROM results2 WHERE ResultAlertCont = 'Indar' AND ResultAlertType = 'Territory' ");
			$indar_territory = mysql_num_rows($indar_territory_query);
			
			$cross_amp_query = mysql_query("SELECT * FROM results2 WHERE ResultAlertCont = 'Cross' AND ResultAlertType = 'Amp' ");
			$cross_amp = mysql_num_rows($cross_amp_query);
			$cross_bio_query = mysql_query("SELECT * FROM results2 WHERE ResultAlertCont = 'Cross' AND ResultAlertType = 'Bio' ");
			$cross_bio = mysql_num_rows($cross_bio_query);
			$cross_tech_query = mysql_query("SELECT * FROM results2 WHERE ResultAlertCont = 'Cross' AND ResultAlertType = 'Tech' ");
			$cross_tech = mysql_num_rows($cross_tech_query);
			
			$amerish_total_query = mysql_query ("SELECT * FROM results2 WHERE ResultAlertCont = 'Amerish' ");
			$amerish_total = mysql_num_rows($amerish_total_query);
			$esamir_total_query = mysql_query ("SELECT * FROM results2 WHERE ResultAlertCont = 'Esamir' ");
			$esamir_total = mysql_num_rows($esamir_total_query);
			$indar_total_query = mysql_query ("SELECT * FROM results2 WHERE ResultAlertCont = 'Indar' ");
			$indar_total = mysql_num_rows($indar_total_query);
			$cross_total_query = mysql_query ("SELECT * FROM results2 WHERE ResultAlertCont = 'Cross' ");
			$cross_total = mysql_num_rows($cross_total_query);
			
			?>
			<script>
					
			$(function () {
		
			var colors = Highcharts.getOptions().colors,
				categories = ['Amerish', 'Esamir', 'Indar', 'Global'],
				name = 'Alert Contients',
				data = [{
						y: <?php echo $amerish_total ?>,
						color: '#63C716',
						drilldown: {
							name: 'Amerish',
							categories: ['Amp', 'Bio', 'Tech', 'Territory'],
							data: [<?php echo $amerish_amp ?>, <?php echo $amerish_bio ?>, <?php echo $amerish_tech ?>, <?php echo $amerish_territory ?>],
							color: ['#93FA43', '#86ED37', '#78E028', '#63C716']
						}
						
					}, {
						y: <?php echo $esamir_total ?>,
						color: '#A3C3FF',
						drilldown: {
							name: 'Esamir',
							categories: ['Amp', 'Bio', 'Territory'],
							data: [<?php echo $esamir_amp ?>, <?php echo $esamir_bio ?>, <?php echo $esamir_territory ?>],
							color: ['#DBE8FF', '#C7DBFF', '#B3CDFF', '#A3C3FF']
						}
					}, {
						y: <?php echo $indar_total ?>,
						color: '#D69D27',
						drilldown: {
							name: 'Indar',
							categories: ['Amp', 'Bio', 'Tech', 'Territory'],
							data: [<?php echo $indar_amp ?>, <?php echo $indar_bio ?>, <?php echo $indar_tech ?>, <?php echo $indar_territory ?>],
							color: ['#FAC14B', '#EDB540', '#E3A930', '#D69D27']
						}
					}, {
						y: <?php echo $cross_total ?>,
						color: '#333333',
						drilldown: {
							name: 'Global',
							categories: ['Amp', 'Bio', 'Tech'],
							data: [<?php echo $cross_amp ?>, <?php echo $cross_bio ?>, <?php echo $cross_tech ?>],
							color: ['#999999', '#666666', '#333333']
						}
					}];
		
		
			// Build the data arrays
			var browserData = [];
			var versionsData = [];
			for (var i = 0; i < data.length; i++) {
		
				// add browser data
				browserData.push({
					name: categories[i],
					y: data[i].y,
					color: data[i].color
				});
		
				// add version data
				for (var j = 0; j < data[i].drilldown.data.length; j++) {
					var brightness = 0.2 - (j / data[i].drilldown.data.length) / 5 ;
					versionsData.push({
						name: data[i].drilldown.categories[j],
						y: data[i].drilldown.data[j],
						color: Highcharts.Color(data[i].color).brighten(brightness).get()
					});
				}
			}
		
			// Create the chart
			$('#alert_types').highcharts({
				chart: {
					type: 'pie',
					backgroundColor: '',
					spacingLeft: 23,
					spacingRight: 47,
					spacingTop: 0
				},
				credits: {enabled: false},
				title: {
					text: ''
				},
				plotOptions: {
					pie: {
						shadow: false,
						center: ['50%', '50%'],
						borderColor: '#CCCCCC'
					}
				},
				tooltip: {
					valueSuffix: ''
				},
				series: [{
					name: 'Continents',
					data: browserData,
					size: '60%',
					dataLabels: {
						formatter: function() {
							return this.y > 5 ? this.point.name +'<br /> <center>'+ this.y: +'</center>'+ null;
						},
						color: 'white',
						distance: -40
					}
				}, {
					name: 'Types',
					data: versionsData,
					size: '80%',
					innerSize: '60%',
					dataLabels: {
						distance: 10,
						formatter: function() {
							// display only if larger than 1
							return this.y > 1 ? '<b>'+ this.point.name +':</b> '+ this.y  : null;
						},
						color: 'white'
					}
				}]
			});
		});
		
	</script>
		</div>
		<div class="content" id="content_right" style="width:200px; float: right; margin-left: 10px; padding-bottom: 5px;">
			<p class="form_headers">Recent Alerts</p>
			
			<!--<a href="all_alerts.php" class="form_item_text" style="margin-left:55px; color: #C00;">View all alerts</a>-->
			<?php 
		
		while ($row = mysql_fetch_array($alerts_list_query)) {
			
			//echo '<a href="BLAH.JPG">';
			
			$row_date = date($row['ResultDateTime']);
			$row_formatted = strtotime($row_date);
			$ResultNC = $row['ResultNC'];
			$ResultTR = $row['ResultTR'];
			$ResultVS = $row['ResultVS'];
			$ResultDraw = $row['ResultDraw'];
			
			if ($ResultNC == "WIN") 
			{
				$winner = "New Congonglomerate";
			} else if ($ResultTR == "WIN")
			{
				$winner = "Terran Republic";
			} else if ($ResultVS == "WIN")
			{
				$winner = "Vanu Sovereignty";
			} else if ($ResultDraw == 1) {
				$winner = "Draw";
			}
			
			echo '<a class="form_item_title" href="alertdetail.php?AlertID='.$row['ResultID'].'">';
			
			echo '<p class="form_item_title">';
			echo date('H', $row_formatted) . ":";
			echo date('i', $row_formatted) . "   ";
			
			echo date('d', $row_formatted) . "-";
			echo date('m', $row_formatted) . "-";
			echo date('y', $row_formatted) . " ";
			echo '</p>';
			echo '</a>';
			
			echo '<p class="form_item_text">';
			
			echo '<span style="color:#F00;">Continent:</span> '.$row["ResultAlertCont"];
			echo "<br />";
			echo '<span style="color:#F00;">Type:</span> '.$row["ResultAlertType"];
			echo "<br />";
			echo '<span style="color:#F00;">Victor:</span> '.$winner;
			echo '</p>';
			
		}
		?>
		</div>
	</div>
</div>
</body>
</html>