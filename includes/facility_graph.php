<script>
		$(function () {
		$('#facility_history').highcharts({
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
			categories: [<?php foreach ($facility_data_dates as $key) {echo "'".$key."', ";}?>],
			tickmarkPlacement: 'on',
			tickInterval: 2,
			title: {
				enabled: false
			}
		},
		yAxis:{title:{text:''},max:<?php echo $max;?>,tickInterval:1},
		legend: {
			enabled: false
		},
		tooltip: {
			shared: true,
			crosshairs:[{width:1,color:'white',zIndex:22}],
			pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b><br/>',
		},
		plotOptions: {
			area: {
				stacking: 'normal',
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
			data: [<?php foreach ($facility_data_VS as $key) {echo "".$key.", ";}?>],
			color: '#7309AA'
		}, {
			name: 'New Conglomerate',
			data: [<?php foreach ($facility_data_NC as $key) {echo "".$key.", ";}?>],
			color: '#080B74'
		}, {
			name: 'Terran Republic',
			data: [<?php foreach ($facility_data_TR as $key) {echo "".$key.", ";}?>],
			color: '#910000'
		}]
	});
});
</script>