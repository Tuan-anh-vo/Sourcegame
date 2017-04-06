var is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
function loadgame(){
  setTimeout(function(){
    $('.btn_choigame').trigger('click');
  })
}
function setConfirmUnload(on) {
    window.onbeforeunload = (on) ? unloadMessage : null;
}
function unloadMessage() {
   setTimeout(function(){
       setConfirmUnload(false);
       location.href = root+'servers/created_user_play';
    },1000);
    return "  Bạn có muốn thử chơi game nhanh không? \r"+
      "- Không cần đăng ký vào chơi ngay \r"+
      "- Quà tặng Giftcode 2.999.999 VND \r"+
      "- Quà tân thủ: Túi quà may mắn \r"+
      "- Quà thú cưỡi và cánh cực đẹp \r"+
      "Truy Mộng là webgame nhập vai kiếm tiên hiệp với nhiều tính năng hấp dẫn lắm \r";
}
$(document).ready(function() {
  $(".click-popup").fancybox();
  
  $(".btn_dangkya").fancybox();
  if( !user_login){
    $(".click-popup").trigger("click").fancybox();
      // setConfirmUnload(true);
      //$('.btn_dangkya').trigger('click');
  }
  $("#click-login").click(function(e){
    $('.btn_dangky').trigger('click');
  });

  $(".bt-vongquay").click(function(){
      if(!user_login){
        //$(".btn-playgame ").trigger("click");
      }else{
        $.fancybox({
            href: root + 'vongquay',
            type: 'iframe',
            beforeShow: function(){
                $(".fancybox-skin").css("background","none");
                $(".fancybox-skin").css("webkit-box-shadow","none");
                $(".fancybox-skin").css("box-shadow","none");
                this.width  = 492;
                this.height = 598;
            },
            afterShow: function(){
                $(".fancybox-close").css({"top": "26px","right": "15px","background":"none"});
            },
        });
      }
  });

  if(!user_login){
    $('.btn_dangky').fancybox({
        beforeShow: function(){
        $('.fancybox-skin').css({
          'background': 'none',
          'webkit-box-shadow': 'none',
          'box-shadow': 'none'
        });
        $('.fancybox-close').css('display', 'none');
        }
    });

    $('.btn-playgame, .btn_choigame').click(function(){
        $('.btn_dangky').trigger('click');
    });

    $('.bt-link a').click(function(e) {
        e.preventDefault();
      $('.btn_dangky').trigger('click');
    });

    if(uri == '/dang-nhap' || uri == '/dang-ky'){
      setTimeout(function(){
        $('.btn-playgame').trigger('click');
      },500);
    }

  }else{
    if(uri == '/' || uri == '/trang-chu' || uri == '/home/lixi'){
      open_popupgiftcode();
    }

    $('.bt-link4').click(function() {
        $.fancybox({
            href: root + 'lixi',
            type: 'iframe',
            autoSize: false,
            autoDimensions: false,
            width: 667,
            height: 584,
            fitToView: false,
            beforeShow: function(){
                $(".fancybox-skin").css("background","none");
                $(".fancybox-skin").css("webkit-box-shadow","none");
                $(".fancybox-skin").css("box-shadow","none");
            },
            afterShow: function(){
                $(".fancybox-close").css({"top": "-17px","right": "-17px"});
            },
        });
    });

    $('.close-popup').click(function() {
      $('.popup-giftcode').slideUp(400);
      $('.popup-server').slideUp(400);
      $('.close-popup').hide(500);
      setTimeout(function(){
        $(".bt-vongquay").trigger("click");
      },300)
    });

    $('.s_xemthem, .btn_choigame, .btn-playgame').click(function(e) {
        e.preventDefault();
        var h = $( window ).height();
        var top = 0;
        var point = $('.header').offset();
        var left = point.left+20;
        $('.popup-server').css({
          'top': top,
          'left': left
        });
        $('.popup-server').slideDown();
        $('.close-popup').show();
    });


  }

  $('.send-email').live('click', function(e) {
      e.preventDefault();
      var email = $('#email-code').val();
      sendMailGiftCode(email);
  });
  $('#email-code').keydown(function (e) {
      if (e.keyCode == 13){
          var email = $('#email-code').val();
          sendMailGiftCode(email);
      }
  });
  $('.sharefb').live('click', function(e) {
      e.preventDefault();
      sharecaption();
  });
  $(".save-plugin").live('click', function(e) {
      e.preventDefault();
      if(is_chrome){
        chrome.webstore.install("https://chrome.google.com/webstore/detail/nklggibnljfhpahgminmgphpkgmldijh", installsuccess, installfailed);
      } else {
        installsuccess();
      }
  })
});

function sharecaption(){
    if(!user_login) window.href= root+'dang-nhap';
    var msg = [];
    msg[1] = 'Phong vân hội tụ, trải nghiệm mỹ mãn với những tính năng độc đáo của Truy Mộng';
    var img_f = [];
    img_f[1] = 'http://truymong.com/static/images/sharefacebook/01.png';
    //-------------
    FB.ui({
        method: 'feed',
        name: msg[Math.floor((Math.random() * 5) + 1)],
        link: 'http://truymong.com/',
        picture: img_f[Math.floor((Math.random() * 6) + 1)],
        caption: 'Truy Mộng',
        description: 'Trải nghiệm ngay webgame 2D đầu tiên tại Việt Nam, và nhận ngay gift code lên đến 1.000.000 vnđ',
        message: 'Bạn đã thử chưa'
    }, function(response) {
        if (response != "" && response != null) {
            loadgiftcode();
        }
    });
}

function loadgiftcode(){
    $.post(
    root + 'gift/giftcode_plugin',{ type : 1},
      function (result) {
        location.href = root;
    });
}

function sendMailGiftCode(email){
  $.post(
    root + 'user/sendMailGiftCode',{ email : email},
      function (result) {
        $('.kq-mail').html(result);
  });
}
function installsuccess(){
  $.post(
  root + 'gift/giftcode_plugin',{ type : 1},
    function (result) {
      location.href = root;
  });
}
function installfailed(){
  alert("Thất bại trong cài đặt, Vui lòng thử lại sau!");
}
function open_popupgiftcode(){
  var h = $( window ).height();
    var top = h/2-200;
    setTimeout(function(){
      var point = $('.header').offset();
      var left = point.left+60;
      $('.popup-giftcode').css({
        'top': top,
        'left': left
      });
        $('.popup-giftcode').slideDown(400);
        $('.close-popup').show();
    },400);
}