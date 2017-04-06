<link rel="stylesheet" type="text/css" href="<?=PATH_URL?>static/css/pagedonate.css">
<!-- <link rel="stylesheet" type="text/css" href="<?=PATH_URL?>static/css/baokim.css"> -->
<script type="text/javascript">

    function show_pay_card(){
      $('.wap_tab_p_c').hide();
      $('.wap_payment_nt').fadeIn(1);
    }

    function show_pay_bank(){
      $('.wap_tab_p_c').hide();
      $('.wap_payment_bank').fadeIn(1);
    }


    function reCaptcha(){
      $('#refesh_capcha').attr('src',root+'captcha/captcha.php?cl='+Math.floor((Math.random() * 9999999) + 1));
    }

   function submit_payment(){
      var card_type=$('#card_type').val();
      var servers_id=$('#servers_id').val();
      var card_serial=$('#card_serial').val();
      var card_pin=$('#card_pin').val();
      var valcapt=$('#valcapt').val();
      if(card_type == ''){
          $('.ketqua-kiemtra').text('Vui lòng chọn nhà mạng');return false;
      }
      if(!servers_id){
          $('.ketqua-kiemtra').text('Vui lòng chọn server');return false;
      }
      if(card_serial == ''){
          $('.ketqua-kiemtra').text('Vui lòng nhập serial card');return false;
      }
      if(!card_pin){
          $('.ketqua-kiemtra').text('Vui lòng nhập card pin');return false;
      }
      if(!valcapt){
          $('.ketqua-kiemtra').text('Vui lòng nhập mã captcha');return false;
      }
      $('.bt-nap').attr('disabled','disabled');
      $.ajax({
          dataType: "json",
          type:'POST',
          url: root+'donate_report/charge',
          data:'ajax=1&json=1&'+$('#form_charge').serialize(),
          cache: false,
          success: function(data){
            reCaptcha();
            if(data.state == 1){
              $('.ketqua-kiemtra').html(data.msg);
              $('#frm_active').html(data.html);
            }
            else{
              $('.ketqua-kiemtra').html(data.msg);
            }
            $(".bt-nap").removeAttr("disabled");
          }

      });
      $(".bt-nap").removeAttr("disabled");
     }
      function change_KNB(){
        var change_knb=$('#change_knb').val();
        var sim_capcha=$('#sim_capcha').val();
        var servers_id = $('#servers_id2 :selected').val();

        if(!change_knb){
            $('.msg_2').text('Vui lòng số KNB muốn chuyển');return false;
        }
        if(servers_id == ''){
          $('.msg_2').text('Vui lòng chọn server');return false;
        }
         if(!sim_capcha){
            $('.msg_2').text('Vui lòng nhập mã captcha');return false;
        }
        $('.but_chuyenknb').attr('disabled','disabled');

        $.ajax({
           type:'POST',
           url: root+'shop_item/chargetogame',
           data:'ajax=1&json=1&knb='+change_knb+'&t_captcha='+sim_capcha+'&servers_id='+servers_id,
           cache: false,
                success: function(data){
                  $('.but_chuyenknb').removeAttr('disabled');
                  $(".msg_2").html(data);
                }
          });

      }


</script>

