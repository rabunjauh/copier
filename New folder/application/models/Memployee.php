<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class memployee extends CI_Model {

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

	}

	// PABX 1
	public function index(){
		$sql = "SELECT tblmas_employee.idemployee, tblmas_employee.employeeno, tblmas_employee.employeename, tblfile_department.deptdesc, tblfile_position.positiondesc 
				FROM tblmas_employee
				LEFT JOIN tblfile_department 
				ON tblmas_employee.iddept = tblfile_department.iddept 
				LEFT JOIN tblfile_position 
				ON tblmas_employee.idposition = tblfile_position.idposition 
				ORDER BY tblmas_employee.idemployee DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function countEmployee(){
		$query = $this->db->query("SELECT * FROM tblmas_employee WHERE stsactive = '1'");
		// $query = $this->db->query("SELECT * FROM tblmas_employee WHERE employeename like '%hidayat%'");
		$count = $query->num_rows();
		return $count;
	}

	public function employeeList($limit, $offset){
	    $sql = "SELECT tblmas_employee.idemployee, tblmas_employee.stsactive, tblmas_employee.employeeno, tblmas_employee.employeename, tblmas_employee.code, tblmas_employee.ext, tblfile_department.deptdesc, tblfile_position.positiondesc, tblfile_position.level, ext.extension, employee_status.employee_status 
	   			FROM tblmas_employee 
	    		LEFT JOIN tblfile_department 
	    		ON tblmas_employee.iddept = tblfile_department.iddept 
	    		LEFT JOIN tblfile_position 
	    		ON tblmas_employee.idposition = tblfile_position.idposition 
	    		LEFT JOIN ext
	    		ON tblmas_employee.extId = ext.id
				LEFT JOIN employee_status ON tblmas_employee.stsactive = employee_status.employee_status_id
	    		ORDER BY tblmas_employee.idemployee DESC";

	    // $sql = "SELECT tblmas_employee.idemployee, tblmas_employee.employeeno, tblmas_employee.employeename, tblfile_department.deptdesc, tblfile_position.positiondesc, tblfile_position.level 
	   	// 		FROM tblmas_employee 
	    // 		LEFT JOIN tblfile_department 
	    // 		ON tblmas_employee.iddept = tblfile_department.iddept 
	    // 		LEFT JOIN tblfile_position 
	    // 		ON tblmas_employee.idposition = tblfile_position.idposition 
	    // 		WHERE tblmas_employee.employeename like '%hidayat%'
	    // 		ORDER BY tblmas_employee.idemployee DESC";

	    if ($limit) {
	      if(!$offset){
	        $sql .= " LIMIT $limit";
	      }else{
	        $sql .= " LIMIT $limit OFFSET $offset";
	      }
	    }
	    
	    $query = $this->db->query($sql);
	    return $query->result();
  	}

	public function saveEmployee($input){
		$info['office_location_id'] = $input['office_location_id'];
		$info['employeeno'] = strtolower(htmlspecialchars($input['employeeno']));
		$info['employeename'] = htmlspecialchars($input['employeename']);
		$info['iddept'] = $input['iddept'];
		$info['idposition'] = $input['idposition'];
		$info['extId'] = $input['extId'];
		$info['ext'] = $input['ext'];
		$this->db->insert('tblmas_employee', $info);
		if ( $this->db->affected_rows() == 1 ){
			return $this->db->insert_id();
		} else {
			return FALSE;
		}
	}

	public function getEmployeeByIds($idEmployee){
		$this->db->select('*')
		->from('tblmas_employee')
		// ->join('office_location', 'tblmas_employee.office_location_id = office_location.office_location_id')
		->where('idemployee', $idEmployee);
		$result = $this->db->get()->row();
		return $result;
	}

	public function employeeIds($idEmployee = NULL){
		$sql = "SELECT tblmas_employee.idemployee, 
					tblmas_employee.employeeno, 
					tblmas_employee.employeename, 
					tblmas_employee.iddept, 
					tblmas_employee.idposition, 
					tblmas_employee.extId, 
					tblmas_employee.code,
					tblmas_employee.office_location_id,
					tblmas_employee.ext,
					office_location.office_location_desc, 
					tblfile_department.deptdesc, 
					tblfile_position.positiondesc, 
					tblfile_position.level, 
					ext.extension,
					ext.pabxLocation,
					employee_status.employee_status_id,
					employee_status.employee_status 
				FROM tblmas_employee 
				LEFT JOIN tblfile_department 
				ON tblmas_employee.iddept = tblfile_department.iddept 
				LEFT JOIN tblfile_position 
				ON tblmas_employee.idposition = tblfile_position.idposition  
				LEFT JOIN ext ON tblmas_employee.extId = ext.id 
				LEFT JOIN office_location ON tblmas_employee.office_location_id = office_location.office_location_id
				LEFT JOIN employee_status ON tblmas_employee.stsactive = employee_status.employee_status_id
				WHERE tblmas_employee.idemployee = '$idEmployee' 
				ORDER BY tblmas_employee.idemployee DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function modifyEmployee($input, $employeeId){
		$info = [];
		$info['office_location_id'] = htmlspecialchars($input['office_location_id']);
		$info['employeeno'] = htmlspecialchars($input['employeeno']);
		$info['employeename'] = htmlspecialchars($input['employeename']);
		$info['iddept'] = $input['iddept'];
		$info['idposition'] = $input['idposition'];
		$info['code'] = $input['code'];
		$info['extId'] = $input['extId'];
		$info['ext'] = $input['ext'];
		$this->db->where('idemployee', $employeeId);
		$this->db->update('tblmas_employee', $info);
		return $info;
	}

	public function toggleEmployeeStatus($idEmployee, $status){
		$this->db->where('idemployee', $idEmployee);
		$this->db->update('tblmas_employee', array('stsactive' => $status));
		if ($this->db->affected_rows() > 0){
			return TRUE;
		}
	}

	public function countEmployeeSearch($searchCategory = false, $txtSearch = false){
		if ($searchCategory == "0"){
			$filter = "tblmas_employee.idemployee LIKE '%$txtSearch%'
	    		OR tblmas_employee.employeeno LIKE '%$txtSearch%'
	    		OR tblmas_employee.employeename LIKE '%$txtSearch%'
	    		OR tblfile_department.deptdesc LIKE '%$txtSearch%'
	    		OR tblfile_position.positiondesc LIKE '%$txtSearch%'
	    		OR tblmas_employee.code LIKE '%txtSearch%'
	    		OR ext.extension LIKE '%$txtSearch%'";
		}else if ( $searchCategory == "idemployee") {
			$filter = "tblmas_employee.idemployee = '$txtSearch'";
		}else if ( $searchCategory == "employeeno" ){
			$filter = "tblmas_employee.employeeno = '$txtSearch'";
		}else if ( $searchCategory == "employeename" ){
			$filter = "tblmas_employee.employeename = 'txtSearch'";
		}else if ( $searchCategory == "deptdesc" ){
			$filter = "tblfile_department.deptdesc = '$txtSearch'";
		}else if ( $searchCategory == "positiondesc" ){
			$filter = "tblfile_position.positiondesc = '$txtSearch'";
		}else if ( $searchCategory == "code" ){
			$filter = "tblmas_employee.code = '$txtSearch'";	
		}else if ( $searchCategory == "extension" ){
			$filter = "ext.extension = '$txtSearch'";		
		}
		// else{
		// 	$filter = "$searchCategory = '$txtSearch'";	
		// }

		$query =  $this->db->query("SELECT tblmas_employee.idemployee, tblmas_employee.employeeno, tblmas_employee.employeename, tblmas_employee.code,tblfile_department.deptdesc, tblfile_position.positiondesc, ext.extension
	    			FROM tblmas_employee 
	     		LEFT JOIN tblfile_department 
	     		ON tblmas_employee.iddept = tblfile_department.iddept 
	     		LEFT JOIN tblfile_position
	     		ON tblmas_employee.idposition = tblfile_position.idposition
	     		LEFT JOIN ext
	     		ON tblmas_employee.extId = ext.id  
	     		WHERE $filter
	     		AND tblmas_employee.stsactive = '1'");
			 $count = $query->num_rows();
			 // echo $this->db->last_query();die;
			 return $count;

	}

	public function employeeListSearch($num, $offset, $searchCategory, $txtSearch){
		
		if ( !$offset ){
  			$limit = "LIMIT $num";
  		}else{
  			$limit = "LIMIT $offset, $num";
  		}

		  if ( $searchCategory == "0" ){
		 	$filter = "tblmas_employee.idemployee LIKE '%$txtSearch%'
    		OR tblmas_employee.employeeno LIKE '%$txtSearch%'
    		OR tblmas_employee.employeename LIKE '%$txtSearch%'
    		OR tblfile_department.deptdesc LIKE '%$txtSearch%'
    		OR tblfile_position.positiondesc LIKE '%$txtSearch%'
    		OR tblmas_employee.code LIKE '%txtSearch%'
    		OR ext.extension LIKE '%$txtSearch%'";
		}else if ( $searchCategory == "idemployee" ){
			$filter = "tblmas_employee.idemployee = '$txtSearch'";
		}else if ( $searchCategory == "employeeno" ){
			$filter = "tblmas_employee.employeeno = '$txtSearch'";
		}else if ( $searchCategory == "employeename" ){
			$filter = "tblmas_employee.employeename = '$txtSearch'";	
		}else if ( $searchCategory == "deptdesc" ){
			$filter = "tblfile_department.deptdesc = '$txtSearch'";
		}else if ( $searchCategory == "positiondesc" ){
			$filter = "tblfile_position.positiondesc = '$txtSearch'";
		}else if ( $searchCategory == "code" ){
			$filter = "tblmas_employee.code = '$txtSearch'";
		}else if ( $searchCategory == "extension" ){
			$filter = "ext.extension = '$txtSearch'";	
		}

  		$sql = "SELECT tblmas_employee.idemployee, tblmas_employee.stsactive, employee_status.employee_status, tblmas_employee.ext, tblmas_employee.employeeno, tblmas_employee.employeename, tblmas_employee.code, tblfile_department.deptdesc, tblfile_position.positiondesc, tblfile_position.level, ext.extension 
		   	 		FROM tblmas_employee 
		     		LEFT JOIN tblfile_department 
		     		ON tblmas_employee.iddept = tblfile_department.iddept 
		     		LEFT JOIN tblfile_position 
		     		ON tblmas_employee.idposition = tblfile_position.idposition
		     		LEFT JOIN ext
		     		ON tblmas_employee.extId = ext.id 
					LEFT JOIN employee_status ON tblmas_employee.stsactive = employee_status.employee_status_id
		     		WHERE $filter AND tblmas_employee.stsactive = '1'
		     		ORDER BY tblmas_employee.idemployee DESC $limit";	
		
		$query = $this->db->query($sql);
		return $query->result();     		
  	}

  	public function department(){
		$sql = "SELECT 
					iddept, deptdesc 
					FROM tblfile_department WHERE stsactive = 1 ORDER BY ordering ASC";
		$query = $this->db->query($sql);
		return $query->result();
	}

  	public function saveDepartment($input){
  		// $info['deptdesc'] = htmlspecialchars($input['txtDepartment']);
  		$this->db->insert('tblfile_department', $input);
  		if ( $this->db->affected_rows() == 1 ){
  			$this->db->insert_id();
  		} else {
  			return FALSE;
  		}
  	}

  	public function countDepartment(){
		$query = $this->db->query("SELECT * FROM tblfile_department");
		$count = $query->num_rows();
		return $count;
	}

	public function departmentList($limit, $offset){
	    $sql = "SELECT 
					d.iddept, 
					d.deptdesc, 
					d.stsactive, 
					g.group_desc 
				FROM tblfile_department d
				JOIN tbl_group g on d.group_id = g.group_id";

	    if ($limit) {
	      if(!$offset){
	        $sql .= " LIMIT $limit";
	      }else{
	        $sql .= " LIMIT $limit OFFSET $offset";
	      }
	    }
	    
	    $query = $this->db->query($sql);
	    return $query->result();
  	}

  	public function getDepartmentByIds($iddept){
		$this->db->select('*')
		->from('tblfile_department')
		->where('iddept', $iddept);
		$result = $this->db->get()->row();
		return $result;
	}

	public function departmentIds($iddept = NULL){
		$sql = "SELECT 
					d.iddept, 
					d.deptdesc, 
					d.stsactive,
					g.group_id, 
					g.group_desc 
				FROM tblfile_department d
				JOIN tbl_group g on d.group_id = g.group_id 
				WHERE iddept = $iddept";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_department_ajax() {
		return $this->db->get('tblfile_department')->result();
	}

	public function modifyDepartment($input, $iddept){
		// $info = [];
		// $info['deptdesc'] = htmlspecialchars($input['deptdesc']);
		$this->db->where('iddept', $iddept);
		$this->db->update('tblfile_department', $input);
		return TRUE;
	}

	public function deleteDepartment($iddept){
  		$this->db->where('iddept', $iddept);
        $this->db->delete('tblfile_department');
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
  	}

  	public function position(){
		$sql = "SELECT tblfile_position.idposition, tblfile_position.positiondesc, tblfile_department.deptdesc FROM tblfile_position
					LEFT JOIN tblfile_department ON tblfile_position.iddept = tblfile_department.iddept ORDER BY tblfile_position.iddept ASC, tblfile_position.positiondesc ASC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function savePosition($input){
  		$info['positiondesc'] = htmlspecialchars($input['txtPosition']);
		$info['iddept'] = htmlspecialchars($input['selDepartment']);
		$info['level'] = htmlspecialchars($input['selLevel']);
  		$this->db->insert('tblfile_position', $info);
  		if ( $this->db->affected_rows() == 1 ){
  			$this->db->insert_id();
  		} else {
  			return FALSE;
  		}
  	}

  	public function countPosition(){
		$query = $this->db->query("SELECT * FROM tblfile_position");
		$count = $query->num_rows();
		return $count;
	}	

	public function positionList($limit, $offset){
	    $sql = "SELECT tblfile_position.idposition, tblfile_position.positiondesc, tblfile_department.deptdesc, tblfile_position.level 
	    		FROM tblfile_position
	    		LEFT JOIN tblfile_department
	    		ON tblfile_position.iddept = tblfile_department.iddept ORDER BY tblfile_department.deptdesc ASC, tblfile_position.level ASC";
	    if ($limit) {
	      if(!$offset){
	        $sql .= " LIMIT $limit";
	      }else{
	        $sql .= " LIMIT $limit OFFSET $offset";
	      }
	    }
	    $query = $this->db->query($sql);
	    return $query->result();
  	}

	public function countSearchPosition($searchCategory = false, $txtSearch = false){
		$filter = '';
		if ( $searchCategory == 'null' OR $searchCategory == 'text'){
			$filter = "WHERE tblfile_position.positiondesc LIKE '%$txtSearch %' OR tblfile_department.deptdesc LIKE '%$txtSearch%'";
		}else if( $searchCategory == 'idposition' ){
			$filter = "WHERE tblfile_position.idposition = '$txtSearch'";
		}else if ($searchCategory == 'iddept'){
			$filter = "WHERE tblfile_department.iddept = '$txtSearch'";
		}
		$query = $this->db->query("SELECT tblfile_position.idposition, tblfile_position.positiondesc, tblfile_department.deptdesc, tblfile_position.level, tblfile_department.iddept 
    		FROM tblfile_position
    		LEFT JOIN tblfile_department
    		ON tblfile_position.iddept = tblfile_department.iddept
    		$filter
    		ORDER BY tblfile_position.level ASC");
		$count = $query->num_rows();
		return $count;	
	}

  	public function positionListSearch($num, $offset, $searchCategory, $txtSearch){
		if ( !$offset ){
  			$limit = "LIMIT $num";
  		}else{
  			$limit = "LIMIT $offset, $num";
  		}

		$filter = '';  
		if ( $searchCategory == 'null' OR $searchCategory == 'text'){
			$filter = "WHERE tblfile_position.positiondesc LIKE '%$txtSearch %' OR tblfile_department.deptdesc LIKE '%$txtSearch%'";
		}else if( $searchCategory == 'idposition' ){
			$filter = "WHERE tblfile_position.idposition = '$txtSearch'";
		}else if ($searchCategory == 'iddept'){
			$filter = "WHERE tblfile_department.iddept = '$txtSearch'";
		}  
		  
	   $sql = "SELECT tblfile_position.idposition, tblfile_position.positiondesc, tblfile_department.deptdesc, tblfile_position.level, tblfile_department.iddept 
    		FROM tblfile_position
    		LEFT JOIN tblfile_department
    		ON tblfile_position.iddept = tblfile_department.iddept
    		$filter
    		ORDER BY tblfile_position.level ASC $limit";
	    $query = $this->db->query($sql);
	    return $query->result();
  	}

  	public function getPositionByIds($idposition){
		$this->db->select('*')
		->from('tblfile_position')
		->where('idposition', $idposition);
		// $this->db->select('tblfile_position.idposition', 'tblfile_position.positiondesc', 'tblfile_department.deptdesc', 'tblfile_position.level');
		// $this->db->from('tblfile_position');
		// $this->db->join('tblfile_department', 'tblfile_position.iddept = tblfile_department.iddept');
		// $this->db->where('idposition', $idposition);
		$result = $this->db->get()->row();
		return $result;

	}

	public function positionIds($idposition = NULL){
		$sql = "SELECT tblfile_position.idposition, tblfile_position.positiondesc,tblfile_department.iddept, tblfile_department.deptdesc, tblfile_position.level 
	    		FROM tblfile_position
	    		LEFT JOIN tblfile_department
	    		ON tblfile_position.iddept = tblfile_department.iddept 
	    		WHERE idposition = $idposition";
	    $query = $this->db->query($sql);
		return $query->result();
	}

	public function modifyPosition($input, $idposition){
		$info = [];
		$info['positiondesc'] = htmlspecialchars($input['positiondesc']);
		$info['iddept'] = $input['iddept'];
		$info['level'] = $input['level'];
		$this->db->where('idposition', $idposition);
		$this->db->update('tblfile_position', $info);
		return $info;
	}

	public function deletePosition($idposition){
  		$this->db->where('idposition', $idposition);
        $this->db->delete('tblfile_position');
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
  	}


  	public function count_company(){
		$query = $this->db->query("SELECT * FROM company");
		$count = $query->num_rows();
		return $count;
	}

	public function company_list($limit, $offset){
	    $sql = "SELECT * FROM company";

	    if ($limit) {
	      if(!$offset){
	        $sql .= " LIMIT $limit";
	      }else{
	        $sql .= " LIMIT $limit OFFSET $offset";
	      }
	    }
	    
	    $query = $this->db->query($sql);
	    return $query->result();
  	}

  	public function save_company($input){
  		$info['company'] = htmlspecialchars($input['txt_company']);
  		$this->db->insert('company', $info);
  		if ( $this->db->affected_rows() == 1 ){
  			$this->db->insert_id();
  		} else {
  			return FALSE;
  		}
  	}

  	public function count_client_position(){
		$query = $this->db->query("SELECT * FROM client_position");
		$count = $query->num_rows();
		return $count;
	}

	public function client_position_list($limit, $offset){
	    $sql = "SELECT * FROM client_position";

	    if ($limit) {
	      if(!$offset){
	        $sql .= " LIMIT $limit";
	      }else{
	        $sql .= " LIMIT $limit OFFSET $offset";
	      }
	    }
	    
	    $query = $this->db->query($sql);
	    return $query->result();
  	}

  	public function employee_ext_id($previd){
  		$query = $this->db->query("SELECT extId FROM tblmas_employee WHERE extId = '$previd'");
		$count = $query->num_rows();
		return $count;
  	}

	public function getOfficeLocations(){
		$result = $this->db->get('office_location')->result();
		return $result;
	}

	public function groupList(){
		$query = $this->db->get('tbl_group');
		return $query->result_array();
	}

	public function getPositionDependent($departmentId){
		// $query = $this->db->select('*')
		// ->where('iddept', '$departmentId')
		// ->from('tblfile_position');
		$query = $this->db->get_where('tblfile_position', array('iddept' => $departmentId));
		return $query->result();
	}

	public function getAllPosition(){
		$query = $this->db->get('tblfile_position');
		return $query->result();
	}

	public function getOfficeDescription($officeLocationId = NULL){
		if ($officeLocationId == NULL){
			$officeLocationId = 1;
		}
		$result = $this->db->get_where('office_location', array('office_location_id' => $officeLocationId));
		return $result->row();
	}

	public function getGroup(){
		$query = $this->db->get('tbl_group');
		return $query->result();
	}

	public function getEmployeeStatus(){
		$query = $this->db->get('employee_status');
		return $query->result();
	}

	public function saveOfficeLocation($input){
		$info['office_location_desc'] = htmlspecialchars($input['txtOfficeLocation']);
		$this->db->insert('office_location', $info);
		if ( $this->db->affected_rows() == 1 ){
			$this->db->insert_id();
		} else {
			return FALSE;
		}
	}

	public function modifyOfficeLocation($input, $officeLocationId){
		$info['office_location_desc'] = htmlspecialchars($input['office_location_desc']);
		$this->db->where('office_location_id', $officeLocationId);
		$this->db->update('office_location', $info);
		if ($this->db->affected_rows() > 0){
			return TRUE;
		}
	}

	public function getEmployeeByOfficeId($officeLocationId){
		$query = $this->db->get_where('tblmas_employee', array('office_location_id' => $officeLocationId));
		if ($query->result()){
			return TRUE;
		}
	}

	public function deleteOfficeLocation($officeLocationId){
		$this->db->where('office_location_id', $officeLocationId);
        $this->db->delete('office_location');
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
	}
}	