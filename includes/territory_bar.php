<script>
	$(function () {
	$('#territory_bar').highcharts({
		chart: {
			type: 'bar',
			backgroundColor: ''
		},
		credits: {enabled: false},
		title: {
			text: ''
		},
		xAxis: {
			categories: 'Territory'
		},
		yAxis: {
			min: 0,
			max: 100
		},
		legend: {
			backgroundColor: '#FFFFFF',
			reversed: true
		},
		plotOptions: {
			series: {
				stacking: 'normal',
					dataLabels: {
						color: '#FFF',
						enabled: true
					}
			},
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