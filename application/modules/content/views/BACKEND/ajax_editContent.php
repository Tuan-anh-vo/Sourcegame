<link rel="stylesheet" href="<?php echo PATH_URL;?>static/css/jquery.datetimepicker.css">
<script type="text/javascript" src="<?php echo PATH_URL;?>static/js/jquery.datetimepicker.js"></script>
<script type="text/javascript" src="<?=PATH_URL.'static/js/admin/jquery.slugit.js'?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $( "#tab_idAdmincp").change(function() {
            $('#contenttype').html('');
            var type = $(this).val();
            if(type == 1){
                $('#even-day').show();
            }else if(type == 2){
                $('#contenttype').html($(".htmltype").html());
                $('#even-day').hide();
            }
            else{
                $('#even-day').hide();
            }
        });
        $("#day_event").on("click", function(){
            console.log('afafa');
        $(this).datetimepicker({
            lang:'vi',
            i18n:{vi:{
                months:[
                'Tháng 1','Tháng 2','Tháng 3','Tháng 4','Tháng 5','Tháng 6','Tháng 7','Tháng 8','Tháng 9','Tháng 10','Tháng 11','Tháng 12'
                ],
                dayOfWeek:["T.2", "T.3", "T.4", "T.5", "T.6", "T.7", "CN."]
            }},
            timepicker:false,
            format:'d-m-Y'
        });
    });
    });

    function save(){
        var options = {
            beforeSubmit:  showRequest,  // pre-submit callback
            success:       showResponse  // post-submit callback
        };
        $('#contentAdmincp').val(CKEDITOR.instances['contentAdmincp'].getData());
        $('#frmManagement').ajaxSubmit(options);
    }
    function apply(){
        var options = {
            beforeSubmit:  showRequest,  // pre-submit callback
            success:       showResponse_apply  // post-submit callback
        };
        $('#contentAdmincp').val(CKEDITOR.instances['contentAdmincp'].getData());
        $('#frmManagement').ajaxSubmit(options);
    }

    function showRequest(formData, jqForm, options) {
        var form = jqForm[0];
        if(form.titleAdmincp.value == '' || $('#contentAdmincp').val() == '<br>' || $('#contentAdmincp').val() == ''){
            $('#txt_error').html('Please enter information!!!');
            $('#loader').fadeOut(300);
            show_perm_denied();
            return false;
        }
    }

    function showResponse_apply(responseText, statusText, xhr, $form) {
        if(responseText=='success'){
            // location.reload();
            $("#loader").fadeOut()
        }

        if(responseText=='error-title-exists'){
            $('#txt_error').html('Title already exists!!!');
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
	
	<?php if(isset($result->slug)){ ?>
    function review_detail(){
        window.open(
            root+'review-content/'+'<?php echo $result->slug;  ?>', '_blank' // <- This is what makes it open in a new window.
        );
    }
	<?php } ?>

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
                    <td class="left_text_field">Loại tin:</td>
                    <td class="right_text_field">
                        <select name="typeAdmincp" id="tab_idAdmincp">
                            <?php echo getFullCategoryOption($result->type); ?>
                        </select>
                    </td>
                </tr>
            </table>
        </div> 
        <div class="row_text_field">
            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                <tr>
                    <td class="left_text_field">Title:</td>
                    <td class="right_text_field"><input value="<?php if(isset($result->title)) { print $result->title; }else{ print '';} ?>" type="text" name="titleAdmincp" id="titleAdmincp" /></td>
                </tr>
            </table>
        </div>
        <div class="row_text_field">
            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                <tr>
                    <td class="left_text_field">Description:</td>
                    <td class="right_text_field"><textarea name="descAdmincp" cols="" rows="8"><?php if(isset($result->description)) { print $result->description; }else{ print '';} ?></textarea></td>
                </tr>
            </table>
        </div>
        <div class="row_text_field">
            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                <tr>
                    <td class="left_text_field">Content:</td>
                    <td class="right_text_field" style="padding-right: 0px;">
                        <?=createEditor('contentAdmincp', @$result->content)?>
                    </td>
                </tr>
            </table>
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
    </form>
</div>
</div>

