<?php

class Search extends MY_Controller
{
	public function index($option=null,$detail=null)
	{
		$this->load->model('Class_model');
		$this->load->model('Student_model');
		$this->load->model('Area_model');

		$data['option'] = $option;
		$data['detail'] = urldecode($detail);

		$data['classes'] = $this->Class_model->get_class();
		$data['students'] = $this->Student_model->get_student();
		$data['areas'] = $this->Area_model->get_areas();

		$this->load->view('layout/header');
		$this->load->view('layout/nav');
		$this->load->view('search/search',$data);
		$this->load->view('layout/footer');
	}
}
