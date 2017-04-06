<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $title;?></title>

<meta property="og:title" content="<?php echo $title?>"/>
<meta property="fb:admins" content="1234" />
<meta property="fb:app_id" content="197368480622157"/>
<meta property="og:description" content="<?php echo $meta_description?>"/>
<meta property="og:image" content="<?php echo PATH_URL;?>static/fb_banner.jpg"/>
<meta property="og:site_name" content="<?php echo $title?>"/>
<meta property="og:locale" content="vi_VN"/>
<meta property="og:url" content="<?php echo PATH_URL;?>">

<meta name="keywords" content="<?php echo $meta_keywords?>">
<meta name="description" content="<?php echo $meta_description?>">
<link rel="shortcut icon" href="<?=PATH_URL?>static/favicon.ico" />
<link rel="icon" href="<?=PATH_URL?>static/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="<?php echo PATH_URL;?>static/account/account.css">
<link rel="stylesheet" type="text/css" href="<?=PATH_URL?>static/fancybox/source/jquery.fancybox.css"/>

<link rel="stylesheet" type="text/css" href="<?=PATH_URL?>static/home/css/hoathiencot.css"/>
<link rel="stylesheet" type="text/css" href="<?=PATH_URL?>static/home/css/owl.carousel.css"/>
<link rel="stylesheet" type="text/css" href="<?=PATH_URL?>static/home/css/style.css"/>
<link rel="stylesheet" type="text/css" href="<?=PATH_URL?>static/css/jquery-ui.css"/>

<script type="text/javascript" src="<?=PATH_URL?>static/js/jquery-1.11.3.min.js"></script>

<?php $username = $this->session->userdata('username');?>
<script>
var url_home = "<?=PATH_URL?>";
var url_src = "<?=PATH_URL?>static/web/";
var root = "<?=PATH_URL?>";

var user_login = "<?php echo $this->session->userdata('username')?>";
var uri = "<?=$this->uri->segment(1)?>";
</script>

<script src="<?=PATH_URL?>static/teaser/js/headjs.js"></script>
<script type="text/javascript" src="<?=PATH_URL?>static/home/js/Rotation-min.js"></script>
<script type="text/javascript" src="<?=PATH_URL?>static/js/wow.min.js"></script>
<script type="text/javascript" src="<?=PATH_URL?>static/js/jquery-ui.js"></script>

<script type="text/javascript">
    isAuthen = 'False';
    typePopup = '';
    paymentStatus = '';
    appPath = '<?=PATH_URL?>';
    status1 = '';
</script>
<script type="text/javascript">
    new WOW().init();
</script>
<script type="text/javascript" src="<?=PATH_URL?>static/home/js/common.js"></script>
<!-- <script type="text/javascript" src="<?=PATH_URL?>static/home/js/utils.js"></script> --> <!-- Tam thoi tat by Tan -->

</head>
<body class="index" style='background:#16151b'>  
    <div id="divHeader">
        <!-- <div class="wrap-header" id='wrap-header-extend'>
            <div class="banner-left_" id="banner-left"><a href="https://dolongky.vtcgame.vn/teaser/?utm_source=teaser&amp;utm_medium=banner_vtcgame&amp;utm_content=1&amp;utm_campaign=NoiBo" target="_blank" style="display: block; opacity: 0.0912868;"><img width="160" height="600" src="https://vtcgame.vn/media/vtcgate/2016/09/27/160x600.png"></a><a href="https://vantrungca.vtcgame.vn/landing06/?utm_source=landing06&amp;utm_medium=banner_vtcgame&amp;utm_content=240616&amp;utm_campaign=NoiBo" target="_blank" style="display: none;"><img width="160" height="600" src="https://vtcgame.vn/media/vtcgate/2016/09/26/160x600.png"></a><a href="https://phidoi2.vtcgame.vn/landing03/?utm_source=landing03&amp;utm_medium=banner_vtcgame&amp;utm_content=1&amp;utm_campaign=NoiBo" target="_blank" style="display: none;"><img width="160" height="600" src="https://vtcgame.vn/media/vtcgate/2016/09/16/160x600pd.png"></a><a href="https://sv.vtcgame.vn/update/?utm_source=update&amp;utm_medium=banner_vtcgame&amp;utm_content=120516&amp;utm_campaign=NoiBo" target="_blank" style="display: none;"><img width="160" height="600" src="https://vtcgame.vn/media/vtcgate/2016/09/14/160x600sv.png"></a><a href="https://as.vtcgame.vn/landing/?utm_source=landing&amp;utm_medium=banner_vtcgame&amp;utm_content=1&amp;utm_campaign=NoiBo" target="_blank" style="display: none;"><img width="160" height="600" src="https://vtcgame.vn/media/vtcgate/2016/09/09/160x600.png"></a><a href="https://phidoi2.vtcgame.vn/?utm_source=homepage&amp;utm_medium=banner_vtcgame&amp;utm_content=1&amp;utm_campaign=NoiBo" target="_blank" style="display: block; opacity: 0.908713;"><img width="160" height="600" src="https://vtcgame.vn/media/vtcgate/2016/08/01/160x600.png"></a></div>
        </div> -->
        <div class="fix-right_">        
            <ul>            
                <!-- <li>   
                    <span class="green"> Download VTC Launcher </span>                
                    <a href="" target="_blank"><img src="<?=PATH_URL?>static/home/images/img-download-fix-right.png"></a>            
                </li>            
                <li> 
                    <span class="purple">Vòng Quay May Mắn</span>                
                    <a href="" target="_blank"><img src="<?=PATH_URL?>static/home/images/img-vongquay-fix-right.png"></a>
                </li>
                <li>
                    <span class="orange">Nhiệm Vụ</span>
                    <a href="" target="_blank"><img src="<?=PATH_URL?>static/home/images/img-nhiemvu-fix-right.png"></a>
                </li>
                <li>
                    <span class="yellow">Ranking</span>
                    <a href="" target="_blank">
                        <img src="<?=PATH_URL?>static/home/images/img-bxh-fix-right.png">
                    </a>
                </li> -->
                <li>
                    <span class="blue">Facebook</span>
                    <a href="https://www.facebook.com/%C4%90%E1%BB%93-Long-Pk-335698360109844/?fref=ts" target="_blank"><img src="<?=PATH_URL?>static/home/images/img-fb-fix-right.png"></a>
                </li>
            </ul>
        </div>
    </div>

    <div id="fb-root"></div>
    <script>
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.5&appId=1629192517345769";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <div id="header">
        <!-- banner section-->

