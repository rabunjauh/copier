<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_user extends CI_Model {

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

	public function count_user(){
		$query = $this->db->query("SELECT * FROM user");
		$count = $query->num_rows();
		return $count;
	}

	public function user_list($limit, $offset){
	    $sql = "SELECT * FROM user";

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

	public function save_user($input){
		$info['name'] = strtolower(stripslashes($input['name']));
		$info['username'] = strtolower(stripslashes($input['username']));
		$info['email'] = strtolower(stripslashes($input['email']));
		// $info['password'] = $input['password'];
		// $confirm_password = $input['confirm_password'];
		// $username = $info['username'];
		
		// $sql = "SELECT username FROM user WHERE username = '$username'";
		// $query = $this->db->query($sql)->num_rows();
		// if ( $query ){
		// 	$message = '<div class="alert alert-danger">Username already exist!</div>';
        // 	$this->session->set_flashdata('message', $message);	
		// 	return false;
		// } 

		// if ( $confirm_password !== $info['password'] ){
		// 	$message = '<div class="alert alert-danger">Password did not match!</div>';
        // 	$this->session->set_flashdata('message', $message);	
		// 	return false;
		// }

		$info['password'] = sha1($info['password']);

		$this->db->insert('user', $info);
		if ( $this->db->affected_rows() == 1 ){
			return $this->db->insert_id();
		} else {
			return FALSE;
		}
		return true;
	}

	public function getUserByID($userID) {
		return $this->db->get_where('user', array('id' => $userID))->row();
	}

	public function saveModifyUser($formInfo, $userID) {
		$userdata = array(
			'email' => $formInfo['email'],
			'name' => $formInfo['name']
		);
		$this->db->set('email', $formInfo['email']);
		$this->db->where('id', $userID);
		$this->db->update('user', $userdata);
		if ($this->db->affected_rows() == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	public function changePassword($new_password, $userID) {
		$this->db->set('password', sha1($new_password));
		$this->db->where('id', $userID);
		$this->db->update('user');
		if ($this->db->affected_rows() == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function count_registration_data() {
		$this->db->select('*');
		$this->db->join('copier_id', 'wasco_fingerman.tblmas_employee.idemployee = copier_id.idemployee', 'right');
		$this->db->from('wasco_fingerman.tblmas_employee');
		
		return $this->db->count_all_results();
	}

	public function get_registration_data($limit = 0, $offset = 0) {
		$this->db->select('
					wasco_fingerman.tblmas_employee.fingerid,
					wasco_fingerman.tblmas_employee.employeename,
					wasco_fingerman.tblfile_department.deptdesc,
					wasco_fingerman.tblfile_position.positiondesc,
					wasco_fingerman.tblmas_employee.email,
					copier_id.sharp_password,
					copier_id.others_password,
		');
		$this->db->join('wasco_fingerman.tblfile_department', 'wasco_fingerman.tblfile_department.iddept = wasco_fingerman.tblmas_employee.iddept', 'left');
		$this->db->join('wasco_fingerman.tblfile_position', 'wasco_fingerman.tblfile_position.idposition = wasco_fingerman.tblmas_employee.idposition', 'left');
		$this->db->join('copier_id', 'wasco_fingerman.tblmas_employee.fingerid = copier_id.idemployee', 'right');
		
		if ($limit != 0) {
			$this->db->limit($limit, $offset);
		}
		$this->db->order_by('copier_id.idemployee', 'DESC');
		return $this->db->get('wasco_fingerman.tblmas_employee')->result();
	}

	public function count_registration_data_search($post = []) {

		$selSearch = $post['selSearch'];
		$txtSearch = $post['txtSearch'];
		$selDepartment = $post['selDepartment'];
		if ($selSearch === '0') {
			$this->db->like('wasco_fingerman.tblmas_employee.employeename', $txtSearch);
			$this->db->or_like('wasco_fingerman.tblmas_employee.fingerid', $txtSearch);
			$this->db->or_like('copier_id.others_password', $txtSearch);
			$this->db->or_like('copier_id.sharp_password', $txtSearch);
			$this->db->or_like('wasco_fingerman.tblfile_department.deptdesc', $txtSearch);
			$this->db->or_like('wasco_fingerman.tblfile_position.positiondesc', $txtSearch);
		} else {
			if ($selSearch == 'employeename') {
				$this->db->like('wasco_fingerman.tblmas_employee.employeename', $txtSearch);
			} else if ($selSearch == 'idemployee') {
				$this->db->like('wasco_fingerman.tblmas_employee.fingerid', $txtSearch);
			} else if ($selSearch == 'other_password') {
				$this->db->like('copier_id.others_password', $txtSearch);
			} else if ($selSearch == 'sharp_password') {
				$this->db->like('copier_id.sharp_password', $txtSearch);
			} else if ($selSearch == 'positiondesc') {
				$this->db->like('wasco_fingerman.tblfile_position.positiondesc', $txtSearch);
			} else if ($selSearch == 'deptdesc') {
				$this->db->where('wasco_fingerman.tblfile_department.iddept', $selDepartment);
			} 
		}

		$this->db->select('*');
		$this->db->join('wasco_fingerman.tblfile_department', 'wasco_fingerman.tblfile_department.iddept = wasco_fingerman.tblmas_employee.iddept', 'left');
		$this->db->join('copier_id', 'wasco_fingerman.tblmas_employee.fingerid = copier_id.idemployee', 'right');
		$this->db->from('wasco_fingerman.tblmas_employee');
		
		return $this->db->count_all_results();
	}
	
	public function get_registration_data_search($limit = 0, $offset = 0, $post = []) {
		$selSearch = $post['selSearch'];
		$txtSearch = $post['txtSearch'];
		$selDepartment = $post['selDepartment'];
		if ($selSearch === '0') {
			$this->db->like('wasco_fingerman.tblmas_employee.employeename', $txtSearch);
			$this->db->or_like('wasco_fingerman.tblmas_employee.fingerid', $txtSearch);
			$this->db->or_like('copier_id.others_password', $txtSearch);
			$this->db->or_like('copier_id.sharp_password', $txtSearch);
			$this->db->or_like('wasco_fingerman.tblfile_department.deptdesc', $txtSearch);
			$this->db->or_like('wasco_fingerman.tblfile_position.positiondesc', $txtSearch);
		} else {
			if ($selSearch == 'employeename') {
				$this->db->like('wasco_fingerman.tblmas_employee.employeename', $txtSearch);
			} else if ($selSearch == 'idemployee') {
				$this->db->like('wasco_fingerman.tblmas_employee.fingerid', $txtSearch);
			} else if ($selSearch == 'other_password') {
				$this->db->like('copier_id.others_password', $txtSearch);
			} else if ($selSearch == 'sharp_password') {
				$this->db->like('copier_id.sharp_password', $txtSearch);
			} else if ($selSearch == 'positiondesc') {
				$this->db->like('wasco_fingerman.tblfile_position.positiondesc', $txtSearch);
			} else if ($selSearch == 'deptdesc') {
				$this->db->where('wasco_fingerman.tblfile_department.iddept', $selDepartment);
			} 
		}

		$this->db->select('
					wasco_fingerman.tblmas_employee.fingerid,
					copier_id.others_password,
					copier_id.sharp_password,
					wasco_fingerman.tblmas_employee.employeename,
					wasco_fingerman.tblfile_department.deptdesc,
					wasco_fingerman.tblfile_position.positiondesc,
					wasco_fingerman.tblmas_employee.email	
		');

		$this->db->join('wasco_fingerman.tblfile_department', 'wasco_fingerman.tblfile_department.iddept = wasco_fingerman.tblmas_employee.iddept', 'left');
		$this->db->join('wasco_fingerman.tblfile_position', 'wasco_fingerman.tblfile_position.idposition = wasco_fingerman.tblmas_employee.idposition', 'left');
		$this->db->join('copier_id', 'wasco_fingerman.tblmas_employee.fingerid = copier_id.idemployee', 'right');
		
		if ($limit != 0) {
			$this->db->limit($limit, $offset);
		}
		$this->db->order_by('copier_id.idemployee', 'DESC');
		return $this->db->get('wasco_fingerman.tblmas_employee')->result();
	}

	public function get_department() {
		return $this->db->get('wasco_fingerman.tblfile_department')->result();
	}

	function get_employee_by_id($employeeID) {
		$this->db->select('
					wasco_fingerman.tblmas_employee.fingerid,
					copier_id.others_password,
					copier_id.sharp_password,
					wasco_fingerman.tblmas_employee.employeename,
					wasco_fingerman.tblfile_department.deptdesc,
					wasco_fingerman.tblfile_position.positiondesc,
					wasco_fingerman.tblmas_employee.email	
		');
		$this->db->join('wasco_fingerman.tblfile_department', 'wasco_fingerman.tblfile_department.iddept = wasco_fingerman.tblmas_employee.iddept', 'left');
		$this->db->join('wasco_fingerman.tblfile_position', 'wasco_fingerman.tblfile_position.idposition = wasco_fingerman.tblmas_employee.idposition', 'left');
		$this->db->join('copier_id', 'wasco_fingerman.tblmas_employee.fingerid = copier_id.idemployee', 'right');
		$this->db->where('wasco_fingerman.tblmas_employee.fingerid', $employeeID);
		return $this->db->get('wasco_fingerman.tblmas_employee')->row();
	}

	public function get_other_users($username) {
		$this->db->where_not_in('username', $username);
		return $this->db->get('user')->result();
	}

	public function delete_user($employeeID) {
		$this->db->where('id', $employeeID);
		$this->db->delete('user');
		if ($this->affected_row() == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}	