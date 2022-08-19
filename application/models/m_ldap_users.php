<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ldap_users extends CI_Model {
    // public function get_ldap_users() {
	// 	return $this->db->get('ldap_users')->result();
	// }

    var $table = 'ldap_users';
    var $column_order = array(null, 'name', 'department', 'position', 'email');
    var $order = array(null, 'name', 'department', 'position', 'email');

    private function _get_ldap_users_query() {
        $this->db->from($this->table);

        if (isset($_POST['search']['value'])) {
            $this->db->group_start();
            $this->db->like('email', $_POST['search']['value']);
            $this->db->or_like('name', $_POST['search']['value']);
            $this->db->or_like('department', $_POST['search']['value']);
            $this->db->or_like('position', $_POST['search']['value']);
            $this->db->group_end();
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('name', 'ASC');
        }
    }

    public function get_ldap_users() {
        $this->_get_ldap_users_query();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_data()
    {
        $this->_get_ldap_users_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_data()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

	public function save_ldap_user($ldap_user) {
		$email = $ldap_user['email'];
		$name = $ldap_user['name'];
		$department = $ldap_user['department'];
		$position = $ldap_user['position'];
		$sql = "INSERT IGNORE INTO ldap_users(email, name, department, position) VALUES ('$email', '$name', '$department', '$position')";
		$this->db->query($sql);
		if ($this->db->affected_rows() == 1) {
            return $this->db->insert_id();
        }
	}

    public function get_ldap_tes() {
        return $this->db->get($this->table)->result();
    }
}
?>