<?php

class Result extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Class_model');
		$this->load->model('Result_model');
		$this->load->model('Attendance_model');
	}

	public function index()
	{
		$data['classes'] = $this->Class_model->get_class();
		$data['teachers'] = $this->Result_model->get_teacher();

		$this->load->view('layout/header');
		$this->load->view('layout/nav');
		$this->load->view('result/result',$data);
		$this->load->view('layout/footer');
	}

	public function get_exam($class_id,$exam)
	{
		$data = $this->Result_model->get_exam($class_id,$exam);
		if ($data)
		{
			echo json_encode($data);
		}
		else
		{
			echo json_encode(['error'=>1]);
		}
	}

	public function save_exam($id=null)
	{
		$data['print'] = $this->input->post('print');
		$class_id = $this->input->post('class');
		$data['results'] = $this->Result_model->save_exam($id);
		$data['exam_id'] = $data['results'][0]->exam_id ?? null; //null used if "student" class will be change record will not be found
		$data['exam'] = $this->Result_model->get_exam_byid($data['exam_id']);
		$data['students'] = $this->Attendance_model->get_class_student($class_id);
		$percentage = array_column($data['results'],'marks_percentage','id');
		arsort($percentage);
		$filter_students = array_unique(array_filter($percentage, function($val) { return $val > 70;}));
		$data['student_position'] = $this->get_position_from_marks($filter_students);
		$data['classes'] = $this->Class_model->get_class();
		$data['teachers'] = $this->Result_model->get_teacher();

		if (!empty($data['print'])) {
			$this->load->view('result/result_print', $data);
		} else {
			$this->load->view('layout/header');
			$this->load->view('layout/nav');
			$this->load->view('result/result', $data);
			$this->load->view('layout/footer');
		}
	}

	public function save_result()
	{
		$this->Result_model->save_result();
	}

	public function get_position_from_marks($marks_array){
		$result_array 	= [];
		$positions 		= ['اول','دوم','سوم'];

		// use array values for re-index of array keys.
		foreach (array_values($marks_array) as $key => $value) {
			$result_array[$value] = $positions[$key];
		}
		
		return $result_array;
	}

}
