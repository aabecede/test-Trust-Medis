<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_poli extends CI_Model {

	var $table = 'poli';

	function get_poli(){
		return $this->db->get($this->table)->result();
	}

}

/* End of file Mod_poli.php */
/* Location: ./application/models/Mod_poli.php */