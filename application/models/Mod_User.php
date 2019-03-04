<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_User extends CI_Model {

	var $table = 'user';

	function get_user($username, $password)	{

		$result = $this->db->get_where($this->table, array('nama' => $username, 'password' => $password))->row();

		return $result;

	}

	public function get_user_by_id($id)
	{
		$result = $this->db->get_where($this->table, array('id' => $id))->row();
		return $result;
	}

}

/* End of file Mod_User.php */
/* Location: ./application/models/Mod_User.php */