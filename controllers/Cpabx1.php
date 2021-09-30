<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cpabx1 extends CI_Controller {

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
		$this->load->model('mpabx11');
		$this->load->model('memployee');
		if ( !$this->session->userdata('username') ){
			redirect(base_url(). 'login');
		}
		
	}

	public function index()
	{
		$data = [];
		$data['menu'] = '';
		$data['header'] = $this->load->view('headers/head', '', TRUE);
		$data['navigation'] = $this->memployee->getOfficeLocations();
		$data['yard1_pabx1_row01'] = $this->mpabx11->yard1_pabx1_row01();
		$data['yard1_pabx1_row02'] = $this->mpabx11->yard1_pabx1_row02();
		$data['yard1_pabx1_row03'] = $this->mpabx11->yard1_pabx1_row03();
		$data['yard1_pabx1_row04'] = $this->mpabx11->yard1_pabx1_row04();
		$data['yard1_pabx2_row01'] = $this->mpabx11->yard1_pabx2_row01();
		$data['yard1_pabx2_row02'] = $this->mpabx11->yard1_pabx2_row02();
		$data['yard1_pabx2_row03'] = $this->mpabx11->yard1_pabx2_row03();
		$data['yard1_pabx2_row04'] = $this->mpabx11->yard1_pabx2_row04();
		$data['yard1_pabx3_row01'] = $this->mpabx11->yard1_pabx3_row01();
		$data['yard1_pabx3_row02'] = $this->mpabx11->yard1_pabx3_row02();
		$data['yard1_pabx3_row03'] = $this->mpabx11->yard1_pabx3_row03();
		$data['yard1_pabx3_row04'] = $this->mpabx11->yard1_pabx3_row04();
		$data['yard1_pabx4_row01'] = $this->mpabx11->yard1_pabx4_row01();
		$data['yard1_pabx4_row02'] = $this->mpabx11->yard1_pabx4_row02();
		$data['yard1_pabx4_row03'] = $this->mpabx11->yard1_pabx4_row03();
		$data['yard1_pabx4_row04'] = $this->mpabx11->yard1_pabx4_row04();
		$data['yard1_pabx5_row01'] = $this->mpabx11->yard1_pabx5_row01();
		$data['yard1_pabx5_row02'] = $this->mpabx11->yard1_pabx5_row02();
		$data['yard1_pabx5_row03'] = $this->mpabx11->yard1_pabx5_row03();
		$data['yard1_pabx5_row04'] = $this->mpabx11->yard1_pabx5_row04();
		$data['yard1_pabx6_row01'] = $this->mpabx11->yard1_pabx6_row01();
		$data['yard1_pabx6_row02'] = $this->mpabx11->yard1_pabx6_row02();
		$data['yard1_pabx6_row03'] = $this->mpabx11->yard1_pabx6_row03();
		$data['yard1_pabx6_row04'] = $this->mpabx11->yard1_pabx6_row04();
		$data['yard1_pabx1_desc'] = $this->mpabx11->yard1_pabx1_desc();
		$data['yard1_pabx2_desc'] = $this->mpabx11->yard1_pabx2_desc();
		$data['yard1_pabx3_desc'] = $this->mpabx11->yard1_pabx3_desc();
		$data['yard1_pabx4_desc'] = $this->mpabx11->yard1_pabx4_desc();
		$data['yard1_pabx5_desc'] = $this->mpabx11->yard1_pabx5_desc();
		$data['yard1_pabx6_desc'] = $this->mpabx11->yard1_pabx6_desc();

		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['content'] = $this->load->view('contents/vExt11', $data, TRUE);
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);
		$this->load->view('main', $data);
	}

	public function addExtension(){
		$data = [];
		$data['menu'] = '';
		$data['header'] = $this->load->view('headers/header', '', TRUE);
		$data['navigation'] = $this->memployee->getOfficeLocations();
		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['content'] = $this->load->view('forms/formAddExtension', '', TRUE);
		// $data['pabx_location'] = $this->mpabx1->
		$data['pabx_no'] = $this->mpabx11->pabx_no();
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);
		$this->load->view('main', $data);
	}

	public function saveExtension(){
		if ( !$this->mpabx11->saveExtension() ){
			echo "An ERROR occurred!";
			redirect(base_url().'cpabx1/addExtension');
		}
		else{
			echo "Extension Added Succesfullly";
			redirect(base_url());
		}
	}

	public function modifyExtension($id = NULL){
		if (isset($_POST['btnUpdateExtension'])) {
			$formInfo = [];
			$formInfo['extension'] = $this->input->post('extNo');
			$formInfo['pabxLocation'] = $this->input->post('pabxLocation');
			$formInfo['pabxNo'] = $this->input->post('pabxNo');
			if ( !$this->mpabx11->modifyExtension($formInfo, $id) ){
				redirect(base_url() . 'cpabx1/modifyExtension/' . $id);
			}else{
				redirect(base_url() . 'cpabx1');
			}	
		}
		// $data[$id] = $id;
		$data['header'] = $this->load->view('headers/head', '', TRUE);
		$data['navigation'] = $this->memployee->getOfficeLocations();
		$data['pabxs'] = $this->mpabx11->getAllPabxById($id);
		$data['getExtensionByIds'] = $this->mpabx11->getExtensionByIds($id);
		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['content'] = $this->load->view('forms/formEditExtension', $data, TRUE);
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);
		$this->load->view('main', $data);
	}

	public function yard2()
	{
		$data = [];
		$data['menu'] = '';
		$data['header'] = $this->load->view('headers/head', '', TRUE);
		$data['navigation'] = $this->memployee->getOfficeLocations();
		$data['yard2_pabx1_row01'] = $this->mpabx11->yard2_pabx1_row01();
		$data['yard2_pabx1_row02'] = $this->mpabx11->yard2_pabx1_row02();
		$data['yard2_pabx1_row03'] = $this->mpabx11->yard2_pabx1_row03();
		$data['yard2_pabx1_row04'] = $this->mpabx11->yard2_pabx1_row04();
		$data['yard2_pabx2_row01'] = $this->mpabx11->yard2_pabx2_row01();
		$data['yard2_pabx2_row02'] = $this->mpabx11->yard2_pabx2_row02();
		$data['yard2_pabx2_row03'] = $this->mpabx11->yard2_pabx2_row03();
		$data['yard2_pabx2_row04'] = $this->mpabx11->yard2_pabx2_row04();
		$data['yard2_pabx3_row01'] = $this->mpabx11->yard2_pabx3_row01();
		$data['yard2_pabx3_row02'] = $this->mpabx11->yard2_pabx3_row02();
		$data['yard2_pabx3_row03'] = $this->mpabx11->yard2_pabx3_row03();
		$data['yard2_pabx3_row04'] = $this->mpabx11->yard2_pabx3_row04();
		$data['yard2_pabx4_row01'] = $this->mpabx11->yard2_pabx4_row01();
		$data['yard2_pabx4_row02'] = $this->mpabx11->yard2_pabx4_row02();
		$data['yard2_pabx4_row03'] = $this->mpabx11->yard2_pabx4_row03();
		$data['yard2_pabx4_row04'] = $this->mpabx11->yard2_pabx4_row04();
		$data['yard2_pabx5_row01'] = $this->mpabx11->yard2_pabx5_row01();
		$data['yard2_pabx5_row02'] = $this->mpabx11->yard2_pabx5_row02();
		$data['yard2_pabx5_row03'] = $this->mpabx11->yard2_pabx5_row03();
		$data['yard2_pabx5_row04'] = $this->mpabx11->yard2_pabx5_row04();
		$data['yard2_pabx6_row01'] = $this->mpabx11->yard2_pabx6_row01();
		$data['yard2_pabx6_row02'] = $this->mpabx11->yard2_pabx6_row02();
		$data['yard2_pabx6_row03'] = $this->mpabx11->yard2_pabx6_row03();
		$data['yard2_pabx6_row04'] = $this->mpabx11->yard2_pabx6_row04();
		$data['yard2_pabx1_desc'] = $this->mpabx11->yard2_pabx1_desc();
		$data['yard2_pabx2_desc'] = $this->mpabx11->yard2_pabx2_desc();
		$data['yard2_pabx3_desc'] = $this->mpabx11->yard2_pabx3_desc();
		$data['yard2_pabx4_desc'] = $this->mpabx11->yard2_pabx4_desc();
		$data['yard2_pabx5_desc'] = $this->mpabx11->yard2_pabx5_desc();
		$data['yard2_pabx6_desc'] = $this->mpabx11->yard2_pabx6_desc();

		$data['cover'] = $this->load->view('headers/cover', '', TRUE);
		$data['content'] = $this->load->view('contents/v_pabx_yard2', $data, TRUE);
		$data['footer'] = $this->load->view('footers/footer', '', TRUE);
		$this->load->view('main', $data);
	}

}
