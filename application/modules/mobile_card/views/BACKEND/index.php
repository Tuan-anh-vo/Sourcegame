<div class="gr_perm_error" style="display:none;">
	<p><strong>FAILURE: </strong>Error! Config mệnh giá thẻ này đã tồn tại!!</p>
</div>
<div class="gr_perm_success" style="display:none;">
	<p><strong>SAVE SUCCESS.</strong></p>
</div>
<div id="indexView" class="table">
	<div class="head_table">
		<div class="head_title_table"><?=$module_name?></div>
	</div>
	<div class="error"></div>
	<div id="promotion">
	<form action="" method="POST">
		<div class="promotion-info">
			<h2>Cổng Thanh Toán</h2>
			<hr/>
			<ul>
				<?php if($result) foreach ($result as $key => $value) {?>
					<li><input value="<?php echo $value->id;?>" name="pay_method" type="radio" <?=$value->status == 1 ? 'checked="checked"' : ''?> class="server-promotion"><a href="javascript:;"><?php echo $value->name;?></a></li>
				<?php }?>
			</ul>
			<div class="clearAll"></div>
			
			
		</div>
		<p><input type="submit" id="btn-pro" value="Cập nhật"></p>
		</form>
	</div>
	<div class="clearAll"></div>
</div>
<style>
	.head_search{width: 100%; background: #c3c3c3; float: left; height: 30px;}
	.head_search h1{width: 160px; font-size: 16px; float: left; height: 30px; line-height: 30px; padding-left: 30px;}
	.head_search select{height: 26px; line-height: 26px; margin-top: 3px;}
	#promotion{width: 100%; overflow: hidden; line-height: 22px; text-align: center; padding: 10px;}
	.promotion-info{margin: 20px auto; width: 800px;}
	.promotion-info a{
		font-weight: bold;
		padding: 10px 5px;
		color: #7E0707;
	}
	.promotion-info p{height: 30px; line-height: 30px;}
	.promotion-info ul{width: 800px; margin: 10px 0px 0px 0px;}
	.promotion-info ul li{width: 400px; float: left;}
	.promotion-info ul li input[type='checkbox']{background: #fff; height: 16px; width: 16px; margin:3px 10px 0 0px;}
	#btn-pro[type='submit']{width: 80px; height: 30px;  background: #00B3F1; box-shadow: ; outline: none; line-height: 30px; border: none; color: #fff;}
	#time-begin, #time-end, #rate-km{height: 18px; width: 180px; padding: 2px 6px;}
	#btn-pro{padding: 0;cursor: pointer;}
</style>
<script src="<?php echo PATH_URL?>static/js/jquery.datetimepicker.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		if(!$('[name="pay_method"]').is(':checked')){
			// $('.error').html("<h1>Vui lòng chọn cổng thanh toán</h1>");
		}
		$('#btn-pro').on('click', function(e) {
			e.preventDefault();
			var id = $('[name="pay_method"]:checked').val();
			if(id){
				$.ajax({
					type: "POST",
					url: root+module+'/updatePay',
					data: 'id='+id,
					cache: false,
					success: function(result){
						if(result) location.reload();
						else alert("Đã có lỗi xảy ra");
					}
				});
			}else{
				alert("Vui lòng chọn cổng thanh toán");
			}
		});
	});

</script>
