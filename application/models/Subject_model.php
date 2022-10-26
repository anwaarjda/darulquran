<?php

class Subject_model extends CI_Model
{
	public function add_subject()
	{
		$name =	$this->input->post('name');
		$total_number =	$this->input->post('total_number');

		$this->db->select('id');
		$this->db->where('dq_subjects.name',$name);
		$this->db->where('active',1);
		$this->db->where('is_delete',0);
		$query = $this->db->get('dq_subjects');

		if($query->num_rows()>0)
		{
			$this->session->set_flashdata('duplicate_entry','مضمون پہلے سے موجود ہے');
		}
		else
		{
			$add_subject = [
				'name'			=>	$name,
				'total_number'	=>	$total_number,
				'created_by'	=>	$this->user_id,
				'created_on'	=>	$this->time
			];

			$query = $this->db->insert('dq_subjects',$add_subject);
			if ($query>0)
			{
				$this->session->set_flashdata('success_msg','مضمون بن گیا ہے');
			}
			else
			{
				$this->session->set_flashdata('error_msg','مضمون نہیں بنا');
			}
		}
		redirect('Subject/new_subject');
	}

	public function get_manage_subject()
	{
		$this->db->select('dq_managesubjects.id,dq_classes.id as class_id,
		dq_classes.class_no,dq_classes.class_name,dq_subjects.id as subject_id,dq_subjects.name,
		dq_subjects.active');

		$this->db->join('dq_classes','dq_classes.id=dq_managesubjects.class_id');
		$this->db->join('dq_subjects','dq_subjects.id=dq_managesubjects.subject_id');
		$this->db->where('dq_managesubjects.is_delete',0);
		$this->db->order_by('dq_classes.class_no','ASC');

		return $this->db->get('dq_managesubjects')->result();
	}

	public function update_subject($id)
	{
		$update_subject = [
			'name' 			=> $this->input->post('name'),
			'total_number'	=> $this->input->post('total_number'),
			'active' 		=> $this->input->post('active'),
			'updated_by' 	=> $this->user_id,
			'updated_on' 	=> $this->time
		];

		$this->db->where('id', $id);
		$this->db->update('dq_subjects', $update_subject);

		if ($this->db->affected_rows()>0)
		{
			$this->session->set_flashdata('success_msg', ' ترمیم ہو گئی');
		}
		else
		{
			$this->session->set_flashdata('error_msg', 'ترمیم نہیں ہوئی');
		}
		redirect('Subject/new_subject');
	}

	public function get_subject()
	{
		$this->db->select('id,name,total_number,active');
		$this->db->where('is_delete', 0);

		return $this->db->get('dq_subjects')->result();
	}

	public function delete_subject($id)
	{
		$this->db->set('is_delete',1);
		$this->db->set('deleted_on',$this->time);
		$this->db->set('deleted_by',$this->user_id);
		$this->db->where('id',$id);
		$this->db->update('dq_subjects');

		redirect('Subject/new_subject');
	}

	public function insert_manage_subject()
	{
		$class_id = $this->input->post('class_name');
		$subject_id = $this->input->post('subject');

		$this->db->select('id');
		$this->db->where('class_id',$class_id);
		$this->db->where('subject_id',$subject_id);
		$this->db->where('is_delete',0);
		$q = $this->db->get('dq_managesubjects');

		if($q->num_rows()>0 )
		{
			$this->session->set_flashdata('duplicate_entry','کلاس میں مضمون پہلے سے موجود ہے');
		}
		else
		{
			$assign_subject = [
				'class_id' 	 => $this->input->post('class_name'),
				'subject_id' => $this->input->post('subject'),
				'created_by' => $this->user_id,
				'created_on' => $this->time
			];

			$query = $this->db->insert('dq_managesubjects',$assign_subject);
			if ($query>0)
			{
				$this->session->set_flashdata('success_msg','ترتیب ہو گئی  ہے');
			}
		}
		redirect('Subject');
	}

	public function update_manage_subject($id)
	{
		$class_id = $this->input->post('class_name');
		$subject_id = $this->input->post('subject');

		$this->db->select('id');
		$this->db->where('class_id',$class_id);
		$this->db->where('subject_id',$subject_id);
		$this->db->where('is_delete',0);
		$q = $this->db->get('dq_managesubjects');

		if($q->num_rows()>0 )
		{
			$this->session->set_flashdata('duplicate_entry','مضمون پہلے سے موجود ہے');
		}
		else
		{
			$update_manage_subject = [
				'class_id' 	 => $this->input->post('class_name'),
				'subject_id' => $subject_id,
				'updated_by' => $this->user_id,
				'updated_on' => $this->time
			];

			$this->db->where('id',$id);
			$query = $this->db->update('dq_managesubjects',$update_manage_subject);
			if ($query>0)
			{
				$this->session->set_flashdata('success_msg','مضمون کی ترتیب ہو گئی ہے');
			}
		}
		redirect('Subject');
	}

	public function delete_manage_subject($id)
	{
		$this->db->set('is_delete',1);
		$this->db->set('deleted_on',$this->time);
		$this->db->set('deleted_by',$this->user_id);
		$this->db->where('id',$id);
		$this->db->update('dq_managesubjects');

		redirect('Subject');
	}
}
