<script>
	$(function () {
    
        var colors = Highcharts.getOptions().colors,
            categories = ['Indar', 'Amerish', 'Esamir'],
            name = 'Continents',
            data = [{
                    y: <?php echo $indar ?>,
                    color: '#D69D27',
                    drilldown: {
                        name: 'Indar',
                        categories: [<?php echo "'".$keys[7]."', '".$keys[9]."', '".$keys[11]."'"?>],
                        data: [<?php echo $fac1.", ".$fac2.", ".$fac3 ?>],
						color: ['#FAC14B', '#EDB540', '#E3A930', '#D69D27']
                    }
                }, {
                    y: <?php echo $amerish ?>,
                    color: '#63C716',
                    drilldown: {
                        name: 'Amerish',
                        categories: [<?php echo "'".$keys[13]."', '".$keys[15]."', '".$keys[17]."'"?>],
                        data: [<?php echo $fac4.", ".$fac5.", ".$fac6?>],
						color: ['#93FA43', '#86ED37', '#78E028', '#63C716']
                        
                    }
                }, {
                    y: <?php echo $esamir ?>,
                    color: '#A3C3FF',
                    drilldown: {
                        name: 'Esamir',
                        categories: [<?php echo "'".$keys[19]."', '".$keys[21]."', '".$keys[23]."'"?>],
                        data: [<?php echo $fac7.", ".$fac8.", ".$fac9?>],
						color: ['#C7DBFF', '#B3CDFF', '#A3C3FF']
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
        $('#facility_votes_graph').highcharts({
            chart: {
                type: 'pie',
				backgroundColor: '',
				spacingLeft: 0,
				spacingRight: 0,
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
                name: 'Total Changes',
                data: browserData,
                size: '50%',
                dataLabels: {
                    formatter: function() {
                        return this.y > 0 ? this.point.name : null;
                    },
                    color: 'white',
                    distance: -45
                }
            }, {
                name: 'Changes',
                data: versionsData,
                size: '90%',
                innerSize: '50%',
                dataLabels: {
                    formatter: function() {
                        // display only if larger than 1
                        return this.y > 0 ? '<b>' + this.point.name +':</b> '+ this.y  : null;
                    },
					distance: -35,
					color: '#D70005'
                }
            }]
        });
    });

</script>