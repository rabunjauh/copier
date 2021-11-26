<?php
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

defined('BASEPATH') OR exit('No direct script access allowed');

class C_employee_details extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('m_copier_registration');
		$this->load->model('m_user');
		$this->load->model('m_employee');
		if ( !$this->session->userdata('username') ){
			redirect(base_url(). 'login');
		}	
	}

	
	public function index($page = 0) {
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
		$config['base_url'] = base_url('c_employee_details/index');
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

	public function search($selSearch = false, $txtSearch = false){
        if (!$selSearch AND !$txtSearch) {
                $selSearch = $this->input->post('selSearch');
                $txtSearch = htmlspecialchars($this->input->post('txtSearch'));
                // $selDepartment = $this->input->post('selDepartment');
            }
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
        // if (!$txtSearch) {
            $config['base_url'] = base_url('c_employee_details/search/' . $selSearch . '/' . $txtSearch);
            $config['uri_segment'] = '5';
            $offset = $this->uri->segment(5);
        // } else {
        //     $config['base_url'] = base_url('c_employee_details/search/' . $selSearch . '/' . $txtSearch);
        //     $config["uri_segment"] = '5';
        // } 
        // if ($txtSearch !== '') {
        //     $config['base_url'] = base_url('c_employee_details/search/'. $selSearch . '/' . $txtSearch);
        //     $config['uri_segment'] = '5';
        //     $offset = $this->uri->segment(5);
        // } else {
        //     $config['base_url'] = base_url('c_employee_details/search/' . $selSearch . '/0/');
        //     $config['uri_segment'] = '3';
        //     $offset = $this->uri->segment(3);
        // }
		$total_row = $this->m_copier_registration->count_registration_data_search($selSearch, urldecode($txtSearch));
		// $config['total_rows'] = 50;
		$config['total_rows'] = $total_row;
		$config['per_page'] = 10;
		$config['num_links'] = 5;
        
        // var_dump('uri segment->' . $this->uri->segment(3));
        // echo '<br>';
        $this->pagination->initialize($config);
		// $data['copier_registrations'] = $this->m_copier_registration->get_registration_data_search($config['per_page'], $selSearch, $txtSearch, $this->uri->segment(5));
		$data['copier_registrations'] = $this->m_copier_registration->get_registration_data_search($config['per_page'], $selSearch, urldecode($txtSearch), $offset);
		$data['header'] = $this->load->view('headers/head', '', TRUE);
		$data['menu'] = '';
		$data['navigation'] = $this->load->view('headers/navigation', '', TRUE);
		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['content'] = $this->load->view('contents/vCopierRegistration', $data, TRUE);
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);
		$this->load->view('main', $data);
	}

    public function register_password() {
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('txt_idemployee', 'Finger ID', 'required|is_unique[copier_id.idemployee]');
			$this->form_validation->set_rules('txt_employee_name', 'Employee Name', 'required');
			$this->form_validation->set_rules('txt_employee_email', 'Email', 'required');

			if ($this->form_validation->run()) {
				$form_info['txt_sharp_password'] = $this->input->post('txt_sharp_password', TRUE);
				$form_info['txt_others_password'] = $this->input->post('txt_others_password', TRUE);
				$form_info['txt_idemployee'] = $this->input->post('txt_idemployee', TRUE);
				if ($this->m_employee->save_register($form_info)) {
					$message = '<div class="alert alert-success">Success</div>';
					$this->session->set_flashdata('message', $message);
					redirect(base_url('c_employee'));
				} else {
					$message = '<div class="alert alert-danger">Failed</div>';
					$this->session->set_flashdata('message', $message);
					redirect(base_url('c_employee/register_password'));
				}
			}
		}
        $data['last_row'] = $this->m_copier_registration->get_last_row();
        $data['header'] = $this->load->view('headers/head', '', TRUE);
        $data['menu'] = '';
        $data['navigation'] = $this->load->view('headers/navigation', '',  TRUE);
        $data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['departments'] = $this->m_employee->get_department();
		$data['positions'] = $this->m_employee->get_position();
        $data['content'] = $this->load->view('forms/register_password', $data, TRUE);
        $data['footer'] = $this->load->view('footers/footer', '', TRUE);
        $this->load->view('main', $data);
    }

    public function modify_copier_registration($employeeID) {
        $data['copier_registration'] = $this->m_copier_registration->get_employee_by_id($employeeID);
        $data['header'] = $this->load->view('headers/head', '', TRUE);
        $data['menu'] = '';
        $data['navigation'] = $this->load->view('headers/navigation', '', TRUE);
        $data['cover'] = $this->load->view('headers/cover', '', TRUE);
        $data['content'] = $this->load->view('forms/form_modify_copier_registration', $data, TRUE);
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

	// public function send_email_employee_details($employeeID) {
	// 	$employee = $this->m_copier_registration->get_employee_by_id($employeeID);
	// 	$this->load->library('email');
	// 	$data = [];
	// 	$data['recipient'] = $employee->email;
	// 	$data['sender'] = $this->session->userdata('email');
	// 	$data['idemployee'] = $employee->fingerid;
	// 	$data['employeename'] = $employee->employeename;
	// 	$data['deptdesc'] = $employee->deptdesc;
	// 	$data['positiondesc'] = $employee->positiondesc;
	// 	$data['others_password'] = $employee->others_password;
	// 	$data['sharp_password'] = $employee->sharp_password;
	// 	$config = [];
	// 	$config['protocol'] = 'smtp';
	// 	$config['charset'] = 'iso-8859-1';
	// 	$config['wordwrap'] = TRUE;
	// 	$config['smtp_host'] = 'smtp-relay.wascoenergy.com';
	// 	$config['smtp_user'] = $this->session->userdata('email');
	// 	$config['smtp_pass'] = $this->session->userdata('password');
	// 	$config['smtp_port'] = '587';
	// 	$config['smtp_crypto'] = 'tls';
	// 	$config['newline'] = "\r\n";
	// 	$config['mailtype'] = 'html';
        // config gmail
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
		// $config['charset'] = 'iso-8859-1';
		// $config['wordwrap'] = TRUE;
		// $config['smtp_host'] = 'smtp.gmail.com';
		// $config['smtp_user'] = 'mustafa.visionet@gmail.com';
		// $config['smtp_pass'] = 'L3baranmasihlama13';
		// $config['smtp_port'] = '465';
		// $config['smtp_crypto'] = 'ssl';
		// $config['newline'] = "\r\n";
		// $config['mailtype'] = 'html';

	// 	$this->email->initialize($config);	

	// 	$this->email->from($data['sender']);
	// 	// $this->email->to($data['recipient']);
    //     $this->email->to($employee->email);
    //     $other_users = $this->m_user->get_other_users($this->session->userdata('username'));
    //     $email = array();
    //     foreach ($other_users as $user) {
    //         array_push($email, $user->email);    
    //     }

    //     $this->email->cc(implode(",", $email));
    //     // $this->email->cc('wasco.upload@gmail.com');
	// 	$this->email->subject('Employee Details');
	// 	$this->email->message($this->load->view('contents/message_body', $data, TRUE));
    //     // var_dump($this->email);
    //     // var_dump($this->email->send());die;
		
	// 	if ($this->email->send()) {
	// 		$message = '<div class="alert alert-success">Email sent to ' . $data['recipient'] . ' successfully</div>';
    //         $this->session->set_flashdata('message', $message);
    //         redirect(base_url('c_employee_details/copier_registration'));
	// 	} else {
	// 		$message = '<div class="alert alert-danger">The email was not sent!</div>';
    //         $this->session->set_flashdata('message', $message);
    //         redirect(base_url('c_employee_details/copier_registration'));
	// 	}
	// }

    // public function send_email_sharp_details($employeeID) {
	// 	$this->load->library('email');
	// 	$employee = $this->m_copier_registration->get_employee_by_id($employeeID);
	// 	$data = [];
	// 	$data['recipient'] = $employee->email;
	// 	$data['sender'] = $this->session->userdata('email');
	// 	$data['idemployee'] = $employee->fingerid;
	// 	$data['employeename'] = $employee->employeename;
	// 	$data['deptdesc'] = $employee->deptdesc;
	// 	$data['positiondesc'] = $employee->positiondesc;
	// 	$data['others_password'] = $employee->others_password;
	// 	$data['sharp_password'] = $employee->sharp_password;
    //     $data['link_password_printer'] = '\\192.168.40.58\MIS-Guide\Printer\Input_Password.pdf';
    //     $data['link_scan'] = '\\192.168.40.58\MIS-Guide\Printer\Scan_Doc.pdf';
	// 	$config = [];
	// 	$config['protocol'] = 'smtp';
	// 	$config['charset'] = 'iso-8859-1';
	// 	$config['wordwrap'] = TRUE;
	// 	$config['smtp_host'] = 'smtp-relay.wascoenergy.com';
	// 	$config['smtp_user'] = $this->session->userdata('email');
	// 	$config['smtp_pass'] = $this->session->userdata('password');
	// 	$config['smtp_port'] = '587';
	// 	$config['smtp_crypto'] = 'tls';
	// 	$config['newline'] = "\r\n";
	// 	$config['mailtype'] = 'html';
        
    //     // gmail config
	// 	// $data = [];
	// 	// $data['recipient'] = $employee->email;
	// 	// $data['sender'] = $this->session->userdata('email');
	// 	// $data['idemployee'] = $employee->fingerid;
	// 	// $data['employeename'] = $employee->employeename;
	// 	// $data['deptdesc'] = $employee->deptdesc;
	// 	// $data['positiondesc'] = $employee->positiondesc;
	// 	// $data['others_password'] = $employee->others_password;
	// 	// $data['sharp_password'] = $employee->sharp_password;
	// 	// $config = [];
	// 	// $config['protocol'] = 'smtp';
	// 	// $config['charset'] = 'iso-8859-1';
	// 	// $config['wordwrap'] = TRUE;
	// 	// $config['smtp_host'] = 'smtp.gmail.com';
	// 	// $config['smtp_user'] = 'mustafa.visionet@gmail.com';
	// 	// $config['smtp_pass'] = 'L3baranmasihlama13';
	// 	// $config['smtp_port'] = '465';
	// 	// $config['smtp_crypto'] = 'ssl';
	// 	// $config['newline'] = "\r\n";
	// 	// $config['mailtype'] = 'html';

	// 	$this->email->initialize($config);	

	// 	$this->email->from($data['sender']);
	// 	// $this->email->to('mustafa.m@wascoenergy.com');
	// 	$this->email->to($employee->email);
    //     $other_users = $this->m_user->get_other_users($this->session->userdata('username'));
    //     $email = array();
    //     foreach ($other_users as $user) {
    //         array_push($email, $user->email);    
    //     }
    //     $this->email->cc(implode(",", $email));
	// 	// $this->email->cc('wasco.upload2@gmail.com');
	// 	$this->email->subject('Sharp Printer Details');
	// 	$this->email->message($this->load->view('contents/message_body_printer', $data, TRUE));
    //     // var_dump($this->email);
    //     // var_dump($this->email->send());die;
	// 	if ($this->email->send()) {
	// 		$message = '<div class="alert alert-success">Email sent to ' . $data['recipient'] . ' successfully</div>';
    //         $this->session->set_flashdata('message', $message);
    //         redirect(base_url('c_employee_details/index'));
	// 	} else {
	// 		$message = '<div class="alert alert-danger">The email was not sent!</div>';
    //         $this->session->set_flashdata('message', $message);
    //         redirect(base_url('c_employee_details/index'));
	// 	}
	// }
	
    public function send_email_employee_details($employeeID) {
		$employee = $this->m_copier_registration->get_employee_by_id($employeeID);
		$this->load->library('email');
        $sender = 'no-reply@wascoenergy.com';
        $pass = 'password.88';
		$data = [];
		$data['recipient'] = $employee->email;
		$data['sender'] = 'no-reply@wascoenergy.com';
		$data['idemployee'] = $employee->fingerid;
		$data['employeename'] = $employee->employeename;
		$data['deptdesc'] = $employee->deptdesc;
		$data['positiondesc'] = $employee->positiondesc;
		$data['others_password'] = $employee->others_password;
		$data['sharp_password'] = $employee->sharp_password;
		$config = [];
		$config['protocol'] = 'smtp';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = FALSE;
		$config['smtp_host'] = 'smtp-relay.wascoenergy.com';
		$config['smtp_user'] = $sender;
		$config['smtp_pass'] = $pass;
		$config['smtp_port'] = '587';
		$config['smtp_crypto'] = 'tls';
		$config['newline'] = "\r\n";
		$config['mailtype'] = 'html';

		$this->email->initialize($config);	

		$this->email->from($sender, 'WEI MIS');
		// $this->email->to($data['recipient']);
        $this->email->to($employee->email);
        // $other_users = $this->m_user->get_other_users($this->session->userdata('username'));
        // $email = array();
        // foreach ($other_users as $user) {
        //     array_push($email, $user->email);    
        // }

        // $this->email->cc(implode(",", $email));
        // $this->email->cc('mustafa.m@wascoenergy.com, ichwan.maulana@wascoenergy.com, wahyu.maulana@wascoenergy.com');
        // $this->email->cc('wasco.upload@gmail.com');
		$this->email->subject('Employee Details');
		$this->email->attach('C:\xampp\htdocs\copier\assets\attachment\Guide-to-Create-Timesheet.pdf');
		$this->email->message($this->load->view('contents/message_body', $data, TRUE));
        // var_dump($this->email);
        // var_dump($this->email->send());die;
		
		if ($this->email->send()) {
			$message = '<div class="alert alert-success">Email sent to ' . $data['recipient'] . ' successfully</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url('c_employee_details'));
		} else {
			$message = '<div class="alert alert-danger">The email was not sent!</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url('c_employee_details'));
		}
	}
	
    public function send_email_sharp_details($employeeID) {
		$this->load->library('email');
        $sender = 'no-reply@wascoenergy.com';
        $pass = 'password.88';
		$employee = $this->m_copier_registration->get_employee_by_id($employeeID);
		$data = [];
		$data['recipient'] = $employee->email;
		$data['sender'] = $sender;
		$data['idemployee'] = $employee->fingerid;
		$data['employeename'] = $employee->employeename;
		$data['deptdesc'] = $employee->deptdesc;
		$data['positiondesc'] = $employee->positiondesc;
		$data['others_password'] = $employee->others_password;
		$data['sharp_password'] = $employee->sharp_password;
        // $data['link_password_printer'] = '\\192.168.40.58\MIS-Guide\Printer\Input_Password.pdf';
        // $data['link_scan'] = "\\192.168.40.58\MIS-Guide";
		$config = [];
		$config['protocol'] = 'smtp';
		$config['charset'] = 'utf-8';
		$config['wordwrap'] = FALSE;
		$config['smtp_host'] = 'smtp-relay.wascoenergy.com';
		$config['smtp_user'] = $sender;
		$config['smtp_pass'] = $pass;
		$config['smtp_port'] = '587';
		$config['smtp_crypto'] = 'tls';
		$config['newline'] = "\r\n";
		$config['mailtype'] = 'html';
        
		$this->email->initialize($config);	

		$this->email->from($sender, 'WEI MIS');
		// $this->email->to('mustafa.m@wascoenergy.com');
		$this->email->to($employee->email);
        // $other_users = $this->m_user->get_other_users($this->session->userdata('username'));
        // $email = array();
        // foreach ($other_users as $user) {
        //     array_push($email, $user->email);    
        // }
        // $this->email->cc(implode(",", $email));
        // $this->email->cc('mustafa.m@wascoenergy.com, ichwan.maulana@wascoenergy.com, wahyu.maulana@wascoenergy.com');
        // $this->email->cc('mustafa.m@wascoenergy.com, ichwan.maulana@wascoenergy.com, wahyu.maulana@wascoenergy.com');
		// $this->email->cc('wasco.upload2@gmail.com');
		$this->email->subject('Sharp Printer Details');
        $this->email->attach('C:\xampp\htdocs\copier\assets\attachment\Guide-Input-Password-Printer-Sharp.pdf');
        $this->email->attach('C:\xampp\htdocs\copier\assets\attachment\Guide-Scan-Doc-Machine-Printer-Sharp.pdf');
		$this->email->message($this->load->view('contents/message_body_printer', $data, TRUE));
        // var_dump($this->email);
        // var_dump($this->email->send());die;
		if ($this->email->send()) {
			$message = '<div class="alert alert-success">Email sent to ' . $data['recipient'] . ' successfully</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url('c_employee_details'));
		} else {
			$message = '<div class="alert alert-danger">The email was not sent!</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url('c_employee_details'));
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

    public function duplicate_table($source_db, $destination_db, $orderby, $tblname) {
        $limit = $source_db - $destination_db;
        $difference = $this->m_copier_registration->get_difference($limit, $orderby, $tblname);
        $this->m_copier_registration->duplicate_table($difference, $limit, $tblname);
    }

	// public function form_import_register() {
    //     $data['header'] = $this->load->view('headers/head', '', TRUE);
    //     $data['menu'] = '';
    //     $data['navigation'] = $this->load->view('headers/navigation', '', TRUE);
    //     $data['cover'] = $this->load->view('headers/cover', '', TRUE);
    //     $data['content'] = $this->load->view('forms/form_import_register', $data, TRUE);
    //     $data['footer'] = $this->load->view('footers/footer', '', TRUE);
    //     $this->load->view('main', $data);
	// }

	public function upload_register() {
		$departments = $this->m_employee->get_department();
		$positions = $this->m_employee->get_position();
		
		$file_upload = $_FILES['file_upload']['name'];
		$extension =  pathinfo($file_upload, PATHINFO_EXTENSION);

		if ($extension == 'xls') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
		} else if ($extension == 'xlsx') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		} else {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
		}

		$spreedsheet = $reader->load($_FILES['file_upload']['tmp_name']);
		$datasheets = $spreedsheet->getActiveSheet()->toArray();
		$data_upload = [];
		for ($i = 1; $i < count($datasheets); $i++) {
			foreach ($departments as $department) {	
				if (isset($datasheets[$i][5])) {		
					if ($datasheets[$i][5] == $department->deptdesc){
							$iddept = $department->iddept;
					}	
				} else {
					$iddept = NULL;
				}
			}
			
			foreach ($positions as $position) {
				if (isset($datasheets[$i][6])) {
					if ($datasheets[$i][6] == $position->positiondesc) {
						$idposition = $position->idposition;
					} 
				} else {
					$idposition = NULL;
				}
			}

			$data_upload[] = [
				'idemployee' => $datasheets[$i][1],
				'others_password' => $datasheets[$i][2],
				'sharp_password' => $datasheets[$i][3],
				'employeename' => $datasheets[$i][4],
				'iddept' => $iddept,
				'idposition' => $idposition,
				'email' => $datasheets[$i][7]
			];
		}

		if ($this->m_copier_registration->upload_register($data_upload)) {
			$message = '<div class="alert alert-success">Upload Success</div>';
			$this->session->set_flashdata('message', $message);
			redirect(base_url('c_employee_details'));
		} else {
			$message = '<div class="alert alert-danger">Upload Failed</div>';
			$this->session->set_flashdata('message', $message);
			redirect(base_url('c_employee_details'));
		}
	}
}

	