
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_user extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('m_user');
		// if ( !$this->session->userdata('username') ){
		// 	redirect(base_url(). 'login');
		// }		
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
		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['users'] = $this->m_user->user_list($config['per_page'], $this->uri->segment(3));
		$data['content'] = $this->load->view('contents/v_user', $data, TRUE);
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);
		$this->load->view('main', $data);
	}

	public function add_user(){
		if ( $this->input->post() ){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('txt_username', 'Username', 'required|is_unique[user.username]|max_length[100]');
			$this->form_validation->set_rules('txt_email', 'Email', 'required|is_unique[user.email]|max_length[30]');
			// $this->form_validation->set_rules('txt_email', 'Email', 'required');
			$this->form_validation->set_rules('txt_password', 'Password', 'required|max_length[20]');
			$this->form_validation->set_rules('txt_confirm_password', 'Confirm Password', 'matches[txt_password]');
			if ($this->form_validation->run() != FALSE) {
				$formInfo = [];
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
		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['content'] = $this->load->view('forms/form_add_user', $data, TRUE);
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);
		$this->load->view('main', $data);
	}

	public function modify_user($userID) {
		if ($this->input->post()) {
			$this->load->library('form_validation');	
			$this->form_validation->set_rules('txt_username', 'Username', 'required|is_unique[user.username]|max_length[100]');
			$this->form_validation->set_rules('txt_email', 'Email', 'required|is_unique[user.email]|max_length[30]');	
			if ($this->form_validation->run() != FALSE) {
				$formInfo = [];
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
		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['user'] = $this->load->m_user->getUserByID($userID);
		$data['content'] = $this->load->view('forms/formResetPassword', $data, TRUE);
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);
		$this->load->view('main', $data);
	}

	public function copier_registration() {
		$data = [];
		$data['header'] = $this->load->view('headers/head', '', TRUE);
		$data['menu'] = '';
		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['content'] = $this->load->view('contents/vCopierRegistration', $data, TRUE);
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);
		$this->load->view('main', $data);
	}
	
	public function load_registration_data($page = 0) {
		$data = [];
		$config = [];
		$config['base_url'] = base_url('c_user/load_registration_data');
		$total_row = $this->m_user->count_registration_data();
		$config['total_rows'] = $total_row;
		$config['per_page'] = 10;
		$config['num_links'] = 5;
		$config['cur_tag_open'] = '&nbsp;<a class="current">';
		$config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config);
		if($this->uri->segment(3)){
            $page = ($this->uri->segment(3)) ;
        }else{
            $page = 0;
        }
		$data['results'] = $this->m_user->get_registration_data($config['per_page'], $page);
		$str_links = $this->pagination->create_links();
		$data['links'] = explode('&nbsp;', $str_links);
		echo json_encode($data);
	}

	public function send_email() {
		$this->load->library('email');
		var_dump($this->input->post());
		$data = [];
		$data['recipient'] = 'mustafa.m@wascoenergy.com';
		$data['sender'] = 'mustafa.visionet@gmail.com';
		$data['idemployee'] = $this->input->post('idemployee');
		$data['employeename'] = $this->input->post('employeename');
		$data['deptdesc'] = $this->input->post('deptdesc');
		$data['positiondesc'] = $this->input->post('positiondesc');
		$data['others_password'] = $this->input->post('others_password');
		$data['sharp_password'] = $this->input->post('sharp_password');
		
		$config = [];
		$config['protocol'] = 'smtp';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$config['smtp_host'] = 'smtp.gmail.com';
		$config['smtp_user'] = 'mustafa.visionet@gmail.com';
		$config['smtp_pass'] = 'L3baranmasihlama13';
		$config['smtp_port'] = '587';
		$config['smtp_crypto'] = 'tls';
		$config['newline'] = "\r\n";
		$config['mailtype'] = 'html';

		$this->email->initialize($config);	

		$this->email->from($data['sender'], 'Mustafa');
		$this->email->to($data['recipient']);
		$this->email->cc('wasco.upload2@gmail.com');
		
		$this->email->subject('Employee Details');
		$this->email->message($this->load->view('contents/message_body', $data, TRUE));
		// $this->email->message('tes email');
		// var_dump($this->email);
		$this->email->send();

		if ($this->email->send()) {
			$message = '<div class="alert alert-success">Email sent to <?= $recipient; ?> successfully</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url('c_user/copier_registration'));
		} else {
			$message = '<div class="alert alert-danger">The email was not sent!</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url('c_user/copier_registration'));
		}
	}
}

	