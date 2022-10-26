<?php


class Sch_years extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

	}
	public function change_section($year)
	{
		$session = array('ac_year' => $year);
		$this->session->set_userdata($session);
		echo true;
	}
}
