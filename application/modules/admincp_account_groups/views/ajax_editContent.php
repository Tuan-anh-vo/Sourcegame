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
	if(form.nameAdmincp.value == ''){
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

	if(responseText=='permission-denied'){
		show_perm_denied();
	}
	
	if(responseText=='error-group-exists'){
		$('#txt_error').html('Group already exists!!!');
		$('#loader').fadeOut(300);
		show_perm_denied();
		$('#usernameAdmincp').focus();
		return false;
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
				<td class="left_text_field">Name:</td>
				<td class="right_text_field"><input value="<?php if(isset($result->name)) { print $result->name; }else{ print '';} ?>" type="text" name="nameAdmincp" /></td>
			</tr>
		</table>
	</div>
	
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Permission:</td>
				<td class="right_text_field">
					<div class="gr_perm">
						<div class="title_perm">Default</div>
						<div class="content_perm">
							<div class="gr_item_perm">
								<div class="item_perm_chk"><input <?php if(isset($result->permission)){ if(substr($result->permission,2,3)=='---'){ ?>checked="checked"<?php }}else{ ?>checked="checked"<?php } ?> class="custom_chk" type="checkbox" onClick="chk_perm(0,'no_access')" name="noaccess0Admincp" id="noaccess0" /></div>
								<div class="item_perm_label">No Access</div>
							</div>
							
							<div class="gr_item_perm">
								<div class="item_perm_chk"><input <?php if(isset($result->permission)){ if(substr($result->permission,2,1)=='r'){ print 'checked="checked"'; }} ?> class="custom_chk perm_access0" type="checkbox" onClick="chk_perm(0,'read')" name="read0Admincp" id="read0" /></div>
								<div class="item_perm_label">Read</div>
							</div>
							
							<div class="gr_item_perm">
								<div class="item_perm_chk"><input <?php if(isset($result->permission)){ if(substr($result->permission,3,1)=='w'){ print 'checked="checked"'; }} ?> class="custom_chk perm_access0" type="checkbox" onClick="chk_perm(0,'write')" name="write0Admincp" id="write0" /></div>
								<div class="item_perm_label">Edit</div>
							</div>
							
							<div class="gr_item_perm">
								<div class="item_perm_chk"><input <?php if(isset($result->permission)){ if(substr($result->permission,4,1)=='d'){ print 'checked="checked"'; }} ?> class="custom_chk perm_access0" type="checkbox" onClick="chk_perm(0,'delete')" name="delete0Admincp" id="delete0" /></div>
								<div class="item_perm_label">Delete</div>
							</div>
						</div>
					</div>
					
					<?php
						if($list_modules){
							foreach($list_modules as $v){
								if(isset($result->permission)){
									$pos = strpos($result->permission,','.$v->id.'|');
									if($pos!=0){
										$pos = $pos + strlen($v->id);
									}else{
										$pos = 0;
									}
								}
								
								if($v->id != 1 && $v->id != 2 && $v->id != 3 && $v->id != 4){
					?>
					<div class="gr_perm">
						<div class="title_perm"><?=$v->name?></div>
						<div class="content_perm">
							<div class="gr_item_perm">
								<div class="item_perm_chk"><input <?php if(isset($result->permission)){ if(substr($result->permission,$pos+2,3)=='---'){ ?>checked="checked"<?php }}else{ ?>checked="checked"<?php } ?> type="checkbox" onClick="chk_perm(<?=$v->id?>,'no_access')" class="custom_chk" name="noaccess<?=$v->id?>Admincp" id="noaccess<?=$v->id?>" /></div>
								<div class="item_perm_label">No Access</div>
							</div>
							
							<div class="gr_item_perm">
								<div class="item_perm_chk"><input <?php if(isset($result->permission)){ if(substr($result->permission,$pos+2,1)=='r'){ print 'checked="checked"'; }} ?> type="checkbox" onClick="chk_perm(<?=$v->id?>,'read')" class="custom_chk perm_access<?=$v->id?>" name="read<?=$v->id?>Admincp" id="read<?=$v->id?>" /></div>
								<div class="item_perm_label">Read</div>
							</div>
							
							<div class="gr_item_perm">
								<div class="item_perm_chk"><input <?php if(isset($result->permission)){ if(substr($result->permission,$pos+3,1)=='w'){ print 'checked="checked"'; }} ?> type="checkbox" onClick="chk_perm(<?=$v->id?>,'write')" class="custom_chk perm_access<?=$v->id?>" name="write<?=$v->id?>Admincp" id="write<?=$v->id?>" /></div>
								<div class="item_perm_label">Edit</div>
							</div>
							
							<div class="gr_item_perm">
								<div class="item_perm_chk"><input <?php if(isset($result->permission)){ if(substr($result->permission,$pos+4,1)=='d'){ print 'checked="checked"'; }} ?> type="checkbox" onClick="chk_perm(<?=$v->id?>,'delete')" class="custom_chk perm_access<?=$v->id?>" name="delete<?=$v->id?>Admincp" id="delete<?=$v->id?>" /></div>
								<div class="item_perm_label">Delete</div>
							</div>
						</div>
					</div>
					<?php }elseif($id==1){ ?>
					<div class="gr_perm">
						<div class="title_perm"><?=$v->name?></div>
						<div class="content_perm">
							<div class="gr_item_perm">
								<div class="item_perm_chk"><input <?php if(isset($result->permission)){ if(substr($result->permission,$pos+2,3)=='---'){ ?>checked="checked"<?php }}else{ ?>checked="checked"<?php } ?> type="checkbox" onClick="chk_perm(<?=$v->id?>,'no_access')" class="custom_chk" name="noaccess<?=$v->id?>Admincp" id="noaccess<?=$v->id?>" /></div>
								<div class="item_perm_label">No Access</div>
							</div>
							
							<div class="gr_item_perm">
								<div class="item_perm_chk"><input <?php if(isset($result->permission)){ if(substr($result->permission,$pos+2,1)=='r'){ print 'checked="checked"'; }} ?> type="checkbox" onClick="chk_perm(<?=$v->id?>,'read')" class="custom_chk perm_access<?=$v->id?>" name="read<?=$v->id?>Admincp" id="read<?=$v->id?>" /></div>
								<div class="item_perm_label">Read</div>
							</div>
							
							<div class="gr_item_perm">
								<div class="item_perm_chk"><input <?php if(isset($result->permission)){ if(substr($result->permission,$pos+3,1)=='w'){ print 'checked="checked"'; }} ?> type="checkbox" onClick="chk_perm(<?=$v->id?>,'write')" class="custom_chk perm_access<?=$v->id?>" name="write<?=$v->id?>Admincp" id="write<?=$v->id?>" /></div>
								<div class="item_perm_label">Edit</div>
							</div>
							
							<div class="gr_item_perm">
								<div class="item_perm_chk"><input <?php if(isset($result->permission)){ if(substr($result->permission,$pos+4,1)=='d'){ print 'checked="checked"'; }} ?> type="checkbox" onClick="chk_perm(<?=$v->id?>,'delete')" class="custom_chk perm_access<?=$v->id?>" name="delete<?=$v->id?>Admincp" id="delete<?=$v->id?>" /></div>
								<div class="item_perm_label">Delete</div>
							</div>
						</div>
					</div>
					<?php }}} ?>
				</td>
			</tr>
		</table>
	</div>
	</form>
</div>