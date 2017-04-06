<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta property="og:title" content="Maxgame Payment Portal" />
<meta property="og:description" content="Maxgame Payment Portal " />
<title>Login by social network Hoang Đồ Web</title>
<script type="text/javascript" src="<?=PATH_URL.'static/js/'?>jquery-1.8.1.min.js"></script>
<script type="text/javascript" src="<?php echo PATH_URL; ?>static/js/admin/jquery.url.js"></script>
<script type="text/javascript">
var root = '<?=PATH_URL?>';
queryString = $.url(window.location).attr('fragment');
	if(queryString!='' && $.url(window.location).fparam('state')){
		$.post(root+'user/login_openid?'+queryString,function(data){
			if(data=='SUCCESS'){
				 window.opener.location.reload();
				 window.close();
			}else{
				console.log(data);
			}
		});
	}else{
		$.post(root+'user/login_openid/fb?'+queryString, function(data) {
			if(data == 'SUCCESS'){
				window.opener.location.reload();
				window.close();
			}else{
				console.log(data);
			}
		});
	}

</script>

</head>

<body>

<p class="machi">Đang xử lý...</p>

</body>

</html>