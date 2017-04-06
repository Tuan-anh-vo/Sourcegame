<?php
class Slider_model extends MY_Model {
    private $module = 'slider';
    private $table = 'slider';

    function getsearchContent($limit,$page){
        $this->db->select('*');
        $this->db->limit($limit,$page);
        $this->db->order_by($this->input->post('func_order_by'),$this->input->post('order_by'));
        if($this->input->post('content')!='' && $this->input->post('content')!='type here...'){
            $this->db->where('(`title` LIKE "%'.$this->input->post('content').'%" OR `content` LIKE "%'.$this->input->post('content').'%" OR `type` = "'.$this->input->post('content').'")');
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
            $this->db->where('(`title` LIKE "%'.$this->input->post('content').'%" OR `content` LIKE "%'.$this->input->post('content').'%" OR `type` = "'.$this->input->post('content').'")');
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
        if(!filter_var($this->input->post('link'),FILTER_VALIDATE_URL)){
            print 'no-url';
            exit;
        }

        $data = array(
            'title'=> $this->input->post('titleAdmincp'),
            'slug'=> SEO($this->input->post('titleAdmincp')),
            'tab_slide'=> $this->input->post('typeAdmincp'),
            'link' =>$this->input->post('link'),
            'status'=> $status,
            'created'=> date('Y-m-d H:i:s'),
        );

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
    function index(){
        $this->db->where('status',1)->limit(5)->order_by('created', 'desc');
        $query = $this->db->get(PREFIX.$this->table);
        if($query->num_rows()>0)
            return $query->result();
        else return 0;
    }
    function slider_news(){
        $this->db->where('status',1)->where('tab_slide',1)->limit(5)->order_by('created', 'desc');
        $query = $this->db->get(PREFIX.$this->table);
        if($query->num_rows()>0)
            return $query->result();
        else return 0;
    }
    function slider_small($tab_slide = ''){
        $this->db->where('status',1)->where('tab_slide',$tab_slide)->limit(5)->order_by('created', 'desc');
        $query = $this->db->get(PREFIX.$this->table);
        if($query->num_rows()>0)
            return $query->result();
        else return 0;
    }
    function slider_trailler(){
        $this->db->where('status',1)->where('tab_slide',5)->limit(4)->order_by('created', 'desc');
        $query = $this->db->get(PREFIX.$this->table);
        if($query->num_rows()>0)
            return $query->result();
        else return 0;
    }
}