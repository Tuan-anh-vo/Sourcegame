<link rel="stylesheet" type="text/css" href="<?php echo PATH_URL?>static/css/jquery.datetimepicker.css"/>
<input type="hidden" value="<?php ($this->session->userdata('start'))? print $this->session->userdata('start') : print 0 ?>" id="start" />
<input type="hidden" value="<?=$default_func?>" id="func_sort" />
<input type="hidden" value="<?=$default_sort?>" id="type_sort" />
<div class="gr_perm_error" style="display:none;">
	<p><strong>FAILURE: </strong>Error! Config mệnh giá thẻ này đã tồn tại!!</p>
</div>
<script>
	var flag = "<?=$flag?>";
	$(document).ready(function() {
		if(flag == 'success'){
			show_perm_success();
		}
	});
</script>
<div class="gr_perm_success" style="display:none;">
	<p><strong>SAVE SUCCESS.</strong></p>
</div>
<div id="indexView" class="table">
	<div class="head_table">
		<div class="head_title_table"><?=$module_name?></div>
	</div>
	<div class="head_search">
		<h1>Khuyến mãi</h1>
	</div>
	<div id="promotion">
		<div class="promotion-info">
			<?php if($flag == 'error')
				echo "<h4 style='color: red;'>Bạn vui lòng kiểm tra dữ liệu</h4>"
			?>
			<form action="<?php echo PATH_URL.'admincp/'.$module?>/promoform" method="POST">
			<p>Tỉ lệ khuyến mãi: <input type="text" name="rate-km" id="rate-km" style="width: 40px; margin-left: 8px;" value="<?php if($rate) echo $rate?>">%</p>
			<p>Thời gian bắt đầu: <input type="text" value="<?=$time_begin?>" name="time-begin" id="time-begin" readonly></p>
			<p>Thời gian kết thúc: <input type="text" value="<?=$time_end?>" name="time-end" id="time-end" readonly></p>
			<p>Chọn server:</p>
			<ul>
				<li><input name="theme[]" type="checkbox" id="chec" class="server-promotion"><b> Tất cả</b></li>
				<?php
					foreach($servers as $item){
					?>
					<li><input id="check_server<?=$item->id?>" name="locationtheme[]" type="checkbox" class="server-promotion single" value="<?php echo $item->id;?>">
							<?=$item->name?>
						</li>
					<?php
					}
				?>
			</ul>
			<div class="clearAll"></div>
			<p><input type="submit" id="btn-pro" value="Cập nhật"></p>
			</form>
		</div>
	</div>
	<div class="head_search">
		<h1>Tỉ lệ quy đổi</h1>
		<div class="clearAll"></div>
	</div>
	<div class="clearAll"></div>
	<div id="ajax_loadContent"><img class="loading" alt="Ajax Loader" src="<?=PATH_URL.'static/images/admin/ajax-loader.gif'?>" /></div>
</div>
<style>
	.head_search{width: 100%; background: #c3c3c3; float: left; height: 30px;}
	.head_search h1{width: 160px; font-size: 16px; float: left; height: 30px; line-height: 30px; padding-left: 30px;}
	.head_search select{height: 26px; line-height: 26px; margin-top: 3px;}
	#promotion{width: 100%; overflow: hidden;}
	.promotion-info{margin: 20px auto; width: 800px;}
	.promotion-info p{height: 30px; line-height: 30px;}
	.promotion-info ul{width: 800px;}
	.promotion-info ul li{width: 400px; float: left; height: 40px;}
	.promotion-info ul li input[type='checkbox']{background: #fff; height: 16px; width: 16px; margin:3px 10px 0 0px;}
	.promotion-info p input[type='submit']{width: 80px; height: 30px;  background: #00B3F1; box-shadow: ; outline: none; line-height: 30px; border: none; color: #fff;}
	#time-begin, #time-end, #rate-km{height: 18px; width: 180px; padding: 2px 6px;}
</style>
<script src="<?php echo PATH_URL?>static/js/jquery.datetimepicker.js"></script>
<script type="text/javascript">
	function updateConfig(id){
		$.post(
			root+'donate_config/updateConfig',
			{
				card_amount: $("#inp_card_amount"+id).val(),
				gamecoin: $('#inp_gamecoin'+id).val(),
				id: id
			},
			function(response){
				if(response == 'success'){
					show_perm_success();
				}
			}
		)
	}
	function updateKM(){
		var rate = $('#rate-km').val();
		$.post(
			root+'donate_config/updateRate',
			{
				rate: rate
			},
			function(response){
				if(response == 'success'){
					show_perm_success();
				}
			}
		)
	}
	function updateRate(){
		var rate = Number($('#rate-km').val());
		$('.gamecoin').each(function(index, value){
			var old_val = Number($(value).data('gamecoin'));
			var new_val = Math.round(old_val + (old_val * rate / 100));
			$(value).val(new_val);
		})
	}
	function check(id){
		$('#check_server'+id).attr('checked','checked');
		var da_check = $('.server-promotion.single:checked').size();
		var total = <?=count($servers)?>;
		if(da_check == total)
			$('#chec').attr('checked','checked');
	}
	$(document).ready(function() {
		<?php
		$abc = explode('|', $server_km);
		foreach ($abc as $key => $value) {
			echo 'check('.$value.');';
		}
		?>

		$('#time-begin').datetimepicker({
			format:'Y-m-d H:i:00',
	        allowTimes:[
	        	'00:00', '00:30', '01:00', '01:30', '02:00', '02:30', '03:00', '03:30',
	        	'04:00', '04:30', '05:00', '05:30', '06:00', '06:30', '07:00', '07:30',
	        	'08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00', '11:30',
	        	'12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30',
	        	'16:00', '16:30', '17:00', '17:30', '18:00', '18:30', '19:00', '19:30',
	        	'20:00', '20:30', '21:00', '21:30', '22:00', '22:30', '23:00', '23:59'
	        ]
		});
		$('#time-end').datetimepicker({
			format:'Y-m-d H:i:00',
	        allowTimes:[
	        	'00:00', '00:30', '01:00', '01:30', '02:00', '02:30', '03:00', '03:30',
	        	'04:00', '04:30', '05:00', '05:30', '06:00', '06:30', '07:00', '07:30',
	        	'08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00', '11:30',
	        	'12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30',
	        	'16:00', '16:30', '17:00', '17:30', '18:00', '18:30', '19:00', '19:30',
	        	'20:00', '20:30', '21:00', '21:30', '22:00', '22:30', '23:00', '23:59'
	        ]
		});

		$('#chec').click(function(event) {
			if($("#chec").is(':checked')){
				$(".server-promotion").attr('checked', true);
				}
			else{
				$(".server-promotion").attr('checked', false);
			}
		});
	});

</script>
