<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="<?=PATH_URL?>static/css/reset.css">
<style type="text/css">
.tichluy-wrapper{width: 500px;
font-family: arial;
line-height: 23px;
display: block;
clear: both;
margin: 44px;}
.tichluy-wrapper h1{font-size: 14px;}
.tichluy-wrapper h2{text-transform: uppercase;font-size: 16px;color:#2225FF;font-weight: bold;} /*#2225FF FFA022*/
.tichluy-wrapper h3{text-align: center;font-weight: bold;padding: 4px 0;}
.list-tichluy{margin: 10px 0 0;font-size: 14px;}
.list-tichluy p{color:#000}/*#D410F4 2505BA*/
.list-tichluy p span.text-info{font-weight: bold;color:#F00;}
.list-tichluy table{border: 1px solid red;width: 100%;background:#9DFFCB;}
.list-tichluy table tr{border: 1px solid red;color:#0035DB;}
.list-tichluy table tr th, .list-tichluy table tr td{
padding: 6px 4px;text-align: center;
border: 1px solid #dcc6b4;
background: #ffead9;
vertical-align: middle;
font-size: 14px;
}
.list-tichluy table tr th{
	border: 1px solid #dcc6b4;
background: #cd2a25;
color: #fff;
font-size: 16px;
}
</style>
<script src="<?=PATH_URL?>static/js/jquery-1.8.3.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.bt-nhantichluy').click(function(){
		id_event = $(this).data('event');
		level = $(this).data('level');
		server = $(this).data('server');
		if(id_event && level && server){
			var me = this;
			$.ajax({
                type:"POST",
                dataType: "JSON",
                data: "server_id="+server+"&id_event="+id_event+"&level_award="+level,
                url:"<?php echo PATH_URL?>tichluy/check_request",
                success:function(result){
                	alert(result.msg);
                	if(result.status == 1){
                		$('#tl_urlservice_'+<?=$type?>).html(result.html_url);
                		$(me).attr('disabled','disabled	');
                		$(me).val('Đã nhận');
                	}
                }
            });
		}
	})
});
</script>
<?php $name_sv = array(); if($servers)  foreach ($servers as $k => $vl) {
	$name_sv[$vl->id] = $vl->name;
}?>

<div id='tl_urlservice_<?=$type?>' style='display:none;opacity:0'></div>
<div class="tichluy-wrapper">
	<!-- <h1>Chào bạn, <font style='color:#f00;font-weight:bold'><?=$this->session->userdata('username')?></font></h1> -->
	<!-- <h2>Danh sách event tích lũy bạn đã tham gia : </h2> -->
	<?php if($event){ 
		foreach ($event as $key => $value) {
		if(isset($value->user) && isset($name_sv[$value->server_id])){
		?>
	<!-- <hr> -->
	<div class="list-tichluy">
		<h3><?=$value->name?></h3>
			<?php if(0){ ?>
			<p>Thời gian event : <span class='text-info'><?='Từ '.date('H:i d/m/Y',strtotime($value->startdate) ).' đến '.date('H:i d/m/Y',strtotime($value->enddate) )?></span></p>
			<?php } ?>
			<p>Số tích lũy(VNĐ) hiện tại mà bạn có : <span class='text-info'><?=$value->total?></span></p>
			<p>Server bạn đang tích lũy :<span class='text-info'> <?=$name_sv[$value->server_id]?></span></p>
		<table>
			<tr>
				<th>Mốc nạp</th>
				<th>Phần quà</th>
				<th>Trạng thái</th>
			</tr>
			<?php if($value->user) foreach ($value->user as $k => $vl) {
				$status[$value->server_id][$vl->id_event][$vl->level_award] = 'Đã nhận'; // doan nay can them key server_id nua de cho chinh xac them
			}?>
			<?php foreach (unserialize($value->config) as $k => $vl) {?>
			<tr>
				<td><?=$vl['level']?></td>
				<td><?=$vl['name_item']?></td>
				<td class='bt-bam'>
					<?php if(isset($status[$value->server_id][$value->id][$vl['level']]) ){?>
					<input type='button' data-level="<?=$vl['level']?>" data-event="<?=$value->id?>" data-server="<?=$value->server_id?>" value='Đã nhận' disabled>
					<?php }else {?>
					<input type='button' data-level="<?=$vl['level']?>" data-event="<?=$value->id?>" data-server="<?=$value->server_id?>" class='bt-nhantichluy' value='Bấm nhận'>
					<?php }?>
				</td>
			</tr>
			<?php }?>
		</table>
	</div>
	<?php } 
		}
	}else{?>
	<h3>Bạn không đủ điều kiện để tham gia các event tích lũy !!!</h3>
	<?php }?>
</div>