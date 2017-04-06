<?php
class Tichluy_model extends MY_Model {
	private $module = 'tichluy';
	private $table = 'tichluy_config';

	function getsearchContent($limit,$page){
		$this->db->select('*');
		$this->db->limit($limit,$page);
		$this->db->order_by($this->input->post('func_order_by'),$this->input->post('order_by'));
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
		if($this->input->post('statusAdmincp')=='on'){
			$status = 1;
		}else{
			$status = 0;
		}
		if($this->input->post('adminserver')){
			$servers = '_'.implode('_',$this->input->post('adminserver')).'_';
		}else{
			$servers = '';
		}
		//Begin of save config
		$item=array();
        $i=1;
        foreach ($_POST['id_item'] as $key => $value) {
            $item[$i]=array('level'=>$_POST['level'][$key],'name_item'=>$_POST['name_item'][$key],'id_item'=>$value,'number_item'=>$_POST['number_item'][$key]);
            $i++;
        }
        foreach ($item as $k => $vl) {
        	$arr1 = explode('_',$vl['name_item']);
            $arr2 = explode('_',$vl['id_item']);
            $arr3 = explode('_',$vl['number_item']);
            if(count($arr1) != count($arr2) || count($arr2) != count($arr3)){
            	print 'Các vật phẩm và số lượng không khớp nhau ở mốc '.$k.' !';
                die;
            }
        }
		//End of save config

		$data = array(
			'name' => $this->input->post('NameAdmincp'),
			'config' => serialize($item),//config sau khi unserialize
			'startdate' => $this->input->post('StartAdmincp'),
			'enddate' => $this->input->post('EndAdmincp'),
			'status' => $status,
			'servers' => $servers,
			'type' => $this->input->post('TypeAdmincp'),
			'created' => date('Y-m-d H:i:s',time())
		);
		if($this->input->post('hiddenIdAdmincp')==0){
			//Kiểm tra đã tồn tại chưa?
			$checkData = $this->checkData($this->input->post('NameAdmincp'));
			if($checkData){
				print 'error-name-exists';
				exit;
			}
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
	function checkData($name){
		$this->db->select('id');
		$this->db->where('name',$name);
		$this->db->limit(1);
		$query = $this->db->get(PREFIX.$this->table);
		if($query->result()){
			return true;
		}else{
			return false;
		}
	}

 /*---------------- End Admin Control Panel (^-^) Begin Frontend ----------------------*/
 	function scan_event($server_id = 0){
 		//Scan xem co nhung loai tich luy nao dang chay
 		$this->db->select('*');
 		if($server_id != 0){
 			$this->db->where("servers LIKE '%_".$server_id."_%'");
 		}
 		$this->db->where('status = 1');
 		$this->db->where('enddate >= "'.date('Y-m-d H:i:s',time()).'"');
 		$this->db->where('startdate <= "'.date('Y-m-d H:i:s',time()).'"');
 		$query = $this->db->get(PREFIX.$this->table);

 		if($query->result()){
 			// pr($query->result());
			return $query->result();
		}else{
			return false;
		}
    }
    function count_money($dk = 0, $date, $server_id){
    	//du lieu date dua vao can dung dinh dang array('begin'=>...,'end'=>...);
    	$username = $this->session->userdata('username');
		//tich luy reset theo ngay
		$today = date('Y-m-d',time());
		$where[1] = "AND date(`created`) = '{$today}'";
		//tich luy reset theo tuan
		$begin = $date['begin'];
    	$end = $date['end'];
    	$where[2] = "AND created >= '{$begin}' AND created <= '{$end}'";
		//tich luy reset theo thang
    	$where[3] = "AND created >= '{$begin}' AND created <= '{$end}'";
    	//tich luy khong reset
    	$where[4] = "AND created >= '{$begin}' AND created <= '{$end}'";
		
    	$sql = "SELECT `username`,sum(`money`)  as `total` FROM `cli_tichluy` WHERE `username` LIKE '{$username}' AND `server_id` = {$server_id} ".$where[$dk]." GROUP BY `username` LIMIT 0,1"; //AND date(`created`) = '{$today}'

    	$query = $this->db->query($sql);
    	if($query->num_rows() > 0){
            $total = $query->row();
            return $total->total;
        }else{
        	return 0;
        }

    }
    function checkAward($dk = 0, $date, $level_award, $id_event, $server_id){
    	//kiem tra xem user no da nhan moc nap tien do chua dua vao id event, server id, dua vao moc nap tien
    	//can co ngay thang vi no co the reset theo ngay reset theo tuan, hoac reset theo thang, hoac ko reset
    	$username = $this->session->userdata('username');
    	//tich luy reset theo ngay
    	$today = date('Y-m-d',time());
		$where[1] = "AND date(`created`) = '{$today}'";
    	//tich luy reset theo tuan
    	$begin = $date['begin'];
    	$end = $date['end'];
    	$where[2] = "AND created >= '{$begin}' AND created <= '{$end}'";
    	//tich luy reset theo thang
    	$where[3] = "AND created >= '{$begin}' AND created <= '{$end}'";
    	//tich luy khong reset
    	$where[4] = "AND created >= '{$begin}' AND created <= '{$end}'";

    	$sql = "SELECT `id` FROM `cli_tichluy_log` WHERE `username` LIKE '{$username}' AND `level_award` = {$level_award} AND `id_event` = {$id_event} AND `server_id` = {$server_id} ".$where[$dk];
    	$query = $this->db->query($sql);
    	if($query->num_rows() > 0){
    		return true;
    	}else{
    		return false;
    	}
    }
    function list_recieve($dk = 0, $id_event = 0, $date, $server_id){
    	//chuc nang lay ra nhung moc level ma user da nhan qua tich luy
    	//no chi can dua vao cai id_event de lay.
    	$username = $this->session->userdata('username');
    	//tich luy reset theo ngay
    	$today = date('Y-m-d',time());
		$where[1] = "AND date(`created`) = '{$today}'";
    	//tich luy reset theo tuan
    	$begin = $date['begin'];
    	$end = $date['end'];
    	$where[2] = "AND created >= '{$begin}' AND created <= '{$end}'";
    	//tich luy reset theo thang
    	$where[3] = "AND created >= '{$begin}' AND created <= '{$end}'";
    	//tich luy khong reset
    	$where[4] = "AND created >= '{$begin}' AND created <= '{$end}'";

    	$sql = "SELECT `id`,`id_event`,`username`,`level_award` FROM `cli_tichluy_log` WHERE `username` LIKE '{$username}' AND `id_event` = {$id_event} AND `server_id` = {$server_id} ".$where[$dk];
    	$query = $this->db->query($sql);
    	if($query->num_rows() > 0){
    		return $query->result();
    	}else{
    		return false;
    	}
    }
    function getEvent($id, $level_award = 0){
    	//lay ra duoc event ma user muon nhan qua tich luy
    	//hon the nua lay ra duoc moc tich luy ma user muon nhan
    	$this->db->select('*');
    	$this->db->where('id',$id);
    	$query = $this->db->get(PREFIX.'tichluy_config');
    	if($query->num_rows() > 0){
    		$result = $query->row();
    		foreach (unserialize($result->config) as $key => $value) {
    			if($value['level'] == $level_award){
    				return (object) $value; break;
    			}
    		}
    		return false;
    	}else{
    		return false;
    	}
    }
    function list_server_user($username){
    	//chuc nang lay ra 1 list server id ma user da nap tien vao
    	$this->db->select('server_id');
    	$this->db->where("username LIKE '{$username}'");
    	$this->db->group_by('server_id');
    	$query = $this->db->get(PREFIX.'tichluy');
    	if($query->num_rows() > 0){
    		$array = array();
    		foreach ($query->result() as $key => $value) {
    			$array[] = $value->server_id;
    		}
    		return $array;
    	}else{
    		return false;
    	}
    }

}