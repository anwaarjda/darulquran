<?php

class Dq_year_model extends CI_Model
{
	public function get_year()
	{
		$year = $this->db->order_by('ac_year','DESC')->get('dq_years');
		if ($year->num_rows()>0)
		{
			return $year->result();
		}
		else
		{
			return false;
		}
	}

	public function update_year($id,$status)
	{
		$update = [
			'status'		=> $status,
			'updated_by'	=> $this->user_id,
			'updated_on'	=> $this->time
		];

		$this->db->where('id',$id);
		$this->db->update('dq_years',$update);

		if($this->db->affected_rows())
		{
			$update = [
				'status'	=> 0
			];
			$this->db->where_not_in('id',$id);
			$this->db->update('dq_years',$update);

			$this->session->set_flashdata('success_msg','ترمیم ہو گئی');
		}
		else
		{
			$this->session->set_flashdata('error_msg','ترمیم نہیں ہوئی');
		}
		redirect('Dq_years');
	}
}
