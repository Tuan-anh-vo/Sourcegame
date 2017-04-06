<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Content extends MX_Controller
{
    private $module = 'content';
    private $table = 'content';
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
        if($this->router->class== "news")
        {
            $this->template->set_template("detail");
        }

    }
    /*----------------- Admin Control Panel -----------------------------*/
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
    public function admincp_update($id = 0) {
        if ($id == 0) {
            modules::run('admincp/chk_perm', $this->session->userdata('ID_Module'), 'w', 0);
        } else {
            modules::run('admincp/chk_perm', $this->session->userdata('ID_Module'), 'r', 0);
        }
        $result[0] = array();
        if ($id != 0) {
            $result = $this->model->getDetailManagement($id);
        }
        $typeNews = $this->model->getType();
        $data = array(
            'result' => $result[0],
            'module' => $this->module,
            'id' => $id,
            'type' => $typeNews,
            'list_category' => $this->model->fetch('*','cli_category')
        );
        foreach ($data['list_category'] as $key => $value) {
            if($value->parent==0)
               $cate_root[$key]=getCategoryByName($value);
        }
        $this->template->write_view('content', 'BACKEND/ajax_editContent', $data);
        $this->template->render();
    }

    function list_sv_category($id=0){
        $list=$this->model->fetch('*','cli_sv_category');
        $html="";
        foreach ($list as $key => $value) {
            $selected="";
            if($value->id==$id)
                $selected="selected='selected'";

            $html.="<option value=".$value->id." ".$selected." >".$value->title."</option>";
        }
        return $html;
    }
    public function admincp_save(){
        $perm = modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'w',1);
        if($perm=='permission-denied'){
            print $perm;
            exit;
        }
        if($_POST){
            $fileName = array();
            list($width, $height) = "";
            if(!empty($_FILES['image']['name'])){
                foreach ($_FILES as $key => $value) {
                    $result=uploadToHost($value['tmp_name'],strtolower($value['name']),$this->module,1);
                    if($result!='false'){
                        $fileName[$key]=$result;
                    }
                }
            }
            if($this->model->saveManagement($fileName)){
                print 'success'; exit;
            }
        }
    }

    public function admincp_delete(){
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
                //Xóa hình khi Delete
                @unlink(BASEFOLDER . DIR_UPLOAD_CONTENT. $result[0]->image);
                return true;
            }
        }
    }
    public function admincp_ajaxLoadContent() {
        $this->load->library('AdminPagination');
        $config['total_rows'] = $this->model->getTotalsearchContent();
        $config['per_page'] = $this->input->post('per_page');
        $config['num_links'] = 3;
        $config['func_ajax'] = 'searchContent';
        $config['start'] = $this->input->post('start');
        $this->adminpagination->initialize($config);
        $result = $this->model->getsearchContent($config['per_page'], $this->input->post('start'));
        $data = array(
            'result' => $result,
            'per_page' => $this->input->post('per_page'),
            'start' => $this->input->post('start'),
            'module' => $this->module
        );
        $this->session->set_userdata('start', $this->input->post('start'));
        $this->load->view('BACKEND/ajax_loadContent', $data);
    }
    public function admincp_ajaxUpdateStatus(){
        $perm = modules::run('admincp/chk_perm', $this->session->userdata('ID_Module'), 'w', 1);
        if ($perm == 'permission-denied') {
            print '<script type="text/javascript">show_perm_denied()</script>';
            $status = $this->input->post('status');
            $data = array( 'status' => $status );
        } else {
            if ($this->input->post('status') == 0) {
                $status = 1;
            } else {
                $status = 0;
            }
            $data = array( 'status' => $status );
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

    /*---------------- End Admin Control Panel (^-^) Begin Frontend -----------------*/
     public function index(){
        $type = $this->model->fetch('*', 'cli_category', "status = 1 AND (id = 4 or id = 2 or id = 1)","id","asc");
        if($type){
            foreach ($type as $key => $value) {
                $ids = getCategoryTreeId($value->slug);
                $type[$key]->obj_news = $this->model->fetch('*', 'cli_content', " status = 1 AND type IN ($ids) ","pubdate","desc",0,4);
            }
            $data['content'] = $type;
        }
        else $data['content'] = 0;
        // pr($data['content'],1);
        return $this->load->view('FRONTEND/index',$data,TRUE);
    }
    
    public function detail(){
        $type = $this->uri->segment(1); $slug = $this->uri->segment(2);
        $parent = $this->model->get('id, slug, name','cli_category',"slug = '{$type}'");
        if($parent){
            $type_content = $parent->id;
        }
        $detail = $this->model->get('*', 'cli_content',"type = {$type_content} AND slug ='{$slug}'");
        if ($detail){
            $other = $this->model->fetch('*','cli_content', "type = {$type_content} AND slug != '{$slug}'",'created','desc',0,6);
            $data['parent'] =  $parent;
            $data['result'] = $detail;
            $data['other'] = $other;
            $this->template->write('meta_image',getCacheImageByUrl(paser_image($detail->content),170, 168));
            $this->template->write('title', CutText($detail->title, 30) . ' | Tin tức - Sự kiện | ' . getSiteName());
            if($detail->description){
                $detail->description=str_replace(array('"',"!","#","@"),"",$detail->description);
                $this->template->write('meta_description', strip_tags(subString($detail->description, 300)));
            }else{
                $detail->content_des=str_replace(array('"',"!","#","@"),"",$detail->content);
                $this->template->write('meta_description', strip_tags(subString($detail->content_des, 300)));
            }
            $this->template->write('meta_keywords', META_KEY);
            $this->template->write_view('content', 'FRONTEND/detail',$data);
            $this->template->render();
        }else {
            show_404('error_404.php');
        }
    }

    function listDetail(){
        $type = $this->uri->segment(1); $slug = $this->uri->segment(2);
        $parent = $this->model->get('id, slug, name','cli_category',"slug = '{$type}'");
        if($parent){
            $type_content = $parent->id;
        }
        $config['total_rows'] = $this->model->getTotal($type_content);
        if($config['total_rows'] != "0"){
            $config['per_page'] = 9;
            $start=$this->input->get('p'); 
            $data['pageLink'] = pagination_new($config['total_rows'], $start, $config['per_page']);
            $data['result']= $this->model->listDetail($config['per_page'], $start,$type_content);
            $data['parent'] = $parent;
            
            $this->template->write('title', $parent->name.' - '.getSiteName());
            $this->template->write('meta_description',META_DESC);
            $this->template->write('meta_keywords', META_KEY);
            $this->template->write_view('content','FRONTEND/list',$data);
            $this->template->render();
        }
        else{
            $data = array('result'=> 0, "parent"=> 0, 'pageLink'=> 0);
            $this->template->write_view('content','FRONTEND/list',$data);
            $this->template->render();
        }
    }
    
    /* ------------------------- End FRONTEND --------------------------*/

}