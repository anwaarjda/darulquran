<?php
class User extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("User_model");
	}

	public function index()
	{
	    $this->check_permission();
		$data['users'] = $this->User_model->get_users();
		$data['groups'] = $this->User_model->get_groups();

		$this->load->view('layout/header');
		$this->load->view('layout/nav');
		$this->load->view('user/index',$data);
		$this->load->view('layout/footer');
	}

	public function get_user($id)
	{
        $this->check_permission();
        $data = $this->User_model->get_users($id);
		echo json_encode($data);
	}

	public function add_user()
	{
        $this->check_permission();
        $this->User_model->add_user();
	}

	public function update_user($id)
	{
        $this->check_permission();
        $this->User_model->update_user($id);
	}

	public function delete_user($id)
	{
        $this->check_permission();
        $this->User_model->delete_user($id);
	}

	public function change_password()
	{
        $this->User_model->change_password();
	}

    public function check_permission()
    {
        if ($this->group != 'admin')
        {
            $this->session->set_flashdata("error_msg","You are not eligible for this action");
            redirect('Dashboard');
        }
	}
}
