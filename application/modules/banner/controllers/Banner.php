<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banner extends MX_Controller {

	private $module = 'banner';
	private $table = 'banner';
	function __construct(){
		parent::__construct();
		$this->load->model($this->module.'_model','model');
		$this->load->model('admincp_modules/admincp_modules_model');
		if($this->uri->segment(1)=='admincp'){
			if($this->uri->segment(2)!='login'){
				if(!$this->session->userdata('userInfo')){
					header('Location: '.PATH_URL.'admincp/login');
					return false;
				}
				$get_module = $this->admincp_modules_model->check_modules($this->uri->segment(2));
				$this->session->set_userdata('ID_Module',$get_module[0]->id);
				$this->session->set_userdata('Name_Module',$get_module[0]->name);
			}
			$this->template->set_template('admin');
			$this->template->write('title','Admin Control Panel');
		}

	}
	/*------------------------------------ Admin Control Panel ------------------------------------*/
	public function admincp_index(){


		modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'r',0);
		$default_func = 'created';
		$default_sort = 'ASC';
		$data = array(
			'module'=>$this->module,
			'module_name'=>$this->session->userdata('Name_Module'),
			'default_func'=>$default_func,
			'default_sort'=>$default_sort
		);
		$this->template->write_view('content','BACKEND/index',$data);
		$this->template->render();
	}


	public function admincp_update($id=0){
		if($id==0){
			modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'w',0);
		}else{
			modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'r',0);
		}
		$result[0] = array();
		if($id!=0){
			$result = $this->model->getDetailManagement($id);
		}
		$data = array(
			'result'=>$result[0],
			'module'=>$this->module,
			'id'=>$id
		);
		//var_dump($data);
		$this->template->write_view('content','BACKEND/ajax_editContent',$data);
		$this->template->render();
	}

	public function admincp_save(){
		$perm = modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'w',1);
		if($perm=='permission-denied'){
			print $perm;
			exit;
		}
		if($_POST){
			$fileName = array();
			list($width, $height) = "";
			if(!empty($_FILES)){
				foreach ($_FILES as $key => $value) {
					$result=uploadToHost($value['tmp_name'],strtolower($value['name']),$this->module,1);
					if($result!='false'){
						$fileName[$key]=$result;
					}
				}
				
			}

			if($this->model->saveManagement($fileName)){
				print 'success';
				exit;
			}
		}
	}

	public function admincp_delete(){
		$perm = modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'d',1);
		if($perm=='permission-denied'){
			print $perm;
			exit;
		}
		if($this->input->post('id')){
			$id = $this->input->post('id');
			$result = $this->model->getDetailManagement($id);
			modules::run('admincp/saveLog',$this->module,$id,'Delete','Delete');
			$this->db->where('id',$id);
			if($this->db->delete(PREFIX.$this->table)){
				//Xóa hình khi Delete
				@unlink('static/uploads/'.$this->module.'/'.$result[0]->image);
				return true;
			}
		}
	}

	public function admincp_ajaxLoadContent(){
		$this->load->library('AdminPagination');
		$config['total_rows'] = $this->model->getTotalsearchContent();
		$config['per_page'] = $this->input->post('per_page');
		$config['num_links'] = 3;
		$config['func_ajax'] = 'searchContent';
		$config['start'] = $this->input->post('start');
		$this->adminpagination->initialize($config);

		$result = $this->model->getsearchContent($config['per_page'],$this->input->post('start'));
		$data = array(
			'result'=>$result,
			'per_page'=>$this->input->post('per_page'),
			'start'=>$this->input->post('start'),
			'module'=>$this->module
		);

		$first_access = $this->input->post("first_access");
		//pr($first_access,1);
		if(!empty($first_access)){
			$data['first_access'] = 1;
		}

		$this->session->set_userdata('start',$this->input->post('start'));
		$this->load->view('BACKEND/ajax_loadContent',$data);
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
	/*------------------------------------ End Admin Control Panel --------------------------------*/

	function index(){
		$data['banner'] = $this->model->get('*', PREFIX.'banner', "status = 1 ",'start_date','desc');
		return $this->load->view('FRONTEND/index',$data);
	}
	function show_calendar(){
		$this->input->post('month') ? $cMonth = $this->input->post('month') : $cMonth = date("m");
		$this->input->post('year') ? $cYear = $this->input->post('year') : $cYear = date("Y");
		$sql = "SELECT * FROM `cli_content` WHERE `day_event` LIKE '".$cYear."-".$cMonth."-%' AND type = 4";
		$result['data'] = $this->db->query($sql)->result();
		$result['cMonth'] = $cMonth; $result['cYear'] = $cYear;
		$this->load->view('FRONTEND/show_calendar', $result);
	}
	function show_event(){
		if($this->input->post('eday')){
			$eday = $this->input->post('eday');
			$this->db->where('type',1)->where('day_event', $eday)->limit(1);
			$result = $this->db->get('cli_content');
		}
		else{
			$eday = date('Y-m-d');
			$this->db->where('day_event >', $eday)->limit(1);
			$result = $this->db->get('cli_content');
			if($result->num_rows()<=0){
				$this->db->where('type',1)->where('day_event <=', $eday)->where(array('status'=>1))->order_by('day_event',"DESC")->limit(1);
				$result = $this->db->get('cli_content');
			}
		}
		if($result->num_rows()>0){
			echo '<table><thead>
                 	<tr><th class="c_month">TH.'.date('m',strtotime($result->row()->day_event)).'
					</th><th class="c_title"><a href="'.PATH_URL.'su-kien/'.$result->row()->slug.'">'.CutText($result->row()->title,30).'</a></th></tr>
                </thead><tbody><tr><td class="c_day">'.date('d',strtotime($result->row()->day_event)).'</td>
                <td class="c_event"><p>'.CutText($result->row()->description,80).'</p></td></tr></tbody></table>';
		}
	}
}