<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {


	public function __construct(){
		parent::__construct();
		cek_login();
		$this->load->model('Model_barang','barang');
		$this->load->model('Model_invoice','invoice');
		$this->load->model('Model_kategori','kategori');

}
	public function index(){

		$data['title'] = 'My Profile';
		$data['user'] = $this->db->get_where('users',['email' =>
		$this->session->userdata('email')])->row_array();
		
		$this->load->view('templates/index_header',$data);
		$this->load->view('templates/index_sidebar',$data);
		$this->load->view('templates/index_topbar',$data);
		$this->load->view('user/index',$data);
		$this->load->view('templates/index_footer',$data);
	}

	public function edit(){
		$data['title'] = 'Edit Profile';
		$data['user'] = $this->db->get_where('users',['email' =>
		$this->session->userdata('email')])->row_array();
		$this->form_validation->set_rules('name','Full name','required|trim');
		if($this->form_validation->run() == false){


		$this->load->view('templates/index_header',$data);
		$this->load->view('templates/index_sidebar',$data);
		$this->load->view('templates/index_topbar',$data);
		$this->load->view('user/edit',$data);
		$this->load->view('templates/index_footer',$data);
		}else{
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			

			//cek jika ada gambar yg diupload
			$upload_img = $_FILES['image']['name'];

			if($upload_img){
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '2048';
				$config['upload_path'] = './assets/img/';

				$this->load->library('upload',$config);

				if($this->upload->do_upload('image')){
					$oldimg = $data['user']['image'];
						if($oldimg != 'default.jpg'){
							unlink(FCPATH . 'assets/img/' . $oldimg);
						}

					$newimg = $this->upload->data('file_name');
					$this->db->set('image',$newimg);
				}else{
					echo $this->upload->display_errors();
				}
			}


			$this->db->set('name',$name);
			$this->db->where('email',$email);
			$this->db->update('users');

			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
					Profle berhasil diupdate!</div>');
				redirect('user');
		}
	}

	public function changepassword(){

		$data['title'] = 'Change Password';
		$data['user'] = $this->db->get_where('users',['email' =>
		$this->session->userdata('email')])->row_array();
		
		$this->form_validation->set_rules('password_saat_ini','Password Saat Ini','required|trim');
		$this->form_validation->set_rules('password_baru1','Password Baru','required|trim|min_length[3]
			|matches[password_baru2]');
		$this->form_validation->set_rules('password_baru2','Ulangi Password','required|trim|min_length[3]
			|matches[password_baru1]');

		if($this->form_validation->run() == false){
		
		$this->load->view('templates/index_header',$data);
		$this->load->view('templates/index_sidebar',$data);
		$this->load->view('templates/index_topbar',$data);
		$this->load->view('user/changepassword',$data);
		$this->load->view('templates/index_footer',$data);
		}else{
			$password_saat_ini = $this->input->post('password_saat_ini');
			$password_baru = $this->input->post('password_baru1');
			if(!password_verify($password_saat_ini,$data['user']['password'])){
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
					Salah Password Lama!</div>');
				redirect('user/changepassword');
			}else{
				if($password_saat_ini == $password_baru){
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
						Password tidak boleh sama dengan password lama!</div>');
				redirect('user/changepassword');	
				}else{
					//password sudak ok
					$pw_hash = password_hash($password_baru, PASSWORD_DEFAULT);
					$this->db->set('password',$pw_hash);
					$this->db->where('email',$this->session->userdata('email'));
					$this->db->update('users');
					$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
						Ganti password berhasil!</div>');
				redirect('user/changepassword');	
				}
			}
		}
	}

	public function toko_online(){
		$data['title'] = 'Dashboard';
		$data['user'] = $this->db->get_where('users',['email' =>
		$this->session->userdata('email')])->row_array();

		$data['toko'] = $this->barang->tampil_data();
		
		$this->load->view('templates/index_header',$data);
		$this->load->view('templates/index_sidebar',$data);
		$this->load->view('templates/topbar_tokoonline',$data);
		$this->load->view('user/dashboard',$data);
		$this->load->view('templates/index_footer',$data);
	}

	public function tambah_keranjang($id){
    	$barang1 = $this->barang->find($id);

    	$data = array(
    				'id' => $barang1->id,
    				'qty' => 1,
    				'price' => $barang1->harga,
    				'name' => $barang1->nama

    	);
    	$this->cart->insert($data);
    	redirect('user/toko_online');
    }

    public function detail_keranjang(){
    	$data['title'] = 'Detail Keranjang';
		$data['user'] = $this->db->get_where('users',['email' =>
		$this->session->userdata('email')])->row_array();

		$data['toko'] = $this->barang->tampil_data();
		
		$this->load->view('templates/index_header',$data);
		$this->load->view('templates/index_sidebar',$data);
		$this->load->view('templates/topbar_tokoonline',$data);
		$this->load->view('user/keranjang',$data);
		$this->load->view('templates/index_footer',$data);


    }

    public function hapus_keranjang(){
    	$this->cart->destroy();
    	redirect('user/toko_online');
    }

    public function pembayaran_keranjang(){
    	$data['title'] = 'Pembayaran';
		$data['user'] = $this->db->get_where('users',['email' =>
		$this->session->userdata('email')])->row_array();

		// $this->form_validation->set_rules('name','Full name','required|trim');
		// $this->form_validation->set_rules('alamat','Alamat','required|trim');
		// $this->form_validation->set_rules('telepon','Telepon','required|trim');
		// $this->form_validation->set_rules('jaskir','Jasa Pengiriman','required|trim');
		// $this->form_validation->set_rules('bank','Bank','required|trim');
		// if($this->form_validation->run() == false){
		
		$this->load->view('templates/index_header',$data);
		$this->load->view('templates/index_sidebar',$data);
		$this->load->view('templates/topbar_tokoonline',$data);
		$this->load->view('user/pembayaran_keranjang',$data);
		$this->load->view('templates/index_footer',$data);
    }

    public function proses_pemesanan(){
    	$data['title'] = 'Pembayaran';
		$data['user'] = $this->db->get_where('users',['email' =>
		$this->session->userdata('email')])->row_array();

		$data['invoice'] = $this->invoice->index();
		if($data){
			$this->cart->destroy();
		$this->load->view('templates/index_header',$data);
		$this->load->view('templates/index_sidebar',$data);
		$this->load->view('templates/topbar_tokoonline',$data);
		$this->load->view('user/proses_pesanan',$data);
		$this->load->view('templates/index_footer',$data);
		}else{
			echo "Maaf,Pesanan Anda Gagal diproses!";
		}
		
    }

    public function detail_barang($id){
    	$data['title'] = 'Detail Barang';
		$data['user'] = $this->db->get_where('users',['email' =>
		$this->session->userdata('email')])->row_array();

		
		$data['barang'] = $this->barang->detail_brg($id);
		$this->load->view('templates/index_header',$data);
		$this->load->view('templates/index_sidebar',$data);
		$this->load->view('templates/topbar_tokoonline',$data);
		$this->load->view('user/detail_brg',$data);
		$this->load->view('templates/index_footer',$data);
    }

    public function elektronik(){
    	$data['title'] = 'Elektronik';
		$data['user'] = $this->db->get_where('users',['email' =>
		$this->session->userdata('email')])->row_array();

		$data['elektronik'] = $this->kategori->tampil_elektronik();
		$this->load->view('templates/index_header',$data);
		$this->load->view('templates/index_sidebar',$data);
		$this->load->view('templates/topbar_tokoonline',$data);
		$this->load->view('user/ktg_elektronik',$data);
		$this->load->view('templates/index_footer',$data);
    }

     public function pakaian_pria(){
    	$data['title'] = 'Pakaian Pria';
		$data['user'] = $this->db->get_where('users',['email' =>
		$this->session->userdata('email')])->row_array();

		$data['pria'] = $this->kategori->tampil_pakaianpria();
		$this->load->view('templates/index_header',$data);
		$this->load->view('templates/index_sidebar',$data);
		$this->load->view('templates/topbar_tokoonline',$data);
		$this->load->view('user/ktg_pakaianpria',$data);
		$this->load->view('templates/index_footer',$data);
    }

    public function pakaian_wanita(){
    	$data['title'] = 'Pakaian Wanita';
		$data['user'] = $this->db->get_where('users',['email' =>
		$this->session->userdata('email')])->row_array();

		$data['wanita'] = $this->kategori->tampil_pakaianwanita();
		$this->load->view('templates/index_header',$data);
		$this->load->view('templates/index_sidebar',$data);
		$this->load->view('templates/topbar_tokoonline',$data);
		$this->load->view('user/ktg_pakaianwanita',$data);
		$this->load->view('templates/index_footer',$data);
    }

    public function pakaian_anak(){
    	$data['title'] = 'Pakaian Anak';
		$data['user'] = $this->db->get_where('users',['email' =>
		$this->session->userdata('email')])->row_array();

		$data['anak'] = $this->kategori->tampil_pakaiananak();
		$this->load->view('templates/index_header',$data);
		$this->load->view('templates/index_sidebar',$data);
		$this->load->view('templates/topbar_tokoonline',$data);
		$this->load->view('user/ktg_pakaiananak',$data);
		$this->load->view('templates/index_footer',$data);
    }

    public function alat_olahraga(){
    	$data['title'] = 'Alat Olahraga';
		$data['user'] = $this->db->get_where('users',['email' =>
		$this->session->userdata('email')])->row_array();

		$data['alat'] = $this->kategori->tampil_alatolahraga();
		$this->load->view('templates/index_header',$data);
		$this->load->view('templates/index_sidebar',$data);
		$this->load->view('templates/topbar_tokoonline',$data);
		$this->load->view('user/ktg_alatolahraga',$data);
		$this->load->view('templates/index_footer',$data);
    }
}