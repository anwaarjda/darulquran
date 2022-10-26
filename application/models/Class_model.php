<?php

class Class_model extends CI_Model
{
	public function add_class()
	{
		$class_no = $this->input->post('class_no');

		$this->db->select('class_no');
		$this->db->where('class_no',$class_no);
		$this->db->where('active',1);
		$this->db->where('is_delete',0);
		$q = $this->db->get('dq_classes');

		if($q->num_rows()>0)
		{
			$this->session->set_flashdata('duplicate_entry','کلاس پہلے سے موجود ہے');
		}
		else
		{
			$rec = [
				'class_no'		=>	$class_no,
				'class_name'	=>	$this->input->post('class_name'),
				'darja'			=>	$this->input->post('darja'),
				'created_by'	=>	$this->user_id,
				'created_on'	=>	$this->time
			];

			$query = $this->db->insert('dq_classes',$rec);
			if ($query>0)
			{
				$this->session->set_flashdata('success_msg','کلاس بن گئی ہے');
			}
			else
			{
				$this->session->set_flashdata('error_msg','کلا س نہیں بنی');
			}
		}
		redirect('Classes/classes');
	}

	public function get_class()
	{
		$this->db->select('id,class_name');
		$this->db->where('is_delete',0);
		$this->db->order_by('class_no');

		return $this->db->get('dq_classes')->result();
	}

	public function update_class($id)
	{
		$class_no = $this->input->post('class_no');

		$this->db->select('class_no,active');
		$this->db->where('id',$id);
		$this->db->where('is_delete',0);
		$q = $this->db->get('dq_classes')->row();

		if($q->class_no != $class_no )
		{
			$this->db->select('class_no');
			$this->db->where('class_no',$class_no);
			$this->db->where('active',1);
			$this->db->where('is_delete',0);
			$q = $this->db->get('dq_classes');

			if($q->num_rows()>0)
			{
				$this->session->set_flashdata('duplicate_entry','کلاس پہلے سے موجود ہے');
			}
			else
			{
				$update_class = [
					'class_no' 		=> $class_no,
					'class_name' 	=> $this->input->post('class_name'),
					'darja' 		=> $this->input->post('darja'),
					'active' 		=> $this->input->post('active'),
					'updated_by' 	=> $this->user_id,
					'updated_on' 	=> $this->time
				];
				$this->db->where('id', $id);
				$this->db->update('dq_classes', $update_class);

				if ($this->db->affected_rows()>0)
				{
					$this->session->set_flashdata('success_msg', ' ترمیم ہو گئی');
				}
				else
				{
					$this->session->set_flashdata('error_msg', 'ترمیم نہیں ہوئی');
				}
			}
		}
		else
		{
			$this->db->where('id !=',$id);
			$this->db->where('class_no',$class_no);
			$this->db->where('active',1);
			$this->db->where('is_delete',0);
			$q = $this->db->get('dq_classes');

			if($q->num_rows()>0)
			{
				$this->session->set_flashdata('duplicate_entry',' فعال کلاس موجود ہے');
			}
			else
			{
				$update_class = [
					'class_no' 		=> $class_no,
					'class_name' 	=> $this->input->post('class_name'),
					'darja' 		=> $this->input->post('darja'),
					'active' 		=> $this->input->post('active'),
					'updated_by' 	=> $this->user_id,
					'updated_on' 	=> $this->time
				];
				$this->db->where('id', $id);
				$this->db->update('dq_classes', $update_class);

				if ($this->db->affected_rows()>0)
				{
					$this->session->set_flashdata('success_msg', ' ترمیم ہو گئی');
				}
				else
				{
					$this->session->set_flashdata('error_msg', 'ترمیم نہیں ہوئی');
				}
			}
		}
		redirect('Classes/classes');
	}

