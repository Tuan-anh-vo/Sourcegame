<div id="account" style='display:none; z-index:9999;'>
    <div class="account_wrapper">
        <div class="dangki_tab">
        <form id="form-register" onsubmit="return false;">
            <span class='kq_reg'></span>
            <div><input type="text" placeholder='Tên đăng nhập' name="username" class='keydown-rg'></div>
            <div><input type="password" placeholder='Mật khẩu' name="password" class='keydown-rg'></div>
            <div><input type="text" placeholder='Email' name="email" class='keydown-rg'></div>
            <div><input type="text" placeholder='Số điện thoại'  name="phone" class='keydown-rg'></div>
            <a href="javascript:;" class='pp_dangki btn_dangky_2016' onclick="registerUser('#form-register','.kq_reg');"></a>
        </form>
        </div>
        <div class="dangnhap_tab">
        <form id="form-login" onsubmit="return false;">
            <span class='kq_login'></span>
            <div><input type="text" placeholder='Tên đăng nhập'  name="username" class='keydown'></div>
            <div style='margin-bottom:10px;'><input type="password" placeholder='Mật khẩu' name="password" class='keydown'></div>
            <p class='remember'>
                <input type="checkbox"><span>Ghi nhớ</span>| <a href="<?php echo PATH_URL ?>quen-mat-khau">Quên mật khẩu ?</a>
            </p>
            <a href="javascript:;" class='pp_dangnhap' onclick="loginUser('#form-login','.kq_login');"></a>
            <p class='other_acc'>Đăng nhập bằng tài khoản khác</p>
            <p class='other_acc'>
                <a href="javascript:;" style="display:none" onclick="window.open('<?php //echo PATH_URL.'user/goLoginOpenId/fb'; ?>','Login Facebook','menubar=1,resizable=1,width=750,height=550')"></a>
                <a href="javascript:;" onclick="window.open('<?php echo PATH_URL ?>user/goLoginOpenId/google','Login Google','menubar=1,resizable=1,width=550,height=350')"></a>
                <a href="javascript:;" onclick="window.open('<?php echo PATH_URL ?>user/goLoginOpenId/yahoo','Login Yahoo','menubar=1,resizable=1,width=550,height=350')"></a>
            </p>
        </form>
        </div>
    </div>
</div>


<?php if(0){?>
<div class="account" id="account">
<div style="text-align: center;font-weight: bold;font-size: 13px;display: block;width: 491px;position: absolute;top: 43px;left: 74px;color: #FFFC02;"></div>
	<ul class='tab-menu'>
		<li><a class='bt-login menu-active' data-link='tab-login' href="javascript:;"></a></li>
		<li><a class='bt-regis' data-link='tab-regis' href="javascript:;"></a></li>
	</ul>
	<div class='tab-popup' id="tab-login">
		<form action="" id="form-login" method="post">
			<p><input type="text" class='keydown' name="username" placeholder="Tên đăng nhập"></p>
			<p></span><input type="password" class='keydown' name="password" placeholder="Mật khẩu"></p>
			<span style='height: 30px; display: block; line-height: 30px;'><input type="checkbox" style='float: left; margin: 9px;'><label style='float: left; color: #9c99c3;white-space: nowrap;' for="Ghi nhớ đăng nhặp">Ghi nhớ</label><a href="<?php echo PATH_URL?>quen-mat-khau" style='margin: 0 0 0 30px; color: red'>Quên mật khẩu</a></span>
			<div class="kq-login"></div>
			<a class="bt_bl btn_accou" id="btn-login" onclick="loginUser('#form-login','.kq-login');" href='javascript:;'>Đăng nhập</a>
		</form>
		<span style="color: rgb(0, 38, 231);margin: 10px 65px 0 0;float: right;white-space: nowrap;" >Đăng nhập nhanh bằng.</span> 
		<ul class='social'>
		<li><a title="facebook" class="fb" onclick="window.open('<?php echo PATH_URL ?>user/goLoginOpenId/fb','Login Facebook','menubar=1,resizable=1,width=750,height=550')" href="javascript:;"><img alt="Login with Facebook" src="<?php echo PATH_URL ?>static/images/account/fb_icon.png"></a></li>
        <li><a href="javascript:;" onclick="window.open('<?php echo PATH_URL?>user/goLoginOpenId/google','Login Google','menubar=1,resizable=1,width=550,height=350')" class="fb" title="google"><img src="<?php echo PATH_URL;?>static/images/account/google_icon.png" alt="Login with Google"></a></li>
        <li><a href="javascript:;" onclick="window.open('<?php echo PATH_URL?>user/goLoginOpenId/yahoo','Login Yahoo','menubar=1,resizable=1,width=550,height=350')" class="fb" title="google"><img src="<?php echo PATH_URL;?>static/images/account/yahoo_icon.png" alt="Login with Yahoo"></a></li>
		</ul>
		<?php $time = date('Y-m-d',time()); if($time >= date('Y-m-d',strtotime('2015-02-16')) ) {?>
		<div class="span-sv">KHAI MỞ TRƯỜNG GIANG<br>15:00 10.03.2015</div>
		<?php }?>
	</div>
	<div class='tab-popup' id="tab-regis"  style='display:none'>
		<form id="form-register" onsubmit="return false;">
			<p><input class='keydown-rg' name='username' type="text" placeholder="Tên đăng nhập"></p>
			<p><input class='keydown-rg' name='password' type="password" placeholder="Mật khẩu"></p>
			<p><input class='keydown-rg' name='email' type="text" placeholder="Email"></p>
			<p><input class='keydown-rg' name='phone' type="text" placeholder="Phone"></p>
			<div class="kq-rg"></div>
			<a class="btn_accou" id="btn-regis" onclick="registerUser('#form-register','.kq-rg');" href='javascript:;'>Đăng kí</a>
		</form>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('.tab-menu li a').hover(function() {
        $('.tab-menu li a').removeClass('menu-active');
        $(this).addClass('menu-active');
        $('.tab-popup').hide();
        var active = $(this).data('link');
        $('#'+active).show();
    });
});
</script>
<?php }?>