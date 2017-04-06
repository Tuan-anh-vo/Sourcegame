<script type="text/javascript">
  
   function reCaptcha(){
     $('#refesh_capcha').attr('src',root+'captcha/captcha.php?cl='+Math.floor((Math.random() * 9999999) + 1));
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

<div class="menhgia">
         <h2 class="title_box"><?php if(isset($msg)) echo $msg;?></h2>
         <div class="chuyen_knb">
            <p>
               <label>Số KNB</label>
               <input id="change_knb" id="KNB"  type="text">
            </p>
            <p>
               <label>Server</label>
               <select class="frm-input2"  name="servers_id2" id="servers_id2" >
                  <?php
                     if(isset($servers))
                        echo "<option value=".$servers->id.">--".$servers->name."--</option>";
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
      <style>
        .menhgia{color:#000; width: 400px;font-family: arial;padding:20px;}
        .menhgia label{font-size: 12px;}
        .menhgia h2{color:#000; font-size: 15px:line-height:20px;}
        .chuyen_knb .text_captcha{height: 22px; line-height: 22px;}
        .chuyen_knb p select{height: 26px;}
        .chuyen_knb .but_chuyenknb{width: 100px; margin: 0 0 0 70px; padding: 0; background: #F15A23; height: 26px;}
      </style>