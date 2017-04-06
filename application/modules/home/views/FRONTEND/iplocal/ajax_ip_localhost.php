<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Trang Set Ip Local Host</title>
<div> Is Local:</div>
<form id="frm_ip"method="post">
<div id="row_items">
	<input style="padding:8px" type="button" onclick="addNe()" id="addItem" value="Add"/><br>
	<?php if($result){ foreach ($result as $key => $value) {?>
	<div id="ip_<?=$key?>">
		<input style="width: 800px;padding: 6px 8px;" value='<?php echo $result[$key]?>'  type="text" name="ip_localhost[]" /><input style="padding:8px" type="button" onclick="delItem(<?=$key?>)" value="Delete"/><br>
	</div>
	<?php } }?>

</div>
<input type="button" id="save_ip" value="Lưu" />
</form>
<div id="ketqua_ip"></div>
<script src="<?=PATH_URL?>static/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#save_ip").click(function(e){
		$.ajax({
		    type: "POST",
			url: "<?=PATH_URL?>home/save_ip_localhost",
			data: $("#frm_ip").serialize(),
			dataType: "text",
		  	success: function(string){
		  		if(string == 1){
		  			$("#ketqua_ip").html("Bạn vừa mới thay đổi thành công địa chỉ ip local");
		  			settime();
		  		}else{
		  			$("#ketqua_ip").html("Thay đổi thất bại, vui lòng thử lại");
		  			settime();
		  		}
		  	}
		})
	});
})

function settime(){
	setTimeout(function(){
        $("#ketqua_ip").html("");
    },1000);
}

function delItem(id){
	$("#ip_"+id).remove();
}
function addNe(){
	var appendStr = "<div id=''><input style='width: 800px;padding: 6px 8px;'' value=''  type='text' name='ip_localhost[]' /><input style='padding:8px' type='button' value='Delete'/><br></div>";
	$('#row_items').append(appendStr);
}

</script>