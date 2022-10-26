<?php

class Subject extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Subject_model');
	}

	public function index()
	{
		$this->load->model('Class_model');

		$data['classes'] = $this->Class_model->get_class();
		$data['manage_subjects'] = $this->Subject_model->get_manage_subject();
		$data['subjects'] = $this->Subject_model->get_subject();

		$this->load->view('layout/header');
		$this->load->view('layout/nav');
		$this->load->view('subject/manage_subject',$data);
		$this->load->view('layout/footer');
	}

	public function new_subject()
	{
		$this->load->model('Class_model');

		$data['classes'] = $this->Class_model->get_class();
		$data['subjects'] = $this->Subject_model->get_subject();

		$this->load->view('layout/header');
		$this->load->view('layout/nav');
		$this->load->view('subject/new_subject',$data);
		$this->load->view('layout/footer');
	}

	public function add_subject()
	{
		$this->Subject_model->add_subject();
	}

	public function update_subject($id)
	{
		$this->Subject_model->update_subject($id);
	}

	public function delete_subject($id)
	{
		$this->Subject_model->delete_subject($id);
	}

	public function manage_subject()
	{
		$this->Subject_model->insert_manage_subject();
	}

	public function update_manage_subject($id)
	{
	 	$this->Subject_model->update_manage_subject($id);
	}

	public function delete_manage_subject($id)
	{
	 	$this->Subject_model->delete_manage_subject($id);
	}
}
