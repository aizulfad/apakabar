<?php
function helper_updatelang($my_lang){
	$ci =& GET_INSTANCE();
	$ci->load->helper('file');
	$ci->db->where('lang',$my_lang);
	$query=$ci->db->get('translation');

	$lang=array();
	$langstr="<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
                /**
                *
                * Description:  ".$my_lang." language file for general views
                *
                */"."\n\n\n";



	foreach ($query->result() as $row){
		$text = str_replace("'", "\'", $row->token);
		$langstr.= "\$lang['".$row->description."'] = '$text';"."\n";
	}
	write_file('./application/language/'.$my_lang.'/information_lang.php', $langstr);

}
