<?php

class Teacher_model extends CI_Model
{
	public function save_teacher()
	{
		if(!empty($_FILES['teacher_picture']['name']))
		{
			$config['upload_path'] = 'assets/images/teacher_pictures/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['file_name'] = rand(0,999).'-'.time();

			//Load upload library and initialize configuration
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if($this->upload->do_upload('teacher_picture'))
			{
				$uploadData = $this->upload->data();
				$picture = $uploadData['file_name'];
			}
		}

		$add_teacher = [
			'name'				=>	$this->input->post('name'),
			'fathername'		=>	$this->input->post('fathername'),
			'gender'			=>	$this->input->post('gender'),
			'email'				=>	$this->input->post('email'),
			'mobile'			=>	$this->input->post('mobile'),
			'cnic'				=>	$this->input->post('cnic'),
			'address'			=>	$this->input->post('address'),
			'qoumiat'			=>	$this->input->post('qoumiat'),
			'elaqa'				=>	$this->input->post('elaqa'),
			'appointment_date'	=>	$this->input->post('appointment_date'),
			'dob'				=>	$this->input->post('dob'),
			'married'			=>	$this->input->post('married'),
			'no_of_child'		=>	$this->input->post('no_of_child'),
			'picture'			=>	$picture,
			'created_by'		=>	$this->user_id,
			'created_on'		=>	$this->time
		];

		$query = $this->db->insert('dq_teachers',$add_teacher);
		if ($query>0)
		{
			$this->session->set_flashdata('success_msg','نام درج ہو گیا');
		}
		else
		{
			$this->session->set_flashdata('error_msg','نام درج نہیں ہوا');
		}
		redirect('Teacher');
	}

	public function get_total_teacher()
	{
		return $this->db->get_where('dq_teachers',['is_delete'=>0])->num_rows();
	}

	public function get_teacher($id=null,$limit, $start)
	{
		if(!empty($id))
		{
			$this->db->where('dq_teachers.id',$id);
		}
		$this->db->limit($limit, $start);
		$this->db->order_by('name','ASC');
		$this->db->where('is_delete',0);

		return $this->db->get('dq_teachers')->result();
	}

	public function update_teacher($id)
	{
		if(!empty($_FILES['teacher_picture']['name']))
		{
			$config['upload_path'] = 'assets/images/teacher_pictures/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['file_name'] = rand(0,999).'-'.time();
			$config['overwrite'] = true;

			//Load upload library and initialize configuration
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if($this->upload->do_upload('teacher_picture'))
			{
				$uploadData = $this->upload->data();
				$picture = $uploadData['file_name'];
			}
			$this->db->set('picture',$picture);
		}

		$update_teacher = [
			'name' 				=>  $this->input->post('name'),
			'fathername'		=>	$this->input->post('fathername'),
			'gender'			=>	$this->input->post('gender'),
			'email'				=>	$this->input->post('email'),
			'mobile'			=>	$this->input->post('mobile'),
			'cnic'				=>	$this->input->post('cnic'),
			'address'			=>	$this->input->post('address'),
			'qoumiat'			=>	$this->input->post('qoumiat'),
			'elaqa'				=>	$this->input->post('elaqa'),
			'appointment_date'	=>	$this->input->post('appointment_date'),
			'dob'				=>	$this->input->post('dob'),
			'married'			=>	$this->input->post('married'),
			'no_of_child'		=>	$this->input->post('no_of_child'),
			'active' 			=> 	$this->input->post('active'),
			'updated_by'		=>	$this->user_id,
			'updated_on'		=>	$this->time
		];

		$this->db->where('id', $id);
		$this->db->update('dq_teachers', $update_teacher);

		if ($this->db->affected_rows()>0)
		{
			$this->session->set_flashdata('success_msg', ' ترمیم ہو گئی');
		}
		else
		{
			$this->session->set_flashdata('error_msg', 'ترمیم نہیں ہوئی');
		}
		redirect('Teacher');
	}

	public function delete_teacher($id)
	{
		$this->db->set('is_delete',1);
		$this->db->set('deleted_on',$this->time);
		$this->db->set('deleted_by',$this->user_id);
		$this->db->where('id',$id);
		$this->db->update('dq_teachers');

		$this->session->set_flashdata('error_msg', 'حذف کامیاب');

		redirect('Teacher');
	}

	public function detail_teacher($id)
	{
		return $this->db->get_where('dq_teachers',['id'=>$id])->row();
	}

	public function update_profile($teacher_id)
	{
		if(!empty($_FILES['teacher_picture']['name']))
		{
			$config['upload_path'] = 'assets/images/teacher_pictures/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['file_name'] = rand(0,999).'-'.time();
			$config['overwrite'] = true;

			//Load upload library and initialize configuration
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if($this->upload->do_upload('teacher_picture'))
			{
				$uploadData = $this->upload->data();
				$picture = $uploadData['file_name'];
			}
			$this->db->set('picture',$picture);
		}
		$update_profile = [
			'active'	=>	$this->input->post('active'),
			'updated_by'=>	$this->user_id,
			'updated_on'=>	$this->time
		];

		$this->db->where('id',$teacher_id);
		$this->db->update('dq_teachers',$update_profile);

		if($this->db->affected_rows()>0)
		{
			$this->session->set_flashdata('success_msg','ریکارڈ تبدیل ہو گیا ہے');
		}
		redirect("Teacher/detail_teacher/$teacher_id");
	}
}
