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

<div id="indexView" class="table" style='margin: 0 0 10px;padding-bottom:10px'>
	<div class="clearAll"></div>
	<div class="wa-confi">
	<form id='frmStatus'>
			<p style='margin: 6px 0 8px 0;'>Server :
			<?php if($servers != null){ ?>
				<select id="server" name="server" style='margin: 0 0 0 34px;' onchange="changeType()">
				<?php
					foreach ($servers as $key => $value) { ?>
					<option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
				<?php } ?>
				</select>
			<?php } ?>
			</p>
			<input onclick="addItem()" type="button" value="Add Item" class="button_add_item">
			<div class="wap-add">
				<table class='level_item'>
					<tr>
						<th>STT</th>
						<th width='200px'>Vật phẩm<br><i>(cách nhau bởi dấu ",")</i></th>
						<th width='200px'>Số lượng<br><i>(cách nhau bởi dấu ",")</i></th>
						<th width='200px'>Level</th>
						<th width='200px'>Thao tác</th>
					</tr>
					<?php 
						$i = 1;
						foreach ($item as $key => $value) {
							$items = json_decode(unserialize($value->items));
							$sums =  json_decode(unserialize($value->sums));
					?>
					<tr class='level' id="div_<?php echo $i; ?>">
						<td class='level_name'><?php echo $i; ?></td>
						<td><input type="text" name="item[]" placeholder="id item"  value="<?php echo $items; ?>" ></td>
						<td><input type="text" name="number[]"  placeholder="number" value="<?php echo $sums; ?>" ></td>
						<td><input type="text" name="level[]"  placeholder="level" value="<?php echo $value->level;?>" ></td>
						<td><input class="detele_level" type="button" onclick="delItem(<?php echo $i; ?>)" value="Delete"></td>
					</tr>
					<?php $i++; }?>
				</table>
			</div>
			<div class="msg"></div>
			<input onclick="saveItem()" type="button" value="Save" class="button_add_item" >	
	</form>
	</div>
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
	<div id="ajax_loadContent"><img class="loading" alt="Ajax Loader" src="<?php echo PATH_URL.'static/images/admin/ajax-loader.gif'?>" /></div>
</div>

<script type="text/javascript">
	function saveItem(){
		$.ajax({
           type:'POST',
           dataType: "JSON",
           url: root+'newbie/save_status',
           data:$('#frmStatus').serialize(),
           cache: false,
                success: function(result){
                   if(result.status == 0){
                   		$('.msg').html(result.msg);
                   }else{
                   		$('.msg').html('Lưu thành công !!');
                   }
                }           
        });
        setTimeout(function(){
        	$('.msg').html('');
        },3000);
	}

	$('#time-begin').datetimepicker({
			format:'Y-m-d H:i:00',
	        allowTimes:[
	        	'00:00', '00:30', '01:00', '01:30', '02:00', '02:30', '03:00', '03:30',
	        	'04:00', '04:30', '05:00', '05:30', '06:00', '06:30', '07:00', '07:30',
	        	'08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00', '11:30',
	        	'12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30',
	        	'16:00', '16:30', '17:00', '17:30', '18:00', '18:30', '19:00', '19:30',
	        	'20:00', '20:30', '21:00', '21:30', '22:00', '22:30', '23:00', '23:59'
	        ]
		});
		$('#time-end').datetimepicker({
			format:'Y-m-d H:i:00',
	        allowTimes:[
	        	'00:00', '00:30', '01:00', '01:30', '02:00', '02:30', '03:00', '03:30',
	        	'04:00', '04:30', '05:00', '05:30', '06:00', '06:30', '07:00', '07:30',
	        	'08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00', '11:30',
	        	'12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30',
	        	'16:00', '16:30', '17:00', '17:30', '18:00', '18:30', '19:00', '19:30',
	        	'20:00', '20:30', '21:00', '21:30', '22:00', '22:30', '23:00', '23:59'
	        ]
		});
	function changeType(){
		var server = $('#server').val();
		$.ajax({
            type: "POST",
            url: root+'newbie/change_type',
            data: ({server: server}),
            success: function(e){
        	   	$('.wap-add').html(e);	
        	}
		});
	}

	function addItem(){
		//var z = 1;
		$('.wap-add table').each(function(){
			var z = $('.level_name:last').html();
			z++;
			html ="<tr class='level' id='div_'>"+
					"<td class='level_name'> </td>"+
					"<td><input type='text' name='item[]' placeholder='item id' value=''></td>"+
					"<td><input type='text' name='number[]' placeholder='number' value=''></td>"+
					"<td><input type='text' name='level[]' placeholder='level' value=''></td>"+
					"<td><input class='detele_level' style='padding:8px' type='button' onclick='delItem()' value='Delete'></td>"+
				"</tr>";
			$(this).append(html);
		})

		var x=1;
		$('.level_name').each(function(){
			$(this).text(x);
			x++;
		})
		
		var y=1;
		$('.detele_level').each(function(){
			$(this).attr('onclick','delItem('+y+')');
			y++;
		})

		var z=1;
		$('.level').each(function(){
			$(this).attr('id','div_'+z);
			z++;
		})
	}

	function delItem(id){
		$("#div_"+id).remove();
	}
</script>
<style>
.wa-confi{padding: 10px 20px;}
.button_add_item, .button_send_item{padding:3px 20px;margin: 8px 0 8px 0;}
.wap-add input{margin: 3px 4px;padding: 3px 5px !important;text-indent: 4px;}
#time-begin, #time-end{padding: 2px 4px;}
table.level_item{border-collapse: collapse;border-spacing: 0;}
table.level_item tr{border: 1px solid #000;}
table.level_item tr th{padding: 10px 20px;border: 1px solid #000;}
table.level_item tr td{border: 1px solid #000;text-align: center;padding: 6px 0;}
.msg_box {display: block; margin: 10px;}
</style>