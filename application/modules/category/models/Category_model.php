<?php
class Category_model extends MY_Model {
    private $module = 'category';
    private $table = 'category';

function getsearchContent($limit,$page){
        $this->db->select('*');
        $this->db->limit($limit,$page);
        $this->db->order_by($this->input->post('func_order_by'),$this->input->post('order_by'));
        $this->db->order_by("index","ASC");
        $this->db->order_by("name","ASC");
        if($this->input->post('content')!='' && $this->input->post('content')!='type here...'){
            $this->db->where('(`name` LIKE "%'.$this->input->post('content').'%" OR `content` LIKE "%'.$this->input->post('content').'%")');
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
            $this->db->where('(`name` LIKE "%'.$this->input->post('content').'%" OR `content` LIKE "%'.$this->input->post('content').'%")');
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
        $obj_perent=$this->model->get('*','cli_category',array('id'=>$this->input->post('parentAdmincp')));
        //pr($this->input->post('parentAdmincp'));die;
        if($this->input->post('statusAdmincp')=='on'){
            $status = 1;
        }else{
            $status = 0;
        }
        if($this->input->post('showAdmincp')=='on'){
            $show = 1;
        }else{
            $show = 0;
        }
        if($this->input->post('displayoption')){
            $displayoptions = implode('|',$this->input->post('displayoption'));
        }else{
            $displayoptions = '';
        }
        if($this->input->post('hiddenIdAdmincp')==0){
            //Kiểm tra đã tồn tại chưa?
            $checkData = $this->checkData($this->input->post('nameAdmincp'));
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
                'name'=> $this->input->post('nameAdmincp'),
                'slug'=> $this->input->post('slugAdmincp'),
                'seo_keywords'=> $this->input->post('keyAdmincp'),
                'seo_description'=> $this->input->post('desAdmincp'),
                'order'=>$this->input->post('orderAdmincp'),
                'status'=> $status,
                'show' => $show,
                'parent'=> $this->input->post('parentAdmincp'),
                'show'=> 1,
                'created'=> date('Y-m-d H:i:s'),
                'displayoptions' => $displayoptions
            );
            if(isset($obj_perent->id)){
                $data['level']=$obj_perent->level+1;
                $data['id_root']=$obj_perent->id_root;
            }

            if($this->db->insert(PREFIX.$this->table,$data)){
                modules::run('admincp/saveLog',$this->module,$this->db->insert_id(),'Add new','Add new');
                return true;
            }
        }else{
            $result = $this->getDetailManagement($this->input->post('hiddenIdAdmincp'));
            $data = array(
                'name'=> $this->input->post('nameAdmincp'),
                'order'=>$this->input->post('orderAdmincp'),
                'slug'=> $this->input->post('slugAdmincp'),
                'seo_keywords'=> $this->input->post('keyAdmincp'),
                'seo_description'=> $this->input->post('desAdmincp'),
                'status'=> $status,
                'show' => $show,
                'parent'=> $this->input->post('parentAdmincp'),
                'show'=> 1,
                'created'=> date('Y-m-d H:i:s'),
                'displayoptions' => $displayoptions
            );
            if(isset($obj_perent->id)){
                $data['level']=$obj_perent->level+1;
                $data['id_root']=$obj_perent->id_root;
            }
            $this->db->where('id',$this->input->post('hiddenIdAdmincp'));
            if($this->db->update(PREFIX.$this->table,$data)){
                return true;
            }
        }
        return false;
    }

    function checkData($title){
        $this->db->select('id');
        $this->db->where('name',$title);
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
    function getCate(){
        $this->db->select('*');
        $this->db->order_by('index','asc');
        $query = $this->db->get(PREFIX.$this->table);
        if($query->result()){
            return $query->result();
        }else{
            return 0;
        }
    }
    /*----------------------FRONTEND----------------------*/
    function getCategory(){
        $this->db->where('show',1);
        $this->db->where('status', 1);
        $this->db->order_by('order','desc');
        $query = $this->db->get(PREFIX.$this->table)->result();
        if(count($query)>0) return $query;
        else return 0;
    }

    function display_children($parent, $level) {
        $result = mysql_query(" SELECT a.id, a.name, a.slug, menucount.Count
                                FROM `cli_category` a  LEFT OUTER JOIN (SELECT parent, COUNT(*) AS Count FROM `cli_category` GROUP BY parent) menucount ON a.id = menucount.parent WHERE a.parent=" . $parent);

        //pr($result->result(),1);
        echo "<ul>";
        while ($row = mysql_fetch_assoc($result)) {
            if ($row['Count'] > 0) {
                echo "<li><a href='" . $row['slug'] . "'>" . $row['name'].'1' . "</a>";
                $this->display_children($row['id'], $level + 1);
                echo "</li>";
            } elseif ($row['Count']==0) {
                echo "<li><a href='" . $row['slug'] . "'>" . $row['name'] . "</a></li>";
            } else;
        }
        echo "</ul>";
    }

    public function multimenu(){
        $this->db->where('`displayoptions` LIKE "%1%"');
        $this->db->where('show',1);
        $query = $this->db->get('cli_category')->result_array();
        $i=0;
        foreach($query as $item){
            $main_nav[$i]['id'] =$item['id'];
            $main_nav[$i]['name'] =$item['name'];
            $main_nav[$i]['slug'] =$item['slug'];
            $main_nav[$i]['parent'] =$item['parent'];
            $i++;
        }
        return $main_nav;
    }
    /*--------------------END FRONTEND--------------------*/
}