<!doctype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="<?php echo PATH_URL;?>static/css/user/reset.css">
	<link rel="stylesheet" href="<?php echo PATH_URL;?>static/css/user/manager.css">
	<title>Quản lý tài khoản Long Võ</title>
</head>
<body>
	<div id="wrapper">
		<div id="container">
			<div id="header">
				<a class="logo" target="_blank" href=""></a>
				<div class="banner">
					<img src="<?php echo PATH_URL;?>static/images/user/banner.jpg" width="638" alt="">
				</div>
				<div class="user-info">
					<img src="<?php echo PATH_URL;?>static/images/user/thump-acc.jpg" width="62" alt="">
					<div class="user-row">
						<p>Chào : Anhhungvolong</p>
						<p>MSTK : 0123456789</p>
						<p><a href="">Thoát</a></p>
					</div>
				</div>
			</div>
			<div id="top-menu">
				<ul>
					<li><a href="">TRANG CHỦ</a></li>
					<li><a href="">SỰ KIỆN<img src="<?php echo PATH_URL;?>static/images/user/img_hot.png" width="30"></a></li>
					<li><a href="">VẬT PHẨM<img src="<?php echo PATH_URL;?>static/images/user/img_hot.png" width="30"></a></li>
					<!-- <li style="margin-left: 170px;">HOTLINE<img src="static/images/manager/img_phone.png" width="129"></li> -->
					<li style="margin-left: 170px;">HOTLINE <span>1234567890</span></li>
					<li><img style="margin: 0 4px 0 0;" src="<?php echo PATH_URL;?>static/images/user/img_chat.png" width="24">TRỢ GIÚP</li>
				</ul>
			</div>
			<div id="center">
				<div class="left-menu">
					<ul>
						<li class="naptien" id='recharge'>
							<a href="<?php echo PATH_URL;?>user/index">
								<p class="label">NẠP TIỀN</p>
								<p class="label-tip">Nạp tiền vào tài khoản</p>
							</a>
						</li>
						<li class="taikhoan" id="account">
							<a href="<?php echo PATH_URL;?>user/index">
								<p class="label">THÔNG TIN TÀI KHOẢN</p>
								<p class="label-tip">Quản lý thông tin chung tài khoản</p>
							</a>
						</li>
						<li class="baomat" id='security'>
							<a href="<?php echo PATH_URL;?>user/index">
								<p class="label">BẢO MẬT TÀI KHOẢN</p>
								<p class="label-tip">Đổi mật khẩu, CMND</p>
							</a>
						</li>
						<li class="lichsu" id="histoty-account">
							<a href="<?php echo PATH_URL;?>user/index">
								<p class="label">LỊCH SỬ NẠP TIỀN</p>
								<p class="label-tip">Tra cứu lịch sử nạp tiền</p>
							</a>
						</li>
					</ul>
				</div>
				<div class="right-content">
					<div style="float: left; display:block">
						<div class="rc-row" style="width: 889px;">
					        <p class="rc-tip" style="margin-top: 30px;"><img style="float:left;margin-right: 6px;" src="<?php echo PATH_URL;?>static/images/user/img_left-arrow.png" width="16"><b>THAY ĐỔI EMAIL ĐĂNG KÝ</b></p>
					    </div>
					</div>
					<div class="rc-row">
        				<p class="rc-result"><?php echo $result;?></p>        
    				</div>
				</div>
				<div class="clear"></div>
			</div>
			<div id="footer">
				<div class="footer-right">
					<p style="margin-top:20px">Copyright © 2014 Long Võ</p>
					<p>Đơn vị chủ quản: Cty Game Cool. Giấy phép ICP số : 41/GP-TTĐT.</p>
				</div>
				<div class="footer-left">
					<ul>
						<li><a target="_blank" href="">Hướng dẫn</a></li>
						<li>|</li>
						<li><a target="_blank" href="">Câu hỏi thường gặp</a></li>
						<li>|</li>
						<li><a target="_blank" href="">Báo lỗi</a></li>
					</ul>
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
	<div id="clicker">
	</div>
	<div id="popup-wrapper" class="modalPopLite-child-1">
		<div class="login-user">
			<div class="kq-login"></div>
			<p><span class="ac-acc"></span><input type="text" placeholder="Tên đăng nhập" id="user-login"></p>
			<p><span class="ac-pass"></span><input type="password" placeholder="Mật khẩu" id="pass-login"></p>
			<p><input type="checkbox"><label for="Ghi nhớ đăng nhặp">Ghi nhớ</label>
				<a href="" class="forgot">Quên mật khẩu</a></p>
			<p><input type="button" value="ĐĂNG NHẬP" id="btn-login"></p>
		</div>
		<a href="#" id="close-btn"></a>
	</div>
</body>
</html>