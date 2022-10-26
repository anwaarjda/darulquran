<?php

class Area extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Area_model');
	}

	public function index()
	{
		$data['areas'] = $this->Area_model->get_areas();

		$this->load->view('layout/header');
		$this->load->view('layout/nav');
		$this->load->view('area/index',$data);
		$this->load->view('layout/footer');
	}

	public function save()
	{
		$this->Area_model->save_area();
	}

	public function update($id)
	{
		$this->Area_model->update($id);
	}
}
