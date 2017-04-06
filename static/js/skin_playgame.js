 $(document).ready(function() {
     $('.popupmess').fancybox();

     reloadIframeGame();
     setInterval(function() {}, 100);
     $('.menu-method ul li a').live('click', function(e) {
         var action = $(this).attr('class');
         $('.menu-method ul li').removeClass('active');
         $(this).parent().addClass('active');
         if (action == 'change-coin') {
             $('.wap_naothe').height(320);
             $('.general').hide();
             $('#chuyencoin').show();
         }
         if (action == 'nap-card') {
             $('.general').hide();
             $('#napthe').show();
             $('.wap_naothe').height(500);
         }
         if (action == 'game-event') {
             $('.general').hide();
             $('#show-event').show();
         }

     });

    $('#click_module').click(function(){
        $.fancybox({
           type:'iframe',
             href: root+'tichluy',
            beforeShow : function(){
                $(".fancybox-skin").css({"background":"none","webkit-box-shadow":"none","box-shadow":"none"});
            },
            afterShow : function(){
                $(".fancybox-close").css({"top": "0","right": "0"});
            }
        });
    });

    $('.btn-naptien, .s-napthe').click(function(){
        $.fancybox({
            href:'#wrap_napthe',
            type:'inline',
            beforeShow: function(){
                $('body').addClass("background_fancybox");
                $(".fancybox-skin").css({"background":"none","webkit-box-shadow":"none","box-shadow":"none"});
            },
            afterShow : function(){
                $(".fancybox-close").css({"top":"-2px","right":"-2px"});
            },
        });
     });
    $('.giftcode, .s-giftcode').click(function(){
        $.fancybox({
            href: root+'gift/index_game',
            type:'iframe',
            beforeShow: function(){
                $('body').addClass("background_fancybox");
                $(".fancybox-skin").css({"background":"none","webkit-box-shadow":"none","box-shadow":"none"});
            },
            afterShow : function(){
                $(".fancybox-close").css({"top":"8px","right":"-2px"});
            },
        });
     });
    
 })

 function showHeight() {
     $('.overlay').toggle(1);
 }

 function reloadIframeGame() {

     var height_if = $(window).height() - $('.topbar').height();
     $('.server-playgame').height(height_if);
 }

 setInterval(function() {
     var height_if = $(window).height() - $('.topbar').height();
     if ($('.topbar').height() <= 37) {
        // $('.server-playgame').height(height_if);
     }

 }, 1300)

 function ShowNapThe() {
     if ($('.wap_naothe').height() > 0) {
         return false;
     }
     hideTop();
     showHeight();
     var hei = 0;
     if ($('.wap_naothe').height() == 0) {
         hei = 480;
     } else {
         return false;
     }
     $(".wap_naothe").animate({
         height: hei
     }, 600);
 }


 function showWebshop() {
     if ($('.wap_webshop').height() > 0) {
         return false;
     }
     $(".overlay").show(1);
     hideTop();
     showHeight();
     var hei = 0;
     if ($('.wap_webshop').height() == 0) {
         hei = 500;
     }
     $(".wap_webshop").animate({
         height: hei
     }, 600);
 }

function show_lathinh(sid){
    $.fancybox({
        href: root + 'lathinh/index?server_id='+sid,
        type: 'iframe',
        beforeShow: function(){
            $(".fancybox-skin").css("background","none");
            $(".fancybox-skin").css("webkit-box-shadow","none");
            $(".fancybox-skin").css("box-shadow","none");
            this.width  = 800;
            this.height = 629;
        },
        afterShow: function(){
            $(".fancybox-close").css({"top": "26px","right": "15px"});
        },
    });
 }
// function show_vipshop(server_id){
//     $.fancybox({
//             href: root + 'vipshop/index2?server_id='+server_id,
//             type: 'iframe',
//             beforeShow: function(){
//                 $(".fancybox-skin").css("background","none");
//                 $(".fancybox-skin").css("webkit-box-shadow","none");
//                 $(".fancybox-skin").css("box-shadow","none");
//                 this.width  = 632;
//                 this.height = 254;
//             },
//             afterShow: function(){
//                 $(".fancybox-close").css({"top": "-19px","right": "0px"});
//             },
//         });
// }



 function hideTop() {
     $(".overlay").hide(1);
     $(".wap_naothe").height(0);
     $(".wap_webshop").height(0);
     $(".view_item_level").height(0);
     $(".wap_showTopGame").height(0);
     $(".wap_item_level_rank").height(0);

 }


 function show_gift_item_level() {
     if ($('.view_item_level').height() > 0) {
         return false;
     }
     $(".overlay").show(1);
     hideTop();
     showHeight();
     var hei = 0;
     if ($('.view_item_level').height() == 0) {
         hei = 300;
     }
     $(".view_item_level").animate({
         height: hei
     }, 600);

 }




 function ajax_request_dautu(servers_id) {
     if (confirm('Bạn có chắc chắn  mua vật phẩm đầu tư giá 888 game coin này hay không?')) {
         $.get(root + "servers/buyItemDautu/" + servers_id, function(data) {
            alert(data);
             $(".detailmess").html(data);
             $('.popupmess').trigger("click");
         });
     }
 }





 $(document).ready(function() {
    
     server_id = $('#servers_id :selected').val();
   

    
 })

 
   

 function load_rank(type) {
    $.fancybox({
       type: 'ajax',
       href: root+'event_item_level/ajax_loaditem/'+type+'/'+servers_id_active,
       topRatio: 0, 
    })

    return false;  
 }

 function show_event_level_topbar() {
     if ($('.wap_item_level_rank').height() > 0) {
         return false;
     }
     $(".overlay").show(1);
     hideTop();
     showHeight();
     var hei = 0;
     if ($('.wap_item_level_rank').height() == 0) {
         hei = 500;
     }
     $(".wap_item_level_rank").animate({
         height: hei
     }, 600);

 }


 function ajax_send_item_event_level(id){
    $.ajax({
         type: 'POST',
         url: root + 'event_item_level/send_item',
         data: 'id=' + id,
         success: function(data) {
           
         }

     });
 }


 $(document).ready(function() {




    $(".menutop_center .mn_content_menu li a").live('hover',function(e){
        var link = $(this).data('link');
        $(".mn_tab_content").hide();
        $(".menutop_center .mn_content_menu li").removeClass('active');
        $(this).parent().addClass('active');
        $("#"+link).show();
    });
});

 function insert_sv_cur(sid){
    $.post(
        root + 'servers/set_ser_cur',
            {
                sid: sid
            }
    );
}