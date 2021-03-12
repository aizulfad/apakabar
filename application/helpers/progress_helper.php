<?php
function progressMenu(){
	$ci =& GET_INSTANCE();
	$ci->load->model('M_client');
	$ci->load->model('M_progressClient');
	$id_detail = $ci->M_client->get_client($ci->session->userdata['id_user']);
	$data = max($ci->M_progressClient->get_progressClient($id_detail['id_detail_client']));
	return $data['id_progress_name'];
}
