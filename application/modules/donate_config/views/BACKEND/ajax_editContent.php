<script type="text/javascript" src="<?=PATH_URL.'static/js/admin/jquery.slugit.js'?>"></script>
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
	if(form.gamecoin.value == 0 || form.card_amount.value == 0){
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
	
	if(responseText=='exists'){
		$('#txt_error').html('Max Coin config already exists!!!');
		$('#loader').fadeOut(300);
		show_perm_denied();
		$('#card_amount').focus();
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

	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Mệnh giá thẻ:</td>
				<td class="right_text_field"><input value="<?php if(isset($result->card_amount)) { print $result->card_amount; }else{ print 0;} ?>" type="text" name="card_amount" id="card_amount" /></td>
			</tr>
		</table>
	</div>

	
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Game Coin (KNB) :</td>
				<td class="right_text_field"><input value="<?php if(isset($result->gamecoin)) { print $result->gamecoin; }else{ print 0;} ?>" type="text" name="gamecoin" id="gamecoin" /></td>
			</tr>
		</table>
	</div>

	</form>
</div>