<link rel="stylesheet" type="text/css" href="<?=PATH_URL?>static/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?=PATH_URL?>static/css/daptrung.css">
<script src="<?php echo PATH_URL?>static/js/jquery-1.8.3.min.js" type="text/javascript"></script>
<script type="text/javascript">
	var endDate = "<?php echo strtotime($bool->valid_date)?>";
   	var now =  "<?php echo time()?>";
    var flag = 0;

	$(document).ready(function(){
		// console.log(servers_id_active);
		$('.menu-daptrung li a').hover(function() {
	        $('.tab-menu li a').removeClass('tab-active');
	        $(this).addClass('tab-active');
	        $('.tab-daptrung').hide();
	        var active = $(this).data('link');
	        $('#'+active).show();
	    });

		$('.send-item input').css({'cursor':'url(http://mongkiemhiep.com/static/images/daptrung/cursor-bua2.cur), progress'})

		<?php if( !$check_con ){?>
		//Toi thoi diem tren thi khong cho click dap trung voi cong diem nua nguoc lai cho mo nut nhan qua dua top
		$('.bt-duatop').addClass('duatop-act');
		$('.bt-duatop').removeAttr('disabled');

		$('.bt-duatop').click(function(){

			$('#html_service').html('');

			sid = $("#chooseserver2 option:selected").val();
	        if(sid == 0){
	        	alert('Bạn phải chọn server !');
	        }else{
        		$.ajax({
                    type:"POST",
                    dataType: "JSON",
                    data: "server_id="+sid,
                    url:"<?php echo PATH_URL?>daptrung/sendAwardTop",
                    success:function(result){
                    	console.log(result.status);
                    	if(result.status == 0){
                    		alert('Bạn không nằm trong top này!');
                    	}else if(result.status == 2){
                    		alert('Bạn đã nhận phần quà đua top rồi !!');
                    	}else{
                    		$('#html_service').html(result.html_service);
                    		alert('Chúc mừng bạn đã nhận được phần quà '+ result.message);
                    	}
                        return false;

                    }
                });
            }
		});

		$('.send-item input').click(function(e){
			alert('Đã hết thời điểm event quả trứng may mắn!!');
		});

		$('#openfreecount').click(function(){
			alert('Đã hết thời điểm event quả trứng may mắn!!');
		});

		<?php }else{?>
		//Chua toi thoi diem tren thi van cho cong diem
		// $('.bt-duatop').attr("disabled","disabled");
		setTimeout(function(){countdown()}, 100);

		$('.bt-duatop').addClass('duatop-no-act');

		$('.bt-duatop').click(function(){
			alert('Chưa đến thời điểm nhận thưởng đua top');
		});

		$('.send-item input').click(function(e){
			e.preventDefault();

			$('#html_service').html('');

	        sid = $("#chooseserver1 option:selected").val();
	        if(sid == 0){
	        	alert('Bạn phải chọn server !');
	        }else{
		        $.ajax({
		            type:"POST",
		            dataType: "JSON",
		            data: "server_id="+sid,
		            url: "<?php echo PATH_URL?>daptrung/getResult",
		            success:function(result){
		            	if(result.status > 0){
			            	$('.count_cur').html(result.count_cur);
			            	$('.count_all').html(result.count_all);
			            	$('#html_service').html(result.html_url);
			            	ajax_duatop();
			            	alert('Chúc mừng bạn đã nhận được '+result.award+'! Bạn hãy vào game để nhận vật phẩm nhé !');
		            	}else{
		            		alert('Bạn đã hết búa !');
		            	}
		            }
		        });
		        $(this).addClass('trung-act');
		        $(this).attr("disabled","disabled");
	        }

		});
		$('.bt-lammoi').click(function(){
			$('.send-item input').removeAttr('disabled');
			$('.send-item input').removeClass('trung-act');
		});

		function ajax_duatop(){
			$.ajax({
                type:"POST",
                dataType: "text",
                url:"<?php echo PATH_URL?>daptrung/ajax_duatop",
                success:function(result){
                	$('.tbl-xephang').html(result);
                	return false;
                }
            });
		}

		$('#openfreecount').click(function(){
			openfreecount();
		});

		function openfreecount(){
            var count = parseInt($('.count_cur2').text())+1;
            if(flag == 1){
                $.ajax({
                    type:"POST",
                    dataType: "JSON",
                    url:"<?php echo PATH_URL?>daptrung/openfreecount",
                    success:function(result){
                    	if(result.status == 1){
	                        $('.count_cur').html(count);
	                        countdown();
	                        ajax_duatop();
	                        alert(result.message);	
                    	}else{
                    		alert(result.message);	
                    	}
                        return false;
                    }
                });
            }
            else{
                $("#openfreecount").removeAttr("disabled");
                alert("Chưa đến thời gian nhận búa!"); return false;
            }
        }
		function countdown(){
            // alert(endDate); alert(now);
            temp = parseInt(endDate)-parseInt(now);
            // alert(temp);

            if(temp >0){
                hour = parseInt(temp/3600);
                minutes = parseInt( (temp - (hour*3600)) /60);
                seconds = parseInt( (temp - (hour*3600) - (minutes*60)));
                if(hour <= 0 && minutes<= 0 && seconds <=0){
                    end(); return false;
                }

                if(hour <10){
                    hour = "0"+hour;
                }
                if(minutes <10){
                    minutes = "0"+minutes;
                }
                if(seconds <10){
                    seconds = "0"+seconds;
                }
                $(".countdown").html("Còn <span class='hours'>" + hour+"</span>:<span class='min'>"+minutes+"</span>:<span class='second'>"+seconds+"</span>");
            }
            else{
                end(); return false;
            }
            now = parseInt(now)+ 1 ;
            setTimeout(function(){countdown()}, 1000);
        }

        function end(){
            flag = 1;
            $(".countdown").html("Còn <span class='hours'>00</span>:<span class='min'>00</span>:<span class='second'>00</span>"); return false;
        }

        <?php }?> //end kiem tra thoi diem

    }); //end document

