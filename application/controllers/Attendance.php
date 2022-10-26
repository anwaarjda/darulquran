<?php

class Attendance extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Attendance_model');
		$this->load->model('Class_model');
		$this->load->model('Result_model');
	}

	public function index()
	{
		$data['classes'] = $this->Class_model->get_class();

		$this->load->view('layout/header');
		$this->load->view('layout/nav');
		$this->load->view('attendance/attendance',$data);
		$this->load->view('layout/footer');
	}

	public function get_student()
	{
		$data['class_id'] = $this->input->post('class');
		$data['period_no'] = $this->input->post('period');

		$data['attendance'] = $this->Attendance_model->get_attendance();
		$data['students'] = $this->Attendance_model->get_class_student($data['class_id']);
		$data['classes'] = $this->Class_model->get_class();

		$this->load->view('layout/header');
		$this->load->view('layout/nav');
		$this->load->view('attendance/attendance',$data);
		$this->load->view('layout/footer');
	}

	public function mark_attendance()
	{
		$this->Attendance_model->mark_attendance();
	}
}
