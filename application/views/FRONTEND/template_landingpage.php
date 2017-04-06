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
<script type="text/javascript" src="<?=PATH_URL?>static/js/jquery-1.11.3.min.js"></script>

<?php $username = $this->session->userdata('username');?>
<script>
  var root = "<?=PATH_URL?>";
  var user_login = "<?php echo $this->session->userdata('username')?>";
  var uri = "<?=$this->uri->segment(1)?>";

  var appPath = root + 'teaser/';
  var accountId = '0';
</script>

<script src="<?=PATH_URL?>static/teaser/js/headjs.js"></script>
<script src="<?=PATH_URL?>static/teaser/js/jsConfig.js"></script>
<script src="<?=PATH_URL?>static/js/wow.min.js"></script>
<link rel="stylesheet" href="<?=PATH_URL?>static/teaser/css/jquery.mCustomScrollbar.css">
<link rel="stylesheet" href="<?=PATH_URL?>static/teaser/css/animate.css">
<link rel="stylesheet" href="<?=PATH_URL?>static/teaser/css/normalize.css">
<link rel="stylesheet" href="<?=PATH_URL?>static/teaser/style.css">
<link rel="stylesheet" href="<?=PATH_URL?>static/fancybox/source/jquery.fancybox.css">

<script src="<?=PATH_URL?>static/teaser/js/Popup.js"></script>
</head>
<body>

    <div id="LogAndReg"></div>
    <div id="side_nav">
    <a href="javascript:void(0);" class="arrow1"></a>
    <a href="javascript:void(0);" class="arrow2"></a>
    <ul>
        <li data-scroll-nav="0"><a href="#spage1"></a></li>
        <!-- <li data-scroll-nav="1"><a href="#spage2"></a></li> -->
        <li data-scroll-nav="2"><a href="#spage3"></a></li>
        <li data-scroll-nav="3"><a href="#spage4"></a></li>
        <li data-scroll-nav="4"><a href="#spage5"></a></li>
        <li data-scroll-nav="5"><a href="#spage6"></a></li>
    </ul>
    <a href="javascript:void(0);" class="arrow2"></a>
    <span class="con_chuot"><img src="<?=PATH_URL?>static/teaser/images/img_chuot.png" alt=""></span>
</div>

<div class="fixed-logo" style="z-index:1000;">
    <img src="<?=PATH_URL?>static/dolongpk_logo.png" alt="">
</div> <!-- end fixed-logo -->

<div id="spage1" data-scroll-index="0">
    <div class="btn-page1">
        <ul class="wow animated fadeIn" data-wow-delay="2.5s">
            <li class='zoomIn'><a href="javascript:;" onclick='<?php if(!$username) echo "PopupCtrl.PopupLogin();" ;else echo "PopupCtrl.PopupOpen();"; ?>' title='Vào game'><img src="<?=PATH_URL?>static/teaser/images/btn-page9.png" alt=""></a></li>
            <li><a href="#spage3"><img src="<?=PATH_URL?>static/teaser/images/btn-page1.png" alt=""></a></li>
            <li><a href="#spage4"><img src="<?=PATH_URL?>static/teaser/images/btn-page2.png" alt=""></a></li>
            <!-- <li><a href="#spage2"><img src="<?=PATH_URL?>static/teaser/images/btn-page3.png" alt=""></a></li> -->
            <li><a href="#spage5"><img src="<?=PATH_URL?>static/teaser/images/btn-page4.png" alt=""></a></li>
        </ul>
        <div class="btn-play-sl1" style='display:none'>
            <div class="wow animated fadeIn" data-wow-delay="2.7s">
                <a href="javascript:;" onclick="PopupCtrl.PopupVideo()">
                    <img src="<?=PATH_URL?>static/teaser/images/btn-play1.png" alt="">
                    <img src="<?=PATH_URL?>static/teaser/images/btn-play2.png" alt="">
                </a>
            </div>
        </div> <!-- end btn-play-sl1 -->
    </div>
    <iframe class="test" src="<?=PATH_URL?>static/teaser/iframe1/trang1.html" align="middle" scrolling="no" width="100%" height="900px" style="overflow:hidden" frameborder="0"></iframe>
</div>

