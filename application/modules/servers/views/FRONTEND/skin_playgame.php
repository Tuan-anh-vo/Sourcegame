<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta property="og:title" content="<?php echo $title; ?>"/>
    <meta property="og:description" content="<?= META_DESC ?>"/>
    <meta property="og:image" content="<?php echo PATH_URL;?>static/images/sharefacebook/share1.png"/>
    <meta property="og:video" content=""/>
    <meta name="keywords" content="<?= META_KEY ?>"/>
    <meta name="description" content="<?= META_DESC ?>"/>
    <link rel="shortcut icon" href="<?php echo PATH_URL?>favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="<?= PATH_URL ?>static/images/"/>
    <script type="text/javascript" src="<?= PATH_URL . 'static/js/' ?>jquery-1.8.1.min.js"></script>
    <script type="text/javascript" src="<?= PATH_URL . 'static/js/' ?>swfobject.js"></script>
    <link rel="stylesheet" type="text/css" href="<?= PATH_URL ?>static/topbar/topbar.css">
    <link rel="stylesheet" type="text/css" href="<?php echo PATH_URL ?>static/popup_vongquay/popup_vongquay.css">

    <script type="text/javascript" src="<?php echo PATH_URL ?>static/fancybox/source/jquery.fancybox.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo PATH_URL ?>static/fancybox/source/jquery.fancybox.css">
    <script type="text/javascript" src="<?= PATH_URL . 'static/js/' ?>skin_playgame.js"></script>
    <title><?php echo $title; ?></title>
    <script type="text/javascript">
        var root = "<?php echo PATH_URL;?>";
        var user_login = "<?=$this->session->userdata('username')?>";
        var servers_id_active =<?php echo $server->id  ?>;
    </script>
    <style type="text/css">
    .ajax_hit_news{position: absolute;top: 32px;background: #fff;float: left;z-index: 10;width: 100%;text-align: center;padding: 7px;font-weight: bold;font-size: 14px;display: none;}
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".newbie").on('click', function() {
                $.fancybox({
                    href: root+'newbie/loadViewNewBie?servers='+servers_id_active,
                    type: "iframe",
                    width: "700px",
                    height: "500px"
                });
            });
            onoffmess();
            setTimeout(function(){
                $("a").click(function(e){
                    // setConfirmUnload(false);
                });
            }, 1000);
            $("#click_event").fancybox();
            insert_sv_cur(servers_id_active);
            setInterval(function(){
               insert_sv_cur(servers_id_active);
            },200000);

            $('.popupmess').fancybox();
            var server_change = '<?php echo $this->uri->segment(2);?>';
            $("#play-server").change(function( e ){
                e.preventDefault();
                var value = $("#play-server option:selected").val();
                window.location.assign("<?=PATH_URL?>choi-game/" + value);
            });
            $('.button_show_hide').click(function(){
                var hei = $(window).height();
                var wid = $(window).width();
                $('.topbar').toggle();
                $(this).toggleClass('active');
                if( $('.topbar').is(":hidden") ){
                    $('.server-playgame').height(hei);
                    $('.server-playgame').css({'top' : '0px'})
                } else{
                    $('.server-playgame').height(hei - 36);
                    $('.server-playgame').css({'top' : '36px'})
                }
            });
			get_notice();
			 setInterval(function(){
				get_notice();
			},144000);

			setTimeout(function(){
				get_notice();
			},10000);

            $(".icon-4").click(function(){
                $('.show-hide').toggle("slow");
            });
            notive_icon();
            event_icon();
            gift_icon();

            // setTimeout(function(){
            //     giftEveryDay();  
            // },1000);
        });
    // function giftEveryDay() {
    //     $.get(root+'gifteveryday/sendGiftToGame', {username: user_login, server: servers_id_active}, function(data){
    //         if(data == 1) alert('Bạn nhận được quà đăng nhập hàng ngày, chúc bạn chơi game vui vẻ');
    //     });
    // }
	function get_notice(){
        $.get(root + "notification/get_notice", function(data) {
            if(data){
                $( ".main_notice" ).html(data);
				$( ".main_notice" ).find('a').attr('target','_blank');
                $( ".box_notication" ).animate({
                    left: "0%"
                },400);
                setTimeout(function(){
                    $( ".box_notication" ).animate({
                    left: "-100%"
                    },1);
                },15000)
            }else{
                $( ".box_notication" ).animate({
                    left: "-100%"
                },400);
            }
        });
    }

    function hide_notice(){
        $( ".box_notication" ).animate({
            left: "-100%"
        },400);
    }
    function notive_icon(){
            setInterval(function(){
                $('.icon-4').toggleClass('active');
            },1000);
        }
    function event_icon(){
            setInterval(function(){
                $('.top-bar-event').toggleClass('note');
            },1000);
        }
    function gift_icon(){
            setInterval(function(){
                $('.top-bar-gift').toggleClass('note');
            },1000);
        }
    function onoffmess(){
        $.ajax({
            type:"POST",
            dataType: "Text",
            data: "server_id="+<?=$server->id?>,
            url:"<?php echo PATH_URL?>hitnews/ajax_hit_news",
            success:function(html){
                $('.topbar').append(html);
            }
        });
    }

    function load_rotation(sid){
        $.fancybox({
           type:'iframe',
            href:root+'vongquay/index/'+sid,
            beforeShow : function(){
                $(".fancybox-skin").css({"background":"none","webkit-box-shadow":"none","box-shadow":"none"});
            },
            afterShow : function(){
                $(".fancybox-close").css({"background":"none","top": "21px","right": "52px"});
            }
        });
    }

    function show_sharefb(){
        $.fancybox({
            href: root + 'sharefb_log/index',
            type: 'iframe',
            beforeShow: function(){
                $(".fancybox-skin").css("background","none");
                $(".fancybox-skin").css("webkit-box-shadow","none");
                $(".fancybox-skin").css("box-shadow","none");
                this.width  = 600;
                this.height = 300;
            },
            afterShow: function(){
                $(".fancybox-close").css({"top": "-18px","right": "-18px"});
            },
        });
    }
    function show_daptrung(server_id){
        $.fancybox({
            href: root + 'daptrung/index?server_id='+server_id,
            type: 'iframe',
            beforeShow: function(){
                $(".fancybox-skin").css("background","none");
                $(".fancybox-skin").css("webkit-box-shadow","none");
                $(".fancybox-skin").css("box-shadow","none");
                this.width  = 753;
                this.height = 732;
            },
            afterShow: function(){
                $(".fancybox-close").css({"top": "26px","right": "15px","background":"none"});
            },
        });
    }
    </script>
