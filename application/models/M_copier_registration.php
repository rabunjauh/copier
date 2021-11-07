<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class m_copier_registration extends CI_Model {
    public function __construct(){
        parent::__construct();
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
}
