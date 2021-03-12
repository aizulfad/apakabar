<?php

class Main_model extends CI_Model
{
	public function get_all($tbl = NULL, $field = NULL, $id = NULL){
		if($field == NULL || $id == NULL){
			return $this->db->get($tbl)->result();
		}else{
			return $this->db->get_where($tbl, [$field => $id])->row();
		}
	}

	public function insert($tbl = NULL, $data = array()){
		$this->db->insert($tbl, $data);
	}

	public function edit($tbl = NULL, $data = array(), $field = NULL, $pk = NULL){
		$this->db->update($tbl, $data, [$field => $pk]);
	}

	public function delete($tbl = NULL, $where = array()){
		$this->db->delete($tbl, $where);
	}

	public function get_all_desc($tbl = NULL, $order_by){
		$this->db->order_by($order_by, 'DESC');
		return $this->db->get($tbl)->row();
	}

}
