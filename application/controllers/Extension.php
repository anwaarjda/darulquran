<?php
class Extension extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$error_msg = null;
		$curl_handle = curl_init();
		curl_setopt($curl_handle, CURLOPT_URL, 'http://rasidaat.jdu.pk/api/extensions');
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 5);

		$buffer = curl_exec($curl_handle);
		if (curl_errno($curl_handle)) {
			$error_msg = curl_error($curl_handle);
		}
		curl_close($curl_handle);
		if(!empty($error_msg))
		{
			die($error_msg);
		}
		$data['extension'] = json_decode($buffer);
		$this->load->view("layout/header");
		$this->load->view("layout/nav");
		$this->load->view("extension/index",$data);
		$this->load->view("layout/footer");
	}
}
