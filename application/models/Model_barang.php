<?php 

class Model_barang extends CI_Model{
	public function tampil_data(){
		return $this->db->get('tb_barang')->result_array();
	}

	public function tampil_data_barang(){
		$query = "SELECT * FROM `tb_barang`";

				  return $this->db->query($query)->result_array();
	}

	public function getDataBaru($data,$table){
		$this->db->insert($table,$data);
	}

	public function getId($id){
		return $this->db->get_where('tb_barang',['id' => $id])->row_array();
	}

	public function find($id){
		$result = $this->db->where('id',$id)
							->limit(1)
							->get('tb_barang');
		if($result->num_rows() > 0){
			return $result->row();
		}else{
			return array();
		}

	}

	public function detail_brg($id){
		$result= $this->db->get_where('tb_barang',['id' => $id]);
		if($result->num_rows() > 0){
			return $result->result();
		}else{
			return false;
		}

	}
}