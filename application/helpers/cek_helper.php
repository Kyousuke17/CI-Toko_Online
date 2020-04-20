<?php

function cek_login(){

	$wow = get_instance();
	if(!$wow->session->userdata('email')){
		redirect('auth');
	}else{
		$role_id = $wow->session->userdata('role_id');
		$menu = $wow->uri->segment(1);

		$query = $wow->db->get_where('user_menu',['menu' => $menu])->row_array();
		$menu_id = $query['id'];	

		$useraccess = $wow->db->get_where('user_access_menu',
			[

			'role_id' => $role_id,
			'menu_id' => $menu_id
		]);

		if($useraccess->num_rows()< 1){
			redirect('auth/block');
		}
	}

	function check_access($role_id,$menu_id){
		$wow = get_instance();
		
		$wow->db->where('role_id',$role_id);
		$wow->db->where('menu_id',$menu_id);
		$result = $wow->db->get('user_access_menu');

		if($result->num_rows() > 0){
			return "checked='checked'";
		}
	}
	
}