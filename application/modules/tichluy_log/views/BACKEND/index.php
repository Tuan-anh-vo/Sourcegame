<script src="<?php echo PATH_URL?>static/js/jquery.datetimepicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo PATH_URL?>static/css/jquery.datetimepicker.css"/>
<script type="text/javascript">
	function searchTichLuyLog(d, b) {
		if (b == undefined) {
			if ($("#per_page").val()) {
				b = $("#per_page").val()
			} else {
				b = 10
			}
		}
		var a = $("#func_sort").val();
		var c = $("#type_sort").val();
		var fa = $("#first_access").val();
		var type = $('#sel_event').val();
		$("#start").val(d);
		$.post(root + "admincp/" + module + "/ajaxLoadContent", {
			type : type,
			func_order_by : a,
			order_by : c,
			start : d,
			first_access : fa,
			per_page : b,
			dateFrom : $("#caledar_from").val(),
			dateTo : $("#caledar_to").val(),
			content : $("#search_content").val()
		}, function (e) {
			$("#ajax_loadContent").html(e);
			$(".custom_chk").jqTransCheckBox();
			$(".fancyboxClick").fancybox();
			$(".sort").removeClass("icon_sort_desc");
			$(".sort").removeClass("icon_sort_asc");
			$(".sort").addClass("icon_no_sort");
			if (c == "DESC") {
				$("#" + a).addClass("icon_sort_desc")
			} else {
				$("#" + a).addClass("icon_sort_asc")
			}
		})
	}
</script>
<style type="text/css">
.head_select{float: left;}
.head_select select{padding: 4px 8px;margin: 6px 0 0 3px;}
</style>
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
		<div class="head_select">
			<select name="" id="sel_event" onchange='searchTichLuyLog()'>
				<option value="0">-- Chọn event để xem --</option>
				<?php if($list_event) foreach ($list_event as $k => $vl) {?>
				<option value="<?=$vl->id?>"><?=CutText($vl->name,60) ?></option>
				<?php }?>
			</select>
		</div>
		<div class="head_search">
			<div class="head_search_title fontface" style="margin-top: 9px">Search | </div>
			<div class="head_search_title">From:</div>
			<div class="head_search_input"><input onkeypress="return enterSearch(event)" id="caledar_from" type="text" /></div>
			<div class="head_search_title">To:</div>
			<div class="head_search_input"><input onkeypress="return enterSearch(event)" id="caledar_to" type="text" /></div>
			<div class="head_search_title">Content:</div>
			<div class="head_search_input"><input id="search_content" onclick="if(this.value=='type here...'){this.value=''}" onblur="if(this.value==''){this.value='type here...'}" class="input_last" type="text" value="type here..." /><div onclick="searchTichLuyLog(0)" class="bt_search"><img alt="Button search" src="<?=PATH_URL.'static/images/admin/icons/searchSmall.png'?>" /></div></div>
		</div>
	</div>
	<div class="clearAll"></div>
	<div id="ajax_loadContent"><img class="loading" alt="Ajax Loader" src="<?=PATH_URL.'static/images/admin/ajax-loader.gif'?>" /></div>
</div>