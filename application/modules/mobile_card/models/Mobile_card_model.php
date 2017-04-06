<?php
class Mobile_card_model extends MY_Model {
	private $module                  = 'mobile_card';
	private $suffix                  = '';
	private $table                   = '';
	
	//config paydirect.vn
	private $_paydirect_charge_url   = "http://125.212.219.11/voucher/useCard.html";
	private $_paydirect_partner_code = "MAXGAME";
	private $_paydirect_password     = "uio33h" ;
	private $_paydirect_secrect_key  = "9ijnhs" ;
	
	//config 1pay
	private $_1pay_access_key        = "79k4g3g8snet7ywg8r6d" ;
	private $_1pay_secrect_key       = "mtaip7jwfj0wdwxy0q1cwuh5n8hru0yt" ;
	private $_1pay_charge_url        = 'https://api.1pay.vn/card-charging/v2/topup';
	
	//config baokim
	private $_baokim_charge_url      = 'https://www.baokim.vn/the-cao/restFul/send';
	private $_baokim_merchant_id     = '25477';
	private $_baokim_secure_pass     = 'b8e480bac6ca871b';
	private $_baokim_api_username    = 'dolongpkcom';
	private $_baokim_api_password    = 'dolongpkcomdsad';
	private $_baokim_digest_user	 = 'merchant_25477';
	private $_baokim_digest_password = '24993jshsodhis28sj8joshosdhs8y8bhudsgdys8gdw';
		
	
	//config
	private $_vnpt_webservice_url    = "http://115.78.133.42:9090/CardChargingGW/services/Services?wsdl";
	private $_vnpt_partner_id        = 'demotest';
	private $_vnpt_partner_user      = 'demotest';
	private $_vnpt_partner_password  = '123456';
	private $_vnpt_partner_code      = '00243';
	private $_vnpt_mpin              = '123456';
	private $_vnpt_target			 = 'useraccount1';

	function __construct(){
		parent::__construct();
		$this->suffix = date('_Y_n');
		//$this->table  = PREFIX . "exchange_coin" . $this->suffix;
		$this->table  = PREFIX . "donate";

		$file_config = APPPATH . "config/mobile_card_config.php";
		if(!check_exists_file($file_config)){
			$put   = "\r\n";
			$put   .= "\$config['pay_method'] = 'paydirect';\r\n";
			$path  = APPPATH."config/mobile_card_config.php";
			$file  = fopen($file_config, "w");
			$write = fwrite($file,'<?php'.$put.' ?>');
	        fclose($file);
		}

		$this->config->load('mobile_card_config', TRUE);
	}

	
	function log_request($post_data){
		if($post_data){
			
			$post_data['created'] = date('Y-m-d H:i:s');
			$post_data['flag'] = 0;

			//insert new record
			if($this->db->insert($this->table, $post_data))
				return $this->db->insert_id();
		}

		return FALSE;
	}

	function card_pay($charge_log_id, $card_type, $card_serial, $card_pin){
		ignore_user_abort(1);

		$pay_method = "";
		$datenow = date("Y-m-d H:i:s",time());

		$check = $this->model->get("*", "cli_congthanhtoan", "status = 1");
		if($check){
			$pay_method = $check->pay_method;
        	$payfrom = $check->name;

        	//Config New Account 
        	$this->_baokim_charge_url      = 'https://www.baokim.vn/the-cao/restFul/send';
			$this->_baokim_merchant_id     = '25477';
			$this->_baokim_secure_pass     = 'b8e480bac6ca871b';
			$this->_baokim_api_username    = 'dolongpkcom';
			$this->_baokim_api_password    = 'dolongpkcomdsad';
			$this->_baokim_digest_user	   = 'merchant_25477';
			$this->_baokim_digest_password = '24993jshsodhis28sj8joshosdhs8y8bhudsgdys8gdw';
		}
        else
        {   
        	$this->_paydirect_charge_url   = "http://125.212.219.11/voucher/useCard.html";
			$this->_paydirect_partner_code = "MAXGAMEG";
			$this->_paydirect_password     = "uio33hg" ;
			$this->_paydirect_secrect_key  = "9ijnhsg" ;
			$payfrom = "paydirect - MAXGAME G";
			$pay_method = "paydirect";
        }


        $function_charge = "charge_".$pay_method;
		
		$card_result = $this->$function_charge($card_type, $card_serial, $card_pin);


		//update log
		$this->charge_done($charge_log_id, $card_result, $pay_method, $payfrom);

		return $card_result;
	}