<div class="slider-home">
    <div id="owl-demo" class="owl-carousel">
        <div class="item"><img src="<?=PATH_URL?>static/home/images/1234(2).png"></div>
    </div>
    <div class="label_server">
        <?php if(1){
            $this->load->model('date_server/date_server_model');
            $setting = $this->date_server_model->getSetting();
            $date_sv = strtotime($setting['date_server']);
            echo "Máy chủ ".$setting['name_server']." ra mắt ".date('H',$date_sv)."h ".date('d-m-Y', $date_sv);
        }?>

    </div>
</div>
        <!-- End banner section-->
        <div class="wrapper">
            <!-- menu section -->
            <div class="menu">
                <ul>
                    <li><a href="<?=PATH_URL?>trang-chu"><span></span><i>trang chủ</i></a></li>
                    <li><a href="<?=PATH_URL?>tin-tuc"><span></span><i>tin tức</i></a></li>
                    <li style='margin:0px;'><a href=""><span></span><i>đặc sắc</i></a></li>
                    <li onclick="backToHome();" style="margin:0px;"></li>
                    <li><a href="<?=PATH_URL?>su-kien"><span></span><i>sự kiện</i></a></li>
                    <li><a href=""><span></span><i>tân thủ</i></a></li>
                    <li><a href="https://www.facebook.com/%C4%90%E1%BB%93-Long-Pk-335698360109844/?fref=ts" target="_blank"><span></span><i>fanpage</i></a></li>
                </ul>
            </div>
            <!-- End menu section -->

            <!-- Playnow section -->
            <div id="choi_ngay_box">
                <div class="choi-ngay wow fadeInUp">
                    <a href="javascript:;" class="bt-choingay"></a>
                    <span onclick="PopupCtrl.PlayNow();"></span>
                    <a href="javascript:;" onclick="PopupCtrl.Napthe();" class="nap-the"><em></em><p>Nạp thẻ</p></a>
                    <a href="javascript:;" onclick="PopupCtrl.HomeRegister();" class="dang-ky"><em></em><p>Đăng ký</p></a>
                    <ul class="from-dangnhap">
                        <?php if(!$username){?>
                        <li><input name="login" id="username" type="text" placeholder="Tài khoản" /></li>
                        <li><input name="login" id="password" type="password" placeholder="Mật khẩu" /></li>
                        <li></li>
                        <li>
                            <div id="lblError" class="err_layout"></div>
                        </li>
                        <li><a href="<?=PATH_URL?>quen-mat-khau" target="_blank">Quên mật khẩu</a></li>
                        <li style='display:none'>
                            Đăng nhập bằng :
                            <a href="javascript:;" style="margin-left: 12px;" onclick="LoginAPI.PostRegisterOpenId('facebook');"><img src="<?=PATH_URL?>static/home/images/icon-fa.png" alt=""></a>
                            <a href="javascript:;" onclick="LoginAPI.PostRegisterOpenId('google');"><img src="<?=PATH_URL?>static/home/images/icon-gg.png" alt=""></a>
                        </li>
                        <a class="bt-dangnhap" href="javascript:;" onclick="loginUser('#username', '#password', '', '#lblError','');"><i>Đăng<br>Nhập</i></a>
                        <?php }else{?>
                        <li> Xin chào : &nbsp;&nbsp; <?=$username?> </li>
                        <li>
                            <a href="<?=PATH_URL?>thong-tin-tai-khoan" style="text-decoration:none;"><i>Cập nhật thông tin cá nhân</i></a>
                        </li>
                        <li>
                            <a href="<?=PATH_URL?>doi-mat-khau" style="text-decoration:none;"><i>Đổi mật khẩu</i></a>
                        </li>
                        <li>
                            <a style="text-decoration: none; font-size: 13px;" href="<?=PATH_URL?>thoat">Thoát</a>
                        </li>
                        <?php }?>
                    </ul>
                </div>
            </div>
            <!-- end Playnow section -->

            <!-- slide1 section -->
            
