<?php
if(is_array($rs)){
	if(!empty($rs)){
	$total=0;
	foreach ($rs as $name => $value) {
		$total+=$value->count;
	}

	?>
	<table class="gmGrid">
		<tr>
			<th width="50%" class="center">Level</th>
			<th width="50%" class="center">Số tài khoản <span style="color:#2175F5">(<?=$total?>)</span></th>
		</tr>
		
		<?php

			foreach ($rs as $key => $row) {

				?>
		<tr class="right-content-thongke-<?=$key%2 == 0 ? 'rowle' : 'rowchan' ?>">
			<td class="center"><?=$row->level?> </td>
			<td class="center"><?=$row->count?> <span  style="color:#2175F5;">(<?=$percent=round((($row->count)/$total)*100,2);?>%)</span></td>
		</tr>
				<?php }?>
	</table>
	<?php
	}

	else{
	?>
	<div class="center">Không có dữ liệu.</div>
	<?php
	}
}
else{?>
	<table class="gmGrid">
			<tr>
				<th class="center">Không có dữ liệu</th>				
			</tr>			
		</table>
<?php
}

?>