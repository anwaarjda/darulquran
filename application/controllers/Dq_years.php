<?php

class Dq_years extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Dq_year_model');
	}

	public function index()
	{
		$data['years'] = $this->Dq_year_model->get_year();

		$this->load->view('layout/header');
		$this->load->view('layout/nav');
		$this->load->view('dq_year/manage_year', $data);
		$this->load->view('layout/footer');
	}

	public function change_section($ac_year)
	{
		$year = $this->db->get_where('dq_years', ['ac_year' => $ac_year])->row();
		if ($year) {
			$session = [
				'ac_year' => $year->ac_year,
				'hijri_year' => $year->hijri_year,
				'active' => $year->status,
			];
			$this->session->set_userdata($session);
			echo true;
		} else {
			echo false;
		}
	}

	public function update_year($id, $status)
	{
		$this->Dq_year_model->update_year($id, $status);
	}
}
