<?php

class M_pemesanan extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get_pemesanan_list(){
		$this->db->select('*');
		$this->db->from('pemesanan');
		$this->db->join('user', 'user.id_user = pemesanan.id_user');
		$this->db->join('kendaraan', 'kendaraan.id_kendaraan = pemesanan.id_kendaraan');
		return $this->db->get()->result();
	}

	function get_pemesanan_list_where($field = NULL, $id = NULL){
		$this->db->select('*');
		$this->db->from('pemesanan');
		$this->db->join('user', 'user.id_user = pemesanan.id_user');
		$this->db->join('kendaraan', 'kendaraan.id_kendaraan = pemesanan.id_kendaraan');
		$this->db->get_where('pemesanan', [$field => $id]);
		return $this->db->get()->result();
	}

}
