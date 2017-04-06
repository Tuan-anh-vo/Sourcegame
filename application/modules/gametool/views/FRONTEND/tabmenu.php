<div class="news_detail">
    <div class="title"><a class="backbutton" onclick="goBack()" href="javascript:;">Quay lại</a> <?=$title?></div>
    <div class="detail scroll-pane">
        <div class="news_center">
            <?php
            foreach ($content as $value) {
                ?>

                <div class="news_list">
                    <div class="list_img">
                        <a href="<?= site_url($sub.'/' .  htmlspecialchars($value->slug)) ?>"> <img src="<? if($imglink == 0 || $imglink == 3) echo img_tintuc('static/uploads/news/'.$value->image,122,86);  else if ($imglink == 1) echo img_sukien('static/uploads/news/'.$value->image,122,86); else echo img_congdong('static/uploads/news/'.$value->image,122,86);?>" /></a>
                    </div>
                    <div class="list_text">
                        <a class="list_title" href="<?= site_url($sub.'/' . htmlspecialchars($value->slug)) ?>"><?= $value->title ?></a>

                        <p class="list_date">Được đăng ngày <?= date("d-m-Y",strtotime( $value->created));?></p>

                        <p class="list_details"><?= truncateString_($value->description, 200) ?></p>
                    </div>
                </div>


            <?php
            }
            ?>
            <div class="clear"></div>
            <div class="paging">
                <ul>
                    <?
                    if ($pageidx == 1)
                        $pageidx = 1;
                    if ($pageidx > 1)
                    {
                        ?>
                        <li><a href="<?= site_url($sub) . "/?page=" . ($pageidx -1) ?>" class="prev" target="-parent">Trang trước</a></li>
                    <?
                    }
                    for ($i = $pageidx; $i <= $numpage && $i < $pageidx + 5; $i++) {
                        ?>
                        <? if ($i == $pageidx) { ?>
                            <li><a href="<?= site_url($sub) . "/?page=" . $i ?>" class="page_num active"  target="-parent"><? echo $i; ?></a></li>
                        <?}
                        else
                        {?>
                            <li><a href="<?= site_url($sub) . "/?page=" . $i ?>" class="page_num" target="-parent"><? echo $i; ?></a></li>
                        <? }
                    } ?>
                    <?php
                    if($numpage > $pageidx)
                    {
                    ?>
                    <li><a href="<?= site_url($sub) . "/?page=" . ($pageidx + 1) ?>" class="next" target="-parent">Trang tiếp</a></li>
                    <?php
                    }
                    ?>

                </ul>
            </div>
        </div>
    </div>
</div>