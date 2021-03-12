<?php
function helper_log($STR = ""){
	$ci =& GET_INSTANCE();

	// PARAMTER
	$param['id_user']	= $ci->session->userdata('id_user');
	$param['log']      	= $STR;

	//LOAD MODEL LOG
	$ci->load->model('M_log');

	//SAVE TO DATABASE
	$ci->M_log->save_log($param);

}
