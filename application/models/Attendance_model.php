<?php

class Attendance_model extends CI_Model
{
	public function mark_attendance()
	{
		$data = $_POST;

		$student_id = $this->input->post('student_id');
		$attendance_id = $this->input->post('attendance_id');

		$this->db->select('id');
		$this->db->where('period',$data['period']);
		$this->db->where('class_id',$data['class_id']);
		$query = $this->db->get('dq_attendance');

		if($query->num_rows()>0)
		{
			foreach($student_id as $key => $value)
			{
				$present = $data['duration']-($data['absent'][$key]+$data['casual_leave'][$key]+$data['sick_leave'][$key]);

				$attendance = [
					'id'			=> $attendance_id[$key],
					'period' 		=> $data['period'],
					'year' 			=> $this->ac_year,
					'class_id' 		=> $data['class_id'],
					'duration' 		=> $data['duration'],
					'present' 		=> $present,
					'absent' 		=> $data['absent'][$key],
					'casual_leave' 	=> $data['casual_leave'][$key],
					'sick_leave' 	=> $data['sick_leave'][$key]
				];
				$this->db->replace('dq_attendance', $attendance);
			}

			if ($this->db->affected_rows())
			{
				$this->session->set_flashdata('success_msg',' حاضری تبدیل ہو گئی ہے');
			}
			else
			{
				$this->session->set_flashdata('error_msg','حاضری تبدیل نہیں ہوئی');
			}
			redirect('Attendance');
		}
		else
		{
			foreach ($student_id as $key => $value)
			{
				$present = $data['duration']-($data['absent'][$key]+$data['casual_leave'][$key]+$data['sick_leave'][$key]);

				$attendance = [
					'period' 			=> $data['period'],
					'year' 				=> $this->ac_year,
					'class_id' 			=> $data['class_id'],
					'duration'			=> $data['duration'],
					'present' 			=> $present,
					'absent' 			=> $data['absent'][$key],
					'casual_leave' 		=> $data['casual_leave'][$key],
					'sick_leave' 		=> $data['sick_leave'][$key]
				];
				$query = $this->db->insert('dq_attendance', $attendance);
			}
			if ($query > 0)
			{
				$this->session->set_flashdata('success_msg', 'حاضری ہو گئی ہے');
			}
			else
			{
				$this->session->set_flashdata('error_msg', 'حاضری نہیں ہوئی');
			}
			redirect('Attendance');
		}
	}

	public function get_attendance()
	{
		$class_id = $this->input->post('class');
		$period = $this->input->post('period');

		$this->db->select('id,duration,absent,casual_leave,sick_leave');
		$this->db->where('class_id',$class_id);
		$this->db->where('period',$period);
		$this->db->where('year',$this->ac_year);

		return $this->db->get('dq_attendance')->result();
	}

	public function get_class_student($class_id)
	{
		$this->db->select('dq_enroll.student_id,dq_enroll.admission_number,
		dq_students.gr_number,dq_students.name,dq_students.father_name,dq_enroll.id enroll_id');
		$this->db->where('class_id',$class_id);
		$this->db->where('ac_year',$this->ac_year);
		$this->db->where('dq_enroll.active',1);
		$this->db->join('dq_students','dq_students.id=dq_enroll.student_id');
		$this->db->order_by('dq_students.gr_number');

		$query = $this->db->get('dq_enroll');
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			$this->session->set_flashdata('error_msg','اس کلاس میں کوئی طالب علم نہیں ہے');
			redirect('Attendance');
		}
	}
}
