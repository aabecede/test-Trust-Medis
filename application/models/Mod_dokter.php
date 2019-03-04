<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_dokter extends CI_Model {

	var $table ='dokter';

	function get_dokter(){

		return $this->db->get($this->table)->result();

	}

}

/* End of file Mod_dokter.php */
/* Location: ./application/models/Mod_dokter.php */