<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesanan extends Controller {
	var $table = 'pemesanan';

	public function __construct(){
		parent::__construct();
		$this->load->model(['main_model', 'M_pemesanan']);
		$this->checkUsr();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{   

			$data['title']      = 'pemesanan';
      $data['user']		= $this->main_model->get_all('user');
      $data['kendaraan']		= $this->main_model->get_all('kendaraan');
			$data['content']    = 'main/pemesanan/index'; 
			$this->load->view('layouts/themes', $data);
	
	}

	public function get_pemesanan(){  

		if($this->session->userdata('tipe_data') == 'employee'){
			$get = $this->M_pemesanan->get_pemesanan_list_where('id_user', $this->session->userdata('id_user'));
		} else {
			$get = $this->M_pemesanan->get_pemesanan_list();
		}

		$result = [];
		$no		= 1;

		foreach($get as $g){
			$dataEdit = "$g->id_pemesanan,$g->id_user,$g->id_kendaraan,$g->jumlah,$g->durasi_pemakaian,$g->status";
			$checkbox = '<center><input id="cb-pemesanan-'.$no.'" style="width: 15px;height: 15px" type="checkbox" name="cb-pemesanan" value="'.$g->id_pemesanan.'" /></center>';

      if($g->status == 1){
				$status = '<h6><span class="badge badge-success">Approve</span></h6>';
			}else{
				$status = '<h6><span class="badge badge-warning">Waiting...</span></h6>';
			}

      $total = $g->harga * $g->jumlah * $g->durasi_pemakaian;

			$buttons = '<button type="button" name="edit" class="btn btn-danger btn-xs" onclick="btnPemesananModal(\'Edit\',['.$dataEdit.'])">Edit</button>';

			$result[] = [
				$checkbox,
				$g->id_pemesanan,
				$g->name,
				$g->nama,
				'Rp. '.number_format($g->harga),
				$g->jumlah. ' Unit',
				$g->durasi_pemakaian.' Hari',
				'Rp. '.number_format($total),
				$status,
				$buttons
			];
			$no++;
		}

		echo json_encode($result);
	}

	public function add()
	{   
      $id_kendaraan = $this->input->post('kendaraan');
      $jumlah = $this->input->post('jumlah');
      $durasi = $this->input->post('durasi');
      $kendaraan = $this->main_model->get_all('kendaraan', 'id_kendaraan', $id_kendaraan);

			$datapemesanan = [
        'id_user' => $this->input->post('user'),
        'id_kendaraan' => $id_kendaraan,
				'jumlah' => $jumlah, 
				'durasi_pemakaian' => $durasi, 
				'status' => $this->input->post('status'), 
				'total_pembayaran' => $kendaraan->harga * $jumlah * $durasi,
				'tanggal_pemesanan' => date('Y-m-d H:i:s')
			];

			$this->main_model->insert($this->table,$datapemesanan);

      $pemesanan = $this->main_model->get_all_desc($this->table, 'id_pemesanan');

			echo $pemesanan->id_pemesanan;
			//echo json_encode($datapemesanan);
	}

	public function edit()
	{   

    $id_kendaraan = $this->input->post('kendaraan');
    $jumlah = $this->input->post('jumlah');
    $durasi = $this->input->post('durasi');
    $kendaraan = $this->main_model->get_all('kendaraan', 'id_kendaraan', $id_kendaraan);
		$data = [
      'id_user' => $this->input->post('user'),
        'id_kendaraan' => $id_kendaraan,
				'jumlah' => $jumlah, 
				'durasi_pemakaian' => $durasi, 
				'status' => $this->input->post('status'), 
				'total_pembayaran' => $kendaraan->harga * $jumlah * $durasi
		];

		$id_pemesanan =  $this->input->post('idx');

		$this->main_model->edit($this->table, $data, 'id_pemesanan', $id_pemesanan);

		echo "success";
	}

	public function delete(){
		$data = $this->input->post('all');
		
		foreach($data as $id){
			$this->main_model->delete($this->table, ['id_pemesanan' => $id]);
		}
    
		echo "Success";
	}

	public function export(){
		$data = $this->M_pemesanan->get_pemesanan_list($this->table);
		$arr = array('title' => 'List Pemesanan', 'pemesanan' => $data);
		$this->load->view('main/pemesanan/export', $arr);
	}
}
