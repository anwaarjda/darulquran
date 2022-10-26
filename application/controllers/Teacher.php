<?php

class Teacher extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Teacher_model');
	}

	public function index()
	{
		$limit_per_page = 12;
		$start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$total_records = $this->Teacher_model->get_total_teacher();

		$data['teachers'] = $this->Teacher_model->get_teacher(null, $limit_per_page, $start_index);

		$config['base_url'] = base_url('Teacher/index/');
		$config['total_rows'] = $total_records;
		$config['per_page'] = $limit_per_page;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<a style="cursor:default" class="page-link bg-dark text-white">';
		$config['cur_tag_close'] = '</a>';
		$config['attributes'] = array('class' => 'page-link');
		$config['next_link'] = 'اگلا صفحہ';
		$config['prev_link'] = 'پچھلا صفحہ';

		$this->pagination->initialize($config);

		// build paging links
		$data["links"] = $this->pagination->create_links();

		$this->load->view('layout/header');
		$this->load->view('layout/nav');
		$this->load->view('teachers/view_teacher', $data);
		$this->load->view('layout/footer');
	}

	public function add_teacher()
	{
		$this->load->view('layout/header');
		$this->load->view('layout/nav');
		$this->load->view('teachers/add_teacher');
		$this->load->view('layout/footer');
	}

	public function edit_teacher($id)
	{
		$data['teachers'] = $this->Teacher_model->get_teacher($id, null, null);

		$this->load->view('layout/header');
		$this->load->view('layout/nav');
		$this->load->view('teachers/edit_teacher', $data);
		$this->load->view('layout/footer');
	}

	public function save_teacher()
	{
		$this->Teacher_model->save_teacher();
	}

	public function update_teacher($id)
	{
		$this->Teacher_model->update_teacher($id);
	}

	public function delete_teacher($id)
	{
		$this->Teacher_model->delete_teacher($id);
	}

	public function detail_teacher($id)
	{
		$data['teacher_details'] = $this->Teacher_model->detail_teacher($id);

		$this->load->view('layout/header');
		$this->load->view('layout/nav');
		$this->load->view('teachers/detail_teacher', $data);
		$this->load->view('layout/footer');
	}

	public function update_profile($id)
	{
		$this->Teacher_model->update_profile($id);
	}
}
