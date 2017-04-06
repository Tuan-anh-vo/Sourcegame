<?php if(!empty($servers)){ ?>
<ul>
	<?php foreach ($servers as $k => $vl) { if($k > 3) break; ?>
      <li><a target='_blank' href="<?=PATH_URL.'choi-game/'.$vl->slug?>"><?=CutText($vl->name,20)?></a></li>
    <?php }?>
</ul>
<?php }?>
<div class="sv-readmore">
    <a onclick="popup('link','<?=PATH_URL?>may-chu')" href="javascript:;"></a>
</div>