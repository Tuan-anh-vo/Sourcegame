<script src="<?php echo PATH_URL?>static/js/jquery.datetimepicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo PATH_URL?>static/css/jquery.datetimepicker.css"/>

<input type="hidden" value="<?php ($this->session->userdata('start'))? print $this->session->userdata('start') : print 0 ?>" id="start" />
<input type="hidden" value="<?=$default_func?>" id="func_sort" />
<input type="hidden" value="<?=$default_sort?>" id="type_sort" />
<div class="gr_perm_error" style="display:none;">
	<p><strong>FAILURE: </strong>Permission Denied.</p>
</div>
<div class="gr_perm_success" style="display:none;">
	<p><strong>SAVE SUCCESS.</strong></p>
</div>

<div id="indexView" class="table">
	<div class="head_table">
		<div class="head_title_table"><?=$module_name?></div>
		<div class="head_search">
			<div class="head_search_title fontface" style="margin-top: 9px">Search | </div>
			<div class="head_search_title">From:</div>
			<div class="head_search_input"><input onkeypress="return enterSearch(event)" id="caledar_from" type="text" /></div>
			<div class="head_search_title">To:</div>
			<div class="head_search_input"><input onkeypress="return enterSearch(event)" id="caledar_to" type="text" /></div>
			<div class="head_search_title">Content:</div>
			<div class="head_search_input"><input onkeypress="return enterSearch(event)" id="search_content" onclick="if(this.value=='type here...'){this.value=''}" onblur="if(this.value==''){this.value='type here...'}" class="input_last" type="text" value="type here..." /><div onclick="searchContent(0)" class="bt_search"><img alt="Button search" src="<?=PATH_URL.'static/images/admin/icons/searchSmall.png'?>" /></div></div>
		</div>
	</div>
	<div class="clearAll"></div>
	<div id="ajax_loadContent"><img class="loading" alt="Ajax Loader" src="<?=PATH_URL.'static/images/admin/ajax-loader.gif'?>" /></div>
</div>

<div id="indexView" class="table" style='margin-top: 10px;padding-bottom:10px'>
	<div class="clearAll"></div>
	<div class="wa-confi">
	<form id='frmSend'>
		<table class='level_item'>
			<tr>
				<th width='200px'>Username</th>
				<th width='200px'>Server</th>
				<th width='200px'>Số Tiền</th>
				<th width='200px'>Gửi</th>
			</tr>
			<tr class="level">
				<td><input type="text" name="username" id="username" placeholder="username"></td>
				<td>
					<select id="server" name="server">
					<?php foreach ($servers as $key => $value) {?>
						<option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
					<?php }?>
					</select>
				</td>
				<td>
					<input type="text" name="money" id="money" placeholder="money">
				</td>
				<td>
					<input onclick="sendTichLuy()" type="button" value="Gửi" class="button_send_item" >	
				</td>
			</tr>
			
		</table>
		<div class="msg_box"></div>
		
	</form>
	</div>
</div>

<style type="text/css">
	table.level_item tr {
	    border: 1px solid #000;
	}
	table.level_item tr th {
	    padding: 10px 20px;
	    border: 1px solid #000;
	}
	table.level_item tr td {
	    border: 1px solid #000;
	    text-align: center;
	    padding: 6px 0;
	}
	table.level_item tr td input {
		height: 28px;
		line-height: 28px;
		padding: 0px 10px;
	}
	table.level_item tr td select {
		height: 28px;
		line-height: 28px;
		padding: 0px 10px;
	}
	.button_send_item {
	    padding: 3px 20px;
	    margin: 8px 0 8px 0;
	}
	.wa-confi {
	    padding: 10px 20px;
	}
	table.level_item {
	    border-collapse: collapse;
	    border-spacing: 0;
	}
	.msg_box {
		font-size: 15px;
		margin-top: 10px;
	}
</style>
<script type="text/javascript">
	function sendTichLuy(){
		if($('#username').val() == ''){
			$('.msg_box').html('Vui lòng nhập username !!');
		}else{
			$.ajax({
	           type:'POST',
	           dataType: "JSON",
	           url: root+'tichluy/sendTichLuy',
	           data:$('#frmSend').serialize(),
	           cache: false,
	                success: function(result){
	                   if(result.status == 0){
	                   		$('.msg_box').html(result.msg);
	                   }else{
	                   		$('.msg_box').html('Gửi thành công !!');
	                   }
	                }           
	        });
        }

        setTimeout(function(){
        	$('.msg_box').html('');
        },3000);
	}
</script>