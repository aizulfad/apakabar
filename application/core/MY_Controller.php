<?php

class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['main_model']);
	}
}

Class Controller extends MY_Controller
{
	public function checkUsr(){
		$this->load->helper('basic_helper');

		if($this->session->userdata('id_user') === null || $this->session->userdata('id_user') === ''){
			$this->session->set_flashdata('message', '<p class="alert alert-danger">Session Expired!</p>');
			redirect(base_url());
		}

	/* 	$encode_ip = get_ip_browser();
		$cekIp = $this->db->get_where('user', ['encode_ip' => $encode_ip])->row(); */

		/* if(!$cekIp){

			$user_session = array(
				'id_user',
				'name' ,
				'email',
				'level_id'
			);
			
			$this->session->unset_userdata($user_session);
			$this->session->set_flashdata('message', '<p class="alert alert-danger">Session Expired!</p>');
			redirect(base_url());
		} */
	}
}