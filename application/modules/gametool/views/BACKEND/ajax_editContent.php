<script type="text/javascript" src="<?=PATH_URL.'static/js/admin/jquery.slugit.js'?>"></script>
<script type="text/javascript">
    $(document).ready( function() {
        $("#titleAdmincp").slugIt({
            events: 'keyup blur',
            output: '#slugAdmincp',
            space: '-'
        });
    });

    function save(){
        var options = {
            beforeSubmit:  showRequest,  // pre-submit callback
            success:       showResponse  // post-submit callback
        };
        $('#contentAdmincp').val(oEdit1.getHTMLBody());
        $('#frmManagement').ajaxSubmit(options);
    }

    function showRequest(formData, jqForm, options) {
        var form = jqForm[0];
        if(form.titleAdmincp.value == '' || form.descAdmincp.value == '' || $('#contentAdmincp').val() == '<br>' || $('#contentAdmincp').val() == ''){
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
                    <td class="left_text_field">Order:</td>
                    <td class="right_text_field"><input value="<?php if(isset($result->order)) { print $result->order; }else{ print '0';} ?>" type="text" name="orderAdmincp" id="orderAdmincp" /></td>
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
                    <td class="left_text_field">Slug:</td>
                    <td class="right_text_field"><input value="<?php if(isset($result->slug)) { print $result->slug; }else{ print '';} ?>" type="text" name="slugAdmincp" id="slugAdmincp" /></td>
                </tr>
            </table>
        </div>

        <div class="row_text_field">
            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                <tr>
                    <td class="left_text_field">Loại tin:</td>
                    <td class="right_text_field">
                        <select name="tab_idAdmincp" id="tab_idAdmincp">
                            <option <?php if(isset($result->tab_id)) if($result->tab_id == 0) print "selected=\"selected\"";?> value="0">Sự kiện</option>
                            <option <?php if(isset($result->tab_id)) if($result->tab_id == 1) print "selected=\"selected\"";?> value="1">Tin tức</option>
                        </select>
                    </td>
                </tr>
            </table>
        </div>

        <div class="row_text_field">
            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                <tr>
                    <td class="left_text_field">Image:</td>
                    <td class="right_text_field"><input type="file" name="fileAdmincp[image]" /><?php if(isset($result->image)){ if($result->image!=''){ ?> - <a class="fancyboxClick" href="<?=PATH_URL.DIR_UPLOAD_NEWS.$result->image?>">Review</a><?php }} ?></td>
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
                        <textarea name="contentAdmincp" id="contentAdmincp" cols="" rows="8"><?php if(isset($result->content)) { print $result->content; }else{ print '';} ?></textarea>
                        <script type="text/javascript">
                            var oEdit1 = new InnovaEditor("oEdit1");
                            oEdit1.width = "100%";
                            oEdit1.cmdAssetManager="modalDialogShow('"+root+"static/editor/assetmanager/assetmanager.php',640,445);";
                            oEdit1.REPLACE("contentAdmincp");
                        </script>
                    </td>
                </tr>
            </table>
        </div>

    </form>
</div>