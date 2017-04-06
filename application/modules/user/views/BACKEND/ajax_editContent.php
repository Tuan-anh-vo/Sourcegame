<link rel="stylesheet" href="<?php echo PATH_URL;?>static/css/jquery.datetimepicker.css">
<script type="text/javascript" src="<?php echo PATH_URL;?>static/js/jquery.datetimepicker.js"></script>
<script type="text/javascript">
function save(){
	var options = {
		beforeSubmit:  showRequest,  // pre-submit callback 
		success:       showResponse  // post-submit callback 
    };
	$('#frmManagement').ajaxSubmit(options);
}

function showRequest(formData, jqForm, options) {
	var form = jqForm[0];
	if(form.emailAdmincp.value == ''){
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
	else if(responseText == 'errorcode'){
		$('#txt_error').html('System Error!!!');
		show_perm_denied();
	}
	
	else{
		$('#txt_error').html(responseText);
		show_perm_denied();
	}
}

$(document).ready(function(){
	$('#birthdayAdmincp').datetimepicker({
		format:'Y-m-d'
	});
})

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
				<td class="right_text_field"><input disabled <?php if(isset($result->is_block)){ if($result->status == 0){ ?>checked="checked"<?php }}else{ ?>checked="checked"<?php } ?> type="checkbox" class="custom_chk" name="statusAdmincp" /></td>
			</tr>
		</table>
	</div>
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Email:</td>
				<td class="right_text_field"><input value="<?php if(isset($result->email)) { print $result->email; }else{ print '';} ?>" type="text" name="emailAdmincp" id="emailAdmincp" /></td>
			</tr>
		</table>
	</div>
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Tên:</td>
				<td class="right_text_field"><input value="<?php if(isset($result->fullname)) { print $result->fullname; }else{ print '';} ?>" type="text" name="fullnameAdmincp" id="fullnameAdmincp" /></td>
			</tr>
		</table>
	</div>
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Công việc:</td>
				<td class="right_text_field"><input value="<?php if(isset($result->job)) { print $result->job; }else{ print '';} ?>" type="text" name="jobAdmincp" id="jobAdmincp" /></td>
			</tr>
		</table>
	</div>
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Hôn nhân:</td>
				<td class="right_text_field"><input value="<?php if(isset($result->marry)) { print $result->marry; }else{ print '';} ?>" type="text" name="marryAdmincp" id="marryAdmincp" /></td>
			</tr>
		</table>
	</div>
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Ngày sinh:</td>
				<td class="right_text_field"><input value="<?php if(isset($result->birthday)) { print $result->birthday; }else{ print '';} ?>" type="text" name="birthdayAdmincp" id="birthdayAdmincp" /></td>
			</tr>
		</table>
	</div>
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Giới tính:</td>
				<td class="right_text_field">
					<select name="genderAdmincp" id="genderAdmincp">
						<option value="">--Chọn giới tính--</option>
						<option value="0" <?php if(isset($result->gender)) { if($result->gender == 0) print "selected"; }?> > Nữ </option>
						<option value="1" <?php if(isset($result->gender)) { if($result->gender == 1) print "selected"; }?> > Nam </option>
					</select>
				</td>
			</tr>
		</table>
	</div>
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Địa chỉ:</td>
				<td class="right_text_field"><input value="<?php if(isset($result->address)) { print $result->address; }else{ print '';} ?>" type="text" name="addressAdmincp" id="addressAdmincp" /></td>
			</tr>
		</table>
	</div>
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Tỉnh:</td>
				<td class="right_text_field">
					<select name="provinceAdmincp" id="provinceAdmincp">
						<option value="0">--Chọn Tỉnh--</option>
						<?php foreach ($province as $k => $vl) {?>
						<option value="<?=$vl->id?>" <?php if(isset($result->province)) { if($result->province == $vl->id) print 'selected';}?> ><?=$vl->name?></option>
						<?php }?>
					</select>
				</td>
			</tr>
		</table>
	</div>
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Điện thoại:</td>
				<td class="right_text_field"><input value="<?php if(isset($result->phone)) { print $result->phone; }else{ print '';} ?>" type="text" name="phoneAdmincp" id="phoneAdmincp" /></td>
			</tr>
		</table>
	</div>
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">CMND:</td>
				<td class="right_text_field"><input value="<?php if(isset($result->cmnd)) { print $result->cmnd; }else{ print '';} ?>" type="text" name="cmndAdmincp" id="cmndAdmincp" /></td>
			</tr>
		</table>
	</div>
	</form>
</div>