	function charge_done($log_id, $card_result, $pay_method, $payfrom){
		// if(is_local()){
		// 	pr( $card_result,1 );
		// }
		// pr($log_id);
		// pr($card_result);
		//pr($pay_method,1);
		
		if(!isset($card_result['response_code'])){
			$response_code = -1;
		}
		else{
			$response_code = $card_result['response_code'];
		}
		$dataUpdate = array(
					'finished'          =>	$card_result['status'],
					'message'           =>	$card_result['msg'],
					'pay_method'    =>	$pay_method,
					'response_code' =>  $response_code,
					'transaction_id' => $card_result['transaction_id'],
					'payfrom'		=>  $payfrom
						);
		//thẻ đúng
		if($card_result['status'] == 1){
			$dataUpdate['card_amount'] = $card_result['card_amount'];
			$dataUpdate['gamecoin']     = $card_result['card_amount'] / 10;
		}
		else{

		}
		return $this->db->where('id', $log_id)
						->update("cli_donate", $dataUpdate);
	}
	//gạch thẻ qua paydirect
	function charge_paydirect($card_type, $card_serial, $card_pin){
		$transaction_id = str_replace(' ', '', microtime());
		$retval = array(
				'status'        =>	0,
				'msg'           =>	'',
				'response_code' =>	-1,
				'card_amount'   =>	0,
				'transaction_id' => $transaction_id
				);
		$nph = array(
			'MOBIFONE'  =>	'MOBI',
			'VIETTEL'   =>	'VT',
			'VINAPHONE' =>	'VINA',
			'GATE'      =>	'GATE'
			);
		$issuer         = $nph[$card_type];
		
		$sign           = MD5($issuer . $card_pin . $transaction_id . $this->_paydirect_partner_code . $this->_paydirect_password . $this->_paydirect_secrect_key);
		$data_pay = array(
			'issuer'      => 	$issuer,
			'cardSerial'  =>	$card_serial,
			'cardCode'    =>	$card_pin,
			'transRef'    => 	$transaction_id,
			'partnerCode' =>	$this->_paydirect_partner_code,
			'password'    =>	$this->_paydirect_password,
			'signature'   =>	$sign
			);
		// pr($dataPay,1);
		$response = trim(post($this->_paydirect_charge_url, $data_pay));
		//test
		//pr($response,1);
		if($card_pin == 'hpny1402'){
			$response = trim("01|Kiem tra thanh cong|10000");
				}
		$result = explode('|', $response);
		$pending = array(8,11,13,40,41,99);
		$error = array(9,10,14,15,16,21,25,26,51,52);
		if(is_array($result)){
			if($result[0] == '01'){
				//thanh cong
				$retval = array(
					'status'        =>	1,
					'msg'           =>	'Gạch thẻ thành công',
					'response_code' =>	$result[0],
					'card_amount'   =>	$result[2],
					'transaction_id' => $transaction_id
				);
			}
			elseif(in_array($result[0], $pending)){
				$retval['msg'] = 'Hệ thống đang bận. Vui lòng thử lại sau ít phút hoặc liên hệ hỗ trợ để được giúp đỡ.';						
			}
			elseif(in_array($result[0], $error)){
				$retval['msg'] =  'Lỗi hệ thống. Vui lòng liên hệ hỗ trợ để được trợ giúp.';
			}
			else{
				$errors = array(
					'00'	=>	"Mã số nạp tiền không tồn tại hoặc đã được sử dụng",
					'03'	=>	"Thẻ đã được sử dụng",
					'04'	=>	"Thẻ đã bị khóa",
					'05'	=>	"Thẻ đã hết hạn sử dụng",
					'06'	=>	"Thẻ chưa được kích hoạt",
					'07'	=>	"Thực hiện sai quá số lần cho phép",
					'20'	=>	"Sai độ dài mã số nạp tiền",
					'23'	=>	"Seri thẻ không hợp lệ",
					'24'	=>	"Mã thẻ và số seri không khớp",
					'28'	=>	"Mã số nạp tiền không đúng định dạng"
					);
				if(isset($errors[$result[0]]))
					$retval['msg'] = $errors[$result[0]];
				else
					$retval['msg'] = "Mã thẻ hoặc số seri không khớp, vui lòng kiểm tra lại thông tin thẻ nạp.";
			}
		}
		else{
			$retval['msg'] ='Hệ thống đang bảo trì. Vui lòng thử lại sau.';
		}
		return $retval;
	}

