var hosts = document.location.hostname;
window.fbAsyncInit = function() {
		FB.init({appId: '173614419638019',cookie: true,status: true, xfbml: true});
	}
$(document).ready(function(){

	if(user_login){
		//--- Tab giftcode

		//--- Giftcode share facebook
		$('.save-plugin').click(function(){
		    var msg = [];
		    msg[0] = 'Hoàng Đồ Web';
		    msg[1] = 'Hoàng Đồ Web';
		    msg[2] = 'Hoàng Đồ Web';
		    var img_f = [];
		    img_f[0] = root + 'static/fanpage/sharefb.png';
		    img_f[1] = root + 'static/fanpage/sharefb.png';
		    img_f[2] = root + 'static/fanpage/sharefb.png';
		    //-------------
		    FB.ui({
		        method: 'feed',
		        name: msg[1], //Math.floor((Math.random() * 3) + 1)
		        link: 'http://hoangdoweb.com/',
		        picture: img_f[Math.floor((Math.random() * 2) + 1)], //Math.floor((Math.random() * 2) + 1)
		        caption: 'Hoàng Đồ Web',
		        description: 'Hoàng Đồ Web với hàng loạt tính năng và hoạt động mới, giúp người chơi trải nghiệm thích thú.',
		        message: 'Tham Gia Ngay Nào'
		    }, function(response) {
		        if (response != "" && response != null) {
		        	//--- Request server
				    $.post(root + 'gift/giftcode_plugin', { type: 34 }, function(result) {
				        if (result == 0) location.href = root + 'dang-nhap';
				        else {
				        	setConfirmUnload(false);
				        	location.href = root;
				        }
				    });
				}
		    });
		});
        //--- giftcode email
		$('.send-email').on('click', function(e) {
			e.preventDefault();
			var email = $('#email-code').val();
	        sendMailGiftCode(email);
		});
	}
});
function sendMailGiftCode(email){
    $.post(
        root + 'user/sendMailGiftCode',{ email : email},
          function (result) {
          	console.log(result);
            $('.kq-mail').html(result);
    });
}