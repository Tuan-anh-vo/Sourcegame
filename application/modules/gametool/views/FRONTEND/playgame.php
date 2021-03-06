<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta property="og:title" content="<?php echo $title?>"/>
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
    <link rel="stylesheet" type="text/css" href="<?= PATH_URL ?>static/css/frameui.css">
    <link rel="stylesheet" type="text/css" href="<?= PATH_URL ?>static/js/frameui/jquery.bxslider.css">
    <script type="text/javascript" src="<?= PATH_URL ?>static/js/frameui/jquery.bxslider.min.js"></script>
    <script type="text/javascript" src="<?= PATH_URL ?>static/js/frameui/jquery.bxslider.js"></script>
    <script type="text/javascript" src="<?= PATH_URL ?>static/js/frameui.js"></script>
    <title><?php echo $title ?></title>

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

    <style type="text/css">
        #lhc_status_container{
            display: none;
        }
    </style>
</head>

<body>

<div class="server-playgame">
    <iframe id="mainFrame" name="mainFrame" wmode="transparent" height="100%" width="100%" marginwidth="0" marginheight="0"frameborder="0" scrolling="no" src="<?=$url?>"></iframe>
</div>

</body>
</html>