<!DOCTYPE html>

<html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta property="og:title" content="<?=$title?>"/>

    <meta property="og:description" content="<?= META_DESC ?>"/>

    <meta property="og:image" content="<?= PATH_URL ?>static/images/front/logo.png"/>

    <meta property="og:video" content=""/>

    <meta name="keywords" content="<?= META_KEY ?>"/>

    <meta name="description" content="<?= META_DESC ?>"/>

    <link type="image/x-icon" href="<?= PATH_URL ?>static/images/favicon.ico" rel="shortcut icon"/>

    <link rel="apple-touch-icon" href="<?= PATH_URL ?>static/images/front/logo.png"/>

    <!-- <link href="http://localhost/payment/static/css/sidebar.css" type="text/css" rel="stylesheet"> -->

    <script type="text/javascript" src="<?= PATH_URL . 'static/js/' ?>jquery-1.8.1.min.js"></script>

    <script type="text/javascript" src="<?= PATH_URL . 'static/js/' ?>swfobject.js"></script>

    <!--<script src="<?= PATH_URL.'static/js/'?>toggle.js" type="text/javascript"language="javascript"></script>-->

    <script src="<?= PATH_URL.'static/js/'?>toggle.js" type="text/javascript"language="javascript"></script>

    <link rel="stylesheet" type="text/css" href="<?= PATH_URL ?>static/css/css_menu_left/fgame-bar.css">

    <link rel="stylesheet" type="text/css" href="<?= PATH_URL ?>static/css/css_menu_left/reset.css">

    <link rel="stylesheet" type="text/css" href="<?= PATH_URL ?>static/css/css_menu_left/frame.css">

    <link rel="stylesheet" type="text/css" href="<?= PATH_URL ?>static/css/css_menu_left/jquery_notification.css">

    <!-- <link rel="stylesheet" type="text/css" href="<?= PATH_URL ?>static/css/frameui.css">

    <link rel="stylesheet" type="text/css" href="<?= PATH_URL ?>static/js/frameui/jquery.bxslider.css">

   <script type="text/javascript" src="<?= PATH_URL ?>static/js/frameui/jquery.bxslider.min.js"></script>

    <script type="text/javascript" src="<?= PATH_URL ?>static/js/frameui/jquery.bxslider.js"></script>-->

    <script type="text/javascript" src="<?= PATH_URL ?>static/js/frameui.js"></script>

    <script type="text/javascript" src="<?= PATH_URL ?>static/js/jquery_notification_v.1.js"></script>



    <title><?= $title ?></title>



    <style>

        * {

           margin: 0

        }

        body, html {

            width: 100%;

            height: 100%;

            overflow: hidden;

       }

    </style>

    <script type="text/javascript">

    root = "<?=PATH_URL?>";



    $(document).ready(function(){
        setTimeout(function(){
            $('.button_top_p').trigger('click');  
        },300000)
        $('.server-playgame').width($(window).width()-205);
    });

     $(document).ready(function(){
        $(".support").click(function(e){
            e.preventDefault();
            $("#lhc_status_container").show();
        });



      

       $(".choose-server").change(function(e){
            e.preventDefault();
            var value =$( ".choose-server option:selected" ).val();
            window.location.assign("<?=PATH_URL?>choi-game/"+value);
        });
        });



     function toggle_bar_top(){

       $('.fgame-bar').toggle(400);

     }   


    function callNotice(){
        var server_id=<?php echo $serverid ?>;
        $.ajax({

            type: "GET",

            dataType : 'json',

            url: root+'servers/thongbaogameInterval/'+server_id,

                success: function (msg) {

                    if (typeof msg.title != 'undefined'){

                        if (typeof msg.content != 'undefined')

                        showNotification({

                            message: "",

                            title: msg.title,

                            link_notification : msg.link, 

                            description : msg.content,  

                            type: "success", // type of notification is error/success/warning/information,

                            autoClose: true, // auto close to true

                            duration: 1500 // message display duration

                        });

                    }   

                }

            

        });

    }

    setTimeout(function(){
        joingame();
     },6000); 

     function joingame(){
         $.ajax({
                url: root+'log_joingame/joingame',
                type: 'POST',
                data:'server=<?php echo $serverid ?>',
                error: function (){
                }
            });
     }   

    //callNotice();

    var myVar = setInterval(function(){

        callNotice()

    },300000);



 

    </script>

    <style type="text/css">

        #lhc_status_container{

            display: none;

        }

    </style>

</head>



<body>

<?php

if(isset($thongbao))

{

    if($thongbao->status == 1) 

    {

?>

<div class="tr_togg"></div>

<a href="javascript:void(0)" onclick="toggle_bar_top()" class="button_top_p"></a> 

<div class="fgame-bar">

    <div class="container-bar">

        <marquee behavior="scroll" direction="left" style="margin-top:5px"><b>

            <img src="<?php echo PATH_URL ?>static/images/leftmenu/new_sv.gif" width="23px">

            <?php echo $thongbao->content?> 

             <img src="<?php echo PATH_URL ?>static/images/leftmenu/new_sv.gif" width="23px">

        </marquee>

    </div>

</div>



<?php

    }

    }

?>



      



<div class="server-playgame">

    <iframe id="mainFrame" name="mainFrame" wmode="transparent" height="100%" width="100%" marginwidth="0" marginheight="0"frameborder="0" scrolling="no" src="<?=$url?>"></iframe>

</div>

<style type="text/css">
    .server-playgame, #linkgame{
        width: 100%;
        height: 100%;
    }
</style>

<?php $this->load->view('FRONTEND/modules/tracking');?>

</body>

</html>