<div class="noidung-tintuc1">
    <div class="tieu-de">
        <a href="<?=PATH_URL?>trang-chu" style="color:white; text-decoration:none;">trang chủ</a>
        <img src="<?=PATH_URL?>static/home/images/icon-tintuc.png" alt="">
        <a href="<?=PATH_URL.$parent->slug?>"><span style="color: #e2c371;"> <?=$parent->name?> </span></a>
        <img src="<?=PATH_URL?>static/home/images/icon-tintuc.png" alt=""><i> <?=CutText($result->title,80)?> </i>
    </div>
    <em>Đăng ngày : <?=date('d/m/Y')?></em>
    <div style="margin-left:10px; margin-right: 10px; font-family: Tahoma, Geneva, sans-serif;">
    <!-- START OF CONTENT DETAIL -->
    <?= $result->content ?>
    <!-- END OF CONTENT DETAIL -->
    </div> 
    <!-- comment fb-->
    <div class="fb-comments"
         data-href="<?=current_url()?>"
         data-width="720"
         data-numposts="5">
    </div> 
    <!-- end comment fb-->
    <div class="tintuc-lienquan">Tin tức liên quan<a href="#"><img src="<?=PATH_URL?>static/home/images/them-link.png" alt="" style="margin-top: -15px;"></a></div>
    <div id="article_refer">
        <!-- START OF RELATED CONTENT -->
        <ul class="lien-quan">
            <?php if($other){ foreach ($other as $vl) { ?>
            <li>
                <i></i>
                <a href="<?=PATH_URL.$parent->slug.'/'.$vl->slug?>"><?= CutText( $vl->title, 80 )?></a>
                <em><?=date( 'd/m/Y', strtotime($vl->created) )?></em>
            </li>
            <?php } } ?>
        </ul>
        <!-- START OF RELATED CONTENT -->     
    </div> 
</div>
