<?php

class Classes extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Class_model');
		$this->load->model('Student_model');
	}

	public function classes($status=null)
	{
		$data['class_lists'] 	= $this->Class_model->classes($status);
		$data['total_classes'] 	= $this->Class_model->count_classes();

		$this->load->view('layout/header');
		$this->load->view('layout/nav');
		$this->load->view('class/classes',$data);
		$this->load->view('layout/footer');
	}

	public function get_students_by_class($class_id)
	{
		$data['students_by_class'] = $this->Class_model->get_students_by_class($class_id);
		$data['count_students_by_class'] = $this->Class_model->count_students_by_class($class_id);

		$this->load->view('layout/header');
		$this->load->view('layout/nav');
		$this->load->view('class/students_by_class',$data);
		$this->load->view('layout/footer');
	}

	public function add_class()
	{
		$this->Class_model->add_class();
	}

	public function update_class($id)
	{
		$this->Class_model->update_class($id);
	}

	public function delete_class($id)
	{
		$this->Class_model->delete_class($id);
	}

	public function status_list($status)
	{
		$data['class_lists'] = $this->Class_model->status_list($status);

		$this->load->view('layout/header');
		$this->load->view('layout/nav');
		$this->load->view('class/classes',$data);
		$this->load->view('layout/footer');
	}
}
