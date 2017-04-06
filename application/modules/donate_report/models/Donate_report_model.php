<?php
class Donate_report_model extends MY_Model {
	private $module = 'donate_report';
	private $table = 'donate';

	function __construct(){
	}

	function getsearchContent($limit,$page){
		$this->db->select('cli_donate.*');
		$this->db->limit($limit,$page);
		$this->db->order_by('cli_donate.'.$this->input->post('func_order_by'),$this->input->post('order_by'));
		if($this->input->post('content')!='' && $this->input->post('content')!='type here...'){
			$this->db->where('(cli_donate.username LIKE "%'.$this->input->post('content').'%")');
		}
		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')==''){
			$this->db->where('cli_donate.created >= "'.date('Y-m-d 00:00:00',strtotime($this->input->post('dateFrom'))).'"');
		}
		if($this->input->post('dateFrom')=='' && $this->input->post('dateTo')!=''){
			$this->db->where('cli_donate.created <= "'.date('Y-m-d 23:59:59',strtotime($this->input->post('dateTo'))).'"');
		}
		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')!=''){
			$this->db->where('cli_donate.created >= "'.date('Y-m-d 00:00:00',strtotime($this->input->post('dateFrom'))).'"');
			$this->db->where('cli_donate.created <= "'.date('Y-m-d 23:59:59',strtotime($this->input->post('dateTo'))).'"');
		}

		$query = $this->db->get(PREFIX.$this->table);

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function getTotalsearchContent(){
		$this->db->select('cli_donate.*');
		if($this->input->post('content')!='' && $this->input->post('content')!='type here...'){
			$this->db->where('(cli_donate.username LIKE "%'.$this->input->post('content').'%")');
		}
		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')==''){
			$this->db->where('cli_donate.created >= "'.date('Y-m-d 00:00:00',strtotime($this->input->post('dateFrom'))).'"');
		}
		if($this->input->post('dateFrom')=='' && $this->input->post('dateTo')!=''){
			$this->db->where('cli_donate.created <= "'.date('Y-m-d 23:59:59',strtotime($this->input->post('dateTo'))).'"');
		}
		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')!=''){
			$this->db->where('cli_donate.created >= "'.date('Y-m-d 00:00:00',strtotime($this->input->post('dateFrom'))).'"');
			$this->db->where('cli_donate.created <= "'.date('Y-m-d 23:59:59',strtotime($this->input->post('dateTo'))).'"');
		}
		$query = $this->db->count_all_results(PREFIX.$this->table);

		if($query > 0){
			return $query;
		}else{
			return false;
		}
	}
	function getTotalPerson(){
		$this->db->group_by('username');
		$query = $this->db->get(PREFIX.$this->table);
		
		if($query->num_rows() > 0 ){
			return $query->num_rows();
		}else{
			return 0;
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
	function getMemberDonate(){
		$this->db->select('id');
		$this->db->where('(`transaction_id` != 0 OR `card_amount` != 0)');
		$this->db->like('created',date('Y-m-d'));
		$query = $this->db->count_all_results(PREFIX.'donate');
		return $query;
	}
	function getChargeChart($id = 0,$month = 0, $year = 0, $group_by = ''){
		if(!$month && !$year){
			$min_date = mktime(0,0,0,date('n'),1);
		}
		else{
			$min_date = mktime(0,0,0,$month,1,$year);			
		}

		$time = date('Y-m-d',$min_date);
		$count = date('t', $min_date);
		if($id != 0){
			$dataTable = $this->db->where('created >=',$time)->where('server',$id)
									->order_by('created','ASC')
									->get(PREFIX.'donate')
									->result();					
		}else if ($id==0){
			if($group_by != ''){
				$dataTable = $this->db->where('created >=',$time)
									->order_by('created','ASC')->group_by("{$group_by}")
									->get(PREFIX.'donate')
									->result();	
			}
			else{
				$dataTable = $this->db->where('created >=',$time)
									->order_by('created','ASC')
									->get(PREFIX.'donate')
									->result();	
			}
		}

		$dataTableIP = $this->db->where('created >=',$time)
									->order_by('created','ASC')->group_by("username")
									->get(PREFIX.'donate')
									->result();	
		//order data
		$data = array(); $dataIP = array();
		
		for($i = 0; $i < $count; $i ++){
			$total = 0; $totalIP = 0;
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

			foreach ($dataTableIP as $key => $value) {
				$compare_time = strtotime($value->created);
				if($compare_time < $max_interval && $compare_time >= $min_date){
					$totalIP += count($value->username);
					unset($dataTableIP[$key]);
				}
			}
			$dataIP[$text]['totalIP'] = $totalIP;
		}
		// $data = array_reverse ($data, TRUE);
		//transform data to string, then send to view
		$series = '';
		$number = '';
		$numberIP = '';
		foreach ($data as $key => $val) {
			$series .= "'$key',";
			$number .= $val['total'].",";
		}

		foreach ($dataIP as $key => $val) {
			$series .= "'$key',";
			$numberIP .= $val['totalIP'].",";
		}

		return array(
					'series'	=>	substr($series, 0, -1),
					'number'	=>	substr($number, 0, -1),
					'numberIP'	=>	substr($numberIP, 0, -1)
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
	function getChargeChartDate($datestart, $dateend, $group_by = ''){
		$min_date = strtotime("+0 day",strtotime($datestart));					

		$time = date('Y-m-d',$min_date);
		$count = sub_date($datestart, $dateend);
		$server_id = $this->input->post("server_id");
			if($server_id && $server_id!=0){
				$this->db->where('server_id =',$server_id);
			}
		if($group_by){

			$dataTable = $this->db->where('created >=',$datestart)
									->order_by('created','ASC')->group_by("{$group_by}")
									->get(PREFIX.'donate')
									->result();		
		}
		else{
			$dataTable = $this->db->where('created >=',$datestart)
									->order_by('created','ASC')
									->get(PREFIX.'donate')
									->result();		
		}
		$server_id = $this->input->post("server_id");
			if($server_id && $server_id!=0){
				$this->db->where('server_id =',$server_id);
			}
		$dataTableIP =  $this->db->where('created >=',$datestart)
									->order_by('created','ASC')->group_by("username")
									->get(PREFIX.'donate')
									->result();	
		//order data
									//pr($dataTable,1);
		$data = array(); $dataIP = array();
		
		for($i = 0; $i <= $count; $i ++){
			$total = 0; $totalIP = 0;
			$interval = mktime(0, 0, 0, date('n', strtotime($datestart)),date('d', strtotime($datestart))  + $i,date('Y', strtotime($datestart)));
			$max_interval = mktime(23, 59, 59, date('n', strtotime($datestart)), date('d', strtotime($datestart)) + $i,date('Y', strtotime($datestart)));
			// pr($interval,1);

			$delimiter = date('j', $interval);
			$text = $delimiter;

			foreach ($dataTable as $key => $value) {
				$compare_time = strtotime($value->created);
				if($compare_time <= $max_interval && $compare_time >= $min_date){
					$total += count($value->username);
					unset($dataTable[$key]);
				}
			}
			$data[$text]['total'] = $total;


			foreach ($dataTableIP as $key => $value) {
				$compare_time = strtotime($value->created);
				if($compare_time < $max_interval && $compare_time >= $min_date){
					$totalIP += count($value->username);
					unset($dataTableIP[$key]);
				}
			}
			$dataIP[$text]['totalIP'] = $totalIP;
		}
		// $data = array_reverse ($data, TRUE);
		//transform data to string, then send to view
		$series = '';
		$number = ''; $numberIP = '';
		foreach ($data as $key => $val) {
			$series .= "'$key',";
			$number .= $val['total'].",";
		}

		foreach ($dataIP as $key => $val) {
			$series .= "'$key',";
			$numberIP .= $val['totalIP'].",";
		}


		return array(
					'series'	=>	substr($series, 0, -1),
					'number'	=>	substr($number, 0, -1),
					'numberIP'	=>	substr($numberIP, 0, -1)
					);
	}
	
	function getChargeAmountChart($id = 0,$month=0,$year=0){
		if(!$month && !$year){
			$min_date = mktime(0,0,0,date('n'),1);
		}
		else{
			$min_date = mktime(0,0,0,$month,1,$year);			
		}

		$time = date('Y-m-d',$min_date);
		$count = date('t', $min_date);
		if($id != 0){
			$dataTable = $this->db->where('created >=', $time)->where('server',$id)
										->order_by('created','ASC')
										->get(PREFIX.'donate')
										->result();					
		}else if($id==0){
			$dataTable = $this->db->where('created >=', $time)
									->order_by('created','ASC')
									->get(PREFIX.'donate')
									->result();			
		}

		if($id!=0){
			$this->db->where('server',$id);
		}
		$countchargeUser = $this->db->where('created >=', $time)
									->order_by('created','ASC')->group_by("username")
									->get(PREFIX.'donate')
									->result();	
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
		$total = 0;
		foreach ($data as $key => $val) {
			$series .= "'$key',";
			$number .= $val['total'].",";
			$total += $val['total'];
		}
		$f_total = $total - $total * 20 / 100;
		// pr($data,1);
		return array(
					'series'	=>	substr($series, 0, -1),
					'number'	=>	substr($number, 0, -1),
					'total'		=>	$f_total,
					'alltotal'  => $total,
					'countchargeUser' => count($countchargeUser)
					);
	
	}

	function getChargeAmountChartDate($datestart, $dateend){
		$min_date = strtotime("+0 day",strtotime($datestart));					

		$time = date('Y-m-d',$min_date);
		$count = sub_date($datestart, $dateend);
		$server_id = $this->input->post("server_id");
			if($server_id && $server_id!=0){
				$this->db->where('server_id =',$server_id);
			}
		$dataTable = $this->db->where('created >=',$datestart)
									->order_by('created','ASC')
									->get(PREFIX.'donate')
									->result();		
				
		if($server_id && $server_id!=0){
			$this->db->where('server_id =',$server_id);
		}
		$countchargeUser = $this->db->where('created >=',$datestart)
									->order_by('created','ASC')->group_by("username")
									->get(PREFIX.'donate')
									->result();		
		//order data
		$data = array();
		for($i = 0; $i <= $count; $i ++){
			$total = 0;
			$interval = mktime(0, 0, 0, date('n', strtotime($datestart)),date('d', strtotime($datestart))  + $i,date('Y', strtotime($datestart)));
			$max_interval = mktime(23, 59, 59, date('n', strtotime($datestart)), date('d', strtotime($datestart)) + $i,date('Y', strtotime($datestart)));
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


		$series = '';
		$number = '';
		$total = 0;
		foreach ($data as $key => $val) {
			$series .= "'$key',";
			$number .= $val['total'].",";
			$total += $val['total'];
		}
		$f_total = $total - $total * 20 / 100;
		// pr($data,1);
		return array(
					'series'	=>	substr($series, 0, -1),
					'number'	=>	substr($number, 0, -1),
					'total'		=>	$f_total,
					'alltotal'  => $total,
					'countchargeUser' => count($countchargeUser)
					);
	
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
	function log_donate($charge_log_id, $rs, $data, $gamecoin_config){
		$pay_method = getSetting('pay_method');
		// $game = $this->get('*', PREFIX . "game", "id = {$game_id}");
		//$pay_method = !empty($game->pay_method) ? $game->pay_method : 'paydirect';
		// $data['pay_method'] 	= $pay_method; 
		$data['gamecoin']       = $gamecoin_config['gamecoin'];
		$data['gamecoin_km']    = $gamecoin_config['gamecoin_km'];
		$data['card_amount']    = $rs['card_amount'];
		$data['message']        = "Gạch thẻ thành công. Đợi kết quả từ service add KNB";
		$data['created']        = date('Y-m-d H:i:s');

		$this->db->where("id", $charge_log_id);
		$this->db->update(PREFIX . $this->table, $data);
	}

	function set_done($charge_id = 0, $msg = '', $gamecoin = 0, $is_success = 0){
		//cập nhật log trên portal---
		$message = $msg;
		if($is_success){
			$data_update = array(
			'message'	=>	$msg,
			'step'		=>	2
			);
		}
		else
		{
			$data_update = array(
			'message'	=>	$msg
			);
		}
		//cập nhật log trên game
		
		return $this->db->where('id', $charge_id)
						->update(PREFIX . $this->table, $data_update);
	}
	function statisByChannel($where = '', $isbank = 0){
		if($where != ''){
			if($isbank=0){
				$spec = htmlentities("^%\$maxp\[\]<>?", ENT_QUOTES, 'UTF-8');
				$sql = "SELECT sum(card_amount) as tong FROM cli_donate WHERE card_pin  != '{$spec}' AND $where ";
			}
			else{
				$sql = "SELECT sum(card_amount) as tong FROM cli_donate WHERE $where ";	
			}
			
			$query = $this->db->query($sql);
			if($query->row()){
				return $query->row();
			}else{
				return 0;
			}
		}
		return 0;
		
	}
	/*--------------------END FRONTEND--------------------*/
}