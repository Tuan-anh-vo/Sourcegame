<script type="text/javascript">
$().ready(function() {
	// validate the comment form when it is submitted
	var validator = $("#chargeForm").validate({
		rules: {
			inp_server: {
				required: true,
				min: 1
			},
			player_slc: {
				required: true,
				min: 1
			},
			radio : 'required',
			txtSoPin: {
				required: true
			},
			txtSoSeri: {
				required: true
			}
		},
		messages: {
			inp_server: {
				required: "Hãy chọn máy chủ muốn nạp tiền",
				min: "Hãy chọn máy chủ muốn nạp tiền"
			},
			player_slc: {
				required: "Hãy chọn nhân vật muốn nạp tiền",
				min: "Hãy chọn nhân vật muốn nạp tiền"
			},
			radio: 'Hãy chọn loại thẻ muốn nạp',
			txtSoPin: {
				required: "Hãy nhập số PIN của thẻ"
			},
			txtSoSeri: {
				required: "Hãy nhập số Serial của thẻ"
			}
		},
		errorPlacement: function(error, element){
			var name = element.attr('name');
			// if(name == 'radio')
			// 	element.parent().parent().parent().append(error);
			// else
				element.parent().append(error);
		},
		onkeyup: false
	});
	$("#imba_select").change(function(){
        $("#imba_select option:selected").each(function(){
            var curr_val = $(this).text();
            $("#imba_span").html(curr_val);
        });
    });
	$('.table-knb').hide();
});

function chooseServer(){
	var id = $('#imba_select').val();
	$('.table-knb').hide();
	if(id > 0){
		$('.table-knb#table-'+id).fadeIn();
		getPlayerList(id);
	}
}

function getPlayerList(server_id){
	if(server_id > 0){
		$.post(
			root+'user/getPlayerListMerge/'+server_id,
			{
				playerName: '<?php $tmp = $this->session->userdata('user_login'); echo $tmp['username']?>'
			},
			function(data){
				// var data = JSON.parse(data.name);

				if(data.length > 0){
					$str = '<option value="0">[Chọn nhân vật]</option>';
					for(i = 0; i < data.length ; i++){
						console.log('abc:',data[i].nickname);
						$str += '<option value="'+data[i].playerid+'">'+data[i].nickname+'</option>';
					}
					$('#player_slc').html($str);
				}
				else{
					$str = '<option value="0">[Chọn nhân vật]</option>';
					$('#player_slc').html($str);
					
				}
			},
			'JSON'
		);
	}
}