	//gạch thẻ qua nganluong.vn
	function charge_nganluong($card_type, $card_serial, $card_pin){
		$retval = array(
			'status'        =>	0,
			'msg'           =>	'',
			'response_code' =>	-1,
			'card_amount'   =>	0
		);
		//thanh toan NL
		//random 10% chuyen qua tk vuonglechi
		//$pay_acc = $this->get_config('pay_acc', 'mobile_card_config');
		$pay_acc = 'hainam';
		if($pay_acc == 'vuonglechi'){
			include_once(APPPATH.'libraries/MobiCard_tkvuonglechi.php');
			$retval['taikhoan'] = "nganluong.vuonglechi";
		}
		else{
			include_once(APPPATH.'libraries/MobiCard.php');
			$retval['taikhoan'] = "nganluong.hainam";
		}
		$call                    = new MobiCard();
		$result                  = new Result();		
		$transaction_id          = str_replace(' ', '', microtime());
		$nph = array(
			'MOBIFONE'  =>	'VMS',
			'VIETTEL'   =>	'VIETTEL',
			'VINAPHONE' =>	'VNP',
			);
		$card_type = $nph[$card_type];
		$result    = $call->CardPay($card_pin,$card_serial,$card_type,$transaction_id,"MAXGAME",'MAXGAME','hotro@maxgame.vn');

		if($card_pin == 'hpny1402'){ // TEST
			$result->error_code = '00';
			$result->card_amount = 10000;
		}	 

		$retval['response_code'] = $result->error_code;
		$retval['transaction_id'] = $transaction_id;
		
		if($result->error_code == '00') // thẻ đúng
		{
			$retval = array(
				'status'        =>	1,
				'msg'           =>	'Gạch thẻ thành công.nl',
				'response_code' =>	$result->error_code,
				'card_amount'   =>	$result->card_amount,
				'transaction_id' => $transaction_id
			);

		}elseif($result->error_code == '18' || $result->error_code == '20' || $result->error_code == '19'){
			$retval['msg'] = $result->error_message ;
		}
		elseif(empty($result->error_message)){
			$retval['msg'] = "Thẻ đã sử dụng hoặc không được chấp nhận.";
		}
		else{
			$retval['msg'] = $result->error_message. ".";
		}
		return $retval;
	}


