<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Daptrung extends MX_Controller
{
    private $module = 'daptrung';
    private $table = 'daptrung_count';
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
    public function admincp_update($id = 0)
    {
        if ($id == 0) {
            modules::run('admincp/chk_perm', $this->session->userdata('ID_Module'), 'w', 0);
        } else {
            modules::run('admincp/chk_perm', $this->session->userdata('ID_Module'), 'r', 0);
        }
        $result[0] = array();
        if ($id != 0) {
            $result = $this->model->getDetailManagement($id);
        }
        $data = array(
            'result' => $result[0],
            'module' => $this->module,
            'id' => $id,
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
                print 'success'; exit;
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
        $data = array(
            'result' => $result,
            'per_page' => $this->input->post('per_page'),
            'start' => $this->input->post('start'),
            'module' => $this->module
        );
        $this->session->set_userdata('start', $this->input->post('start'));
        $this->load->view('BACKEND/ajax_loadContent', $data);
    }
    /*Add diem dua top cho user*/
    function addPointTop(){
        if($this->input->post('allow') && $this->input->post('account') && $this->input->post('point')){
            $account = $this->input->post('account');
            $user = $this->model->get('id,username',PREFIX.'web_users',"username LIKE '{$account}'");
            if($user){
                $dt_ins = array('user_id'=>$user->id,'username'=>$account,'count'=>0,'subtract'=>$this->input->post('point'),'message'=> "Admin add điểm đua top",'created'=>date('Y-m-d H:i:s',time()) );
                $this->db->insert(PREFIX.'daptrung_count',$dt_ins);
                $rs = array('status'=>1,'msg'=>'Add điểm đua top thành công !!');
            }else{
                $rs = array('status'=>0,'msg'=>'Tài khoản không tồn tại !!');
            }
        }else{
            $rs = array('status'=>0,'msg'=>'Kiểm tra lại dữ liệu !!');
        }
        echo json_encode($rs);
    }
    /*---------------- End Admin Control Panel (^-^) Begin Frontend -----------------*/
    function index(){
        if(!$this->session->userdata('username')){
            redirect(PATH_URL.'dang-nhap');
            exit;
        }
        // pr($this->uri->segment(1),1);
        $data = array();
        $user = $this->model->get('id,username',PREFIX.'web_users',"status = 1 AND username LIKE '{$this->session->userdata('username')}'");
        $data['count_cur'] = $this->model->getCount($user);
        $data['count_all'] = $this->model->getCountAll($user);
        $data['servers'] = $this->model->fetch('id,name,slug',PREFIX.'servers',"status = 1");
        $data['server_id_cur'] = $this->input->get('server_id');
        $data['check_con'] = modules::run('daptrung_config/check_event');
        // pr($this->input->get('server_id'),1);
        // $server_cur' = $this->uri->segment(2);

        $data['bool'] = json_decode($this->getfreecount());
        $data['top'] = $this->model->top_user();
        // pr($this->session->userdata('username'),1);
        echo $this->load->view('FRONTEND/popup_daptrung',$data);
    }
    function ajax_duatop(){
        $data['top'] = $this->model->top_user();
        echo $this->load->view('FRONTEND/ajax_duatop',$data);
    }
    function test_rand(){
        $check_con = modules::run('daptrung_config/check_event');
        if($check_con){
            die('Su kien dang dien ra');
        }else{
            die('Su kien chua dien ra hoac da ket thuc');
        }
        $list_config = $this->model->get('*','cli_daptrung_config');
        $item = unserialize($list_config->config);
        // pr($item,1);
        $ran = rand(1,1000);
        $phantram = 0;
        // pr($ran,1);
        foreach ($item as $k => $vl) {
            $phantram = $phantram + $vl['phantram'];
            if($ran <= $phantram ){
                $id_award = $vl['item'];
                $sum_award = $vl['number'];
                break;
            }
        }
        echo $ran.'<br>'.$vl['name_item'].'<br>'.$sum_award;
        pr($id_award,1);
        exit;
    }
    function getResult(){
        $server_id = $this->input->post('server_id');
        $user = $this->model->get('*',PREFIX.'web_users',"status = 1 AND username LIKE '{$this->session->userdata('username')}'");
        $count_all = $this->model->getCountAll($user);
        $count_cur = $this->model->getCount($user);
        if($count_cur > 0){
            $list_config = $this->model->get('*','cli_daptrung_config');
            $item = unserialize($list_config->config);
            $ran = rand(1,1000);
            $phantram = 0;
            foreach ($item as $k => $vl) {
                $phantram = $phantram + $vl['phantram'];
                if($ran <= $phantram ){
                    $id_award = $vl['item'];
                    $name_award = $vl['name_item'];
                    $sum_award = $vl['number'];
                    break;
                }
            }
            $this->model->removeCount($user);
            $count_cur -= 1;
            $count_all += 1;
            if($id_award != 0){
                $this->load->model('servers/servers_model');
                $is_done = $this->servers_model->gm_insert_item($user->username,$server_id,$id_award,$sum_award);
            }else{
                $dt_in = array('count'=>$sum_award,'message'=>'Nhận '.$sum_award.' búa đập trứng');
                $this->model->addCount($user,$dt_in);
                $count_cur += $sum_award;
                $is_done = array('status' => 1, 'url_service' => '');
            }

            $html_service = " <div style='display:none'><iframe src='". $is_done['url_service'] ."'></iframe></div> ";

            $data_ins = array(
                'username' => $user->username,
                'name_item' => $name_award,
                'id_item' => $id_award,
                'server_id' => $server_id,
                'is_send' => 1,
                'created' => date('Y-m-d H:i:s',time())
            );
            $this->db->insert(PREFIX.'daptrung_log',$data_ins);
            $result = array('count_all' => $count_all,'count_cur' => $count_cur,'award' => $name_award,'status'=>1, 'html_url' => $html_service );
            echo json_encode($result);
        }else{
            $result = array('count_cur' => $count_cur,'status'=>0);
            echo json_encode($result);
        }
                    
    }

    function getfreecount() {
        $username = $this->session->userdata("username");
        if ($username) {
            $user = $this->model->get("*", "cli_web_users", "username = '$username'");
            $check = $this->model->get("*", "cli_daptrung_free", "username = '$username'", "created", "DESC");
            $dtIN = array();
            $now = time();
            $valid_date = date("Y-m-d H:i:s", $now + 3600);
            $created = date("Y-m-d H:i:s", time());
            if (empty($check)) {
                $dt_in = array("uid" => $user->id, "username" => $username, "valid_date" => $valid_date, "created" => $created, "is_received" => 0, );
                $this->db->insert("cli_daptrung_free", $dt_in);
            } else {
                if ($check->is_received == 1 && $check->created <= $created) {
                    $dt_in = array("uid" => $user->id, "username" => $username, "valid_date" => $valid_date, "created" => $created, "is_received" => 0, );
                    $this->db->insert("cli_daptrung_free", $dt_in);
                }
            }
            $check = $this->model->get("*", "cli_daptrung_free", "username = '$username'", "created", "DESC");

            //pr($check, 1);
            $valid_date = $check->valid_date;
            $is_received = $check->is_received;
            $dt_return = array('is_received' => $is_received, 'valid_date' => $valid_date, );
            return json_encode($dt_return);
        }
    }

    function openfreecount(){
        $this->setngay();
        $username = $this->session->userdata("username");
        if ($username) {
            $user = $this->model->get("*", "cli_web_users", "username = '$username'");
            $check = json_decode($this->getfreecount());

            //pr($check, 1);
            if ($check) {
                $valid_date = $check->valid_date;
                $is_received = $check->is_received;
                $now = time();
                $dt_in = array();
                $dt_in2 = array();
                $now = time();
                $created = date("Y-m-d H:i:s", time());

                //Số lượt free
                $countfree = 1;
                if ($created >= $valid_date && $is_received == 0) {
                    $this->db->set("is_received", 1)->where("username", $username)->update("cli_daptrung_free");

                    //Cộng 1 búa miễn phí khi đúng thời gian
                    $dt_in = array('count' => $countfree,'message'=>'Nhận 1 búa miễn phí');
                    $this->model->addCount($user,$dt_in);

                    $valid_date = date("Y-m-d H:i:s", $now + 3600);

                    //Tăng Thời Gian Nhận
                    $dt_in2 = array("uid" => $user->id, "username" => $username, "valid_date" => $valid_date, "created" => $created, "is_received" => 0, );
                    $this->db->insert("cli_daptrung_free", $dt_in2);

                    echo json_encode(array('status'=>1,'message'=>'Nhận búa thành công. Bạn có thêm '.$countfree.'búa miễn phí') );
                    die;
                } else {
                    echo json_encode(array('status'=>0,'message'=>'Nhận búa thất bại. Chưa đến thời gian nhận búa!') );
                    die;
                }
            }
        }
        echo json_encode(array('status'=>0,'message'=>'Nhận búa thất bại. Mở lại trình duyệt rồi thử lại.') );
    }
    function setngay(){
        $time = time();
        $list_config = $this->model->get('*','cli_daptrung_config','id = 1');
        $checknow = strtotime($list_config->enddate);
        if($checknow <= $time){
                echo "Thời gian sự kiện kết thúc";
                die;
        }
    }
    function sendTopKnb($username,$sendKnb,$server_id){
        $knb = array(20000,15000,6000,5000,4000,2000);
        $check_knb = $this->model->get('*',PREFIX.'daptrung_log',"username LIKE '{$username}' AND name_item LIKE ".$knb[$sendKnb]."  AND is_duatop = 1");
        if($check_knb){ //No da nhan qua dua top roi
        }else{
            $user_id = '';
            $money = '';
            $charge_log_id = '';
            $this->load->model('servers/servers_model');
            $bool = $this->servers_model->insert_knb($server_id, $user_id, $username, $money, $knb[$sendKnb], $charge_log_id);
            $data_ins = array(
                'username' => $username,
                'name_item' => $knb[$sendKnb],
                'id_item' => '999999', //175123
                'server_id' => $server_id,
                'is_send' => 1,
                'is_duatop' => 1,
                'created' => date('Y-m-d H:i:s',time())
            );
            $this->db->insert(PREFIX.'daptrung_log',$data_ins);
        }
    }
     function sendAwardTop(){
        $result = array('status'=>0,'message'=>'No allowed');
        $getConfig = $this->model->get('enddate', 'cli_daptrung_config',"id = 1");
        if(!$getConfig) {echo json_encode($result); exit();}
        if(strtotime($getConfig->enddate) > time()){echo json_encode($result); exit();}
        $username = $this->session->userdata('username');
        $server_id = $this->input->post('server_id');
        // if(is_local()) $server_id = 88; // DUNG DE TEST
        if(!$server_id || !$username){echo json_encode($result); exit();}
        $check_nhan = $this->model->get('*',PREFIX.'daptrung_log',"username LIKE '{$username}' AND is_duatop = 1");
        if($check_nhan){
            $result['status'] = 2;
            echo json_encode($result); exit();
        }
        $userTop = $this->model->top_user();
        if(!$userTop) {echo json_encode($result); exit();}
        foreach ($userTop as $key => $value) {
            if($value->username == $username){
                $i = $key; $user = $value;
                break;
            }
        }
        if(!isset($i)) {echo json_encode($result); exit();}
        switch ($i) {
            case 0:
                $award = array(
                    array('name_item'=>'Đá Công Kích - 6','id_item' =>24045,'sum_item'=>1),
                    array('name_item'=>'Ám Hắc Chi Hài - Khóa','id_item' =>28305,'sum_item'=>1),
                    array('name_item'=>'Ám Hắc Thần Binh - Khóa','id_item' =>28546,'sum_item'=>2),
                    array('name_item'=>'1000 KNB Không Khóa','id_item' =>22981,'sum_item'=>6)
                );
                break;
            case 1:
                $award = array(
                    array('name_item'=>'Đá Công Kích - 5','id_item' =>24044,'sum_item'=>2),
                    array('name_item'=>'Ám Hắc Thần Binh - Khóa','id_item' =>28546,'sum_item'=>1),
                    array('name_item'=>'1000 KNB Không Khóa','id_item' =>22981,'sum_item'=>4)
                );
                break;
            case 2:
                $award = array(
                    array('name_item'=>'Đá Công Kích - 5','id_item' =>24044,'sum_item'=>2),
                    array('name_item'=>'Ám Hắc Thần Binh - Khóa','id_item' =>28546,'sum_item'=>1),
                    array('name_item'=>'1000 KNB Không Khóa','id_item' =>22981,'sum_item'=>2)
                );
                break;
            default:
                $award = array(
                    array('name_item'=>'Đá Công Kích - 3','id_item' =>24042,'sum_item'=>3),
                    array('name_item'=>'500 KNB Khóa','id_item' =>22978,'sum_item'=>4)
                );
            break;
        }
        $this->load->model('servers/servers_model');
        $qua = '';
        $is_done = array();
        foreach ($award as $key => $value) {
            if($value['id_item'] == 99999){
                $is_done = $this->servers_model->insert_knb($server_id, '', $username, '' , $value['sum_item'], 0);
            }else{
                $is_done = $this->servers_model->gm_insert_item($username, $server_id, $value['id_item'], $value['sum_item']);
            }
            $data_ins = array(
                'username' => $username,
                'name_item' => $value['name_item'],
                'id_item' => $value['id_item'],
                'server_id' => $server_id,
                'is_send' => 1,
                'is_duatop' => 1,
                'created' => date('Y-m-d H:i:s',time())
            );
            $this->db->insert('cli_daptrung_log', $data_ins);
            $qua .= ' | '.$value['name_item'];
        }

        $html_service = '';
        if( is_array($is_done) ){
            foreach ($is_done as $vl) {
                $html_service .= " <iframe src='". $vl['url_service'] ."'></iframe> ";
            }
        }

        $result = array('status' => 1,'message' => $qua, 'html_service' => $html_service );
        echo json_encode($result);
        exit;
    }
    /*----------------------------- End FRONTEND --------------------------*/
}