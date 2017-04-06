<?php
class Content_model extends MY_Model {
	private $module = 'content';
	private $table = 'content';

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

		if($this->input->post('type_ct')>0){
			$ids=getCategoryTreeId($this->input->post('type_ct'));
			$this->db->where_in('type',explode(",",$ids));
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

		if($this->input->post('type_ct')>0){
			$ids=getCategoryTreeId($this->input->post('type_ct'));
			$this->db->where_in('type',explode(",",$ids));
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

		$data = array(
			'title'=> trim($this->input->post('titleAdmincp')),
			'slug'=> SEO($this->input->post('titleAdmincp')),
			'content'=> $this->input->post('contentAdmincp'),
			'description'=> $this->input->post('descAdmincp'),
			'type'=> $this->input->post('typeAdmincp'),
			'status'=> $status,
			'created'=> date('Y-m-d H:i:s'),
			'pubdate'=> date('Y-m-d H:i:s')
		);

		//			

		if(!empty($fileName))
			foreach ($fileName as $key => $value) {
				$data[$key]=$value;
			}

		if($this->input->post('hiddenIdAdmincp')==0){
			//Kiểm tra đã tồn tại chưa?
			$checkData = $this->checkData($this->input->post('titleAdmincp'));
			if($checkData){
				print 'error-title-exists';
				exit;
			}

			$checkSlug = $this->checkSlug(SEO($this->input->post('titleAdmincp')));
			if($checkSlug){
				print 'error-slug-exists';
				exit;
			}
			
			if($this->db->insert(PREFIX.$this->table,$data)){
				modules::run('admincp/saveLog',$this->module,$this->db->insert_id(),'Add new','Add new');
				return true;
			}
		}else{
			$result = $this->getDetailManagement($this->input->post('hiddenIdAdmincp'));
			$link_img = $result[0]->image;
			unset($data['created']);
			
			// modules::run('admincp/saveLog',$this->module,$this->input->post('hiddenIdAdmincp'),'','Update',$result,$data);
			$this->db->where('id',$this->input->post('hiddenIdAdmincp'));
			if($this->db->update(PREFIX.$this->table,$data)){
				return true;
			}
		}
		return false;
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
		$this->db->where('check',$pubdate);
		$this->db->limit(1);
		$query = $this->db->get("cli_content_forum");
		if($query->num_rows()>0){
			return 1;
		}else{
			return 0;
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
	
	/* Get content for sv_category ------------------------------------------------------------------------------------------- */
	function getsearchContent2($limit,$page){
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

		$this->db->where("CatId != 0");

		if($this->input->post('type_ct')>0){
			$ids=getCategoryTreeId($this->input->post('type_ct'));
			$this->db->where_in('type',explode(",",$ids));
		}	

		$query = $this->db->get(PREFIX.$this->table);

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}

	function getTotalsearchContent2(){
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

		$this->db->where("CatId != 0");
		
		if($this->input->post('type_ct')>0){
			$ids=getCategoryTreeId($this->input->post('type_ct'));
			$this->db->where_in('type',explode(",",$ids));
		}	

		$query = $this->db->count_all_results(PREFIX.$this->table);

		if($query > 0){
			return $query;
		}else{
			return false;
		}
	}
	/*End Get Content for sv_category -------------------------------------------------------------------------------------------*/
 /*---------------- End Admin Control Panel (^-^) Begin Frontend ----------------------*/
 	function getType($except = ''){
		$this->db->select('id,name,slug');
		if($except)
			$where = "status = 1 AND slug != '{$except}' AND parent = 0";
		else
			$where = "status = 1 AND parent = 0";
		$this->db->where($where);
		return $this->db->get('cli_category')->result();
	}
	function getType1($except = ''){
		$this->db->select('id,name,slug');
		if($except)
			$where = "status = 1 AND slug != '{$except}'";
		else
			$where = "status = 1";
		$this->db->where($where);
		return $this->db->get('cli_category')->result();
	}
 	function index(){
 		$type = $this->fetch('*', 'cli_category', "status = 1 AND (id = 1 or id = 2)","created","DESC", 0, 6);
 		if($type){
	 		foreach ($type as $key => $value) {
	 			$a[] = $value->id;
	 		}
	 		$this->db->where_in('type', $a);
	 		$this->db->where('status',1);
	 		$this->db->order_by("created", "DESC");
	 		$data = $this->db->get(PREFIX.$this->table)->result();
	 		return $data;
	 	}
	 	else return 0;
 	}
 	function launcher_index(){
 		$type = $this->fetch('*', 'cli_category', "status = 1 AND displayoptions like '%4%'","id","asc",0,5);
 		if($type){
	 		foreach ($type as $key => $value) {
	 			$a[] = $value->id;
	 		}
	 		$this->db->where('status',1);
	 		$this->db->order_by("created", "DESC");
	 		$this->db->limit(30);
	 		// $this->db->where_in('type',$a);
	 		return $this->db->get(PREFIX.$this->table)->result();
	 	}
	 	else return 0;
 	}
 	// Event moi nhat(limit 1)
 	function eventlimit(){
 		$type = $this->getType();
	 	if($type)
 		{
 			foreach ($type as $key => $value) {
 			if($value->slug == 'su-kien'){$type = $value->id;}
 			}
 			$this->db->where('type',$type)->where('status',1)->limit(1)->order_by('created','desc');
 			$query = $this->db->get(PREFIX.$this->table)->row();
 			return $query;
 		}
 	}
 	//Event hot
 	function eventhot(){
 		$type = $this->getType();
	 	if($type)
 		{
 			foreach ($type as $key => $value) {
 			if($value->slug == 'su-kien'){$type = $value->id;}
 			}
 			$this->db->where(array('type' => $type, 'hot' => '1'));
 			$this->db->limit(5);
 			$this->db->order_by('created','desc');
 			return $this->db->get(PREFIX.$this->table)->result();
 		}
 	}
 	//Top event
 	function get_topevent(){
 		$type = $this->getType();
	 	if($type)
 		{
 			foreach ($type as $key => $value) {
 			if($value->slug == 'su-kien'){$type = $value->id;}
 			}
 			$this->db->where('type',$type);
 			$this->db->where('status',1);
 			$this->db->limit(5);
 			$this->db->order_by('created','desc');
 			return $this->db->get(PREFIX.$this->table)->result();

 		}
 	}

 	function getContentByType($type, $slug){
 		$array_type=explode(",",$type);
 		$this->db->where_in('type',$array_type);
 		$this->db->where(array('slug' => $slug))->limit(1);
 		$query = $this->db->get(PREFIX.$this->table)->row();
 		return $query;
 	}

 	function get_content($type, $slug){
 		$this->db->where(array('type' => $type, 'slug' => $slug))->limit(1);
 		$query = $this->db->get(PREFIX.$this->table)->row();
 		return $query;
 	}
 	function getOtherById($id,$type){

 		$this->db->select('id,slug,title,created');
 		$array_type=explode(",",$type);
 		$this->db->where_in('type',$array_type);

 		$this->db->where(array('status'=>1, 'id !=' => $id))->limit(10);
        $this->db->order_by('created','desc');
        $query = $this->db->get(PREFIX.$this->table);
        if($query->result()){
            return $query->result();
        }else{
            return 0;
        }
 	}

 	function get_other($id,$type){
 		$this->db->where(array('status'=>1, 'id !=' => $id, 'type' => $type))->limit(5);
        $this->db->order_by('created','desc');
        $query = $this->db->get(PREFIX.$this->table);
        if($query->result()){
            return $query->result();
        }else{
            return 0;
        }
 	}

 	function listDetail($record,$start=0,$type){
        $this->db->where('status',1)->where('type', $type);
        $this->db->order_by('created','desc');
        if($start != 0){
        	$start = ($start-1)*$record;
        }
        $this->db->limit($record,$start);
        $query = $this->db->get(PREFIX.$this->table);
        if($query->result()){
            return $query->result();
        }else{
            return false;
        }
    }
    function listTagsLineDetail($record,$start=0,$tags){
 		$this->db->where("status = 1 and tags like '%{$tags}%'");
        $this->db->order_by('created','desc');
        if($start != 0){
        	$start = ($start-1)*10;
        }
        $this->db->limit($record,$start);
        $query = $this->db->get(PREFIX.$this->table);
        if($query->result()){
            return $query->result();
        }else{
            return false;
        }
    }


 	function getTotal($type){
        $where = 'status = 1 AND type = '.$type;
        $this->db->where($where);
        return $this->db->get(PREFIX.$this->table)->num_rows();
    }
    function getTotalcontent($type){
    	$this->db->where('type',$type);
    	return $this->db->get(PREFIX.$this->table)->num_rows();
    }
    function ajax_listContent($limit, $start, $type){
    	$this->db->where('type',$type);
    	$this->db->where('status',1);
    	$this->db->limit($limit, $start);
    	$this->db->order_by('created ASC');
    	$query = $this->db->get(PREFIX.$this->table);
    	if($query->result()){
    		return $query->result();
    	}else{
    		return false;
    	}
    }

    function getTotalInId($ids){
        $where = "status = 1 AND type IN({$ids})";
        foreach (explode(",",$ids) as $key => $value) {
        	$where .= " OR type_in LIKE '%-".$value."-%'";
        }
        //pr($where);die;
        $this->db->where($where);
        return $this->db->get(PREFIX.$this->table)->num_rows();
    }

    function getTotalTagsLine($tags){
        $where = "status = 1 AND tags LIKE '%{$tags}%'";
        $this->db->where($where);
        return $this->db->get(PREFIX.$this->table)->num_rows();
    }

    function get_listtanthu(){  
		$ids=getCategoryTreeId('nhap-mon');

		$this->db->where('status',1);
		$this->db->where_in('type',explode(",",$ids));
		$this->db->limit(6);
		$this->db->order_by('created','desc');
		return $this->db->get(PREFIX.$this->table)->result();
 	}

 	function get_listdacsac(){
 		$ids=getCategoryTreeId('dac-sac');
 		
		$this->db->where('status',1);
		$this->db->where_in('type',explode(",",$ids));
		$this->db->limit(6);
		$this->db->order_by('created','desc');
		return $this->db->get(PREFIX.$this->table)->result();
 	}
 	function get_listvatpham(){
 		$type = 8;
		$this->db->where('status',1);
		$this->db->where('type',$type);
		$this->db->limit(13);
		$this->db->order_by('created','desc');
		return $this->db->get(PREFIX.$this->table)->result();
 	}

 	function get_listnangcao(){
 		$type = $this->getType();
	 	if($type)
 		{
 			foreach ($type as $key => $value) {
 			if($value->slug == 'nang-cao'){
 				$type = $value->id;
 			$this->db->where('status',1);
			$this->db->where('type',$type);
 			$this->db->limit(6);
 			$this->db->order_by('created','desc');
 			return $this->db->get(PREFIX.$this->table)->result();
 				}
 			}
 			return false;

 		}
 	}

 	function get_listcongdong(){
 		$type = $this->getType();
	 	if($type)
 		{
 			foreach ($type as $key => $value) {
 			if($value->slug == 'cong-dong'){
 				$type = $value->id;
 				$this->db->where('status',1);
 				$this->db->where('type',$type);
	 			$this->db->limit(6);
	 			$this->db->order_by('created','desc');
	 			return $this->db->get(PREFIX.$this->table)->result();
 				}
 			}
 			return false;

 		}
 	}
 	function update_time(){
 		$this->db->select("*");
		$this->db->where('status',1);
		$this->db->limit(1);
		$this->db->order_by('created','desc');
		return $this->db->get(PREFIX.$this->table)->result();
    }

     function getListByCategory($cate){  
        if(isset($cate->id)){
            $array_dq=$cate;
            $this->db->where(array('parent'=>$cate->id));
            // $this->db->where("status", "1"); 
            $this->db->order_by("order", "asc"); 
            $children=$this->db->get('cli_category')->result();

            if(!empty($posts)){
                $array_dq->posts=$posts;
            }

            if(!empty($children)){
                $array_dq->children=$children;
                foreach ($children as $key => $value) {
                    $this->getListByCategory($value);
                }
            }    
            return $array_dq;
        }

    }

}