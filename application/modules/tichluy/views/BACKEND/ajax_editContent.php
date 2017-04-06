<link rel="stylesheet" href="<?php echo PATH_URL;?>static/css/jquery.datetimepicker.css">
<script type="text/javascript" src="<?=PATH_URL.'static/js/jquery.datetimepicker.js'?>"></script>
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
        if(form.NameAdmincp.value == '' || form.TypeAdmincp.value == 0){
            $('#txt_error').html('Please enter Information!!!');
            $('#loader').fadeOut(300);
            show_perm_denied();
            return false;
        }
    }

    function showResponse(responseText, statusText, xhr, $form) {

        if(responseText=='success'){
            location.href=root+"admincp/"+module+"/#/save";
        }
        else if(responseText=='error-user-exists'){
            $('#txt_error').html('Name already exists!!!');
            $('#loader').fadeOut(300);
            show_perm_denied();
            $('#UserAdmincp').focus();
            return false;
        }
        else if(responseText=='permission-denied'){
            show_perm_denied();
        }
        else{
            $('#txt_error').html(responseText);
            $('#loader').fadeOut(300);
            show_perm_denied();
            return false;
        }
    }

    function addItem(){
        var html="<tr class='level' id='div_'>"+
                    "<td class='level_name'>Mốc </td>"+
                    "<td><input type='text' name='level[]' placeholder='Mốc nạp' value=''></td>"+
                    "<td><input type='text' name='name_item[]' placeholder='Tên vật phẩm' value=''></td>"+
                    "<td><input type='text' name='id_item[]' placeholder='Id vật phẩm' value=''></td>"+
                    "<td><input type='text' name='number_item[]' placeholder='Số lượng vật phẩm' value=''></td>"+
                    "<td><input class='detele_level' style='padding:8px' type='button' onclick='delItem()' value='Delete'></td>"+
                "</tr>";
        $('.wap-add table').append(html);
        setElement();
    }

    function delItem(id){
        $("#div_"+id).remove();
        setElement();
    }
    function setElement(){
        var x=1;
        $('.level_name').each(function(){
            $(this).text('Mốc '+x);
            x++;
        })
        var y=1;
        $('.detele_level').each(function(){
            $(this).attr('onclick','delItem('+y+')');
            y++;
        })
        var z=1;
        $('.level').each(function(){
            $(this).attr('id','div_'+z);
            z++;    
        })
    }

$(document).ready(function(){
    $('#StartAdmincp').datetimepicker({
        format:'Y-m-d H:i:00',
        allowTimes:[
            '00:00', '00:30', '01:00', '01:30', '02:00', '02:30', '03:00', '03:30',
            '04:00', '04:30', '05:00', '05:30', '06:00', '06:30', '07:00', '07:30',
            '08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00', '11:30',
            '12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30',
            '16:00', '16:30', '17:00', '17:30', '18:00', '18:30', '19:00', '19:30',
            '20:00', '20:30', '21:00', '21:30', '22:00', '22:30', '23:00', '23:59'
        ]
    });
    $('#EndAdmincp').datetimepicker({
        format:'Y-m-d H:i:00',
        allowTimes:[
            '00:00', '00:30', '01:00', '01:30', '02:00', '02:30', '03:00', '03:30',
            '04:00', '04:30', '05:00', '05:30', '06:00', '06:30', '07:00', '07:30',
            '08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00', '11:30',
            '12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30',
            '16:00', '16:30', '17:00', '17:30', '18:00', '18:30', '19:00', '19:30',
            '20:00', '20:30', '21:00', '21:30', '22:00', '22:30', '23:00', '23:59'
        ]
    });

    $('#chec').click(function(event) {
        if($("#chec").is(':checked')){
            $(".server-promotion").attr('checked', true);
        }
        else{
            $(".server-promotion").attr('checked', false);
        }
    });
    function check(id){
        $('#check_server'+id).attr('checked','checked');
        var da_check = $('.server-promotion.single:checked').size();
        var total = <?=count($servers)?>;
        if(da_check == total)
            $('#chec').attr('checked','checked');
    }

    <?php if($id){
        $abc = ltrim($result->servers,'_');
        $abc = rtrim($abc,'_');
        $abc = explode('_', $abc);
        foreach ($abc as $key => $value) {
            echo 'check('.$value.');';
        }
    }?>
})

</script>

