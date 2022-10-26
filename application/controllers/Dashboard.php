<?php

class Dashboard extends MY_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('Student_model');
			$this->load->model('Teacher_model');
			$this->load->model('Class_model');
		}

		public function index()
		{
			$data['active_students'] 	= $this->Student_model->count_students(1);
			$data['inactive_students'] 	= $this->Student_model->count_students(0);
			$data['total_students'] 	= $this->Student_model->get_total_student_current_ac_year();
			$data['total_classes'] 		= $this->Class_model->count_classes();
			$data['active_classes'] 	= $this->Class_model->status_classes(1);
			$data['inactive_classes'] 	= $this->Class_model->status_classes(0);
			$data['total_teachers'] 	= $this->Teacher_model->get_total_teacher();

			$this->load->view('layout/header');
			$this->load->view('layout/nav');
			$this->load->view('layout/content',$data);
			$this->load->view('layout/footer');
		}
	}
?>
