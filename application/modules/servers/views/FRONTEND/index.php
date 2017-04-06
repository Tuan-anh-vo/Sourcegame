<div class="noidung-tintuc">
    <div class="tieu-de">
        <a href="<?=PATH_URL?>trang-chu" style="color:white; text-decoration:none;">trang chủ</a>
        <img src="<?=PATH_URL?>static/home/images/icon-tintuc.png" alt=""><span style="color: #e2c371;"> Máy chủ </span>
    </div>
    <div class="list-news-dt wow fadeInUp">
        <div class="server-wrapper">
            <div class="sv-new-new">
                <?php if ($servers) $sv_new = array_slice($servers,0,3);
                if(isset($sv_new)){
                  echo "<ul>";
                    foreach ($sv_new as $key => $vl){
                        $link = PATH_URL.'choi-game'.'/'.$vl->slug;
                      ?>
                    <li>
                      <a href="<?=$link?>" class="sv<?=$key+1?>" target="_parent">
                        <?=$vl->name?>
                      </a>
                  </li>
                <?php } echo "</ul>"; }?>
            </div>
            <div class="sv-new" style="">
                <?php if (!empty($servers)){
                    echo "<ul>";
                      foreach ($servers as $key => $vl) {
                         $link = PATH_URL.'choi-game'.'/'.$vl->slug;
                          switch ($vl->server_status) {
                              case '0':
                                  $text = 'Ẩn';
                                  $color = '#FF0033';
                                  $img_stt = '';
                                  break;
                              case '1':
                                  $text = 'Tốt';
                                  $color = '#04b500';
                                  $img_stt = 'sv-stt-tot.png';
                                  break;
                              case '2':
                                  $text = 'Sắp đầy';
                                  $color = '#ff8400';
                                  $img_stt = '';
                                  break;
                              case '3':
                                  $text = 'Đầy';
                                  $color = '#fe2012';
                                  $img_stt = 'sv-stt-day.png';
                                  break;
                              case '4':
                                  $text = 'Bảo trì';
                                  $color = '#c5c5c5';
                                  $img_stt = 'sv-stt-btri.png';
                                  break;
                              default:
                                  $text = 'Mới';
                                  $color = '#55D152';
                                  $img_stt = 'sv-stt-moi.png';
                              break;
                          } ?>

                <li><a <?php //if($vl->status == 0){if(!is_local()) echo "style='display:none'";} ?> href="<?= $link ?>" target="_parent">
                    <?=$vl->name?>
                </a><span></span></li>
                <?php } echo "</ul>"; }?>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>

<style type="text/css">
  .list-news-dt {display: block; height: auto; width: 100%;padding:0 0 20px;}
  .server-wrapper{width: 631px; height: auto !important; background: none !important;margin:40px auto 0;}
  .title-content{font-size: 20px; text-align: center; height: 40px; line-height: 40px;}
  .sv-new{float: left; width: 100%; background: url(<?php echo PATH_URL;?>/static/images/index/bg-ds-sv.png) no-repeat top center;}
  .sv-new ul li{ margin: 12px 0 0 20px; background: url(<?php echo PATH_URL;?>static/home/images/btn-server-hot.jpg); width: 187px; height: 42px; float: left; }
  .sv-new ul li a{color:#602323; font-size: 15px; width: 100%; height:100%; text-align: center; line-height: 42px;display: block;font-family:arial;float: left;margin-top: 0px;}
  .sv-new ul li:hover{-webkit-filter: brightness(1.2);
    filter: brightness(1.2);
    webkit-transition: 0.1s;
    transition: 0.1s;}
  .sv-new ul li a:hover{color: #E9F900;}  
  .pop-server-title span{padding:12px 10px 6px;font-family: arial;font-size: 16px;font-weight: bold;text-transform: uppercase;color:#ce9d54;display: block;}
  .sv-new-new{float: left;  width: 100%; background: url(<?php echo PATH_URL;?>/static/images/index/bg-sv-new.png) no-repeat top left;}
  .sv-new-new ul, .sv-playing ul, .sv-new ul{width: 100%; margin: 25px 0px 15px 0px; overflow: hidden;}
  .sv-new-new ul li, .sv-playing ul li{ margin: 12px 0 0 20px; background: url(<?php echo PATH_URL;?>static/home/images/btn-server-new.jpg); width: 187px; height: 42px; float: left; }
  .sv-new-new ul li:hover{
    -webkit-filter: brightness(1.2);
    filter: brightness(1.2);
    webkit-transition: 0.1s;
    transition: 0.1s;}
  .sv-new-new ul li a {color:#602323; font-size: 16px ;height:100%; line-height: 42px;display: block;font-family:arial;text-align:center;width:100%;float:left;margin-top:0px;} 
  .sv-new-new ul li a:hover{color: #E9F900;}/**/
</style>
