<?php
class Gametool_model extends MY_Model {
	private $module = 'news';
	private $table = 'news';

	function getsearchContent($limit,$page){
		$this->db->select('*');
		$this->db->limit($limit,$page);
		$this->db->order_by($this->input->post('func_order_by'),$this->input->post('order_by'));
		if($this->input->post('content')!='' && $this->input->post('content')!='type here...'){
			$this->db->where('(`title` LIKE "%'.$this->input->post('content').'%" OR `content` LIKE "%'.$this->input->post('content').'%")');
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
			$this->db->where('(`title` LIKE "%'.$this->input->post('content').'%" OR `content` LIKE "%'.$this->input->post('content').'%")');
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
				'description'=> $this->input->post('descAdmincp'),
				'content'=> $this->input->post('contentAdmincp'),
                'order'=> $this->input->post('orderAdmincp'),
				'image'=> $fileName['image'],
				'tab_id'=> $this->input->post('tab_idAdmincp'),
				'status'=> $status,
				'created'=> date('Y-m-d H:i:s'),
			);
			if($this->db->insert(PREFIX.$this->table,$data)){
				modules::run('admincp/saveLog',$this->module,$this->db->insert_id(),'Add new','Add new');
				return true;
			}
		}else{
			$result = $this->getDetailManagement($this->input->post('hiddenIdAdmincp'));

			//Kiểm tra đã tồn tại chưa?
			/* if($result[0]->title!=$this->input->post('titleAdmincp')){
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
			} */
			
			//Xử lý xóa hình khi update thay đổi hình
			$link_img = $result[0]->link_img;
			if($fileName['image']==''){
				$fileName['image'] = $result[0]->image;
				
			}else{
				@unlink(BASEFOLDER.DIR_UPLOAD_NEWS.$result[0]->image);
				if($result[0]->link_img){
					$link_img = 0;
				}
			}
			//End xử lý xóa hình khi update thay đổi hình
			
			$data = array(
				'title'=> $this->input->post('titleAdmincp'),
				'slug'=> $this->input->post('slugAdmincp'),
				'description'=> $this->input->post('descAdmincp'),
                'order'=> $this->input->post('orderAdmincp'),
				'content'=> $this->input->post('contentAdmincp'),
				'image'=> $fileName['image'],
				'tab_id'=> $this->input->post('tab_idAdmincp'),
				'link_img'=>$link_img,
				'status'=> $status
			);
			// $data1 = array_merge($data, $dataAdd);
			// pr($data1,1);
			// exit();
			// pr($data);
			modules::run('admincp/saveLog',$this->module,$this->input->post('hiddenIdAdmincp'),'','Update',$result,$data);
			$this->db->where('id',$this->input->post('hiddenIdAdmincp'));
			if($this->db->update(PREFIX.$this->table,$data)){
				return true;
			}
		}
		return false;
	}
	function saveNews($fileName,$title,$description,$link,$tab_id,$lastpost,$pubdate,$link_img){
		$status = 1;

		if($this->input->post('hiddenIdAdmincp')==0){
			//Kiểm tra đã tồn tại chưa?
			/* $checkData = $this->checkData($this->input->post('titleAdmincp'));
			if($checkData){
				print 'error-title-exists';
				exit;
			}
			
			$checkSlug = $this->checkSlug($this->input->post('slugAdmincp'));
			if($checkSlug){
				print 'error-slug-exists';
				exit;
			} */
			
			$data = array(
				'title'=> htmlspecialchars($title),
				'tab_id'=> $tab_id,
				'description'=> htmlspecialchars($description),
				'slug' => htmlspecialchars($link),
				'image'=> htmlspecialchars($fileName),
				'link_img'=> $link_img,
				'status'=> $status,
				'lastpost' => htmlspecialchars($lastpost),
				'pubdate' => htmlspecialchars($pubdate),
				'created'=> date('Y-m-d H:i:s',time()),
			);
			//pr($data,1);
			if($this->db->insert(PREFIX.$this->table,$data)){
				//modules::run('admincp/saveLog',$this->module,$this->db->insert_id(),'Add new','Add new');
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
	
	function checkPubdate($pubdate){
		$this->db->select('*');
		$this->db->where('pubdate',$pubdate);
		$this->db->limit(1);
		$query = $this->db->get(PREFIX.$this->table);
		// pr($query->result(),1);exit();
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
	function getNews($type){
		$this->db->select('*');
		$this->db->where('type',$type);
		$this->db->where('status',1);
		$this->db->order_by('created','DESC');
		$query = $this->db->get(PREFIX.$this->table);

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function getNewsDetail($slug_detail){
		$this->db->select('id,content');
		$this->db->where('slug',$slug_detail);
		$this->db->where('status',1);
		$this->db->limit(1);
		$query = $this->db->get(PREFIX.$this->table);

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}

    function getNewItems($id, $tabid, $limit = NULL, $start = NULL) {
        $this->db->select('id, title, image, title, slug, created');
        //$this->db->where('id <', $id);
        $this->db->where('tab_id', $tabid);
        $this->db->order_by('created', 'DESC');
        if (!is_null($limit)) {
            $this->db->limit($limit, $start);
        }
        $query = $this->db->get(PREFIX.$this->table);
        return $query->result();
    }

    function cron_thongkelevel($server){
    	if($server){
    		$params = array(
            'serviceUser'=> SERVICE_USER_NAP_TIEN,
            'servicePass'=> SERVICE_PASS_NAP_TIEN
            );
    		$url = getServiceURL($server, "GetLevelSummary");
    		$response = strip_tags(post($url, $params));
    		$result = json_decode($response);
    		if(json_last_error() == JSON_ERROR_NONE){
    			$check = $this->get('*', "gm_thongkelevel", "`server` = {$server->id} AND created = '".date('Y-m-d')."'");
    			$dataIns = array(
					'levelsummary'	=> $response,
					'server'		=>	$server->id,
					'server_name'	=>	$server->name,
					'created'		=>	date('Y-m-d')
				);
    			if(!$check){
					$this->db->insert("gm_thongkelevel", $dataIns);
    			}
    			else{
    				$this->update("gm_thongkelevel", $dataIns, "`id` = {$check->id}");
    			}
    		}
    	}
    }
    function getTotalDonate(){
/*        if($this->session->userdata('username'))
        {
            $this->db->where('username !=', $this->session->userdata('username'));
        }
        $server_id = $_POST['server'];
        $name = $_POST['name'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
*/
        if(isset($_POST['name']))
        {
            $this->db->where('username =', $_POST['name']);
        }
        if(isset($_POST['server']))
        {
            $this->db->where('server_id =', intval($_POST['server']) );
        }
        if(isset($_POST['startDate']))
        {
            $this->db->where('created >=', date("Y-m-d 00:00:00",strtotime($_POST['startDate']) ));
        }
        if(isset($_POST['endDate']))
        {
            $this->db->where('created <=', date("Y-m-d 00:00:00",strtotime($_POST['endDate']) ));
        }


        return $this->db->get(PREFIX."donate_ucenter")->num_rows();
    }
    function paginDonate($record,$start){
        $this->db->select('*');
        $this->db->limit($record,$start);
        /*if($this->session->userdata('username'))
        {
            $this->db->where('username !=', $this->session->userdata('username'));
        }*/

        if(isset($_POST['name']))
        {
            $this->db->where('username =', $_POST['name']);
        }
        if(isset($_POST['server']))
        {
            $this->db->where('server_id =', intval($_POST['server']) );
        }
        if(isset($_POST['startDate']))
        {
            $this->db->where('created >=', date("Y-m-d 00:00:00",strtotime($_POST['startDate']) ));
        }
        if(isset($_POST['endDate']))
        {
            $this->db->where('created <=', date("Y-m-d 00:00:00",strtotime($_POST['endDate']) ));
        }
        $this->db->order_by('created','DESC');
        $query = $this->db->get(PREFIX."donate_ucenter");
        if($query->result()){
            return $query->result();
        }else{
            return 0;
        }
    }

    function getlast_useronline(){
    	$this->db->order_by("created", "DESC");
    	$this->db->group_by("created");
    	$this->db->limit(144);
        $query = $this->db->get('cli_log_useronlinejob');
        if($query->result()){
            return $query->result();
        }else{
            return 0;
        }
    }

    function list_useronline($record,$start=0){
        if($this->input->post("server")!=0){
    		$this->db->where('sid',$this->input->post("server") );	
    	}
    	if($this->input->post("caledar_from")!=0){
    		$start = date("Y-m-d 00:00:00", strtotime($this->input->post("caledar_from")));

    		$this->db->where('created >=', "{$start}");	
    	}
    	if($this->input->post("caledar_to")!=0){
    		$to = date("Y-m-d 23:59:59", strtotime($this->input->post("caledar_to")));
    		$this->db->where('created <=',"{$to}");	
    	}
    	//pr(last_query(),1);
    	$this->db->order_by("created", "DESC"); 
        
        $query = $this->db->get("cli_log_useronlinejob");
        if($query->result()){
            return $query->result();
        }else{
            return 0;
        }
    }

    function getTotal_useronline(){
    	if($this->input->post("server")!=0){
    		$this->db->where('sid',$this->input->post("server") );	
    	}
    	if($this->input->post("caledar_from")!=0){
    		$start = date("Y-m-d 00:00:00", strtotime($this->input->post("caledar_from")));

    		$this->db->where('created >=', "{$start}");	
    	}
    	if($this->input->post("caledar_to")!=0){
    		$to = date("Y-m-d 23:59:59", strtotime($this->input->post("caledar_to")));
    		$this->db->where('created <=',"{$to}");	
    	}
    
    	$this->db->group_by("created");
    	$this->db->order_by("created", "DESC");
        return $this->db->get("cli_log_useronlinejob")->num_rows();
    }

    function getGroupBy_useronline($record,$start=0){
    	if($this->input->post("server")!=0){
    		$this->db->where('sid',$this->input->post("server") );	
    	}
    	if($this->input->post("caledar_from")!=0){
    		$start = date("Y-m-d 00:00:00", strtotime($this->input->post("caledar_from")));

    		$this->db->where('created >=', "{$start}");	
    	}
    	if($this->input->post("caledar_to")!=0){
    		$to = date("Y-m-d 23:59:59", strtotime($this->input->post("caledar_to")));
    		$this->db->where('created <=',"{$to}");	
    	}
        

    	$this->db->order_by("created", "DESC");
    	$this->db->group_by("created");
    	$this->db->limit($record,$start);
    	$query = $this->db->get("cli_log_useronlinejob");
        if($query->result()){
            return $query->result();
        }else{
            return 0;
        }
    }

     function list_naptien($record,$start=0){
    	if($this->input->post("caledar_from")){
    		$start = date("Y-m-d 00:00:00", strtotime($this->input->post("caledar_from")));

    		$this->db->where('created >=', "{$start}");	
    	}
    	if($this->input->post("caledar_to")){
    		$to = date("Y-m-d 23:59:59", strtotime($this->input->post("caledar_to")));
    		$this->db->where('created <=',"{$to}");	
    	}
    	//pr(last_query(),1);
   		$this->db->order_by('id','DESC');
        $this->db->limit($record,$start);
        $query = $this->db->get("cli_log_gmt_money");
        if($query->result()){
            return $query->result();
        }else{
            return 0;
        }
    }
    
    
	function list_Data($table="",$record,$start=0){
    	if($this->input->post("caledar_from")){
    		$start = date("Y-m-d 00:00:00", strtotime($this->input->post("caledar_from")));

    		$this->db->where('created >=', "{$start}");	
    	}
    	if($this->input->post("caledar_to")){
    		$to = date("Y-m-d 23:59:59", strtotime($this->input->post("caledar_to")));
    		$this->db->where('created <=',"{$to}");	
    	}
    	//pr(last_query(),1);
   		 $this->db->order_by('id','DESC');
        $this->db->limit($record,$start);
        $query = $this->db->get($table);
        if($query->result()){
            return $query->result();
        }else{
            return 0;
        }
    }
    
    
	
    
	function getTotal_Table($table=""){
    	
        return $this->db->get($table)->num_rows();
    }
    
    function getTotal_naptien(){
    	if($this->input->post("caledar_from")!=0){
    		$start = date("Y-m-d 00:00:00", strtotime($this->input->post("caledar_from")));
    		$this->db->where('created >=', "{$start}");	
    	}
    	if($this->input->post("caledar_to")!=0){
    		$to = date("Y-m-d 23:59:59", strtotime($this->input->post("caledar_to")));
    		$this->db->where('created <=',"{$to}");	
    	}
        return $this->db->get("cli_log_gmt_money")->num_rows();
    }
     function list_items($record,$start=0){
    	if($this->input->post("caledar_from")){
    		$start = date("Y-m-d 00:00:00", strtotime($this->input->post("caledar_from")));

    		$this->db->where('created >=', "{$start}");	
    	}
    	if($this->input->post("caledar_to")){
    		$to = date("Y-m-d 23:59:59", strtotime($this->input->post("caledar_to")));
    		$this->db->where('created <=',"{$to}");	
    	}
    	//pr(last_query(),1);
   
        $this->db->limit($record,$start);
        $query = $this->db->get("cli_log_gmt_money");
        if($query->result()){
            return $query->result();
        }else{
            return 0;
        }
    }

    function getTotal_items(){
    	if($this->input->post("caledar_from")!=0){
    		$start = date("Y-m-d 00:00:00", strtotime($this->input->post("caledar_from")));
    		$this->db->where('created >=', "{$start}");	
    	}
    	if($this->input->post("caledar_to")!=0){
    		$to = date("Y-m-d 23:59:59", strtotime($this->input->post("caledar_to")));
    		$this->db->where('created <=',"{$to}");	
    	}
        return $this->db->get("cli_log_gmt_money")->num_rows();
    }
    /*--------------------END FRONTEND--------------------*/
}