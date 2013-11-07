<script>
$(function () {
	$('#territory_bar_new_<?php echo $AlertStats["ResultID"] ?>').highcharts({
		chart: {
			backgroundColor: '',
			type: 'bar',
			spacing: [5, 10, 5, 10]
		},
		credits: {enabled: false},
		title: {text: ''},
		xAxis: {
			categories: ['']
			},
		yAxis: {
			min: 0,
			max: 100,
			title: {
				text: ''
			}
		},
		legend: {enabled: false},
		tooltip: {enabled: false},
		plotOptions: {
			series: {
				stacking: 'normal',
				dataLabels: {
					enabled: true,
					color: '#FFFFFF',
					format: "{point.y:.0f}%"
				}
			}
		},
			series: [{
			name: 'New Congolomerate',
			color: '#0080FF',
			data: [<?php echo $AlertStatsTerritory["TerritoryNC"] ?>]
		}, {
			name: 'Terran Republic',
			color: '#DF0101',
			data: [<?php echo $AlertStatsTerritory["TerritoryTR"] ?>]
		}, {
			name: 'Vanu Soverignity',
			color: '#7309AA',
			data: [<?php echo $AlertStatsTerritory["TerritoryVS"] ?>]
		}]
	});
});
</script>