<div class="noidung-tintuc">
    <div class="tieu-de">
        <a href="<?=PATH_URL?>trang-chu" style="color:white; text-decoration:none;">trang chủ</a>
        <img src="<?=PATH_URL?>static/home/images/icon-tintuc.png" alt=""><span style="color: #e2c371;"> Nạp thẻ </span>
    </div>
    <div class="newList" style='padding:0 0 10px;'>
        <div class="box_donate">
            <div class="wapper">
                <div class="note">
                    <h6>Nạp Thẻ Bằng Thẻ Cào</h6>
                    <!-- <p>Vui lòng chọn đúng máy chủ để nạp tiền. Nếu bạn nạp sai máy chủ hoặc lỗi khi nạp tiền, hãy liên lạc ngay
                        với hỗ trợ hoặc vào link sau để báo lỗi
                    </p>
                    <p style="text-align:center"><a style="color:red; font-weight:bold;" href="https://docs.google.com/forms/d/1_H1n0EddovLL-DDPgKL0zJZMggNTJIyqiRXmYI1Ylyo/viewform">Link báo nạp thẻ</a></p> -->
                </div>
                <div class="card-row">
                    <div class="frm-nap">
                        <div id='frm_active' style='display:none;opacity:0'></div>
                        <div class="title-card">NẠP THẺ BẰNG THẺ CÀO</div>
                     
                        <form action="" method="post" id="form_charge">
                           <p>
                              <span class="frm-label">Nhà mạng : <font color="red">&#42;</font></span>
                              <select  class="frm-input"  name="card_type" id="card_type" >
                                 <option value="">-- Chọn nhà mạng --</option>
                                 <option value="MOBIFONE">-- MOBIFONE --</option>
                                 <option value="VINAPHONE">-- VINAPHONE --</option>
                                 <option value="VIETTEL">-- VIETTEL --</option>
                                 <option value="GATE">-- GATE --</option>
                              </select>
                           </p>
                           <p>
                              <span class="frm-label">Servers : <font color="red">&#42;</font></span>
                              <select class="frm-input"  name="servers_id" id="servers_id" >
                                 <option value="">-- Chọn servers --</option>
                                 <?php if($servers){
                                    foreach ($servers as $key => $value) {
                                    ?>
                                 <option value="<?=$value->id?>">-- <?=$value->name?> --</option>
                                 <?php }
                                    }
                                    ?>
                              </select>
                           </p>
                           <p><span class="frm-label">Số Seri : <font color="red">&#42;</font></span><input class="frm-input" name="card_serial" id="card_serial" type="text"></p>
                           <p><span class="frm-label">Mã Pin : <font color="red">&#42;</font></span><input class="frm-input"  id="card_pin" name="card_pin" type="text"></p>
                           <p class="capcha">
                              <span class="frm-label" >Mã kiểm tra:</span>
                              <img  id="refesh_capcha" class="captcha_img"  src="<?=PATH_URL?>captcha/captcha.php" width="115" height="25" alt=" ">
                              <a title="Đổi mã bảo mật" href="javascript:;"  onclick="reCaptcha()">
                              <img  src="<?php echo PATH_URL ?>static/images/payment/refresh.jpg" >
                              </a>
                           </p>
                           <p><span class="frm-label">Nhập mã kiểm tra: <font color="red">&#42;</font></span>
                              <input type="text" value=""  class="required valcapt" name="valcapt" id="valcapt" placeholder="Nhập mã kiểm tra">
                           </p>
                           <p><span class="frm-label">&nbsp;</span><input onclick="submit_payment()" type="button" value="NẠP THẺ" class="bt-nap btn_napthe_2016"></p>
                           <p class="ketqua-kiemtra" style="text-align: center; width: 100%;  color: red"> </p>
                        </form>
                        <div class="status-card">
                           <ul>
                              <li>Mobifone: <span>Hoạt động tốt</span></li>
                              <li>Viettel: <span>Hoạt động tốt</span></li>
                              <li>Vinaphone: <span>Hoạt động tốt</span></li>
                              <li>FPT Gate: <span>Hoạt động tốt</span></li>
                           </ul>
                           <div class="time-st">
                              Cập nhật lúc: 14:00, 30-09-2014
                           </div>
                        </div>
                        <!-- <div class="loading" style="display:none">
                           <p style="color:rgb(32,184,211)"> Đang xử lý, vui lòng đợi</p>
                           </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>  
    <div class="clear"></div>
</div>

<!-- <div id="changecoin"></div> -->
<a href="<?php echo PATH_URL;?>donate_report/changeCoin" id="changecoin"></a>
<style type="text/css">
   .detail_page .title h3{line-height: 56px;}
</style>