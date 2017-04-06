<?php if($code){?>
	<h3>Bạn nhận được giftcode <br><span class='yellow'>2.000 KNB</span> khóa</h3>
	<a class='pl-show-code'><?php echo $code;?></a>
	<p style="color: #fff; padding: 3px 15px;">Hãy vào chơi game và nhập Giftcode trên để trải nghiệm.<br /></p>
<?php }else{?>
	<h3>Nhận ngay <span class='yellow'>2000 KNB</span> khóa <br>khi bảo mật tài khoản bằng điện thoại</h3>
	<strong><span class='white'>Soạn tin: </span>Max TM <?php echo $this->session->userdata('username');?><br/> đến 8038</strong>
	<i>Bạn sẽ tốn 500 vnd cho tin nhắn</i>
<?php }?>