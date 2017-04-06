<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Donate extends MX_Controller {

	private $module = 'donate';
	private $table = 'donate';
	function __construct(){
		parent::__construct();
		$this->load->model($this->module.'_model','model');
		$this->load->model('admincp_modules/admincp_modules_model');
		$this->load->model('admincp/admincp_model');
		if($this->uri->segment(1)=='admincp'){
			if($this->uri->segment(2)!='login'){
				if(!$this->session->userdata('userInfo')){
					header('Location: '.PATH_URL.'admincp/login');
					return false;
				}
				$get_module = $this->admincp_modules_model->check_modules($this->uri->segment(2));
				$this->session->set_userdata('ID_Module',$get_module[0]->id);
				$this->session->set_userdata('Name_Module',$get_module[0]->name);
			}
			$this->template->set_template('admin');
			$this->template->write('title','Admin Control Panel');
		}
		modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'r',0);
		$this->load->library('form_validation');
		// error_reporting(E_ALL);
	}
	/*------------------------------------ Admin Control Panel ------------------------------------*/
	public function admincp_index(){
		modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'r',0);
        redirect(PATH_URL."admincp/donate/transaction");
	}
	function ajaxAccountPayChart($id=0,$month = 0, $year = 0){
			$view = 'BACKEND/accountpaychart';
			$data = $this->model->getChargeChart($id,$month, $year);
		if($data){
			if($this->input->is_ajax_request())
				echo $this->load->view($view,$data,TRUE);
			else
				return $this->load->view($view,$data,TRUE);
		}
		else
			return '';
	}
	function ajaxAmountUserPayChart($id=0,$month = 0, $year = 0){
			$view = 'BACKEND/amountuserpaychart';
			$data = $this->model->getChargeAmountChart($id,$month, $year);
		if($data){
			if($this->input->is_ajax_request())
				echo $this->load->view($view,$data,TRUE);
			else
				return $this->load->view($view,$data,TRUE);
		}
		else
			return '';
	}
	function ajaxReport(){
		$server = $this->input->post('id');
		$default_func = 'created';
		$default_sort = 'DESC';
		$total = $this->model->getTotalVND($server);
		$month = $this->input->post('txtmonth');
		$year = $this->input->post('txtyear');
		$data = array(
			'module'=>$this->module,
			'module_name'=>$this->session->userdata('Name_Module'),
			'default_func'=>$default_func,
			'default_sort'=>$default_sort,
			'total'=>$total[0]->card_amount,
			'list_charge'=>$this->ajaxAccountPayChart($server,$month,$year),
			'list_charge_amount'=>$this->ajaxAmountUserPayChart($server,$month,$year)
		);
		$data['donation_member'] = $this->model->getMemberDonate($server);
		$data['donation_today'] = $this->model->getTotalVNDofDay($server);
		$data['donation_full'] = $this->model->getTotalVND($server);
		echo $this->load->view('BACKEND/ajax_loadReport',$data, TRUE);
	}
	// public function admincp_update($id=0){
	// 	if($id==0){
	// 		modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'w',0);
	// 	}else{
	// 		modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'r',0);
	// 	}
	// 	$result[0] = array();
	// 	if($id!=0){
	// 		$result = $this->model->getDetailManagement($id);
	// 	}
	// 	$data = array(
	// 		'result'=>$result[0],
	// 		'module'=>$this->module,
	// 		'id'=>$id
	// 	);
	// 	$this->template->write_view('content','BACKEND/ajax_editContent',$data);
	// 	$this->template->render();
	// }

	public function admincp_save(){
		$perm = modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'w',1);
		if($perm=='permission-denied'){
			print $perm;
			exit;
		}
		if($_POST){
			//Upload Image
			$fileName = array('image'=>'');
			if($_FILES){
				foreach($fileName as $k=>$v){
					if(isset($_FILES['fileAdmincp']['error'][$k])){
						$typeFileImage = strtolower(substr($_FILES['fileAdmincp']['type'][$k],0,5));
						if($typeFileImage == 'image'){
							$tmp_name[$k] = $_FILES['fileAdmincp']["tmp_name"][$k];
							$file_name[$k] = $_FILES['fileAdmincp']['name'][$k];
							$ext = strtolower(substr($file_name[$k], -4, 4));
							if($ext=='jpeg'){
								$fileName[$k] = time().'_'.SEO(substr($file_name[$k],0,-5)).'.jpg';
							}else{
								$fileName[$k] = time().'_'.SEO(substr($file_name[$k],0,-4)).$ext;
							}
						}else{
							print 'Only upload Image.';
							exit;
						}
					}
				}
			}
			//End Upload Image

			if($this->model->saveManagement($fileName)){
				//Upload Image
				if($_FILES){
					foreach($fileName as $k=>$v){
						if(isset($_FILES['fileAdmincp']['error'][$k])){
							$upload_path = BASEFOLDER.DIR_UPLOAD_NEWS;
							move_uploaded_file($tmp_name[$k], $upload_path.$fileName[$k]);
						}
					}
				}
				//End Upload Image
				print 'success';
				exit;
			}
		}
	}

	public function admincp_delete(){
		$perm = modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'d',1);
		if($perm=='permission-denied'){
			print $perm;
			exit;
		}
		if($this->input->post('id')){
			$id = $this->input->post('id');
			$result = $this->model->getDetailManagement($id);
			modules::run('admincp/saveLog',$this->module,$id,'Delete','Delete');
			$this->db->where('id',$id);
			if($this->db->delete(PREFIX.$this->table)){
				//Xóa hình khi Delete
				@unlink(BASEFOLDER.DIR_UPLOAD_NEWS.$result[0]->image);
				return true;
			}
		}
	}

	public function admincp_ajaxLoadContent(){
		$this->load->model('Donate/donate_model','model');
		$this->load->library('AdminPagination');
		$config['total_rows'] = $this->model->getTotalsearchContent();
		$config['per_page'] = $this->input->post('per_page');
		$config['num_links'] = 3;
		$config['func_ajax'] = 'searchContentDonate';
		$config['start'] = $this->input->post('start');
		$this->adminpagination->initialize($config);
		$result = $this->model->getsearchContent($config['per_page'],$this->input->post('start'));
		$data = array(
			'result'=>$result,
			'per_page'=>$this->input->post('per_page'),
			'start'=>$this->input->post('start'),
			'module'=>$this->module
		);
		$this->session->set_userdata('start',$this->input->post('start'));
		$this->load->view('BACKEND/ajax_loadContent',$data);
	}

	public function admincp_ajaxUpdateStatus(){
		$perm = modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'w',1);
		if($perm=='permission-denied'){
			print '<script type="text/javascript">show_perm_denied()</script>';
			$status = $this->input->post('status');
			$data = array(
				'status'=>$status
			);
		}else{
			if($this->input->post('status')==0){
				$status = 1;
			}else{
				$status = 0;
			}
			$data = array(
				'status'=>$status
			);
			modules::run('admincp/saveLog',$this->module,$this->input->post('id'),'status','update',$this->input->post('status'),$status);
			$this->db->where('id', $this->input->post('id'));
			$this->db->update(PREFIX.$this->table, $data);
		}

		$update = array(
			'status'=>$status,
			'id'=>$this->input->post('id'),
			'module'=>$this->module
		);
		$this->load->view('BACKEND/ajax_updateStatus',$update);
	}
	public function admincp_resendCoin(){
		$id = $this->input->post('id');
		$resendList = $this->model->get('*', PREFIX.$this->table, 'step = 3 AND id = '.$id.' ', "created", "asc", true);
		if( $resendList ){
			$serverIP = $this->model->get('*', 'cli_servers', "id = '".$resendList['server']."'", '', '', true);
			$port_service = (!empty($serverIP['port_service'])) ? ":".$serverIP['port_service'] : '';
			$serverIP = $serverIP['ip'];
			$fieldGame = array(
				'serviceUser'	=>	SERVICE_USER_NAP_TIEN,
				'servicePass'	=>	SERVICE_PASS_NAP_TIEN,
				'accountLogin'	=>	$resendList['username'],
				'amountMoney'	=>	$resendList['card_amount'],
				'amountGoldGet'	=>	$resendList['gcoin']
			);
			$resultGame = post("http://".$serverIP.$port_service."/WebService.asmx/NapTien", $fieldGame);
			$donate['step'] = '2';
			$this->model->update(PREFIX.$this->table, $donate, "id = ".$resendList['id']."");
			// pr($resultGame);
			print 'success';
		}
	}

	function admincp_transaction(){
        $default_func = 'created';
        $default_sort = 'DESC';
        //pr($this->session->userdata,1);
        //modules::run('admincp/chk_perm', $this->session->userdata('ID_Module'), 'r', 0);
        // if($this->session->userdata('userGroup') == 3){
        //     $game_per = $this->session->userdata('game_permission');
        //     $game_id = str_replace('all|','',$game_per);
        //     $game_id = "'".str_replace('|',"','",$game_id)."'";
        //     $servers = $this->model->get_game($game_id);
        // }
        $this->load->model("donate/donate_model");
        $servers = $this->donate_model->fetch("*", "cli_servers", "status = 1");
        //pr($servers,1);
        $data = array(
            'module' => $this->module,
            'module_name' => $this->session->userdata('Name_Module'),
            'default_func' => $default_func,
            'default_sort' => $default_sort,
            'servers' => $servers
        );
        $this->template->write_view('content', 'BACKEND/transaction', $data);
        $this->template->render();
    }
    function lookup(){
    	$s = $this->input->post();
		$mathe    = $this->input->post('mathe');
		$seri     = $this->input->post('seri');
		$username = $this->input->post('username');
		$server   = $this->input->post('server');
		$month    = $this->input->post('month');
		$status   = $this->input->post('status');
		$start    = $this->input->post('page'); $stt = $start;
        $view           = 'BACKEND/kq_transaction';

        $admin = $this->session->userdata("userInfo");
        $infoadmin = $this->model->get("*", "admin_nqt_users", "username = '{$admin}' ");
    	// if($mathe == "" && $seri == "" && $username == "" && !$server){
    	// 	echo "<div style='color: red;padding: 10px;text-align: center;'>Vui lòng nhập vào thông tin tìm kiếm </div>"; exit();
    	// }
        $config['total_rows'] = $this->model->transaction($mathe, $seri, $username,$month,$server, $status, $num_row = TRUE, $config['per_page'] = 0, $start);
        $config['per_page'] = 20;
        $data['pageLink'] = pagination_transaction($config['total_rows'], $start, $config['per_page']);
        $data['result'] = $this->model->transaction($mathe, $seri, $username,$month,$server, $status, $num_row = FALSE, $config['per_page'], $start);
        $data['stt'] = $stt;
        echo $this->load->view($view, $data, TRUE);
    }
    function delete_transaction(){
        $id = $this->input->get('id');
        $this->model->delete_transaction($id);
        redirect('/admincp/donate/transaction','refresh');
    }
	/*------------------------------------ End Admin Control Panel --------------------------------*/


	/*------------------------------------ FRONTEND ------------------------------------*/

	function luckyDonate(){
		$now = date('Y-m-d H:i:s',mktime(0,0,0));
		$donateToday = $this->db->query("SELECT count(*) as total FROM ".PREFIX.$this->table." WHERE created > '$now'")->row();
		if($donateToday)
			return $donateToday->total;
	}

	function addExtraCoin($num){
		$mod25 = ($num + 1) % 25;
		if($mod25 == 0){
			return 1;
		}
		$mod5 = ($num + 1) % 5;
		if($mod5 == 0 || $num == 0)
			return 0.5;
		return 0;
	}

	function writeWarning($link = '', $text = ''){
		$time = time();
		if($link && $text){
			$data = "<link>{$link}</link><text>{$text}</text>";
			$File = APPPATH."libraries/warning.txt";
			$fd = fopen($File, 'w');
			fwrite($fd, mb_convert_encoding($data, 'UTF-8'));
			fclose($fd);
		}
	}
	function check_detail(){
		$checkid = $this->input->post("checkdetail");
		$data = "";
		if($checkid){
			$data['bool_transaction'] = "";
			$data['bool_insertknb'] = "";
			$this->load->model("gametool/gametool_model");
            $value = $this->gametool_model->get("*", "cli_donate", "`id` = {$checkid}");

			if($value){
				if($value->flag != 1)
				{
					$data['id'] = $value->id;
					$transaction_id = $value->transaction_id;
					$data['bool_transaction'] = $this->getTransactionDetail($transaction_id);
					$data['bool_insertknb'] = $this->checklog($value->id);
				}
				else{
					$data['id'] = $value->id;
					$transaction_id = $value->transaction_id;
					$data['bool_transaction'] = $value->card_amount;
					$data['bool_insertknb'] = $value->gamecoin;
				}
			}
			echo $this->load->view("FRONTEND/check_detail", $data);
		}

	}


	function getTransactionDetail($transaction_id){
        $paydirect_charge_url   = "http://125.212.219.11/voucher/getTransactionDetail.html";
        $paydirect_partner_code = "MAXGAME";
        $paydirect_password     = "uio33h" ;
        $paydirect_secrect_key  = "9ijnhs" ;
        $card_pin ="";
        $transRef = $transaction_id;
        $sign           = MD5($transRef . $paydirect_partner_code . $paydirect_password . $paydirect_secrect_key);
        $data_pay = array(
            'transRef'    =>    $transRef,
            'partnerCode' =>    $paydirect_partner_code,
            'password'    =>    $paydirect_password,
            'signature'   =>    $sign
            );
        // pr($dataPay,1);
        $response = trim(post($paydirect_charge_url, $data_pay));
        //test
        //pr($response,1);

        $result = explode('|', $response);
        if(is_array($result)){
            if($result[0] == '01'){
              return $result[3];
            }
            else{
                $errors = array(
                    '00'    =>  "Mã số nạp tiền không tồn tại hoặc đã được sử dụng",
                    '03'    =>  "Thẻ đã được sử dụng",
                    '04'    =>  "Thẻ đã bị khóa",
                    '05'    =>  "Thẻ đã hết hạn sử dụng",
                    '06'    =>  "Thẻ chưa được kích hoạt",
                    '07'    =>  "Thực hiện sai quá số lần cho phép",
                    '08'	=>	"Giao dịch nghi vấn (Timeout từ Đơn vị phát hành thẻ, chưa xử lý xong)",
                    "09"	=>	"Sai định dạng thông tin truyền vào",
                    "10"	=>  "Partner không tồn tại",
                    "11"	=>  "Partner bị khóa",
                    "13"	=>	"Hệ thống của Đơn vị phát hành thẻ đang bận",
                    "14"	=> 	"Sai password",
                    "15"	=>	"Sai địa chỉ IP",
                    '20'    =>  "Sai độ dài mã số nạp tiền",
                    '21'    =>  "Mã giao dịch không hợp lệ",
                    '23'    =>  "Seri thẻ không hợp lệ",
                    '24'    =>  "Mã thẻ và số seri không khớp",
                    '28'    =>  "Mã số nạp tiền không đúng định dạng",
                    '26'    =>  "Mã giao dịch không tồn tại",
                    '99'    =>  "Lỗi không xác định khi xử lý giao dịch"
                    );
				if(isset($errors[$result[0]]))
                {
                	return $errors[$result[0]];
                }
                else
                	return "Chưa xác định lỗi. Cụ thể: $result[0]";

            }
        }
        return 'Truy vấn từ paydirect thất bại.';


    }

    function checklog($idlog){
        $this->load->model("gametool/gametool_model");
        $value = $this->gametool_model->get("*", "cli_donate_response", "`did` = {$idlog}");
        //pr($value,1);
        if($value){
            $request = unserialize($value->request);
            $response = unserialize($value->response);

            $MchID = 'PEGA';
            $MchOrderID = $request['MchOrderID'];
            $UserName = $request['UserName'];
            $GameID = 3;
            $Key = 12345678;
            $BeforeMD5 = "MchID=".$MchID."&MchOrderID=".$MchOrderID."&GameID=3&Key=".$Key;
            $Signature = strtoLower(md5($BeforeMD5));
            $datapost = array('MchID' => $MchID, 'MchOrderID' => $MchOrderID, "GameID" => $GameID , "Signature" => $Signature);
            $url = getServiceURL("GetOrderStatus");
            $result = cURLGet($url, $datapost);
            //pr($result,1);
            $data = xml_to_array($result);
            $return = 0;
            if(isset($data['ReturnCode']) == 1)
            {
                return 1;
            }
            else{
                return "<span style='color:#FF0000;'>CHƯA</span> nạp vào game";
            }

        }
        else{
            return "<span style='color:#FF0000;'>CHƯA</span> nạp vào game";
        }

    }

    function resendMissDonate(){
    	$checkid = $this->input->post("checkdetail");
    	//pr($checkid,1);
		$data = "";
		if($checkid){
			$data['bool_transaction'] = "";
			$data['bool_insertknb'] = "";
			$this->load->model("gametool/gametool_model");
            $value = $this->gametool_model->get("*", "cli_donate", "`id` = {$checkid}");
			//pr($value,1);
			if($value){
				if($value->flag == 1){
					echo "Thẻ đã được nạp lại!"; die;
				}
				$transaction_id = $value->transaction_id;
				//$transaction_id = "0.999003001408868076";
				$bool_transaction = $this->getTransactionDetail($transaction_id);
				$bool_insertknb = $this->checklog($value->id);
				// pr($bool_insertknb,1);

				if(is_numeric($bool_transaction) && !is_numeric($bool_insertknb)){
					$getuser = $this->model->get("*", "cli_web_users", "username = '$value->username' ");
					//pr($getuser,1); die;
					if($getuser){
						//pr($getuser,1); die;
						$money = $bool_transaction;
						$gamecoin = $bool_transaction/200;
						$username = $getuser->username;
						//$username = 'vuivui007';
						// $getuser->id = 1;
						// $value->id = 7563;
						//pr($value->id,1); die;
						$insert_knb = $this->insert_knb($getuser->id, $username, $money, $gamecoin);
						$message = "<span style='color:green'>Bạn vừa nạp thẻ thành công với mệnh giá là {$money}đ, bạn nhận được {$gamecoin} KNB. </span>";
						//pr($insert_knb,1);
						if($insert_knb === true){
								$dtup = array('step' => 2, 'flag' => 1, 'card_amount' => $money, 'gamecoin' => $gamecoin, "message" =>  $message);
								$this->db->where('id', $value->id);
								$this->db->update('cli_donate', $dtup);
								echo "Nạp lại Thành Công"; die;
						}
					}

				}
			}

		}
		echo "Thất bại. Thử lại sau!";

    }

     function insert_knb($uid, $username = '', $menhgiathe = '', $gamecoin = ''){
		$time     = time();
		$response = 1;
	    $MchID = 'PEGA';
        $MchOrderID = strtolower(str_replace('.', '', str_replace(' ', '', microtime())));
        $UserName = $username;
        $PayType = 0; //default

        $PayNum = $menhgiathe/10000; // PayNum = Amount/10000
        $ProCode = '1'; // example 100
        $Amount = 100*$PayNum; //KNB = Amount/200
        $GameID = 3;
        $Key = "SzXa0I8sayRH0AbgDqPBu8wCv6f8PScI";

        $BeforeMD5 = "MchID=".$MchID."&MchOrderID=".$MchOrderID."&UserName=".$UserName."&PayType=".$PayType."&ProCode=".$ProCode."&PayNum=".$PayNum."&Amount=".$Amount."&GameID=".$GameID."&Key=".$Key;
        $Signature = strtoLower(md5($BeforeMD5));
        $IP = getIP();
        $fieldGame = array(
            'MchID'         =>  $MchID,
            'MchOrderID'    =>  $MchOrderID,
            'UserName'      =>  $UserName,
            'PayType'       =>  $PayType,
            'ProCode'       =>  $ProCode,
            'PayNum'        =>  $PayNum,
            'GameID'        =>  $GameID,
            'Amount'        =>  $Amount,
            'BeforeMD5'     =>  $BeforeMD5,
            'Signature'     =>  $Signature,
            'IP'            =>  $IP
        );


        $url = getServiceURL("OrderAdd");
        //pr($fieldGame); pr($url);
        $result = cURLGet($url, $fieldGame);
        //pr($result);
        $data = xml_to_array($result);
        //pr($data,1);
        $return = 0;
		if(isset($data['ReturnCode']))
	    {
			return true;
		}
		else
			return false;
	}
	/*------------------------------------ End FRONTEND --------------------------------*/
}