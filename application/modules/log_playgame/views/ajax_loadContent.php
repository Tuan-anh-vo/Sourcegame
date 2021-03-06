<div class="content_table">
	<table cellspacing="0" cellpadding="0" border="0" width="100%">
		<tr>
			<th class="th_no_cursor" width="40">No.</th>
			<th width="80" class="th_left" onclick="sort('function')"><div id="function" class="sort icon_no_sort">User</div></th>
			<th width="80" class="th_left" onclick="sort('function')"><div id="function" class="sort icon_no_sort">IP</div></th>
			<th width="50" onclick="sort('function_id')"><div id="function_id" class="sort icon_no_sort">Server</div></th>
			<th class="th_last" width="100" onclick="sort('created')"><div id="created" class="sort icon_sort_asc">Time</div></th>
		</tr>
		<?php
			if($result){
				$i=0;
				$md_f = 'function';
				foreach($result as $k=>$v){
		?>
		<tr class="item_row<?=$i?> <?php ($k%2==0) ? print 'row1' : print 'row2' ?>">
			<td class="td_center"><?=$k+1+$start?></td>
			<td class="th_left"><?=$v->username?></td>
			<td class="th_left"><?=$v->ip?></td>
			<td class="th_left"><?=$v->slug?></td>
			<td class="th_last td_center"><?=date('d-m-Y H:i:s',strtotime($v->created))?></td>
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