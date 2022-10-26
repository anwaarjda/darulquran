<?php

class Result_model extends CI_Model
{
	public function get_exam($class_id,$exam)
	{
		$this->db->select('id,date,date_hijri,teacher,duration,time');
		$this->db->where('exam',$exam);
		$this->db->where('class_id',$class_id);
		$this->db->where('ac_year',$this->ac_year);

		return $this->db->get('dq_exams')->row();
	}

	public function get_exam_byid($id)
	{
		$this->db->select('dq_exams.*,dq_classes.class_name,dq_classes.darja');

		$this->db->join('dq_classes','dq_classes.id=dq_exams.class_id');
		$this->db->where('dq_exams.id',$id);

		return $this->db->get('dq_exams')->row();
	}

	public function get_teacher()
	{
		$this->db->select('name');
		$this->db->where('is_delete',0);

		return $this->db->get('dq_teachers')->result();
	}

	public function get_students_by_class($class_id)
	{
		$this->db->where('class_id',$class_id);
		$this->db->where('ac_year',$this->ac_year);
		$this->db->where('is_delete',0);

		return $this->db->get('dq_enroll')->num_rows();
	}

	public function save_exam($id)
	{
		$class_id = $this->input->post('class');
		$exam_no = $this->input->post('exam');
		$print = $this->input->post('print');

		$count = $this->get_students_by_class($class_id);

		if ($count<1)
		{
			$this->session->set_flashdata('error_msg','اس کلاس میں کوئی طالب علم نہیں ہے');
			redirect('Result');
		}

		$this->db->where('class_id',$class_id);
		$this->db->where('exam',$exam_no);
		$this->db->where('ac_year',$this->ac_year);
		$q = $this->db->get('dq_exams');

		if($q->num_rows()>0)
		{
			$add_exam = [
				'id' => $id,
				'ac_year' => $this->ac_year,
				'class_id' => $class_id,
				'exam' => $this->input->post('exam'),
				'teacher' => $this->input->post('teacher'),
				'date' => $this->input->post('date'),
				'date_hijri' => $this->input->post('date_hijri'),
				'duration' => $this->input->post('duration'),
				'time' => $this->input->post('time'),
				'overall_educational_quality' => $q->row()->overall_educational_quality,
				'remarks' => $q->row()->remarks,
				'principal_remarks' => $q->row()->principal_remarks,
				'created_by' => $this->user_id,
				'created_on' => $this->time
			];

			$query = $this->db->replace('dq_exams',$add_exam);

			if ($query>0)
			{
				if(empty($print))
				{
					$this->session->set_flashdata('success_msg','امتحان کا ریکارڈ بن گیا ہے ');
				}
			}
			else
			{
				$this->session->set_flashdata('error_msg','ریکارڈ نہیں بنا');
			}

			$this->db->select('dq_results.id,dq_results.ac_year,dq_results.exam_id,
			dq_results.student_id,dq_results.sabiqa_miqdar,dq_results.mojuda_miqdar,
			dq_results.izafi_miqdar,dq_results.quran,dq_results.namaz_miqdar,dq_results.namaz,
			dq_results.kayfiat,dq_results.gain,dq_results.total,dq_results.grade,
			dq_results.attendance,dq_enroll.class_id,dq_results.only_namaz,
			CAST((( if(`dq_results`.`only_namaz`=1,`dq_results`.`namaz`,`dq_results`.`quran`) / 100)*100) AS SIGNED) marks_percentage');

			$this->db->join('dq_enroll','dq_results.enroll_id=dq_enroll.id');
			$this->db->where('dq_results.exam_id', $id);
			$this->db->where('dq_enroll.active', 1);
			$this->db->where('dq_results.ac_year', $this->ac_year);

			return $this->db->get('dq_results')->result();
		}
		else
		{
			$add_exam = array(
				'ac_year'		=>	$this->ac_year,
				'class_id'		=> 	$class_id,
				'exam'			=> 	$this->input->post('exam'),
				'teacher'		=> 	$this->input->post('teacher'),
				'date'			=> 	$this->input->post('date'),
				'date_hijri'	=> 	$this->input->post('date_hijri'),
				'duration'		=> 	$this->input->post('duration'),
				'time'			=> 	$this->input->post('time'),
				'created_by'	=>	$this->user_id,
				'created_on'	=>	$this->time
			);

			$query = $this->db->insert('dq_exams',$add_exam);
			$exam_id = $this->db->insert_id();

			if ($query>0)
			{
				$this->session->set_flashdata('success_msg','ریکارڈ بن گیا ہے');

				$this->db->select('student_id');
				$this->db->where('class_id',$class_id);
				$this->db->where('ac_year',$this->ac_year);
				$q = $this->db->get('dq_enroll');

				foreach ($q->result() as $key => $row)
				{
					$student_ids =  $row->student_id;

					$add_result = array(
						'ac_year' 		=> $this->ac_year,
						'exam_id' 		=> $exam_id,
						'student_id' 	=> $student_ids,
						'created_by' 	=> $this->user_id,
						'created_on' 	=> $this->time,
					);

					$query = $this->db->insert('dq_results', $add_result);
				}

				if ($query>0)
				{
					$this->session->set_flashdata('success_msg', 'امتحان کا ریکارڈ بن گیا ہے ');
				}
				else
				{
					$this->session->set_flashdata('error_msg', 'ریکارڈ نہیں بنا');
				}

				$this->db->select('dq_results.id,dq_results.ac_year,dq_results.exam_id,dq_results.student_id,
				dq_results.sabiqa_miqdar,dq_results.mojuda_miqdar,dq_results.izafi_miqdar,dq_results.quran,
				dq_results.namaz_miqdar,dq_results.namaz,dq_results.kayfiat,dq_results.gain,dq_results.total,
				dq_results.grade,dq_results.attendance,dq_enroll.class_id,dq_enroll.class_id');
				$this->db->join('dq_enroll','dq_results.student_id=dq_enroll.student_id');
				$this->db->where('dq_results.exam_id',$exam_id);
				$this->db->where('dq_results.ac_year',$this->ac_year);

				return $this->db->get('dq_results')->result();
			}
			else
			{
				$this->session->set_flashdata('error_msg','ریکارڈ نہیں بنا');
			}
			redirect('Result');
		}
	}

	public function save_result()
	{
		$data = $_POST;
		$exam_id 					 = $this->input->post('exam_id');
		$result_id 					 = $this->input->post('result_id');
		$student_id 				 = $this->input->post('student_id');
		$overall_educational_quality = $this->input->post('overall_educational_quality');
		$remarks 					 = $this->input->post('remarks');
		$principal_remarks 			 = $this->input->post('principal_remarks');

		$this->db->where('exam_id', $exam_id);
		$this->db->where_in('student_id', $student_id);
		$this->db->delete('dq_results');

		foreach ($result_id as $key => $value) {

			$gain = ($data['only_namaz'][$key] == 1) ? $data['namaz'][$key] : $data['quran'][$key];
			$percentage = ((int) $gain / 100) * 100;
			if ($percentage >= 85) {
				$grade = 'ممتاز';
			} elseif ($percentage >= 70) {
				$grade = 'جیدجداً';
			} elseif ($percentage >= 55) {
				$grade = 'جید';
			} elseif ($percentage >= 40) {
				$grade = 'مقبول';
			} elseif ($percentage < 40) {
				$grade = 'راسب';
			}

			$st_id 			= $data['student_id'][$key];
			$result_data[] 	= array(
				'ac_year' 		=> $this->ac_year,
				'exam_id' 		=> $exam_id,
				'student_id' 	=> $st_id,
				'enroll_id' 	=> $data['enroll_id'][$key],
				'sabiqa_miqdar' => $data['sabiqa_miqdar'][$key],
				'mojuda_miqdar' => $data['mojuda_miqdar'][$key],
				'izafi_miqdar' 	=> $data['izafi_miqdar'][$key],
				'quran' 		=> $data['quran'][$key],
				'namaz_miqdar' 	=> $data['namaz_miqdar'][$key],
				'namaz' 		=> $data['namaz'][$key],
				'kayfiat' 		=> $data['kayfiat'][$key],
				'gain' 			=> $gain,
				'total' 		=> 100,
				'grade' 		=> $grade,
				'attendance' 	=> $data["attendance_$st_id"] ?? 'ح',
				'created_by' 	=> $this->user_id,
				'created_on' 	=> $this->time,
				'only_namaz' 	=> $data['only_namaz'][$key]
			);
		}
		
		$this->db->where('ac_year', $this->ac_year);
		$this->db->where('exam_id', $exam_id);
		$this->db->insert_batch('dq_results', $result_data);

		if ($this->db->affected_rows()) {
			$this->session->set_flashdata('success_msg', 'نتیجہ محفوظ ہوگیا ہے');

			$ins_remarks = [
				'overall_educational_quality' => $overall_educational_quality,
				'remarks' => $remarks,
				'principal_remarks' => $principal_remarks
			];

			$this->db->where('id', $exam_id);
			$this->db->update('dq_exams', $ins_remarks);
		} else {
			$this->session->set_flashdata('error_msg', 'متبادل رزلٹ نہیں بنا');
		}

		redirect('Result');
	}

	public function count_grade($exam_id,$grade)
	{
		$this->db->select('count(grade) as total,grade');
		$this->db->where('ac_year',$this->ac_year);
		$this->db->where('exam_id',$exam_id);
		$this->db->where('grade',$grade);
		$this->db->where('attendance','ح');
		$this->db->group_by('grade');

		return $this->db->get('dq_results')->row();
	}

	public function count_attendance($exam_id,$attendance)
	{
		$this->db->select('count(attendance) as total,attendance');
		$this->db->where('ac_year',$this->ac_year);
		$this->db->where('exam_id',$exam_id);
		$this->db->where('attendance',$attendance);
		$this->db->group_by('attendance');

		return $this->db->get('dq_results')->row();
	}

	public function get_students_by_exam($exam_id)
	{
		$this->db->select('count(student_id) as total');
		$this->db->where('ac_year',$this->ac_year);
		$this->db->where('exam_id',$exam_id);

		return $this->db->get('dq_results')->row();
	}
}
