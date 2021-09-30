<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mpabx11 extends CI_Model {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://examples.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$sql = "SELECT * FROM ext ORDER BY extension ASC, pabxLocation ASC";
		$query = $this->db->query($sql);
		return $query->result();
	}	

	public function pabx_no(){
		$sql = "SELECT * FROM pabxno ORDER BY pabxno ASC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function getAllPabxById($id = NULL){
		$sql = "SELECT * FROM ext WHERE id = '$id' ORDER BY port ASC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	// Yard 1 PABX 1
	public function yard1_pabx1_desc(){
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 1' AND pabxno = 1";
		$query = $this->db->query($sql);
		return $query->row();
	}

	public function yard1_pabx2_desc(){
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 1' AND pabxno = 2";
		$query = $this->db->query($sql);
		return $query->row();
	}

	public function yard1_pabx3_desc(){
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 1' AND pabxno = 3";
		$query = $this->db->query($sql);
		return $query->row();
	}

	public function yard1_pabx4_desc(){
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 1' AND pabxno = 4";
		$query = $this->db->query($sql);
		return $query->row();
	}

	public function yard1_pabx5_desc(){
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 1' AND pabxno = 5";
		$query = $this->db->query($sql);
		return $query->row();
	}

	public function yard1_pabx6_desc(){
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 1' AND pabxno = 6";
		$query = $this->db->query($sql);
		return $query->row();
	}

	// Yard 1 PABX 1
	public function yard1_pabx1_row01()
	{
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 1' AND pabxno = 1 AND row = 1 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function yard1_pabx1_row02()
	{
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 1' AND pabxno = 1 AND row = 2 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function yard1_pabx1_row03()
	{
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 1' AND pabxno = 1 AND row = 3 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function yard1_pabx1_row04()
	{
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 1' AND pabxno = 1 AND row = 4 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	// Yard 1 PABX 2
	public function yard1_pabx2_row01()
	{
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 1' AND pabxno = 2 AND row = 1 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function yard1_pabx2_row02()
	{
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 1' AND pabxno = 2 AND row = 2 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function yard1_pabx2_row03()
	{
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 1' AND pabxno = 2 AND row = 3 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function yard1_pabx2_row04()
	{
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 1' AND pabxno = 2 AND row = 4 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	// Yard 1 PABX 3
	public function yard1_pabx3_row01()
	{
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 1' AND pabxno = 3 AND row = 1 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function yard1_pabx3_row02()
	{
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 1' AND pabxno = 3 AND row = 2 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function yard1_pabx3_row03()
	{
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 1' AND pabxno = 3 AND row = 3 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function yard1_pabx3_row04()
	{
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 1' AND pabxno = 3 AND row = 4 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	// Yard 1 PABX 4
	public function yard1_pabx4_row01()
	{
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 1' AND pabxno = 4 AND row = 1 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function yard1_pabx4_row02()
	{
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 1' AND pabxno = 4 AND row = 2 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function yard1_pabx4_row03()
	{
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 1' AND pabxno = 4 AND row = 3 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function yard1_pabx4_row04()
	{
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 1' AND pabxno = 4 AND row = 4 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	// Yard 1 PABX 5
	public function yard1_pabx5_row01(){
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 1' AND pabxno = 5 AND row = 1 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function yard1_pabx5_row02(){
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 1' AND pabxno = 5 AND row = 2 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function yard1_pabx5_row03(){
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 1' AND pabxno = 5 AND row = 3 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function yard1_pabx5_row04(){
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 1' AND pabxno = 5 AND row = 4 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	// Yard 1 PABX 6
	public function yard1_pabx6_row01(){
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 1' AND pabxno = 6 AND row = 1 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function yard1_pabx6_row02(){
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 1' AND pabxno = 6 AND row = 2 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function yard1_pabx6_row03(){
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 1' AND pabxno = 6 AND row = 3 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function yard1_pabx6_row04(){
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 1' AND pabxno = 6 AND row = 4 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}



	// Yard 2 PABX 1
	public function yard2_pabx1_row01()
	{
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 2' AND pabxno = 1 AND row = 1 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function yard2_pabx1_row02()
	{
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 2' AND pabxno = 1 AND row = 2 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function yard2_pabx1_row03()
	{
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 2' AND pabxno = 1 AND row = 3 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function yard2_pabx1_row04()
	{
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 2' AND pabxno = 1 AND row = 4 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	// Yard 2 PABX 2
	public function yard2_pabx2_row01()
	{
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 2' AND pabxno = 2 AND row = 1 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function yard2_pabx2_row02()
	{
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 2' AND pabxno = 2 AND row = 2 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function yard2_pabx2_row03()
	{
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 2' AND pabxno = 2 AND row = 3 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function yard2_pabx2_row04()
	{
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 2' AND pabxno = 2 AND row = 4 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	// Yard 2 PABX 3
	public function yard2_pabx3_row01()
	{
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 2' AND pabxno = 3 AND row = 1 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function yard2_pabx3_row02()
	{
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 2' AND pabxno = 3 AND row = 2 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function yard2_pabx3_row03()
	{
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 2' AND pabxno = 3 AND row = 3 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function yard2_pabx3_row04()
	{
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 2' AND pabxno = 3 AND row = 4 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	// Yard 2 PABX 4
	public function yard2_pabx4_row01()
	{
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 2' AND pabxno = 4 AND row = 1 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function yard2_pabx4_row02()
	{
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 2' AND pabxno = 4 AND row = 2 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function yard2_pabx4_row03()
	{
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 2' AND pabxno = 4 AND row = 3 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function yard2_pabx4_row04()
	{
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 2' AND pabxno = 4 AND row = 4 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	// Yard 2 PABX 5
	public function yard2_pabx5_row01(){
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 2' AND pabxno = 5 AND row = 1 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function yard2_pabx5_row02(){
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 2' AND pabxno = 5 AND row = 2 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function yard2_pabx5_row03(){
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 2' AND pabxno = 5 AND row = 3 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function yard2_pabx5_row04(){
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 2' AND pabxno = 5 AND row = 4 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	// Yard 2 PABX 6
	public function yard2_pabx6_row01(){
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 2' AND pabxno = 6 AND row = 1 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function yard2_pabx6_row02(){
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 2' AND pabxno = 6 AND row = 2 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function yard2_pabx6_row03(){
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 2' AND pabxno = 6 AND row = 3 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function yard2_pabx6_row04(){
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 2' AND pabxno = 6 AND row = 4 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function yard2_pabx1_desc(){
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 2' AND pabxno = 1";
		$query = $this->db->query($sql);
		return $query->row();
	}

	public function yard2_pabx2_desc(){
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 2' AND pabxno = 2";
		$query = $this->db->query($sql);
		return $query->row();
	}

	public function yard2_pabx3_desc(){
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 2' AND pabxno = 3";
		$query = $this->db->query($sql);
		return $query->row();
	}

	public function yard2_pabx4_desc(){
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 2' AND pabxno = 4";
		$query = $this->db->query($sql);
		return $query->row();
	}

	public function yard2_pabx5_desc(){
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 2' AND pabxno = 5";
		$query = $this->db->query($sql);
		return $query->row();
	}

	public function yard2_pabx6_desc(){
		$sql = "SELECT * FROM ext WHERE pabxLocation = 'YARD 2' AND pabxno = 6";
		$query = $this->db->query($sql);
		return $query->row();
	}

	public function getExtensionByIds($id){
		// $sql = "SELECT * FROM ext WHERE id = '$id'";
		$this->db->select('*')
			->from('ext')
			->where('id', $id);
		$result = $this->db->get()->row();
		return $result;
	}

	public function saveEmpExt(){
		$info = [];
		$info['extension'] = $this->input->post('extension', TRUE);
		$info['employee'] = $this->input->post('employee', TRUE);

		var_dump($info);
	}

	public function saveExtension(){
		$info= [];
		$portValueValidate = $this->input->post(htmlspecialchars('portNo', TRUE));
		$info['port'] = $this->input->post(htmlspecialchars('portNo', TRUE));
		$info['extension'] = $this->input->post(htmlspecialchars('extNo', TRUE));
		
		$this->db->insert('ext', $info);
		if ( $this->db->affected_rows() == 1) {
			return TRUE;
		}
	}

	public function modifyExtension($input, $id = NULL){
		
		$info = [];
		$info['extension'] = $input['extension'];
		$info['pabxLocation'] = $input['pabxLocation'];
		$info['pabxNo'] = $input['pabxNo'];
		$this->db->where('id', $id);
		$this->db->update('ext', $info);
		return $info;
	}

	public function yard01Projects(){
		$sql = "SELECT 
				wasco_fingerman.tblfile_department.deptdesc, 
				wasco_fingerman.tblmas_employee.employeename,
				wasco_fingerman.tblmas_employee.idemployee, 
				wasco_fingerman.tblfile_position.positiondesc, 
				extension.ext.extension, 
				extension.ext.pabxLocation
				FROM 
				wasco_fingerman.tblfile_department 
				JOIN wasco_fingerman.tblmas_employee 
				ON wasco_fingerman.tblfile_department.iddept = wasco_fingerman.tblmas_employee.iddept 
				JOIN wasco_fingerman.tblfile_position 
				ON wasco_fingerman.tblfile_position.idposition = wasco_fingerman.tblmas_employee.idposition
				JOIN extension.ext 
				ON extension.ext.empId = wasco_fingerman.tblmas_employee.idemployee";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function getEmployees(){
		$sql = "SELECT 
				wasco_fingerman.tblfile_department.deptdesc, 
				wasco_fingerman.tblmas_employee.employeename,
				wasco_fingerman.tblmas_employee.idemployee, 
				wasco_fingerman.tblfile_position.positiondesc 
				FROM 
				wasco_fingerman.tblfile_department 
				JOIN wasco_fingerman.tblmas_employee 
				ON wasco_fingerman.tblfile_department.iddept = wasco_fingerman.tblmas_employee.iddept 
				JOIN wasco_fingerman.tblfile_position 
				ON wasco_fingerman.tblfile_position.idposition = wasco_fingerman.tblmas_employee.idposition
				";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function updateExtensionStatusAdd($extId = false){
		if ( $extId > 0 ){
			$sql = "UPDATE ext SET status = 1 WHERE id = '$extId'";
			$query = $this->db->query($sql);
		}
	}

	public function updateExtensionStatus0($extId = false,$previd = false){

		// echo $extId ."|". $previd;die;

		// $info = [];
		// $info['extId'] = $extId['extId'];

		// if ($info['extId'] == "0" || $info['extId'] == "" ){
		// 	$this->db->where('id', '$previd');
		// 	$this->db->update('ext', $info);
		// }else{
		// 	$this->db->where('id', '$extId['extId']');
		// 	$this->db->update('ext', $info);
		// }

		$sql = "UPDATE ext SET status = 0 WHERE id = '$previd'";
			$query = $this->db->query($sql);
	}

	public function updateExtensionStatus1($extId = false,$previd = false){

		// echo $extId ."|". $previd;die;

		// $info = [];
		// $info['extId'] = $extId['extId'];

		// if ($info['extId'] == "0" || $info['extId'] == "" ){
		// 	$this->db->where('id', '$previd');
		// 	$this->db->update('ext', $info);
		// }else{
		// 	$this->db->where('id', '$extId['extId']');
		// 	$this->db->update('ext', $info);
		// }


		
		
			$sql = "UPDATE ext SET status = 1 WHERE id = '$extId'";
			$query = $this->db->query($sql);
		
	}


}