<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index(){

		if($this->session->userdata('email')){
			redirect('user');
		}
		$this->form_validation->set_rules('email','Email','required|trim|valid_email');
		$this->form_validation->set_rules('password','Password','required|trim');
		if($this->form_validation->run() == false){

		$data['title'] = 'User Login';
		$this->load->view('templates/header',$data);
		$this->load->view('auth/login');
		$this->load->view('templates/footer');
	

	}else{
		//validasinya success
		$this->_login();
	}
}

	private function _login(){
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('users',['email' => $email])->row_array();

		if($user){
				//usernya ada
			if($user['is_active'] == 1){
				//cek pw
				if(password_verify($password, $user['password'])){
					$data = [
						'email' => $user['email'],
						'role_id' => $user['role_id']
					];
					$this->session->set_userdata($data);
					if($user['role_id'] == 1){
						redirect('admin');
					}else{
						redirect('user');
					}
					

				}else{
					$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
					Password salah!</div>');
				}
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
					Email ini belom diaktivasi!</div>');
			}
		}else{
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
					Email tidak ada di database!</div>');
		}
	}

	public function registration(){

		if($this->session->userdata('email')){
			redirect('user');
		}

		$this->form_validation->set_rules('name','Name','required|trim');
		$this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[users.email]',[
			'is_unique' => 'This email already registered!'
		]);
		$this->form_validation->set_rules('password1','Password','required|trim|min_length[3]|matches[password2]');
		$this->form_validation->set_rules('password2','Password','required|trim|matches[password1]');

		if($this->form_validation->run() == false){
		$data['title'] = 'User Login';
		$this->load->view('templates/header',$data);
		$this->load->view('auth/registration');
		$this->load->view('templates/footer');	
	
		}else{
				$email = $this->input->post('email',true);
				$data = [
					'name' => htmlspecialchars($this->input->post('name',true)),
					'email' =>  htmlspecialchars($email),
					'image' => 'default.jpg',
					'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
					'role_id' => 2,
					'is_active' => 0,
					'date_created' => time()
				];

				//siapkan token
				$token = base64_encode(random_bytes(32));
				$user_token = [
					'email' 	   => $email,
					'token' 	   => $token,
					'date_created' => time()
				];

				$this->db->insert('users',$data);
				$this->db->insert('user_token',$user_token);


				$this->_sendEmail($token,'verify');

				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
					Tolong aktivasi akun kamu!</div>');
				redirect('auth');
		}
	}

	private function _sendEmail($token,$verify){
		$config = [
			'protocol' 	=> 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'kyousuke.lol911@gmail.com',
			'smtp_pass' => 'Chelse@fc7',
			'smtp_port' => 465,
			'mailtype' 	=> 'html',
			'charset' 	=> 'utf-8',
			'newline' 	=> "\r\n"
		];
		$this->email->initialize($config);
		$this->load->library('email',$config);
		$this->email->from('kyousuke.lol911@gmail.com','kyousuke');
		$this->email->to($this->input->post('email'));
		

		if($type == 'verify'){
			$this->email->subject('Verifikasi Akun');
			$this->email->message('Klik link ini untuk verifikasi akun kamu : <a href="' . 
			base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) .'">
			Activate </a>');
		}else if($type == 'forgot'){
			$this->email->subject('Reset Password');
			$this->email->message('Klik link ini untuk reset password kamu : <a href="' . 
			base_url() . 'auth/resetpw?email=' . $this->input->post('email') . '&token=' . urlencode($token) .'">
			Reset Password</a>');
		}

		if ($this->email->send()){
			return true;
		}else{
			echo $this->email->print_debugger();
			die;
		}

		
	}

	public function verify(){
		//ambil inputtan url
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		//cek apakah data ada di database
		$user = $this->db->get_where('users',['email' => $email])->row_array();

		if($user){
			$user_token = $this->db->get_where('user_token',['token' => $token])->row_array();
			if($user_token){

				//kurang dari sehari token masih aktif
				if(time() - $user_token['date_created'] < (60*60*24)){
					$this->db->set('is_active',1);
					$this->db->where('email',$email);
					$this->db->update('users');

					$this->db->delete('user_token',['email' => $email]);
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
						'. $email .' telah berhasil aktivasi! Please login</div>');
				redirect('auth');
				}else{

					//lebih dari sehari
					$this->db->delete('users',['email' => $email]);
					$this->db->delete('user_token',['email' => $email]);
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
					Token kadaluarsa!</div>');
				redirect('auth');
				}
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
					Salah token!</div>');
				redirect('auth');
			}
		}else{
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
					Akun gagal diaktivasi!</div>');
				redirect('auth');
	
		}
	}

	public function logout(){
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
					Anda berhasil logout!</div>');
				redirect('auth');
	}

	public function block(){

		$data['title'] = '404';
		$this->load->view('templates/index_header',$data);
		$this->load->view('auth/block');
		$this->load->view('templates/index_footer');
	}

	public function forgotpassword(){
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		if($this->form_validation->run() == false){

		$data['title'] = 'Forgot Password';
		$this->load->view('templates/header',$data);
		$this->load->view('auth/forgotpw');
		$this->load->view('templates/footer');
		}else{
			$email = $this->input->post('email');
			$user = $this->db->get_where('users',['email' => $email,'is_active' => 1 ])->row_array();

			if($user){
				$token = base64_encode(random_bytes(32));
				$user_token = [
					'email' 	   => $email,
					'token' 	   => $token,
					'date_created' => time()
				];

				$this->db->insert('user_token',$user_token);
				$this->_sendEmail($token,'forgot');
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
					Tolong cek email untuk reset password anda!</div>');
				redirect('auth/forgotpassword');
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
					Email belom terdaftar atau belom aktivasi!</div>');
				redirect('auth/forgotpassword');
			}
		}
	}

	public function resetpw(){
			$email = $this->input->get('email');
			$token = $this->input->get('token');

			$user = $this->db->get_where('users',['email' => $email])->row_array();
		
			if($user){
				$user_token = $this->db->get_where('user_token',['token' => $token])->row_array();
				
				if($user_token){
					$this->session->set_userdata('reset_email',$email);
					$this->changepw();
				}else{
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
					Token salah!</div>');
				redirect('auth');
				}
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
					Email salah!</div>');
				redirect('auth');
			}
		}

	public function changepw(){

		$data['title'] = 'Change Password';
		$this->load->view('templates/header',$data);
		$this->load->view('auth/change-password');
		$this->load->view('templates/footer');
	}
}