<?php if(0){?>
<div id="spage2" data-scroll-index="1" class="select select-2">
    <div class="wrapper">
        <div class="content-sl-2">
            <div class="tt-sl">
                <img src="<?=PATH_URL?>static/teaser/images/tt-sl2.png" alt="">
            </div> <!-- end tt-sl -->
            <div class="mora">
                <img class="wow animated" src="<?=PATH_URL?>static/teaser/images/que-1.png" alt="">
                <img class="wow animated" src="<?=PATH_URL?>static/teaser/images/que-1.png" alt="">
            </div>
            <div class="bao-contain-table wow animated">
                <div class="bao-contain-table-2">
                    <div class="contain-table">
                        <div class="bao-table">
                            <div class="table-tt">
                                <a href="javascript:;" id="btnPrev"><img src="<?=PATH_URL?>static/teaser/images/btn-left-table.png" alt=""></a>
                                <div id="monthandyear" style="position:absolute; left: 26.65%;; top: 10%;"></div>
                                <a href="javascript:;" id="btnNext"><img src="<?=PATH_URL?>static/teaser/images/btn-left-table.png" alt="" style="transform: rotate(180deg);"></a>
                            </div>
                            <div id="divcalendartable">
                            </div>
                        </div>
                        <div class="vinhdanh">
                            <div class="tt-vinhdanh">Bảng Vinh Danh</div>
                                <div class="content-vinhdanh mCustomScrollbar">
        <ul>
                <li><a href="">robotihon</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 10:40 28-09-2016</li>
                <li><a href="">robotihon</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 10:40 28-09-2016</li>
                <li><a href="">robotihon</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 10:40 28-09-2016</li>
                <li><a href="">bmtacelol123</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 10:40 28-09-2016</li>
                <li><a href="">nhoctai1710</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 10:40 28-09-2016</li>
                <li><a href="">khoanhkhacviet</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 10:40 28-09-2016</li>
                <li><a href="">khoanhkhacviet</a> đã nhận được <a href="">Thẻ vcoin mệnh gi&#225; 10.000 VNĐ </a>lúc 10:40 28-09-2016</li>
                <li><a href="">khoanhkhacviet</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 10:40 28-09-2016</li>
                <li><a href="">kiemmavotinh01</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 10:24 28-09-2016</li>
                <li><a href="">renodl</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 10:22 28-09-2016</li>
                <li><a href="">renodl</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 10:22 28-09-2016</li>
                <li><a href="">vtcid50618131951</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 10:22 28-09-2016</li>
                <li><a href="">vtcid50618131951</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 10:22 28-09-2016</li>
                <li><a href="">phamtuoisang0103</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 10:22 28-09-2016</li>
                <li><a href="">copcho0022</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 10:21 28-09-2016</li>
                <li><a href="">copcho0022</a> đã nhận được <a href="">Thẻ vcoin mệnh gi&#225; 10.000 VNĐ </a>lúc 10:21 28-09-2016</li>
                <li><a href="">gosdblue</a> đã nhận được <a href="">Thẻ vcoin mệnh gi&#225; 10.000 VNĐ </a>lúc 10:01 28-09-2016</li>
                <li><a href="">gosdblue</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 10:01 28-09-2016</li>
                <li><a href="">huannguyen851</a> đã nhận được <a href="">Thẻ vcoin mệnh gi&#225; 10.000 VNĐ </a>lúc 10:01 28-09-2016</li>
                <li><a href="">huannguyen851</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 10:01 28-09-2016</li>
                <li><a href="">huannguyen851</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 10:01 28-09-2016</li>
                <li><a href="">tinhversion074</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 10:00 28-09-2016</li>
                <li><a href="">tinhversion074</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 10:00 28-09-2016</li>
                <li><a href="">baocu1997</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 10:00 28-09-2016</li>
                <li><a href="">baocu1997</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 10:00 28-09-2016</li>
                <li><a href="">nhoem1109</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 09:42 28-09-2016</li>
                <li><a href="">nhoem1109</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 09:42 28-09-2016</li>
                <li><a href="">kenkaiser411</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 09:41 28-09-2016</li>
                <li><a href="">vietkunzin5</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 09:41 28-09-2016</li>
                <li><a href="">vietkunzin5</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 09:41 28-09-2016</li>
                <li><a href="">tinhversion073</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 09:40 28-09-2016</li>
                <li><a href="">tinhversion073</a> đã nhận được <a href="">Thẻ vcoin mệnh gi&#225; 10.000 VNĐ </a>lúc 09:40 28-09-2016</li>
                <li><a href="">tinhversion073</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 09:40 28-09-2016</li>
                <li><a href="">changkhotkqn</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 09:20 28-09-2016</li>
                <li><a href="">tinhversion069</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 09:20 28-09-2016</li>
                <li><a href="">tinhversion069</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 09:20 28-09-2016</li>
                <li><a href="">ltk90</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 09:20 28-09-2016</li>
                <li><a href="">ltk90</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 09:20 28-09-2016</li>
                <li><a href="">kyuusei13</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 09:20 28-09-2016</li>
                <li><a href="">kyuusei13</a> đã nhận được <a href="">Thẻ vcoin mệnh gi&#225; 10.000 VNĐ </a>lúc 09:20 28-09-2016</li>
                <li><a href="">kyuusei13</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 09:20 28-09-2016</li>
                <li><a href="">deby_kynz.99_hpv</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 09:00 28-09-2016</li>
                <li><a href="">joonuee</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 09:00 28-09-2016</li>
                <li><a href="">byruretert</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 09:00 28-09-2016</li>
                <li><a href="">byruretert</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 09:00 28-09-2016</li>
                <li><a href="">tinhversion067</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 09:00 28-09-2016</li>
                <li><a href="">tinhversion067</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 09:00 28-09-2016</li>
                <li><a href="">ltk27</a> đã nhận được <a href="">Thẻ vcoin mệnh gi&#225; 10.000 VNĐ </a>lúc 09:00 28-09-2016</li>
                <li><a href="">ltk27</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 09:00 28-09-2016</li>
                <li><a href="">vtc.60928084454</a> đã nhận được <a href="">Giftcode Đồ Long K&#253; </a>lúc 08:43 28-09-2016</li>
        </ul>
    </div>

                        </div> <!-- end vinhdanh -->

                        <div class="clearfix"></div>
                    </div> <!-- end contain-table -->
                </div>
            </div> <!-- bao-contain-table -->
            <div class="thele wow animated fadeIn" data-wow-delay="1s">
                <div class="tt-thele"><img src="https://dolongky.vtcgame.vn/teaser/images/icon-thele.png" alt=""> Thể lệ:</div>
                <ul>
                    <li>Mỗi ngày đăng nhập, điểm danh game thủ có cơ hội nhận được các phần quà hấp dẫn như Thẻ Vcoin, Giftcode Đồ Long Ký. Sẽ có hàng trăm quà tặng mỗi ngày cho game thủ.</li>
                    <li>Điểm danh liên tiếp 14 ngày game thủ sẽ nhận được "Mã số may mắn" và VIPCODE vào ngày thứ 14.</li>
                    <li>Mã số may mắn sẽ được tổ chức quay số, trao giải trên fanpage của Đồ Long Ký. </li>
                    <li>Trị giá giải thưởng của “Mã số may mắn” là 500 Vcoin tương đương 500.000 VNĐ. </li>
                </ul>
            </div> <!-- end thele -->
        </div> <!-- end content-sl1 -->
    </div>
</div> <!-- end select-1 -->
<?php }?>

