<div class="noidung-tintuc">
    <div class="tieu-de">
        <a href="<?=PATH_URL?>trang-chu" style="color:white; text-decoration:none;">trang chủ</a>
        <img src="<?=PATH_URL?>static/home/images/icon-tintuc.png" alt=""><span style="color: #e2c371;"> Lấy lại mật khẩu </span>
    </div>
    <div class="newList" style='padding:0 0 10px;'>
        <div class="infomation">
            <form action="" id="fotgotPassword">
              <p class="mss_u_fg" style="text-align: center; color: red;"></p>
              <p><label for="Mật khẩu cũ">Tài khoản đăng nhập</label><input type="text" name='username'></p>
              <p><label for="Mật khẩu cũ">Email đăng nhập:</label><input type="text" name="email"></p>
              <p><label for="Mật khẩu cũ">&nbsp;</label><input style="padding: 2px 20px;" type="button" id="forgetPass" value="Gửi"></p>
            </form>
        </div>
    </div>  
    <div class="clear"></div>
</div>


<style type="text/css">
.title h3{text-align: center; color: #fff; font-size: 14px}
    .infomation{width: 600px; margin: 0 auto;}
    .mss_u_fg{font-size: 13px;}
    .detail_page .title h3{line-height: 56px;}
    .infomation p{height: 30px; line-height: 30px; margin: 0; color: #fff; width: 100%; margin-bottom: 10px;}
    .infomation p label{display: block; width: 160px; float: left; height: 30px; line-height: 30px; font-size: 14px; color: #444; padding-left: 100px;}
    .infomation p input{float: left; width: 200px; padding: 2px 4px; height: 20px;}
    #forgetPass{width: 80px; background: #428bca; border: 1px solid #357ebd; color: #fff; font-weight: bold; height: 30px;}
</style>
<script type="text/javascript">
  $(document).ready(function() {
    $('#forgetPass').click(function(e) {
        e.preventDefault();
        fotgotPassword();
    });
  });
  function fotgotPassword(){
    $.ajax({
        type:"POST",
        dataType: "json",
        url:root+"user/fotgotPassword",
        data: $("#fotgotPassword").serialize(),
        success:function(result){
            if(result.status){
                $('.mss_u_fg').html("<span style='color: blue;'>"+result.msg+"</span>");
                setTimeout(function(){location.reload()}, 3000);
            }else{
                $('.mss_u_fg').html(result.msg);
            }
        }
    });
}
</script>
