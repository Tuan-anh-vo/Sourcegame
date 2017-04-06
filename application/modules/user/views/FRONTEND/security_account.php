
<div class="tab-bvtaikhoan" style="float: left;">
	<div class="rc-row" style="width: 889px;">
		<p class="rc-tip" style="margin-top: 30px;"><img style="float:left;margin-right: 6px;" src="<?php echo PATH_URL;?>static/images/user/img_left-arrow.png" width="16"><b>THÔNG TIN BẢO VỆ TÀI KHOẢN</b></p>
	</div>
	<?php if($user){ 
		foreach ($province as $value) {
			if($user->noicap_cmnd == $value->id){
				$noicap = $value->name;
			}
		}
		if(!isset($noicap)) $noicap ="Chưa cập nhật"
	?>
    <div class="rc-row">
        <?php if($user->firstname != ''){?>
        <p class="rc-result">Thông tin tài khoản của <?php echo $user->firstname.' '.$user->midname.' '.$user->lastname;?></p>
        <?php }else{ ?>
        <p class="rc-result">Thông tin tài khoản của <?php echo $user->username; ?></p>
        <?php }?>
    </div>
	<div class="rc-row">
		<div class="info-security">
			<table>
				<tr>
					<td><span class="security-label">CMND : <img src="<?php echo PATH_URL;?>static/images/user/img_help.png"></span>
						<div class="update-hide">
							<div class="security-detail">
								<p>Số CMND : &nbsp; <?php if($user->cmnd) echo $user->cmnd; else echo "Chưa cập nhật"?></p>
								<p>Ngày cấp : &nbsp; <?php if($user->ngaycap_cmnd) echo $user->ngaycap_cmnd; else echo "Chưa cập nhật"; ?></p>
								<p>Nơi cấp : &nbsp; <?php echo $noicap;?></p>
							</div>
							<span <?php if($user->cmnd) echo "style='display: none'"?> class="right"><a href="javascript:void(0)" class="update-security">Cập nhật</a></span>
						</div>
						<div class="update-show edit-secutity" style='display: none;'>
							<div class="security-detail">
								<p><span>Số CMND : </span><input class="input-value" type="text" value="<?php echo $user->cmnd;?>" id='cmnd'></p>
								<p><span>Ngày cấp :</span><input class="input-value" type="text" readonly value="<?php echo $user->ngaycap_cmnd; ?>" id='time-purvey'></p>
								<p><span>Nơi cấp :</span>
									<select style="height: 28px;" type="text" id="province" value="<?php if($user->noicap_cmnd) echo $user->noicap_cmnd;?>">
					                <option value="0">Chọn tỉnh</option>
					                <?php 
					                foreach($province as $value){
					                    ?>                    
					                    <option value="<?=$value->id?>" <?php if($value->id == $user->noicap_cmnd) echo "selected";?>><?=$value->name?></option>
					                <?php }?>
					                </select>
								</p>
								<p style="display: none" class="ketqua">
								</p>
								<p><span>&nbsp;</span><input type="button" id="update-security" value="Lưu thay đổi">&nbsp;&nbsp;<input type="button" value="Hủy" id="security-cancel"></p>
							</div>
						</div> 
					</td>
				</tr>
				<tr>
					<td><div class="ketqua-email"></div>
						<span class="security-label">Email bảo vệ : <img src="<?php echo PATH_URL;?>static/images/user/img_help.png"></span>			
						<div class='email-hide'>
							****<?php echo substr($user->email,4);?>
							<span class="right"><a class="edit-email" href="javascript:void(0)">Thay đổi</a></span>
						</div>
						<div class="email-show" style="display: none">
							<input class="input-value" id="email-value" placeholder="Email mới" type="text" value="">
							<input type="button" value="Lưu thay đổi" id="email-change">
							<input type="button" value="Hủy" id="email-cancel">
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<span class="security-label">Mật khẩu : 
								<img src="<?php echo PATH_URL;?>static/images/user/img_help.png">
							</span>
						<div class="password-hide">							
							******************
							<span class="right"><a id="change-pass" href="javascript:void(0)">Thay đổi</a></span>
						</div>
						<div class="password-show" style="display: none">
							<div class="ketqua-pass"></div>
							<input type="text" placeholder="Email đăng ký" id="email-register">
							<input type="password" placeholder="Mật khẩu cũ" id="password-old">
							<input type="password" placeholder="Mật khẩu mới" id="password-new">
							<input type="password" placeholder="Nhập lại mật khẩu" id="password-new1">
							<br>
							<input type="button" value="Lưu thay đổi" id="update-pass">
							<input type="button" value="Hủy" id="pass-cancel">
						</div>
					</td>
				</tr>
				<!-- <tr>
					<td><span class="security-label">SĐT bảo vệ : <img src="<?php echo PATH_URL;?>static/images/user/img_help.png"></span><input readonly="readonly" class="input-value border" type="text" value="<?php echo $user->phone;?> "><span class="right"><a href="">Xác nhận</a></span></td>
				</tr> -->
			</table>
		</div>
	</div>
 	<?php }else{?>
        <div class="rc-row">
		    <p class="rc-result">
		    Bạn chưa đăng nhập. Vui lòng đăng nhập.</p>
		</div>
    <?php }?>
</div>