<link rel="stylesheet" type="text/css" href="<?=PATH_URL?>static/css/skin_payments.css">
<link rel="stylesheet" type="text/css" href="<?=PATH_URL?>static/css/baokim.css">


<script type="text/javascript">
   $(document).ready(function(){

   });
</script>
<title>Payment</title>
<script type="text/javascript">
   $(document).ready(function(){

     /*setTimeout(function(){
       $.get( root+"baokim", function( data ) {
          $( ".wap_payment_bank" ).html( data );
      });
     },100)*/


     $('.bt_pay_nt').click(function(){
       $('.tab_nt a').removeClass('active');
       $('.bt_pay_nt').addClass('active');
       show_pay_card();
     })

     $('.bt_pay_bank').click(function(){
       $('.tab_nt a').removeClass('active');
       $('.bt_pay_bank').addClass('active');
       show_pay_bank();
     })

     $('.bt_pay_nt').trigger('click');


   })
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

   $(document).ready(function(){


   });

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
          type:'POST',
          dataType: "json",
          url: root+'donate_report/charge',
          data:'ajax=1&json=1&'+$('#form_charge').serialize(),
          cache: false,
               success: function(data){
                  reCaptcha();
                  $('.ketqua-kiemtra').html(data.msg);
                
                  if(data.state==1){
                    $(".bt-coin").show();
                  }  
                  $(".bt-nap").removeAttr("disabled");
               }

       });
       $(".bt-nap").removeAttr("disabled");



     }


