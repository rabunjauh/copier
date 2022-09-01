
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_user extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('m_user');
		if ( !$this->session->userdata('username') ){
			redirect(base_url(). 'login');
		}		
	}

	public function index(){
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
	    $data['totalEmployee'] =  $this->m_user->count_user();
	    $config["base_url"] = base_url() . "user";
	    $config['total_rows'] = $data['totalEmployee'];
	    $config['per_page'] = '10';
	    $config['uri_segment'] = '3';
	    $this->pagination->initialize($config);

		$data['header'] = $this->load->view('headers/head', '', TRUE);
		$data['menu'] = '';
		$data['navigation'] = $this->load->view('headers/navigation', '', TRUE);
		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['users'] = $this->m_user->user_list($config['per_page'], $this->uri->segment(3));
		$data['content'] = $this->load->view('contents/v_user', $data, TRUE);
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);
		$this->load->view('main', $data);
	}

	public function get_ldap_users_admin() {
		$ldap_users = $this->m_user->get_ldap_users_admin();
		$no = $_POST['start'];
		foreach ($ldap_users as $ldap_user) {
			$row =  array();
			$row[] = ++$no;
			$row[] = $ldap_user->id;
			$row[] = $ldap_user->name;
			$row[] = $ldap_user->department;
			$row[] = $ldap_user->position;
			$row[] = $ldap_user->ldap_email;
			$data[] = $row;
		}

		if (isset($data)) {
			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->m_user->count_all_data(),
				"recordsFiltered" => $this->m_user->count_filtered_data(),
				"data" => $data
			);
		} else {
			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->m_user->count_all_data(),
				"recordsFiltered" => $this->m_user->count_filtered_data(),
				"data" => array()
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function add_user(){
		if ( $this->input->post() ){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('txt_name', 'Name', 'required|max_length[100]');
			$this->form_validation->set_rules('txt_username', 'Username', 'required|is_unique[user.username]|max_length[100]');
			$this->form_validation->set_rules('txt_email', 'Email', 'required|is_unique[user.email]|max_length[30]');
			// $this->form_validation->set_rules('txt_email', 'Email', 'required');
			$this->form_validation->set_rules('txt_password', 'Password', 'required|max_length[50]');
			$this->form_validation->set_rules('txt_confirm_password', 'Confirm Password', 'matches[txt_password]');
			if ($this->form_validation->run() != FALSE) {
				$formInfo = [];
				$formInfo['name'] = $this->input->post('txt_name', TRUE);
				$formInfo['username'] = $this->input->post('txt_username', TRUE);
				$formInfo['email'] = $this->input->post('txt_email', TRUE);
				$formInfo['password'] = $this->input->post('txt_password', TRUE);
				// $formInfo['confirm_password'] = $this->input->post('txt_confirm_password', TRUE);

				if ( $this->m_user->save_user($formInfo) ){
					$message = '<div class="alert alert-success">Success</div>';
					$this->session->set_flashdata('message', $message);				
					redirect(base_url() . 'c_user');
				} else {
					$message = '<div class="alert alert-danger">Username already exist or password did not match!</div>';
					$this->session->set_flashdata('message', $message);
					redirect(base_url() . 'c_user/add_user');
				}
			}
		}

		$data = [];
		$data['header'] = $this->load->view('headers/head', '', TRUE);
		$data['menu'] = '';
		$data['navigation'] = $this->load->view('headers/navigation', '', TRUE);
		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['content'] = $this->load->view('forms/form_add_user', $data, TRUE);
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);
		$this->load->view('main', $data);
	}

	public function modify_user($userID) {
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('txt_name', 'Name', 'required|max_length[100]');	
			$this->form_validation->set_rules('txt_email', 'Email', 'required|max_length[30]');	
			if ($this->form_validation->run() != FALSE) {
				$formInfo = [];
				$formInfo['name'] = $this->input->post('txt_name', TRUE);
				$formInfo['username'] = $this->input->post('txt_username', TRUE);
				$formInfo['email'] = $this->input->post('txt_email', TRUE);

				if ( $this->m_user->saveModifyUser($formInfo, $userID) ){
					$message = '<div class="alert alert-success">Modify user success</div>';
					$this->session->set_flashdata('message', $message);				
					redirect(base_url() . 'c_user');
				} else {
					$message = '<div class="alert alert-danger">Modify user failed!</div>';
					$this->session->set_flashdata('message', $message);
					redirect(base_url() . 'c_user/modify_user');
				}
			}
		}
		$data = [];
		$data['header'] = $this->load->view('headers/head', '', TRUE);
		$data['menu'] = '';
		$data['navigation'] = $this->load->view('headers/navigation', '', TRUE);
		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['user'] = $this->load->m_user->getUserByID($userID);
		$data['content'] = $this->load->view('forms/formEditUser', $data, TRUE);
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);
		$this->load->view('main', $data);
	}
	
	public function change_password($userID) {
		if ($this->input->post()) {
			$this->load->library('form_validation');	
			$this->form_validation->set_rules('txt_password', 'Password', 'required|max_length[20]');
			$this->form_validation->set_rules('txt_confirm_password', 'Password', 'required|max_length[20]|matches[txt_password]');
			if ($this->form_validation->run() != FALSE) {
				$password = $this->input->post('txt_password', TRUE);

				if ( $this->m_user->changePassword($password, $userID) ){
					$message = '<div class="alert alert-success">Password changed</div>';
					$this->session->set_flashdata('message', $message);				
					redirect(base_url() . 'c_user');
				} else {
					$message = '<div class="alert alert-danger">Change password failed!</div>';
					$this->session->set_flashdata('message', $message);
					redirect(base_url() . 'c_user/change_password');
				}
			}
		}
		$data = [];
		$data['header'] = $this->load->view('headers/head', '', TRUE);
		$data['menu'] = '';
		$data['navigation'] = $this->load->view('headers/navigation', '', TRUE);
		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['user'] = $this->load->m_user->getUserByID($userID);
		$data['content'] = $this->load->view('forms/formResetPassword', $data, TRUE);
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);
		$this->load->view('main', $data);
	}

	public function delete_user($employeeID) {
		if ($this->m_user->delete_user($employeeID)) {
			$message = '<div class="alert alert-success">User Deleted!</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url('c_user'));
		} else {
			$message = '<div class="alert alert-danger">User delete failed!</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url('c_user'));
		}
	}

	public function check($id) {
		$user = $this->m_user->getUserByID($id);
		if($user->status === '0') {
			// $this->m_user->check_user($id);
			if ($this->m_user->check_user($id)) {
				$message = '<div class="alert alert-success">User '. $user->username . ' status changed!</div>';
				$this->session->set_flashdata('message', $message);
				redirect(base_url('c_user'));
			} else {
				$message = '<div class="alert alert-danger">Change user '. $user->username . ' status failed!</div>';
				$this->session->set_flashdata('message', $message);
				redirect(base_url('c_user'));
			}
		} else {
			if ($this->m_user->uncheck_user($id)) {
				$message = '<div class="alert alert-success">User '. $user->username . ' status changed!</div>';
				$this->session->set_flashdata('message', $message);
				redirect(base_url('c_user'));
			} else {
				$message = '<div class="alert alert-danger">Change user '. $user->username . 'status failed!</div>';
				$this->session->set_flashdata('message', $message);
				redirect(base_url('c_user'));
			}
		}
		
	}

	public function uncheck($id) {
		$user = $this->m_user->getUserByID($id);
		if($user->status === '1') {
			$this->m_user->uncheck_user($id);
		}
	}
}

	 