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
<div class="wrapper_popup">
    <div class="ct_popup">
        <?php if(!empty($servers_cur)){ ?>
            <div class="sv_playing">
                <ul>
                    <?php foreach ($servers_cur as $ky => $va) {?>
                        <li><a href="<?php echo PATH_URL.'choi-game'.'/'.$va->slug;?>"><?php echo $va->sname; ?></a></li>
                    <?php }?>
                </ul>
            </div>
        <?php }?>
        <?php 
        if(!empty($servers)) $sv_new = array_slice($servers,0,2);
        if(!empty($sv_new)){ ?>
            <div class="new_sv">
                <ul>
                    <?php foreach ($sv_new as $key => $vl){?>
                        <li>
                            <a href="<?php echo PATH_URL.'choi-game'.'/'.$vl->slug;?>" target="_blank">
                                <?=$vl->name?>
                            </a>
                        </li>
                    <?php }?>
                </ul>
                <div class="clear"></div>
            </div>
        <?php }?>

        <?php if (!empty($servers)){ ?>
            <div class="sv_pager_pop">
                <ul class="sv_pop_menu">
                    <?php foreach ($servers as $key => $vl) { ?>
                        <?php if(isset($arr_list[$vl->idplay]) && $arr_list[$vl->idplay]!=""){ ?>
                            <li class="m<?php echo $key;?>"><a <?php if($key == 0) echo 'class="active"';?> data-link="<?php echo $key+1;?>" href="javascript:void(0)"><?php echo $arr_list[$vl->idplay]; ?></a></li>
                        <?php } ?>
                    <?php }?>
                </ul>
                <?php foreach ($servers as $key => $vl) { 
                    if(isset($arr_list[$vl->idplay]) && $arr_list[$vl->idplay]!=""){ ?>
                        <ul class="tab tabshow<?php echo $key+1;?>" id="tab<?php echo $key+1;?>">
                            <?php foreach ($servers as $key => $value) {
                                $is=explode("-",$arr_list[$vl->idplay]);
                                if($value->idplay>=$is[0] && $value->idplay<=$is[1] ){
                                    ?>
                                    <li><a href="<?php echo PATH_URL.'choi-game'.'/'.$value->slug;?>"><?php echo $value->name; ?></a></li>
                            <?php } } ?>
                        </ul>
                <?php } } ?>
                <div class="clear"></div>
            </div>
        <?php }?>
    </div>
</div>
<style type="text/css">
    p,a,span{font-family: Tahoma;text-decoration: none}
    .clear{clear: both}
    .wrapper_popup{width: 100%;height: auto;}
    .ct_popup{width: 956px;margin: 0px auto; background: #262535; position: relative; z-index: 700;padding:15px 0px;}
    .ct_popup .new_sv{margin: 20px 0px 0px 0px;background: url(<?php echo PATH_URL;?>static/images/popup/sv_moi.png)no-repeat;padding-top: 30px;clear: both;}
    .ct_popup .new_sv ul{clear:both;margin: 30px 0px 50px 170px;width: 710px;min-height: 50px;}
    .ct_popup .new_sv ul li{float: left;background: url(<?php echo PATH_URL;?>static/images/popup/p_sv.png)no-repeat right bottom;width: 229px;height: 49px; line-height: 49px; text-align: center;}
    .ct_popup .new_sv ul li:first-child{margin-right: 120px;}
    .ct_popup .new_sv ul li a{color: #f9a945;font-weight: bold;font-size: 18px;font-family: Arial;text-transform: uppercase;line-height: 25px; display: block; height: 100%; width: 100%; line-height: 49px;}
    .ct_popup .new_sv ul li a p{color: #727272;font-size: 13px;}
    .ct_popup .new_sv ul li a:hover span{background: #DA312B;}
    .ct_popup .new_sv ul li a:hover h3{color: #F9D545;}
    .ct_popup .new_sv ul li a:hover p{color: #CACACA;}
    .ct_popup .sv_playing {margin-bottom: 20px;}
    .ct_popup .sv_playing  ul{background: url(<?php echo PATH_URL;?>static/images/popup/sv_dangchoi.png)no-repeat 0px 30px;padding-top: 75px;clear: both;}
    .ct_popup .sv_playing  ul li{margin: 14px 0px 0px 14px;display: inline-block;vertical-align: top;zoom: 1; /* Fix for IE7 */*display: inline; /* Fix for IE7 */}
    .ct_popup .sv_playing  ul li a{display: block;width: 218px;height: 43px;background: url(../static/images/popup/p-sv-suong.png)no-repeat;line-height: 43px;text-indent: 30px;text-transform: uppercase;color: #f9a945;font-weight: bold;font-size: 15px; opacity: 0.9}
    .ct_popup .sv_playing  ul li a:hover{ opacity: 1}
    .ct_popup .sv_pager_pop{width: 100%;background: url(<?php echo PATH_URL;?>static/images/popup/sv_ds.png)no-repeat 0px 0px;padding-top:60px;}
    .ct_popup .sv_pager_pop  ul.tab li{margin: 14px 0px 0px 14px;display: inline-block;vertical-align: top;zoom: 1; /* Fix for IE7 */*display: inline; /* Fix for IE7 */}
    .ct_popup .sv_pager_pop  ul.tab li a{display: block;width: 218px;height: 43px;background: url(../static/images/popup/p_sv.png)no-repeat;line-height: 43px;text-indent: 30px;text-transform: uppercase;color: #f9a945;font-weight: bold;font-size: 15px;}
    .ct_popup .sv_pager_pop  ul.tab li a:hover{background-position: 0px -43px;}
    .ct_popup .sv_pager_pop  ul.sv_pop_menu{width:927px; height: 36px;margin-left: 13px;margin-bottom: 10px;position: relative;}
    .ct_popup .sv_pager_pop  ul.sv_pop_menu li{float:left;}
    .ct_popup .sv_pager_pop  ul.sv_pop_menu li a{line-height: 36px;text-align: center;display: block;height: 36px;width:150px;font-size: 18px;color: #656565;background: url(../images/detail/p_li.png)no-repeat;}
    .ct_popup .sv_pager_pop  ul.sv_pop_menu li a:hover,.ct_popup .sv_pager_pop  ul.sv_pop_menu li a.active{background: url(../static/images/popup/p_li_hv.png)no-repeat;color: #ecca82}
    .ct_popup .sv_pager_pop  ul.sv_pop_menu li:first-child a{line-height: 36px;text-align: center;display: block;height: 36px;width:128px;font-size: 18px;color: #656565;}
    .ct_popup .sv_pager_pop  ul.sv_pop_menu li:first-child a:hover,.ct_popup .sv_pager_pop  ul.sv_pop_menu li:first-child a.active{background: url(../static/images/popup/p_li1_hv.png)no-repeat;color: #ecca82}
    .ct_popup .sv_pager_pop  ul.sv_pop_menu li.m1{left:95px; }
    .ct_popup .sv_pager_pop  ul.sv_pop_menu li.m2{left:211px; }
    .ct_popup .sv_pager_pop  ul.sv_pop_menu li.m3{left:327px; }
</style>

<script>
    $(document).ready(function(){
        $('.sv_pop_menu li').click(function(){
            $(this).children().addClass('active').parent().siblings().children().removeClass('active');
            $('.tab').hide();
            var id = $.trim($(this).children().data('link'));
            $('.tabshow'+id).show();
        });
    });
</script>