<?php
    if($this->session->userdata('username')){
        $username = $this->session->userdata('username');
        $mail_gift = 35; $sms_gift = 33; $share_gift = 34; $tanthu = 59;    
        $codeshare = $this->model->get('*','cli_giftcode_user',array('username'=>$username,'type'=>$share_gift));
        $codesms = $this->model->get('*','cli_giftcode_user',array('username'=>$username,'type'=>$sms_gift));
        $codeemail = $this->model->get('*','cli_giftcode_user',array('username'=>$username,'type'=>$mail_gift));
        $codetanthu  = $this->model->get('*','cli_giftcode_media',array('type'=>$tanthu));
    }
	$fullcode = 0;
	if($codeemail && $codeshare && $codesms) $fullcode = 1;
?>
<div class="popup-giftcode" style='display: none'>
  <div class="" id="giftcode">
    <div class="pu-title left width"></div>
    <div class="pu-content left width">
      <div class="plugin-schrome left">
        <?php if(0){?>
			<h3>Bạn nhận được giftcode <br><span class='yellow'>1.000.000 VNĐ</span></h3>
			<a class='pl-show-code'><?php echo $codeshare->code;?></a>
			<p style="color: #fff; padding: 3px 15px;">Hãy vào chơi game và nhập Giftcode trên để trải nghiệm,<br /></p>
		<?php }else{?>
			<?php if(0){?>
			<h3>Nhận ngay <span class='yellow'> 1.000.000 VNĐ </span><br>khi Share Hoàng Đồ Web</h3>
			<a href="javascript:;" class='save-plugin'>SHARE FANPAGE</a>
			
			<p class="code-tanthu">Gifcode Tân Thủ của bạn là</p>
			<a class='pl-show-code'><?php echo $codetanthu->code; ?></a>
			<?php } ?>
		<?php }?>
      </div>
      <?php if(0){?>
      <div class="po-email left">
        <?php if($codeemail){?>
			<h3>Bạn nhận được giftcode <br><span class='yellow'>2000 KNB</span> khóa</h3>
			<a class='pl-show-code'><?php echo $codeemail->code;?></a>
			<p style="color: #fff; padding: 3px 15px;">Hãy vào chơi game và nhập Giftcode trên để trải nghiệm.<br /></p>
		<?php }else{?>
			<h3>Nhận ngay <span class='yellow'>2000 KNB</span> khóa <br>khi bảo mật tài khoản bằng email</h3>
			<input type="text" id='email-code'>
			<i class='kq-mail' style="margin: 10px 0 0"></i>
			<a href="javascript:;" class="send-email">GỬI</a>
			<i>Truy cập email của bạn để xác nhận, nếu bạn chưa nhận được email hãy điền email và thử lại</i>
		<?php }?>
      </div>
      <div class="po-sms left">
        <?php if($codesms){?>
			<h3>Bạn nhận được giftcode <br><span class='yellow'>2.000 KNB</span> khóa</h3>
			<a class='pl-show-code'><?php echo $codesms->code;?></a>
			<p style="color: #fff; padding: 3px 15px;">Hãy vào chơi game và nhập Giftcode trên để trải nghiệm.<br /></p>
		<?php }else{?>
			<h3>Nhận ngay <span class='yellow'>2000 KNB</span> khóa <br>khi bảo mật tài khoản bằng điện thoại</h3>
			<strong><span class='white'>Soạn tin: </span>MAX BLKY <?php echo $this->session->userdata('username');?><br/> đến 8038</strong>
			<i>Bạn sẽ tốn 500 vnd cho tin nhắn</i>
		<?php }?>
      </div>
    <?php } ?>
    </div>
    <div style="clear:both"></div>
    <a href="javascript:;" onclick='popup()' style="margin: 0 0 0 430px; padding:7px 10px; background:#0169AC; color: #FFF; font-size: 15px;">Vào server mới nhất</a>
  </div> 
</div>