<body style="overflow:hidden;">
<div class="ajax_hit_news" style="display:none"></div>
<div class="box_notication">
	<div onclick="hide_notice()" class="button_notice_hide"></div>
	<div class="main_notice">
	</div>
</div>
<div class="button_show_hide"></div>
<div onclick="hideTop()" style="display:none;" class="overlay">
    <div class="close_layout">Click ra ngoài để vào lại game</div>
</div>
<div class="topbar">
    <div id="skip-content"></div>
    <div class="wap_naothe" id='wrap_napthe' style='display:none'>
        <?php echo modules::run('user/payment') ?>
    </div>
    <div class="wap_event" id='wrap_event' style='display:none'>
        <?php //echo $this->load->view('FRONTEND/popup-event');?>
    </div>
    <div class="wap_modules" id='wrap_modules' style='display:none'>
        <?php // echo $this->load->view('FRONTEND/popup_modules');?>
    </div>
    <div class="wap_item_level_rank"></div>
    <div class="bg-main">
        <div class="main">
            <div class="boxclick">
                <a class="napthe s-napthe btn_napthe_topmenu_2016" href="javascript:;"></a>
                <a class="giftcode" href="javascript:;"></a>
                <?php if(1){ ?>
                    <?php
                        if(1){ echo modules::run('vipshop/box_online',$this->session->userdata('server_id'));?>
                            <a class='btn_xingau btn_vq' onclick='show_vipshop(<?=$this->session->userdata('server_id')?>)' href="javascript:;" style='text-align: center;font-weight: bold;color: #fff;background:#0081FF;padding: 8px 4px;height: 20px;display: block;float: left;line-height:23px;'>VIPSHOP</a>
                        <?php }?>
                        
                    <!-- <a class="btn_xingau btn_vq"  href="javascript:;" onclick="load_rotation()" title="">Vòng quay</a> -->
                <?php } ?>
                <?php if(0){?>
                <blink><a class="btn_xingau btn_vq" id='click_module'  href="javascript:;" title="">Tích Lũy</a></blink>
                <?php }?>
                <?php  $time_start = strtotime('2015-10-18 00:00:00'); if( 0 ) {?>
                <a class="btn_lathinh btn_vq"  href="javascript:;" onclick="show_lathinh(<?=$this->session->userdata('server_id')?>)" title="">Lật bài</a>
                <?php }?>
                <!-- <a href="javascript:;" onclick='show_sharefb()' class='sharefacebook' style='display: block;height: 36px;line-height: 36px;background: #8B0F0F;color: #fff;font-weight: bold;padding: 0 7px;'>Share Game</a> -->
                <?php 
                    // if(time() > strtotime("2015-09-17 12:00:00") && time() < strtotime("2015-09-22 12:00:00")){
                if(0){?>
                    <a style='display: block;height: 36px;line-height: 36px;background: #028443;color: #fff;font-weight: bold;padding: 0 7px;' onclick="show_daptrung(<?=$server->id?>)" class="daptrung" href="javascript:void(0)" >ĐẬP TRỨNG</a>
                <?php }?>

                <?php if(0){?>
                    <a style='display: block;height: 36px;line-height: 36px;background: #028443;color: #fff;font-weight: bold;padding: 0 7px;' onclick="load_rotation(<?=$server->id?>)" class="daptrung" href="javascript:void(0)" >VÒNG QUAY</a>
                <?php }?>
                <?php if(0){?>
                    <a style='display: block;height: 36px;line-height: 36px;background: #027284;color: #fff;font-weight: bold;padding: 0 7px; -webkit-animation: tada 2s ease infinite; animation: tada 2s ease infinite;' class="newbie" href="javascript:void(0)" >NHẬN QUÀ LV</a>
                <?php }?>

            </div>  
            <div class="box_hot_line">
                <a target="_blank" class="icon-1" href="<?= PATH_URL ?>"></a>
                <a target="_blank" class="icon-2" href="https://www.facebook.com/banlongky"></a>
            </div>
            <div class="wap_hover">
                <span class='span-active-server'><?php echo trim(substr($this->uri->segment(2), 0, 16)) ?></span>
                <ul class="change_server">
                <?php foreach ( $servers as $key => $value ) { ?>
                    <li>
                        <a href="<?php echo PATH_URL ?>choi-game/<?php echo $value->slug ?>"><?php echo $value->name ?></a>
                    </li>                        
                <?php } ?>                    
                </ul>
            </div>
            <div class="box_username">
                <div class="wap_fix_us">
                    <span class="text-name">Chào: <?php echo CutText($this->session->userdata("username"), 13); ?></span>
                    <div class="wap_us_f">
                        <div class="avatarpp"></div>
                        <div class="usernamepp"><?php echo CutText($this->session->userdata("username"), 13);?></div>
                        <a href="<?php echo PATH_URL ?>thoat"><div class="logoutpp">Thoát<i></i></div></a>
                        <div class="quanly"><i></i><a target="_blank" href="<?php echo PATH_URL?>thong-tin-tai-khoan">quản lý tài khoản</a></div>
                    </div>
                </div>
                
            </div>
            <div class="box_close"></div>
        </div>
    </div>
</div>
<div class="server-playgame" style="width: 100%; ">
    <!-- PLAY GAME -->
    <?php
    if ( !is_local() ) {
        if ( $server->server_status != 0 ) {
            ?>
            <!-- PLAY GAME -->
            <iframe id="mainFrame" name="mainFrame" wmode="transparent" height="100%" width="100%" marginwidth="0"
                    marginheight="0" frameborder="0" scrolling="no" src="<?=$url?>"></iframe>
        <?php } else { ?>
            <div
                style="width: 100%;height: 100%;background-color: #E5DCDC;padding: 5px;text-align: center;font-weight: bold;">
                Server đang tạm bảo trì, các bạn vui lòng quay lại sau
            </div>
        <?php
        }
    } else {
        // pr($url,1);
        ?>
        <!-- PLAY GAME -->
        <iframe id="mainFrame" name="mainFrame" wmode="transparent" height="100%" width="100%" marginwidth="0"
                marginheight="0" frameborder="0" scrolling="no" src="<?=$url?>"></iframe>
    <?php
    }
    ?>
</div>
<?php echo $this->load->view('FRONTEND/modules/tracking');?>
</body>
</html>