	public function delete_class($id)
	{
		$this->db->select('dq_enroll.student_id');
		$this->db->where('ac_year',$this->ac_year);
		$this->db->where('class_id',$id);
		$student = $this->db->get('dq_enroll');

		if($student->num_rows()>0)
		{
			$this->session->set_flashdata('error_msg', 'کلاس میں طالب علم موجود ہے');
		}
		else
		{
			$this->db->set('is_delete', 1);
			$this->db->set('deleted_on', $this->time);
			$this->db->set('deleted_by', $this->user_id);
			$this->db->where('id',$id);
			$this->db->update('dq_classes');

			if ($this->db->affected_rows()>0)
			{
				$this->session->set_flashdata('success_msg', ' کلاس حذف ہو گئی');
			}
			else
			{
				$this->session->set_flashdata('error_msg', 'کلاس حذف نہیں ہوئی');
			}
		}
		redirect('Classes/classes');
	}

	public function classes($status=null)
	{
		if (!empty($status))	// For Dashboard
		{
			if ($status == 'inactive')
			{
				$status = 0;
			}
			$this->db->where('dq_enroll.active',$status);
		}
		$this->db->select('dq_classes.id,dq_classes.class_no,dq_classes.class_name,
		dq_classes.active,dq_classes.darja');

		$this->db->where('dq_classes.is_delete',0);
		$this->db->join('dq_enroll','dq_enroll.class_id=dq_classes.id','left');
		$this->db->order_by('dq_classes.class_no');
		$this->db->group_by('dq_classes.id');

		return $this->db->get('dq_classes')->result();
	}

	public function get_students_by_class($class_id)
	{
		$this->db->select('dq_classes.id,dq_classes.class_no,dq_classes.class_name,
		dq_classes.darja,dq_classes.active,dq_enroll.student_id,dq_enroll.admission_number,
		dq_enroll.admission_type,dq_enroll.old_admission_number,dq_enroll.class_id,
		dq_enroll.active as active_students,dq_enroll.ac_year,dq_enroll.date,dq_students.gr_number, 
		dq_students.name,dq_students.address, dq_students.father_name,dq_students.resident,dq_students.dob,
		dq_students.father_name,dq_students.father_cnic,dq_students.birthplace,dq_guardians.guardian_phone');

		$this->db->join('dq_classes','dq_enroll.class_id=dq_classes.id','left');
		$this->db->join('dq_students','dq_students.id=dq_enroll.student_id','left');
		$this->db->join('dq_guardians','dq_guardians.student_id=dq_enroll.student_id','left');
		$this->db->where('dq_classes.is_delete', 0);
		$this->db->where('dq_students.is_delete', 0);
		$this->db->where('dq_enroll.ac_year',$this->ac_year);
		$this->db->where('dq_enroll.class_id',$class_id);
		$this->db->order_by('dq_students.gr_number');

		return $this->db->get('dq_enroll')->result();
	}

	public function count_students_by_class($class_id)
	{
		$this->db->select('count(dq_enroll.class_id) as students');

		$this->db->where('dq_enroll.class_id',$class_id);
		$this->db->where('dq_enroll.ac_year',$this->ac_year);
		$this->db->where('dq_enroll.is_delete', 0);

		return $this->db->get('dq_enroll')->row();
	}

	public function status_list($status)
	{
		$this->db->select('dq_classes.id,dq_classes.class_no,dq_classes.darja,
		dq_classes.class_name,dq_classes.active,count(dq_enroll.class_id) as students');

		$this->db->join('dq_enroll','dq_enroll.class_id=dq_classes.id','left');
		$this->db->where('dq_classes.active', $status);
		$this->db->where('dq_classes.is_delete', 0);
		$this->db->group_by('dq_classes.id');

		return $this->db->get('dq_classes')->result();
	}

	public function status_classes($status)
	{
		$this->db->select('id');
		$this->db->where('active',$status);
		$this->db->where('is_delete', 0);

		return $this->db->get('dq_classes')->num_rows();
	}

	public function count_classes()
	{
		return $this->db->get_where('dq_classes',['is_delete'=>0])->num_rows();
	}

	public function get_class_by_id($id)
	{
		return $this->db->get_where('dq_classes', ['id' => $id])->row();
	}
}
