<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
	
	// Dashboard page admin
	public function index()
	{
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
		$this->load->view('dashboard/admin',$data); //ADMIN VIEWS
		$this->load->view('layouts/footer');
	}

	
}
