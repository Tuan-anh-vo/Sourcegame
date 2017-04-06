<table class='level_item'>
	<tr>
		<th>STT</th>
		<th width='200px'>Vật phẩm<br><i>(cách nhau bởi dấu ",")</i></th>
		<th width='200px'>Số lượng<br><i>(cách nhau bởi dấu ",")</i></th>
		<th width='200px'>Level</th>
		<th width='200px'>Thao tác</th>
	</tr>
	<?php 
		$i = 1;
		foreach ($item as $key => $value) {
			$items = json_decode(unserialize($value->items));
			$sums =  json_decode(unserialize($value->sums));
	?>
		<tr class='level' id="div_<?php echo $i; ?>">
			<td class='level_name'><?php echo $i; ?></td>
			<td><input type="text" name="item[]" placeholder="id item"  value="<?php echo $items; ?>" ></td>
			<td><input type="text" name="number[]"  placeholder="number" value="<?php echo $sums; ?>" ></td>
			<td><input type="text" name="level[]"  placeholder="level" value="<?php if(isset($value->level)) echo $value->level;?>" ></td>
			<td><input class="detele_level" type="button" onclick="delItem(<?php echo $i; ?>)" value="Delete"></td>
		</tr>
	<?php $i++; } ?>
</table>