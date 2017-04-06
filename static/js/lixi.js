$(document).ready(function(){
	$('.alixi').click(function(){
		$.post(root + 'lixi/getlixi', function(data){
			$('.xluot font').text(data.count);
			$('#table').html(data.table);
			if(data.count == 0){
				alert('Bạn đã hết lượt may mắn, vui lòng nạp thẻ để tiếp tục nhé bạn.');
			}
		}, 'JSON');
	});
	$('.chuyenqua').click(function(){
		var server = $('.selectsv').val();
		$.post(root + 'lixi/senditem', 'server=' + server, function(data){
			if(data.msg == 'ok'){
				$('#table tbody').html('<tr class="title"><th>vật phẩm</th><th>hình ảnh</th><th>số lượng</th></tr><tr><td></td><td></td><td></td></tr>');
				alert('Quà của bạn đã được chuyển vào game.\r Vui lòng đợi trong giây lát và kiểm tra túi hành trang bạn nhé.');
			}else{
				alert(data.msg);
			}			
		}, 'JSON');
	});
});