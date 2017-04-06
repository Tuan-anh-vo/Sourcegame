<?php
    if($servers != 0) $a = array_chunk($servers, 6);
?>
<div id="container">
    <div id="wrapper">
        <div id="header">
            <a href="<?=PATH_URL?>trang-chu" class="logo"><img src="<?=PATH_URL?>static/images/logo.png"></a>
            <div class="user-login">
                
            </div>
            <div class="main-nav">
                <ul>
                    <li><a href="<?=PATH_URL?>trang-chu" title="Trang chủ" class="home"></a></li>
                    <li><a href="<?=PATH_URL?>nap-the" class="napthe" title="Nạp thẻ"></a></li>
                    <li><a onClick="ga('send', 'event', 'User', 'View', 'Fanpage');" href="http://facebook.com/quybaoonline" target="_blank" class="diendan" title="Diễn đàn"></a></li>
                </ul>
            </div>
        </div>
        <div id="content">
            <div id="content-top">
                <div class="server">
                    <div class="bg-server"></div>
                </div>
                <div class="li-server">
                    <div class="server-new">
                        <ul>
                             <?php if($servers != 0) foreach ($servers as $key => $value) {if($key <2){
                                ?>
                                    <li><a onClick="ga('send', 'event', 'User', 'Join Game');" title="<?=$value->name?>" href="<?=PATH_URL?>choi-game/<?=$value->slug?>"><?=$value->name?></a></li>
                            <?php }}?>
                        </ul>
                    </div>

                    <div class="munber-server">
                        <ul class="tabs">
                        <?php
                        $d = 0;
                        for($i = 0; $i < count($servers); $i++){
                            if($i % 6 == 0){
                                $b = $i+1; $c = $i +6;  $d++;?>
                                <li><a onClick="ga('send', 'event', 'User', 'Join Game');" href="#" class="tab-server <?php if($d==1) echo ('active');?>" data-tab="ser-<?=$d?>" title="1-6"><?=$b?> - <?=$c?></a></li>
                           <?php }
                        }?>
                        </ul>
                        <?php if(isset($a)) for($i = 0; $i < count($a); $i++){?>
                        <div class="all-server active" id="ser-<?=$i+1?>" style="display: <?php if($i!=0) echo('none'); ?>">
                            <ul>
                                <?php foreach ($a[$i] as $key => $value) {?>
                                    <li class="detail-server"><a onClick="ga('send', 'event', 'User', 'Join Game');" href="<?=PATH_URL?>choi-game/<?=$value->slug?>" title="<?=$value->name?>"><?=$value->name?></a></li>
                               <?php }?>
                            </ul>
                        </div>
                        <?php }?>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="detail-new">
                    <div class="new-left">
                        <ul class="bxslider">
                             <?php if(count($news) > 0) foreach ($news as $key => $value) {
                                $key ==0 ? $display = "block" : $display = 'none';
                                ?>
                                <li style="display: <?=$display?>" class="test img-<?=$key?>"><a onClick="ga('send', 'event', 'User', 'View', 'News');" href="<?=PATH_URL?>tin-tuc/<?=$value->slug?>" title="<?=$value->title?>"><img src="<?=img(DIR_UPLOAD_NEWS.$value->image,240,200)?>" alt="<?=$value->title?>"></a></li>
                            <?php }?>
                        </ul>
                    </div>
                    <div class="new-right">
                        <div class="title-new">
                            <p>
                                <a onClick="ga('send', 'event', 'User', 'View', 'News');" href="<?=PATH_URL?>tin-tuc">Tin tức</a>
                                <a onClick="ga('send', 'event', 'User', 'View', 'News');" href="<?=PATH_URL?>tin-tuc" class="readmore">Xem thêm +</a>
                            </p>
                        </div>
                        <ul>
                            <?php if(count($news) > 0) foreach ($news as $key => $value) {?>
                                <li><a class="tab-snews" data-tab="img-<?=$key?>" onClick="ga('send', 'event', 'User', 'View', 'News');" href="<?=PATH_URL?>tin-tuc/<?=$value->slug?>" title="<?=$value->title?>"><?=$value->title?></a></li>
                            <?php }?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <div id="content-bottom"></div>
        </div>
    </div>