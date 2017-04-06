<div class="tab-lsnt" style="float: left; display:block">
	<div class="rc-row">
		<p class="rc-title">LỊCH SỬ NẠP TIỀN</p>
	</div>
	<div class="rc-row" style="width: 889px;">
		<p class="rc-tip"><img style="float:left;margin-right: 6px;" src="<?php echo PATH_URL;?>static/images/user/img_hot_larger.png" width="50">Giảm ngay 3% khi nạp từ <font color="#e7604a"><b>50.000VNĐ</b></font> trở lên qua thẻ <font color="#6d9dc4"><b>ATM.</b></font></p>
	</div>
	<?php if($transfer != 0){
	?>
	<div class="rc-row">
		<p class="rc-result">Bạn đang xem chi tiết các giao dịch gần đây nhất.</p>
	</div>
	<div class="rc-row">
		<div class="charge-history">
			<table>
				<tr class="history-head">
					<td>THỜI GIAN</td>
					<td>MÃ THẺ</td>
					<td>LOẠI THẺ</td>
					<td>GIÁ TRỊ GIAO DỊCH</td>
					<td>SERVER</td>
					<td>TÌNH TRẠNG</td>
					<td>MÔ TẢ</td>
				</tr>
				<?php foreach ($transfer as $key => $value) {?>
					<tr>
						<td><?php echo date("H:i d-m-Y", strtotime($value->create));?></td>
						<td><?php echo $value->card_pin;?></td>
						<td><?php echo $value->card_type;?></td>
						<td><?php echo number_format($value->card_amount,0, '', '.');?> VNĐ</td>
						<td><?php echo $value->server_name;?></td>
						<?php if($value->step == 2){?>
						<td><img src="<?php echo PATH_URL;?>static/images/user/img_gdtc.png"></td>
						<td>Giao dịch thành công</td>
						<?php } else if($value->step == 1){?>
							<td><img src="<?php echo PATH_URL;?>static/images/user/img_gdth.png"></td>
							<td>Giao dịch đang xử lý</td>
						<?php } else if($value->step == 0){?>
						<td><img src="<?php echo PATH_URL;?>static/images/user/img_gdtb.png"></td>
						<td>Giao dịch thất bại</td>
					<?php }?>
					</tr>
				<?php }?>
			</table>
		</div>
	</div>
		<?php echo $pageLink;?>
	<?php }else{?>
	<div class="rc-row">
		<p class="rc-result">Bạn chưa có giao dịch nào.</p>
	</div>
	<?php }?>
	<div class="rc-row">
		<p class="history-note">
			<span><font style="color:#6d9dc4;text-decoration: underline;">Ý nghĩa các ký hiệu</font></span>
			<span>GD : Giao dịch</span>
			<span><img src="<?php echo PATH_URL;?>static/images/user/img_gdtc.png">Giao dịch thành công</span>
			<span><img src="<?php echo PATH_URL;?>static/images/user/img_gdth.png">Giao dịch đang xử lý</span>
			<span><img src="<?php echo PATH_URL;?>static/images/user/img_gdtb.png">Giao dịch thất bại</span>
		</p>
	</div>
</div>