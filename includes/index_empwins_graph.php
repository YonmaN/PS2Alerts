<?php

$wins_NC_query = mysql_query ("SELECT ResultID FROM results2 ".$ResultServer_SQL." AND ResultNC = 'WIN' AND CAST(ResultDateTime AS TIME) BETWEEN '$time_start' AND '$time_end'");
$wins_NC = mysql_num_rows($wins_NC_query);
$wins_TR_query = mysql_query ("SELECT ResultID FROM results2 ".$ResultServer_SQL." AND ResultTR = 'WIN' AND CAST(ResultDateTime AS TIME) BETWEEN '$time_start' AND '$time_end'");
$wins_TR = mysql_num_rows($wins_TR_query);
$wins_VS_query = mysql_query ("SELECT ResultID FROM results2 ".$ResultServer_SQL." AND ResultVS = 'WIN' AND CAST(ResultDateTime AS TIME) BETWEEN '$time_start' AND '$time_end'");
$wins_VS = mysql_num_rows($wins_VS_query);
$wins_Draw_query = mysql_query ("SELECT ResultID FROM results2 ".$ResultServer_SQL." AND ResultDraw = 1 AND CAST(ResultDateTime AS TIME) BETWEEN '$time_start' AND '$time_end'");
$wins_Draw = mysql_num_rows($wins_Draw_query);
		
		$wins_NC_amps_query = mysql_query ("SELECT ResultID FROM results2 ".$ResultServer_SQL." AND ResultNC = 'WIN' AND ResultAlertType = 'Amp' AND CAST(ResultDateTime AS TIME) BETWEEN '$time_start' AND '$time_end'");
		$wins_NC_amps = mysql_num_rows($wins_NC_amps_query);
		$wins_NC_bios_query = mysql_query ("SELECT ResultID FROM results2 ".$ResultServer_SQL." AND ResultNC = 'WIN' AND ResultAlertType = 'Bio' AND CAST(ResultDateTime AS TIME) BETWEEN '$time_start' AND '$time_end'");
		$wins_NC_bios = mysql_num_rows($wins_NC_bios_query);
		$wins_NC_techs_query = mysql_query ("SELECT ResultID FROM results2 ".$ResultServer_SQL." AND ResultNC = 'WIN' AND ResultAlertType = 'Tech' AND CAST(ResultDateTime AS TIME) BETWEEN '$time_start' AND '$time_end'");
		$wins_NC_techs = mysql_num_rows($wins_NC_techs_query);
		$wins_NC_territory_query = mysql_query ("SELECT ResultID FROM results2 ".$ResultServer_SQL." AND ResultNC = 'WIN' AND ResultAlertType = 'Territory' AND CAST(ResultDateTime AS TIME) BETWEEN '$time_start' AND '$time_end'");
		$wins_NC_territory = mysql_num_rows($wins_NC_territory_query);
		
		$wins_TR_amps_query = mysql_query ("SELECT ResultID FROM results2 ".$ResultServer_SQL." AND ResultTR = 'WIN' AND ResultAlertType = 'Amp' AND CAST(ResultDateTime AS TIME) BETWEEN '$time_start' AND '$time_end'");
		$wins_TR_amps = mysql_num_rows($wins_TR_amps_query);
		$wins_TR_bios_query = mysql_query ("SELECT ResultID FROM results2 ".$ResultServer_SQL." AND ResultTR = 'WIN' AND ResultAlertType = 'Bio' AND CAST(ResultDateTime AS TIME) BETWEEN '$time_start' AND '$time_end'");
		$wins_TR_bios = mysql_num_rows($wins_TR_bios_query);
		$wins_TR_techs_query = mysql_query ("SELECT ResultID FROM results2 ".$ResultServer_SQL." AND ResultTR = 'WIN' AND ResultAlertType = 'Tech' AND CAST(ResultDateTime AS TIME) BETWEEN '$time_start' AND '$time_end'");
		$wins_TR_techs = mysql_num_rows($wins_TR_techs_query);
		$wins_TR_territory_query = mysql_query ("SELECT ResultID FROM results2 ".$ResultServer_SQL." AND ResultTR = 'WIN' AND ResultAlertType = 'Territory' AND CAST(ResultDateTime AS TIME) BETWEEN '$time_start' AND '$time_end'");
		$wins_TR_territory = mysql_num_rows($wins_TR_territory_query);
		
		$wins_VS_amps_query = mysql_query ("SELECT ResultID FROM results2 ".$ResultServer_SQL." AND ResultVS = 'WIN' AND ResultAlertType = 'Amp' AND CAST(ResultDateTime AS TIME) BETWEEN '$time_start' AND '$time_end'");
		$wins_VS_amps = mysql_num_rows($wins_VS_amps_query);
		$wins_VS_bios_query = mysql_query ("SELECT ResultID FROM results2 ".$ResultServer_SQL." AND ResultVS = 'WIN' AND ResultAlertType = 'Bio' AND CAST(ResultDateTime AS TIME) BETWEEN '$time_start' AND '$time_end'");
		$wins_VS_bios = mysql_num_rows($wins_VS_bios_query);
		$wins_VS_techs_query = mysql_query ("SELECT ResultID FROM results2 ".$ResultServer_SQL." AND ResultVS = 'WIN' AND ResultAlertType = 'Tech' AND CAST(ResultDateTime AS TIME) BETWEEN '$time_start' AND '$time_end'");
		$wins_VS_techs = mysql_num_rows($wins_VS_techs_query);
		$wins_VS_territory_query = mysql_query ("SELECT ResultID FROM results2 ".$ResultServer_SQL." AND ResultVS = 'WIN' AND ResultAlertType = 'Territory' AND CAST(ResultDateTime AS TIME) BETWEEN '$time_start' AND '$time_end'");
		$wins_VS_territory = mysql_num_rows($wins_VS_territory_query);
		
		$wins_Draw_amps_query = mysql_query ("SELECT ResultID FROM results2 ".$ResultServer_SQL." AND ResultDraw = 1 AND ResultAlertType = 'Amp' AND CAST(ResultDateTime AS TIME) BETWEEN '$time_start' AND '$time_end'");
		$wins_Draw_amps = mysql_num_rows($wins_Draw_amps_query);
		$wins_Draw_bios_query = mysql_query ("SELECT ResultID FROM results2 ".$ResultServer_SQL." AND ResultDraw = 1 AND ResultAlertType = 'Bio' AND CAST(ResultDateTime AS TIME) BETWEEN '$time_start' AND '$time_end'");
		$wins_Draw_bios = mysql_num_rows($wins_Draw_bios_query);
		$wins_Draw_techs_query = mysql_query ("SELECT ResultID FROM results2 ".$ResultServer_SQL." AND ResultDraw = 1 AND ResultAlertType = 'Tech' AND CAST(ResultDateTime AS TIME) BETWEEN '$time_start' AND '$time_end'");
		$wins_Draw_techs = mysql_num_rows($wins_Draw_techs_query);
		$wins_Draw_territory_query = mysql_query ("SELECT ResultID FROM results2 ".$ResultServer_SQL." AND ResultDraw = 1 AND ResultAlertType = 'Territory' AND CAST(ResultDateTime AS TIME) BETWEEN '$time_start' AND '$time_end'");
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
							return this.y > 2 ? this.y  : null;
						},
						color: 'white'
					}
				}]
			});
		});
	</script>