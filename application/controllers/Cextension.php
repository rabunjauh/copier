<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cextension extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model('mextensions');
		$this->load->model('memployee');
	}

	public function index($officeLocationId = 1, $pdf = ''){
		$data = [];
		$data['officeLocationId'] = $officeLocationId;
		$data['menu'] = '';
		$data['departments'] = $this->memployee->department();
		$data['officeLocationDesc'] = $this->memployee->getOfficeDescription($officeLocationId);
		$data['groups'] = $this->memployee->getGroup();
		$data['navigation'] = $this->memployee->getOfficeLocations();
		$data['header'] = $this->load->view('headers/head', '', TRUE);
		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['phoneBooks'] = $this->mextensions->index($data['departments'], $officeLocationId);
		$data['content'] = $this->load->view('contents/vExtension', $data, TRUE);
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);
		if (!$pdf){
			$this->load->view('main', $data);
		} else {
			$html = $this->load->view('contents/vExtensionPDF', $data, TRUE);
			// mpdf library
			error_reporting(0); 
			include("library/MPDF54/mpdf.php");
			$mpdf = new mPDF('',    // mode - default ''
			'',    // format - A4, for example, default ''
				8,     // font size - default 0
				'',    // default font family
				15,    // margin_left
				15,    // margin right
				10,     // margin top
				10,    // margin bottom
				5,     // margin header
				9,     // margin footer
				'P');  // L - landscape, P - portrait

			$mpdf->SetDisplayMode('fullpage');
			
			$mpdf->list_indent_first_level = 0;

			$stylesheet = file_get_contents('css/pdfstyle.css');
			$mpdf->WriteHTML($stylesheet,1);

			$mpdf->WriteHTML($html,2);

			$mpdf->Output('extension.pdf','I');
			exit;
		}
	}
}

	