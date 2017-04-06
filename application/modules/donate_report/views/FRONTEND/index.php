<div class="content_news right">
    <div class="left news_left">
        <div class="nav_news left">
            <ul class="small_menu ">
                <li class="active" id="litintuc"><a onclick="onclcickTintuc()">Tin tức</a></li>
                <li id="lisukien"> <a onclick="onclickSuKien()">Sự kiện</a></li>
                <li id="likinhnghiem"> <a onclick="onclickKinhNghiem()">Kinh nghiệm</a></li>
                <li id="licongdong"> <a onclick="onclickCongDong()">Cộng đồng</a></li>
            </ul>
        </div>
        <div class="clearAll"></div>
        <!-- tab-1 start -->
        <div class="news_content" id="tab-1">
        	<?php if(!empty($items_1)){
        		$mid = 'tin-tuc/';
        		$items_1[0]->link = PATH_URL.$mid.$items_1[0]->slug;
        		?>
            <div class="hot">
                <div class="img left">
                    <a href="<?php echo $items_1[0]->link?>">
						<img src="<?php echo img(DIR_UPLOAD_NEWS.$items_1[0]->image,135);?>" alt="" class="dblock" />
					</a>
		        </div>
                <div class="detail left">
                    <a href="<?php echo $items_1[0]->link?>"><h1><?php echo CutText($items_1[0]->title,50)?><span><?=date("d/m",strtotime($items_1[0]->created))?></span> </h1></a>
                    <div class="clearAll"></div>
                    <div class="des">
                        <?php echo CutText($items_1[0]->description,100)?>
                    </div>

                </div>
            </div>
            <div class="clearAll"></div>
            <div class="list_news">
               <ul>
					<?php
					$count = count($items_1);
					$count2 = $count-1;
					for($i=1;$i<=$count2;$i++){
						$mid = 'tin-tuc/';
		        		$items_1[$i]->link = PATH_URL.$mid.$items_1[$i]->slug;
						?>
					<li><a href="<?php echo $items_1[$i]->link?>" ><?php echo CutText($items_1[$i]->title,50)?></a>
					</li>
					<?php }?>
				</ul>
            </div>
            <?php }?>
        </div>
        <!-- end tab-1 -->
        
        <!-- tab-2 begin -->
        <div class="news_content" id="tab-2" style="display: none;">
	        <?php if(!empty($items_2)){
	        	$mid = 'tin-tuc/';
        		$items_2[0]->link = PATH_URL.$mid.$items_2[0]->slug;
	        	?>
	        	<div class="hot">
                <div class="img left">
                    <a href="<?php echo $items_2[0]->link?>" >
						<img src="<?php echo img(DIR_UPLOAD_NEWS.$items_2[0]->image,135);?>" alt="" class="dblock" />
					</a>
		        </div>
                <div class="detail left">
                   	<a href="<?php echo $items_2[0]->link?>"><?php echo CutText($items_2[0]->title,50)?></a>
                    <div class="clearAll"></div>
                    <div class="des">
                        <?php echo CutText($items_2[0]->description,100)?>
                    </div>

                </div>
            </div>
            <div class="clearAll"></div>
            <div class="list_news">
               <ul>
					<?php
					$count = count($items_2);
					$count2 = $count-1;
					for($i=1;$i<=$count2;$i++){
						$mid = 'tin-tuc/';
		        		$items_2[$i]->link = PATH_URL.$mid.$items_2[$i]->slug;
						?>
					<li><a href="<?php echo $items_2[$i]->link?>" target="_blank"><?php echo CutText($items_2[$i]->title,50)?></a>
					</li>
					<?php }?>
				</ul>
            </div>
	        <?php }?>
        </div>
        <!-- tab-2 end -->
        
        <!-- tab-3 begin -->
        <div class="news_content" id="tab-3" style="display: none;">
	        <?php if(!empty($items_3)){?>
	        	<div class="hot">
                <div class="img left">
                    <a href="<?php echo $items_3[0]->link?>" target="_blank">
						<img src="<?php echo img(DIR_UPLOAD_NEWS.$items_3[0]->image,135);?>" alt="" class="dblock" />
					</a>
		        </div>
                <div class="detail left">
                   	<a href="<?php echo $items_3[0]->link?>" target="_blank"><?php echo CutText($items_3[0]->title,50)?></a>
                    <div class="clearAll"></div>
                    <div class="des">
                        <?php echo CutText($items_3[0]->description,100)?>
                    </div>

                </div>
            </div>
            <div class="clearAll"></div>
            <div class="list_news">
               <ul>
					<?php
					$count = count($items_3);
					$count2 = $count-1;
					for($i=1;$i<=$count2;$i++){?>
					<li><a href="<?php echo $items_3[$i]->link?>" target="_blank"><?php echo CutText($items_3[$i]->title,50)?></a>
					</li>
					<?php }?>
				</ul>
            </div>
	        <?php }?>
        </div>
        <!-- tab-3 end -->
         <!-- tab-4 begin -->
        <div class="news_content" id="tab-4" style="display: none;">
	        <?php if(!empty($items_4)){?>
	        	<div class="hot">
                <div class="img left">
                    <a href="<?php echo $items_4[0]->link?>" target="_blank">
						<img src="<?php echo img(DIR_UPLOAD_NEWS.$items_4[0]->image,135);?>" alt="" class="dblock" />
					</a>
		         </div>
                <div class="detail left">
                   	<a href="<?php echo $items_4[0]->link?>" target="_blank"><?php echo CutText($items_4[0]->title,50)?></a>
                    <div class="clearAll"></div>
                    <div class="des">
                        <?php echo CutText($items_4[0]->description,100)?>
                    </div>

                </div>
            </div>
            <div class="clearAll"></div>
            <div class="list_news">
               <ul>
					<?php
					$count = count($items_4);
					$count2 = $count-1;
					for($i=1;$i<=$count2;$i++){?>
					<li><a href="<?php echo $items_4[$i]->link?>" target="_blank"><?php echo CutText($items_4[$i]->title,50)?></a>
					</li>
					<?php }?>
				</ul>
            </div>
	        <?php }?>
        </div>
        <!-- tab-4 end -->
    </div>
    
