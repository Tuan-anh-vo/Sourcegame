<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta property="og:title" content="<?php echo $title; ?>"/>
    <meta property="og:description" content="<?= META_DESC ?>"/>
    <meta property="og:image" content="<?= PATH_URL ?>static/images/front/logo.png"/>
    <meta property="og:video" content=""/>
    <meta name="keywords" content="<?= META_KEY ?>"/>
    <meta name="description" content="<?= META_DESC ?>"/>
    <link type="image/x-icon" href="<?= PATH_URL ?>static/images/favicon.ico" rel="shortcut icon"/>
    <link rel="apple-touch-icon" href="<?= PATH_URL ?>static/images/front/logo.png"/>
    <script type="text/javascript" src="<?= PATH_URL . 'static/js/' ?>jquery-1.8.1.min.js"></script>
    <script type="text/javascript" src="<?= PATH_URL . 'static/js/' ?>swfobject.js"></script>
    <link rel="stylesheet" type="text/css" href="<?= PATH_URL ?>static/topbar/topbar.css">

    <script type="text/javascript" src="<?php echo PATH_URL ?>static/fancybox/source/jquery.fancybox.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo PATH_URL ?>static/fancybox/source/jquery.fancybox.css">
    <script type="text/javascript" src="<?= PATH_URL . 'static/js/' ?>skin_playgame.js"></script>
    <title><?php echo $title; ?></title>
    <script type="text/javascript">
        var root = "<?php echo PATH_URL;?>";
        var user_login = "<?=$this->session->userdata('username')?>";
        var servers_id_active =<?php echo $server->id  ?>;
    </script>
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
            })
			
			get_notice();
			 setInterval(function(){
				get_notice();
			},144000);

			setTimeout(function(){
				get_notice();
			},10000)
			
			
			
        });
		
		
		
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
		
		
		
		
		
		
		
		
    </script>
<body style="overflow:hidden;">


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
    <div class="wap_item_level_rank"></div>
    <div class="bg-main">
        <div class="main">
            <div class="boxclick">
                <a class="napthe" onclick="ShowNapThe()" href="javascript:void(0)"></a>
                <a target="_blank" class="giftcode" href="<?php echo PATH_URL?>gift-code" target="_blank"></a>
                <a target="_blank" class="hotevent" href="<?php echo PATH_URL?>su-kien"></a>
            </div>
            <div class="box_hot_line">
                <a target="_blank" class="icon-1" href="<?= PATH_URL ?>"></a>
                <a target="_blank" class="icon-2" href="https://www.facebook.com/kiemtonvn"></a> 
                <a target="_blank" class="icon-3" href="javascript:void(0)"></a> 
            </div>
            <div class="wap_hover">
                <span class='span-active-server'><?php echo trim(substr($this->uri->segment(2), 0, 3)) ?></span>
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
    <script type="text/javascript">
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-46434597-32', 'auto');
  ga('send', 'pageview');
function check_register_convertion(){
  ga('send', 'event', 'Register', 'Source', 'FULL');
  var img = new Image()
  img.src = "http://www.googleadservices.com/pagead/conversion/964179717/imp.gif?label=boYBCNmc4FcQhe7gywM&amp;guid=ON&amp;script=0";
  var fbimg = new Image()
  fbimg.src = "https://www.facebook.com/tr?ev=6019550216927&amp;cd[value]=0.00&amp;cd[currency]=VND&amp;noscript=1";
 }
</script>

</div>
<!-- Google Code for &#272;&atilde; V&agrave;o Ch&#417;i Game Conversion Page -->
<script type="text/javascript">
    /* <![CDATA[ */
    var google_conversion_id = 966222625;
    var google_conversion_language = "en";
    var google_conversion_format = "3";
    var google_conversion_color = "ffffff";
    var google_conversion_label = "09tRCMeoylYQocbdzAM";
    var google_remarketing_only = false;
    /* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
    <div style="display:inline;">
        <img height="1" width="1" style="border-style:none;" alt=""
             src="//www.googleadservices.com/pagead/conversion/966222625/?label=09tRCMeoylYQocbdzAM&amp;guid=ON&amp;script=0"/>
    </div>
</noscript>
</body>
</html>
