<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_pasien extends CI_Model {

	var $table = 'pasien';

	//datatables
	var $column_order = array(null, 'no_rm', 'idjenis', 'nik' , 'nama_pasien', 'tgl_lahir', 'tgl_masuk', 'tempat_lahir', 'jenis_kelamin','domisili',null);
	var $column_search = array('no_rm', 'idjenis', 'nik' , 'nama_pasien', 'tgl_lahir', 'tgl_masuk', 'tempat_lahir', 'jenis_kelamin','domisili');
	var $order = array('no_rm' => 'desc');

	function get_no_rm(){

		$this->db->select('right(no_rm,7) as no_rm');
		$this->db->from($this->table);
		$this->db->order_by('no_rm','desc');

		$norm = $this->db->get()->row();

		if(!empty($norm->no_rm)){

			if($norm->no_rm < 10){
				
				$norm = "000000".($norm->no_rm + 1);

			}elseif ($norm->no_rm < 100) {
				
				$norm = "00000".($norm->no_rm + 1);

			}elseif ($norm->no_rm < 1000) {
				
				$norm = "000".($norm->no_rm + 1);

			}elseif ($norm->no_rm < 10000) {
				
				$norm = "00".($norm->no_rm + 1);

			}elseif ($norm->no_rm < 100000) {
				
				$norm = "0".($norm->no_rm + 1);

			}else{
				$norm = $norm->no_rm + 1;
			}

			//$norm->no_rm = $norm->no_rm->no_rm + 1;

		}else{

			$norm = '0000001';
		}
		return $norm;
	}

	public function get_pasien_by_no($id)
	{
		$this->db->where('no_rm', $id);
		return $this->db->get($this->table)->row();
	}

	public function insert($data){

		$query = $this->db->insert($this->table, $data);
		return $query;
	}

	public function update($no_rm, $data)
	{
		$this->db->where('no_rm', $no_rm);
		$query = $this->db->update($this->table, $data);
		return $query;
	}

	public function delete($id)
	{
		$this->db->where('no_rm', $id);
		return $this->db->delete($this->table);
	}

	public function cek_nik($nik)
	{
		return $this->db->get_where($this->table, array('nik' => $nik))->num_rows();
	}

	public function now(){

		$query = $this->db->query('select now() as now')->row();
		$query = $query->now;
		return $query;

	}


	//get datatables
	private function _get_datatables_query()
	{
		$this->db->select('*');
		$this->db->from($this->table);

		$i = 0;

        $arrSearch = array();
        $data_post = $this->input->post();

        #die;

        if(isset($data_post['search'])){

            $arrSearch = $_POST['search']['value'];
        }
     
        foreach ($this->column_search as $item) // looping awal
        {

            //if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            if(!empty($arrSearch))
            {
                 
                if($i===0) // looping awal
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }

	}

	public function get_datatables()
	{
		
		$this->_get_datatables_query();
        $start = (isset($_POST['start'])) ? $_POST['start'] : 0;
        $length = (isset($_POST['length'])) ? $_POST['length'] : 10;

        if($length != -1){

            $this->db->limit($length, $start);
            $query = $this->db->get();
        }else{

            $this->db->limit($start, $length);
            $query = $this->db->get();
        }
        
        $data = $query->result(); 
       /* echo $this->db->last_query();
        $this->pre($data);
        die;*/
        return $data;

	}

	public function count_all() //count_filtered
	{
		
		$this->_get_datatables_query();
		$query = $this->db->get()->result();
		return $query;

	}

	public function count_filtered() //count_all
	{
		$this->db->get($this->table);
		return $this->db->count_all_results();

	}


	function pre($var){
		echo '<pre>';
		print_r($var);
		echo '</pre>';
	}
	

}

/* End of file Mod_pasien.php */
/* Location: ./application/models/Mod_pasien.php */