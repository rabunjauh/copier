<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mextensions extends CI_Model {

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

	public function index($department, $officeLocationId = NULL){
		// if ($officeLocationId == NULL){
		// 	$officeLocationId = 1;
		// }
		foreach ($department as $value) {
			$iddept = $value->iddept;
			$sql = "SELECT 
					te.employeename,
					te.ext,
					te.extId,
					te.code,
					ext.extension,
					td.deptdesc,
					tp.positiondesc 
				FROM tblmas_employee te 
				LEFT JOIN tblfile_department td ON te.iddept = td.iddept 
				LEFT JOIN tblfile_position tp ON te.idposition = tp.idposition
				LEFT JOIN office_location ol ON te.office_location_id = ol.office_location_id 
				LEFT JOIN ext ON te.extId = ext.id 
				WHERE te.iddept = $iddept 
							AND te.stsactive = '1' 
							AND ol.office_location_id = '$officeLocationId'
				ORDER BY tp.level ASC";
			$query = $this->db->query($sql);
			if ($query->result_array()) {
				$results[$value->deptdesc] = $query->result_array();
			}
		}
		if (isset($results)){
			return $results;
		}
	}

}
