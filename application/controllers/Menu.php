<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

	public function __construct(){
		parent::__construct();
		cek_login();
		$this->load->model('Menu_model','menu');
		
	}

    public function index(){

		$data['title'] = 'Menu Management';
		$data['user'] = $this->db->get_where('users',['email' =>
		$this->session->userdata('email')])->row_array();
		
		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('menu','Menu','required');

		if($this->form_validation->run() == false){

		$this->load->view('templates/index_header',$data);
		$this->load->view('templates/index_sidebar',$data);
		$this->load->view('templates/index_topbar',$data);
		$this->load->view('menu/index',$data);
		$this->load->view('templates/index_footer');
		} else {

			$this->db->insert('user_menu',['menu' => $this->input->post('menu')]);
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
			Menu Berhasil ditambahkan!</div>');
			redirect('menu');
		}
	}

	public function submenu(){

		$data['title'] = 'Submenu Management';
		$data['user'] = $this->db->get_where('users',['email' =>
		$this->session->userdata('email')])->row_array();
		
		
		$data['SubMenu'] = $this->menu->getSubMenu();
		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('title','Title','required');
		$this->form_validation->set_rules('menu_id','Menu','required');
		$this->form_validation->set_rules('url','Url','required');
		$this->form_validation->set_rules('icon','Icon','required');
		
		if($this->form_validation->run() == false){

		$this->load->view('templates/index_header',$data);
		$this->load->view('templates/index_sidebar',$data);
		$this->load->view('templates/index_topbar',$data);
		$this->load->view('menu/submenu',$data);
		$this->load->view('templates/index_footer');
	}else{

		$data = [
				'title' => $this->input->post('title'),
				'menu_id' => $this->input->post('menu_id'),
				'field_url' => $this->input->post('url'),
				'icon' => $this->input->post('icon'),
				'is_active' => $this->input->post('is_active')
		];
		$this->db->insert('user_sub_menu',$data);
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
			Menu Berhasil ditambahkan!</div>');
			redirect('menu/submenu');
	}
}

		public function hapus($id){
	        
	        $this->db->where('id',$id);
	        $this->db->delete('user_menu');    
	        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
				Data Berhasil dihapus!</div>');
	        redirect('menu');
	    }
		public function hapus_submenu($id){
	        
	        $this->db->where('id',$id);
	        $this->db->delete('user_sub_menu');    
	        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
				Data Berhasil dihapus!</div>');
	        redirect('menu/submenu');
	    }
	public function ubah($id){
		$data['title'] = 'Menu Management';
		$data['user'] = $this->db->get_where('users',['email' =>
		$this->session->userdata('email')])->row_array();
		
		$data['menu'] = $this->db->get_where('user_menu',['id' => $id])->row_array();

		$this->form_validation->set_rules('menu','Menu','required');

		if($this->form_validation->run() == false){

		$this->load->view('templates/index_header',$data);
		$this->load->view('templates/index_sidebar',$data);
		$this->load->view('templates/index_topbar',$data);
		$this->load->view('menu/ubah_menu',$data);
		$this->load->view('templates/index_footer');
		} else {

			$id   = $this->input->post('id');
			$menu = $this->input->post('menu');
			$data = [
					'menu' => $menu,
					'id'   => $id
			];

			$this->db->where('id',$id);
			$this->db->update('user_menu',$data);
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
			Data Berhasil diubah!</div>');
			redirect('menu/index');
		}
	}
}