<?php
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use function PHPSTORM_META\map;

defined('BASEPATH') OR exit('No direct script access allowed');

class C_employee_details extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('m_copier_registration');
		$this->load->model('m_user');
		$this->load->model('m_employee');
		$this->load->model('m_ldap_users');
		$this->load->model('m_copier_registration');
		if ( !$this->session->userdata('username') ){
			redirect(base_url(). 'login');
		}	
	}

	
	public function index($page = 0) {
		$data['header'] = $this->load->view('headers/head', '', TRUE);
		$data['menu'] = '';
		$data['navigation'] = $this->load->view('headers/navigation', '', TRUE);
		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['content'] = $this->load->view('contents/vCopierRegistration', $data, TRUE);
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);
		$this->load->view('main', $data);
	}

	public function get_registration_data() {
		$copier_registrations = $this->m_copier_registration->get_registration_data();
		// echo $this->db->last_query();
		// var_dump($copier_registrations);
		// var_dump($this->m_copier_registration->count_all_registration_data());
		// var_dump($this->m_copier_registration->count_filtered_registration_data());
		$no = $_POST['start'];
		foreach ($copier_registrations as $copier_registration) {
			if ($copier_registration->ldap_id === null || $copier_registration->name === null){
				$employeename = $copier_registration->employeename;
				$deptdesc = $copier_registration->deptdesc;
				$positiondesc = $copier_registration->positiondesc;
				$email = $copier_registration->email;
			} else {
				$employeename = $copier_registration->name;
				$deptdesc = $copier_registration->department;
				$positiondesc = $copier_registration->position;
				$email = $copier_registration->ldap_email;
			}
			$id = $copier_registration->id;
			$row =  array();
			$row[] = $id;
			$row[] = ++$no;
			$row[] = $copier_registration->idemployee;
			$row[] = $copier_registration->sharp_password;
			$row[] = $copier_registration->others_password;
			$row[] = $employeename;
			$row[] = $deptdesc;
			$row[] = $positiondesc;
			$row[] = $email;
			$data[] = $row;
		}

		if (isset($data)) {
			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->m_copier_registration->count_all_registration_data(),
				"recordsFiltered" => $this->m_copier_registration->count_filtered_registration_data(),
				"data" => $data
			);
		} else {
			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->m_copier_registration->count_all_registration_data(),
				"recordsFiltered" => $this->m_copier_registration->count_filtered_registration_data(),
				"data" => array()
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function search($selSearch = false, $txtSearch = false){
        if (!$selSearch AND !$txtSearch) {
                $selSearch = $this->input->post('selSearch');
                $txtSearch = htmlspecialchars($this->input->post('txtSearch'));
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
			// var_dump($this->input->post());die;
			$this->load->library('form_validation');
			$this->form_validation->set_rules('txt_sharp_password', 'Sharp Password', 'is_unique[copier_id.sharp_password]');
			$this->form_validation->set_rules('txt_idemployee', 'Employee ID', 'is_unique[copier_id.idemployee]');
			if(!$this->input->post('txt_employee_email')) {
				$this->form_validation->set_rules('client', 'Client Checkbox', 'required');
			}

			if ($this->form_validation->run()) {
				$form_info['client'] = $this->input->post('client', TRUE);
				$form_info['txt_sharp_password'] = $this->input->post('txt_sharp_password', TRUE);
				$form_info['txt_others_password'] = substr($form_info['txt_sharp_password'], 1);
				if($form_info['client']) {
					$form_info['ldap_id'] = null;
					$form_info['txt_employee_name'] = $this->input->post('txt_employee_name', TRUE);
					$form_info['iddept'] = $form_info['client'];
					$form_info['txt_idemployee'] = null;
					$form_info['isclient'] = 1;
				} else {
					$form_info['ldap_id'] = $this->input->post('txt_ldap_id', TRUE);
					$form_info['txt_employee_name'] = null;
					$form_info['iddept'] = null;
					$form_info['isclient'] = null;
					$form_info['txt_idemployee'] = $this->input->post('txt_idemployee');
				}

				$form_info['txt_idposition'] = null;
				
				if ($this->m_copier_registration->save_register($form_info)) {
					$message = '<div class="alert alert-success">Success</div>';
					$this->session->set_flashdata('message', $message);
					redirect(base_url('c_employee_details'));
				} else {
					$message = '<div class="alert alert-danger">Failed</div>';
					$this->session->set_flashdata('message', $message);
					redirect(base_url('c_employee_details/register_password'));
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

    public function modify_copier_registration($id) {
		
        $data['copier_registration'] = $this->m_copier_registration->get_registration_by_id($id);
        $data['header'] = $this->load->view('headers/head', '', TRUE);
        $data['menu'] = '';
        $data['navigation'] = $this->load->view('headers/navigation', '', TRUE);
        $data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['departments'] = $this->m_employee->get_department();
		$data['positions'] = $this->m_employee->get_position();
        $data['content'] = $this->load->view('forms/form_modify_copier_registration', $data, TRUE);
        $data['footer'] = $this->load->view('footers/footer', '', TRUE);
        $this->load->view('main', $data);
    }

	public function update_copier_registration() {
		// $this->load->library('form_validation');
		// $this->form_validation->set_rules('txt_other_password', 'Others Password');
		// $this->form_validation->set_rules('txt_sharp_password', 'Sharp Password');
		// $this->form_validation->set_rules('txt_employeeid', 'Employee ID');
		// $this->form_validation->set_rules('txt_employeename', 'Employee Name');
		// $this->form_validation->set_rules('txt_email', 'Email');

		// if ($this->form_validation->run()) {
			$id = $this->input->post('copier_id', TRUE);
			$form_info['client'] = $this->input->post('client_value', TRUE);
			$form_info['txt_sharp_password'] = $this->input->post('txt_sharp_password', TRUE);
			$form_info['txt_others_password'] = substr($form_info['txt_sharp_password'], 1);

			if($form_info['client']) {
				$form_info['ldap_id'] = null;
				$form_info['txt_employeename'] = $this->input->post('txt_employeename', TRUE);
				$form_info['iddept'] = $form_info['client'];
				$form_info['txt_idemployee'] = null;
				$form_info['isclient'] = 1;
			} else {
				$form_info['ldap_id'] = $this->input->post('txt_ldap_id', TRUE);
				$form_info['txt_employee_name'] = null;
				$form_info['iddept'] = null;
				$form_info['txt_employeeid'] = $this->input->post('txt_employeeid', TRUE);
				$form_info['isclient'] = null;
			}
			if ($this->m_copier_registration->update_register($form_info, $id)) {
				$message = '<div class="alert alert-success">Success</div>';
				$this->session->set_flashdata('message', $message);
				redirect(base_url('c_employee_details/'));
			} else {
				$message = '<div class="alert alert-danger">Failed</div>';
				$this->session->set_flashdata('message', $message);
				redirect(base_url('c_employee_details'));
			}
		// }
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
	
    // public function send_email_employee_details($id) {
	// 	$employee = $this->m_copier_registration->get_registration_by_id($id);
	// 	$admin = $this->m_user->get_users();
	// 	$this->load->library('email');
    //     $sender = 'no-reply@wascoenergy.com';
    //     $pass = 'password.88';
	// 	$data = [];
	// 	$data['username'] = ($employee->ldap_id === null) ? $employee->email : $employee->ldap_email;
	// 	$data['recipient'] = ($employee->ldap_id === null) ? $employee->email : $employee->ldap_email . '@wascoenergy.com';
	// 	$data['sender'] = 'no-reply@wascoenergy.com';
	// 	$data['idemployee'] = $employee->idemployee;
	// 	$data['employeename'] = ($employee->ldap_id === null) ? $employee->employeename : $employee->name;
	// 	$data['deptdesc'] = ($employee->ldap_id === null) ? $employee->deptdesc : $employee->department;
	// 	$data['positiondesc'] = ($employee->ldap_id === null) ? $employee->positiondesc : $employee->position;
	// 	$data['others_password'] = $employee->others_password;
	// 	$data['sharp_password'] = $employee->sharp_password;
	// 	$config = [];
	// 	$config['protocol'] = 'smtp';
	// 	$config['charset'] = 'iso-8859-1';
	// 	$config['wordwrap'] = FALSE;
	// 	$config['smtp_host'] = 'smtp-relay.wascoenergy.com';
	// 	$config['smtp_user'] = $sender;
	// 	$config['smtp_pass'] = $pass;
	// 	$config['smtp_port'] = '587';
	// 	$config['smtp_crypto'] = 'tls';
	// 	$config['newline'] = "\r\n";
	// 	$config['mailtype'] = 'html';

	// 	$this->email->initialize($config);			
	// 	$this->email->from($sender, 'WEI MIS');
	// 	$this->email->to((($employee->ldap_id === null) ? $employee->email : $employee->ldap_email) . '@wascoenergy.com');
		
	// 	$is_cc = [];
	// 	foreach ($admin as $list) {
	// 		$is_cc[] = $list->email;
	// 	}

	// 	function modify($str) {
	// 		return $str . '@wascoenergy.com';
	// 	}

	// 	$list_admin = array_map('modify', $is_cc);
	// 	$this->email->cc(join(", ", $list_admin));
	// 	// $this->email->cc('wahyu.maulana@wascoenergy.com, ichwan.maulana@wascoenergy.com, mustafa.m@wascoenergy.com');
	// 	$this->email->subject('Employee Details');
	// 	$this->email->attach($_SERVER["DOCUMENT_ROOT"]."/copier"."/assets"."/attachment/Guide-to-Create-Timesheet.pdf");
	// 	$this->email->attach($_SERVER["DOCUMENT_ROOT"]."/copier"."/assets"."/attachment/Guide-Input-Password-Printer-Sharp.pdf");
	// 	$this->email->attach($_SERVER["DOCUMENT_ROOT"]."/copier"."/assets"."/attachment/Guide-Scan-Doc-Machine-Printer-Sharp.pdf");
	// 	$this->email->message($this->load->view('contents/message_body', $data, TRUE));
	// 	if ($this->email->send()) {
	// 		$message = '<div class="alert alert-success">Employee Details sent to ' . $data['recipient'] . ' successfully</div>';
    //         $this->session->set_flashdata('message', $message);
    //         redirect(base_url('c_employee_details'));
	// 	} else {
	// 		$message = '<div class="alert alert-danger">Employee Details was not sent!</div>';
    //         $this->session->set_flashdata('message', $message);
    //         redirect(base_url('c_employee_details'));
	// 	}
	// }

    public function send_email_employee_details() {
		$admin = $this->m_user->get_users();
		$this->load->library('email');
        $sender = 'no-reply@wascoenergy.com';
        $pass = 'password.88';
		$id = $this->input->post();
		$sent_emails = [];
		$failed_emails = [];
		// var_dump($id['postData']);die;
		// $id = ['18', '207'];
		function modify($str) {
			return $str . '@wascoenergy.com';
		} 
		$employees = $this->m_copier_registration->get_email_recipients($id['postData']);
		foreach($employees as $employee) {
			$data = [];
			$data['username'] = ($employee->ldap_id === null) ? $employee->email : $employee->ldap_email;
			$data['recipient'] = ($employee->ldap_id === null) ? $employee->email : $employee->ldap_email . '@wascoenergy.com';
			$data['sender'] = 'no-reply@wascoenergy.com';
			$data['idemployee'] = $employee->idemployee;
			$data['employeename'] = ($employee->ldap_id === null) ? $employee->employeename : $employee->name;
			$data['deptdesc'] = ($employee->ldap_id === null) ? $employee->deptdesc : $employee->department;
			$data['positiondesc'] = ($employee->ldap_id === null) ? $employee->positiondesc : $employee->position;
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
			$this->email->to((($employee->ldap_id === null) ? $employee->email : $employee->ldap_email) . '@wascoenergy.com');
			
			$is_cc = [];
			foreach ($admin as $list) {
				$is_cc[] = $list->email;
			}
	
			// function modifying($str) {
			// 	return $str . '@wascoenergy.com';
			// }
	
			$list_admin = array_map('modify', $is_cc);
			$this->email->cc(join(", ", $list_admin));
			// $this->email->cc('wahyu.maulana@wascoenergy.com, ichwan.maulana@wascoenergy.com, mustafa.m@wascoenergy.com');
			$this->email->subject('Employee Details');
			// $this->email->attach($_SERVER["DOCUMENT_ROOT"]."/copier"."/assets"."/attachment/Guide-to-Create-Timesheet.pdf");
			// $this->email->attach($_SERVER["DOCUMENT_ROOT"]."/copier"."/assets"."/attachment/Guide-Input-Password-Printer-Sharp.pdf");
			// $this->email->attach($_SERVER["DOCUMENT_ROOT"]."/copier"."/assets"."/attachment/Guide-Scan-Doc-Machine-Printer-Sharp.pdf");
			$this->email->message($this->load->view('contents/message_body', $data, TRUE));
			if ($this->email->send()) {
				array_push($sent_emails, $employee->name);
			} else {
				array_push($failed_emails, $employee->name);
			}
			// } else {
			// 	$message = '<div class="alert alert-danger">Sharp Detail was not sent!</div>';
			// 	$this->session->set_flashdata('message', $message);
			// 	redirect(base_url('c_employee_details'));
			// }
		}
		if(count($id['postData']) === count($sent_emails)) {
			// $output = [
			// 	"status" => "success",
			// 	"data" => $sent_emails
			// ];
			echo "Email has been sent to " . join(", ", $sent_emails);
		} else {
			// $output = [
			// 	"status" => "fail",
			// 	"data" => $failed_emails
			// ];
			echo "Sending Email to " . join(", ", $failed_emails) . "was failed";
		}

		// echo $output;
 
    // public function send_email_sharp_details($id) {
	// 	$admin = $this->m_user->get_users();
	// 	$this->load->library('email');
    //     $sender = 'no-reply@wascoenergy.com';
    //     $pass = 'password.88';
	// 	$employee = $this->m_copier_registration->get_registration_by_id($id);
	// 	$data = [];
	// 	$data['recipient'] = ($employee->ldap_id === null) ? $employee->email : $employee->ldap_email . '@wascoenergy.com';
	// 	$data['sender'] = $sender;
	// 	$data['idemployee'] = $employee->idemployee;
	// 	$data['employeename'] = ($employee->ldap_id === null ) ? $employee->employeename : $employee->name;
	// 	$data['deptdesc'] =($employee->ldap_id === null ) ?  $employee->deptdesc : $employee->department;
	// 	$data['positiondesc'] = ($employee->ldap_id === null ) ? $employee->positiondesc : $employee->position;
	// 	$data['others_password'] = $employee->others_password;
	// 	$data['sharp_password'] = $employee->sharp_password;
	// 	$config = [];
	// 	$config['protocol'] = 'smtp';
	// 	$config['charset'] = 'utf-8';
	// 	$config['wordwrap'] = FALSE;
	// 	$config['smtp_host'] = 'smtp-relay.wascoenergy.com';
	// 	$config['smtp_user'] = $sender;
	// 	$config['smtp_pass'] = $pass;
	// 	$config['smtp_port'] = '587';
	// 	$config['smtp_crypto'] = 'tls';
	// 	$config['newline'] = "\r\n";
	// 	$config['mailtype'] = 'html';
        
	// 	$this->email->initialize($config);	

	// 	$this->email->from($sender, 'WEI MIS');
	// 	$this->email->to((($employee->ldap_id === null) ? $employee->email : $employee->ldap_email) . '@wascoenergy.com');

	// 	$is_cc = [];
	// 	foreach ($admin as $list) {
	// 		$is_cc[] = $list->email;
	// 	}

	// 	function modifying($str) {
	// 		return $str . '@wascoenergy.com';
	// 	}

	// 	$list_admin = array_map('modifying', $is_cc);
	// 	$this->email->cc(join(", ", $list_admin));

	// 	// $this->email->cc('wahyu.maulana@wascoenergy.com, mustafa.m@wascoenergy.com, ichwan.maulana@wascoenergy.com');
	// 	$this->email->subject('Sharp Printer Details');
    //   		$this->email->attach($_SERVER["DOCUMENT_ROOT"]."/copier"."/assets"."/attachment/Guide-to-Create-Timesheet.pdf");
	// 	$this->email->attach($_SERVER["DOCUMENT_ROOT"]."/copier"."/assets"."/attachment/Guide-Input-Password-Printer-Sharp.pdf");
	// 	$this->email->message($this->load->view('contents/message_body_printer', $data, TRUE));
	// 	if ($this->email->send()) {
	// 		$message = '<div class="alert alert-success">Sharp Detail sent to ' . $data['recipient'] . ' successfully</div>';
    //         $this->session->set_flashdata('message', $message);
    //         redirect(base_url('c_employee_details'));
	// 	} else {
	// 		$message = '<div class="alert alert-danger">Sharp Detail was not sent!</div>';
    //         $this->session->set_flashdata('message', $message);
    //         redirect(base_url('c_employee_details'));
	// 	}
	}

	public function get_department() {
		$departments = $this->m_copier_registration->get_department();
		$option = '';
		foreach($departments as $department) {
			$option .= '<option value=' . $department->iddept . '>' . $department->deptdesc . '</option>';
		}
		echo json_encode($option);
	}

    public function duplicate_table($source_db, $destination_db, $orderby, $tblname) {
        $limit = $source_db - $destination_db;
        $difference = $this->m_copier_registration->get_difference($limit, $orderby, $tblname);
        $this->m_copier_registration->duplicate_table($difference, $limit, $tblname);
    }

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

	public function export_register() {
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="list_copier.xlsx"');
		$spreedsheet = new Spreadsheet();
		$sheet = $spreedsheet->getActiveSheet();
		$sheet->setCellValue('B1', 'ID');
		$sheet->setCellValue('C1', 'Others Password');
		$sheet->setCellValue('D1', 'Sharp Password');
		$sheet->setCellValue('E1', 'Name');
		$sheet->setCellValue('F1', 'Department');
		$sheet->setCellValue('G1', 'Job Title');
		$sheet->setCellValue('H1', 'Email');

		$datum = $this->m_copier_registration->get_registration_export();

		$row_number = 2;
		foreach ($datum as $data) {
			$sheet->setCellValue('B'. $row_number, $data->idemployee);
			$sheet->setCellValue('C'. $row_number, $data->others_password);
			$sheet->setCellValue('D'. $row_number, $data->sharp_password);
			$sheet->setCellValue('E'. $row_number, ($data->ldap_id === null) ? $data->employeename : $data->name);
			$sheet->setCellValue('F'. $row_number, ($data->ldap_id === null) ? $data->deptdesc : $data->department);
			$sheet->setCellValue('G'. $row_number, ($data->ldap_id === null) ? $data->positiondesc : $data->position);
			$sheet->setCellValue('H'. $row_number, ($data->ldap_id === null) ? $data->email : $data->ldap_email);
			$row_number++;
		}

		$writer = new Xlsx($spreedsheet);
		$writer->save("php://output");
	}
	
	public function export_department() {
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="list_copier.xlsx"');
		$spreedsheet = new Spreadsheet();
		$sheet = $spreedsheet->getActiveSheet();
		$sheet->setCellValue('B1', 'ID');
		$sheet->setCellValue('C1', 'Others Password');
		$sheet->setCellValue('D1', 'Sharp Password');
		$sheet->setCellValue('E1', 'Name');
		$sheet->setCellValue('F1', 'Department');
		$sheet->setCellValue('G1', 'Job Title');
		$sheet->setCellValue('H1', 'Email');

		$datum = $this->m_copier_registration->get_registration_export();

		$row_number = 2;
		foreach ($datum as $data) {
			$sheet->setCellValue('B'. $row_number, $data->idemployee);
			$sheet->setCellValue('C'. $row_number, $data->others_password);
			$sheet->setCellValue('D'. $row_number, $data->sharp_password);
			$sheet->setCellValue('E'. $row_number, $data->employeename);
			$sheet->setCellValue('F'. $row_number, $data->deptdesc);
			$sheet->setCellValue('G'. $row_number, $data->positiondesc);
			$sheet->setCellValue('H'. $row_number, $data->email);
			$row_number++;
		}

		$writer = new Xlsx($spreedsheet);
		$writer->save("php://output");
	}

	public function download_template() {
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="upload_template.xlsx"');
		$spreedsheet = new Spreadsheet();
		$sheet = $spreedsheet->getActiveSheet();
		$sheet->setCellValue('B1', 'ID');
		$sheet->setCellValue('C1', 'Others Password');
		$sheet->setCellValue('D1', 'Sharp Password');
		$sheet->setCellValue('E1', 'Name');
		$sheet->setCellValue('F1', 'Department');
		$sheet->setCellValue('G1', 'Job Title');
		$sheet->setCellValue('H1', 'Email');
		$writer = new Xlsx($spreedsheet);
		$writer->save("php://output");
	}

	
	
	
	public function pdf_register($id) {
		$employee = $this->m_copier_registration->get_registration_by_id($id);
		$data['recipient'] = $employee->email . '@wascoenergy.com';
		$data['idemployee'] = $employee->idemployee;
		$data['employeename'] = $employee->employeename;
		$data['deptdesc'] = $employee->deptdesc;
		$data['positiondesc'] = $employee->positiondesc;
		$data['others_password'] = $employee->others_password;
		$data['sharp_password'] = $employee->sharp_password;

		$html = $this->load->view('contents/print_register', $data, TRUE);

		$mpdf = new \Mpdf\Mpdf();
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	public function get_last_sharp_password() {
		$last_sharp_password = $this->m_copier_registration->get_last_sharp_password();
		if ($last_sharp_password ) {
			echo $last_sharp_password->sharp_password;
		}
	}

	public function client_subcon() {
		$data['copier_registrations'] = $this->m_copier_registration->get_client_subcon();
		$data['header'] = $this->load->view('headers/head', '', TRUE);
		$data['menu'] = '';
		$data['navigation'] = $this->load->view('headers/navigation', '', TRUE);
		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['content'] = $this->load->view('contents/vCopierRegistrationClient', $data, TRUE);
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);
		$this->load->view('main', $data);
	}

	public function ldap_users() {
		$this->WEI();
		$this->WEIL();
		$this->WESS_SG();
	}

	public function WEI() {
		$username = "sghelpdeskadmin@WASCOENERGY";
		$password = "w@5c0@sg";
		$ldapconn = ldap_connect("192.168.40.3");
		// $ldapconn = ldap_connect("172.88.88.81");
		@ldap_bind($ldapconn, $username, $password);
			$ad_departments = [
				'WEI-BT-Consultant',
				'WEI-BT-Engineering',
				'WEI-BT-Finance',
				'WEI-BT-Groups',
				'WEI-BT-HR',
				'WEI-BT-HSE',
				'WEI-BT-MIS',
				'WEI-BT-Operations',
				'WEI-BT-Production',
				'WEI-BT-Projects',
				'WEI-BT-QAQC',
				'WEI-BT-SCM',
			];
		
		foreach ($ad_departments as $department) {
			$attrib = [
				"dn", 
				"displayname", 
				"mail", 
				"title", 
				"mobile", 
				"st", 
				"co", 
				"usncreated", 
				"department", 
				"samaccountname"
			];
			$dn = "OU=" . $department . ",OU=WEI,OU=Engineering,OU=Wasco Energy Group,DC=wascoenergy,DC=wasco,DC=global";
			$filter = "(&(&(&(objectCategory=person)(objectClass=user))))";
			$search = @ldap_search($ldapconn, $dn, $filter, $attrib);
			
			if ($search != '') {
				$entries = ldap_get_entries($ldapconn, $search);
				if ($entries['count'] > 0) {
					unset($entries['count']);
						$this->save_ldap_users($entries);
						// $this->save_ldap_users($entries, substr($department, 7));
				}
			}
		}
	}
	
	public function WEIL() {
		$username = "sghelpdeskadmin@WASCOENERGY";
		$password = "w@5c0@sg";
		$ldapconn = ldap_connect("192.168.40.3");
		// $ldapconn = ldap_connect("172.88.88.81");
		@ldap_bind($ldapconn, $username, $password);
			$ad_departments = [
				'WEIL-DB-Admin',
				'WEIL-DB-Corporate',
				'WEIL-DB-Engineering',
				'WEIL-DB-Estimating',
				'WEIL-DB-Finance',
				'WEIL-DB-Groups',
				'WEIL-DB-HR',
				'WEIL-DB-HSE',
				'WEIL-DB-MIS',
				'WEIL-DB-Operations',
				'WEIL-DB-Projects',
				'WEIL-DB-QAQC',
				'WEIL-DB-Sales',
				'WEIL-DB-SCM',
				'WEIL-DB-Sites',
				'WEIL-DB-Sites2',
				'WEIL-DB-VPN',
				'WEIL-DB-Workshop',
			];
		
		foreach ($ad_departments as $department) {
			$attrib = [
				"dn", 
				"displayname", 
				"mail", 
				"title", 
				"mobile", 
				"st", 
				"co", 
				"usncreated", 
				"department", 
				"samaccountname"
			];
			$dn = "OU=" . $department . ",OU=WEIL,OU=Engineering,OU=Wasco Energy Group,DC=wascoenergy,DC=wasco,DC=global";
			$filter = "(&(&(&(objectCategory=person)(objectClass=user))))";
			$search = @ldap_search($ldapconn, $dn, $filter, $attrib);
			if ($search != '') {
				$entries = ldap_get_entries($ldapconn, $search);
				if ($entries['count'] > 0) {
					unset($entries['count']);
						$this->save_ldap_users($entries, substr($department, 8));
				}
			}
		}
	}
	
	public function WESS_SG() {
		$username = "sghelpdeskadmin@WASCOENERGY";
		$password = "w@5c0@sg";
		$ldapconn = ldap_connect("192.168.40.3");
		// $ldapconn = ldap_connect("172.88.88.81");
		@ldap_bind($ldapconn, $username, $password);
			$ad_departments = [
				'WESS-SG-Contracts',
				'WESS-SG-Corporate',
				'WESS-SG-Engineering',
				'WESS-SG-Estimating',
				'WESS-SG-Finance',
				'WESS-SG-Groups',
				'WESS-SG-HR',
				'WESS-SG-HSE',
				'WESS-SG-MIS',
				'WESS-SG-Operations',
				'WESS-SG-Projects',
				'WESS-SG-QAQC',
				'WESS-SG-Sales',
				'WESS-SG-SCM',
			];
		
		foreach ($ad_departments as $department) {
			$attrib = [
				"dn", 
				"displayname", 
				"mail", 
				"title", 
				"mobile", 
				"st", 
				"co", 
				"usncreated", 
				"department", 
				"samaccountname"
			];
			$dn = "OU=" . $department . ",OU=SG, OU=WESS, OU=Engineering,OU=Wasco Energy Group,DC=wascoenergy,DC=wasco,DC=global";
			$filter = "(&(&(&(objectCategory=person)(objectClass=user))))";
			$search = @ldap_search($ldapconn, $dn, $filter, $attrib);
			if ($search != '') {
				$entries = ldap_get_entries($ldapconn, $search);
				if ($entries['count'] > 0) {
					unset($entries['count']);
						$this->save_ldap_users($entries, substr($department, 8));
				}
			}
		}
	}

	public function save_ldap_users($entries) {
		foreach($entries as $entry) {
			$ldap_user['ldap_email'] = $entry['samaccountname'][0];
			$ldap_users = $this->m_ldap_users->get_ldap_user($ldap_user['ldap_email']);
			if(!$ldap_users) {
				$ldap_user['name'] = $entry['displayname'][0];
				$department = $this->verify_department($entry['department'][0]);
				$ldap_user['department'] = $department;
				if(isset($entry['title'][0])) {
					$ldap_user['position'] = $entry['title'][0];
				}
				$this->m_ldap_users->save_ldap_user($ldap_user);
			} else {
				
				$ldap_user['name'] = $entry['displayname'][0];
				$department = $this->verify_department($entry['department'][0]);
				$ldap_user['department'] = $department;
				if(isset($entry['title'][0])) {
					$ldap_user['position'] = $entry['title'][0];
				}
				$this->m_ldap_users->update_ldap_user($ldap_user, $ldap_users->ldap_email);
			}
		}
	}

	public function verify_department ($department) {
		if(
			strpos($department, 'Engineering') !== false ||
			strpos($department, 'engineering') !== false 
		) {
			$departmentResult = 'Engineering';
		} elseif(
			strpos($department, 'Finance') !== false || 
			strpos($department, 'finance') !== false
		) {
			$departmentResult = 'Finance';	
		} elseif(
			strpos($department, 'HR') !== false || 
			strpos($department, 'hr') !== false
		) {
			$departmentResult = 'HR';	
		} elseif(
			strpos($department, 'HSE') !== false || 
			strpos($department, 'hse') !== false
		) {
			$departmentResult = 'HSE';	
		} elseif(
			strpos($department, 'MIS') !== false || 
			strpos($department, 'mis') !== false
		) {
			$departmentResult = 'MIS';	
		} elseif(
			strpos($department, 'QAQC') !== false || 
			strpos($department, 'qaqc') !== false || 
			strpos($department, 'QA/QC') !== false ||
			strpos($department, 'qa/qc') !== false ||
			strpos($department, 'QC') !== false ||
			strpos($department, 'qc') !== false ||
			strpos($department, 'QA') !== false ||
			strpos($department, 'qa') !== false
		) {
			$departmentResult = 'QA/QC';	
		} elseif(
			strpos($department, 'SCM') !== false || 
			strpos($department, 'scm') !== false ||
			strpos($department, 'Supply Chain') !== false ||  
			strpos($department, 'supply Chain') !== false  
		) {
			$departmentResult = 'Supply Chain';	
		} elseif(
			strpos($department, 'Aftermarket') !== false || 
			strpos($department, 'aftermarket') !== false ||
			strpos($department, 'Sales') !== false || 
			strpos($department, 'sales') !== false || 
			strpos($department, 'Sales & Marketing') !== false || 
			strpos($department, 'Marketing') !== false || 
			strpos($department, 'marketing') !== false
		) {
			$departmentResult = 'Sales & Marketing';	
		} elseif(
			strpos($department, 'Workshop') !== false || 
			strpos($department, 'workshop') !== false
		) {
			$departmentResult = 'Workshop';	
		} elseif(
			strpos($department, 'Contracts') !== false || 
			strpos($department, 'contracts') !== false || 
			strpos($department, 'Contract') !== false || 
			strpos($department, 'contract') !== false 
		) {
			$departmentResult = 'Workshop';	
		}  elseif(
			strpos($department, 'PMT') !== false || 
			strpos($department, 'pmt') !== false || 
			strpos($department, 'Project & Operations') !== false || 
			strpos($department, 'project & operations') !== false || 
			strpos($department, 'Project & Operation') !== false || 
			strpos($department, 'project & operation') !== false || 
			strpos($department, 'Project') !== false ||
			strpos($department, 'project') !== false ||
			strpos($department, 'Projects') !== false || 
			strpos($department, 'projects') !== false || 
			strpos($department, 'Operation') !== false || 
			strpos($department, 'operation') !== false || 
			strpos($department, 'Production') !== false ||
			strpos($department, 'production') !== false ||
			strpos($department, 'Productions') !== false ||
			strpos($department, 'productions') !== false 
		) {
			$departmentResult = 'Project & Operations';
		} elseif(
			strpos($department, 'Estimating') !== false || 
			strpos($department, 'estimating') !== false || 
			strpos($department, 'Tendering & Estimation') !== false || 
			strpos($department, 'tendering & estimation') !== false || 
			strpos($department, 'estimation') !== false
		) {
			$departmentResult = 'Tendering & Estimation';
		} elseif(
			strpos($department, 'General Management') !== false || 
			strpos($department, 'general management') !== false || 
			strpos($department, 'Management') !== false || 
			strpos($department, 'management') !== false 
		) {
			$departmentResult = 'General Management';
		} elseif(
			strpos($department, 'Instrumentation') !== false || 
			strpos($department, 'instrumentation') !== false
		) {
			$departmentResult = 'Instrumentation';
		} else {
			$departmentResult = 'Uncategorized';
		}

		return $departmentResult;
	}
	public function get_ldap_users() {
		$ldap_users = $this->m_ldap_users->get_ldap_users();
		$no = $_POST['start'];
		foreach ($ldap_users as $ldap_user) {
			$row =  array();
			$row[] = ++$no;
			$row[] = $ldap_user->id;
			$row[] = $ldap_user->name;
			$row[] = $ldap_user->department;
			$row[] = $ldap_user->position;
			$row[] = $ldap_user->ldap_email;
			// $row[] = '<a id = "sendEmployeeDetails" href="' . base_url('c_employee_details/send_email_employee_details/') . $copier_registration->id . '"><i class="fa fa-user fa-2x"></i></a> <a class = "sendPrinterDetails" href="' . base_url('c_employee_details/send_email_sharp_details/') . $copier_registration->id . '"><i class="fa fa-print fa-2x"></i></a> <a href="' . base_url('c_employee_details/modify_copier_registration/') . $copier_registration->id . '"<i class="fa fa-edit fa-2x"></i></a>';
			$data[] = $row;
		}

		if (isset($data)) {
			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->m_ldap_users->count_all_data(),
				"recordsFiltered" => $this->m_ldap_users->count_filtered_data(),
				"data" => $data
			);
		} else {
			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->m_ldap_users->count_all_data(),
				"recordsFiltered" => $this->m_ldap_users->count_filtered_data(),
				"data" => array()
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function update_copier() {
		// $copiers = $this->m_copier_registration->get_existing_copier();
		$unduplicated_copiers = $this->m_copier_registration->get_unduplicated_copiers();
		foreach($unduplicated_copiers as $unduplicated_copier) {
			$existing_email = $unduplicated_copier->email;
			echo "Existing email: " . $existing_email;
			echo "<br>";
			$ldap_user = $this->m_ldap_users->get_ldap_user($existing_email);
			if($ldap_user) {

				// $oldest_duplicate = $this->m_ldap_users->get_old_duplicate($existing_email);
				// $old_id =  $oldest_duplicate['id'];
				// echo "oldest duplicate:" . $oldest_duplicate['email'];
				// $duplicate = $this->m_ldap_users->get_duplicate();
				// if ($duplicate) {
				// 	foreach($duplicate as $value) {
						// $oldest_data_id = $oldest['email'];
						// echo "oldest: " . $oldest_data_id;
						// echo "</br>";
					// }
				// }
				$ldap_id = $ldap_user->id;
				$this->m_copier_registration->update_copier_data($existing_email, $ldap_id);
			}
		}
		// $double = $this->m_ldap_users->get_double();
		// foreach($double as $value) {
		// 	$newest = $this->m_ldap_users->get_latest_double($value->email);
		// 	$ldap_data = $this->m_ldap_users->get_ldap_data($value->email);
		// 	$newest_data_id = $newest['id'];
		// 	$ldap_data_id = $ldap_data['id'];

		// 	$this->m_ldap_users->update_copier_double($ldap_data_id, $newest_data_id);
		// }
		
	}

	public function verify_recipient() {
		$id = $this->input->post('data');
		$id = explode(",", $id);
		$recipients = $this->m_copier_registration->get_email_recipients($id);
		$no = $_POST['start'];
		foreach ($recipients as $recipient) {
			if ($recipient->ldap_id === null || $recipient->name === null){
				$employeename = $recipient->employeename;
				$deptdesc = $recipient->deptdesc;
				$positiondesc = $recipient->positiondesc;
				$email = $recipient->email;
			} else {
				$employeename = $recipient->name;
				$deptdesc = $recipient->department;
				$positiondesc = $recipient->position;
				$email = $recipient->ldap_email;
			}
			$row = [];
			$row[] = ++$no;
			$row[] = $employeename;
			$row[] = $deptdesc;
			$row[] = $positiondesc;
			$row[] = $email;
			$data[] = $row;
		}

		if (isset($data)) {
			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->m_copier_registration->count_all_recipients($id),
				"recordsFiltered" => $this->m_copier_registration->count_filtered_recipients($id),
				"data" => $data
			);
		} else {
			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->m_copier_registration->count_all_recipients($id),
				"recordsFiltered" => $this->m_copier_registration->count_filtered_recipients($id),
				"data" => array()
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}
}

	