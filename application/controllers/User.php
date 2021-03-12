<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Controller {
	var $table = 'user';

	public function __construct(){
		parent::__construct();
		$this->load->model(['main_model']);
		$this->checkUsr();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{   
			$data['title']      = 'user';
			$data['content']    = 'main/user/index'; 
			$this->load->view('layouts/themes', $data);
	}

	public function get_user(){
		$get = $this->main_model->get_all($this->table);

		$result = [];
		$no		= 1;

		foreach($get as $g){
			$password = $this->encryption->decrypt($g->password);
			$dataEdit = "$g->id_user,'$g->name','$g->email','$password','$g->phone_number','$g->tipe_user'";
			$checkbox = '<center><input id="cb-user-'.$no.'" style="width: 15px;height: 15px" type="checkbox" name="cb-user" value="'.$g->id_user.'" /></center>';
			$buttons = '<button type="button" name="edit" class="btn btn-danger btn-xs" onclick="btnUserModal(\'Edit\',['.$dataEdit.'])">Edit</button>';

			$result[] = [
				$checkbox,
				$no,
				$g->name,
				$g->email,
				$g->phone_number,
				$g->tipe_user,
				$g->created_date,
				$buttons
			];
			$no++;
		}

		echo json_encode($result);
	}

	public function add()
	{   

			$datauser = [
				'name' => $this->input->post('nama'), 
				'email' => $this->input->post('email'), 
				'password' => $this->encryption->encrypt($this->input->post('password')), 
				'phone_number' => $this->input->post('hp'), 
				'tipe_user' => $this->input->post('tipe_user'), 
				'created_date' => date('Y-m-d H:i:s')
			];

			$this->main_model->insert($this->table,$datauser);

			echo json_encode($datauser);
	}

	public function edit()
	{   
		$data = [
			'name' => $this->input->post('nama'), 
			'email' => $this->input->post('email'), 
			'password' => $this->encryption->encrypt($this->input->post('password')), 
			'phone_number' => $this->input->post('hp'), 
			'tipe_user' => $this->input->post('tipe_user'),
		];

		$id_user =  $this->input->post('idx');

		$this->main_model->edit($this->table, $data, 'id_user', $id_user);

		echo "success";
	}

	public function delete(){
		$data = $this->input->post('all');
		
		foreach($data as $id){
			$this->main_model->delete($this->table, ['id_user' => $id]);
		}
		
		echo "Success";
	}

	public function export(){
		$data = $this->main_model->get_all($this->table);
		$arr = array('title' => 'List User', 'user' => $data);
		$this->load->view('main/user/export', $arr);
	}
}