<div id="spage3" data-scroll-index="2" class="select select-3">
    <div class="wrapper">

        <div class="tab-yt">
            <ul class="yt-tab wow animated bounceInLeft">
                <li class="active"><a href="javascript:;" onclick="VideoShow(1)">1</a></li>
                <li><a href="javascript:;" onclick="VideoShow(2)">2</a></li>
                <li><a href="javascript:;" onclick="VideoShow(3)">3</a></li>
                <li><a href="javascript:;" onclick="VideoShow(4)">4</a></li>
            </ul>

            <div id="tab-yt1" class="youtube-embed wow animated pulse">
                <img src="<?=PATH_URL?>static/teaser/images/nut1.png" style=" width: 875px; margin-top: -2%; height: 478px;" />
            </div> <!-- end tab-yt1 -->
            <div id="tab-yt2" class="youtube-embed wow animated pulse">
                <img src="<?=PATH_URL?>static/teaser/images/nut2.png" style=" width: 875px; margin-top: -2%; height: 478px;" />
            </div> <!-- end tab-yt1 -->
            <div id="tab-yt3" class="youtube-embed wow animated pulse">
                <img src="<?=PATH_URL?>static/teaser/images/nut3.png" style=" width: 875px; margin-top: -2%; height: 478px;" />
            </div> <!-- end tab-yt1 -->
            <div id="tab-yt4" class="youtube-embed wow animated pulse">
                <img src="<?=PATH_URL?>static/teaser/images/nut4.png" style=" width: 875px; margin-top: -2%; height: 478px;" />
            </div> <!-- end tab-yt1 -->

        </div>
    </div>
