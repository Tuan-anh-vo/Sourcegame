<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class User extends MX_Controller{
    private $module = 'user';
    private $table = 'web_users';
    private $message = '';
    function __construct(){
        parent::__construct();
        if (!session_id()) {
            ini_set('session.gc_maxlifetime', 5 * 60 * 60); // 3 hours
            session_start();
        }
        $this->load->model($this->module . '_model', 'model');
        $this->load->helper('cookie');
        $this->load->helper('form');
        $this->load->model('admincp/admincp_model');
        $this->load->model('admincp_modules/admincp_modules_model');
        $sg1 = $this->uri->segment(1);
        if ($sg1 == 'admincp') {
            if ($this->uri->segment(2) != 'login') {
                if (!$this->session->userdata('userInfo')) {
                    header('Location: ' . PATH_URL . 'admincp/login');
                    exit();
                }

                $get_module = $this->admincp_modules_model->check_modules($this->uri->segment(2));
                $this->session->set_userdata('ID_Module', $get_module[0]->id);
                $this->session->set_userdata('Name_Module', $get_module[0]->name);
            }
            $this->template->set_template('admin');
            $this->template->write('title', 'Admin Control Panel');
        } else {
            $this->template->write('meta_keywords', META_KEY);
            $this->template->write('meta_description', META_DESC);
        }
    }
    /*------------------------------ Admin Control Panel ------------------------*/
    public function admincp_index(){
        modules::run('admincp/chk_perm', $this->session->userdata('ID_Module'), 'r', 0);
        $default_func = 'username';
        $default_sort = 'DESC';
        $data         = array(
            'module' => $this->module,
            'module_name' => $this->session->userdata('Name_Module'),
            'default_func' => $default_func,
            'default_sort' => $default_sort
        );
        $this->template->write_view('content', 'BACKEND/index', $data);
        $this->template->render();
    }
    public function admincp_update($username = ''){
        if ($username == '') {
            modules::run('admincp/chk_perm', $this->session->userdata('ID_Module'), 'w', 0);
        } else {
            modules::run('admincp/chk_perm', $this->session->userdata('ID_Module'), 'r', 0);
        }
        $result = array();
        if ($username != '') {
            $result = $this->model->getDetailManagement($username);
        }
        $data = array(
            'province' => $this->model->fetch('id, name',PREFIX.'province'),
            'result' => $result,
            'module' => $this->module,
            'id' => $username
        );
        $this->template->write_view('content', 'BACKEND/ajax_editContent', $data);
        $this->template->render();
    }
    public function admincp_save(){
        $perm = modules::run('admincp/chk_perm', $this->session->userdata('ID_Module'), 'w', 1);
        if ($perm == 'permission-denied') {
            print $perm;
            exit;
        }
        if ($_POST) {
            $result = $this->model->saveManagement($_POST);
            if($result) print 'success';
            else echo $result;
        }
    }
    public function admincp_ajaxLoadContent(){
        $this->load->library('AdminPagination');
        $config['total_rows'] = $this->model->getTotalsearchContent();
        $config['per_page']   = $this->input->post('per_page');
        $config['num_links']  = 3;
        $config['func_ajax']  = 'searchContent';
        $config['start']      = $this->input->post('start');
        $this->adminpagination->initialize($config);
        $result = $this->model->getsearchContent($config['per_page'], $this->input->post('start'));
        $data   = array(
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
            $data   = array(
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
            'id'     => $this->input->post('id'),
            'module' => $this->module
        );
        $this->load->view('BACKEND/ajax_updateStatus', $update);
    }

     function resetPass(){
       $new_password = $this->input->post('new_pass');
       $list_user = $this->input->post('list_id');
       $list = "";

       foreach ($list_user as $item) {
            if ($item != 'on') {
                $user = $this->model->get("*", "cli_web_users", "`username` = '{$item}'");
                // pr($user,1);
                $flag = $this->model->reset_password($user, $new_password );
                if (!$flag) {
                    $check = '0';
                    exit();
                }else{
                    $check = '1';
                }
            }
       }


       echo $check;
    }

    /*----- End Admin Control Panel ^-^ Begin Frond end ^-^ Manage Account------------*/

    function checkCaptcha($captcha=""){
        $captcha = md5(strtolower($captcha));
        if($captcha == $_SESSION['captcha'])
            echo 1;
        else echo 0;
    }
    public function logout(){
        unset($this->session->userdata);
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach ($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name  = trim($parts[0]);
                if($name=='utm_source' || $name=='utm_medium'){
                    continue;
                }
                setcookie($name, '', time() - 1000);
                setcookie($name, '', time() - 1000, '/');
            }
        }
        session_destroy();
        $this->session->set_userdata("logout",1);
        // echo '<script type="text/javascript">window.location.href = "' . PATH_URL . '";</script>';
        redirect(PATH_URL);
    }

    function ajax_forgot_password(){
        $data = $this->input->post();
        $result = $this->model->user_forgot_pass($data);
        echo $result;
    }


    // THAO VIET TU DAY
    function goLoginOpenId($type){
        redirect(url_login_openid($type));
    }
    function openid(){
        $this->load->view('FRONTEND/openid');
    }
    function login_openid($type = 'google'){
        $data = array();
        $profile = get_attr_profile_openid($type);
        if(!empty($profile['email'])){
            $user = $this->model->getUser(trim($profile['email']), TRUE);
            if($user){
                $this->session->set_userdata('username',$user->username);
                $this->session->set_userdata('uid',$user->id);
                modules::run('gifteveryday/checkGift', $user->username);
                echo 'SUCCESS';
            }
            else{
                $username = $data['username'] = $data['email'] = $profile['email'];
                $data['utm_source'] = $data['utm_medium'] = $data['referer'] = $type;
                $result = $this->model->addUser($data);
                if($result){
                    echo 'SUCCESS';
                    modules::run('gifteveryday/checkGift', $username);
                }
                else{echo "Hệ thống đang bị lỗi, bạn có thể đăng ký từ hệ thống.";}
            }
            if($type=='yahoo'){
                echo "<script>
                function setConfirmUnload(on) {
                    return false;
                }
                    setConfirmUnload(false);
                    window.opener.location.reload();
                    window.close();
                </script>";
            }
        }
        else
            echo "Unknown Error";
    }

    function ajaxLogin(){
        $post_data = $this->input->post();
        $post_data['username']=trim(strtolower($post_data['username']));
        $result = $this->model->loginUser($post_data);
        echo $result;
    }
    function ajaxRegister(){
        $result = $this->model->registerUser($this->input->post());
        echo $result;
    }
    function updateInfoUser(){
        $result = $this->model->updateInfoUser($this->input->post());
        echo $result;
    }
    function changPasswordUser(){
        $result = $this->model->changPasswordUser($this->input->post());
        echo $result;
    }
    // THÔNG TIN TÀI KHOẢNG
    function manageAccount(){
        // return 1;
        $this->model->loginReredirect();
        $data['user'] = $this->model->getUser($this->session->userdata('username'), FALSE);
        $data['province'] = $this->model->getprovince();
        $this->template->write('title', 'Thông tin tài khoản | ' . getSiteName());
        $this->template->write('meta_description', "Thay đổi thông tin tài khoản ".PATH_URL);
        $this->template->write('meta_keywords', 'Thay đổi thông tin tài khoản '.PATH_URL);
        $this->template->write_view('content','FRONTEND/manageaccount', $data);
        $this->template->render();
    }
    function changePassword(){
        $this->model->loginReredirect(PATH_URL.'doi-mat-khau');
        $this->template->write('title', 'Thay đổi mật khẩu | ' . getSiteName());
        $this->template->write('meta_description', "Thay đổi mật khẩu đăng nhập tài khoản ");
        $this->template->write('meta_keywords', 'Thay đổi mật khẩu đăng nhập tài khoản ');
        $this->template->write_view('content','FRONTEND/change_password');
        $this->template->render();
    }
    function forgetPassword(){
        $this->template->write('title', 'Quên mật khẩu| Lấy lại mật khẩu | ' . getSiteName());
        $this->template->write('meta_description', "Bạn quên mật khẩu đăng nhập web game");
        $this->template->write('meta_keywords', 'Lấy lại mật khẩu ');
        $this->template->write_view('content','FRONTEND/forgot_password');
        $this->template->render();
    }
    function fotgotPassword(){
        $result = $this->model->fotgotPassword($this->input->post());
        echo $result;
    }
    function sendMailGiftCode(){
        $email = $this->input->post('email');
        if(!$email){ echo "Vui lòng nhập địa chỉ mail"; exit();}
        $email = trim(strtolower($email));
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo "Địa chỉ mail không hợp lệ"; exit();
        }
        $data = $this->model->get('*','cli_giftcode_email', "email = '{$email}'");
        if($data){
            echo "Địa chỉ email này đã được gửi, bạn vui lòng kiểm tra spam"; exit();
        }
        if($this->session->userdata('uid')){
            $this->model->sendEmailGiftCode($this->session->userdata('uid'), $this->session->userdata('username'), $email);
            echo "Bạn vui lòng kiểm tra mail và làm theo hướng dẫn, email có thể vào spam."; exit();
        }else{
            echo "Vui lòng đăng nhập"; exit();
        }
    }


     function payment(){
        $this->load->model("user_model");
        if ( is_local() ) {
            $servers = $this->user_model->fetch("*", "cli_servers", "");
        } else {
            $servers = $this->user_model->fetch("*", "cli_servers", "status = 1");
        }
        $data['servers'] = $servers;
        $this->load->view('FRONTEND/skin_payment', $data);
    }
}