<!-- galalery  -->
	<div class="slide_show left">
	 <?php if(!empty($gallery_event)){?>
		<ul class="bxslider">
		<?php foreach($gallery_event as $event){
					?>
		  <li><a href="<?=PATH_URL."su-kien/".$event->slug?>"><img src="<?=img(DIR_GALLERY_CATEGORY.$event->image,320,254)?>"/></a></li>
		  <?php }?>
		</ul>
		<?php } else {?>
			<div class="theme-default" style="height: 238px";>
				<div class="rank-update" style="color:#f1d5ab;padding: 35px 0px 0px 115px;">Đang cập nhật</div>
			</div>
		<?php } ?>
	</div>
	
</div>


<?php
	if($this->uri->segment(1) != 'dang-nhap' && $this->uri->segment(1) != 'dang-ky'  && !$this->session->userdata('username')){
	?>
	<script>
	$(document).ready(function(){
		//$('#triggerPop').click();
		$('#fancybox-close').css({
			top: '-11px !important',
			right: '-14px !important'
		});
		$('#triggerPopHome').fancybox().trigger("click");
	})
	</script>
	<?php
	}
	?>
	<div style="display:none">		
		<div id="popuphome" style="width:710px; height:525px">
			<a target="_blank" style="text-align: center;display:block;width:710px; height:525px;" href="http://maxgame.vn/tuyet-vuc-online-chinh-thuc-mo-cua-tai-viet-nam-3670-1-1.html">
				<img src="<?=PATH_URL?>static/images/121010_thegioihoanmy05.png" alt=""/>				
			</a>
		</div>		
	</div>
<a id="triggerPopHome" href="#popuphome" class="fancy"></a>