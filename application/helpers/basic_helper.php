<?php 
function is_admin()
{
	$ci = get_instance();
	if($ci->session->userdata('role_id') != 1) {
		redirect('administrador/user');
	}
}

function is_user()
{
	$ci = get_instance();
	if($ci->session->userdata('role_id') != 3) {
		redirect('administrador/user');
	}
}

function is_auth()
{
	$ci = get_instance();
	if(!$ci->session->userdata('email')) {
		redirect('administrador');
	}
}

function check_access($role_id, $menu_id) 
{
	$ci = get_instance();

	$ci->db->where('role_id', $role_id);
	$ci->db->where('menu_id', $menu_id);
	$result = $ci->db->get('user_access_menu');

	if($result->num_rows() > 0) :
		return 'checked="checked"';
	endif;
}

function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Jan',
		'Feb',
		'Mar',
		'Apr',
		'Mei',
		'Jun',
		'Jul',
		'Agt',
		'Sep',
		'Okt',
		'Nov',
		'Des'
	);
	$pecahkan = explode('-', $tanggal);
 
	return substr($pecahkan[2], 0, 2) . ' ' . $bulan[(int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

function bulan_indo($tanggal){
	$ci = get_instance();

	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
 
	return $ci->lang->line($bulan[(int)$pecahkan[1] ]) . ' ' . $pecahkan[0];
}

function datetime_custom($tanggal){
	$date 	= substr($tanggal, 8, 2);
	$month 	= substr($tanggal, 5, 2);
	$year 	= substr($tanggal, 0, 4);
	$time 	= substr($tanggal, 11, 8);

	return $date.'/'.$month.'/'.$year.' '.$time;
}

function get_ip_browser() {
	$arr_browsers = ["Opera", "Edg", "Chrome", "Safari", "Firefox", "MSIE", "Trident"];
 
	$agent = $_SERVER['HTTP_USER_AGENT'];
	 
	$user_browser = '';
	foreach ($arr_browsers as $browser) {
	    if (strpos($agent, $browser) !== false) {
	        $user_browser = $browser;
	        break;
	    }   
	}
	  
	switch ($user_browser) {
	    case 'MSIE':
	        $user_browser = 'Internet Explorer';
	        break;
	  
	    case 'Trident':
	        $user_browser = 'Internet Explorer';
	        break;
	  
	    case 'Edg':
	        $user_browser = 'Microsoft Edge';
	        break;
	}

	return md5($user_browser.getHostByName(getHostName()));
}


?>