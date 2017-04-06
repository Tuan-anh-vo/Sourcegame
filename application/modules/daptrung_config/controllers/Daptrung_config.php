<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Daptrung_config extends MX_Controller
{
    private $module = 'daptrung_config';
    private $table = 'daptrung';
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

        $item=$this->model->get('*','cli_daptrung_config');
        $data['item']=unserialize($item->config);
        $data['startdate']=$item->startdate;
        $data['enddate']=$item->enddate;
        $data['enable']=$item->status;

        $this->template->write_view('content', 'BACKEND/index', $data);
        $this->template->render();
    }
    public function admincp_ajaxLoadContent(){

        $this->load->library('AdminPagination');
        $config['total_rows'] = $this->model->getTotalsearchContent();
        $config['per_page'] = $this->input->post('per_page');
        $config['num_links'] = 3;
        $config['func_ajax'] = 'searchContent';
        $config['start'] = $this->input->post('start');
        $this->adminpagination->initialize($config);
        $result = $this->model->getsearchContent($config['per_page'], $this->input->post('start'));
        $server = $this->model->fetch('id,name',PREFIX.'servers','status = 1');
        $data = array(
            'result' => $result,
            'server' => $server,
            'per_page' => $this->input->post('per_page'),
            'start' => $this->input->post('start'),
            'module' => $this->module
        );
        $this->session->set_userdata('start', $this->input->post('start'));
        $this->load->view('BACKEND/ajax_loadContent', $data);
    }
    //Begin of Save config
    public function save_status(){
        if(empty($_POST)){
            $out_msg = array('status'=>0,'msg'=>'Vui lòng nhập đầy đủ dữ liệu');
            echo json_encode($out_msg);
            exit;
        }

        $item=array();
        $i=1;
        $percent = 0;
        foreach ($_POST['item'] as $key => $value) {
            $item[$i]=array('name_item'=>$_POST['name_item'][$key],'item'=>$value,'number'=>$_POST['number'][$key],'percent'=>$_POST['percent'][$key], 'phantram'=>($_POST['percent'][$key]/100)*1000 );
            $percent += $_POST['percent'][$key];
            $i++;
        }

        if($percent != 100){
            $out_msg = array('status'=>0,'msg'=>'Tổng tỷ lệ không đủ 100% !!');
            echo json_encode($out_msg);
            exit;
        }

        $data_ins = array(
            'config' => serialize($item),
            'startdate' => $_POST['time-begin'],
            'enddate' => $_POST['time-end'],
            'status' => $_POST['enable']
        );

        $result = $this->model->get('*',PREFIX.'daptrung_config');
        if(empty($result)){
            if($this->db->insert('cli_daptrung_config',$data_ins)){
                $out_msg = array('status'=>1);
                echo json_encode($out_msg);
                exit;
            }
        }else{
            if($this->db->update('cli_daptrung_config',$data_ins)){
                $out_msg = array('status'=>1);
                echo json_encode($out_msg);
                exit;
            }
        }
    }
    public function check_event(){
        // if(!is_local()){
        //     return false;
        //     exit;
        // }

        $result = $this->model->get('*',PREFIX.'daptrung_config');
        if($result){
            if($result->status == 1){
                if( date('Y-m-d H:i',strtotime($result->startdate)) <= date('Y-m-d H:i',time()) && date('Y-m-d H:i',time()) <= date('Y-m-d H:i',strtotime($result->enddate) ) ) {    
                    //su kien van dang dien ra
                    return true;
                    exit;
                }else{
                    //su kien chua dien ra hoac da ket thuc
                    return false;
                    exit;
                }
            }else{
                //su kien chua duoc kich hoat
                return false;
                exit;
            }
        }else{
            //su kien chua co
            return false;
            exit;
        }
    }
    public function turnOn(){
        // if(!is_local()){
        //     return false;
        //     exit;
        // }
        $result = $this->model->get('*',PREFIX.'daptrung_config');
        if($result){
            if($result->status == 1){
                return true; //Event da duoc kich hoat
            }else{
                return false; //Event chua duoc kich hoat
            }
        }else{
            return false; //Event chua duoc kich hoat
        }
    }
    //End of Save config
    public function clear_data(){
        if($this->input->post('allow')){
            $this->db->truncate(PREFIX.'daptrung_count'); 
            $this->db->truncate(PREFIX.'daptrung_free'); 
            $this->db->truncate(PREFIX.'daptrung_log'); 
            echo json_encode(array('status'=>1));
        }
    }

    /*---------------- End Admin Control Panel (^-^) Begin Frontend -----------------*/

    /*----------------------------- End FRONTEND --------------------------*/
}