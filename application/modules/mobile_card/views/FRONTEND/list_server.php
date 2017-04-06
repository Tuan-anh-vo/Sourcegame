<?php
if(!empty($servers)){
?>
<div class="fwb c_ffc600">Danh sách máy chủ</div>
	<?php
	foreach($servers as $item){
		switch($item->server_status){
			case 1:
				$status = 'Tốt';
				$color = 'c_55ec35';
				break;
			case 2:
				$status = 'Sắp đầy';
				$color = 'c_c0a342';
				break;
			case 3:
				$status = 'Đầy';
				$color = 'c_ff0000';
				break;	
			case 4:
				$status = 'Bảo trì';
				$color = 'c_ff0000';
				break;	
		}
	?>	
	<div class="mt15"><?=$item->name?>&nbsp;&nbsp;&nbsp;&nbsp;
		<?php
		if($item->is_new){
		?>
		<img class="img_new" src="<?=PATH_URL.'static/images/icon/icon_new.png'?>" alt="" class="png" />
		<?php
		}
		?>
	</div>
	<div>
		<a class="btn-play" onclick="playGame(<?=$item->id?>)" title="Đăng nhập máy chủ <?=$item->name?>">
			<img src="<?=PATH_URL.'static/images/img_count_'.$item->server_status.'.png'?>" alt="" class="png" />
		</a>
	&nbsp;&nbsp;<span class="<?=$color?>"><?=$status?></span><? if ($item->server_status !=4){?>&nbsp;&nbsp;<a href="http://www.loantamgioi.com/may-chu">[ Vào chơi ]</a><?}?></span> 
	</div>
	
<?php } ?>
	<div class="fwb c_ffc600" style="padding:10px 0px 10px 0px">Hỗ trợ Online</div>

	<div class="hotro">
		<p style="padding-bottom:5px"><a href="ymsgr:SendIM?loantamgioi" title="Chat với chúng tôi"><img src="http://opi.yahoo.com/online?u=loantamgioi" /> Hỗ trợ Loạn Tam Giới (nhân vật nữ)</a> </p>
		<p><a href="ymsgr:SendIM?hotro_loantamgioi" title="Chat với chúng tôi"><img src="http://opi.yahoo.com/online?u=hotro_loantamgioi" /> Hỗ trợ Loạn Tam Giới (nhân vật nam)</a></p>
	</div>
<?}else{
?>
<div class="updating" style="font-size:13px;padding-right:10px; font-weight:bold">Máy chủ Tiên giới sẽ được mở cửa vào ngày 10h ngày 21/03/2013</div>
<?php
}

?>