<?php

class Area_model extends CI_Model
{
	public function get_areas()
	{
		return $this->db->get('dq_area')->result();
	}

	public function save_area()
	{
		$area = [
			'area'	=> $this->input->post('area')
		];

		$query = $this->db->insert('dq_area',$area);
		if($query>0)
		{
			$this->session->set_flashdata('success_msg','ریکارڈ محفوظ ہوگیا ہے');
		}
		redirect('Area');
	}

	public function update($id)
	{
		$update = [
			'area'	=>	$this->input->post('edit_area')
		];

		$this->db->where('id',$id);
		$this->db->update('dq_area',$update);

		if($this->db->affected_rows())
		{
			$this->session->set_flashdata('success_msg','ترمیم ہو گئی');
		}
		redirect('Area');
	}
}