</script>
<div class="main_content imba_height">
	<div class="wrap_news">
		<div class="title">
	
			<div class="title_center">
				<h2><span class="charge_text"><img src="<?=PATH_URL.'static/images/background/title_nt.png'?>" /></span></h2>
			</div>
			
		</div>
		<div class="news_center napthe">
			<div class="feature">
				<div class="add-money">
					<div class="adtop" style="display: block !important">
						
						<div class="top_title">Tài khoản nạp tiền : <span style="font-weight: bold; color: #FFC600"><?php $user = $this->session->userdata('user_login'); echo $user['username']; ?></span></div>
						<p>Bạn sử dụng mã thẻ điện thoại di động trả trước để thực hiện giao dịch:<br>
						Bạn hãy nhập thông tin thẻ cào vào form dưới đây, bấm chọn <strong>"Nạp thẻ"</strong> để hoàn tất:</p>
					</div>
					
					
					<div class="add-bottom">
						<!-- <div style="position:relative">
							<img style="height: 139px;position: absolute;right: -17px;top: 24px;width: 141px;" src="http://ketnoipay.com/media/ketnoipay.jpg" alt="Trạng thái máy chủ nạp tiền" />
						</div> -->
						<form action="" method="post" id="chargeForm">
							<table wdth="100%">
								<tr>
									<td colspan="6">
										<?php echo validation_errors(); ?>
										<?php if( $this->session->flashdata('alert') ) { ?>
											<p style="width: 100%; text-align: center" class="errors"><?php echo $this->session->flashdata('alert') ?></p>
										<?php } ?>
										<p class="success"><?=$this->session->flashdata('success')?></p>
									</td>
								</tr>
								<tr id="server_napthe">
									<td width="93" class="label"><p>Máy chủ</p></td>
									<td colspan="5">
										<div class="wrap_select">
											<select name="inp_server" id="imba_select" onchange="chooseServer()">
											<option value="0">[Chọn máy chủ]</option>
											<?php
											if($this->input->post('inp_server')){ ?>
											<script type="text/javascript">getPlayerList(<?=$this->input->post('inp_server')?>,1);</script>
											<?php
											}
											foreach($server as $item){
											
											?>
											<option value="<?=$item->id?>" <?php if($this->input->post('inp_server') == $item->id) print 'selected="selected"';?>><?=$item->name?></option>
											<?php } ?>
											</select>
										</div>
									</td>
								</tr>
								<tr>
									<td width="93" class="label"><p>Nhân vật</p></td>
									<td colspan="5">
										<div class="wrap_select">
											<select name="player_slc" id="player_slc" >
												<option value="0">[Chọn nhân vật]</option>
											</select>
										</div>
									</td>
								</tr>
								<tr>
									<td width="115" class="label"><p>Loại thẻ</p></td>
									<td width="120" valign="middle" align="center"><a href="#"><img src="<?=PATH_URL?>static/images/icon/mobifone.png" alt="" /></a></td>
									<td width="104" valign="middle" align="center"><a href="#"><img src="<?=PATH_URL?>static/images/icon/vinaphone.png" alt="" /></a></td>
									<td width="72" valign="top" align="center"><a href="#"><img src="<?=PATH_URL?>static/images/icon/viettel.png" alt="" /></a></td>
									<td colspan="2" valign="top" align="center">&nbsp;</td>
									
								</tr>
								<tr class="imba_radio">
									<td width="115"></td>
									<td width="120" align="center"><input class="input_radio" type="radio" name="radio" value="VMS"></td>
									<td width="104" align="center"><input class="input_radio" type="radio" name="radio" value="VNP"></td>
									<td width="72" align="center"><input class="input_radio" type="radio" name="radio" value="VIETTEL"></td>
								</tr>
								<tr class="mathe_tr">
									<td width="93" class="label"><p>Mã thẻ</p></td>
									<td width="95" colspan="5">
										<input type="text" class="input" name="txtSoPin" id="txtSoPin">
									</td>
								</tr>
								<tr class="serial_tr">
									<td width="93" class="label"><p>Số serial</p></td>
									<td width="95" colspan="5">
										<input type="text" class="input" name="txtSoSeri" id="txtSoSeri">
									</td>
								</tr>
								<tr>
									<td width="93"></td>
									<td width="95" colspan="5">
										
										<input type="submit" name="cashout" class="imba_submit" value="Nạp thẻ" />

									</td>
								</tr>
							</table>
						</form>
					</div>
					<div style="margin-top: 15px; padding-bottom: 20px">
						<?php
						foreach($server as $item){
						?>
						<table class="table-knb" id="table-<?=$item->id?>">
							<tr>
								<td width="605" align="center" style="font-weight: bold; font-size:16px">Tỉ lệ quy đổi Kim Nguyên Bảo máy chủ <?=$item->name?></td>
							</tr>
							<tr>								
								<td width="605" align="center">
									<table class="napthe_table" cellpadding="0" cellspacing="0">
										<tbody>
											<tr>
												<th>Mệnh giá thẻ</th>
												<th>Kim Nguyên Bảo nhận được</th>
											</tr>
											<?php if(isset($list_coins['coin_10k_'.$item->id])) : ?>
												<tr><td width="30%" align="center">10.000 VNĐ</td><td align="center" width="40%"><?=number_format($list_coins['coin_10k_'.$item->id]->content,0,',','.')?></td></tr>
											<?php endif; ?>
											<?php if(isset($list_coins['coin_20k_'.$item->id])) : ?>
												<tr><td width="30%" align="center">20.000 VNĐ</td><td align="center" width="40%"><?=number_format($list_coins['coin_20k_'.$item->id]->content,0,',','.')?></td></tr>
											<?php endif; ?>
											<?php if(isset($list_coins['coin_30k_'.$item->id])) : ?>
												<tr><td width="30%" align="center">30.000 VNĐ</td><td align="center" width="40%"><?=number_format($list_coins['coin_30k_'.$item->id]->content,0,',','.')?></td></tr>
											<?php endif; ?>
											<?php if(isset($list_coins['coin_40k_'.$item->id])) : ?>
												<tr><td width="30%" align="center">40.000 VNĐ</td><td align="center" width="40%"><?=number_format($list_coins['coin_40k_'.$item->id]->content,0,',','.')?></td></tr>
											<?php endif; ?>
											<?php if(isset($list_coins['coin_50k_'.$item->id])) : ?>
												<tr><td width="30%" align="center">50.000 VNĐ</td><td align="center" width="40%"><?=number_format($list_coins['coin_50k_'.$item->id]->content,0,',','.')?></td></tr>
											<?php endif; ?>
											<?php if(isset($list_coins['coin_100k_'.$item->id])) : ?>
												<tr><td width="30%" align="center">100.000 VNĐ</td><td align="center" width="40%"><?=number_format($list_coins['coin_100k_'.$item->id]->content,0,',','.')?></td></tr>
											<?php endif; ?>
											<?php if(isset($list_coins['coin_200k_'.$item->id])) : ?>
												<tr><td width="30%" align="center">200.000 VNĐ</td><td align="center" width="40%"><?=number_format($list_coins['coin_200k_'.$item->id]->content,0,',','.')?></td></tr>
											<?php endif; ?>
											<?php if(isset($list_coins['coin_300k_'.$item->id])) : ?>
												<tr><td width="30%" align="center">300.000 VNĐ</td><td align="center" width="40%"><?=number_format($list_coins['coin_300k_'.$item->id]->content,0,',','.')?></td></tr>
											<?php endif; ?>
											<?php if(isset($list_coins['coin_500k_'.$item->id])) : ?>
												<tr><td width="30%" align="center">500.000 VNĐ</td><td align="center" width="40%"><?=number_format($list_coins['coin_500k_'.$item->id]->content,0,',','.')?></td></tr>
											<?php endif; ?>					
										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" align="center" style="padding-top: 8px;"><span style="color:red; font-style:italic;font-size: 12px">**Đã bao gồm các chương trình khuyến mãi nạp thẻ</span></td>
							</tr>
						</table>	
						<?php
						}
						?>
					</div>
					
					
				</div>
			</div>
		</div>
		<div class="news_bottom"></div>
	</div>
	<div class="clearAll"></div>

</div>
<div class="clearAll"></div>
