<?php
class User_model extends MY_Model{
    private $module = 'user';
    private $table = 'web_users';
    private $game_table = 'game_users';
    private $retval = array(
                        'status'    =>  0,
                        'msg'       =>  ''
                        );
    public $USERNAME_MIN_LENGTH = 6;
    public $USERNAME_MAX_LENGTH = 50;
    public $PASSWORD_MIN_LENGTH = 6;
    public $PASSWORD_MAX_LENGTH = 32;
    function getsearchContent( $limit, $page ){
        $this->db->select( '*' );
        $this->db->limit( $limit, $page );
        $this->db->order_by( $this->input->post( 'func_order_by' ), $this->input->post( 'order_by' ) );
        if ( $this->input->post( 'content' ) != '' && $this->input->post( 'content' ) != 'type here...' ) {
            $this->db->where( '(`username` LIKE "%' . $this->input->post( 'content' ) . '%" OR `email` LIKE "%' . $this->input->post( 'content' ) . '%" OR `id` LIKE "%'.$this->input->post('content') . '%")' );
        }
        if ( $this->input->post( 'dateFrom' ) != '' && $this->input->post( 'dateTo' ) == '' ) {
            $this->db->where( 'created >= "' . date( 'Y-m-d 00:00:00', strtotime( $this->input->post( 'dateFrom' ) ) ) . '"' );
        }
        if ( $this->input->post( 'dateFrom' ) == '' && $this->input->post( 'dateTo' ) != '' ) {
            $this->db->where( 'created <= "' . date( 'Y-m-d 23:59:59', strtotime( $this->input->post( 'dateTo' ) ) ) . '"' );
        }
        if ( $this->input->post( 'dateFrom' ) != '' && $this->input->post( 'dateTo' ) != '' ) {
            $this->db->where( 'created >= "' . date( 'Y-m-d 00:00:00', strtotime( $this->input->post( 'dateFrom' ) ) ) . '"' );
            $this->db->where( 'created <= "' . date( 'Y-m-d 23:59:59', strtotime( $this->input->post( 'dateTo' ) ) ) . '"' );
        }
        $this->db->from('cli_web_users');
        $query = $this->db->get();
        if ( $query->result() ) {
            return $query->result();
        } else {
            return false;
        }
    }
    function getTotalsearchContent(){
        $this->db->select( '*' );
        if ( $this->input->post( 'content' ) != '' && $this->input->post( 'content' ) != 'type here...' ) {
            $this->db->where( '(`username` LIKE "%' . $this->input->post( 'content' ) . '%" OR `email` LIKE "%' . $this->input->post( 'content' ) . '%" OR `id` LIKE "%'.$this->input->post('content') . '%")' );
        }
        if ( $this->input->post( 'dateFrom' ) != '' && $this->input->post( 'dateTo' ) == '' ) {
            $this->db->where( 'created >= "' . date( 'Y-m-d 00:00:00', strtotime( $this->input->post( 'dateFrom' ) ) ) . '"' );
        }
        if ( $this->input->post( 'dateFrom' ) == '' && $this->input->post( 'dateTo' ) != '' ) {
            $this->db->where( 'created <= "' . date( 'Y-m-d 23:59:59', strtotime( $this->input->post( 'dateTo' ) ) ) . '"' );
        }
        if ( $this->input->post( 'dateFrom' ) != '' && $this->input->post( 'dateTo' ) != '' ) {
            $this->db->where( 'created >= "' . date( 'Y-m-d 00:00:00', strtotime( $this->input->post( 'dateFrom' ) ) ) . '"' );
            $this->db->where( 'created <= "' . date( 'Y-m-d 23:59:59', strtotime( $this->input->post( 'dateTo' ) ) ) . '"' );
        }
        $this->db->from('cli_web_users');
        $query = $this->db->get();
        if ( $query->result() ) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }
    function saveManagement( $fileName = '' ){
        if ( $this->input->post( 'statusAdmincp' ) == 'on' ) {
            $status = 1;
        } else {
            $status = 0;
        }
        if ( $this->input->post( 'hiddenIdAdmincp' ) == '' ) {
            //Kiểm tra đã tồn tại chưa?
            $checkData = $this->checkData( 'username', $this->input->post( 'hiddenIdAdmincp' ) );
            if ( $checkData ) {
                print 'error-name-exists';
                exit;
            }
            $checkEmail = $this->checkData( 'email', $this->input->post( 'emailAdmincp' ) );
            if ( $checkEmail ) {
                print 'error-email-exists';
                exit;
            }
            $data = array(
                'email'    => $this->input->post( 'emailAdmincp' ),
                'fullname' => $this->input->post( 'fullnameAdmincp' ),
                'gender'   => $this->input->post( 'genderAdmincp' ),
                'phone'    => $this->input->post( 'phoneAdmincp' ),
                'address'  => $this->input->post( 'addressAdmincp' ),
                'idnumber' => $this->input->post( 'idnumberAdmincp' ),
                'status'   => $status
            );
            if ( $this->db->insert( PREFIX . $this->table, $data ) ) {
                modules::run( 'admincp/saveLog', $this->module, $this->db->insert_id(), 'Add new', 'Add new' );
                return true;
            }
        } else {
            $result = $this->getDetailManagement( $this->input->post( 'hiddenIdAdmincp' ) );
            if ( $result->username != $this->input->post( 'hiddenIdAdmincp' ) ) {
                $checkData = $this->checkData( 'username', $this->input->post( 'hiddenIdAdmincp' ) );
                if ( $checkData ) {
                    print 'error-name-exists';
                    exit;
                }
            }
            if ( $result->email != $this->input->post( 'emailAdmincp' ) ) {
                $checkData = $this->checkData( 'email', $this->input->post( 'emailAdmincp' ) );
                if ( $checkData ) {
                    print 'error-email-exists';
                    exit;
                }
            }
            //update data
            $data_email = array(
                'email'    => $this->input->post( 'emailAdmincp' )
            );
            $data_user = array(
                'fullname' => $this->input->post( 'fullnameAdmincp' ),
                'birthday' => $this->input->post( 'birthdayAdmincp' ),
                'job' => $this->input->post( 'jobAdmincp' ),
                'marry' => $this->input->post( 'marryAdmincp' ),
                'gender'   => $this->input->post( 'genderAdmincp' ),
                'phone'    => $this->input->post( 'phoneAdmincp' ),
                'address'  => $this->input->post( 'addressAdmincp' ),
                'cmnd' => $this->input->post( 'cmndAdmincp' ),
                'province' => $this->input->post( 'provinceAdmincp' ),
            );
            // pr($result,1);
            modules::run( 'admincp/saveLog', $this->module, $result->id , '', 'Update Email User', array($result), $data_email);
            modules::run( 'admincp/saveLog', $this->module, $result->id , '', 'Update User Info', array($result), $data_user);
            $this->db->where( 'username', $this->input->post( 'hiddenIdAdmincp' ) );
            if ( $this->db->update( PREFIX . $this->table, $data_email ) ) {
                $this->db->where('id',$result->id); //update cai user profile
                $this->db->update(PREFIX.'user_profiles',$data_user);
                return true;
            }
        }
        return false;
    }
    function getDetailManagement( $username = '' ) {
        $this->db->select( '*' );
        $this->db->from(PREFIX . $this->table);
        $this->db->join('cli_user_profiles', 'cli_web_users.id = cli_user_profiles.uid');
        $this->db->where( 'username', $username );
        $query = $this->db->get();
        if ( $query->row() ) {
            return $query->row();
        } else {
            return false;
        }
    }
    function checkData( $field, $value )
    {
        $this->db->select( '*' );
        $this->db->where( $field, $value );
        $query = $this->db->get( PREFIX . $this->table );
        if ( $query->num_rows() ) {
            return true;
        } else {
            return false;
        }
    }
        //Cai hien tai ma gioi dang lam
    function reset_password($user, $new_password = '') {
        // pr($user->salt,1)
        $this->db->set('password', $this->createPassword($new_password, $user->salt))->where('username', $user->username);
        return $this->db->update('cli_web_users');

        // return 1;
    }

