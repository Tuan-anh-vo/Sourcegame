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
			
			<div class="head_search_title">Danh mục</div>
			<div class="head_search_input"><select id="type_ct" style="margin:9px 5px;" ><option value="0">All</option> <?php echo getFullCategoryOption() ?> </select></div>
			<div class="head_search_title">Content:</div>
			<div class="head_search_input"><input onkeypress="return enterSearch(event)" id="search_content" onclick="if(this.value=='type here...'){this.value=''}" onblur="if(this.value==''){this.value='type here...'}" class="input_last" type="text" value="type here..." /><div onclick="searchContentType(0)" class="bt_search"><img alt="Button search" src="<?=PATH_URL.'static/images/admin/icons/searchSmall.png'?>" /></div></div>
		</div>
	</div>
	<div class="clearAll"></div>
	
	<div id="ajax_loadContent"><img class="loading" alt="Ajax Loader" src="<?=PATH_URL.'static/images/admin/ajax-loader.gif'?>" /></div>
</div>

<script>
function searchContentType(d, b) {
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
		var type_ct = $("#type_ct").val();
		$("#start").val(d);
		$.post(root + "admincp/" + module + "/ajaxLoadContent", {
			func_order_by : a,
			order_by : c,
			start : d,
			type_ct : type_ct,
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