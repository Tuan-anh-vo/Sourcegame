<style>
.ui-datepicker-calendar {
    display: none;
    }

</style>
<script type="text/javascript">
	function chooseServer(){
		var server = $('#select_sv').val();
		var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
        var  month_val = Number(month) + 1;
        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
		$.post(
			root+'donate/ajaxReport',
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
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
	<script type="text/javascript">
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
	        	$('.ui-datepicker-calendar').show();
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

	    $('.date-picker2').datepicker( {    
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
	            $('#hdDate').val(year+'-'+month_val+'-1');
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

	    $('#caledar_from').datepicker('setDate', new Date(<?=date('Y')?>,<?=date('n')-1?>,1));
	});
	
	function loadChart(month, year){
		var server = $('#select_sv').val();
		$.post(
			root+'donate/ajaxAccountPayChart/'+server+'/'+month+'/'+year,
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
				root+'donate/ajaxAmountUserPayChart/'+server+'/'+month+'/'+year,
				{},
				function(response){
					if(response.length>0){
						$('#chargeAmountChart').html(response);
					}
				}
				)
		}
	</script>
Thống kê theo máy chủ :
<select style="width: 200px; height: 25px;" id="select_sv" onchange="chooseServer()">
	<option value="0">[Tất cả]</option>
	<?php
	foreach($list_server as $item){
	?>
	<option value="<?=$item->id?>"><?=$item->name?></option>
	<?php 
	}
	?>
</select>
<div id="ajax-report" style="margin-top: 15px">
	<input type="hidden" value="<?php ($this->session->userdata('start'))? print $this->session->userdata('start') : print 0 ?>" id="start" />
	<input type="hidden" value="<?=$default_func?>" id="func_sort" />
	<input type="hidden" value="<?=$default_sort?>" id="type_sort" />
	- Tổng doanh thu trong ngày: <strong style="font-size: 16px;"><?=number_format($donation_member,0,'','.')?> tài khoản nạp vào <?=number_format($donation_today[0]->card_amount,0,'','.')?> VNĐ</strong><br/>
	- Tổng doanh thu: <strong style="font-size: 16px;"><?=number_format($donation_full[0]->card_amount,0,'','.')?> VNĐ</strong><br/>
	<div class="clearAll"></div>
	<div class="fright" style="float:right;margin-right:50px;font-size:16px">
		Thời gian thống kê: <input style="padding:3px" readonly="readonly" name="startDate" id="startDate" class="date-picker" />
	</div>
	<div class="clearAll"></div>
	<div id="chargeChart" style="width: 98%;height: 500px;padding: 10px">
		<?=$list_charge?>
	</div>

	<div class="clearAll"></div>
	<div id="chargeAmountChart" style="width: 98%;height: 500px;padding: 10px">
		<?=$list_charge_amount?>
	</div>
<input type="hidden" id="hdDate" value="<?=date('Y')."-".date('n')."-1"?>">

	<div class="gr_perm_error" style="display:none;">
		<p><strong>FAILURE: </strong>Permission Denied.</p>
	</div>
	<div class="gr_perm_success" style="display:none;">
		<p><strong>SAVE SUCCESS.</strong></p>
	</div>
	<div id="indexView" class="table">
		<div class="head_table">
			<div class="head_title_table"><?=$module_name?> | Total: <?=number_format($total,0,'','.')?> VND</div>
			<div class="head_search">
				<div class="head_search_title fontface" style="margin-top: 9px">Search | </div>
				<div class="head_search_title">From:</div>
				<div class="head_search_input"><input onkeypress="return enterSearchDonate(event)" id="caledar_from" type="text" /></div>
				<div class="head_search_title">To:</div>
				<div class="head_search_input"><input onkeypress="return enterSearchDonate(event)" id="caledar_to" type="text" /></div>
				<div class="head_search_title">Content:</div>
				<div class="head_search_input"><input onkeypress="return enterSearchDonate(event)" id="search_content" onclick="if(this.value=='type here...'){this.value=''}" onblur="if(this.value==''){this.value='type here...'}" class="input_last" type="text" value="type here..." /><div onclick="searchContentDonate(0)" class="bt_search"><img alt="Button search" src="<?=PATH_URL.'static/images/admin/icons/searchSmall.png'?>" /></div></div>
			</div>
		</div>
		<div class="clearAll"></div>
		
		<div id="ajax_loadContent"><img class="loading" alt="Ajax Loader" src="<?=PATH_URL.'static/images/admin/ajax-loader.gif'?>" /></div>
	</div>

	
</div>