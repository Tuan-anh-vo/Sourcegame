<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tichluy_log extends MX_Controller
{
    private $module = 'tichluy_log';
    private $table = 'tichluy_log';
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
            'default_sort' => $default_sort,
            'list_event' => $this->model->list_event()
        );
        $this->template->write_view('content', 'BACKEND/index', $data);
        $this->template->render();
    }

    public function admincp_ajaxLoadContent()
    {
        $this->load->library('AdminPagination');
        $config['total_rows'] = $this->model->getTotalsearchContent();
        $config['per_page'] = $this->input->post('per_page');
        $config['num_links'] = 3;
        $config['func_ajax'] = 'searchTichLuyLog';
        $config['start'] = $this->input->post('start');
        $this->adminpagination->initialize($config);
        $result = $this->model->getsearchContent($config['per_page'], $this->input->post('start'));
        $list_event = $this->model->list_event();
        $servers = $this->model->fetch('id,name',PREFIX.'servers');
        $data = array(
            'result' => $result,
            'per_page' => $this->input->post('per_page'),
            'start' => $this->input->post('start'),
            'module' => $this->module,
            'list_event' => $list_event,
            'servers' => $servers
        );
        $this->session->set_userdata('start', $this->input->post('start'));
        $this->load->view('BACKEND/ajax_loadContent', $data);
    }
    /*---------------- End Admin Control Panel (^-^) Begin Frontend -----------------*/

    /*----------------------------- End FRONTEND --------------------------*/
}