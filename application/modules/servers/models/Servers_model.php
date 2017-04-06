<?php
class Servers_model extends MY_Model {
	private $module = 'servers';
	private $table = 'servers';
	function getsearchContent($limit,$page){
		$this->db->select('*');
		$this->db->limit($limit,$page);
		$first_access = $this->input->post("first_access");
		if(empty($first_access) || $first_access == 0){
			$this->db->order_by('status DESC, id ASC');
		}
		else{
			$this->db->order_by($this->input->post('func_order_by'),$this->input->post('order_by'));
		}
		if($this->input->post('content')!='' && $this->input->post('content')!='type here...'){
			$this->db->where('(`name` LIKE "%'.$this->input->post('content').'%")');
		}
		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')==''){
			$this->db->where('created >= "'.date('Y-m-d 00:00:00',strtotime($this->input->post('dateFrom'))).'"');
		}
		if($this->input->post('dateFrom')=='' && $this->input->post('dateTo')!=''){
			$this->db->where('created <= "'.date('Y-m-d 23:59:59',strtotime($this->input->post('dateTo'))).'"');
		}
		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')!=''){
			$this->db->where('created >= "'.date('Y-m-d 00:00:00',strtotime($this->input->post('dateFrom'))).'"');
			$this->db->where('created <= "'.date('Y-m-d 23:59:59',strtotime($this->input->post('dateTo'))).'"');
		}
		$query = $this->db->get(PREFIX.$this->table);
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	function getTotalsearchContent(){
		$this->db->select('*');
		if($this->input->post('content')!='' && $this->input->post('content')!='type here...'){
			$this->db->where('(`name` LIKE "%'.$this->input->post('content').'%")');
		}
		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')==''){
			$this->db->where('created >= "'.date('Y-m-d 00:00:00',strtotime($this->input->post('dateFrom'))).'"');
		}
		if($this->input->post('dateFrom')=='' && $this->input->post('dateTo')!=''){
			$this->db->where('created <= "'.date('Y-m-d 23:59:59',strtotime($this->input->post('dateTo'))).'"');
		}
		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')!=''){
			$this->db->where('created >= "'.date('Y-m-d 00:00:00',strtotime($this->input->post('dateFrom'))).'"');
			$this->db->where('created <= "'.date('Y-m-d 23:59:59',strtotime($this->input->post('dateTo'))).'"');
		}
		$query = $this->db->count_all_results(PREFIX.$this->table);
		if($query > 0){
			return $query;
		}else{
			return false;
		}
	}
	function getDetailManagement($id){
		$this->db->select('*');
		$this->db->where('id',$id);
		$query = $this->db->get(PREFIX.$this->table);

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}

	function saveManagement(){
		//pr($_POST,1);
		if($this->input->post('statusAdmincp')=='on'){
			$status = 1;
		}else{
			$status = 0;
		}
		
		if($this->input->post('is_new')=='on'){
			$is_new = 1;
		}else{
			$is_new = 0;
		}
		if($this->input->post('is_cron')=='on'){
			$is_cron = 1;
		}else{
			$is_cron = 0;
		}
		$server_name = $this->input->post('nameAdmincp');
		if($this->input->post('hiddenIdAdmincp')==0){
			//Kiểm tra đã tồn tại chưa?
			$checkData = $this->checkData('name',$this->input->post('nameAdmincp'));
			if($checkData){
				print 'error-title-exists';
				exit;
			}

			$data = array(
				'name'=> htmlspecialchars($server_name),
				'slug'	=>	SEO($server_name),
				'note'=> htmlspecialchars($this->input->post('noteAdmincp')),
				'sub_folder'=> $this->input->post('subAdmincp'),
				'port_game'=> $this->input->post('port_gameAdmincp'),
				'url_service'=> $this->input->post('url_serviceAdmincp'),
				'idplay'=> $this->input->post('idplayAdmincp'),
				'port_service'=> $this->input->post('port_serviceAdmincp'),
				'server_status'=> $this->input->post('server_status'),
				'description'=> $this->input->post('descriptionAdmincp'),
				'playtime' => $this->input->post('playtimeAdmincp'),
				'ip'=> htmlspecialchars($this->input->post('ipAdmincp')),
				'status'=> $status,
				'is_new'=> $is_new,
				'is_cron' => $is_cron,
				'created'=> date('Y-m-d H:i:s',time()),
			);

			if($this->db->insert(PREFIX.$this->table,$data)){
				$newid = $this->db->insert_id();
				modules::run('admincp/saveLog',$this->module,$newid,'Add new','Add new');
				modules::run('donate_config/syncConfig',$newid);
				return true;
			}
		}else{
			$result = $this->getDetailManagement($this->input->post('hiddenIdAdmincp'));
			$slug = '';
			//Kiểm tra đã tồn tại chưa?
			if($result[0]->name!=$this->input->post('nameAdmincp')){
				$checkData = $this->checkData('name', $this->input->post('nameAdmincp'));
				if($checkData){
					print 'error-title-exists';
					exit;
				}
			}

			$data = array(
				'name'=> htmlspecialchars($this->input->post('nameAdmincp')),
				'slug'	=>	SEO($server_name),
				'note'=> htmlspecialchars($this->input->post('noteAdmincp')),
				'idplay'=> $this->input->post('idplayAdmincp'),
				'sub_folder'=> $this->input->post('subAdmincp'),
				'port_game'=> $this->input->post('port_gameAdmincp'),
				'url_service'=> $this->input->post('url_serviceAdmincp'),
				'port_service'=> $this->input->post('port_serviceAdmincp'),
				'server_status'=> $this->input->post('server_status'),
				'description'=> $this->input->post('descriptionAdmincp'),
				'playtime' => $this->input->post('playtimeAdmincp'),
				'ip'=> htmlspecialchars($this->input->post('ipAdmincp')),
				'status'=> $status,
				'is_new'=> $is_new,
				'is_cron' =>$is_cron,
				'modified'=> date('Y-m-d H:i:s',time()),
			);
			modules::run('admincp/saveLog',$this->module,$this->input->post('hiddenIdAdmincp'),'','Update',$result,$data);
			$this->db->where('id',$this->input->post('hiddenIdAdmincp'));
			if($this->db->update(PREFIX.$this->table,$data)){
				return true;
			}
		}
		return false;
	}



	function checkData($field, $title){
		$this->db->select('id');
		$this->db->where($field,$title);
		$this->db->limit(1);
		$query = $this->db->get(PREFIX.$this->table);
		if($query->result()){
			return true;
		}else{
			return false;
		}
	}

	function checkSlug($slug){
		$this->db->select('id');
		$this->db->where('slug',$slug);
		$this->db->limit(1);
		$query = $this->db->get(PREFIX.$this->table);
		if($query->result()){
			return true;
		}else{
			return false;
		}
	}

	/*----------------------FRONTEND----------------------*/
	function getServers(){
		$this->db->order_by('playtime DESC');
		// $this->db->limit(12);
		if(!is_local()){
			$this->db->where('status > 0');
		}
		$query = $this->db->get(PREFIX.$this->table);
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return 0;
		}
	}
	
	function getServersCur(){
		$this->db->order_by('created DESC');
		$this->db->group_by('sid');
		$this->db->where('username',$this->session->userdata('username'));
		$this->db->order_by('created','desc');
		$this->db->limit(2);
		$query = $this->db->get('cli_sv_cur');
		return $query->result();
	}
	function insert_ser(){
		$data = array(
			'username' => $this->session->userdata('username'),
			'sid' => $this->input->post('sid'),
			'slug' => $this->input->post('slug'),
			'sname' => $this->input->post('sname'),
			'created' => date('Y-m-d H:i:s',time())
		);
		$this->db->insert('cli_sv_cur',$data);
	}

	function listServer(){
		$this->db->order_by('status DESC, created DESC');
		if(!is_local())
			$this->db->where('status > 0');
		$query = $this->db->get(PREFIX.$this->table);
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return 0;
		}
	}

    function getActiveServers(){
        $this->db->select('*');
        $this->db->order_by('status DESC, created DESC');
        if(!is_local())
        	$this->db->where('server_status = 1');
        $query = $this->db->get(PREFIX.$this->table);
        if($query->result()){
            return $query->result();
        }else{
            return false;
        }

    }
    	
 	function insert_knb($server_id, $user_id, $username, $money, $gamecoin, $charge_log_id){	
 		$server = $this->model->get("*", "cli_servers", "id = $server_id");
        $gamename = $username;
        $knb = $gamecoin;
        
        $md5user_str =md5($username.'@^*%AH_TruyMong%*^@');
 		$character = $username.'_'.$md5user_str;

        $sid = $server->idplay;
        $gold = $knb;
        $money = $money;
        $time = time();
        $key_login = "dGVhbWRldjIwMTU";
        $sign = md5($time.$sid.$character.$key_login.$gold);
        $data = array(
            "user" => $character,
            "sid" => $sid,
            "gold" => $gold,
            "money" => $money,
            "time"  =>  time(),
            "sign"  =>  $sign
        );  
        $urlAPI = "http://$server->url_service/api_add_gold.php";
        // $result = cURLGet($urlAPI, $data);     

        $dt['url'] = processUrl($urlAPI, $data);
        $result = $this->load->view('FRONTEND/api_view',$dt, TRUE);
        return array('status'=>1, 'html'=> $result);
     //    echo $result;
     //    $result = 'ok';

     //    if($result != 'ok')
     //    {
     //    	return false;
     //    }
    	// return true;

	}

	function gm_insert_item($username, $server_id, $itemid, $soluong, $content = ""){
		
		$server = $this->model->get("*", "cli_servers", "id = $server_id");
        $knb = $gamecoin = $soluong;

        $md5user_str =md5($username.'@^*%AH_TruyMong%*^@');
 		$character = $username.'_'.$md5user_str;

        $sid = $server->idplay;
        $itemId = $itemid;
        $soluong = $soluong;
        $key_login = "dGVhbWRldjIwMTU";
        $time = time();
        $sign = md5($time.$sid.$character.$key_login.$itemId);
        $content = 'Gửi Thư';

        $data = array(
                "user" => $character,
                "itemId" => $itemId,
                "count" => $soluong,
                "time"  => $time,
                "sid"   =>  $sid,
                "sign"  =>  $sign,
                "content"   =>  $content
            );
        $urlAPI = "http://$server->url_service/api_send_item.php";

        $url_service = processUrl($urlAPI, $data);
        return array('status'=>1, 'url_service'=> $url_service);


     //    if($result != 'ok')
     //    {
    	// 	return false;
    	// }
    	// return true;
		
	}


	function create_gamename($user, $server_id = 0){
		if(!empty($user->username)){
			$gamename = (empty($user->rand_username)) ? $user->username : $user->rand_username;
			$gamename = $gamename."_".md5($user->id.$user->token);
			if($server_id)
				return strtolower($gamename . "_" . $server_id);
			else
				return strtolower($gamename);
		}
		return FALSE;
	}



	/*--------------------END FRONTEND--------------------*/

}

