<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta property="og:title" content="<?php echo $title; ?>"/>
    <meta property="og:description" content="<?php echo META_DESC ?>"/>
    <meta property="og:image" content="<?php echo PATH_URL ?>static/images/front/logo.png"/>
    <meta property="og:video" content=""/>
    <meta name="keywords" content="<?php echo META_KEY ?>"/>
    <meta name="description" content="<?php echo META_DESC ?>"/>
    <link rel="shortcut icon" href="<?=PATH_URL?>static/favicon.ico" />
    <link rel="apple-touch-icon" href="<?php echo PATH_URL ?>static/images/front/logo.png"/>
    <script type="text/javascript" src="<?php echo PATH_URL . 'static/js/' ?>jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="<?php echo PATH_URL . 'static/js/' ?>swfobject.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo PATH_URL ?>static/skin_playgame/css/leftmenu.css">

    <script type="text/javascript" src="<?php echo PATH_URL ?>static/fancybox/source/jquery.fancybox.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo PATH_URL ?>static/fancybox/source/jquery.fancybox.css">
    <script type="text/javascript" src="<?php echo PATH_URL . 'static/js/' ?>skin_playgame_leftbar.js"></script>
    <title><?php echo $title; ?></title>
    <script type="text/javascript">
        var root = "<?php echo PATH_URL; ?>";
        var user_login = "<?php echo $this->session->userdata('username') ?>";
        var servers_id_active =<?php echo $server->id ?>;
    </script>
    <script type="text/javascript">
        $(document).ready(function(){

            $('.btn_popup_thangcap').click(function(){
                $.fancybox({
                    href : '#popup_thangcap',
                    padding : 0,
                    scrolling: false,
                    beforeShow : function(){
                        $('.fancybox-skin').css({'background':'none','box-shadow':'none'});
                    },
                    afterShow : function(){
                        $('.fancybox-close').css({top: '7px',right: '-2px'});
                    }
                });
            })


            $('.popupmess').fancybox();
            var server_change = '<?php echo $this->uri->segment(2); ?>';
            $("#play-server").change(function( e ){
                e.preventDefault();
                var value = $("#play-server option:selected").val();
                window.location.assign("<?php echo PATH_URL ?>choi-game/" + value);
            });

            get_notice();
            setInterval(function(){
                get_notice();
            },300000);

            // setTimeout(function(){
            //     get_notice();
            // },10000)

        });

    function get_notice(){
        $.get(root + "notification/get_notice", function(data) {
            if(data){
                $( ".main_notice" ).html(data);
                $( ".main_notice" ).find('a').attr('target','_blank');
                $( ".box_notication" ).animate({
                    right: "0%"
                },400);
                setTimeout(function(){
                    $( ".box_notication" ).animate({
                    right: "-100%"
                    },1);
                },15000)
            }else{
                $( ".box_notication" ).animate({
                    right: "-100%"
                },400);
            }
        });
    }

    function hide_notice(){
        $( ".box_notication" ).animate({
            right: "-100%"
        },400);
    }

    function load_rotation(){
        $.fancybox.open({
            href:root+'vongquay/index/'+servers_id_active,
            type:'ajax',
            beforeLoad: function(){
                $('body').addClass("background_fancybox");
            },
        });
    }
     
    function sendback(){

        $.ajax({
            type:"POST",
            dataType: "Text",
            data: "server_id="+<?=$server->id?>,
            url:"<?php echo PATH_URL?>servers/sendback",
            success:function(html){
                alert(html);
            }
        });
    }
        
    </script>
<body style="overflow:hidden;">
    <!-- <div id="bglixi" style="display:none; z-index: 1000; width: 100%; height: 100%;"> 
        <?php // echo modules::run('lixi') ?>
    </div> -->
<div class="ajax_hit_news" style="display:none"></div>

<div class="box_notication">
    <div onclick="hide_notice()" class="button_notice_hide"></div>
    <div class="main_notice">
    </div>
</div>


<!-- <div class="button_show_hide"></div> -->
<div onclick="hideTop()" style="display:none;" class="overlay">
    <div class="close_layout">Click ra ngoài để vào lại game</div>
</div>

<div class="close-lb in"></div>