	function charge_1pay($card_type, $card_serial, $card_pin){
		$retval = array(
				'status'        =>	0,
				'msg'           =>	'',
				'response_code' =>	-1,
				'card_amount'   =>	0
				);
		//thanh toan NL
		//random 10% chuyen qua tk vuonglechi
		$transaction_id          = str_replace(' ', '', microtime());
		
		$tmp = "access_key=". $this->_1pay_access_key . "&pin=" . $card_pin . "&serial=" . $card_serial . "&type=" . $card_type;
		$signature = hash_hmac("sha256", $tmp, $this->_1pay_secrect_key);
		$params = array(
			'access_key' =>	$this->_1pay_access_key,
			'pin'        =>	$card_pin,
			'serial'     =>	$card_serial,
			'type'       =>	$card_type,
			'signature'  =>	$signature
			);
		$card_pay = post($this->_1pay_charge_url, $params);

		$result = json_decode($card_pay);
		if(json_last_error() == JSON_ERROR_NONE){
			$card_status             = isset($result->status) ? $result->status : 0;
			$retval['response_code'] = $card_status;
			//card test
			if($card_pin == 'hpny1402'){
				$card_status = '00';
				$result->amount = 10000;
			}	 

			if($card_status == '00'){
				//thẻ đúng
				$retval = array(
					'status'        =>	1,
					'msg'           =>	'Gạch thẻ thành công',
					'response_code' =>	$card_status,
					'card_amount'   =>	$result->amount
				);
			}
			else{
				/*Lỗi Cũ:
					'01'	=>	'Loại thẻ không được hỗ trợ hoặc gửi sai giá trị của Loại thẻ',
					'02'	=>	'Thẻ không hợp lệ hoặc đã được sử dụng',
					'10'	=>	'Lỗi không xác định',
					'13'	=>	'Lỗi hệ thống nhà mạng',
				*/
				$err = array(
					'01' => 'Lỗi, địa chỉ IP truy cập API bị từ chối',
					'02' => 'Lỗi, tham số gửi từ merchant tới chưa chính xác (thường sai tên tham số hoặc thiếu tham số)',
					'03' => 'Lỗi, merchant không tồn tại hoặc merchant đang bị khóa kết nối',
					'04' => 'Mật khẩu hoặc chữ ký xác thực không chính xác',
					'05' => 'Trùng mã giao dịch (transRef)',
					'06' => 'Mã giao dịch không tồn tại hoặc sai định dạng',
					'07' => 'Thẻ đã được sử dụng, hoặc thẻ sai',
					'08' => 'Thẻ bị khóa',
					'09' => 'Thẻ hết hạn sử dụng',
					'10' =>  'Thẻ chưa được kích hoạt hoặc không tồn tại',
					'11' => 'Mã thẻ sai định dạng',
					'12' => 'Sai số serial của thẻ',
					'13' => 'Mã thẻ và số serial không khớp',
					'14' => 'Thẻ không tồn tại',
					'15' => 'Thẻ không sử dụng được',
					'16' => 'Số lần thử (nhập sai liên tiếp) của thẻ vượt quá giới hạn cho phép',
					'17' => 'Hệ thống đơn vị phát hành (Telco) bị lỗi hoặc quá tải, thẻ chưa bị trừ',
					'18' => 'Hệ thống đơn vị phát hành (Telco) bị lỗi hoặc quá tải, thẻ có thể bị trừ, cần phối hợp với 1pay.vn để tra soát',
					'19' => 'Đơn vị phát hành không tồn tại',
					'20' => 'Đơn vị phát hành không hỗ trợ nghiệp vụ này',
					'21' => 'Không hỗ trợ loại card này',
					'22' => 'Kết nối tới hệ thống đơn vị phát hành (Telco) bị lỗi, thẻ chưa bị trừ (thường do lỗi kết nối với Telco, ví dụ sai tham số kết nối, mà không liên quan đến merchant)',
					'23' => 'Kết nối 1Pay tới hệ thống đơn vị cung cấp bị lỗi, thẻ chưa bị trừ',
					'99' => 'Lỗi, tuy nhiên lỗi chưa được định nghĩa hoặc chưa xác định được nguyên nhân'
					);
				$retval['msg'] = $err[$card_status];
			}
		}
		else{
			$retval['msg'] ='Hệ thống đang bảo trì. Vui lòng thử lại sau.';
		}

		return $retval;
	}

	/*----------------------FRONTEND----------------------*/
	function update_card_pay($log_id, $game_response,  $gamecoin = 0, $table_suffix = ''){
		if($table_suffix)
			$table = PREFIX . "exchange_coin" . $table_suffix;
		else
			$table = $this->table;
		$check = $this->get('*', $table, "id = {$log_id}");
		if($check){
			$this->db->set('gamecoin',$gamecoin)
					 ->set('game_response', strip_tags($game_response))
					 ->where('id', $log_id)
					 ->update($table);
			return TRUE;
		}
		else
			return "Mã giao dịch không tồn tại";

	}


	function get_config($name = ''){
		if($name)
			return $this->config->item($name, 'mobile_card_config');
		else
			return FALSE;
	}

	function save_config($pay_method = 'paydirect', $pay_acc = 'hainam'){
		$file_config = APPPATH . "config/mobile_card_config.php";
		$put   = "\r\n";
		$put   .= "\$config['pay_method'] = '$pay_method';\r\n";
		if($pay_method == 'nganluong')
			$put   .= "\$config['pay_acc'] = '$pay_acc';\r\n";
		$path  = APPPATH."config/mobile_card_config.php";
		$file  = fopen($file_config, "w");
		$write = fwrite($file,'<?php'.$put.' ?>');
        fclose($file);
		return TRUE;

	}


