<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Controller {
	

	public function __construct(){
		parent::__construct();
		$this->checkUsr();
	}

	public function index()
	{   
		
		$data['title']      = 'Dashboard';
		$data['content']    = 'main/dashboard'; 
		$this->load->view('layouts/themes', $data);
	
	}

}
