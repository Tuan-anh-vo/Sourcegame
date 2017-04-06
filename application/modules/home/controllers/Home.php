<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Home extends MX_Controller
{
    private $module = 'home';
    function __construct()
    {
        parent::__construct();
        $this->load->model($this->module . '_model', 'model');
    }
    /*-------------------------------------- FrontEnd --------------------------------*/
    function landingpage(){
        $this->template->set_template('landingpage');
        $this->template->write('title',getSiteName());
        $this->template->write('meta_keywords',META_KEY);
        $this->template->write('meta_description',META_DESC);
        $this->template->render();
    }

    function index(){
        $this->template->write('title',getSiteName());
        $this->template->write('meta_keywords',META_KEY);
        $this->template->write('meta_description',META_DESC);
        $this->template->write_view('content','FRONTEND/index');
        $this->template->render();
    }
    function intro(){
        $this->template->set_template('intro');
        $this->template->write('title',getSiteName());
        $this->template->write('meta_keywords',META_KEY);
        $this->template->write('meta_description',META_DESC);
        $this->template->render();
    }
    function test_local(){
        pr( getIP() );
        if( is_local() ) echo 'yess';else echo 'no';
    }

    /*Begin of iplocal host*/
    function ip_localhost(){
        $data = array();
        if(!$this->session->userdata('user_local')){
            $this->load->view("FRONTEND/iplocal/ip_localhost", $data);
        }else{
            header('Location: ' . PATH_URL . 'home/ajax_ip_localhost');
        }
    }
    function ajax_ip_localhost(){
        $pass_local = $this->input->post('pass');
        $result = $this->model->fetch('*','admin_nqt_settings',"`slug` like 'is_local'");
        $data['result'] = json_decode($result[0]->content);
        // pr($pass_local,1);
        if(!$this->session->userdata('user_local')){
            if($pass_local == 'shin012016'){
                $this->session->set_userdata('user_local',true);
                $this->load->view("FRONTEND/iplocal/ajax_ip_localhost", $data);
            }
            else{
                echo "Mật khẩu bạn nhập không chính xác, vui lòng thử lại";
            }
        }else{
            $this->load->view("FRONTEND/iplocal/ajax_ip_localhost", $data);
        }

    }
    function save_ip_localhost(){
        $result = json_encode($this->input->post('ip_localhost'));
        // pr($result,1);
        $data = array('content' => $result);
        $this->db->where('slug','is_local');
        if($this->db->update('admin_nqt_settings',$data)){
            echo 1;
        }else{
            echo 0;
        }
    }
    /*End of iplocal host*/

    function file_get_contents_curl($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
        curl_setopt($ch, CURLOPT_URL, $url);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    function get_data($url) {
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    function test(){
        $url = "http://103.27.60.212:8888/api_tan.php";
        // echo $this->get_data($url);

        echo file_get_contents( $url );
    }

}

