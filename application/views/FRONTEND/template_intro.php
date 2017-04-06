<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $title;?></title>
<meta property="og:title" content="<?php echo $title?>"/>
<meta property="fb:admins" content="1234" />
<meta property="fb:app_id" content="197368480622157"/>
<meta property="og:description" content="<?php echo $meta_description?>"/>
<meta property="og:image" content="<?php echo PATH_URL;?>static/images/account/hi.png"/>
<meta property="og:site_name" content="<?php echo $title;?>"/>
<meta property="og:locale" content="vi_VN"/>
<meta property="og:url" content="<?php echo PATH_URL;?>"/>
<meta name="keywords" content="<?php echo $meta_keywords?>"/>
<meta name="description" content="<?php echo $meta_description?>"/>
<link rel="shortcut icon" href="<?=PATH_URL?>static/favicon.ico" />
<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'/>
<link rel="icon" href="<?=PATH_URL?>static/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="<?php echo PATH_URL;?>static/account/account.css"/>
<link rel="stylesheet" type="text/css" href="<?=PATH_URL?>static/web/fancybox/jquery.fancybox.css?v=9603" media="screen" />

<link href="<?=PATH_URL?>static/css/reset.css" rel="stylesheet" media="screen" />
<link href="<?=PATH_URL?>static/css/intro.css" rel="stylesheet" media="screen" />

<script type="text/javascript" src="<?=PATH_URL?>static/web/jsCommon/jquery-1.7.2.min.js"></script>
</head>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&appId=197368480622157&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<body class="index">  
  <?php $username = $this->session->userdata('username');?>
  <script>
  var url_home = "<?=PATH_URL?>";
  var url_src = "<?=PATH_URL?>static/web/";
  var root = "<?=PATH_URL?>";

  var user_login = "<?php echo $this->session->userdata('username')?>";
  var uri = "<?=$this->uri->segment(1)?>";
  </script>
<div class="wrapper">
    <div class="container">
        <?php if($this->session->userdata('username')){?>
        <div class="user_logined">
          <p>
          Chào bạn, <font color='#FFD709'> <?=$this->session->userdata('username')?> </font>
          </p>
          <a href="<?=PATH_URL?>thoat">Thoát</a>
        </div>
        <?php }?>
        <a class="link_fb" href="https://www.facebook.com/Ho%C3%A0ng-%C4%90%E1%BB%93-Web-219187541761113/" target='_blank'></a>
        <a class="logo" href='<?=PATH_URL?>'></a>
        <a class="giftcode" href='javascript:;' onclick='popup("giftcode")'></a>
    </div>
</div>


<script type="text/javascript" src="<?=PATH_URL?>static/web/jsCommon/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?=PATH_URL?>static/web/jsCommon/function.js?v=9301"></script>
<script type="text/javascript" src="<?=PATH_URL?>static/web/jsCommon/userClass.js?v=9301"></script>
<script type="text/javascript" src="<?=PATH_URL?>static/web/fancybox/jquery.fancybox.js"></script>
<script type="text/javascript" src="<?=PATH_URL?>static/web/jsCommon/jquery.Xslider.js"></script>
<script type="text/javascript" src="<?=PATH_URL?>static/web/jsCommon/swfobject.js"></script>
<script type="text/javascript" src="<?=PATH_URL?>static/web/jsCommon/jquery.jcarousel.js"></script>


<script src="<?=PATH_URL?>static/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?=PATH_URL?>static/assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
<script src="<?=PATH_URL?>static/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?=PATH_URL?>static/assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>  
<script src="<?=PATH_URL?>static/assets/plugins/jquery.cookie.min.js" type="text/javascript"></script>
<script src="<?=PATH_URL?>static/assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
<script src="<?=PATH_URL?>static/assets/scripts/app.js"></script>

<script type="text/javascript" src="<?php echo PATH_URL?>static/js/jshome.js"></script>
<script type="text/javascript" src="<?php echo PATH_URL?>static/js/account.js"></script>
<script type="text/javascript" src="<?php echo PATH_URL?>static/js/giftcode.js"></script>

<script type="text/javascript" src="http://connect.facebook.net/en_US/all.js"></script>

<script>
  jQuery(document).ready(function() {       
   // initiate layout and plugins
   App.init();
  });
</script>
<!-- Popup giftcode -->
<?php if($username){?>
    <?php echo $this->load->view('FRONTEND/popup_giftcode');?>
<?php }?>
<!-- banner -->
<?php if(0){echo modules::run('banner');} ?>

<!-- Login -->
<div style="display: none;">
  <?php echo $this->load->view('FRONTEND/login');?>
</div>

<?php $this->load->view('FRONTEND/modules/tracking');?>
</body>
</html> 