</div> <!-- end select-3 -->

<div id="spage4" data-scroll-index="3" class="select select-4">
    <div class="wrapper">
        <div class="hethong-nv-a">
            <div class="flipster">
                <ul class="flip-items">
                    <li id="1">
                        <a href="javascript:;" onclick="PopupCtrl.PopupKiemKhach();">
                            <img src="<?=PATH_URL?>static/teaser/images/nv1-gray.png" alt="">
                            <img src="<?=PATH_URL?>static/teaser/images/nv1-color.png" alt="">
                            <img src="<?=PATH_URL?>static/teaser/images/tt-nv1.png" alt="">
                        </a>
                    </li>
                    <li id="2">
                        <a href="javascript:;" onclick="PopupCtrl.PopupDaoKhach();">
                            <img src="<?=PATH_URL?>static/teaser/images/nv3-gray.png" alt="">
                            <img src="<?=PATH_URL?>static/teaser/images/nv3-color.png" alt="">
                            <img src="<?=PATH_URL?>static/teaser/images/tt-nv3.png" alt="">
                        </a>
                    </li>

                    <li id="3">
                        <a href="javascript:;" onclick="PopupCtrl.PopupPhienKhach();">
                            <img src="<?=PATH_URL?>static/teaser/images/nv2-gray.png" alt="">
                            <img src="<?=PATH_URL?>static/teaser/images/nv2-color.png" alt="">
                            <img src="<?=PATH_URL?>static/teaser/images/tt-nv2.png" alt="">
                        </a>
                    </li>


                    <li id="4">
                        <a href="javascript:;" onclick="PopupCtrl.PopupKiemKhach();">
                            <img src="<?=PATH_URL?>static/teaser/images/nv1-gray.png" alt="">
                            <img src="<?=PATH_URL?>static/teaser/images/nv1-color.png" alt="">
                            <img src="<?=PATH_URL?>static/teaser/images/tt-nv1.png" alt="">
                        </a>
                    </li>
                    <li id="5">
                        <a href="javascript:;" onclick="PopupCtrl.PopupDaoKhach();">
                            <img src="<?=PATH_URL?>static/teaser/images/nv3-gray.png" alt="">
                            <img src="<?=PATH_URL?>static/teaser/images/nv3-color.png" alt="">
                            <img src="<?=PATH_URL?>static/teaser/images/tt-nv3.png" alt="">
                        </a>
                    </li>
                    <li id="6">
                        <a href="javascript:;" onclick="PopupCtrl.PopupPhienKhach();">
                            <img src="<?=PATH_URL?>static/teaser/images/nv2-gray.png" alt="">
                            <img src="<?=PATH_URL?>static/teaser/images/nv2-color.png" alt="">
                            <img src="<?=PATH_URL?>static/teaser/images/tt-nv2.png" alt="">
                        </a>
                    </li>
                </ul>
            </div>

        </div> <!-- end hethong-nv-a -->
        <div class="tt-nv wow animated fadeIn"><img src="<?=PATH_URL?>static/teaser/images/tt-nv.png" alt=""></div>
    </div>
</div> <!-- end select-4 -->

