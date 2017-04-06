function setConfirmUnload(on) {
    window.onbeforeunload = (on) ? unloadMessage : null;
}

function unloadMessage() {
    if(!user_login){
        setTimeout(function(){
           setConfirmUnload(false);
           location.href = root+'servers/created_user_play';
        },1000);

        return "Còn rất nhiều điều bí mật bạn chưa khám phá tại Hoàng Đồ Web.\r"+
        "- Bạn nhận được cơ hội sở hữu bộ VIPCODE trị giá 2.000.000 VNĐ.\r"+
        "- Trãi nghiệm rất nhiều điều thú vị tại Hoàng Đồ Web.\r"+
        "- Bạn có chắc thoát hay không?";
    }else{
        setTimeout(function(){
           setConfirmUnload(false);
           location.href = root+'vao-game';
        },1000);

        return "Còn rất nhiều điều bí mật bạn chưa khám phá tại Hoàng Đồ Web.\r"+
        "- Bạn nhận được cơ hội sở hữu bộ VIPCODE trị giá 2.000.000 VNĐ.\r"+
        "- Trãi nghiệm rất nhiều điều thú vị tại Hoàng Đồ Web.\r"+
        "- Bạn có chắc thoát hay không?";
    }
}

/*window.onload = function () {
    if (typeof history.pushState === "function") {
        history.pushState("jibberish", null, null);
        window.onpopstate = function () {
            history.pushState('newjibberish', null, null);
            setConfirmUnload(true);
        };
    } else {
        var ignoreHashChange = true;
        window.onhashchange = function () {
            if (!ignoreHashChange) {
                ignoreHashChange = true;
                window.location.hash = Math.random();
                setConfirmUnload(true);
            }
            else {
                ignoreHashChange = false;   
            }
        };
    }
}*/

function popup(option, url){
    if(!user_login){
        $.fancybox({
            href : '#account',
            padding : 0,
            beforeShow : function(){
                $('.fancybox-skin').css({'background':'none','box-shadow':'none'});
            },
            afterShow: function(){
                $('.fancybox-type-inline').css('top', '20px');
                $('.fancybox-close').css({top: '-6px',right: '-12px'});
            }
        });
    }else{
        if(option == 'giftcode'){
            $.fancybox({
                href : '#giftcode',
                padding : 0,
                scrolling: false,
                beforeShow : function(){
                    $('.fancybox-skin').css({'background':'none','box-shadow':'none'});
                },
                afterShow : function(){
                    $('.fancybox-close').css({top: '-18px',right: '-15px'});
                }
            });
        }
        else if(option == 'link'){
            window.open(root + url, '_blank');
        }else{
            // alert('Vui lòng quay lại vào lúc 14h ngày 24/02/2016 để trải nghiêm Game');
            alert('Bạn đã đăng nhập !');
        }
    }
}

$(document).ready(function() {
    if(user_login && (uri == '' || uri == 'trang-chu')){
        ///console.log("111");
        setTimeout(function(){
          popup('giftcode','');
        },100);
    }
    if(uri != 'facebook' && uri != 'facebooks'){
        setTimeout(function(){
            // setConfirmUnload(true);
        },200);      
    }
    if(uri != 'facebook' && uri != 'facebooks'){
        setTimeout(function(){
            $("body a").click(function(){
                // setConfirmUnload(false);
            })
        },1200);        
    }

    if(!user_login){
        if(uri=='dang-nhap' || uri=='dang-ky'){
            popup();
        }
    }

    /*Tab Tin tuc*/
    $('ul.Tab li').hover(function(){
        $('.a_tabnews').removeClass('Active');
        $(this).addClass('Active');
        var link = $(this).data('link');
        $('.ListNews').hide();
        $("#"+link).show();
    });
    /*Tab nhan vat*/
    $('.CharControl li').hover(function(){
        $('.nv_menu').removeClass('nv_active');    
        var id = $(this).data('link');
        $(this).addClass('nv_active');
        $('.Char').hide();
        $('#'+id).show();
    })

    if (window.history && window.history.pushState) {
        $(window).on('popstate', function() {
            var hashLocation = location.hash;
            var hashSplit = hashLocation.split("#!/");
            var hashName = hashSplit[1];

            if (hashName !== '') {
                var hash = window.location.hash;
                if (hash === '') {
                    // setConfirmUnload(true);
                }
            }
        });
        //./#forward
        window.history.pushState('forward', null, '');
      }

});
    $('.PlayNow').click(function(){
        if(!user_login){
            popup();
        }else{
           location.href = root+'vao-game';
        }
    })

    $('.s_xemthem').click(function(e) {
        $.fancybox({
            href : '#popserver',
            padding : 0,
            scrolling: false,
            beforeShow : function(){
                $('.fancybox-skin').css({'background':'none','box-shadow':'none'});
            },
            afterShow : function(){
                $('.fancybox-close').css({top: '0px',right: '14px'});
            }
        });
    });