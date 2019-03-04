<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mod_user');
	}

	public function index()
	{
		$this->load->view('Login');

	}

	public function process()
	{
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));

		//ceking
		$cek = $this->Mod_user->get_user($username, $password);

		if(!empty($cek)){
			//multi user
						
			$this->session->set_userdata('id', $cek->id);
			redirect('Dashboard','refresh');

		}else{

			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h4>Password / Username salah</h4>
						</div>');
			redirect('','refresh');

		}

	}

	function logout(){
		$this->session->sess_destroy();
		redirect('Login','refresh');
	}

	function pre($var){
		echo '<pre>';
		print_r($var);
		echo '</pre>';
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */