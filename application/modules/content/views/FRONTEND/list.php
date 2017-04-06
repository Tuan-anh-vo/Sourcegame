<div class="noidung-tintuc">
   <div class="tieu-de">
      <a href="<?=PATH_URL?>trang-chu" style="color:white; text-decoration:none;">trang chủ</a>
      <img src="<?=PATH_URL?>static/home/images/icon-tintuc.png" alt=""><span style="color: #e2c371;"><?=$parent->name?></span></div>
      <div id="load-data"> 
         <ul>
            <?php if($result){ foreach ($result as $key => $value) {?>
            <?php if($key == 0){
               if($value->image) $img =getCacheImage($value->image,300, 170); else $img = getCacheImageByUrl(paser_image($value->content), 300, 170);
            ?>

            <li class="tin-noibat wow fadeInUp">
               <img src="<?= $img ?>" alt="" style="width:300px; height:170px;" >
               <i></i><a href="<?=PATH_URL.$parent->slug.'/'.$value->slug?>"> <?= CutText($value->title,50)?> </a><em> <?=date('d/m/Y',strtotime($value->created))?> </em>
               <p> <?=CutText( strip_tags( $value->content ), 100 )?> <a href="<?=PATH_URL.$parent->slug.'/'.$value->slug?>">xem thêm >></a></p>
            </li>

            <?php }else{
               if($value->image) $img =getCacheImage($value->image,220, 150); else $img = getCacheImageByUrl(paser_image($value->content), 220, 150);
            ?>

            <li class=" wow fadeInUp">
               <img src="<?= $img ?>" alt="" style="width: 220px; height: 150px;">
               <i></i><a href="<?=PATH_URL.$parent->slug.'/'.$value->slug?>"> <?= CutText($value->title,50)?> </a><em> <?=date('d/m/Y',strtotime($value->created))?> </em>
               <p> <?=CutText( strip_tags( $value->content ), 100 )?> <a href="<?=PATH_URL.$parent->slug.'/'.$value->slug?>">xem thêm >></a></p>
            </li>

            <?php }?>
            <?php } }?>

         </ul>

         <div class="phan-trang">
         <?php echo $pageLink; ?>
         </div>
             
      </div>
   </div>
</div>