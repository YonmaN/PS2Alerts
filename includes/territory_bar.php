<script>
$(function () {
	$('#territory_bar_<?php echo $AlertStats["ResultID"] ?>').highcharts({
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
					format: "{y}%"
				}
			}
		},
			series: [{
			name: 'New Congolomerate',
			color: '#0080FF',
			data: [<?php echo $AlertStats["ResultTerritoryNC"] ?>]
		}, {
			name: 'Terran Republic',
			color: '#DF0101',
			data: [<?php echo $AlertStats["ResultTerritoryTR"] ?>]
		}, {
			name: 'Vanu Soverignity',
			color: '#7309AA',
			data: [<?php echo $AlertStats["ResultTerritoryVS"] ?>]
		}]
	});
});
</script>