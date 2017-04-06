<div class="noidung-tintuc">
    <div class="tieu-de">
        <a href="<?=PATH_URL?>trang-chu" style="color:white; text-decoration:none;">trang chủ</a>
        <img src="<?=PATH_URL?>static/home/images/icon-tintuc.png" alt=""><span style="color: #e2c371;"> Đổi GiftCode </span>
    </div>
    <div class="newList" style='padding:0 0 10px;'>
        <div class="contentsssss">
            <a href="<?=PATH_URL?>" target="_blank" style="color: #f00;font-size: 14px;text-transform: uppercase;font-weight: bold;margin: 10px 0 0 30px;display:block">Hướng dẫn sử dụng giftcode</a>
            <?php if($result){
              foreach ($result as $key => $value) {?>
               <div class="div-giftcode">
                 <h1><?php echo $value->title;?></h1>
                 <div class="gift-code-detail">
                 <div class='code'><strong><?php echo $value->code;?></strong></div>
                  <div class='detail-code'>
                      <ul>
                        <?php if(isset($value->chuanhan)){
                          foreach ($value->chuanhan as $vl) {?>
                            <li><?php echo $vl;?></li>
                            <li>Chưa nhận</li>
                          <?php }
                        }?>
                        <?php if(isset($value->nhanroi)){
                          foreach ($value->nhanroi as $vl) {?>
                          <li><?php echo $vl;?></li>
                          <li>Đã nhận</li>
                        <?php }}?>
                      </ul>
                  </div>
                 </div>
               </div>
              <?php } }?>

            <div id='form'>
              <div id="url_service" style='display:none;opacity:0;'></div>
              <div style="color: red;" id="result">Vui lòng tạo nhân vật trước khi nhập giftcode</div>
              <?php if($servers){?>
              <p><label>Mã giftcode: </label><input type="text" id='text-gift'></p>
              <p><label for="Chọn server">Chọn server:</label>
              <select name="name-server" id="name-server">
                <option value="0">Chọn server</option>
                <?php
                foreach ($servers as $key => $value) {
                 echo '<option value="'.$value->id.'">'.$value->name.'</option>';
                }
                echo "</select>";?>
              </p>
              <p><label for="">Mã bảo vệ: </label><img class="captcha_img" src="<?=PATH_URL?>captcha/captcha.php" class="img-cap" height="18" width="50" onclick="javascript: reCaptcha();"></p>
              <p><label for="Đổi">Nhâp mã bảo vệ</label><input type="text" id="capcha"></p>
              <p><label for="Đổi giftcode">&nbsp;</label>
              <input type="button" id="changegift" value="Đổi giftcode"></p>
              <?php }
              else{echo '<p>Chưa có server</p>';}
              ?>
            </div>
        </div>
    </div>  
    <div class="clear"></div>
</div>

<style type="text/css">
.div-giftcode{color: #174131; margin: 0 0 0 30px; font-size: 13px;}
.div-giftcode h1{color: red; font-size: 14px; text-transform: uppercase; float: left; padding: 10px 0 0; width: 100%;}
.gift-code-detail{height: auto; width: 90%; overflow: hidden; margin: 0 auto;} 
.div-giftcode .code{width: 98.5%; float: left; text-align: center; height: 25px; line-height: 25px; border: none; margin: 0; background: #EBFFCC}
.div-giftcode .code strong{font-size: 15px; line-height: 25px; color: #FF0012;}
.detail-code{width: 100%; float: left; border-left: 1px solid #fff;}
.detail-code ul{width: 100%; height: auto;}
.detail-code ul li{width: 49%; float: left; text-align: center; border: 1px solid #fff; border-width: 0px 1px 1px 0; height: 25px; line-height: 25px;}
#form{width: 60%; margin:10px auto; color: #1E3E3C;}
#form p{width: 100%; height:32px; margin: 0px; font-size: 14px; line-height: 32px;}
#form p label{display: block; width: 120px; float: left;}
#form p input{width: 200px; float: left; height: 18px; padding: 2px}
#form p img{float: left; width: 88px; height: 26px; margin: 0;}
#form #name-server{height: 24px;}
#form #capcha{width: 80px;}
#form #changegift {height: 34px; background: #CF674F; border: none; outline: none; color: #fff; font-weight: bold; cursor: pointer; width: 90px;}
.contentsssss h5{color: #fff; text-align: center; font-size: 14px;}
</style>
<script type="text/javascript">
  $(document).ready(function() {
    $('#changegift').click(function() {
      $(this).attr("disabled","disabled");
      var giftcode = $('#text-gift').val();
      var server = $('#name-server').val();
      var capcha = $('#capcha').val();
      if(server == 0){
          $('#result').html("Vui lòng chọn server");
          $('#changegift').removeAttr('disabled');
          reCaptcha();
          return false;
      }
      if(giftcode == ''){
          $('#result').html("Vui lòng nhập code của bạn");
          $('#changegift').removeAttr('disabled');
          reCaptcha();
          return false;
      }
      if(capcha == ''){
          $('#result').html("Vui lòng nhập mã bảo vệ");
          $('#changegift').removeAttr('disabled');
          reCaptcha();
          return false;
      }
      $.post(
          root + 'gift/change_giftcode',
          {
              code : giftcode,
              server: server,
              capcha: capcha
          },
          function (result){
            if(result.stt == 1){
                $('#result').html(result.st);
                $('#url_service').html(result.url_service);

                $('#changegift').removeAttr('disabled');
                reCaptcha();
            }else{
                $('#result').html(result.st);
                setTimeout(function(){
                  $('#changegift').removeAttr('disabled');
                },3000);
                reCaptcha();
            }
      }, "json" );
    });
    $('#text-gift').keypress(function() {
      $('#result').html("");
    });
    $('#name-server').change(function() {
      $('#result').html("");
    });

  });
  function reCaptcha() {
        $('.captcha_img').attr('src', root + 'captcha/captcha.php?t=' + Math.random());
    }

</script>