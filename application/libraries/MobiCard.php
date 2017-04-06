<?php 
  class Config
  {
	  public static $_FUNCTION = "CardCharge";
	  public static $_VERSION = "2.0";
	  //Thay đổi 3 thông tin ở phía dưới
	  public static $_MERCHANT_ID = "47885";//mã merchantsite( mã website) dăng ký trên ngân lượng
	  public static $_MERCHANT_PASSWORD = "e3a470c1d01c76141bf27f8c84e0b380";// Mật khẩu giao tiếp( mật khẩu khi đăng ký merchantsite)
	  public static $_EMAIL_RECEIVE_MONEY = "trinhleminhphuc@gmail.com";// Email chính đăng ký trên Ngân Lượng
  }
  
  class Result {
	 var $error_code = "";
	 var $merchant_id = "";
	 var $merchant_account = "";				
	 var $pin_card = "";
	 var $card_serial = "";
	 var $type_card = "";
	 var $order_id = "";
	 var $client_fullname = "";
	 var $client_email = "";
	 var $client_mobile = "";
	 var $card_amount = "";
	 var $amount = "";
	 var $transaction_id = "";
	 var $error_message = "";
  }
  
  
  class MobiCard
  {
	          function GetErrorMessage($error_code) {
				$arrCode = array(
				   '00'=>  'Giao dịch thành công',
				   '99'=>  '99 : Máy chủ quá tải, vui lòng thử lại sau ít phút',
				   '01'=>  '01: Máy chủ quá tải, vui lòng thử lại sau ít phút',
				   '02'=>  '02: Máy chủ quá tải, vui lòng thử lại sau ít phút',
				   '03'=>  '03: Máy chủ quá tải, vui lòng thử lại sau ít phút',
				   '04'=>  '04: Máy chủ quá tải, vui lòng thử lại sau ít phút',
				   '05'=>  '05: Máy chủ quá tải, vui lòng thử lại sau ít phút',
				   '06'=>  '06: Máy chủ quá tải, vui lòng thử lại sau ít phút',
				   '07'=>  'Thẻ đã được sử dụng',
				   '08'=>  'Thẻ bị khóa',
				   '09'=>  'Thẻ hết hạn sử dụng',
				   '10'=>  'Thẻ chưa được kích hoạt hoặc không tồn tại',
				   '11'=>  'Mã thẻ sai định dạng',
				   '12'=>  'Sai số serial của thẻ',
				   '13'=>  'Mã thẻ và số serial không khớp',
				   '14'=>  'Thẻ không tồn tại',
				   '15'=>  'Thẻ không sử dụng được',
				   '16'=>  'Số lần thử (nhập sai liên tiếp) của thẻ vượt quá giới hạn cho phép',
				   '17'=>  'Máy chủ quá tải, vui lòng thử lại sau ít phút',
				   '18'=>  'Hệ thống nạp thẻ bị lỗi hoặc quá tải, thẻ có thể bị trừ, vui lòng liên hệ hỗ trợ để được giúp đỡ',
				   '19'=>  'Máy chủ quá tải, vui lòng thử lại sau ít phút',
				   '20'=>  'Hệ thống không ổn định, thẻ đã bị trừ, nếu không nhận được KNB vui lòng liên hệ hỗ trợ để được giúp đỡ');
				   
				   return $arrCode[$error_code];
			}
			
		   function CardPay($pin_card,$card_serial,$type_card,$_order_id,$client_fullname,$client_mobile,$client_email) 
		   {
				 $params = array(
						'func'					=> Config::$_FUNCTION,
						'version'				=> Config::$_VERSION,
						'merchant_id'			=> Config::$_MERCHANT_ID,
						'merchant_account'		=> Config::$_EMAIL_RECEIVE_MONEY,
						'merchant_password'		=> MD5(Config::$_MERCHANT_ID.'|'.Config::$_MERCHANT_PASSWORD),
						'pin_card'				=> $pin_card,
						'card_serial'			=> $card_serial,
						'type_card'				=> $type_card,
						'ref_code'				=> $_order_id,
						'client_fullname'		=> $client_fullname,
						'client_email'			=> $client_email,
						'client_mobile'			=> $client_mobile,
					);
					
					$post_field = '';
					foreach ($params as $key => $value){
						if ($post_field != '') $post_field .= '&';
						$post_field .= $key."=".$value;
					}
					// var_dump($post_field);
					// die();
					$api_url = "https://www.nganluong.vn/mobile_card.api.post.v2.php";
				// pr($params,1);
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL,$api_url);
				curl_setopt($ch, CURLOPT_ENCODING , 'UTF-8');
				curl_setopt($ch, CURLOPT_VERBOSE, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $post_field);
				$result = curl_exec($ch);
				$status = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
				$error = curl_error($ch);
				
				//print_r($result);
				//die();
				$kq = new Result();
				
				if ($result != '' && $status==200){
					$arr_result = explode("|",$result);
					if (count($arr_result) == 13) {
						$kq->error_code       = $arr_result[0];
						$kq->merchant_id      = $arr_result[1];
						$kq->merchant_account = $arr_result[2];				
						$kq->pin_card         = $arr_result[3];
						$kq->card_serial      = $arr_result[4];
						$kq->type_card        = $arr_result[5];
						$kq->order_id         = $arr_result[6];
						$kq->client_fullname  = $arr_result[7];
						$kq->client_email     = $arr_result[8];
						$kq->client_mobile    = $arr_result[9];
						$kq->card_amount      = $arr_result[10];
						$kq->amount           = $arr_result[11];
						$kq->transaction_id   = $arr_result[12];
						
						if ($kq->error_code == '00'){
						   $kq->error_message ="Nạp thẻ thành công, mệnh giá thẻ = ".$kq->card_amount;
						}
						else {
						   $kq->error_message = $this->GetErrorMessage($kq->error_code);
						}
					}
					
				}
				else $kq->error_message = $error;	
				
				return $kq;
		    }
			function getParam($param_name){
					$result = '';
					if (!empty($_POST[$param_name]))		
						$result = trim($_POST[$param_name]);
					return $result;
			}
			
			
			
  }
?>