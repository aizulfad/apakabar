<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kendaraan extends Controller {
	var $table = 'kendaraan';

	public function __construct(){
		parent::__construct();
		$this->load->model(['main_model']);
		$this->checkUsr();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{   

			$data['title']      = 'kendaraan';
			$data['content']    = 'main/kendaraan/index'; 
			$this->load->view('layouts/themes', $data);
	
	}

	public function get_kendaraan(){
		$get = $this->main_model->get_all($this->table);

		$result = [];
		$no		= 1;

		foreach($get as $g){
			$dataEdit = "$g->id_kendaraan,'$g->nama','$g->tipe',$g->stok,$g->harga";
			$checkbox = '<center><input id="cb-kendaraan-'.$no.'" style="width: 15px;height: 15px" type="checkbox" name="cb-kendaraan" value="'.$g->id_kendaraan.'" /></center>';
			$buttons = '<button type="button" name="edit" class="btn btn-danger btn-xs" onclick="btnKendaraanModal(\'Edit\',['.$dataEdit.'])">Edit</button>';

			$result[] = [
				$checkbox,
				$no,
				$g->nama,
				$g->tipe,
				$g->stok.' Unit',
				'Rp. '.number_format($g->harga),
				$g->created_date,
				$buttons
			];
			$no++;
		}

		echo json_encode($result);
	}

	public function add()
	{   

			$datakendaraan = [
				'nama' => $this->input->post('nama'), 
				'tipe' => $this->input->post('tipe'), 
				'stok' => $this->input->post('stok'), 
				'harga' => $this->input->post('harga'),
				'created_date' => date('Y-m-d H:i:s')
			];

			$this->main_model->insert($this->table,$datakendaraan);

			echo json_encode($datakendaraan);
	}

	public function edit()
	{   
		$data = [
      'nama' => $this->input->post('nama'), 
      'tipe' => $this->input->post('tipe'), 
      'stok' => $this->input->post('stok'), 
      'harga' => $this->input->post('harga'),
		];

		$id_kendaraan =  $this->input->post('idx');

		$this->main_model->edit($this->table, $data, 'id_kendaraan', $id_kendaraan);

		echo "success";
	}

	public function delete(){
		$data = $this->input->post('all');
		
		foreach($data as $id){
			$this->main_model->delete($this->table, ['id_kendaraan' => $id]);
		}
    
		echo "Success";
	}

	public function export(){
		$data = $this->main_model->get_all($this->table);
		$arr = array('title' => 'List kendaraan', 'kendaraan' => $data);
		$this->load->view('main/kendaraan/export', $arr);
	}
}
