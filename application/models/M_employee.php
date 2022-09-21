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

	public function count_department() {
		$this->db->select('*');
		$this->db->from('tblfile_department');
		return $this->db->count_all_results();
	}

	public function department_list() {
		$this->db->order_by('iddept', 'ASC');
		return $this->db->get('tblfile_department')->result();
	}
	

	public function save_department($input) {
		$info['deptdesc'] = $input['deptdesc'];
		$info['stsactive'] = $input['stsactive'];
		$this->db->insert('tblfile_department', $info);
		if ($this->db->affected_rows() == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function update_department($input, $iddept) {
		$info['deptdesc'] = $input['deptdesc'];
		$info['stsactive'] = $input['stsactive'];
		$this->db->where('iddept', $iddept);
		$this->db->update('tblfile_department', $info);
		if ($this->db->affected_rows() == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function delete_department($iddept) {
		$this->db->where('iddept', $iddept);
		$this->db->delete('tblfile_department');
		if ($this->db->affected_rows() == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function get_department() {
		$this->db->order_by('deptdesc', 'ASC');
        return $this->db->get('tblfile_department')->result();
    }

	public function get_department_by_id($iddept) {
		$this->db->where('iddept', $iddept);
		return $this->db->get('tblfile_department')->row();
	}

	public function count_position() {
		$this->db->select('*');
		$this->db->from('tblfile_position');
		return $this->db->count_all_results();
	}

	public function position_list() {
		$this->db->select('tp.idposition, tp.positiondesc, td.deptdesc');
		$this->db->join('tblfile_department td', 'td.iddept = tp.iddept');
		$this->db->order_by('td.iddept', 'ASC');
		$this->db->order_by('tp.positiondesc', 'ASC');
        return $this->db->get('tblfile_position tp')->result();
	}
	
	public function save_position($input) {
		$info['positiondesc'] = html_escape($input['txtPosition']);
		$info['iddept'] = $input['selDepartment'];
		$this->db->insert('tblfile_position', $info);
		if ($this->db->affected_rows() == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function update_position($input, $idposition) {
		$info['positiondesc']  = html_escape($input['positiondesc']);
		$info['iddept'] = $input['iddept'];
		$this->db->where('idposition', $idposition);
		$this->db->update('tblfile_position', $info);
		if ($this->db->affected_rows() == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function delete_position($idposition) {
		$this->db->where('idposition', $idposition);
		$this->db->delete('tblfile_position');
		if ($this->db->affected_rows() == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function get_position() {
		$this->db->order_by('positiondesc', 'ASC');
        return $this->db->get('tblfile_position')->result();
    }

	public function get_position_by_id($idposition) {
		$this->db->select('tp.idposition, tp.positiondesc, td.iddept, td.deptdesc');
		$this->db->join('tblfile_department td', 'td.iddept = tp.iddept');
		$this->db->where('tp.idposition', $idposition);
		return $this->db->get('tblfile_position tp')->row();
	}

	public function getPositionDependent($iddept) {
		$this->db->order_by('positiondesc', 'ASC');
		return $this->db->get_where('tblfile_position', array('iddept' => $iddept))->result();
	}
}	