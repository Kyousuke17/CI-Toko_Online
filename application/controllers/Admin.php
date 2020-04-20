<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {


	public function __construct(){
		parent::__construct();
		cek_login();
		$this->load->model('Model_barang','barang');
		$this->load->model('Model_invoice','invoice');

	}

	public function index(){

		$data['title'] = 'Dashboard Admin';
		$data['user'] = $this->db->get_where('users',['email' =>
		$this->session->userdata('email')])->row_array();
		
		$this->load->view('templates/index_header',$data);
		$this->load->view('templates/index_sidebar',$data);
		$this->load->view('templates/index_topbar',$data);
		$this->load->view('admin/index',$data);
		$this->load->view('templates/index_footer',$data);
	}

	public function role(){

		$data['title'] = 'Role';
		$data['user'] = $this->db->get_where('users',['email' =>
		$this->session->userdata('email')])->row_array();

		$data['role'] = $this->db->get('users_role')->result_array(); 
		
		$this->load->view('templates/index_header',$data);
		$this->load->view('templates/index_sidebar',$data);
		$this->load->view('templates/index_topbar',$data);
		$this->load->view('admin/role',$data);
		$this->load->view('templates/index_footer');
	}

	public function roleaccess($role_id){


		$data['title'] = 'Role Access';
		$data['user'] = $this->db->get_where('users',['email' =>
		$this->session->userdata('email')])->row_array();

		$data['role'] = $this->db->get_where('users_role',['id' => $role_id])->row_array(); 

		$this->db->where('id != 1');
		$data['menu'] = $this->db->get('user_menu')->result_array();
		
		$this->load->view('templates/index_header',$data);
		$this->load->view('templates/index_sidebar',$data);
		$this->load->view('templates/index_topbar',$data);
		$this->load->view('admin/role-access',$data);
		$this->load->view('templates/index_footer');
	}

	public function role_ubah($id){

		$data['title'] = 'Ubah Data Role';
		$data['user'] = $this->db->get_where('users',['email' =>
		$this->session->userdata('email')])->row_array();

		$data['role'] = $this->db->get_where('users_role',['id' => $id])->row_array(); 
		$this->form_validation->set_rules('role','Role','required');
		
		if($this->form_validation->run() == false){
		$this->load->view('templates/index_header',$data);
		$this->load->view('templates/index_sidebar',$data);
		$this->load->view('templates/index_topbar',$data);
		$this->load->view('admin/ubah_role',$data);
		$this->load->view('templates/index_footer');

		
		}else{
			
			$id   = $this->input->post('id');
			$role = $this->input->post('role');
			
			$data = [
					'role' => $role,
					'id'   => $id
			];

			$this->db->where('id',$id);
			$this->db->update('users_role',$data);
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
			Data Berhasil diubah!</div>');
			redirect('admin/role');
	}
		
	}

	  public function hapus($id){
        
        $this->db->where('id',$id);
        $this->db->delete('users_role');
        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
			Data Berhasil dihapus!</div>');
        redirect('admin/role');
    }


    public function changeaccess(){
    	$menu_id = $this->input->post('menuId');
    	$role_id = $this->input->post('roleId');

    	$data = [
    		'role_id' => $role_id,
    		'menu_id' => $menu_id
    	];

    	$result = $this->db->get_where('user_access_menu',$data);

    	if($result->num_rows() < 1){
    		$this->db->insert('user_access_menu',$data);
    	}else{
    		$this->db->delete('user_access_menu',$data);
    	}
    	$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
					Data berhasil diubah!</div>');
    }

    public function data_barang(){
    	$data['title'] = 'Data Barang';
		$data['user'] = $this->db->get_where('users',['email' =>
		$this->session->userdata('email')])->row_array();
		
		$data['barang'] = $this->barang->tampil_data_barang();
		$data['kategori'] = ['Elektronik','Pakaian Pria','Pakaian Wanita','Pakaian Anak-anak','Pakaian Olahraga'];

		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('keterangan','Keterangan','required');
		$this->form_validation->set_rules('kategori','Kategori','required');
		$this->form_validation->set_rules('harga','Harga','required');
		$this->form_validation->set_rules('stock','Stock','required');
		$this->form_validation->set_rules('gambar','Gambar','required');

		if($this->form_validation->run() == false){

		$this->load->view('templates/index_header',$data);
		$this->load->view('templates/index_sidebar',$data);
		$this->load->view('templates/index_topbar',$data);
		$this->load->view('admin/databarang',$data);
		$this->load->view('templates/index_footer',$data);
    }else{
    	
				$nama 		= $this->input->post('nama');
				$keterangan = $this->input->post('keterangan');
				$kategori 	= $this->input->post('kategori');
				$harga 		= $this->input->post('harga');
				$stock 		= $this->input->post('stock');

				//cek jika ada gambar yg diupload
				$upload_gambar = $_FILES['gambar']['name'];

				if($upload_gambar=''){}else{
					$config['allowed_types'] = 'gif|jpg|png';	
					$config['upload_path'] = './assets/img/';

					$this->load->library('upload',$config);
					if(!$this->upload->do_upload('gambar')){
						echo "Gambar gagal";
					}else{
						$newimg = $this->upload->data("file_name");
						
					}
				}


				$data = [
							'nama' 		  => $nama,
							'keterangan'  => $keterangan,
							'kategori' 	  => $kategori,
							'harga' 	  => $harga,
							'stock' 	  => $stock,
							'gambar' 	  => $upload_gambar
					];
		
		$this->barang->getDataBaru($data,'tb_barang');
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
			Data Berhasil ditambahkan!</div>');
			redirect('admin/data_barang');
    	}
	}

	public function edit_databarang($id){
		$data['title'] = 'Edit Data Barang';
		$data['user'] = $this->db->get_where('users',['email' =>
		$this->session->userdata('email')])->row_array();
		
		$data['brg'] = $this->barang->getId($id);
		$data['brg2'] = ['Elektronik','Pakaian Pria','Pakaian Wanita','Pakaian Anak-anak','Pakaian Olahraga'];

		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('keterangan','Keterangan','required');
		$this->form_validation->set_rules('kategori','Kategori','required');
		$this->form_validation->set_rules('harga','Harga','required');
		$this->form_validation->set_rules('stock','Stock','required');
		$this->form_validation->set_rules('gambar','Gambar','required');
		

		if($this->form_validation->run() == false){

		$this->load->view('templates/index_header',$data);
		$this->load->view('templates/index_sidebar',$data);
		$this->load->view('templates/index_topbar',$data);
		$this->load->view('admin/edit_barang',$data);
		$this->load->view('templates/index_footer',$data);
    }else{

    	$id 			= $this->input->post('id');
    	$nama 			= $this->input->post('nama');
    	$keterangan 	= $this->input->post('keterangan');
    	$kategori 		= $this->input->post('kategori');
    	$harga 			= $this->input->post('harga');
    	$stock 			= $this->input->post('stock');

    	$data = [
    						
							'nama' 		  => $nama,
							'keterangan'  => $keterangan,
							'kategori' 	  => $kategori,
							'harga' 	  => $harga,
							'stock' 	  => $stock
							
				];

		$where = [
					'id'		  => $id
		];
		
		$this->db->where($where);
		$this->db->update('tb_barang',$data);
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
			Data Berhasil diubah!</div>');
			redirect('admin/edit_barang');
    }
}

public function hapus_databarang($id){
        
        $this->db->where('id',$id);
        $this->db->delete('tb_barang');
        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
			Data Berhasil dihapus!</div>');
        redirect('admin/data_barang');
    }

public function invoice(){
		$data['title'] = 'Invoice Pemesanan Produk';
		$data['user'] = $this->db->get_where('users',['email' =>
		$this->session->userdata('email')])->row_array();

		$data['invoice'] = $this->invoice->tampil_data();
		$this->load->view('templates/index_header',$data);
		$this->load->view('templates/index_sidebar',$data);
		$this->load->view('templates/index_topbar',$data);
		$this->load->view('admin/invoice_dashboard',$data);
		$this->load->view('templates/index_footer',$data);
}    

public function invoice_detail($id_invoice){
		$data['title'] = 'Invoice Detail Produk';
		$data['user'] = $this->db->get_where('users',['email' =>
		$this->session->userdata('email')])->row_array();

		$data['invoice'] = $this->invoice->detail($id_invoice);
		$data['pesanan'] = $this->invoice->getIdPesanan($id_invoice);
		$this->load->view('templates/index_header',$data);
		$this->load->view('templates/index_sidebar',$data);
		$this->load->view('templates/index_topbar',$data);
		$this->load->view('admin/detail',$data);
		$this->load->view('templates/index_footer',$data);
}
}