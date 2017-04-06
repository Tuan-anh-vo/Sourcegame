<div class="content_table">
	<table cellspacing="0" cellpadding="0" border="0" width="100%">
		<tr>
			<th class="th_no_cursor" width="40">No.</th>
			<th class="th_no_cursor" width="31"><input type="checkbox" class="custom_chk" id="selectAllItems" onclick="selectAllItems(<?=count($result)?>)" /></th>
			<th width="150" class="th_left th_no_cursor" onclick="sort('card_amount')"><div id="card_amount">Mệnh giá thẻ</div></th>
			<th class="th_left" onclick="sort('gamecoin')"><div id="gamecoin" class="sort icon_no_sort">Game Coin (KNB)</div></th>
			<th class="th_center"><div>Action</div></th>
		</tr>
		<?php
			if($result){
				$i=0;
				foreach($result as $k=>$v){
		?>
		<tr class="item_row<?=$i?> <?php ($k%2==0) ? print 'row1' : print 'row2' ?>">
		   <td class="td_center"><?=$k+1+$start?></td>
		   <td class="td_no_padd"><input type="checkbox" class="custom_chk config" id="item<?=$i?>" onclick="selectItem(<?=$i?>)" value="<?=$v->id?>" /></td>
		   <td class="td_center">
		   		<input value="<?php if(isset($v->card_amount)) { print $v->card_amount; }else{ print 0;} ?>" type="text" name="gamecoin" id="inp_card_amount<?=$v->id?>" />
	   		</td>

		   <td class="th_left">
		   		<input data-gamecoin="<?=$v->gamecoin?>" class="gamecoin" value="<?php if(isset($v->gamecoin)) { print $v->gamecoin; }else{ print 0;} ?>" type="text" name="gamecoin" id="inp_gamecoin<?=$v->id?>" />
		   	</td>
		   <td class="th_center">
		   		<input style="border:1px solid cecece;padding:5px;background:#dedede;cursor:pointer" type="button" onclick="updateConfig(<?=$v->id?>)" value="Update"/>
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
</div>
<div class="clearAll"></div>
<?php } ?>