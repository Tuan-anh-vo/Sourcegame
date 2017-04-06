<link rel="stylesheet" href="<?php echo PATH_URL;?>static/css/jquery.datetimepicker.css">
<script type="text/javascript" src="<?php echo PATH_URL;?>static/js/jquery.datetimepicker.js"></script>
<script type="text/javascript" src="<?=PATH_URL.'static/js/admin/jquery.slugit.js'?>"></script>
<script type="text/javascript">
    $(document).ready(function() {

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
        if(form.UserAdmincp.value == ''){
            $('#txt_error').html('Please enter Username!!!');
            $('#loader').fadeOut(300);
            show_perm_denied();
            return false;
        }
        if(form.CountAdmincp.value == ''){
            $('#txt_error').html('Please enter Count!!!');
            $('#loader').fadeOut(300);
            show_perm_denied();
            return false;
        }
    }

    function showResponse(responseText, statusText, xhr, $form) {
        if(responseText=='success'){
            location.href=root+"admincp/"+module+"/#/save";
        }
        if(responseText=='error-user-exists'){
            $('#txt_error').html('Username already exists!!!');
            $('#loader').fadeOut(300);
            show_perm_denied();
            $('#UserAdmincp').focus();
            return false;
        }
        if(responseText=='error-user-not-exists'){
            $('#txt_error').html('Username not exists!!!');
            $('#loader').fadeOut(300);
            show_perm_denied();
            $('#UserAdmincp').focus();
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
                    <td class="left_text_field">Username:</td>
                    <td class="right_text_field"><input value="<?php if(isset($result->username)) { print $result->username; }else{ print '';} ?>" type="text" name="UserAdmincp" id="UserAdmincp" /></td>
                </tr>
            </table>
        </div>
        <div class="row_text_field">
            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                <tr>
                    <td class="left_text_field">Count:</td>
                    <td class="right_text_field"><input value="<?php if(isset($result->count)) { print $result->count; }else{ print '';} ?>" type="text" name="CountAdmincp" id="CountAdmincp" /></td>
                </tr>
            </table>
        </div>

    </form>
</div>
</div>

