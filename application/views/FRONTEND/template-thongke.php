<!DOCTYPE html>
<html>
<head>
    <title>Tool Quản Lý Game</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="<?=PATH_URL?>static/css/reset.css" type="text/css" rel="stylesheet" />
    <link href="<?=PATH_URL?>static/css/thongke-style.css" type="text/css" rel="stylesheet" />
    <script language="javascript" type="text/javascript" src="<?=PATH_URL?>static/js/thongke/jquery.js"></script>
    <script language="javascript" type="text/javascript" src="<?=PATH_URL?>static/js/thongke/thongke-script.js"></script>
    <link rel="stylesheet" type="text/css" href="<?=PATH_URL?>static/js/popup/popup-style.min.css">
    <script type="text/javascript" src="<?=PATH_URL?>static/js/jquery-1.11.3.min.js"></script>
    <script src="<?=PATH_URL?>static/js/jquery.popupoverlay.js"></script>
    <script type="text/javascript" src="<?=PATH_URL?>static/js/popup/jquery.bpopup.min.js"></script>
    <link rel="stylesheet" href="<?=PATH_URL.'static/css/admin/'?>styles.css" type="text/css">
    <link href="<?=PATH_URL?>static/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="all" href="<?=PATH_URL?>static/css/daterangepicker-bs3.css" />
    <script type="text/javascript" src="<?=PATH_URL?>static/js/moment.js"></script>
    <script type="text/javascript" src="<?=PATH_URL?>static/js/jquery.price_format.2.0.js"></script>

    <script type="text/javascript" src="<?=PATH_URL?>static/js/daterangepicker.js"></script>
    <script type="text/javascript" src="<?=PATH_URL?>static/js/admin/jquery.tablesorter.js"></script>
</head>
<script type="text/javascript">
    root = "<?=PATH_URL?>";
    $(document).ready(function(){
        $('.knb').priceFormat({prefix: '', centsLimit: 0, thousandsSeparator: '.'});

    });
</script>
<body>
<div id="wraper" align="center">
<div id="container">
<div class="top_title">TOOL QUẢN LÝ GAME</div>
<div class="left-menu-wrap">
    <div class="menu-title-thongke" id="title-thongke"><a href="<?=PATH_URL."gametool"?>">Thống Kê</a></div>
    <ul class="menu-content-list" id="list-thongke">
        <li><a href="<?=site_url("gametool/naptien")?>">Nạp Tiền</a></li> 
        <li><a href="<?=site_url("gametool/themvatpham")?>">Thêm Vật Phẩm</a></li>
        <li><a href="<?=site_url("gametool/useronline")?>">User Online</a></li>
        <li><a href="<?=site_url("gametool/getprofilebyuser")?>">Tài khoản => Nhân vật</a></li>
        <li><a href="<?=site_url("gametool/getprofilebyplayername")?>">Nhân vật => Tài khoản</a></li>
        <li><a href="<?=site_url("gametool/getlevelbyserver")?>">Thông tin Level</a></li>
        <li><a href="<?=site_url("gametool/getnumberclick")?>">Số tài khoản theo server</a></li>
        <li><a href="<?=site_url("gametool/inform_all")?>">Gửi Tin Nhắn Server</a></li>
        <li><a href="<?=site_url("gametool/getreportknb")?>">Thống kê KNB server</a></li>
    </ul>
</div>
<div class="right-content-wrap">
   <?= $content ?>
</div>
<div class="clear"></div>
</div>
</div>

<div id="my_server" class="well" style="display:none; margin:1em; position: relative !important; z-index: 9999 !important; color: #000; background: #fff">
    <a href="#" class="my_modal_close" style="float:right;padding:0 0.4em; position: relative; z-index: 9999;">×</a>
    <h4 style="text-align: center">Thông Báo</h4>
    <div class="content-pop" style="padding: 10px 13px; min-width: 308px; text-align: center;"></div>

    <form>
        <button class="btn btn-alert my_modal_close">Close</button>
    </form>
</div>
</body>
</html>