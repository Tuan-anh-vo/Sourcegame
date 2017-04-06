<link rel="stylesheet" type="text/css" href="<?=PATH_URL?>static/css/detail.css">
<script src="<?=PATH_URL?>static/js/script.js"></script>
<div class="pop-server-wrapper">
  <!-- <div class="pop-server-title">Danh sách máy chủ</div> -->
  
  <div class="pop-server-title"><span>Máy chủ mới</span></div>
  <div class="leftleft">
    <?php if (!empty($servers))
    $sv_new = array_slice($servers,0,2);
        if(!empty($sv_new)) foreach ($sv_new as $key => $vl){ ?>
    <a onclick="insert_sv_cur(<?=$vl->id?>,'<?=$vl->slug?>','<?=$vl->name?>')" href="<?php echo PATH_URL.'choi-game'.'/'.$vl->slug;?>" class="sv<?=$key+1?>" target="_parent">
      <span class="imgsv<?=$key+1?>"></span>
      <span class="namesv"><?=$vl->name?></span>
      <span class="timesv">Ra mắt <?=date('H',strtotime($vl->playtime)).'h'?> - <?=date('d.m.Y', strtotime($vl->playtime))?></span>
    </a>
    <?php }?>
  </div>
  <div class="pop-server-title"><span>Tất cả máy chủ</span></div>
  <div class="leftleft" style="height:236px;">

    <?php
        if (!empty($servers))
            foreach ($servers as $key => $vl) {
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

      <a <?php if($vl->status == 0){if(!is_local()) echo "style='display:none'";} ?> onclick="insert_sv_cur(<?=$vl->id?>,'<?=$vl->slug?>','<?=$vl->name?>')" href="<?php echo PATH_URL.'choi-game'.'/'.$vl->slug;?>" target="_parent">
        <div class="sver">
          <p class="datesver"><?=date('d/m',strtotime($vl->playtime))?></p>
          <p class="sttsver"><?php if($vl->status == 0){echo 'Ẩn';}else{echo $text;}?></p>
          <p class="namesver"><?=$vl->name?></p>
        </div>
      </a>
      <?php }?>

  </div>
</div>
<style type="text/css">
   body{background: none;}
  .pop-server-wrapper{width: 700px;height:560px;float:left;background:#1d1d1d;}
  .pop-server-title:first-of-type{margin-top: 0;}
  .pop-server-title{text-align: center;height: 30px;border-bottom: 1px solid #8620DD;width: 100%;float: left;margin: 14px 0 14px;}
  .pop-server-title span{padding:8px 10px 6px;font-family: arial;font-size: 16px;font-weight: bold;background: #AE4FFF;text-transform: uppercase;float: left;color:#fff;min-width: 200px;}
  .pop-server-content{padding: 20px 0;float: left;}
  .pop-server-content ul{}
  .pop-server-content ul li{float: left;margin: 0 20px}
  .pop-server-content ul li a{color: #fff;font-family: arial; font-size: 13px;font-weight: normal;width: 182px;background:url(static/images/index/bt-popserver.png) no-repeat;display: block;float: left;height: 33px;}
  .pop-server-content ul li a:hover{background-position:0 -35px;}
  .sv1 .namesv, .sv2 .namesv{margin: 12px 0 0 0;}
  .datesver,.sttsver,.namesver{margin: 0}
  .sttsver{width:60px;;float: left;margin: -2px 0 0 0;}
  .namesver{margin: -10px 30px 0 0px;float: right;}
</style>

<script type="text/javascript">
function insert_sv_cur(sid,slug,sname){
    $.post(
        root + 'servers/set_ser_cur',
            {
                sid: sid,
                slug : slug,
                sname : sname
            },
            function (result) {
                if (result) {
                    alert(result);
                }
            },'JSON'
    );
}
</script>