<div id="spage5" data-scroll-index="4" class="select select-5">
    <div class="wrapper">
        <div class="tt-sl5 wow animated fadeInDown">
            <img src="<?=PATH_URL?>static/teaser/images/tt-sl5.png" alt="">
        </div> <!-- end tt-sl5 -->
        <div class="select-tuong wow animated fadeInRight">
            <a href="javascript:;" onclick="showVoTuong()"><img src="<?=PATH_URL?>static/teaser/images/tuong1.png" alt=""></a>
            <a href="javascript:;" onclick="showKyNang()"><img src="<?=PATH_URL?>static/teaser/images/tuong2.png" alt=""></a>
            <a href="javascript:;" onclick="showBanDo()"><img src="<?=PATH_URL?>static/teaser/images/tuong3.png" alt=""></a>
            <a href="javascript:;" onclick="showNPC()"><img src="<?=PATH_URL?>static/teaser/images/tuong4.png" alt=""></a>
            <a href="javascript:;" onclick="showTrangBi()"><img src="<?=PATH_URL?>static/teaser/images/tuong5.png" alt=""></a>
            <a href="javascript:;" onclick="showCanh()"><img src="<?=PATH_URL?>static/teaser/images/tuong6.png" alt=""></a>
            <a href="javascript:;" onclick="showToaKy()"><img src="<?=PATH_URL?>static/teaser/images/tuong7.png" alt=""></a>
        </div> <!-- end select-tuong -->
    </div>

    <!--Vo Tuong-->
    <div id="VoTuong" style="display:none;">
        <div class="nenxam" style="height: 625%; margin-top: -249%; position: absolute;" onclick="hideVoTuong()"></div>
        <div class="wrapper" style="margin-top: -14%;">
            <div class="popup">
                <div class="popuptuong" style="padding: 0px 30px 20px 70px;z-index: 200;">
                    <img src="<?=PATH_URL?>static/teaser/images/tinh-nang-dacsac.png" alt="">
                    <a href="javascript:;" onclick="hideVoTuong()"><img src="<?=PATH_URL?>static/teaser/images/close-popup.png" alt=""></a>
                    <div class="content-popup-tuong">
                        <div class="tt-popup-tuong">hệ thống mỹ nữ</div>
                        <div class="tuong-scroll mCustomScrollbar">
                            <b>Hệ thống võ tướng của ĐỒ LONG KÝ được cách điệu thành vô số các mỹ nhân đi theo trợ chiến cho người chơi. Mỗi mỹ nhân lại mang những đặc tính khác nhau và phát huy tối đa sức mạnh trong các tình huống cụ thể.</b>
                            <img src="<?=PATH_URL?>static/teaser/images/votuong.png" alt="">
                        </div> <!-- end tuong-scroll -->
                    </div>
                </div><!--  end popuptuong -->
            </div>
        </div> <!-- end popup -->
    </div>

    <!--Ky Nang-->
    <div id="KyNang" style="display:none;">
        <div class="nenxam" style="height: 625%; margin-top: -249%; position: absolute;" onclick="hideKyNang()"></div>
        <div class="wrapper" style="margin-top: -14%;">
            <div class="popup">
                <div class="popuptuong" style="padding: 0px 30px 20px 70px;z-index: 200;">
                    <img src="<?=PATH_URL?>static/teaser/images/tinh-nang-dacsac.png" alt="">
                    <a href="javascript:;" onclick="hideKyNang()"><img src="<?=PATH_URL?>static/teaser/images/close-popup.png" alt=""></a>
                    <div class="content-popup-tuong">
                        <div class="tt-popup-tuong">hệ thống kỹ năng</div>
                        <div class="tuong-scroll mCustomScrollbar">
                            <b>Mỗi lớp nhân vật trong ĐỒ LONG KÝ được trang bị tới 7 kỹ năng chủ động. Đây không chỉ là điểm nhấn về trải nghiệm tuyệt vời cho người chơi mà còn là đặc sắc lớn nhất trong hệ thống PK trong ĐỒ LONG KÝ.</b>
                            <img src="<?=PATH_URL?>static/teaser/images/kynang.png" alt="">
                        </div> <!-- end tuong-scroll -->
                    </div>
                </div><!--  end popuptuong -->
            </div>
        </div> <!-- end popup -->
    </div>

    <!--Ban Do-->
    <div id="BanDo" style="display:none;">
        <div class="nenxam" style="height: 625%; margin-top: -249%; position: absolute;" onclick="hideBanDo()"></div>
        <div class="wrapper" style="margin-top: -14%;">
            <div class="popup">
                <div class="popuptuong" style="padding: 0px 30px 20px 70px;z-index: 200;">
                    <img src="<?=PATH_URL?>static/teaser/images/tinh-nang-dacsac.png" alt="">
                    <a href="javascript:;" onclick="hideBanDo()"><img src="<?=PATH_URL?>static/teaser/images/close-popup.png" alt=""></a>
                    <div class="content-popup-tuong">
                        <div class="tt-popup-tuong">hệ thống bản đồ</div>
                        <div class="tuong-scroll mCustomScrollbar">
                            <b>Bản đồ Thế giới với giao diện dễ nhìn, dễ tìm kiếm là công cụ đắc lực cho người trong quá trình luyện cấp. Không chỉ giúp người chơi dịch chuyển nhanh hơn từ nơi này tới nơi khác, bản đồ thế giới còn giúp người chơi dễ dàng lựa chọn khu vực phù hợp để luyện cấp.</b>
                            <img src="https://dolongky.vtcgame.vn/teaser/images/bando.png" alt="">
                        </div> <!-- end tuong-scroll -->
                    </div>
                </div><!--  end popuptuong -->
            </div>
        </div> <!-- end popup -->
    </div>

    <!--NPC-->
    <div id="NPC" style="display:none;">
        <div class="nenxam" style="height: 625%; margin-top: -249%; position: absolute;" onclick="hideNPC()"></div>
        <div class="wrapper" style="margin-top: -14%;">
            <div class="popup">
                <div class="popuptuong" style="padding: 0px 30px 20px 70px;z-index: 200;">
                    <img src="<?=PATH_URL?>static/teaser/images/tinh-nang-dacsac.png" alt="">
                    <a href="javascript:;" onclick="hideNPC()"><img src="<?=PATH_URL?>static/teaser/images/close-popup.png" alt=""></a>
                    <div class="content-popup-tuong">
                        <div class="tt-popup-tuong">hệ thống NPC</div>
                        <div class="tuong-scroll mCustomScrollbar">
                            <b>NPC trong ĐỒ LONG KÝ giúp người chơi hình dung ra một cách rõ ràng nhất sự hiện diện của chính phái, tà phái và các thế lực trung gian. Cuộc chiến bất phân thắng bại kéo dài nhiều năm liệu có thể chấm dứt hay không tùy thuộc vào quyết định của bạn!</b>
                            <img src="<?=PATH_URL?>static/teaser/images/npc.png" alt="">
                        </div> <!-- end tuong-scroll -->
                    </div>
                </div><!--  end popuptuong -->
            </div>
        </div> <!-- end popup -->
    </div>

    <!--Trang bị-->
    <div id="TrangBi" style="display:none;">
        <div class="nenxam" style="height: 625%; margin-top: -249%; position: absolute;" onclick="hideTrangBi()"></div>
        <div class="wrapper" style="margin-top: -14%;">
            <div class="popup">
                <div class="popuptuong" style="padding: 0px 30px 20px 70px;z-index: 200;">
                    <img src="<?=PATH_URL?>static/teaser/images/tinh-nang-dacsac.png" alt="">
                    <a href="javascript:;" onclick="hideTrangBi()"><img src="<?=PATH_URL?>static/teaser/images/close-popup.png" alt=""></a>
                    <div class="content-popup-tuong">
                        <div class="tt-popup-tuong">hệ thống trang bị</div>
                        <div class="tuong-scroll mCustomScrollbar">
                            <b>Các trang bị tinh xảo với chỉ số đa dạng khiến người chơi không khỏi thích thú. Đây chính là cơ hội để người chơi xây dựng một nhân vật hoàn toàn theo ý muốn của mình chứ không phụ thuộc vào bất cứ yếu tố nào khác</b>
                            <img src="<?=PATH_URL?>static/teaser/images/trangbi.png" alt="">
                        </div> <!-- end tuong-scroll -->
                    </div>
                </div><!--  end popuptuong -->
            </div>
        </div> <!-- end popup -->
    </div>

    <!--Cánh-->
    <div id="Canh" style="display:none;">
        <div class="nenxam" style="height: 625%; margin-top: -249%; position: absolute;" onclick="hideCanh()"></div>
        <div class="wrapper" style="margin-top: -14%;">
            <div class="popup">
                <div class="popuptuong" style="padding: 0px 30px 20px 70px;z-index: 200;">
                    <img src="<?=PATH_URL?>static/teaser/images/tinh-nang-dacsac.png" alt="">
                    <a href="javascript:;" onclick="hideCanh()"><img src="<?=PATH_URL?>static/teaser/images/close-popup.png" alt=""></a>
                    <div class="content-popup-tuong">
                        <div class="tt-popup-tuong">hệ thống cánh</div>
                        <div class="tuong-scroll mCustomScrollbar">
                            <b>Không chỉ thể hiện đẳng cấp của người sở hữu, cánh trong ĐỒ LONG KÝ còn đồng thời vừa là “phục trang” làm đẹp, vừa là nguồn lực chiến dồi dào cho nhân vật. Do đó, sở hữu cánh cấp cao luôn là niềm mơ ước của mọi game thủ ĐỒ LONG KÝ</b>
                            <img src="<?=PATH_URL?>static/teaser/images/canh.png" alt="">
                        </div> <!-- end tuong-scroll -->
                    </div>
                </div><!--  end popuptuong -->
            </div>
        </div> <!-- end popup -->
    </div>

    <!--Tọa Kỵ-->
    <div id="ToaKy" style="display:none;">
        <div class="nenxam" style="height: 625%; margin-top: -249%; position: absolute;" onclick="hideToaKy()"></div>
        <div class="wrapper" style="margin-top: -14%;">
            <div class="popup">
                <div class="popuptuong" style="padding: 0px 30px 20px 70px;z-index: 200;">
                    <img src="<?=PATH_URL?>static/teaser/images/tinh-nang-dacsac.png" alt="">
                    <a href="javascript:;" onclick="hideToaKy()"><img src="<?=PATH_URL?>static/teaser/images/close-popup.png" alt=""></a>
                    <div class="content-popup-tuong">
                        <div class="tt-popup-tuong">hệ thống tọa kỵ</div>
                        <div class="tuong-scroll mCustomScrollbar">
                            <b>Giúp người chơi di chuyển nhanh hơn là nhiệm vụ chính của tọa kỵ, nhưng ngoại hình của tọa kỵ trong ĐỒ LONG KÝ mới là một trong những điểm hấp dẫn nhất. Từ nhắng nhít, dễ thương cho tới “cool ngầu” và hoành tráng, hệ thống tọa kỵ trong ĐỒ LONG KÝ hoàn toàn có thể chiều lòng những người chơi khó tính nhất.</b>
                            <img src="<?=PATH_URL?>static/teaser/images/toaky.png" alt="">
                        </div> <!-- end tuong-scroll -->
                    </div>
                </div><!--  end popuptuong -->
            </div>
        </div> <!-- end popup -->
    </div>
