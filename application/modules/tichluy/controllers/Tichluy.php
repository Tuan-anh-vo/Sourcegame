<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tichluy extends MX_Controller
{
    private $module = 'tichluy';
    private $table = 'tichluy_config';
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
        $servers = $this->model->fetch('id,name',PREFIX.'servers','','created');
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

    public function admincp_update($id=0){
        if($id==0){
            modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'w',0);
        }else{
            modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'r',0);
        }
        $result[0] = (object) array('config'=>'');
        if($id!=0){
            $result = $this->model->getDetailManagement($id);
        }
        $servers = $this->model->fetch('id,name',PREFIX.'servers');
        $data = array(
            'result'=>$result[0],
            'module'=>$this->module,
            'id'=>$id,
            'item' => unserialize($result[0]->config),
            'servers'=>$servers
        );
        //var_dump($data);
        $this->template->write_view('content','BACKEND/ajax_editContent',$data);
        $this->template->render();
    }
    public function admincp_ajaxUpdateStatus(){
        $perm = modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'w',1);
        if($perm=='permission-denied'){
            print '<script type="text/javascript">show_perm_denied()</script>';
            $status = $this->input->post('status');
            $data = array(
                'status'=>$status
            );
        }else{
            if($this->input->post('status')==0){
                $status = 1;
            }else{
                $status = 0;
            }
            $data = array(
                'status'=>$status
            );
            modules::run('admincp/saveLog',$this->module,$this->input->post('id'),'status','update',$this->input->post('status'),$status);
            $this->db->where('id', $this->input->post('id'));
            $this->db->update(PREFIX.$this->table, $data);
        }
        $update = array(
            'status'=>$status,
            'id'=>$this->input->post('id'),
            'module'=>$this->module
        );
        $this->load->view('BACKEND/ajax_updateStatus',$update);
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
    public function check_event(){
        if(!is_local()){
            return false;
            exit;
        }

        $result = $this->model->get('*',PREFIX.'tichluy_config');

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
        $result = $this->model->get('*',PREFIX.'tichluy_config');
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
    /*---------------- End Admin Control Panel (^-^) Begin Frontend -----------------*/
    function index(){
        $this->load->view('FRONTEND/popup_modules');
    }
    function insert_money($money,$server_id){
    /*Insert money vao cho user tich luy*/
        if(!$this->session->userdata('username')){
            redirect(PATH_URL.'dang-nhap');
            exit;
        }
        $username = $this->session->userdata('username');
        $dt_ins = array(
            'user_id' => '',
            'username' => $username,
            'money' => $money,
            'server_id' => $server_id,
            'created' => date('Y-m-d H:i:s',time())
        );
        $is_done = $this->db->insert(PREFIX.'tichluy',$dt_ins);
        return $is_done;
    }
    function scan_event(){
        //function xu li trung tam
        //Lay ra cac event hien dang chay de lay dieu kien su dung buoc tiep theo
        //dem so tien tich luy ma user da nap thoa dieu kien.
        //dau tien da kiem tra event nao dang chay, sau do dua vao server id ma user no chon de nap tien de loc tiep
        $server_id = $this->input->get('server_id');
        $result = $this->model->scan_event($server_id);
        return $result;
        // pr($result);
    }

    /*tam toi tat khong dung den function nay, du lieu se dc chuyen thang den function trong  model de xu ly
    function count_money($type, $startdate, $enddate){
        //cong tong tien lai cua user thoa dieu kien cho truoc
        //cai nay quan trong vi no se xu li tinh toan tong tien tich luy ma user da nap vao thoa theo tung dieu kien
        //du lieu dua vao la loai tich luy, ngay bat dau ngay ket thuc
        //du lieu dau ra se la ngay bat dau, ngay ket thuc cua tuan, tu do tinh ra tong tien tich luy
        $date = array('begin'=>$startdate,'end'=>$enddate);
        $total = $this->model->count_money($type, $date);
        return $total;
    }
    */

    function calculate_date($dk, $start, $end){
    /*
        -tinh toan xem dieu kien reset theo tuan, reset theo ngay
        -vi du : ngay 2/3 thi 1 tuan sau (7 ngay sau) roi vao ngay nao...
        10h 2/4 thi 1 tuan sau do la 10h 9/4
        -du lieu dua vao la ngay bat dau, ngay ket thuc cua event
    */
        $today = time();
        $start = strtotime($start);
        $end = strtotime($end);
        //Kiem tra xem ngay bat cua tuan va ngay ket thuc cua tuan la ngay nao
        $dur = $end - $start;
        // pr($dur);
        if($dk == 1){//reset theo ngay
            $begin = date('Y-m-d H:i:s',$start);
            $end = date('Y-m-d H:i:s',$end);
        }
        if($dk == 2){//reset theo tuan
            $sotuan = intval($dur/604800);
            for ($i=1; $i <= $sotuan; $i++) {
                $week_begin = $start + ($i-1)*604800;
                $week_end = $week_begin + 604800 + 86399;
                if($today >= $week_begin && $today <= $week_end ){
                    //tra ra duoc ngay bat dau va ngay ket thuc cua tuan
                    break;
                }
            }
            $begin = date('Y-m-d H:i:s',$week_begin);
            $end = date('Y-m-d H:i:s',$week_end);
        }
        if($dk == 3){//reset theo thang
            $sothang = intval($dur/2592000);
            for ($i=1; $i <= $sothang; $i++) {
                $month_begin = $start + ($i-1)*2592000;
                $month_end = $month_begin + 2592000;
                if($today >= $month_begin && $today <= $month_end ){
                    //tra ra duoc ngay bat dau va ngay ket thuc cua tuan
                    break;
                }
            }
            $begin = date('Y-m-d H:i:s',$month_begin);
            $end = date('Y-m-d H:i:s',$month_end);
        }
        if($dk == 4){//khong reset
            $begin = date('Y-m-d H:i:s',$start);
            $end = date('Y-m-d H:i:s',$end);
        }
        
        $rs = array('begin'=>$begin,'end'=>$end);
        return $rs;

        /*
        echo 'có : '.intval($dur/604800).' tuần';die;
        // echo strtotime('2015-02-04 10:00:00');
        echo '2015-04-02 10:00:00'.'<br/>';
        $tuansau = strtotime('2015-04-02 10:00:00')+604800;
        echo date('Y-m-d H:i:s',$tuansau);
        */
    }
    function check_request(){
        #kiem tra tinh hop le cua request
        #kiem tra xem event nay co ton tai hay khong
        #kiem tra xem event nay dang chay co server_id nay khong
        $username = $this->session->userdata('username');
        $server_id = $this->input->post('server_id');
        $id_event = $this->input->post('id_event');
        $level_award = $this->input->post('level_award');
        $check = 0;
        // pr($username,1);
        if(!$username || !$server_id || !$id_event || !$level_award){
            $rs = array('status'=>0,'msg'=>'Bạn muốn hack à (lần 1) ???');
            echo json_encode($rs);die;
        }
        $check_idevent = $this->model->get('*',PREFIX.'tichluy_config',"id = {$id_event} AND servers LIKE '%_{$server_id}_%'");
        if(!$check_idevent){
            $rs = array('status'=>0,'msg'=>'Bạn muốn hack à (lần 2) ???');
            echo json_encode($rs);die;
        }else{
            #kiem tra xem level_award co thuoc event nay khong -QUAN TRONG-
            foreach (unserialize($check_idevent->config) as $key => $value) {
                if($value['level'] == $level_award){
                    $check = 1;break;
                }
            }
        }
        if($check == 0){
            $rs = array('status'=>0,'msg'=>'Bạn muốn hack à (lần 3) ???');
            echo json_encode($rs);die;
        }else{
            #tat ca du lieu deu hop le
            // echo 'ok';
            $data = array('username'=>$username,'server_id'=>$server_id,'id_event'=>$id_event,'level_award'=>$level_award);
            $rs = $this->ajaxSendAward($data);
            echo json_encode($rs);die;
        }
    }
    function ajaxSendAward($data){
        $username = $data['username'];
        $server_id = $data['server_id'];
        $id_event = $data['id_event'];
        $level_award = $data['level_award'];

        $info_event = $this->model->get('id,type,startdate,enddate',PREFIX.'tichluy_config',"id = {$id_event}");
        $date = $this->calculate_date($info_event->type, $info_event->startdate, $info_event->enddate);
        //kiem tra xem moc tich luy no muon nhan co lon hon so tien hien tai no dang co hay la khong???
        $check_money = $this->model->count_money($info_event->type, $date, $server_id);
        if($level_award > $check_money){
            return array('status'=>0,'msg'=>'Tổng tích lũy bạn có được không đủ để nhận mốc tích lũy này');
        }

        $checkAward = $this->model->checkAward($info_event->type, $date, $level_award, $id_event, $server_id);
        $rs = array('status'=>0);
        if(!$checkAward){//no chua nhan qua o moc nay
            //Lay event ma user muon nhan moc qua
            $event = $this->model->getEvent($id_event,$level_award);
            // pr($event,1);
            //lay moc qua de gui id item va so luong item vo cho user
            $id_item = explode('_', $event->id_item);
            $num_item = explode('_', $event->number_item);
            $name_item = explode('_', $event->name_item);
            $html_url = '';
            foreach ($id_item as $k => $vl) {
                $this->load->model('servers/servers_model');
                $is_done = $this->servers_model->gm_insert_item($username, $server_id,$vl,$num_item[$k]);
                $is_done['status'] = true;
                if( $is_done['status'] ){
                    $dt_ins = array(
                        'id_event' => $id_event,
                        'username' => $username,
                        'server_id' => $server_id,
                        'award_id' => $vl,
                        'award_name' => $name_item[$k],
                        'award_sum' => $num_item[$k],
                        'level_award' => $level_award,
                        'created' => date('Y-m-d H:i:s',time())
                    );
                    $this->db->insert(PREFIX.'tichluy_log',$dt_ins);
                    $rs = array('status'=>1,'msg'=>'Chúc mừng bạn đã nhận được các phần quà ở mốc tích lũy '.$level_award);

                    $html_url .= "<div style='display:none'><iframe src='". $is_done['url_service'] ."' ></iframe></div>";
                }
            }
            return array('status'=>1, 'msg' => $rs['msg'], 'html_url' => $html_url) ;
        }else{
            return array('status'=>0,'msg'=>'Bạn đã nhận quà ở mốc tích lũy này rồi !!');
        }
    }
    function tichluy_user($type = 0){
        $data['type'] = $type;

        //dau tien la phai lay ra duoc danh sach cac server ma user no da nap tien (function list_server_user trong model xu ly viec nay)
        //sau do load ra cac event tich luy chay tren server do (function loadEvent xu ly viec nay), ok!!!
        //tiep do lay ra nhung moc tich luy ma user da nhan duoc, ke do rap lai voi cac moc tich luy cua event dang chay do.
        $username = $this->session->userdata('username');
        if(!$username){
            print 'Vui lòng đăng nhập để tham gia event này';exit;
        }
        $this->load->model("tichluy/tichluy_model");

        $server_id  = $this->session->userdata("server_id");
        $checkdonate   =    $this->model->get("*", "cli_tichluy", "username = '$username' AND server_id = $server_id");
        if(empty($checkdonate)){
            $this->db->insert("cli_tichluy", array("username" => $username, "server_id" => $server_id, "money"  =>  0, 'created' => date("Y-m-d H:i:s", time())) );
        }

        $data = array();
        $result = $this->loadEvent();
        if($result){
            foreach ($result as $key => $value) {
                if($type == 0){
                    $date = $this->calculate_date($value->type, $value->startdate, $value->enddate);
                    $result[$key]->user = $this->tichluy_model->list_recieve($value->type, $value->id, $date, $value->server_id);
                    //chuyen toi thang model de no xu ly
                    $result[$key]->total = $this->tichluy_model->count_money($value->type, $date, $value->server_id);    
                }
                else{
                    if($value->type == $type){
                        $date = $this->calculate_date($value->type, $value->startdate, $value->enddate);
                        $result[$key]->user = $this->tichluy_model->list_recieve($value->type, $value->id, $date, $value->server_id);
                        //chuyen toi thang model de no xu ly
                        $result[$key]->total = $this->tichluy_model->count_money($value->type, $date, $value->server_id); 
                    }
                }
                
            }
        }

        // pr($result,1);
        // return false;
        $data['type'] = $type;
        $data['servers'] = $this->tichluy_model->fetch('id,name',PREFIX.'servers');
        $data['event'] = $result;
        $this->load->view('FRONTEND/tichluy_user',$data);
    }
    function view_insert(){
        //function test nap tien
        $username = $this->input->get('username');
        $money = $this->input->get('money');
        $server_id = $this->input->get('server_id');
        $this->session->set_userdata('username',$username);
        if(!$money || !$server_id){
            echo 'Khong dung dieu kien';die;
        }
        $rs = $this->insert_money($money,$server_id);
        if($rs = 'success') echo 'Bạn đã nạp tiền thành công vào server : '.$server_id.'. Với mệnh giá nạp là : '.$money;
    }
    function loadEvent(){
        //function giup lay ra nhung server id ma user da tung nap tien
        //sau do lay ra nhung event tich luy dang chay ma co nhung server id do
        $username = $this->session->userdata('username');
        $this->load->model("tichluy/tichluy_model");
        $server_id = $this->tichluy_model->list_server_user($username);
        if($server_id){
            $result = array();
            foreach ($server_id as $value) {
                if($value == $this->session->userdata("server_id")){
                    $result_a = $this->tichluy_model->scan_event($value);
                    // pr($result_a,1);
                    if(!empty($result_a)){
                        foreach ($result_a as $k => $vl) {
                            $result_a[$k]->server_id = $value;
                            array_push($result,$vl);
                        }
                    }    
                }
                
            }
            return $result;
        }else{

            $server_id[] = $this->session->userdata("server_id");
            $result = array();
            foreach ($server_id as $value) {
                if($value == $this->session->userdata("server_id")){
                    $result_a = $this->tichluy_model->scan_event($value);
                    // pr($result_a,1);
                    if(!empty($result_a)){
                        foreach ($result_a as $k => $vl) {
                            $result_a[$k]->server_id = $value;
                            array_push($result,$vl);
                        }
                    }    
                }
                
            }
            return $result;
            // return false;
        }
    }
    function sendKnbDay(){
        $now = date('Y-m-d',time());
        $username = $this->session->userdata('username');
        $server_id = $this->session->userdata('server_id');
        $check_charge = $this->model->get('id,username',PREFIX.'donate',"username LIKE '{$username}' AND date(`created`) = '{$now}'");
        $check_received = $this->model->get('id,username',PREFIX.'knbday_log',"username LIKE '{$username}' AND date(`created`) = '{$now}'");
        if(!$check_charge){//kiem tra xem ngay hom nay no da nap card chua
            $rs = array('status'=>0,'msg'=>'Bạn vui lòng nạp thẻ để tham gia event này. Event chỉ tham gia 1 lần duy nhất trong ngày !!!');
        }else if($check_received){//Neu no nhan roi trong ngay thi khong gui cho no
            $rs = array('status'=>0,'msg'=>'Bạn đã nhận KNB Khóa từ event này, vui lòng vào game để kiểm tra !!!');
        }else{
            $dt_ins = array(
                'username' => $username,
                'created' => date('Y-m-d H:i:s',time()),
                'server_id' => $server_id,
            );
            $this->db->insert(PREFIX.'knbday_log',$dt_ins);
            //Gui 2.000 KNB (Khoa) vo game.
            $this->load->model('servers/servers_model');
            $this->servers_model->gm_insert_item($username,$server_id, 22978, 2);
            $rs = array('status'=>1,'msg'=>'Chúc mừng bạn đã nhận được 2.000 KNB (Khóa). Bạn hãy vào game để kiểm tra !!!');
        }
        echo json_encode($rs);
    }
    function test(){
        $monhoc[0][0][0] = 'mot';
        $monhoc[0][0][1] = 'hai';
        pr($monhoc);
    }
    function setUser(){
        $this->session->set_userdata('username','tan.nguyen124');
    }

    public function sendTichLuy(){
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
        $money = ($_POST['money'] != null) ? $_POST['money']:0;
        
        if($username != null && $server_id != null && $money != null ){
            $dtlog = array(
                    "username" => $username,
                    "server_id" => $server_id,
                    "user_id" =>  0,
                    "money"   =>  $money,
                    "created"   =>  date("Y-m-d H:i:s",time())
                );
            $this->db->insert("cli_tichluy", $dtlog);
            $boolsend++;
        }
        if($boolsend){
            $out_msg = array('status'=>1);
        }else{
            $out_msg = array('status'=>0);
        }
        echo json_encode($out_msg);
        exit;
    }
    /*----------------------------- End FRONTEND --------------------------*/
}