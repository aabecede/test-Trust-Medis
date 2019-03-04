<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RawatJalan extends CI_Controller {

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
			$this->load->model('Mod_poli');
			$this->load->model('Mod_dokter');
			$this->load->model('Mod_kelas');
			$this->load->model('Mod_rawatjalan');

		}
	}

	public function index()
	{
		$id = $this->session->userdata('id');
		$user = $this->Mod_user->get_user_by_id($id);
		$pembayaran = array('BPJS','UMUM');
		$penanggung = array('Sendiri', 'Pemerintah');

		$data = array(
				'user' => $user,
				'title' => 'Trust Medis',
				'icon' => 'Rawat Jalan / Pendaftaran',
				'pembayaran' => $pembayaran,
				'penanggung' => $penanggung,
				'kelas' => $this->Mod_kelas->get_kelas(),
				'poli'=> $this->Mod_poli->get_poli(),
				'dokter' => $this->Mod_dokter->get_dokter(),

			);

		$this->load->view('Header', $data);
		$this->load->view('RawatJalan/Index');
		$this->load->view('Footer');

		
	}

	public function insert()
	{
		$data = $this->input->post();
		$query = $this->Mod_rawatjalan->insert($data);

		if(!empty($query)){

			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h4>Berhasil Menambahkan Rawat Jalan</h4>
						</div>');

			redirect('RawatJalan','refresh');

		}else{

			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h4>Galat</h4>
						</div>');

			redirect('RawatJalan','refresh');

		}
	}

	//datatables
	function get_data_rawat()
    {
        $list = $this->Mod_rawatjalan->get_datatables();
        $data = array();

     	if(isset($_POST['start'])){
			
			$no = $_POST['start'];

		}else{

			$_POST['start'] = 0;
			$_POST['lenght'] = 10;

		}
		$no = 0;
       
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->no_dftr;
            $row[] = $field->no_rm;
            $row[] = $field->id_jenis_bayar;
            $row[] = $field->no_asuransi	;
            $row[] = $field->id_penanggung;
            $row[] = $field->namakelas;
            $row[] = $field->namapoli;
            $row[] = $field->namadokter;	
           
 
            $data[] = $row;
        }	
 	
 		$draw = (isset($_POST['draw'])) ? $_POST['draw'] : 0;
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $this->Mod_rawatjalan->count_all(),
            "recordsFiltered" => $this->Mod_rawatjalan->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

	public function pre($var)
	{
		echo "<pre>";
		print_r($var);
		echo '</pre>';
	}

}

/* End of file RawatJalan.php */
/* Location: ./application/controllers/RawatJalan.php */