$(function(){
	
	$('.contain-table table td a').click(function(){
		$(this).parent().addClass('diemdanh');
		return false;
	});


   $(".yt-tab a").click(function(event) {
            event.preventDefault();
            $(this).parent().addClass("active");
            $(this).parent().siblings().removeClass("active");
            var tab = $(this).attr("href");
            $(".youtube-embed").not(tab).css("display", "none");
            $(tab).fadeIn();
        });
   $(".info-tab-nv a").click(function(event) {
            event.preventDefault();
            $(this).parent().addClass("active");
            $(this).parent().siblings().removeClass("active");
            var tab = $(this).attr("href");
            $(".info-nvv").not(tab).css("display", "none");
            $(tab).fadeIn();
        });
   $(".info-tab-nv1 a").click(function(event) {
            event.preventDefault();
            $(this).parent().addClass("active");
            $(this).parent().siblings().removeClass("active");
            var tab = $(this).attr("href");
            $(".info-nvv2").not(tab).css("display", "none");
            $(tab).fadeIn();
        });
   $(".info-tab-nv2 a").click(function(event) {
            event.preventDefault();
            $(this).parent().addClass("active");
            $(this).parent().siblings().removeClass("active");
            var tab = $(this).attr("href");
            $(".info-nvv3").not(tab).css("display", "none");
            $(tab).fadeIn();
        });


    $('a[href*=#s]:not([href=#])').click(function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top
                }, 1000);
                return false;
            }
        }
    });
	
});




$(function() {
    var $galitem = $('.neoslideshow').children();
    // ƒê·∫øm cA°c ·∫£nh trong gallery
    var $galsize = $('.neoslideshow .item-info-nv').size();
    // ThA™m nA∫t Prev vA  Next vA o gallery
    $('.neoslideshow').append('<div id="galprev">Prev</div><div id="galnext">Next</div>');
    // ·∫®n t·∫•t c·∫£ cA°c ·∫£nh vA  hi·ªán ·∫£nh ƒë·∫ßu tiA™n
    $('.neoslideshow .item-info-nv:gt(0)').hide();
    $currentimg = 0;
    // ThA™m id ƒë·ªÉ phA¢n bi·ªát riA™ng t·ª´ng ·∫£nh
    $galitem.attr("id", function (arr) {
        return "galleryitem" + arr;
    });
    
    // ThA™m s·ª± ki·ªán click vA o nA∫t Prev
    $('#galprev').click(function () { 
        if ($currentimg > 0) {
            previmg($currentimg);
            $currentimg = $currentimg - 1;
        }
    });
    // ThA™m s·ª± ki·ªán click vA o nA∫t Next
    $('#galnext').click(function () { 
        if ($currentimg < $galsize - 1) {
            nextimg($currentimg, $galsize);
            $currentimg = $currentimg + 1;
        }
    });
})

// HA m x·ª≠ lAΩ khi nA∫t Next ƒë∆∞·ª£c ·∫•n
function nextimg($img, $size) {
    $n_img = $img + 1;
    if ($n_img < $size) {
        $('#galleryitem' + $img).fadeOut();
        $('#galleryitem' + $n_img).fadeIn();
    }
}
// HA m x·ª≠ lAΩ khi nA∫t Previous ƒë∆∞·ª£c ·∫•n
function previmg($img) {
    $p_img = $img - 1;
    if ($p_img >= 0) {
        $('#galleryitem' + $img).fadeOut();
        $('#galleryitem' + $p_img).fadeIn();
    }
}

function windowHeight() {
    return $(window).height();
}
function windowWidth() {
    return $(window).width();
}

function documentHeight() {
    return $(document).height();
}

function documentWidth() {
    return $(document).width();
}