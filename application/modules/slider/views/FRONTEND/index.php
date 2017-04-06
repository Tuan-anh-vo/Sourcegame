<!-- START OF MODULE SLIDER -->
<div id="owl-demo1" class="owl-carousel">
	<?php if( !empty($result) ){ foreach ($result as $vl) {?>
	<div><a href="<?=$vl->link?>" target="_blank"><img width="530" height="290" src="<?=trim( getCacheImage($vl->image, 530, 290) );?>"></a></div>	
	<?php } } ?>
</div>
<!-- END OF MODULE SLIDER -->