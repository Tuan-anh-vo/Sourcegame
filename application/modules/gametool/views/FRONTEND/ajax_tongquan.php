<?php
// pr(($sid),1);
if(is_array($rs)){
	if(!empty($rs)){
	$tongnap=$naptrongngay=$soluotnap=$sonv=$sonvdktrongngay=$sotkdntrongngay=$knbton=$dongton=$online=0;
?>
<table class="gmGrid">
	<tr>
		<?php if($sid==0){?>
		<th width="" class="center">Server</th>
		<?php }?>
		<th width="" class="center">Tổng nạp</th>
		<th width="" class="center">Nạp trong ngày</th>
		<th width="" class="center">Số lượt nạp</th>
		<th width="" class="center">Tổng Nvật</th>
		<th width="" class="center">Số NV ĐKý trong ngày</th>
		<th width="" class="center">Số TK ĐNhập trong ngày</th>
		<th width="" class="center">KNB tồn</th>
		<th width="" class="center">Đồng tồn</th>
		<th width="" class="center">Đang online</th>
	</tr>	
<?php 
	$i=0;
		
	foreach ($rs as $key => $row) { if(!empty($row->tongNap)){ ?>

	<tr class="right-content-thongke-<?=$i%2 == 0 ? 'rowle' : 'rowchan' ?>">

	<?php	
		if(isset($row->tongNap)){
			if($sid==0){
	?>
		<td class="center" style="font-weight:bold"><?=count($row->name) > 1 ? implode(' + ', $row->name) : $row->name[0]?></td>	
	<?php } ?>	

		<td class="center"><?=number_formatVN($row->tongNap)?></td>
		<td class="center"><?=number_formatVN($row->napTrongNgay)?></td>
		<td class="center"><?=number_formatVN($row->soLuotNap)?></td>
		<td class="center"><?=number_formatVN($row->soNV)?></td>
		<td class="center"><?=number_formatVN($row->soNVdktrongngay)?></td>
		<td class="center"><?=number_formatVN($row->soTKDangNhapTrongNgay)?></td>
		<td class="center"><?=number_formatVN($row->KNBTon)?></td>
		<td class="center"><?=number_formatVN($row->DongTon)?></td>
		<td class="center"><?=number_formatVN($row->online)?></td>

	<?php
		$tongnap+=$row->tongNap;
		$naptrongngay+=$row->napTrongNgay;
		$soluotnap+=$row->soLuotNap;
		$sonv+=$row->soNV;
		$sonvdktrongngay+=$row->soNVdktrongngay;
		$sotkdntrongngay+=$row->soTKDangNhapTrongNgay;
		$knbton+=$row->KNBTon;
		$dongton+=$row->DongTon;
		$online+=$row->online;
		}
	}
		elseif(!empty($row->name)){
	?>
		<td class="center" style="font-weight:bold"><?=count($row->name) > 1 ? implode(' + ', $row->name) : $row->name[0]?></td>	
		<td colspan="8" style="text-align:center">Không lấy được dữ liệu từ service</td> 

	<?php } ?>
	</tr>


	<?php

		$i++;	
	}
		if($sid==0){	
		?>
	<tr style="background:#95CEE4">

		<td class="center" style="font-weight:bold">Tổng</td>
		<td class="center"><?=number_formatVN($tongnap)?></td>
		<td class="center"><?=number_formatVN($naptrongngay)?></td>
		<td class="center"><?=number_formatVN($soluotnap)?></td>
		<td class="center"><?=number_formatVN($sonv)?></td>
		<td class="center"><?=number_formatVN($sonvdktrongngay)?></td>
		<td class="center"><?=number_formatVN($sotkdntrongngay)?></td>
		<td class="center"><?=number_formatVN($knbton)?></td>
		<td class="center"><?=number_formatVN($dongton)?></td>
		<td class="center"><?=number_formatVN($online)?></td>
	</tr>
	<?php } ?>
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
<div class="center">Không có dữ liệu.</div>
<?php
}
?>