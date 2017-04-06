<?php if($servers){?>
<div class="servers left">
	<div class="title"></div>
    <ul>
    	<?php foreach ($servers as $key => $value) { if($key == 4) break;?>
    		<li><a href="<?php echo PATH_URL.'choi-game'.'/'.$value->slug;?>"><?php echo $value->name;?></a><span>[<?=date('d-m', strtotime($value->playtime))?>]</span></li>
    	<?php }?>
	</ul>
</div>
<a class="s_xemthem" href="">Xem thêm &gt;</a>
<?php }?>