</script>
<div class="popup-daptrung">
	<div class="popup-title">QỦA TRỨNG MAY MẮN</div>
	<div id="html_service" style='display:none;opacity:0'></div>
	<div class="tabmenu-daptrung">
		<ul class='menu-daptrung'>
			<li><a data-link='tab2' target='_blank' href="<?=PATH_URL?>nap-the">NẠP THẺ</a></li>
			<li><a data-link='tab2' href="javascript:;">ĐẬP TRỨNG</a></li>
			<li><a data-link='tab3' href="javascript:;">ĐUA TOP</a></li>
		</ul>
		<div class="tab-daptrung" id='tab2' style='display:block'>
			<div class='tab-row' style='margin: 20px 0 0 0;'>
				<div class="timer">
					<span class='timer-label'>Nhận búa miễn phí</span>
					<span class='timer-number countdown'></span>
					<span class="server-list">
						<select name="" id="chooseserver1">
							<option value="0">Chọn server</option>
							<?php if($servers) foreach ($servers as $key => $value) {?>
								<option value="<?=$value->id?>" <?php if($server_id_cur == $value->id) echo "selected='selected'";?> ><?=$value->name?></option>
							<?php }?>
						</select>
					</span>
				</div>
				<a href="javascript:;" class="bt-nhanbua" id='openfreecount'></a>
				<div class="user-area">
					<p>Tài khoản : <font color='#ff3c00'><?=$this->session->userdata('username')?></font></p>
					<p>Lượt đập : <span class='count_cur' style='color:#ff3c00'><?=$count_cur?></span></p>
					<p>Tổng số lượt đã đập : <span class='count_all' style='color:#ff3c00'><?=$count_all?></span></p>
				</div>
				<div class="clear"></div>
			</div>
			<div class='tab-row'>
				<div class="send-item">
					<input type='button' class='trung1' style='margin-left: 22px;'/>
					<input type='button' class='trung2'/>
					<input type='button' class='trung3'/>
					<input type='button' class='trung4'/>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
			<div class='tab-row'><a class='bt-lammoi' href="javascript:;"></a></div>
			<div class='tab-row'>
				<div class="daptrung-footer">
					<p style='margin-top: 4px;'><font style='color:#ff9600;font-weight:bold'>Thời gian :</font> 14h ngày 23.02.2016 đến 23h59 10.03.2016</p>
					<p><font style='color:#ff9600;font-weight:bold'>Đối tượng :</font> Tất cả User </p>
					<p><font style='color:#ff9600;font-weight:bold'>Thể lệ :</font> Xem chi tiết <a style='color:#fff' target='_blank' href='<?=PATH_URL?>tin-hot/su-kien-dua-top-dap-trung-lan-3'>(Tại Đây)</a></p>
					<p><a class='bt-seemore' href="">Chi tiết >> </a></p>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="tab-daptrung" id='tab3' style='display:none'>
			<div class='tab-row' style='margin: 20px 0 0 0;'>
				<div class="timer">
					<span class="server-list">
						<select name="" id="chooseserver2">
							<option value="0">Chọn server</option>
							<?php if($servers) foreach ($servers as $key => $value) {?>
								<option value="<?=$value->id?>" <?php if($server_id_cur == $value->id) echo "selected='selected'";?> ><?=$value->name?></option>
							<?php }?>
						</select>
					</span>
				</div>
				<input type='button' class="bt-duatop"/>
				<div class="user-area">
					<p>Tài khoản : <font color='#ff3c00'><?=$this->session->userdata('username')?></font></p>
					<p>Lượt đập : <span class='count_cur count_cur2' style='color:#ff3c00'><?=$count_cur?></span></p>
					<p>Tổng số lượt đã đập : <span class='count_all' style='color:#ff3c00'><?=$count_all?></span></p>
				</div>
				<div class="clear"></div>
			</div>
			<div class="tab-row">
				<p><font style='color:#da0007;font-weight:bold;font-size:14px;'>Thời gian nhận thưởng đua top 0 Giờ ngày 11.03.2016</font></p>
				<p>
					<table class='tbl-xephang'>
						<tr>
							<th>Hạng</th>
							<th>Tên Tài Khoản</th>
							<th>Tổng Điểm</th>
							<th>Phần Thưởng</th>
						</tr>
						<?php if($top) { foreach ($top as $key => $value) {
							switch ($key) {
								case '0':
									$award = '10.000 Bạc - Tiềm Năng Tiên Dược ...';
									break;
								case '1':
									$award = '8.000 Bạc - Tiềm Năng Tiên Dược ...';
									break;
								case '2':
									$award = '6.000 Bạc - Cao - Đá Cường Hóa Thần ...';
									break;
								case '3':
									$award = '5.000 Bạc - Cao - Đá Cường Hóa Thần ...';
									break;
								case '4':
									$award = '4.000 Bạc - Cao - Đá Cường Hóa Thần ...';
									break;
								default:
									$award = '2.000 Bạc - Cao - Đá Cường Hóa Thần ...';
									break;
							}
						?>
						<tr>
							<td><?=$key+1?></td>
							<td><?=CutText($value->username,10)?></td>
							<td><?=$value->count_sum?></td>
							<td><?=CutText($award,30)?></td>
						</tr>
						<?php } }?>
					</table>
				</p>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>
