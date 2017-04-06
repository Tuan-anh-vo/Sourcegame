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



  if( (uri == '' || uri == '/' || uri == 'trang-chu') && !user_login ){
      setConfirmUnload(true);
  } 

  if(!user_login){
    $('.btn-playgame, .btn_dangky, .btn_choigame').fancybox({
      beforeShow: function(){
      $('.fancybox-skin').css({
        'background': 'none',
        'webkit-box-shadow': 'none',
        'box-shadow': 'none'
      });
      $('.fancybox-close').css('display', 'none');
      }
    });
    if(uri == '/dang-nhap' || uri == '/dang-ky'){
      setTimeout(function(){
        $('.btn-playgame').trigger('click');
      },500);
    }
  }else{
    if(uri == '/' || uri == '/trang-chu' || uri ==' home'){
      var h = $( window ).height();
      var top = h/2-200;
      setTimeout(function(){
        var point = $('.content').offset();
        var left = point.left+60;
        $('.popup-giftcode').css({
          'top': top,
          'left': left
        });
          $('.popup-giftcode').slideDown(400);
          $('.close-popup').show();
      },400);
    }
    $('.close-popup').click(function() {
      $('.popup-giftcode').slideUp(400);
      $('.popup-server').slideUp(400);
      $('.close-popup').hide(500);
    });
  }
  $('.s_xemthem, .btn_choigame').click(function(e) {
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
  $(".save-plugin").live('click', function(e) {
      e.preventDefault();
      if(is_chrome){
        chrome.webstore.install("https://chrome.google.com/webstore/detail/nklggibnljfhpahgminmgphpkgmldijh", installsuccess, installfailed);
      } else {
        installsuccess();
      }
  })
});
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