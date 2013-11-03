<script>
		$(function () {
		$('#territory_percentages').highcharts({
		chart: {
			type: 'area',
			backgroundColor: ''
		},
		title: {
			text: ''
		},
		credits:{enabled: false},
		exporting:{enabled: false},
		xAxis: {
			categories: [<?php foreach ($territory_data_dates as $key) {echo "'".$key."', ";}?>],
			tickmarkPlacement: 'on',
			tickInterval: 2,
			title: {
				enabled: false
			}
		},
		yAxis: {
			title: {
				text: ''
			},
			labels: {
				formatter: function() {
					return this.value;
				}
			}
		},
		legend: {
			enabled: false
		},
		tooltip: {
			shared: true,
			crosshairs:[{width:1,color:'white',zIndex:22}],
			pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.percentage:.0f}%</b><br/>',
		},
		plotOptions: {
			area: {
				stacking: 'percent',
				lineColor: '#ffffff',
				lineWidth: 1,
				fillOpacity: 0.85,
				marker: {
					lineWidth: 1,
					lineColor: '#CCCCCC'
				}
			}
		},
		series: [{
			name: 'Vanu Soverignity',
			data: [<?php foreach ($territory_data_VS as $key) {echo "".$key.", ";}?>],
			color: '#7309AA'
		}, {
			name: 'New Conglomerate',
			data: [<?php foreach ($territory_data_NC as $key) {echo "".$key.", ";}?>],
			color: '#080B74'
		}, {
			name: 'Terran Republic',
			data: [<?php foreach ($territory_data_TR as $key) {echo "".$key.", ";}?>],
			color: '#910000'
		}]
	});
});
    </script>