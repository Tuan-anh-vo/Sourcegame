<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Date_server extends MX_Controller
{
    private $module = 'date_server';
    private $table = '';
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

    /*----------------- Admin Control Panel -----------------------------*/
    public function admincp_index(){
        modules::run('admincp/chk_perm', $this->session->userdata('ID_Module'), 'r', 0);
        $data = array(
            'module' => $this->module,
            'module_name' => $this->session->userdata('Name_Module'),
        );
        $data['setting']     = $this->model->getSetting();

        $this->template->write_view('content', 'BACKEND/index', $data);
        $this->template->render();
    }
    function save_config(){
        if (!empty($_POST)) {
            $content = $this->input->post('contentAdmincp');
            foreach ($content as $k => $v) {
                $chk_slug = $this->model->checkSlug($k);
                if ($chk_slug) {
                    $data = array(
                        'content' => $v,
                        'modified' => date('Y-m-d H:i:s')
                    );
                    $this->db->where('id', $chk_slug[0]->id);
                    $this->db->update('admin_nqt_settings', $data);
                } else {
                    $data = array(
                        'slug' => $k,
                        'content' => $v,
                        'modified' => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('admin_nqt_settings', $data);
                }
            }
            echo json_encode(array('status'=>1,'msg'=>'Lưu thành công !!') );
        } 
    }

    public function admincp_ajaxLoadContent(){
        $data = array();
        // $this->load->view('BACKEND/ajax_loadContent', $data);
    }

    /*---------------- End Admin Control Panel (^-^) Begin Frontend -----------------*/
    function date_home(){//Ngay gio ra mat o trang chu
        $this->load->model('date_server/date_server_model');
        $setting = $this->date_server_model->getSetting();
        // pr($setting,1);
        if(isset($setting['name_server'] ) && isset($setting['date_server'])){
            $time_sv = strtotime($setting['date_server']);
            $name_server = explode("_", $setting['name_server']);
            // pr($time);
            $html = "";

            $html .= "<link rel='stylesheet' type='text/css' href='".PATH_URL."static/date_sv/date_sv.css'>";
            // $html .= "Khai mở máy chủ ".$setting['name_server']." <br/><span>".date('H',$time_sv)."H00 ngày ".date('d.m.Y',$time_sv)."</span></div>";
            $html .= "<div class='label_server'><span>open beta ".$name_server[0]." </br> <font class='d_duoi'>".$name_server[1]."</font></span><span>khai mở </br><font class='d_duoi'> ".date('H',$time_sv)."H - ".date('d.m.Y',$time_sv)."</font></span></div>";

            echo $html;
        }else{
            echo "";
        }
    }

    /*----------------------------- End FRONTEND --------------------------*/
}