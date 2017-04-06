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
			<p>Thời gian bắt đầu: <input type="text" value="<?php if(isset($startdate)) echo $startdate; ?>" name="time-begin" id="time-begin"></p>
			<p style='margin: 6px 0 8px 0;'>Thời gian kết thúc: <input type="text" value="<?php if(isset($enddate)) echo $enddate; ?>"  name="time-end" id="time-end"></p>

			<label><input checked="checked" type="radio" name="enable" value="1" >Bật</label>
			<label><input <?php if($enable==0) echo "checked='checked'"; ?>	type="radio" name="enable" value="0" >Tắt</label><br/>

		<div class="clear"></div>
		<input onclick="addItem()" type="button" value="Add Item" class="button_add_item" >

			<div class="wap-add">
				<?php foreach ($item as $key => $value) {  ?>
				<div id="div_<?=$key?>">
					<span><?php echo $key; ?></span>
					<input type="text" name="name_item[]" placeholder="Tên item"  value="<?php if(isset($value['name_item'])) echo $value['name_item']; ?>" >
					<input type="text" name="item[]" placeholder="id item"  value="<?php echo $value['item']; ?>" >
					<input type="text" name="number[]"  placeholder="number" value="<?php echo $value['number']; ?>" >
					<input type="text" name="percent[]" placeholder="tỷ lệ"  value="<?php echo $value['percent']; ?>" >
					<input style="padding:8px" type="button" onclick="delItem(<?=$key?>)" value="Delete"/>
					<font></font>
					<div class="clear"></div>
				</div>
				<?php }  ?>
			</div>
			<div class="msg"></div>
			<input onclick="saveItem()" type="button" value="Save" class="button_add_item" >	
			<input onclick="cleardata()" type="button" value='Clear all data' class="button_add_item">
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
	<div id="ajax_loadContent"><img class="loading" alt="Ajax Loader" src="<?=PATH_URL.'static/images/admin/ajax-loader.gif'?>" /></div>
</div>

<script>
	function cleardata() {
		console.log('hihi');
	    var x=window.confirm("Bạn có chắc muốn xóa tất cả dữ liệu không?");
		if (x){
		    // window.alert("Good!")
		    $.ajax({
		    	type : 'POST',
		    	dataType : 'JSON',
		    	url: root + 'daptrung_config/clear_data',
		    	data: 'allow=1',
		    	cache : false,
		    	success:function(result){
		    		if(result.status == 1){
		    			window.alert("Bạn đã xóa thành công dữ liệu, bạn có thể chạy lại event này !")
		    		}
		    	}
		    });

		}else{
		    // window.alert("Too bad")
		}
	}
	
	function delItem(id){
		$("#div_"+id).remove();
	}

	function saveItem(){
		if($('#time-begin').val() == '' || $('#time-end').val() == ''){
			$('.msg').html('Vui lòng nhập đầy đủ ngày tháng !!');
		}else{
			$.ajax({
	           type:'POST',
	           dataType: "JSON",
	           url: root+'daptrung_config/save_status',
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
        }

        setTimeout(function(){
        	$('.msg').html('');
        },3000);
	}

	setInterval(function(){
		var i=1;
		$('.wap-add span').each(function(){
			$(this).text(i);
			i++;
		})
	},500)

	function addItem(){
		var html='<div id=""><span>1</span><input type="text" name="name_item[]" placeholder="Tên item" value="" ><input type="text" name="item[]" placeholder="id item"  value="" ><input type="text" name="number[]"  placeholder="number" value="" ><input type="text" name="percent[]" placeholder="Tỷ lệ"  value="" ><input style="padding:8px" type="button" onclick="" value="Delete"/><div class="clear"></div></div>';
		$('.wap-add').append(html);
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

</script>
<style>
.wa-confi{padding: 10px 20px;}
.button_add_item{padding:3px 20px;margin: 8px 0 8px 0;}
.wap-add input{margin: 3px 4px;padding: 0px !important;width: 15%;text-indent: 4px;}
#time-begin, #time-end{padding: 2px 4px;}
</style>