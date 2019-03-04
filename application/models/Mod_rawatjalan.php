<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_rawatjalan extends CI_Model {

	var $table = 'rawat_jalan';


	var $column_order = array(null, 'no_dftr', 'no_rm', 'id_jenis_bayar' , 'no_asuransi', 'id_penanggung', 'id_kelas', 'id_poli', 'id_dokter');
	var $column_search = array('no_dftr', 'no_rm', 'id_jenis_bayar' , 'no_asuransi', 'id_penanggung', 'id_kelas', 'id_poli', 'id_dokter');
	var $order = array('no_dftr' => 'desc');

	public function insert($data)
	{
		return $this->db->insert($this->table, $data);
	}

	//get datatables
	private function _get_datatables_query()
	{
		$this->db->select('rawat_jalan.*, dokter.dokternama as namadokter, poli.poli as namapoli, kelas.kelas as namakelas ');
		$this->db->from('rawat_jalan,pasien,poli,dokter,kelas');
		$this->db->where('rawat_jalan.no_rm = pasien.no_rm and poli.id = rawat_jalan.id_poli and dokter.id = rawat_jalan.id_dokter and kelas.id = rawat_jalan.id_kelas');

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

}

/* End of file Mod_rawatjalan.php */
/* Location: ./application/models/Mod_rawatjalan.php */