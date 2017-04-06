<meta charset="utf-8">
<script src="<?=PATH_URL?>static/js/jquery-1.8.3.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?=PATH_URL?>static/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?=PATH_URL?>static/popup_tichluy/popup_tichluy.css">
<link rel="stylesheet" type="text/css" href="<?=PATH_URL?>static/css/jquery.bxslider.css">

<script src="<?=PATH_URL?>static/popup_tichluy/popup_tichluy.js" type="text/javascript"></script>
		<div class="container" style="width: 1000px;">
			<div class="container-left">
				<div class="menu-left">
					<ul>
						<li class="menu-item-left selected" data-id="1"><a></a></li>
						<li class="menu-item-left" data-id="2"><a></a></li>
						<!-- <li class="menu-item-left" data-id="3"><a></a></li>
						<li class="menu-item-left" data-id="4"><a></a></li> -->
					</ul>
				</div>
			</div>
			<div class="container-right">
				<div class="cumulative-day b-info box-selected" id="box-menu-l-1">
					<div class="title">TÍCH LŨY NGÀY</div>
					<div class="f-title"></div>
					<div class="content">
						<span>Đối tượng áp dụng:</span> Toàn bộ máy chủ.<br/>
						<span>Nội dung:</span> Khi người chơi nạp thẻ đạt vào mốc nhất định như 100k, 500k, 1000k, 2000k thì sẽ nhận được phần thưởng nhất định.<br/>
						<span>Cách nhận thưởng:</span> Sau khi đạt mốc nhận thưởng, nhận thưởng ngay trên TOP MENU.<br/>
						<!-- <span class="noted">Lưu ý: Mốc tích lũy sẽ reset vào lúc 0:00 thứ hai hàng tuần. Nếu chưa nhận thưởng tuần trước, sau 0:00 thứ hai sẽ bị mất.</span> -->
					</div>
					<?=Modules::run("tichluy/tichluy_user", 1)?>
				</div>
				<div class="cumulative-week b-info" id="box-menu-l-2">
					<div class="title">TÍCH LŨY TUẦN</div>
					<div class="f-title"></div>
					<div class="content">
						<span>Đối tượng áp dụng:</span> Toàn bộ máy chủ.<br/>
						<span>Nội dung:</span> Khi người chơi nạp thẻ đạt vào mốc nhất định như 100k, 500k, 1000k, 2000k thì sẽ nhận được phần thưởng nhất định.<br/>
						<span>Cách nhận thưởng:</span> Sau khi đạt mốc nhận thưởng, nhận thưởng ngay trên TOP MENU.<br/>
						<!--<span class="noted">Hiện tại event này đang đóng, bạn có thể tham gia tích lũy ngày để nhận các phần quà hấp dẫn !!!.</span>-->
					</div>
					<?=Modules::run("tichluy/tichluy_user", 2)?>	
				</div>

				<div class="share b-info" id="box-menu-l-3" style='display:none'>
					<div class="title">SHARE FACEBOOK MÁY CHỦ MỚI</div>
					<div class="f-title"></div>
					<div class="content">
						<span>Đối tượng áp dụng:</span> Share cho máy chủ mới, nhận mỗi ngày.<br/>
						<!-- <span>Thời gian:</span> 6/4/2015 - 20/4/2015.<br/> -->
						<span>Nội dung:</span> Khi người chơi comment vào một status được bật lên sẵn trên popup, sẽ nhận được quà của Giáng Ma.<br/>
						<span class="noted">Mỗi status sẽ reset vào lúc 0h mỗi ngày. Phần thưởng cũng sẽ reset vào lúc 0h mỗi ngày. Khi người chơi chưa nhận được phần thưởng của ngày hôm qua cũng sẽ bị reset.</span>
					</div>
					<!-- <div class="status-fb">
						Nội dung status facebook (Plugin)
					</div>
					<div class="box-reward">
						<div class="box-table" style="width: 400px; margin-left: 190px;">
							<table>
								<tbody>
									<tr class="character">
										<th>Tên vật phẩm</th>
										<th>Hình ảnh</th>
										<th>Số lượng</th>
									</tr>
									<tr>
										<td>A</td>
										<td>A</td>
										<td>A</td>
									</tr>
									<tr>
										<td>A</td>
										<td>A</td>
										<td>A</td>
									</tr>
									<tr>
										<td>A</td>
										<td>A</td>
										<td>A</td>
									</tr>
								</tbody>
							</table>
							<div class="reward">
								<a href="#">Nhận</a>
							</div>
						</div>
					</div> -->
					<?php //echo Modules::run("sharefb_log")?>	
				</div>
				<div class="top-racing-day b-info" id="box-menu-l-4" style='display:none'>
					<div class="title">ĐUA TOP HẰNG NGÀY</div>
					<div class="f-title"></div>
					<div class="content">
						<span>Đối tượng áp dụng:</span> Toàn bộ máy chủ.<br/>
						<!-- <span>Thời gian:</span> 6/4/2015 - 20/4/2015.<br/> -->
						<span>Nội dung:</span> Khi người chơi đạt các mốc top của lực chiến, thú cưỡi, cánh sẽ nhận được phần thưởng.<br/>
						<span>Cách nhận thưởng:</span> Top sẽ lấy vào 0h mỗi ngày. Khi reset bảng xếp hạng, người chơi có thể nhận thưởng lại.<br/>
						<span class="noted">Lưu ý: Phần thưởng sẽ reset vào lúc 0h mỗi ngày. Khi chưa nhận phần thưởng của ngày hôm trước cũng sẽ bị reset</span>
					</div>
					<!-- <div class="rating">
						<a href="#"></a>
					</div> -->
					<?php //echo Modules::run("duatop/duatop_user")?>	
				</div>
			</div>
		</div>
 