</div> <!-- end select-5 -->

<div id="spage6" data-scroll-index="5" class="select select-6 wow animated">
    <div class="wrapper">
        <div class="tt-sl6 wow animated">
            <img src="<?=PATH_URL?>static/teaser/images/tt-sl6.png" alt="">
        </div> <!-- end tt-sl6 -->
        <div class="btn">
            <a href="https://www.facebook.com/%C4%90%E1%BB%93-Long-Pk-335698360109844/?fref=ts" target="_blank" class="wow animated bounceInLeft"><img src="<?=PATH_URL?>static/teaser/images/btn-fb.png" alt=""></a>
          
            
            <!-- <a href="https://www.facebook.com/groups/dolongky.vtcgame.vn/" target="_blank" class="wow animated bounceInRight"><img src="<?=PATH_URL?>static/teaser/images/btn-gift.png" alt=""></a>  -->
        </div>

    </div>
</div> <!-- end select-6 -->

<script type="text/javascript">
    function VideoShow(type) {
        if (type == 1) {
            $("#tab-yt1").show();
            $("#tab-yt2").hide();
            $("#tab-yt3").hide();
            $("#tab-yt4").hide();
        }
        if (type == 2) {
            $("#tab-yt1").hide();
            $("#tab-yt2").show();
            $("#tab-yt3").hide();
            $("#tab-yt4").hide();
        }
        if (type == 3) {
            $("#tab-yt1").hide();
            $("#tab-yt2").hide();
            $("#tab-yt3").show();
            $("#tab-yt4").hide();
        }
        if (type == 4) {
            $("#tab-yt1").hide();
            $("#tab-yt2").hide();
            $("#tab-yt3").hide();
            $("#tab-yt4").show();
        }
    }


    //Vo Tuong
    function showVoTuong() {
        document.getElementById('VoTuong').style.display = "block";
    }
    function hideVoTuong() {
        document.getElementById('VoTuong').style.display = "none";
    }

    //Kỹ Năng
    function showKyNang() {
        document.getElementById('KyNang').style.display = "block";
    }
    function hideKyNang() {
        document.getElementById('KyNang').style.display = "none";
    }

    //Ban Do
    function showBanDo() {
        document.getElementById('BanDo').style.display = "block";
    }
    function hideBanDo() {
        document.getElementById('BanDo').style.display = "none";
    }

    //NPC
    function showNPC() {
        document.getElementById('NPC').style.display = "block";
    }
    function hideNPC() {
        document.getElementById('NPC').style.display = "none";
    }

    //TrangBi
    function showTrangBi() {
        document.getElementById('TrangBi').style.display = "block";
    }
    function hideTrangBi() {
        document.getElementById('TrangBi').style.display = "none";
    }

    //Canh
    function showCanh() {
        document.getElementById('Canh').style.display = "block";
    }
    function hideCanh() {
        document.getElementById('Canh').style.display = "none";
    }

    //ToaKy
    function showToaKy() {
        document.getElementById('ToaKy').style.display = "block";
    }
    function hideToaKy() {
        document.getElementById('ToaKy').style.display = "none";
    }

    $(document).ready(function () {
        // setTimeout(function () {
        //     PopupCtrl.PopupVideo();
        // }, 2000);

    });

    setTimeout(function () {
        PopupCtrl.HidePopup();
    }, 85000);
