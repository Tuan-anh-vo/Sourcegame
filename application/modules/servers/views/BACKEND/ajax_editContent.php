<link rel="stylesheet" href="<?php echo PATH_URL;?>static/css/jquery.datetimepicker.css">
<script type="text/javascript" src="<?=PATH_URL.'static/js/admin/jquery.slugit.js'?>"></script>
<script type="text/javascript" src="<?php echo PATH_URL;?>static/js/jquery.datetimepicker.js"></script>
<script type="text/javascript">
$(document).ready( function() {
	$("#titleAdmincp").slugIt({
		events: 'keyup blur',
		output: '#slugAdmincp',
		space: '-'
	});
	$("#playtimeAdmincp").datetimepicker({
        lang:'vi',
        i18n:{vi:{
            months:[
            'Tháng 1','Tháng 2','Tháng 3','Tháng 4','Tháng 5','Tháng 6','Tháng 7','Tháng 8','Tháng 9','Tháng 10','Tháng 11','Tháng 12'
            ],
            dayOfWeek:["T.2", "T.3", "T.4", "T.5", "T.6", "T.7", "CN."]
        }},
        timepicker:false,
        format:'Y-m-d H:i:s'
    });
});

function save(){
	var options = {
		beforeSubmit:  showRequest,  // pre-submit callback 
		success:       showResponse  // post-submit callback 
    };
    $('#descriptionAdmincp').val(oEdit1.getHTMLBody());
	$('#frmManagement').ajaxSubmit(options);
}

function showRequest(formData, jqForm, options) {
	var form = jqForm[0];
	if(form.nameAdmincp.value == ''){
		$('#txt_error').html('Please enter server name!!!');
		$('#loader').fadeOut(300);
		show_perm_denied();
		return false;
	}
	if(form.ipAdmincp.value == ''){
		$('#txt_error').html('Please enter server ip!!!');
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
		$('#txt_error').html('Server name already exists!!!');
		$('#loader').fadeOut(300);
		show_perm_denied();
		$('#titleAdmincp').focus();
		return false;
	}

	if(responseText=='permission-denied'){
		show_perm_denied();
	}
}
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
				<td class="left_text_field">New Server:</td>
				<td class="right_text_field"><input <?php if(isset($result->is_new)){ if($result->is_new==1){ ?>checked="checked"<?php }}else{ ?>checked="checked"<?php } ?> type="checkbox" class="custom_chk" name="is_new" /></td>
			</tr>
		</table>
	</div>
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Tắt Cron Thống Kê User:</td>
				<td class="right_text_field"><input <?php if(isset($result->is_cron)){ if($result->is_cron==1){ ?>checked="checked"<?php }}else{ ?>checked="checked"<?php } ?> type="checkbox" class="custom_chk" name="is_cron" /></td>
			</tr>
		</table>
	</div>
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Server name:</td>
				<td class="right_text_field"><input value="<?php if(isset($result->name)) { print $result->name; }else{ print '';} ?>" type="text" name="nameAdmincp" id="nameAdmincp" /></td>
			</tr>
		</table>
	</div>

	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Note:</td>
				<td class="right_text_field"><input value="<?php if(isset($result->note)) { print $result->note; }else{ print '';} ?>" type="text" name="noteAdmincp" id="noteAdmincp" /></td>
			</tr>
		</table>
	</div>

	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Server ip:</td>
				<td class="right_text_field"><input value="<?php if(isset($result->ip)) { print $result->ip; }else{ print '';} ?>" type="text" name="ipAdmincp" id="ipAdmincp" /></td>
			</tr>
		</table>
	</div>
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Server idplay:</td>
				<td class="right_text_field"><input value="<?php if(isset($result->idplay)) { print $result->idplay; }else{ print '';} ?>" type="text" name="idplayAdmincp" id="idplayAdmincp" /></td>
			</tr>
		</table>
	</div>
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Sub Folder:</td>
				<td class="right_text_field"><input value="<?php if(!empty($result->sub_folder)) { print $result->sub_folder; }else{ print '/game/games_online.php';} ?>" type="text" name="subAdmincp" id="subAdmincp" /></td>
			</tr>
		</table>
	</div>
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Port Game:</td>
				<td class="right_text_field"><input value="<?php if(!empty($result->port_game)) { print $result->port_game; }else{ print '';} ?>" type="text" name="port_gameAdmincp" id="port_gameAdmincp" /></td>
			</tr>
		</table>
	</div>
	<!-- <div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Port Service:</td>
				<td class="right_text_field"><input value="<?php if(isset($result->port_service)) { print $result->port_service; }else{ print '';} ?>" type="text" name="port_serviceAdmincp" id="port_serviceAdmincp" /></td>
			</tr>
		</table>
	</div> -->
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">URL Service:</td>
				<td class="right_text_field"><input value="<?php if(isset($result->url_service)) { print $result->url_service; }else{ print '';} ?>" type="text" name="url_serviceAdmincp" id="url_serviceAdmincp" /></td>
			</tr>
		</table>
	</div>
	<div class="row_text_field">
        <table cellspacing="0" cellpadding="0" border="0" width="100%">
            <tr>
                <td class="left_text_field">Ngày ra server:</td>
                <td class="right_text_field"><input value="<?php if(isset($result->playtime)) { print $result->playtime; }else{ print '';} ?>" type="text" name="playtimeAdmincp" id="playtimeAdmincp" /></td>
            </tr>
        </table>
    </div>
	
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Server Status:</td>
				<td class="right_text_field">
					<select name="server_status" id="server_status">
						<?php
						$tmp = 1;
						if(isset($result->server_status))
							$tmp = $result->server_status;
						?>
						<option <?php if($tmp == 0) echo 'selected="selected"' ?> value="0">Không hiện ở trang chủ</option>
						<option <?php if($tmp == 1) echo 'selected="selected"' ?> value="1">Tốt</option>
						<option <?php if($tmp == 2) echo 'selected="selected"' ?> value="2">Sắp đầy</option>
						<option <?php if($tmp == 3) echo 'selected="selected"' ?> value="3">Đầy</option>
						<option <?php if($tmp == 4) echo 'selected="selected"' ?> value="4">Bảo trì</option>
						<option <?php if($tmp == 5) echo 'selected="selected"' ?> value="5">Mới</option>
					</select>
				</td>
			</tr>
		</table>
	</div>
	
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Server Description:</td>
				<td class="right_text_field">
					<textarea name="descriptionAdmincp" id="descriptionAdmincp" cols="" rows="8"><?php if(isset($result->description)) { print $result->description; }else{ print '';} ?></textarea>
					<script type="text/javascript">
						var oEdit1 = new InnovaEditor("oEdit1");
						oEdit1.width = "100%";
						oEdit1.cmdAssetManager="modalDialogShow('"+root+"static/editor/assetmanager/assetmanager.php',640,100);";
						oEdit1.REPLACE("descriptionAdmincp");
					</script>
				</td>
			</tr>
		</table>
	</div>
	</form>
</div>