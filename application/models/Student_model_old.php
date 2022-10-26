<?php
class Student_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Class_model');
	}

	public function check_admission_number($admission_number)
	{
		$this->db->where('admission_number',$admission_number);
		$this->db->where('ac_year',$this->ac_year);
		$this->db->where('is_delete',0);

		return $this->db->get('dq_enroll')->row();
	}

	public function save_student()
	{
		$admission_number = $this->input->post('admission_number');

		if(!empty($_FILES['student_picture']['name']))
		{
			$config['upload_path'] = 'assets/images/student_pictures/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['file_name'] = $this->ac_year.'-'.$admission_number.'.jpg';

			//Load upload library and initialize configuration
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if($this->upload->do_upload('student_picture'))
			{
				$uploadData = $this->upload->data();
				$uploadData['file_name'];
			}
		}

		$student = [
			'name'					=>	$this->input->post('name'),
			'father_name'			=>	$this->input->post('father_name'),
			'resident'				=>	$this->input->post('resident'),
			'dob'					=>	$this->input->post('dob'),
			'birthplace'			=>	$this->input->post('birthplace'),
			'district'				=>	$this->input->post('district'),
			'area'					=>	$this->input->post('area'),
			'province'				=>	$this->input->post('province'),
			'country'				=>	$this->input->post('country'),
			'cnic'					=>	$this->input->post('cnic'),
			'address'				=>	$this->input->post('address'),
			'phone'					=>	$this->input->post('phone'),
			'passport'				=>	$this->input->post('passport'),
			'father_cnic'			=>	$this->input->post('father_cnic'),
			'knownperson'			=>	$this->input->post('knownperson'),
			'knownperson_address'	=>	$this->input->post('knownperson_address'),
			'knownperson_phone'		=>	$this->input->post('knownperson_phone'),
			'last_darsgah'			=>	$this->input->post('last_darsgah'),
			'leave_reason'			=>	$this->input->post('leave_reason'),
			'prev_darsgah'			=>	$this->input->post('prev_darsgah'),
			'prev_education'		=>	$this->input->post('prev_education'),
			'required_class'		=>	$this->input->post('required_class'),
			'created_by'			=>	$this->user_id,
			'created_on'			=>	$this->time
		];
		$query = $this->db->insert('dq_students',$student);

		if ($query>0)
		{
			$student_id = $this->db->insert_id();
			$guardian = [
				'student_id'			=>	$student_id,
				'guardian'				=>	$this->input->post('guardian'),
				'guardian_father_name'	=>	$this->input->post('guardian_father_name'),
				'guardian_relation'		=>	$this->input->post('guardian_relation'),
				'guardian_profession'	=>	$this->input->post('guardian_profession'),
				'guardian_address'		=>	$this->input->post('guardian_address'),
				'guardian_phone'		=>	$this->input->post('guardian_phone'),
				'guardian_phone_2'		=>	$this->input->post('guardian_phone_2'),
				'guardian_cnic'			=>	$this->input->post('guardian_cnic'),
				'created_by'			=>	$this->user_id,
				'created_on'			=>	$this->time
			];
			$query = $this->db->insert('dq_guardians',$guardian);

			if($query>0)
			{
				$student_id = $this->db->insert_id();
				$guarantor = [
					'student_id'			=>	$student_id,
					'guarantor'				=>	$this->input->post('guarantor'),
					'guarantor_father_name'	=>	$this->input->post('guarantor_father_name'),
					'guarantor_country'		=>	$this->input->post('guarantor_country'),
					'guarantor_address'		=>	$this->input->post('guarantor_address'),
					'guarantor_cnic'		=>	$this->input->post('guarantor_cnic'),
					'known_from'			=>	$this->input->post('known_from'),
					'created_by'			=>	$this->user_id,
					'created_on'			=>	$this->time
				];
				$query = $this->db->insert('dq_guarantors',$guarantor);

				if ($query>0)
				{
					$enroll = [
						'admission_number' 		=> 	$admission_number,
						'old_admission_number' 	=> 	$this->input->post('old_admission_number'),
						'admission_type' 		=> 	$this->input->post('admission_type'),
						'fees_type' 			=> 	$this->input->post('fees_type'),
						'date'					=>	$this->input->post('date'),
						'date_hijri'			=>	$this->input->post('date_hijri'),
						'student_id'			=>	$student_id,
						'class_id'				=>	$this->input->post('required_class'),
						'ac_year'				=>	$this->ac_year,
						'created_by'			=>	$this->user_id,
						'created_on'			=>	$this->time
					];
					$enroll_query = $this->db->insert('dq_enroll',$enroll);

					if($enroll_query>0)
					{
						$this->session->class_id = $this->input->post('required_class');
						$this->session->set_flashdata('success_msg','ریکارڈ محفوظ ہوگیا ہے');
					}
					else
					{
						$this->session->set_flashdata('error_msg','ریکارڈ محفوظ نہیں ہوا');
					}
				}
			}
		}
		redirect('Student');
	}

	public function get_student($id=null)
	{
		if(!empty($id))
		{
			$this->db->where('dq_students.id',$id);
		}
		$this->db->select('dq_enroll.admission_number,dq_enroll.old_admission_number,
		dq_enroll.admission_type,dq_enroll.fees_type,dq_enroll.class_id,dq_enroll.ac_year,
		dq_enroll.active,dq_enroll.date,dq_enroll.date_hijri,dq_students.id,dq_students.name,
		dq_students.father_name,dq_students.dob,dq_students.resident,dq_students.birthplace,
		dq_students.district,dq_students.area as area_id,dq_students.province,dq_students.country,
		dq_students.cnic,dq_students.address,dq_students.phone,dq_students.passport,
		dq_students.father_cnic,dq_guardians.id as guardian_id,dq_guardians.guardian,
		dq_guardians.guardian_father_name,dq_guardians.guardian_relation,
		dq_guardians.guardian_profession,dq_guardians.guardian_address,
		dq_guardians.guardian_phone,dq_guardians.guardian_phone_2,dq_guardians.guardian_cnic,
		dq_students.knownperson,dq_students.knownperson_address,dq_students.knownperson_phone,
		dq_students.last_darsgah,dq_students.leave_reason,dq_students.prev_darsgah,
		dq_students.prev_education,dq_students.required_class,dq_classes.class_name,
		dq_guarantors.guarantor,dq_guarantors.guarantor_father_name,
		dq_guarantors.guarantor_country,dq_guarantors.guarantor_address,
		dq_guarantors.guarantor_cnic,dq_guarantors.known_from');

		$this->db->where('dq_students.is_delete',0);
		$this->db->where('dq_enroll.ac_year',$this->ac_year);
		$this->db->join('dq_guardians','dq_students.id=dq_guardians.student_id');
		$this->db->join('dq_enroll','dq_students.id=dq_enroll.student_id');
		$this->db->join('dq_classes','dq_classes.id=dq_enroll.class_id');
		$this->db->join('dq_guarantors','dq_students.id=dq_guarantors.student_id','left');
		$this->db->order_by('dq_enroll.id','DESC');

		return $this->db->get('dq_students')->result();
	}

	public function update_student($student_id)
	{
		$admission_number = $this->input->post('admission_number');

		if(!empty($_FILES['student_picture']['name']))
		{
			$config['upload_path'] = 'assets/images/student_pictures/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['file_name'] = $this->ac_year.'-'.$admission_number.'.jpg';
			$config['overwrite'] = true;

			//Load upload library and initialize configuration
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if($this->upload->do_upload('student_picture'))
			{
				$uploadData = $this->upload->data();
				$uploadData['file_name'];
				$this->output->delete_cache();
			}
		}

		$update_student = [
			'name'					=>	$this->input->post('name'),
			'father_name'			=>	$this->input->post('father_name'),
			'resident'				=>	$this->input->post('resident'),
			'dob'					=>	$this->input->post('dob'),
			'birthplace'			=>	$this->input->post('birthplace'),
			'district'				=>	$this->input->post('district'),
			'area'					=>	$this->input->post('area'),
			'province'				=>	$this->input->post('province'),
			'country'				=>	$this->input->post('country'),
			'cnic'					=>	$this->input->post('cnic'),
			'address'				=>	$this->input->post('address'),
			'phone'					=>	$this->input->post('phone'),
			'passport'				=>	$this->input->post('passport'),
			'father_cnic'			=>	$this->input->post('father_cnic'),
			'knownperson'			=>	$this->input->post('knownperson'),
			'knownperson_address'	=>	$this->input->post('knownperson_address'),
			'knownperson_phone'		=>	$this->input->post('knownperson_phone'),
			'last_darsgah'			=>	$this->input->post('last_darsgah'),
			'leave_reason'			=>	$this->input->post('leave_reason'),
			'prev_darsgah'			=>	$this->input->post('prev_darsgah'),
			'prev_education'		=>	$this->input->post('prev_education'),
			'required_class'		=>	$this->input->post('required_class'),
			'updated_by'			=>	$this->user_id,
			'updated_on'			=>	$this->time
		];

		$this->db->where('id',$student_id);
		$query1 = $this->db->update('dq_students',$update_student);

		if ($query1>0)
		{
			$guardian = [
				'guardian' 				=> $this->input->post('guardian'),
				'guardian_father_name'  => $this->input->post('guardian_father_name'),
				'guardian_relation' 	=> $this->input->post('guardian_relation'),
				'guardian_profession'   => $this->input->post('guardian_profession'),
				'guardian_address' 		=> $this->input->post('guardian_address'),
				'guardian_phone' 		=> $this->input->post('guardian_phone'),
				'guardian_phone_2'		=> $this->input->post('guardian_phone_2'),
				'guardian_cnic' 		=> $this->input->post('guardian_cnic'),
				'updated_by' 			=> $this->user_id,
				'updated_on' 			=> $this->time
			];

			$this->db->where('student_id',$student_id);
			$query2 = $this->db->update('dq_guardians',$guardian);

			if($query2)
			{
				$guarantor = [
					'student_id'			=>	$student_id,
					'guarantor'				=>	$this->input->post('guarantor'),
					'guarantor_father_name'	=>	$this->input->post('guarantor_father_name'),
					'guarantor_country'		=>	$this->input->post('guarantor_country'),
					'guarantor_address'		=>	$this->input->post('guarantor_address'),
					'guarantor_cnic'		=>	$this->input->post('guarantor_cnic'),
					'known_from'			=>	$this->input->post('known_from'),
					'created_by'			=>	$this->user_id,
					'created_on'			=>	$this->time
				];

				$this->db->where('student_id',$student_id);
				$query3 = $this->db->update('dq_guarantors',$guarantor);

				if ($query3>0)
				{
					$enroll = [
						'student_id' 			=> $student_id,
						'class_id' 				=> $this->input->post('required_class'),
						'admission_number' 		=> $admission_number,
						'old_admission_number' 	=> $this->input->post('old_admission_number'),
						'admission_type'		=> $this->input->post('admission_type'),
						'fees_type'				=> $this->input->post('fees_type'),
						'date' 					=> $this->input->post('date'),
						'date_hijri' 			=> $this->input->post('date_hijri'),
						'ac_year' 				=> $this->ac_year,
						'active' 				=> $this->input->post('active'),
						'updated_by' 			=> $this->user_id,
						'updated_on' 			=> $this->time
					];
					$this->db->where('student_id', $student_id);
					$this->db->update('dq_enroll', $enroll);

					if ($this->db->affected_rows()>0)
					{
						$this->session->set_flashdata('success_msg', 'ترمیم ہو گئی ہے');
					}
				}
			}
		}
		redirect('Student');
	}

	public function delete_student($id)
	{
		$this->db->select('student_id');
		$this->db->where('student_id',$id);
		$this->db->where('ac_year',$this->ac_year);
		$this->db->where('active',1);
		$this->db->where('is_delete',0);

		$student = $this->db->get('dq_enroll')->num_rows();

		if($student>0)
		{
			$this->session->set_flashdata('error_msg','یہ طالب علم کلاس میں موجود ہے');
		}
		else
		{
			$this->db->set('is_delete', 1);
			$this->db->set('deleted_on', $this->time);
			$this->db->set('deleted_by', $this->user_id);
			$this->db->where('student_id', $id);
			$this->db->update('dq_enroll');

			if($this->db->affected_rows()>0)
			{
				$this->db->set('is_delete', 1);
				$this->db->set('deleted_on', $this->time);
				$this->db->set('deleted_by', $this->user_id);
				$this->db->where('id', $id);
				$this->db->update('dq_students');

				if($this->db->affected_rows()>0)
				{
					$this->db->set('is_delete', 1);
					$this->db->set('deleted_on', $this->time);
					$this->db->set('deleted_by', $this->user_id);
					$this->db->where('student_id', $id);
					$this->db->update('dq_guardians');

					if($this->db->affected_rows()>0)
					{
						$this->db->set('is_delete', 1);
						$this->db->set('deleted_on', $this->time);
						$this->db->set('deleted_by', $this->user_id);
						$this->db->where('student_id', $id);
						$this->db->update('dq_guarantors');
					}
				}
			}
		}
		redirect('Student');
	}

	public function detail_student($student_id=null)
	{
		$option = $this->input->post('option');
		$detail = $this->input->post('detail');

		if ($option=='admission_number')
		{
			$this->db->select('student_id,ac_year');
			$this->db->where('admission_number',$detail);
			$this->db->where('ac_year',$this->ac_year);
			$this->db->where('is_delete',0);

			$student_id = $this->db->get('dq_enroll')->row()->student_id??null;

			if ($student_id!='') // FETCHING STUDENT PROFILE DATA FOR SEARCH
			{
				$this->db->select('dq_students.id,dq_students.name,dq_students.father_name,
				dq_students.resident,dq_students.dob,dq_students.birthplace,dq_students.district,
				dq_area.area,dq_students.province,dq_students.country,dq_students.cnic,
				dq_students.address,dq_students.phone,dq_students.passport,dq_students.father_cnic,
				dq_students.knownperson,dq_students.knownperson_address,dq_students.knownperson_phone,
				dq_students.last_darsgah,dq_students.leave_reason,dq_students.prev_darsgah,
				dq_students.prev_education,dq_students.required_class,dq_classes.id as class_id,
				dq_classes.class_no,dq_classes.class_name,dq_classes.active as class_active,
				dq_enroll.id as enroll_id,dq_enroll.admission_number,dq_enroll.old_admission_number,
				dq_enroll.admission_type,dq_enroll.ac_year,dq_enroll.active,dq_guardians.guardian,
				guardian_father_name,guardian_relation,guardian_address,guardian_phone,guardian_profession,
				guardian_cnic,dq_guarantors.guarantor,dq_guarantors.guarantor_father_name,
				dq_guarantors.guarantor_country,dq_guarantors.guarantor_address,
				dq_guarantors.guarantor_cnic,dq_guarantors.known_from');

				$this->db->join('dq_students','dq_students.id=dq_enroll.student_id');
				$this->db->join('dq_area','dq_students.area=dq_area.id');
				$this->db->join('dq_guardians','dq_guardians.student_id=dq_students.id');
				$this->db->join('dq_classes','dq_classes.id=dq_enroll.class_id');
				$this->db->join('dq_guarantors','dq_guarantors.student_id=dq_students.id');
				$this->db->where('dq_enroll.student_id',$student_id);
				$this->db->where('dq_enroll.ac_year',$this->ac_year);
				$this->db->where('dq_enroll.is_delete',0);

				return $this->db->get('dq_enroll')->row();
			}
			else
			{
				$this->session->set_flashdata('error_msg','ریکارڈ موجود نہیں ہے');
				redirect('Search');
			}
		}
		if ($option == 'name' || $option == 'father_name' || $option=='father_cnic'
			|| $option=='area')
		{
			if($class_id = $this->input->post('class'))
			{
				$this->db->where('dq_enroll.class_id',$class_id);
			}

			$this->db->select('dq_enroll.id as enroll_id,dq_enroll.student_id,
			dq_enroll.active,dq_enroll.admission_number,dq_enroll.old_admission_number,dq_enroll.ac_year,
			dq_students.name,dq_students.father_name,dq_students.area,dq_classes.id as class_id,
			dq_classes.class_name,dq_classes.active as class_active');

			if ($option == 'name')
			{
				$this->db->like('name', $detail);
			}
			elseif ($option == 'father_name')
			{
				$this->db->like('father_name', $detail);
			}
			elseif ($option == 'father_cnic')
			{
				$this->db->like('father_cnic', $detail);
			}
			elseif ($option == 'area')
			{
				$this->db->like('area', $detail);
			}
			
			$this->db->where('ac_year', $this->ac_year);
			$this->db->join('dq_classes', 'dq_classes.id = dq_enroll.class_id');
			$this->db->join('dq_students', 'dq_students.id = dq_enroll.student_id');

			$query = $this->db->get('dq_enroll');

			if($query->num_rows()>0)
			{
				return $query->result();
			}
			else
			{
				$this->session->set_flashdata('error_msg', 'ریکارڈ موجود نہیں ہے');
				redirect("Search/index/$option/$detail");
			}
		}

		if($student_id)	// FETCHING STUDENT PROFILE DATA FOR CLASS_LIST AND FOR REDIRECT
		{
			$this->db->select('dq_students.id,dq_students.name,dq_students.father_name,
			dq_students.dob,dq_students.resident,dq_students.birthplace,dq_students.district,
			dq_area.area,dq_students.province,dq_students.country,dq_students.cnic,
			dq_students.address,dq_students.phone,dq_students.passport,dq_students.father_cnic,
			dq_students.knownperson,dq_students.knownperson_address,dq_students.knownperson_phone,
			dq_students.last_darsgah,dq_students.leave_reason,dq_students.prev_darsgah,
			dq_students.prev_education,dq_students.required_class,dq_classes.id as class_id,
			dq_classes.class_no,dq_classes.class_name,dq_classes.active as class_active,
			dq_enroll.id as enroll_id,dq_enroll.admission_number,dq_enroll.admission_type,
			dq_enroll.old_admission_number,dq_enroll.date,dq_enroll.ac_year,dq_enroll.active,
			dq_guardians.guardian,guardian_father_name,guardian_relation,guardian_address,
			guardian_phone,guardian_profession,guardian_cnic,dq_guarantors.guarantor,
			dq_guarantors.guarantor_father_name,dq_guarantors.guarantor_country,
			dq_guarantors.guarantor_address,dq_guarantors.guarantor_cnic,dq_guarantors.known_from');

			$this->db->where('dq_enroll.ac_year',$this->ac_year);
			$this->db->where('dq_enroll.student_id',$student_id);
			$this->db->where('dq_enroll.is_delete',0);
			$this->db->join('dq_students','dq_students.id=dq_enroll.student_id');
			$this->db->join('dq_area','dq_students.area=dq_area.id');
			$this->db->join('dq_guardians','dq_guardians.student_id=dq_students.id');
			$this->db->join('dq_classes','dq_classes.id=dq_enroll.class_id');
			$this->db->join('dq_guarantors','dq_guarantors.student_id=dq_students.id');

			return $this->db->get('dq_enroll')->row();
		}
	}

	public function update_profile($student_id)
	{
		$admission_number = $this->input->post('admission_number');
		$updated_class = $this->input->post('update_student_class');

		if(!empty($_FILES['student_picture']['name']))
		{
			$config['upload_path'] = 'assets/images/student_pictures/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['file_name'] = $this->ac_year.'-'.$admission_number.'.jpg';
			$config['overwrite'] = true;

			//Load upload library and initialize configuration
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if($this->upload->do_upload('student_picture'))
			{
				$uploadData = $this->upload->data();
				$uploadData['file_name'];
				$this->output->delete_cache();
			}
		}
		
		$this->db->select('id');
		$this->db->where('student_id',$student_id);
		$q = $this->db->get('dq_enroll');
		if($q->num_rows()>0)
		{
			$enroll_id = $q->row()->id;
		}
		else
		{
			echo false;
		}

		$update_profile = [
				'class_id'	=>	$updated_class,
				'ac_year'	=>	$this->ac_year,
				'active'	=>	$this->input->post('update_student_status'),
				'updated_by'=>	$this->user_id,
				'updated_on'=>	$this->time
			];

		$this->db->where('id',$enroll_id);
		$this->db->update('dq_enroll',$update_profile);

		if($this->db->affected_rows()>0)
		{
			$this->session->set_flashdata('success_msg','ریکارڈ تبدیل ہو گیا ہے');
		}
		redirect("Student/detail_student/$student_id");
	}

	public function save_student_complaint()
	{
		$student_id = $this->input->post('student_id');

		$this->db->select('id');
		$this->db->where('student_id',$student_id);
		$this->db->where('is_delete',0);
		$q = $this->db->get('dq_enroll');
		if($q->num_rows()>0)
		{
			$enroll_id = $q->row()->id;
		}
		else
		{
			echo false;
		}

		$complaint = [
			'enroll_id' 	=> 	$enroll_id,
			'complaint' 	=> 	$this->input->post('complaint'),
			'complaint_by' 	=> 	$this->input->post('complaint_by'),
			'ac_year'		=>	$this->ac_year,
			'created_by'	=>	$this->user_id,
			'created_on'	=>	$this->time
		];

		$query = $this->db->insert('dq_complaints',$complaint);
		if($query>0)
		{
			$this->session->set_flashdata('success_msg','شکایت درج ہو گئی ہے');
		}
		else
		{
			$this->session->set_flashdata('error_msg','شکایت درج نہیں ہوئی');
		}
		redirect("Student/detail_student/$student_id");
	}

	public function get_complaint($enroll_id)
	{
		$this->db->select('id,enroll_id,complaint,complaint_by');
		$this->db->where('is_delete',0);
		$this->db->where('enroll_id',$enroll_id);
		$this->db->where('ac_year',$this->ac_year);

		return $this->db->get('dq_complaints')->result();
	}

	public function update_student_complaint($complaint_id,$student_id)
	{
		$update_complaint = [
					'complaint'		=>	$this->input->post('complaint'),
					'complaint_by'	=>	$this->input->post('complaint_by'),
					'ac_year'		=>	$this->ac_year,
					'updated_by'	=>	$this->user_id,
					'updated_on'	=>	$this->time
				];
		
		$this->db->where('id',$complaint_id);
		$this->db->update('dq_complaints',$update_complaint);

		if($this->db->affected_rows()>0)
		{
			$this->session->set_flashdata('success_msg','ریکارڈ تبدیل ہو گیا ہے');
		}
		redirect("Student/detail_student/$student_id");
	}

	public function delete_student_complaint($complaint_id,$student_id,$enroll_id)
	{
		$this->db->set('is_delete',1);
		$this->db->set('deleted_on',$this->time);
		$this->db->set('deleted_by',$this->user_id);
		$this->db->where('id',$complaint_id);
		$this->db->where('enroll_id',$enroll_id);
		$this->db->update('dq_complaints');

		if($this->db->affected_rows()>0)
		{
			$this->session->set_flashdata('success_msg','شکایت حزف ہو گئی');
		}
		redirect("Student/detail_student/$student_id");
	}

	public function count_students($active) // For Dashboard
	{
		$this->db->select('count(dq_enroll.class_id) as students');
		$this->db->where('dq_enroll.ac_year',$this->ac_year);
		$this->db->where('dq_enroll.active',$active);
		$this->db->where('dq_classes.is_delete', 0);
		$this->db->where('dq_students.is_delete', 0);
		$this->db->join('dq_enroll','dq_enroll.class_id=dq_classes.id','left');
		$this->db->join('dq_students','dq_students.id=dq_enroll.student_id','left');

		return $this->db->get('dq_classes')->row()->students;
	}

	public function get_total_student()
	{
		return $this->db->get_where('dq_students',['is_delete'=>0])->num_rows();
	}

	public function get_total_student_current_ac_year()
	{
		$this->db->where('dq_enroll.ac_year',$this->ac_year);
		$this->db->where('dq_enroll.is_delete',0);
		$this->db->where('dq_students.is_delete',0);
		$this->db->join('dq_students','dq_enroll.student_id=dq_students.id');

		return $this->db->get('dq_enroll')->num_rows();
	}
}
