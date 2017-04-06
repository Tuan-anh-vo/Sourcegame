
$(document).ready(function(){
	$('.small-slide').bxSlider({
		auto:true,
		pager:false,
		controls:false
	});	
	$('.big-slide').bxSlider({
		auto:true,
		pager:false,
		controls:false,
	});
	$('.main-slide .bx-wrapper img').css({
		border:'none',
		width:'90% !important'
	});
	$('.main-slide .bx-wrapper').css({
		margin: '2.2% auto'		
	});
	
	$('.arrow-pre').click(function(){		
		$( ".wrap_frameui" ).animate({ "width": "0%"}, "slow" );			
		$('.arrow-pre').css('display', 'none');
		$('.arrow-next').css('display', 'block');
		$( ".server-playgame" ).animate({ "width": "100%" }, "slow" );
		// $( ".server-playgame" ).css('width', '91.3%');
	});
	$('.arrow-next').click(function(){
		$( ".wrap_frameui" ).animate({ "width": "8.7%" }, "slow" );			
		$('.arrow-next').css('display', 'none');
		$('.arrow-pre').css('display', 'block');
		$( ".server-playgame" ).animate({ "width": "91.3%" }, "slow" );

	});

});