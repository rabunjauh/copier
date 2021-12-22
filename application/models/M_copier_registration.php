<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class m_copier_registration extends CI_Model {
    public function __construct(){
        parent::__construct();
    }
    
    public function count_registration_data() {
        $this->db->select('*');
        $this->db->from('copier_id');
        
        return $this->db->count_all_results();
    }
    
    public function get_registration_data() {
        $this->db->select('
                    c.id,
                    c.idemployee,
                    c.employeename,
                    td.deptdesc,
                    tp.positiondesc,
                    c.email,
                    c.sharp_password,
                    c.others_password
        ');
        $this->db->join('tblfile_department td', 'td.iddept = c.iddept', 'left');
        $this->db->join('tblfile_position tp', 'tp.idposition = c.idposition', 'left');
        
        $client_subcon = array('CLIENT', 'SUBCON');
        $this->db->where_not_in('td.deptdesc', $client_subcon);
        $this->db->order_by('c.others_password', 'DESC');
        return $this->db->get('copier_id c')->result();
    }

    function get_registration_by_id($id) {
        $this->db->select('
					c.id,
					c.idemployee,
					c.employeename,
					c.iddept,
					c.idposition,
					c.email,
					c.sharp_password,
					c.others_password,
					td.deptdesc,
					tp.positiondesc
        ');
        $this->db->join('tblfile_department td', 'td.iddept = c.iddept', 'left');
        $this->db->join('tblfile_position tp', 'tp.idposition = c.idposition', 'left');
        $this->db->where('c.id', $id);
        return $this->db->get('copier_id c')->row();
    }
    
    public function count_registration_data_search($selSearch = false, $txtSearch = false) {
    
        if ($selSearch == '0') {
            $this->db->like('c.employeename', $txtSearch);
            $this->db->or_like('c.idemployee', $txtSearch);
            $this->db->or_like('c.others_password', $txtSearch);
            $this->db->or_like('c.sharp_password', $txtSearch);
            $this->db->or_like('td.deptdesc', $txtSearch);
            $this->db->or_like('tp.positiondesc', $txtSearch);
        // } else if ($selSearch == 'employeename') {
        //     $this->db->like('tblmas_employee.employeename', $txtSearch);
        // } else if ($selSearch == 'idemployee') {
        //     $this->db->like('tblmas_employee.fingerid', $txtSearch);
        // } else if ($selSearch == 'other_password') {
        //     $this->db->like('copier_id.others_password', $txtSearch);
        // } else if ($selSearch == 'sharp_password') {
        //     $this->db->like('copier_id.sharp_password', $txtSearch);
        // } else if ($selSearch == 'positiondesc') {
        //     $this->db->like('tblfile_position.positiondesc', $txtSearch);
        // } else if ($selSearch == 'deptdesc') {
        //     $this->db->where('tblfile_department.iddept', $txtSearch);
        } 
    
        $this->db->select('*');
        $this->db->join('tblfile_department td', 'td.iddept = c.iddept', 'left');
        $this->db->join('tblfile_position tp', 'tp.idposition = c.idposition', 'left');
        $this->db->from('copier_id c');
        
        return $this->db->count_all_results();
    }
    
    public function get_registration_data_search($limit, $selSearch, $txtSearch, $offset) {
        // var_dump('model->selSearch: ' . $selSearch . '| txtSearch: ' . $txtSearch);
        if ($selSearch === '0') {
            // if ($txtSearch) {
                $this->db->like('c.employeename', $txtSearch);
                $this->db->or_like('c.idemployee', $txtSearch);
                $this->db->or_like('c.others_password', $txtSearch);
                $this->db->or_like('c.sharp_password', $txtSearch);
                $this->db->or_like('td.deptdesc', $txtSearch);
                $this->db->or_like('tp.positiondesc', $txtSearch);
            // }
        // } else if ($selSearch == 'employeename') {
        //     $this->db->like('tblmas_employee.employeename', $txtSearch);
        // } else if ($selSearch == 'idemployee') {
        //     $this->db->like('tblmas_employee.fingerid', $txtSearch);
        // } else if ($selSearch == 'other_password') {
        //     $this->db->like('copier_id.others_password', $txtSearch);
        // } else if ($selSearch == 'sharp_password') {
        //     $this->db->like('copier_id.sharp_password', $txtSearch);
        // } else if ($selSearch == 'positiondesc') {
        //     $this->db->like('tblfile_position.positiondesc', $txtSearch);
        // } else if ($selSearch == 'iddept') {
        //     $this->db->where('tblfile_department.deptdesc', $txtSearch);
        } 
    
        $this->db->select('
                    c.id,
                    c.idemployee,
                    c.others_password,
                    c.sharp_password,
                    c.employeename,
                    td.deptdesc,
                    tp.positiondesc,
                    c.email	
        ');
    
        $this->db->join('tblfile_department td', 'td.iddept = c.iddept', 'left');
        $this->db->join('tblfile_position tp', 'tp.idposition = c.idposition', 'left');
        
        if (!$offset){
            $this->db->limit($limit);
        } else {
            $this->db->limit($limit, $offset);
        }
        $this->db->order_by('c.idemployee', 'DESC');
        return $this->db->get('copier_id c')->result();
    }

    public function get_registration_export() {
        $this->db->select('
                    c.id,
                    c.idemployee,
                    c.employeename,
                    td.deptdesc,
                    tp.positiondesc,
                    c.email,
                    c.sharp_password,
                    c.others_password
        ');
        $this->db->join('tblfile_department td', 'td.iddept = c.iddept', 'left');
        $this->db->join('tblfile_position tp', 'tp.idposition = c.idposition', 'left');
        $this->db->order_by('c.others_password', 'ASC');
        return $this->db->get('copier_id c')->result();
    }

    public function upload_register($data_upload) {
        $this->db->insert_batch('copier_id', $data_upload);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    

    public function get_new_employee() {
        $this->db->where('email !=', '');
        $this->db->limit(1);
        $this->db->select('fingerid');
        $this->db->order_by('tblmas_employee.idemployee', 'DESC');
        return $this->db->get('tblmas_employee')->row();
    }

    public function count_employee(){
        $this->db->where('email !=', '');
        $this->db->select('fingerid');
        $this->db->order_by('tblmas_employee.idemployee', 'DESC');
        return $this->db->count_all_results();
    }

    public function get_last_row() {
        $this->db->limit(1);
        // $this->db->select('idemployee');
        $this->db->order_by('id', 'DESC');
        return $this->db->get('copier_id')->row();
    }

    // public function count_wasco_fingerman_employee() {
    //     $this->db->select('idemployee');
    //     $this->db->from('tblmas_employee');
    //     return $this->db->count_all_results();
    // }
    
    // public function count_copier_employee() {
    //     $this->db->select('idemployee');
    //     $this->db->from('copier.tblmas_employee');
    //     return $this->db->count_all_results();
    // }
    
    public function count_table($col, $db, $table_name) {
        $this->db->select($col);
        $this->db->from($db . '.' . $table_name);
        return $this->db->count_all_results();
    }

    public function get_difference($limit, $orderby, $tblname) {
        $this->db->limit($limit);
        $this->db->order_by($orderby, 'DESC');
        return $this->db->get('' . $tblname)->result();
    }

    public function duplicate_table($difference, $limit, $tblname) {
        if ($limit > 0) {
            foreach ($difference as $different) {
                $this->db->insert($tblname, $different);
            }
        }
    }

    public function save_register($input) {
		$info['idemployee'] = html_escape($input['txt_idemployee']);
		$info['others_password'] = html_escape($input['txt_others_password']);
		$info['sharp_password'] = html_escape($input['txt_sharp_password']);
		$info['employeename'] = html_escape($input['txt_employee_name']);
		$info['iddept'] = $input['sel_dept'];
		$info['idposition'] = $input['sel_position'];
		$info['email'] = html_escape($input['txt_employee_email']);
		$this->db->insert('copier_id', $info);
		if ($this->db->affected_rows() == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

    public function update_register($input, $id) {
        $info['idemployee'] = html_escape($input['txt_employeeid']);
		$info['others_password'] = html_escape($input['txt_other_password']);
		$info['sharp_password'] = html_escape($info['others_password']);
		$info['employeename'] = html_escape($input['txt_employeename']);
		$info['iddept'] = $input['sel_dept'];
		$info['idposition'] = $input['sel_position'];
		$info['email'] = html_escape($input['txt_email']);
        $this->db->where('id', $id);
		$this->db->update('copier_id', $info);
		if ($this->db->affected_rows() == 1) {
            	return TRUE;
		} else {
			return FALSE;
		}
    }

    public function get_last_others_password() {
        $this->db->limit(1);
        $this->db->order_by('id', 'DESC');
        $this->db->select('others_password');
        return $this->db->get('copier_id')->row();
    }

    public function get_client_subcon() {
        $this->db->select('
                    c.id,
                    c.idemployee,
                    c.employeename,
                    td.deptdesc,
                    tp.positiondesc,
                    c.email,
                    c.sharp_password,
                    c.others_password
        ');
        $this->db->join('tblfile_department td', 'td.iddept = c.iddept', 'left');
        $this->db->join('tblfile_position tp', 'tp.idposition = c.idposition', 'left');
        $client_subcon = array('CLIENT', 'SUBCON');
        $this->db->where_in('td.deptdesc', $client_subcon);
        $this->db->order_by('c.others_password', 'DESC');
        return $this->db->get('copier_id c')->result();
    }
}
