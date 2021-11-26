<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class m_copier_registration extends CI_Model {
    public function __construct(){
        parent::__construct();
    }
    
    public function count_registration_data() {
        $this->db->select('*');
        $this->db->join('copier_id', 'tblmas_employee.idemployee = copier_id.idemployee', 'right');
        $this->db->from('tblmas_employee');
        
        return $this->db->count_all_results();
    }
    
    public function get_registration_data($limit = 0, $offset = 0) {
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
        
        if ($limit != 0) {
            $this->db->limit($limit, $offset);
        }
        $this->db->order_by('c.idemployee', 'DESC');
        return $this->db->get('copier_id c')->result();
    }
    
    public function count_registration_data_search($selSearch = false, $txtSearch = false) {
    
        if ($selSearch == '0') {
            $this->db->like('tblmas_employee.employeename', $txtSearch);
            $this->db->or_like('tblmas_employee.fingerid', $txtSearch);
            $this->db->or_like('copier_id.others_password', $txtSearch);
            $this->db->or_like('copier_id.sharp_password', $txtSearch);
            $this->db->or_like('tblfile_department.deptdesc', $txtSearch);
            $this->db->or_like('tblfile_position.positiondesc', $txtSearch);
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
        $this->db->join('tblfile_department', 'tblfile_department.iddept = tblmas_employee.iddept', 'left');
        $this->db->join('tblfile_position', 'tblfile_position.idposition = tblmas_employee.idposition', 'left');
        $this->db->join('copier_id', 'tblmas_employee.fingerid = copier_id.idemployee', 'right');
        $this->db->from('tblmas_employee');
        
        return $this->db->count_all_results();
    }
    
    public function get_registration_data_search($limit, $selSearch, $txtSearch, $offset) {
        // var_dump('model->selSearch: ' . $selSearch . '| txtSearch: ' . $txtSearch);
        if ($selSearch === '0') {
            // if ($txtSearch) {
                $this->db->like('tblmas_employee.employeename', $txtSearch);
                $this->db->or_like('tblmas_employee.fingerid', $txtSearch);
                $this->db->or_like('copier_id.others_password', $txtSearch);
                $this->db->or_like('copier_id.sharp_password', $txtSearch);
                $this->db->or_like('tblfile_department.deptdesc', $txtSearch);
                $this->db->or_like('tblfile_position.positiondesc', $txtSearch);
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
                    tblmas_employee.fingerid,
                    copier_id.others_password,
                    copier_id.sharp_password,
                    tblmas_employee.employeename,
                    tblfile_department.deptdesc,
                    tblfile_position.positiondesc,
                    tblmas_employee.email	
        ');
    
        $this->db->join('tblfile_department', 'tblfile_department.iddept = tblmas_employee.iddept', 'left');
        $this->db->join('tblfile_position', 'tblfile_position.idposition = tblmas_employee.idposition', 'left');
        $this->db->join('copier_id', 'tblmas_employee.fingerid = copier_id.idemployee', 'right');
        
        if (!$offset){
            $this->db->limit($limit);
        } else {
            $this->db->limit($limit, $offset);
        }
        $this->db->order_by('copier_id.idemployee', 'DESC');
        return $this->db->get('tblmas_employee')->result();
    }

    public function upload_register($data_upload) {
        $this->db->insert_batch('copier_id', $data_upload);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    function get_employee_by_id($employeeID) {
        $this->db->select('
                    tblmas_employee.fingerid,
                    copier_id.others_password,
                    copier_id.sharp_password,
                    tblmas_employee.employeename,
                    tblfile_department.deptdesc,
                    tblfile_position.positiondesc,
                    tblmas_employee.email	
        ');
        $this->db->join('tblfile_department', 'tblfile_department.iddept = tblmas_employee.iddept', 'left');
        $this->db->join('tblfile_position', 'tblfile_position.idposition = tblmas_employee.idposition', 'left');
        $this->db->join('copier_id', 'tblmas_employee.fingerid = copier_id.idemployee', 'right');
        $this->db->where('tblmas_employee.fingerid', $employeeID);
        return $this->db->get('tblmas_employee')->row();
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
}
