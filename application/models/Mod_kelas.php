<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_kelas extends CI_Model {

	var $table = 'kelas';

	public function get_kelas()
	{
		return $this->db->get($this->table)->result();
	}

}

/* End of file Mod_kelas.php */
/* Location: ./application/models/Mod_kelas.php */