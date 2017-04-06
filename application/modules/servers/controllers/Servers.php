<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Servers extends MX_Controller {
	private $module = 'servers';
	private $table = 'servers';
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
	/*------------------------------------ Admin Control Panel ------------------------------------*/
	public function admincp_index(){
		modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'r',0);
		$default_func = 'created';
		$default_sort = 'ASC';
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
		if($id!=0){
			$result = $this->model->getDetailManagement($id);
		}
		$data = array(
			'result'=>$result[0],
			'module'=>$this->module,
			'id'=>$id
		);
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
			//End Upload Image
			if( $this->model->saveManagement() ){
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
				@unlink(BASEFOLDER.DIR_UPLOAD_CLASSES.$result[0]->image);
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
		$first_access = $this->input->post("first_access");
		//pr($first_access,1);
		if(!empty($first_access)){
			$data['first_access'] = 1;
		}
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
	public function admincp_ajaxUpdateServer_Status(){
		$perm = modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'w',1);
		if($perm=='permission-denied'){
			print '<script type="text/javascript">show_perm_denied()</script>';
			$server_status = $this->input->post('server_status');
			$data = array(
				'server_status'=>$server_status
			);
		}else{
			if($this->input->post('server_status')==0){
				$server_status = 1;
			}else{
				$server_status = 0;
			}
			$data = array(
				'server_status'=>$server_status
			);
			modules::run('admincp/saveLog',$this->module,$this->input->post('id'),'server_status','update',$this->input->post('server_status'),$server_status);
			$this->db->where('id', $this->input->post('id'));
			$this->db->update(PREFIX.$this->table, $data);
		}
		$update = array(
			'server_status'=>$server_status,
			'id'=>$this->input->post('id'),
			'module'=>$this->module
		);
		$this->load->view('BACKEND/ajax_updateServer_Status',$update);
	}

	/*------------------------------------ End Admin Control Panel --------------------------------*/


	/*------------------------------------ FRONTEND ------------------------------------*/

	public function index(){
       	$data['servers'] = $this->model->getServers();
       	// $this->template->set_template('bigupdate');
        $this->template->write('meta_keywords',META_KEY);
        $this->template->write('meta_description',META_DESC);
        $this->template->write('title', 'Danh sách máy chủ | '.getSiteName());
        $this->template->write_view('content','FRONTEND/index',$data);
        $this->template->render();
	}

	public function listServer(){
		$this->load->model("servers/servers_model");
		$data['servers'] = $this->servers_model->listServer();
        echo $this->load->view('FRONTEND/listServer',$data);
	}

	function linkserver(){
		$this->load->model("servers/servers_model");
		$server = $this->servers_model->get('*', PREFIX.$this->table, "status = 1", 'playtime', 'desc');

		if($server)
			redirect(PATH_URL . "choi-game/". $server->slug);
		else
			redirect(PATH_URL . "trang-chu");
	}

	function create_user_appfacebook(){
		require APPPATH.'libraries/fb/facebook.php';
		$facebook = new Facebook(array(
		  'appId'  => '299825140207631',
		  'secret' => '07a89fbe092c650ed08fa338a399998a',
		));
		$user = $facebook->getUser();

		// pr($user,1);
		if ($user) {
		  try {
		    $user_profile = $facebook->api('/me');
		    $this->session->set_userdata("appface", "ok");
		   //pr($user_profile); die;
		  } catch (FacebookApiException $e) {
		    $user = null;
		  }
		}

		$id= $user_profile['id'];
		$name= $user_profile['name'];
		$token= "123";
		$confirm=trim($this->input->get('confirm'));
		if(!$id || !$name || !$token){
			redirect(PATH_URL);die;
		}
		$username=trim(str_replace(" ","",$name));
		$username=strtolower(create_slug($username)."_".$id);
		
		$this->load->model("user/user_model");
		$this->user_model->login_app_facebook($username,$id,$token, $confirm);
		//pr($this->session->userdata("username"));die;
		// $this->linkserver();
		$appface = $this->session->userdata("appface");
		if($appface){
			$this->load->model("servers/servers_model");
			$server = $this->servers_model->get('*', PREFIX.$this->table, "status = 1", 'playtime', 'desc');

			if($server)
				redirect("https://duhiepky.cuahd.com/choi-game/". $server->slug);
			
		}
		else{
				redirect("https://duhiepky.cuahd.com/may-chu");
		}
		

	}			

	function playGame($slug = ''){
		$ipcheck = getIP();
		/*if(ban_ip($ipcheck)){
			redirect(PATH_URL);
		}*/
		$username = $this->session->userdata('username');
		//pr($username,1);
		if($username){
			$ip=getIP();
			if(!is_local())
				$server = $this->model->get('*', PREFIX.$this->table, "`slug` = '$slug' AND status = 1");
			else
				$server = $this->model->get('*', PREFIX.$this->table, "`slug` = '$slug'");
			if($server){
				$user = $this->model->get('*', PREFIX.'web_users', "`username` = '$username' AND status = 1 ");
				if(!isset($user->id)){
					redirect(PATH_URL);
				}

				$sid = $server->idplay;

				$time = time();
				$key_login = "dGVhbWRldjIwMTU";
				$sid = $server->idplay;
 				$security = md5($time.$sid.$user->username.$key_login);
				//pr($security);
   				$url = "http://$server->ip:$server->port_game/$server->sub_folder?account={$username}&security=$security&time={$time}&sid={$server->idplay}";

   				$md5user_str =md5($username.'@^*%AH_TruyMong%*^@');
		 		$character = $username.'_'.$md5user_str;

   				$url_service = "http://$server->url_service/api_new_account.php?account={$character}&sid={$server->idplay}";

   				$data = array(
                    'url'       =>  $url,
                    'server'    =>  $server,
                    'title'     =>  $server->name . " | " .getSiteName(),
                    'url_service' => $url_service
                );

				$data['serverid'] = $server->id;
				$server_id = $this->session->userdata("server_id");
				if($server_id != $server->id)
					$this->session->set_userdata('server_id',$server->id);
                if(!is_local()){
            		$data['servers']= $this->model->fetch('*',PREFIX . $this->table,  "`status` = 1 ", "playtime", "DESC");
            	}
            	else{
            		$data['servers']= $this->model->fetch('*',PREFIX . $this->table,  "", "playtime", "DESC");
            	}
            	//pr($data,1);

            	//$pre_bool = file_get_contents('http://'.$server->url_service.'/api_new_account.php?account='.$character.'&sid='.$sid);
            	// pr($username);
            	// pr('http://'.$server->url_service.'/api_new_account.php?account='.$character.'&sid='.$sid,1);
                $this->load->view('FRONTEND/skin_playgame_leftbar',$data);    
			}
			else{
				redirect(PATH_URL);
			}
		}
		else{
			redirect(PATH_URL.'dang-nhap');
		}
	}

 	function view_servers(){
 		$this->load->model("servers_model");
 		if(is_local()){
 			$servers = $this->servers_model->fetch("*", "cli_servers", "");	
 		}
 		else{
 			$servers = $this->servers_model->fetch("*", "cli_servers", "status = 1");
 		}
 		
 		$data['servers'] = $servers;
 		echo $this->load->view("FRONTEND/view_servers", $data);
 	}


	function test_1(){

		$file = APPPATH . "config/notice.txt";
				        $file= file_get_contents($file);

				       	$file=unserialize($file);

				       	pr($file);die;
	}

	 public function thongbaogameInterval(){

        //$thongbao = $this->model->get('*', PREFIX . "inform", "`slug` = 'inform'");


    	//$data['thongbao'] = $this->model->get('*', PREFIX . "inform", "`slug` = 'inform'");
    	$server_id=$this->uri->segment(3);
		$file = APPPATH . "config/notice.txt";
	    $file= file_get_contents($file);

	    $file=unserialize($file);

	    foreach ($file as $key => $thongbao) {
	    	if(in_array($server_id, explode(",",$thongbao->server)))
	       	if($thongbao->status == 1 && date('d-m-Y H:i') >= date('d-m-Y H:i',strtotime($thongbao->start)) && date('d-m-Y H:i') <= date('d-m-Y H:i',strtotime($thongbao->stop)) ) {
	       		$dt_tb=$thongbao;
	       		break;	
	       	}
	    }	

        if(isset($dt_tb))
	       if($dt_tb->content!="" || $dt_tb->title!=""){
	        	echo json_encode($dt_tb);exit();
	        }else{
	        	
	        } 
      	else{
      		echo json_encode(array());exit();
      	}	


    }	

    function get_server_langding(){
    	$this->load->model('servers_model');
    	$data = $this->servers_model->getServers();
    	return $data[0];
    }

   
     public  function UserOnlineJob(){
        $servers = $this->model->fetch('*', PREFIX.'servers', "");
        if($servers)
        {
            $now =  date('Y-m-d H:i:s', time());
            foreach ($servers as $server) {
                $url = "http://$server->url_service/api_online.php?sid={$server->idplay}";
                pr($url);
                $tmp = file_get_contents($url);
                $tmp = (int)$tmp;
                pr($tmp);                

                $data = array(
                        'sid' => $server->id,
                        'total'  => $tmp,
                        'created' => $now
                );
                $this->db->insert("cli_log_useronlinejob", $data);
            }

        }
    }


    function getInfoByUsername($username, $server_id){
		$this->load->model("servers/servers_model");
		$server = $this->servers_model->get('*', PREFIX.'servers', "id = $server_id");
		$user = $this->servers_model->get("*", "cli_web_users", "username = '$username'");
		if($server){
        	$url = getServiceURL($server, "MG_get_player_by_username.php");
        	//pr($url);
        	$username2 = md5($username.'tiendatnn^**^@@^');
			$game_user = $username."_".$username2."_{$server->idplay}";	
			//pr($game_user,1);

			// $link = "$url?user_name=$game_user&server_id=$server->id";
			// pr($link);
			$data = array('user_name' => $game_user , 'server_id' => $server->idplay);
			//pr($data,1);
			$bool = cURLGet($url, $data);
        	$bool = json_decode($bool);
        	if(isset($bool->name) && $bool->name!= 'null' && $bool->name!= ''){
        		return $bool; die;
        	}
        	return 0; die;			
		}
       // http://client.magioi.vn:8686/API/?user_name=htuan2_926cceff729ce5386ec527a64d3af274_1&server_id=1
    }	
	/*------------------------------------ End FRONTEND --------------------------------*/
	function popupServer(){
		$this->load->model('servers/servers_model');
    	$data['servers'] = $this->servers_model->getServers();
    	return $this->load->view('FRONTEND/popserver',$data);
    }
    function set_ser_cur(){	
    	$id=$this->input->post('sid');
    	$server=$this->model->get('*','cli_servers',array('id'=>$id));
    	if(!isset($server->id)){
    		return false;
    	}
    	$username=$this->session->userdata('username');
    	$user = $this->model->get("id,username", "cli_web_users", "username = '$username' ");

    	$this->db->query("DELETE  FROM `cli_sv_cur` WHERE DATE(`created`) = '".date('Y-m-d')."' AND `sid` =".$server->id." AND `username`='".$username."' ");	


    	if(isset($user->id)){
	    	$data = array(
	    		'user_id' => $user->id,
				'username' => $this->session->userdata('username'),
				'sid' => $server->id,
				'slug' => $server->slug,
				'sname' => $server->name,
				'ip'	=>	getIP(),
				'created' => date('Y-m-d H:i:s',time())
			);
			$this->db->insert('cli_sv_cur',$data);
		}	

		//$this->db->query("DELETE  FROM `cli_sv_cur` WHERE `created` < NOW() - INTERVAL 3 DAY");
		echo 'ok';die;	


    }
    function listSiderbar(){
	if(!is_local()){
		$this->db->where('status',1);
	}
	$this->db->order_by('created', 'desc');
	$this->db->limit(4);
	$data = $this->db->get("cli_servers")->result();
	return $data;
    }



    public function created_user_play(){
		$username=random_username();
		$this->load->model("user/user_model");
		if(!$this->session->userdata('username')){
			$this->user_model->created_user_play($username);
		}			
		$this->linkserver();

	}

	function sends16(){
		
		$checkserver = 15;
		$server_id = $this->input->post("server_id");
		$username = $this->session->userdata("username");
		$user = $this->model->get("*", "cli_web_users", "username = '$username'");
		if($server_id == 16 && $user){

			$sql = "SELECT  `username` ,  `server_id` , SUM(  `card_amount` ) AS tong FROM cli_donate WHERE `card_amount` > 0 AND username =  '$username' AND server_id = $checkserver AND created <= '2015-01-15:23:59:59'  GROUP BY username";
			$dt  = $this->db->query($sql);

			//pr(last_query());
			$checkmoney =  0;
			if($dt->num_rows() >0 ){
				$checkmoney = $dt->row();
				//pr($checkmoney,1);
				$checkmoney = $checkmoney->tong;
			}
			$gamecoin = $checkmoney/100*2;
			if($gamecoin == 0){
				echo "Bạn chưa nạp thẻ cho server s15 vừa qua"; die;
			}
			$check = $this->model->get("*", "cli_sends16", "username = '$username'");
			if(empty($check)){
				$data = array('username' => $username, 'server_id' => $server_id, 'gamecoin' => $gamecoin);
				$bool = $this->model->insert_knb($server_id, $user->id, $username, 0, $gamecoin, 0);
				if($bool){
					$data['is_send'] = 1;
				}
				else{
					$data['is_send'] = 0;
				}
				$this->db->insert("cli_sends16", $data);
				echo "Bạn vừa nhận đền bù từ s15 => s16 thành công";
			}
			else{
				echo "Bạn đã nhận đền bù từ s15 => s16";
			}
		}
	}

	function sendback(){
		
		$checkserver = 17;
		$server_id = $this->input->post("server_id");
		$username = $this->session->userdata("username");
		$user = $this->model->get("*", "cli_web_users", "username = '$username'");
		if($server_id == 18 && $user){

			$sql = "SELECT  `username` ,  `server_id` , SUM(  `card_amount` ) AS tong FROM cli_donate WHERE `card_amount` > 0 AND username =  '$username' AND server_id = $checkserver AND created <= '2015-01-21 10:00:00'  GROUP BY username";
			$dt  = $this->db->query($sql);

			//pr($dt->num_rows() ,1);
			$checkmoney =  0;
			if($dt->num_rows() >0 ){
				$checkmoney = $dt->row();
				//pr($checkmoney,1);
				$checkmoney = $checkmoney->tong;
			}
			$gamecoin = $checkmoney/100*2;
			if($gamecoin == 0){
				echo "Bạn chưa nạp thẻ cho server s17 vừa qua"; die;
			}
			$check = $this->model->get("*", "cli_sendback", "username = '$username'");
			if(empty($check)){
				$data = array('username' => $username, 'server_id' => $server_id, 'gamecoin' => $gamecoin);
				$bool = $this->model->insert_knb($server_id, $user->id, $username, 0, $gamecoin, 0);
				if($bool){
					$data['is_send'] = 1;
				}
				else{
					$data['is_send'] = 0;
				}
				$this->db->insert("cli_sendback", $data);
				echo "Bạn vừa nhận đền bù từ s17 => s18 thành công";
			}
			else{
				echo "Bạn đã nhận đền bù từ s17 => s18";
			}
		}
	}

	
}

