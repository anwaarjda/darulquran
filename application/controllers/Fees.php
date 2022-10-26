<?php

class Fees extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Fees_model');
		$this->load->model('Class_model');
	}

	public function index()
	{
		$data['annual_fees'] = $this->Fees_model->get_annual_fees()->amount??null;
		$data['student'] = $this->Fees_model->get_student_by_gr_number();

		$this->load->view('layout/header');
		$this->load->view('layout/nav');
		$this->load->view('fees/receive_fees',$data);
		$this->load->view('layout/footer');
	}

	public function receive()
	{
		$this->Fees_model->receive();
	}

	public function annual_fees()
	{
		$data['annual_fees'] = $this->Fees_model->get_annual_fees();

		$this->load->view('layout/header');
		$this->load->view('layout/nav');
		$this->load->view('fees/annual_fees',$data);
		$this->load->view('layout/footer');
	}

	public function generate_annual_fees()
	{
		$this->Fees_model->generate_annual_fees();
	}

	public function update_annual_fees($id)
	{
		$this->Fees_model->update_annual_fees($id);
	}

	public function print_fees_voucher($fees_id)
	{
		$data['students'] = $this->Fees_model->print_fees_voucher($fees_id);

		$this->load->view('fees/print_fees_voucher',$data);
	}

	public function fees_list()
	{
		$this->load->model('Class_model');
		$data['classes'] = $this->Class_model->get_class();

		$this->load->view('layout/header');
		$this->load->view('layout/nav');
		$this->load->view('fees/fees_list',$data);
		$this->load->view('layout/footer');
	}

	public function get_fees_list($paid,$class_id)
	{
		$this->load->model('Class_model');
		$data['classes'] = $this->Class_model->get_class();
		$data['fees_lists'] = $this->Fees_model->get_fees_list($paid,$class_id);
		$data['annual_fees'] = $this->Fees_model->get_annual_fees()->amount??null;

		$data['paid_unpaid'] = $paid;
		$data['class_id'] = $class_id;

		$this->load->view('layout/header');
		$this->load->view('layout/nav');
		$this->load->view('fees/fees_list',$data);
		$this->load->view('layout/footer');
	}
}
