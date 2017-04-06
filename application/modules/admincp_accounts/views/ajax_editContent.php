<script type="text/javascript">
function resetPerm(){
	$.post('<?=PATH_URL.'admincp/'.$module.'/reset_permission/'?>',{
		id: <?=$id?>,
		permDefault: $('#perm_group').val()
	},function(data){
		if(data=='success'){
			location.href=root+"admincp/"+module+"/#/reset";
		}
	});
}

function save(){
	var options = {
		beforeSubmit:  showRequest,  // pre-submit callback 
		success:       showResponse  // post-submit callback 
    };
	$('#frmManagement').ajaxSubmit(options);
}

function showRequest(formData, jqForm, options) {
	var form = jqForm[0];
	if(form.usernameAdmincp.value == ''){
		$('#txt_error').html('Please enter information!!!');
		$('#loader').fadeOut(300);
		show_perm_denied();
		return false;
	}
	<?php if($id==0){ ?>
	if(form.passAdmincp.value == ''){
		$('#txt_error').html('Please enter information!!!');
		$('#loader').fadeOut(300);
		show_perm_denied();
		return false;
	}
	<?php } ?>
}

function showResponse(responseText, statusText, xhr, $form) {
	if(responseText=='success'){
		location.href=root+"admincp/"+module+"/#/save";
	}

	if(responseText=='permission-denied'){
		show_perm_denied();
	}
	
	if(responseText=='error-username-exists'){
		$('#txt_error').html('Username already exists!!!');
		$('#loader').fadeOut(300);
		show_perm_denied();
		$('#usernameAdmincp').focus();
		return false;
	}
}

function getPerm(val,isUpdate){
	if(isUpdate==0){
		$.get('<?=PATH_URL.'admincp/admincp_accounts/ajaxPerm/'?>'+val, function(data) {
			$('#ajax_perm').html(data);
		});
	}else{
		$.post('<?=PATH_URL.'admincp/admincp_accounts/ajaxPerm/'?>'+val,{
			'perm': isUpdate
		},function(data) {
			$('#ajax_perm').html(data);
		});
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
				<td class="left_text_field">Group:</td>
				<td class="right_text_field">
					<select onChange="getPerm(this.value)" class="custom_select" name="groupAdmincp" id="groupAdmincp">
						<?php
							if($list_group){
								foreach($list_group as $value){
						?>
						<option <?php if(isset($result->group_id)){ if($result->group_id==$value->id){ ?>selected="selected"<?php }} ?> value="<?=$value->id?>"><?=$value->name?></option>
						<?php }} ?>
					</select>
				</td>
			</tr>
		</table>
	</div>

	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Username:</td>
				<td class="right_text_field"><input value="<?php if(isset($result->username)) { print $result->username; }else{ print '';} ?>" type="text" name="usernameAdmincp" id="usernameAdmincp" /></td>
			</tr>
		</table>
	</div>
	
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Password:</td>
				<td class="right_text_field"><input value="" type="password" name="passAdmincp" /></td>
			</tr>
		</table>
	</div>
	
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Permission:</td>
				<td class="right_text_field" id="ajax_perm">
					<?php if($id==0){ ?>
					<script type="text/javascript">$(document).ready(function(){ getPerm($('#groupAdmincp').val(),0); })</script>
					<?php }else{ ?>
					<script type="text/javascript">$(document).ready(function(){ getPerm($('#groupAdmincp').val(),'<?=$result->permission?>'); })</script>
					<?php } ?>
				</td>
			</tr>
		</table>
	</div>
	</form>
</div>