<div id="leftControl" class="left_menu"> 
    <a href="javascript:;" class='btn_expand' title='Click to Expand'> <span> </a>


    <!-- HTC Add -->
    <a href="" target="_blank" >
        <img class="logo-left-menu" src="../static/dolongpk_logo.png" style="width: 215px;">
    </a> 
    <!-- End HTC Add --> 

    <!-- HTC Add -->
    <a href="javascript:;" id='click_module' class="btn-napthe-left-menu" style="margin-bottom: 15px;" target="_blank">
        <img src="../static/skin_playgame/images/btn_quanapthe.jpg" style="margin-left: 10px;margin-top: 5px;">
    </a> 
    <!-- End HTC Add -->



    <!-- HTC Add -->
    <div class="form-user">
        <span><b><i><?=$this->session->userdata('username');?></i></b></span>
        <a href="<?=PATH_URL?>thoat" class="thoat-user" >Thoát</a>
        <br /><br />
        <span>Đang chơi : <?=$server->name?> </span><br />
        
    </div>
    <div class="clear"></div>
    <!-- End HTC Add -->  

    <!-- HTC Add -->
    <div class="ds-maychu">  
        <div class="clear"></div> 

        <select id="selectServer" name="select_server" onchange="location = this.options[this.selectedIndex].value;">
            <option value="0">-- Máy chủ khác --</option>
            <?php foreach ($servers as $key => $value) { ?>
            <option <?php echo ($server->id == $value->id) ? 'selected="true"':'' ?> value="<?php echo PATH_URL ?>choi-game/<?php echo $value->slug ?>"><?php echo $value->name; ?></option>
            <?php }?>
        </select>
    </div>
    <div class="clear"></div>
    <!-- End HTC Add -->


    <!-- HTC Add -->
    <div class="form-btn">
        <a href="<?=PATH_URL?>nap-the" target='_blank' class="btn-napthe-left-menu"><img src="../static/skin_playgame/images/icon1-btn-all.png"><p>nạp thẻ</p></a>
        <ul>
            <li class="clear"><a href="javascript:;" class='btn_popup_thangcap' ><img src="../static/skin_playgame/images/icon2-btn-all.png"><p>Thăng cấp nhận quà</p></a></li>
            <li class="clear"><a href="<?=PATH_URL?>gift-code" target="_blank"><img src="../static/skin_playgame/images/icon-gif.png"><p>Nhận gift code</p></a></li>
            <li class="clear"><a href="<?=PATH_URL?>dac-sac/huong-dan-tan-thu-len-nhanh-lv" target="_blank"><img src="../static/skin_playgame/images/icon3-btn-all.png"><p>HDẫn tăng level</p></a></li>
            <li class="clear"><a href="<?=PATH_URL?>dac-sac/huong-dan-tang-nhanh-luc-chien" target="_blank"><img src="../static/skin_playgame/images/icon4-btn-all.png"><p>HDẫn tăng lực chiến</p></a></li>
            <?php if(is_local()) { ?>
            <li class="clear"><a href="javascript:;" onclick="show_daptrung(<?=$server->id?>)" ><img src="../static/skin_playgame/images/icon4-btn-all.png"><p>Event Đập trứng</p></a></li>
            <?php } ?>
        </ul>
    </div>
    <!-- End HTC Add -->


    <!-- HTC Add --> 
    
    <a href="https://www.facebook.com/%C4%90%E1%BB%93-Long-Pk-335698360109844/?fref=ts" target="_blank">
        <img class="hotline-left-menu" src="../static/skin_playgame/images/img-fanpage.png"> 
    </a>
    <!-- <a href="#" style="padding-left: 5px;" >
        <img src="../static/skin_playgame/images/item-img-1.jpg">
    </a> -->
    <!-- End HTC Add -->

    <!--end:server-->
    
    <!--end_bt-->
</div>



<div class="server-playgame" style="height:100%;float:left;">
    <!-- PLAY GAME -->
    <?php
        if (!is_local()) {
            if ($server->server_status != 0) {?>
            <!-- PLAY GAME -->
            <iframe id="mainFrame" name="mainFrame" wmode="transparent" height="100%" width="100%" marginwidth="0"
                    marginheight="0" frameborder="0" scrolling="no" src="<?php echo $url; ?>"></iframe>
    <?php
        } else { 
    ?>
            <div
                style="width: 100%;height: 100%;background-color: #E5DCDC;padding: 5px;text-align: center;font-weight: bold;">
                Server đang tạm bảo trì, các bạn vui lòng quay lại sau
            </div>
    <?php
        }
    } else {
    ?>
        <!-- PLAY GAME -->
        <iframe id="mainFrame" name="mainFrame" wmode="transparent" height="100%" width="100%" marginwidth="0"
                marginheight="0" frameborder="0" scrolling="no" src="<?php echo $url; ?>"></iframe>
    <?php
    }
    ?>
</div>
<div style='display:none'>
<div id='popup_thangcap'>
    <a href="javascript:;"> <img src="<?=PATH_URL?>static/popup_thangcap.jpg"> </a>
</div>
</div>

<div id='url_service' style='display:none;opacity:0'>
    <iframe src="<?= $url_service ?>"></iframe>
</div>
<div class="tracking" style="position:absolute;bottom:0px">
    <?php $this->load->view('FRONTEND/modules/tracking.php'); ?>
</div>

</body>
</html>
