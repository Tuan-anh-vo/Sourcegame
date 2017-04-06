<!-- Title -->
<div class="title_content">
  <ul class="breadcumb">
    <li><a class="homeb" href="<?=PATH_URL?>trang-chu">trang chủ</a></li>
    <li><span class="muiten">»</span></li>
    <li><a href="<?=PATH_URL."nap-the"?>">Nạp Thẻ</a></li>
  </ul>
  <div style="clear:both"></div>
</div>
<!-- Content -->
<div id="contentparent">
  <div class="news_content">
    <span class="news_title">Nạp Thẻ</span>
    <!-- <img src="static/images/detail/wallpagenews.png" height="236" width="678"/> -->
    <div class="contentsssss">
      <?=Modules::run("user/payment")?>
    </div>
  </div>
</div>

<style type="text/css">
  .breadcum ul{height: 100%;}
  .breadcum ul li{float: left; line-height: 48px; color: #fff; font-weight: bold;}
  .breadcum ul li a{margin: 0 6px;}
  .breadcum ul li a:hover{color: #fff;}
  .breadcum ul li a.last-child{color: #fff;}
 
.chuyen_knb label {
	width: 70px !important;
	float: left !important;
	margin: 0px !important;
}
.contentsssss {
	background: #fff;
}
</style>