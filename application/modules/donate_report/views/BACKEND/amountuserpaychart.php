<div><span style="font-size: 17px"><b>Thống kê theo thời điểm:</b></span></div>
<div><span style="font-size: 17px">Doanh thu: <span style="color:blue"><?=number_format($alltotal,0,',','.')?> VNĐ</span></span></div>
<div><span style="font-size: 17px">Doanh thu(- 20% Tổng doanh số): <span style="color:blue"><?=number_format($total,0,',','.')?> VNĐ</span></span></div>
<div><span style="font-size: 17px">Số người nạp: <span style="color:blue"><?=$countchargeUser?></span></span></div>
<div><span style="font-size: 17px">Trung bình nạp: <span style="color:blue"><?php if($countchargeUser != 0) echo number_format($total/$countchargeUser,0,',','.'); else echo 0; ?> / người</span></span></div>
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
