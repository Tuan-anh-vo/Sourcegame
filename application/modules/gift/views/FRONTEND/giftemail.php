<?php if($code){?>
	<h3>Bạn nhận được giftcode <br><span class='yellow'>2000 KNB</span> khóa</h3>
	<a class='pl-show-code'><?php echo $code;?></a>
	<p style="color: #fff; padding: 3px 15px;">Hãy vào chơi game và nhập Giftcode trên để trải nghiệm.<br /></p>
<?php }else{?>
	<h3>Nhận ngay <span class='yellow'>2000 KNB</span> khóa <br>khi bảo mật tài khoản bằng email</h3>
	<input type="text" id='email-code'>
	<i class='kq-mail' style="margin: 10px 0 0"></i>
	<a href="javascript:;" class="send-email">GỬI</a>
	<i>Truy cập email của bạn để xác nhận, nếu bạn chưa nhận được email hãy điền email và thử lại</i>
<?php }?>
