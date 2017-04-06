$(document).ready(function() {
    //Top
    $('a.top').click(function(){
        $('html, body').animate({scrollTop:0}, 'slow');
    });
	
	// SLIDE
	$('.bxslidetop').bxSlider({auto:true});

	// SIDEBAR

	  $(".date li a").hover(function(e){
    var link = $(this).data('link');
    $(".r_content").hide();
    $(".date li").removeClass('active');
    $(this).parent().addClass('active');
    $("#"+link).show();

  });
});