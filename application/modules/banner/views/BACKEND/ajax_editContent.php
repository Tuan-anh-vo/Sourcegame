<script type="text/javascript" src="<?=PATH_URL.'static/js/admin/jquery.slugit.js'?>"></script>
<script type="text/javascript">

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
	if(form.linkimageAdmincp.value == ''){
		$('#txt_error').html('Please enter link image name!!!');
		$('#loader').fadeOut(300);
		show_perm_denied();
		return false;
	}
}

function showResponse(responseText, statusText, xhr, $form) {
	if(responseText=='success'){
		 location.href=root+"admincp/"+module+"/#/save";
	}
	
/*	if(responseText=='error-title-exists'){
		$('#txt_error').html('Server name already exists!!!');
		$('#loader').fadeOut(300);
		show_perm_denied();
	//	$('#titleAdmincp').focus();
		return false;
	}
*/
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
				<td class="left_text_field">Image:</td>
				<td class="right_text_field"><input type="file" name="image"/><?php 
				if(isset($result->image)){ 
					if($result->image!=''){
						?>
						<a class="fancyboxClick" href="<?=getPathViewImage($result->image)?>">Review</a>
					<?php } } ?></td>
			</tr>
		</table>
	</div>

	


	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Link Image:</td>
				<td class="right_text_field"><input value="<?php if(isset($result->linkimage)) { print $result->linkimage; }else{ print '';} ?>" type="text" name="linkimageAdmincp" id="linkimageAdmincp" /></td>
			</tr>
		</table>
	</div>

	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Ngày bắt đầu:</td>
				<td class="right_text_field">
					<input id="start_fromdate" class="date-event" name="start_fromdate" type="text" style="width: 25%" value="<?php if (isset($result->start_date)){print date("d-m-Y",strtotime($result->start_date));}else{print '';}?>"/>
				</td>
			</tr>
		</table>
	</div>
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Ngày kết thúc:</td>
				<td class="right_text_field">
					<input id="end_todate" class="date-event" type="text" name="end_todate" style="width: 25%" value="<?php if (isset($result->end_date)){print date("d-m-Y",strtotime($result->end_date));}else{print '';}?>"/>
				</td>
			</tr>
		</table>
	</div>

	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Description:</td>
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