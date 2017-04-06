<input type="hidden" value="<?php ($this->session->userdata('start'))? print $this->session->userdata('start') : print 0 ?>" id="start" />
<input type="hidden" value="<?=$default_func?>" id="func_sort" />
<input type="hidden" value="<?=$default_sort?>" id="type_sort" />
<div class="gr_perm_error" style="display:none;">
	<p><strong>FAILURE: </strong>Permission Denied.</p>
</div>
<div id="indexView" class="table">
	<div class="head_table">
		<div class="head_title_table"><?=$module_name?></div>
	</div>
	<div class="clearAll"></div>
	
	<div id="ajax_loadContent"><img class="loading" alt="Ajax Loader" src="<?=PATH_URL.'static/images/admin/ajax-loader.gif'?>" /></div>
</div>