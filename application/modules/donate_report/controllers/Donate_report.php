<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Donate_report extends MX_Controller {
	private $module = 'donate_report';
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
		$this->load->library('form_validation');
	}
	/*------------------------------------ Admin Control Panel ------------------------------------*/
	public function admincp_index(){
		modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'r',0);
		$default_func = 'created';
		$default_sort = 'DESC';
		$total = $this->model->getTotalVND();
		$data = array(
			'module'=>$this->module,
			'module_name'=>$this->session->userdata('Name_Module'),
			'default_func'=>$default_func,
			'default_sort'=>$default_sort,
			'total'=>$total[0]->card_amount,
			'list_charge'=>$this->ajaxAccountPayChart(0,date('n'),date('Y')),
			'list_charge_amount'=>$this->ajaxAmountUserPayChart(0,date('n'),date('Y')),
			'list_server'=>$this->model->fetch('*',PREFIX.'servers','','status','desc')
		);
		$data['donation_member'] = $this->model->getMemberDonate();
		$data['donation_today'] = $this->model->getTotalVNDofDay();
		$data['donation_full'] = $this->model->getTotalVND();
		$data['total_person'] = $this->model->getTotalPerson();
		$this->template->write_view('content','BACKEND/index',$data);
		$this->template->render();
	}
	function ajaxAccountPayChart($id=0,$month = 0, $year = 0){
		$view = 'BACKEND/accountpaychart';
		if($this->input->post()){
			$DateStart = date("Y-m-d",strtotime($this->input->post("DateStart")));
    		$DateEnd = date("Y-m-d", strtotime($this->input->post("DateEnd")));
    		$this->load->model("donate_report/donate_report_model");
//			$data = $this->donate_report_model->getChargeChart($DateStart, $DateEnd);

    		$diff = abs(strtotime($DateEnd) - strtotime($DateStart));
    		$years = floor($diff / (365*60*60*24));
    		$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
    		if($months > 0){
    			for($i = 0; $i<= $months; $i++){
    				$month = date("n", strtotime("+".$i." day", strtotime($DateStart)));
    				$data = $this->model->getChargeChartDate($DateStart, $DateEnd);
    			}
    		}
    		else{
    			$data = $this->model->getChargeChartDate($DateStart, $DateEnd);
    			//pr($data,1);

    		}

		}
		else
		{

			$data = $this->model->getChargeChart($id,$month, $year);
		}
		//pr($data,1);

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

		if($this->input->post()){
			$DateStart = date("Y-m-d",strtotime($this->input->post("DateStart")));
    		$DateEnd = date("Y-m-d", strtotime($this->input->post("DateEnd")));
    		$this->load->model("donate_report/donate_report_model");
//			$data = $this->donate_report_model->getChargeChart($DateStart, $DateEnd);

    		$diff = abs(strtotime($DateEnd) - strtotime($DateStart));
    		$years = floor($diff / (365*60*60*24));
    		$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
    		if($months > 0){
    			for($i = 0; $i<= $months; $i++){
    				$month = date("n", strtotime("+".$i." day", strtotime($DateStart)));
    				$data = $this->model->getChargeAmountChartDate($DateStart, $DateEnd);
    			}
    		}
    		else{
    			$data = $this->model->getChargeAmountChartDate($DateStart, $DateEnd);
    			//pr($data,1);

    		}

		}
		else
		{

			$data = $this->model->getChargeAmountChart($id,$month, $year);
		}
			// pr($data,1);
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
		$server = $this->input->post('id');
		$this->load->library('AdminPagination');
		$config['total_rows'] = $this->model->getTotalsearchContent();
		$config['per_page'] = $this->input->post('per_page');
		$config['num_links'] = 3;
		$config['func_ajax'] = 'searchContentDonate';
		$config['start'] = $this->input->post('start');
		$this->adminpagination->initialize($config);

		$result = $this->model->getsearchContent($config['per_page'],$this->input->post('start'));
		$servers = $this->model->fetch("*", "cli_servers", "status = 1");
		$data = array(
			'result'=>$result,
			'per_page'=>$this->input->post('per_page'),
			'start'=>$this->input->post('start'),
			'module'=>$this->module,
			'servers' => $servers
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
		// pr($_POST,1);
		$id = $this->input->post('id');
		$resendList = $this->model->get('*', PREFIX.$this->table, 'step = 3 AND id = '.$id.' ', "created", "asc", true);
		//pr($resendList,1);
		if( $resendList ){
			$username = $resendList['username'];
			$server_id = $resendList['server_id'];
			//pr($username,1);
			$user = $this->model->get('*', PREFIX . "web_users", "`username` = '{$username}' ");
			//pr($user,1);
			$this->load->model("servers/servers_model");
			$resultGame = $this->servers_model->insert_knb($user->id, $server_id, $resendList['gamecoin']);
			//pr($resultGame);
			if($resultGame == TRUE)
			{
				$donate['step'] = '2';
				$this->model->update(PREFIX.$this->table, $donate, "id = ".$resendList['id']."");
				print 'success';
			}
			else
			{
				print 'fail';
			}

		}
	}
	/*------------------------------------ End Admin Control Panel --------------------------------*/


	/*------------------------------------ FRONTEND ------------------------------------*/
	function charge(){
		$output = array(); $output['state'] = 0;
		$captcha = md5(strtolower($_POST['valcapt']));

		// pr( $_SESSION, 1);

  //       if($captcha != $_SESSION['captcha']){
  //       	$output['msg'] = "Mã xác nhận không chính xác";
  //       	echo json_encode($output);
  //       	exit();
  //       }

		$this->load->model('donate_config/donate_config_model', 'dmodel');
		$this->load->model('servers/servers_model');
		$this->load->model('user/user_model');
		$this->load->model('mobile_card/mobile_card_model');
		$timelimit    = $this->session->userdata('timelimit');
		$username     = $this->session->userdata('username');
		$user         = $this->model->get('*', PREFIX . "web_users", "`username` = '$username'");
		$post_data    = $this->input->post();
		$data['rate'] =  $rate_km   = $this->dmodel->get_config('rate');
		$success      = '';
		$error        = '';
		if(!$username){
			$output['msg'] = "Mã xác nhận không chính xác";
			echo json_encode($output);
			exit();
		}
		if(!$post_data){
			$output['msg'] = "Vui lòng điền đầy đủ thông tin";
			echo json_encode($output);
			exit();
		}
		$server_id = $this->input->post("servers_id");
		if($timelimit > time()){
			$output['msg'] = "Gửi yêu cầu quá nhanh, vui lòng đợi trong giây lát rồi thử lại";
			echo json_encode($output);
			exit();
		}
		$this->form_validation->set_rules('card_type','Loại thẻ cào','required');
		$this->form_validation->set_rules('card_pin','Mã thẻ','required');
		$this->form_validation->set_rules('card_serial','Số serial','required');
		$this->form_validation->set_error_delimiters('<p class="errors">','</p>');
		if($this->form_validation->run() === TRUE){
			//pr($_POST,1);
			$card_type   = $post_data['card_type'];
			$card_serial = str_replace(" ","",trim($post_data['card_serial']));
			$card_serial = str_replace("-","",$card_serial);
			$card_pin = str_replace(" ","",trim($post_data['card_pin']));
			$card_pin = str_replace("-","",$card_pin);
			$params = array(
				'server_id'    =>  $server_id,
				'username'     =>  $username,
				'card_type'    =>  $card_type,
				'card_serial'  =>  $card_serial,
				'card_pin'     =>  $card_pin,
				'ip'           =>  getIP(),
				'utm_medium'   =>  $user->utm_medium,
				'utm_source'   =>  $user->utm_source,
				'utm_campaign' =>  $user->utm_campaign,
				'promotion'    =>  $rate_km,
				'created'      => date("Y-m-d H:i:s")
				);
			if($this->db->insert(PREFIX."donate", $params)){
				$charge_log_id = $this->db->insert_id();
			}
			else{
				$output['msg'] = "Vui lòng quay lại trong vài phút";
				echo json_encode($output);
				exit();
			}
			$rs = $this->mobile_card_model->card_pay($charge_log_id, $card_type, $card_serial, $card_pin);
			if(!$rs){
				$output['msg'] = "Hệ thống đang gặp sự cố, vui lòng thử lại sau";
				echo json_encode($output);
				exit();
			}
			$gamecoin_config = $this->dmodel->gamecoin_config($rs['card_amount'], $server_id);
			if($rs['status'] == 1){
				// LOG THẺ
				$this->model->log_donate($charge_log_id, $rs, $params, $gamecoin_config);
				//call API add KNB
				$this->load->model("servers/servers_model");
				$insert_knb = $this->servers_model->insert_knb($server_id, $user->id, $user->username,$rs['card_amount'], $gamecoin_config['gamecoin'] + $gamecoin_config['gamecoin_km'], $charge_log_id);
				if($insert_knb['status'] == 1){
					if($gamecoin_config['gamecoin_km'] > 0){
						$success   = "Bạn vừa nạp thẻ thành công với mệnh giá là ".number_format($rs['card_amount'],0,'.','.') ."đ, bạn nhận được ".$gamecoin_config['gamecoin']." Gamecoin và ".$gamecoin_config['gamecoin_km']." Gamecoin khuyến mãi";
					}else{
						$success   = "Bạn vừa nạp thẻ thành công với mệnh giá là ".number_format($rs['card_amount'],0,'.','.') ."đ, bạn nhận được ".$gamecoin_config['gamecoin']." Gamecoin.";
					}

					$TxtMenhGia = $rs['card_amount'];

					$success .= $this->actionEvent($server_id, $rs['card_amount']);
					$output['msg'] = $success;

					$this->model->set_done($charge_log_id, $success, $gamecoin_config['gamecoin'], 1);
					$output['state'] = 1;
					$output['html'] = $insert_knb['html'];
				}
				else{
					$error = "Thẻ nạp vào vào game, nhưng chưa vào tài khoản. Vui lòng liên hệ admin";
					$this->model->set_done($charge_log_id, $error, $gamecoin_config['gamecoin'], 0);
					$output['msg'] = $error;
				}
			}
			else{
				$this->session->set_userdata('timelimit', time() + 20);
				$output['msg']  = $rs['msg'];
			}
			$this->session->set_flashdata('alert','Thẻ nạp vào vào game, nhưng chưa vào tài khoản. Vui lòng liên hệ admin');
			$this->session->set_flashdata('success',$success);
			echo json_encode($output);
		}else{
			$this->session->set_userdata('timelimit', time() + 20);
			$output['msg'] = "Vui lòng điền đầy đủ thông tin";
			echo json_encode($output);
			exit();
		}
	}

	function actionEvent($server_id, $amount, $username=0){
		if(!$username){
			$username = $this->session->userdata('username');
			$uid = $this->session->userdata('uid');
		}else{
			$user = $this->model->get('id','cli_web_users', "username = '{$username}'");
			$uid = $user->id;
		}
		$success = '';
		
		if(0){
			$vq = modules::run('vongquay/addLuotQuayPayment', $amount);
			$success = ' Chúc mừng bạn nhận được $vq lượt vòng quay ';
		}

		if(0){
			$luotlatbai = floor($amount / 10000);
			$dt_in = array('uid' => $uid, 'username' => $username, 'count' => $luotlatbai, 'created' => date("Y-m-d H:i:s", time()));
			$this->db->insert("cli_lathinh_user", $dt_in);
			$success .= ".Bạn nhận được $luotlatbai lượt lật bài.";
		}
		if(0){
			$checkluot = '';
			$luot = 0;
			$checkluot = $this->model->get("count",'cli_lixi_card',"username = '{$username}'");
			$luot = intval($amount/10000);
			if(empty($checkluot)){
				$dtluot = array('user_id' => $uid,  'username' => $username, 'count' => $luot, 'created' => date("Y-m-d H:i:s", time()));
				$this->db->insert("cli_lixi_card", $dtluot);
			}
			else{
				$luot = $checkluot->count + $luot;
				$this->db->where('username', $username)->set('count', $luot)->update('cli_lixi_card');
			}
				$success .= "<br/>Số lượt nhận lì xì: ".$luot ;
		}

		if(0){
			$check_vs = modules::run('vipshop/check_event'); 
	        if($check_vs){
				$rs_vs = modules::run("vipshop_coin/add_coin", $amount, $server_id, 1);
	            $success   .= "<br>".$rs_vs."<br>";
	        }
        }

		//$check_con = modules::run('daptrung_config/check_event');
		if( 0 ){ //qua thoi gian tren thi ko cho add bua them nua
			$bua = floor($amount / 10000);
			$type = array('count'=>$bua,'message'=>'Nạp thẻ');
			$this->load->model('daptrung/daptrung_model');
			$user = $this->model->get("*", "cli_web_users", "username = '$username'");
			$this->daptrung_model->addCount($user, $type);
			$success .= "<br/>Chúc mừng bạn nạp card $amount VNĐ, bạn nhận được $bua lượt đập trứng.<br/>";
		}


		$data = array(
           'user_id'=> $uid ,
           'username' => $username,
           'server_id' => $server_id,
           'point' => $amount,
           'created' => date("Y-m-d H:i:s", time())
        );
        $this->db->insert('cli_log_pointcard', $data);
        
		$bool = Modules::run("tichluy/insert_money", $amount, $server_id);
		if($bool){
			$success .= ".Bạn đã nạp tiền tích lũy thêm ".$amount. ".Xem sự kiện tích lũy ở top menu trong game";
		}
		
		return $success;
	}

	/* Start of VipShop */
	function changeCoin(){
		$data = array();
		$id = $this->input->post('servers');
		$msg = $this->input->post('msg');
		if($id){
			$data['servers'] = $this->model->get('*','cli_servers',"id = {$id}");
			$this->db->select('*,sum(gamecoin) as total_point');
			$this->db->where('username',$this->session->userdata('username'));
			$this->db->where('server_id',$id);
			$this->db->group_by('username');
		   	$query = $this->db->get(PREFIX.'log_gamecoin');
		   	if($query->num_rows() > 0){
				$msg .= "<br />Tổng Gamecoin của bạn trên server: ".$query->row()->total_point;
			}
		}
		$data['msg'] = $msg;
		$this->load->view('FRONTEND/changecoin', $data);
	}

	function charge_vipshop(){
		$output = array(); $output['state'] = 0;
		$captcha = md5(strtolower($_POST['valcapt']));
        if($captcha != $_SESSION['captcha']){
        	$output['msg'] = "Mã xác nhận không chính xác";
        	echo json_encode($output);
        	exit();
        }

		$this->load->model('donate_config/donate_config_model', 'dmodel');
		$this->load->model('servers/servers_model');
		$this->load->model('user/user_model');
		$this->load->model('mobile_card/mobile_card_model');
		$timelimit    = $this->session->userdata('timelimit');
		$username     = $this->session->userdata('username');
		$user         = $this->model->get('*', PREFIX . "web_users", "`username` = '$username'");
		$post_data    = $this->input->post();
		$data['rate'] =  $rate_km   = $this->dmodel->get_config('rate');
		$success      = '';
		$error        = '';
		if(!$username){
			$output['msg'] = "Mã xác nhận không chính xác";
			echo json_encode($output);
			exit();
		}
		if(!$post_data){
			$output['msg'] = "Vui lòng điền đầy đủ thông tin";
			echo json_encode($output);
			exit();
		}
		$server_id = $this->input->post("servers_id");
		if($timelimit > time()){
			$output['msg'] = "Gửi yêu cầu quá nhanh, vui lòng đợi trong giây lát rồi thử lại";
			echo json_encode($output);
			exit();
		}
		$this->form_validation->set_rules('card_type','Loại thẻ cào','required');
		$this->form_validation->set_rules('card_pin','Mã thẻ','required');
		$this->form_validation->set_rules('card_serial','Số serial','required');
		$this->form_validation->set_error_delimiters('<p class="errors">','</p>');
		if($this->form_validation->run() === TRUE){
			//pr($_POST,1);
			$card_type   = $post_data['card_type'];
			$card_serial = str_replace(" ","",trim($post_data['card_serial']));
			$card_serial = str_replace("-","",$card_serial);
			$card_pin = str_replace(" ","",trim($post_data['card_pin']));
			$card_pin = str_replace("-","",$card_pin);
			$params = array(
				'server_id'    =>  $server_id,
				'username'     =>  $username,
				'card_type'    =>  $card_type,
				'card_serial'  =>  $card_serial,
				'card_pin'     =>  $card_pin,
				'ip'           =>  getIP(),
				'utm_medium'   =>  $user->utm_medium,
				'utm_source'   =>  $user->utm_source,
				'utm_campaign' =>  $user->utm_campaign,
				'promotion'    =>  $rate_km,
				'created'      => date("Y-m-d H:i:s")
				);
			if($this->db->insert(PREFIX."donate", $params)){
				$charge_log_id = $this->db->insert_id();
			}
			else{
				$output['msg'] = "Vui lòng quay lại trong vài phút";
				echo json_encode($output);
				exit();
			}
			$rs = $this->mobile_card_model->card_pay($charge_log_id, $card_type, $card_serial, $card_pin);
			if(!$rs){
				$output['msg'] = "Hệ thống đang gặp sự cố, vui lòng thử lại sau";
				echo json_encode($output);
				exit();
			}
			$gamecoin_config = $this->dmodel->gamecoin_config($rs['card_amount'], $server_id);
			if($rs['status'] == 1){
				// LOG THẺ
				$this->model->log_donate($charge_log_id, $rs, $params, $gamecoin_config);
				//call API add KNB
				// $this->load->model("servers/servers_model");
				// $insert_knb = $this->servers_model->insert_knb($server_id, $user->id, $user->username,$rs['card_amount'], $gamecoin_config['gamecoin'] + $gamecoin_config['gamecoin_km'], $charge_log_id);
				if(1){
					if($gamecoin_config['gamecoin_km'] > 0){
                        $success   = "Bạn vừa nạp thẻ thành công với mệnh giá là ".number_format($rs['card_amount'],0,'.','.') ."đ";
                    }else{
                        $success   = "Bạn vừa nạp thẻ thành công với mệnh giá là ".number_format($rs['card_amount'],0,'.','.') ."đ";
                    }

                    $check_vs = modules::run('vipshop/check_event'); 
                    if($check_vs){
	                    $rs_vs = modules::run("vipshop_coin/add_coin",$rs['card_amount'], $server_id, 2);
	                    $success   .= "<br>".$rs_vs."<br>";
                    }

					// $TxtMenhGia = $rs['card_amount'];

					// $success .= $this->actionEvent($server_id, $rs['card_amount']);

					$output['msg'] = $success;

					$this->model->set_done($charge_log_id, $success, $gamecoin_config['gamecoin'], 1);
					$output['state'] = 1;
				}
				else{
					$error = "Thẻ nạp vào vào game, nhưng chưa vào tài khoản. Vui lòng liên hệ admin";
					$this->model->set_done($charge_log_id, $error, $gamecoin_config['gamecoin'], 0);
					$output['msg'] = $error;
				}
			}
			else{
				$this->session->set_userdata('timelimit', time() + 20);
				$output['msg']  = $rs['msg'];
			}
			$this->session->set_flashdata('alert','Thẻ nạp vào vào game, nhưng chưa vào tài khoản. Vui lòng liên hệ admin');
			$this->session->set_flashdata('success',$success);
			echo json_encode($output);
		}else{
			$this->session->set_userdata('timelimit', time() + 20);
			$output['msg'] = "Vui lòng điền đầy đủ thông tin";
			echo json_encode($output);
			exit();
		}
	}
	/* End of Vipshop */
	function admincp_resendCard(){
		modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'r',0);
		$default_func = 'created';
		$default_sort = 'DESC';
		$total = $this->model->getTotalVND();
		$data = array(
			'module'=>$this->module,
			'module_name'=>$this->session->userdata('Name_Module'),
			'default_func'=>$default_func,
			'default_sort'=>$default_sort,
		);
		$data['servers'] = $this->model->fetch('id, name','cli_servers','status > 0');
		$this->template->write_view('content','BACKEND/resendCard',$data);
		$this->template->render();
	}
	function processResend(){
		$data = $this->input->post();
		if(!$data['username'] || !$data['card_amount'] || !$data['card_serial'] || !$data['card_pin'] || !$data['pay_method'] || !$data['card_type'] || !$data['server_id']){
			echo "0Vui lòng điền đầy đủ thông tin";
			exit();
		}
		if(!is_numeric($data['card_amount']) || $data['card_amount'] < 10000){
			echo "0Mệnh giá thẻ ít nhất là 10000VNĐ";
			exit();
		}
		$message = "Admin add lại thẻ <br>";
		$message .= $this->actionEvent($data['server_id'], $data['card_amount']);
		$data['message'] = $message;
		$data['created'] = date('Y-m-d H:i:s');
		$this->db->insert(PREFIX.$this->table, $data);
		echo "1"+$message;
	}

	function api_check_donate() {

		if (!isset($_GET['month'])) {
			$_GET['month'] = date('Y-m');
		}

		$query = $this->db->query("SELECT sum(card_amount) as card,pay_method FROM cli_donate WHERE  DATE_FORMAT(created,'%Y-%m')='" . $_GET['month'] . "' GROUP BY pay_method ");
		$result[PATH_URL]['full'] = $query->result_array();

		$_GET['month_15'] = $_GET['month'] . "-15";
		$query = $this->db->query("SELECT sum(card_amount) as card,pay_method FROM cli_donate WHERE  DATE_FORMAT(created,'%Y-%m-%d')>='" . $_GET['month'] . "-00' AND DATE_FORMAT(created,'%Y-%m-%d')<='" . $_GET['month_15'] . "'   GROUP BY pay_method ");
		$result[PATH_URL]['15'] = $query->result_array();
		echo json_encode($result);
	}

	function indexdemo(){
		echo file_get_contents("https://google.com.vn");
	}

	function checkcharacter($username, $server_id){
		$this->load->model("servers/servers_model");
		$server = $this->servers_model->get('*', PREFIX.'servers', "id = $server_id");
		$user = $this->servers_model->get("*", "cli_web_users", "username = '$username'");
		if($server){
        	$url = getServiceURL($server, "MG_get_player_by_username.php");
        	//pr($url);
        	$username2 = md5($username.'^**^tiendatnn@@^');
			$game_user = $username."_".$username2."_{$server->idplay}";
			//pr($game_user,1);
			$data = array('user_name' => $game_user , 'server_id' => $server->idplay);
			//pr($data);
			$bool = cURLGet($url, $data);
			//pr($bool,1);
        	$bool = json_decode($bool);
        	if(isset($bool->name) && $bool->name!= 'null' && $bool->name!= ''){
        		return 1; die;
        	}
        	return 0; die;
		}
       // http://client.magioi.vn:8686/API/?user_name=htuan2_926cceff729ce5386ec527a64d3af274_1&server_id=1
    }

    function pagedonate_new(){
    	$username     = $this->session->userdata('username');
    	$this->load->model("donate_report_model", "model");
		$user         = $this->model->get('*', PREFIX . "web_users", "`username` = '$username'");
		if(is_local()){
			$data['servers']        = $this->model->fetch('*', PREFIX . "servers", "");
		}
		else{
			$data['servers']        = $this->model->fetch('*', PREFIX . "servers", "status = 1");
		}

		if(!$user){
			redirect(PATH_URL."dang-nhap");
		}
    	$this->template->write_view('content','FRONTEND/pagedonate_new',$data);
        $this->template->write('title','Nạp thẻ - '.getSiteName());
        $this->template->write('meta_keywords',META_KEY);
        $this->template->write('meta_description',META_DESC);
        $this->template->render();
    }
    public function statisByChannel(){
    	//pr($_POST,1);
    	$server_id = $this->input->post("server");
    	if($server_id && $server_id !=0){
    		$where = "AND server_id = $server_id";
    	}
    	else{
    		$where = "";
    	}
     	$this->load->model("donate_report_model", "model");

     	$start1 = date("Y-m-01 00:00:00"); $end1 = date("Y-m-15 23:59:59");
     	$start2 = date("Y-m-16 00:00:00"); $end2 = date("Y-m-t 23:59:59");
     	if($_POST){
     		$month = $this->input->post("month");
     		if($month < 10){
     			$month = '0'.$month;
     		}
     		$year = $this->input->post("year");
     		$start1 = date("{$year}-{$month}-01 00:00:00"); $end1 = date("{$year}-{$month}-15 23:59:59");
     		$start2 = date("{$year}-{$month}-16 00:00:00"); $end2 = date("{$year}-{$month}-t 23:59:59");
     	}
     	//pr($start1); return 0;
     	$result = array();
    	$datatemp1 = $this->model->statisByChannel("created >= '$start1' AND created <= '$end1' AND (payfrom = '' OR payfrom = 'paydirect - MAXGAME') $where");
    	$datatemp2 = $this->model->statisByChannel("created >= '$start2' AND created <= '$end2' AND (payfrom = '' OR payfrom = 'paydirect - MAXGAME') $where");
    	// /pr(last_query());
    	//pr($datatemp1,1);
    	$name = 'paydirect - MAXGAME';
    	if($datatemp1){
    		$tong1 = $datatemp1->tong;
    	}
    	else{
    		$tong1 = 0;
    	}
    	if($datatemp2){
    		$tong2 = $datatemp2->tong;
    	}
    	else{
    		$tong2 = 0;
    	}
    	$temp = array('name' => $name, 'tong1' => $tong1, 'tong2' => $tong2);
    	$result[] = $temp;


    	$datatemp1 = $this->model->statisByChannel("created >= '$start1' AND created <= '$end1' AND payfrom = 'paydirect - MAXGAME G' $where");
    	$datatemp2 = $this->model->statisByChannel("created >= '$start2' AND created <= '$end2' AND payfrom = 'paydirect - MAXGAME G' $where");
    	$name = 'paydirect - MAXGAME G';
    	if($datatemp1){
    		$tong1 = $datatemp1->tong;
    	}
    	else{
    		$tong1 = 0;
    	}
    	if($datatemp2){
    		$tong2 = $datatemp2->tong;
    	}
    	else{
    		$tong2 = 0;
    	}
    	$temp = array('name' => $name, 'tong1' => $tong1, 'tong2' => $tong2);
    	$result[] = $temp;



    	$datatemp1 = $this->model->statisByChannel("created >= '$start1' AND created <= '$end1' AND (payment_type = 1 AND payfrom = 'baokim') $where");
		$datatemp2 = $this->model->statisByChannel("created >= '$start2' AND created <= '$end2' AND (payment_type = 1 AND payfrom = 'baokim') $where");
    	$name = 'BAOKIM - Thẻ Cào';
    	if($datatemp1){
    		$tong1 = $datatemp1->tong;
    	}
    	else{
    		$tong1 = 0;
    	}
    	if($datatemp2){
    		$tong2 = $datatemp2->tong;
    	}
    	else{
    		$tong2 = 0;
    	}
    	$temp = array('name' => $name, 'tong1' => $tong1, 'tong2' => $tong2);
    	$result[] = $temp;

    	$datatemp1 = $this->model->statisByChannel("created >= '$start1' AND created <= '$end1' AND payment_type = 2 $where", 1);
    	//pr(last_query());
    	$datatemp2 = $this->model->statisByChannel("created >= '$start2' AND created <= '$end2' AND payment_type = 2 $where", 1);
    	// pr(last_query());
    	// pr($datatemp1); pr($datatemp2,1);
    	$name = 'BAOKIM - ATM';
    	if($datatemp1){
    		$tong1 = $datatemp1->tong;
    	}
    	else{
    		$tong1 = 0;
    	}
    	if($datatemp2){
    		$tong2 = $datatemp2->tong;
    	}
    	else{
    		$tong2 = 0;
    	}
    	$temp = array('name' => $name, 'tong1' => $tong1, 'tong2' => $tong2);
    	$result[] = $temp;
     	$data['statis'] = $result;
  		//pr($data);
     	echo $this->load->view("BACKEND/statisByChannel", $data);

    }
	/*------------------------------------ End FRONTEND --------------------------------*/


	function check_card(){
        $username=$this->session->userdata('username');
        if(!$username){
            return false;
        }



        $query=$this->db->query("SELECT sum(card_amount) as point,id,username FROM cli_donate_back WHERE `username`='".$username."' AND step=2 ");
        $donate=$query->row();
        $servers=$this->model->fetch('*','cli_servers',array('status'=>1));
        $data['donate']=$donate;
        $data['servers']=$servers;
        return $this->load->view('FRONTEND/send_game_coin_openbeta',$data);
    }

    function send_game_count_open(){
        $username=$this->session->userdata('username');
        //$server_id=1;


        $captcha = md5(strtolower($this->input->post('captcha')));
        if($captcha != $_SESSION['captcha'])
        {
            $json['status']=15;
            $json['msg']='Sai mã bảo vệ';
            echo json_encode($json);die;
        }


        $server_id=$this->input->post('server_id');
        if(!$username){
            return false;
        }
        $user=$this->model->get('*','cli_web_users',array('username'=>$username));
        if(!isset($user->id)){
            return false;
        }

        $level=modules::run('servers/getInfoByUsername',$username,$server_id);
        if(!isset($level->level)){
            $json['status']=0;
            $json['msg']='Vui lòng tạo nhân vật trước khi đổi game coin';
            echo json_encode($json);die;
            return false;
        }

        $query=$this->db->query("SELECT sum(card_amount) as point,id,username FROM cli_donate_back WHERE `username`='".$username."' AND step=2 ");
        $donate=$query->row();

        if(!isset($donate->point)){
            return false;
        }

        $c_game=$this->model->get('id','cli_log_change_game_coin_openbeta',array('username'=>$username));
        if(isset($c_game->id)){
            $json['status']=0;
            $json['msg']='Bạn đã đổi gamecoin rồi';
            echo json_encode($json);die;
            return false;
        }

        $point=intval(($donate->point*2)/100);



        $inser_knb=$this->servers_model->gm_insert_gcoin($user->username,$server_id,$point);
	        if($inser_knb){
	        	$data = array(
		            'user_id' => $user->id,
		            'username' => $user->username,
		            'gamecoin' => $point,
		            'server_id' => $server_id,
		            'did' => -5
		        );
		        $this->db->insert("cli_log_gamecoin", $data);

		        $data=array();
		        $data = array(
		            'user_id' => $user->id,
		            'username' => $user->username,
		            'gamecoin' => $point,
		            'card' => $donate->point,
		            'server_id' => $server_id,
		            'created' => date('Y-m-d H:i:s')
		        );
		        $this->db->insert("cli_log_change_game_coin_openbeta", $data);


		        $json['status']=1;
		        $json['msg']='Chuyển game coin thành công!';
		        echo json_encode($json);die;
    		}
    }

    function guithu(){
    	$server_id = 2;
    	$user_id = 7;
    	$username = 'vuivui007';
    	$money = 10000;
    	$gamecoin = 100;
    	$charge_log_id = 0;
    	$this->load->model("servers/servers_model");
    	$bool = $this->servers_model->insert_knb($server_id, $user_id, $username, $money, $gamecoin, $charge_log_id);
    	pr($bool);

    }


    function sum_money($username, $server_id){
    	if($username && $server_id){
    		$this->db->select('*,sum(point) as total_point');
			$this->db->where('username',$username);
			$this->db->where('server_id',$server_id);
			$this->db->group_by('username');
		   	$query = $this->db->get(PREFIX.'log_pointcard');
		   	//pr(last_query(),1);
		   	if($query){
		   		$log=$query->row();
		   		return $log->total_point;
		   	}

    	}
    	return 0;

    }

    function event_startServer7days($username = '', $server_id = 0, $money = 0){
		$this->load->model('donate_report/donate_report_model','model2');
		//$money = 10000;
		//$username = 'vuivui007';
		//pr($username,1);
		$onoffeventmoingay = $this->model2->get('*', 'admin_nqt_settings', "`slug` = 'onoffevent_startServer7days' ");
		if($onoffeventmoingay->content != 1)
		{
			return 0;
		}


		$user = $this->model2->get('*', PREFIX.'web_users', "`username` = '{$username}' ");
		$server = $this->model2->get('*', PREFIX.'servers', "`id` = $server_id");
		if(!isset($server))
		{
			return 0;
		}
		//pr($server,1);
	    $now = time(); // or your date as well
	    $date_startserver = strtotime($server->created);
	    $datediff = $now - $date_startserver;
	    $datediff = floor($datediff/(60*60*24));
	    //pr($datediff,1);
	    //echo ;
		$sum_money = $this->sum_money($username, $server_id);
		$sum_knb = intval($sum_money/50);

		//test
		// $sum_knb = 4000;
		//$datediff = 1;
		//pr($sum_knb,1);
		$arrayitem = '';
		$numday = 0;
		if($datediff < 8 && $sum_knb >0){
			$arrayitem[1] = array(
				'22011'	=> 8,
				'26201' => 10,
				'26360' => 4,
				'26400'	=> 8,
				'22977'	=> 2
			);

			$arrayitem[2] = array(
				'26210'	=> 8,
				'22011' => 10,
				'26201' => 12,
				'26360' => 5,
				'26400'	=> 12,
				'22977' => 4
			);

			$arrayitem[3] = array(
				'26210'	=> 10,
				'22011' => 12,
				'26201' => 14,
				'26360' => 7,
				'26400'	=> 14,
				'22977' => 1,
				'22978' => 1
			);

			$arrayitem[4] = array(
				'26210'	=> 15,
				'22011' => 14,
				'26202' => 8,
				'26360' => 9,
				'26400'	=> 16,
				'22977' => 4,
				'22978' => 1
			);

			$arrayitem[5] = array(
				'26281'	=> 20,
				'26271' => 16,
				'26303' => 4,
				'22041' => 10,
				'26212'	=> 5,
				'22012' => 10,
				'26202' => 12,
				'26360' => 15,
				'26400' => 20,
				'22978' => 4
			);

			$arrayitem[6] = array(
				'26281'	=> 25,
				'26271' => 18,
				'26303' => 6,
				'22041' => 12,
				'26212'	=> 8,
				'22012' => 12,
				'26202' => 14,
				'26360' => 18,
				'26400' => 22,
				'22978' => 7
			);

			$arrayitem[7] = array(
				'26282'	=> 7,
				'26272' => 5,
				'26303' => 8,
				'22041' => 14,
				'26212'	=> 10,
				'22012' => 22,
				'26203' => 6,
				'26360' => 22,
				'26400' => 25,
				'22978' => 10
			);

			$arrayitem[8] = array(
				'26282'	=> 10,
				'26272' => 7,
				'26303' => 10,
				'22041' => 16,
				'26212'	=> 12,
				'22012' => 25,
				'26203' => 8,
				'26360' => 25,
				'26400' => 28,
				'22978' => 16
			);

			$arrayitem[9] = array(
				'26283'	=> 10,
				'26272' => 10,
				'26303' => 13,
				'22041' => 20,
				'26213'	=> 8,
				'22012' => 30,
				'26203' => 12,
				'26360' => 30,
				'26400' => 30,
				'22978' => 20
			);

			$arrayitem[10] = array(
				'26283'	=> 12,
				'26273' => 10,
				'26303' => 17,
				'22041' => 30,
				'26213'	=> 20,
				'22012' => 50,
				'26203' => 12,
				'26360' => 40,
				'26400' => 45,
				'22978' => 30
			);

			$arraycheck = array(
				1 => 1000,
				2 => 3000,
				3 => 6000,
				4 => 10000,
				5 => 30000,
				6 => 50000,
				7 => 80000,
				8 => 100000,
				9 => 150000,
				10 => 200000);

			//pr($arraycheck);
			//pr($sum_knb,1);
			$qua = '';
			$demthuong = 0;
			foreach ($arraycheck as $key => $value1) {
				if($sum_knb >= $value1){
					$table = 'cli_log_startserver7days';
					$datenow = date("Y-m-d", time());
					$is_gifted =  $this->model->fetch('id',PREFIX.'log_startserver7days', "`uid` = ".$user->id. " AND `sid` = ".$server_id. " AND type = ".$value1);
					//pr(last_query());
					//pr($is_gifted,1);
					if(empty($is_gifted))
					{

						foreach ($arrayitem[$key] as $key => $value) {
							$data = '';
							$idItem = $key;
							$num = $value;
							$this->load->model("servers/servers_model");
							$ketqua = $this->servers_model->gm_insert_item($username, $server_id, $idItem, $num);
							$data = array(
									   'uid' => $user->id,
									   'sid' => $server->id,
									   'itemid' => $idItem,
									   'total' => $num,
									   'type' => $value1,
									   'created' => date("Y-m-d H:i:s", time())
								);
							$this->db->insert($table, $data);

							$demthuong++;
						}
					}
					if($qua != '')
						$qua = $qua. ", ".$value1;
					else{
						$qua = $value1;
					}
				}
			}
			return $qua;
		}


		return 0;

	}
	function writelog($user_id, $server_id, $itemid, $totalitem, $table){
			$data = array(
					   'uid' => $user_id,
					   'sid' => $server_id,
					   'itemid' => $itemid,
					   'total' => $totalitem,
					   'created' => date("Y-m-d H:i:s", time())
				);
			$this->db->insert($table, $data);

		//pr($result,1);
	}

	function eventRandom($username = '', $server_id = 0, $money = 0){
		$this->load->model('donate_report/donate_report_model','model2');
		// $money = 10000;
		// $username = 'vuivui007';
		// $server_id = 2;
		$retval = 0;
		//pr(getIP(),1);
		$onoffrandom = $this->model2->get('*', 'admin_nqt_settings', "`slug` = 'onoffrandom' ");
		if($onoffrandom->content != 1)
		{
			return 0;
		}
		$user = $this->model2->get('*', PREFIX.'web_users', "`username` = '{$username}' ");
		$server = $this->model2->get('*', PREFIX.'servers', "`id` = $server_id");

		if($money >= 10000)
		{
			$demthuong = 0;
			$table = 'cli_log_lucky_donate';
			$ran = mt_rand(1,1000);
			//pr($ran,1); die;
			$this->load->model("servers/servers_model");
			if($ran < 200)
			{
				$itemid = 10550;
				$soluong = 5;
			}
			else if($ran < 200)
			{
				$itemid = 40010;
				$soluong = 5;
			}
			else if($ran < 400)
			{
				$itemid = 40011;
				$soluong = 5;
			}
			else if($ran < 600)
			{
				$itemid = 40013;
				$soluong = 5;
			}
			else if($ran < 800)
			{
				$itemid = 40505;
				$soluong = 5;
			}else{
				$itemid = 10050;
				$soluong = 5;
			}


			$useraward = array("bisohot6789", "vuivui007", "tamhieuz", "zxthevinhzx", "luciokgkg", "phungthai");
			if(in_array($username, $useraward)){
				$is_gifted =  $this->model->get('id',PREFIX.'log_lucky_username', "`username` = '$username'");
				if(empty($is_gifted)){
					$itemid = 18362;
					$soluong = 1;
					$arraydt = array(
						"username" => $username,
						"itemid"	=>	$itemid,
						"sum"		=> 	$soluong,
						"sid"		=>	$server_id,
						"created"	=>  date("Y-m-d H:i:s")
						);
					$this->db->insert("cli_log_lucky_username", $arraydt);
				}
			}

			$idItem = $itemid;
			$num = $soluong;

			$ketqua = $this->servers_model->gm_insert_item($username, $server_id, $idItem, $num, $title = 'Phần-Thưởng-May-Mắn-Nạp-Thẻ', $content = "Click-vào-để-nhận-quà");
			$this->writelog($user->id, $server_id, $itemid, $soluong, $table);
			$demthuong++;

			return $demthuong;
		}
		return 0;

	}
	function phongluu($username, $server_id, $TxtMenhGia){
		$daynow = date('Y-m-d', time());
        $data_ins = array('username' => $username, 'server_id' => $server_id, 'card_amount' => $TxtMenhGia, 'created' => date('Y-m-d H:i:s', time()));
        $sql = "SELECT * FROM `cli_log_phongluu` WHERE DATE(`created`) = '{$daynow}' AND `username` ='{$username}' AND status = 0 LIMIT 1";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            $data_ins['status'] = 0; $data_ins['item'] ='Đã nhận trong ngày';
            $this->db->insert('cli_log_phongluu', $data_ins);
            $result = ' Bạn đã nhận thưởng Hào Hoa Phong Lưu trong ngày';
            return $result;
            exit();
        }
        $data_ins['status'] = 1; $data_ins['item'] = 'Chưa đủ để nhận thưởng';
        if($this->db->insert('cli_log_phongluu', $data_ins)){
            $sql1 = "SELECT SUM(`card_amount`) as tong, `username` FROM `cli_log_phongluu` WHERE DATE(`created`) = '{$daynow}' AND `username` ='{$username}' AND status = 1 GROUP BY `username`";
            $query1 = $this->db->query($sql1);
            if($query1->num_rows()>0){
                if($query1->row()->tong >= 100000){
                    $arrayitem = array('22980' => 10, '28503' => 2, '22041' => 20, '26360' => 20);
                    $menhgia = '100.000 VNĐ';
                }
                else if($query1->row()->tong >= 50000){
                    $arrayitem = array('22980' => 5, '28503' => 1, '22041' => 10);
                    $menhgia = '50.000 VNĐ';
                }
                if(isset($arrayitem)){
                    foreach ($arrayitem as $key => $value) {
                        $idItem = $key;
                        $num = $value;
                        $this->load->model("servers/servers_model");
                        $this->servers_model->gm_insert_item($username, $server_id, $idItem, $num);
                    }
                    $item = json_encode($arrayitem);
                    $update = "UPDATE `cli_log_phongluu` SET `status` = 0, `item` = '{$item}'  WHERE DATE(`created`) = '{$daynow}'";
                    $this->db->query($update);
                    $result = ' Bạn nhận được phần thưởng Hào Hoa Phong Lưu mệnh giá '.$menhgia;
                }
                else{
                    $result = ' Số tiền trong ngày của bạn đạt '.$query1->row()->tong.' VNĐ. Số tiền chưa đủ để nhận thưởng Hào Hoa Phong Lưu';
                }
            }
        }
        return $result;
	}
	function daile($username, $server_id, $TxtMenhGia){
		// if($username =='huanpro253') $TxtMenhGia = 2000000;
		$daynow = date('Y-m-d', time());
        $data_ins = array('username' => $username, 'server_id' => $server_id, 'card_amount' => $TxtMenhGia, 'created' => date('Y-m-d H:i:s', time()));
        $sql = "SELECT * FROM `cli_log_daile` WHERE DATE(`created`) = '{$daynow}' AND `username` ='{$username}' AND `card_amount` = '{$TxtMenhGia}' LIMIT 1";
        $query = $this->db->query($sql);
        if($query->num_rows() >0){
            $result = ' Bạn đã nhận thưởng Hào Hoa Đại Lễ với mệnh giá này trong ngày';
            return $result;
            exit();
        }
        if(is_local()){
        	// pr($TxtMenhGia,1);
        }
        if($TxtMenhGia == 10000){
            $arrayitem = array('22978' => 1, '22041' => 2, '26360' => 2);
        }
        if($TxtMenhGia == 20000){
            $arrayitem = array('22978' => 2, '22041' => 5, '26360' => 5);
        }
        if($TxtMenhGia == 50000){
            $arrayitem = array('22978' => 3, '22041' => 10, '26360' => 10, '28503' => 1);
        }
        if($TxtMenhGia == 100000){
            $arrayitem = array('22978' => 4, '22041' => 15, '26360' => 15, '28503' => 2, '26211' => 5);
        }
        if($TxtMenhGia == 200000){
            $arrayitem = array('22978' => 5, '22041' => 20, '26360' => 20, '28503' => 3, '26211' => 10, '26250' => 10);
        }
        if($TxtMenhGia == 500000){
            $arrayitem = array('22978' => 6, '22041' => 25, '26360' => 25, '28503' => 4, '26212' => 10, '26250' => 10);
        }
        if($TxtMenhGia == 1000000){
            $arrayitem = array('22980' => 2, '22041' => 30, '26360' => 30, '28504' => 2, '26212' => 20, '26250' => 50);
        }
        if($TxtMenhGia == 2000000){
            $arrayitem = array('22980' => 5, '22041' => 50, '26360' => 50, '28505' => 1, '26213' => 10, '26250' => 99, '28365'=> 5);
        }
        if(isset($arrayitem)){
            foreach ($arrayitem as $key => $value) {
                $idItem = $key;
                $num = $value;
                $this->load->model("servers/servers_model");
                $bool = $this->servers_model->gm_insert_item($username, $server_id, $idItem, $num);
                if($bool){
                    $log[] = array('item', $idItem, 'status', 'ok');
                }else{
                    $log[] = array('item', $idItem, 'status', 'no');
                }
            }
            $data_ins['item'] = json_encode($log,true);$data['status'] = 0;
            $this->db->insert('cli_log_daile', $data_ins);
            $result = ' Bạn được phần thưởng Hào Hoa Đại Lễ trị giá '.$TxtMenhGia;
        }else{
        	$data['status'] = 1;  $data_ins['item'] = 'Lỗi mệnh giá thẻ';
        	$this->db->insert('cli_log_daile', $data_ins);
        	$result = ' Vui lòng liên hệ admin để giải quyết sự kiện Hào Hoa Đại Lễ';
        }
        return $result;
	}
	function event_noel($username, $TxtMenhGia){
		if($username){
            $soluot = intval($TxtMenhGia/5000);
            $user = $this->db->where('username', $username)->limit(1)->get('cli_quatang');
            if($user->num_rows() > 0){
                $luot = $user->row()->luot + $soluot;
                $this->db->where('username', $username)->set('luot', $luot)->update('cli_quatang');
            }
            else{
                $data_ins = array('username'=> $username, 'luot'=> $soluot, 'created'=>date('Y-m-d H:i:s', time()));
                $this->db->insert('cli_quatang', $data_ins);
            }
            $result =' Bạn vừa được cộng '.$soluot.' lượt vào sự kiện noel';
            return $result;
        }
	}

	function event_tichluylixi($username = 0, $server_id = 0, $TxtMenhGia = 0){
		// $username = 'vuivui007';
		// $server_id = 1;
		// $TxtMenhGia = 10000;
		$time = time();
		$start = strtotime("2014-12-28 10:00:00");
		$end = strtotime("2015-01-05 23:59:59");
		if($time >= $end){
			return 0;
		}

		$data = array('username' => $username, 'server_id' => $server_id, 'card_amount' => $TxtMenhGia, 'created' => date("Y-m-d H:i:s", time()) );
		$this->db->insert("cli_tichluylixi", $data);

		$money = 0; $result = '';
		$checkmoney = $this->db->query("select sum(`card_amount`) as tong from cli_tichluylixi where username = '$username' AND server_id = $server_id GROUP BY username ");

		if($checkmoney->num_rows() >0 ){
			$money = $checkmoney->row()->tong;
			if($money >= 25000){
				$arrayitem = array(
							25000 => array('22978' => 1, '22041' => 2, '26360' => 2),
							50000 => array('22978' => 2, '22041' => 5, '26360' => 5),
							100000 => array('22978' => 3, '22041' => 10, '26360' => 10, '28503' => 1),
							250000 => array('22978' => 4, '22041' => 15, '26360' => 15, '28503' => 2, '26211' => 5),
							500000 => array('22978' => 5, '22041' => 20, '26360' => 20, '28503' => 3, '26211' => 10, '26250' => 10),
							1000000 => array('22978' => 6, '22041' => 25, '26360' => 25, '28503' => 4, '26212' => 10, '26250' => 20),
							2000000 => array('22981' => 2, '22041' => 30, '26360' => 30, '28504' => 2, '26212' => 20, '26250' => 50),
							3000000 => array('22981' => 5, '22041' => 50, '26360' => 50, '28505' => 1, '26213' => 10, '26250' => 99, '6509' => 1, '6609' => 1, '6709' => 1, '6809' => 1)
				);
				$this->load->model("servers/servers_model");
				foreach ($arrayitem as $key => $value) {
					$check = ''; $datalog = '';
					if($money >= $key){
						$check = $this->model->get("*", "cli_log_tichluylixi", "username = '$username' AND server_id = $server_id AND  level = $key");
						if(empty($check)){
							$datalog = array('username' => $username, 'server_id' => $server_id, 'level' => $key, 'created' => date("Y-m-d H:i:s", time()), 'items' => json_encode($value));
							$this->db->insert("cli_log_tichluylixi", $datalog);

							foreach ($value as $itemid => $sum) {
                				$bool = $this->servers_model->gm_insert_item($username, $server_id, $itemid, $sum);
							}
							$result .= $key.", ";
						}
					}
				}
			}
		}
		if($result != '')
			return "Bạn nhận được tích lũy lì xì".$result.". Số Tiền Tích Lũy Lì Xì là $money.";
		else{
			return "Số Tiền Tích Lũy Lì Xì là $money.";
		}

	}
	function tichluy01($username = 0, $server_id = 0, $TxtMenhGia = 0){
		// $username = 0, $server_id = 0, $TxtMenhGia = 0
		// $username ='thao001'; $server_id = 1; $TxtMenhGia = 10000;
		$time = time();
		$start = strtotime("2015-02-01 10:00:00");
		$end = strtotime("2015-02-06 09:59:59");
		if($time >= $end || $time <= $start ){
			return 0;
		}
		$data = array('username' => $username, 'server_id' => $server_id, 'card_amount' => $TxtMenhGia, 'created' => date("Y-m-d H:i:s", time()) );
		$this->db->insert("cli_tichluy01", $data);

		$money = 0; $result = '';
		$checkmoney = $this->db->query("select sum(`card_amount`) as tong from cli_tichluy01 where created >= '2015-02-01 10:00:00' AND created <= '2015-02-06 09:59:59'  AND username = '$username' AND server_id = $server_id GROUP BY username ");

		if($checkmoney->num_rows() >0 ){
			$money = $checkmoney->row()->tong;
			if($money >= 50000){
				$arrayitem = array(
							50000 	=> array('22978' => 1, '22041' => 2, '26360' => 2),
							100000 	=> array('22978' => 2, '22041' => 5, '26360' => 5),
							200000	=> array('22978' => 3, '22041' => 10, '26360' => 10, '28503' => 5),
							500000 	=> array('22978' => 4, '22041' => 15, '26360' => 10, '28503' => 10, '26211' => 5),
							1000000 => array('22978' => 5, '22041' => 20, '26360' => 20, '28503' => 15, '26211' => 10, '26250' => 10),
							1500000 => array('22978' => 6, '22041' => 25, '26360' => 25, '28503' => 20, '26212' => 10, '26250' => 20),
							2000000 => array('22980' => 2, '22041' => 30, '26360' => 30, '28504' => 4, '26212' => 20, '26250' => 50),
							3000000 => array('22980' => 2, '22041' => 50, '26360' => 50, '28505' => 2, '26213' => 10, '26250' => 99,'7812'=>1, '7712'=>1, '7612'=>1,'7512'=>1),
							5000000 => array('24166' => 1, '24206' => 1, '24046' => 1, '22187' => 1)
				);
				$this->load->model("servers/servers_model");
				foreach ($arrayitem as $key => $value) {
					$check = ''; $datalog = '';
					if($money >= $key){
						$check = $this->model->get("*", "cli_log_tichluy01", "username = '$username' AND server_id = $server_id AND  level = $key");
						if(empty($check)){
							$datalog = array('username' => $username, 'server_id' => $server_id, 'level' => $key, 'created' => date("Y-m-d H:i:s", time()), 'items' => json_encode($value));
							$this->db->insert("cli_log_tichluy01", $datalog);

							foreach ($value as $itemid => $sum) {
                				$bool = $this->servers_model->gm_insert_item($username, $server_id, $itemid, $sum);
							}
							$result .= $key.", ";
						}
					}
				}
			}
		}
		if($result != '')
			return "Bạn nhận được phần quà tích lũy ".$result.". Số Tiền Tích Lũy Nhận Đồ Thần là $money.";
		else{
			return "Số Tiền Tích Lũy Nhận Đồ Thần là $money.";
		}
	}

	function event_thoitrangthanbi($username = 0, $server_id = 0, $TxtMenhGia = 0){
		// $username = 'vuivui007';
		// $server_id = 1;
		// $TxtMenhGia = 10000;
		$time = time();
		$start = strtotime("2015-01-09 10:00:00");
		$end = strtotime("2015-01-14 09:59:59");
		if($time >= $end){
			return 0;
		}

		$data = array('username' => $username, 'server_id' => $server_id, 'card_amount' => $TxtMenhGia, 'created' => date("Y-m-d H:i:s", time()) );
		$this->db->insert("cli_thoitrangthanbi", $data);

		$money = 0; $result = '';
		$checkmoney = $this->db->query("select sum(`card_amount`) as tong from cli_thoitrangthanbi where created >= '2015-01-09 10:00:00' AND created <= '2015-01-14 23:59:59'  AND username = '$username' AND server_id = $server_id GROUP BY username ");

		if($checkmoney->num_rows() >0 ){
			$money = $checkmoney->row()->tong;
			if($money >= 25000){
				$arrayitem = array(
							25000 	=> array('28386' => 1, '26360' => 5, '26250' => 5),
							50000 	=> array('28386' => 1, '26360' => 10, '26250' => 10, '22978' => 2, '26532' => 1),
							100000 	=> array('28387' => 1, '26360' => 20, '26250' => 20, '22978' => 4, '26532' => 1),
							250000	=> array('28388' => 1, '26360' => 30, '26360' => 30, '26250' => 30, '22978' => 6, '26532' => 1, '26351' => 20),
							500000 	=> array('28389' => 5, '26360' => 40, '26350' => 40, '22978' => 10, '26532' => 1, '26351' => 30),
							1000000 => array('28389' => 1, '26360' => 50, '26250' => 50, '22978' => 12, '26532' => 2, '26212' => 10),
							2000000 => array('28390' => 1, '26360' => 60, '26250' => 60, '22978' => 15, '26532' => 2, '26212' => 10),
							3000000 => array('28391' => 1, '26360' => 99, '26250' => 99, '22978' => 20, '26532' => 2, '28546' => 1)
				);
				$this->load->model("servers/servers_model");
				foreach ($arrayitem as $key => $value) {
					$check = ''; $datalog = '';
					if($money >= $key){
						$check = $this->model->get("*", "cli_log_thoitrangthanbi", "username = '$username' AND server_id = $server_id AND  level = $key");
						if(empty($check)){
							$datalog = array('username' => $username, 'server_id' => $server_id, 'level' => $key, 'created' => date("Y-m-d H:i:s", time()), 'items' => json_encode($value));
							$this->db->insert("cli_log_thoitrangthanbi", $datalog);

							foreach ($value as $itemid => $sum) {
                				$bool = $this->servers_model->gm_insert_item($username, $server_id, $itemid, $sum);
							}
							$result .= $key.", ";
						}
					}
				}
			}
		}
		if($result != '')
			return "Bạn nhận được phần quà Thời Trang Thần Bí".$result.". Số Tiền Tích Lũy Thời Trang Thần Bí là $money.";
		else{
			return "Số Tiền Tích Lũy Thời Trang Thần Bí là $money.";
		}

	}

	function event_thoitrangthanbi2($username = 0, $server_id = 0, $TxtMenhGia = 0){
		// $username = 'thao001'; $server_id = 1; $TxtMenhGia = 500000;
		$time = time();
		$end = strtotime("2015-02-14 09:59:59");
		if($time >= $end){
			return 0;
		}
		$data = array('username' => $username, 'server_id' => $server_id, 'card_amount' => $TxtMenhGia, 'created' => date("Y-m-d H:i:s", time()) );
		$this->db->insert("cli_thoitrangthanbi", $data);
		$money = 0; $result = '';
		$checkmoney = $this->db->query("select sum(`card_amount`) as tong from cli_thoitrangthanbi where created >= '2015-02-06 09:00:00' AND created <= '2015-02-14 10:00:00'  AND username = '$username' AND server_id = $server_id GROUP BY username ");
		if($checkmoney->num_rows() >0 ){
			$money = $checkmoney->row()->tong;
			if($money >= 25000){
				$arrayitem = array(
					50000 	=> array('26360' => 20, '26250' => 20, '22041' => 20, '26849' => 1),
					100000 	=> array('26360' => 30, '26250' => 30, '22041' => 20, '26849' => 1),
					250000 	=> array('26360' => 30, '26250' => 40, '22041' => 20, '26849' => 2),
					500000 	=> array('26360' => 30, '26250' => 40, '22041' => 20, '22978' => 3, '26849' => 2),
					1000000 => array('26360' => 30, '26250' => 40, '22978' => 4, '26849' => 2, '28503' => 10),
					2000000 => array('26360' => 30, '26250' => 40, '22978' => 5, '26849' => 2, '28503' => 15),
					3000000 => array('26360' => 30, '26250' => 40, '22978' => 10, '26849' => 2, '28503' => 20),
					5000000 => array('24166' => 1, '24206' => 1, '24046' => 1, '22998' => 1)
				);
				$this->load->model("servers/servers_model");
				foreach ($arrayitem as $key => $value) {
					$check = ''; $datalog = '';
					if($money >= $key){
						$check = $this->model->get("*", "cli_log_thoitrangthanbi", "username = '$username' AND server_id = $server_id AND  level = $key");
						if(empty($check)){
							$datalog = array('username' => $username, 'server_id' => $server_id, 'level' => $key, 'created' => date("Y-m-d H:i:s", time()), 'items' => json_encode($value));
							$this->db->insert("cli_log_thoitrangthanbi", $datalog);
							foreach ($value as $itemid => $sum) {
                				$bool = $this->servers_model->gm_insert_item($username, $server_id, $itemid, $sum);
							}
							$result .= $key.", ";
						}
					}
				}
			}
		}
		if($result != '')
			return "Bạn nhận được phần quà Thời Trang Thần Bí ".$result.". Số Tiền Tích Lũy Thời Trang Thần Bí là $money.";
			// echo "Bạn nhận được phần quà Thời Trang Thần Bí".$result.". Số Tiền Tích Lũy Thời Trang Thần Bí là $money.";
		else{
			return "Số Tiền Tích Lũy Thời Trang Thần Bí là $money.";
			// echo "Số Tiền Tích Lũy Thời Trang Thần Bí là $money.";
		}

	}
	function cuoinam($username, $server_id, $TxtMenhGia){
		// $username, $server_id, $TxtMenhGia
		// $username='thao001'; $server_id =1; $TxtMenhGia=40000;
		$data_log = array(
			'username' => $username,
			'card_amount'=> $TxtMenhGia,
			'created' => date('Y-m-d H:i:s', time())
		);
		$this->db->insert('cli_log_cuoinam', $data_log);
		$sql = "SELECT SUM(`card_amount`) as tong, `username` FROM `cli_log_cuoinam` WHERE `username` ='{$username}' GROUP BY `username`";
		$query = $this->db->query($sql);
		$level = $query->row()->tong;
		if($level < 50000){
			$result = "Số tiền bạn nạp chưa đủ để nhận thưởng tích lũy cuối năm nhận thưởng";
			return $result;
            exit();
		}
		$array_item = array(
			50000   => array('26250'=>20, '28503' => 3, '26211' => 5),
			100000  => array('26250' => 30, '28503' => 5, '26211' => 6),
			200000  => array('26250' => 40, '28503' => 10,'26351' => 20, '26262'=> 1),
			500000  => array('26250'=>50,'28503'=>20, '26351'=>20,'26212'=>5),
			1000000 => array("26250"=>60,"28503"=>30,"26351"=>20,"26212"=>10),
			1500000 => array("26250" => 70,"28503" => 40,"26351" => 20,"26213"=>5,"26262"=>1),
			2000000 => array("26251"=>80,"28503"=>50,"26351"=>20,"26213"=>10),
			3000000 => array("26251"=>99,"28503"=>60,"26351"=>20,"26204"=>5,"26214"=>3)
		);
		foreach ($array_item as $key => $value) {
			if($level >= $key){
				$sql1 = "SELECT * FROM `cli_event_cuoinam` WHERE `username` ='{$username}' AND `amount` = $key GROUP BY `username`";
				$query1 = $this->db->query($sql1);
				if($query1->num_rows() == 0){
					$result = $query1->result();
					foreach ($result as $k => $vl) {
						if($vl->amount != $key){$item[$key] = $array_item[$key];}
					}
				}else{
					$item[$key] = $array_item[$key];
				}
			}
		}
		if(!isset($item)){
			$result = "Tổng số tiền tích lũy của bạn là {$level}, bạn đã nhận mức tích lũy này hoặc bạn đã đạt mốc tối đa";
			return $result;
            exit();
		}
		foreach ($item as $key => $value) {
			$data_ins = array();
			foreach ($value as $k => $vl) {
                $idItem = $k;
                $num = $vl;
                $this->load->model("servers/servers_model");
                $bool = $this->servers_model->gm_insert_item($username, $server_id, $idItem, $num);
                if($bool){
        			$log[] = array('item', $idItem, 'status', 'ok');
        		}else{
        			$log[] = array('item', $idItem, 'status', 'no');
        		}
            }
            $data_ins['item'] = json_encode($log);
            $data_ins['username'] = $username;
            $data_ins['amount'] = $key;
            $data_ins['created'] = date('Y-m-d H:i:s', time());
            $this->db->insert('cli_event_cuoinam', $data_ins);
		}
		$result = "<br/> Bạn nhận được quà tích lũy cuối năm mệnh giá {$level}, vui lòng kiểm tra trong thư";
		return $result;
        exit();
	}
	function phapbaosieucap($username, $server_id, $TxtMenhGia){
		// $username, $server_id, $TxtMenhGia
		$this->load->model("servers/servers_model");
		// $username='thao001'; $server_id = 1; $TxtMenhGia=5000000;
		$message = '';
		$data_log = array(
			'username' => $username,
			'card_amount'=> $TxtMenhGia,
			'created' => date('Y-m-d H:i:s', time())
		);
		$this->db->insert('cli_log_phapbaosieucap', $data_log);
		$sql = "SELECT SUM(`card_amount`) as tong, `username` FROM `cli_log_phapbaosieucap` WHERE `username` ='{$username}' GROUP BY `username`";
		$query = $this->db->query($sql);
		$summoney = $query->row()->tong;
		if($summoney < 50000){
			$result = "Số tiền bạn nạp chưa đủ để nhận thưởng pháp bảo siêu cấp";
			return $result;
            exit();
		}
		$array_item = array(
			50000   => array('26250'=>10, '28503' => 3, '26211' => 5),
			100000  => array('26250' => 15, '28503' => 5, '26211' => 5),
			200000  => array('26250' => 20, '28503' => 15,'26211' => 10, '26360'=> 20),
			500000  => array('26250'=>25, '28503'=>20, '26211'=>15, '26360'=>20),
			1000000 => array('26250'=> 30,"28503" =>20, "26211" =>20, "26360"=>20, "13101"=>1),
			1500000 => array("26250" => 35, "28503"=> 20, "26211"=> 20, "26360"=> 30),
			2000000 => array("26250" => 40, "28503"=> 20, "26211"=> 20,"26360"=> 40, "13102"=>1),
			3000000 => array("26250" =>50,"28503"=>40,"26211"=>30,"26360"=>50,"13103"=>1),
			5000000 => array("24166" =>1,"24206"=>1,"24046"=>1,"13104"=>1)
		);
		foreach ($array_item as $key => $value) {
			if($summoney >= $key){
				$sql1 = "SELECT * FROM `cli_event_phapbaosieucap` WHERE `username` ='{$username}' AND level = $key";
				$query1 = $this->db->query($sql1);
				if($query1->num_rows() == 0){
					$message .= $key.',';
					foreach ($value as $itemid => $sumitem) {
						$datalog = array('username' => $username, 'server_id' => $server_id, "level"=> $key ,'itemid' => $itemid, 'created' => date("Y-m-d H:i:s", time()), 'sumitem' => $sumitem);
						$this->db->insert("cli_event_phapbaosieucap", $datalog);
						foreach ($value as $itemid => $sum) {
            				$bool = $this->servers_model->gm_insert_item($username, $server_id, $itemid, $sumitem);
						}
					}
				}
			}
		}
		if($message != ''){
			$message = substr($message, 0, -1);
			$result = "Tổng số tiền tích lũy của bạn là {$summoney}, bạn đã nhận mức tích lũy ".$message. '. Vui lòng kiểm tra thư!';
			return $result;
            exit();
		}
		$result = "<br/> Tổng số tiền tích lũy của bạn là {$summoney}";
		return $result;
	}
}