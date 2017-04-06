<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MX_Controller{
    private $module = 'category';
    private $table = 'category';
    function __construct()
    {
        parent::__construct();
        $this->load->model($this->module . '_model', 'model');
        $this->load->model('admincp_modules/admincp_modules_model');
        if ($this->uri->segment(1) == 'admincp') {
            if ($this->uri->segment(2) != 'login') {
                if (!$this->session->userdata('userInfo')) {
                    header('Location: ' . PATH_URL . 'admincp/login');
                    return false;
                }
                $get_module = $this->admincp_modules_model->check_modules($this->uri->segment(2));
                $this->session->set_userdata('ID_Module', $get_module[0]->id);
                $this->session->set_userdata('Name_Module', $get_module[0]->name);
            }
            $this->template->set_template('admin');
            $this->template->write('title', 'Admin Control Panel');
        }
    }

    /*----------------------- Admin Control Panel ----------------------------------*/
    public function admincp_index()
    {
        modules::run('admincp/chk_perm', $this->session->userdata('ID_Module'), 'r', 0);
        $default_func = 'created';
        $default_sort = 'DESC';
        $data = array(
            'module' => $this->module,
            'module_name' => $this->session->userdata('Name_Module'),
            'default_func' => $default_func,
            'default_sort' => $default_sort
        );
        $this->template->write_view('content', 'BACKEND/index', $data);
        $this->template->render();
    }


    public function admincp_update($id = 0)
    {
        if ($id == 0) {
            modules::run('admincp/chk_perm', $this->session->userdata('ID_Module'), 'w', 0);
            $data = array(
                'active' => 0,
                'created'=> date('Y-m-d H:i:s',time()),
            );
            if($this->db->insert('cli_category',$data)){
                $redirect_url = PATH_URL."admincp/category/update/".$this->db->insert_id();
                header('Location:'. $redirect_url);
            }
        } else {
            modules::run('admincp/chk_perm', $this->session->userdata('ID_Module'), 'r', 0);
        }
        $result[0] = array();
        $list_display = $this->model->fetch('*', 'cli_category', "status = 1 and id ={$id}", '', '', 0, 20);
        if ($id != 0) {
            $result = $this->model->getDetailManagement($id);
        }
        $cate = $this->model->getCate();
        $data = array(
            'result' => $result[0],
            'category' => $cate,
            'module' => $this->module,
            'list_display' =>$list_display,
            'id' => $id
        );
        $this->template->write_view('content', 'BACKEND/ajax_editContent', $data);
        $this->template->render();
    }

    public function admincp_save()
    {
        $perm = modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'w',1);
        if($perm=='permission-denied'){
            print $perm;
            exit;
        }
        if($_POST){
            if($this->model->saveManagement()){
                $this->dynamicRouter();
                print 'success';
                exit;
            }
        }
    }

    public function admincp_delete()
    {
        $perm = modules::run('admincp/chk_perm', $this->session->userdata('ID_Module'), 'd', 1);
        if ($perm == 'permission-denied') {
            print $perm;
            exit;
        }
        if ($this->input->post('id')) {
            $id = $this->input->post('id');
            $result = $this->model->getDetailManagement($id);
            modules::run('admincp/saveLog', $this->module, $id, 'Delete', 'Delete');
            $this->db->where('id', $id);
            if ($this->db->delete(PREFIX . $this->table)) {
                @unlink(BASEFOLDER . DIR_UPLOAD_CATEGORY . $result[0]->image);
                return true;
            }
        }
    }




    public function admincp_ajaxLoadContent()
    {

        $this->load->library('AdminPagination');
        $config['total_rows'] = $this->model->getTotalsearchContent();
        $config['per_page'] = $this->input->post('per_page');
        $config['num_links'] = 3;
        $config['func_ajax'] = 'searchContent';
        $config['start'] = $this->input->post('start');
        $this->adminpagination->initialize($config);
        $result = $this->model->getsearchContent($config['per_page'], $this->input->post('start'));
        $cate = $this->model->getCate();


        foreach ($cate as $key => $value) {
            if($value->parent==0)
               $cate_root[$key]=$this->getCategoryGroup($value);
        }
        

       //pr($this->getCategoryByName('su-kien'));die;
     

        $data = array(
            'menu' => $this->load_list_cate($cate_root),
            'category' => $cate,
            'result' => $result,
            'cate' => $cate,
            'per_page' => $this->input->post('per_page'),
            'start' => $this->input->post('start'),
            'module' => $this->module
        );
        
        $this->session->set_userdata('start', $this->input->post('start'));
        $this->load->view('BACKEND/ajax_loadContent', $data);
    }


    function load_list_cate($cateObj,&$html=""){
        $number=0;

        $html.="<ul class ='cate_group' >";
        foreach ($cateObj as $key => $value) {
          $html.="<li data-index='{$value->index}' level='{$value->level}' id='{$value->id}'  class='list_c level_{$value->level}' ><a href='javascript:void(0)'>{$value->name}</a>";
          if(isset($value->children)){
                $this->load_list_cate($value->children,$html);
          }
          $number++;
        }

        $html.="</li></ul>";
        return $html;
    }


    function getCategoryByName($cate,&$array_dq=''){  
        if(!isset($cate->id)){
            $this->db->where(array('name'=>"$cate"));
            $this->db->or_where(array('slug'=>"$cate"));
            $cate = $this->db->get('cli_category')->row();    
        } 
        if(isset($cate->id)){
            $array_dq=$cate;
            $this->db->where(array('parent'=>$cate->id));
            $this->db->order_by("index", "asc"); 
            $children=$this->db->get('cli_category')->result();
            if(!empty($children)){
                $array_dq->children=$children;
                foreach ($children as $key => $value) {
                    $this->getCategoryByName($value);
                }
            }    
            return $array_dq;
        }

    }


    function getCategoryGroup($cate,&$array_dq=''){        
        if($cate->id){
            $array_dq=$cate;
            $this->db->where(array('parent'=>$cate->id));
            $this->db->order_by("index", "asc"); 
            $children=$this->db->get('cli_category')->result();
            if(!empty($children)){
                $array_dq->children=$children;
                foreach ($children as $key => $value) {
                    $this->getCategoryGroup($value);
                }
            }    

            return $array_dq;
        }

    }


    public function admincp_ajaxUpdateStatus()
    {
        $perm = modules::run('admincp/chk_perm', $this->session->userdata('ID_Module'), 'w', 1);
        if ($perm == 'permission-denied') {
            print '<script type="text/javascript">show_perm_denied()</script>';
            $status = $this->input->post('status');
            $data = array(
                'status' => $status
            );
        } else {
            if ($this->input->post('status') == 0) {
                $status = 1;
            } else {
                $status = 0;
            }
            $data = array(
                'status' => $status
            );
            modules::run('admincp/saveLog', $this->module, $this->input->post('id'), 'status', 'update', $this->input->post('status'), $status);
            $this->db->where('id', $this->input->post('id'));
            $this->db->update(PREFIX . $this->table, $data);
        }

        $update = array(
            'status' => $status,
            'id' => $this->input->post('id'),
            'module' => $this->module
        );
        $this->load->view('BACKEND/ajax_updateStatus', $update);
    }

    function category_change()
    {
        $ids=implode(",", array_keys($this->input->post('data')));
        $this->db->select('*');
        $this->db->where_in('id',array_keys($this->input->post('data')));
        $query=$this->db->get('cli_category');
        $result=$query->result();

      
        foreach ($this->input->post('data') as $key => $value) {
            if($value=="") $value=0;
            $this->db->update('cli_category',array('index'=>$value), array('id' => $key));
        }

        foreach ($this->input->post('obj') as $key => $value) {
           if($value!="")
             $this->db->update('cli_category',array('parent'=>$value), array('id' => $key));
        }

    }

    /*------------------------------------ FRONTEND ------------------------------------*/
    function index()
    {
        $this->load->model('Category_model');
        $data['result']= $this->Category_model->getCategory();
        $data['multimenu']= $this->Category_model->multimenu();
        echo $this->load->view('FRONTEND/index',$data);
    }
    function dynamicRouter(){
        $this->load->model('Category_model');
        $result= $this->Category_model->getCategory();
        $file_content = '';
        foreach ($result as $key => $value) {
            $file_content .= "\$route['".$value->slug."'] =\"content/listDetail\";\r\n"."\$route['".$value->slug."/(:any)'] =\"content/detail/$1\";\r\n";
        }
        $path=APPPATH.'modules/category/views/FRONTEND/dynamic.txt';
        $file=fopen($path, "w");
        $write=fwrite($file,'<?php '.$file_content.' ?>');
        fclose($file);
    }
    function dynamicRouter2(){
        $result = $this->fetch('*', 'cli_category', "status = 1 AND displayoptions like '%2%'","","",0,5);
        if($result){
            return $result;
        }else{
            return 0;
        }

    }

    /*------------------------------------ End FRONTEND --------------------------------*/
}