    /*--------------------END FRONTEND--------------------*/

    function getprovince(){
        $this->db->order_by('order','asc');
        return $this->db->get(PREFIX.'province')->result();
    }
    // THẢO VIẾT TỪ ĐÂY.
    function createSalt(){
        return uniqid(rand());
    }
    function createPassword($password, $salt=''){
        return md5(sha1($password).$salt);
    }
    function loginUser($data){
        $username = addslashes($data['username']); $password = addslashes($data['password']);
        if(!trim(strtolower($username))){
            $this->retval['msg'] = 'Vui lòng nhập tên tài khoản';
            return json_encode($this->retval); exit();
        }
        if(!trim(strtolower($password))){
            $this->retval['msg'] = 'Vui lòng nhập mật khẩu';
            return json_encode($this->retval); exit();
        }
        $user = $this->model->get('id, username, password, salt, status','cli_web_users',"`username` = '{$username}'");
        if(!$user){
            $this->retval['msg'] = 'Tài khoản không tồn tại';
            return json_encode($this->retval); exit();
        }
        if($user->status != 1){
            $this->retval['msg'] = 'Tài khoản của bạn đã bị khóa';
            return json_encode($this->retval); exit();
        }
        /*Ban IP*/
        if( ban_ip() ){
            $this->retval['msg'] = 'Địa chỉ IP trên máy của bạn đã bị ban, vui lòng liên hệ admin !';
            return json_encode($this->retval); exit();   
        }
        
        if($this->createPassword($password,$user->salt) !=   $user->password){
            $this->retval['msg'] = 'Mật khẩu của bạn không khớp';
            return json_encode($this->retval); exit();
        }
        if($this->session->userdata('redirect')) $this->retval['redirect'] = $this->session->userdata('redirect');
        else $this->retval['redirect'] = "";
        $this->retval['status'] = 1;
        $this->retval['msg'] = 'Đăng nhập thành công';

        if(0){
            $time = time();
            $start = date("Y-m-d 00:00:00", $time);
            $end = date("Y-m-d 23:59:59", $time);
            $check = $this->model->get("*", "cli_lathinh_everyday", "created >=  '$start' AND created <= '$end' AND username = '$user->username'");
            if (empty($check)) {
                $dt_in = array('uid' => $user->id, 'username' => $username, 'count' => 5, 'created' => date("Y-m-d H:i:s", time()));
                $this->db->insert("cli_lathinh_user", $dt_in);
                $dt_everyday = array('username' => $username, 'count' => 5, 'created' => date("Y-m-d H:i:s", time()));
                $this->db->insert("cli_lathinh_everyday", $dt_everyday);
            }
        }
        if(0){
            //Add bua cho event dap trung
            $check_con = modules::run('daptrung_config/check_event');
            if( $check_con ){
                $this->load->model('daptrung/daptrung_model');
                $this->daptrung_model->addCountToday($user);
            }
        }
        

        $this->session->set_userdata('username',$user->username);
        $this->session->set_userdata('uid',$user->id);
        $this->session->set_userdata('first_login',1);
        return json_encode($this->retval);
    }
    // VALIDATE USER.
    function getUser($username, $by_email = FALSE){
        $username = trim(strtolower($username));
        $where = "WHERE `cli_web_users`.`username` = '{$username}' LIMIT 1";
        if($by_email) $where = "WHERE `cli_web_users`.`email` = '{$username}' LIMIT 1";
        $sql ="SELECT `cli_user_profiles`.*, `cli_web_users`.* FROM (`cli_web_users`) LEFT JOIN `cli_user_profiles` ON `cli_user_profiles`.`uid` = `cli_web_users`.`id`" .$where;
        $query = $this->db->query($sql);
        if($query->row()){
            return $query->row();
        }else{
            return false;
        }
    }
    function validateUser($username){
        $username = trim(strtolower($username));
        $length = strlen($username);
        if( $length < $this->USERNAME_MIN_LENGTH || $length > $this->USERNAME_MAX_LENGTH)
            return "Tên tài khoản phải từ {$this->USERNAME_MIN_LENGTH}-{$this->USERNAME_MAX_LENGTH} ký tự";
        if(!preg_match('/^[a-z0-9@._]+$/', $username))
            return "Tên tài khoản không được chứa ký tự đặc biệt";
        $user = $this->getUser($username);
        if($user) return "Tài khoản đã tồn tại";
        return false;
    }
    function validateEmail($email){
        $email = trim(strtolower($email));
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            return "Địa chỉ mail không hợp lệ";
        $user = $this->getUser($email, TRUE);
        if($user) return "Email đã tồn tại";
        return false;
    }
    function validatePassword($password){
        $length = strlen($password);
        if( $length < $this->PASSWORD_MIN_LENGTH || $length > $this->PASSWORD_MAX_LENGTH)
            return "Mật khẩu phải từ {$this->PASSWORD_MIN_LENGTH}-{$this->PASSWORD_MAX_LENGTH} ký tự";
        return false;
    }
    function validateNumberic($number){
        if(is_numeric($number)){
            if(strlen($number) >= 9 && strlen($number) <= 13) return 1;
            else return 0;
        }
        else return 0;
    }
    // END VALIDATE & BEGIN REGISTER.
    function updateInfoUser($data){
        $username = $this->session->userdata('username');
        $phone = addslashes( $data['phone'] ); $cmnd = addslashes( $data['cmnd'] );
        if(substr($phone,0,2) == '84') $phone = substr_replace($phone,'0',0,2);
        if(substr($phone,0,3) == '084') $phone = substr_replace($phone,'0',0,3);
        if($cmnd && !$this->validateNumberic($cmnd)){
            $this->retval['msg'] = "Định dạng số chứng minh không chính xác";
            return json_encode($this->retval);
        }
        if($phone && !$this->validateNumberic($phone)){
            $this->retval['msg'] = "Định dạng số điện thoại không chính xác";
            return json_encode($this->retval);
        }
        $data['phone'] = $phone;
        $uid = $this->getUser($username)->id;
        $this->db->where('uid',$uid)->limit(1);
        $query = $this->db->get('cli_user_profiles');
        $row = $query->num_rows();
        if($row){
            if(!empty($query->row()->cmnd) || $query->row()->cmnd != ""){
                unset($data['cmnd']); unset($data['ngaycap_cmnd']);
                unset($data['noicap_cmnd']);
            }
            $this->db->where('uid', $uid);
            $this->db->update('cli_user_profiles', $data);
            $this->retval['status'] = 1;
            $this->retval['msg'] = "Cập nhật tài khoản thành công";
        }
        else{
            $data['uid'] = $uid;
            if($this->db->insert('cli_user_profiles', $data)){
                $this->retval['status'] = 1;
                $this->retval['msg'] = "Cập nhật tài khoản thành công";
            }
        }
        return json_encode($this->retval);
    }
    function changPasswordUser($data){
        $username = addslashes($this->session->userdata('username'));
        $data['password_new'] = addslashes($data['password_new']);
        $data['re_password'] = addslashes($data['re_password']);
        $data['password_old'] = addslashes($data['password_old']);
        $data['email'] = addslashes($data['email']);
        if($data['password_new'] != $data['re_password']){
            $this->retval['msg'] = "Nhập lại mật khẩu không khớp";
            return json_encode($this->retval);
        }
        if($this->validatePassword($data['password_new'])){
            $this->retval['msg'] = $this->validatePassword($data['password_new']);
            return json_encode($this->retval);
        }
        $user = $this->getUser($username);
        if($data['email'] != $user->email){
            $this->retval['msg'] = "Email đăng ký không chính xác";
            return json_encode($this->retval);
        }
        if($user->password != $this->createPassword($data['password_old'], $user->salt)){
            $this->retval['msg'] = "Mật khẩu cũ không chính xác";
            return json_encode($this->retval);
        }
        $this->db->set('password', $this->createPassword($data['password_new'], $user->salt))->where('id', $user->id);
        $this->db->update('cli_web_users');
        $this->retval['status'] = 1;
        $this->retval['msg'] = "Đổi mật khẩu thành công";
        return json_encode($this->retval);
    }
    // REGISTER AND SEND MAIL GIFTCODE.
    function registerUser( $data ){
        $utm_medium = isset($_COOKIE['utm_medium']) ? $_COOKIE['utm_medium']: $this->session->userdata('utm_medium');
        $utm_source = isset($_COOKIE['utm_source']) ? $_COOKIE['utm_source']: $this->session->userdata('utm_source');
        $reference  = $this->session->userdata('reference');
        $password           = addslashes( $data['password'] );
        $email              = addslashes( trim(strtolower($data['email'])) );
        $username           = addslashes( trim(strtolower($data['username'])) );

        $phone = 0919111001;
        if(isset($data['phone'])){
            $phone = addslashes( $data['phone'] );
            if(substr($phone,0,2) == '84') $phone = substr_replace($phone,'0',0,2);
            if(substr($phone,0,3) == '084') $phone = substr_replace($phone,'0',0,3);
        }
        /*Ban IP*/
        if( ban_ip() ){
            $this->retval['msg'] = 'Địa chỉ IP trên máy của bạn đã bị ban, vui lòng liên hệ admin !';
            return json_encode($this->retval); exit();   
        }
        
        if($this->validateUser($username)){
            $this->retval['msg'] = $this->validateUser($username);
            return json_encode($this->retval);
        }
        if($this->validateEmail($email)){
            $this->retval['msg'] = $this->validateEmail($email);
            return json_encode($this->retval);
        }
        if($this->validatePassword($password)){
            $this->retval['msg'] = $this->validatePassword($password );
            return json_encode($this->retval);
        }
        if($phone && !$this->validateNumberic($phone)){
            $this->retval['msg'] = "Định dạng số điện thoại không chính xác";
            return json_encode($this->retval);
        }
        $salt =  $this->createSalt();
        $dataIns = array(
            'username'     =>   $username,
            'salt'         =>   $salt,
            'password'     =>   $this->createPassword($password, $salt),
            'email'        =>   strtolower($email),
            'registerip'   =>   getIP(),
            'utm_source'   =>   $utm_source,
            'utm_medium'   =>   $utm_medium,
            'utm_campaign' =>   date('Y_m'),
            'referer'      =>   strtolower($reference),
            'regdate'      =>   time(),
            'created'      => date( 'Y-m-d H:i:s')
        );
        if($this->db->insert(PREFIX.$this->table, $dataIns)){
            $uid = $this->db->insert_id();
            
            if (0){
                $dt_in = array('username' => $username, 'count' => '10', 'created' => date("Y-m-d H:i:s", time()));
                $this->db->insert("cli_lathinh_user", $dt_in);
            }

            
            //add bua cho event dap trung
            if(0){
                $check_con = modules::run('daptrung_config/check_event');
                if( $check_con ){ //chua den thoi diem thi van cho add bua
                    $dt_bua = array('user_id'=>$uid,'username' => $username, 'count' => 10, 'message'=>'Add 10 búa tài khoản đăng ký lần đầu','created' => date("Y-m-d H:i:s", time()));
                    $this->db->insert(PREFIX.'daptrung_count',$dt_bua);
                }
            }

            $data_profile = array(
                                'uid'      => $uid,
                                'phone'    => $phone,
                            );
            $this->db->insert('cli_user_profiles', $data_profile);
            // CALL FUNCTION SEND MAIL
            
            // $this->sendEmailGiftCode($uid, $username, $email);

            if($this->session->userdata('redirect')) $this->retval['redirect'] = $this->session->userdata('redirect');
            else $this->retval['redirect'] = "";
            $this->retval['status'] = 1;
            $this->retval['msg'] = 'Đăng ký thành công';
            $this->session->set_userdata('username',$username);
            $this->session->set_userdata('uid',$uid);
            $this->session->set_userdata('first_login',1);
            return json_encode($this->retval);
        }
    }
    function sendEmailGiftCode($uid, $username, $email){
        $salt = $this->createSalt(); $token = md5($salt.time());
        $namesite = "Hoàng Đồ Web"; $site = "http://hoangdoweb.com/";
        $data_ins = array(
            'uid'      => $uid,
            'username' => $username,
            'email'    => $email,
            'salt'     => $salt,
            'token'    => $token,
            'status'   => 1,
            'created'  => date('Y-m-d H:i:s',time())
        );
        if($this->db->insert('cli_giftcode_email', $data_ins)){
            $id = $this->db->insert_id();
            $link = PATH_URL.'gift-code/gift-code-email/?token='.$token.'&code='.time().'&salt='.$salt.'&sign='.$id.'&active='.$uid;
            $to = $email;
            $subject = 'Nhận Giftcode '.$namesite;
            $message = 'Bạn <b>' . $username . '</b> thân mến, <br/><br/>
                Bạn nhận được email này vì bạn đã đăng ký tham gia '.$namesite.' tại website '.$site.'<br/><br/>
                Vui lòng bấm vào link sau để xác nhận tài khoản và nhận ngay Giftcode giá trị 1000KNB <br/><br/>
                Vui lòng truy cập vào đường dẫn dưới đây bằng cách chép và dán vào trình duyệt: <br/>'.$link.'<br><br/>
                Với việc xác nhận tài khoản bạn sẽ nhận được email thông báo các sự kiện mới nhất của '.$namesite.'. <br/><br/>
                Nếu bạn không muốn nhận email nữa, vui lòng bấm vào link sau để hủy bỏ email của bạn<br><br/>
                Cám ơn và chúc bạn chơi game vui vẻ. <br><br><br>
                Hello, <b>' . $username . '</b>, <br/><br/>
                You are receiving this email because you entered your address for Hoàng Đồ Web at '.$site.'.<br><br/>
                If you did indeed provide this email address and would like to continue to receive emails from '.$site.', please click on this link for confirmation. <br>'.$link. '<br><br/>
                After clicking on the confirmation link you will receive our weekly newsletter.<br><br/>
                If you did not sign up for this Newsletter or do not wish to receive it only a weekly basis, please Unsubscribe here:<br><br/>
                Thank you for your time and patronage. <br>
                ';
            $headers = 'From: '.$namesite.' Hỗ Trợ <hoangdoweb.com>'."\r\n" .
                'Reply-To:  hotro.hoangdoweb@gmail.com'."\r\n" .
                'X-Mailer: PHP/' . phpversion();
            $headers .= 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            if(mail($to, $subject, $message, $headers)) return 1;
            else return 0;
        }
    }
    function addUser($data){
        $salt                 = $this->createSalt();
        $data['salt']         = $salt;
        $data['password']      = $this->createPassword($data['email'], $salt);
        $data['registerip']   = getIP();
        $data['utm_campaign'] = date('Y_m');
        $data['regdate']      = time();
        $data['created']      = date( 'Y-m-d H:i:s');
        if($this->db->insert(PREFIX.$this->table, $data)){
            $uid = $this->db->insert_id();
            $this->session->set_userdata('username',$data['username']);
            $this->session->set_userdata('uid',$uid);
            $this->session->set_userdata('first_login',1);
        }
        return 1;
    }

