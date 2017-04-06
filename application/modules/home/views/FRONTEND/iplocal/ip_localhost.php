<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Đăng nhập vào trang set ip</title>
	<script type="text/javascript" src="<?=PATH_URL?>static/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".enterpass").click(function(e){
				pass = $(".pass").val();
				if(pass == ''){
					alert("Điền Mật Khẩu");
				}

				$.ajax({
				    type: "POST",
					url: "<?=PATH_URL?>home/ajax_ip_localhost",
					data: "pass="+pass,
					dataType: "text",
				  	success: function(string){
				  		$("#ketqua").html(string);
				  	}
				})
			});
		})
	</script>
</head>
<style type="text/css">
	.pass{
		padding: 6px;
	}
</style>
<body>
<div>Nhập pass: </div>
<div><input value="" type="password" name="pass" placeholder="Điền Mật Khẩu" class="pass" /></div>
<input type="button" value="Gửi" class="enterpass" />
<div id="ketqua"></div>
</body>
</html>