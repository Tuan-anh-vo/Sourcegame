<script src="<?php echo PATH_URL?>static/js/jquery.datetimepicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo PATH_URL?>static/css/jquery.datetimepicker.css"/>
<style>
.wa-confi{padding: 10px 20px;}
#frmStatus{float: left;}
#frmStatus p{text-align: left;height:26px;width:300px;}
#frmStatus p input{float: right;}
.button_add_item{padding:3px 20px;margin: 8px 0 8px 0;}
.wap-add input{margin: 3px 4px;padding: 0px !important;width: 15%;text-indent: 4px;}
#name_server, #date_server{padding: 2px 4px;}
</style>
<script type="text/javascript">
$(document).ready(function(){
	$('#date_server').datetimepicker({
		format:'Y-m-d H:i:00',
	    allowTimes:[
	    	'00:00', '00:30', '01:00', '01:30', '02:00', '02:30', '03:00', '03:30',
	    	'04:00', '04:30', '05:00', '05:30', '06:00', '06:30', '07:00', '07:30',
	    	'08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00', '11:30',
	    	'12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30',
	    	'16:00', '16:30', '17:00', '17:30', '18:00', '18:30', '19:00', '19:30',
	    	'20:00', '20:30', '21:00', '21:30', '22:00', '22:30', '23:00', '23:59'
	    ]
	});

});

function save_sv(){
	$.ajax({
       type:'POST',
       dataType: "JSON",
       url: root+'date_server/save_config',
       data:$('#frmStatus').serialize(),
       cache: false,
            success: function(result){
               if(result.status == 0){
               		$('.msg').html(result.msg);
               }else{
               		$('.msg').html('Lưu thành công !!');
               }
            }           
    });
}
</script>
<div class="gr_perm_error" style="display:none;">
	<p><strong>FAILURE: </strong>Permission Denied.</p>
</div>
<div class="gr_perm_success" style="display:none;">
	<p><strong>SAVE SUCCESS.</strong></p>
</div>

<div id="indexView" class="table">
	<div class="head_table">
		<div class="head_title_table"><?=$module_name?></div>
	</div>	
	<div id="ajax_loadContent_sv">
		<div class="wa-confi"> 
			<form id='frmStatus'>
				<p>Tên server: <input type="text" value="<?php if(isset($setting['name_server'])){ print $setting['name_server']; }?>" name="contentAdmincp[name_server]" id="name_server"></p>
				<p style='margin: 6px 0 8px 0;'>Ngày giờ ra server: <input type="text" value="<?php if(isset($setting['date_server'])){ print $setting['date_server']; }?>"  name="contentAdmincp[date_server]" id="date_server"></p>

				<div class="clear"></div>
				<div class="msg"></div>
				<input onclick="save_sv()" type="button" value="Save" class="button_add_item" >
			</form>
		</div>
		<div class="clearAll"></div>
	</div>
	<div class="clearAll"></div>
</div>

<script type="text/javascript">
	
</script>