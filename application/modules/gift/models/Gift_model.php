<?php
class Gift_model extends MY_Model {
	function __construct(){
		parent::__construct();
	}
	private $module = 'gift';
	private $table = 'gift_code';
	function getsearchContent($limit,$page){
		$this->db->select('g.*');
		$this->db->from(PREFIX.$this->table.' g');
		$this->db->limit($limit,$page);
		$this->db->order_by($this->input->post('func_order_by'),$this->input->post('order_by'));
		if($this->input->post('content')!='' && $this->input->post('content')!='type here...'){
			$this->db->where('(`title` LIKE "%'.$this->input->post('content').'%" OR `type` LIKE "%'.$this->input->post('content').'%")');
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
		$query = $this->db->get();
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}

	function getTotalsearchContent(){
		$this->db->select('*');
		if($this->input->post('content')!='' && $this->input->post('content')!='type here...'){
			$this->db->where('(`title` LIKE "%'.$this->input->post('content').'%" OR `type` LIKE "%'.$this->input->post('content').'%")');
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
	//MANY = 1 LA NHẬN NHÌU LẦN.
	function saveManagement($fileName = ''){
		$status = 0; $many = 0; $servers = 0;
		if($this->input->post('statusAdmincp')=='on'){
			$status = 1;
		}
		if($this->input->post('many-set')=='on'){
			$many = 1;
		}
		$arrI = $this->input->post('itemId');
		$arrQ = $this->input->post('itemQuantity');
		if(($arrI[0]) || ($arrQ[0])){
			if(in_array("", $arrI) || in_array("", $arrQ)){
				echo "error-item";
				exit();
			}
		}
		$list_item = json_encode(array('id'=>$arrI,'quantity'=>$arrQ));
		$expiredDate = $this->input->post('expired_dateAdmincp')." ".date("H:i:s");
		$vali_expired = strtotime($expiredDate);
		if($vali_expired <= strtotime("+1 day")){
			print 'error-invalid-date';
			exit;
		}
		if($this->input->post('many-server')){
			if($this->input->post('adminserver'))
				$servers = implode('|',$this->input->post('adminserver'));
		}
		else{
			$servers = $this->input->post('multiple-server');
		}
		if(!$servers){
			print 'error-server';
			exit;
		}
		$method = $this->input->post('methodAdmincp');
		if($method == 2 && !$this->input->post('quality')){
			print "error_quality";
			exit();
		}
		if($this->input->post('hiddenIdAdmincp')==0){
			$checkData = $this->checkData($this->input->post('titleAdmincp'));
			if($checkData){
				print 'error-title-exists';
				exit;
			}
			$checkPrefix = $this->checkPrefix($this->input->post('prefixAdmincp'));
			if($checkPrefix){
				print 'error-prefix-exists';
				exit;
			}
			$data = array(
				'title'        => $this->input->post('titleAdmincp'),
				'status'       => $status,
				'type'         => $this->input->post('typeAdmincp'),
				'prefix'       => strtoupper($this->input->post('prefixAdmincp')),
				'created'      => date('Y-m-d H:i:s',time()),
				'list_item'    => $list_item,
				'many'         => $many,
				'expired_date' => $vali_expired,
				'servers'      => $servers
			);
			if($this->db->insert(PREFIX."gift_code",$data)){
				$new_id = $this->db->insert_id();
				if($method == 2){
					for($i = 0; $i < $this->input->post('quality'); $i++){
						$code = $this->input->post('prefixAdmincp').strtoupper(substr(sha1(random_string(9)), -6));
						$data = array(
							'code'   => $code,
							'type'   => $new_id,
							'status' => 1
						);
						$this->db->insert('cli_giftcode_media', $data);
					}
				}
				modules::run('admincp/saveLog',$this->module, $new_id,'Add new','Add new');
				return true;
			}
		}
		else{
			$data = array(
				'status'       => $status,
				'title'        => $this->input->post('titleAdmincp'),
				'list_item'    => $list_item,
				'expired_date' => $vali_expired,
				'servers'      => $servers,
				'many'         => $many
			);
			if($many == 1){
				$this->db->where('type', $this->input->post('hiddenIdAdmincp'));
				$this->db->set('status', 1);
				$this->db->update(PREFIX.'giftcode_user');
			}
			if($this->update(PREFIX.$this->table,$data, '`id` = '.$this->input->post('hiddenIdAdmincp'))){
				$new_id = $this->input->post('hiddenIdAdmincp');
				modules::run('admincp/saveLog',$this->module, $new_id, 'Update','Update');
				return true;
			}
			return true;
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
				$this->db->where('gift_details_id', $id);
				if($this->db->delete(PREFIX.'gift_code'))
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
	function get_server(){
		$this->db->select('id,name');
		$this->db->order_by('playtime DESC');
		if(!is_local()) $this->db->where('status >', 0);
		return $this->db->get('cli_servers')->result();
	}
	function checkPrefix($prefix){
		$this->db->select('id');
		$this->db->where('prefix',$prefix);
		$this->db->limit(1);
		$query = $this->db->get(PREFIX.$this->table);
		if($query->result()){
			return true;
		}else{
			return false;
		}
	}

	/*----------------------FRONTEND----------------------*/
	function index($uid, $server){
		$sql = "SELECT us.`code`, us.`type`, us.`servers`, gc.`title` FROM `cli_gift_code` gc, `cli_giftcode_user` us WHERE gc.`id`= us.`type` AND `uid` = {$uid}";
		$gc_user = $this->db->query($sql)->result();
		if($gc_user){
			foreach ($server as $key => $value) {
				$serverkey[$value->id]=$value;
			}
			foreach ($gc_user as $key => $value) {
				$value->type = $this->model->get("servers", "cli_gift_code", "id = {$value->type}");
				$gc_user[$key]->type_arr=explode("|",$value->type->servers);
				foreach (explode("|",$value->servers) as $val) {
					if(isset($serverkey[$val]->name))
					$value->nhanroi[$val]=$serverkey[$val]->name;
				}
				$gc_user[$key]->server_arr=explode("|",$value->servers);
				foreach ($value->type_arr as $k=> $sr) {
					if(in_array($sr,$value->server_arr)){
						unset($value->type_arr[$k]);
					}else{
						if(isset($serverkey[$sr]->name))
								$value->chuanhan[$sr]=$serverkey[$sr]->name;
					}
				}
				unset($gc_user[$key]->servers);
				unset($gc_user[$key]->type);
				unset($gc_user[$key]->type_arr);
				unset($gc_user[$key]->server_arr);
			}
			return $gc_user;

		}else{
			return 0;
		}

	}

	function gift_code_user($username, $uid, $type){
		if(!$type){
			return "Không tồn tại code này";
			exit();
		}
		$giftcode = $this->model->get("prefix, expired_date, status, many, servers", "cli_gift_code", "id = {$type}");
		if(!$giftcode){
			return "Không tồn tại giftcode này";
			exit();
		}
		$gc_user = $this->model->get("*", "cli_giftcode_user", "uid = {$uid} AND type = {$type}");
		if($gc_user){
			return $gc_user->code;
		}else{
			if($giftcode->expired_date < time() || $giftcode->status == 0){
				return "Thời gian sử dụng code này đã hết hoặc code đã bị khóa";
				exit();
			}
			$code = $giftcode->prefix.strtoupper(substr(sha1(time().$username), -6));
			$data = array(
				'status'   => 1,
				'username' => $username,
				'uid'      => $uid,
				'type'     => $type,
				'code'     => $code,
				'created'  => date('Y-m-d H:i:s',time())
			);
			if($this->db->insert('cli_giftcode_user', $data)){
				return $code;
			}
		}
	}
	// Status=1 la chua nhan.
	function change_giftcode($username, $uid, $server, $code){
		$data_log = array(
			'username' => $username,
			'code'=> addslashes( $code ),
			'server_receiver' => $server,
			'created' => date('Y-m-d H:i:s',time())
		);
		$gc_user = $this->model->get("*", "cli_giftcode_user","code = '{$code}' AND uid = {$uid}");
		if($gc_user){
			if(!$gc_user->status){
				$st = "Code của bạn đã được sử dụng";
				$data_log['status'] = $st;
				$this->db->insert('cli_log_giftcode', $data_log);
				return array('stt' => 0,'st' => $st);
				exit();
			}
			$sv_user = explode("|", $gc_user->servers);
			if($sv_user[0]){
				// pr($sv_user,1);
				if(in_array($server, $sv_user)){
					$st = "Code của bạn đã được sử dụng ở server này";
					$data_log['status'] = $st;
					$this->db->insert('cli_log_giftcode', $data_log);
					return array('stt' => 0,'st' => $st);
					exit();
				}
			}
			$giftcode = $this->model->get("prefix, expired_date, status, many, servers", "cli_gift_code", "id = {$gc_user->type}");
			if(!$giftcode){
				$st = "Vui lòng liên hệ admin để được trợ giúp";
				$data_log['status'] = "Không tìm thấy giftcode trong bảng cli_gift_code";
				$this->db->insert('cli_log_giftcode', $data_log);
				return array('stt' => 0,'st' => $st);
				exit();
			}
			if($giftcode->status == 0 || $giftcode->expired_date < time()){
				$st = "Code của bạn đã hết hạn sử dụng hoặc đã khóa";
				$data_log['status'] = $st;
				$this->db->insert('cli_log_giftcode', $data_log);
				return $st;
				exit();
			}
			$sv_receiver = explode("|", $giftcode->servers);
			if(!in_array($server, $sv_receiver)){
				$st = "Code của bạn không sử dụng được ở server này";
				$data_log['status'] = $st;
				$this->db->insert('cli_log_giftcode', $data_log);
				return array('stt' => 0,'st' => $st);
				exit();
			}
			$change = $this->mailItem($gc_user->type, $username, $server); //FUNCTION CHUYỂN VÀO GAME.
			$data_log['itemid'] = $change['log'];
			if($change['flag'] == 0){
				$st = "Kiểm tra bạn tạo nhân vật chưa? Vui lòng thử lại sau!";
				$data_log['status'] = "Không thể chuyển vào game";
				$this->db->insert('cli_log_giftcode', $data_log);
				return array('stt' => 0,'st' => $st);
				exit();
			}
			if(!$giftcode->many){
				$data['status'] = 0;
			}
			if(!$sv_user[0]) {$data['servers'] = $server;}
			else{
				array_push($sv_user, $server);
				$data['servers'] = implode("|", $sv_user);
			}
			$this->db->where('uid', $uid)->where('type', $gc_user->type);
			if($this->db->update('cli_giftcode_user', $data)){
				$st = "Đổi giftcode thành công, vui lòng đợi vài phút hệ thống sẽ cập nhật thư cho bạn";
				$data_log['status'] = "Thành công";
				$this->db->insert('cli_log_giftcode', $data_log);
				return array('stt'=> 1,'st' => $st, 'url_service' => $change['html_url']);
			}
		}else{
			$check_code = $this->model->get("*", "cli_giftcode_media","code = '{$code}' AND status = 1");
			if(!$check_code){
				$st = "Code của bạn không hợp lệ";
				$data_log['status'] = $st;
				$this->db->insert('cli_log_giftcode', $data_log);
				return array('stt' => 0,'st' => $st);
				exit();
			}
			$check_user = $this->model->get("id", "cli_giftcode_user","type = '{$check_code->type}' AND uid = {$uid}");
			if($check_user){
				$st = "Bạn đã sử dụng loại code này rồi";
				$data_log['status'] = $st;
				$this->db->insert('cli_log_giftcode', $data_log);
				return array('stt' => 0,'st' => $st);
				exit();
			}
			$giftcode = $this->model->get("prefix, expired_date, status, many, servers", "cli_gift_code", "id = {$check_code->type}");
			$sv_giftcode = explode("|", $giftcode->servers);
			if(!in_array($server, $sv_giftcode)){
				$st = "Code của bạn không thể nhận ở server này";
				$data_log['status'] = $st;
				$this->db->insert('cli_log_giftcode', $data_log);
				return array('stt' => 0,'st' => $st);
				exit();
			}
			if($giftcode->status == 0 || $giftcode->expired_date < time()){
				$st = "Code của bạn đã hết thời hạn sử dụng hoặc đã bị khóa";
				$data_log['status'] = $st;
				$this->db->insert('cli_log_giftcode', $data_log);
				return array('st' => $st);
				exit();
			}
			$change = $this->mailItem($check_code->type, $username, $server); //FUNCTION CHUYỂN VÀO GAME.
			$data_log['itemid'] = $change['log'];
			if($change['flag'] == 0){
				$st = "Vui lòng đợi trong giây lác hoặc liên hệ admin";
				$data_log['status'] = "Không thể chuyển vào game";
				$this->db->insert('cli_log_giftcode', $data_log);
				return array('stt' => 0,'st' => $st);
				exit();
			}
			$data = array(
				'username' => $username,
				'uid' => $uid,
				'code' => $code,
				'type' => $check_code->type,
				'servers' => $server,
				'created' => date('Y-m-d H:s:i', time())
			);
			$data['status'] = 0;
			if($giftcode->many){
				$data['status'] = 1;
			}
			if($this->db->insert('cli_giftcode_user', $data)){
				$arr_check = array(34,35,36,37);
				if(!in_array($check_code->type,$arr_check) ) {
					$this->db->set('status',0)->where('code', $code)->update('cli_giftcode_media');
				}
				$data_log['status'] = "Thành công";

				$this->db->insert('cli_log_giftcode', $data_log);
				// pr($change['html_url'],1);
				$st = "Đổi giftcode thành công, vui lòng đợi vài phút hệ thống sẽ cập nhật thư cho bạn";
				return array('stt'=> 1,'st' => $st, 'url_service' => $change['html_url']);
			}
		}
	}
	
	function mailItem($id = '', $username, $server_id){
		if($id){
			$bool = ""; $flag = 0;
			$server = $this->model->get('*', PREFIX.'servers', "id = $server_id");
			$res = $this->model->get('list_item','cli_gift_code', "id ={$id}");
			$item = json_decode($res->list_item);
			$item_count = count($item->id);

			$this->load->model('servers/servers_model');
			$html_url = '';
			for($i = 0; $i < $item_count; $i++){
				$idItem = $item->id[$i];
				$num = $item->quantity[$i];

				if($idItem && $idItem != 0){
					$result = $this->servers_model->gm_insert_item($username, $server_id, $idItem, $num);
					$url_service = $result['url_service'];

					$log[] = array('item', $idItem, 'status', 'ok');$flag = 1;
					$html_url .= "<div style='display:none'><iframe src='". $url_service ."' ></iframe></div>";

					/* tam thoi tat cho qua ngay 24/02 se mo len
					if($result === false){
						$log[] = array('item', $idItem, 'status', 'no'); 
					}else{
						$log[] = array('item', $idItem, 'status', 'ok');$flag = 1;
					}
					*/

				}

			}
			// pr($html_url,1);

			$data['flag'] = $flag;
			$data['log'] = json_encode( $log );
			$data['html_url'] = $html_url;
			return $data;
		}
	}

	function giftCodeEmail($data, $type){
		$this->db->where($data)->limit(1);
		$result = $this->db->get('cli_giftcode_email');	
		if($result->num_rows() < 1){
			return 0; exit();
		}
		$result = $result->row();
		if($result->status == 0){
			return 0; exit();
		}
		$id = $data['id']; $username = $result->username;
		$this->db->set('status', 0)->where('id', $id)->update('cli_giftcode_email');
		$result = $this->gift_code_user($username, $data['uid'], $type);
		return $result;
	}
	/*--------------------END FRONTEND--------------------*/
}