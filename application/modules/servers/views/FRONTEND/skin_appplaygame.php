<!DOCTYPE html>
<?php define('FACEPATH', "https://duhiepky.cuahd.com/"); ?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta property="og:title" content="<?php echo $title; ?>"/>
    <meta property="og:description" content="<?= META_DESC ?>"/>
    <meta property="og:image" content="<?= FACEPATH ?>static/images/front/logo.png"/>
    <meta property="og:video" content=""/>
    <meta name="keywords" content="<?= META_KEY ?>"/>
    <meta name="description" content="<?= META_DESC ?>"/>
    <link type="image/x-icon" href="<?= FACEPATH ?>static/images/favicon.ico" rel="shortcut icon"/>
    <link rel="apple-touch-icon" href="<?= FACEPATH ?>static/images/front/logo.png"/>
    <script type="text/javascript" src="<?= FACEPATH . 'static/js/' ?>jquery-1.8.1.min.js"></script>
    <script type="text/javascript" src="<?= FACEPATH . 'static/js/' ?>swfobject.js"></script>
    <link rel="stylesheet" type="text/css" href="<?= FACEPATH ?>static/topbar/topbar.css">

    <script type="text/javascript" src="<?php echo FACEPATH ?>static/fancybox/source/jquery.fancybox.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo FACEPATH ?>static/fancybox/source/jquery.fancybox.css">
    <script type="text/javascript" src="<?= FACEPATH . 'static/js/' ?>skin_playgame.js"></script>
    <title><?php echo $title; ?></title>
    <script type="text/javascript">
        var root = "<?php echo FACEPATH;?>";
        var user_login = "<?=$this->session->userdata('username')?>";
        var servers_id_active =<?php echo $server->id  ?>;
    </script>
    <style type="text/css">
            .ajax_hit_news{
            position: absolute;
            top: 41px;
            background: #fff;
            /*height: 20px;*/
            float: left;
            z-index: 10;
            width: 100%;
            text-align: center;
            padding-top: 7px;
            font-weight: bold;
            font-size: 14px;
            display: none;
            }

    </style>
    <script type="text/javascript">
        $(document).ready(function(){

            insert_sv_cur(servers_id_active);    
            setInterval(function(){
               insert_sv_cur(servers_id_active);      
            },200000);     

            $('.popupmess').fancybox();
            var server_change = '<?php echo $this->uri->segment(2);?>';
            $("#play-server").change(function( e ){
                e.preventDefault();
                var value = $("#play-server option:selected").val();
                window.location.assign("<?=FACEPATH?>choi-game/" + value);
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
            })
            $(".icon-3").click(function(e){
                $(".ajax_hit_news").html("");
                onoffmess();
                
            })
			$(".ajax_hit_news").hide();
			get_notice();
			 setInterval(function(){
				get_notice();
			},144000);

			setTimeout(function(){
				get_notice();
			},10000)

            setTimeout(function(){
                ajax_hit_news();
            },20000)
            
			

    
			ajax_hit_news();
			
        });

    function ajax_hit_news(){
      $(".ajax_hit_news").hide();
           $.ajax({
                type:"POST",
                dataType: "Text",
                data: "server_id="+<?=$server->id?>,
                url:"<?php echo FACEPATH?>hitnews/ajax_hit_news",
                success:function(html){
                    $(".ajax_hit_news").hide();
                     if(html == 0){
                            $(".ajax_hit_news").hide();
                            $('.box_hot_line .icon-3').removeClass('active');
                            notive_icon();                                
                        }else{
                            $(".ajax_hit_news").html(html);
                            // $(".ajax_hit_news").show();
                            notive_icon();
                        }
                }
            });
}
		
	function notive_icon(){
            setInterval(function(){
                $('.box_hot_line .icon-3').toggleClass('active');
            },1000);
        }    
    function onoffmess(){
        if($(".ajax_hit_news").css("display") == "block"){
            $(".ajax_hit_news").hide();
        }else{
            $.ajax({
                type:"POST",
                dataType: "Text",
                data: "server_id="+<?=$server->id?>,
                url:"<?php echo FACEPATH?>hitnews/ajax_hit_news",
                success:function(html){
                    $(".ajax_hit_news").hide();
                     if(html == 0){
                            $(".ajax_hit_news").hide();
                            $('.box_hot_line .icon-3').removeClass('active');
                            notive_icon();                                
                        }else{
                            $(".ajax_hit_news").html(html);
                            $(".ajax_hit_news").show();
                            $('.box_hot_line .icon-3').addClass('no-active');
                        }
                }
            });
        }
    } 		
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
		
		
		
	function send_denbu(){
        $('.send_denbu').removeAttr('onclick');    
        $.get(root + "home/updateknb?username=<?php echo $this->session->userdata('username'); ?>", function(data) {
            if(data){
              alert(data);
              $('.send_denbu').remove(); 
            }
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
    <div class="wap_naothe">            
        <?php echo modules::run('user/payment') ?>        
    </div>
    <div class="wap_suutam" style="overflow:hidden">
            <?php if(1) echo modules::run('suutam/index', $this->uri->segment(2));?>
    </div>
    <div class="wap_item_level_rank"></div>
    <div class="bg-main">
        <div class="main">
               
            <div class="boxclick">
                <a class="bt-trangchu" target="_blank" href="<?=FACEPATH?>"></a>
                <a class="napthe" onclick="ShowNapThe()" href="javascript:void(0)"></a>
                <a target="_blank" class="giftcode" href="<?php echo FACEPATH?>gift-code" target="_blank"></a>
                <a target="_blank" class="quatang" href="<?php echo FACEPATH?>su-kien"></a>
              
                <!-- <a class="send_denbu" onclick="send_denbu()" >Đền bù</a> -->
           
            </div>
            <div class="box_hot_line">
                <a target="_blank" class="icon-2" href="https://www.facebook.com/DuHiepKyOnline"></a> 
                <a target="_blank" class="icon-3" href="javascript:void(0)"></a> 
            </div>
            <div class="wap_hover">
                <span class='span-active-server'><?php echo trim(substr($this->uri->segment(2), 0, 3)) ?></span>
                <ul class="change_server">
                <?php foreach ( $servers as $key => $value ) { ?>
                    <li>
                        <a href="<?php echo FACEPATH ?>choi-game/<?php echo $value->slug ?>"><?php echo $value->name ?></a>
                    </li>                        
                <?php } ?>                    
                </ul>
            </div>
            <?php if(1){?>
                <a onclick="show_suutam();" class="suutam" href="javascript:void(0)" >EVENT LINH NGỌC</a>
            <?php }?>
            <div class="box_username">
                <div class="wap_fix_us">
                    <span class="text-name">Chào: <?php echo CutText($this->session->userdata("username"), 13); ?></span>
                    <div class="wap_us_f">
                        <div class="avatarpp"></div>
                        <div class="usernamepp"><?php echo CutText($this->session->userdata("username"), 13);?></div>
                        <a href="<?php echo FACEPATH ?>thoat"><div class="logoutpp">Thoát<i></i></div></a>
                        <div class="quanly"><i></i><a target="_blank" href="<?php echo FACEPATH?>thong-tin-tai-khoan">quản lý tài khoản</a></div>
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
                    marginheight="0" frameborder="0" scrolling="no" src="<?= $url ?>"></iframe>
        <?php } else { ?>
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
                marginheight="0" frameborder="0" scrolling="no" src="<?= $url ?>"></iframe>
    <?php
    }
    ?>
</div>
<div class="tracking" style="position:absolute;bottom:0px">
    <?php $this->load->view('FRONTEND/modules/tracking.php'); ?>
</div>

</body>
</html>
