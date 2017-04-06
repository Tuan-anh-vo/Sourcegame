<script src="<?php echo PATH_URL?>static/js/jquery-1.8.3.min.js" type="text/javascript"></script>
<div class="container">
	<p class="title-head">BẠN ĐÃ ĐẠT ĐƯỢC CÁC QUÀ TÂN THỦ SAU</p>
	<p style='color: red; text-align: center'>Lưu ý: Túi phải trống ít nhất 10 ô</p>
	<table>
		<tr>
			<th>STT</th>
			<th>Nhân Vật</th>
			<th>Máy Chủ</th>
			<th>Mốc Level</th>
			<th>Tình Trạng</th>
			<th>Đổi Quà</th>
		</tr>
	<?php
		$i = 1;
		foreach ($item as $key => $value) { 
	?>
	<tr>
		<td><?php echo $i++; ?></td>
		<td><?php echo $name ?></td>
		<td><?php echo $server->name ?></td>
		<td><?php echo $value->level; ?></td>
		<td><?php if(in_array($value->level, $checkQua)) echo 'Đã nhận'; else echo 'Chưa nhận'; ?></td>
		<td><button id='typetop' <?php if(in_array($value->level, $checkQua)) echo "disabled='disabled'"; else echo ""; ?> data-level="<?php echo $value->level; ?>" class='change'>Đổi</button></td>
	</tr>
	<?php } ?>
	</table>
</div>
<style>
	.container{background-color: #fff; width: 700px; height: 500px;}
	.title-head {display: block; float: left; width: 100%; margin-top: 20px; text-align: center; font-size: 17px; font-weight: bold;}
	table {
	  	border-collapse: collapse;
	    width: 600px;
	    max-width: 100%;
	    margin: 10px auto;
	}
	table tr th, table tr td {text-align: center;}
	td, th {
	  border: 1px solid #999;
	  padding: 0.5rem;
	  text-align: left;
	}
	table tr td button {
		padding: 3px 5px;
    	border: 1px solid #7b7b7b;
    	margin: 0 auto;
    	display: block;
    	width: 40px;
    	text-align: center;
    	cursor: pointer;
    }
    table tr td button.active {background: #ffffb3;}
</style>
<script type="text/javascript">
	var root       = '<?=PATH_URL?>';
	$(document).ready(function(){
		$('.change').click(function(){
			$(this).attr('disabled', 'disabled');
			var level = $(this).attr('data-level');
			//alert(level);
			$.post(root+"newbie/chageToGame", {level: level},function(result){
		        alert(result);
		    });
		})
	})
</script>
