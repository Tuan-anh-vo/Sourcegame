<script type="text/javascript" src="<?=PATH_URL.'static/js/admin/jquery.slugit.js'?>"></script>
<script type="text/javascript">
    $(document).ready( function() {
        $("#nameAdmincp").slugIt({
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
        $('#frmManagement').ajaxSubmit(options);
    }

    function showRequest(formData, jqForm, options) {
        var form = jqForm[0];
        if(form.nameAdmincp.value == '' || form.keyAdmincp.value == '' || form.desAdmincp.value == ""){
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
            $('#nameAdmincp').focus();
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
                    <td class="left_text_field">Hiển thị ở menu:</td>
                    <td class="right_text_field"><input <?php if(isset($result->show)){ if($result->show==1){ ?>checked="checked"<?php }}else{ ?>checked="checked"<?php } ?> type="checkbox" class="custom_chk" name="showAdmincp" /></td>
                </tr>
            </table>
        </div>

        <div class="row_text_field">
            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                <tr>
                    <td class="left_text_field">Menu cấp cha:</td>
                    <td class="right_text_field">
                        <select name="parentAdmincp" id="parentAdmincp">
                            <option value="0" selected="selected">Không có</option>
                            <!--<?php foreach ($category as $value) {?>
                                <option value="<?=$value->id?>" <?php if(isset($result->parent)) if($result->parent==$value->id) echo "selected='selected'"; else echo "";?> > <?=$value->name?></option>
                            <?php }?>-->
                            <?php echo getFullCategoryOption($result->parent); ?>
                        </select>

                    </td>
                </tr>
            </table>
        </div>

        <div class="row_text_field">
            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                <tbody><tr>
                    <td class="left_text_field">Kiểu hiển thị:</td><td><ul><li><input type="checkbox" id="chec" name="" value="0" class="display-promotion">Tất cả</li>                
                        <li><input name="displayoption[]" type="checkbox" id="check_display1" value="1" class="display-promotion single">Top menu</li>                
                                
                        <li><input name="displayoption[]" type="checkbox" id="check_display2" value="2" class="display-promotion single">Tab menu</li>               
                                
                        <li><input name="displayoption[]" type="checkbox" id="check_display3" value="3" class="display-promotion single">Right menu</li>                
                </ul></td></tr>
            </tbody></table>
        </div>

        <div class="row_text_field">
            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                <tr>
                    <td class="left_text_field">Name:</td>
                    <td class="right_text_field"><input value="<?php if(isset($result->name)) { print $result->name; }else{ print '';} ?>" type="text" name="nameAdmincp" id="nameAdmincp" /></td>
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
                    <td class="left_text_field">Sắp xếp:</td>
                    <td class="right_text_field"><input value="<?php if(isset($result->order)) { print $result->order; }else{ print '';} ?>" type="text" name="orderAdmincp" id="orderAdmincp" /></td>
                </tr>
            </table>
        </div>

        <div class="row_text_field">
            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                <tr>
                    <td class="left_text_field">Keyword:</td>
                    <td class="right_text_field"><textarea name="keyAdmincp" cols="" rows="8"><?php if(isset($result->seo_keywords)) { print $result->seo_keywords; }else{ print '';} ?></textarea></td>
                </tr>
            </table>
        </div>
        <div class="row_text_field">
            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                <tr>
                    <td class="left_text_field">Description:</td>
                    <td class="right_text_field"><textarea name="desAdmincp" cols="" rows="8"><?php if(isset($result->seo_description)) { print $result->seo_description; }else{ print '';} ?></textarea></td>
                </tr>
            </table>
        </div>
    </form>
</div>
<script type="text/javascript">
    $('#chec').click(function(event) {
            if($("#chec").is(':checked')){
                $(".display-promotion").attr('checked', true);
                }
            else{
                $(".display-promotion").attr('checked', false);
            }
        });

    function check(id){
        $('#check_display'+id).attr('checked','checked');
    }

    $(document).ready(function(){
    <?php
        if($list_display){
            //pr($list_display,1);
            $abc = explode('|', $list_display[0]->displayoptions);
            foreach ($abc as $key => $value) {
                echo 'check('.$value.');';
            }
        }
    ?>
    });
</script>