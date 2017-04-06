<ul class="bxslidetop">
<?php if($result) { foreach ($result as $item) {?>
	<li><a href="<?=$item->link?>"><img src="<?=trim(getCacheImage($item->image, 596, 257));?>" width='596' height='257'/></a></li>
<?php } } ?>
	<!-- <li><a href=""><img src="static/images/index/s1.jpg" width="596" alt=""></a></li> -->
</ul>
<script type="text/javascript">
$(document).ready(function(){
	$('.bxslidetop').bxSlider({auto:true});
})
</script>