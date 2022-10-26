<?php


class User_model extends CI_Model
{
	public function add_user()
	{
		$this->load->model('Ion_auth_model');
		$data = [
			'ip_address' 	=> $this->input->ip_address(),
			'username' 		=> $this->input->post('name'),
			'first_name' 	=> $this->input->post('first_name'),
			'email' 		=> $this->input->post('email'),
			'phone' 		=> $this->input->post('mobile'),
			'password' 		=> $this->Ion_auth_model->hash_password($this->input->post('password')),
			'active' 		=> 1,
			'created_on' 	=> $this->time
		];
		$query = $this->db->insert("users",$data);

		$data = [
			'user_id' => $this->db->insert_id(),
			'group_id' => $this->input->post('group_id')
		];
		$this->db->insert('users_groups',$data);
		if ($query>0)
		{
			$this->session->set_flashdata("success_msg","اندراج شد");
		}
		else
		{
			$this->session->set_flashdata("error_msg","اندراج نہیں ہوا");
		}
		redirect("user");
	}

	public function get_users($id=null,$group=null)
	{
		if(!empty($id))
		{
			$this->db->where('users.id',$id);
		}
		if(!empty($group))
		{
			$this->db->where('groups.name',$group);
		}
		$this->db->select('users.*, groups.id as group_id,groups.description');
		$this->db->join('users_groups','users_groups.user_id=users.id');
		$this->db->join('groups','groups.id=users_groups.group_id');
		$get = $this->db->get("users");
		if ($get)
		{
			return $get->result();
		}
		else{
			return false;
		}
	}


	public function update_user($id)
	{
		$this->load->model('Ion_auth_model');
		$data = [
			'ip_address' 	=> $this->input->ip_address(),
			'username' 		=> $this->input->post('name'),
			'first_name' 	=> $this->input->post('first_name'),
			'email' 		=> $this->input->post('email'),
			'phone' 		=> $this->input->post('mobile'),
			'active' 		=> $this->input->post('active'),
		];
		$password = $this->input->post('password');
		if (!empty($password))
		{
			$data['password'] = $this->Ion_auth_model->hash_password($this->input->post('password'));
		}
		$this->db->where('id',$id);
		$this->db->update("users",$data);

		$data = [
			'user_id' => $id,
			'group_id' => $this->input->post('group_id')
		];
		$this->db->where('user_id',$id);
		$this->db->update("users_groups",$data);

		$this->session->set_flashdata("success_msg","ترمیم کامیاب");

		redirect("User");
	}

	public function change_password()
	{
		$this->load->model('Ion_auth_model');
        $password = $this->input->post('password');
        if (!empty($password))
        {
            $identity = $this->session->userdata('identity');

            $change = $this->ion_auth->change_password($identity, $this->input->post('old_password'), $this->input->post('password'));

            if ($change)
            {
                //if the password was successfully changed
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect('Auth/logout', 'refresh');
            }
            else
            {
                $this->session->set_flashdata("error_msg","پرانا پاس ورڈ غلط ہے، دوبارہ کوشش کریں۔");
                redirect('Dashboard', 'refresh');
            }

        }
	}

	public function delete_user($id)
	{
		$data = [
			'is_delete' => 1,
			'deleted_on' => $this->time,
			'deleted_by' => $this->user_id
		];
		$this->db->where('id',$id);
		$this->db->update('users',$data);
		if ($this->db->affected_rows()>0)
		{
			$this->session->set_flashdata("success_msg","Record Deleted Successfully");
		}
		else{
			$this->session->set_flashdata("error_msg","Error");
		}
		redirect("user");
	}

	public function get_groups()
	{
		return $this->db->get('groups')->result();
	}

    public function get_username_by_id($id)
    {
        return $this->db->get_where('users',['id'=>$id])->first_name;
	}

}
