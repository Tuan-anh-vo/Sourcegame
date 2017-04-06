<div class="account" id="account">
<div style="text-align: center;font-weight: bold;font-size: 13px;display: block;width: 491px;position: absolute;top: 43px;left: 74px;color: #FFFC02;">Server Mới Ra Mắt 10H 03.03.2015 Đăng Ký Ngay Nhận Code Lì Xì 500.000</div>
	<div id="tab-regis">
		<form action="" id="form-register" method="post">
			
			<p><span class="ac-acc"></span><input class='key-regis' name='username' type="text" placeholder="Tên đăng nhập"></p>
			<p><span class='ac-mail'></span><input class='key-regis' name='email' type="text" placeholder="Email"></p>
			<p><span class='ac-phone'></span><input class='key-regis' name='phone' type="text" placeholder="Phone"></p>
			<p><span class='ac-pass'></span><input class='key-regis' name='password' type="password" placeholder="Mật khẩu"></p>
			<div class="kq-rg"></div>
			<input class="btn_accou" value="Đăng ký" type="submit" id="btn-regis">
		</form>
	</div>
	<div id="tab-login">
		<form action="" id="form-login" method="post">
			
			<p><span class="ac-acc"></span><input type="text" class='keydown' name="username" placeholder="Tên đăng nhập"></p>
			<p><span class='ac-pass'></span><input type="password" class='keydown' name="password" placeholder="Mật khẩu"></p>
			<span style='height: 30px; display: block; line-height: 30px;'><input type="checkbox" style='float: left; margin: 9px;'><label style='float: left; color: #9c99c3;white-space: nowrap;' for="Ghi nhớ đăng nhặp">Ghi nhớ</label><a href="<?php echo PATH_URL?>quen-mat-khau" style='margin: 0 0 0 30px; color: red'>Quên mật khẩu</a></span>
			<div class="kq-login"></div>
			<input class="bt_bl btn_accou" type="submit" value="Đăng nhập" id="btn-login">
		</form>
		<span style="color: white; margin: 10px 0 0; float: left;white-space: nowrap;" >Đăng nhập nhanh bằng.</span> 
		<ul >
		<?php if(0){ ?>
		<li><a title="facebook" class="fb" onclick="window.open('<?php echo PATH_URL ?>user/goLoginOpenId/fb','Login Facebook','menubar=1,resizable=1,width=750,height=550')" href="javascript:;"><img alt="Login with Facebook" src="<?php echo PATH_URL ?>static/images/account/fb_icon.png"></a></li>
		<?php } ?>
        <li><a href="javascript:;" onclick="window.open('<?php echo PATH_URL ?>user/goLoginOpenId/google','Login Google','menubar=1,resizable=1,width=550,height=350')" class="fb" title="google"><img src="<?php echo PATH_URL;?>static/images/account/google_icon.png" alt="Login with Google"></a></li>
        <li><a href="javascript:;" onclick="window.open('<?php echo PATH_URL ?>user/goLoginOpenId/yahoo','Login Yahoo','menubar=1,resizable=1,width=550,height=350')" class="fb" title="google"><img src="<?php echo PATH_URL;?>static/images/account/yahoo_icon.png" alt="Login with Yahoo"></a></li>
		</ul>
	</div>
</div>

