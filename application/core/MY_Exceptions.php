<?php
class MY_Exceptions extends CI_Exceptions {

	function __construct()
	{
		parent::__construct();
	}

	function log_exception($severity, $message, $filepath, $line)

	{
		if (ENVIRONMENT === 'production') {
			$ci =& get_instance();
			$ci->load->library('email');

			$config['protocol'] = "smtp";
			$config['smtp_host'] = "hwsmtp.qiye.163.com";
			$config['smtp_port'] = "25";
			$config['smtp_user'] = "no-reply@jet.co.id";
			$config['smtp_pass'] = "ITman1188";
			$config['charset'] = "utf-8";
			$config['mailtype'] = "html";

			$ci->email->initialize($config);


			$ci->email->from('no-reply@jet.co.id', 'no-reply@jet.co.id');
			$ci->email->to('bug-feedback@jet.co.id');
//			$ci->email->cc('budihmesa@gmail.com');
//			$ci->email->bcc('them@their-example.com');
			$ci->email->subject('error');
			$ci->email->message('Severity: '.$severity.'  --> '.$message. ' '.$filepath.' '.$line);
			$ci->email->send();

			$webhook = "https://oapi.dingtalk.com/robot/send?access_token=61cb851d0984beda63046209ae1d2a42ee29e6f2cd49585ddabd075aaa7f5823";
			$message='J&T => FAQ - Severity: '.$severity.'  --> '.$message. ' '.$filepath.' '.$line;
			$data = array ('msgtype' => 'text','text' => array ('content' => $message));
			$data_string = json_encode($data);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $webhook);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array ('Content-Type: application/json;charset=utf-8'));
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_exec($ch);
		}


		parent::log_exception($severity, $message, $filepath, $line);
	}

}
