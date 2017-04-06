$('.list-detail li').hover(function() {
    $(this).find('.content-description').css({
      "-webkit-transform": "translate(0,70px)",
      "transform": "translate(0,70px)",
      "transition-duration": "0.5s"
    })
  }, function() {
    $(this).find('.content-description').css({
      "-webkit-transform": "translate(0,0px)",
      "transform": "translate(0,0px)",
      "transition-duration": "0.5s"
    })
});
$(document).ready(function() {
    if(uri == '' || uri == 'dang-nhap' || uri == 'dang-ky' && !user_login){
      setTimeout(function(){
        $('.close-popup').trigger('click');
        $('.btn-regis').trigger('click');
      },500);
    }
    if(!user_login){
      $('.btn-playgame').fancybox({
        beforeShow: function(){
        $('.fancybox-skin').css({
          'background': 'none',
          'webkit-box-shadow': 'none',
          'box-shadow': 'none'
        });
        $('.fancybox-close').css('display', 'none');
        }
      });
    }else{
      $('.btn-playgame').click(function(e) {
        e.preventDefault();
        var h = $( window ).height();
        var top = 0;
        setTimeout(function(){
          var point = $('.header').offset();
          var left = point.left;
          $('.popup-server').css({
            'top': top,
            'left': left
          });
          $('.popup-server').slideDown(400);
          $('.close-popup').show();
        },400);
      });
    }
    $('.close-popup').click(function(e) {
      e.preventDefault();
      $('.popup-server').slideUp(400);
      $('.close-popup').hide();
    });
});