    function fotgotPassword($data){
        $username = trim(strtolower($data['username']));
        $email    = trim(strtolower($data['email']));
        $username = addslashes($username);
        $email = addslashes($email);
        $domain   = PATH_URL;
        $user     = $this->getUser($username);
        if(!$user){
            $this->retval['msg'] = 'Tài khoản của bạn không tồn tại';
            return json_encode($this->retval);
        }
        if($email != $user->email){
            $this->retval['msg'] = 'Địa chỉ email không chính xác';
            return json_encode($this->retval);
        }
        $pass   = strtolower( random_string(6));
        $this->db->set('password', $this->createPassword($pass, $user->salt))->where('id', $user->id);
        $this->db->update('cli_web_users');
        $to = $email;
        $subject = 'Thông tin mật khẩu đăng nhập vào '.$domain;
        $message = 'Chào <b>' . $username . '</b> <br/> Mật khẩu đăng nhập vào '.$domain.' mới của bạn là:  <b>' . $pass . '</b>';
        $headers = 'From: Khôi phục mật khẩu ' .$domain. "\r\n" .
            'Reply-To:'.$domain. "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        $headers .= 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        if(mail($to, $subject, $message, $headers)){
            $this->retval['status'] = 1;
            $this->retval['msg']  = 'Thành công! Hãy kiểm tra hộp thư của bạn để nhận mật khẩu mới';
        }else{
            $this->retval['msg']  = 'Hệ thống đang bận .Vui lòng liên hệ admin để nhận lại mật khẩu';
        }
        return json_encode($this->retval);
    }
    function loginReredirect($url=''){
        if(!$this->session->userdata('username') && $url != ''){
            $this->session->set_userdata('redirect', $url);
            redirect(PATH_URL.'dang-nhap');
        }else if(!$this->session->userdata('username')){
            $this->session->set_userdata('redirect',$_SERVER['SERVER_NAME'].$_SERVER['REDIRECT_URL']);
            redirect(PATH_URL.'dang-nhap');
        }
    }

     function login_app_facebook( $username = "",$fid, $token = "" ){
        //->get('*','cli_web_users',array('username'=>$username,'email'=>$email));

        $this->db->where(array(
            'username' => $username,
            'token_app_facebook' => $token
        ));
        $query = $this->db->get('cli_web_users');
        $obj   = $query->row();
        if ( isset($obj->id) ) {
            // if user exists shall set session for this username
            $this->session->set_userdata('username', $obj->username);
            $this->session->set_userdata('user_id', $obj->id);
            $this->session->set_userdata('first_login', 1);
            return 1;
        } else {
            // if not found user shall register
            $time = time();
            $data['email']    = $username."@truymong.com";
            $data['username'] = $username;
            $data['password'] = $this->createPassword(substr($username, 0, 10) . "duhiepky.com");
            $data['utm_source'] = 'fbapp';
            $data['utm_campaign'] = 'fbapp';
            $data['utm_medium']= 'fbapp';
            $data['created'] = date("Y-m-d H:i:s", $time);
            $data['regdate'] = $time;
            $data['token_app_facebook']= $token;   
            $query = $this->db->insert('cli_web_users',$data);  

            $user_id=$this->db->insert_id();
            $this->session->set_userdata('username', $username);
            $this->session->set_userdata('user_id',$user_id);  
            
        }
        return 1;
    }




    function created_user_play( $username = ""){
            $obj=$this->model->get('*','cli_web_users',array('username'=>$username));
            if(isset($obj->id)){
                redirect(PATH_URL."servers/created_user_play");
            }

            $utm_source = isset($_COOKIE['utm_source']) ? $_COOKIE['utm_source']: $this->session->userdata('utm_source');
            $time = time();
            $data['email']    = $username."@dolongpk.com";
            $data['username'] = $username;
            $data['password'] = $this->createPassword($username);
            $data['salt']     = $this->createSalt();
            $data['utm_source'] = $utm_source;
            $data['utm_campaign'] = 'auto';
            $data['utm_medium']= 'auto';
            $data['created'] = date("Y-m-d H:i:s", $time);
            $data['regdate'] = $time;
            $query = $this->db->insert('cli_web_users',$data);  

            $user_id=$this->db->insert_id();
            $this->session->set_userdata('username', $username);
            $this->session->set_userdata('user_id',$user_id);  
       
        return 1;
    }




}