	/*--------------------END FRONTEND--------------------*/
	function charge_baokim($card_type, $card_serial, $card_pin){
		//tạo mã giao dịch
		$transaction_id          = str_replace(' ', '', microtime());
		$retval = array(
				'status'        =>	0,
				'msg'           =>	'',
				'response_code' =>	-1,
				'card_amount'   =>	0,
				'transaction_id' => $transaction_id
				);
		
		//lấy mã nhà mạng tương ứng
		$nph = array(
			'MOBIFONE'  =>	'MOBI',
			'VIETTEL'   =>	'VIETEL',
			'VINAPHONE' =>	'VINA',
			'GATE'		=>	'GATE'
			);
		$card_type = $nph[$card_type];

		
		//tham số gửi qua webservice
		$params = array(
			'merchant_id'    =>	$this->_baokim_merchant_id,
			'api_username'   =>	$this->_baokim_api_username,
			'api_password'   =>	$this->_baokim_api_password,
			'transaction_id' =>	$transaction_id,
			'card_id'        =>	$card_type,
			'pin_field'      =>	$card_pin,
			'seri_field'     =>	$card_serial,
			'algo_mode'      =>	'hmac'
			);

		//tạo mã xác nhận request
		ksort($params);
		$sign = hash_hmac('SHA1',implode('',$params),$this->_baokim_secure_pass);;
		$params['data_sign'] = $sign;
			
		$result    = $this->baokim_charge($params);

		// if(is_local()){
		// 	pr($result);
			
		// }
		//pr($result);
		if($card_pin == 'hpny1402'){ // TEST
			$result->status_code = 200;
			$result->amount = 100000;
		}	 

		$retval['response_code'] = $result->status_code;
		
		if($result->status_code == 200) // thẻ đúng
		{
			$retval = array(
				'status'        =>	1,
				'msg'           =>	'Gạch thẻ thành công',
				'card_amount'   =>	$result->amount,
				'transaction_id' => $transaction_id
				);

		}elseif($result->status_code == 460){
			$retval['msg'] = $result->errorMessage ;
		}
		elseif($result->errorMessage == 202){
		 	//Thẻ trễ	 Giao dịch chưa xác định được trạng thái thành công hay không! TimeOut
			$retval['msg'] = "Hệ thống Telco quá tải, thẻ có thể bị trừ, vui lòng liên hệ hỗ trợ để được giúp đỡ";
		}
		else{
			//450 and esle
			$retval['msg'] = $result->errorMessage. ".";
		}
		//pr($retval,1);
		return $retval;
	}

	function baokim_charge($params = array()){
		$retval = new StdClass;
		$curl = curl_init($this->_baokim_charge_url);

		curl_setopt_array($curl, array(
			CURLOPT_POST           =>true,
			CURLOPT_HEADER         =>false,
			CURLINFO_HEADER_OUT    =>true,
			CURLOPT_TIMEOUT        =>30,
			CURLOPT_RETURNTRANSFER =>true,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_HTTPAUTH       =>CURLAUTH_DIGEST|CURLAUTH_BASIC,
			CURLOPT_USERPWD        =>$this->_baokim_digest_user.':'.$this->_baokim_digest_password,
			CURLOPT_POSTFIELDS     =>http_build_query($params)
		));

		$data = curl_exec($curl);
		$retval = json_decode($data);
		$retval->status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

		

		return $retval;

	}

