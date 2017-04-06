<div id="payment_chart" style="height:500px"></div>
<script type="text/javascript">
        $('#payment_chart').highcharts({
        chart: {
                type: 'column'
            },
            title: {
                text:'Thống kê tài khoản nạp tiền hàng ngày'
            },
            xAxis: {
                categories: [<?=$series?>],
                title:{
                    text: 'Ngày trong tháng'
                } 
            },
            yAxis: {
                title: {
                    text: 'số tài khoản nạp tiền'
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
                name: 'Số lượt nạp tiền',
                data: [<?=$number?>]
            },
                {
                name: 'Số tài khoản nạp tiền',
                data: [<?=$numberIP?>]

            }
            ]
        });
        $('svg text tspan:last').hide();
        $('.highcharts-legend').hide();
</script>
