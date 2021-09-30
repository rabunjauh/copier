<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mpabx14 extends CI_Model {

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

	public function index()
	{
		$sql = "SELECT * FROM ext WHERE pabxLocation = 1 AND pabxNo = 4 ORDER BY port DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	
}
