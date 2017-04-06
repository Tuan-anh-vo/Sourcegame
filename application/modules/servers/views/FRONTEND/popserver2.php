<?php
    for($i=1;$i<50;$i++){
      if($i==1)  
        $arr_list[$i]="1-12";
      else if($i==13)  
       $arr_list[$i]="13-24";
      else if($i==25)
       $arr_list[$i]="25-36"; 
      else
        $arr_list[$i]="";
    }

?>
<div class="server-wrapper">
  <?php if($servers_cur){?>
 <!--  <div class="pop-server-title"><span>server đang chơi</span></div>
  <div class="sv-new">
    <?php if ($servers_cur)
        echo "<ul>";
          foreach ($servers_cur as $key => $vl){ ?>
          <li>
            <a href="<?php echo PATH_URL.'choi-game'.'/'.$vl->slug;?>" class="sv<?=$key+1?>" target="_parent">
              <?=$vl->sname?>
            </a>
        </li>
    <?php } echo "</ul>";?>

  </div>
  <div class="clear"></div> -->
  <?php }?>
  <div class="pop-server-title"><span style="color:#b72924">server mới</span></div>
  <div class="sv-new-new">
    <?php if ($servers) $sv_new = array_slice($servers,0,2);
      if($sv_new){
        echo "<ul>";
          foreach ($sv_new as $key => $vl){ ?>
          <li>
            <a href="<?php echo PATH_URL.'choi-game'.'/'.$vl->slug;?>" class="sv<?=$key+1?>" target="_parent">
              <?=$vl->name?>
            </a>
        </li>
    <?php } echo "</ul>"; }?>

  </div>
  <div class="clear"></div>
  <div class="pop-server-title"><span>danh sách server</span></div>

  <div class="wa-li-t">
      <ul class="ls_tab_h">  
          <?php if (!empty($servers))
              foreach ($servers as $key => $vl) { ?>       
                    <?php if(isset($arr_list[$vl->idplay]) && $arr_list[$vl->idplay]!=""){ ?>
                <li><a rel="<?php echo $arr_list[$vl->idplay]; ?>" href="javascript:void(0)"><?php echo $arr_list[$vl->idplay]; ?></a></li>
              <?php } ?>
          <?php }?>
          <div class="clear"></div>
      </ul>
  </div>
  
  <div class="wap_ls">
      <?php foreach ($servers as $key => $vl) { ?> 
      <?php if(isset($arr_list[$vl->idplay]) && $arr_list[$vl->idplay]!=""){ ?>

      <div class="sv-new tb_ct" id="ct_tab_<?php echo $arr_list[$vl->idplay]; ?>" style="">
          <ul>
          <?php
                foreach ($servers as $key => $value) { 
                $is=explode("-",$arr_list[$vl->idplay]);
                  if($value->idplay>=$is[0] && $value->idplay<=$is[1] ){ ?>

                  <li><a <?php if($value->status == 0){if(!is_local()) echo "style='display:none'";} ?> href="<?php echo PATH_URL.'choi-game'.'/'.$value->slug;?>" target="_parent"><?=$value->name?></a></li>
            <?php } }?>
          </ul>
      </div>
      <?php } }?>
</div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
       $('.ls_tab_h li a').click(function(){
        $('.ls_tab_h li a').removeClass('active');
            $(this).addClass('active');
            var rel=$(this).attr('rel');
            $('.tb_ct').hide();
            $('#ct_tab_'+rel).fadeIn(100);
       })
       $('.ls_tab_h li a').first().trigger('click');
    })
</script>

<style type="text/css">
   body{background: none;}
  .server-wrapper{width: 916px;height:560px;float:left;background:url(<?php echo PATH_URL;?>/static/images/index/popsv-head-line.jpg) #0b1415 no-repeat top center;}
  .pop-server-title{background:url(<?php echo PATH_URL;?>/static/images/index/pop-sv-title.png) no-repeat;height:46px;text-indent: 340px;margin:16px 0;}
  .sv-new{float: left; height: auto; padding: 0 60px;}
  .sv-new ul{width: 100%; height: auto;}
  .sv-new ul li{background: url(<?php echo PATH_URL;?>static/images/index/popsv-sv-bg.png);width:207px; height: 40px; float: left; margin: 5px 0 5px 30px;}
  .sv-new ul li:hover{background-position:0 -41px;}
  .sv-new ul li a{color: #ecca82; font-size: 15px;width:100%;height:100%;text-align: center;line-height: 40px;display: block;font-family: tahoma;font-weight: bold;}
  .pop-server-title span{padding:12px 10px 6px;font-family: arial;font-size: 16px;font-weight: bold;text-transform: uppercase;color:#ce9d54;display: block;}

  .sv-new-new{float: left; height: auto; padding: 0 60px 0px;}
  .sv-new-new ul{width: 100%; height: auto;}
  .sv-new-new ul li{background: url(<?php echo PATH_URL;?>static/images/index/pop-svmoi.png);width:207px; height: 49px; float: left; margin: 5px 0 5px 30px;}
  .sv-new-new ul li:last-of-type{background-position:-330px 0;}
  .sv-new-new ul li:last-of-type:hover{background-position:-330px -51px;}
  .sv-new-new ul li:hover{background-position:0 -51px;}
  .sv-new-new ul li a{color: #ecca82; font-size: 15px;width:100%;height:100%;line-height: 49px;display: block;font-family: tahoma;font-weight: bold;text-indent: 52px;}

  .wa-li-t{width:  100%;/*background:#0d0d0d;*/display:  block;float: left;margin: -34px 0 0;}
  .wa-li-t ul{list-style: none;}
  .wa-li-t li a{color:#656565;padding:3px 14px;font-weight: bold;display:block;float:left;font-size:13px;}
  .wa-li-t li a.active{color:#931001;background:#070707;}
</style>
