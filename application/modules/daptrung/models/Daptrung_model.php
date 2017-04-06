<?php
class Daptrung_model extends MY_Model {
	private $module = 'daptrung';
	private $table = 'daptrung_count';
	private $time = '2015-02-13 10:00:00';

	function getsearchContent($limit,$page){
		$this->db->select('*');
		$this->db->limit($limit,$page);
		$this->db->order_by($this->input->post('func_order_by'),$this->input->post('order_by'));
		if($this->input->post('content')!='' && $this->input->post('content')!='type here...'){
			$this->db->where('(`username` LIKE "%'.$this->input->post('content').'%")');
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
		$this->db->where("count != -1");
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
			$this->db->where('(`username` LIKE "%'.$this->input->post('content').'%")');
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
		$this->db->where("count != -1");
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
		$user = $this->model->get('*',PREFIX.'web_users',"status = 1 AND username LIKE '{$this->input->post('UserAdmincp')}'");

		if(empty($user)){
			print 'error-user-not-exists';
			exit;
		}

		$data = array(
			'user_id' => $user->id,
			'username'=> $this->input->post('UserAdmincp'),
			'count'=> $this->input->post('CountAdmincp'),
			'message'=> 'Add búa do admincp',
			'created'=> date('Y-m-d H:i:s'),
		);
		if($this->input->post('hiddenIdAdmincp')==0){
			//Kiểm tra đã tồn tại chưa?
			// $checkData = $this->checkData($this->input->post('UserAdmincp'));
			// if($checkData){
			// 	print 'error-user-exists';
			// 	exit;
			// }
			if($this->db->insert(PREFIX.$this->table,$data)){
				modules::run('admincp/saveLog',$this->module,$this->db->insert_id(),'Add new','Add new');
				return true;
			}
		}else{
			$result = $this->getDetailManagement($this->input->post('hiddenIdAdmincp'));
			unset($data['created']);
			modules::run('admincp/saveLog',$this->module,$this->input->post('hiddenIdAdmincp'),'','Update',$result,$data);
			$this->db->where('id',$this->input->post('hiddenIdAdmincp'));
			if($this->db->update(PREFIX.$this->table,$data)){
				return true;
			}
		}
		return false;
	}
	function checkData($username){
		$this->db->select('id');
		$this->db->where('username',$username);
		$this->db->limit(1);
		$query = $this->db->get(PREFIX.$this->table);
		if($query->result()){
			return true;
		}else{
			return false;
		}
	}


 /*---------------- End Admin Control Panel (^-^) Begin Frontend ----------------------*/
	//Get so lan da dap trung cua user
    function getCountAll($user){
    	if(!$user || empty($user) ){
    		exit;	
    	}
    	$count_dt_card = 0;
    	$sql = "SELECT `username`,sum(abs(`count`)) as `count_sum` FROM cli_daptrung_count WHERE `username` LIKE '{$user->username}' AND `count` = -1";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            $row = $query->row();
            return $row->count_sum;
        }else{
        	return 0;
        }
    }
	//Get so lan dap trung hien tai cua user
    function getCount($user){
    	if(!$user || empty($user) ){
    		exit;	
    	}

        $count_dt_card = 0;
        $sql = "SELECT `username`,sum(`count`) as `count_dt` FROM cli_daptrung_count WHERE `username` LIKE '{$user->username}' GROUP BY `username`";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0)
        {
            $row = $query->row();
            //pr($row);
            $count_dt_card = $row->count_dt;
            //pr($count_lucky_card,1);
            return $count_dt_card;
        }
        else
            return $count_dt_card;
    }
    function addCount($username, $type = ''){
   //  	$check_con = modules::run('daptrung_config/check_event');
   //  	if(!$check_con ){
			// exit;
   //      }

    	$data_ins = array(
    		'user_id' => $username->id,
    		'username' => $username->username,
    		'count' => $type['count'],
    		'message' => $type['message'],
    		'created' => date('Y-m-d H:i:s',time())
    	);
    	$this->db->insert(PREFIX.'daptrung_count',$data_ins);

    }
    function addCountToday($user){  
        $check_con = modules::run('daptrung_config/check_event');
    	if(!$check_con ){
			exit;
        }

    	$today = date("Y-m-d", time());
    	$check_count = $this->model->get('*',PREFIX.'daptrung_count',"username LIKE '{$user->username}' AND DATE(`created`) = '{$today}' AND `is_today` = 1");
    	if(empty($check_count)){
    		$data_ins = array(
	    		'user_id' => $user->id,
	    		'username' => $user->username,
	    		'count' => 5,
	    		'is_today' =>1,
	    		'message' => 'Đăng nhập lần đầu hằng ngày',
	    		'created' => date('Y-m-d H:i:s',time())
	    	);
	    	$this->db->insert(PREFIX.'daptrung_count',$data_ins);
    	}
    }
    function removeCount($user){
    	$check_con = modules::run('daptrung_config/check_event');
    	if(!$check_con ){
			exit;
        }

    	$data_ins = array(
    		'user_id' => $user->id,
    		'username' => $user->username,
    		'count' => -1,
    		'subtract' => -1,
    		'created' => date('Y-m-d H:i:s',time())
    	);
    	$this->db->insert(PREFIX.'daptrung_count',$data_ins);	
    }

    function getAwardAvailable()
    {
        $this->db->select('*');
        $query = $this->db->get(PREFIX.'lucky_award');
        if($query->num_rows() > 0){
            $row = $query->result_array();
            return $row;
        }else{
            return '';
        }
    }
    function top_user(){
    	$sql = "SELECT `username`,`user_id`,sum(abs(`count`))+sum(`subtract`)  as `count_sum` FROM `cli_daptrung_count` GROUP BY `username` ORDER BY `count_sum` DESC LIMIT 0,10";
    	$query = $this->db->query($sql);
    	if($query->num_rows > 0){
    		return $query->result();
    	}else{
    		return false;
    	}

    }


}