<style>
    .wa-confi{padding: 10px 20px;}
    .button_add_item{padding:3px 20px;margin: 8px 0 8px 0;}
    .wap-add input{margin: 3px 4px;padding:3px 0 !important;text-indent: 4px;}
    #time-begin, #time-end{padding: 2px 4px;}
    table.level_item{border-collapse: collapse;border-spacing: 0;}
    table.level_item tr{border: 1px solid #000;}
    table.level_item tr th{padding: 10px 20px;border: 1px solid #000;}
    table.level_item tr td{border: 1px solid #000;text-align: center;padding:2px 12px 2px 2px;}
    ul.li-server{}
    ul.li-server li{width:460px;height:20px;float: left;}
    ul.li-server li input{float: left;margin: 0 4px 0 0;}
</style>

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
                    <td class="right_text_field"><input value="<?php if(isset($result->name)) { print $result->name; }else{ print '';} ?>" type="text" name="NameAdmincp" id="NameAdmincp" /></td>
                </tr>
            </table>
        </div>
        <div class="row_text_field">
            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                <tr>
                    <td class="left_text_field">Ngày bắt đầu:</td>
                    <td class="right_text_field"><input value="<?php if(isset($result->startdate)) { print $result->startdate; }else{ print '';} ?>" type="text" name="StartAdmincp" id="StartAdmincp" /></td>
                </tr>
            </table>
        </div>
        <div class="row_text_field">
            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                <tr>
                    <td class="left_text_field">Ngày kết thúc:</td>
                    <td class="right_text_field"><input value="<?php if(isset($result->enddate)) { print $result->enddate; }else{ print '';} ?>" type="text" name="EndAdmincp" id="EndAdmincp" /></td>
                </tr>
            </table>
        </div>
        <div class="row_text_field">
            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                <tr>
                    <td class="left_text_field">Loại tích lũy:</td>
                    <td class="right_text_field">
                        <select name="TypeAdmincp" id="TypeAdmincp" />
                            <option value='0'>-- Chọn loại tích lũy --</option>
                            <option value='1' <?php if(isset($result->type) && $result->type == 1) print "selected"?> >Tích lũy reset theo ngày</option>
                            <option value='2' <?php if(isset($result->type) && $result->type == 2) print "selected"?> >Tích lũy reset theo tuần</option>
                            <option value='3' <?php if(isset($result->type) && $result->type == 3) print "selected"?> >Tích lũy reset theo tháng</option>
                            <option value='4' <?php if(isset($result->type) && $result->type == 4) print "selected"?> >Tích lũy không reset</option>
                        </select>
                    </td>
                </tr>
            </table>
        </div>
        <div class="row_text_field">
            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                <tr>
                    <td class="left_text_field">Server :</td>
                    <td class="right_text_field">
                        <ul class='li-server'>
                            <li><input type="checkbox" id="chec" name="" value="0" class="server-promotion">Tất cả</li>
                            <?php foreach ($servers as $key => $value) {?>
                            <li><input name="adminserver[]" type="checkbox" id='check_server<?php echo $value->id;?>' value='<?php echo $value->id;?>' class="server-promotion single"><?php echo $value->name;?></li>
                            <?php }?>
                        </ul>
                    </td>
                </tr>
            </table>
        </div>
        <!-- Cau hinh thong tin moc the nap va vat pham -->
        <div class="row_text_field">
            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                <tr>
                    <td class="left_text_field">Cấu hình vật phẩm & mốc nạp:</td>
                    <td class="right_text_field">
                        <input onclick="addItem()" type="button" value="Add Item" class="button_add_item" >
                        <div class="wap-add">
                            <table class='level_item'>
                                <tr>
                                    <th>No.</th>
                                    <th>Mốc <b>( VNĐ )</b></th>
                                    <th width='200px'>Tên Vật phẩm<br><i>(cách nhau bởi dấu "_")</i></th>
                                    <th width='200px'>ID Vật phẩm<br><i>(cách nhau bởi dấu "_")</i></th>
                                    <th width='200px'>Số lượng Vật phẩm<br><i>(cách nhau bởi dấu "_")</i></th>
                                    <th>Thao tác</th>
                                </tr>
                                <?php if($item) foreach ($item as $key => $value) {  ?>
                                <tr class='level' id="div_<?=$key?>">
                                    <td class='level_name'>Mốc <?php echo $key; ?></td>
                                    <td><input type="text" name="level[]" placeholder="Mốc nạp" value='<?php if(!empty($value['level'])) echo $value['level'];?>'></td>
                                    <td><input type="text" name="name_item[]" placeholder="Tên vật phẩm"  value="<?php echo $value['name_item']; ?>" ></td>
                                    <td><input type="text" name="id_item[]" placeholder="Id vật phẩm"  value="<?php echo $value['id_item']; ?>" ></td>
                                    <td><input type="text" name="number_item[]"  placeholder="Số lượng vật phẩm" value="<?php echo $value['number_item']; ?>" ></td>
                                    <td><input class='detele_level' style="padding:8px" type="button" onclick="delItem(<?=$key?>)" value="Delete"/></td>
                                </tr>
                                <?php }?>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

    </form>
</div>

