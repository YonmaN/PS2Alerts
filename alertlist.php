<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include("includes/includes.php")?>
<title>Alert Stats</title>
</head>

<body>
<div id="wrapper">

	<?php include('includes/header.php') ?>
	
	<div id="float" style="margin-left: auto; margin-right: auto; width: 1050px;">
    
		<div id="content_left" style="width:380px; float: left;">
		
			<div class="content" id="general_stats" style="width: 320px;">
				<p class="form_headers">General Statistics</p>
				
				<?php
				
				date_default_timezone_set('UTC');
				
				$query = mysql_query("SELECT * FROM results2");
				$alerts_list_query = mysql_query("SELECT * FROM results2 ORDER BY ResultDateTime DESC LIMIT 5");
				$alerts_domination_query = mysql_query("SELECT * FROM results2 WHERE ResultDomination = 1 ");
				
				$result_domination = mysql_fetch_array($alerts_domination_query);
				
				$count_submit = mysql_num_rows($query);
				$count_domination = mysql_num_rows($alerts_domination_query);
				
				?>
				
				<p class="form_item_text"><span style="color:#F00; font-size: 22px;"> <?php echo $count_submit ?> </span> Alerts Submitted</p>
				<p class="form_item_text"><span style="color:#F00; font-size: 22px;"> <?php echo $count_domination ?> </span> Alerts Dominated</p>
			</div>
			
			<div class="content" id="chart_container" style="margin-top: 10px; width: 320px;">
				<p class="form_headers" style="font-size: 32px;">Alerts won by <br />Faction &amp; Type</p>
				
				<div id="factions_chart" style="width: 320px; height: 320px;"></div>
	
	<?php
	
	$wins_NC_query = mysql_query ("SELECT * FROM results2 WHERE ResultNC = 2");
	$wins_NC = mysql_num_rows($wins_NC_query);
	$wins_TR_query = mysql_query ("SELECT * FROM results2 WHERE ResultTR = 2");
	$wins_TR = mysql_num_rows($wins_TR_query);
	$wins_VS_query = mysql_query ("SELECT * FROM results2 WHERE ResultVS = 2");
	$wins_VS = mysql_num_rows($wins_VS_query);
	$wins_Draw_query = mysql_query ("SELECT * FROM results2 WHERE ResultDraw = 1");
	$wins_Draw = mysql_num_rows($wins_Draw_query);
	
	$wins_NC_amps_query = mysql_query ("SELECT * FROM results2 WHERE ResultNC = 2 AND ResultAlertType = 'Amp' ");
	$wins_NC_amps = mysql_num_rows($wins_NC_amps_query);
	$wins_NC_bios_query = mysql_query ("SELECT * FROM results2 WHERE ResultNC = 2 AND ResultAlertType = 'Bio' ");
	$wins_NC_bios = mysql_num_rows($wins_NC_bios_query);
	$wins_NC_techs_query = mysql_query ("SELECT * FROM results2 WHERE ResultNC = 2 AND ResultAlertType = 'Tech' ");
	$wins_NC_techs = mysql_num_rows($wins_NC_techs_query);
	$wins_NC_territory_query = mysql_query ("SELECT * FROM results2 WHERE ResultNC = 2 AND ResultAlertType = 'Territory' ");
	$wins_NC_territory = mysql_num_rows($wins_NC_territory_query);
	
	$wins_TR_amps_query = mysql_query ("SELECT * FROM results2 WHERE ResultTR = 2 AND ResultAlertType = 'Amp' ");
	$wins_TR_amps = mysql_num_rows($wins_TR_amps_query);
	$wins_TR_bios_query = mysql_query ("SELECT * FROM results2 WHERE ResultTR = 2 AND ResultAlertType = 'Bio' ");
	$wins_TR_bios = mysql_num_rows($wins_TR_bios_query);
	$wins_TR_techs_query = mysql_query ("SELECT * FROM results2 WHERE ResultTR = 2 AND ResultAlertType = 'Tech' ");
	$wins_TR_techs = mysql_num_rows($wins_TR_techs_query);
	$wins_TR_territory_query = mysql_query ("SELECT * FROM results2 WHERE ResultTR = 2 AND ResultAlertType = 'Territory' ");
	$wins_TR_territory = mysql_num_rows($wins_TR_territory_query);
	
	$wins_VS_amps_query = mysql_query ("SELECT * FROM results2 WHERE ResultVS = 2 AND ResultAlertType = 'Amp' ");
	$wins_VS_amps = mysql_num_rows($wins_VS_amps_query);
	$wins_VS_bios_query = mysql_query ("SELECT * FROM results2 WHERE ResultVS = 2 AND ResultAlertType = 'Bio' ");
	$wins_VS_bios = mysql_num_rows($wins_VS_bios_query);
	$wins_VS_techs_query = mysql_query ("SELECT * FROM results2 WHERE ResultVS = 2 AND ResultAlertType = 'Tech' ");
	$wins_VS_techs = mysql_num_rows($wins_VS_techs_query);
	$wins_VS_territory_query = mysql_query ("SELECT * FROM results2 WHERE ResultVS = 2 AND ResultAlertType = 'Territory' ");
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
  		</div>
		
		<div id="content_middle" class="content" style="width:380px; float: left; padding-left: 10px; padding-right: 10px">
		
		<p class="form_headers">Alert Continents &amp; Types</p>
		
		<div id="alert_types" style="width: 380px; height: 320px;"></div>
		
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
            categories = ['Amerish', 'Esamir', 'Indar', 'Cross'],
            name = 'Alert Contients',
            data = [{
                    y: <?php echo $amerish_total ?>,
                    color: colors[2],
                    drilldown: {
                        name: 'Amerish',
                        categories: ['Amp', 'Bio', 'Tech', 'Territory'],
                        data: [<?php echo $amerish_amp ?>, <?php echo $amerish_bio ?>, <?php echo $amerish_tech ?>, <?php echo $amerish_territory ?>],
                        color: colors[2]
                    }
					
                }, {
                    y: <?php echo $esamir_total ?>,
                    color: '#646CA1',
                    drilldown: {
                        name: 'Esamir',
                        categories: ['Amp', 'Bio', 'Territory'],
                        data: [<?php echo $esamir_amp ?>, <?php echo $esamir_bio ?>, <?php echo $esamir_territory ?>],
                        color: ['#E5E7F1', '#C1C4D1', '#A4A5AF', '#646CA1']
                    }
                }, {
                    y: <?php echo $indar_total ?>,
                    color: '#EFC15E',
                    drilldown: {
                        name: 'Indar',
                        categories: ['Amp', 'Bio', 'Tech', 'Territory'],
                        data: [<?php echo $indar_amp ?>, <?php echo $indar_bio ?>, <?php echo $indar_tech ?>, <?php echo $indar_territory ?>],
                        color: ['#91670D', '#A6853D', '#DBA124', '#EFC15E']
                    }
                }, {
                    y: <?php echo $cross_total ?>,
                    color: colors[3],
                    drilldown: {
                        name: 'Cross',
                        categories: ['Amp', 'Bio', 'Tech'],
                        data: [<?php echo $cross_amp ?>, <?php echo $cross_bio ?>, <?php echo $cross_tech ?>],
                        color: colors[3]
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
	
	<div class="content" id="content_right" style="width:200px; float: left; margin-left: 10px">
    
		<p class="form_headers">Recent Alerts</p>
		
		<?php 
		
		while ($row = mysql_fetch_array($alerts_list_query)) {
			
			//echo '<a href="BLAH.JPG">';
			echo '<p class="form_item_title">';
			$row_date = date($row['ResultDateTime']);
			$row_formatted = strtotime($row_date);
			$ResultNC = $row['ResultNC'];
			$ResultTR = $row['ResultTR'];
			$ResultVS = $row['ResultVS'];
			
			if ($ResultNC == "2") 
			{
				$winner = "New Congonglomerate";
			} else if ($ResultTR == "2")
			{
				$winner = "Terran Republic";
			} else if ($ResultVS == "2")
			{
				$winner = "Vanu Sovereignity";
			} else if ($ResultNC or $ResultTR or $ResultVS == "1") {
				$winner = "Draw";
			}
			
			
			echo date('H', $row_formatted) . ":";
			echo date('i', $row_formatted) . "   ";
			
			echo date('d', $row_formatted) . "-";
			echo date('m', $row_formatted) . "-";
			echo date('y', $row_formatted) . " ";
			echo '</p>';
			
			echo '<p class="form_item_text">';
			
			echo '<span style="color:#F00;">Continent:</span> '.$row["ResultAlertCont"];
			echo "<br />";
			echo '<span style="color:#F00;">Type:</span> '.$row["ResultAlertType"];
			echo "<br />";
			echo '<span style="color:#F00;">Victor:</span> '.$winner;
			
			echo '</p>';
			
			//echo '</a>';
			
		}
		?>
    
  	</div>
	
	</div>


</div>
</body>
</html>