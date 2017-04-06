<?php
class Banner_model extends MY_Model {
	private $module = 'banner';
	private $table = 'banner';

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
		$query = $this->db->get('cli_banner');

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}

	function saveManagement($fileName){
		if($this->input->post('statusAdmincp')=='on'){
			$status = 1;
		}else{
			$status = 0;
		}
		
		$data = array(
			'description'=> $this->input->post('descriptionAdmincp'),
			'linkimage'=> $this->input->post('linkimageAdmincp'),
			'status'=> $status,
			'created'=> date('Y-m-d H:i:s',time()),
			'start_date' => date('Y-m-d H:i:s',strtotime($this->input->post('start_fromdate'))),
			'end_date' =>  date('Y-m-d H:i:s',strtotime($this->input->post('end_todate')))
		);

		if(!empty($fileName))
			foreach ($fileName as $key => $value) {
				$data[$key]=$value;
			}
		if($this->input->post('hiddenIdAdmincp')==0){
			if($this->db->insert(PREFIX.$this->table,$data)){
				// modules::run('admincp/saveLog',$this->module,$this->db->insert_id(),'Add new','Add new');
				return true;
			}
		}else{
			$result = $this->getDetailManagement($this->input->post('hiddenIdAdmincp'));
			$slug = '';
			unset($data['created']);


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


	/*----------------------FRONTEND----------------------*/

	/*--------------------END FRONTEND--------------------*/
}
