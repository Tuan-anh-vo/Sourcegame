<script type="text/javascript" src="<?=PATH_URL.'static/js/admin/jquery.slugit.js'?>"></script>
<script type="text/javascript">
$(document).ready(function(){
 $("#expired_dateAdmincp").datepicker({
  changeMonth : true,
  changeYear : true,
  minDate : '+1D',
  dateFormat : "dd-mm-yy",
  yearRange : "2012:2050"
 });
 chooseType();
});


function save(){
	var options = {
		beforeSubmit:  showRequest,  // pre-submit callback
		success:       showResponse  // post-submit callback
    };
	$('#frmManagement').ajaxSubmit(options);
}


function showRequest(formData, jqForm, options) {
	var form = jqForm[0];
	if(form.titleAdmincp.value == ''){
		$('#txt_error').html('Please enter information!!!');
		$('#loader').fadeOut(300);
		show_perm_denied();
		return false;
	}
	if(form.prefixAdmincp.value.length < 4){
		$('#txt_error').html('Tiền tố phải dài hơn 4 ký tự!');
		$('#loader').fadeOut(300);
		show_perm_denied();
		return false;
	}
}

function showResponse(responseText, statusText, xhr, $form) {
	if(responseText=='success'){
		location.href=root+"admincp/"+module+"/#/save";
	}
	if(responseText=='error-item'){
		$('#txt_error').html('Item và số lượng không được bỏ trống!');
		$('#loader').fadeOut(300);
		show_perm_denied();
		$('#row_items').focus();
		return false;
	}
	if(responseText=='error-title-exists'){
		$('#txt_error').html('Tên code đã tồn tại!');
		$('#loader').fadeOut(300);
		show_perm_denied();
		$('#titleAdmincp').focus();
		return false;
	}
	if(responseText=='error_quality'){
		$('#txt_error').html('Bạn muốn tạo số lượng bao nhiêu?');
		$('#loader').fadeOut(300);
		show_perm_denied();
		$('#quality').focus();
		return false;
	}

	if(responseText=='error-prefix-exists'){
		$('#txt_error').html('Tiền tố đã tồn tại!');
		$('#loader').fadeOut(300);
		show_perm_denied();
		$('#prefixAdmincp').focus();
		return false;
	}

	if(responseText=='error-invalid-date'){
		$('#txt_error').html('Thời gian đổi ít nhất là 2 ngày !');
		$('#loader').fadeOut(300);
		show_perm_denied();
		$('#expired_dateAdmincp').focus();
		return false;
	}
	if(responseText == 'error-server'){
		$('#txt_error').html('Vui lòng chọn server để nhận code');
		$('#loader').fadeOut(300);
		show_perm_denied();
		return false;
	}

	if(responseText=='permission-denied'){
		show_perm_denied();
	}
}
var uri = window.location.href;
function searchGift(){
	var gift = $('#inp_key').val();
	var cells = $('.gift-code');
	cells.css('color','#000').css('font-weight','normal');
	cells.attr('id','');
	if(gift == ''){
		alert('Please enter gift code to search!');
		return;
	}

	var size = cells.size();
	var flag = false;
	for(i = 0; i < size; i++){
		var cell = cells.eq(i);
		if(cell.text() == gift){
			cell.attr('id','found');
			flag = true;
			break;
		}
	}
	if(flag){
		cell.css('color','blue').css('font-weight','bold');
		$('html, body').animate({
			scrollTop: cell.offset().top - 100
		}, 1000);
		// window.location.href = uri + '#found';
	}
	else{
		alert('Gift code not found!');
	}

}

function chooseType(){
	if($('#typeAdmincp').val() == "VIP Code"){
		$('#config-item').show();
	}
	else{
		$('#config-item').hide();
	}
}

function addNe(){
	var appendStr = '<div style="margin-top:5px"><label>Item ID: </label>'+
							'<input style="width:200px" type="text" name="itemId[]" />'+
							'<label>Số lượng </label>'+
							'<input style="width:200px" type="text" name="itemQuantity[]" /></div>';
	$('#row_items').append(appendStr);
}
</script>
<div class="gr_perm_error" style="display:none;">
	<p><strong>FAILURE: </strong><span id="txt_error">Permission Denied.</span></p>
