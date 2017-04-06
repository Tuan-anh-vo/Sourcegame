<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Gametool extends MX_Controller
{

    private $module = 'gametool';

    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('userInfo')) {
            header('Location: ' . PATH_URL . 'admincp/login');
            return false;
        }              
        $this->load->model($this->module . "_model", "model");
        $this->template->set_template("template_thongke");         
                
    }
    function secutity_gt(){
        if(!$this->session->userdata('pwgt')){
            redirect('/admincp/post_security/', 'refresh');
        }
    }
    public function index()
    {
        $this->secutity_gt();
        $this->naptien();
        
        // $data['result'] = '';
        // $this->template->write('title','Nạp tiền'.' | '.getSiteName());
        // $this->template->write_view('content','FRONTEND/index',$data);
        // $this->template->render();
    }

    function naptien(){
        $config['total_rows'] = $this->model->getTotal_naptien();
        $config['per_page'] = 10;
        $start=$this->input->get('p');
        
        $data['pageLink']=pagination($config['total_rows'], $start, $config['per_page']);
        //pr($data['pageLink'],1);
        $start==0?$start=0:$start = $start-1;
        $data['result']= $this->model->list_naptien($config['per_page'], $start);
        //pr($data['result'],1);
       
        $data['servers'] = $this->model->fetch('*', PREFIX . "servers");
        $this->template->write('title','Nạp tiền'.' | '.getSiteName());
        $this->template->write_view('content','FRONTEND/naptien', $data);
        $this->template->render();
    }

    function naptienAjax(){
        //pr($_POST,1);
        $soluongknb = $_POST['soluongknb'];
        $server_id = $_POST['server'];
        $username = $_POST['name'];     
        $server = $this->model->get('*', PREFIX.'servers', "id = $server_id");
        //pr($url);
        $user = $this->model->get('*',PREFIX.'web_users', "`username` = '$username' AND status = 1 ");
        if($user)
        {


            // $urlAPI = "http://$server->url_service/api_tan.php";
            // $result = file_get_contents($urlAPI);
            // pr($result,1);

            $gamename = $username;
            $knb = str_replace('.', '',$soluongknb);

            $md5user_str =md5($username.'@^*%AH_TruyMong%*^@');
            $character = $username.'_'.$md5user_str;

            $sid = $server->idplay;
            $gold = $knb;
            $money = 0;
            $time = time();
            $key_login = "dGVhbWRldjIwMTU";

            $sign = md5($time.$sid.$character.$key_login.$gold);

            $data = array(
                    "user" => $character,
                    "sid" => $sid,
                    "gold" => $gold,
                    "money" => $money,
                    "time"  =>  time(),
                    "sign"  =>  $sign
                );  

            pr($data);
            $urlAPI = "http://$server->url_service/api_add_gold.php";
            // $urlAPI = "http://$server->url_service/api_add_gold.php?user=$character&sid=$sid&sign=sign&time=$time&gold=$gold";
            // $result = file_get_contents($urlAPI);
            pr($urlAPI);
            $data['url'] = processUrl($urlAPI, $data);
            $result = $this->load->view('FRONTEND/api_view',$data, TRUE);
            pr($result);

            $result = 'ok';
            pr($result);
            if($result != 'ok')
                {
                    $data = array(
                        "poster" => $this->session->userdata('userInfo'),
                        "name"  =>  $username,
                        "knb"   =>  -1,
                        "sid"   =>  $server_id,
                        "created" => date("Y-m-d H:i:s", time())
                        );
                    $this->db->insert("cli_log_gmt_money", $data);
                    echo "Nạp tiền không thành công ".$username;
                }
            else
                {
                   $data = array(
                        "poster" => $this->session->userdata('userInfo'),
                        "name"  =>  $username,
                        "knb"   =>  $knb,
                        "sid"   =>  $server_id,
                        "created" => date("Y-m-d H:i:s", time())
                        );
                    $this->db->insert("cli_log_gmt_money", $data);
                    echo "Nạp tiền thành công ".$username;
                }
        }
        else
        {
            echo "Chưa có tài khoản";
        }
    }

     function themvatpham(){
		
     	$config['total_rows'] = $this->model->getTotal_Table('cli_log_gmt_items');
        //pr($config['total_rows'] ,1);
        $config['per_page'] = 10;
        $start=$this->input->get('p');
        $data['pageLink']=pagination($config['total_rows'], $start, $config['per_page']);
        //pr($data['pageLink'],1);
        $start==0?$start=0:$start = $start-1;
        $data['result']= $this->model->list_Data('cli_log_gmt_items',$config['per_page'], $start);
        //pr($data['result'],1);
     	
        
        $data['servers'] = $this->model->fetch('*', PREFIX . "servers");
        $this->template->write('title','Nạp tiền'.' | '.getSiteName());
        $this->template->write_view('content','FRONTEND/themvatpham', $data);
        $this->template->render();
    }

    function themvatphamAjax(){
        //pr($_POST);
        $itemid = $_POST['itemid'];
        $soluong = $_POST['soluong'];
        $server_id = $_POST['server'];
        $username = strtolower($_POST['name']);        

        $server = $this->model->get('*', PREFIX.'servers', "id = $server_id");
        //pr($url);
        $user = $this->model->get('id', PREFIX.'web_users', "`username` = '$username' AND status = 1 ");
        if($user)
        {
            
            $gamename = $username;

            $md5user_str =md5($username.'@^*%AH_TruyMong%*^@');
            $character = $username.'_'.$md5user_str;
            

            $sid = $server->idplay;
            $itemId = $itemid;
            $soluong = $soluong;
            $key_login = "dGVhbWRldjIwMTU";
            $time = time();
            $sign = md5($time.$sid.$character.$key_login.$itemId);
            $content = 'Quà gửi';


            $data = array(
                    "user" => $character,
                    "itemId" => $itemId,
                    "count" => $soluong,
                    "time"  => $time,
                    "sid"   =>  $sid,
                    "sign"  =>  $sign,
                    "content"   =>  $content
                );
            pr($data);
            $urlAPI = "http://$server->url_service/api_send_item.php";

            $data['url'] = processUrl($urlAPI, $data);
            $result = $this->load->view('FRONTEND/api_view',$data, TRUE);
            pr($result);
            $result = 'ok';

            pr($result);
            if($result != 'ok')
            {
                $data = array(
                "poster" => $this->session->userdata('userInfo'),
                "name"  =>  $username,
                "item" => $itemid,
                "total"   =>  -1,
                "sid"   =>  $server_id,
                "created" => date("Y-m-d H:i:s", time())
                );
                $this->db->insert("cli_log_gmt_items", $data);
                echo $result;
            }
            else
            {
                 $data = array(
                "poster" => $this->session->userdata('userInfo'),
                "name"  =>  $username,
                "item" => $itemid,
                "total"   =>  $soluong,
                "sid"   =>  $server_id,
                "created" => date("Y-m-d H:i:s", time())
                );
                $this->db->insert("cli_log_gmt_items", $data);
                echo "Thêm vật phẩm thành công";
            }
        }
        else
        {
            echo "Chưa có tài khoản";
        }
    }

     function inform_all(){
        
        $config['total_rows'] = $this->model->getTotal_Table('cli_log_gmt_inform_all');
        //pr($config['total_rows'] ,1);
        $config['per_page'] = 10;
        $start=$this->input->get('p');
        $data['pageLink']=pagination($config['total_rows'], $start, $config['per_page']);
        //pr($data['pageLink'],1);
        $start==0?$start=0:$start = $start-1;
        $data['result']= $this->model->list_Data('cli_log_gmt_inform_all',$config['per_page'], $start);
        //pr($data['result'],1);
        
        
        $data['servers'] = $this->model->fetch('*', PREFIX . "servers");
        $this->template->write('title','Nạp tiền'.' | '.getSiteName());
        $this->template->write_view('content','FRONTEND/inform_all', $data);
        $this->template->render();
    }

    function inform_allAjax(){
        //pr($_POST);
        $content = addslashes( trim( $_POST['content'] ) );
        $title = addslashes( trim( $_POST['title'] ) );
        $server_id = addslashes( trim( $_POST['server'] ) ); 

        $server = $this->model->get('*', PREFIX.'servers', "id = $server_id");
        $key_login = "dGVhbWRldjIwMTU";
        $sign = md5( $server->idplay.$title.$key_login.$content);
        $data = array(
            "sid" => $server->idplay,
            "subject" => $title,
            "content" => $content,
            "sign" => $sign
        );

        $urlAPI = "http://$server->url_service/api_send_mail.php";
        $url_service = processUrl($urlAPI, $data);
        $html_service = "<iframe src='". $url_service ."'></iframe>";
        pr($html_service);

        $result = 'ok';
        pr($result);
         if($result == '')
            {
                $data = array(
                "poster" => $this->session->userdata('userInfo'),
                "title"  =>  $title,
                "content" => $content,
                "total"   =>  -1,
                "sid"   =>  $server_id,
                "created" => date("Y-m-d H:i:s", time())
                );
                $this->db->insert("cli_log_gmt_inform_all", $data);
                echo "Gửi Thư Thất Bại - ".$result;
            }
        else
            {
                 $data = array(
                "poster" => $this->session->userdata('userInfo'),
                 "title"  =>  $title,
                "content" => $content,
                "sid"   =>  $server_id,
                "created" => date("Y-m-d H:i:s", time())
                );
                $this->db->insert("cli_log_gmt_inform_all", $data);
                echo "Gửi Thư thành công";
            }
      
    }


