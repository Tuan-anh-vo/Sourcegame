<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="<?=PATH_URL.'static/images/admin/'?>favicon.ico" type="image/x-icon" rel="icon" />
<link href="<?=PATH_URL.'static/images/admin/'?>favicon.ico" type="image/x-icon" rel="shortcut icon" />
<link rel="stylesheet" href="<?=PATH_URL.'static/css/admin/'?>styles.css" type="text/css">
<link rel="stylesheet" href="<?=PATH_URL.'static/css/admin/'?>jquery-ui-1.10.3.custom.min.css" type="text/css">
<script type="text/javascript">
var root = '<?=PATH_URL?>';
var module = '<?=$module?>';
<?php if($this->uri->segment(2) == 'user'){ ?>

function resetPass(){
	$list_id = new Array();
	$('.custom_chk:checked').each(function(index,val){
		$list_id[index] = $(val).attr('value');
	});
	$new_pass = prompt('Nhập mật khẩu mới : ');
	if($new_pass != ""){
		if($list_id.length > 0){
			$.post(
				root+'user/resetPass',
				{
					list_id : $list_id,
					new_pass : $new_pass
				},
				function(response){
					console.log(response);
					if(response == 1){
						alert('Reset Password User Success');
					}
				}
			);
		}
	}
	else{
		alert("Vui lòng nhập mật khẩu reset");
	}
}
<?php } ?>
</script>
<script type="text/javascript" src="<?=PATH_URL.'static/js/jquery-1.11.3.min.js'?>"></script>
<script type="text/javascript" src="<?=PATH_URL.'static/editor/scripts/innovaeditor.js'?>"></script>
<script type="text/javascript" src="<?=PATH_URL.'static/js/admin/jquery.ToTop.js'?>"></script>
<script type="text/javascript" src="<?=PATH_URL.'static/js/admin/jquery_caledar.js'?>"></script>
<script type="text/javascript" src="<?=PATH_URL.'static/js/admin/custom_forms.js'?>"></script>
<script type="text/javascript" src="<?=PATH_URL.'static/js/admin/jquery.form.js'?>"></script>
<script type="text/javascript" src="<?=PATH_URL.'static/js/admin/jquery.url.js'?>"></script>
<script type="text/javascript" src="<?=PATH_URL.'static/js/admin/highcharts.js'?>"></script>
<script type="text/javascript" src="<?=PATH_URL.'static/js/admin/'?>modules/exporting.src.js"></script>
<script type="text/javascript" src="<?=PATH_URL.'static/fancybox/source/jquery.fancybox.pack.js'?>"></script>
<script type="text/javascript" src="<?=PATH_URL.'static/js/admin/admin.js'?>"></script>
<script type="text/javascript" src="<?=PATH_URL.'static/js/admin/jquery.ui.datepicker-vi.js'?>"></script>
<script type="text/javascript" src="<?=PATH_URL.'static/js/admin/jquery-ui-1.10.3.custom.min.js'?>"></script>
<script type="text/javascript" src="<?=PATH_URL.'static'?>/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?=PATH_URL.'static'?>/ckfinder/ckfinder.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="<?=PATH_URL.'static'?>/css/admin/daterangepicker-bs3.css" />
<script type="text/javascript" src="<?=PATH_URL.'static'?>/js/admin/moment.js"></script>
<script type="text/javascript" src="<?=PATH_URL.'static'?>/js/admin/daterangepicker.js"></script>
<title>Admin Control Panel</title>
<!--[if ie 6]>
<style>
html, body{
behavior: url('<?php echo PATH_URL.'static/css/' ?>csshover3.htc');
}

.png{
behavior: url('<?php echo PATH_URL.'static/css/' ?>iepngfix.htc');
}
</style>
<script type="text/javascript" src="<?php echo PATH_URL.'static/js/' ?>iepngfix_tilebg.js"></script>
<![endif]-->
</head>
<body>
<div class="topNav">
	<div class="nameNav"><?=modules::run('admincp/getSetting','title-admincp')?></div>
	<div class="userNav">
		<ul>
			<li class="profile"><a href="<?=PATH_URL.'admincp/update_profile'?>"><img alt="profile" src="<?=PATH_URL.'static/images/admin/userPic.png'?>" /><span><?=$this->session->userdata('userInfo')?></span></a></li>
			<li class="li_last_child"><a href="<?=PATH_URL.'admincp/logout'?>"><img alt="profile" src="<?=PATH_URL.'static/images/admin/logout.png'?>" /><span>Logout</span></a></li>
		</ul>
	</div>
</div>

