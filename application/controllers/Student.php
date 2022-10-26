<?php

class Student extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Class_model');
		$this->load->model('Student_model');
		$this->load->model('Area_model');
	}

	public function index($inactive = null)
	{
		$data['total_students'] = $this->Student_model->get_total_student_current_ac_year();
		$data['students'] = $this->Student_model->get_student(null, $inactive);

		$this->load->view('layout/header');
		$this->load->view('layout/nav');
		$this->load->view('student/view_student', $data);
		$this->load->view('layout/footer');
	}

	/**
	 * Form for adding new student
	 *
	 * @return void
	 */
	public function add_student()
	{
		/**
		 * admission allowed in only active year
		 */
		if ($this->session->active == 0) {
			$this->session->set_flashdata('error_msg', 'صرف رواں سال میں داخلہ دیا جاسکتا ہے۔');
			redirect('Student');
		}

		$data['classes'] = $this->Class_model->get_class();
		$data['areas'] = $this->Area_model->get_areas();
		$data['gr_number'] = $this->Student_model->get_gr_number();

		$this->load->view('layout/header');
		$this->load->view('layout/nav');
		$this->load->view('student/add_student', $data);
		$this->load->view('layout/footer');
	}

	public function check_admission_number($admission_number)
	{
		$data = $this->Student_model->check_admission_number($admission_number);
		$admission_number = $data->admission_number ?? null;
		echo json_encode($admission_number);
	}

	public function save_student()
	{
		$this->Student_model->save_student();
	}

	public function edit_student($id)
	{
		$data['classes'] = $this->Class_model->get_class();
		$data['st'] = $this->Student_model->get_student($id);
		$data['areas'] = $this->Area_model->get_areas();

		$this->load->view('layout/header');
		$this->load->view('layout/nav');
		$this->load->view('student/edit_student', $data);
		$this->load->view('layout/footer');
	}

	public function update_student($student_id, $class_id = null)
	{
		$this->Student_model->update_student($student_id, $class_id);
	}

	public function delete_student($id)
	{
		$this->Student_model->delete_student($id);
	}

	/**
	 * search sutdnet by gr number
	 *
	 * @return void
	 */
	public function get_student_by_gr_number()
	{
		$student_id = $this->Student_model->get_student_id_by_gr_number($this->input->post('gr_number'));
		if ($student_id) {
			return $this->detail_student($student_id);
		} else {
			$this->session->set_flashdata('error_msg', 'ریکارڈ نہیں ملا');
			redirect('Dashboard');
		}
	}

	public function detail_student($student_id = null)
	{
		$data['option'] = $this->input->post('option');
		$data['detail'] = $this->input->post('detail');
		$data['class_id'] = $this->input->post('class');
		$data['classes'] = $this->Class_model->get_class();
		$data['areas'] = $this->Area_model->get_areas();

		$data['student_details'] = $this->Student_model->detail_student($student_id);

		$enroll_id = $data['student_details']->enroll_id ?? null;
		$data['complaints'] = $this->Student_model->get_complaint($enroll_id);

		$this->load->view('layout/header');
		$this->load->view('layout/nav');
		if (in_array($data['option'], ['name', 'father_name', 'father_cnic', 'area'])) {
			$data['search'] = $this->Student_model->detail_student();

			$this->load->view('search/search', $data);
		} else {
			$this->load->view('student/detail_student', $data);
		}

		$this->load->view('layout/footer');
	}

	public function update_profile($student_id)
	{
		$this->Student_model->update_profile($student_id);
	}

	public function save_student_complaint()
	{
		$this->Student_model->save_student_complaint();
	}

	public function update_student_complaint($complaint_id, $student_id)
	{
		$this->Student_model->update_student_complaint($complaint_id, $student_id);
	}

	public function delete_student_complaint($complaint_id, $student_id, $enroll_id)
	{
		$this->Student_model->delete_student_complaint($complaint_id, $student_id, $enroll_id);
	}

	public function get_gr_number()
	{
		return $this->Student_model->get_gr_number();
	}

}
