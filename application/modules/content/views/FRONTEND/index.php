<ul class="tabs">
    <li class="tab-link current" data-tab="tab-1"><span>Sự kiện</span></li>
    <li class="tab-link" data-tab="tab-2"><span>Tin tức</span></li> 
    <!-- <li class="tab-link" data-tab="tab-3" style="width: 92px;"><span>Cộng đồng</span></li> -->
    <a href="javascript:;" onclick="OpenAllArticleInCate()"></a>
</ul>
<?php if($content){ foreach ($content as $key => $value) {?>
<div id="tab-<?=$key+1?>" class="tab-content <?php if( $key == 0 ) echo 'current';?>">
    <ul>
        <?php if( !empty($value->obj_news) ){ foreach ($value->obj_news as $k => $vl) {?>

        <?php if( $k == 0 ){ if($vl->image) $img = getCacheImage($vl->image,180, 95); else $img = getCacheImageByUrl(paser_image($vl->content), 180, 95); ?>
        <li>
            <i></i><a href="<?=PATH_URL.$value->slug.'/'.$vl->slug?>"> <?= CutText($vl->title, 50) ?> </a><br />
            <p>
                <img src="<?=$img?>" alt="">
                <span> <?= CutText( strip_tags( $vl->content ), 100 ) ?>
                    <a href="" style="position: absolute;right: 10px;top: 105px;"> xem thêm >> </a>
                </span>
            </p>
        </li>
        <?php }else{ ?>

        <li><i></i><a href="<?=PATH_URL.$value->slug.'/'.$vl->slug?>"><?= CutText($vl->title, 50) ?></a><em><?=date( 'd/m/Y', strtotime($vl->created) )?></em></li>

        <?php } } } ?>
        
    </ul>
</div>
<?php } }?>
<!-- aaa -->