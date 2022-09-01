<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_copier_registration extends CI_Model {
    var $column_order = array(null, 'c.idemployee', 'c.sharp_password', 'c.employeename', 'td.deptdesc', 'tp.positiondesc', 'c.email');
    var $order = array(null, 'c.idemployee', 'c.sharp_password', 'c.employeename', 'td.deptdesc', 'tp.positiondesc', 'c.email');

    private function _get_data_registration_query() {
        $this->db->select('
            c.id,
            c.sharp_password,
            c.others_password,
            c.idemployee,
            c.employeename,
            c.email,
            c.ldap_id,       
            td.deptdesc,
            tp.positiondesc,
            l.ldap_email,
            l.name,
            l.department,
            l.position
        ');
        $this->db->where_not_in('c.iddept', 22);
        $this->db->where_not_in('c.iddept', 23);
        $this->db->or_where('c.ldap_id !=', null);


        $this->db->join('tblfile_department td', 'td.iddept = c.iddept', 'left');
        $this->db->join('tblfile_position tp', 'tp.idposition = c.idposition', 'left');
        $this->db->join('ldap_users l', 'l.id = c.ldap_id', 'left');
        

        if (isset($_POST['search']['value'])) {
            $this->db->group_start();
            $this->db->like('idemployee', $_POST['search']['value']);
            $this->db->or_like('c.employeename', $_POST['search']['value']);
            $this->db->or_like('td.deptdesc', $_POST['search']['value']);
            $this->db->or_like('tp.positiondesc', $_POST['search']['value']);
            $this->db->or_like('c.email', $_POST['search']['value']);
            $this->db->or_like('c.sharp_password', $_POST['search']['value']);
            $this->db->or_like('c.others_password', $_POST['search']['value']);
            $this->db->or_like('l.ldap_email', $_POST['search']['value']);
            $this->db->or_like('l.name', $_POST['search']['value']);
            $this->db->or_like('l.department', $_POST['search']['value']);
            $this->db->or_like('l.position', $_POST['search']['value']);
            $this->db->group_end();
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('c.sharp_password', 'DESC');
        }
    }
    
    public function get_registration_data() {
        $this->_get_data_registration_query();
        
        if ($_POST['length'] != 1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        return $this->db->get('copier_id c')->result();
   }

   function get_registration_by_id($id) {
        $this->db->select('
            c.id,
            c.sharp_password,
            c.others_password,
            c.idemployee,
            c.employeename,
            c.iddept,
            c.idposition,
            c.email,
            c.ldap_id,       
            td.deptdesc,
            tp.positiondesc,
            l.ldap_email,
            l.name,
            l.department,
            l.position
        ');
        $this->db->join('tblfile_department td', 'td.iddept = c.iddept', 'left');
        $this->db->join('tblfile_position tp', 'tp.idposition = c.idposition', 'left');
        $this->db->join('ldap_users l', 'l.id = c.ldap_id', 'left');
        $this->db->where('c.id', $id);
        return $this->db->get('copier_id c')->row();
    }

   
    public function count_filtered_registration_data() {
        $this->_get_data_registration_query();    
        
        $this->db->from('copier_id c');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_registration_data() {
        $this->db->select('*');
        $this->db->from('copier_id');
        
        return $this->db->count_all_results();
    }

    public function count_registration_data_search($selSearch = false, $txtSearch = false) {
        if ($selSearch == '0') {
            $this->db->like('c.employeename', $txtSearch);
            $this->db->or_like('c.idemployee', $txtSearch);
            $this->db->or_like('c.others_password', $txtSearch);
            $this->db->or_like('c.sharp_password', $txtSearch);
            $this->db->or_like('td.deptdesc', $txtSearch);
            $this->db->or_like('tp.positiondesc', $txtSearch);
        } 
    
        $this->db->select('*');
        $this->db->join('tblfile_department td', 'td.iddept = c.iddept', 'left');
        $this->db->join('tblfile_position tp', 'tp.idposition = c.idposition', 'left');
        $this->db->from('copier_id c');
        
        return $this->db->count_all_results();
    }
    
    public function get_registration_data_search($limit, $selSearch, $txtSearch, $offset) {
        if ($selSearch === '0') {
                $this->db->like('c.employeename', $txtSearch);
                $this->db->or_like('c.idemployee', $txtSearch);
                $this->db->or_like('c.others_password', $txtSearch);
                $this->db->or_like('c.sharp_password', $txtSearch);
                $this->db->or_like('td.deptdesc', $txtSearch);
                $this->db->or_like('tp.positiondesc', $txtSearch);
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
                c.sharp_password,
                c.others_password,
                c.idemployee,
                c.employeename,
                c.email,
                c.ldap_id,       
                td.deptdesc,
                tp.positiondesc,
                l.ldap_email,
                l.name,
                l.department,
                l.position
            ');
        $this->db->join('tblfile_department td', 'td.iddept = c.iddept', 'left');
        $this->db->join('tblfile_position tp', 'tp.idposition = c.idposition', 'left');
        $this->db->join('ldap_users l', 'l.id = c.ldap_id', 'left');
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
		$info['iddept'] = html_escape($input['iddept']);
		$info['idposition'] = html_escape($input['txt_idposition']);
		$info['employeename'] = html_escape($input['txt_employee_name']);
		$info['ldap_id'] = html_escape($input['ldap_id']);
		$this->db->insert('copier_id', $info);
		if ($this->db->affected_rows() == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

    public function update_register($input, $id) {
        $info['idemployee'] = html_escape($input['txt_employeeid']);
        $info['employeename'] = html_escape($input['txt_employeename']);
		$info['iddept'] = html_escape($input['iddept']);
		$info['sharp_password'] = html_escape($input['txt_sharp_password']);
		$info['others_password'] = html_escape($input['txt_others_password']);
		$info['ldap_id'] = html_escape($input['ldap_id']);
        $this->db->where('id', $id);
		$this->db->update('copier_id', $info);
		if ($this->db->affected_rows() == 1) {
            	return TRUE;
		} else {
			return FALSE;
		}
    }

    public function get_last_sharp_password() {
        $this->db->limit(1);
        $this->db->order_by('id', 'DESC');
        $this->db->select('sharp_password');
        return $this->db->get('copier_id')->row();
    }

    public function get_client_subcon() {
        $this->db->select('
                    c.id,
                    c.idemployee,
                    c.employeename,
                    td.iddept,
                    tp.positiondesc,
                    c.email,
                    c.sharp_password,
                    c.others_password
        ');
        $this->db->join('tblfile_department td', 'td.iddept = c.iddept', 'left');
        $this->db->join('tblfile_position tp', 'tp.idposition = c.idposition', 'left');
        $this->db->where('td.iddept', 22);
        $this->db->order_by('c.sharp_password', 'DESC');
        return $this->db->get('copier_id c')->result();
    }
}
