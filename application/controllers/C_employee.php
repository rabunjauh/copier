<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_employee extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('m_employee');
		$this->load->model('mpabx11');
		// if ( !$this->session->userdata('username') ){
		// 	redirect(base_url(). 'login');
		// }			
	}

	public function get_employee_data(){
		$data = [];
		$config = [];
		$config['full_tag_open'] = '<ul class="pagination">';
	    $config['full_tag_close'] = '</ul>';
	    $config['num_tag_open'] = '<li>';
	    $config['num_tag_close'] = '</li>';
	    $config['cur_tag_open'] = '<li class="active"><span>';
	    $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
	    $config['prev_tag_open'] = '<li>';
	    $config['prev_tag_close'] = '</li>';
	    $config['next_tag_open'] = '<li>';
	    $config['next_tag_close'] = '</li>';
	    $config['first_link'] = '&laquo;';
	    $config['prev_link'] = '&lsaquo;';
	    $config['last_link'] = '&raquo;';
	    $config['next_link'] = '&rsaquo;';
	    $config['first_tag_open'] = '<li>';
	    $config['first_tag_close'] = '</li>';
	    $config['last_tag_open'] = '<li>';
	    $config['last_tag_close'] = '</li>';
	    $data['total_employee'] =  $this->m_employee->count_employee();
		
	    $config["base_url"] = base_url() . "c_employee/get_employee_data";
	    $config['total_rows'] = $data['total_employee'];
	    $config['per_page'] = '10';
	    $config['uri_segment'] = '3';
	    $this->pagination->initialize($config);

		$data['header'] = $this->load->view('headers/head', '', TRUE);
		// $data['menu'] = '';
		// $data['cover'] = $this->load->view('headers/cover', '', TRUE);
		// $data['navigation'] = $this->memployee->getOfficeLocations();
		$data['no'] = $this->uri->segment(3);
		$data['employees'] = $this->m_employee->employee_list($config['per_page'], $this->uri->segment(3));
		// var_dump($data['employees']);die;
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);
		$data['content'] = $this->load->view('contents/view_employee', $data);
		// $this->load->view('main', $data);
		// echo json_encode($data);
		
	}
	
	public function addEmployee(){
		if ( $this->input->post() ){
			$formInfo = [];
			$formInfo['employee_status'] = $this->input->post('selectEmployeeStatus', TRUE);
			$formInfo['office_location_id'] = $this->input->post('selectOfficeLocation', TRUE);
			$formInfo['employeeno'] = $this->input->post('txtEmployeeNo', TRUE);
			$formInfo['employeename'] = strtoupper($this->input->post('txtEmployee', TRUE));
			$formInfo['iddept'] = $this->input->post('selDepartment', TRUE);
			$formInfo['idposition'] = $this->input->post('selPosition');
			if ($this->input->post('selExtension', TRUE)){
				$formInfo['extId'] = $this->input->post('selExtension', TRUE);
			} else {
				$formInfo['ext'] = $this->input->post('textExtension', TRUE);
			}					
			if ( $this->memployee->saveEmployee($formInfo) !== 0){
				$this->mpabx11->updateExtensionStatusAdd($formInfo['extId']);
				$message = '<div class="alert alert-success">Success!</div>';
        		$this->session->set_flashdata('message', $message);
				redirect(base_url() . 'cemployee');				
			}else{
				$message = '<div class="alert alert-danger">Something wrong!</div>';
        		$this->session->set_flashdata('message', $message);
				redirect(base_url() . 'cemployee/addEmployee');
			}
		}

		$data = [];
		$data['extensions'] = $this->mpabx11->index();
		$data['departments'] = $this->memployee->department();
		$data['positions'] = $this->memployee->position();
		$data['listOfficeLocations'] = $this->memployee->getOfficeLocations();
		$data['menu'] = '';
		$data['header'] = $this->load->view('headers/head', '', TRUE);
		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['navigation'] = $this->memployee->getOfficeLocations();		
		$data['content'] = $this->load->view('forms/formAddEmployee', $data, TRUE);
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);
		$this->load->view('main', $data);
	}

	public function modifyEmployee($employeeId = NULL){
		if ( isset($_POST['btnUpdateEmployee']) ){
			$formInfo = [];
			$formInfo['office_location_id'] = $this->input->post('selectOfficeLocation');
			$formInfo['employeeno'] = $this->input->post('txtEmployeeNo');
			$formInfo['employeename'] = strtoupper($this->input->post('txtEmployeeName'));
			$formInfo['iddept'] = $this->input->post('selDepartment');
			$formInfo['idposition'] = $this->input->post('selPosition');
			$formInfo['extId'] = $this->input->post('selExtension');
			$formInfo['ext'] = $this->input->post('textExtension');
			$formInfo['txtprevid'] = $this->input->post('txtprevid');
			if ( !$this->memployee->modifyEmployee($formInfo, $employeeId) ){				
				redirect(base_url() . 'cemployee/modifyEmployee/' . $employeeId);
			} else {
				if ( !$this->memployee->employee_ext_id($formInfo['txtprevid']) > 0){
					$this->mpabx11->updateExtensionStatus0($formInfo['extId'],$formInfo['txtprevid']);	
				}else{
					$this->mpabx11->updateExtensionStatus1($formInfo['extId'],$formInfo['txtprevid']);	
				}
				
				redirect(base_url() . 'cemployee');
			}
		}

		$data = [];
		$data['extensions'] = $this->mpabx11->index();
		$data['employees'] = $this->memployee->employeeIds($employeeId);
		$data['employeeStatuses'] = $this->memployee->getEmployeeStatus();
		$data['getEmployeeByIds'] = $this->memployee->getEmployeeByIds($employeeId);
		$data['departments'] = $this->memployee->department();
		$data['positions'] = $this->memployee->position();
		// $data['getEmpoyeeStatus'] = $this->memployee->getEmployeeStatus();
		$data['header'] = $this->load->view('headers/head', '', TRUE);		
		$data['menu'] = '';
		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['navigation'] = $this->memployee->getOfficeLocations();
		$data['listOfficeLocations'] = $this->memployee->getOfficeLocations();					
		$data['content'] = $this->load->view('forms/formEditEmployee', $data, TRUE);		
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);		
		$this->load->view('main', $data);	
	}

	public function toggleEmployeeStatus($idEmployee, $status) {
		if ($this->memployee->toggleEmployeeStatus($idEmployee, $status)){
			$message = '<div class="alert alert-success">Employee status changed!</div>';
			$this->session->set_flashdata('message', $message);
			redirect(base_url() . 'cemployee');
		}
	}

	public function search($searchCategory=false, $txtSearch=false){
		$data = [];
		if ( !$searchCategory AND !$txtSearch){
			$searchCategory = $this->input->post('selCategory');
			$txtSearch = htmlspecialchars($this->input->post('txtSearch'));	
		}
		
		$config = [];
		$config['full_tag_open'] = '<ul class="pagination">';
	    $config['full_tag_close'] = '</ul>';
	    $config['num_tag_open'] = '<li>';
	    $config['num_tag_close'] = '</li>';
	    $config['cur_tag_open'] = '<li class="active"><span>';
	    $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
	    $config['prev_tag_open'] = '<li>';
	    $config['prev_tag_close'] = '</li>';
	    $config['next_tag_open'] = '<li>';
	    $config['next_tag_close'] = '</li>';
	    $config['first_link'] = '&laquo;';
	    $config['prev_link'] = '&lsaquo;';
	    $config['last_link'] = '&raquo;';
	    $config['next_link'] = '&rsaquo;';
	    $config['first_tag_open'] = '<li>';
	    $config['first_tag_close'] = '</li>';
	    $config['last_tag_open'] = '<li>';
	    $config['last_tag_close'] = '</li>';
	    $data['totalEmployee'] =  $this->memployee->countEmployeeSearch($searchCategory, urldecode($txtSearch));
	   	$config["base_url"] = base_url() . "cemployee/search/" . $searchCategory . "/" .  $txtSearch;
	    $config['total_rows'] = $data['totalEmployee'];
	    $config['per_page'] = '10';
	    $config['uri_segment'] = '5';
	    $this->pagination->initialize($config);


		$data['header'] = $this->load->view('headers/head', '', TRUE);
		$data['menu'] = '';
		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['navigation'] = $this->memployee->getOfficeLocations();
		$data['no'] = $this->uri->segment(5);
		$data['employees'] = $this->memployee->employeeListSearch($config['per_page'], $this->uri->segment(5),  $searchCategory, urldecode($txtSearch));
		$data['content'] = $this->load->view('contents/vEmployee', $data, TRUE);
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);

		$this->load->view('main', $data);
	}


	// public function deleteEmployee($idEmployee = ''){
	// 	$this->memployee->deleteEmployee($idEmployee);
	// 	redirect(base_url() . 'cemployee');
	// }

	public function department(){		
		$data = [];
		$config = [];
		$config['full_tag_open'] = '<ul class="pagination">';
	    $config['full_tag_close'] = '</ul>';
	    $config['num_tag_open'] = '<li>';
	    $config['num_tag_close'] = '</li>';
	    $config['cur_tag_open'] = '<li class="active"><span>';
	    $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
	    $config['prev_tag_open'] = '<li>';
	    $config['prev_tag_close'] = '</li>';
	    $config['next_tag_open'] = '<li>';
	    $config['next_tag_close'] = '</li>';
	    $config['first_link'] = '&laquo;';
	    $config['prev_link'] = '&lsaquo;';
	    $config['last_link'] = '&raquo;';
	    $config['next_link'] = '&rsaquo;';
	    $config['first_tag_open'] = '<li>';
	    $config['first_tag_close'] = '</li>';
	    $config['last_tag_open'] = '<li>';
	    $config['last_tag_close'] = '</li>';
	    $data['totalDepartment'] =  $this->memployee->countDepartment();
	    $config["base_url"] = base_url() . "cemployee/department";
	    $config['total_rows'] = $data['totalDepartment'];
	    $config['per_page'] = '10';
	    $config['uri_segment'] = '3';
	    $this->pagination->initialize($config);

		$data['header'] = $this->load->view('headers/head', '', TRUE);
		$data['menu'] = '';
		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['navigation'] = $this->memployee->getOfficeLocations();
		$data['departments'] = $this->memployee->departmentList($config['per_page'], $this->uri->segment(3));
		$data['content'] = $this->load->view('contents/vDepartment', $data, TRUE);
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);
		$this->load->view('main', $data);
	}

	public function addDepartment(){
		if ( $this->input->post() ){
			$formInfo = [];
			$formInfo['deptdesc'] = htmlspecialchars(strtoupper($this->input->post('txtDepartment')));
			$formInfo['group_id'] = htmlspecialchars(strtoupper($this->input->post('selectGroup')));
			$formInfo['stsactive'] = htmlspecialchars(strtoupper($this->input->post('selectStatus')));
			if ( $this->memployee->saveDepartment($formInfo) ){
				redirect(base_url() . 'cemployee/addDepartment');
			} else {
				redirect(base_url() . 'cemployee/department');
			}
		}
		$data = [];
		$data['departments'] = $this->memployee->department();
		$data['header'] = $this->load->view('headers/head', '', TRUE);
		$data['menu'] = '';
		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['navigation'] = $this->memployee->getOfficeLocations();
		$data['groups'] = $this->memployee->groupList();
		$data['content'] = $this->load->view('forms/formAddDepartment', $data, TRUE);
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);
		$this->load->view('main', $data);
	}

	public function modifyDepartment($iddept = NULL){
		if ( isset($_POST['btnModifyDepartment']) ){
			$formInfo = [];
			$formInfo['deptdesc'] = htmlspecialchars(strtoupper($this->input->post('txtDepartmentName')));
			$formInfo['group_id'] = htmlspecialchars(strtoupper($this->input->post('selectGroup')));
			$formInfo['stsactive'] = htmlspecialchars(strtoupper($this->input->post('selectStatus')));
			if ( !$this->memployee->modifyDepartment($formInfo, $iddept) ){
				redirect(base_url() . 'cemployee/modifyDepartment/' . $iddept);
			} else {
				redirect(base_url() . 'cemployee/department');
			}
		}

		$data = [];
		$data['getDepartmentByIds'] = $this->memployee->getDepartmentByIds($iddept);
		$data['departmentIds'] = $this->memployee->departmentIds($iddept);
		$data['header'] = $this->load->view('headers/head', '', TRUE);		
		$data['menu'] = '';
		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['navigation'] = $this->memployee->getOfficeLocations();
		$data['groups'] = $this->memployee->groupList();					
		$data['content'] = $this->load->view('forms/formEditDepartment', $data, TRUE);		
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);		
		$this->load->view('main', $data);	
	}

	public function deleteDepartment($iddept = ''){
		$this->memployee->deleteDepartment($iddept);
		redirect(base_url() . 'cemployee/department');
	}	

	public function position(){		
		$data = [];
		$config = [];
		$config['full_tag_open'] = '<ul class="pagination">';
	    $config['full_tag_close'] = '</ul>';
	    $config['num_tag_open'] = '<li>';
	    $config['num_tag_close'] = '</li>';
	    $config['cur_tag_open'] = '<li class="active"><span>';
	    $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
	    $config['prev_tag_open'] = '<li>';
	    $config['prev_tag_close'] = '</li>';
	    $config['next_tag_open'] = '<li>';
	    $config['next_tag_close'] = '</li>';
	    $config['first_link'] = '&laquo;';
	    $config['prev_link'] = '&lsaquo;';
	    $config['last_link'] = '&raquo;';
	    $config['next_link'] = '&rsaquo;';
	    $config['first_tag_open'] = '<li>';
	    $config['first_tag_close'] = '</li>';
	    $config['last_tag_open'] = '<li>';
	    $config['last_tag_close'] = '</li>';
	    $data['totalPosition'] =  $this->memployee->countPosition();
	    $config["base_url"] = base_url() . "cemployee/position";
	    $config['total_rows'] = $data['totalPosition'];
	    $config['per_page'] = '10';
	    $config['uri_segment'] = '3';
	    $this->pagination->initialize($config);

		$data['header'] = $this->load->view('headers/head', '', TRUE);
		$data['no'] = $this->uri->segment(3);
		$data['menu'] = '';
		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['navigation'] = $this->memployee->getOfficeLocations();
		$data['departments'] = $this->memployee->department();
		$data['get_positions'] = $this->memployee->position();
		$data['positions'] = $this->memployee->positionList($config['per_page'], $this->uri->segment(3));
		$data['content'] = $this->load->view('contents/vPosition', $data, TRUE);
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);
		$this->load->view('main', $data);
	}

	public function addPosition(){
		if ( $this->input->post() ){
			$formInfo = [];
			$formInfo['txtPosition'] = strtoupper($this->input->post('txtPosition'));
			$formInfo['selDepartment'] = $this->input->post('selDepartment');
			$formInfo['selLevel'] = $this->input->post('selLevel');
			if ( $this->memployee->savePosition($formInfo) ){
				redirect(base_url() . 'cemployee/addPosition');
			} else {
				redirect(base_url() . 'cemployee/position');
			}
		}
		$data = [];
		$data['positions'] = $this->memployee->position();
		$data['departments'] = $this->memployee->department();		
		$data['header'] = $this->load->view('headers/head', '', TRUE);
		$data['menu'] = '';
		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['navigation'] = $this->memployee->getOfficeLocations();
		$data['content'] = $this->load->view('forms/formAddPosition', $data, TRUE);
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);
		$this->load->view('main', $data);
	}

	public function modifyPosition($idposition = NULL){
		if ( isset($_POST['btnModifyPosition']) ){
			$formInfo = [];
			$formInfo['positiondesc'] = strtoupper($this->input->post('txtPositionName'));
			$formInfo['iddept'] = $this->input->post('selDepartment');
			$formInfo['level'] = $this->input->post('selLevel');
			if ( !$this->memployee->modifyPosition($formInfo, $idposition) ){
				redirect(base_url() . 'cemployee/modifyPosition/' . $idposition);
			} else {
				redirect(base_url() . 'cemployee/position');
			}
		}

		$data = [];
		$data['departments'] = $this->memployee->department();
		$data['getPositionByIds'] = $this->memployee->getPositionByIds($idposition);
		$data['positionIds'] = $this->memployee->positionIds($idposition);
		$data['header'] = $this->load->view('headers/head', '', TRUE);		
		$data['menu'] = '';
		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['navigation'] = $this->memployee->getOfficeLocations();					
		$data['content'] = $this->load->view('forms/formEditPosition', $data, TRUE);		
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);		
		$this->load->view('main', $data);	
	}

	public function deletePosition($idposition = ''){
		$this->memployee->deletePosition($idposition);
		redirect(base_url() . 'cemployee/position');
	}

	public function searchPosition($department = false, $position = false){
		$data = [];
		if ( !$position AND !$department){
			$position = $this->input->post('select_position');
			$department = $this->input->post('select_department');
		}
	
		$config = [];
		$config['full_tag_open'] = '<ul class="pagination">';
	    $config['full_tag_close'] = '</ul>';
	    $config['num_tag_open'] = '<li>';
	    $config['num_tag_close'] = '</li>';
	    $config['cur_tag_open'] = '<li class="active"><span>';
	    $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
	    $config['prev_tag_open'] = '<li>';
	    $config['prev_tag_close'] = '</li>';
	    $config['next_tag_open'] = '<li>';
	    $config['next_tag_close'] = '</li>';
	    $config['first_link'] = '&laquo;';
	    $config['prev_link'] = '&lsaquo;';
	    $config['last_link'] = '&raquo;';
	    $config['next_link'] = '&rsaquo;';
	    $config['first_tag_open'] = '<li>';
	    $config['first_tag_close'] = '</li>';
	    $config['last_tag_open'] = '<li>';
	    $config['last_tag_close'] = '</li>';
	    $data['totalEmployee'] =  $this->memployee->countSearchPosition($department, $position);
	   	$config['base_url'] = base_url() . 'cemployee/searchPosition/' . $department . '/' . $position;
	    $config['total_rows'] = $data['totalEmployee'];
	    $config['per_page'] = '10';
	    $config['uri_segment'] = '5';
	    $this->pagination->initialize($config);

		$data['header'] = $this->load->view('headers/head', '', TRUE);
		$data['no'] = $this->uri->segment(5);
		$data['menu'] = '';
		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['navigation'] = $this->memployee->getOfficeLocations();
		$data['departments'] = $this->memployee->department();
		$data['get_positions'] = $this->memployee->position();
		$data['positions'] = $this->memployee->positionListSearch($config['per_page'], $this->uri->segment(5), $department, $position);
		$data['content'] = $this->load->view('contents/vPosition', $data, TRUE);
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);

		$this->load->view('main', $data);
	}

	// public function getPositionDependent(){
		// $positionId  = $_POST['id'];
		// $departmentId = $this->input->post('id', true);
		// if ($positionId) {
		// 	$data = $positionId;
			// $data = $this->memployee->getPositionDependent($positionId);
			// $data = $this->memployee->getPositionDependent($departmentId);
		// } else {
		// 	$data = "gagal";
		// 	// $data = $this->memployee->getAllPosition();
		// }
		// $data = $departmentId;
		// echo json_encode($data);
	// }

	public function officeLocation(){		
		$data = [];
		$data['header'] = $this->load->view('headers/head', '', TRUE);
		$data['no'] = $this->uri->segment(3);
		$data['menu'] = '';
		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['navigation'] = $this->memployee->getOfficeLocations();
		$data['content'] = $this->load->view('contents/vOfficeLocation', $data, TRUE);
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);
		$this->load->view('main', $data);
	}

	public function addOfficeLocation(){
		if ( $this->input->post() ){
			$formInfo = [];
			$formInfo['txtOfficeLocation'] = strtoupper($this->input->post('txtOfficeLocation'));
			if ( $this->memployee->saveOfficeLocation($formInfo) ){
				redirect(base_url() . 'cemployee/addOfficeLocation');
			} else {
				redirect(base_url() . 'cemployee/officeLocation');
			}
		}
		$data = [];
		$data['header'] = $this->load->view('headers/head', '', TRUE);
		$data['menu'] = '';
		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['navigation'] = $this->memployee->getOfficeLocations();
		$data['content'] = $this->load->view('forms/formAddOfficeLocation', $data, TRUE);
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);
		$this->load->view('main', $data);
	}

	public function modifyOfficeLocation($officeLocationId = NULL){
		if ( isset($_POST['btnModifyOfficeLocation']) ){
			$formInfo = [];
			// $formInfo['office_location_id'] = strtoupper($this->input->post('txtOfficeLocation'));
			$formInfo['office_location_desc'] = strtoupper($this->input->post('txtOfficeLocationDesc'));
			if ( !$this->memployee->modifyOfficeLocation($formInfo, $officeLocationId) ){
				redirect(base_url() . 'cemployee/modifyOfficeLocation/' . $officeLocationId);
			} else {
				redirect(base_url() . 'cemployee/officeLocation');
			}
		}

		$data = [];
		$data['header'] = $this->load->view('headers/head', '', TRUE);		
		$data['menu'] = '';
		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['navigation'] = $this->memployee->getOfficeLocations();
		$data['officeLocationById'] = $this->memployee->getOfficeDescription($officeLocationId);
		$data['content'] = $this->load->view('forms/formEditOfficeLocation', $data, TRUE);		
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);		
		$this->load->view('main', $data);	
	}

	public function deleteOfficeLocation($officeLocationId = ''){
		$getEmployeeByOfficeId = $this->memployee->getEmployeeByOfficeId($officeLocationId);
		if (!$getEmployeeByOfficeId){
			$this->memployee->deleteOfficeLocation($officeLocationId);
			$message = '<div class="alert alert-success">Office location deleted!</div>';
			$this->session->set_flashdata('message', $message);
			redirect(base_url() . 'cemployee/officeLocation');
		} else {
			$message = '<div class="alert alert-danger">Office location can not be deleted while still there people in it!</div>';
			$this->session->set_flashdata('message', $message);
			redirect(base_url() . 'cemployee/officeLocation');	
		}
	}

	public function department_position_dependent() {
		$iddept = $_POST['iddept'];
		if (!$iddept) {
			$positions = $this->m_employee->get_position();
		} else {
			$positions = $this->m_employee->getPositionDependent($iddept);
		}
		$output = '<option>Position</option>';
		foreach ($positions as $position) {
			$output .= '<option value=' . $position->idposition . '>' . $position->positiondesc . '</position>';
		}
		echo json_encode($output);	
	}
}

	