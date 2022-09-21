<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ldap_users extends CI_Model {
    var $table = 'ldap_users';
    var $column_order = array(null, 'name', 'department', 'position', 'ldap_email', 'id');
    var $order = array(null, 'name', 'department', 'position', 'email', 'id');

    private function _get_ldap_users_query() {
        $this->db->from($this->table);

        if (isset($_POST['search']['value'])) {
            $this->db->group_start();
            $this->db->like('ldap_email', $_POST['search']['value']);
            $this->db->or_like('name', $_POST['search']['value']);
            $this->db->or_like('department', $_POST['search']['value']);
            $this->db->or_like('position', $_POST['search']['value']);
            $this->db->or_like('id', $_POST['search']['value']);
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
        if (isset($_POST['length'])) {
            if ($_POST['length'] != -1) {
                $this->db->limit($_POST['length'], $_POST['start']);
            }
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
        return $this->db->count_all_results($this->table);
    }

    public function get_ldap_user($email) {
        return $this->db->get_where('ldap_users', ['ldap_email' => $email])->row();
    }

	public function save_ldap_user($ldap_user) {
        $this->db->insert('ldap_users', $ldap_user);
		if ($this->db->affected_rows() == 1) {
            return $this->db->insert_id();
        }
	}

    public function update_ldap_user($ldap_user, $email) {
        if ($email === 'raquel.dechavez' ) {
            echo $ldap_user['position'];
        }
        $this->db->where('ldap_email', $email);
        $this->db->update('ldap_users', $ldap_user);
        if ($this->db->affected_rows() == 1) {
            return $this->db->insert_id();
        }
    }

    public function get_ldap_tes() {
        return $this->db->get($this->table)->result();
    }

    public function get_duplicate() {
        $query = $this->db->query('SELECT email, id, COUNT(email) FROM copier_id GROUP BY email HAVING COUNT(email) > 1');

        return $query->result();
    }

    public function get_old_duplicate($email) {
        $this->db->where('email', $email);
        $this->db->limit(1);
        $this->db->order_by('id', 'ASC');
        return $this->db->get('copier_id')->row_array();
    }

    public function get_ldap_data($email) {
        $this->db->where('ldap_email', $email);
        return $this->db->get('ldap_users')->row_array();
    }
}
?> 