</script>
<div class="wapper">
   <div class="menu-method">
      <div><img src="" alt="" width="100"></div>
      <ul>
         <li class="active"><a class="nap-card">Nạp Tiền</a><strong></strong></li>
         <!-- <li><a class="promotion">Khuyến Mãi</a></li> 
         <li><a class="game-event">Sự kiện</a><strong></strong></li>-->
      </ul>
   </div>
   <div class="general" id="napthe">
      <div class="skip-welcome">
        <i>Xin chào:</i><strong><?php echo $this->session->userdata('username');?></strong>
      </div>
     <div class="wap_payment_nt wap_tab_p_c">
         <div class="rc-row">
            <div class="frm-nap">
               <form action="" method="post" id="form_charge">
                  <h2 class="title_box">Nạp KNB</h2>
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
                        <?php
                           $slug = $this->uri->segment(2);
                           if($servers){
                            foreach ($servers as $key => $value) {

                              if($value->slug == $slug)
                              {
                            ?>
                        <option value="<?=$value->id?>">-- <?=$value->name?> --</option>
                        <?php
                           }
                           }
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
                  <p><input onclick="submit_payment()" type="button" value="NẠP THẺ" class="bt-nap"></p>
                  <p>
                  <div class="ketqua-kiemtra"></div>
                  </p>
               </form>
               <div class="loading" style="display:none">
                  <p style="color:rgb(32,184,211)"> Đang xử lý, vui lòng đợi</p>
               </div>
               <p>Nếu lỗi khi nạp tiền, hãy liên lạc ngay
với hỗ trợ hoặc vào link sau để báo lỗi</p>
<p style="text-align:center"><a style="color:red; font-weight:bold;" href="https://docs.google.com/forms/d/1_H1n0EddovLL-DDPgKL0zJZMggNTJIyqiRXmYI1Ylyo/viewform">Link báo nạp thẻ</a></p>
            </div>
         </div>
         <!-- <div class="clear"></div>
         <div class="rc-row" style="margin-bottom: 15px;">
            <a class="bt-nhanqua" href="<?=PATH_URL?>tichluy"></a>
         </div>
         <div class="clear"></div> -->
         <div class="rc-row" style="margin-left:30px;">
         <!--    <table class="card_status"  width="100%">
               <tr>
                  <td width="50%"><img src="<?php echo PATH_URL ?>static/images/payment/mobifone-logo.png">
                    <p><img src="<?php echo PATH_URL ?>static/images/payment/status_ok.png"></p>
                  </td>
                  <td width="50%"><img src="<?php echo PATH_URL ?>static/images/payment/vinaphone-logo.png">
                    <p><img src="<?php echo PATH_URL ?>static/images/payment/status_ok.png"></p>
                  </td>
                  
               </tr>
               <tr>
                  <td width="50%"><img src="<?php echo PATH_URL ?>static/images/payment/viettel-logo.png">
                    <p><img src="<?php echo PATH_URL ?>static/images/payment/status_ok.png"></p>
                  </td>
                  <td width="50%"><img src="<?php echo PATH_URL ?>static/images/payment/gate-logo.png">
                    <p><img src="<?php echo PATH_URL ?>static/images/payment/status_ok.png"></p>
                  </td>

                  <!-- <td></td>
                  <td></td>
                  <td><img src="<?php echo PATH_URL ?>static/images/payment/status_ok.png"></td>
                  <td><img src="<?php echo PATH_URL ?>static/images/payment/status_ok.png"></td> -->
               </tr>
            </table>
             <table align="center" border="1" cellpadding="1" cellspacing="1" style="width: 445px;line-height: 22px;color: #0F0E0E;">
                      <tbody>
                        <tr>
                          <td style="background-color:rgb(51, 51, 51); text-align:center"><span style="color:#FFFFFF"><strong><span style="font-size:14px"><span style="font-family:tahoma,geneva,sans-serif">Mệnh Giá Thẻ</span></span></strong></span></td>
                          <td style="background-color:rgb(51, 51, 51); text-align:center"><span style="color:#FFFFFF"><strong><span style="font-size:14px"><span style="font-family:tahoma,geneva,sans-serif">Số Nguyên Bảo</span></span></strong></span></td>
                        </tr>
                        <tr>
                          <td style="text-align:center"><span style="font-size:14px"><span style="font-family:tahoma,geneva,sans-serif">10.000 VNĐ</span></span></td>
                          <td style="text-align:center"><span style="color:#FF0000"><strong><span style="font-size:14px"><span style="font-family:tahoma,geneva,sans-serif">200 NB</span></span></strong></span></td>
                        </tr>
                        <tr>
                          <td style="text-align:center"><span style="font-size:14px"><span style="font-family:tahoma,geneva,sans-serif">20.000 VNĐ</span></span></td>
                          <td style="text-align:center"><span style="color:#FF0000"><strong><span style="font-size:14px"><span style="font-family:tahoma,geneva,sans-serif">400 NB</span></span></strong></span></td>
                        </tr>
                        <tr>
                          <td style="text-align:center"><span style="font-size:14px"><span style="font-family:tahoma,geneva,sans-serif">50.000 VNĐ</span></span></td>
                          <td style="text-align:center"><span style="color:#FF0000"><strong><span style="font-size:14px"><span style="font-family:tahoma,geneva,sans-serif">1000 NB</span></span></strong></span></td>
                        </tr>
                        <tr>
                          <td style="text-align:center"><span style="font-size:14px"><span style="font-family:tahoma,geneva,sans-serif">100.000 VNĐ</span></span></td>
                          <td style="text-align:center"><span style="color:#FF0000"><strong><span style="font-size:14px"><span style="font-family:tahoma,geneva,sans-serif">2000 NB</span></span></strong></span></td>
                        </tr>
                        <tr>
                          <td style="text-align:center"><span style="font-size:14px"><span style="font-family:tahoma,geneva,sans-serif">200.000 VNĐ</span></span></td>
                          <td style="text-align:center"><span style="color:#FF0000"><strong><span style="font-size:14px"><span style="font-family:tahoma,geneva,sans-serif">4000 NB</span></span></strong></span></td>
                        </tr>
                        <tr>
                          <td style="text-align:center"><span style="font-size:14px"><span style="font-family:tahoma,geneva,sans-serif">500.000 VNĐ</span></span></td>
                          <td style="text-align:center"><span style="color:#FF0000"><strong><span style="font-size:14px"><span style="font-family:tahoma,geneva,sans-serif">10000 NB</span></span></strong></span></td>
                        </tr>
                      </tbody>
                    </table>
         </div>
     </div>
   </div>
   <div class="general" id="chuyencoin" style="display: none">
      <div class="skip-welcome">
        <i>Xin chào: <?php echo $this->session->userdata('username');?></i>
        <p><span class="gamecoin_user"></span></p>
      </div>
      <div class="menhgia">
         <h2 class="title_box">Chuyển game coin thành KNB</h2>
         <div class="chuyen_knb">
            <p>
               <label>Số KNB</label>
               <input id="change_knb" id="KNB"  type="text">
            </p>
            <p>
               <label>Server</label>
               <select class="frm-input2"  name="servers_id2" id="servers_id2" >
                  <?php
                     if($servers){
                      foreach ($servers as $key => $value) {

                        if($value->slug == $slug)
                        {
                      ?>
                  <option value="<?=$value->id?>">-- <?=$value->name?> --</option>
                  <?php
                     }
                     }
                     }
                     ?>
               </select>
            </p>
            <p>
               <label>Mã bảo vệ</label>
               <?php $rand=rand(1000,9999);
                  $this->session->set_userdata('t_capcha',md5($rand));
                   ?>
               <span class="text_captcha"><?php echo $rand; ?></span>
               <input id="sim_capcha" style="width:143px" id="KNB" type="text">
            </p>
            <p><input  onclick="change_KNB()" type="button" value="CHUYỂN KNB" class="but_chuyenknb" ></p>
            <span>
               <div class="msg_2"></div>
            </span>
         </div>
         ★ <a style="color:#000; text-decoration: underline;" href="" target="_blank">Báo lỗi nạp thẻ</a>
         </p>
      </div>
    </div>
    <?php echo modules::run('shop_item/skin_show_event');?>
</div>