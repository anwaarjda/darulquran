<?php


class Fees_model extends CI_Model
{
	public function get_annual_fees()
	{
		$this->db->where('ac_year',$this->ac_year);
		return $this->db->get('dq_fees_master')->row();
	}

	public function get_student_by_gr_number()
	{
		$this->db->select('dq_students.id as student_id,dq_students.name,
		dq_students.father_name,dq_students.gr_number,dq_classes.class_name,
		dq_enroll.fees_type,dq_enroll.remarks,dq_fees.page_number,dq_fees.voucher_no,
		dq_fees.received,dq_fees.paid,dq_fees.id as fees_id,dq_fees.date,dq_enroll.remarks');

		$this->db->where('dq_students.gr_number',$this->input->post('gr_number'));
		$this->db->where('dq_enroll.ac_year',$this->ac_year);
		$this->db->where('dq_enroll.is_delete',0);
		$this->db->join('dq_students','dq_students.id=dq_enroll.student_id');
		$this->db->join('dq_classes','dq_enroll.class_id=dq_classes.id');
		$this->db->join('dq_fees','dq_students.id=dq_fees.student_id','left');

		$query = $this->db->get('dq_enroll');

		return $query->row();

	}

	public function print_fees_voucher($fees_id)
	{
		$this->db->select('dq_students.id as student_id,dq_students.name,dq_enroll.admission_type,
		dq_students.father_name,dq_students.gr_number,dq_enroll.admission_number,dq_classes.class_name,
		dq_enroll.fees_type,dq_fees.page_number,dq_fees.voucher_no,users.first_name as user_name,
		dq_fees.received,dq_fees.paid,dq_fees.date,dq_enroll.remarks,dq_fees.amount');

		$this->db->join('dq_enroll', 'dq_enroll.id=dq_fees.enroll_id');
		$this->db->join('dq_students','dq_students.id=dq_enroll.student_id');
		$this->db->join('dq_classes','dq_enroll.class_id=dq_classes.id');
		$this->db->join('users','users.id=dq_fees.created_by');
		$this->db->where('dq_fees.id', $fees_id);
		$this->db->where('dq_enroll.ac_year',$this->ac_year);

		return $this->db->get('dq_fees')->row();
	}

	public function generate_annual_fees()
	{
		$annual_fees = [
			'ac_year'	=> $this->ac_year,
			'amount'	=>	$this->input->post('amount')
		];

		$query = $this->db->insert('dq_fees_master', $annual_fees);

		if ($query > 0)
		{
			$this->session->set_flashdata('success_msg', 'فیس بن گئی');
		}
		else
		{
			$this->session->set_flashdata('error_msg', 'فیس نہیں بنی');
		}
		redirect('Fees/annual_fees');
	}

	public function update_annual_fees($id)
	{
		$update = [
			'ac_year'	=>	$this->ac_year,
			'amount'	=>	$this->input->post('edit_amount')
		];

		$this->db->where('id',$id);
		$this->db->update('dq_fees_master',$update);

		if($this->db->affected_rows())
		{
			$this->session->set_flashdata('success_msg','فیس میں ترمیم ہو گئی');
		}
		redirect('Fees/annual_fees');
	}

	public function receive()
	{
		$gr_number = $this->input->post('gr_number');
		$student_id = $this->input->post('student_id');

		$serial_number = $this->db->select_max('sn')->get('dq_fees')->row()->sn + 1;
		$enroll_id = $this->db->get_where('dq_enroll',['student_id'=>$student_id])->row()->id;

		$receive = [
			'student_id'		=>	$student_id,
			'enroll_id'			=>	$enroll_id,
			'sn'				=>	$serial_number,
			'voucher_no'		=>	'DQ-'.$this->year.'-'.$serial_number,
			'ac_year'			=>	$this->ac_year,
			'page_number'		=>	$this->input->post('page_number'),
			'amount'			=>	$this->input->post('amount'),
			'received'			=>	$this->input->post('received'),
			'date'				=>	$this->time,
			'created_by'		=>	$this->user_id
		];

		$this->db->insert('dq_fees',$receive);
		redirect("Fees/print_fees_voucher/".$this->db->insert_id());
	}

	public function get_fees_list($paid,$class_id)
	{
		$this->db->select('dq_enroll.admission_number,dq_enroll.fees_type,
		dq_students.name,dq_students.father_name,dq_students.gr_number,dq_fees.page_number,
		dq_fees.id, dq_fees.amount, dq_fees.received,dq_fees.voucher_no,dq_fees.date,dq_enroll.remarks,
		guardian_phone');
		$this->db->where('dq_students.is_delete',0);
		if($class_id!='all')
		{
			$this->db->where('dq_enroll.class_id',$class_id);
		}
		if($paid==1)
		{
			$this->db->where('dq_fees.paid',1);
		}
		elseif($paid==0 && $paid!='paid_unpaid')
		{
			$this->db->where('dq_fees.paid',null);
		}

		$this->db->join('dq_students','dq_enroll.student_id=dq_students.id');
		$this->db->join('dq_fees','dq_fees.enroll_id=dq_enroll.id','left');
		$this->db->join('dq_guardians', 'dq_guardians.student_id=dq_students.id');
		$this->db->where('dq_enroll.ac_year',$this->ac_year);
		$this->db->order_by('dq_students.gr_number');

		$query =  $this->db->get('dq_enroll');
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			$this->session->set_flashdata('error_msg','ریکارڈ موجود نہیں ہے');
			redirect('Fees/fees_list');
		}
	}
}