<div class="slide1 wow fadeInUp">
    <?=modules::run('slider')?>
</div>
<!-- End slide1 section -->
<!-- tai game -->
<div id="tai_game_box">
    <div class="tai-game wow fadeInUp">
        <ul>
            <li class="tai"><a href="<?=PATH_URL?>gift-code"><span></span><p>Nhập Giftcode</p></a></li>
            <li class="faq"><a href="javascript:;" onclick="PopupCtrl.PopupTopBXH();"><span></span><p>Top Lực Chiến </p></a></li>
            <li class="vip"><a href=""><span></span><p>VIP</p></a></li>
        </ul>
    </div>
</div>
<!-- End tai game -->
        </div>
    </div>
    <div class="wrapper">
        <!-- left_content section-->
        <div class="left-content">
            <!-- DS server section-->
            <div class="may-chu wow fadeInUp" id="may-chu-id-sty">
                <?php echo modules::run('servers/listServer')?>
            </div>
            <!-- DS server section-->
            <?php if(0){?>
            <!-- video -->
            <div class="video wow fadeInUp">
                <a class="youtube" href="https://www.youtube.com/watch?v=YSEPQztFCJo">
                    <img src="<?=PATH_URL?>static/home/images/bg-video.jpg" alt="">
                </a>

            </div>
            <!-- hotline -->
            <div class="hotline wow fadeInUp"><a href="" target="_blank"><img src="<?=PATH_URL?>static/home/images/bg-hotline.jpg" alt=""></a></div>
            <?php }?>
            <!-- facebook -->
            <div class="facebook wow fadeInUp">
                <div class="fb-page"
                     data-href="https://www.facebook.com/%C4%90%E1%BB%93-Long-Pk-335698360109844/?fref=ts"
                     data-width="250"
                     data-small-header="false"
                     data-adapt-container-width="true"
                     data-hide-cover="false"
                     data-show-facepile="true"
                     data-show-posts="false">
                    <div class="fb-xfbml-parse-ignore">
                        <blockquote cite="https://www.facebook.com/%C4%90%E1%BB%93-Long-Pk-335698360109844/?fref=ts">
                            <a href="https://www.facebook.com/%C4%90%E1%BB%93-Long-Pk-335698360109844/?fref=ts">Đồ Long PK</a>
                        </blockquote>
                    </div>
                </div>

            </div>

        </div>
        <!-- End left_content section-->
        <!-- right_content section-->
        

<div class="right-content">
    <!-- START OF CONTENT -->
    <?=$content?>
    <!-- END OF CONTENT -->
</div>
        <!-- End right_content section-->
        <div id='backtotop'></div>
    </div>
    <!-- footer section-->
<!-- FOOTER -->
<div class="footer-mautoi">
    <div class="footerchung" style='display:none'>
        <div class="infor-left-footer">
            <a href="#" class="logovtc"><img src="<?=PATH_URL?>static/home/images/cg_logo.png"></a>
            <div class="clear"></div>
            <div class="text-left-all aaa">
                <h4>TỔNG CÔNG TY TRUYỀN THÔNG ĐA PHƯƠNG TIỆN (VTC)</h4>
                <h5>CÔNG TY VTC CÔNG NGHỆ VÀ NỘI DUNG SỐ (VTC INTECOM)</h5>
            </div>
        </div>

        <div class="infor-right-footer">
            <div class="text-right-1">

                <table class="table-footer">
                    <tr>
                        <td><p>thông tin liên hệ</p></td>
                    </tr>
                    <tr>
                        <td><a href="#" class="icon-footer icon-phone-footer">1900 1530</a></td>
                    </tr>
                    <tr>
                        <td><a href="#" class="icon-footer icon-fax-footer">04-3636-7728</a></td>
                    </tr>
                    <tr>
                        <td><a href="#" class="icon-footer icon-fb-footer">facebook.com/vtccareplus</a></td>
                    </tr>
                    <tr>
                        <td><a href="#" class="icon-footer icon-hotro-footer">hotro.vtc.vn</a></td>
                    </tr>
                </table>
            </div>

            <div class="text-right-2">
                <div class="text-left-all">
                    <h5>trụ sở hà nội</h5>
                    <p>Tầng 12, Tòa nhà VTC 23 Lạc Trung, Quận Hai Bà Trưng, Hà Nội</p>
                </div>

                <div class="text-left-all">
                    <h5>chi nhánh đà nẵng</h5>
                    <p>158 Lê Đình Dương, Quận Hải Châu, TP. Đà Nẵng</p>
                </div>

                <div class="text-left-all margin-0">
                    <h5>Chi nhánh TP. hồ chí minh </h5>
                    <p>128E Nguyễn Đình Chính, Phường 8, Quận Phú Nhuận, TP. Hồ Chí Minh</p>
                </div>
            </div>

        </div>

    </div>
