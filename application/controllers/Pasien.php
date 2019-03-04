<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mod_pasien');
		$this->load->model('Mod_user');
	}

	// Add a new item
	public function insert()
	{
		$jk = !empty($this->input->post('jk1')) ? $this->input->post('jk1') : $this->input->post('jk2');
		$now = $this->Mod_pasien->now();
		$data = array(
			'no_rm' => $this->input->post('no_rm'),
			'idjenis' => $this->input->post('idjenis'),
			'nik' => $this->input->post('nik'),
			'nama_pasien' => $this->input->post('nama_pasien'),
			'tgl_lahir' => $this->input->post('tgl_lahir'),
			'tgl_masuk' => $now,
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'jenis_kelamin' => $jk,
			'domisili' => $this->input->post('domisili'),
			'alamat' => $this->input->post('alamat'),
		);

		/*$this->pre($data);
		die;*/

		

		$cek = $this->Mod_pasien->cek_nik($data['nik']);
		/*$this->pre($cek);
		die;*/

		if($cek > 0){

			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<h4>NIK SUDAH TERDAFTAR</h4>
							</div>');
			redirect('Dashboard','refresh');

		}else{

			$query = $this->Mod_pasien->insert($data);

			if(!empty($query)){

				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<h4>Berhasil Input Data</h4>
							</div>');
				redirect('Dashboard','refresh');

			}else{

				$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<h4>Galat</h4>
							</div>');
				redirect('Dashboard','refresh');

			}
		}

	}

	//Update one item
	public function update($no_rm)
	{
		$jk = !empty($this->input->post('jk1')) ? $this->input->post('jk1') : $this->input->post('jk2');

		$data = array(
			'no_rm' => $this->input->post('no_rm'),
			'idjenis' => $this->input->post('idjenis'),
			'nik' => $this->input->post('nik'),
			'nama_pasien' => $this->input->post('nama_pasien'),
			'tgl_lahir' => $this->input->post('tgl_lahir'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'jenis_kelamin' => $jk,
			'domisili' => $this->input->post('domisili'),
			'alamat' => $this->input->post('alamat'),
		);

		$query = $this->Mod_pasien->update($no_rm, $data);

		if(!empty($query)){
			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<h4>Data Berhasil Di Ubah</h4>
							</div>');
			redirect('Dashboard','refresh');

		}else{

			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<h4>Galat</h4>
							</div>');
			redirect('Dashboard','refresh');
		}
	}

	//Delete one item
	public function delete($id)
	{
		$query = $this->Mod_pasien->delete($id);

		if($query == true){

			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<h4>Data Berhasil Dihapus</h4>
							</div>');
			redirect('Dashboard','refresh');

		}else{

			$this->session->set_flashdata('msg', '<div class="alert alert-galat alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<h4>Galat</h4>
							</div>');
			redirect('Dashboard','refresh');

		}
	}

	public function edit($no_rm)
	{
		$id = $this->session->userdata('id');
		$user = $this->Mod_user->get_user_by_id($id);
		$query = $this->Mod_pasien->get_pasien_by_no($no_rm);
		$arr_jenisid = array(
			'KTP','SIM'
		);

		$data = array(
				'user' => $user,
				'title' => 'Trust Medis',
				'icon' => 'Dashboard / Pendaftaran',
				'jenisid' => $arr_jenisid,
				'data' => $query
		);

		$this->load->view('Header', $data);
		$this->load->view('Pasien/Modal_edit');
		$this->load->view("Footer");
	}

	public function get_pasien_by_no()
	{
		$no_rm = $this->input->post('norm');
		$query = $this->Mod_pasien->get_pasien_by_no($no_rm);
		
		if(empty($query)){
			
			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<h4>NO RM TIDAK TERSEDIA</h4>
							</div>');

		}else{
			
			$data = array(
				'data' => $query,
			);

			$this->load->view('Pasien/Load_get_pasien', $data);
				
		}
		//return echo json_encode($query);
		

	}


	function get_data_pasien()
    {
        $list = $this->Mod_pasien->get_datatables();
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
            $row[] = $field->no_rm;
            $row[] = $field->idjenis;
            $row[] = $field->nik;
            $row[] = $field->nama_pasien;
            $row[] = $field->tgl_lahir;
            $row[] = $field->tgl_masuk;
            $row[] = $field->tempat_lahir;
            $row[] = $field->jenis_kelamin;
            $row[] = $field->domisili;
            $row[] = $field->alamat;
            $row[] = '<a href="'.site_url('Pasien/delete/'.$field->no_rm).'" onclick="return confirm("Yakin ingin menghapus data")" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a> | <a href="'.site_url('Pasien/edit/'.$field->no_rm).'" class="btn btn-primary btn-xs" title="Edit'.$field->nik.'"><b class="glyphicon glyphicon-edit"></b></a></tr>';
 
            $data[] = $row;
        }	
 	
 		$draw = (isset($_POST['draw'])) ? $_POST['draw'] : 0;
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $this->Mod_pasien->count_all(),
            "recordsFiltered" => $this->Mod_pasien->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    function pre($var){
    	echo '<pre>';
    	print_r($var);
    	echo '</pre>';
    }
}

/* End of file Pasien.php */
/* Location: ./application/controllers/Pasien.php */
