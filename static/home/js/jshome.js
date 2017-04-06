$(document).ready(function() {
    $("#owl-demo").owlCarousel({
        autoPlay : 10000,
        stopOnHover : true,
        navigation:true,
        paginationSpeed : 1000,
        goToFirstSpeed : 2000,
        singleItem : true,
        autoHeight : true,
        transitionStyle:"fade",
        navigationText  :["<h5></h5>","<h5></h5>"]
    });

    $("#owl-demo1").owlCarousel({
        autoPlay : 3000,
        stopOnHover : true,
        navigation:true,
        paginationSpeed : 1000,
        goToFirstSpeed : 2000,
        singleItem : true,
        autoHeight : true,
        transitionStyle:"fade",
        navigationText  :["<h5></h5>","<h5></h5>"]
    });
});
// js backtotop
$(function(){

    $(window).scroll(function(){
        if($(this).scrollTop()!=0){
	       $('#backtotop').fadeIn();
        }else{
	       $('#backtotop').fadeOut();
        }
    });

	$('#backtotop').click(function(){
        $('body,html').animate({scrollTop:0},800);
    });
});


// js tab
$(document).ready(function(){
    $('ul.tabs li').click(function(){
        var tab_id = $(this).attr('data-tab');
        $('ul.tabs li').removeClass('current');
        $('.tab-content').removeClass('current');
        $(this).addClass('current');
        $("#" + tab_id).addClass('current'); 
    }),
    (function ($) {
    $(window).load(function () {
        $("a[rel='load-content']").click(function (e) {
            e.preventDefault();
            var url = $(this).attr("href");
            $.get(url, function (data) {
                $(".content .mCSB_container").append(data); //load new content inside .mCSB_container
                //scroll-to appended content 
                $(".content").mCustomScrollbar("scrollTo", "h2:last");
            });
        });
        $(".content").delegate("a[href='top']", "click", function (e) {
            e.preventDefault();
            $(".content").mCustomScrollbar("scrollTo", $(this).attr("href"));
        });
    });
    })(jQuery);
})
// js nhan vat
$(function(){
     var len  = $(".f-n li").length;
     var index = 0;
     var adTimer;
     var adWidth = $(".f-m li").width();
     var len2  = $(".f-m li").length;
     $(".f-m ul").width(adWidth*len2);
     $(".f-n").mouseenter(function(){
         $(".f-n ul").css("display","block");
         $(".f-n p").addClass("hover");
         })
     $(".f-n").mouseleave(function(){
         $(".f-n ul").css("display","none");
         $(".f-n p").removeClass("hover");
         })
      $(".customer .bd .f-n ul li a ").click(function(){
         $(".f-n ul").css("display","none");
         $(".f-n p").removeClass("hover");
         })
     $(".f-n li").click(function(){
        index  =   $(".f-n li").index(this);
        showImg2(index);
     }).eq(0).click();  
     $('.f-m').hover(function(){
             clearInterval(adTimer);
         },function(){
             adTimer = setInterval(function(){
                showImg()
              } , 3000);
             }).trigger("mouseleave");
function showImg(){
        $(".f-m ul").find("li:last").prependTo($(".f-m ul"));
        $(".f-n ul").find("li:last").prependTo($(".f-n ul"));
        $(".f-m ul").css({"left":-adWidth});
        $(".f-m ul").stop(true,false).animate({left :0},500);}
function showImg2(index){
        $(".f-m ul li").eq(index).prependTo($(".f-m ul"));
        $(".f-n ul li").eq(index).prependTo($(".f-n ul"));
        $(".f-m ul").css({"left":-adWidth});
        $(".f-m ul").stop(true,false).animate({left :0},0);
    }
})

//zl
$('.zl').hover(function(){
    $(this).addClass('show').siblings().removeClass('show');
    //alert('1123');
})


// js tab 2
