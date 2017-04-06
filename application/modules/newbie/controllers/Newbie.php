<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Newbie extends MX_Controller
{
    private $module = 'newbie';
    private $table = 'newbie_log';
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

        $item = $this->model->fetch('*','cli_newbie_item','server = 47');
        $data['item'] = $item;

        $servers = $this->model->fetch('*','cli_servers','server_status = 1');
        $data['servers'] = $servers;

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
        $server = $this->model->fetch('id,name',PREFIX.'servers');
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
        foreach ($_POST['item'] as $key => $value) {
            $item[$i]=array('item'=>$value,'number'=>$_POST['number'][$key], 'level'=>$_POST['level'][$key]);
            $i++;
        }
        $server = $_POST['server'];
        $result = $this->model->get('*',PREFIX.'newbie_item', "`server`  = ".$server);
        if(!empty($result)){
            $this->db->where('server', $server);
            $this->db->delete(PREFIX.'newbie_item'); 
        }
        foreach ($item as $k => $vl) {
            $arr1 = explode(',',$vl['item']);
            $arr2 = explode(',',$vl['number']);
            if(count($arr1) != count($arr2)){
                $out_msg = array('status'=>0,'msg'=>'Các vật phẩm và số lượng không khớp nhau ở mốc '.$k.' !');
                echo json_encode($out_msg);
                die;
            }else{
                $data_ins = array(
                    'items'   => serialize(json_encode($vl['item'])),
                    'sums'    => serialize(json_encode($vl['number'])),
                    'server'    => $server,
                    'level'    => $vl['level']
                );
                $this->db->insert('cli_newbie_item',$data_ins);
            }
        }
        $out_msg = array('status'=>1);
        echo json_encode($out_msg);
        exit;
    }
    public function change_type(){
        $server = $_POST['server'];
        $item = $this->model->fetch('*','cli_newbie_item',"`server` = ".$server);
        $data['item'] = $item;
        echo $this->load->view('BACKEND/change_type', $data);
    }

    public function send_item(){
        $boolsend = 0;
        
        $username = $_POST['username'];
        $user = $this->model->get('*','cli_web_users',"`username` = '". $username."'");
        if(!$user){
            $out_msg = array('status'=>0,'msg'=>'username không tồn tại');
            echo json_encode($out_msg);
            exit;
        }
        $server_id = $_POST['server'];
        $server = $this->model->get('*','cli_servers',"`id` = ". $server_id);
        if(!$server){
            $out_msg = array('status'=>0,'msg'=>'server không tồn tại');
            echo json_encode($out_msg);
            exit;
        }
        $type = $_POST['type_send'];
        $rank = $_POST['rank'];
        $data_item = $this->model->get('*','cli_newbie_item',"`type` = ". $type." AND `rank` = ". $rank);
        if(!$data_item){
            $out_msg = array('status'=>0,'msg'=>'thứ hạng hoặc kiểu đua top không tồn tại');
            echo json_encode($out_msg);
            exit;
        }
        $this->load->model('servers/servers_model');
        if(isset($data_item)){
            $items = json_decode(unserialize($data_item->items));
            $numbers = json_decode(unserialize($data_item->sums));
            $items = explode(",", $items);
            $numbers = explode(",", $numbers);
            for ($i= 0; $i < count($items); $i++) { 
               $bool =  $this->servers_model->gm_insert_item($username,$server_id, $items[$i], $numbers[$i]);
               if($bool){
                    $boolsend++;
                    $dtlog = array(
                            "username" => $username,
                            "server_id" => $server_id,
                            "itemid"    =>  $items[$i],
                            "sum"   =>  $numbers[$i],
                            "type"  =>  $type,
                            "rank"  => $rank,
                            "created"   =>  date("Y-m-d H:i:s",time())
                        );
                    $this->db->insert("cli_newbie_log", $dtlog);
               }
            }
        }
        if($boolsend){
            $out_msg = array('status'=>1);
        }
        else{
            $out_msg = array('status'=>0);
        }
        echo json_encode($out_msg);
        exit;
    }
    function loadViewNewBie(){
        $username = $this->session->userdata('username');
        $server_id = $this->input->get('servers');
        if(!$username || !$server_id) { echo 'Vui lòng refresh lại trình duyệt'; exit();}

        $server = $this->model->get('*','cli_servers', "id = '{$server_id}'");
        if(empty($server)) { echo 'Máy chủ không tồn tại.'; exit();}

        $md5user_str =md5($username.'@^*%HoanhDo%*^@');
        $character = $username.'_'.$md5user_str;

        $data = array( "user" => $username,"sid"=>$server->idplay,"type"=>'asd');
        $urlAPI = "http://$server->url_service/api_get_user.php";
        $info = json_decode(cURLGet($urlAPI, $data));
        if(empty($info->name)){ 
            $level = 1;
        }else{
            $level = $info->level;
            $data['name'] = $info->name;
        }
        
        $item = $this->model->fetch('*','cli_newbie_item', "server = $server->id AND level <= $level");

        $sql = "SELECT *  FROM cli_newbie_log WHERE `server_id` = $server->id AND `username` = '$username' GROUP BY `level`";
        $query = $this->db->query($sql);
        $result = $query->result();
        
        $checkQua = array();
        if(!empty($result)){
            foreach ($result as $key => $value) {
                $checkQua[] = $value->level;
            }
        }
        
        $data['checkQua'] = $checkQua;
        $data['item'] = $item;
        $data['server'] = $server;
        $this->load->view('FRONTEND/viewTop', $data);
    }
    function chageToGame(){
        $level = $this->input->post('level');
        $username = $this->session->userdata('username');
        $server_id = $this->session->userdata('server_id');
        if(!$username || !$level || !$server_id) { echo 'Vui lòng refresh lại trình duyệt'; exit();}

        $server = $this->model->get('*','cli_servers', "id = '{$server_id}'");

        $md5user_str =md5($username.'@^*%HoanhDo%*^@');
        $character = $username.'_'.$md5user_str;

        $data = array( "user" => $username,"sid"=>$server->idplay,"type"=>'asd');
        $urlAPI = "http://$server->url_service/api_get_user.php";
        $info = json_decode(cURLGet($urlAPI, $data));  
        $levelChar = $info->level;
        if($levelChar < $level){
            echo "Level của bạn không đủ để nhận thưởng"; exit();
        }

        $checkQua = $this->model->fetch('*','cli_newbie_log', "`server_id` = $server->id AND `level` = $level AND `username` = '$username'");
        if(!empty($checkQua)){
            echo "Bạn đã nhận mốc phần thưởng này rồi !!!"; exit();
        }

        $dataItem = $this->model->get('*','cli_newbie_item', "`server` = $server->id AND `level` = $level");
        if(empty($dataItem)){
            echo "Không có mốc phần thưởng của server này."; exit();
        }

        $item =  explode(",", json_decode(unserialize($dataItem->items)));
        $num = explode(",", json_decode(unserialize($dataItem->sums)));
        $this->load->model('servers/servers_model');
        foreach ($item as $key => $value) {
            $bool = $this->servers_model->gm_insert_item($username, $server->id, $value, $num[$key]);
            $data_log = array(
                'username'  => $username,
                'server_id' => $server->id,
                'level'     => $level,
                'status'    => 0,
                'created'   => date('Y-m-d H:i:s'),
                'itemid'    => $value,
                'sum'       => $num[$key]
            );
            if($bool) $data_log['status'] = 1;
            $this->db->insert('cli_newbie_log', $data_log);
        }
        echo "Bạn vừa đổi thành công phần thưởng mốc level: $level";
        exit();
    }
    /*----------------------------- End FRONTEND --------------------------*/
}