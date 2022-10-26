<?php

class Date extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get_hijri_date($date)
	{
		$this->load->library('hijri');
		echo json_encode($this->hijri->hijri(['date'=>$date]));
	}
}
