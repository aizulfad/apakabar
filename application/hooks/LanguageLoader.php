<?php

class LanguageLoader

{

	function initialize() {
		$ci =& get_instance();

		$ci->load->helper('language');

        if($ci->session->userdata('lang')){
            $siteLang = $ci->session->userdata('lang');
            $ci->lang->load('information',$siteLang);
        }
        else {

			$ci->lang->load('information','id');

		}

	}

}
