	var num_vongquay = 0;
	function pagination_ajax(id){
         $.ajax({
              type: "GET",
              url: root+"/vongquay/list_gift?p="+id+"",
              success: function(html){
                  $("#list_gift_ajax").html(html);
               }
            });

  	}
	function getNumberluotquay(){
		$.ajax({
            type : 'GET',
            url : root + 'vongquay/getNumberLuotQuayAjax',
            success : function(data) {
            	num_vongquay=data;
            	if(num_vongquay>0){
            		flag=1;
            	}
            	$('#num_lq').text(num_vongquay);
            }
        });
	}
	var enable_get=1;
	getvongquay(0);
	function getvongquay(start){
			if(enable_get==0 && start==1){
				return false;
			}
			$.ajax({
	            type : 'POST',
	            dataType : 'json',
	            url : root + 'vongquay/getLuotQuay/'+start,
	            success : function(data) {
	            	enable_get=1;
	            	getNumberluotquay();
	          	    countdown(data.time);
	          	    setTimeout(function(){
	          	    	enable_get=1;
	          	    },3000) ;

	            }
	        });
		}

	var seco=0;
	var min=0;
	var hor=0;
	function countdown(s){
		if(!s){
			clearTimeout(s);
		}
		if(isNaN(s)) {
			$('.sec').text('00');$('.hou').text('00');$('.min').text('00');
			return false;
		}
		if(s==0){
			setTimeout(function(){
				$('.sec').text('00');$('.hou').text('00');$('.min').text('00');
			},1000)
			return false;
		}

		var timec22=setTimeout(function(){


			hou=parseInt(s/(60*60));
			min=parseInt((s-(hou*3600))/60);
			seco=s-(hou*3600+min*60);
			if(String(seco).length==1)
				seco='0'+seco;
			$('.sec').text(seco);

			if(seco==0){
				seco=60;
			}
			if(String(hou).length==1)
				hou='0'+hou;

			if(String(min).length==1)
				min='0'+min;
			$('.hou').text(hou);
			$('.min').text(min);
			s--;
			seco--;

			if(s<=3){
				enable_get=1;
				$('.lay_luot_quay').fadeIn(1);
			}else{
				enable_get=0;
				$('.lay_luot_quay').hide();
			}
			countdown(s);
			if(s==0){
			}

		},1000)
	}
	function AnimateRotate(d){
	    var elem = $(".fl_vongquay");
	    $({deg: 0}).animate({deg: d}, {
	        duration: 7000,
	        step: function(now){
	            elem.css({
	            	'-moz-transform':'rotate('+now+'deg)',
	                  '-webkit-transform':'rotate('+now+'deg)',
	                  '-o-transform':'rotate('+now+'deg)',
	                  '-ms-transform':'rotate('+now+'deg)',
	                  'transform':'rotate('+now+'deg)'
	            });
	        }
	    });
	}
	if(num_vongquay==0){
		flag=2;
	}else{
		flag=1;
	}
	function start_vongquay(){
		if(!user_login){
			$('.trigger_login').trigger('click');
			return false;
		}
		if(flag==2){
			alert('Hiện bạn đã hết lượt quay ! vui lòng nạp cash hoặc click vào nhận lượt quay miễn phí');
			getNumberluotquay();
			return false;
		}
		var server_id=$('.select_server').val();
		if(server_id==0){
			alert('Vui lòng chọn server!');
			return false;
		}
		if(flag==0){
			return false;
		}
		flag=0;
		$.ajax({
	      type : 'POST',
	      dataType : 'json',
	      url : root + 'vongquay/quayso',
	      data : 'ajax=1&server_id=' + server_id + '',
	      success : function(data) {
	      	   if(data.result['status']==25){
	      	  	alert(data.result['msg']);
	      	  	flag=0;
	      	  	return false;
	      	  }
	      	  if(data.result['status']==15){
	      	  	alert('Bạn chưa tạo nhân vật');
	      	  	flag=1;
	      	  	return false;
	      	  }

	      	  var xoay_kim=setInterval(function(){
		          $(".kim-chi").toggleClass('xoay');
		       },200);

	          var offset_stop=3600*3-(data.result['index']*30-15);
	          console.log(data.result['index']*30);

				  AnimateRotate(offset_stop);
				  setTimeout(function(){
				  	getNumberluotquay();
				  	getNumberScore();
				  	alert('Xin chúc mừng bạn đã may mắn nhận được "'+data.result['name_item']+'". Vui lòng vào game để nhận vật phẩm!');
				  	flag=1;
				  	clearInterval(xoay_kim);
				  	$('.kim-chi').removeClass('xoay');
				  },8000)
				  $('#num_lq').text(data.result['luotquay']);
	      }
	    });
	}

var flag_c=1;
function change_item(id){

	if(flag_c==0){
		return false;
	}
		

	var server_id=$('.select_server').val();

	var r = confirm("Bạn có muốn đổi vật phẩm này không ?");
	if (r == false) {
		return false;
	}
	flag_c=0;



	$.ajax({
      type : 'POST',
      url : root + 'vongquay/change_item',
      data : 'ajax=1&server_id=' + server_id + '&id='+id+'',
      success : function(data) {
      	alert(data);
      	flag_c=1;
      	getNumberScore();
	  }    	  
	})  
} 


function getNumberScore(){
	$.ajax({
        type : 'GET',
        url : root + 'vongquay/check_score_by_user/1',
        success : function(data) {
        	$('#num_score,.diemtl2 span').text(data);
        }
    });
}

$(document).ready(function(){
	getNumberScore();
})