</div>
<!-- FOOTER -->
    <!-- End footer section-->
    <div style="margin-top: 3333px; display:none;">
        <p hidden>audio hoa thien cot, code hoa thiên cốt, chuyen hoa thien cot, doc truyen hoa thien cot tap 1, doc truyen hoa thien cot tap 2, doc truyen hoa thiên cốt, download phim hoa thien cot, đọc truyện hoa thiên cốt ngoại truyện, giftcode hoa thien cot, h0a thien cot, hanphongtuyet hoa thien cot, hình ảnh hoa thiên cốt, hình hoa thiên cốt, hoa cot thien, hoa tien cot, hoa thien cot, hoa thien cot 1, hoa thien cot 2, hoa thien cot bao nhieu tap, hoa thien cot ebook, hoa thien cot facebook, hoa thien cot full, hoa thien cot kenh14, hoa thien cot tap2, hoa thien cot tiki, hoa thien cot wattpad, hoa thien cot.com, hoa thien cốt, hoa thiet cot, hoa thiên cốt, hoa thiên cốt audio, hoa thiên cốt cosplay, hoa thiên cốt epub, hoa thiên cốt facebook, hoa thiên cốt full, hoa thiên cốt full truyện, hoa thiên cốt manga, hoa thiên cốt ost, hoa thiên cốt prc, hoa thiên cốt tập 1 truyện, hoa thiên cốt tiểu thuyết, hoa thiên cốt tiki, hoa thiên cốt trọn bộ, hoa thiên cốt wattpad, ket thuc cua hoa thien cot, kết truyện hoa thiên cốt, nhac hoa thien cot, nhạc hoa thiên cốt, phim bo trung quoc hoa thien cot, phim hoa thien cot, phim hoa thiên cốt, phim hoa thiên cốt tập cuối, phim thien hoa cot, sách hoa thiên cốt, tai phim hoa thien cot, tan hoa thien cot, tiểu thuyết hoa thiên cốt, tiểu thuyết hoa thiên cốt full, tiểu thuyết hoa thiên cốt tập cuối, thien hoa cot, trailer hoa thien cot, trailer hoa thiên cốt, truyện hoa thien cot, truyện hoa thiên cốt, truyện hoa thiên cốt ngoại truyện, truyện hoa thiên cốt phần cuối, xem fim hoa thien cot, xem phim hoa thien cốt, xem truyện hoa thiên cốt</p>
        <h2>Hoa Thiên Cốt - Webgame kiếm hiệp ngôn tình đầu tiên 2016 tại Việt Nam</h2>
        <h2>Hoa Thiên Cốt là webgame online chuyển thể từ tiểu thuyết kiếm hiệp ngôn tình thành công nhất năm 2015 với các sát chiêu PK xuyên phá hư không cực kỳ đặc sắc</h2>
    </div>

<script type="text/javascript" src="<?=PATH_URL?>static/fancybox/source/jquery.fancybox.js"></script>
<script type="text/javascript" src="<?=PATH_URL?>static/owl-carousel/owl.carousel.js"></script>
<script type="text/javascript" src="<?=PATH_URL?>static/home/js/jshome.js"></script>

<script type="text/javascript" src="<?php echo PATH_URL?>static/js/account.js"></script>
<script type="text/javascript" src="<?php echo PATH_URL?>static/js/giftcode.js"></script>

<?php if($username){?>
    <?php echo $this->load->view('FRONTEND/popup_giftcode');?>
<?php }?>
<!-- banner -->
<?php if(1){echo modules::run('banner');} ?>

<!-- START OF POPUP ACCOUNT -->
<?php echo $this->load->view('FRONTEND/popup/account');?>
<!-- END OF POPUP ACCOUNT -->

<div class="tracking" style="position:absolute;bottom:-100%;">
<?php $this->load->view('FRONTEND/modules/tracking');?>
</div>
</body>
</html> 