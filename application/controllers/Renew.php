<?php

class Renew extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Renew_admission_model');
		$this->load->model('Class_model');
	}

	public function index()
	{
		$data['classes'] = $this->Class_model->get_class();

		$this->load->view('layout/header');
		$this->load->view('layout/nav');
		$this->load->view('student/renew_admission',$data);
		$this->load->view('layout/footer');
	}

	public function get_student_by_admission_number()
	{
		$data['old_student'] = $this->Renew_admission_model->get_student_by_admission_number();
		$data['classes'] = $this->Class_model->get_class();

		$this->load->view('layout/header');
		$this->load->view('layout/nav');
		$this->load->view('student/renew_admission',$data);
		$this->load->view('layout/footer');
	}

	public function renew_admission($student_id)
	{
		$this->Renew_admission_model->renew_admission($student_id);
	}


}
