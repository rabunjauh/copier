<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_employee extends CI_Model {

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

	public function count_employee() {
		$this->db->select('idemployee');
		$this->db->join('tblfile_department', 'tblmas_employee.iddept = tblfile_department.iddept');
		$this->db->join('tblfile_position', 'tblmas_employee.idposition = tblfile_position.idposition');
		$this->db->from('tblmas_employee');
		$this->db->where('email !=', '');
		return $this->db->count_all_results();
	}

	// public function employee_list($limit = FALSE, $offset = FALSE) {
	// 	if (!$offset) {
	// 		$this->db->limit($limit);
	// 	} else {
	// 		$this->db->limit($limit, $offset);
	// 	}
	// 	$this->db->select('tblmas_employee.idemployee, tblmas_employee.employeeno, tblmas_employee.employeename, tblmas_employee.email, tblfile_department.iddept, tblfile_department.deptdesc, tblfile_position.idposition, tblfile_position.positiondesc');
	// 	$this->db->join('tblfile_department', 'tblmas_employee.iddept = tblfile_department.iddept');
	// 	$this->db->join('tblfile_position', 'tblmas_employee.idposition = tblfile_position.idposition');
	// 	$this->db->where('email !=', '');
	// 	$this->db->order_by('idemployee', 'DESC');
	// 	return $this->db->get('tblmas_employee')->result();

	// }
	
	// public function employee_list($limit = FALSE, $offset = FALSE) {
	// 	if (!$offset) {
	// 		$this->db->limit($limit);
	// 	} else {
	// 		$this->db->limit($limit, $offset);
	// 	}
	// 	$this->db->select('te.fingerid, te.employeeno, te.employeename, te.email, td.iddept, td.deptdesc, tp.idposition, tp.positiondesc');
	// 	$this->db->join('tblfile_department td', 'te.iddept = td.iddept');
	// 	$this->db->join('tblfile_position tp', 'te.idposition = tp.idposition');
	// 	$this->db->where('email !=', '');
	// 	$this->db->order_by('idemployee', 'DESC');
	// 	return $this->db->get('tblmas_employee te')->result();
	// }

	public function get_department() {
		$this->db->order_by('deptdesc', 'ASC');
        return $this->db->get('tblfile_department')->result();
    }
	
	public function get_position() {
		$this->db->order_by('positiondesc', 'ASC');
        return $this->db->get('tblfile_position')->result();
    }

	public function getPositionDependent($iddept) {
		$this->db->order_by('positiondesc', 'ASC');
		return $this->db->get_where('tblfile_position', array('iddept' => $iddept))->result();
	}
}	