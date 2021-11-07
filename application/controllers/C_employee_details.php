
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_employee_details extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('m_copier_registration');
		if ( !$this->session->userdata('username') ){
			redirect(base_url(). 'login');
		}	
	}

	
	public function index() {
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
		$config['base_url'] = base_url('c_employee_details/copier_registration');
		// $total_row = $this->m_copier_registration->count_registration_data();
		$config['total_rows'] = 50;
		// $config['total_rows'] = $total_row;
		$config['per_page'] = 10;
		$config['num_links'] = 5;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config);
		if($this->uri->segment(3)){
            $page = ($this->uri->segment(3)) ;
        }else{
            $page = 0;
        }
		$data['copier_registrations'] = $this->m_copier_registration->get_registration_data($config['per_page'], $page);
		$data['header'] = $this->load->view('headers/head', '', TRUE);
		$data['menu'] = '';
		$data['navigation'] = $this->load->view('headers/navigation', '', TRUE);
		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['content'] = $this->load->view('contents/vCopierRegistration', $data, TRUE);
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);
		$this->load->view('main', $data);
	}

	public function search($page = 0){
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
		$config['base_url'] = base_url('c_employee_details/search');
		$total_row = $this->m_copier_registration->count_registration_data_search($this->input->post());
		// $config['total_rows'] = 50;
		$config['total_rows'] = $total_row;
		$config['per_page'] = 10;
		$config['num_links'] = 5;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config);
		if($this->uri->segment(3)){
            $page = ($this->uri->segment(3)) ;
        }else{
            $page = 0;
        }
		$data['copier_registrations'] = $this->m_copier_registration->get_registration_data_search($config['per_page'], $page, $this->input->post());
		$data['header'] = $this->load->view('headers/head', '', TRUE);
		$data['menu'] = '';
		$data['navigation'] = $this->load->view('headers/navigation', '', TRUE);
		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['content'] = $this->load->view('contents/vCopierRegistration', $data, TRUE);
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);
		$this->load->view('main', $data);
	}
	
	public function load_registration_data($page = 0) {
		$data = [];
		$config = [];
		$config['base_url'] = base_url('c_employee_details/load_registration_data');
		$total_row = $this->m_copier_registration->count_registration_data();
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
		$data['results'] = $this->m_copier_registration->get_registration_data($config['per_page'], $page);
		$str_links = $this->pagination->create_links();
		$data['links'] = explode('&nbsp;', $str_links);
		echo json_encode($data);
	}

	public function send_email_employee_details($employeeID) {
		$employee = $this->m_copier_registration->get_employee_by_id($employeeID);
		$this->load->library('email');
		// $data = [];
		// $data['recipient'] = $employee->email;
		// $data['sender'] = $this->session->userdata('email');
		// $data['idemployee'] = $employee->fingerid;
		// $data['employeename'] = $employee->employeename;
		// $data['deptdesc'] = $employee->deptdesc;
		// $data['positiondesc'] = $employee->positiondesc;
		// $data['others_password'] = $employee->others_password;
		// $data['sharp_password'] = $employee->sharp_password;
		// $config = [];
		// $config['protocol'] = 'smtp';
		// $config['charset'] = 'utf-8';
		// $config['wordwrap'] = TRUE;
		// $config['smtp_host'] = 'smtp-relay.wascoenergy.com';
		// $config['smtp_user'] = $this->session->userdata('email');
		// $config['smtp_pass'] = $this->session->userdata('password');
		// $config['smtp_port'] = '587';
		// $config['smtp_crypto'] = 'tls';
		// $config['newline'] = "\r\n";
		// $config['mailtype'] = 'html';

        $data = [];
		$data['recipient'] = $employee->email;
		$data['sender'] = $this->session->userdata('email');
		$data['idemployee'] = $employee->fingerid;
		$data['employeename'] = $employee->employeename;
		$data['deptdesc'] = $employee->deptdesc;
		$data['positiondesc'] = $employee->positiondesc;
		$data['others_password'] = $employee->others_password;
		$data['sharp_password'] = $employee->sharp_password;
		$config = [];
		$config['protocol'] = 'smtp';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$config['smtp_host'] = 'smtp.gmail.com';
		$config['smtp_user'] = 'mustafa.visionet@gmail.com';
		$config['smtp_pass'] = 'L3baranmasihlama13';
		$config['smtp_port'] = '465';
		$config['smtp_crypto'] = 'ssl';
		$config['newline'] = "\r\n";
		$config['mailtype'] = 'html';

		$this->email->initialize($config);	

		$this->email->from($data['sender']);
		// $this->email->to($data['recipient']);
        $this->email->to($employee->email);
        $other_users = $this->m_copier_registration->get_other_users($this->session->userdata('username'));
        $email = array();
        foreach ($other_users as $user) {
            array_push($email, $user->email);    
        }

        $this->email->cc(implode(",", $email));
        // $this->email->cc('wasco.upload@gmail.com');
		$this->email->subject('Employee Details');
		$this->email->message($this->load->view('contents/message_body', $data, TRUE));
        var_dump($this->email->send());die;
		
		if ($this->email->send()) {
			$message = '<div class="alert alert-success">Email sent to ' . $data['recipient'] . ' successfully</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url('c_employee_details/copier_registration'));
		} else {
			$message = '<div class="alert alert-danger">The email was not sent!</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url('c_employee_details/copier_registration'));
		}
	}
	
	public function send_email_sharp_details($employeeID) {
		$this->load->library('email');
		$employee = $this->m_copier_registration->get_employee_by_id($employeeID);
		// $data = [];
		// $data['recipient'] = 'ptwei.mis@wascoenergy.com';
		// $data['sender'] = 'mustafa.m@wascoenergy.com';
		// $data['idemployee'] = $employee->fingerid;
		// $data['employeename'] = $employee->employeename;
		// $data['deptdesc'] = $employee->deptdesc;
		// $data['positiondesc'] = $employee->positiondesc;
		// $data['others_password'] = $employee->others_password;
		// $data['sharp_password'] = $employee->sharp_password;
		// $config = [];
		// $config['protocol'] = 'smtp';
		// $config['charset'] = 'iso-8859-1';
		// $config['wordwrap'] = TRUE;
		// $config['smtp_host'] = 'smtp-relay.wascoenergy.com';
		// $config['smtp_user'] = 'ptwei.mis@wascoenergy.com';
		// $config['smtp_pass'] = 'wasco@123';
		// $config['smtp_port'] = '587';
		// $config['smtp_crypto'] = 'tls';
		// $config['newline'] = "\r\n";
		// $config['mailtype'] = 'html';

		$data = [];
		$data['recipient'] = $employee->email;
		$data['sender'] = $this->session->userdata('email');
		$data['idemployee'] = $employee->fingerid;
		$data['employeename'] = $employee->employeename;
		$data['deptdesc'] = $employee->deptdesc;
		$data['positiondesc'] = $employee->positiondesc;
		$data['others_password'] = $employee->others_password;
		$data['sharp_password'] = $employee->sharp_password;
		$config = [];
		$config['protocol'] = 'smtp';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$config['smtp_host'] = 'smtp.gmail.com';
		$config['smtp_user'] = 'mustafa.visionet@gmail.com';
		$config['smtp_pass'] = 'L3baranmasihlama13';
		$config['smtp_port'] = '465';
		$config['smtp_crypto'] = 'ssl';
		$config['newline'] = "\r\n";
		$config['mailtype'] = 'html';

		$this->email->initialize($config);	

		$this->email->from($data['sender']);
		// $this->email->to('mustafa.m@wascoenergy.com');
		$this->email->to($employee->email);
        $other_users = $this->m_copier_registration->get_other_users($this->session->userdata('username'));
        $email = array();
        foreach ($other_users as $user) {
            array_push($email, $user->email);    
        }
        $this->email->cc(implode(",", $email));
		// $this->email->cc('wasco.upload2@gmail.com');
		$this->email->subject('Sharp Printer Details');
		$this->email->message($this->load->view('contents/message_body_printer', $data, TRUE));
        var_dump($this->email);
        var_dump($this->email->send());die;
		if ($this->email->send()) {
			$message = '<div class="alert alert-success">Email sent to ' . $data['recipient'] . ' successfully</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url('c_employee_details/copier_registration'));
		} else {
			$message = '<div class="alert alert-danger">The email was not sent!</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url('c_employee_details/copier_registration'));
		}
	}

	public function get_department() {
		$departments = $this->m_copier_registration->get_department();
		$option = '';
		foreach($departments as $department) {
			$option .= '<option value=' . $department->iddept . '>' . $department->deptdesc . '</option>';
		}
		echo json_encode($option);
		// var_dump($option);
	}
}

	