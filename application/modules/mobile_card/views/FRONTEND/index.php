<script type="text/javascript">
$(document).ready(function(){
	<?php
	foreach($servers as $item){
		if($item->status != 4){
	 ?>
		$.post(
			root+'servers/GetPlayerLevel/<?=$item->id?>/<?=$user->username?>',
			'',
			function(response){
				if($.trim(response) != ''){
					$('#getData<?=$item->id?>').html('<div class="levelhientai">Level hiện tại '+response+'</div>');
				}
				else
					$('#getData<?=$item->id?>').html('<div class="chuataonhanvat">Chưa tạo nhân vật</div>');

			}
			);
	<?php
		}
	}
	?>
})
</script>
<div class="main_content imba_height">
	<div class="wrap_news">
		<div class="title">
	
			<div class="title_center">
				<h2><span class="charge_text"><img src="<?=PATH_URL.'static/images/background/danh-sach-may-chu.png'?>" /></span></h2>
			</div>
			
		</div>
		<div class="news_center napthe">
			
			<div class="feature">
				<div class="sever">
				<?php
				foreach($servers as $item){			
					$port = (!empty($item->port_game)) ? ':'.$item->port_game : '';
					$sub = (!empty($item->sub_folder))? '/'.$item->sub_folder : '';
					
					if($this->session->userdata('user_login')){
						if($item->status == 1){
				?>
				 <form id="frmPlay<?=$item->id?>" target="_blank" action="http://<?=$item->ip.$port.$sub?>/flash/game.php" method="post">
					<input type="hidden" name="username" value="<?=rawurlencode(base64_encode($user->username))?>"/>
					<input type="hidden" name="password" value="<?=rawurlencode(base64_encode($user->token))?>"/>
				</form>
				<?php
				}
				?>
				<div class="block-banner">
				
				<?	if($item->server_status	 == 4 ){
						echo '<div id="getData'.$item->id.'"><div class="levelhientai" style="color:#ff0000;padding-left:60px">Máy chủ đang bảo trì</div></div>';
					}
					else
						echo '<div id="getData'.$item->id.'"></div>';
				?>
				<a href="javascript:;" class="server_1 <?php if($item->status) echo 'active'?>" onclick="playGame(<?=$item->id?>)"><?=$item->name?></a>
				</div>
				<?
				}
				}
				?>

					 <div class="clearAll"></div>
				</div>
			</div>
			<div class="huongdan">
				Nếu bạn mới bắt đầu gia nhập Loạn Tam Giới. Dành chút thời gian xem <a href="http://diendan.maxgame.vn/forum.php?mod=forumdisplay&fid=88" target="blank">Hướng Dẫn Tân Thủ.</a>
				
				<h3>Hướng dẫn theo Level</h3>
				<ul>
				<li><a href="http://diendan.maxgame.vn/misc.php?mod=tag&id=5">Hướng dẫn tân thủ Level 30 - 35</a></li>
				<li><a href="http://diendan.maxgame.vn/misc.php?mod=tag&id=4">Hướng dẫn tân thủ Level 35 - 40</a></li>
				<li><a href="http://diendan.maxgame.vn/misc.php?mod=tag&id=3">Hướng dẫn tân thủ Level 40 - 50</a></li>
				</ul>
			</div>
		</div>
		<div class="news_bottom"></div>
	</div>
	
<div class="clearAll"></div>

</div>
<div class="clearAll"></div>