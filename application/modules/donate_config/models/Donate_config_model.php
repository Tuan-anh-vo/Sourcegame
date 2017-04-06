<?php
class Donate_config_model extends MY_Model {
	private $module = 'donate_config';
	private $table = 'donate_config';

	function __construct(){
		$file_config = APPPATH . "config/donate_config_setting.php";
		if(!check_exists_file($file_config)){
			$put = "\r\n";
			$put .= "\$config['rate'] = 0;\r\n";
			$put .= "\$config['time_begin'] = '';\r\n";
			$put .= "\$config['time_end'] = '';\r\n";
			$put .= "\$config['server'] = '';\r\n";
			$path = APPPATH."config/donate_config_setting.php";
	        $file=fopen($file_config, "w");
	        $write=fwrite($file,'<?php'.$put.' ?>');
	        fclose($file);
		}
		$this->config->load('donate_config_setting', TRUE);
	}
	function getsearchContent($limit,$page){
		$this->db->select('*');
		// $this->db->limit($limit,$page);
		
		if($this->input->post('content')!= 0){
			$this->db->where('`server` = '.$this->input->post('content'));
		}
		$query = $this->db->get(PREFIX.$this->table);
		$data  = $query->result();	
		if($data){
			if($this->input->post('time_bg') != "" && $this->input->post('time_en') != ""){
				if(time($this->input->post('time_bg')) >= $time_begin && time($this->input->post('time_en')) >= $time_end){
					$server_km = explode('|', $server);
					foreach ($data as $key => $value){	
						foreach ($server_km as $k => $vl) {
							if($value->id == $vl){
								$data[$key]->rate_mk = $rate;
							}
							else{
								$data[$key]->rate_mk = 0;
							}
						}
					}
				}
			}
			else{
				foreach ($data as $key => $value){
					$data[$key]->rate_mk = 0;
				}
			}
			return $data;

		}else{
			return false;
		}
	}

	function getTotalsearchContent(){
		$this->db->select('*');
		if($this->input->post('content')!= 0){
			$this->db->where('`server` = '.$this->input->post('content'));
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

	function saveManagement($servers=''){
		if($this->input->post('statusAdmincp')=='on'){
			$status = 1;
		}else{
			$status = 0;
		}

		if($this->input->post('hiddenIdAdmincp')==0){
			//Kiểm tra đã tồn tại chưa?
			$checkData = $this->checkData($this->input->post('card_amount'));
			if($checkData){
				print 'exists';
				exit;
			}

			$data = array(
				'card_amount'  => $this->input->post('card_amount'),
				'gamecoin' => $this->input->post('gamecoin'),
				'created'  => date('Y-m-d H:i:s',time())
			);
			$this->db->insert(PREFIX . $this->table, $data);
			return true;
		}
		return false;
	}

	function checkData($title, $id = ''){
		$this->db->select('id');
		if($id != '')
			$this->db->where('id !=',$id);
		$this->db->where('card_amount',$title);
		$this->db->limit(1);
		$query = $this->db->get(PREFIX.$this->table);

		if($query->result()){
			return true;
		}else{
			return false;
		}
	}
	function gamecoin_config($mgthe = 0, $server_id=""){
		$this->db->where('card_amount', $mgthe);
		$query      = $this->db->get(PREFIX.$this->table)->row();
		$now        = time();
		$time_begin = strtotime($this->get_config('time_begin'));
		$time_end   = strtotime($this->get_config('time_end'));
		$data       = array(
			'gamecoin'    => 0,
			'gamecoin_km' => 0
			);
		if($query){
			$data['gamecoin'] = $query->gamecoin;
			//xet khuyen mai
			if($now > $time_begin && $now < $time_end){
				$servers = explode('|', $this->get_config('server'));
				//pr($this->get_config('rate') ,1);
				if(in_array($server_id, $servers)){
					$data['gamecoin_km'] = floor($query->gamecoin * $this->get_config('rate') / 100);
				}
			}
		}
		return $data;
	}

	function get_config($name = ''){
		if($name)
			return $this->config->item($name, 'donate_config_setting');
		else
			return FALSE;
	}

}