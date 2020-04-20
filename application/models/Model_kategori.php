<?php

class Model_kategori extends CI_Model{

	public function tampil_elektronik(){
		return $this->db->get_where("tb_barang",array('kategori' => 'elektronik'))->result_array();
	}

	public function tampil_pakaianpria(){
		return $this->db->get_where("tb_barang",array('kategori' => 'pakaian pria'))->result_array();
	}

	public function tampil_pakaianwanita(){
		return $this->db->get_where("tb_barang",array('kategori' => 'pakaian wanita'))->result_array();
	}

	public function tampil_pakaiananak(){
		return $this->db->get_where("tb_barang",array('kategori' => 'pakaian anak-anak'))->result_array();
	}

	public function tampil_alatolahraga(){
		return $this->db->get_where("tb_barang",array('kategori' => 'alat olahraga'))->result_array();
	}
}