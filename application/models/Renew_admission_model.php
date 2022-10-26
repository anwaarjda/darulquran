<?php


class Renew_admission_model extends CI_Model
{
	public function get_prev_year()
	{
		$id = $this->db->get_where('dq_years',['ac_year'=>$this->ac_year])->row()->id-1;

		$this->db->where('status',1);
		$this->db->where('id',$id);
		$query = $this->db->get('dq_years')->row()->ac_year;

		if($query>0)
		{
			return $query;
		}
		else
		{
			$this->session->set_flashdata('error_msg','گزشتہ سال فعال نہیں');
		}
		redirect('Renew');
	}

	public function get_student_by_admission_number()
	{
		$prev_year = $this->get_prev_year();
		$old_admission_number = $this->input->post('old_admission_number');

		$this->db->select('dq_enroll.admission_number,dq_enroll.old_admission_number,
		dq_enroll.admission_type,dq_enroll.fees_type,dq_enroll.class_id,dq_enroll.ac_year,
		dq_enroll.active,
		dq_enroll.date,dq_enroll.date_hijri,dq_students.id,dq_students.name,dq_students.father_name,
		dq_students.dob,dq_students.resident,dq_students.birthplace,dq_students.district,
		dq_students.area,dq_students.province,dq_students.country,dq_students.cnic,
		dq_students.address,dq_students.phone,dq_students.passport,dq_students.father_cnic,
		dq_guardians.id as guardian_id,dq_guardians.guardian,dq_guardians.guardian_father_name,
		dq_guardians.guardian_relation,dq_guardians.guardian_profession,
		dq_guardians.guardian_address,dq_guardians.guardian_phone,dq_guardians.guardian_cnic,
		dq_students.knownperson,dq_students.knownperson_address,dq_students.knownperson_phone,
		dq_students.last_darsgah,dq_students.leave_reason,dq_students.prev_darsgah,
		dq_students.prev_education,dq_students.required_class,dq_classes.class_name,
		dq_guarantors.guarantor,dq_guarantors.guarantor_father_name,
		dq_guarantors.guarantor_country,dq_guarantors.guarantor_address,
		dq_guarantors.guarantor_cnic,dq_guarantors.known_from');

		$this->db->where('dq_students.is_delete',0);
		$this->db->where('dq_enroll.ac_year',$prev_year);
		$this->db->where('dq_enroll.admission_number',$old_admission_number);
		$this->db->join('dq_guardians','dq_students.id=dq_guardians.student_id');
		$this->db->join('dq_enroll','dq_students.id=dq_enroll.student_id');
		$this->db->join('dq_classes','dq_classes.id=dq_enroll.class_id');
		$this->db->join('dq_guarantors','dq_students.id=dq_guarantors.student_id','left');
		$this->db->order_by('dq_students.gr_number');

		$query = $this->db->get('dq_students');

		if($query->num_rows()>0)
		{
			return $query->row();
		}
		else
		{
			$this->session->set_flashdata('error_msg','سابقہ سال میں داخلہ نمبر موجود نہیں ہے');
		}
		redirect('Renew');
	}

	public function renew_admission($student_id)
	{
		$this->db->select('ac_year');
		$this->db->where('status',1);
		$this->db->where('ac_year',$this->ac_year);
		$query = $this->db->get('dq_years')->row();

		if($query>0)
		{
			if(!empty($_FILES['student_picture']['name']))
			{
				$config['upload_path'] = 'assets/images/student_pictures/';
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
				$config['file_name'] = $this->ac_year.'-'.$this->input->post('admission_number').'.jpg';

				//Load upload library and initialize configuration
				$this->load->library('upload',$config);
				$this->upload->initialize($config);

				if($this->upload->do_upload('student_picture'))
				{
					$uploadData = $this->upload->data();
					$uploadData['file_name'];
					print_r($uploadData['file_name']);exit;
				}
			}

			$enroll = [
				'admission_number' 			=> $this->input->post('admission_number'),
				'old_admission_number' 		=> $this->input->post('old_admission_number'),
				'admission_type' 			=> $this->input->post('admission_type'),
				'fees_type' 				=> $this->input->post('fees_type'),
				'date' 						=> $this->input->post('date'),
				'date_hijri' 				=> $this->input->post('date_hijri'),
				'student_id' 				=> $student_id,
				'class_id'					=> $this->input->post('required_class'),
				'ac_year' 					=> $this->ac_year,
				'created_by' 				=> $this->user_id,
				'created_on' 				=> $this->time
			];
			$query = $this->db->insert('dq_enroll', $enroll);

			if ($query > 0) {
				$this->session->set_flashdata('success_msg', 'ریکارڈ محفوظ ہوگیا ہے');
			} else {
				$this->session->set_flashdata('error_msg', 'ریکارڈ محفوظ نہیں ہوا');
			}
			redirect('Student');
		}
		else
		{
			$this->session->set_flashdata('error_msg','یہ سال فعال نہیں ہے');
		}
		redirect('Renew');
	}
}
