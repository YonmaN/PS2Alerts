		<?php
		
		$amerish_amp_query = mysql_query("SELECT * FROM results2 ".$ResultServer_SQL." AND ResultAlertCont = 'Amerish' AND ResultAlertType = 'Amp' AND CAST(ResultDateTime AS TIME) BETWEEN '$time_start' AND '$time_end'");
		$amerish_amp = mysql_num_rows($amerish_amp_query);
		$amerish_bio_query = mysql_query("SELECT * FROM results2 ".$ResultServer_SQL." AND ResultAlertCont = 'Amerish' AND ResultAlertType = 'Bio' AND CAST(ResultDateTime AS TIME) BETWEEN '$time_start' AND '$time_end'");
		$amerish_bio = mysql_num_rows($amerish_bio_query);
		$amerish_tech_query = mysql_query("SELECT * FROM results2 ".$ResultServer_SQL." AND ResultAlertCont = 'Amerish' AND ResultAlertType = 'Tech' AND CAST(ResultDateTime AS TIME) BETWEEN '$time_start' AND '$time_end'");
		$amerish_tech = mysql_num_rows($amerish_tech_query);
		$amerish_territory_query = mysql_query("SELECT * FROM results2 ".$ResultServer_SQL." AND ResultAlertCont = 'Amerish' AND ResultAlertType = 'Territory' AND CAST(ResultDateTime AS TIME) BETWEEN '$time_start' AND '$time_end'");
		$amerish_territory = mysql_num_rows($amerish_territory_query);
		
		$esamir_amp_query = mysql_query("SELECT * FROM results2 ".$ResultServer_SQL." AND ResultAlertCont = 'Esamir' AND ResultAlertType = 'Amp' AND CAST(ResultDateTime AS TIME) BETWEEN '$time_start' AND '$time_end'");
		$esamir_amp = mysql_num_rows($esamir_amp_query);
		$esamir_bio_query = mysql_query("SELECT * FROM results2 ".$ResultServer_SQL." AND ResultAlertCont = 'Esamir' AND ResultAlertType = 'Bio' AND CAST(ResultDateTime AS TIME) BETWEEN '$time_start' AND '$time_end'");
		$esamir_bio = mysql_num_rows($esamir_bio_query);
		$esamir_territory_query = mysql_query("SELECT * FROM results2 ".$ResultServer_SQL." AND ResultAlertCont = 'Esamir' AND ResultAlertType = 'Territory' AND CAST(ResultDateTime AS TIME) BETWEEN '$time_start' AND '$time_end'");
		$esamir_territory = mysql_num_rows($esamir_territory_query);
		
		$indar_amp_query = mysql_query("SELECT * FROM results2 ".$ResultServer_SQL." AND ResultAlertCont = 'Indar' AND ResultAlertType = 'Amp' AND CAST(ResultDateTime AS TIME) BETWEEN '$time_start' AND '$time_end'");
		$indar_amp = mysql_num_rows($indar_amp_query);
		$indar_bio_query = mysql_query("SELECT * FROM results2 ".$ResultServer_SQL." AND ResultAlertCont = 'Indar' AND ResultAlertType = 'Bio' AND CAST(ResultDateTime AS TIME) BETWEEN '$time_start' AND '$time_end'");
		$indar_bio = mysql_num_rows($indar_bio_query);
		$indar_tech_query = mysql_query("SELECT * FROM results2 ".$ResultServer_SQL." AND ResultAlertCont = 'Indar' AND ResultAlertType = 'Tech' AND CAST(ResultDateTime AS TIME) BETWEEN '$time_start' AND '$time_end'");
		$indar_tech = mysql_num_rows($indar_tech_query);
		$indar_territory_query = mysql_query("SELECT * FROM results2 ".$ResultServer_SQL." AND ResultAlertCont = 'Indar' AND ResultAlertType = 'Territory' AND CAST(ResultDateTime AS TIME) BETWEEN '$time_start' AND '$time_end'");
		$indar_territory = mysql_num_rows($indar_territory_query);
		
		$cross_amp_query = mysql_query("SELECT * FROM results2 ".$ResultServer_SQL." AND ResultAlertCont = 'Cross' AND ResultAlertType = 'Amp' AND CAST(ResultDateTime AS TIME) BETWEEN '$time_start' AND '$time_end'");
		$cross_amp = mysql_num_rows($cross_amp_query);
		$cross_bio_query = mysql_query("SELECT * FROM results2 ".$ResultServer_SQL." AND ResultAlertCont = 'Cross' AND ResultAlertType = 'Bio' AND CAST(ResultDateTime AS TIME) BETWEEN '$time_start' AND '$time_end'");
		$cross_bio = mysql_num_rows($cross_bio_query);
		$cross_tech_query = mysql_query("SELECT * FROM results2 ".$ResultServer_SQL." AND ResultAlertCont = 'Cross' AND ResultAlertType = 'Tech' AND CAST(ResultDateTime AS TIME) BETWEEN '$time_start' AND '$time_end'");
		$cross_tech = mysql_num_rows($cross_tech_query);
		
		$amerish_total_query = mysql_query ("SELECT * FROM results2 ".$ResultServer_SQL." AND ResultAlertCont = 'Amerish' AND CAST(ResultDateTime AS TIME) BETWEEN '$time_start' AND '$time_end'");
		$amerish_total = mysql_num_rows($amerish_total_query);
		$esamir_total_query = mysql_query ("SELECT * FROM results2 ".$ResultServer_SQL." AND ResultAlertCont = 'Esamir' AND CAST(ResultDateTime AS TIME) BETWEEN '$time_start' AND '$time_end'");
		$esamir_total = mysql_num_rows($esamir_total_query);
		$indar_total_query = mysql_query ("SELECT * FROM results2 ".$ResultServer_SQL." AND ResultAlertCont = 'Indar' AND CAST(ResultDateTime AS TIME) BETWEEN '$time_start' AND '$time_end'");
		$indar_total = mysql_num_rows($indar_total_query);
		$cross_total_query = mysql_query ("SELECT * FROM results2 ".$ResultServer_SQL." AND ResultAlertCont = 'Cross' AND CAST(ResultDateTime AS TIME) BETWEEN '$time_start' AND '$time_end'");
		$cross_total = mysql_num_rows($cross_total_query);
				
		?>
				<script>
						
				$(function () {
			
				var colors = Highcharts.getOptions().colors,
					categories = ['Amerish', 'Esamir', 'Indar', 'Global']
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
						<?php if ($time_filter == "offpeak") 
						{
							echo 'spacingLeft: 50,';
							echo 'spacingRight: 70,';
						}
						else
						{
							echo 'spacingLeft: 30,';
							echo 'spacingRight: 57,';
						} ?>

						spacingTop: 0,
						spacingBottom: 0
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
						name: 'Continant Alerts',
						data: browserData,
						size: '65%',
						dataLabels: {
							align: 'center',
							style: {
								textAlign: 'center'
							},
							formatter: function() {
								return this.y > 10 ? this.point.name +'<br />'+ this.y:+ null;
							},
							color: 'white',
							distance: -45
						}
					}, {
						name: 'Alerts',
						data: versionsData,
						size: '80%',
						innerSize: '65%',
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