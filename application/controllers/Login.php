<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(['main_model', 'm_login']);
		date_default_timezone_set('Asia/Jakarta');
	}

	function user_login(){
		if(isset($_SESSION['user_id'])){
			redirect(base_url('dashboard'));
		}
		
		$email 			= $this->input->post('email');
		$password 		= $this->input->post('password');

		if($email !== '' || $password !== ''){
			
			if($email == ''){
				echo json_encode(['status' => 10009, 'message' => $this->lang->line('email_mandatory')]); die;

			}

			$user = $this->main_model->get_all('user', 'email', $email);
						
			if($user) {
				if($password == $this->encryption->decrypt($user->password)) {
								$data = [
									'id_user' 		=> $user->id_user,
									'name' 			=> $user->name,
									'email' 		=> $user->email,
									'tipe_user' 		=> $user->tipe_user
								];
	
								$this->session->set_userdata($data);
								$this->session->set_tempdata('email', $email, 900);
								$this->session->set_tempdata('password', $password, 900);
	
	
								echo json_encode(['status' => 10000, 'email' => $user->email]); // device registered

				} else {
					echo json_encode(['status' => 20000, 'message' => 'Password salah']); // account not actived
				} 
			} else {
				echo json_encode(['status' => 20004, 'message' => 'Email tidk terdaftar']); // Email not registered
			}
		}else{
			echo json_encode(['status' => 20005, 'message' => 'email dan password wajib diisi']); // required
		}

	}


	public function logout(){
		
		$user_session = array(
			'id_user',
			'name' ,
			'email',
			'level_id'
		);
		
		$this->session->unset_userdata($user_session);
		redirect(base_url());
	}
}
