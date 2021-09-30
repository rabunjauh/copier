<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_login extends CI_Model {

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

	public function login($input){
		$username = htmlspecialchars($input['username']);
		$password = $input['password'];
		$query = $this->db->get_where('user',
					[
						'username' => $username,
						'password' => sha1($password)
					],
				1);
		$result = $query->row();
		if ( $result ){
			$this->session->set_userdata('username', $username);
			return true;
		}
	}
}	