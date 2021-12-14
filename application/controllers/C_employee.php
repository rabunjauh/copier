<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_employee extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('m_employee');
		if ( !$this->session->userdata('username') ){
			redirect(base_url(). 'login');
		}			
	}


	public function department(){		
		// $data = [];
		// $config = [];
		// $config['full_tag_open'] = '<ul class="pagination">';
	    // $config['full_tag_close'] = '</ul>';
	    // $config['num_tag_open'] = '<li>';
	    // $config['num_tag_close'] = '</li>';
	    // $config['cur_tag_open'] = '<li class="active"><span>';
	    // $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
	    // $config['prev_tag_open'] = '<li>';
	    // $config['prev_tag_close'] = '</li>';
	    // $config['next_tag_open'] = '<li>';
	    // $config['next_tag_close'] = '</li>';
	    // $config['first_link'] = '&laquo;';
	    // $config['prev_link'] = '&lsaquo;';
	    // $config['last_link'] = '&raquo;';
	    // $config['next_link'] = '&rsaquo;';
	    // $config['first_tag_open'] = '<li>';
	    // $config['first_tag_close'] = '</li>';
	    // $config['last_tag_open'] = '<li>';
	    // $config['last_tag_close'] = '</li>';
	    // $data['totalDepartment'] =  $this->m_employee->count_department();
	    // $config["base_url"] = base_url() . "c_employee/department";
	    // $config['total_rows'] = $data['totalDepartment'];
	    // $config['per_page'] = '10';
	    // $config['uri_segment'] = '3';
	    // $this->pagination->initialize($config);

		$data['header'] = $this->load->view('headers/head', '', TRUE);
		$data['menu'] = '';
		$data['navigation'] = $this->load->view('headers/navigation', '', TRUE);
		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['departments'] = $this->m_employee->department_list();
		// $data['departments'] = $this->m_employee->department_list($config['per_page'], $this->uri->segment(3));
		$data['content'] = $this->load->view('contents/view_department', $data, TRUE);
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);
		$this->load->view('main', $data);
	}

	public function add_department(){
		if ( $this->input->post() ){
			$formInfo = [];
			$formInfo['deptdesc'] = htmlspecialchars(strtoupper($this->input->post('txtDepartment')));
			$formInfo['stsactive'] = htmlspecialchars(strtoupper($this->input->post('selectStatus')));
			if ( $this->m_employee->save_department($formInfo) ){
				$message = '<div class="alert alert-success">Department added</div>';
            	$this->session->set_flashdata('message', $message);
				redirect(base_url() . 'c_employee/department');
			} else {
				$message = '<div class="alert alert-danger">Add department failed</div>';
            	$this->session->set_flashdata('message', $message);
				redirect(base_url() . 'c_employee/add_department');
			}
		}
		$data = [];
		$data['header'] = $this->load->view('headers/head', '', TRUE);
		$data['menu'] = '';
		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['navigation'] = $this->load->view('headers/navigation', '', TRUE);
		$data['content'] = $this->load->view('forms/form_add_department', $data, TRUE);
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);
		$this->load->view('main', $data);
	}

	public function modify_department($iddept){
		$data = [];
		$data['getDepartmentByIds'] = $this->m_employee->get_department_by_id($iddept);
		$data['header'] = $this->load->view('headers/head', '', TRUE);		
		$data['menu'] = '';
		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['navigation'] = $this->load->view('headers/navigation', '', TRUE);
		$data['content'] = $this->load->view('forms/form_edit_department', $data, TRUE);		
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);		
		$this->load->view('main', $data);	
	}

	public function update_department() {
		if ( isset($_POST['btnModifyDepartment']) ){
			$iddept = $this->input->post('txtDepartmentId');
			$formInfo['deptdesc'] = htmlspecialchars(strtoupper($this->input->post('txtDepartmentName')));
			$formInfo['stsactive'] = htmlspecialchars(strtoupper($this->input->post('selectStatus')));
			if ( !$this->m_employee->update_department($formInfo, $iddept) ){
				$message = '<div class="alert alert-success">Department updated</div>';
            	$this->session->set_flashdata('message', $message);
				redirect(base_url() . 'c_employee/department/');
			} else {
				$message = '<div class="alert alert-danger">Update department failed</div>';
            	$this->session->set_flashdata('message', $message);
				redirect(base_url() . 'c_employee/department');
			}
		}
	}

	public function delete_department($iddept = ''){
		if ($this->m_employee->delete_department($iddept)) {
			$message = '<div class="alert alert-success">Department deleted</div>';
			$this->session->set_flashdata('message', $message);
			redirect(base_url() . 'c_employee/department');
		} else {
			$message = '<div class="alert alert-danger">Something wrong</div>';
			$this->session->set_flashdata('message', $message);
			redirect(base_url() . 'c_employee/department');
		}
	}	

	public function position(){		
		// $data = [];
		// $config = [];
		// $config['full_tag_open'] = '<ul class="pagination">';
	    // $config['full_tag_close'] = '</ul>';
	    // $config['num_tag_open'] = '<li>';
	    // $config['num_tag_close'] = '</li>';
	    // $config['cur_tag_open'] = '<li class="active"><span>';
	    // $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
	    // $config['prev_tag_open'] = '<li>';
	    // $config['prev_tag_close'] = '</li>';
	    // $config['next_tag_open'] = '<li>';
	    // $config['next_tag_close'] = '</li>';
	    // $config['first_link'] = '&laquo;';
	    // $config['prev_link'] = '&lsaquo;';
	    // $config['last_link'] = '&raquo;';
	    // $config['next_link'] = '&rsaquo;';
	    // $config['first_tag_open'] = '<li>';
	    // $config['first_tag_close'] = '</li>';
	    // $config['last_tag_open'] = '<li>';
	    // $config['last_tag_close'] = '</li>';
	    // $data['totalPosition'] =  $this->m_employee->count_position();
	    // $config["base_url"] = base_url() . "c_employee/position";
	    // $config['total_rows'] = $data['totalPosition'];
	    // $config['per_page'] = '10';
	    // $config['uri_segment'] = '3';
	    // $this->pagination->initialize($config);

		$data['header'] = $this->load->view('headers/head', '', TRUE);
		$data['no'] = $this->uri->segment(3);
		$data['menu'] = '';
		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['navigation'] = $this->load->view('headers/navigation',  '', TRUE);
		$data['departments'] = $this->m_employee->get_department();
		$data['positions'] = $this->m_employee->position_list();
		// $data['positions'] = $this->m_employee->position_list($config['per_page'], $this->uri->segment(3));
		$data['content'] = $this->load->view('contents/view_position', $data, TRUE);
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);
		$this->load->view('main', $data);
	}

	public function add_position(){
		if ( $this->input->post() ){
			$formInfo = [];
			$formInfo['txtPosition'] = strtoupper($this->input->post('txtPosition'));
			$formInfo['selDepartment'] = $this->input->post('selDepartment');
			if ( $this->m_employee->save_position($formInfo) ){
				$message = '<div class="alert alert-success">Position added</div>';
				$this->session->set_flashdata('message', $message);
				redirect(base_url() . 'c_employee/position');
			} else {
					$message = '<div class="alert alert-success">Add position failed!</div>';
				$this->session->set_flashdata('message', $message);
				redirect(base_url() . 'c_employee/position');
			}
		}
		$data = [];
		$data['departments'] = $this->m_employee->get_department();		
		$data['header'] = $this->load->view('headers/head', '', TRUE);
		$data['menu'] = '';
		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['navigation'] = $this->load->view('headers/navigation', '', TRUE);
		$data['content'] = $this->load->view('forms/form_add_position', $data, TRUE);
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);
		$this->load->view('main', $data);
	}

	public function modify_position($idposition){
		$data = [];
		$data['departments'] = $this->m_employee->get_department();
		$data['getPositionById'] = $this->m_employee->get_position_by_id($idposition);
		$data['header'] = $this->load->view('headers/head', '', TRUE);		
		$data['menu'] = '';
		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['navigation'] = $this->load->view('headers/navigation', '', TRUE);					
		$data['content'] = $this->load->view('forms/form_edit_position', $data, TRUE);		
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);		
		$this->load->view('main', $data);	
	}

	public function update_position() {
		if ( isset($_POST['btnModifyPosition']) ){
			$idposition = $this->input->post('txtPositionID');
			$formInfo['positiondesc'] = strtoupper($this->input->post('txtPositionName'));
			$formInfo['iddept'] = $this->input->post('selDepartment');
			if ( $this->m_employee->update_position($formInfo, $idposition) ){
				$message = '<div class="alert alert-success">Position updated</div>';
            	$this->session->set_flashdata('message', $message);
				redirect(base_url() . 'c_employee/position');
			} else {
				$message = '<div class="alert alert-danger">Update position failed!</div>';
            	$this->session->set_flashdata('message', $message);
				redirect(base_url() . 'c_employee/position');
			}
		}
	}

	public function delete_position($idposition = ''){
		if ($this->m_employee->delete_position($idposition)) {
			$message = '<div class="alert alert-success">Position deleted</div>';
			$this->session->set_flashdata('message', $message);
			redirect(base_url() . 'c_employee/position');
		} else {
			$message = '<div class="alert alert-danger">Something wrong</div>';
			$this->session->set_flashdata('message', $message);
			redirect(base_url() . 'c_employee/position');
		}
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

	