function getprofileuser(){
        if(isset($_POST['server']))
            $server_id = addslashes( trim( $_POST['server'] ) );
        $data['result']=array();
       // $username = strtolower($_POST['name']); 
        $server_all =  $this->model->fetch('*', PREFIX . "servers");       
        if(isset($server_id)){
            if($server_id!=0){
                $server = $this->model->get('*', PREFIX.'servers', "id = $server_id");
                $fieldGame = array(
                    'serviceUser'   =>  SERVICE_USER_NAP_TIEN,
                    'servicePass'   =>  SERVICE_PASS_NAP_TIEN,
                    'OrderBy'     =>'Level',
                    'OrderByProperty'   =>'DESC',
                    'Page'       =>  1,

                );

                //pr($fieldGame);
                $result = post($url, $fieldGame);
                $result = trim(strip_tags($result));
                $data['result']=json_decode($result);
                $data['server_name']=$server->name;
            }    
        }
        
        $data['servers']=$server_all;
        //pr($data['result']);exit();
       // print_r($data['result']);exit();
        $this->template->write('title','Nạp tiền'.' | '.getSiteName());
        $this->template->write_view('content','FRONTEND/getprofileuser', $data);
        $this->template->render();


    }
    function getnumberclick(){
        if(isset($_POST['server'])){
            $server_id = addslashes( trim( $_POST['server'] ) );
        }
        $data['result']=array();
        $server_all =  $this->model->fetch('*', PREFIX . "servers");
        if(isset($server_id)){
            if($server_id!=0){
                $server = $this->model->get('*', PREFIX.'servers', "id = $server_id");
                $urlAPI = "http://{$server->url_service}/get_register.php";

                $result = file_get_contents($urlAPI);
                $result = json_decode($result);
                // pr($result,1);
                $data['result']= $result; 
                $data['server_name']=$server->name;         
            }
        }
        $data['servers']=$server_all;
        $this->template->write('title','Nạp tiền'.' | '.getSiteName());
        $this->template->write_view('content','FRONTEND/getnumberclick', $data);
        $this->template->render();        
    }
    function getprofilebyuser(){
        $server_all =  $this->model->fetch('*', PREFIX . "servers");       
        if(isset($_POST['server']))
            $server_id = addslashes( trim( $_POST['server'] ) );
        $data['result']=array();

        if(isset($_POST['name']))
            $username = addslashes( trim( $_POST['name'] ) );
 
        if(isset($username)){
            $server = $this->model->get('*', PREFIX.'servers', "id = $server_id");
           if($server){
                $gamename = $username;
                $dt = array(
                    "user" => $gamename,
                    "sid" => $server->idplay,
                    "type" => "name3"
                );
                //pr($data);
                $urlAPI = "http://$server->url_service/api_get_user.php";
                //pr($urlAPI);
                $url_service = processUrl($urlAPI, $dt);
                $data['url_service'] = "<iframe width='100%' src='".$url_service."'> </iframe>";
           }

        }     
        
        $data['servers']=$server_all;
        //pr($data);exit();
        // print_r($data['result']);exit();
        $this->template->write('title','Nạp tiền'.' | '.getSiteName());
        $this->template->write_view('content','FRONTEND/getprofilebyuser', $data);
        $this->template->render();
    }


    function getprofilebyplayername(){
        //pr($_POST);
       // $itemid = $_POST['itemid'];
        //$soluong = $_POST['server'];
    $server_all =  $this->model->fetch('*', PREFIX . "servers");       
            

    if(isset($_POST['server']))
        $server_id = addslashes( trim( $_POST['server'] ) );

    $data['result']=array();

    if(isset($_POST['name']))
        $username = addslashes( trim( $_POST['name'] ) );

   
            
        if(@$server_id!=0){
            $server = $this->model->get('*', PREFIX.'servers', "id = $server_id");

            $dt = array(
                "user" => urlencode($username),
                "sid" => $server->idplay,
                "type" => "name"
            );
            //pr($data);
            $urlAPI = "http://$server->url_service/api_get_user.php";
            //pr($urlAPI);
            $url_service = processUrl($urlAPI, $dt);
            $data['url_service'] = "<iframe width='100%' src='".$url_service."'> </iframe>";

        }    
      
        $data['servers']=$server_all;
        $this->template->write('title','Nạp tiền'.' | '.getSiteName());
        $this->template->write_view('content','FRONTEND/getprofilebyplayername', $data);
        $this->template->render();
    }
    function getreportserver(){
        if(isset($_POST['server']))
            $server_id = addslashes( trim( $_POST['server'] ) );
        $data['result']=array();
       // $username = strtolower($_POST['name']); 
        $server_all =  $this->model->fetch('*', PREFIX . "servers");       
        if(isset($server_id)){
            if($server_id!=0){
                $server = $this->model->get('*', PREFIX.'servers', "id = $server_id");
                $fieldGame = array(
                    'serviceUser'   =>  SERVICE_USER_NAP_TIEN,
                    'servicePass'   =>  SERVICE_PASS_NAP_TIEN,
                    'OrderBy'     =>'Level',
                    'OrderByProperty'   =>'DESC',
                    'Page'       =>  1,

                );

                //pr($fieldGame);
                $result = post($url, $fieldGame);
                $result = trim(strip_tags($result));
                $data['result']=json_decode($result);
                $data['server_name']=$server->name;
            }    
        }
        
        $data['servers']=$server_all;
        $this->template->write('title','Nạp tiền'.' | '.getSiteName());
        $this->template->write_view('content','FRONTEND/getreportserver', $data);
        $this->template->render();
    }
    function themnhieuvatpham(){
    	
    	$config['total_rows'] = $this->model->getTotal_Table('cli_log_gmt_items');
        //pr($config['total_rows'] ,1);
        $config['per_page'] = 10;
        $start=$this->input->get('p');
        $data['pageLink']=pagination($config['total_rows'], $start, $config['per_page']);
        //pr($data['pageLink'],1);
        $start==0?$start=0:$start = $start-1;
        $data['result']= $this->model->list_Data('cli_log_gmt_items',$config['per_page'], $start);
    	
        $data["servers"] = $this->model->fetch('*', PREFIX . "servers");
        $this->template->write('title','Nạp tiền'.' | '.getSiteName());
        $this->template->write_view('content','FRONTEND/themnhieuvatpham', $data);
        $this->template->render();
    }

    function themnhieuvatphamAjax(){
        //pr($_POST,1);        
        $error ="";
        $server_id = addslashes( trim( $_POST['server'] ) );
        $username = strtolower( addslashes( trim( $_POST['name'] ) ) ); 
        $textAr = explode("\n", $username);  
        $server = $this->model->get('*', PREFIX.'servers', "id = $server_id");
        if($_POST['sum']>0)
        {
            for($so = 1; $so <= $_POST['sum']; $so++) 
            {
                
                $idItem = "idItem_".$so;
                $sumItem = "sumItem_".$so;
                if($_POST[$idItem] != '' &&  $_POST[$sumItem] != '')
                {
                    foreach ($textAr as $line) 
                    {
                        $rs = '';
                        if($line)
                        {
                            $user = $this->model->get('*', PREFIX.'web_users', "`username` = '$line' AND status = 1 ");
                            if($user)
                            {
                                $gamename = $username;
                                $tmp = $gamename."_".md5($user->id);
                                if (strlen($tmp)> 47){
                                  $check_game = substr($tmp,0,47);
                                 }else $check_game = $tmp;
                         
                                $gamename2 = strtolower($check_game."_".$server->id);

                                if($_POST[$sumItem]>0)
                                {
                                     $fieldGame = array(
                                        'serviceUser'   =>  SERVICE_USER_NAP_TIEN,
                                        'servicePass'   =>  SERVICE_PASS_NAP_TIEN,
                                        'loginName'     =>  $gamename2,
                                        'IdItem'        =>  addslashes( trim( $_POST[$idItem] ) ),
                                        'SoLuong'       =>  addslashes( trim( $_POST[$sumItem] ) ),
                                        'Khoa'          => 1,
                                        'titleEmail'    => 'Phần quà từ System',
                                        'messageEmail'  => 'Click vào để nhận'
                                    );
                                    $result = post($url, $fieldGame);
                                    $result = trim(strip_tags($result));
                                    if($result != 'true')
                                    {
                                              $data = array(
                                                "poster" => $this->session->userdata('userInfo'),
                                                "name"  =>  $line,
                                                "item" => addslashes( trim( $_POST[$idItem] ) ),
                                                "total"   => -1,
                                                "sid"   =>  $server_id,
                                                "created" => date("Y-m-d H:i:s", time())
                                                );
                                                $this->db->insert("cli_log_gmt_items", $data);
                                            $error = $error.$result."<br/>";
                                    }
                                    else
                                    {
                                            $data = array(
                                            "poster" => $this->session->userdata('userInfo'),
                                            "name"  =>  $line,
                                            "item" => addslashes( trim( $_POST[$idItem] ) ),
                                            "total"   => addslashes( trim( $_POST[$sumItem] ) ),
                                            "sid"   =>  $server_id,
                                            "created" => date("Y-m-d H:i:s", time())
                                            );
                                            $this->db->insert("cli_log_gmt_items", $data);
                                        $error = $error." Thao tác thêm vật phẩm thành công tài khoản ".$line."<br/>";
                                    }
                                }
                       
                            }
                            else
                                $error = $error." Không tồn tại tài khoản ".$line."<br/>";         
                        }
                         
                    }
                }
            }
        }
        echo $error;
    }

    function useronline(){
        if(1){
            $this->session->set_userdata('pwgt','bachluyenthanhtien');
            $data['servers'] = $this->model->fetch('*', PREFIX . "servers", "is_cron = 0");
            $merge = array();
            if($data){
               $data['resultnow'] = '';
               $data['serversnow'] = $this->model->fetch('*', PREFIX . "servers", "is_cron = 0");
               $day = date("Y-m-d 00:00:00", strtotime("-1 day", time()));
               $data['result_full'] = $this->model->fetch("*", "cli_log_useronlinejob", "created >= '$day'");       
               $data['time'] =   $this->model->getlast_useronline();    
            }
            else{
                $data['result'] = '';
                $data['time'] = 0;
            }

            foreach ($data['result_full'] as $key => $value) {
                $data['result'][$value->created.'__'.$value->sid]=$value;
            }
            foreach ($data['servers'] as $key => $value) {
                if($value->id==15 || $value->id==16)
                    unset($data['servers'][$key]);
            }
            $this->template->write('title','Nạp tiền'.' | '.getSiteName());
            $this->template->write_view('content','FRONTEND/useronline', $data);
            $this->template->render();        
        }

        else{
            $this->secutity_gt();
        }
    }

    function useronlineAjax(){
        
        if(isset($_POST['server']))
        {
            $server_id = addslashes( trim( $_POST['server'] ) );
            //pr($server_id,1);
            $config['total_rows'] = $this->model->getTotal_useronline();
            //pr($config['total_rows'] ,1);
            $config['per_page'] = 144;
            $start=$this->input->post('page');
            $data['pageLink']=pagination($config['total_rows'], $start, $config['per_page']);
            //pr($data['pageLink'],1);
            $start==0?$start=0:$start = $start-1;
            $data['result']= $this->model->list_useronline($config['per_page'], $start);
            //pr(last_query(),1);
            //pr($data['result'],1);
            //pr(last_query(),1);
            if($_POST['server'] ==0 )
                $data['servers'] = $this->model->fetch('*', PREFIX . "servers");
            else
                $data['servers'] = $this->model->fetch('*', PREFIX . "servers", "id = {$_POST['server']}");
            $data['time'] = $this->model->getGroupBy_useronline($config['per_page'], $start);
            
            //pr($data['servers']);
            //pr($data['time'],1);
            
            echo $this->load->view("FRONTEND/useronline_ajaxnew", $data);
        }
        
    }

    function useronlineAjax2(){
        $server_id = addslashes( trim( $_POST['server'] ) );

        if($server_id==0){
            $server = $this->model->fetch('*', PREFIX . "servers");
            //pr(($server),1);            
            $merge = array();

            for ($i=0; $i <count($server) ; $i++) {             
                    $tmp='';
                    $params = array(
                    'serviceUser'=> SERVICE_USER_NAP_TIEN,
                    'servicePass'=> SERVICE_PASS_NAP_TIEN
                    );
                    $tmp = strip_tags(post($url, $params));
                    $tmp = json_decode($tmp);
                    $rs[$i] = NULL;
                     // pr($rs[$i]);
                     // pr($server,1);
                    if($server[$i]->merge){
                        if(!empty($tmp[0])){
                            if(array_key_exists($server[$i]->merge, $merge)){
                                $rs[$merge[$server[$i]->merge]]->name[] = $server[$i]->name;
                            }
                            else{
                                $merge[$server[$i]->merge] = $i;
                                $tmp[0]->name[] = $server[$i]->name;
                                $rs[$i] = $tmp[0];
                            }
                        }
                            
                    }
                    else{
                        if(!empty($tmp[0])){
                            $tmp[0]->name[] = $server[$i]->name;
                            $rs[$i] = $tmp[0];                                                   
                        }
                    }
                     //pr($tmp,1);
                     //pr($rs,1);                      
        }
        }            
        else
        {
                $server = $this->model->get('*', PREFIX.'servers', "id = $server_id");
                $fieldGame = array(
                    'serviceUser'   =>  SERVICE_USER_NAP_TIEN,
                    'servicePass'   =>  SERVICE_PASS_NAP_TIEN
                );
                $result = post($url, $fieldGame);
                echo $result;
        }
    }



   
    function blockAccount(){

        $data['server'] = $this->model->fetch('*', PREFIX . "servers");

        $this->template->write('title','Nạp tiền'.' | '.getSiteName());
        $this->template->write_view('content','FRONTEND/blockAccount', $data);
        $this->template->render();
    }
    function blockAccountAjax(){
        $server_id = addslashes( trim( $_POST['server'] ) );
        $name = addslashes( trim( $_POST['name'] ) );
        $status = addslashes( trim( $_POST['status'] ) );
        $params = array(
            'serviceUser'=> SERVICE_USER_NAP_TIEN,
            'servicePass'=> SERVICE_PASS_NAP_TIEN,
            'LoginName'=> $name,
            'status' => $status
        );
        // pr($params);

        $server = $this->model->get('*', PREFIX.'servers', "id = $server_id");
        //pr($server,1);
        $url_service = $server->ip . ":".$server->port_service."/";
        //pr($url_service,1);
        $url = $url_service."WebService.asmx/BlockAccount";
        //pr(post($url, $params),1);
        $response = trim(strip_tags(post($url, $params)) );
        //pr($response,1);
        if($response != $status)
        {
             echo "0";
        }
        else
        {
            echo "1";
        }
    }
    


    function thongbaogame(){
        $data['thongbao'] = $this->model->get('*', PREFIX . "inform", "`slug` = 'inform'");
        //pr($data,1);
        $this->template->write('title','Nạp tiền'.' | '.getSiteName());
        $this->template->write_view('content','FRONTEND/thongbaogame', $data);
        $this->template->render();
    }
    function thongbaogameAjax(){
        //pr($_POST,1);
        if(isset($_POST['status']) && $_POST['status'] =='on')
            $status = 1;
        else
            $status = 0;

        $thongbao = addslashes( trim( $_POST['thongbao'] ) );

        $data = array(
                'status'=> $status,
                'content'=> $thongbao,
                'created'=> date('Y-m-d H:i:s')
            );
        //pr($data,1);
            
        $this->db->where('slug','inform');
        if($this->db->update(PREFIX . "inform",$data)){
            echo "success";
        }
        else
            echo "false";
        
    }
    function optionplaygame(){
        $data['servers']= $this->model->fetch('*', PREFIX . "servers");
        $this->template->write_view('content','FRONTEND/optionplaygame',$data);
        $this->template->render();
    }

    function ajax_playgame(){
        if($_GET['server']){
            $server = $this->model->get('*', PREFIX.'servers', "`id` = '{$_GET['server']}' AND status = 1");
            //pr($server,1);
            $user = $this->model->get('*', PREFIX.'web_users', "`username` = '{$_GET['username']}' AND status = 1 ");

            $this->load->model('servers/servers_model');
            $gamename = $this->servers_model->create_gamename($user);

            // pr($gamename,1);

            $uname = rawurlencode(base64_encode(strtolower($gamename)));

            $upass = rawurlencode(base64_encode(strtolower('mathienky.com'))); //define default password

            // pr($gamename2,1);

            $server->sub_folder = $server->sub_folder ? $server->sub_folder : '/1';

            if($_GET['port']){
                $portgame = $_GET['port'];
            }else{
                $portgame = $server->port_game;

            }


            $url = "http://".$server->ip.":".$portgame.$server->sub_folder."?username={$uname}&password={$upass}&server_id={$server->id}";
            $data = array(
                'url'       =>  $url,
                'server'    =>  $server,
                'title'     =>  $server->name . " | " .getSiteName(),
                //'check'       =>  $check
            );
             $this->load->view('FRONTEND/playgame',$data);
        }
    }

   
    public  function UserOnlineJob(){
        $servers = $this->model->fetch('*', PREFIX.'servers', "");
        if($servers)
        {
            $now =  date('Y-m-d H:i:s', time());
            foreach ($servers as $server) {
                //pr($server);
                $fieldGame = array(
                    'serviceUser'   =>  SERVICE_USER_NAP_TIEN,
                    'servicePass'   =>  SERVICE_PASS_NAP_TIEN
                );
                //pr(post($url, $fieldGame));
                $tmp = strip_tags(post($url, $fieldGame));
                $tmp = json_decode($tmp);
                if(is_numeric($tmp))
                {
                    $total = $tmp;
                }
                else
                {
                    $total = -1;
                }
               
                $data = array(
                        'sid' => $server->id,
                        'total'  => $total,
                        'created' => $now
                );
                $this->db->insert("cli_log_useronlinejob", $data);
            }            
            
        }            
    }

    public  function UserOnlineJob_Now(){
        $servers = $this->model->fetch('*', PREFIX.'servers', "");
        if($servers)
        {
            $now =  date('Y-m-d H:i:s', time());
            foreach ($servers as $server) {
                //pr($server);
                $fieldGame = array(
                    'serviceUser'   =>  SERVICE_USER_NAP_TIEN,
                    'servicePass'   =>  SERVICE_PASS_NAP_TIEN
                );
                //pr(post($url, $fieldGame));
                $tmp = strip_tags(post($url, $fieldGame));
                $tmp = json_decode($tmp);
                if(is_numeric($tmp))
                {
                    $total = $tmp;
                }
                else
                {
                    $total = -1;
                }
               
                $data = array(
                        'sid' => $server->id,
                        'total'  => $total,
                        'created' => $now
                );
                $this->db->insert("cli_log_useronlinejob_now", $data);
            }            
            
        }            
    }


    function paginationUser(){
        $config['total_rows'] = $this->model->getTotal($type);
        $config['per_page'] = 10;
        $start=$this->input->get('p');
        $data['pageLink']=pagination($config['total_rows'], $start, $config['per_page']);
        $data['result']= $this->model->listDetail($config['per_page'], $start,$type);
    }

    function saveChangeEveryDay(){
        //pr($_POST);
        $arrI = $this->input->post('itemId');
        $arrQ = $this->input->post('itemQuantity');
        $moneyChangeEveryDay = $this->input->post("moneyChangeEveryDay");
        $onoffChangeEveryDay = $this->input->post("onoffChangeEveryDay");

        $list_item = json_encode(array('id'=>$arrI,'quantity'=>$arrQ));
        //pr($list_item,1);
        $getItem = $this->model->get("*","admin_nqt_settings", "slug = 'ItemChangeEveryDay'");
        $getMoney = $this->model->get("*","admin_nqt_settings", "slug = 'moneyChangeEveryDay'");
        $getOnOff = $this->model->get("*","admin_nqt_settings", "slug = 'onoffChangeEveryDay'");
        //pr($getDataItem);
        //pr($getMoney);
        //pr($getOnOff,1);
        if($getItem){
            $dt = array('content' =>  $list_item);
            $this->db->where("id", $getItem->id);
            $this->db->update("admin_nqt_settings", $dt);
        }

        if($getMoney){
            $dt = array('content' =>  $moneyChangeEveryDay);
            $this->db->where("id", $getMoney->id);
            $this->db->update("admin_nqt_settings", $dt);
        }

        if($getOnOff){
            $dt = array('content' =>  $onoffChangeEveryDay);
            $this->db->where("id", $getOnOff->id);
            $this->db->update("admin_nqt_settings", $dt);
        }
        echo "Cập nhật thành công";
    }   
    /*------------------------------------ End FRONTEND --------------------------------*/
}