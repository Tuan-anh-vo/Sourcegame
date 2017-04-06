
<table id="tbl-thongke">
 	<tr><th>Kênh Tiền</th><th>Nửa tháng đầu</th><th>Nửa tháng cuối</th><th>Tổng tháng</th></tr>
 	<?php
 	if($statis)
 	{
 		$sum1 = 0; $sum2 = 0; $sum = 0;
 	 	foreach ($statis as $key => $value) {
 	 		$sum1 +=  $value['tong1'];
 	 		$sum2 +=  $value['tong2'];
 	 	?>
 	 	<tr><td><?=$value['name']?></td><td><?=$value['tong1']? product_price($value['tong1']): 0;?></td><td><?=$value['tong2']? product_price($value['tong2']): 0; ?></td><td><?=product_price($value['tong1']+ $value['tong2'])?></td></tr>
 	 	<?php
 		}
 		?>
 		<tr><td>Tổng</td><td><?=product_price($sum1)?></td><td><?=product_price($sum2)?></td><td><?=product_price($sum1+$sum2)?></td></tr>
 		<?php
 	}
 		?>
</table>