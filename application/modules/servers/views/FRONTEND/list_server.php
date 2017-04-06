<?php if(!empty($servers)){ ?>
<h2 class="game-servers__title">Danh sách máy chủ</h2>
<a  href="<?=PATH_URL.'choi-game/'.$servers[0]->slug?>" target="_blank" class="game-servers__newest-server game-servers__login-game" target="_blank"><?=$servers[0]->name?></a>
<ul class="game-servers__list" id="game-servers__list">
  <?php foreach ($servers as $k => $vl) {
            if($k == 0)
                continue;
            ?>
    <li class="bj"><a href="<?=PATH_URL.'choi-game/'.$vl->slug?>" target="_blank" class="game-servers__login-game"><?=$vl->name?></a></li>
  <?php }?>
</ul>
<?php }?>
<a href="<?=PATH_URL?>may-chu" class='btn-sv-more' style='margin: 0 0 0 82px;'>Xem thêm >> </a>
