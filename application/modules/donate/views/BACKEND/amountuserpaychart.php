<div id="payment_chart_amountuser" style="height:500px;padding-top: 10px;"></div>
<script type="text/javascript">
        $('#payment_chart_amountuser').highcharts({
        chart: {
                type: 'column'
            },
            title: {
                text:'Thống kê doanh thu'
            },
            xAxis: {
                categories: [<?=$series?>],
                title:{
                    text: 'Ngày trong tháng'
                } 
            },
            yAxis: {
                title: {
                    text: 'Số tiền người chơi nạp'
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: false
                    },
                    tooltip:{
                        headerFormat:''
                    },
                    enableMouseTracking: true
                }
            },
            series: [{
                name: 'Doanh thu',
                data: [<?=$number?>]
            }]
        });
        $('svg text tspan:last').hide();
        $('.highcharts-legend').hide();
</script>
