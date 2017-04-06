<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mobile_card extends MX_Controller {

	private $module = 'mobile_card';

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
		$result = $this->model->fetch('*','cli_congthanhtoan');
		$data = array(
			'module'       =>$this->module,
			'module_name'  =>$this->session->userdata('Name_Module'),
			'default_func' =>$default_func,
			'default_sort' =>$default_sort,
			'result'       => $result
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
			//Upload Image
			$fileName = array('image'=>'');
			if($_FILES){
				foreach($fileName as $k=>$v){
					if(isset($_FILES['fileAdmincp']['error'][$k])){
						$typeFileImage = strtolower(substr($_FILES['fileAdmincp']['type'][$k],0,5));
						if($typeFileImage == 'image'){
							$tmp_name[$k] = $_FILES['fileAdmincp']["tmp_name"][$k];
							$file_name[$k] = $_FILES['fileAdmincp']['name'][$k];
							$ext = strtolower(substr($file_name[$k], -4, 4));
							if($ext=='jpeg'){
								$fileName[$k] = time().'_'.SEO(substr($file_name[$k],0,-5)).'.jpg';
							}else{
								$fileName[$k] = time().'_'.SEO(substr($file_name[$k],0,-4)).$ext;
							}
							$fileName[$k] ='static/uploads/game/'.$fileName[$k];
						}else{
							print 'Only upload Image.';
							exit;
						}
					}
				}
			}
			//End Upload Image

			if($this->model->saveManagement($fileName)){
				//Upload Image
				if($_FILES){
					foreach($fileName as $k=>$v){
						if(isset($_FILES['fileAdmincp']['error'][$k])){
							$upload_path = 'static/uploads/game/';
							move_uploaded_file($tmp_name[$k], $fileName[$k]);
						}
					}
				}
				//End Upload Image
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
				@unlink(BASEFOLDER.$result[0]->image);
				return true;
			}
		}
	}

	public function admincp_ajaxLoadContent(){
		$this->load->library('AdminPagination');
		$config['per_page'] = $this->input->post('per_page');
		$config['num_links'] = 3;
		$config['func_ajax'] = 'searchContent';
		$config['start'] = $this->input->post('start');
		$this->adminpagination->initialize($config);

		$data = array(
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
	

	/*------------------------------------ FRONTEND ------------------------------------*/
	function updatePay(){
		$id = $this->input->post('id');
		$checkid = $this->model->get("*", "cli_congthanhtoan", "id = $id");
		if($checkid){
			if($this->db->set('status', 0)->update('cli_congthanhtoan')){
				if($this->db->set('status', 1)->where('id', $id)->update('cli_congthanhtoan')){
					modules::run('admincp/saveLog',$this->module,$id,'Update','Update', $checkid->status, 1);
					echo 1; die;
				}
			}
		}
		echo 0;
	}

	function api_updatePay(){
		$id = $this->input->post('id');
		if(!empty($id)){
			$checkid = $this->model->get("*", "cli_congthanhtoan", "id = $id");
			if($checkid){
				if($this->db->set('status', 0)->update('cli_congthanhtoan')){
					if($this->db->set('status', 1)->where('id', $id)->update('cli_congthanhtoan')){
						$this->model->saveLog('admincp/saveLog',$this->module,$id,'Update By Payment','Update By Payment', $checkid->status, 1);
						echo 1; die;
					}
				}
			}
		}
		echo 0;
	}

	function api_getPay(){
		$checkid = $this->model->get("*", "cli_congthanhtoan", "status = 1");
		if($checkid){
			echo $checkid->id; 
		}
		else{
			echo 0;
		}
	}
	
	/*------------------------------------ End FRONTEND --------------------------------*/
}
