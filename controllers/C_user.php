
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_user extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('m_user');
		$this->load->model('memployee');
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
		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['navigation'] = $this->memployee->getOfficeLocations();
		$data['users'] = $this->m_user->user_list($config['per_page'], $this->uri->segment(3));
		$data['content'] = $this->load->view('contents/v_user', $data, TRUE);
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);
		$this->load->view('main', $data);
	}
	public function add_user(){
		if ( $this->input->post() ){
			$formInfo = [];
			$formInfo['username'] = $this->input->post('txt_username', TRUE);
			$formInfo['password'] = $this->input->post('txt_password', TRUE);
			$formInfo['confirm_password'] = $this->input->post('txt_confirm_password', TRUE);

			if ( $this->m_user->save_user($formInfo) ){
				$message = '<div class="alert alert-success">Success</div>';
        		$this->session->set_flashdata('message', $message);				
				redirect(base_url() . 'c_user');
			}else{
				$message = '<div class="alert alert-danger">Username already exist or password did not match!</div>';
        		$this->session->set_flashdata('message', $message);
				redirect(base_url() . 'c_user/add_user');
			}
		}

		$data = [];
		$data['users'] = $this->m_user->position();
		$data['header'] = $this->load->view('headers/head', '', TRUE);
		$data['menu'] = '';
		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['navigation'] = $this->memployee->getOfficeLocations();		
		$data['content'] = $this->load->view('forms/form_add_user', $data, TRUE);
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);
		$this->load->view('main', $data);
	}
}

	