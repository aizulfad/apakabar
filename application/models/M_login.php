<?php
class M_login extends CI_Model
{
	public function check_device($user_id = NULL, $email = NULL, $device_type = NULL, $data_device = NULL){
		if($device_type != NULL && $data_device != NULL){
			return $this->db->get_where('log_device', ['user_id' => $user_id,'email' => $email,'device' => $device_type, 'data_device' => $data_device])->row();
		}
	}

	function put_token($param)
	{
		$sql        = $this->db->insert_string('token',$param);
		$ex         = $this->db->query($sql);
		return $this->db->affected_rows($sql);
	}

	public function isTokenValid($token){
		return $this->db->get_where('token',array('token'=>$token,'status'=>1))->row_array();
	}

	public function cek_token($token){
		return $this->db->get_where('token', ['token' => $token, 'status' => '1'])->row();
	}

	public function check_attempt($email){
		// $this->db->where();
		return $this->db->get_where('verifycode', ['email' => $email, 'verifycode !=' => 'OTPSMS'])->num_rows();
	}

	public function check_attempt_sms($email){
		// $this->db->where('verifycode', 'OTPSMS');
		return $this->db->get_where('verifycode', ['email' => $email, 'verifycode' => 'OTPSMS'])->num_rows();
	}

	public function check_attempt_forget($email){
		// $this->db->where('verifycode', 'OTPSMS');
		return $this->db->get_where('token', ['email' => $email])->num_rows();
	}

	public function get_all($id = NULL){
		$this->db->join('agent', 'agent.id_agent = user.agent_id');
		return $this->db->get_where('user', ['email' => $id])->row();
	}
}
