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
		// $config['base_url'] = base_url('c_employee_details/index');
		// $total_row = $this->m_copier_registration->count_registration_data();
		// // $config['total_rows'] = 50;
		// $config['total_rows'] = $total_row;
		// $config['per_page'] = 10;
		// $config['num_links'] = 5;
        // $config["uri_segment"] = 3;
        // $this->pagination->initialize($config);
		// if($this->uri->segment(3)){
        //     $page = ($this->uri->segment(3)) ;
        // }else{
        //     $page = 0;
        // }
		// $data['copier_registrations'] = $this->m_copier_registration->get_registration_data();
		// $data['copier_registrations'] = $this->m_copier_registration->get_registration_data($config['per_page'], $page);
		$data['header'] = $this->load->view('headers/head', '', TRUE);
		$data['menu'] = '';
		$data['navigation'] = $this->load->view('headers/navigation', '', TRUE);
		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['content'] = $this->load->view('contents/vCopierRegistration', $data, TRUE);
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);
		$this->load->view('main', $data);
	}

	public function get_registration_data() {
		// var_dump($this->input->post());
		$copier_registrations = $this->m_copier_registration->get_registration_data();
		$no = $_POST['start'];
		foreach ($copier_registrations as $copier_registration) {
			$row =  array();
			$row[] = ++$no;
			$row[] = $copier_registration->idemployee;
			$row[] = $copier_registration->sharp_password;
			$row[] = $copier_registration->others_password;
			$row[] = $copier_registration->employeename;
			$row[] = $copier_registration->deptdesc;
			$row[] = $copier_registration->positiondesc;
			$row[] = $copier_registration->email;
			$row[] = $copier_registration->id;
			// $row[] = '<a id = "sendEmployeeDetails" href="' . base_url('c_employee_details/send_email_employee_details/') . $copier_registration->id . '"><i class="fa fa-user fa-2x"></i></a> <a class = "sendPrinterDetails" href="' . base_url('c_employee_details/send_email_sharp_details/') . $copier_registration->id . '"><i class="fa fa-print fa-2x"></i></a> <a href="' . base_url('c_employee_details/modify_copier_registration/') . $copier_registration->id . '"<i class="fa fa-edit fa-2x"></i></a>';
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
			$this->form_validation->set_rules('txt_others_password', 'Others Password', 'is_unique[copier_id.others_password]');
			$this->form_validation->set_rules('txt_sharp_password', 'Sharp Password', 'is_unique[copier_id.sharp_password]');
			$this->form_validation->set_rules('txt_idemployee', 'Employee ID', 'is_unique[copier_id.idemployee]');
			$this->form_validation->set_rules('txt_employee_name', 'Employee Name');
			$this->form_validation->set_rules('txt_employee_email', 'Email');

			if ($this->form_validation->run()) {
				$form_info['txt_others_password'] = $this->input->post('txt_others_password', TRUE);
				$form_info['txt_sharp_password'] = $this->input->post('txt_sharp_password', TRUE);
				$form_info['txt_idemployee'] = $this->input->post('txt_idemployee', TRUE);
				$form_info['txt_employee_name'] = $this->input->post('txt_employee_name', TRUE);
				$form_info['sel_dept'] = $this->input->post('sel_dept', TRUE);
				$form_info['sel_position'] = $this->input->post('sel_position', TRUE);
				$form_info['txt_employee_email'] = $this->input->post('txt_employee_email', TRUE);
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
			$form_info['txt_other_password'] = $this->input->post('txt_other_password', TRUE);
			$form_info['txt_sharp_password'] = $this->input->post('txt_sharp_password', TRUE);
			$form_info['txt_employeeid'] = $this->input->post('txt_employeeid', TRUE);
			$form_info['txt_employeename'] = $this->input->post('txt_employeename', TRUE);
			$form_info['sel_dept'] = $this->input->post('sel_dept', TRUE);
			$form_info['sel_position'] = $this->input->post('sel_position', TRUE);
			$form_info['txt_email'] = $this->input->post('txt_email', TRUE);
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
	
    public function send_email_employee_details($id) {
		$employee = $this->m_copier_registration->get_registration_by_id($id);
		$this->load->library('email');
        $sender = 'no-reply@wascoenergy.com';
        $pass = 'password.88';
		$data = [];
		$data['username'] = $employee->email;
		$data['recipient'] = $employee->email . '@wascoenergy.com';
		$data['sender'] = 'no-reply@wascoenergy.com';
		$data['idemployee'] = $employee->idemployee;
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
		$this->email->to($employee->email . '@wascoenergy.com');
		$this->email->cc('wahyu.maulana@wascoenergy.com, mustafa.m@wascoenergy.com, ichwan.maulana@wascoenergy.com');
		$this->email->subject('Employee Details');
		$this->email->attach($_SERVER["DOCUMENT_ROOT"]."/copier"."/assets"."/attachment/Guide-to-Create-Timesheet.pdf");
		$this->email->attach($_SERVER["DOCUMENT_ROOT"]."/copier"."/assets"."/attachment/Guide-Input-Password-Printer-Sharp.pdf");
		$this->email->attach($_SERVER["DOCUMENT_ROOT"]."/copier"."/assets"."/attachment/Guide-Scan-Doc-Machine-Printer-Sharp.pdf");
		$this->email->message($this->load->view('contents/message_body', $data, TRUE));
		
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
	
    public function send_email_sharp_details($id) {
		$this->load->library('email');
        $sender = 'no-reply@wascoenergy.com';
        $pass = 'password.88';
		$employee = $this->m_copier_registration->get_registration_by_id($id);
		$data = [];
		$data['recipient'] = $employee->email . '@wascoenergy.com';
		$data['sender'] = $sender;
		$data['idemployee'] = $employee->idemployee;
		$data['employeename'] = $employee->employeename;
		$data['deptdesc'] = $employee->deptdesc;
		$data['positiondesc'] = $employee->positiondesc;
		$data['others_password'] = $employee->others_password;
		$data['sharp_password'] = $employee->sharp_password;
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
		$this->email->to($employee->email . '@wascoenergy.com');
		$this->email->cc('wahyu.maulana@wascoenergy.com, mustafa.m@wascoenergy.com, ichwan.maulana@wascoenergy.com');
		$this->email->subject('Sharp Printer Details');
      		$this->email->attach($_SERVER["DOCUMENT_ROOT"]."/copier"."/assets"."/attachment/Guide-to-Create-Timesheet.pdf");
		$this->email->attach($_SERVER["DOCUMENT_ROOT"]."/copier"."/assets"."/attachment/Guide-Input-Password-Printer-Sharp.pdf");
		//$this->email->attach($_SERVER["DOCUMENT_ROOT"]."/copier"."/assets"."/attachment/Guide-Scan-Doc-Machine-Printer-Sharp.pdf");
		$this->email->message($this->load->view('contents/message_body_printer', $data, TRUE));
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
			$sheet->setCellValue('E'. $row_number, $data->employeename);
			$sheet->setCellValue('F'. $row_number, $data->deptdesc);
			$sheet->setCellValue('G'. $row_number, $data->positiondesc);
			$sheet->setCellValue('H'. $row_number, $data->email);
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

	public function get_last_others_password() {
		$last_others_password = $this->m_copier_registration->get_last_others_password();

		// var_dump($last_others_password->others_password);
		echo $last_others_password->others_password;
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

	public function tes ($tesParameter) {
		echo $tesParameter;
	}
}

	