</div>
<div class="table">
	<div class="head_table"><div class="head_title_edit"><?=$module?></div></div>
	<div class="clearAll"></div>

	<form id="frmManagement" action="<?=PATH_URL.'admincp/'.$module.'/save/'?>" method="post" enctype="multipart/form-data">
	<input type="hidden" value="<?=$id?>" name="hiddenIdAdmincp" />

	<div class="row_text_field_first">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Trạng thái:</td>
				<td class="right_text_field"><input <?php if(isset($result->status)){ if($result->status==1){ ?>checked="checked"<?php }}else{ ?>checked="checked"<?php } ?> type="checkbox" class="custom_chk" name="statusAdmincp" /></td>
			</tr>
		</table>
	</div>

	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Loại code:</td>
				<td class="right_text_field">
					<select onchange="chooseType()" <?php if(isset($result->type)) print 'disabled="disabled"'; ?> name="typeAdmincp" id="typeAdmincp">
						<option <?php if(isset($result->type)) if($result->type == 'Gift Code') print "selected=\"selected\"";?> value="Gift Code">Gift Code</option>
						<option <?php  if(isset($result->type)) if($result->type == 'VIP Code') print "selected=\"selected\"";?> value="VIP Code">VIP Code</option>
					</select>
				</td>
			</tr>
		</table>
	</div>
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Cách trao code:</td>
				<td class="right_text_field">
					<select onchange="chooseMethod()" <?php if(isset($result->method)) print 'disabled="disabled"'; ?> name="methodAdmincp" id="methodAdmincp">
						<option <?php if(isset($result->method)) if($result->method == 1) print "selected=\"selected\"";?> value="1">Trong website</option>
						<option <?php  if(isset($result->method)) if($result->method == 2) print "selected=\"selected\"";?> value="2">Trên truyền thông</option>
					</select>
				</td>
			</tr>
		</table>
	</div>
	<?php if(!$id){?>
	<div class="row_text_field soluong" style="display: none;">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Số lượng:</td>
				<td class="right_text_field">
					<input type="text" name="quality" id="quality">
				</td>
			</tr>
		</table>
	</div>
	<?php }?>

	<div id="config-item" style="display:none">
		<div class="row_text_field" >
			<table cellspacing="0" cellpadding="0" border="0" width="100%">
				<tr>
					<td class="left_text_field">
						Item của Gift Code
					</td>
					<td class="right_text_field">
						<div id="row_items">
							<?php
							$list_item = isset($result->list_item) ? json_decode($result->list_item) : '';
							// pr($list_item,1);
							if(empty($list_item)){
							?>
							<div class="f_row" >
								<label>Item ID: </label>
								<input style="width:200px" type="text" name="itemId[]" />
								<label>Số lượng </label>
								<input style="width:200px" type="text" name="itemQuantity[]" />
								<input style="padding:8px" type="button" onclick="addNe()" id="addItem" value="Add"/>
							</div>
							<?php
							}
							else{
								$i = 0;
								$list_item->id = !empty($list_item->id) ? $list_item->id : array();
								foreach($list_item->id as $key => $item){
									if(!empty($list_item->quantity[$key]) & !empty($item)){
							?>
								<div style="margin-top:5px">
									<label>Item ID: </label>
									<input style="width:200px" type="text" name="itemId[]" value="<?=$item?>"/>
									<label>Số lượng </label>
									<input style="width:200px" type="text" name="itemQuantity[]" value="<?=$list_item->quantity[$key]?>"/>
									<?php if($i == 0){ ?>
									<input style="padding:8px" type="button" onclick="addNe()" id="addItem" value="Add"/>
									<?php
										$i++;
									} ?>
								</div>
								<?php
									}
									// $i++;
								}
								if($i == 0){ ?>
								<div class="f_row" >
									<label>Item ID: </label>
									<input style="width:200px" type="text" name="itemId[]" />
									<label>Số lượng </label>
									<input style="width:200px" type="text" name="itemQuantity[]" />
									<input style="padding:8px" type="button" onclick="addNe()" id="addItem" value="Add"/>
								</div>
								<?php
								}
							?>

							<?php
							}
							?>
						</div>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Tiền tố code:</td>
				<td class="right_text_field"><input <?php if(isset($result->prefix)) print 'disabled="disabled"'; ?> value="<?php if(isset($result->prefix)) { print $result->prefix; }else{ print '';} ?>" type="text" name="prefixAdmincp" id="prefixAdmincp" /></td>
			</tr>
		</table>
	</div>

	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Tên của code:</td>
				<td class="right_text_field"><input value="<?php if(isset($result->title)) { print $result->title; }else{ print '';} ?>" type="text" name="titleAdmincp" id="titleAdmincp" /></td>
			</tr>
		</table>
	</div>

	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Ngày hết hạn:</td>
				<td class="right_text_field"><input value="<?php if(isset($result->expired_date)) { print date('d-m-Y',$result->expired_date); }else{ print date('d-m-Y');} ?>" type="text" name="expired_dateAdmincp" id="expired_dateAdmincp" /></td>
			</tr>
		</table>
	</div>
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Nhận nhiều lần:</td>
				<td class="right_text_field"><input type="checkbox" <?php if(isset($result->many)) if($result->many) print "checked";?> name="many-set"/></td>
			</tr>
		</table>
	</div>
	<div class="row_text_field">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Nhận nhiều server:</td>
				<td class="right_text_field">
					<select name="many-server" id="many-server">
						<option value="1">Nhận nhiều server</option>
						<option value="0">Nhận 1 server</option>
					</select>
				</td>
			</tr>
		</table>
	</div>
	<?php
		if($servers){
			echo '<div class="row_text_field" id="mny-server">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Server nhận:</td><td>';
			echo '<ul>';
			echo '<li><input type="checkbox" id="chec" name="" value="0" class="server-promotion">Tất cả</li>';
			foreach ($servers as $key => $value) {?>
					<li><input name="adminserver[]" type="checkbox" id='check_server<?php echo $value->id;?>' value='<?php echo $value->id;?>' class="server-promotion single"><?php echo $value->name;?></li>
			<?php }
			echo '</ul>';
			echo '</td></tr>
		</table>
	</div>';
		}
	?>
	<?php
		if($servers){
		echo '<div class="row_text_field" id="one-server" style="display: none;">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td class="left_text_field">Server nhận:</td>
				<td class="right_text_field">';
				echo '<select name="multiple-server"><option value="0">Chon server</option>';
				foreach ($servers as $key => $value) {
					echo '<option value="'.$value->id.'">'.$value->name.'</option>';
				}
				echo '</select>';
			echo '</td></tr>
		</table>
	</div>';}
	?>
	</form>
</div>
<style type="text/css">
	.row_text_field ul li{width: 50%; float: left; height: 24px; line-height: 24px;}
</style>
<script type="text/javascript">
	$('#chec').click(function(event) {
		if($("#chec").is(':checked')){
			$(".server-promotion").attr('checked', true);
			}
		else{
			$(".server-promotion").attr('checked', false);
		}
	});
	function check(id){
		$('#check_server'+id).attr('checked','checked');
		var da_check = $('.server-promotion.single:checked').size();
		var total = <?=count($servers)?>;
		if(da_check == total)
			$('#chec').attr('checked','checked');
	}
	function chooseMethod(){
		var method = $('#methodAdmincp').val();
		if(method == 2){
			$('.soluong').show();
		}else{
			$('.soluong').hide();
		}
	}
	$(document).ready(function() {
		<?php
		if($id){
			$abc = explode('|', $result->servers);
			foreach ($abc as $key => $value) {
				echo 'check('.$value.');';
			}
		}
		?>
		$( "#many-server" ).change(function() {
		  	var many_server = $('#many-server').val();
		  	if(many_server == 0){
		  		$('#one-server').toggle("slow");
		  		$('#mny-server').toggle("slow");
		  	}
		  	else{
		  		$('#one-server').toggle("slow");
		  		$('#mny-server').toggle("slow");
		  	}
		});
	});
</script>