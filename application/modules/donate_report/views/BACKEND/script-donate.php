<style>
.ui-datepicker-calendar {
    display: none;
    }
.tab-menu{
	width: 100%;
	clear: both;
	height: 30px;
	background: #1A3A39;
}
.tab-menu li{
	float: left;
}
.tab-menu a{
	margin: 0px 11px 0px 0px;
	display: block;
	background: #2A78AC;
	padding: 8px 20px;
	color: #fff;
	font-weight: bold;
}
.tab-menu a:hover, .tab-menu a.active{
	background: #255F85;
	text-decoration: underline;
}
.content-show{
	width: 100%;
	clear: both;
	margin-top: 25px;
}
#tbl-thongke{
	border-collapse: collapse;
}
#tbl-thongke tr:last-child{
	font-weight: bold;
}
#tbl-thongke td{
	background: #D9E0E0;
}
#tbl-thongke th{
	background: #346C91;
	color: #fff;
	text-align: center;
}
#tbl-thongke th, #tbl-thongke td{
	padding: 10px 43px;
	border: 1px solid #fff;
}
</style>
<script type="text/javascript">
	function chooseServer(){
		var server = $('#select_sv').val();
		var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
        var  month_val = Number(month) + 1;
        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
		$.post(
			root+'donate_report/ajaxReport',
			{
				id : server,
				txtmonth : month_val,
				txtyear : year
			},
			function(response){
				$('#chargeChart').html(response);
				$('#chargeAmountChart').html(response);
				searchContentDonate(0);
			}
		);
	}
</script>
<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script> -->
	<script type="text/javascript">
	$(document).ready(function(){
		loadStatis();
		$( "#byserver" ).change(function() {
		  loadStatis();
		    DateStart = jQuery('#caledar_from').val();
            DateEnd = jQuery('#caledar_to').val();
            //ajaxLoadExchange(Datestart, DateEnd);
            jQuery.ajax({
                type: "POST",
                url: root + "donate_report/ajaxAccountPayChart",
                data: "DateStart="+DateStart+"&DateEnd=" + DateEnd+"&server_id="+$( "#byserver option:selected" ).val(),
                dataType: "text",
                success: function (response) {
                        $('#chargeChart').html(response);
                }
            })
            jQuery.ajax({
                type: "POST",
                url: root + "donate_report/ajaxAmountUserPayChart",
                data: "DateStart="+DateStart+"&DateEnd=" + DateEnd+"&server_id="+$( "#byserver option:selected" ).val(),
                dataType: "text",
                success: function (response2) {
                        $('#chargeAmountChart').html(response2);
                }
            })
		});

		// $("body").on( "change", "#smonth", function(e) {
			
		// 	alert("a");
		// });

		$("body").on( "click", "a.click-menu", function(e) {
			$(".click-menu").removeClass("active");
			$(this).addClass("active");
			e.preventDefault();
		  	data = $(this).data("id");
		  	$(".tab-show").hide();
			$("#"+data).show();
		});
	});
	$(function() {
	    $('.date-picker').datepicker( {
	    	showOn: "button",
	     	buttonImage: root+"static/images/calendar.gif",
		    buttonImageOnly: true,
	     
	        // maxDate: "+0d",
	        changeMonth: true,
	        changeYear: true,
	        showButtonPanel: true,
	        dateFormat: 'MM yy',
	        onClose: function(dateText, inst) { 
	        	// $('.ui-datepicker-calendar').show();
	            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
	            month_val = Number(month) + 1;
	            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
	            $(this).datepicker('setDate', new Date(year, month, 1));
	            loadChart(month_val,year);
	            loadAmountUserChart(month_val,year);
	        },
	        beforeShow : function(input, inst) {
	        	setTimeout(function(){
	        		$('.ui-datepicker-calendar').hide();
	        	},150);
	            if ((datestr = $(this).val()).length > 0) {
	                year = datestr.substring(datestr.length-4, datestr.length);
	                month = jQuery.inArray(datestr.substring(0, datestr.length-5), $(this).datepicker('option', 'monthNames'));
	                $(this).datepicker('option', 'defaultDate', new Date(year, month, 1));
	                $(this).datepicker('setDate', new Date(year, month, 1));
	            }
	        }

	    });
		$('.date-picker').datepicker('setDate', new Date(<?=date('Y')?>,<?=date('n')-1?>,1));

	    $('#caledar_statis').datepicker( {    
	        // maxDate: "+0d",
	        changeMonth: true,
	        changeYear: true,
	        showButtonPanel: true,
	        dateFormat: 'MM yy',
	        onClose: function(dateText, inst) { 
	            $('.ui-datepicker-calendar').show();
	            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
	            month_val = Number(month) + 1;
	            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
	            $(this).datepicker('setDate', new Date(year, month, 1));
	            $('#smonth').val(month_val);
	            $('#syear').val(year);
	            loadStatis();
	        },
	        beforeShow : function(input, inst) {
	            if ((datestr = $(this).val()).length > 0) {
	                year = datestr.substring(datestr.length-4, datestr.length);
	                month = jQuery.inArray(datestr.substring(0, datestr.length-5), $(this).datepicker('option', 'monthNames'));
	                $(this).datepicker('option', 'defaultDate', new Date(year, month, 1));
	                $(this).datepicker('setDate', new Date(year, month, 1));
	            }
	        }

	    });

		$('#caledar_statis').datepicker('setDate', new Date(<?=date('Y')?>,<?=date('n')-1?>,1));
	    $('#caledar_from').datepicker('setDate', new Date(<?=date('Y')?>,<?=date('n')-1?>,1));
	});
	
	function loadChart(month, year){
		var server = $('#select_sv').val();
		$.post(
			root+'donate_report/ajaxAccountPayChart/'+server+'/'+month+'/'+year,
			{},
			function(response){
				if(response.length>0){
					$('#chargeChart').html(response);
				}
			}
			)
	}

	function loadAmountUserChart(month, year){
		var server = $('#select_sv').val()
		console.log(server);
		$.post(
				root+'donate_report/ajaxAmountUserPayChart/'+server+'/'+month+'/'+year,
				{},
				function(response){
					if(response.length>0){
						$('#chargeAmountChart').html(response);
					}
				}
				)
		}

		function loadStatis(){
			// alert($("#smonth").val());
			server = $( "#byserver option:selected" ).val();
			jQuery.ajax({
			 type:"POST",
			 url:root+'donate_report/statisByChannel/', //goi toi file ajax.php
			 data: "month=" + $("#smonth").val() + "&year="+$("#syear").val()+"&server="+server,
			 success:function(html){
			  jQuery(".ajaxstatis").html(html);
			 }
			});
		}
	</script>