<div class="header">
	<div class="logo"><img alt="" src="<?=PATH_URL.'static/images/admin/logo.png'?>" /></div>
	<?php if($this->uri->segment(2)!='permission'){ ?>
	<div class="midNav">
		<?php
			if($this->uri->segment(3)!='update' && $this->uri->segment(3)!='update2' && $this->uri->segment(2)!='update_profile' && $this->uri->segment(2)!='setting'){
				if($this->uri->segment(2)!='manager_modules' && $this->uri->segment(2)!='logs' && $this->uri->segment(2)!='user'){
		?>
		<ul>
			<?php if($this->uri->segment(2)=='donate' || $this->uri->segment(2)=='donate_report') { ?>
				<li><a href="<?php echo PATH_URL;?>admincp/donate_report/resendCard"><span class="show_items">Resend</span></a></li>
			<?php } ?>
			<?php if($this->uri->segment(2)!='contact' && $this->uri->segment(2)!='donate'){ ?>
			<li><a href="<?=PATH_URL.'admincp/'.$module.'/update/'?>"><span class="add_new">Add new</span></a></li>
			<li><a href="javascript:void(0)" onclick="showStatusAll()"><span class="show_items">Show</span></a></li>
			<li><a href="javascript:void(0)" onclick="hideStatusAll()"><span class="hide_items">Hide</span></a></li>

			

			<?php } ?>
			<li class="midNav_last_child"><a href="javascript:void(0)" onclick="deleteAll()"><span class="delete_items">Delete</span></a></li>
		</ul>
		<?php }
			else{ ?>
			<ul>
				<li class="midNav_last_child"><a href="javascript:void(0)" onclick="resetPass()"><span class="delete_items">Reset Password</span></a></li>
			</ul>			
			<?php
			}
		}else{ ?>
		<ul>
			<?php if($this->uri->segment(2)!='update_profile' && $this->uri->segment(2)!='setting'){ ?>
			<li <?php ($this->uri->segment(2)=='contact') ? print 'class="midNav_last_child"' : print '' ?>><a href="<?=PATH_URL.'admincp/'.$module.'/#/back'?>"><span class="back">Back</span></a></li>
			<?php } ?>
			
			<?php if($this->uri->segment(2)=='accounts' && $this->uri->segment(4)!=''){ ?>
			<li><a href="javascript:void(0)" onclick="resetPerm()"><span class="reset">Reset Permission</span></a></li>
			<?php } ?>
			
			<?php if($this->uri->segment(2)!='contact' && $this->uri->segment(3)!='update2'){ ?>
			<li class="midNav_last_child"><a href="javascript:void(0)" onclick="save()"><span id="saveContent" class="save">Save</span></a></li>
			<?php if($this->uri->segment(2)=='content'){?>
			<li class="" style="margin-left: 14px;"><a href="javascript:void(0)" onclick="apply()"><span id="applyContent" class="save">Apply</span></a></li>

			<li class="midNav_last_child"><a onclick="review_detail()"><span class="add_new">ReView</span></a></li>
			<?php }?>
			<?php } ?>
			<!-- add nut save2 vao phan update cuar sv_category -->
			<?php if($this->uri->segment(3)=='update2'){?>
			<li class="midNav_last_child"><a href="javascript:void(0)" onclick="save2()"><span id="saveContent" class="save">Save</span></a></li>
			<?php }?>
			<!-- add nut save2 vao phan update cuar sv_category -->
		</ul>
		<?php } ?>
	</div>
	<?php } ?>
</div>

<div id="content">
	<table cellspacing="0" cellpadding="0" border="0" width="100%">
		<tr>
			<td valign="top" width="237">
				<div class="left_content">
					<ul>
						<li style="margin-top: 0px;"><a <?php if($this->uri->segment(2)==''){ ?>class="active"<?php } ?> href="<?=PATH_URL.'admincp'?>"><span class="menu_dashboard">Dashboard</span></a></li>
						<div id="loadMenu"><?=modules::run('admincp/menu')?></div>
						<li><a <?php if($this->uri->segment(2)=='setting'){ ?>class="active"<?php } ?> href="<?=PATH_URL.'admincp/setting'?>"><span class="menu_setting">Setting</span></a></li>
					</ul>
				</div>
			</td>

			<td valign="top">
				<div class="right_content">
					<?=$content?>
				</div>
			</td>
		</tr>
	</table>
</div>

<div class="footer"><div class="text_footer">&copy; Copyright 2012. All rights reserved. Developed by <a target="_blank" href="http://climaxinteractive.com">Climax</a></div></div>

<div id="loader">
	<div class="bg_mask"></div>
	<div class="processing">
		<div class="bg_processing"><img alt="Loading" src="<?=PATH_URL.'static/images/admin/ajax-loader.gif'?>" /><br/>System is processing...</div>
	</div>
</div>
</body>
</html>