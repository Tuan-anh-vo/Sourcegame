<script src="<?php echo PATH_URL?>static/js/jquery.datetimepicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo PATH_URL?>static/css/jquery.datetimepicker.css"/>
<script type="text/javascript">
$(document).ready( function() {
	/* $("#titleAdmincp").slugIt({
		events: 'keyup blur',
		output: '#slugAdmincp',
		space: '-'
	}); */
});

function save(){
	var options = {
		beforeSubmit:  showRequest,  // pre-submit callback 
		success:       showResponse  // post-submit callback 
    };
	$('#frmManagement').ajaxSubmit(options);
}

function showRequest(formData, jqForm, options) {
	var form = jqForm[0];
	if(form.titleAdmincp.value == ''){
		$('#txt_error').html('Please enter information!!!');
		$('#loader').fadeOut(300);
		show_perm_denied();
		return false;
	}
}

function showResponse(responseText, statusText, xhr, $form) {
	if(responseText=='success'){
		location.href=root+"admincp/"+module+"/#/save";
	}
	
	if(responseText=='error-title-exists'){
		$('#txt_error').html('Title already exists!!!');
		$('#loader').fadeOut(300);
		show_perm_denied();
		$('#titleAdmincp').focus();
		return false;
	}
	if(responseText=='no-url'){
        $('#txt_error').html('Link no syntax!!!');
        $('#loader').fadeOut(300);
        show_perm_denied();
        $('#titleAdmincp').focus();
        return false;
    }
	if(responseText=='error-slug-exists'){
		$('#txt_error').html('Slug already exists!!!');
		$('#loader').fadeOut(300);
		show_perm_denied();
		$('#slugAdmincp').focus();
		return false;
	}
	if(responseText=='error-no-server'){
		$('#txt_error').html('Bạn chưa chọn server!!!');
		$('#loader').fadeOut(300);
		show_perm_denied();
		return false;
	}

	if(responseText=='permission-denied'){
		show_perm_denied();
	}
}

$(document).ready(function(){

	$('#date_start').datetimepicker({
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
	$('#date_end').datetimepicker({
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

})

$(document).ready(function() {
    $('#selecctall').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });
    
});

</script>
<div class="gr_perm_error" style="display:none;">
	<p><strong>FAILURE: </strong><span id="txt_error">Permission Denied.</span></p>
</div>
<div class="table">
	<div class="head_table"><div class="head_title_edit"><?=$module?></div></div>
	<div class="clearAll"></div>

	<form id="frmManagement" action="<?=PATH_URL.'admincp/'.$module.'/save/'?>" method="post" enctype="multipart/form-data">
	<input type="hidden" value="<?=$id?>" name="hiddenIdAdmincp" />
	<div class="row_text_field_first">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Status:</td>
				<td class="right_text_field"><input <?php if(isset($result->status)){ if($result->status==1){ ?>checked="checked"<?php }}else{ ?>checked="checked"<?php } ?> type="checkbox" class="custom_chk" name="statusAdmincp" /></td>
			</tr>
		</table>
	</div>

	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Tiêu đề:</td>
				<td class="right_text_field"><input value="<?php if(isset($result->title)) { print $result->title; }else{ print '';} ?>" type="text" name="titleAdmincp" id="titleAdmincp" /></td>
			</tr>
		</table>
	</div>
	<style type="text/css">
		.ls_dv li{
			width: 200px;
			float: left;
		}
	</style>
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Máy chủ:</td>
				<td class="right_text_field">
					<ul class="ls_dv">
						<li><label><input type="checkbox" id="selecctall" ><b> Tất cả</b></label></li>
						<?php
							foreach($servers as $item){
							?>
							<li><label><input id="check_server_<?=$item->id?>" name="servers[]" type="checkbox" class="checkbox1" value="<?php echo $item->id;?>">
									<?=$item->name?></label>
								</li>	
							<?php
							}
						?>
					</ul>

				</td>
			</tr>
		</table>
	</div>

	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field" style="padding: 5px px;">Thời gian bắt đầu</td>
				<td  style="padding: 0px 5px;"><input value="<?php if(isset($result->start_time)) { print date("Y-m-d H:i:s",strtotime($result->start_time)); }else{ print "";} ?>" name="start_time" id="date_start" type="text"></td>
			</tr>
		</table>
	</div>

	<div style="clear:both"></div>
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field" style="padding: 5px 0px;">Thời gian kết thúc</td>
				<td  style="padding: 0px 5px;"><input value="<?php if(isset($result->end_time)) { print date("Y-m-d H:i:s",strtotime($result->end_time)); }else{ print "";} ?>"  name="end_time" id="date_end" type="text"></td>
			</tr>
		</table>
	</div>

	

    
	<div class="row_text_field">
            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                <tr>
                    <td class="left_text_field">Content:</td>
                    <td class="right_text_field" style="padding-right: 0px;max-height:300px;">
                        <?=createEditor('contentAdmincp', @$result->content)?>
                        <!-- <textarea name="contentAdmincp" id="contentAdmincp" cols="" rows="8"><?php if(isset($result->content)) { print $result->content; }else{ print '';} ?></textarea>
                        <script type="text/javascript">
                            var oEdit1 = new InnovaEditor("oEdit1");
                            oEdit1.width = "100%";
                            oEdit1.cmdAssetManager="modalDialogShow('"+root+"static/editor/assetmanager/assetmanager.php',640,445);";
                            oEdit1.REPLACE("contentAdmincp");
                        </script> -->
                    </td>
                </tr>
        </table>
    </div>
    
	</form>
</div>


<script>
	$(document).ready(function(){
		<?php
		if(isset($result->server_id)){
			$server_arr = explode('-', $result->server_id);
			foreach ($server_arr as $key => $value) {
				if($value!="")
				  echo "$('#check_server_".$value."').attr('checked','checked');";
			}
		}	
	?>
});

</script>