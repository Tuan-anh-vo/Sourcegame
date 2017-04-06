<?php
class Donate_model extends MY_Model {
	private $module = 'donate';
	private $table = 'donate';

	function __construct(){
	}

	function getsearchContent($limit,$page){
		//pr($_POST,1);
		$this->db->select("*");
		$this->db->limit($limit,$page);
		if($this->input->post('func_order_by') && $this->input->post('order_by'))
			$this->db->order_by($this->input->post('func_order_by'),$this->input->post('order_by'));
		if($this->input->post('content')!='' && $this->input->post('content')!='type here...'){
			$this->db->where('(username LIKE "%'.$this->input->post('content').'%")');
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
		$query = $this->db->get("cli_donate");
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function getTotalsearchContent(){
		$this->db->select("*");
		if($this->input->post('content')!='' && $this->input->post('content')!='type here...'){
			$this->db->where('(username LIKE "%'.$this->input->post('content').'%")');
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
		$query = $this->db->count_all_results("cli_donate");

		if($query > 0){
			return $query;
		}else{
			return false;
		}
	}
	
	function getTotalVND(){
		$this->db->select_sum('card_amount');
		$this->db->where('(cli_donate.transaction_id != 0 OR cli_donate.card_amount != 0)');

		$this->db->where('step >=','2');
		$query = $this->db->get(PREFIX.$this->table);
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	function getTotalVNDofDay(){
		$this->db->select_sum('card_amount');
		$this->db->where('(`transaction_id` != 0 OR `card_amount` != 0)');
		$this->db->like('created',date('Y-m-d'));
		$query = $this->db->get(PREFIX.'donate');
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	function getMemberDonate($id = 0){
		$this->db->select('id');
		$this->db->where('(`transaction_id` != 0 OR `card_amount` != 0)');
		$this->db->like('created',date('Y-m-d'));
		$query = $this->db->count_all_results(PREFIX.'donate');
		return $query;
	}
	function getChargeChart($month = 0, $year = 0){
		if(!$month && !$year){
			$min_date = mktime(0,0,0,date('n'),1);
		}
		else{
			$min_date = mktime(0,0,0,$month,1,$year);			
		}

		$time = date('Y-m-d',$min_date);
		$count = date('t', $min_date);
		if($id != 0){
			$dataTable = $this->db->where('created >=',$time)
									->order_by('created','ASC')
									->get(PREFIX.'donate')
									->result();					
		}else if ($id==0){
			$dataTable = $this->db->where('created >=',$time)
									->order_by('created','ASC')
									->get(PREFIX.'donate')
									->result();	
		}
		//order data
		$data = array();
		
		for($i = 0; $i < $count; $i ++){
			$total = 0;
			if($month == 0 || $year == 0){
				$interval = mktime(0, 0, 0, date('n'), 1 + $i);
				$max_interval = mktime(0, 0, 0, date('n'), 2 + $i);
			}	
			else{
				$interval = mktime(0, 0, 0, $month, 1 + $i, $year);
				$max_interval = mktime(0, 0, 0, $month, 2 + $i, $year);
			}	
			// pr($interval,1);

			$delimiter = date('j', $interval);
			$text = $delimiter;

			foreach ($dataTable as $key => $value) {
				$compare_time = strtotime($value->created);
				if($compare_time < $max_interval && $compare_time >= $min_date){
					$total += count($value->username);
					unset($dataTable[$key]);
				}
			}
			$data[$text]['total'] = $total;
		}
		// $data = array_reverse ($data, TRUE);
		//transform data to string, then send to view
		$series = '';
		$number = '';
		foreach ($data as $key => $val) {
			$series .= "'$key',";
			$number .= $val['total'].",";
		}
		return array(
					'series'	=>	substr($series, 0, -1),
					'number'	=>	substr($number, 0, -1)
					);
		
		/*if($id != 0)
			$cond = "AND server = $id";
		$query =   "SELECT DATE(created) as date,COUNT(username) as total, DATEDIFF(DATE(created),DATE_SUB(CURDATE(), INTERVAL 30 DAY)) as diff 
					FROM cli_donate
					WHERE DATEDIFF(DATE(created),DATE_SUB(CURDATE(), INTERVAL 30 DAY)) > 0 AND card_amount > 0 $cond
					GROUP BY DATEDIFF(DATE(created),DATE_SUB(CURDATE(), INTERVAL 30 DAY))
					ORDER BY diff ASC
					";
		return $this->db->query($query)->result();
		*/
	}
	
	function getChargeAmountChart($month=0,$year=0){
		if(!$month && !$year){
			$min_date = mktime(0,0,0,date('n'),1);
		}
		else{
			$min_date = mktime(0,0,0,$month,1,$year);			
		}

		$time = date('Y-m-d',$min_date);
		$count = date('t', $min_date);
		if($id != 0){
			$dataTable = $this->db->where('created >=', $time)
										->order_by('created','ASC')
										->get(PREFIX.'donate')
										->result();					
		}else if($id==0){
			$dataTable = $this->db->where('created >=', $time)
									->order_by('created','ASC')
									->get(PREFIX.'donate')
									->result();			
		}
		//order data
		$data = array();
		
		for($i = 0; $i < $count; $i ++){
			$total = 0;
			if($month == 0 || $year == 0){
				$interval = mktime(0, 0, 0, date('n'), 1 + $i);
				$max_interval = mktime(0, 0, 0, date('n'), 2 + $i);
			}	
			else{
				$interval = mktime(0, 0, 0, $month, 1 + $i, $year);
				$max_interval = mktime(0, 0, 0, $month, 2 + $i, $year);
			}	
			// pr($interval,1);

			$delimiter = date('j', $interval);
			$text = $delimiter;


			foreach ($dataTable as $key => $value) {
				$compare_time = strtotime($value->created);
				if($compare_time < $max_interval && $compare_time >= $min_date){
					$total += $value->card_amount;
					unset($dataTable[$key]);
				}
			}
			$data[$text]['total'] = $total;
		}
	//	var_dump($data);exit();
		// $data = array_reverse ($data, TRUE);
		//transform data to string, then send to view
		$series = '';
		$number = '';
		foreach ($data as $key => $val) {
			$series .= "'$key',";
			$number .= $val['total'].",";
		}
		return array(
					'series'	=>	substr($series, 0, -1),
					'number'	=>	substr($number, 0, -1)
					);
	/*	$cond = '';
		if($id != 0)
			$cond = "AND server = $id";
		$query =   "SELECT DATE(created) as date,SUM(card_amount) as total, DATEDIFF(DATE(created),DATE_SUB(CURDATE(), INTERVAL 30 DAY)) as diff 
					FROM cli_donate
					WHERE DATEDIFF(DATE(created),DATE_SUB(CURDATE(), INTERVAL 30 DAY)) > 0 AND card_amount > 0 $cond
					GROUP BY DATEDIFF(DATE(created),DATE_SUB(CURDATE(), INTERVAL 30 DAY))
					ORDER BY diff ASC
					";
		return $this->db->query($query)->result();			
	*/
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
	
	function saveManagement($fileName=''){
		if($this->input->post('statusAdmincp')=='on'){
			$status = 1;
		}else{
			$status = 0;
		}

		if($this->input->post('hiddenIdAdmincp')==0){
			//Kiểm tra đã tồn tại chưa?
			$checkData = $this->checkData($this->input->post('titleAdmincp'));
			if($checkData){
				print 'error-title-exists';
				exit;
			}
			
			$checkSlug = $this->checkSlug($this->input->post('slugAdmincp'));
			if($checkSlug){
				print 'error-slug-exists';
				exit;
			}
			$data = array(
				'title'=> $this->input->post('titleAdmincp'),
				'slug'=> $this->input->post('slugAdmincp'),
				'description'=> $this->input->post('descriptionAdmincp'),
				'content'=> $this->input->post('contentAdmincp'),
				'type'	=>	$this->input->post('typeAdmincp'),
				'image'=> $fileName['image'],
				'status'=> $status,
				'created'=> date('Y-m-d H:i:s',time()),
			);
			if($this->db->insert(PREFIX.$this->table,$data)){
				modules::run('admincp/saveLog',$this->module,$this->db->insert_id(),'Add new','Add new');
				return true;
			}
		}else{
			$result = $this->getDetailManagement($this->input->post('hiddenIdAdmincp'));
			//Kiểm tra đã tồn tại chưa?
			if($result[0]->title!=$this->input->post('titleAdmincp')){
				$checkData = $this->checkData($this->input->post('titleAdmincp'));
				if($checkData){
					print 'error-title-exists';
					exit;
				}
			}
			
			if($result[0]->slug!=$this->input->post('slugAdmincp')){
				$checkSlug = $this->checkSlug($this->input->post('slugAdmincp'));
				if($checkSlug){
					print 'error-slug-exists';
					exit;
				}
			}
			
			//Xử lý xóa hình khi update thay đổi hình
			if($fileName['image']==''){
				$fileName['image'] = $result[0]->image;
			}else{
				@unlink(BASEFOLDER.DIR_UPLOAD_NEWS.$result[0]->image);
			}
			//End xử lý xóa hình khi update thay đổi hình
			
			$data = array(
				'title'=> $this->input->post('titleAdmincp'),
				'slug'=> $this->input->post('slugAdmincp'),
				'description'=> $this->input->post('descriptionAdmincp'),
				'content'=> $this->input->post('contentAdmincp'),
				'type'	=>	$this->input->post('typeAdmincp'),
				'image'=> $fileName['image'],
				'status'=> $status
			);
			modules::run('admincp/saveLog',$this->module,$this->input->post('hiddenIdAdmincp'),'','Update',$result,$data);
			$this->db->where('id',$this->input->post('hiddenIdAdmincp'));
			if($this->db->update(PREFIX.$this->table,$data)){
				return true;
			}
		}
		return false;
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
	
	function checkData($title){
		$this->db->select('id');
		$this->db->where('title',$title);
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


	function _getList($limit = -1, $page = -1, $username) {

		$this->db->select('*');
		$this->db->where("step" ,'2');
		$this->db->where('username', $username);
		$this->db->order_by('finished', 'desc');
		if ($limit == -1) {
		 
		} else {
			$this->db->limit($limit, $page);
		}

		$query = $this->db->get(PREFIX.$this->table);
		if ($query->result()) {
			if ($limit == -1) {
				return count($query->result());
			} else {
				return $query->result();
			}
		}else
		return false;

   	}

	
	/*----------------------FRONTEND----------------------*/

	function donateLog($data, $id = ''){

		if($id == ''){
			// insert || before donate
			$this->db->insert(PREFIX.$this->table, $data);
		}else{
			// update || finish donate
			$this->db->where('id', $id);
			$this->db->update(PREFIX.$this->table, $data);
		}

		return $this->db->insert_id();

	}
	
	function donateLogDelete($id){

		$this->db->where('id', $id)->delete(PREFIX.$this->table);

	}

	function getDonateHistory($username){

		$query = $this->db->where('username', $username)
						->where('step >=', '2')
						->order_by('finished DESC')
						->get(PREFIX.$this->table);

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}

	}


	function getBalance($accID){

		$data = false;

		$query = $this->tbGame
					->where('account_id', $accID)
					->get('donation');

		if($query->row_array()){
			$data = $query->row_array();
		}

		return $data;

	}

	function setBalance($accID, $dt){

		$data = false;

		$query = $this->tbGame
					->where('account_id', $accID)
					->update('donation', $dt);

		if($query){
			$data = true;
		}

		return $data;

	}
	

	function insertBalanceRecord($accID){

		$dt = array(
			'account_id'	=>	$accID,
			'balance'		=>	'0'
		);
		$data = false;
		$query = $this->tbGame
					->insert('donation', $dt);

		if($query){
			$data = true;
		}
		return $data;

	}
	function transaction($mathe = "", $seri = "", $username = "", $month = "", $server="", $status, $num = FALSE, $record, $start){
        if($this->session->userdata('userGroup') == 3 && $seri == "" && $username == "" && $mathe == "" && $this->session->userdata('game_permission') == ""){
               return 0;
        }
        if($status){
            if($status == 1){
                $where = 'step = 2 AND card_amount is not null AND finished = 1';
                $this->db->where($where);
            }
            else if($status == 2){
                $where = 'step = 2 AND card_amount is not null AND finished = 0';
                $this->db->where($where);
            }
            else if($status == 3){
                $where = 'step != 2 AND card_amount is null OR card_amount = 0';
                $this->db->where($where);
            }
        }
        if($month){
            $months = intval(substr($month,0,2)); $year = substr($month,3);
        }
        else{
            $months = date('n'); $year = date('Y');
        }
        if($server){$this->db->like('server_id',$server);}
        if($username){$this->db->like('username', $username);}
        if($seri){$this->db->like('card_serial', $seri);}
        if($mathe){$this->db->like('card_pin', $mathe);}
        if($record){
        	$start==1?$start=0:$start = ($start-1)*$record;
        	$this->db->limit($record,$start);
        }
        $this->db->order_by("created","desc");
        $data = $this->db->get('cli_donate');
        if($num){
        	return $data->num_rows();
        }else{
        	return $data->result();
        }
    }	
    function delete_transaction($id = ""){
        $this->db->delete('cli_donate', array('id' => $id));
    }
    function update_transaction($id){
        return $this->get('*','cli_donate','id ='.$id);
    }
    function update_the($id,$card_amount = 0,$status,$gamecoin){
        if($status == 1){
            $data['flag'] = 1;
        }
        else if($status == 3){
            $card_amount = 0;
            $data['flag'] = 0;
        }
        else $data['flag'] = 0;
        $data['gamecoin'] = $gamecoin;
        $data['card_amount'] = $card_amount;
        $this->db->where('id',$id);
        $this->db->update('cli_donate',$data);
    }
	/*--------------------END FRONTEND--------------------*/
}