	function charge_vnpt($card_type, $card_serial, $card_pin){
		$retval = array(
				'status'        =>	0,
				'msg'           =>	'',
				'response_code' =>	-1,
				'card_amount'   =>	0
				);
		$result = new StdClass;
		//lấy mã nhà mạng tương ứng
		$nph = array(
			'MOBIFONE'  =>	'VMS',
			'VIETTEL'   =>	'VTT',
			'VINAPHONE' =>	'VNP',
			);
		$card_type = $nph[$card_type];


		require_once("application/libraries/libs/nusoap.php");	
		include("application/libraries/Entries.php");	
		// load SOAP library		
		$soapClient = new SoapClient(null, array('location' => $this->_vnpt_webservice_url, 'uri' => "http://113.161.78.134/VNPTEPAY/"));

		$CardCharging                 = new CardCharging();
		$CardCharging->m_UserName     = $this->_vnpt_partner_user;
		$CardCharging->m_PartnerID    = $this->_vnpt_partner_id;
		$CardCharging->m_MPIN         = $this->_vnpt_mpin;
		$CardCharging->m_Target       = $this->_vnpt_target;
		$CardCharging->m_Card_DATA    = $card_serial.":".$card_pin.":"."0".":".$card_type;
		$CardCharging->m_SessionID    = "";
		$CardCharging->m_Pass         = $this->_vnpt_partner_password;
		$CardCharging->soapClient     = $soapClient;
		
		$transaction_id                      = $this->_vnpt_partner_code.date("YmdHms");//gen transaction id

	
		$CardCharging->m_TransID      = $transaction_id;
		$CardChargingResponse         = new CardChargingResponse();
		$CardChargingResponse         = $CardCharging->CardCharging_();
		$result->transaction_status = $CardChargingResponse->m_Status;
		$result->card_amount        = $CardChargingResponse->m_RESPONSEAMOUNT;
		$result->transaction_id     = $CardChargingResponse->m_TRANSID;

		
		$retval['response_code'] = $result->transaction_status;

		pr($retval,1);
		//card test
		if($card_pin == 'hpny1402'){
			$result->transaction_status = 1;
			$result->card_amount = 10000;
		}	 

		if($result->transaction_status == 1){
			//thẻ đúng
			$retval = array(
				'status'        =>	1,
				'msg'           =>	'Gạch thẻ thành công',
				'response_code' =>	$result->transaction_status,
				'card_amount'   =>	$result->card_amount
			);
		}
		else{
			$err = array(
				'-1'  =>	'Thẻ đã sử dụng',
				'-2'  =>	'Thẻ đã bị khóa, hãy kiểm tra lại mã thẻ',
				'-3'  =>	'Thẻ hết hạn sử dụng',
				'-4'  =>	'Mã thẻ chưa được kích hoạt',
				'-10' =>	'Mã thẻ sai định dạng',
				'-12' =>	'Thẻ không tồn tại',
				'-99' =>	'Mã thẻ hoặc seri không đúng định dạng',
				'4'   =>	'Thẻ không sử dụng được',
				'9'   =>	'Mạng Mobifone đang quá tải, vui lòng thử lại sau',
				'50'  =>	'Thẻ đa sử dụng hoặc không tồn tại',
				'51'  =>	'Seri thẻ không đúng',
				'52'  =>	'Mã thẻ và số seri không khớp',
				'53'  =>	'Seri hoặc mã thẻ không đúng',
				'54'  =>	'Thẻ chưa được kích hoạt, liên hệ với tổng đài nhà mạng để được giúp đỡ',
				'55'  =>	'Thẻ tạm thời bị nhà mạng khóa trong vòng 24h',
				'99'  =>	'Giao dịch tạm giữ, vui lòng liên hệ hỗ trợ để được trợ giúp'
				);
			if(array_key_exists($result->transaction_status, $err))
				$retval['msg'] = $err[$result->transaction_status];
			else
				$retval['msg'] = "Hệ thống quá tải hoặc đang bảo trì, vui lòng thử lại sau";
		}

		return $retval;
	}


	function saveManagement(){
		if($this->input->post('statusAdmincp')=='on'){
			$status = 1;
		}else{
			$status = 0;
		}
		$data = array(
			'name'       => trim($this->input->post('nameAdmincp')),
			'status'     => $status,
			'pay_method' => $this->input->post('payAdmincp'),
			'created'    => date('Y-m-d H:i:s')
		);
		if($this->input->post('hiddenIdAdmincp')==0){
			//Kiểm tra đã tồn tại chưa?
			$checkData = $this->db->where('pay_method', $this->input->post('payAdmincp'))->get(PREFIX."congthanhtoan");
			if($checkData->num_rows() > 0){
				print 'error-title-exists';
				exit;
			}
			if($status) $this->db->set('status', 0)->update(PREFIX."congthanhtoan");
			if($this->db->insert(PREFIX."congthanhtoan",$data)){
				modules::run('admincp/saveLog',$this->module,$this->db->insert_id(),'Add new','Add new');
				return true;
			}
		}else{
			unset($data['created']);
			if($status) $this->db->set('status', 0)->update(PREFIX."congthanhtoan");
			$this->db->where('id',$this->input->post('hiddenIdAdmincp'));
			if($this->db->update(PREFIX."congthanhtoan",$data)){
				return true;
			}
		}
		return false;
	}

	function getDetailManagement($id){
		$this->db->select('*');
		$this->db->where('id',$id);
		$query = $this->db->get(PREFIX."congthanhtoan");
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}


	function saveLog($func, $func_id, $field, $type, $old_value = '', $new_value = '')
    {
        if ($field != '') {
            $data = array(
                'function' => $func,
                'function_id' => $func_id,
                'field' => $field,
                'type' => $type,
                'old_value' => $old_value,
                'new_value' => $new_value,
                'account' => "api",
                'ip' => getIP(),
                'created' => date('Y-m-d H:i:s')
            );
            $this->db->insert('admin_nqt_logs', $data);
        } else {
            foreach ($new_value as $k => $v) {
                if ($v != $old_value[0]->$k) {
                    $data = array(
                        'function' => $func,
                        'function_id' => $func_id,
                        'field' => $k,
                        'type' => $type,
                        'old_value' => $old_value[0]->$k,
                        'new_value' => $v,
                        'account' => 'api',
                        'ip' => getIP(),
                        'created' => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('admin_nqt_logs', $data);
                }
            }
        }
    }
}
