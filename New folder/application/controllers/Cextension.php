<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cextension extends CI_Controller
{

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
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mextensions');
		$this->load->model('memployee');
		$this->load->model('mpabx11');
	}

	public function index($officeLocationId = 1, $pdf = '')
	{
		// $this->ldap_save();
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
		if (!$pdf) {
			$this->load->view('main', $data);
		} else {
			$html = $this->load->view('contents/vExtensionPDF', $data, TRUE);
			// mpdf library
			error_reporting(0);
			include("library/MPDF54/mpdf.php");
			$mpdf = new mPDF(
				'',    // mode - default ''
				'',    // format - A4, for example, default ''
				8,     // font size - default 0
				'',    // default font family
				15,    // margin_left
				15,    // margin right
				10,     // margin top
				10,    // margin bottom
				5,     // margin header
				9,     // margin footer
				'P'
			);  // L - landscape, P - portrait

			$mpdf->SetDisplayMode('fullpage');

			$mpdf->list_indent_first_level = 0;

			$stylesheet = file_get_contents('css/pdfstyle.css');
			$mpdf->WriteHTML($stylesheet, 1);

			$mpdf->WriteHTML($html, 2);

			$mpdf->Output('extension.pdf', 'I');
			exit;
		}
	}

	public function officeExtensionDependent()
	{
		$officeLocation = $_POST['officeLocation'];

		if ($officeLocation === '1') {
			$extension = $this->mpabx11->getExtensionDependent($officeLocation);
		} else if ($officeLocation === '2') {
			$extension = $this->mpabx11->getExtensionDependent($officeLocation);
		} else {
			$extension = $this->mpabx11->index();
		}
		$output = '<option>Extension No</option>';
		foreach ($extension as $ext) {
			$output .= '<option value=' . $ext->id . '>Yard' . $ext->pabxLocation . ' - ' . $ext->extension . '</option>';
		}
		echo json_encode($output);
	}

	public function information()
	{
		// $data = [];
		$data['menu'] = '';
		$data['header'] = $this->load->view('headers/head', '', TRUE);
		$data['navigation'] = $this->memployee->getOfficeLocations();
		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['content'] = $this->load->view('contents/vInformation', $data, TRUE);
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);
		$this->load->view('main', $data);
	}

	// public function ldap_save()
	// {
	// 	$username = "sghelpdeskadmin@WASCOENERGY";
	// 	$password = "w@5c0@sg";
	// 	// $ldapconn = ldap_connect("172.88.88.81");
	// 	$ldapconn = ldap_connect("192.168.40.3");
	// 	@ldap_bind($ldapconn, $username, $password);
	// 	$ad_departments = [
	// 		'WEI-BT-Consultant',
	// 		'WEI-BT-Engineering',
	// 		'WEI-BT-Finance',
	// 		'WEI-BT-Groups',
	// 		'WEI-BT-HR',
	// 		'WEI-BT-HSE',
	// 		'WEI-BT-MIS',
	// 		'WEI-BT-Operations',
	// 		'WEI-BT-Production',
	// 		'WEI-BT-Projects',
	// 		'WEI-BT-QAQC',
	// 		'WEI-BT-SCM',
	// 	];
	// 	foreach ($ad_departments as $department) {
	// 		// $dn = "OU=WEI-BT-Groups,OU=WEI,OU=Engineering,OU=Wasco Energy Group,DC=wascoenergy,DC=wasco,DC=global";
	// 		$dn = "OU=" . $department . ",OU=WEI,OU=Engineering,OU=Wasco Energy Group,DC=wascoenergy,DC=wasco,DC=global";
	// 		$filter = "(&(&(&(objectCategory=person)(objectClass=user))))";
	// 		$search = @ldap_search($ldapconn, $dn, $filter, array("dn", "displayname", "mail", "title", "mobile", "st", "co", "usncreated", 'department', "samaccountname"));
	// 		// cek jika hasil pencarian tidak ada
	// 		if ($search != '') {
	// 			$entries = ldap_get_entries($ldapconn, $search);
	// 			$array_data = [];
	// 			foreach ($entries as $entry) {
	// 				var_dump($entry);
	// 			}
	// 		}
	// 	}
	// 	var_dump($array_data);
	// }
}
