$(document).ready(function() {
	$('.menu-item-left').hover(function(){
		$('.menu-item-left').removeClass('selected');
		var id = $(this).attr('data-id');
		$('.b-info').removeClass('box-selected');
		if($('#box-menu-l-'.id).hasClass('box-selected')){
			$('#box-menu-l-'+id).removeClass('box-selected');
		}else{
			$('#box-menu-l-'+id).addClass('box-selected');
		}
		$(this).addClass('selected');
	});
});