<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	// Constructor function
	function __construct()
    {
        parent::__construct();
        // Check if not login
        if (!$this->session->userdata('logged_in')) { 
			redirect(base_url('auth/login'));
			exit;
		}
		
		// Check role and use the model for this role
		if ($this->session->userdata('role') == 1) {
			$this->load->model('admin_models');
		}
    }

    //add user into database
	public function addUser()
	{
		// Validasi input data
        $this->form_validation->set_rules('full_name','Nama','required');
		$this->form_validation->set_rules('role_id','Posisi','required|numeric|max_length[1]');
        $this->form_validation->set_rules('unit_kerja','Unit Kerja','required');
        $this->form_validation->set_rules('extention','Extention','required');
		$this->form_validation->set_rules('nip','Nip','required|numeric');
		$this->form_validation->set_rules('email','Email','required|valid_email');
		$this->form_validation->set_rules('domain','Domain','required');
		$this->form_validation->set_rules('username','Username','required|min_length[6]');
		$this->form_validation->set_rules('password','Password','required|min_length[6]');
        
        // Check Data valid
        if($this->form_validation->run() == false){
			// err true
			$this->session->set_flashdata('errAdd',' ');
            // Data for this page
            $data['title'] = "Home | Quartee";
            $data['users'] = $this->admin_models->getAllUser();
            $this->load->model('auth_models');
            $data['user_info'] = $this->auth_models->getUserDetail($this->session->userdata('id_user'));
            $data['role_info'] = $this->admin_models->getRoleName();
		
            // Counting
            $data['count_all_users'] = $this->admin_models->getALlUserCount();
            $data['count_uploader'] = $this->admin_models->getNumRowsData(2,'users');
            $data['count_guest'] = $this->admin_models->getNumRowsData(3,'users');
            
            // Load views
            $this->load->view('layouts/header',$data);
            $this->load->view('layouts/sidebar');
            $this->load->view('layouts/navbar',$data);
            $this->load->view('dashboard/admin',$data);
            $this->load->view('layouts/footer', $data);
        }else {

            // Input Data Filter
            $input['full_name'] = $this->input->post('full_name',true);
            $input['role_id'] = $this->input->post('role_id',true);
            $input['unit_kerja'] = $this->input->post('unit_kerja',true);
            $input['extention'] = $this->input->post('extention',true);
            $input['nip'] = $this->input->post('nip',true);
            $input['email'] = $this->input->post('email',true);
			$input['domain'] = $this->input->post('domain',true);
			$input['username'] = $this->input->post('username',true);
			$input['password'] = $this->input->post('password',true);

			 // Send to databse
            $check = $this->admin_models->addUser($input);
            
			// success true
			$this->session->set_flashdata('succAdd',' ');
            redirect(base_url());
        }
    }

    // Set Data User for Edit
    public function setData($id)
    {
        $data = [
            'user' => $this->admin_models->getDataFromId($id)
        ];
        // var_dump($data);
        $this->load->view('admin/edit', $data);
    }

    public function update($id)
    {
        // Data to check on ajax
        $data['success'] = FALSE;
        $data['messages'] = [];

        // Set delimiter errors
        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
        // Set rules
        $this->form_validation->set_rules('full_name','Nama','required');
		$this->form_validation->set_rules('role_id','Posisi','required|numeric|max_length[1]');
        $this->form_validation->set_rules('unit_kerja','Unit Kerja','required');
        $this->form_validation->set_rules('extention','Extention','required');
		$this->form_validation->set_rules('nip','Nip','required|numeric');
		$this->form_validation->set_rules('email','Email','required|valid_email');
		$this->form_validation->set_rules('domain','Domain','required');
		$this->form_validation->set_rules('username','Username','required|min_length[6]');
        $this->form_validation->set_rules('password','Password','required|min_length[6]');
        
        
        if ($this->form_validation->run() == TRUE) {
            // Set Data and Update Data if there's no errors
            $data['success'] = TRUE;
            $this->admin_models->updateUser($id);
        } else {
            // Check Validation
            foreach ( $_POST as $key => $value )
            {
                // Add to error
                $data['messages'][$key] = form_error($key);
            }
        }
        
        echo json_encode($data);
    }
    
    // Delete User
    public function delete($id)
    {
        $this->admin_models->deleteUser($id);
        echo "<script>
                alert('Delete user success');
                document.location.href='".base_url()."';
            </script>";
    }
}