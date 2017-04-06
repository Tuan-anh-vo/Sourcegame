<style type="text/css">
	.thongbao {
		text-align: center;
		font-weight: bold;
		color: red;
		font-size: 13px;
		padding: 20px;
		background: #fff;
		margin-top: 10%;
	}	
	.noidungthongbao {
		padding-right: 18px;
		line-height: 24px;
	}
	#fancybox-close {
		background: url("<?=PATH_URL?>static/images/close.png") no-repeat !important;
		background-size: 100% 100%;
	}
	.closeinform{
		position: absolute;
		right: 0px;
		top: 30px;
	}
</style>

<script type="text/javascript">
	$(document).ready(function() {
		$('.js-typecard li').click(function(){
			var target = $(this).attr('class');
			$('#'+target).attr('checked', 'checked');
		});
	});
</script>
<script type="text/javascript">
$().ready(function() {
	// validate the comment form when it is submitted
	var validator = $("#chargeForm").validate({
		rules: {
			server: {
				required: true,
				min: 1
			},
			card_type : 'required',
			card_pin: {
				required: true
			},
			card_serial: {
				required: true
			}
		},
		messages: {
			server: {
				required: "Hãy chọn server muốn nạp",
				min: "Hãy chọn server muốn nạp"
			},
			card_type: 'Hãy chọn loại thẻ muốn nạp',
			card_pin: {
				required: "Hãy nhập số PIN của thẻ"
			},
			card_serial: {
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


</script>
<style type="text/css">
	.ct_post table {
		background: none;
	}
	.ct_post table td {
		padding: 5px;
		border: none;
	}
	.errors{
		color: rgb(241, 31, 39) !important;
		font-weight: bold;
		font-size: 14px;
	}
	#imba_select{
		padding: 5px;
	}
	.label{
		font-weight: bold;
		font-size: 14px;
	}
	.input{
		padding: 5px 10px;
	}
	.top_title{
		color: #000;
	}
</style>


<div class="detail">
   <div class="detail-title">
      <span class="detail-title-label"><a href="<?=site_url("nap-the")?>" style="text-decoration:none; color:#fff;">Nạp thẻ</span>
      <span class="detail-date-label"></span>
   </div>
   <div class="detail-result">
   	
   	<div class="news_center napthe">
			<div class="feature">
				<div class="add-money">
					<div class="adtop" style="display: block !important">
						<div class="top_title">Tài khoản nạp tiền : <span style="font-weight: bold; color: #FFC600; font-size: 14px;"><?=$this->session->userdata("username")?></span></div>
						<p style="color:#C0CA44">Nếu có lỗi sự cố nạp thẻ không thành công, bạn vui lòng nhấp vào nút sau để gửi thông tin. BQT sẽ hỗ trợ các bạn trong vòng 24h!</p>
						<p style="color:#C0CA44; text-align: center;"> <a target="_new" href="https://docs.google.com/forms/d/1gp2EZQkieZe7OsJRaliHvRrE5HMCH_AjAic4tumLqYs/viewform#start=openform"> <img width="80" src="<?=PATH_URL?>static/images/clickhere.gif"/></a></p>
						<p class="w360">Bạn sử dụng mã thẻ điện thoại di động trả trước để thực hiện giao dịch:<br>
						Bạn hãy nhập thông tin thẻ cào vào form dưới đây, bấm chọn <strong>"Nạp thẻ"</strong> để hoàn tất:</p>
					</div>
					
					
					<div class="add-bottom">
						<div style="position:relative">
							<img style="height: 139px;position: absolute;right: -17px;top: -120px;width: 141px;" src="http://exu.vn/status/card2/" alt="Trạng thái máy chủ nạp tiền" />
						</div>
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
								<tr>
									<td width="115" class="label"><p>Loại thẻ</p></td>
									<td width="120" valign="middle" ><a href="#"><img src="<?=PATH_URL?>static/images/mobifone.png" alt="" /></a></td>
									<td width="104" valign="middle" ><a href="#"><img src="<?=PATH_URL?>static/images/vinaphone.png" alt="" /></a></td>
									<td width="72" valign="top" ><a href="#"><img src="<?=PATH_URL?>static/images/viettel.png" alt="" /></a></td>
									<td colspan="2" valign="top" >&nbsp;</td>
								</tr>
								<tr class="imba_radio">
									<td width="115"></td>
									<td width="120" align="center"><input class="input_radio" type="radio" name="card_type" value="MOBIFONE"></td>
									<td width="104" align="center"><input class="input_radio" type="radio" name="card_type" value="VINAPHONE"></td>
									<td width="72" align="center"><input class="input_radio" type="radio" name="card_type" value="VIETTEL"></td>
									<td width="72" align="center"><input class="input_radio" type="radio" name="card_type" value="GATE"></td>
								</tr>
								<tr class="mathe_tr">
									<td width="93" class="label"><p>Mã thẻ</p></td>
									<td width="95" colspan="5">
										<input type="text" class="input" name="card_pin" id="card_pin">
									</td>
								</tr>
								<tr class="serial_tr">
									<td width="93" class="label"><p>Số serial</p></td>
									<td width="95" colspan="5">
										<input type="text" class="input" name="card_serial" id="card_serial">
									</td>
								</tr>

								<tr>
									<td width="93" class="label"><p>Máy chủ</p></td>
									<td colspan="5">
										<div class="wrap_select">
											<select name="server" id="imba_select">
											<option value="0">[Chọn máy chủ]</option>
											<?php
											foreach($servers as $item){
											?>
											<option value="<?=$item->id?>" <?php if($this->input->post('inp_server') == $item->id) print 'selected="selected"';?>><?=$item->name?></option>
											<?php } ?>
											</select>
										</div>
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
						if($donate_config)
						{
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
												<?php foreach($donate_config as $item){
													?>
													<tr>
														<td width="30%" align="center"><?=$item->gamecoin*100?> VNĐ</td>
														<td align="center" width="40%"><?=$item->gamecoin?>	</td>
													</tr>
												<?php 
													}
												?>
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
					<p style="color:#F5001D">Nếu có lỗi sự cố nạp thẻ không thành công, bạn vui lòng nhấp vào nút sau để gửi thông tin. BQT sẽ hỗ trợ các bạn trong vòng 24h!</p>
					<p style="color:#F5001D; text-align: center;"> <a target="_new" href="https://docs.google.com/forms/d/1VCwq6XVRmWQPxt6lV-CnB-AVHU46rH4CyJ3hRh_zIcg/viewform"> <img width="80" src="<?=PATH_URL?>static/images/clickhere.gif"/></a></p>
					<p style="color:#F5001D">Hoặc chat với hỗ trợ admin góc dưới bên phải của web.</p>

					<div class="clear"></div>
					<div class="thongbao" id="thongbao" style="display:none;"> 
						<a href="" class="closeinform"><img src="<?=PATH_URL?>static/images/close.png"/></a>
						<div class="noidungthongbao">
							
						</div>					
		            </div>
		            <a href="#thongbao" class="linkthongbao"></a>
					
				</div>
			</div>
		</div>
   	
   </div>
   <div class="clear"></div>
 
</div>
<div class="clear"></div>



<script type="text/javascript">
alert = "<?=$this->session->flashdata('alert');?>";
success = "<?=$this->session->flashdata('success');?>";
$(document).ready(function() {
	if(alert)
	{
		$(".thongbao").show();
		$(".noidungthongbao").html(alert);
		setTimeout(function(){
	    	$(".linkthongbao").fancybox().trigger('click');
	    },100);
	}
	if(success)
	{
		$(".noidungthongbao").html(success);
		setTimeout(function(){
		    $(".thongbao").show();
	    	$(".linkthongbao").fancybox().trigger('click');
	    },100);
	}	
	
	$(".closeinform").click(function(){
		alert(11);
		parent.$.fancybox.close();
	});

});
</script>

