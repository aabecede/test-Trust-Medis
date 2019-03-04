<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$session= $this->session->userdata('id');

		if(empty($session)){ //when session is null

			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h4>SILAHKAN LOGIN</h4>
						</div>');

			redirect('Login','refresh');

		}else{

			$this->load->model('Mod_user');
			$this->load->model('Mod_pasien');

		}


	}

	public function index()
	{
		$id = $this->session->userdata('id');
		$user = $this->Mod_user->get_user_by_id($id);
		$norm = $this->Mod_pasien->get_no_rm();

		$arr_jenisid = array(
			'KTP','SIM'
		);

		$poli = $user->status;



		if($poli == 'loket'){

			#$this->pre($poli);
			$data = array(
				'user' => $user,
				'title' => 'Trust Medis',
				'icon' => 'Dashboard / Pendaftaran',
				'norm' => $norm,
				'jenisid' => $arr_jenisid,

			);

			$this->load->view('Header', $data);
			$this->load->view('Dashboard');
			$this->load->view('Footer');

		}else{

			$data = array(
				'user' => $user,
				'title' => 'Trust Medis',
				'icon' => 'Pasien / '.$user->status,
			);

			$this->load->view('Header', $data);
			$this->load->view('Dashboard');
			$this->load->view('Footer');

		}


		

	}

	function pre($var){
		echo '<pre>';
		print_r($var);
		echo '</pre>';
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */