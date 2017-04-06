<?=$this->load->view("BACKEND/script-donate")?>

<?php
	$useradmin = $this->session->userdata('userInfo');
    $admin = $this->model->get("*", "admin_nqt_users", "`username` = '$useradmin'");
    if($admin){
        //pr($admin,1);
        if($admin->group_id == 1){
        	?>
        	<ul class="tab-menu"><li><a class="click-menu active" href="javascript:;" data-id="tab-donate">Doanh Thu</a></li><li><a  class="click-menu" href="javascript:;" data-id="tab-statis">Thống Kê Theo Kênh</a></li></ul>
        	<?php
        }
    }

?>

<select id="byserver" style="padding: 10px;">
                <option value="0">Tất cả server</option>
                <?php if($list_server){
                    foreach ($list_server as $key => $value) {
                  
                    ?>
                    <option value="<?=$value->id?>"><?=$value->name?></option>
                    <?php }
                      }
                    ?>
      
</select>
<div class="clear"></div>
<div id="tab-donate" class="tab-show">
	<div class="content-show">
	<!-- Thống kê theo máy chủ :
		<select style="width: 200px; height: 25px;" id="select_sv" onchange="chooseServer()">
		<option value="0">[Tất cả]</option>
		<?php
		foreach($list_server as $item){
		?>
		<option value="<?=$item->id?>"><?=$item->name?></option>
		<?php 
		}
		?>
	</select> -->
    <style type="text/css">
    .daterangepicker{
        display: block;
        top: 88px;
        right: 29.765625px;
        left: auto;
        min-width: 200px;
    }
    </style>
	 <div class="well" style="overflow: auto">
            <div id="reportrange" class="pull-right"
                 style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                Thống kê theo ngày:
                <i class="glyphicon glyphicon-calendar icon-calendar icon-large"></i>
                <span></span> <b class="caret"></b>
            </div>

            <script type="text/javascript">
                $(document).ready(function () {
                    $('#reportrange').daterangepicker(
                        {
                            startDate: moment().subtract('days', 29),
                            endDate: moment(),
                            minDate: '01/01/2012',
                            maxDate: '12/31/2020',
                            dateLimit: { days: 60 },
                            showDropdowns: true,
                            showWeekNumbers: true,
                            timePicker: true,
                            timePickerIncrement: 30,
                            timePicker12Hour: true,
                            ranges: {
                                'Hôm nay': [moment(), moment()],
                                'Hôm qua': [moment().subtract('days', 1), moment().subtract('days', 1)],
                                'Tuần trước': [moment().subtract('days', 6), moment()],
                                '30 ngày gần nhất': [moment().subtract('days', 29), moment()],
                                'Tháng này': [moment().startOf('month'), moment().endOf('month')],
                                'Tháng trước': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                            },
                            opens: 'left',
                            buttonClasses: ['btn btn-default'],
                            applyClass: 'btn-small btn-primary',
                            cancelClass: 'btn-small',
                            format: 'MM/DD/YYYY HH:mm:ss',
                            separator: ' to ',
                            locale: {
                                applyLabel: 'OK',
                                fromLabel: 'Từ',
                                toLabel: 'Đến',
                                customRangeLabel: 'Tùy chọn',
                                daysOfWeek: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
                                monthNames: ['Th.1', 'Th.2', 'Th.3', 'Th.4', 'Th.5', 'Th.6', 'Th.7', 'Th.8', 'Th.9', 'Th.10', 'Th.11', 'Th.12'],
                                firstDay: 1
                            }
                        },
                        function (start, end) {
                            $('#reportrange span, #updateTime, #updateTime0').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));

                            DateStart = start.format('YYYY-MM-DD HH:mm:ss');
                            DateEnd = end.format('YYYY-MM-DD HH:mm:ss');
                            jQuery('#caledar_from').val(start.format('YYYY-MM-DD HH:mm:ss'));
                            jQuery('#caledar_to').val(end.format('YYYY-MM-DD HH:mm:ss'));
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
                        }

                    );
                    //Set the initial state of the picker label
                    //$('#reportrange span').html(moment().subtract('days', 10).format('DD/MM/YYYY HH:mm:ss') + ' - ' + moment().format('DD/MM/YYYY HH:mm:ss'));
                    var label_time = moment().format('01/MM/YYYY') + ' - ' + moment().format('DD/MM/YYYY');
                    $('#reportrange span').html(label_time);
                    $('#updateTime, #updateTime0').html(label_time);
                });

                function ajaxLoadExchange(start, end) {
                    like = $('#search_content').val();
                    like = like == 'type here...' ? '' : like;
                    page = $('#per_page').val();
                    if (page == undefined) {
                        per_page = 50;
                    }
                    else {
                        per_page = page;
                    }
                    $.post(
                        root + 'donate/admincp_ajaxLoadContentExchange/' + start + '/' + end + '/' + per_page + '/' + like,
                        {},
                        function (response) {
                            if (response.length > 0) {
                                $('#ajax_loadContent').html(response);
                                $('#updateTime, #updateTime0').html($('#reportrange span').html());
                                setTimeout(function(){
                                    $('#updateTime, #updateTime0').html($('#reportrange span').html());
                                },500);
                            }
                        }
                    )
                }
                $(function () {
                        
                        $('.date-picker2').datepicker({
                            minDate: new Date(2013, 5 - 1, 1),
                            // maxDate: "+0d",
                            changeMonth: true,
                            changeYear: true,
                            showButtonPanel: true,
                            dateFormat: 'MM yy',
                            onClose: function (dateText, inst) {
                                $('.ui-datepicker-calendar').show();
                                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                                month_val = Number(month) + 1;
                                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                                $(this).datepicker('setDate', new Date(year, month, 1));
                                $('#hdDate').val(year + '-' + month_val + '-1');
                            },
                            beforeShow: function (input, inst) {
                                if ((datestr = $(this).val()).length > 0) {
                                    year = datestr.substring(datestr.length - 4, datestr.length);
                                    month = jQuery.inArray(datestr.substring(0, datestr.length - 5), $(this).datepicker('option', 'monthNames'));
                                    $(this).datepicker('option', 'defaultDate', new Date(year, month, 1));
                                    $(this).datepicker('setDate', new Date(year, month, 1));
                                }
                            }

                        });

                        $("#DateStart").datepicker({
                            changeMonth: true,
                            changeYear: true,
                            dateFormat: "yy-mm-dd",
                            yearRange: "1930:2050"
                        });

                        $("#DateEnd").datepicker({
                            changeMonth: true,
                            changeYear: true,
                            dateFormat: "yy-mm-dd",
                            yearRange: "1930:2050"
                        });

                        $('#caledar_from').datepicker('setDate', new Date(<?=date('Y')?>, <?=date('n')-1?>, 1));
                    });

            </script>
        </div>
    </div>
    <div class="clearAll"></div>
	<div id="ajax-report" style="margin-top: 15px">
		<input type="hidden" value="<?php ($this->session->userdata('start'))? print $this->session->userdata('start') : print 0 ?>" id="start" />
		<input type="hidden" value="<?=$default_func?>" id="func_sort" />
		<input type="hidden" value="<?=$default_sort?>" id="type_sort" />
		- Tổng doanh thu trong ngày: <strong style="font-size: 16px;"><?=number_format($donation_member,0,'','.')?> tài khoản nạp vào <?=number_format($donation_today[0]->card_amount,0,'','.')?> VNĐ</strong><br/>
		- Tổng doanh thu từ ngày ra game: <strong style="font-size: 16px;"><?=number_format($donation_full[0]->card_amount,0,'','.')?> VNĐ</strong><br/>
        - Tổng người nạp: <strong style="font-size: 16px;"><?=$total_person?> người</strong><br/>
        - Trung Bình người nạp: <strong style="font-size: 16px;"><?=number_format($donation_full[0]->card_amount/$total_person,0,'','.')?> VNĐ / người</strong><br/>
        
		<div class="clearAll"></div>
		<!-- <div class="fright" style="float:right;margin-right:50px;font-size:16px">
			Thống kê theo tháng: <input style="padding:3px" readonly="readonly" name="startDate" id="startDate" class="date-picker" />
		</div> -->
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
		<div id="indexView" style="margin-top: 102px;clear: both;" class="table">
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

	</div>
	
</div>

<div id="tab-statis" class="tab-show" style="display:none;">
	<div class="content-show">
	<!-- <input onkeypress="return enterSearchDonate(event)" id="caledar_from" type="text" /> -->	
			<input  id="caledar_statis" type="text" style="padding: 9px;margin-bottom: 14px;" />
            
			<input type="hidden" id="smonth" value="<?=date("n")?>"> <input type="hidden" id="syear" value="<?=date("Y")?>">
			<div class="ajaxstatis"></div>
	</div>
</div>

<style type="text/css">
    .well{
       width: 499px;
    }
</style>
