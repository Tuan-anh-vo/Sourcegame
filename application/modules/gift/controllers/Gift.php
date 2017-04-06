<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gift extends MX_Controller {
	private $module = 'gift';
	private $table = 'gift_code';
	function __construct(){
		parent::__construct();
		$this->load->model($this->module.'_model','model');
		$this->load->model('admincp_modules/admincp_modules_model');
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
	}
	/*----------------------- Admin Control Panel ------------------------------------*/
	public function admincp_index(){
		modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'r',0);
		$default_func = 'created';
		$default_sort = 'DESC';
		$data = array(
			'module'=>$this->module,
			'module_name'=>$this->session->userdata('Name_Module'),
			'default_func'=>$default_func,
			'default_sort'=>$default_sort
		);
		$this->template->write_view('content','BACKEND/index',$data);
		$this->template->render();
	}
	public function admincp_update($id=0){
		if($id==0){
			modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'w',0);
		}else{
			modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'r',0);
		}
		$result[0] = array();
		$data = array(
			'module'=>$this->module,
			'id'=>$id
		);
		if($id!=0){
			$result = $this->model->getDetailManagement($id);
		}
		$data['servers'] = $this->model->get_server();
		$data['result'] = $result[0];
		$this->template->write_view('content','BACKEND/ajax_editContent',$data);
		$this->template->render();
	}

	public function admincp_save(){
		$perm = modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'w',1);
		if($perm=='permission-denied'){
			print $perm;
			exit;
		}
		if($_POST){
			if($this->model->saveManagement()){
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
				$this->db->where('gift_details_id', $id);
				if($this->db->delete(PREFIX.'gift_code'))
					return true;
			}
		}
	}

	public function admincp_ajaxLoadContent(){
		$this->load->library('AdminPagination');
		$config['total_rows'] = $this->model->getTotalsearchContent();
		$config['per_page'] = $this->input->post('per_page');
		$config['num_links'] = 3;
		$config['func_ajax'] = 'searchContent';
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
	/*-----------------------END BACKEND--- FRONTEND -------------------------*/
	function index(){
		if(!$this->session->userdata('username')){
  			redirect(PATH_URL . "dang-nhap");
  		}
  		else{
  			$username = $this->session->userdata('username');
    		$user = $this->model->get("id", "cli_web_users", "username = '{$username}'");
    		$data['servers'] = $server = $this->model->get_server();
  			$data['result'] = $this->model->index($user->id, $server);
  			$this->template->write('title',' Đổi Giftcode - Giftcode | ' . getSiteName());
            $this->template->write('meta_description', 'Gift code .'.getSiteName().'Giftcode tân thủ, giftcode sự kiện');
            $this->template->write('meta_keywords', META_KEY);
            $this->template->write_view('content', 'FRONTEND/index',$data);
            $this->template->render();
  		}
	}
	function index_game(){
		if(!$this->session->userdata('username')){
  			redirect(PATH_URL . "dang-nhap");
  		}
  		else{
  			$this->load->model('servers/servers_model');
			$server = $this->servers_model->getServersCur();
			$server_play = $this->session->userdata('server_id');
			$this->db->where('id', $server_play);
			$server = $this->db->get('cli_servers')->result();
  			$username = $this->session->userdata('username');
    		$user = $this->model->get("id", "cli_web_users", "username = '{$username}'");
    		$data['servers'] = $this->model->get_server();
    		if(!$server) $server = $data['servers'];
  			$data['result'] = $this->model->index($user->id, $server);
  			$this->load->view('FRONTEND/index_game',$data);
  		}
	}
	// Luy y: Many bang 1 la cho nhan nhiu lan.
    function gift_code_user($type=''){
    	if($this->session->userdata('username')){
    		if(!$type){
    			$data['result'] = "Bạn là một cổ máy, hãy liên hệ admin";
    			return $data;
    		}
    		if(!$this->session->userdata('timecode')){
    			$this->session->set_userdata('timecode', time()+10);
	    		$username = $this->session->userdata('username');
	    		$user = $this->model->get("id", "cli_web_users", "username = '{$username}'");
	    		$this->load->model('gift_model');
	    		$result = $this->gift_model->gift_code_user($username, $user->id, $type);
	    		if($result){
	    			$this->session->unset_userdata('timecode');
	    			$data['result'] = $result;
	    		}
	    		else{$data['result'] = "Hệ thống quá tải";}
	    	}else{
	    		if($this->session->userdata('timecode') < time()){
	    			$this->session->unset_userdata('timecode');
	    		}
	    		$data['result'] = "Vui lòng đợi vài giây";
	    	}
	    	return $data;
    	}
    	else{
    		// redirect(PATH_URL . "dang-nhap");
    		return 0;
    	}
    }

    function change_giftcode(){
    	$capcha = $this->input->post('capcha');
    	if(!$capcha){
    		echo "Vui lòng nhập mã bảo vệ";
    		exit();
    	}
        $capcha = md5(strtolower($capcha));
        // if($capcha != $_SESSION['captcha']){
        // 	echo "Mã bảo vệ không khớp";
        // 	exit();
        // }
    	if(!$this->session->userdata('username')){
            redirect(PATH_URL . "dang-nhap");
        }else{
        	$username = $this->session->userdata('username');
    		$user = $this->model->get("id,username", "cli_web_users", "username = '{$username}'");
	    	$server = $this->input->post('server');
	    	$code = $this->db->escape_str($this->input->post('code'));
	    	if(!$server){
	    		echo "Vui lòng chọn server";
	    		exit();
	    	}
	    	if(!$code){
	    		echo "Vui lòng nhập code của bạn";
	    		exit();
	    	}

	    
	    	if( $this->session->userdata('timechange') ){ //$this->session->userdata('timechange')
	    		if($this->session->userdata('timechange') < time()){
	    			$this->session->unset_userdata('timechange');
	    		}
	    		echo "Vui lòng đợi vài giây và thử lại";
	    	}else{
	    		$this->session->set_userdata('timechange', time()+10);




	    		$this->load->model('servers/servers_model');
	    		$data = $this->model->change_giftcode($username, $user->id, $server, $code);
	    		if($data){
	    			$this->session->unset_userdata('timechange');
	    			echo json_encode( $data );
	    		}
		    }
    	}
    }

    // THẢO
    function checkCode($type){
    	if(empty($type)) return 0;
    	if($this->session->userdata('username')){
    		$username = $this->session->userdata('username');
	    	$code=$this->model->get('*','cli_giftcode_user',array('username'=>$username,'type'=>$type));
	    	if(isset($code->code)){
	    		return $code->code;
	    	}else{
	    		return 0;
	    	}
    	}else{
    		return 0;
    	}
    }
    function giftcode_plugin(){
    	$data = array();
    	$type = $this->input->post('type');
    	if(!$type) {echo 0; exit();}
    	$username = $this->session->userdata('username');
		if($username){
			$code = $this->gift_code_user($type);
			echo $code;
		}else echo 0;
    }
    function giftCodeEmail(){
    	$type = 35; // CHỈ SỐ ID GIFTCODE.
		$data['token'] = $this->input->get('token');
		$data['salt']  = $this->input->get('salt');
		$data['uid']   = $this->input->get('active');
		$data['id']    = $this->input->get('sign');
		if(!$data['token'] || !$data['salt'] || !$data['uid'] || !$data['id']){
			$rs['result'] = -1;
		}else{
			$rs['result']  = $this->model->giftCodeEmail($data, $type);
		}
		$this->load->view('FRONTEND/showgiftemail', $rs);
    }

    function giftEmail(){
    	$data['code'] = $this->checkCode(35);
    	return $this->load->view('FRONTEND/giftemail', $data);
    }

	function giftCodeSMS(){
    	$data['code'] = $this->checkCode(33);
    	return $this->load->view('FRONTEND/giftcodesms', $data);
    }

     function get_gift_code_sms($type='', $username){
		if(!$type){
			$data['result'] = "Bạn là một cổ máy, hãy liên hệ admin";
			return $data;
		}

		$user = $this->model->get("id", "cli_web_users", "username = '{$username}'");
		$this->load->model('gift_model');
		$result = $this->gift_model->gift_code_user($username, $user->id, $type);
		if($result){
			$result = $result;
		}
		else{$result = "Hệ thống quá tải";}

    	return $result;

    }
    function api_giftCodeSMS(){
    	$username  = $_POST['username'];
    	$phone = $_POST['phone'];
    	if($phone && $username){
    		$this->load->model("gift/gift_model");
    		$user = $this->gift_model->get("*", "cli_web_users", "username = '$username'");
    		$arResponse['status'] = 0;
            $arResponse['sms'] = $username;
            $arResponse['type']  = 'text';
            if(empty($user)){
    			$arResponse['status'] = 0;
                $arResponse['sms'] = "HOANG DO WEB - Tai khoan $username khong ton tai";
                $arResponse['type']  = 'text';
                echo json_encode($arResponse); die;
    		}

    		$code = $this->get_gift_code_sms(33, $username);
    		$arResponse['status'] = 1;
            $arResponse['sms'] = "HOANG DO WEB - Tai khoan $username, Gift Code: ".$code;
            $arResponse['type']  = 'text';


    		$data = array("username"=> $username, "phone" => $phone, "created" => date("Y-m-d H:i:s"), "content" => $arResponse['sms'] );
    		$this->db->insert("cli_log_sms", $data);

            echo json_encode($arResponse); die;
    	}

    	$arResponse['status'] = 0;
        $arResponse['sms'] = "HOANG DO WEB - He Thong Dang Ban, Thu Lai Sau. Ban Khong Mat Tien.";
        $arResponse['type']  = 'text';
        echo json_encode($arResponse); die;
    	//return $this->load->view('FRONTEND/giftcodesms', $data);
    }
    function noverifyemail(){
	    $data = $this->model->fetch("*", "cli_web_users", "email != ''");
	    	if($data){
	      		echo "<table>";
	      		echo "<tr><td>STT</td><td>Email</td></tr>";
	      			foreach ($data as $key => $value) {
       			echo "<tr>
       				<td>{$key}</td>
       				<td>{$value->email}</td></tr>";
	      	}
	      	echo "<table>";
	    }
    }
    function activeemail(){
    	$data = $this->model->fetch("*", "cli_giftcode_email", "status = 0");
	    	if($data){
	      		echo "<table>";
	      		echo "<tr><td>STT</td><td>Email</td></tr>";
	      			foreach ($data as $key => $value) {
       			echo "<tr>
       				<td>{$key}</td>
       				<td>{$value->email}</td></tr>";
	      	}
	      	echo "<table>";
	    }
    }
}