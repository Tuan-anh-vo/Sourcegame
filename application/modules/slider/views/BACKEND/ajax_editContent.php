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
				<td class="left_text_field">Tiêu đề:</td>
				<td class="right_text_field"><input value="<?php if(isset($result->title)) { print $result->title; }else{ print '';} ?>" type="text" name="titleAdmincp" id="titleAdmincp" /></td>
			</tr>
		</table>
	</div>
    <div class="row_text_field">
        <table cellspacing="0" cellpadding="0" border="0" width="100%">
            <tr>
                <td class="left_text_field">Loại:</td>
                <td class="right_text_field">
                    <select name="typeAdmincp" id="tab_idAdmincp">
                    	<option value="0">-- Chọn --</option>
                    	<option <?php if(isset($result->tab_slide)) if($result->tab_slide == 1) print "selected=\"selected\"";?> value="1">News slider</option>
                    	<option <?php if(isset($result->tab_slide)) if($result->tab_slide == 2) print "selected=\"selected\"";?> value="2">Thú cưỡi</option>
                    	<option <?php if(isset($result->tab_slide)) if($result->tab_slide == 3) print "selected=\"selected\"";?> value="3">Thú nuôi</option>
                    	<option <?php if(isset($result->tab_slide)) if($result->tab_slide == 4) print "selected=\"selected\"";?> value="4">Bang hội</option>
                    	<option <?php if(isset($result->tab_slide)) if($result->tab_slide == 5) print "selected=\"selected\"";?> value="5">Trailler</option>

                    </select>
                </td>
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
                <td class="left_text_field">Link:</td>
                <td class="right_text_field"><input value="<?php if(isset($result->link)) { print $result->link; }else{ print '';} ?>" type="text" name="link" id="link" /></td>
            </tr>
        </table>
    </div>
	</form>
</div>