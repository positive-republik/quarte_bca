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
		$this->form_validation->set_rules('nip','Nip','required|numeric');
		$this->form_validation->set_rules('ttl','Tanggal Lahir','required');
		$this->form_validation->set_rules('domain','Domain','required');
		$this->form_validation->set_rules('username','Username','required|min_length[8]');
		$this->form_validation->set_rules('password','Password','required|min_length[8]');
        
        // Check Data valid
        if($this->form_validation->run() == false){
			// err true
			$this->session->set_flashdata('errAdd',' ');
            // Data for this page
            $data['title'] = "Home | Quartee";
            $data['users'] = $this->admin_models->getAllUser();

            // Counting
            $data['count_all_users'] = $this->admin_models->getALlUserCount();
            $data['count_uploader'] = $this->admin_models->getNumRowsData(2,'users');
            $data['count_guest'] = $this->admin_models->getNumRowsData(3,'users');
            
            // Load views
            $this->load->view('layouts/header',$data);
            $this->load->view('layouts/sidebar');
            $this->load->view('layouts/navbar');
            $this->load->view('dashboard/admin',$data);
            $this->load->view('layouts/footer');
        }else {

            // Input Data Filter
            $input['full_name'] = $this->input->post('full_name',true);
            $input['role_id'] = $this->input->post('role_id',true);
            $input['unit_kerja'] = $this->input->post('unit_kerja',true);
            $input['nip'] = $this->input->post('nip',true);
            $input['ttl'] = $this->input->post('ttl',true);
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