</script>

    <script src="<?=PATH_URL?>static/teaser/js/app.js" type="text/javascript"></script>
    <script src="<?=PATH_URL?>static/teaser/js/jquery.mCustomScrollbar.concat.min.js" type="text/javascript"></script>
    <script src="<?=PATH_URL?>static/teaser/js/scroll.js"></script>
    <script src="<?=PATH_URL?>static/teaser/js/index.js"></script>

    <link rel="stylesheet" href="<?=PATH_URL?>static/teaser/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="<?=PATH_URL?>static/teaser/owl-carousel/owl.theme.css">
    <script src="<?=PATH_URL?>static/teaser/owl-carousel/owl.carousel.js"></script>
    <!-- <script src="<?=PATH_URL?>static/teaser/js/CalendarJS.js"></script> -->

    <script src="<?=PATH_URL?>static/fancybox/source/jquery.fancybox.pack.js"></script>
    <script src="<?=PATH_URL?>static/js/account.js"></script>

    <script>
  
        $(document).ready(function () {
            var UrlRoot = jsConfig.UrlRoot;
            var urlEncode = encodeURIComponent(UrlRoot);
            var islogin = false;
            var accountId = '0';
        });
        $(function () {
            $.scrollIt();
        });
        new WOW().init();
      if (accountId != '0') {
                PopupCtrl.SetLastLogin();
            }
    </script>
  
    <script>
        $(function () {
            var owl = $("#owl-info-nv");
            owl.owlCarousel({
                itemsCustom: [
                    [0, 1],
                    [480, 1],
                    [768, 1],
                    [992, 1],
                    [1200, 1],
                ],
                navigation: true,
                pagination: false,
                autoPlay: false,
            });
        });
    </script>
<?php if($username){
echo $this->load->view('FRONTEND/popup_giftcode');
}?>
<!-- banner -->
<?php if(1){echo modules::run('banner');} ?>
<!-- Login -->
<div style="display: none;">
<div class="popup_banner" id='popup_open'>
    <a href="javascript:;" onclick='PopupCtrl.ShowBanner();' target='_blank'> <img src="<?=PATH_URL?>static/teaser/images/banner_open.jpg"> </a>
</div>
<!-- START OF POPUP ACCOUNT -->
<?php //echo $this->load->view('FRONTEND/popup/video');?>
<!-- START OF POPUP ACCOUNT -->
<?php echo $this->load->view('FRONTEND/popup/account');?>
<!-- END OF POPUP ACCOUNT -->

<script type="text/javascript">
// $(document).ready(function(){
//     setTimeout(function(){
//         PopupCtrl.PopupOpen();
//     },800); 
// })
</script>

</div>
<div class="tracking" style="position:absolute;bottom:0px">
<?php $this->load->view('FRONTEND/modules/tracking');?>
</div>
</body>
</html> 