<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

 <div style="width: 100%; float: left; margin: 40px 0 0">
	<div class="container">
	  <h2>Nạp lại card</h2>
	  <p class='kq'></p>
	  <form class="form-inline" role="form" id='form-resend'>
	  	<div class="container">
	    <div class="form-group">
	      <label >Tên tài khoản:</label>
	      <input type="text" class="form-control username" name="username" placeholder="Tên tài khoản">
	    </div>
	    <div class="form-group">
	      <label>Số tiền:</label>
	      <input type="text" class="form-control" name='card_amount' placeholder="Số tiền">
	    </div>
	    <div class="form-group">
	       	<label>Số Serial:</label>
	      	<input type="text" class="form-control" name='card_serial' placeholder="Số serial">
	    </div>
	    <div class="form-group">
	       	<label>Mã pin:</label>
	      	<input type="text" class="form-control" name='card_pin' placeholder="Mã pin">
	    </div>
	    </div>
	    <div class="container" style='margin-top: 10px'>
	    <div class="form-group">
	       	<label>Cổng thanh toán:</label>
	      	<select name="pay_method" class='form-control'>
	      		<option value="baokim">Bản kim</option>
	      		<option value="paydirect">Paydirect</option>
	      	</select>
	    </div>
	    <div class="form-group">
	       	<label>Chọn nhà mạng:</label>
	      	<select class="form-control" name="card_type">
                <option value="">-- Chọn nhà mạng --</option>
                <option value="MOBIFONE">-- MOBIFONE --</option>
                <option value="VINAPHONE">-- VINAPHONE --</option>
                <option value="VIETTEL">-- VIETTEL --</option>
                <option value="GATE">-- GATE --</option>
             </select>
	    </div>
	    <div class="form-group">
	       	<label>Máy chủ:</label>
	      	<select name="server_id" class='form-control server'>
	      		<option value="0">Chọn server</option>
	      		<?php foreach($servers as $value){?>
	      			<option value="<?php echo $value->id;?>"><?php echo $value->name;?></option>
      			<?php }?>
	      	</select>
	    </div>
	    <button type="button" class="btn btn-default btn-submit">Nạp thẻ</button>
	    </div>
	  </form>
	</div>
</div>

<div id="indexView" class="table" style="float: left">
	<input type="hidden" value="<?=$default_func?>" id="func_sort" />
	<input type="hidden" value="<?=$default_sort?>" id="type_sort" />
	<div class="head_table">
		<div class="head_title_table"><?=$module_name?></div>
		<div class="head_search">
			<div class="head_search_title fontface" style="margin-top: 9px">Search | </div>
			<div class="head_search_title">From:</div>
			<div class="head_search_input"><input onkeypress="return enterSearchDonate(event)" id="caledar_from" type="text" /></div>
			<div class="head_search_title">To:</div>
			<div class="head_search_input"><input onkeypress="return enterSearchDonate(event)" id="caledar_to" type="text" /></div>
			<div class="head_search_title">Content:</div>
			<div class="head_search_input"><input onkeypress="return enterSearchDonate(event)" id="search_content" onclick="if(this.value=='type here...'){this.value=''}" onblur="if(this.value==''){this.value='type here...'}" class="input_last" type="text" value="type here..." /><div onclick="searchContentDonate(0)" class="bt_search"><img alt="Button search" src="<?=PATH_URL.'static/images/admin/icons/searchSmall.png'?>" /></div></div>
		</div>
	</div>
	<div class="clearAll"></div>
	
	<div id="ajax_loadContent">
		<div class="content_table">
			<table cellspacing="0" cellpadding="0" border="0" width="100%">
				<tbody>
					<tr>
						<th class="th_no_cursor" width="40">No.</th>
						<th class="th_no_cursor" width="31"><input type="checkbox" class="custom_chk" id="selectAllItems" onclick="selectAllItems(1)"></th>
						<th class="th_left" onclick="sort('username')"><div id="username" class="sort icon_no_sort">Username</div></th>
						<th class="th_left" onclick="sort('card_pin')"><div id="card_pin" class="sort icon_no_sort">Mã Thẻ</div></th>
						<th class="th_left" onclick="sort('card_serial')"><div id="card_serial" class="sort icon_no_sort">Seri Thẻ</div></th>
						<th class="th_left" onclick="sort('card-type')"><div id="type_card" class="sort icon_no_sort">Loại Thẻ</div></th>
						<th class="th_left" onclick="sort('card_amount')"><div id="card_amount" class="sort icon_no_sort">Mệnh Giá Thẻ</div></th>
						<th class="th_left" onclick="sort('gamecoin')"><div id="gcoin" class="sort icon_no_sort">KNB</div></th>
						<th width="100" onclick="sort('created')"><div id="created" class="sort icon_sort_asc">Time</div></th>
						<th width="100" onclick="sort('server_id')"><div id="created" class="sort icon_sort_asc">Server</div></th>
						<th class="th_left" onclick="sort('payfrom')"><div id="server" class="sort icon_no_sort">Loại Giao Dịch</div></th>
						<th class="th_left" onclick="sort('payment_type')"><div id="server" class="sort icon_no_sort">Ví Tiền</div></th>
						<th class="th_last" onclick="sort('step')"><div id="step" class="sort icon_no_sort">Trạng Thái</div></th>				
					</tr>
					<tr class="row1">
						<td class="th_last td_center" colspan="50" style="font-size: 20px; padding: 50px 0">No data</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	var root = '<?=PATH_URL?>';
	$( document ).ready(function() {
	    $('.btn-submit').click(function(){
	    	$.ajax({
			    type:"POST",
		        url: root+'donate_report/processResend',
		        data: $('#form-resend').serialize(),
		        success: function(response){
		        	var msg = response.substring(1);
		        	$('.kq').html(msg)
		            if(response.substring(0,1) == 1){
		            	var username = $('.username').val();
		            	$('#search_content').attr('value', username);
		            	setTimeout(function(){
		            		$('.bt_search').trigger('click');
		            	},500);
		            }
		        }
			});
	    })
	});
</script>