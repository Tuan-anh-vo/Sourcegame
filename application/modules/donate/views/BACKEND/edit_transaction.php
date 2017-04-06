<div class="table">
	<form accept-charset="utf-8" action="<?=PATH_URL.'admincp/donate/update_the'?>" method="post">
	<div class="head_table"><div class="head_title_edit"><?=$module?></div></div>
	<div class="clearAll"></div>
	<input type="hidden" value="<?=$id?>" name="hiddenIdAdmincp" />
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Username:</td>
				<td class="right_text_field"><?php if($result->username) echo $result->username;?></td>
			</tr>
		</table>
	</div>

	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Mã thẻ:</td>
				<td class="right_text_field"><?php  if($result->card_pin) echo $result->card_pin;?></td>
			</tr>
		</table>
	</div>

	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Loại thẻ:</td>
				<td class="right_text_field"><?php if($result->card_type) echo $result->card_type;?></td>
			</tr>
		</table>
	</div>

	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Serial:</td>
				<td class="right_text_field"><?php if($result->card_serial) echo $result->card_serial;?></td>
			</tr>
		</table>
	</div>

	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Mệnh giá:</td>
				<td class="right_text_field"><input name="amountAdmincp" type="text" value="<?php if($result->card_amount) echo $result->card_amount?>"></td>
			</tr>
		</table>
	</div>
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Khuyến mãi:</td>
				<td class="right_text_field"><?php if($result->promotion) echo $result->promotion;?></td>
			</tr>
		</table>
	</div>

	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Cổng thanh toán:</td>
				<td class="right_text_field"><?php if($result->pay_method) echo $result->pay_method;?></td>
			</tr>
		</table>
	</div>
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Trạng thái:</td>
				<td class="right_text_field">
					<select name="statusAdmincp">
						<option value="1" <?php if($result->flag == 1 && $result->card_amount !="") echo "selected";?>>Thành công</option>
						<option value="2" <?php if($result->flag == 0 && $result->card_amount !="") echo "selected";?>>Đang chuyển KNB</option>
						<option value="3" <?php if($result->flag == 0 && $result->card_amount =="" || $result->card_amount == 0) echo "selected";?>>Thất bại</option>
					</select>
				</td>
			</tr>
		</table>
	</div>
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Gamecoin:</td>
				<td class="right_text_field"><input name="gamecoinAdmincp" type="text" value="<?php if($result->gamecoin) echo $result->gamecoin?>"></td>
			</tr>
		</table>
	</div>
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">&nbsp;</td>
				<td class="right_text_field"><input type="submit" name="submit_transaction" value="Cập nhật" style="cursor: pointer;"></td>
			</tr>
		</table>
	</div>
	</form>
</div>