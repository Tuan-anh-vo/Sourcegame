<div class="content_table">

	<table cellspacing="0" cellpadding="0" border="0" width="100%">

		<tr>

			<th class="th_no_cursor" width="40">No.</th>

			<th class="th_no_cursor" width="31"><input type="checkbox" class="custom_chk" id="selectAllItems" onclick="selectAllItems(<?=count($result)?>)" /></th>

			<th class="th_left" onclick="sort('username')"><div id="username" class="sort icon_no_sort">Username</div></th>

			<th class="th_left" onclick="sort('card_pin')"><div id="card_pin" class="sort icon_no_sort">Mã Thẻ</div></th>

			<th class="th_left" onclick="sort('card_serial')"><div id="card_serial" class="sort icon_no_sort">Seri Thẻ</div></th>

			<th class="th_left" onclick="sort('card-type')"><div id="type_card" class="sort icon_no_sort">Loại Thẻ</div></th>

			<th class="th_left" onclick="sort('card_amount')"><div id="card_amount" class="sort icon_no_sort">Mệnh Giá Thẻ</div></th>

			<th class="th_left" onclick="sort('gamecoin')"><div id="gcoin" class="sort icon_no_sort">KNB</div></th>

			<th width="100" onclick="sort('created')"><div id="created" class="sort icon_sort_asc">Time</div></th>


			<th class="th_last" onclick="sort('step')"><div id="step" class="sort icon_no_sort">Trạng Thái</div></th>

		</tr>

		<?php

			if($result){

				$i=0;

				foreach($result as $k=>$v){

		?>

		<tr class="item_row<?=$i?> <?php ($k%2==0) ? print 'row1' : print 'row2' ?>">

			<td class="td_center"><?=$k+1+$start?></td>

			<td class="td_no_padd"><input type="checkbox" class="custom_chk" id="item<?=$i?>" onclick="selectItem(<?=$i?>)" value="<?=$v->id?>" /></td>

			<td class="th_left"><?=$v->username?></td>

			<td class="th_left"><?=$v->card_pin?></td>

			<td class="th_left"><?=$v->card_serial?></td>

			<td class="th_left"><?=$v->card_type?></td>

			<td class="th_left"><?=number_format($v->card_amount,0,'','.')?></td>

			<td class="th_left"><?=number_format($v->gamecoin,0,'','.')?></td>

			<td width="100" class="th_left"><?=date('d-m-Y H:i:s',strtotime($v->created))?></td>


			<td class="th_last">

				<?php if($v->step == 2 && $v->flag == 1){?>
?>

					<span style="color: green">Thành công</span>

				<?php } else { ?>

					<span style="color: red">Thất bại : <?=$v->message?></span>

				<?php } ?>

			</td>

		</tr>

		<?php $i++;}}else{ ?>

		<tr class="row1">

			<td class="th_last td_center" colspan="50" style="font-size: 20px; padding: 50px 0">No data</td>

		</tr>

		<?php } ?>

	</table>

</div>



<?php if($result){ ?>

<div class="footer_table">

	<div class="item_per_page">Items per page:</div>

	<div class="select_per_page">

		<select id="per_page" onchange="searchContent(<?=$start?>,this.value)">

			<option <?php ($per_page==10) ? print 'selected="selected"' : print '' ?> value="10">10</option>

			<option <?php ($per_page==25) ? print 'selected="selected"' : print '' ?> value="25">25</option>

			<option <?php ($per_page==50) ? print 'selected="selected"' : print '' ?> value="50">50</option>

			<option <?php ($per_page==100) ? print 'selected="selected"' : print '' ?> value="100">100</option>

		</select>

	</div>

	

	<div class="pagination"><?=$this->adminpagination->create_links();?></div>

</div>

<div class="clearAll"></div>

<?php } ?>