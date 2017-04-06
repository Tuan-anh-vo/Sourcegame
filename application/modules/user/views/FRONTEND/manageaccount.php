<link type="text/css" rel="stylesheet" href="<?php echo PATH_URL?>static/css/jquery.datetimepicker.css">
<script type="text/javascript" src="<?=PATH_URL;?>static/js/jquery.datetimepicker.js"></script>

<div class="noidung-tintuc">
    <div class="tieu-de">
        <a href="<?=PATH_URL?>trang-chu" style="color:white; text-decoration:none;">trang chủ</a>
        <img src="<?=PATH_URL?>static/home/images/icon-tintuc.png" alt=""><span style="color: #e2c371;"> Cập nhật thông tin tài khoản </span>
    </div>
    <div class="newList" style='padding:0 0 10px;'>
        <div class="infomation">
            <p style="height: 90px; margin: 0px">
                <strong style="display: block; background-color: #fcf8e3; color: #8a6d3b; padding: 10px; font-size: 12px;"><b style="color: red;">Lưu ý</b>: Số CMND chỉ nhập một lần duy nhất và không thay đổi được. Bạn vui lòng điền đúng thông tin để bảo vệ tài khoản và cũng như có thể tham gia các sự kiện của chúng tôi.</strong>
            </p>
            <form id="form-infomation">
                <p><label for="Họ">Họ và tên:</label><input type="text" id="fullname" name= 'fullname' value="<?php if($user->fullname) echo $user->fullname;?>"></p>
                <p><label for="Ngày sinh">Ngày sinh:</label><input type="text" id="birthday" name="birthday" value="<?php if($user->birthday) echo $user->birthday;?>"></p>
                <p><label for="Giới tính">Giới tính:</label>
                    <select style="height: 24px;" name="gender" id="gender">
                        <option value="0">Chọn giới tính</option>
                        <option value="1" <?php if($user->gender == 1) echo "selected";?>>Nam</option>
                        <option value="2" <?php if($user->gender == 2) echo "selected";?>>Nữ</option>
                    </select>
                </p>
                <p><label for="Địa chỉ">Địa chỉ:</label><input name="address" type="text" id="address" value="<?php if($user->address) echo $user->address;?>"></p>
                <p><label for="Số cmnd">CMND:</label><input type="text" id="cmnd" name='cmnd' value="<?php if($user->cmnd) echo $user->cmnd;?>"></p>
                <p><label for="Ngày cấp cmnd">Ngày cấp:</label><input type="text" id="time-purvey" name="ngaycap_cmnd" value="<?php if($user->ngaycap_cmnd) echo $user->ngaycap_cmnd;?>"></p>
                <p><label for="Nơi cấp cmnd">Nơi cấp:</label>
                    <select style="height: 24px;" type="text" name='noicap_cmnd'  id="province" value="<?php if($user->noicap_cmnd) echo $user->noicap_cmnd;?>">
                    <option value="0">Chọn tỉnh</option>
                    <?php
                    foreach($province as $value){
                        ?>
                        <option value="<?=$value->id?>" <?php if($value->id == $user->noicap_cmnd) echo "selected";?>><?=$value->name?></option>
                    <?php }?>
                </select>
                </p>
                <p><label for="Số điện thoại">Số điện thoại:</label><input name='phone' type="text" id="mobilephone" value="<?php if($user->phone) echo $user->phone;?>"></p>
                <p class="chang-info" style="color: red; height: auto; margin: 0 0 0 80px; font-size: 13px;"></p>
                <p><label>&nbsp;</label><input style="padding: 2px 20px;" type="button" id="change-info" value="Đổi"></p>
            </form>
        </div>
    </div>  
    <div class="clear"></div>
</div>

<style type="text/css">
    .title h3{text-align: center; color: #fff; font-size: 14px}
    #form-infomation{width: 600px; margin: 80px auto 0;}
    .infomation{width: 100%;}
    .detail_page .title h3{line-height: 56px;}
    .infomation p{height: 30px; line-height: 30px; margin: 0; color: #000; width: 100%; margin-bottom: 10px;}
    .infomation p label{display: block; width: 120px; float: left; height: 30px; line-height: 30px; font-size: 14px;}
    .infomation p input{float: left; width: 180px; padding: 2px 4px; height: 20px;}
    .infomation p select {height: 28px !important; width: 192px;}
    #change-info{width: 80px; background: #428bca; border: 1px solid #357ebd; color: #fff; font-weight: bold; height: 30px;}
</style>

<script type="text/javascript">
$(document).ready(function() {
    $('#time-purvey').datetimepicker({
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
    $('#birthday').datetimepicker({
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
    $('#change-info').click(function(e) {
        e.preventDefault();
        updateInfoUser();
    });
});
function updateInfoUser(){
    $.ajax({
        type:"POST",
        dataType: "json",
        url:root+"user/updateInfoUser",
        data: $("#form-infomation").serialize(),
        success:function(result){
            if(result.status){
                $('.chang-info').html("<span style='color: blue;'>"+result.msg+"</span>");
                setTimeout(function(){location.reload()}, 3000);
            }else{
                $('.chang-info').html(result.msg);
            }
        }
    });
}
</script>